<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "besir_adam_ds2vtx";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
