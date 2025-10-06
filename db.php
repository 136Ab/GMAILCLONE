<?php
$servername = "localhost";
$username   = "uykwtuo7kz79u";
$password   = "ioop0adayzc5";
$dbname     = "dbei0tjy74a1lg";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
