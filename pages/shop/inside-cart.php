<?php
ob_start();
session_start();
require_once("../../db/customer.db.php");
require_once("../../static/users/home-header.php");

if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: //shoe-apparel.org/log/user/login.user.php");
  exit();
}
ob_end_flush();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SoleStyle - Shop</title>
  <meta name="description" content="Find the perfect shoes for your style">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/frontend/css/style.css">
  <link rel="stylesheet" href="/frontend/css/cart.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
  <!-- Running Shoe Section -->
  <section id="running-shoe" class="py-12 px-4 sm:px-6 lg:px-8 mb-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-8">Running Shoes</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
      <?php
      // Strictly get running shoes only
      $query = "SELECT s.*, b.brand_name, c.category_name 
                FROM shoe s
                LEFT JOIN brand b ON s.brand_id = b.brand_id
                LEFT JOIN category c ON s.category_id = c.category_id
                WHERE c.category_name = 'Running Shoe'
                ORDER BY shoe_id DESC";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        $counter = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $counter++;
          $isNew = ($counter <= 2);
      ?>
          <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
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
              <?php $image_path = "../Uploads/products/" . basename($row['picture_path']); ?>
              <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Product Image" class="w-full h-full object-cover">
            </div>
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
          <p class="text-gray-600">No running shoes available at the moment.</p>
        </div>
      <?php
      }
      ?>
    </div>
  </section>

  <!-- Sneakers Section -->
  <section id="sneakers" class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-100 mb-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-8">Sneakers</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
      <?php
      // Strictly get sneakers only
      $query = "SELECT s.*, b.brand_name, c.category_name 
                FROM shoe s
                LEFT JOIN brand b ON s.brand_id = b.brand_id
                LEFT JOIN category c ON s.category_id = c.category_id
                WHERE c.category_name = 'Sneakers'
                ORDER BY shoe_id DESC";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        $counter = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $counter++;
          $isNew = ($counter <= 2);
      ?>
          <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
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
              <?php $image_path = "../Uploads/products/" . basename($row['picture_path']); ?>
              <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Product Image" class="w-full h-full object-cover">
            </div>
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
          <p class="text-gray-600">No sneakers available at the moment.</p>
        </div>
      <?php
      }
      ?>
    </div>
  </section>

  <!-- New Arrival Section -->
  <section id="new-arrival" class="py-12 px-4 sm:px-6 lg:px-8 mb-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-8">New Arrivals</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
      <?php
      // Get the newest shoes across all categories, limited to 8
      $query = "SELECT s.*, b.brand_name, c.category_name 
                FROM shoe s
                LEFT JOIN brand b ON s.brand_id = b.brand_id
                LEFT JOIN category c ON s.category_id = c.category_id
                ORDER BY s.shoe_id DESC
                LIMIT 8";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
          <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
            <div class="h-48 overflow-hidden relative">
              <?php if ($row['Stock_Quantity'] <= 5) { ?>
                <div class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded">
                  Low Stock
                </div>
              <?php } ?>
              <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded">
                NEW
              </div>
              <?php $image_path = "../Uploads/products/" . basename($row['picture_path']); ?>
              <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Product Image" class="w-full h-full object-cover">
            </div>
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
          <p class="text-gray-600">No new arrivals available at the moment.</p>
        </div>
      <?php
      }
      ?>
    </div>
  </section>

  <script src=""> </script>
</body>

</html>