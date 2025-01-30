<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moja_strona";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$login = "admin";
$pass = "password123";
?>

