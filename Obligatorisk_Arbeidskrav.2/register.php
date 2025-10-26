<?php 
include("db_connect.php"); 
$klassemessage = '';
$studentmessage = '';

if (isset($_POST["velgUkedagKnapp"])) {

    // --- Registrer klasse ---
    if (isset($_POST["klasse"])) {
        $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);
        $klassenavn = mysqli_real_escape_string($db, $_POST["klassenavn"]);
        $studiumkode = mysqli_real_escape_string($db, $_POST["studiumkode"]);

        // Lengdekontroll
        if (strlen($klassekode) > 5) {
            $klassemessage = "Klassekoden er for lang (maks 5 tegn).";
        } elseif (strlen($klassekode) < 5) {
            $klassemessage = "Klassekoden er for kort (må være 5 tegn).";
        } else {
            $sqlSetning = "INSERT INTO klasse (klassekode, klassenavn, studiumkode)
                           VALUES ('$klassekode', '$klassenavn', '$studiumkode')";
            if (mysqli_query($db, $sqlSetning)) {
                $klassemessage = "Følgende klasse er registrert: $klassekode";
            } else {
                if (mysqli_errno($db) == 1062) {
                    $klassemessage = "Denne klassekoden finnes allerede. Prøv en annen.";
                } else {
                    $klassemessage = "Det oppsto en feil under registrering av data.";
                }
            }
        }
    }

    // --- Registrer student ---
    elseif (isset($_POST["student"])) {
        $brukernavn = mysqli_real_escape_string($db, $_POST["brukernavn"]);
        $fornavn = mysqli_real_escape_string($db, $_POST["fornavn"]);
        $etternavn = mysqli_real_escape_string($db, $_POST["etternavn"]);
        $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);

        // Lengdekontroll
        if (strlen($brukernavn) > 7) {
            $studentmessage = "Brukernavnet er for langt (maks 7 tegn).";
        } elseif (strlen($brukernavn) < 7) {
            $studentmessage = "Brukernavnet er for kort (må være 7 tegn).";
        } else {
            $sqlSetning = "INSERT INTO student (brukernavn, fornavn, etternavn, klassekode)
                           VALUES ('$brukernavn', '$fornavn', '$etternavn', '$klassekode')";
            if (mysqli_query($db, $sqlSetning)) {
                $studentmessage = "Følgende student er registrert: $fornavn $etternavn";
            } else {
                if (mysqli_errno($db) == 1062) {
                    $studentmessage = "Dette brukernavnet finnes allerede. Prøv et annet.";
                } else {
                    $studentmessage = "Det oppsto en feil under registrering av data.";
                }
            }
        }
    }
}


?>

<!DOCTYPE html>
<a href="index.html">Tilbake til meny</a>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Registrer Data</title>

    <script>
    // Denne kjører når du trykker på "Registrer"-knappene
    function bekreft(type) {
        if (type === 'klasse') {
            return confirm("Er du sikker på at du vil registrere denne klassen?");
        } else if (type === 'student') {
            return confirm("Er du sikker på at du vil registrere denne studenten?");
        } else {
            return confirm("Er du sikker?");
        }
    }
    </script>

</head>
<body>
<h3>Registrer Ny Klasse</h3>
<?php if ($klassemessage) echo "<p>$klassemessage</p>"; ?>

<form method="post" action="">
    <input type="hidden" name="klasse">
    Klassekode: <input type="text" name="klassekode" required><br>
    Klassenavn: <input type="text" name="klassenavn" required><br>
    Studiumkode: <input type="text" name="studiumkode" required><br>
    <input type="submit" value="Registrer klasse" name="velgUkedagKnapp" onclick="return bekreft('klasse')">
</form>



<h3>Registrer Ny Student</h3>
<?php if ($studentmessage) echo "<p>$studentmessage</p>"; ?>

<form method="post" action="">
    <input type="hidden" name="student">
    Brukernavn: <input type="text" name="brukernavn" required><br>
    Fornavn: <input type="text" name="fornavn" required><br>
    Etternavn: <input type="text" name="etternavn" required><br>
    Klassekode: 
    <select name="klassekode" id="klassekode" required>
        <option value="">Velg klassekode</option>
        <?php include("dynamic_functions.php"); listeboksKlassekode(); ?>
    </select><br>
    <input type="submit" value="Registrer student" name="velgUkedagKnapp" onclick="return bekreft('student')">
</form>

<a href="index.html">Tilbake til meny</a>
</body>
</html>
