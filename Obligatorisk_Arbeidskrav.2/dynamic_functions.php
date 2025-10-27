<?php
include("db_connect.php");

function listeboksKlassekode() {
    global $db;
    $sqlSetning = "SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode;";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die ("Ikke mulig å hente data fra databasen");

    while ($rad = mysqli_fetch_array($sqlResultat)) {
        $klassekode = $rad["klassekode"];
        $klassenavn = $rad["klassenavn"];
        echo "<option value='$klassekode'>$klassekode $klassenavn</option>";
    }
}

function listeboksBrukernavn() {
    global $db;
    $sqlSetning = "SELECT brukernavn, fornavn, etternavn FROM student ORDER BY brukernavn;";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die ("Ikke mulig å hente data fra databasen");

    while ($rad = mysqli_fetch_array($sqlResultat)) {
        $brukernavn = $rad["brukernavn"];
        $fornavn = $rad["fornavn"];
        $etternavn = $rad["etternavn"];
        echo "<option value='$brukernavn'>$fornavn $etternavn</option>";
    }
}
?>
