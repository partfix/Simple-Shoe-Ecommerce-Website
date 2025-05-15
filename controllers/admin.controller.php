<?php
ob_start();
function logActivity($action, $details)
{
  global $conn;
  $admin = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';
  $insert_log = "INSERT INTO activity_log (admin_name, action, details, created_at) VALUES ('$admin', '$action', '$details', NOW())";
  mysqli_query($conn, $insert_log);
}

if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: //shoe-apparel.org/log/user/login.user.php");
  exit();
}

// Add User
if (isset($_POST['add_user'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $user_type = isset($_POST['user_type']) ? mysqli_real_escape_string($conn, $_POST['user_type']) : 'customer';

  // Validate passwords match
  if ($password !== $confirm_password) {
    $error_message = "Passwords do not match!";
  } else {
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert_query = "INSERT INTO customer (name, email, phone, address, password, user_type) 
                    VALUES ('$username', '$email', '$phone', '$address', '$hashed_password', '$user_type')";

    if (mysqli_query($conn, $insert_query)) {
      logActivity("Create User", "Added new user: $username");
      $_SESSION['success_message'] = "User created successfully!";
      $_SESSION['message_type'] = "success";
    } else {
      $error_message = "Error: " . mysqli_error($conn);
    }
  }
}

// Delete User - MODIFIED FOR RELIABILITY
if (isset($_GET['delete'])) {
  $id = mysqli_real_escape_string($conn, $_GET['delete']);

  // Get user name before deletion for activity log
  $user_query = "SELECT name FROM customer WHERE customer_ID = '$id'";
  $user_result = mysqli_query($conn, $user_query);

  if ($user_result && mysqli_num_rows($user_result) > 0) {
    $user_data = mysqli_fetch_assoc($user_result);
    $user_name = $user_data['name'];

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
      // First delete all related orders
      $delete_orders = "DELETE FROM `order` WHERE customer_ID = '$id'";
      mysqli_query($conn, $delete_orders);

      // Then delete the customer
      $delete_query = "DELETE FROM customer WHERE customer_ID = '$id'";
      mysqli_query($conn, $delete_query);

      // If we got here, commit the changes
      mysqli_commit($conn);

      logActivity("Delete User", "Deleted user: $user_name (ID: $id) and all related orders");
      $_SESSION['success_message'] = "User deleted successfully!";
      $_SESSION['message_type'] = "success";
    } catch (mysqli_sql_exception $exception) {
      // An error occurred, rollback the transaction
      mysqli_rollback($conn);

      $_SESSION['success_message'] = "Error deleting user: " . $exception->getMessage();
      $_SESSION['message_type'] = "error";
    }
  } else {
    $_SESSION['success_message'] = "User not found!";
    $_SESSION['message_type'] = "error";
  }

  // Store the redirect URL in a session variable instead of using header()
  $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
  echo "<script>window.location = '" . $_SERVER['PHP_SELF'] . "';</script>";
  exit();
}

// Edit User - Get user data for editing
$edit_user = null;
if (isset($_GET['edit'])) {
  $id = mysqli_real_escape_string($conn, $_GET['edit']);
  $edit_query = "SELECT * FROM customer WHERE customer_ID = '$id'";
  $edit_result = mysqli_query($conn, $edit_query);

  if (mysqli_num_rows($edit_result) > 0) {
    $edit_user = mysqli_fetch_assoc($edit_result);
  }
}

// Update User
if (isset($_POST['update_user'])) {
  $id = mysqli_real_escape_string($conn, $_POST['user_id']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $user_type = isset($_POST['user_type']) ? mysqli_real_escape_string($conn, $_POST['user_type']) : 'customer';

  // Check if password needs to be updated
  if (!empty($password) && !empty($confirm_password)) {
    if ($password !== $confirm_password) {
      $error_message = "Passwords do not match!";
    } else {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $update_query = "UPDATE customer SET name='$username', email='$email', phone='$phone', address='$address', password='$hashed_password', user_type='$user_type' WHERE customer_ID='$id'";
    }
  } else {
    $update_query = "UPDATE customer SET name='$username', email='$email', phone='$phone', address='$address', user_type='$user_type' WHERE customer_ID='$id'";
  }

  if (isset($update_query) && mysqli_query($conn, $update_query)) {
    logActivity("Update User", "Updated user: $username (ID: $id)");
    $_SESSION['success_message'] = "User updated successfully!";
    $_SESSION['message_type'] = "success";
  } else if (!isset($error_message)) {
    $error_message = "Error: " . mysqli_error($conn);
  }
}

// Count users for KPI
$user_sql = "SELECT COUNT(*) as total_users FROM customer";
$user_result = mysqli_query($conn, $user_sql);
$user_count = mysqli_fetch_assoc($user_result)['total_users'];

// Get monthly user registrations data
// For now, we'll use dummy data
$monthly_data = [
  'Jan' => 0,
  'Feb' => 5,
  'Mar' => 15,
  'Apr' => 25,
  'May' => 30,
  'Jun' => 28,
  'Jul' => 30,
  'Aug' => 32,
  'Sep' => 35,
  'Oct' => 40,
  'Nov' => 60,
  'Dec' => 80
];
// Handle session messages
$success_message = null;
$message_type = null;

if (isset($_SESSION['success_message'])) {
  $success_message = $_SESSION['success_message'];
  $message_type = $_SESSION['message_type'];
  unset($_SESSION['success_message']);
  unset($_SESSION['message_type']);
}

// Process delete 
if (isset($_POST['delete_activity']) && isset($_POST['activity_id'])) {
  $activity_id = $_POST['activity_id'];
  // Convert to integer for safety
  $activity_id = (int)$activity_id;

  // Delete act
  $delete_query = "DELETE FROM activity_log WHERE id = $activity_id";
  if (mysqli_query($conn, $delete_query)) {
  } else {
  }
}
ob_end_flush();
