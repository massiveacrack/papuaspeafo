<?php
include("db_connect.php");

$klassemessage = '';
$studentmessage = '';

if (isset($_POST["slettPoststedKnapp"])) {
    $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);
    if (!$klassekode) {
        $klassemessage = "Det er ikke valgt noe klassekode";
    } else {
        $sqlSetning = "SELECT COUNT(*) as count FROM student WHERE klassekode = '$klassekode'";
        $result = mysqli_query($db, $sqlSetning);
        $row = mysqli_fetch_array($result);
        if ($row['count'] > 0) {
            $klassemessage = "Kan ikke slette klasse med studenter tilknyttet. Fjern studenter først.";
        } else {
            $sqlSetning = "DELETE FROM klasse WHERE klassekode = '$klassekode'";
            mysqli_query($db, $sqlSetning) or die ("ikke mulig å slette data");
            $klassemessage = "Følgende klasse er nå slettet: $klassekode";
        }
    }
} elseif (isset($_POST["slettStudentKnapp"])) {
    $brukernavn = mysqli_real_escape_string($db, $_POST["brukernavn"]);
    if (!$brukernavn) {
        $studentmessage = "Det er ikke valgt noe brukernavn";
    } else {
        $sqlSetning = "DELETE FROM student WHERE brukernavn = '$brukernavn'";
        mysqli_query($db, $sqlSetning) or die ("ikke mulig å slette data");
        $studentmessage = "Følgende student er nå slettet: $brukernavn";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Slett Data</title>
    <script>
    function bekreft(form) {
        if (form.name === "slettPoststedSkjema") {
            var klassekode = form.klassekode.value;
            return confirm("Er du sikker på at du vil slette klassen: " + klassekode + "?");
        } else if (form.name === "slettPoststedBruker") {
            var brukernavn = form.brukernavn.value;
            return confirm("Er du sikker på at du vil slette studenten: " + brukernavn + "?");
        } else {
            return confirm("Er du sikker?");
        }
    }
    </script>
</head>
<body>
    <h3>Slett Klasse</h3>
    <?php if ($klassemessage) print("<p>$klassemessage</p>"); ?>
    <form method="post" action="" name="slettPoststedSkjema" onsubmit="return bekreft(this)">
        Klassekode: 
        <select name="klassekode" id="klassekode" required>
            <option value="">velg klassekode</option>
            <?php include("dynamic_functions.php"); listeboksKlassekode(); ?>
        </select><br>
        <input type="submit" value="Slett Klasse" name="slettPoststedKnapp">
    </form>

    <h3>Slett Student</h3>
    <?php if ($studentmessage) print("<p>$studentmessage</p>"); ?>
    <form method="post" action="" name="slettPoststedBruker" onsubmit="return bekreft(this)">
        Brukernavn: 
        <select name="brukernavn" id="brukernavn" required>
            <option value="">velg brukernavn</option>
            <?php include("dynamic_functions.php"); listeboksBrukernavn(); ?>
        </select><br>
        <input type="submit" value="Slett Student" name="slettStudentKnapp">
        <a href="index.html">Tilbake til meny</a>
    </form>
</body>
</html>
