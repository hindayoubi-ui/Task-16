
<?php
// Connect to the database
include("conn.php");

// Get category ID from the URL
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

// Check if the ID is valid
if (!$id || $id < 1) {
    exit("Invalid category ID");
}

// Get category information
$sql = "SELECT * FROM categories WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

// Check if category exists
if ($result->num_rows == 0) {
    exit("Category not found");
}

$category = $result->fetch_assoc();
$stmt->close();

// Update category when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the new category name
    $name = trim($_POST["name"]);

    if ($name == "") {
        $message = "Category name is required.";
    } else {

        // Update category name
        $sql = "UPDATE categories SET name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $name, $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $message = "Error updating category: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <div class="card mx-auto shadow" style="max-width: 500px;">

        <div class="card-header text-white" style="background-color: #e88aaa;">
            <h3 class="mb-0">Edit Category</h3>
        </div>

        <div class="card-body">

            <?php if (!empty($message)) { ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                            $_POST['name'] ?? $category['name']
                        ); ?>"
                        required>
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
