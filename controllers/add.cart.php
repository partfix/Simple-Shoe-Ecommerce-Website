<?php
// This file should be placed at /api/get-product.php

// Database connection
require_once '../../shoe-apparel/db/customer.db.php';

// Check if ID parameter is set
if (isset($_GET['id'])) {
  $shoe_id = intval($_GET['id']);

  // Prepare query with proper SQL injection protection
  $query = "SELECT s.*, b.brand_name, c.category_name 
              FROM shoe s
              LEFT JOIN brand b ON s.brand_id = b.brand_id
              LEFT JOIN category c ON s.category_id = c.category_id
              WHERE s.shoe_ID = ?";

  // Prepare statement
  $stmt = mysqli_prepare($conn, $query);

  // Bind parameter
  mysqli_stmt_bind_param($stmt, "i", $shoe_id);

  // Execute statement
  mysqli_stmt_execute($stmt);

  // Get result
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
    // Return product data as JSON
    header('Content-Type: application/json');
    echo json_encode($row);
  } else {
    // Product not found
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['error' => 'Product not found']);
  }

  // Close statement
  mysqli_stmt_close($stmt);
} else {
  // Missing ID parameter
  header('HTTP/1.1 400 Bad Request');
  echo json_encode(['error' => 'Missing product ID']);
}

// Close connection
mysqli_close($conn);
