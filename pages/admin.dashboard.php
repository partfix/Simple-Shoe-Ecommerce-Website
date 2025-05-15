<?php session_start();
require("../db/customer.db.php");
require_once("../static/admin/admin.header.php");
require_once("../controllers/admin.controller.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/frontend/css/pop.css">
</head>

<body>
  <!-- Main Content Container -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <?php require_once("../static/admin/greet.php") ?><!-- Main Content Container -->
  </div>

  <!-- Cards -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
    <?php require_once("../static/admin/cards.php") ?>
  </div>

  <!-- Activity and Orders Section -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">
    <!-- Recent Activity Panel-->
    <div>
      <?php require_once("../static/admin/activities.php") ?>

      <!-- Developer Contact Panel -->

      <div>
        <?php require_once("../static/admin/developer.contact.php") ?>
      </div>
    </div>
    <!-- Active Orders Panel -->
    <div class="lg:col-span-2">
      <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <?php require_once("../static/admin/active.orders.php") ?>
      </div>

      <!-- Order Analytics Section -->
      <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mt-5">
        <?php require_once("../static/admin/order.analytics.php") ?>
      </div>
    </div>
  </div>

  <!-- User Management  -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-">
    <?php require_once("../static/admin/add-user.php") ?>
    <!--msg-->
    <?php require_once("../static/admin/message.use-case.php") ?>
    <!-- field -->
    <div id="addUserForm" class="mx-5 mt-5 bg-gray-50 rounded-md border border-gray-200 <?php echo (!isset($edit_user) && !isset($_POST['add_user'])) ? 'hidden' : ''; ?>">
      <?php require_once("../static/admin/admin.form.php") ?>
    </div>
    <?php require_once("../static/admin/admin.user-list.php"); ?>
  </div>


  <!-- footer -->
  <?php require_once("../static/admin/admin.footer.php") ?>
  <script src="/frontend/js/prop.js"></script>
</body>

</html>