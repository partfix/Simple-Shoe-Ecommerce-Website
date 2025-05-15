<!-- Container -->
<div class="container mx-auto px-4 py-12 ">
  <!-- header -->
  <div class="text-center mb-20">
    <h2 class="text-4xl font-bold text-gray-900 mb-4">Shop By Category</h2>
    <p class="text-gray-600 max-w-2xl mx-auto">
      Explore our curated collection of footwear designed for style and performance.
    </p>
  </div>
  <!-- grid sa card -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Sneakers Card -->
    <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group">
      <div class="h-64 overflow-hidden">
        <a href="/pages/shop/inside-cart.php#sneakers">
          <img
            src="../../asset/front.png"
            alt="Sneakers"
            class="w-full h-full object-contain " style="background-repeat: no-repeat; background-position: center;" />
        </a>
      </div>
      <div class="p-6 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">
          <a href="../inside-cart.php?category=sneakers" class="group-hover:text-yellow-800 transition-colors duration-300">Sneakers</a>
        </h3>
        <p class="text-gray-600 mb-4">
          <?php

          $query = "SELECT COUNT(*) as total FROM shoe WHERE category_id = 2";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          echo $row['total'] . " Products Available";
          ?>
        </p>
      </div>
    </div>
    <!-- Running Shoes Card -->
    <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group">
      <div class="h-64 overflow-hidden">
        <a href="/pages/shop/inside-cart.php#running-shoes">
          <img
            src="../../asset/bk-file.png"
            alt="Running-Shoe"
            class="w-full h-full object-contain inset-1 " style="background-repeat: no-repeat; background-position: center;" />
        </a>
      </div>
      <div class="p-6 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">
          <a href="/pages/shop/inside-cart.php#running-shoes" class="group-hover:text-yellow-700 transition-colors duration-300">Running Shoes</a>
        </h3>
        <p class="text-gray-600 mb-4">
          <?php
          $query = "SELECT COUNT(*) as total FROM shoe WHERE category_id = 1";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          echo $row['total'] . " Products Available";
          ?>
        </p>
      </div>
    </div>
  </div>
  <div class="mt-10 text-center">
    <a href="../shop/inside-cart.php" class="inline-block bg-blue-600 text-white py-3 px-8 rounded-md hover:bg-blue-700 transition-colors duration-300">Explore All Footwear</a>
  </div>
</div>