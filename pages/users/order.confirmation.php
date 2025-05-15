<?php
ob_start();
session_start();
require_once("../../db/customer.db.php");
require_once("../../static/users/home-header.php");

// Check if the user is logged in and print debug info
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$isLoggedIn = !empty($userId);

// Debug code - only keep temporarily to diagnose issues
if (!$isLoggedIn) {
  // For debugging only - remove after fixing the issue
  echo '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
          Debug: No user ID in session. Session data: ' . json_encode($_SESSION) . '
        </div>';
}

// Initialize empty cart if not exists
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Get current user info from database
$userData = [];

if ($userId) {
  try {
    // Use the customer table and get the currently logged in user
    $stmt = $conn->prepare("SELECT * FROM customer WHERE customer_ID = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    // Debug check - if user data is empty despite having user ID
    if (empty($userData)) {
      echo '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
              Debug: User ID exists but no matching record found in database.
            </div>';
    }
  } catch (Exception $e) {
    // Handle database error with more info
    echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            Database error: ' . $e->getMessage() . '
          </div>';
    error_log("Database error: " . $e->getMessage());
  }
}

// Mask email function
function maskEmail($email)
{
  if (empty($email)) return '';

  $parts = explode('@', $email);
  if (count($parts) != 2) return $email;

  $name = $parts[0];
  $domain = $parts[1];

  $nameLength = strlen($name);
  if ($nameLength <= 2) {
    $maskedName = $name[0] . str_repeat('*', $nameLength - 1);
  } else {
    $visibleCount = min(2, $nameLength);
    $maskedCount = $nameLength - $visibleCount;
    $maskedName = substr($name, 0, $visibleCount) . str_repeat('*', $maskedCount);
  }

  // Fix: Properly handle domain parts that might not have a dot
  $domainParts = explode('.', $domain);
  if (count($domainParts) > 1) {
    $domainName = $domainParts[0];
    $domainExtension = $domainParts[count($domainParts) - 1];
    $maskedDomain = substr($domainName, 0, 1) . str_repeat('*', strlen($domainName) - 1) . '.' . $domainExtension;
  } else {
    $maskedDomain = $domain; // Keep original if no dot in domain
  }

  return $maskedName . '@' . $maskedDomain;
}

// Get email from userData and mask it
$maskedEmail = isset($userData['email']) ? maskEmail($userData['email']) : '';

// Process form submission
if (isset($_POST['place_order'])) {
  // Get cart data from the hidden field
  $cartData = isset($_POST['cart_data']) ? json_decode($_POST['cart_data'], true) : [];
  $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'cod';

  // For debugging - check what's in the cart data
  error_log("Cart data received: " . json_encode($cartData));

  // Calculate totals
  $subtotal = 0;

  // FIXED: Added proper check for cartData before using it
  if (!empty($cartData) && is_array($cartData)) {
    foreach ($cartData as $item) {
      $subtotal += $item['price'] * $item['quantity'];
    }

    $shipping = $subtotal > 1000 ? 0 : 100; // Free shipping for orders over ₱1000
    $tax = $subtotal * 0.12; // 12% tax
    $total = $subtotal + $shipping + $tax;

    try {
      // Start transaction for mysqli
      $conn->autocommit(FALSE);

      // FIX: Handle the case where user is not logged in
      if (!$userId) {
        // Instead of throwing an exception, redirect to login page
        $conn->rollback();
        $_SESSION['redirect_after_login'] = 'checkout.php'; // Set redirect after login
        $_SESSION['cart_data'] = $cartData; // Save cart data to restore after login

        echo '<script>
                alert("Please log in to complete your purchase.");
                window.location.href = "//shoe-apparel.org/log/user/login.user.php";
              </script>';
        exit();
      }

      // 1. Insert into order table
      $orderDate = date('Y-m-d H:i:s');

      $stmt = $conn->prepare("INSERT INTO `order` (customer_ID, Order_Date, Total_Amount, Status) VALUES (?, ?, ?, ?)");
      $status = 'confirm';
      $stmt->bind_param("isds", $userId, $orderDate, $total, $status);
      $stmt->execute();

      // Check if the insert was successful
      if ($stmt->affected_rows <= 0) {
        throw new Exception("Failed to insert order record");
      }

      $orderId = $conn->insert_id;

      // 2. Insert into order_details table
      $detailsStmt = $conn->prepare("INSERT INTO order_details (order_ID, shoe_ID, Quantity) VALUES (?, ?, ?)");
      $detailsStmt->bind_param("iii", $orderId, $shoeId, $quantity);

      $orderItemsInserted = false;
      foreach ($cartData as $item) {
        $shoeId = $item['id'];
        $quantity = $item['quantity'];
        $detailsStmt->execute();
        if ($detailsStmt->affected_rows > 0) {
          $orderItemsInserted = true;
        }
      }

      if (!$orderItemsInserted) {
        throw new Exception("Failed to insert order details");
      }

      // 3. Insert into payments table
      $paymentStmt = $conn->prepare("INSERT INTO payments (order_ID, payment_Method, payment_Status, payment_Date) VALUES (?, ?, ?, ?)");
      $paymentStatus = 'Processing';
      $paymentStmt->bind_param("isss", $orderId, $paymentMethod, $paymentStatus, $orderDate);
      $paymentStmt->execute();

      if ($paymentStmt->affected_rows <= 0) {
        throw new Exception("Failed to insert payment record");
      }

      // Commit transaction
      $conn->commit();

      // Clear the cart after successful order
      $_SESSION['cart'] = [];

      // Store order information in session for confirmation page
      $_SESSION['order_success'] = true;
      $_SESSION['order_id'] = $orderId;
      $_SESSION['order_total'] = $total;
      $_SESSION['payment_method'] = $paymentMethod;

      // Calculate estimated delivery date (5-7 days from order)
      $minDeliveryDate = date('Y-m-d', strtotime('+5 days'));
      $maxDeliveryDate = date('Y-m-d', strtotime('+7 days'));
      $_SESSION['delivery_estimate'] = [$minDeliveryDate, $maxDeliveryDate];

      header("Location: order-confirmation.php");
      exit();
    } catch (Exception $e) {
      // Rollback transaction on error
      $conn->rollback();
      error_log("Order processing error: " . $e->getMessage());
      $orderError = "There was an error processing your order: " . $e->getMessage();
    } finally {
      // Restore autocommit mode
      $conn->autocommit(TRUE);
    }
  } else {
    $orderError = "Your cart is empty. Please add items to your cart before checking out.";
  }
}

// Process logout only if explicitly requested
if (isset($_POST["logout"])) {
  // Just destroy the session without redirecting
  session_destroy();
  session_start();
  // Redirect after logout
  header("Location: //shoe-apparel.org/log/user/login.user.php");
  exit();
}

// Default values
$subtotal = 0;
$shipping = 0;
$tax = 0;
$total = 0;

ob_end_flush();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Checkout</title>
  <meta name="description" content="Checkout page">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <?php if (!$isLoggedIn): ?>
      <!-- Show login notice if not logged in -->
      <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
        <div>
          <p class="font-bold">You need to be logged in to checkout</p>
          <p>Please log in to complete your purchase.</p>
        </div>
        <a href="//shoe-apparel.org/log/user/login.user.php" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
          Log In
        </a>
      </div>
    <?php endif; ?>

    <div class="flex flex-col lg:flex-row gap-8">
      <!-- Checkout Form -->
      <div class="lg:w-2/3">
        <h1 class="text-2xl font-semibold mb-6">Checkout</h1>
        <form method="post" action="">
          <!-- Hidden field to pass cart data from localStorage to server -->
          <input type="hidden" name="cart_data" id="cart_data" value="">

          <?php if (isset($orderError)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
              <?php echo $orderError; ?>
            </div>
          <?php endif; ?>

          <!-- Display user information if logged in -->
          <?php if ($isLoggedIn && !empty($userData)): ?>
            <div class="mb-8">
              <h2 class="text-xs uppercase tracking-wide font-semibold text-gray-500 mb-4">Your Information</h2>
              <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($userData['name'] ?? 'Not available'); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($maskedEmail); ?></p>
                <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($userData['address'] ?? 'Not available'); ?></p>
              </div>
            </div>
          <?php endif; ?>

          <!-- Payment Method Section -->
          <div class="mb-8">
            <h2 class="text-xs uppercase tracking-wide font-semibold text-gray-500 mb-4">Payment Method</h2>

            <div class="payment-option border border-gray-300 rounded-md p-4 mb-4 hover:border-red-500 cursor-pointer">
              <label class="flex items-center justify-between cursor-pointer w-full">
                <div class="flex items-center">
                  <input type="radio" name="payment_method" value="cod" checked
                    class="w-4 h-4 text-red-600 border-gray-300 focus:ring-red-500">
                  <span class="ml-2">Cash On Delivery</span>
                </div>
                <img src="/asset/cod.png" alt="Cash On Delivery" class="h-6 w-auto">
              </label>
            </div>

            <div class="payment-option border border-gray-300 rounded-md p-4 mb-4 hover:border-red-500 cursor-pointer">
              <label class="flex items-center justify-between cursor-pointer w-full">
                <div class="flex items-center">
                  <input type="radio" name="payment_method" value="gcash"
                    class="w-4 h-4 text-red-600 border-gray-300 focus:ring-red-500">
                  <span class="ml-2">GCash</span>
                </div>
                <img src="/asset/gcash.png" alt="GCash" class="h-6 w-auto">
              </label>
            </div>
          </div>

          <button type="submit" name="place_order" id="place_order_btn"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-md transition">
            Place Order
          </button>
        </form>
      </div>

      <!-- Cart Summary -->
      <div class="lg:w-1/3">
        <div class="bg-gray-100 rounded-lg p-6">
          <h2 class="text-xs uppercase tracking-wide font-semibold text-gray-500 mb-4">Cart Summary</h2>

          <div id="checkout-cart-items">
            <!-- Cart items will be loaded here dynamically -->
            <div class="text-center py-6 text-gray-500">
              <p>Loading cart items...</p>
            </div>
          </div>

          <div class="mt-6">
            <div class="flex justify-between mb-2">
              <span>Subtotal</span>
              <span id="checkout-subtotal">₱0.00</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Shipping & handling</span>
              <span id="checkout-shipping">₱0.00</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>VAT rate</span>
              <span id="checkout-tax">₱0.00</span>
            </div>

            <div class="flex justify-between pt-4 border-t border-gray-200 text-lg font-semibold">
              <span>Total</span>
              <span id="checkout-total">₱0.00</span>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg p-6 mt-6 shadow-sm">
          <h3 class="font-semibold mb-4">30-DAY SATISFACTION GUARANTEE</h3>

          <div class="flex items-start mb-4">
            <span class="flex-shrink-0 inline-flex items-center justify-center w-6 h-6 bg-gray-100 text-gray-600 rounded-full text-sm mr-3">1</span>
            <span>Try our products at home for 30 days</span>
          </div>

          <div class="flex items-start mb-4">
            <span class="flex-shrink-0 inline-flex items-center justify-center w-6 h-6 bg-gray-100 text-gray-600 rounded-full text-sm mr-3">2</span>
            <span>Explore our collection of high-quality products</span>
          </div>

          <div class="flex items-start mb-4">
            <span class="flex-shrink-0 inline-flex items-center justify-center w-6 h-6 bg-gray-100 text-gray-600 rounded-full text-sm mr-3">3</span>
            <span>Not for you? We'll refund your entire order</span>
          </div>

          <p class="text-xs text-gray-500">Limited-time offer. Terms apply.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Simple script to highlight selected payment option
    document.querySelectorAll('input[name="payment_method"]').forEach(input => {
      input.addEventListener('change', function() {
        document.querySelectorAll('.payment-option').forEach(option => {
          option.classList.remove('border-red-500', 'bg-red-50');
          option.classList.add('border-gray-300');
        });
        this.closest('.payment-option').classList.remove('border-gray-300');
        this.closest('.payment-option').classList.add('border-red-500', 'bg-red-50');
      });
    });

    // Initialize the first payment option as selected
    document.querySelector('input[name="payment_method"]:checked')
      .closest('.payment-option').classList.remove('border-gray-300');
    document.querySelector('input[name="payment_method"]:checked')
      .closest('.payment-option').classList.add('border-red-500', 'bg-red-50');

    // Load cart data from localStorage
    document.addEventListener('DOMContentLoaded', function() {
      localStorage.removeItem('soleStyleCart');
    });
  </script>
</body>

</html>