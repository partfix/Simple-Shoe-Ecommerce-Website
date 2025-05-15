<!-- Header -->
<div class="text-center mb-10">
  <h2 class="text-3xl font-bold text-gray-900">You may also like</h2>
  <div class="w-24 h-1 bg-blue-600 mx-auto mt-2"></div>
  <p class="text-gray-600 mt-4">
    Discover a variety of stylish shoes handpicked just for you. Find your perfect pair from our latest collection!
  </p>
</div>

<!-- Main Carousel Container -->
<div id="carousel-container" class="relative">
  <div id="slide-1" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php

    $query = "SELECT s.*, b.brand_name, c.category_name 
      FROM shoe s
      LEFT JOIN brand b ON s.brand_id = b.brand_id
      LEFT JOIN category c ON s.category_id = c.category_id
      ORDER BY shoe_id DESC LIMIT 4";

    $result = mysqli_query($conn, $query);

    // Check if there are any products
    if (mysqli_num_rows($result) > 0) {
      $counter = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        $counter++;
        // Show "NEW" tag for the first 2 products (most recently added since they're ordered by DESC)
        $isNew = ($counter <= 2);
    ?>
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
          <!-- Product Image -->
          <div class="h-48 overflow-hidden relative">
            <?php if ($row['Stock_Quantity'] <= 5) { ?>
              <div class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded">
                Low Stock
              </div>
            <?php } ?>

            <?php if ($isNew) { ?>
              <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded">
                NEW
              </div>
            <?php } ?>

            <?php $image_path = "../uploads/products/" . basename($row['picture_path']); ?>
            <img
              src="<?php echo htmlspecialchars($image_path); ?>" alt="Product Image" class="w-full h-full object-cover">
          </div>

          <!-- Product Info -->
          <div class="p-4 flex-grow">
            <h3 class="text-lg font-semibold text-gray-900 mb-1">
              <?php echo $row['brand_name'] . ' ' . $row['Name']; ?>
            </h3>
            <p class="text-sm text-gray-600 mb-2">
              <?php echo $row['Size']; ?> | <?php echo $row['Color']; ?>
            </p>
            <div class="flex justify-between items-center mb-3">
              <span class="text-xl font-bold text-gray-900">
                ₱<?php echo number_format($row['Price'], 2); ?>
              </span>
              <span class="text-sm text-gray-600">
                <?php echo $row['Stock_Quantity']; ?> in stock
              </span>
            </div>
            <p class="text-sm text-gray-600 mb-4">
              <?php echo $row['category_name']; ?>
            </p>
          </div>

          <!-- Buy Button -->
          <div class="px-4 pb-4">
            <button
              class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition duration-300"
              onclick="addToCart(<?php echo $row['shoe_ID']; ?>)">
              Buy now
            </button>
          </div>
        </div>
      <?php
      }
    } else {
      ?>
      <div class="col-span-4 text-center py-8">
        <p class="text-gray-600">No products available at the moment.</p>
      </div>
    <?php
    }
    ?>
  </div>
</div>

<!-- Make sure both JS files are included -->
<script src="../../frontend/js/cart.components.js"></script>
<script src="../../frontend/js/cart.added.js"></script>