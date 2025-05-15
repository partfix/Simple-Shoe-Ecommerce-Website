<?php
session_start();
include("../db/customer.db.php");
require_once("../static/about.header.php");

if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: //shoe-apparel.org/log/user/login.user.php");
  exit();
}
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="">
</head>

<body>
  <?php
  if (isset($_SESSION['username'])) {
    echo  "hello<br>" . "session_name: " . htmlspecialchars($_SESSION["username"]);
    if (isset($_SESSION) && session_id()) {
      echo " <br>and you are still in the same session ";
    } else {
      echo "something went wrong";
    }
  }
  ?>
</body>

</html>