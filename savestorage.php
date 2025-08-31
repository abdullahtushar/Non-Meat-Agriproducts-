<?php
include 'connection.php'; // Include database connection
    // Collect form data safely
    $storageType   = isset($_POST['storageType']) ? $conn->real_escape_string($_POST['storageType']) : '';
    $batchQuantity = isset($_POST['batchQuantity']) ? (int)$_POST['batchQuantity'] : 0;
    $storedDate    = isset($_POST['storedDate']) ? $conn->real_escape_string($_POST['storedDate']) : '';

    if ($storageType && $batchQuantity && $storedDate) {
        // Insert into table
        $sql = "INSERT INTO storage_batches (storage_type, quantity, stored_date)
                VALUES ('$storageType', $batchQuantity, '$storedDate')";

        if ($conn->query($sql) === TRUE) {
            echo "✅ New storage batch added successfully!";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    } else {
        echo "⚠️ Please fill in all fields.";
    }

    $conn->close();

?>
