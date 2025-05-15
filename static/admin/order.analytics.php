<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">

  <div class="p-4 border-b border-gray-100 flex justify-between items-center cursor-pointer" onclick="toggleOrderAnalytics()">
    <div>
      <h2 class="text-base font-medium text-gray-800">Order Analytics</h2>
      <p class="text-xs text-gray-500 mt-1">Overview of order status</p>
    </div>
    <button class="text-gray-500 hover:text-gray-700 focus:outline-none transition-transform duration-300" id="analytics-toggle-btn">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-300" id="analytics-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>
  </div>

  <!-- Collapsible Content with smooth transition -->
  <div class="transition-all duration-300 max-h-0 overflow-hidden" id="analytics-content">
    <!-- Summary Section -->
    <div class="p-5">
      <?php
      // Get order status counts
      $status_query = "SELECT Status, COUNT(*) as count FROM `order` GROUP BY Status";
      $status_result = mysqli_query($conn, $status_query);

      // Define all possible statuses and colors - ONLY INCLUDING Processing and Completed
      $all_statuses = [
        'Processing' => ['bg-yellow-100', 'text-yellow-800'],
        'Completed' => ['bg-indigo-100', 'text-indigo-800'],
      ];

      // Initialize counts array with zeros
      $status_counts = array_fill_keys(array_keys($all_statuses), 0);

      // Get total number of orders
      $total_query = "SELECT COUNT(*) as total FROM `order`";
      $total_result = mysqli_query($conn, $total_query);
      $total_orders = 0;
      if ($total_result && mysqli_num_rows($total_result) > 0) {
        $total_row = mysqli_fetch_assoc($total_result);
        $total_orders = $total_row['total'];
      }

      // Fill in actual counts from database
      if ($status_result && mysqli_num_rows($status_result) > 0) {
        while ($status = mysqli_fetch_assoc($status_result)) {
          if (isset($status_counts[$status['Status']])) {
            $status_counts[$status['Status']] = $status['count'];
          }
        }
      }

      // Calculate revenue from processing and completed orders (modified to exclude confirmed, delivered)
      $revenue_query = "SELECT SUM(Total_Amount) as total_revenue FROM `order` WHERE Status IN ('Processing', 'Completed')";
      $revenue_result = mysqli_query($conn, $revenue_query);
      $total_revenue = 0;
      if ($revenue_result && mysqli_num_rows($revenue_result) > 0) {
        $revenue_row = mysqli_fetch_assoc($revenue_result);
        $total_revenue = $revenue_row['total_revenue'] ?: 0;
      }

      // Calculate fulfillment rate - now only based on Completed
      $fulfilled = $status_counts['Completed'];
      $fulfillment_rate = $total_orders > 0 ? round(($fulfilled / $total_orders) * 100) : 0;

      // Calculate average order value
      $avg_order_value = $total_orders > 0 ? ($total_revenue / $total_orders) : 0;

      // Display content to fill same space as before
      echo '<div class="space-y-4">';

      // Show total revenue
      echo '<div class="mb-4">';
      echo '<p class="text-sm text-gray-500 mb-1">Total Revenue</p>';
      echo '<p class="text-2xl font-semibold text-gray-900">₱' . number_format($total_revenue, 2) . '</p>';
      echo '</div>';

      // Show order status breakdown - only Processing and Completed
      echo '<div>';
      echo '<p class="text-sm text-gray-500 mb-2">Order Status</p>';
      foreach ($status_counts as $status => $count) {
        if (array_key_exists($status, $all_statuses)) {
          $percentage = $total_orders > 0 ? round(($count / $total_orders) * 100) : 0;
          $bg_class = $all_statuses[$status][0];
          $text_class = $all_statuses[$status][1];
          echo '<div class="mb-2">';
          echo '<div class="flex justify-between items-center mb-1">';
          echo '<div class="flex items-center">';
          echo '<span class="inline-block w-3 h-3 rounded-full mr-2 ' . $bg_class . '"></span>';
          echo '<span class="text-sm text-gray-600">' . $status . '</span>';
          echo '</div>';
          echo '<span class="text-sm font-medium ' . $text_class . '">' . $count . '</span>';
          echo '</div>';
          echo '<div class="w-full bg-gray-200 rounded-full h-2">';
          echo '<div class="' . $bg_class . ' h-2 rounded-full" style="width: ' . $percentage . '%"></div>';
          echo '</div>';
          echo '</div>';
        }
      }
      echo '</div>';
      echo '</div>';
      ?>
    </div>

    <!-- Link to Detailed Reports with smooth hover effect -->
    <div class="px-5 py-3 bg-gray-50 text-right border-t border-gray-100">
      <a href="/pages/admin.analytics.php#analytics-dashboard" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-300 inline-flex items-center group focus:outline-none">
        View detailed reports
        <span aria-hidden="true" class="ml-1 transform transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
      </a>
    </div>
  </div>
</div>

<!-- JavaScript for smooth toggle functionality -->
<script>
  function toggleOrderAnalytics() {
    const content = document.getElementById('analytics-content');
    const chevron = document.getElementById('analytics-chevron');

    // Toggle the rotation of the chevron
    if (content.classList.contains('max-h-0')) {
      // Open the panel - set a specific max height that's larger than the content
      chevron.classList.add('rotate-180');
      content.classList.remove('max-h-0');
      content.classList.add('max-h-96'); // Adjust max-height as needed for your content
    } else {
      // Close the panel
      chevron.classList.remove('rotate-180');
      content.classList.remove('max-h-96');
      content.classList.add('max-h-0');
    }
  }

  // Initialize the panel state on page load (optional)
  document.addEventListener('DOMContentLoaded', function() {
    const content = document.getElementById('analytics-content');
    // Ensure it starts collapsed
    if (!content.classList.contains('max-h-0')) {
      content.classList.add('max-h-0');
    }
  });
</script>