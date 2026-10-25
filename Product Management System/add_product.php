
<?php

// Include database connection
include("conn.php");

// Check if the form was submitted
if ($_POST) {

    // Get form values
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];

    // Insert product into database
    $sql = "INSERT INTO products (name, category, price, quantity, description)
            VALUES ('$name', '$category', '$price', '$quantity', '$description')";

    // Execute INSERT query
    if ($conn->query($sql) === TRUE) {

        // Redirect to index.php after adding product
        header("Location: index.php");
        exit;

    } else {

        // Display error message
        echo "Error adding product: " . $conn->error;

    }
}

// Close database connection
$conn->close();

?>
