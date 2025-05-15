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
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];

  $query = "SELECT name, email, address, phone FROM customer WHERE name = '$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $customer = mysqli_fetch_assoc($result);
  } else {
    echo "Customer not found.";
  }
}

function maskEmail($email)
{
  $parts = explode("@", $email);
  if (count($parts) === 2) {
    $name = $parts[0];
    $gmail = $parts[1];

    // Mask the name part
    $maskedName = substr($name, 0, 1) . '*****' . substr($name, -1);

    return $maskedName . '@' . $gmail;
  }
  return "sayup mani";
}
ob_end_flush();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Profile</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-5">
    <div class="bg-white overflow-hidden shadow rounded-lg border">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-xl leading-6 font-medium text-gray-900">
          User Information
        </h3>
        <p class="mt-1 max-w-2xl text-xs text-red-600 ">
          Note: Don't share your Information
        </p>
      </div>
      <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
          <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Full name</dt>
            <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
              <?php echo htmlspecialchars($customer["name"] ?? 'None'); ?>
            </dd>
          </div>
          <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Email address</dt>
            <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
              <?php echo htmlspecialchars(maskEmail($customer["email"] ?? 'None')); ?>
            </dd>
          </div>
          <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Phone number</dt>
            <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
              <?php echo htmlspecialchars($customer["phone"] ?? 'None'); ?>
            </dd>
          </div>
          <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Address</dt>
            <dd class="mt-1 text-sm text-gray-600 sm:mt-0 sm:col-span-2">
              <?php echo htmlspecialchars($customer["address"] ?? 'None'); ?>
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </section>

  <script src="/frontend/js/index.js" async defer></script>
</body>

</html>