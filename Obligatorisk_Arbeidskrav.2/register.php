<?php 
include("db_connect.php"); 
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Registrer Data</title>
    <script>
    function bekreft(type) {
        if (type === 'klasse') {
            return confirm("Er du sikker på at du vil registrere denne klassen?");
        } else if (type === 'student') {
            return confirm("Er du sikker på at du vil registrere denne studenten?");
        }
        return confirm("Er du sikker?");
    }
    </script>
</head>
<body>
<a href="index.html">Tilbake til meny</a>

<?php
if (isset($_POST["velgUkedagKnapp"])) {

    // --- Registrer klasse ---
    if (isset($_POST["klasse"])) {
        $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);
        $klassenavn = mysqli_real_escape_string($db, $_POST["klassenavn"]);
        $studiumkode = mysqli_real_escape_string($db, $_POST["studiumkode"]);

        // Sjekk om klassen allerede finnes
        $check = mysqli_query($db, "SELECT * FROM klasse WHERE klassekode='$klassekode'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('Feil: Klassen med kode $klassekode finnes allerede.');</script>";
        } else {
            mysqli_query($db, "INSERT INTO klasse (klassekode, klassenavn, studiumkode)
                               VALUES ('$klassekode', '$klassenavn', '$studiumkode')");
            echo "<script>alert('Følgende klasse er registrert: $klassekode');</script>";
        }
    }

    // --- Registrer student ---
    elseif (isset($_POST["student"])) {
        $brukernavn = mysqli_real_escape_string($db, $_POST["brukernavn"]);
        $fornavn = mysqli_real_escape_string($db, $_POST["fornavn"]);
        $etternavn = mysqli_real_escape_string($db, $_POST["etternavn"]);
        $klassekode = mysqli_real_escape_string($db, $_POST["klassekode"]);

        // Sjekk om studenten allerede finnes
        $check = mysqli_query($db, "SELECT * FROM student WHERE brukernavn='$brukernavn'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('Feil: Brukernavnet $brukernavn finnes allerede.');</script>";
        } else {
            mysqli_query($db, "INSERT INTO student (brukernavn, fornavn, etternavn, klassekode)
                               VALUES ('$brukernavn', '$fornavn', '$etternavn', '$klassekode')");
            echo "<script>alert('Følgende student er registrert: $fornavn $etternavn');</script>";
        }
    }
}
?>

<h3>Registrer Ny Klasse</h3>
<form method="post" action="">
    <input type="hidden" name="klasse">
    Klassekode: <input type="text" name="klassekode" required><br>
    Klassenavn: <input type="text" name="klassenavn" required><br>
    Studiumkode: <input type="text" name="studiumkode" required><br>
    <input type="submit" value="Registrer klasse" name="velgUkedagKnapp" onclick="return bekreft('klasse')">
</form>

<h3>Registrer Ny Student</h3>
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
</body>
</html>
