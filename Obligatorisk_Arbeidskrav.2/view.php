<?php
include("db_connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vis Data</title>
</head>
<body>
    <h3>Alle Klasser</h3>
    <?php
    $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente data");
    $antallRader = mysqli_num_rows($sqlResultat);
    if ($antallRader > 0) {
        print("<table border='1'><tr><th>Klassekode</th><th>Klassenavn</th><th>Studiumkode</th></tr>");
        for ($r = 1; $r <= $antallRader; $r++) {
            $rad = mysqli_fetch_array($sqlResultat);
            print("<tr><td>{$rad['klassekode']}</td><td>{$rad['klassenavn']}</td><td>{$rad['studiumkode']}</td></tr>");
        }
        print("</table>");
    } else {
        print("Ingen klasser registrert");
    }
    ?>

    <h3>Alle Studenter</h3>
    <?php
    $sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente data");
    $antallRader = mysqli_num_rows($sqlResultat);
    if ($antallRader > 0) {
        print("<table border='1'><tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th></tr>");
        for ($r = 1; $r <= $antallRader; $r++) {
            $rad = mysqli_fetch_array($sqlResultat);
            print("<tr><td>{$rad['brukernavn']}</td><td>{$rad['fornavn']}</td><td>{$rad['etternavn']}</td><td>{$rad['klassekode']}</td></tr>");
        }
        print("</table>");
    } else {
        print("Ingen studenter registrert");
    }
    ?>
    <a href="index.html">Tilbake til meny</a>
</body>
</html>