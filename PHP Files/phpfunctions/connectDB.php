<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "project_webboard";

$conDB = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conDB, "utf8");
if (!$conDB) {
    die("Connection failed: " . mysqli_connect_error());
}
?>