<?php
session_start();
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

  <!-- User Management  -->
  <div class="w-mx-5 bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden p-6 m-5">
    <?php require_once("../static/admin/add-user.php") ?>

    <!--mssg-->
    <?php require_once("../static/admin/message.use-case.php") ?>

    <!-- field -->
    <div id="addUserForm" class="mx-5 mt-5 bg-gray-50 rounded-md border border-gray-200 p-4 <?php echo (!isset($edit_user) && !isset($_POST['add_user'])) ? 'hidden' : ''; ?>">
      <?php require_once("../static/admin/admin.form.php") ?>
    </div>

    <!-- List -->
    <?php require_once("../static/admin/admin.user-list.php"); ?>
  </div>


  <script src="/frontend/js/prop.js"></script>
</body>

</html>