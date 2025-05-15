<!-- Active Orders Panel -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
  <div class="p-5 border-b border-gray-100">
    <h2 class="text-base font-medium text-gray-800">Active Orders</h2>
    <p class="text-xs text-gray-500 mt-1">Recent customer purchases</p>
  </div>

  <div class="p-5">
    <?php
    // Modified query: exclude removed orders
    $order_query = "SELECT o.order_ID, o.customer_ID, c.name as customer_name, o.Order_Date, o.Total_Amount, o.Status 
                   FROM `order` o
                   JOIN customer c ON o.customer_ID = c.customer_ID
                   WHERE o.Status != 'Removed'
                   GROUP BY o.order_ID
                   ORDER BY o.Order_Date DESC LIMIT 10";
    $order_result = mysqli_query($conn, $order_query);

    // Handle form submission for status update
    if (isset($_POST['update_status'])) {
      $order_id = (int) $_POST['order_id'];
      $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);
      $admin_name = $_SESSION['admin_name'] ?? ($_SESSION['username'] ?? 'Unknown Admin');

      // Check if we should delete the record or update status
      if ($new_status === 'Removed') {
        // Get order details before deletion for logging
        $order_details_query = "SELECT c.name as customer_name, o.Total_Amount 
                              FROM `order` o 
                              JOIN customer c ON o.customer_ID = c.customer_ID 
                              WHERE o.order_ID = $order_id";
        $details_result = mysqli_query($conn, $order_details_query);
        $order_details = mysqli_fetch_assoc($details_result);

        // Delete order from database
        $delete_query = "DELETE FROM `order` WHERE order_ID = $order_id";
        if (mysqli_query($conn, $delete_query)) {
          $formatted_amount = '₱' . number_format($order_details['Total_Amount'], 2);
          $action = "Remove Order";
          $details = "Permanently deleted order #$order_id for " . htmlspecialchars($order_details['customer_name']) .
            " ($formatted_amount) from database";

          $activity_query = "INSERT INTO activity_log (admin_name, action, details, created_at) 
                           VALUES ('$admin_name', '$action', '$details', NOW())";
          mysqli_query($conn, $activity_query);

          $_SESSION['status_message'] = "Order #$order_id has been <strong>permanently deleted</strong> from the database!";
          $_SESSION['status_type'] = "success";
        } else {
          $_SESSION['status_message'] = "Failed to delete order: " . htmlspecialchars(mysqli_error($conn));
          $_SESSION['status_type'] = "error";
        }
      } else {
        // Regular status update (unchanged from original)
        $update_query = "UPDATE `order` SET Status = '$new_status' WHERE order_ID = $order_id";
        if (mysqli_query($conn, $update_query)) {
          $order_details_query = "SELECT c.name as customer_name, o.Total_Amount 
                                FROM `order` o 
                                JOIN customer c ON o.customer_ID = c.customer_ID 
                                WHERE o.order_ID = $order_id";
          $details_result = mysqli_query($conn, $order_details_query);
          $order_details = mysqli_fetch_assoc($details_result);

          $formatted_amount = '₱' . number_format($order_details['Total_Amount'], 2);
          $action = "Update Order Status";
          $details = "Changed order #$order_id for " . htmlspecialchars($order_details['customer_name']) .
            " ($formatted_amount) to status: $new_status";

          $activity_query = "INSERT INTO activity_log (admin_name, action, details, created_at) 
                           VALUES ('$admin_name', '$action', '$details', NOW())";
          mysqli_query($conn, $activity_query);

          $_SESSION['status_message'] = "Order #$order_id status updated to <strong>$new_status</strong> successfully!";
          $_SESSION['status_type'] = "success";
        } else {
          $_SESSION['status_message'] = "Failed to update order status: " . htmlspecialchars(mysqli_error($conn));
          $_SESSION['status_type'] = "error";
        }
      }

      echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "';</script>";
      exit();
    }


    // Display status message
    if (isset($_SESSION['status_message'])) {
      $message_type = $_SESSION['status_type'] ?? "info";
      $bg_color = match ($message_type) {
        "success" => "bg-green-50 text-green-700", // Less intense green
        "error" => "bg-red-50 text-red-700",
        default => "bg-blue-50 text-blue-700",
      };

      // Create a unique ID for the status message
      $message_id = "status-message-" . uniqid();

      // Simplified message with smaller padding and font
      echo '<div id="' . $message_id . '" class="mb-3 py-2 px-3 text-sm rounded-md ' . $bg_color . '" style="transition: opacity 0.5s ease-out">';
      echo $_SESSION['status_message'];
      echo '</div>';

      // Auto-hide message after 3.5 seconds
      echo '<script>
        setTimeout(function() {
          const msg = document.getElementById("' . $message_id . '");
          msg.style.opacity = "0";
          setTimeout(function() { msg.remove(); }, 500);
        }, 3000);
      </script>';

      unset($_SESSION['status_message'], $_SESSION['status_type']);
    }


    if ($order_result && mysqli_num_rows($order_result) > 0) {
      echo '<div class="h-64 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">';
      echo '<div class="overflow-x-auto">';
      echo '<table class="min-w-full divide-y divide-gray-200">';
      echo '<thead class="bg-gray-50 sticky top-0">';
      echo '<tr>';
      echo '<th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>';
      echo '<th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>';
      echo '<th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>';
      echo '<th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>';
      echo '<th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>';
      echo '<th class="px-3 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody class="bg-white divide-y divide-gray-200">';

      while ($order = mysqli_fetch_assoc($order_result)) {
        $date = new DateTime($order['Order_Date']);
        $formatted_date = $date->format('M j, Y');
        $amount = '₱' . number_format($order['Total_Amount'], 2);

        $status_class = '';
        $status_bg = '';

        switch ($order['Status']) {
          case 'Processing':
            $status_class = 'text-yellow-800';
            $status_bg = 'bg-yellow-100';
            break;
          case 'Confirmed':
            $status_class = 'text-green-800';
            $status_bg = 'bg-green-100';
            break;
          case 'Delivered':
            $status_class = 'text-blue-800';
            $status_bg = 'bg-blue-100';
            break;
          case 'Completed':
            $status_class = 'text-green-800';
            $status_bg = 'bg-green-100';
            break;
          case 'Cancelled':
            $status_class = 'text-red-800';
            $status_bg = 'bg-red-100';
            break;
          default:
            $status_class = 'text-gray-800';
            $status_bg = 'bg-gray-100';
        }

        echo '<tr>';
        echo '<td class="px-3 py-2 text-sm text-gray-900">#' . $order['order_ID'] . '</td>';
        echo '<td class="px-3 py-2 text-sm text-gray-600">' . htmlspecialchars($order['customer_name']) . '</td>';
        echo '<td class="px-3 py-2 text-sm text-gray-500">' . $formatted_date . '</td>';
        echo '<td class="px-3 py-2 text-sm font-medium text-gray-900">' . $amount . '</td>';
        echo '<td class="px-3 py-2">';
        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . $status_bg . ' ' . $status_class . '">' . $order['Status'] . '</span>';
        echo '</td>';
        echo '<td class="px-3 py-2 text-sm flex justify-center space-x-1">';
        echo '<button onclick="openStatusModal(' . $order['order_ID'] . ', \'Confirmed\')" class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs hover:bg-green-200">Confirm</button>';
        echo '<button onclick="openStatusModal(' . $order['order_ID'] . ', \'Delivered\')" class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs hover:bg-blue-200">Deliver</button>';
        echo '<button onclick="openStatusModal(' . $order['order_ID'] . ', \'Completed\')" class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs hover:bg-indigo-200">Complete</button>';
        echo '<button onclick="openStatusModal(' . $order['order_ID'] . ', \'Cancelled\')" class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs hover:bg-red-200">Cancel</button>';
        echo '<button onclick="openStatusModal(' . $order['order_ID'] . ', \'Removed\')" class="px-2 py-1 bg-red-300 text-red-800 rounded text-xs hover:bg-red-400">Remove</button>';
        echo '</td>';
        echo '</tr>';
      }

      echo '</tbody></table></div></div>';
    } else {
      echo '<div class="text-center py-8">';
      echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
      echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />';
      echo '</svg>';
      echo '<p class="text-sm text-gray-500">No active orders found</p>';
      echo '</div>';
    }
    ?>
  </div>
</div>


<!-- Status Update Modal -->
<div id="statusModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg p-6 max-w-md w-full">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Update Order Status</h3>
      <button type="button" onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-500">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="mb-4">
      <p class="text-sm text-gray-500" id="modalContent">Are you sure you want to update this order's status?</p>
    </div>
    <form method="POST" id="statusForm">
      <input type="hidden" name="order_id" id="modal_order_id">
      <input type="hidden" name="new_status" id="modal_new_status">
      <input type="hidden" name="update_status" value="1">
      <div class="mt-5 sm:mt-6 flex justify-end space-x-2">
        <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded hover:bg-gray-200">
          Cancel
        </button>
        <button type="submit" class="px-4 py-2 text-sm text-white bg-indigo-600 rounded hover:bg-indigo-700" id="confirmButton">
          Confirm
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Custom Scrollbar -->
<style>
  .scrollbar-thin::-webkit-scrollbar {
    width: 6px;
  }

  .scrollbar-thin::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }

  .scrollbar-thin::-webkit-scrollbar-thumb {
    background: #d1d1d1;
    border-radius: 10px;
  }

  .scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #b1b1b1;
  }

  .scrollbar-thin {
    scrollbar-width: thin;
    scrollbar-color: #d1d1d1 #f1f1f1;
  }
</style>

<!-- JavaScript Modal Logic -->
<script>
  function openStatusModal(orderId, newStatus) {
    document.getElementById('modal_order_id').value = orderId;
    document.getElementById('modal_new_status').value = newStatus;
    document.getElementById('modalTitle').textContent = 'Update Order #' + orderId + ' Status';

    let message = '';
    let confirmButtonColor = '';
    let confirmButtonText = 'Confirm';

    // Use the same color scheme as defined in the CSS classes
    switch (newStatus) {
      case 'Processing':
        message = 'Are you sure you want to mark this order as Processing?';
        confirmButtonColor = 'bg-yellow-600 hover:bg-yellow-700'; // yellow
        break;
      case 'Confirmed':
        message = 'Are you sure you want to mark this order as Confirmed?';
        confirmButtonColor = 'bg-green-600 hover:bg-green-700'; // green
        break;
      case 'Delivered':
        message = 'Are you sure you want to mark this order as Delivered?';
        confirmButtonColor = 'bg-blue-600 hover:bg-blue-700'; // blue
        break;
      case 'Completed':
        message = 'Are you sure you want to mark this order as Completed?';
        confirmButtonColor = 'bg-green-600 hover:bg-green-700'; // green 
        break;
      case 'Cancelled':
        message = 'Are you sure you want to CANCEL this order? This action cannot be undone.';
        confirmButtonColor = 'bg-red-600 hover:bg-red-700'; // Red 
        confirmButtonText = 'Cancel Order';
        break;
      case 'Removed':
        message = 'WARNING: This will PERMANENTLY DELETE this order from the database. This action cannot be undone.';
        confirmButtonColor = 'bg-red-600 hover:bg-red-700'; // Red 
        confirmButtonText = 'Delete';
        break;
      default:
        message = 'Are you sure you want to update this order\'s status to ' + newStatus + '?';
        confirmButtonColor = 'bg-gray-600 hover:bg-gray-700'; // defl
    }

    document.getElementById('modalContent').textContent = message;


    const confirmButton = document.getElementById('confirmButton');
    confirmButton.className = 'px-4 py-2 text-sm text-white ' + confirmButtonColor + ' rounded';
    confirmButton.textContent = confirmButtonText;

    document.getElementById('statusModal').classList.remove('hidden');
  }

  function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
  }

  window.addEventListener('click', function(event) {
    const modal = document.getElementById('statusModal');
    if (event.target === modal) closeStatusModal();
  });
</script>