<?php
include("db_connect.php");

/* Funksjon for å lage nedtrekksliste med klassekoder */
function listeboksKlassekode() {
    global $db;

    $sql = "SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode;";
    $resultat = mysqli_query($db, $sql) or die("Feil: kunne ikke hente klasser fra databasen.");

    if (mysqli_num_rows($resultat) == 0) {
        print("<option value=''>Ingen klasser registrert</option>");
    } else {
        while ($rad = mysqli_fetch_array($resultat)) {
            $klassekode = htmlspecialchars($rad["klassekode"]);
            $klassenavn = htmlspecialchars($rad["klassenavn"]);
            print("<option value='$klassekode'>$klassekode ($klassenavn)</option>");
        }
    }
}

/* Funksjon for å lage nedtrekksliste med studenter */
function listeboksBrukernavn() {
    global $db;

    $sql = "SELECT brukernavn, fornavn, etternavn FROM student ORDER BY brukernavn;";
    $resultat = mysqli_query($db, $sql) or die("Feil: kunne ikke hente studenter fra databasen.");

    if (mysqli_num_rows($resultat) == 0) {
        print("<option value=''>Ingen studenter registrert</option>");
    } else {
        while ($rad = mysqli_fetch_array($resultat)) {
            $brukernavn = htmlspecialchars($rad["brukernavn"]);
            $fornavn = htmlspecialchars($rad["fornavn"]);
            $etternavn = htmlspecialchars($rad["etternavn"]);
            print("<option value='$brukernavn'>$brukernavn ($fornavn $etternavn)</option>");
        }
    }
}
?>
