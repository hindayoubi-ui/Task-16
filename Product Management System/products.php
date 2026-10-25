
<?php

// Include database connection
include("conn.php");

// Get products from database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Display each product
while ($product = $result->fetch_assoc()) {
?>

    <tr>
        <td><?php echo $product['id']; ?></td>

        <td><?php echo htmlspecialchars($product['name']); ?></td>

        <td><?php echo htmlspecialchars($product['category']); ?></td>

        <td><?php echo $product['price']; ?></td>

        <td><?php echo $product['quantity']; ?></td>

        <td><?php echo htmlspecialchars($product['description']); ?></td>

        <td>
            <a href="edit_product.php?id=<?php echo $product['id']; ?>"
                class="btn btn-success btn-sm">
                Edit
            </a>

            <a href="delete_product.php?id=<?php echo $product['id']; ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure you want to delete this product?')">
                Delete
            </a>
        </td>
    </tr>

<?php
}

// Close database connection
$conn->close();
?>
