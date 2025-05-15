<div class="p-5 overflow-x-auto">
  <!-- Alert modal for delete confirmation with background blur -->
  <div id="deleteModal" class="hidden fixed inset-0 backdrop-blur-sm bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="relative mx-auto p-4 border w-80 shadow-md rounded-md bg-white">
      <div class="text-center">
        <div class="mx-auto flex items-center justify-center h-10 w-10 rounded-full bg-red-50 mb-3">
          <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
        </div>
        <h3 class="text-base font-medium text-gray-900">Delete Confirmation</h3>
        <div class="mt-2 mb-4">
          <p class="text-sm text-gray-500">Are you sure you want to delete this user?</p>
          <p id="adminWarning" class="mt-2 text-xs font-medium text-red-500 hidden">Warning: You are currently using the <span id="currentUsername"></span> account!</p>
        </div>
        <div class="flex justify-center space-x-3">
          <button id="deleteCancel" class="px-3 py-1.5 bg-gray-100 text-gray-600 text-sm font-medium rounded hover:bg-gray-200 focus:outline-none">
            Cancel
          </button>
          <button id="deleteConfirm" class="px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 focus:outline-none">
            Yes, Delete
          </button>
        </div>
      </div>
    </div>
  </div>

  <?php
  // Store current admin info for later use
  $current_admin = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $admin_data = null;
  ?>

  <table class="min-w-full divide-y divide-gray-200">
    <thead>
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      <?php
      $sql = "SELECT * FROM customer";
      $link = mysqli_query($conn, $sql);
      if (mysqli_num_rows($link)) {
        while ($caller = mysqli_fetch_assoc($link)) {
          // Skip current admin, store their data instead
          if ($caller["name"] == $current_admin) {
            $admin_data = $caller;
            continue; // Skip displaying this row
          }

          echo "<tr class='hover:bg-gray-50'>";
          echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . $caller["customer_ID"] . "</td>";
          echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>" . $caller["name"] . "</td>";
          echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . $caller["email"] . "</td>";
          echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . $caller["phone"] . "</td>";
          echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>" . $caller["address"] . "</td>";
          echo "<td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>";
          echo "<a href='?edit=" . $caller["customer_ID"] . "' class='text-indigo-600 hover:text-indigo-900 mr-3'>Edit</a>";
          echo "<a href='javascript:void(0)' onclick='confirmDelete(\"" . $caller["customer_ID"] . "\", \"" . $caller["name"] . "\", false)' class='text-red-600 hover:text-red-900'>Delete</a>";
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6' class='px-6 py-12 text-center text-gray-500'>
    <div class='flex flex-col items-center justify-center'>
      <svg xmlns='http://www.w3.org/2000/svg' class='h-12 w-12 text-gray-400 mb-2' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 12h13a4 4 0 100-8 4 4 0 00-4 4H3m0 8h10a4 4 0 110 8 4 4 0 01-4-4H3' />
      </svg>
      <span class='text-sm'>No users found</span>
    </div>
  </td></tr>";
      }
      ?>
    </tbody>
  </table>

  <script>
    // Store the current username in a JavaScript variable
    const currentUsername = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";
    let deleteUserId = null;

    function confirmDelete(userId, userName, isAdminAccount) {
      deleteUserId = userId;
      const modal = document.getElementById('deleteModal');
      const adminWarning = document.getElementById('adminWarning');
      const usernameSpan = document.getElementById('currentUsername');

      // Show/hide the admin warning
      if (isAdminAccount) {
        adminWarning.classList.remove('hidden');
        usernameSpan.textContent = currentUsername;
      } else {
        adminWarning.classList.add('hidden');
      }

      // Show the modal
      modal.classList.remove('hidden');

      // Setup event listeners for the buttons
      document.getElementById('deleteConfirm').onclick = function() {
        window.location.href = "?delete=" + deleteUserId;
      };

      document.getElementById('deleteCancel').onclick = function() {
        modal.classList.add('hidden');
      };
    }
  </script>


</div>