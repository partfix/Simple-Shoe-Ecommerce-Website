<?php
session_start();
require_once("../db/customer.db.php");
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



  <!-- Analytic expand -->
  <section id="analytics-dashboard">
    <div class="grid grid-cols-1 md:grid-cols-3 m-4 p-4">
      <div class="col-span-2">
        <?php require_once("../static/admin/expand.analytics.php") ?>
      </div>
    </div>
  </section>


  <!-- footer -->
  <?php require_once("../static/admin/admin.footer.php") ?>
  </div>

  <script src="/frontend/js/prop.js"></script>
</body>

</html>