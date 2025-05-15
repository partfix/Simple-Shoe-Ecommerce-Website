<?php

// Initialize
$username = "";
$errors = [];
$success = false;

// login submit
if (isset($_POST["login"])) {
  $_SESSION["username"] = $_POST["username"];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $admin_pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($admin_user) || empty($admin_pass)) {
      $errors[] = "Please complete all required fields";
    } else {
      $link = "SELECT * FROM customer WHERE user_type = 'admin' AND name = '$admin_user'";
      $holder = mysqli_query($conn, $link);

      if ($holder && mysqli_num_rows($holder) > 0) {
        $usable = mysqli_fetch_assoc($holder);
        if (password_verify($admin_pass, $usable["password"])) {
          $_SESSION["username"] = $admin_user; //  username in session
          $_SESSION["password"] = $admin_pass;
          $success = true;
        } else {
          $errors[] = "Incorrect password";
        }
      } else {
        $errors[] = "Admin credentials not found. Please contact dev@partfix for authorization";
      }
    }
  }
}
