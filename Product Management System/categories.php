
<?php
// Include database connection
include("conn.php");

// Get categories from database
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<?php
// Display each category
while ($category = $result->fetch_assoc()) {
?>
    <tr>
        <td><?php echo $category['id']; ?></td>
        <td><?php echo htmlspecialchars($category['name']); ?></td>
        <td>
            <a href="edit_category.php?id=<?php echo $category['id']; ?>"
               class="btn btn-success btn-sm">Edit</a>

            <a href="delete_category.php?id=<?php echo $category['id']; ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Are you sure you want to delete this category?')">
               Delete
            </a>
        </td>
    </tr>
<?php
}

// Close database connection
$conn->close();
?>
