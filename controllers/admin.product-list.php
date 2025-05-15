<?php
require_once("../db/customer.db.php");

// Initialize variables sa search
$brands = [];
$categories = [];
$colors = [];
$result = false;
$brand_filter = '';
$category_filter = '';
$color_filter = '';
$min_price = '';
$max_price = '';
$search_term = '';

// if expire
if (isset($_SESSION['product_message_time']) && (time() - $_SESSION['product_message_time'] > 5)) {
  unset($_SESSION['product_message']);
  unset($_SESSION['product_message_type']);
  unset($_SESSION['product_message_time']);
}

// filter value
if (isset($_GET['brand'])) $brand_filter = $_GET['brand'];
if (isset($_GET['category'])) $category_filter = $_GET['category'];
if (isset($_GET['color'])) $color_filter = $_GET['color'];
if (isset($_GET['min_price'])) $min_price = $_GET['min_price'];
if (isset($_GET['max_price'])) $max_price = $_GET['max_price'];
if (isset($_GET['search'])) $search_term = $_GET['search']; // Get search parameter

// Function to log activity
function logActivity($conn, $action, $details)
{
  // Get admin details from session
  $admin_username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';

  // Prepare SQL statement
  // Changed to use columns that actually exist in the activity_log table
  $log_sql = "INSERT INTO activity_log (admin_name, action, details, created_at) VALUES (?, ?, ?, NOW())";
  $stmt = $conn->prepare($log_sql);

  if ($stmt) {
    $stmt->bind_param("sss", $admin_username, $action, $details);
    $stmt->execute();
    $stmt->close();
  }
}

//  product update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
  $shoe_id = $_POST['shoe_id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $brand_id = $_POST['brand_id'];
  $category_id = $_POST['category_id'];
  $color = $_POST['color'];
  $size = $_POST['size'];
  $stock_quantity = $_POST['stock_quantity'];
  $picture_path = $_POST['picture_path'];

  // Get old product details for activity log
  $old_product_query = "SELECT s.*, b.Brand_Name as brand_name, c.Category_Name as category_name
                        FROM shoe s
                        LEFT JOIN brand b ON s.brand_ID = b.brand_ID
                        LEFT JOIN category c ON s.category_ID = c.category_ID
                        WHERE s.shoe_ID = ?";
  $stmt = $conn->prepare($old_product_query);
  $old_product = null;

  if ($stmt) {
    $stmt->bind_param("i", $shoe_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $old_product = $result->fetch_assoc();
    }
    $stmt->close();
  }

  $update_sql = "UPDATE shoe SET
                Name = ?,
                Price = ?,
                brand_ID = ?,
                category_ID = ?,
                Color = ?,
                Size = ?,
                Stock_Quantity = ?,
                picture_path = ?
                WHERE shoe_ID = ?";

  $stmt = $conn->prepare($update_sql);
  if ($stmt) {
    $stmt->bind_param("sdiissisi", $name, $price, $brand_id, $category_id, $color, $size, $stock_quantity, $picture_path, $shoe_id);
    if ($stmt->execute()) {
      $_SESSION['product_message'] = "Product \"$name\" successfully updated.";
      $_SESSION['product_message_type'] = "success";

      // Log the activity
      // Get updated brand and category names
      $brand_query = "SELECT Brand_Name FROM brand WHERE brand_ID = ?";
      $brand_stmt = $conn->prepare($brand_query);
      $brand_name = '';
      if ($brand_stmt) {
        $brand_stmt->bind_param("i", $brand_id);
        $brand_stmt->execute();
        $brand_result = $brand_stmt->get_result();
        if ($brand_result->num_rows > 0) {
          $brand_row = $brand_result->fetch_assoc();
          $brand_name = $brand_row['Brand_Name'];
        }
        $brand_stmt->close();
      }

      $category_query = "SELECT Category_Name FROM category WHERE category_ID = ?";
      $category_stmt = $conn->prepare($category_query);
      $category_name = '';
      if ($category_stmt) {
        $category_stmt->bind_param("i", $category_id);
        $category_stmt->execute();
        $category_result = $category_stmt->get_result();
        if ($category_result->num_rows > 0) {
          $category_row = $category_result->fetch_assoc();
          $category_name = $category_row['Category_Name'];
        }
        $category_stmt->close();
      }

      // Create details for log
      $changes = array();
      if ($old_product) {
        if ($old_product['Name'] != $name) $changes[] = "Name: {$old_product['Name']} → $name";
        if ($old_product['Price'] != $price) $changes[] = "Price: ₱{$old_product['Price']} → ₱$price";
        if ($old_product['brand_name'] != $brand_name) $changes[] = "Brand: {$old_product['brand_name']} → $brand_name";
        if ($old_product['category_name'] != $category_name) $changes[] = "Category: {$old_product['category_name']} → $category_name";
        if ($old_product['Color'] != $color) $changes[] = "Color: {$old_product['Color']} → $color";
        if ($old_product['Size'] != $size) $changes[] = "Size: {$old_product['Size']} → $size";
        if ($old_product['Stock_Quantity'] != $stock_quantity) $changes[] = "Stock: {$old_product['Stock_Quantity']} → $stock_quantity";

        $details = "Updated product ID #$shoe_id \"$name\". Changes: " . implode(", ", $changes);
      } else {
        $details = "Updated product ID #$shoe_id \"$name\"";
      }

      logActivity($conn, "Update Product", $details);
    } else {
      $_SESSION['product_message'] = "Error updating product: " . $stmt->error;
      $_SESSION['product_message_type'] = "error";
    }
    $_SESSION['product_message_time'] = time();
    $stmt->close();
  } else {
    $_SESSION['product_message'] = "Error preparing statement: " . $conn->error;
    $_SESSION['product_message_type'] = "error";
    $_SESSION['product_message_time'] = time();
  }

  echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "';</script>";
  exit;
}

// product delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_product'])) {
  $shoe_id = $_POST['shoe_id'];
  $product_name = $_POST['product_name'];

  // Get product details before deletion for more detailed logging
  $product_query = "SELECT s.*, b.Brand_Name as brand_name, c.Category_Name as category_name
                   FROM shoe s
                   LEFT JOIN brand b ON s.brand_ID = b.brand_ID
                   LEFT JOIN category c ON s.category_ID = c.category_ID
                   WHERE s.shoe_ID = ?";
  $stmt = $conn->prepare($product_query);
  $product_details = '';

  if ($stmt) {
    $stmt->bind_param("i", $shoe_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $product = $result->fetch_assoc();
      $product_details = "Brand: {$product['brand_name']}, Category: {$product['category_name']}, " .
        "Color: {$product['Color']}, Size: {$product['Size']}, " .
        "Price: ₱{$product['Price']}, Stock: {$product['Stock_Quantity']}";
    }
    $stmt->close();
  }

  $delete_sql = "DELETE FROM shoe WHERE shoe_ID = ?";
  $stmt = $conn->prepare($delete_sql);
  if ($stmt) {
    $stmt->bind_param("i", $shoe_id);
    if ($stmt->execute()) {
      $_SESSION['product_message'] = "Product \"$product_name\" successfully removed.";
      $_SESSION['product_message_type'] = "success";

      // Log the activity
      $details = "Removed product ID #$shoe_id \"$product_name\". Details: $product_details";
      logActivity($conn, "Delete Product", $details);
    } else {
      $_SESSION['product_message'] = "Error removing product: " . $stmt->error;
      $_SESSION['product_message_type'] = "error";
    }
    $_SESSION['product_message_time'] = time();
    $stmt->close();
  } else {
    $_SESSION['product_message'] = "Error preparing statement: " . $conn->error;
    $_SESSION['product_message_type'] = "error";
    $_SESSION['product_message_time'] = time();
  }

  echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "';</script>";
  exit;
}

// brands
$brand_sql = "SELECT brand_ID, Brand_Name FROM brand ORDER BY Brand_Name";
$brand_result = $conn->query($brand_sql);
if ($brand_result && $brand_result->num_rows > 0) {
  while ($row = $brand_result->fetch_assoc()) {
    $brands[] = $row;
  }
}

// categories
$category_sql = "SELECT category_ID, Category_Name FROM category ORDER BY Category_Name";
$category_result = $conn->query($category_sql);
if ($category_result && $category_result->num_rows > 0) {
  while ($row = $category_result->fetch_assoc()) {
    $categories[] = $row;
  }
}

//  colors
$color_sql = "SELECT DISTINCT Color FROM shoe ORDER BY Color";
$color_result = $conn->query($color_sql);
if ($color_result && $color_result->num_rows > 0) {
  while ($row = $color_result->fetch_assoc()) {
    $colors[] = $row['Color'];
  }
}

// connect for filters
$sql = "SELECT s.*, b.Brand_Name as brand_name, c.Category_Name as category_name
        FROM shoe s
        LEFT JOIN brand b ON s.brand_ID = b.brand_ID
        LEFT JOIN category c ON s.category_ID = c.category_ID
        WHERE 1=1";

// search
if (!empty($search_term)) {
  $search_term_escaped = $conn->real_escape_string($search_term);
  $sql .= " AND (s.Name LIKE '%$search_term_escaped%' 
             OR b.Brand_Name LIKE '%$search_term_escaped%'
             OR c.Category_Name LIKE '%$search_term_escaped%'
             OR s.Color LIKE '%$search_term_escaped%'
             OR s.Size LIKE '%$search_term_escaped%')";
}

if (!empty($brand_filter)) {
  $sql .= " AND s.brand_ID = " . $conn->real_escape_string($brand_filter);
}
if (!empty($category_filter)) {
  $sql .= " AND s.category_ID = " . $conn->real_escape_string($category_filter);
}
if (!empty($color_filter)) {
  $sql .= " AND s.Color = '" . $conn->real_escape_string($color_filter) . "'";
}
if (!empty($min_price)) {
  $sql .= " AND s.Price >= " . $conn->real_escape_string($min_price);
}
if (!empty($max_price)) {
  $sql .= " AND s.Price <= " . $conn->real_escape_string($max_price);
}
$sql .= " ORDER BY s.shoe_ID DESC";

// Execute main query
$result = $conn->query($sql);

// Handle AJAX message clearing
if (basename($_SERVER['PHP_SELF']) == 'clear_message.php') {
  unset($_SESSION['product_message']);
  unset($_SESSION['product_message_type']);
  unset($_SESSION['product_message_time']);
  echo json_encode(['status' => 'success']);
  exit;
}
