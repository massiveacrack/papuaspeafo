<?php
$host = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$db = mysqli_connect($host, $username, $password, $database) or die ("Ikke kontakt med database-server");
mysqli_set_charset($db, "utf8");
?>
