
<?php
// Include database connection
include("conn.php");

// Check if the form was submitted
if ($_POST) {

    // Get category name
    $name = trim($_POST["name"]);

    // Insert category into database
    $sql = "INSERT INTO categories (name)
            VALUES ('$name')";

    // Execute INSERT query
    if ($conn->query($sql) === TRUE) {

        // Redirect to index.php
        header("Location: index.php");
        exit;

    } else {
        echo "Error adding category: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
