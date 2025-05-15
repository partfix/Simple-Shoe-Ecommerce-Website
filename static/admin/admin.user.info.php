<!--this is infor of current user(admin)-->

<body class="bg-gray-50 font-sans">
  <!-- Notif reuse-->
  <div id="notificationContainer" class="fixed top-4 right-4 z-50 max-w-md w-full flex flex-col gap-2"></div>
  <div class="flex min-h-screen">
    <div class="flex-1 p-8 max-w-4xl mx-auto">
      <div class="mb-8">
        <h2 class="text-3xl font-light text-gray-800">Admin Profile</h2>
      </div>

      <!-- Display mes -->
      <?php if (!empty($profileUpdateMessage)) echo $profileUpdateMessage; ?>
      <?php if (!empty($passwordUpdateMessage)) echo $passwordUpdateMessage; ?>

      <!-- Admin Info card -->
      <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
        <div class="flex items-center mb-8 border-b pb-6">
          <div class="bg-green-50 p-4 rounded-full mr-5">
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-medium text-gray-800"><?php echo htmlspecialchars($admin_data['name']); ?></h3>
            <p class="text-gray-500"><?php echo htmlspecialchars($admin_data['user_type']); ?></p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
          <div>
            <h4 class="text-xs font-medium uppercase tracking-wider text-gray-500 mb-4">Contact Information</h4>
            <div class="space-y-5">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span class="text-gray-700"><?php echo htmlspecialchars($admin_data['email']); ?></span>
              </div>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <span class="text-gray-700"><?php echo htmlspecialchars($admin_data['phone']); ?></span>
              </div>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-gray-700"><?php echo htmlspecialchars($admin_data['address']); ?></span>
              </div>
            </div>
          </div>

          <div>
            <h4 class="text-xs font-medium uppercase tracking-wider text-gray-500 mb-4">Account Information</h4>
            <div class="space-y-5">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span class="text-gray-700">Password: <i class="text-sm text-yellow-800">Password is hidden</i></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Action -->
      <div class="flex flex-wrap space-x-4 mb-8">
        <button class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-md flex items-center transition-colors duration-200" onclick="toggleModal('editProfileModal')">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
          </svg>
          Edit Profile
        </button>
        <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-md flex items-center transition-colors duration-200" onclick="toggleModal('changePasswordModal')">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
          Change Password
        </button>
      </div>
    </div>
  </div>

  <!-- Edit Profile Modal -->
  <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-medium text-gray-800">Edit Profile</h3>
        <button onclick="toggleModal('editProfileModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <form method="POST" action="" id="profileForm">
        <div class="mb-5">
          <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Name</label>
          <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($admin_data['name']); ?>" class="border rounded-md w-full py-2 px-3 text-gray-700 focus:ring-2 focus:ring-green-500 placeholder:text-sm" minlength="8" pattern="[A-Za-z0-9]+" title="At least 8 characters, letters and numbers only" placeholder="Username">
          <div class="text-amber-600 text-xs mt-1 flex items-center" id="name-warning">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            At least 8 characters, letters and numbers only
          </div>
        </div>
        <div class="mb-5">
          <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
          <div class="relative">
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin_data['email']); ?>" class="border border-gray-200 rounded-md w-full py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly aria-disabled="true">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
          </div>
          <p class="text-xs text-gray-500 mt-1">Contact your lead developer to change email.</p>
        </div>
        <div class="mb-5">
          <label for="phone" class="block text-gray-700 text-sm font-medium mb-2">Phone</label>
          <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($admin_data['phone']); ?>" maxlength="11" class="border border-gray-200 rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent placeholder:text-sm" placeholder="Phone #">
        </div>
        <div class="mb-6">
          <label for="address" class="block text-gray-700 text-sm font-medium mb-2">Address</label>
          <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($admin_data['address']); ?>" class="border border-gray-200 rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent placeholder:text-sm" placeholder="Street, City" pattern="^[^,]+,\s*[^,]+$">
          <div class="text-amber-600 text-xs mt-1 flex items-center" id="address-warning">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            Address must be in the format: Street, City
          </div>
        </div>
        <div class="flex items-center justify-end">
          <button type="button" onclick="toggleModal('editProfileModal')" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md mr-2 transition-colors">
            Cancel
          </button>
          <button type="submit" name="update_profile" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Change Password Modal -->
  <div id="changePasswordModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-medium text-gray-800">Change Password</h3>
        <button onclick="toggleModal('changePasswordModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <form method="POST" action="" id="passwordForm">
        <div class="mb-5">
          <label for="current_password" class="block text-gray-700 text-sm font-medium mb-2 ">Current Password</label>
          <input type="password" id="current_password" name="current_password" class="border border-gray-200 rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent placeholder:text-xs" placeholder="password">
        </div>
        <div class="mb-5">
          <label for="new_password" class="block text-gray-700 text-sm font-medium mb-2">New Password</label>
          <input type="password" id="new_password" name="new_password" class="border border-gray-200 rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent placeholder:text-xs" pattern="(?=.*[A-Z])(?=.*[\W_]).+">
          <div class="text-amber-600 text-xs mt-1 flex items-center" id="password-warning">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            Must contain at least one special character and one capital letter
          </div>
        </div>
        <div class="mb-6">
          <label for="confirm_password" class="block text-gray-700 text-sm font-medium mb-2">Confirm New Password</label>
          <input type="password" id="confirm_password" name="confirm_password" class="border border-gray-200 rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent placeholder:text-xs" pattern="(?=.*[A-Z])(?=.*[\W_]).+">
          <div id="password_match_error" class="text-red-500 text-xs mt-1 flex items-center hidden">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Passwords do not match
          </div>
        </div>
        <div class="flex items-center justify-end">
          <button type="button" onclick="toggleModal('changePasswordModal')" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md mr-2 transition-colors">
            Cancel
          </button>
          <button type="submit" name="change_password" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
            Change Password
          </button>
        </div>
      </form>
    </div>
  </div>


  <script>
    function toggleModal(modalId) {
      const modal = document.getElementById(modalId);
      if (modal.classList.contains('hidden')) {
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      } else {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }
    }

    document.getElementById('passwordForm').addEventListener('submit', function(event) {
      const newPassword = document.getElementById('new_password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      const errorElement = document.getElementById('password_match_error');

      if (newPassword !== confirmPassword) {
        errorElement.classList.remove('hidden');
        event.preventDefault();
      } else {
        errorElement.classList.add('hidden');
      }
    });

    // Show/hide validation warnings
    document.addEventListener('DOMContentLoaded', function() {
      // Initially hide the validation warnings
      document.getElementById('name-warning').style.display = 'none';
      document.getElementById('address-warning').style.display = 'none';
      document.getElementById('password-warning').style.display = 'none';

      // Show warning on focus, hide on valid input
      const nameInput = document.getElementById('name');
      nameInput.addEventListener('focus', function() {
        document.getElementById('name-warning').style.display = 'flex';
      });
      nameInput.addEventListener('blur', function() {
        if (this.validity.valid) {
          document.getElementById('name-warning').style.display = 'none';
        }
      });

      const addressInput = document.getElementById('address');
      addressInput.addEventListener('focus', function() {
        document.getElementById('address-warning').style.display = 'flex';
      });
      addressInput.addEventListener('blur', function() {
        if (this.validity.valid) {
          document.getElementById('address-warning').style.display = 'none';
        }
      });

      const passwordInput = document.getElementById('new_password');
      passwordInput.addEventListener('focus', function() {
        document.getElementById('password-warning').style.display = 'flex';
      });
      passwordInput.addEventListener('blur', function() {
        if (this.validity.valid) {
          document.getElementById('password-warning').style.display = 'none';
        }
      });
    });

    // Close modals when clicking outside
    window.onclick = function(event) {
      const editProfileModal = document.getElementById('editProfileModal');
      const changePasswordModal = document.getElementById('changePasswordModal');

      if (event.target === editProfileModal) {
        toggleModal('editProfileModal');
      }

      if (event.target === changePasswordModal) {
        toggleModal('changePasswordModal');
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      // Target all PHP message elements
      const phpMessages = document.querySelectorAll('.bg-green-100, .bg-red-100');

      // Add transition class to all message elements
      phpMessages.forEach(message => {
        // Add transition classes if they don't exist
        message.classList.add('transition-opacity', 'duration-300', 'opacity-100');

        // Set timeout to fade out after 5 seconds
        setTimeout(() => {
          message.classList.replace('opacity-100', 'opacity-0');

          // Remove from DOM after transition completes
          setTimeout(() => {
            if (message.parentNode) {
              message.remove();
            }
          }, 300);
        }, 3000);
      });
    });
  </script>
</body>