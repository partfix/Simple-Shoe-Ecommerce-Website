<?php
session_start();
require("../../db/customer.db.php");
require_once("../../controllers/login.controler.php");

$username = "";
$errors = [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | SoleStyle</title>
  <meta name="description" content="Sign in to your SoleStyle account">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="/frontend/css/login.pop.css">
</head>

<body class="antialiased bg-gray-50 text-gray-900">

  <div id="toast-container" class="fixed right-0 top-0 max-w-sm p-4 z-50 w-full sm:w-auto"></div>

  <div class="min-h-screen flex flex-col md:flex-row">
    <!-- Image -->
    <div class="hidden md:block md:w-1/2 bg-contain bg-no-repeat ml-10" style="background-image: url('../../asset/front.png');">
    </div>

    <div class="w-full md:w-1/2 flex flex-col justify-center p-4 sm:p-6 lg:p-10">
      <div class="mx-auto w-full max-w-md">
        <div class="mb-8">
          <h1 class="text-2xl font-semibold text-gray-900">Sign in to your account</h1>
          <p class="mt-2 text-sm text-gray-600">Welcome back to SoleStyle</p>
        </div>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="space-y-6">

          <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Email or Username</label>
            <input
              type="text"
              id="username"
              name="username"
              value="<?php echo $username; ?>"
              class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:ring-2 focus:ring-emerald-100"
              placeholder="your@email.com"
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

          <div>
            <button
              type="submit"
              name="login"
              value="Login"
              class="w-full flex justify-center py-2.5
                px-4 border border-transparent rounded-md shadow-sm 
                text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 
                transition duration-150">
              Sign in
            </button>
          </div>

          <!-- Register link -->
          <div class="text-center mt-4">
            <p class="text-sm text-gray-600">
              Don't have an account?
              <a href="./register.user.php" class="font-medium text-emerald-600 hover:text-emerald-500 
              transition duration-150">
                Create account
              </a>
            </p>
          </div>


          <div class="text-center">
            <p class="text-sm text-gray-600">
              Are you an admin?
              <a href=".././admin/login.admin.php" class="font-medium text-emerald-600 hover:text-emerald-500 transition duration-150">
                Admin login
              </a>
            </p>
          </div>

          <div class="text-center mt-8">
            <small class="text-xs bg-gray-100 text-gray-500 px-3 py-1 rounded-lg">
              Session ID: <?php echo session_id(); ?>
            </small>
          </div>
        </form>
      </div>
    </div>
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
    // Modal functions
    function showTermsModal() {
      document.getElementById('termsModal').classList.remove('hidden');
    }

    function hideTermsModal() {
      document.getElementById('termsModal').classList.add('hidden');
    }

    function showPrivacyModal() {
      document.getElementById('privacyModal').classList.remove('hidden');
    }

    function hidePrivacyModal() {
      document.getElementById('privacyModal').classList.add('hidden');
    }

    // Close modals when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
      // Get the form
      const form = document.querySelector('form');

      // Add event listener for form submission
      form.addEventListener('submit', function(e) {
        // Check if terms checkbox is checked
        const termsCheckbox = document.getElementById('terms');
        if (!termsCheckbox.checked) {
          e.preventDefault(); // Prevent form submission

          // Create and show toast notification
          const toastContainer = document.getElementById('toast-container');
          const toast = document.createElement('div');
          toast.className = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-md';
          toast.innerHTML = `
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm">Please agree to the Terms and Conditions to continue.</p>
              </div>
            </div>
          `;
          toastContainer.appendChild(toast);

          // Remove toast after 3 seconds
          setTimeout(() => {
            toast.remove();
          }, 3000);
        }
      });

      // Modal closing when clicking outside
      document.getElementById('termsModal').addEventListener('click', function(e) {
        if (e.target === this) {
          hideTermsModal();
        }
      });

      document.getElementById('privacyModal').addEventListener('click', function(e) {
        if (e.target === this) {
          hidePrivacyModal();
        }
      });

      // Close buttons in modals (assuming they exist in the included files)
      const closeButtons = document.querySelectorAll('.modal-close');
      closeButtons.forEach(button => {
        button.addEventListener('click', function() {
          this.closest('.fixed').classList.add('hidden');
        });
      });
    });
  </script>

  <script src="/frontend/js/login.prop.js"></script>
</body>

</html>