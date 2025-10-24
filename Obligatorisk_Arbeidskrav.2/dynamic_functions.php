<?php
include("db_connect.php");

function listeboksKlassekode() {
    global $db;
    $sqlSetning = "SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode;";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente data fra databasen");
    $antallRader = mysqli_num_rows($sqlResultat);

    for ($r = 1; $r <= $antallRader; $r++) {
        $rad = mysqli_fetch_array($sqlResultat);
        $klassekode = $rad["klassekode"];
        $klassenavn = $rad["klassenavn"];
        print("<option value='$klassekode'>$klassekode $klassenavn</option>");
    }
}

function listeboksBrukernavn() {
    global $db;
    $sqlSetning = "SELECT brukernavn, fornavn, etternavn FROM student ORDER BY brukernavn;";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente data fra databasen");
    $antallRader = mysqli_num_rows($sqlResultat);

    for ($r = 1; $r <= $antallRader; $r++) {
        $rad = mysqli_fetch_array($sqlResultat);
        $brukernavn = $rad["brukernavn"];
        $fornavn = $rad["fornavn"];
        $etternavn = $rad["etternavn"];
        print("<option value='$brukernavn'>$fornavn $etternavn</option>");
    }
}
?>