<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SoleStyle</title>
  <meta name="description" content="SoleStyle - Your premium shoe store">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../frontend/css/style.css">
</head>

<body>
  <nav id="main-nav" class="bg-opacity-50 backdrop-blur-md sticky top-0 z-50 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-4">
      <div class="flex items-center">
        <span class="text-xl font-bold text-gray-900"><a href="../../pages/users/index.php">SoleStyle</a></span>
      </div>

      <div class="md:hidden">
        <button id="menu-btn" class="text-gray-600 hover:text-gray-900 focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
      </div>

      <div id="nav-links" class="hidden md:flex md:space-x-3 absolute top-full left-0 w-full bg-transparent shadow-md md:static md:shadow-none md:w-auto">
        <a href="../../pages/users/index.php" class="block py-2 px-3 text-gray-600 hover:text-gray-900 bg-transparent">Home</a>
        <a href="/pages/shop/inside-cart.php" class="block py-2 px-3 text-gray-600 hover:text-gray-900">Shop</a>

        <div class="relative group">
          <a href="#" class="block py-2 px-3 text-gray-600 hover:text-gray-900 flex items-center gap-1">
            Products
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7"></path>
            </svg>
          </a>
          <div class="absolute opacity-0 invisible group-hover:opacity-100 group-hover:visible bg-white shadow-lg rounded-md top-full z-10 w-40 transition-all duration-300">
            <a href="/pages/shop/inside-cart.php#running-shoe" class="block px-4 py-2 text-gray-600 hover:bg-red-500 hover:text-white transition-all duration-300">Running Shoe</a>
            <a href="/pages/shop/inside-cart.php#sneakers" class="block px-4 py-2 text-gray-600 hover:bg-red-500 hover:text-white transition-all duration-300">Sneakers</a>
            <a href="/pages/shop/inside-cart.php#new-arrival" class="block px-4 py-2 text-gray-600 hover:bg-red-500 hover:text-white transition-all duration-300">New Arrival</a>
          </div>
        </div>
        <a href="../../pages/users/checkout.php" class="block py-2 px-3 text-gray-600 hover:text-gray-900 flex items-center gap-2">
          Checkout
        </a>
        <a href="https://www.linkedin.com/in/rencee/" target="_blank" class="block py-2 px-3 text-gray-600 hover:text-gray-900 flex items-center gap-2">
          <img src="/asset/philippines.png" alt="Philippine Flag" class="w-5 h-5">
          Contact
        </a>
      </div>

      <div class="hidden md:flex items-center space-x-3">
        <div class="gap-3">
          <?php echo "Hello, " . $_SESSION["username"] . "!"; ?>
        </div>

        <div class="relative group">
          <a href="#" class="text-gray-600 hover:text-gray-900">
            <img src="/asset/user.png" alt="User Icon" class="w-6 h-6">
          </a>
          <div class="absolute opacity-0 invisible group-hover:opacity-100 group-hover:visible bg-white shadow-lg rounded-md mt-1 z-10 w-40 transition-all duration-300">
            <a href="/pages/profile/user.profile.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">View Profile</a>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="showLogoutPopup(event)">
              <button type="submit" name="logout"
                class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100">Logout</button>
            </form>
          </div>
        </div>

        <!-- Cart Button with relative positioning for badge -->
        <a href="#" id="cart-button" class="text-gray-600 hover:text-gray-900 relative flex items-center gap-1 transition-transform duration-200 hover:scale-110">
          <img src="/asset/add-to-basket.png" alt="Cart Icon" class="w-6 h-6">
          <!-- Cart Badge will be added dynamically by JS -->
        </a>
      </div>
    </div>
  </nav>


  <!-- Cart Sidebar Overlay -->
  <div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300"></div>

  <!-- Cart Sidebar -->
  <div id="cart-sidebar" class="fixed top-0 right-0 h-screen w-80 md:w-96 bg-white shadow-lg z-50 transform translate-x-full transition-transform duration-300 ease-out flex flex-col">
    <!-- Cart Header -->
    <div class="p-4 border-b flex justify-between items-center bg-gray-50">
      <h2 class="text-xl font-semibold text-gray-800">Your Cart</h2>
      <button id="close-cart" class="text-gray-500 hover:text-red-500 p-1 rounded-full hover:bg-gray-100 transition-all duration-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Cart Items Container -->
    <div class="flex-grow overflow-y-auto p-4">
      <!-- Cart items will be dynamically added here -->
      <div id="cart-items-container" class="space-y-4">
        <!-- Empty cart state -->
        <div id="empty-cart" class="py-8 text-center">
          <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          <p class="mt-4 text-gray-500">Your cart is empty</p>
          <a href="/pages/shop/inside-cart.php" class="mt-4 text-red-500 hover:text-red-600 font-medium transition-colors duration-200 hover:underline">
            Continue Shopping
          </a>
        </div>
      </div>
    </div>

    <!-- Cart Footer with Checkout Button -->
    <div class="border-t p-4 bg-gray-50">
      <div class="flex justify-between mb-2">
        <span class="font-medium text-gray-600">Subtotal:</span>
        <span class="font-bold text-gray-800" id="cart-subtotal">₱0.00</span>
      </div>
      <div class="flex justify-between mb-4">
        <span class="font-medium text-gray-600">Shipping:</span>
        <span class="font-medium text-gray-800" id="cart-shipping">Free</span>
      </div>
      <a href="../../pages/users/checkout.php" id="checkout-button" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-md font-medium transition-all duration-300 flex items-center justify-center hover:shadow-md transform hover:-translate-y-1">
        Proceed to Checkout
      </a>
      <a href="/pages/shop/inside-cart.php" id="continue-shopping" class="w-full mt-3 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 py-2 rounded-md font-medium transition-all duration-300 flex items-center justify-center">
        Continue Shopping
      </a>
    </div>
  </div>

  <!-- Custom Cart Notification (will be created by JS when needed) -->

  <script src="../../frontend/js/cart.components.js" defer></script>
  <script src="../../frontend/js/cart.added.js"></script>
</body>

</html>