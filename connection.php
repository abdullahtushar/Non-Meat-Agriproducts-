<?php
$host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "greenharvestfarm";
$port = 3306;

$conn = new mysqli($host, $db_username, $db_password, $db_name, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>