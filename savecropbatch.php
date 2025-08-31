<?php
include 'connection.php';

// Get form data safely
$cropType     = $conn->real_escape_string($_POST['cropType']);
$cropQuantity = (int)$_POST['cropQuantity'];
$plantingDate = $conn->real_escape_string($_POST['plantingDate']);

// Insert into database
$sql = "INSERT INTO crop_batches (crop_type, quantity, planting_date) 
        VALUES ('$cropType', $cropQuantity, '$plantingDate')";

if ($conn->query($sql) === TRUE) {
    echo "New crop batch added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
