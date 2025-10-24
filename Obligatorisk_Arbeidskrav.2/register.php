<?php 
include("db_connect.php"); 
$message = '';

if (isset($_POST["velgUkedagKnapp"])) {

    // --- Registrer klasse ---
    if (isset($_POST["klasse"])) {
        $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);
        $klassenavn = mysqli_real_escape_string($db, $_POST["klassenavn"]);
        $studiumkode = mysqli_real_escape_string($db, $_POST["studiumkode"]);

        // Lengdekontroll
        if (strlen($klassekode) > 5) {
            $message = "Klassekoden er for lang (maks 5 tegn).";
        } elseif (strlen($klassekode) < 5) {
            $message = "Klassekoden er for kort (må være 5 tegn).";
        } else {
            $sqlSetning = "INSERT INTO klasse (klassekode, klassenavn, studiumkode)
                           VALUES ('$klassekode', '$klassenavn', '$studiumkode')";
            if (mysqli_query($db, $sqlSetning)) {
                $message = "Følgende klasse er registrert: $klassekode";
            } else {
                if (mysqli_errno($db) == 1062) {
                    $message = "Denne klassekoden finnes allerede. Prøv en annen.";
                } else {
                    $message = "Det oppsto en feil under registrering av data.";
                }
            }
        }
    }

    // --- Registrer student ---
    elseif (isset($_POST["student"])) {
        $brukernavn = mysqli_real_escape_string($db, $_POST["brukernavn"]);
        $fornavn = mysqli_real_escape_string($db, $_POST["fornavn"]);
        $etternavn = mysqli_real_escape_string($db, $_POST["etternavn"]);
        $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);

        // Lengdekontroll
        if (strlen($brukernavn) > 7) {
            $message = "Brukernavnet er for langt (maks 7 tegn).";
        } elseif (strlen($brukernavn) < 7) {
            $message = "Brukernavnet er for kort (må være 7 tegn).";
        } else {
            $sqlSetning = "INSERT INTO student (brukernavn, fornavn, etternavn, klassekode)
                           VALUES ('$brukernavn', '$fornavn', '$etternavn', '$klassekode')";
            if (mysqli_query($db, $sqlSetning)) {
                $message = "Følgende student er registrert: $fornavn $etternavn";
            } else {
                if (mysqli_errno($db) == 1062) {
                    $message = "Dette brukernavnet finnes allerede. Prøv et annet.";
                } else {
                    $message = "Det oppsto en feil under registrering av data.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrer Data</title>
    <meta charset="UTF-8">
</head>
<body>
<h3>Registrer Ny Klasse</h3>
<?php if ($message) echo "<p>$message</p>"; ?>

<form method="post" action="">
    <input type="hidden" name="klasse">
    Klassekode: <input type="text" name="klassekode" required><br>
    Klassenavn: <input type="text" name="klassenavn" required><br>
    Studiumkode: <input type="text" name="studiumkode" required><br>
    <input type="submit" value="Registrer klasse" name="velgUkedagKnapp">
</form>

<h3>Registrer Ny Student</h3>
<?php if ($message) echo "<p>$message</p>"; ?>

<form method="post" action="">
    <input type="hidden" name="student">
    Brukernavn: <input type="text" name="brukernavn" required><br>
    Fornavn: <input type="text" name="fornavn" required><br>
    Etternavn: <input type="text" name="etternavn" required><br>
    Klassekode: 
    <select name="klassekode" id="klassekode" required>
        <option value="">Velg klassekode</option>
        <?php include("dynamic_functions.php"); listeboksKlassekode(); ?>
    </select><br>
    <input type="submit" value="Registrer student" name="velgUkedagKnapp">
</form>

<a href="index.html">Tilbake til meny</a>
</body>
</html>
