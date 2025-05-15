<?php // initialize 
$username = $email = $phone = $address = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  $conf_pass = filter_input(INPUT_POST, "confirm-password", FILTER_SANITIZE_SPECIAL_CHARS);
  $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);
  $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);

  // validate inputs
  if (empty($username) || empty($password) || empty($email) || empty($phone) || empty($address)) {
    $errors[] = "Please complete all required fields";
  } else {
    // username validation 
    if (strlen($username) < 8 || preg_match('/[^a-zA-Z0-9]/', $username)) {
      $errors[] = "Username must be at least 8 characters with only letters and numbers";
    }

    // email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Please enter a valid email address";
    }

    // phone number validation
    if (!preg_match('/^\d{11}$/', $phone)) {
      $errors[] = "Phone number must be exactly 11 digits";
    }

    // password validation 
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
      $errors[] = "Password must contain at least one special character";
    }

    // address validation 
    if (!preg_match('/,.+/', $address)) {
      $errors[] = "Address format should be: Street, City";
    }

    // password 
    if ($password != $conf_pass) {
      $errors[] = "Passwords do not match";
    }
  }

  // if no errors, proceed with registration
  if (empty($errors)) {
    $get_Check = "SELECT * FROM customer WHERE name = '$username' OR email = '$email'";
    $queryResult = mysqli_query($conn, $get_Check);

    if (mysqli_num_rows($queryResult) > 0) {
      $errors[] = "Username or Email is already taken";
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO customer(name, email, phone, address, password, user_type)
              VALUES ('$username', '$email', '$phone', '$address', '$hash', 'customer')";

      if (mysqli_query($conn, $sql) > 0) {
        $success = true;
      } else {
        $errors[] = "Registration failed. Please try again";
      }
    }
  }
}
mysqli_close($conn);
