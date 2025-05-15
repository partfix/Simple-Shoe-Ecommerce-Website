<?php
ob_start();
session_start();
require_once("../../db/customer.db.php");
require_once("../../static/users/home-header.php");

// Process logout only if explicitly requested
if (isset($_POST["logout"])) {
  session_destroy();
  session_start();
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
      // Debug: Check if localStorage is working
      try {
        localStorage.setItem('test', 'test');
        localStorage.removeItem('test');
        console.log('localStorage is working');
      } catch (e) {
        console.error('localStorage is not available:', e);
      }

      // Get cart from localStorage
      let cart = [];
      try {
        const cartData = localStorage.getItem('soleStyleCart');
        console.log('Raw cart data:', cartData);

        if (cartData) {
          cart = JSON.parse(cartData);
          console.log('Parsed cart:', cart);
        } else {
          console.log('No cart in localStorage');
        }
      } catch (e) {
        console.error('Error parsing cart:', e);
      }

      const cartItemsContainer = document.getElementById('checkout-cart-items');
      const cartDataInput = document.getElementById('cart_data');
      const placeOrderBtn = document.getElementById('place_order_btn');

      // Set cart data to hidden input for form submission
      cartDataInput.value = JSON.stringify(cart);

      // Clear loading message
      cartItemsContainer.innerHTML = '';

      if (!cart || cart.length === 0) {
        // Display empty cart message
        cartItemsContainer.innerHTML = `
          <div class="text-center py-6 text-gray-500">
            <p>Your cart is empty</p>
          </div>
        `;

        // Disable the place order button if cart is empty
        if (placeOrderBtn) {
          placeOrderBtn.disabled = true;
          placeOrderBtn.classList.add('opacity-50', 'cursor-not-allowed');
          placeOrderBtn.classList.remove('hover:bg-red-700');
        }
      } else {
        // Calculate values
        let subtotal = 0;

        // Add each item to the cart summary
        cart.forEach(item => {
          const itemTotal = item.price * item.quantity;
          subtotal += itemTotal;

          const itemElement = document.createElement('div');
          itemElement.className = 'py-4 border-b border-gray-200 last:border-0';
          itemElement.innerHTML = `
            <div class="flex justify-between">
              <span>${item.quantity} x ${item.name}</span>
              <span>₱${itemTotal.toFixed(2)}</span>
            </div>
            <div class="text-sm text-gray-500">
              ${item.size || 'N/A'} | ${item.color || 'N/A'}
            </div>
          `;

          cartItemsContainer.appendChild(itemElement);
        });

        // Calculate other values
        const shipping = subtotal > 1000 ? 0 : 100; // Free shipping for orders over ₱1000
        const tax = subtotal * 0.12; // 12% tax
        const total = subtotal + shipping + tax;

        // Update summary values
        document.getElementById('checkout-subtotal').textContent = `₱${subtotal.toFixed(2)}`;
        document.getElementById('checkout-shipping').textContent = shipping === 0 ? 'Free' : `₱${shipping.toFixed(2)}`;
        document.getElementById('checkout-tax').textContent = `₱${tax.toFixed(2)}`;
        document.getElementById('checkout-total').textContent = `₱${total.toFixed(2)}`;
      }
    });
  </script>
</body>

</html>