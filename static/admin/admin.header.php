<?php
if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: //shoe-apparel.org/log/user/login.user.php");
  exit();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 flex">
  <div class="w-64 min-h-screen bg-white shadow-lg flex flex-col py-8 border-r border-gray-100">
    <div class="px-6 mb-10">
      <div class="flex items-center">
        <span class="text-xl font-semibold text-gray-800">SoleStyle</span>
      </div>
    </div>

    <div class="flex-1 px-4">
      <div class="space-y-2">
        <a href="admin.dashboard.php"
          class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 
           <?php echo ($current_page == 'admin.dashboard.php') ? 'bg-yellow-100 text-yellow-600 ' : 'text-gray-600 hover:bg-yellow-50 hover:text-yellow-500'; ?>">
          <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
            <i class="fas fa-home"></i>
          </div>
          <span>Home</span>
        </a>

        <a href="admin.orders.php"
          class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 
           <?php echo ($current_page == 'admin.orders.php') ? 'bg-yellow-100 text-yellow-600' : 'text-gray-600 hover:bg-gray-50 hover:text-yellow-500'; ?>">
          <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <span>Orders</span>
        </a>

        <a href="#" id="productDropdownToggle"
          class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200
      <?php echo ($current_page == 'admin.products.php') ? 'bg-yellow-100 text-yellow-600' : 'text-gray-700 hover:bg-yellow-50 hover:text-yellow-500'; ?>">
          <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
            <i class="fas fa-box"></i>
          </div>
          <span>Products</span>
          <!-- Dropdown Arrow -->
          <svg xmlns="http://www.w3.org/2000/svg" id="dropdownArrow" class="h-4 w-4 ml-2 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </a>
        <div id="productDropdownMenu" class="hidden w-full mt-1 rounded-lg overflow-hidden">
          <a href="../../pages/admin.add-product.php" class="block pl-11 py-2 text-sm text-gray-600 hover:text-yellow-500 border-l border-gray-200 hover:border-yellow-400 transition-colors duration-150 rounded-lg
          <?php echo ($current_page == 'admin.add-product.php') ? 'bg-yellow-100 text-yellow-600 border-yellow-400' : ''; ?>">
            Add Product
          </a>
          <a href="../../pages/admin.product-list.php" class="block pl-11 py-2 text-sm text-gray-600 hover:text-yellow-500 border-l border-gray-200 hover:border-yellow-400 transition-colors duration-150 rounded-lg
          <?php echo ($current_page == 'admin.product-list.php') ? 'bg-yellow-100 text-yellow-600 border-yellow-400' : ''; ?>">
            Product List
          </a>
        </div>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('productDropdownToggle');
            const dropdownMenu = document.getElementById('productDropdownMenu');
            const dropdownArrow = document.getElementById('dropdownArrow');
            const addProductLink = dropdownMenu.querySelector('a[href*="admin.add-product.php"]');
            const productListLink = dropdownMenu.querySelector('a[href*="admin.product-list.php"]');

            // Check if dropdown should be open based on URL or stored state
            function checkActiveState() {
              // Check if we're on a product-related page
              const currentPath = window.location.pathname;
              const isProductPage = currentPath.includes('admin.add-product.php') ||
                currentPath.includes('admin.product-list.php') ||
                currentPath.includes('admin.products.php');

              // Set active background for current page
              if (currentPath.includes('admin.add-product.php')) {
                addProductLink.classList.add('bg-yellow-100', 'text-yellow-600', 'border-yellow-400');
              } else if (currentPath.includes('admin.product-list.php')) {
                productListLink.classList.add('bg-yellow-100', 'text-yellow-600', 'border-yellow-400');
              }

              // Check localStorage for saved state
              const isDropdownOpen = localStorage.getItem('productDropdownOpen') === 'true';

              // If either condition is true, open the dropdown
              if (isProductPage || isDropdownOpen) {
                dropdownMenu.classList.remove('hidden');
                dropdownArrow.classList.add('rotate-180');
                dropdownToggle.classList.add('text-yellow-600');
              }
            }

            // Run on page load
            checkActiveState();

            // Toggle dropdown on click
            dropdownToggle.addEventListener('click', function(e) {
              e.preventDefault(); // Prevent default link behavior

              // Toggle visibility
              const isHidden = dropdownMenu.classList.contains('hidden');

              // Store state in localStorage
              localStorage.setItem('productDropdownOpen', isHidden);

              // Apply changes
              if (isHidden) {
                dropdownMenu.classList.remove('hidden');
                dropdownArrow.classList.add('rotate-180');
                dropdownToggle.classList.add('text-yellow-600');
              } else {
                dropdownMenu.classList.add('hidden');
                dropdownArrow.classList.remove('rotate-180');
                if (!dropdownToggle.classList.contains('bg-yellow-100')) {
                  dropdownToggle.classList.remove('text-yellow-600');
                }
              }
            });

            // Don't close dropdown when clicking on menu items
            dropdownMenu.addEventListener('click', function(e) {
              e.stopPropagation();
            });

            // I've removed the document event listener that was closing the dropdown
            // when clicking outside of it. This way, the dropdown will stay open
            // until the user explicitly clicks the toggle button again.
          });
        </script>

        <a href="admin.analytics.php"
          class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 
        <?php echo ($current_page == 'admin.analytics.php') ? 'bg-yellow-100 text-yellow-600' : 'text-gray-600 hover:bg-yellow-50 hover:text-yellow-500'; ?>">
          <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
            <i class="fas fa-chart-line"></i>
          </div>
          <span>Analytics</span>
        </a>

        <a href="../../pages/admin.customer.php"
          class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 
        <?php echo ($current_page == 'admin.customer.php') ? 'bg-yellow-100 text-yellow-600' : 'text-gray-600 hover:bg-yellow-50 hover:text-yellow-500'; ?>">
          <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
            <i class="fas fa-users"></i>
          </div>
          <span>Customers</span>
        </a>

        <a href="../../pages/admin.settings.php"
          class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 
        <?php echo ($current_page == 'admin.settings.php') ? 'bg-yellow-100 text-yellow-600' : 'text-gray-600 hover:bg-yellow-50 hover:text-yellow-500'; ?>">
          <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
            <i class="fas fa-cog"></i>
          </div>
          <span>Settings</span>
        </a>
      </div>
    </div>

    <div class="px-5 my-5">
      <div class="h-px bg-gray-200"></div>
    </div>

    <div class="px-4 mb-6">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <button type="submit" name="logout" class="w-full flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-red-50 hover:text-red-500 transition-colors duration-200">
          <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
            <i class="fas fa-sign-out-alt"></i>
          </div>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </div>

  <div class="flex-1">


</body>

</html>