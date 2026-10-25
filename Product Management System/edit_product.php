
<?php
// Connect to the database
include("conn.php");

// Get product ID from the URL
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

// Check if the ID is valid
if (!$id || $id < 1) {
    exit("Invalid product ID");
}

// Get product information
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

// Check if product exists
if ($result->num_rows == 0) {
    exit("Product not found");
}

$product = $result->fetch_assoc();
$stmt->close();

// Update product when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form values
    $name = trim($_POST["name"]);
    $category = trim($_POST["category"]);
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = trim($_POST["description"]);

    // Update product information
    $sql = "UPDATE products
            SET name = ?, category = ?, price = ?,
                quantity = ?, description = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssdisi",
        $name,
        $category,
        $price,
        $quantity,
        $description,
        $id
    );

    // Execute the update
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating product: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container mt-5">

    <div class="card mx-auto shadow" style="max-width: 600px;">

        <div class="card-header text-white" style="background-color: #e88aaa;">
            <h3 class="mb-0">Edit Product</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?php echo htmlspecialchars($product['name']); ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input
                        type="text"
                        name="category"
                        class="form-control"
                        value="<?php echo htmlspecialchars($product['category']); ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input
                        type="number"
                        name="price"
                        class="form-control"
                        step="0.01"
                        min="0"
                        value="<?php echo htmlspecialchars($product['price']); ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input
                        type="number"
                        name="quantity"
                        class="form-control"
                        min="0"
                        value="<?php echo htmlspecialchars($product['quantity']); ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea
                        name="description"
                        class="form-control"
                        rows="3"><?php echo htmlspecialchars($product['description']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    Save Changes
                </button>

                <a href="index.php" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>
</div>

</body>
</html>
