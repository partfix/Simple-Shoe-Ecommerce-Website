<?php
// Get the product from db
$product_query = "SELECT COUNT(*) as count FROM shoe";
$product_result = $conn->query($product_query);
$product_count = 0;

if ($product_result && $product_result->num_rows > 0) {
  $row = $product_result->fetch_assoc();
  $product_count = $row['count'];
}
?>
<!-- Users Card -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
  <div class="p-5">
    <div class="flex items-center justify-between mb-1">
      <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Users</p>
      <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
          <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
        </svg>
      </span>
    </div>
    <div class="mt-2">
      <h3 class="text-2xl font-semibold text-gray-800"><?php echo $user_count; ?></h3>
      <p class="text-xs text-gray-500 mt-1">Total registered users</p>
    </div>
  </div>
</div>

<!-- Orders Card -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
  <div class="p-5">
    <div class="flex items-center justify-between mb-1">
      <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Orders</p>
      <span class="flex items-center justify-center w-8 h-8 rounded-full bg-green-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" viewBox="0 0 20 20" fill="currentColor">
          <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
        </svg>
      </span>
    </div>
    <div class="mt-2">
      <?php
      // Get total number of orders
      $order_count_query = "SELECT COUNT(*) as count FROM `order`";
      $order_count_result = $conn->query($order_count_query);
      $order_count = 0;

      if ($order_count_result && $order_count_result->num_rows > 0) {
        $row = $order_count_result->fetch_assoc();
        $order_count = $row['count'];
      }
      ?>
      <h3 class="text-2xl font-semibold text-gray-800"><?php echo $order_count; ?></h3>
      <p class="text-xs text-gray-500 mt-1">Total orders placed</p>
    </div>
  </div>
</div>

<!-- Products Card -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
  <div class="p-5">
    <div class="flex items-center justify-between mb-1">
      <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Products</p>
      <span class="flex items-center justify-center w-8 h-8 rounded-full bg-purple-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
          <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
          <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
      </span>
    </div>
    <div class="mt-2">
      <h3 class="text-2xl font-semibold text-gray-800"><?php echo $product_count; ?></h3>
      <p class="text-xs text-gray-500 mt-1">Available products</p>
    </div>
  </div>
</div>

<!-- Revenue Card -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
  <div class="p-5">
    <div class="flex items-center justify-between mb-1">
      <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</p>
      <span class="flex items-center justify-center w-8 h-8 rounded-full bg-indigo-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
          <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
        </svg>
      </span>
    </div>


    <div class="flex items-center mt-1 mb-2">
      <div class="flex text-xs space-x-4 text-gray-400">
        <span id="period_all_time" class="cursor-pointer hover:text-indigo-500 transition-colors duration-150" onclick="updateRevenueDisplay('all_time')">All</span>
        <span id="period_current_month" class="cursor-pointer text-indigo-500 border-b border-indigo-500 pb-0.5 transition-colors duration-150" onclick="updateRevenueDisplay('current_month')">Month</span>
        <span id="period_last_month" class="cursor-pointer hover:text-indigo-500 transition-colors duration-150" onclick="updateRevenueDisplay('last_month')">Last</span>
        <span id="period_last_3_months" class="cursor-pointer hover:text-indigo-500 transition-colors duration-150" onclick="updateRevenueDisplay('last_3_months')">3M</span>
        <span id="period_last_6_months" class="cursor-pointer hover:text-indigo-500 transition-colors duration-150" onclick="updateRevenueDisplay('last_6_months')">6M</span>
      </div>
    </div>

    <div class="mt-2">
      <?php
      // Function to get revenue 
      function getRevenue($conn, $period)
      {
        // Only count completed orders
        $where_clause = " WHERE Status = 'Completed'";

        // Add date 
        if ($period == 'current_month') {
          $where_clause .= " AND YEAR(Order_Date) = YEAR(CURRENT_DATE()) AND MONTH(Order_Date) = MONTH(CURRENT_DATE())";
        } elseif ($period == 'last_month') {
          $where_clause .= " AND YEAR(Order_Date) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)) 
                               AND MONTH(Order_Date) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))";
        } elseif ($period == 'last_3_months') {
          $where_clause .= " AND Order_Date >= DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH)";
        } elseif ($period == 'last_6_months') {
          $where_clause .= " AND Order_Date >= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH)";
        }


        //  query
        $revenue_query = "SELECT SUM(Total_Amount) as total_revenue FROM `order`" . $where_clause;

        $revenue_result = $conn->query($revenue_query);
        $total_revenue = 0;

        if ($revenue_result && $revenue_result->num_rows > 0) {
          $row = $revenue_result->fetch_assoc();
          $total_revenue = $row['total_revenue'] ? $row['total_revenue'] : 0;
        }

        return $total_revenue;
      }


      $all_time_revenue = getRevenue($conn, 'all_time');
      $current_month_revenue = getRevenue($conn, 'current_month');
      $last_month_revenue = getRevenue($conn, 'last_month');
      $last_3_months_revenue = getRevenue($conn, 'last_3_months');
      $last_6_months_revenue = getRevenue($conn, 'last_6_months');
      ?>


      <div id="all_time_revenue" class="hidden">
        <h3 class="text-2xl font-semibold text-gray-800">₱<?php echo number_format($all_time_revenue, 2); ?></h3>
        <p class="text-xs text-gray-500 mt-1">All time revenue</p>
      </div>

      <div id="current_month_revenue">
        <h3 class="text-2xl font-semibold text-gray-800">₱<?php echo number_format($current_month_revenue, 2); ?></h3>
        <p class="text-xs text-gray-500 mt-1">Current month revenue</p>
      </div>

      <div id="last_month_revenue" class="hidden">
        <h3 class="text-2xl font-semibold text-gray-800">₱<?php echo number_format($last_month_revenue, 2); ?></h3>
        <p class="text-xs text-gray-500 mt-1">Last month revenue</p>
      </div>

      <div id="last_3_months_revenue" class="hidden">
        <h3 class="text-2xl font-semibold text-gray-800">₱<?php echo number_format($last_3_months_revenue, 2); ?></h3>
        <p class="text-xs text-gray-500 mt-1">Last 3 months revenue</p>
      </div>

      <div id="last_6_months_revenue" class="hidden">
        <h3 class="text-2xl font-semibold text-gray-800">₱<?php echo number_format($last_6_months_revenue, 2); ?></h3>
        <p class="text-xs text-gray-500 mt-1">Last 6 months revenue</p>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript to handle the toggle -->
<script>
  function updateRevenueDisplay(period) {
    // If period is not passed, default to current_month
    if (!period) period = 'current_month';

    // Hide all revenue displays
    document.getElementById('all_time_revenue').classList.add('hidden');
    document.getElementById('current_month_revenue').classList.add('hidden');
    document.getElementById('last_month_revenue').classList.add('hidden');
    document.getElementById('last_3_months_revenue').classList.add('hidden');
    document.getElementById('last_6_months_revenue').classList.add('hidden');

    // Reset all toggle button styles
    document.querySelectorAll('[id^="period_"]').forEach(el => {
      el.classList.remove('text-indigo-500', 'border-b', 'border-indigo-500', 'pb-0.5');
      el.classList.add('text-gray-400', 'hover:text-indigo-500');
    });

    // Style active toggle and show the selected period
    document.getElementById('period_' + period).classList.add('text-indigo-500', 'border-b', 'border-indigo-500', 'pb-0.5');
    document.getElementById('period_' + period).classList.remove('text-gray-400', 'hover:text-indigo-500');
    document.getElementById(period + '_revenue').classList.remove('hidden');
  }

  // Initialize with current month selected
  document.addEventListener('DOMContentLoaded', function() {
    updateRevenueDisplay('current_month');
  });
</script>