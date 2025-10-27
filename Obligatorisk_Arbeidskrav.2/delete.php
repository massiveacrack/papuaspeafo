<?php
include("db_connect.php");
include("dynamic_functions.php");

$klassemessage = '';
$studentmessage = '';

if (isset($_POST["slettKlasseKnapp"])) {
    $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);
    if (!$klassekode) {
        $klassemessage = "Det er ikke valgt noe klassekode.";
    } else {
        $sqlSetning = "SELECT COUNT(*) as count FROM student WHERE klassekode = '$klassekode'";
        $result = mysqli_query($db, $sqlSetning);
        $row = mysqli_fetch_array($result);
        if ($row['count'] > 0) {
            $klassemessage = "Kan ikke slette klasse med studenter tilknyttet. Fjern studenter først.";
        } else {
            if (mysqli_query($db, "DELETE FROM klasse WHERE klassekode = '$klassekode'")) {
                $klassemessage = "Følgende klasse er nå slettet: <strong>$klassekode</strong>";
            } else {
                $klassemessage = "Feil under sletting: " . mysqli_error($db);
            }
        }
    }
}

elseif (isset($_POST["slettStudentKnapp"])) {
    $brukernavn = mysqli_real_escape_string($db, $_POST["brukernavn"]);
    if (!$brukernavn) {
        $studentmessage = "Det er ikke valgt noe brukernavn.";
    } else {
        if (mysqli_query($db, "DELETE FROM student WHERE brukernavn = '$brukernavn'")) {
            $studentmessage = "Følgende student er nå slettet: <strong>$brukernavn</strong>";
        } else {
            $studentmessage = "Feil under sletting: " . mysqli_error($db);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Slett Data</title>
    <script>
    function bekreft(type) {
        if (type === 'klasse') {
            return confirm("Er du sikker på at du vil slette denne klassen?");
        } else if (type === 'student') {
            return confirm("Er du sikker på at du vil slette denne studenten?");
        }
        return confirm("Er du sikker?");
    }
    </script>
</head>
<body>
<a href="index.html">Tilbake til meny</a>

<h3>Slett Klasse</h3>
<?php if ($klassemessage) echo "<p>$klassemessage</p>"; ?>

<form method="post" action="" onsubmit="return bekreft('klasse');">
    Klassekode: 
    <select name="klassekode" required>
        <option value="">Velg klassekode</option>
        <?php listeboksKlassekode(); ?>
    </select><br>
    <input type="submit" value="Slett Klasse" name="slettKlasseKnapp">
</form>

<h3>Slett Student</h3>
<?php if ($studentmessage) echo "<p>$studentmessage</p>"; ?>

<form method="post" action="" onsubmit="return bekreft('student');">
    Brukernavn: 
    <select name="brukernavn" required>
        <option value="">Velg brukernavn</option>
        <?php listeboksBrukernavn(); ?>
    </select><br>
    <input type="submit" value="Slett Student" name="slettStudentKnapp">
</form>
</body>
</html>
