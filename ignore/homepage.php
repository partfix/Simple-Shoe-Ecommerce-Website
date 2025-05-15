<?php
session_start();
include("../db/customer.db.php");
require_once "../static/homepage.header.php";


if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: //shoe-apparel.org/log/user/login.user.php"); //in xammp local
  exit();
}
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="">
</head>

<body>
  <!-- <?php
        if (isset($_SESSION['username'])) {
          echo "Hello," . htmlspecialchars($_SESSION['username']) . "!";
        }
        ?> -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 m-2">
    <!-- Product Card -->
    <div class="flex flex-col rounded-lg border border-gray-200 bg-white shadow-md overflow-hidden">
      <a class="relative flex h-60 w-full overflow-hidden rounded-t-lg" href="#">
        <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=500&q=60" alt="product image" />
        <span class="absolute top-2 left-2 bg-black text-white text-xs font-medium px-2 py-1 rounded">39% OFF</span>
      </a>
      <div class="p-4">
        <a href="#">
          <h5 class="text-lg font-semibold text-gray-900">Nike Air MX Super 2500 - Red</h5>
        </a>
        <div class="mt-2 flex justify-between items-center">
          <p class="text-2xl font-bold text-gray-900">$449 <span class="text-sm text-gray-500 line-through">$699</span></p>
        </div>
        <a href="#" class="mt-4 block w-full text-center rounded-md bg-gray-900 px-4 py-2 text-white hover:bg-gray-700">
          Add to cart
        </a>
      </div>
    </div>

    <!-- Duplicate this card for additional products -->
    <div class="flex flex-col rounded-lg border border-gray-200 bg-white shadow-md overflow-hidden ">
      <a class="relative flex h-60 w-full overflow-hidden rounded-t-lg" href="#">
        <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=500&q=60" alt="product image" />
        <span class="absolute top-2 left-2 bg-black text-white text-xs font-medium px-2 py-1 rounded">39% OFF</span>
      </a>
      <div class="p-4">
        <a href="#">
          <h5 class="text-lg font-semibold text-gray-900">Nike Air MX Super 2500 - Red</h5>
        </a>
        <div class="mt-2 flex justify-between items-center">
          <p class="text-2xl font-bold text-gray-900">$449 <span class="text-sm text-gray-500 line-through">$699</span></p>
        </div>
        <a href="#" class="mt-4 block w-full text-center rounded-md bg-gray-900 px-4 py-2 text-white hover:bg-gray-700">
          Add to cart
        </a>
      </div>
    </div>

    <!-- Add more product cards here -->

  </div>
</body>

</html>