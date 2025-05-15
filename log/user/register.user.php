<?php
session_start();
ob_start();
require("../../db/customer.db.php");
require_once("../../controllers/register.controller.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register | SoleStyle</title>
  <meta name="description" content="Create your SoleStyle account">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="/frontend/css/register.mod.css">
</head>

<body class="antialiased bg-gray-50 text-gray-900">
  <!-- Toast notifications -->
  <div id="toast-container" class="fixed right-0 top-0 max-w-sm p-4 z-50 w-full sm:w-auto"></div>

  <div class="min-h-screen flex flex-col md:flex-row">
    <!-- Content area -->
    <div class="w-full md:w-1/2 flex flex-col justify-center p-4 sm:p-6 lg:p-10">
      <div class="mx-auto w-full max-w-md">
        <div class="mb-8">
          <h1 class="text-2xl font-semibold text-gray-900">Create your account</h1>
          <p class="mt-2 text-sm text-gray-600">Join SoleStyle to discover exclusive footwear collections</p>
        </div>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="space-y-6">
          <!-- Grid layout for form fields -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
            <!-- Username field -->
            <div class="col-span-1">
              <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                value="<?php echo $username; ?>"
                class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-2 focus:ring-emerald-100"
                placeholder="8+ characters, no special chars"
                required />
            </div>

            <!-- Email field -->
            <div class="col-span-1">
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
              <input
                type="email"
                id="email"
                name="email"
                value="<?php echo $email; ?>"
                class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-2 focus:ring-emerald-100"
                placeholder="your@email.com"
                required />
            </div>

            <!-- Phone field -->
            <div class="col-span-1">
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone number</label>
              <input
                type="tel"
                id="phone"
                name="phone"
                value="<?php echo $phone; ?>"
                class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-2 focus:ring-emerald-100"
                placeholder="11 digits only"
                required />
            </div>

            <!-- Address field -->
            <div class="col-span-1">
              <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
              <input
                type="text"
                id="address"
                name="address"
                value="<?php echo $address; ?>"
                class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-2 focus:ring-emerald-100"
                placeholder="Street, City"
                required />
            </div>

            <!-- Password field -->
            <div class="col-span-1">
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-2 focus:ring-emerald-100"
                placeholder="Include 1 special character"
                required />
            </div>

            <!-- Confirm Password field -->
            <div class="col-span-1">
              <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm password</label>
              <input
                type="password"
                id="confirm-password"
                name="confirm-password"
                class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-2 focus:ring-emerald-100"
                placeholder="Re-enter password"
                required />
            </div>
          </div>

          <!-- Terms and Conditions Checkbox -->
          <div class="mt-4">
            <div class="flex items-start">
              <div class="flex items-center h-5">
                <input
                  id="terms"
                  name="terms"
                  type="checkbox"
                  class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                  required />
              </div>
              <div class="ml-3 text-sm">
                <label for="terms" class="font-medium text-gray-700">
                  I agree to the
                  <a href="#" class="text-emerald-600 hover:text-emerald-500" onclick="showTermsModal(); return false;">Terms and Conditions</a>
                  and
                  <a href="#" class="text-emerald-600 hover:text-emerald-500" onclick="showPrivacyModal(); return false;">Privacy Policy</a>
                </label>
              </div>
            </div>
          </div>

          <!-- Submit button -->
          <div>
            <button
              type="submit"
              name="register"
              value="register"
              class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-150"
              id="registerButton">
              Create account
            </button>
          </div>

          <!-- Sign in link -->
          <div class="text-center mt-4">
            <p class="text-sm text-gray-600">
              Already have an account?
              <a href="./login.user.php" class="font-medium text-emerald-600 hover:text-emerald-500 transition duration-150">
                Sign in
              </a>
            </p>
          </div>
        </form>
      </div>
    </div>

    <!-- Image area -->
    <div class="hidden md:block md:w-1/2 bg-cover bg-center mt-10" style="background-image: url('../../asset/bk-file.png');">
    </div>

    <!-- terms modal -->
    <div id="termsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
      <?php require_once("terms-modal.php") ?>
    </div>

    <!-- privacy policy -->
    <div id="privacyModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
      <?php require_once("privacy-policy.php") ?>
    </div>

    <script>
      // Toast notification system
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

      // Terms and Privacy Policy Modal functions
      function showTermsModal() {
        document.getElementById('termsModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }

      function hideTermsModal() {
        document.getElementById('termsModal').classList.add('hidden');
        document.body.style.overflow = '';
      }

      function showPrivacyModal() {
        document.getElementById('privacyModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }

      function hidePrivacyModal() {
        document.getElementById('privacyModal').classList.add('hidden');
        document.body.style.overflow = '';
      }

      // Form validation for terms checkbox
      document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const termsCheckbox = document.getElementById('terms');

        form.addEventListener('submit', function(event) {
          if (!termsCheckbox.checked) {
            event.preventDefault();
            showToast('You must accept the Terms and Privacy Policy to register', 'error');
          }
        });
      });

      <?php if (!empty($errors)): ?>
        document.addEventListener('DOMContentLoaded', function() {
          <?php foreach ($errors as $error): ?>
            showToast('<?php echo $error; ?>', 'error');
          <?php endforeach; ?>
        });
      <?php endif; ?>

      <?php if ($success): ?>
        document.addEventListener('DOMContentLoaded', function() {
          showToast('Registration successful! Redirecting to login...', 'success');
          setTimeout(function() {
            window.location.href = './login.user.php';
          }, 2000);
        });
      <?php endif; ?>
    </script>
</body>

</html>