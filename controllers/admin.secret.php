<?php
ob_start();
require_once("../db/customer.db.php");
if (!isset($_SESSION["username"])) {
  echo '<script>window.location.href = "login.php";</script>';
  exit();
}
// Fetch admin data from database
$admin_user = $_SESSION["username"];
$query = "SELECT * FROM customer WHERE user_type = 'admin' AND name = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $admin_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
  $admin_data = mysqli_fetch_assoc($result);
} else {
  // Redirect if user data not found
  header("Location: logout.php");
  exit();
}

// Handle profile update
$profileUpdateMessage = "";
if (isset($_POST["update_profile"])) {
  $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
  $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);

  // Validate inputs
  $errors = [];
  if (empty($name)) $errors[] = "Name is required";
  if (empty($email)) $errors[] = "Email is required";
  if (empty($phone)) $errors[] = "Phone number is required";
  if (empty($address)) $errors[] = "Address is required";

  if (empty($errors)) {
    // Update profile in database
    $update_query = "UPDATE customer SET name = ?, email = ?, phone = ?, address = ? WHERE customer_ID = ?";
    $update_stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($update_stmt, "ssssi", $name, $email, $phone, $address, $admin_data['customer_ID']);

    if (mysqli_stmt_execute($update_stmt)) {
      // Update session variable
      $_SESSION["username"] = $name;
      $profileUpdateMessage = "<div class='bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4' role='alert'>Profile updated successfully!</div>";

      // Refresh admin data
      $admin_data['name'] = $name;
      $admin_data['email'] = $email;
      $admin_data['phone'] = $phone;
      $admin_data['address'] = $address;
    } else {
      $profileUpdateMessage = "<div class='bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4' role='alert'>Failed to update profile. Please try again.</div>";
    }
  } else {
    $profileUpdateMessage = "<div class='bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4' role='alert'>" . implode("<br>", $errors) . "</div>";
  }
}

// Handle password change
$passwordUpdateMessage = "";
if (isset($_POST["change_password"])) {
  $current_password = filter_input(INPUT_POST, "current_password", FILTER_SANITIZE_SPECIAL_CHARS);
  $new_password = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_SPECIAL_CHARS);
  $confirm_password = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS);

  // Validate inputs
  $errors = [];
  if (empty($current_password)) $errors[] = "Current password is required";
  if (empty($new_password)) $errors[] = "New password is required";
  if (empty($confirm_password)) $errors[] = "Confirm password is required";
  if ($new_password !== $confirm_password) $errors[] = "New passwords do not match";

  if (empty($errors)) {
    // Verify current password
    if (password_verify($current_password, $admin_data['password'])) {
      // Hash new password
      $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

      // Update password in database
      $update_query = "UPDATE customer SET password = ? WHERE customer_ID = ?";
      $update_stmt = mysqli_prepare($conn, $update_query);
      mysqli_stmt_bind_param($update_stmt, "si", $hashed_password, $admin_data['customer_ID']);

      if (mysqli_stmt_execute($update_stmt)) {
        $passwordUpdateMessage = "<div class='bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4' role='alert'>Password changed successfully!</div>";
      } else {
        $passwordUpdateMessage = "<div class='bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4' role='alert'>Failed to change password. Please try again.</div>";
      }
    } else {
      $passwordUpdateMessage = "<div class='bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4' role='alert'>Current password is incorrect</div>";
    }
  } else {
    $passwordUpdateMessage = "<div class='bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4' role='alert'>" . implode("<br>", $errors) . "</div>";
  }
}
