<body class="bg-white text-gray-800">
  <!-- Modal Background Overlay -->
  <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden flex items-center justify-center">
    <!-- Edit Product Modal -->
    <div id="editModal" class="bg-white rounded-lg shadow-lg max-w-lg w-full mx-4 z-50">
      <div class="border-b px-4 py-3 flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-800">Edit Product</h3>
        <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form id="editProductForm" method="POST" action="" class="p-4">
        <input type="hidden" name="update_product" value="1">
        <input type="hidden" id="edit_shoe_id" name="shoe_id" value="">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
            <input type="text" id="edit_name" name="name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-500">
          </div>

          <div>
            <label for="edit_price" class="block text-sm font-medium text-gray-700 mb-1">Price (₱)</label>
            <input type="number" id="edit_price" name="price" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-500">
          </div>

          <div>
            <label for="edit_brand" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
            <select id="edit_brand" name="brand_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-500">
              <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['brand_ID'] ?>"><?= htmlspecialchars($brand['Brand_Name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <label for="edit_category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select id="edit_category" name="category_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-500">
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['category_ID'] ?>"><?= htmlspecialchars($category['Category_Name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <label for="edit_color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
            <input type="text" id="edit_color" name="color" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-500">
          </div>

          <div>
            <label for="edit_size" class="block text-sm font-medium text-gray-700 mb-1">Size</label>
            <input type="text" id="edit_size" name="size" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-500">
          </div>

          <div>
            <label for="edit_stock" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
            <input type="number" id="edit_stock" name="stock_quantity" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-500">
          </div>

          <div>
            <label for="edit_picture" class="block text-sm font-medium text-gray-700 mb-1">Picture Path</label>
            <input type="text" id="edit_picture" name="picture_path" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-green-500">
          </div>
        </div>

        <div class="flex justify-end gap-2 border-t pt-4">
          <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <div class="max-w-screen-xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-light mb-6 flex items-center">
      Product List
    </h1>

    <!-- Search Bar -->
    <div class="mb-4">
      <form method="GET" action="" class="flex">
        <div class="relative flex-grow">
          <input type="text" name="search"
            value="<?= htmlspecialchars($search_term ?? '') ?>"
            placeholder="Search products by name, brand, category, color..."
            class="w-full border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-1 focus:ring-green-500">
          <input type="hidden" name="brand" value="<?= htmlspecialchars($brand_filter) ?>">
          <input type="hidden" name="category" value="<?= htmlspecialchars($category_filter) ?>">
          <input type="hidden" name="color" value="<?= htmlspecialchars($color_filter) ?>">
          <input type="hidden" name="min_price" value="<?= htmlspecialchars($min_price) ?>">
          <input type="hidden" name="max_price" value="<?= htmlspecialchars($max_price) ?>">
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-r-md hover:bg-green-600 flex items-center">
          <i class="fas fa-search mr-2"></i> Search
        </button>
      </form>
    </div>

    <!-- Filter Section -->
    <div class="mb-6">
      <button id="filterToggle" class="flex items-center text-sm text-gray-500 hover:text-gray-700 mb-2">
        <i class="fas fa-filter mr-1"></i> Filters
        <i class="fas fa-chevron-up ml-1 text-xs"></i>
      </button>

      <div id="filterPanel" class="bg-gray-50 p-4 rounded grid grid-cols-2 md:grid-cols-5 gap-3 text-sm">
        <form method="GET" action="" class="contents">
          <input type="hidden" name="search" value="<?= htmlspecialchars($search_term) ?>">

          <div>
            <select name="brand" class="w-full border-0 bg-white rounded shadow-sm py-1 px-2 focus:ring-0 focus:outline-none">
              <option value="">Brand: All</option>
              <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['brand_ID'] ?>" <?= $brand_filter == $brand['brand_ID'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($brand['Brand_Name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <select name="category" class="w-full border-0 bg-white rounded shadow-sm py-1 px-2 focus:ring-0 focus:outline-none">
              <option value="">Category: All</option>
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['category_ID'] ?>" <?= $category_filter == $category['category_ID'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($category['Category_Name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <select name="color" class="w-full border-0 bg-white rounded shadow-sm py-1 px-2 focus:ring-0 focus:outline-none">
              <option value="">Color: All</option>
              <?php foreach ($colors as $color): ?>
                <option value="<?= $color ?>" <?= $color_filter == $color ? 'selected' : '' ?>><?= htmlspecialchars($color) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="flex space-x-1">
            <input type="number" name="min_price" value="<?= htmlspecialchars($min_price) ?>" placeholder="₱Min" class="w-full border-0 bg-white rounded shadow-sm py-1 px-2 focus:ring-0 focus:outline-none">
            <input type="number" name="max_price" value="<?= htmlspecialchars($max_price) ?>" placeholder="₱Max" class="w-full border-0 bg-white rounded shadow-sm py-1 px-2 focus:ring-0 focus:outline-none">
          </div>

          <div class="flex items-center space-x-2">
            <button type="submit" class="bg-green-500 text-white text-xs py-1 px-3 rounded hover:bg-green-600">Apply</button>
            <a href="?" class="text-xs text-gray-500 hover:text-gray-700">Clear</a>
          </div>
        </form>
      </div>
    </div>

    <!-- result search kung mana -->
    <?php if (!empty($search_term)): ?>
      <div class="mb-4 flex items-center justify-between bg-gray-50 p-3 rounded">
        <div>
          <span class="text-sm">Showing results for: <strong>"<?= htmlspecialchars($search_term) ?>"</strong></span>
          <?php if (isset($result) && $result): ?>
            <span class="text-xs text-gray-500 ml-2 font-bold">(<?= $result->num_rows ?> results)</span>
          <?php endif; ?>
        </div>
        <a href="?<?= !empty($brand_filter) ? 'brand=' . urlencode($brand_filter) . '&' : '' ?><?= !empty($category_filter) ? 'category=' . urlencode($category_filter) . '&' : '' ?><?= !empty($color_filter) ? 'color=' . urlencode($color_filter) . '&' : '' ?><?= !empty($min_price) ? 'min_price=' . urlencode($min_price) . '&' : '' ?><?= !empty($max_price) ? 'max_price=' . urlencode($max_price) : '' ?>"
          class="text-xs text-blue-500 hover:text-blue-700">
          <i class="fas fa-times-circle mr-1"></i> Clear search
        </a>
      </div>
    <?php endif; ?>

    <!-- Products Grid -->
    <?php if (isset($result) && $result && $result->num_rows > 0): ?>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="group bg-white hover:shadow-md transition duration-200">
            <div class="relative overflow-hidden h-50">
              <?php if (!empty($row['picture_path'])): ?>
                <div class="w-full h-48 bg-gray-100 flex items-center justify-center overflow-hidden p-2">
                  <img src="<?= htmlspecialchars($row['picture_path']) ?>" alt="<?= htmlspecialchars($row['Name']) ?>" class="w-full h-full object-cover px-5">
                </div>
              <?php else: ?>
                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                  <i class="fas fa-shoe-prints text-gray-300 text-2xl"></i>
                </div>
              <?php endif; ?>
            </div>

            <div class="p-2">
              <div class="flex justify-between items-start">
                <h3 class="text-sm font-medium truncate"><?= htmlspecialchars($row['Name']) ?></h3>
                <span class="text-sm font-bold text-gray-900"><?= $row['Price'] ? '₱' . number_format($row['Price'], 0) : '' ?></span>
              </div>

              <div class="flex justify-between text-xs text-gray-500 mt-1">
                <span><?= htmlspecialchars($row['brand_name'] ?? '') ?></span>
                <span class="inline-flex items-center">stock
                  <span class="ml-1 <?php
                                    if ($row['Stock_Quantity'] <= 0) {
                                      echo 'bg-red-100 text-red-800';
                                    } elseif ($row['Stock_Quantity'] < 10) {
                                      echo 'bg-red-100 text-red-800';
                                    } else {
                                      echo 'bg-green-100 text-green-800';
                                    }
                                    ?> px-1.5 py-0.5 rounded-sm text-xs">
                    <?= $row['Stock_Quantity'] > 0 ? $row['Stock_Quantity'] : 'Out' ?>
                  </span>
                </span>
              </div>

              <div class="flex flex-wrap gap-1 mt-2">
                <span class="inline-block bg-gray-100 text-gray-600 px-1.5 rounded-sm text-xs"><?= htmlspecialchars($row['Color']) ?></span>
                <span class="inline-block bg-gray-100 text-gray-600 px-1.5 rounded-sm text-xs">Size <?= htmlspecialchars($row['Size']) ?></span>
              </div>

              <div class="mt-2 flex justify-end gap-1">
                <!-- edit btn-->
                <button type="button" onclick="openEditModal(<?= $row['shoe_ID'] ?>, '<?= addslashes($row['Name']) ?>', <?= $row['Price'] ?>, <?= $row['brand_ID'] ?>, <?= $row['category_ID'] ?>, '<?= addslashes($row['Color']) ?>', '<?= addslashes($row['Size']) ?>', <?= $row['Stock_Quantity'] ?>, '<?= addslashes($row['picture_path']) ?>')" class="text-xs bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded inline-flex items-center">
                  <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                  </svg>
                  Edit
                </button>

                <!-- remove btn -->
                <form method="POST" action="" class="inline-block" onsubmit="return confirm('Are you sure you want to remove this product?');">
                  <input type="hidden" name="remove_product" value="1">
                  <input type="hidden" name="shoe_id" value="<?= $row['shoe_ID'] ?>">
                  <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['Name']) ?>">
                  <button type="submit" class="text-xs bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded inline-flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Remove
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="p-8 text-center">
        <p class="text-gray-400">No products found matching your criteria.</p>
      </div>
    <?php endif; ?>
  </div>

  <!-- Toast notification -->
  <?php if (isset($_SESSION['product_message'])): ?>
    <div id="notification" class="fixed top-4 right-4 mb-4 px-4 py-3 rounded-lg shadow-lg max-w-md transform transition-all duration-300 ease-in-out z-50 flex items-center justify-between <?= $_SESSION['product_message_type'] == 'success' ? 'bg-white border-l-4 border-green-500' : 'bg-white border-l-4 border-red-500' ?>">
      <div class="flex items-center">
        <?php if ($_SESSION['product_message_type'] == 'success'): ?>
          <div class="mr-5">
            <i class="fas fa-check text-green-500"></i>
          </div>
          <div>
            <h3 class="font-semibold text-gray-800">Success</h3>
            <p class="text-sm text-gray-600"><?= $_SESSION['product_message'] ?></p>
          </div>
        <?php else: ?>
          <div class="bg-red-100 p-2 rounded-full mr-3">
            <i class="fas fa-exclamation text-red-500"></i>
          </div>
          <div>
            <h3 class="font-semibold text-gray-800">Error</h3>
            <p class="text-sm text-gray-600"><?= $_SESSION['product_message'] ?></p>
          </div>
        <?php endif; ?>
      </div>
      <button onclick="closeNotification()" class="ml-4 text-gray-400 hover:text-gray-700 transition-colors">
        <i class="fas fa-times"></i>
      </button>
    </div>
  <?php endif; ?>

  <script src="/frontend/js/product-list.js" defer></script>