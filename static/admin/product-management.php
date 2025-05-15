<?php
// Include the logActivity function if not already included via admin.controller.php
if (!function_exists('logActivity')) {
  function logActivity($action, $details)
  {
    global $conn;
    $admin = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';
    $insert_log = "INSERT INTO activity_log (admin_name, action, details, created_at) VALUES ('$admin', '$action', '$details', NOW())";
    mysqli_query($conn, $insert_log);
  }
}

// Message handling
$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
  // Get form data
  $category_id = $conn->real_escape_string($_POST['category_id']);
  $name = $conn->real_escape_string($_POST['name']);
  $size = $conn->real_escape_string($_POST['size']);
  $color = $conn->real_escape_string($_POST['color']);
  $price = $conn->real_escape_string($_POST['price']);
  $stock = $conn->real_escape_string($_POST['stock_quantity']);

  // Handle brand selection or custom brand input
  $brand_id = null;
  $brand_name = ""; // Store brand name for activity logging
  if ($_POST['brand_type'] == 'existing' && !empty($_POST['brand_id'])) {
    $brand_id = $conn->real_escape_string($_POST['brand_id']);

    // Get brand name for activity logging
    $brand_query = "SELECT Brand_Name FROM brand WHERE brand_ID = '$brand_id'";
    $brand_result = $conn->query($brand_query);
    if ($brand_result && $brand_result->num_rows > 0) {
      $brand_name = $brand_result->fetch_assoc()['Brand_Name'];
    }
  } elseif ($_POST['brand_type'] == 'new' && !empty($_POST['custom_brand'])) {
    // Insert the new brand first and get its ID
    $custom_brand = $conn->real_escape_string($_POST['custom_brand']);
    $brand_name = $custom_brand; // Store for activity logging
    $brandInsertSql = "INSERT INTO brand (Brand_Name) VALUES ('$custom_brand')";

    if ($conn->query($brandInsertSql) === TRUE) {
      $brand_id = $conn->insert_id; // Get the ID of the newly inserted brand
    } else {
      $message = "Error adding new brand: " . $conn->error;
      $messageType = "error";
    }
  }

  // If no brand ID, stop here
  if ($brand_id === null) {
    if (empty($message)) {
      $message = "Please select a brand or enter a new one.";
      $messageType = "error";
    }
  } else {
    // Handle image upload
    $picture_path = '';
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
      // Define path relative to the script location
      $target_dir = "uploads/products/";

      // For debugging - log the absolute path
      $absolute_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/products/';
      error_log("Absolute path for uploads: " . $absolute_path);

      // Create directory if it doesn't exist
      if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
      }

      $file_extension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
      $file_name = uniqid() . '.' . $file_extension;
      $target_file = $target_dir . $file_name;

      // Debug information
      error_log("Attempting to upload file: " . $_FILES['product_image']['tmp_name'] . " to " . $target_file);

      if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
        // Store only the relative path from web root for consistency
        $picture_path = "uploads/products/" . $file_name;
        error_log("File uploaded successfully to: " . $target_file);
        error_log("Path stored in database: " . $picture_path);
      } else {
        // Log error information
        error_log("Upload failed. Error code: " . $_FILES['product_image']['error']);
        $upload_error = error_get_last();
        error_log("PHP Error: " . print_r($upload_error, true));
      }
    }

    // Get category name for activity logging
    $category_name = "";
    $category_query = "SELECT Category_Name FROM category WHERE category_ID = '$category_id'";
    $category_result = $conn->query($category_query);
    if ($category_result && $category_result->num_rows > 0) {
      $category_name = $category_result->fetch_assoc()['Category_Name'];
    }

    // Insert data into database
    $sql = "INSERT INTO shoe (brand_id, category_id, Name, Size, Color, Price, Stock_Quantity, picture_path)
    VALUES ('$brand_id', '$category_id', '$name', '$size', '$color', '$price', '$stock', '$picture_path')";
    if ($conn->query($sql) === TRUE) {
      $product_id = $conn->insert_id; // Get the ID of the newly inserted product
      // Log the activity
      $log_details = "Added product: $name (Brand: $brand_name, Category: $category_name, Price: ₱$price)";
      logActivity("Add Product", $log_details);
      $message = "Product added successfully!";
      $messageType = "success";
      // Clear form after successful submission
      $_POST = array();
    } else {
      $message = "Error: " . $sql . "<br>" . $conn->error;
      $messageType = "error";
    }
  }
}

// Get brands for dropdown
$brands = [];
$brandQuery = "SELECT * FROM brand ORDER BY brand_id";
$brandResult = $conn->query($brandQuery);

if ($brandResult && $brandResult->num_rows > 0) {
  while ($row = $brandResult->fetch_assoc()) {
    $brands[] = $row;
  }
}

// Get categories for dropdown
$categories = [];
$categoryQuery = "SELECT * FROM category ORDER BY category_id";
$categoryResult = $conn->query($categoryQuery);

if ($categoryResult && $categoryResult->num_rows > 0) {
  while ($row = $categoryResult->fetch_assoc()) {
    $categories[] = $row;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product - SoleStyle</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
  <!-- Notification -->
  <?php if ($message): ?>
    <div id="notification" class="fixed top-4 right-4 z-50 flex items-center p-4 rounded-md shadow-md transform transition-transform duration-300 ease-in-out translate-x-0 <?= $messageType === 'success' ? 'bg-green-50 border-l-4 border-green-500 text-green-800' : 'bg-red-50 border-l-4 border-red-500 text-red-800' ?>">
      <div class="mr-3">
        <?php if ($messageType === 'success'): ?>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        <?php else: ?>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        <?php endif; ?>
      </div>
      <p><?= $message ?></p>
      <button onclick="dismissNotification()" class="ml-auto text-gray-500 hover:text-gray-700 focus:outline-none">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
  <?php endif; ?>

  <div class="max-w-3xl mx-auto p-4 sm:p-6">
    <h1 class="text-xl font-medium text-gray-800 mb-6">Add New Product</h1>

    <div class="bg-white shadow rounded-md p-6">
      <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <!-- Product Name -->
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
          <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Brand Selection -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
          <div class="flex items-center space-x-4 mb-2">
            <div class="flex items-center">
              <input type="radio" id="existing_brand" name="brand_type" value="existing" checked onchange="toggleBrandFields()" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
              <label for="existing_brand" class="ml-2 text-sm text-gray-700">Select existing</label>
            </div>
            <div class="flex items-center">
              <input type="radio" id="new_brand" name="brand_type" value="new" onchange="toggleBrandFields()" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
              <label for="new_brand" class="ml-2 text-sm text-gray-700">Add new brand</label>
            </div>
          </div>

          <div id="existing_brand_container">
            <select name="brand_id" id="brand_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-white">
              <option value="">Select Brand</option>
              <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['brand_ID'] ?>"><?= htmlspecialchars($brand['Brand_Name'] ?? 'Unknown') ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div id="new_brand_container" class="hidden">
            <input type="text" name="custom_brand" id="custom_brand" placeholder="Enter new brand name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
          <!-- Category -->
          <div class="mt-9">
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category_id" id="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-white" required>
              <option value="">Select Category</option>
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['category_ID'] ?>"><?= htmlspecialchars($category['Category_Name'] ?? 'Unknown') ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Size -->
          <div>
            <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Size</label>
            <div class="flex flex-col space-y-2">
              <div class="flex space-x-2">
                <button type="button" onclick="selectSizeSystem('UK')" class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-xs rounded text-gray-700 focus:outline-none">UK</button>
                <button type="button" onclick="selectSizeSystem('EU')" class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-xs rounded text-gray-700 focus:outline-none">EU</button>
                <button type="button" onclick="selectSizeSystem('US')" class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-xs rounded text-gray-700 focus:outline-none">US</button>
              </div>
              <input type="text" name="size" id="size" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. UK 6, EU 40, US 7" required>
            </div>
          </div>

          <!-- Color -->
          <div class="mb-6">
            <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
            <div class="flex space-x-2">
              <input type="text" name="color" id="color" class="flex-grow px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. Red, #FF0000" required>
              <div class="relative">
                <input type="color" id="colorPicker" onchange="updateColorField()" class="h-9 w-9 rounded cursor-pointer absolute opacity-0 inset-0">
                <div class="h-9 w-9 rounded border border-gray-300 overflow-hidden">
                  <div id="colorPreview" class="h-full w-full bg-black"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Price -->
          <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (₱)</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm"></span>
              </div>
              <input type="number" name="price" id="price" step="0.01" min="0" class="pl-7 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
          </div>

          <!-- Stock Quantity -->
          <div>
            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
            <input type="number" name="stock_quantity" id="stock_quantity" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
          </div>

          <!-- Product Image -->
          <div>
            <label for="product_image" class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
            <div class="relative">
              <input type="file" name="product_image" id="product_image" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" accept="image/*" onchange="updateFileName()">
              <div class="w-full px-3 py-2 border border-dashed border-gray-300 bg-gray-50 text-center rounded-md">
                <span id="file-name" class="text-gray-500 text-sm">Choose file</span>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-5">
          <button type="submit" name="add_product" class="w-full md:w-auto px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Add Product
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Toggle between brand selection options
    function toggleBrandFields() {
      const existingBrandRadio = document.getElementById('existing_brand');
      const existingBrandContainer = document.getElementById('existing_brand_container');
      const newBrandContainer = document.getElementById('new_brand_container');
      const brandDropdown = document.getElementById('brand_id');
      const customBrand = document.getElementById('custom_brand');

      if (existingBrandRadio.checked) {
        existingBrandContainer.classList.remove('hidden');
        newBrandContainer.classList.add('hidden');
        customBrand.removeAttribute('required');
        brandDropdown.setAttribute('required', 'required');
      } else {
        existingBrandContainer.classList.add('hidden');
        newBrandContainer.classList.remove('hidden');
        customBrand.setAttribute('required', 'required');
        brandDropdown.removeAttribute('required');
      }
    }

    // Function to update color field from the color picker
    function updateColorField() {
      const colorPicker = document.getElementById('colorPicker');
      const colorField = document.getElementById('color');
      const colorPreview = document.getElementById('colorPreview');
      colorField.value = colorPicker.value;
      colorPreview.style.backgroundColor = colorPicker.value;
    }

    // Function to add size system prefix to the size input
    function selectSizeSystem(system) {
      const sizeField = document.getElementById('size');
      const currentValue = sizeField.value.trim();

      if (currentValue) {
        if (!currentValue.endsWith(',') && !currentValue.endsWith(', ')) {
          sizeField.value = currentValue + ', ' + system + ' ';
        } else {
          sizeField.value = currentValue + system + ' ';
        }
      } else {
        sizeField.value = system + ' ';
      }

      sizeField.focus();
    }

    // Function to update the file name display
    function updateFileName() {
      const input = document.getElementById('product_image');
      const fileNameDisplay = document.getElementById('file-name');

      if (input.files && input.files[0]) {
        fileNameDisplay.textContent = input.files[0].name;
      } else {
        fileNameDisplay.textContent = 'Choose file';
      }
    }

    // Dismiss notification function
    function dismissNotification() {
      const notification = document.getElementById('notification');
      if (notification) {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
          notification.style.display = 'none';
        }, 300);
      }
    }

    // Automatically hide notification after 5 seconds
    if (document.getElementById('notification')) {
      setTimeout(() => {
        dismissNotification();
      }, 5000);
    }
  </script>
</body>

</html>