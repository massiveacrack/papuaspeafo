<?php
include("db_connect.php");

$message = '';
if (isset($_POST["slettPoststedKnapp"])) {
    $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);
    if (!$klassekode) {
        $message = "Det er ikke valgt noe klassekode";
    } else {
        $sqlSetning = "SELECT COUNT(*) as count FROM student WHERE klassekode = '$klassekode'";
        $result = mysqli_query($db, $sqlSetning);
        $row = mysqli_fetch_array($result);
        if ($row['count'] > 0) {
            $message = "Kan ikke slette klasse med studenter tilknyttet. Fjern studenter først.";
        } else {
            $sqlSetning = "DELETE FROM klasse WHERE klassekode = '$klassekode'";
            mysqli_query($db, $sqlSetning) or die ("ikke mulig å slette data");
            $message = "Følgende klasse er nå slettet: $klassekode";
        }
    }
} elseif (isset($_POST["slettStudentKnapp"])) {
    $brukernavn = mysqli_real_escape_string($db, $_POST["brukernavn"]);
    if (!$brukernavn) {
        $message = "Det er ikke valgt noe brukernavn";
    } else {
        $sqlSetning = "DELETE FROM student WHERE brukernavn = '$brukernavn'";
        mysqli_query($db, $sqlSetning) or die ("ikke mulig å slette data");
        $message = "Følgende student er nå slettet: $brukernavn";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Slett Data</title>
    <script src="functions.js"></script>
</head>
<body>
    <h3>Slett Klasse</h3>
    <?php if ($message) print("<p>$message</p>"); ?>
    <form method="post" action="" id="slettPoststedSkjema" name="slettPoststedSkjema" onSubmit="return bekreft()">
        Klassekode: 
        <select name="klassekode" id="klassekode" required>
            <option value="">velg klassekode</option>
            <?php include("dynamic_functions.php"); listeboksKlassekode(); ?>
        </select><br>
        <input type="submit" value="Slett Klasse" name="slettPoststedKnapp" id="slettPoststedKnapp">
    </form>

    <h3>Slett Student</h3>
    <?php if ($message) print("<p>$message</p>"); ?>
    <form method="post" action="" id="slettPoststedBruker" name="slettPoststedBruker" onSubmit="return bekreft()">
        Brukernavn: 
        <select name="brukernavn" id="brukernavn" required>
            <option value="">velg brukernavn</option>
            <?php include("dynamic_functions.php"); listeboksBrukernavn(); ?>
        </select><br>
        <input type="submit" value="Slett Student" name="slettStudentKnapp" id="slettStudentKnapp">
    </form>
</body>
<a href="index.html">Tilbake til meny</a>
</html>