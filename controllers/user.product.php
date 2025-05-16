<?php
require_once("../../db/customer.db.php");

// Function to safely query the database
function safeQuery($conn, $query, $params = [], $types = '')
{
  // Prepare statement if params are provided
  if (!empty($params)) {
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
      // Handle preparation error
      error_log("Query preparation failed: " . mysqli_error($conn));
      return false;
    }

    // Bind parameters if they exist
    if (!empty($types) && !empty($params)) {
      mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    // Execute statement
    $result = mysqli_stmt_execute($stmt);

    if ($result === false) {
      // Handle execution error
      error_log("Query execution failed: " . mysqli_stmt_error($stmt));
      mysqli_stmt_close($stmt);
      return false;
    }

    // Get result for SELECT queries
    $resultSet = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return $resultSet;
  }

  // For simple queries without prepared statements
  return mysqli_query($conn, $query);
}

// Function to get all products
function getAllProducts($conn)
{
  $query = "SELECT s.shoe_ID, s.Name, s.Size, s.Color, s.Price, s.Stock_Quantity, s.picture_path, 
                   br.name AS Brand, c.name AS Category 
            FROM shoe s
            LEFT JOIN brand br ON s.brand_ID = br.brand_ID
            LEFT JOIN category c ON s.category_ID = c.category_ID";

  $result = safeQuery($conn, $query);

  $products = [];
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $products[] = $row;
    }
  }

  return $products;
}

// Function to get a single product by ID
function getProductById($conn, $shoe_ID)
{
  $query = "SELECT s.shoe_ID, s.Name, s.Size, s.Color, s.Price, s.Stock_Quantity, s.picture_path, 
                   br.name AS Brand, c.name AS Category 
            FROM shoe s
            LEFT JOIN brand br ON s.brand_ID = br.brand_ID
            LEFT JOIN category c ON s.category_ID = c.category_ID
            WHERE s.shoe_ID = ?";

  $result = safeQuery($conn, $query, [$shoe_ID], 'i');

  return $result ? mysqli_fetch_assoc($result) : null;
}

// Function to add a product
function addProduct($conn, $name, $brand_id, $category_id, $size, $color, $price, $stock_quantity, $picture_path)
{
  $query = "INSERT INTO shoe (Name, brand_ID, category_ID, Size, Color, Price, Stock_Quantity, picture_path) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

  $result = safeQuery(
    $conn,
    $query,
    [$name, $brand_id, $category_id, $size, $color, $price, $stock_quantity, $picture_path],
    'siissids'
  );

  return $result ? mysqli_insert_id($conn) : false;
}

// Function to update a product
function updateProduct($conn, $shoe_id, $name, $brand_id, $category_id, $size, $color, $price, $stock_quantity, $picture_path)
{
  $query = "UPDATE shoe 
            SET Name = ?, brand_ID = ?, category_ID = ?, Size = ?, Color = ?, 
                Price = ?, Stock_Quantity = ?, picture_path = ?
            WHERE shoe_ID = ?";

  $result = safeQuery(
    $conn,
    $query,
    [$name, $brand_id, $category_id, $size, $color, $price, $stock_quantity, $picture_path, $shoe_id],
    'siissdsis'
  );

  return $result ? true : false;
}

// Function to delete a product
function deleteProduct($conn, $shoe_id)
{
  $query = "DELETE FROM shoe WHERE shoe_ID = ?";

  $result = safeQuery($conn, $query, [$shoe_id], 'i');

  return $result ? true : false;
}

// Function to get product categories
function getCategories($conn)
{
  $query = "SELECT * FROM category";

  $result = safeQuery($conn, $query);

  $categories = [];
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $categories[] = $row;
    }
  }

  return $categories;
}

// Function to get product brands
function getBrands($conn)
{
  $query = "SELECT * FROM brand";

  $result = safeQuery($conn, $query);

  $brands = [];
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $brands[] = $row;
    }
  }

  return $brands;
}
