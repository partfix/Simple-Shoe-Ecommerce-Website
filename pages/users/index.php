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
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SoleStyle-home</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Heroicons-->
  <script src="https://unpkg.com/@heroicons/react@2.0.18/dist/heroicons.min.js"></script>
  <link rel="stylesheet" href="../frontend/css/style.css">
</head>

<body class="bg-gray-100 font-sans">
  <!-- Nav -->

  <!-- Banner -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-5">
    <?php require_once("../../static/users/user.direct-offer.php") ?>
  </section>

  <!--  Carousel product card -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php require_once("../../static/users/user-card.product.php") ?>
  </section>

  <!--hero section--->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php require_once("../../static/users/user.hero.php") ?>
  </section>

  <!-- products category--->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <?php require_once("../../static/users/user.category.php") ?>
  </section>

  <!--promise card-->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
    <?php require_once("../../static/users/user.promise.php") ?>
  </section>

  <!-- footer parent container -->
  <footer class="bg-white pt-10 pb-8 border-t border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto">

        <!-- footer grid content -->
        <?php require_once("../../static/users/user.footer.content.php") ?>

        <!-- copyright -->
        <div class="mt-8 text-center text-gray-600">
          <?php require_once("../../static/users/user.footer.php") ?>
        </div>
      </div>
    </div>

  </footer>

  <script src="/frontend/js/index.js"></script>
  <script src="../../frontend/js/cart.components.js"></script>
  <script src="../../frontend/js/cart.added.js"></script>
</body>


</html>