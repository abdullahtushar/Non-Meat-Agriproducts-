<?php
include 'connection.php'; // Include database connection
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $batchSize = $_POST['batchSize'];
    $packingDate = $_POST['packingDate'];
    $expiryDate = $_POST['batchExpiryDate'];

    $sql = "INSERT INTO batches (batch_size, packing_date, expiry_date) 
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $batchSize, $packingDate, $expiryDate);

    if ($stmt->execute()) {
        echo "✅ Batch added successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
