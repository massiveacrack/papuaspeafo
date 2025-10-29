# --- sei_theta_analyzer.py ---
import argparse, os, json, numpy as np, matplotlib.pyplot as plt, csv

def load_csv(path):
    x = np.genfromtxt(path, delimiter=',')
    return x if x.ndim==2 else x[:,None]

def detrend_per_channel(X): return X - X.mean(axis=0, keepdims=True)

def phases_from_signal(sig):
    cos_part = sig; sin_part = np.roll(sig, 1)  # ~90° phase shift
    return np.arctan2(sin_part, cos_part)

def kuramoto_order(phases):
    z = np.exp(1j*phases); return np.abs(np.mean(z, axis=0))

def compute_metrics(X, fs, win_sec=0.4, step_sec=None):
    if step_sec is None: step_sec = win_sec/2.0
    T, K = X.shape; win = max(4, int(round(win_sec*fs))); hop = max(1, int(round(step_sec*fs)))
    SE_list=[]; C_list=[]; R_list=[]; S_list=[]; centers=[]
    for start in range(0, T-win+1, hop):
        seg = X[start:start+win, :]; centers.append(start+win//2)
        phases = np.array([phases_from_signal(seg[:,i]) for i in range(seg.shape[1])])
        Sval = float(np.mean(kuramoto_order(phases)))
        corr = np.corrcoef(seg.T); upper = corr[np.triu_indices(seg.shape[1],1)]
        Cval = float(np.nanmean(upper))
        Rval = float(np.var(np.mean(seg, axis=1)))
        amp = np.abs(seg).flatten(); hi = np.percentile(amp, 99.0)
        hist,_ = np.histogram(amp, bins=32, range=(0, hi if hi>0 else np.max(amp)+1e-12), density=True)
        p = hist / (np.sum(hist)+1e-12); SEval = float(-np.sum(p*np.log(p+1e-12)))
        SE_list.append(SEval); C_list.append(Cval); R_list.append(Rval); S_list.append(Sval)

    def scale01(a):
        a=np.array(a,float); lo,hi=np.nanpercentile(a,1),np.nanpercentile(a,99)
        return np.zeros_like(a) if hi-lo<1e-12 else np.clip((a-lo)/(hi-lo),0,1)

    SE=scale01(SE_list); C=scale01(C_list); R=scale01(R_list); S=scale01(S_list); t_idx=np.array(centers,int)
    return dict(SE=SE,C=C,R=R,S=S,t=t_idx)

def theta_from(SE,C,R,S, alphaC=1.0,alphaR=0.9,alphaS=0.8,beta=0.7):
    SE_norm = SE/max(SE[0],1e-9) if SE.size else SE
    raw = alphaC*C + alphaR*R + alphaS*S - beta*SE_norm
    return 1/(1+np.exp(-4.0*raw))

def main():
    ap=argparse.ArgumentParser(description="SEI Theta Analyzer with Custom Formula Support")
    ap.add_argument("--in",dest="inp",required=True)
    ap.add_argument("--fs",type=float,required=True)
    ap.add_argument("--win",type=float,default=0.4)
    ap.add_argument("--step",type=float,default=None)
    ap.add_argument("--out",type=str,required=True)
    ap.add_argument("--detrend",action="store_true")
    ap.add_argument("--alphaC",type=float,default=1.0)
    ap.add_argument("--alphaR",type=float,default=0.9)
    ap.add_argument("--alphaS",type=float,default=0.8)
    ap.add_argument("--beta",type=float,default=0.7)
    ap.add_argument("--theta_star",type=float,default=0.35)
    ap.add_argument("--T_star",type=int,default=30)
    ap.add_argument("--death_index",type=int,default=None)
    ap.add_argument("--formula",action="append",help="Custom formulas, e.g. 'NewVar = (C + R - SE)/2'")

    a=ap.parse_args()
    os.makedirs(a.out,exist_ok=True)
    X=load_csv(a.inp); X=detrend_per_channel(X) if a.detrend else X
    m=compute_metrics(X,a.fs,a.win,a.step)
    SE,C,R,S,t=m["SE"],m["C"],m["R"],m["S"],m["t"]
    Theta=theta_from(SE,C,R,S,a.alphaC,a.alphaR,a.alphaS,a.beta)

    # Compute custom formulas (if any)
    custom_results = {}
    if a.formula:
        for f_str in a.formula:
            try:
                if "=" not in f_str:
                    print(f"Invalid formula (missing '='): {f_str}")
                    continue
                name, expr = [x.strip() for x in f_str.split("=", 1)]
                local_env = {"np": np, "SE": SE, "C": C, "R": R, "S": S, "Theta": Theta}
                result = eval(expr, {"__builtins__": {}}, local_env)
                custom_results[name] = np.array(result, float)
                print(f"Computed custom variable '{name}' using formula: {expr}")
            except Exception as e:
                print(f"Error computing formula '{f_str}':", e)

    # Save everything to CSV
    csvp=os.path.join(a.out,"sei_theta_timeseries.csv")
    with open(csvp,"w",newline="") as f:
        headers=["center_index","SE","C","R","S","Theta"] + list(custom_results.keys())
        w=csv.writer(f); w.writerow(headers)
        for i in range(len(Theta)):
            row=[int(t[i]),float(SE[i]),float(C[i]),float(R[i]),float(S[i]),float(Theta[i])]
            for key in custom_results:
                row.append(float(custom_results[key][i]))
            w.writerow(row)

    # Helper to save plots
    def save_plot(y,title,ylabel,fname):
        plt.figure(figsize=(8,4)); plt.plot(y)
        if a.death_index is not None:
            xi=int(np.argmin(np.abs(t-a.death_index))); plt.axvline(xi,linestyle="--")
        plt.xlabel("window #"); plt.ylabel(ylabel); plt.title(title); plt.tight_layout()
        plt.savefig(os.path.join(a.out,fname),dpi=160); plt.close()

    # Save standard plots
    save_plot(SE,"SEI: S_E (proxy)","S_E","plot_SE.png")
    save_plot(C,"SEI: C","C","plot_C.png")
    save_plot(R,"SEI: R","R","plot_R.png")
    save_plot(S,"SEI: S","S","plot_S.png")
    save_plot(Theta,"SEI: Θ(t)","Theta","plot_Theta.png")

    # Save custom plots
    for key, val in custom_results.items():
        save_plot(val, f"Custom Metric: {key}", key, f"plot_{key}.png")

    persist=None
    if a.death_index is not None:
        idx=int(np.argmax(t>=a.death_index)); end=min(idx+a.T_star,len(Theta))
        persist=bool(np.all(Theta[idx:end]>=a.theta_star))

    # Save summary JSON
    open(os.path.join(a.out,"sei_theta_summary.json"),"w").write(json.dumps({
        "input_csv":a.inp,"fs_Hz":a.fs,"win_sec":a.win,"step_sec":a.step if a.step else a.win/2.0,
        "alphaC":a.alphaC,"alphaR":a.alphaR,"alphaS":a.alphaS,"beta":a.beta,
        "theta_star":a.theta_star,"T_star":a.T_star,"death_index":a.death_index,
        "persist_after_death":persist,
        "custom_formulas":a.formula
    },indent=2))
    print("Done. Outputs in", a.out)

if __name__ == "__main__":
    main()
