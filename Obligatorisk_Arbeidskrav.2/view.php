<?php
include("db_connect.php");
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Vis Data</title>
</head>
<body>
<a href="index.html">Tilbake til meny</a>

<h3>Alle Klasser</h3>
<?php
$sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die ("Ikke mulig å hente data");
if (mysqli_num_rows($sqlResultat) > 0) {
    echo "<table border='1'><tr><th>Klassekode</th><th>Klassenavn</th><th>Studiumkode</th></tr>";
    while ($rad = mysqli_fetch_array($sqlResultat)) {
        echo "<tr><td>{$rad['klassekode']}</td><td>{$rad['klassenavn']}</td><td>{$rad['studiumkode']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "Ingen klasser registrert";
}
?>

<h3>Alle Studenter</h3>
<?php
$sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die ("Ikke mulig å hente data");
if (mysqli_num_rows($sqlResultat) > 0) {
    echo "<table border='1'><tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th></tr>";
    while ($rad = mysqli_fetch_array($sqlResultat)) {
        echo "<tr><td>{$rad['brukernavn']}</td><td>{$rad['fornavn']}</td><td>{$rad['etternavn']}</td><td>{$rad['klassekode']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "Ingen studenter registrert";
}
?>
</body>
</html>
