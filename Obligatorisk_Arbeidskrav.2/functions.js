// Generelt varsel for sletting
function bekreft() {
    return confirm("Er du sikker på at du vil slette dette?");
}

// Spesifikt varsel for student, med navn
function bekreftSlettStudent(brukernavn, fornavn, etternavn) {
    if (!brukernavn) return false;
    return confirm("Er du sikker på at du vil slette studenten: " + fornavn + " " + etternavn + " (" + brukernavn + ")?");
}
