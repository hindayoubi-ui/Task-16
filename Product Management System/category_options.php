
<?php
// Include database connection
include("conn.php");

// Get all categories from database
$sql = "SELECT * FROM categories ORDER BY name ASC";
$result = $conn->query($sql);

// Display each category as an option
while ($category = $result->fetch_assoc()) {
    echo '<option value="' . htmlspecialchars($category["name"], ENT_QUOTES, "UTF-8") . '">';
    echo htmlspecialchars($category["name"], ENT_QUOTES, "UTF-8");
    echo '</option>';
}

// Close database connection
$conn->close();
?>
