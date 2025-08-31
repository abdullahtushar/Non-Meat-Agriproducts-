<?php
include 'connection.php'; // Include database connection
    // Collect form data
    $itemType     = isset($_POST['itemType']) ? $conn->real_escape_string($_POST['itemType']) : '';
    $batchQuantity = isset($_POST['batchQuantity']) ? (int)$_POST['batchQuantity'] : 0;
    $receivedDate = isset($_POST['receivedDate']) ? $conn->real_escape_string($_POST['receivedDate']) : '';

    if ($itemType && $batchQuantity && $receivedDate) {
        // Insert into database
        $sql = "INSERT INTO inventory_batches (item_type, quantity, received_date) 
                VALUES ('$itemType', $batchQuantity, '$receivedDate')";

        if ($conn->query($sql) === TRUE) {
            echo "New inventory batch added successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Please fill out all fields.";
    }

    $conn->close();

?>
