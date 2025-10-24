<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_klasse'])) {
        $klassekode = $_POST['klassekode'];
        $stmt = $pdo->prepare("DELETE FROM klasse WHERE klassekode = ?");
        $stmt->execute([$klassekode]);
    } elseif (isset($_POST['delete_student'])) {
        $brukernavn = $_POST['brukernavn'];
        $stmt = $pdo->prepare("DELETE FROM student WHERE brukernavn = ?");
        $stmt->execute([$brukernavn]);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Slett Data</title>
</head>
<body>
    <h2>Slett Klasse</h2>
    <form method="post">
        <input type="hidden" name="delete_klasse">
        Klassekode: 
        <select name="klassekode" required>
            <?php
            $result = $pdo->query("SELECT klassekode, klassenavn FROM klasse");
            while ($row = $result->fetch()) {
                echo "<option value='{$row['klassekode']}'>{$row['klassenavn']}</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Slett Klasse">
    </form>

    <h2>Slett Student</h2>
    <form method="post">
        <input type="hidden" name="delete_student">
        Brukernavn: 
        <select name="brukernavn" required>
            <?php
            $result = $pdo->query("SELECT brukernavn, fornavn, etternavn FROM student");
            while ($row = $result->fetch()) {
                echo "<option value='{$row['brukernavn']}'>{$row['fornavn']} {$row['etternavn']}</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Slett Student">
    </form>
    <a href="index.php">Tilbake til meny</a>
</body>
</html>