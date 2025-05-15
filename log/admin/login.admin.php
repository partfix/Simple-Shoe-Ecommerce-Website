<?php
session_start();
require('../../db/customer.db.php');
require('../../controllers/admin.form.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Login | SoleStyle</title>
  <meta name="description" content="Admin portal for SoleStyle">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="/frontend/css/register.mod.css">
</head>

<body class="antialiased bg-gray-50 text-gray-900">
  <!-- Toast notifications -->
  <div id="toast-container" class="fixed right-0 top-0 max-w-sm p-4 z-50 w-full sm:w-auto"></div>

  <!-- Back to login link - with padding instead of absolute top positioning -->
  <div class="fixed top-0 left-0 p-6">
    <a href="../user/login.user.php" class="flex items-center text-sm font-medium text-gray-600 hover:text-gray-800">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
      </svg>
      Back to User Login
    </a>
  </div>

  <div class="min-h-screen flex justify-center items-center p-4">
    <!-- Content area -->
    <div class="w-full max-w-md">
      <!-- Card container -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Admin logo and title -->
        <div class="flex flex-col items-center p-6 bg-emerald-50 border-b border-emerald-100">
          <img src="../../asset/admin-logo.png" alt="Admin Logo" class="h-16 mb-4">
          <h1 class="text-2xl font-semibold text-gray-900">Admin Portal</h1>
          <p class="mt-2 text-sm text-gray-600">Access the SoleStyle Admin Group</p>
        </div>

        <!-- Form section -->
        <div class="p-6">
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="space-y-6">
            <!-- Username field -->
            <div>
              <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Admin Username</label>
              <input
                type="text"
                id="username"
                name="username"
                value="<?php echo $username; ?>"
                class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-2 focus:ring-emerald-100"
                placeholder="Enter your admin username"
                required />
            </div>

            <!-- Password field -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-2 focus:ring-emerald-100"
                placeholder="Enter your password"
                required />
            </div>

            <!-- Submit button -->
            <div>
              <button
                type="submit"
                name="login"
                value="login"
                class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-150">
                Log in to Dashboard
              </button>
            </div>
          </form>

          <!-- Admin information box -->
          <div class="mt-6 p-4 bg-emerald-50 border border-emerald-200 rounded-md">
            <h2 class="text-sm font-semibold text-emerald-700">Administrator Information</h2>
            <ul class="mt-2 text-sm text-emerald-700 space-y-1">
              <li class="flex items-start">
                <svg class="h-5 w-5 text-emerald-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Only authorized personnel may access this portal</span>
              </li>
              <li class="flex items-start">
                <svg class="h-5 w-5 text-emerald-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Admin credentials are provided by <a href="https://www.facebook.com/profile.php?id=100008272907321" class="text-emerald-700 hover:text-emerald-800 font-medium">dev@partfix</a></span>
              </li>
            </ul>
            <div class="mt-3 text-xs text-gray-500 text-center">
              <span class="bg-gray-100 px-2 py-1 rounded-md">Session ID: <?php echo session_id(); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Toast 
    function showToast(message, type = 'info') {
      const container = document.getElementById('toast-container');
      const id = 'toast-' + Date.now();

      let bgColor, iconPath;

      switch (type) {
        case 'success':
          bgColor = 'bg-emerald-50';
          iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
          iconColor = 'text-emerald-500';
          borderColor = 'border-emerald-400';
          textColor = 'text-emerald-800';
          break;
        case 'error':
          bgColor = 'bg-red-50';
          iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
          iconColor = 'text-red-500';
          borderColor = 'border-red-400';
          textColor = 'text-red-800';
          break;
        default:
          bgColor = 'bg-blue-50';
          iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
          iconColor = 'text-blue-500';
          borderColor = 'border-blue-400';
          textColor = 'text-blue-800';
      }

      const toast = document.createElement('div');
      toast.id = id;
      toast.classList.add('toast', 'mb-3', 'p-4', 'rounded-md', 'shadow-md', 'border-l-4', bgColor, borderColor, 'flex', 'items-start');

      toast.innerHTML = `
        <div class="flex-shrink-0 mr-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ${iconColor}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            ${iconPath}
          </svg>
        </div>
        <div class="flex-grow ${textColor} text-sm">
          ${message}
        </div>
        <div class="ml-auto pl-3 flex-shrink-0">
          <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="dismissToast('${id}')">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      `;

      container.appendChild(toast);

      // Show toast with animation
      setTimeout(() => {
        toast.classList.add('show');
      }, 10);

      // Auto dismiss after 5 seconds
      setTimeout(() => {
        dismissToast(id);
      }, 5000);
    }

    function dismissToast(id) {
      const toast = document.getElementById(id);
      if (toast) {
        toast.classList.remove('show');
        setTimeout(() => {
          if (toast.parentNode) {
            toast.parentNode.removeChild(toast);
          }
        }, 400);
      }
    }

    <?php if (!empty($errors)): ?>
      document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($errors as $error): ?>
          showToast('<?php echo $error; ?>', 'error');
        <?php endforeach; ?>
      });
    <?php endif; ?>

    <?php if ($success): ?>
      document.addEventListener('DOMContentLoaded', function() {
        showToast('Login successful! Redirecting to dashboard...', 'success');
        setTimeout(function() {
          window.location.href = '../../pages/admin.dashboard.php';
        }, 2000);
      });
    <?php endif; ?>
  </script>
</body>

</html>