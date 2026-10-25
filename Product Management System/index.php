<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Management System</title>

    <!-- Bootstrap CSS -->
    <link href="bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar p-3">

            <h4 class="mb-4">Product System</h4>

            <button class="sidebar-link active" onclick="showSection('productsSection', this)">
                <i class="bi bi-box-seam"></i> Products
            </button>

            <button class="sidebar-link" onclick="showSection('categoriesSection', this)">
                <i class="bi bi-tags"></i> Categories
            </button>

        </div>

        <!-- Main Content -->
        <div class="main-content p-4">

            <!-- Products Section -->
            <div id="productsSection">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Products</h2>

                    <button class="btn btn-primary" onclick="showForm('productForm')">
                        <i class="bi bi-plus-lg"></i> Add Product
                    </button>
                </div>

                <!-- Add Product Form (hidden at first) -->
                <div class="card shadow-sm mb-4" id="productForm" style="display: none;">

                    <div class="card-header">
                        <h5 class="mb-0">Add New Product</h5>
                    </div>

                    <div class="card-body">

                        <form action="add_product.php" method="POST">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Enter product name" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Category</label>
                                    <select name="category" id="productCategory" class="form-select" required>
                                        <option value="">Select Category</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control"
                                        placeholder="Enter price" min="0" step="0.01" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control"
                                        placeholder="Enter quantity" min="0" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control"
                                        rows="3" placeholder="Enter product description" required></textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save Product</button>

                                    <button type="button" class="btn btn-secondary"
                                        onclick="hideForm('productForm')">Cancel</button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>

                <!-- Search -->
                <input type="text" id="searchInput" class="form-control mb-3"
                    placeholder="Search products...">




                <select id="categoryFilter" class="form-select mb-3"
                    onchange="filterProducts()">
                    <option value="">All Categories</option>
                </select>


                <!-- Products Table -->
                <div class="card shadow-sm">
                    <div class="card-body table-responsive">

                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="productsTable">
                                <!-- Products will load here -->
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <!-- Categories Section -->
            <div id="categoriesSection" style="display: none;">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Categories</h2>

                    <button class="btn btn-primary" onclick="showForm('categoryForm')">
                        <i class="bi bi-plus-lg"></i> Add Category
                    </button>
                </div>

                <!-- Add Category Form -->
                <div class="card shadow-sm mb-4" id="categoryForm" style="display: none;">
                    <div class="card-body">

                        <form action="add_category.php" method="POST">

                            <label class="form-label">Category Name</label>

                            <input type="text" name="name" class="form-control mb-3"
                                placeholder="Enter category name" required>

                            <button type="submit" class="btn btn-primary">Save Category</button>

                            <button type="button" class="btn btn-secondary"
                                onclick="hideForm('categoryForm')">Cancel</button>

                        </form>

                    </div>
                </div>

                <!-- Categories Table -->
                <div class="card shadow-sm">
                    <div class="card-body table-responsive">

                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="categoriesTable">
                                <!-- Categories will load here -->
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Custom JavaScript -->
    <script src="script.js"></script>

</body>

</html>