<!--admin form-->
<div class=" border-b border-gray-200">
  <h3 class="text-sm font-medium text-gray-700"><?php echo isset($edit_user) ? 'Edit User' : 'Add New User'; ?></h3>
</div>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="p-4" id="userForm">
  <?php if (!empty($error_message)): ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
      <p><?php echo $error_message; ?></p>
    </div>
  <?php endif; ?>
  <?php if (isset($edit_user)): ?>
    <input type="hidden" name="user_id" value="<?php echo $edit_user['customer_ID']; ?>">
  <?php endif; ?>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
    <div>
      <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
      <input type="text" id="username" name="username" required
        value="<?php echo isset($edit_user) ? $edit_user['name'] : ''; ?>"
        minlength="8" pattern="[A-Za-z0-9]+"
        class="form-input block w-full px-4 py-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base">
      <p class="mt-1 text-xs text-gray-500 hidden warning-message" id="username-warning">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        At least 8 characters, letters and numbers only
      </p>
    </div>
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
      <input type="email" id="email" name="email" required
        value="<?php echo isset($edit_user) ? $edit_user['email'] : ''; ?>"
        placeholder="@yours.com"
        class="form-input block w-full px-4 py-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base placeholder:text-sm">
    </div>
    <div>
      <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
      <input type="text" id="phone" name="phone" required
        value="<?php echo isset($edit_user) ? $edit_user['phone'] : ''; ?>"
        maxlength="11" pattern="[0-9]{1,11}"
        class="form-input block w-full px-4 py-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base">
      <p class="mt-1 text-xs text-gray-500 hidden warning-message" id="phone-warning">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Maximum 11 digits
      </p>
    </div>
    <div>
      <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
      <input type="text" id="address" name="address" required
        value="<?php echo isset($edit_user) ? $edit_user['address'] : ''; ?>"
        placeholder="Street, City"
        class="form-input block w-full px-4 py-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base placeholder:text-sm">
      <p class="mt-1 text-xs text-gray-500 hidden warning-message" id="address-warning">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Address must be in the format of: Street, City
      </p>
    </div>
    <div>
      <label for="user_type" class="block text-sm font-medium text-gray-700 mb-1">User Type</label>
      <select id="user_type" name="user_type" required
        class="form-select block w-full px-4 py-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base">
        <option value="customer" class="text-sm" <?php echo (isset($edit_user) && isset($edit_user['user_type']) && $edit_user['user_type'] == 'customer') ? 'selected' : ''; ?>>Customer</option>
        <option value="admin" class="text-sm" <?php echo (isset($edit_user) && isset($edit_user['user_type']) && $edit_user['user_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
      </select>
    </div>

    <?php if (!isset($edit_user)): ?>
      <!-- Password fields (only for Add User) -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" id="password" name="password" required
          minlength="8"
          class="form-input block w-full px-4 py-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base">
        <p class="mt-1 text-xs text-gray-500 hidden warning-message" id="password-warning">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Must be at least 8 characters with one capital letter and one special character
        </p>
      </div>
      <div>
        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required
          class="form-input block w-full px-4 py-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base">
        <p class="mt-1 text-xs text-gray-500 hidden warning-message" id="password-match-warning">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Passwords must match
        </p>
      </div>
    <?php else: ?>
      <!-- Password fields (for Edit User - optional) -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password (leave blank to keep current)</label>
        <input type="password" id="password" name="password"
          minlength="8"
          class="form-input block w-full px-4 py-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base">
        <p class="mt-1 text-xs text-gray-500 hidden warning-message" id="password-warning">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Must be at least 8 characters with one capital letter and one special character (!@#$%^&*)
        </p>
      </div>
      <div>
        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
        <input type="password" id="confirm_password" name="confirm_password"
          class="form-input block w-full px-4 py-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base">
        <p class="mt-1 text-xs text-gray-500 hidden warning-message" id="password-match-warning">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Passwords must match
        </p>
      </div>
    <?php endif; ?>
  </div>
  <div class="flex justify-end space-x-3 pt-5 border-t border-gray-200">
    <button type="button" id="cancelForm" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
      Cancel
    </button>

    <button type="submit" name="<?php echo isset($edit_user) ? 'update_user' : 'add_user'; ?>"
      class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
      <?php echo isset($edit_user) ? 'Save Changes' : 'Add User'; ?>
    </button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get all input fields that need validation
      const usernameInput = document.getElementById('username');
      const phoneInput = document.getElementById('phone');
      const addressInput = document.getElementById('address');
      const passwordInput = document.getElementById('password');
      const confirmPasswordInput = document.getElementById('confirm_password');
      const userForm = document.getElementById('userForm');

      // Get all warning elements
      const usernameWarning = document.getElementById('username-warning');
      const phoneWarning = document.getElementById('phone-warning');
      const addressWarning = document.getElementById('address-warning');
      const passwordWarning = document.getElementById('password-warning');
      const passwordMatchWarning = document.getElementById('password-match-warning');

      // Form validation
      userForm.addEventListener('submit', function(event) {
        // Check if password fields have values (only validate if they're being used)
        if (passwordInput.value !== '') {
          // Validate password format
          const hasCapital = /[A-Z]/.test(passwordInput.value);
          const hasSpecial = /[!@#$%^&*]/.test(passwordInput.value);
          const hasMinLength = passwordInput.value.length >= 8;

          if (!hasCapital || !hasSpecial || !hasMinLength) {
            event.preventDefault();
            passwordWarning.classList.remove('hidden');
            return false;
          }

          // Check if passwords match
          if (passwordInput.value !== confirmPasswordInput.value) {
            event.preventDefault();
            passwordMatchWarning.classList.remove('hidden');
            return false;
          }
        }

        // Only validate confirm password is matching if we have a password
        if (passwordInput.value !== '' && passwordInput.value !== confirmPasswordInput.value) {
          event.preventDefault();
          passwordMatchWarning.classList.remove('hidden');
          return false;
        }

        return true;
      });

      // Username validation
      if (usernameInput && usernameWarning) {
        usernameInput.addEventListener('focus', function() {
          usernameWarning.classList.remove('hidden');
        });

        usernameInput.addEventListener('input', function() {
          // Check if input matches the required pattern
          if (this.value.length >= 8 && /^[A-Za-z0-9]+$/.test(this.value)) {
            usernameWarning.classList.add('hidden');
          } else {
            usernameWarning.classList.remove('hidden');
          }
        });

        usernameInput.addEventListener('blur', function() {
          if (this.value === '') {
            usernameWarning.classList.add('hidden');
          }
        });
      }

      // Phone validation
      if (phoneInput && phoneWarning) {
        phoneInput.addEventListener('focus', function() {
          phoneWarning.classList.remove('hidden');
        });

        phoneInput.addEventListener('input', function() {
          // Check if input matches the required pattern
          if (/^[0-9]{1,11}$/.test(this.value)) {
            phoneWarning.classList.add('hidden');
          } else {
            phoneWarning.classList.remove('hidden');
          }
        });

        phoneInput.addEventListener('blur', function() {
          if (this.value === '') {
            phoneWarning.classList.add('hidden');
          }
        });
      }

      // Address validation
      if (addressInput && addressWarning) {
        addressInput.addEventListener('focus', function() {
          addressWarning.classList.remove('hidden');
        });

        addressInput.addEventListener('input', function() {
          // Check if input contains a comma (simple check for "Street, City" format)
          if (this.value.includes(',')) {
            addressWarning.classList.add('hidden');
          } else {
            addressWarning.classList.remove('hidden');
          }
        });

        addressInput.addEventListener('blur', function() {
          if (this.value === '') {
            addressWarning.classList.add('hidden');
          }
        });
      }

      // Password validation
      if (passwordInput && passwordWarning) {
        passwordInput.addEventListener('focus', function() {
          if (this.value !== '' || document.activeElement === this) {
            passwordWarning.classList.remove('hidden');
          }
        });

        passwordInput.addEventListener('input', function() {
          // Check password requirements
          const hasCapital = /[A-Z]/.test(this.value);
          const hasSpecial = /[!@#$%^&*]/.test(this.value);
          const hasMinLength = this.value.length >= 8;

          if (hasCapital && hasSpecial && hasMinLength) {
            passwordWarning.classList.add('hidden');
          } else {
            passwordWarning.classList.remove('hidden');
          }

          // Check if passwords match when typing
          if (confirmPasswordInput.value !== '' && this.value !== confirmPasswordInput.value) {
            passwordMatchWarning.classList.remove('hidden');
          } else {
            passwordMatchWarning.classList.add('hidden');
          }
        });

        passwordInput.addEventListener('blur', function() {
          if (this.value === '') {
            passwordWarning.classList.add('hidden');
          }
        });
      }

      // Confirm password validation
      if (confirmPasswordInput && passwordMatchWarning) {
        confirmPasswordInput.addEventListener('focus', function() {
          if (passwordInput.value !== '' && this.value !== passwordInput.value) {
            passwordMatchWarning.classList.remove('hidden');
          }
        });

        confirmPasswordInput.addEventListener('input', function() {
          // Check if passwords match
          if (passwordInput.value !== '' && this.value !== passwordInput.value) {
            passwordMatchWarning.classList.remove('hidden');
          } else {
            passwordMatchWarning.classList.add('hidden');
          }
        });

        confirmPasswordInput.addEventListener('blur', function() {
          if (this.value === '') {
            passwordMatchWarning.classList.add('hidden');
          }
        });
      }
    });
  </script>
</form>