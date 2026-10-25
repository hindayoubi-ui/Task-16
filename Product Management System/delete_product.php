
<?php
// Connect to the database
include("conn.php");

// Get product ID from the URL
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

// Check if the ID is valid
if ($id === false || $id === null || $id < 1) {
    exit("Invalid product ID");
}

// Prepare the delete query
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param("i", $id);

// Execute the query
if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting product: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
