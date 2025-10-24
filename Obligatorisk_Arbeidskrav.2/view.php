<?php
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vis Data</title>
</head>
<body>
    <h2>Alle Klasser</h2>
    <table border="1">
        <tr><th>Klassekode</th><th>Klassenavn</th><th>Studiumkode</th></tr>
        <?php
        $result = $pdo->query("SELECT * FROM klasse");
        while ($row = $result->fetch()) {
            echo "<tr><td>{$row['klassekode']}</td><td>{$row['klassenavn']}</td><td>{$row['studiumkode']}</td></tr>";
        }
        ?>
    </table>

    <h2>Alle Studenter</h2>
    <table border="1">
        <tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th></th></tr>
        <?php
        $result = $pdo->query("SELECT * FROM student");
        while ($row = $result->fetch()) {
            echo "<tr><td>{$row['brukernavn']}</td><td>{$row['fornavn']}</td><td>{$row['etternavn']}</td><td>{$row['klassekode']}</td></tr>";
        }
        ?>
    </table>
    <a href="index.php">Tilbake til meny</a>
</body>
</html>