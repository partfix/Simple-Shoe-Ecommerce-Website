<?php
ob_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
  $_SESSION["username"] = $_POST["username"];

  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

  if (empty($username) || empty($password)) {
    echo '<script>
      document.addEventListener("DOMContentLoaded", function() {
        showToast("Please fill in all fields.", "error");
      });
    </script>';
  } else {
    $sql = "SELECT * FROM customer WHERE name = '$username' AND user_type = 'customer'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $holder = mysqli_fetch_assoc($result);

      if (password_verify($password, $holder["password"])) {
        $_SESSION["username"] = $username;
        header("Location: ../../pages/users/index.php");
        exit();
      } else {
        echo '<script>
          document.addEventListener("DOMContentLoaded", function() {
            showToast("Invalid password.", "error");
          });
        </script>';
      }
    } else {
      echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
          showToast("User not found. Please register first.", "error");
        });
      </script>';
    }
  }
}
mysqli_close($conn);
