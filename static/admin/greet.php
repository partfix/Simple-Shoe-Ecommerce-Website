<!-- greet.php -->
<div class="mb-10">
  <div class="flex justify-between items-center">
    <div>
      <h1 class="text-4xl font-bold text-gray-900">
        <?php
        if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
          echo ucfirst(($_SESSION['username'])) . " Dashboard";
        }
        ?>
      </h1>
      <p class="text-lg text-gray-600 mt-2 opacity-65">Welcome to your admin dashboard</p>
    </div>
  </div>