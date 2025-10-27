<?php
include("db_connect.php");
include("dynamic_functions.php");

$klassemessage = '';
$studentmessage = '';

if (isset($_POST["klasse"])) {
    $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);
    $klassenavn = mysqli_real_escape_string($db, $_POST["klassenavn"]);
    $studiumkode = mysqli_real_escape_string($db, $_POST["studiumkode"]);

    $sqlSetning = "INSERT INTO klasse (klassekode, klassenavn, studiumkode)
                   VALUES ('$klassekode', '$klassenavn', '$studiumkode')";
    if (mysqli_query($db, $sqlSetning)) {
        $klassemessage = "Følgende klasse er registrert: $klassekode";
    } else {
        if (mysqli_errno($db) == 1062) {
            $klassemessage = "Denne klassekoden finnes allerede. Velg en annen.";
        } else {
            $klassemessage = "Det oppsto en feil under registrering av klassen.";
        }
    }
}

if (isset($_POST["student"])) {
    $brukernavn = mysqli_real_escape_string($db, $_POST["brukernavn"]);
    $fornavn = mysqli_real_escape_string($db, $_POST["fornavn"]);
    $etternavn = mysqli_real_escape_string($db, $_POST["etternavn"]);
    $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);

    $sqlSetning = "INSERT INTO student (brukernavn, fornavn, etternavn, klassekode)
                   VALUES ('$brukernavn', '$fornavn', '$etternavn', '$klassekode')";
    if (mysqli_query($db, $sqlSetning)) {
        $studentmessage = "Følgende student er registrert: $fornavn $etternavn";
    } else {
        if (mysqli_errno($db) == 1062) {
            $studentmessage = "Dette brukernavnet finnes allerede. Velg et annet.";
        } else {
            $studentmessage = "Det oppsto en feil under registrering av studenten.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Registrer Data</title>
    <script src="functions.js"></script>
</head>
<body>
<a href="index.html">Tilbake til meny</a>

<h3>Registrer Ny Klasse</h3>
<?php if ($klassemessage) echo "<p>$klassemessage</p>"; ?>
<form method="post" action="" onsubmit="return confirm('Er du sikker på at du vil registrere denne klassen?');">
    <input type="hidden" name="klasse">
    Klassekode: <input type="text" name="klassekode" required><br>
    Klassenavn: <input type="text" name="klassenavn" required><br>
    Studiumkode: <input type="text" name="studiumkode" required><br>
    <input type="submit" value="Registrer klasse">
</form>

<h3>Registrer Ny Student</h3>
<?php if ($studentmessage) echo "<p>$studentmessage</p>"; ?>
<form method="post" action="" onsubmit="return confirm('Er du sikker på at du vil registrere denne studenten?');">
    <input type="hidden" name="student">
    Brukernavn: <input type="text" name="brukernavn" required><br>
    Fornavn: <input type="text" name="fornavn" required><br>
    Etternavn: <input type="text" name="etternavn" required><br>
    Klassekode: 
    <select name="klassekode" required>
        <option value="">Velg klassekode</option>
        <?php listeboksKlassekode(); ?>
    </select><br>
    <input type="submit" value="Registrer student">
</form>
</body>
</html>
