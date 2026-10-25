
<?php
// Connect to the database
include("conn.php");

// Get category ID from the URL
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

// Check if the ID is valid
if (!$id || $id < 1) {
    exit("Invalid category ID");
}

// Prepare the delete query
$sql = "DELETE FROM categories WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// Execute the query
if ($stmt->execute()) {

    // Return to the main page
    header("Location: index.php");
    exit;

} else {
    echo "Error deleting category: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
