<?php
ob_start();
session_start();
require_once("../../db/customer.db.php");
require_once("../../static/users/home-header.php");

// Initialize empty cart if not exists
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Process form submission
if (isset($_POST['place_order'])) {
  // Order processing would go here
  $_SESSION['order_success'] = true;
  header("Location: order-confirmation.php");
  exit();
}

if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: //shoe-apparel.org/log/user/login.user.php");
  exit();
}

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
    <div class="flex flex-col lg:flex-row gap-8">
      <!-- Checkout Form -->
      <div class="lg:w-2/3">
        <h1 class="text-2xl font-semibold mb-6">Checkout</h1>
        <form method="post" action="">

          <!-- Shipping Section -->

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

          <button type="submit" name="place_order"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-md transition">
            Place Order
          </button>
        </form>
      </div>

      <!-- Cart Summary -->
      <div class="lg:w-1/3">
        <div class="bg-gray-100 rounded-lg p-6">
          <h2 class="text-xs uppercase tracking-wide font-semibold text-gray-500 mb-4">Cart Summary</h2>

          <?php if (empty($_SESSION['cart'])): ?>
            <div class="text-center py-6 text-gray-500">
              <p>Your cart is empty</p>
            </div>
          <?php else: ?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
              <div class="py-4 border-b border-gray-200 last:border-0">
                <div class="flex justify-between">
                  <span><?= $item['quantity'] ?> x <?= $item['name'] ?></span>
                  <span>₱<?= number_format($item['price'], 2) ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

          <div class="mt-6">
            <div class="flex justify-between mb-2">
              <span>Subtotal</span>
              <span>₱0.00</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Shipping & handling</span>
              <span>₱0.00</span>
            </div>
            <div class="flex justify-between mb-2">
              <span>Tax</span>
              <span>₱0.00</span>
            </div>

            <div class="flex justify-between pt-4 border-t border-gray-200 text-lg font-semibold">
              <span>Total</span>
              <span>₱0.00</span>
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
  </script>
</body>

</html>