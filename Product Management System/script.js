/* Show Products or Categories section */
function showSection(sectionId, button) {
  // Hide both sections
  document.getElementById("productsSection").style.display = "none";
  document.getElementById("categoriesSection").style.display = "none";

  // Show selected section
  document.getElementById(sectionId).style.display = "block";

  // Update active sidebar button
  document.querySelectorAll(".sidebar-link").forEach(function (link) {
    link.classList.remove("active");
  });

  button.classList.add("active");

  // Load data for the selected section
  if (sectionId === "productsSection") {
    loadProducts();
  }

  if (sectionId === "categoriesSection") {
    loadCategories();
  }
}

/* Show Add Product or Add Category form */
function showForm(formId) {
  document.getElementById(formId).style.display = "block";
}

/* Hide form */
function hideForm(formId) {
  document.getElementById(formId).style.display = "none";
}

/* Load products */
function loadProducts() {
  fetch("products.php")
    .then(function (response) {
      return response.text();
    })
    .then(function (data) {
      document.getElementById("productsTable").innerHTML = data;
      filterProducts();
    })
    .catch(function (error) {
      console.log("Error loading products:", error);
    });
}

/* Load categories */
function loadCategories() {
  fetch("categories.php")
    .then(function (response) {
      return response.text();
    })
    .then(function (data) {
      document.getElementById("categoriesTable").innerHTML = data;
    })
    .catch(function (error) {
      console.log("Error loading categories:", error);
    });
}

/* Load categories into Product dropdown and Filter */
function loadCategoryOptions() {
  fetch("category_options.php")
    .then(function (response) {
      return response.text();
    })
    .then(function (data) {
      // Fill the Product form dropdown
      let productCategory = document.getElementById("productCategory");

      if (productCategory) {
        productCategory.innerHTML =
          '<option value="">Select Category</option>' + data;
      }

      // Fill the Category Filter dropdown
      let categoryFilter = document.getElementById("categoryFilter");

      if (categoryFilter) {
        categoryFilter.innerHTML =
          '<option value="">All Categories</option>' + data;
      }
    })
    .catch(function (error) {
      console.log("Error loading categories:", error);
    });
}

/* Search and filter products by category */
function filterProducts() {
  // Get search text
  let searchInput = document.getElementById("searchInput");
  let searchText = searchInput ? searchInput.value.toLowerCase() : "";

  // Get selected category
  let categoryFilter = document.getElementById("categoryFilter");
  let selectedCategory = categoryFilter
    ? categoryFilter.value.toLowerCase()
    : "";

  // Get product rows
  let rows = document.querySelectorAll("#productsTable tr");

  rows.forEach(function (row) {
    // Get all product information
    let productInfo = row.textContent.toLowerCase();

    // Get the category from the third column
    let categoryCell = row.cells[2];
    let productCategory = categoryCell
      ? categoryCell.textContent.trim().toLowerCase()
      : "";

    // Check search and category
    let matchesSearch = productInfo.includes(searchText);

    let matchesCategory =
      selectedCategory === "" || productCategory === selectedCategory;

    // Show product only if both conditions match
    if (matchesSearch && matchesCategory) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

// Check if the search input exists
let searchInput = document.getElementById("searchInput");

if (searchInput) {
  searchInput.addEventListener("input", filterProducts);
}

/* Load data when page opens */
loadProducts();
loadCategories();
loadCategoryOptions();
