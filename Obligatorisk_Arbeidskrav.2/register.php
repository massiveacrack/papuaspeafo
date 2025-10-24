<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['klasse'])) {
        $klassekode = $_POST['klassekode'];
        $klassenavn = $_POST['klassenavn'];
        $studiumkode = $_POST['studiumkode'];
        $stmt = $pdo->prepare("INSERT INTO klasse (klassekode, klassenavn, studiumkode) VALUES (?, ?, ?)");
        $stmt->execute([$klassekode, $klassenavn, $studiumkode]);
    } elseif (isset($_POST['student'])) {
        $brukernavn = $_POST['brukernavn'];
        $fornavn = $_POST['fornavn'];
        $etternavn = $_POST['etternavn'];
        $klassekode = $_POST['klassekode'];
        $stmt = $pdo->prepare("INSERT INTO student (brukernavn, fornavn, etternavn, klassekode) VALUES (?, ?, ?, ?)");
        $stmt->execute([$brukernavn, $fornavn, $etternavn, $klassekode]);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrer Data</title>
</head>
<body>
    <h2>Registrer Ny Klasse</h2>
    <form method="post">
        <input type="hidden" name="klasse">
        Klassekode: <input type="text" name="klassekode" required><br>
        Klassenavn: <input type="text" name="klassenavn" required><br>
        Studiumkode: <input type="text" name="studiumkode" required><br>
        <input type="submit" value="Registrer Klasse">
    </form>

    <h2>Registrer Ny Student</h2>
    <form method="post">
        <input type="hidden" name="student">
        Brukernavn: <input type="text" name="brukernavn" required><br>
        Fornavn: <input type="text" name="fornavn" required><br>
        Etternavn: <input type="text" name="etternavn" required><br>
        Klassekode: 
        <select name="klassekode" required>
            <?php
            $result = $pdo->query("SELECT klassekode, klassenavn FROM klasse");
            while ($row = $result->fetch()) {
                echo "<option value='{$row['klassekode']}'>{$row['klassenavn']}</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Registrer Student">
    </form>
    <a href="index.php">Tilbake til meny</a>
</body>
</html>