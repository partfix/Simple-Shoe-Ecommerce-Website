<!-- Active Orders Panel -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
  <div class="p-5 border-b border-gray-100">
    <h2 class="text-base font-medium text-gray-800">Active Orders</h2>
    <p class="text-xs text-gray-500 mt-1">Recent customer purchases</p>
  </div>

  <div class="p-5">
    <?php
    // Modified query to show most recent orders by order_ID
    // We're getting the most recent status for each order_ID
    // Increased limit to 10 to ensure there's enough content for scrollbar
    $order_query = "SELECT o.order_ID, o.customer_ID, c.name as customer_name, o.Order_Date, o.Total_Amount, o.Status 
                   FROM `order` o
                   JOIN customer c ON o.customer_ID = c.customer_ID
                   GROUP BY o.order_ID
                   ORDER BY o.Order_Date DESC LIMIT 10";
    $order_result = mysqli_query($conn, $order_query);

    if ($order_result && mysqli_num_rows($order_result) > 0) {
      // Added a fixed height container with scrollbar
      echo '<div class="h-64 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">';
      echo '<div class="overflow-x-auto">';
      echo '<table class="min-w-full divide-y divide-gray-200">';
      echo '<thead class="bg-gray-50 sticky top-0">';  // Added sticky header
      echo '<tr>';
      echo '<th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>';
      echo '<th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>';
      echo '<th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>';
      echo '<th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>';
      echo '<th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>';
      echo '<th scope="col" class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody class="bg-white divide-y divide-gray-200">';

      while ($order = mysqli_fetch_assoc($order_result)) {
        // Format the date
        $date = new DateTime($order['Order_Date']);
        $formatted_date = $date->format('M j, Y');

        // Format the amount
        $amount = '₱' . number_format($order['Total_Amount'], 2);

        // Set status class based on status value
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
        echo '<td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">#' . $order['order_ID'] . '</td>';
        echo '<td class="px-3 py-2 whitespace-nowrap text-sm text-gray-600">' . htmlspecialchars($order['customer_name']) . '</td>';
        echo '<td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">' . $formatted_date . '</td>';
        echo '<td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">' . $amount . '</td>';
        echo '<td class="px-3 py-2 whitespace-nowrap">';
        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . $status_bg . ' ' . $status_class . '">' . $order['Status'] . '</span>';
        echo '</td>';
        echo '<td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">';
        echo '<a href="admin.orders.php?id=' . $order['order_ID'] . '" class="text-indigo-600 hover:text-indigo-900">View</a>';
        echo '</td>';
        echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
      echo '</div>';
      echo '</div>'; // Close the scrollable container
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

  <!-- Show View All Orders link if there are orders -->
  <?php if (isset($order_result) && mysqli_num_rows($order_result) > 0): ?>
    <div class="px-5 py-3 bg-gray-50 text-right">
      <a href="/pages/admin.orders.php" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
        View all orders <span aria-hidden="true">&rarr;</span>
      </a>
    </div>
  <?php endif; ?>
</div>

<!-- Add custom scrollbar styling if not already added elsewhere -->
<style>
  /* Webkit (Chrome, Safari, newer versions of Opera) */
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

  /* Firefox */
  .scrollbar-thin {
    scrollbar-width: thin;
    scrollbar-color: #d1d1d1 #f1f1f1;
  }
</style>