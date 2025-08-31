<?php
$conn = new mysqli("localhost", "root", "", "farm_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fullname = $conn->real_escape_string($_POST['fullname']);
$email    = $conn->real_escape_string($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert user
$sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful! <a href='landing.php'>Go back</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
