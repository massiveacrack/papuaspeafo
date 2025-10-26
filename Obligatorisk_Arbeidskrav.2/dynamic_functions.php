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

include("db_connect.php");

function listeboksBrukernavn() {
    global $db;
    $sql = "SELECT brukernavn, fornavn, etternavn FROM student ORDER BY brukernavn;";
    $result = mysqli_query($db, $sql) or die("Error fetching students: " . mysqli_error($db));

    while ($row = mysqli_fetch_assoc($result)) {
        $brukernavn = $row['brukernavn'];
        $fornavn = $row['fornavn'];
        $etternavn = $row['etternavn'];
        echo "<option value='$brukernavn'>$fornavn $etternavn</option>";
    }
}
?>