<!--Activities-->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
  <div class="p-5 border-b border-gray-100 flex justify-between items-center">
    <div>
      <h2 class="text-base font-medium text-gray-800">Recent Activity</h2>
      <p class="text-xs text-gray-500 mt-1">Your latest actions</p>
    </div>
    <!-- Clear All Button -->
    <button id="clear-all-btn" class="px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-md transition-colors duration-200 flex items-center shadow-sm">
      Clear All
    </button>
  </div>

  <!-- Add a message div for success/error notifications -->
  <div id="message-container" class="px-5 pt-2" style="display: none;">
    <div id="message" class="p-2 rounded text-sm"></div>
  </div>

  <div class="p-5">
    <ul class="space-y-3 max-h-60 overflow-y-auto pr-2" style="scrollbar-width: thin;" id="activity-list">
      <?php
      // First check if we have a way to identify the current user
      $current_user_filter = "";

      // Check for user identification in session - adjust these checks based on how your sessions are set up
      if (isset($_SESSION['user_id'])) {
        $current_user_id = $_SESSION['user_id'];
        $current_user_filter = "WHERE user_id = $current_user_id";
      } elseif (isset($_SESSION['admin_id'])) {
        $current_user_id = $_SESSION['admin_id'];
        $current_user_filter = "WHERE admin_id = $current_user_id";
      } elseif (isset($_SESSION['username'])) {
        $current_user_name = $_SESSION['username'];
        $current_user_filter = "WHERE admin_name = '$current_user_name'";
      }
      // If none of the above session variables exist, we'll show all activities (no WHERE clause)

      // Process delete requests
      if (isset($_POST['delete_activity']) && isset($_POST['activity_id'])) {
        $activity_id = $_POST['activity_id'];
        // Convert to integer for safety
        $activity_id = (int)$activity_id;

        // Delete the activity record
        $delete_query = "DELETE FROM activity_log WHERE id = $activity_id";
        if (mysqli_query($conn, $delete_query)) {
          echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                      var messageContainer = document.getElementById('message-container');
                      var message = document.getElementById('message');
                      message.innerHTML = 'Activity deleted successfully';
                      message.className = 'p-2 rounded text-sm bg-green-100 text-green-700';
                      messageContainer.style.display = 'block';
                      setTimeout(function() {
                        messageContainer.style.display = 'none';
                      }, 3000);
                    });
                  </script>";
        } else {
          echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                      var messageContainer = document.getElementById('message-container');
                      var message = document.getElementById('message');
                      message.innerHTML = 'Error deleting activity';
                      message.className = 'p-2 rounded text-sm bg-red-100 text-red-700';
                      messageContainer.style.display = 'block';
                    });
                  </script>";
        }
      }

      // Process clear all request
      if (isset($_POST['clear_all_activities'])) {
        // Delete all activities for the current user
        $clear_query = "DELETE FROM activity_log $current_user_filter";
        if (mysqli_query($conn, $clear_query)) {
          echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                      var messageContainer = document.getElementById('message-container');
                      var message = document.getElementById('message');
                      message.innerHTML = 'All activities cleared successfully';
                      message.className = 'p-2 rounded text-sm bg-green-100 text-green-700';
                      messageContainer.style.display = 'block';
                      setTimeout(function() {
                        messageContainer.style.display = 'none';
                      }, 3000);
                    });
                  </script>";
        } else {
          echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                      var messageContainer = document.getElementById('message-container');
                      var message = document.getElementById('message');
                      message.innerHTML = 'Error clearing activities';
                      message.className = 'p-2 rounded text-sm bg-red-100 text-red-700';
                      messageContainer.style.display = 'block';
                    });
                  </script>";
        }
      }

      // Get recent activity with the appropriate filter
      $activity_query = "SELECT * FROM activity_log $current_user_filter ORDER BY created_at DESC LIMIT 10";
      $activity_result = mysqli_query($conn, $activity_query);

      if ($activity_result && mysqli_num_rows($activity_result) > 0) {
        while ($activity = mysqli_fetch_assoc($activity_result)) {
          $action_class = '';
          $icon = '';
          // Set different colors for different actions
          switch ($activity['action']) {
            case 'Create User':
              $action_class = 'text-green-600';
              $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                          </svg>';
              break;
            case 'Update User':
              $action_class = 'text-blue-600';
              $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                          </svg>';
              break;
            case 'Delete User':
              $action_class = 'text-red-600';
              $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                          </svg>';
              break;
            case 'Add Product':
              $action_class = 'text-purple-600';
              $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                          </svg>';
              break;
            case 'Update Product':
              $action_class = 'text-yellow-600';
              $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                          </svg>';
              break;
            case 'Delete Product':
              $action_class = 'text-red-600';
              $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                          </svg>';
              break;
            default:
              $action_class = 'text-gray-600';
              $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                          </svg>';
              break;
          }

          // Format the timestamp
          $timestamp = new DateTime($activity['created_at']);
          $formatted_time = $timestamp->format('M j, Y g:i A');
      ?>

          <li class="flex items-start justify-between bg-gray-50 p-3 rounded-md">
            <div class="flex space-x-3">
              <div class="flex-shrink-0 mt-0.5">
                <?php echo $icon; ?>
              </div>
              <div>
                <p class="text-sm mb-1">
                  <span class="font-medium <?php echo $action_class; ?>"><?php echo htmlspecialchars($activity['action']); ?></span>
                  <span class="text-gray-600"> by </span>
                  <span class="font-medium text-gray-700"><?php echo htmlspecialchars($activity['admin_name']); ?></span>
                </p>
                <p class="text-xs text-gray-500"><?php echo htmlspecialchars($activity['details']); ?></p>
                <span class="text-xs text-gray-400 block mt-1"><?php echo $formatted_time; ?></span>
              </div>
            </div>
            <!-- Delete Button -->
            <form method="post" class="flex-shrink-0 ml-2" onsubmit="return confirm('Are you sure you want to delete this activity?');">
              <input type="hidden" name="activity_id" value="<?php echo $activity['id']; ?>">
              <button type="submit" name="delete_activity" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </form>
          </li>

      <?php
        }
      } else {
        echo '<li class="text-center py-4 text-gray-500 text-sm">No activity found</li>';
      }
      ?>
    </ul>
  </div>
</div>


<!-- Form for clearing all activities -->
<form id="clear-all-form" method="post" class="hidden">
  <input type="hidden" name="clear_all_activities" value="1">
</form>

<script>
  // Set up event listener for clear all button
  document.getElementById('clear-all-btn').addEventListener('click', function() {
    if (confirm('Are you sure you want to clear all activities? This action cannot be undone.')) {
      document.getElementById('clear-all-form').submit();
    }
  });

  // Function to dismiss notification
  function dismissNotification() {
    const notification = document.getElementById('message-container');
    if (notification) {
      notification.style.display = 'none';
    }
  }

  // Auto-hide notifications after 5 seconds
  setTimeout(function() {
    dismissNotification();
  }, 5000);
</script>