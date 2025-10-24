<?php
include("db_connect.php");

$message = '';
if (isset($_POST["velgUkedagKnapp"])) { // Reused button name for consistency
    if (isset($_POST["klasse"])) {
        $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);
        $klassenavn = mysqli_real_escape_string($db, $_POST["klassenavn"]);
        $studiumkode = mysqli_real_escape_string($db, $_POST["studiumkode"]);
        $sqlSetning = "INSERT INTO klasse (klassekode, klassenavn, studiumkode) VALUES ('$klassekode', '$klassenavn', '$studiumkode')";
        if (mysqli_query($db, $sqlSetning)) {
            $message = "Følgende klasse er registrert: $klassekode";
        } else {
            $message = mysqli_errno($db) == 1062 ? "Duplikat klassekode, prøv igjen." : "ikke mulig å registrere data";
        }
    } elseif (isset($_POST["student"])) {
        $brukernavn = mysqli_real_escape_string($db, $_POST["brukernavn"]);
        $fornavn = mysqli_real_escape_string($db, $_POST["fornavn"]);
        $etternavn = mysqli_real_escape_string($db, $_POST["etternavn"]);
        $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);
        $sqlSetning = "INSERT INTO student (brukernavn, fornavn, etternavn, klassekode) VALUES ('$brukernavn', '$fornavn', '$etternavn', '$klassekode')";
        if (mysqli_query($db, $sqlSetning)) {
            $message = "Følgende student er registrert: $fornavn $etternavn";
        } else {
            $message = mysqli_errno($db) == 1062 ? "Duplikat brukernavn, prøv igjen." : "ikke mulig å registrere data";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrer Data</title>
</head>
<body>
    <h3>Registrer Ny Klasse</h3>
    <?php if ($message) print("<p>$message</p>"); ?>
    <form method="post" action="" id="velgUkedagSkjema" name="velgUkedagSkjema">
        <input type="hidden" name="klasse">
        Klassekode: <input type="text" name="klassekode" required><br>
        Klassenavn: <input type="text" name="klassenavn" required><br>
        Studiumkode: <input type="text" name="studiumkode" required><br>
        <input type="submit" value="Velg ukedag" name="velgUkedagKnapp" id="velgUkedagKnapp">
    </form>

    <h3>Registrer Ny Student</h3>
    <?php if ($message) print("<p>$message</p>"); ?>
    <form method="post" action="" id="velgUkedagSkjema" name="velgUkedagSkjema">
        <input type="hidden" name="student">
        Brukernavn: <input type="text" name="brukernavn" required><br>
        Fornavn: <input type="text" name="fornavn" required><br>
        Etternavn: <input type="text" name="etternavn" required><br>
        Klassekode: 
        <select name="klassekode" id="klassekode" required>
            <option value="">velg klassekode</option>
            <?php include("dynamic_functions.php"); listeboksKlassekode(); ?>
        </select><br>
        <input type="submit" value="Velg ukedag" name="velgUkedagKnapp" id="velgUkedagKnapp">
    </form>
    <a href="index.html">Tilbake til meny</a>
</body>
</html>