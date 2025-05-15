<?php
$status_query = "SELECT Status, COUNT(*) as count FROM `order` GROUP BY Status";
$status_result = mysqli_query($conn, $status_query);


$all_statuses = [
  'Processing' => ['bg-yellow-100', 'text-yellow-800'],
  'Confirmed' => ['bg-green-100', 'text-green-800'],
  'Delivered' => ['bg-blue-100', 'text-blue-800'],
  'Cancelled' => ['bg-red-100', 'text-red-800'],
  'Completed' => ['bg-indigo-100', 'text-indigo-800'],
];

// Initialize counts 
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

// Calculate revenue from confirmed and completed orders
$revenue_query = "SELECT SUM(Total_Amount) as total_revenue FROM `order` WHERE Status IN ('Confirmed', 'Delivered', 'Completed')";
$revenue_result = mysqli_query($conn, $revenue_query);
$total_revenue = 0;
if ($revenue_result && mysqli_num_rows($revenue_result) > 0) {
  $revenue_row = mysqli_fetch_assoc($revenue_result);
  $total_revenue = $revenue_row['total_revenue'] ?: 0;
}

// Calculate fulfillment rate
$fulfilled = $status_counts['Delivered'] + $status_counts['Completed'];
$fulfillment_rate = $total_orders > 0 ? round(($fulfilled / $total_orders) * 100) : 0;

// Calculate average order value
$avg_order_value = $total_orders > 0 ? ($total_revenue / $total_orders) : 0;

// Fetch recent orders for activity display - moved to top of file
$recent_orders_query = "SELECT Status, DATE_FORMAT(Order_Date, '%Y-%m-%d %H:%i:%s') as Order_Date, Total_Amount 
                        FROM `order` 
                        ORDER BY Order_Date DESC 
                        LIMIT 10";
$recent_orders_result = mysqli_query($conn, $recent_orders_query);
?>

<!-- Detailed Analytics Section -->
<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden my-4">
  <div class="p-5 border-b border-gray-100">
    <h2 class="text-base font-medium text-gray-800">Order Analytics Dashboard</h2>
    <p class="text-xs text-gray-500 mt-1">Comprehensive order metrics and trends</p>
  </div>

  <div class="p-4 sm:p-5 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
    <!-- MOVED SECTION: Recent Order Activity Now On Left Side -->
    <div class="space-y-4">
      <h3 class="text-sm font-medium text-gray-700">Recent Order Activity</h3>

      <!-- Summary metrics for left side -->
      <div class="grid grid-cols-2 gap-4 mb-4">
        <!-- Total Orders -->
        <div class="bg-gray-50 rounded-lg p-3 sm:p-4">
          <p class="text-xs text-gray-500 mb-1">Total Orders</p>
          <p class="text-xl font-semibold text-gray-900"><?php echo number_format($total_orders); ?></p>
        </div>

        <!-- Fulfillment Rate -->
        <div class="bg-gray-50 rounded-lg p-3 sm:p-4">
          <p class="text-xs text-gray-500 mb-1">Fulfillment Rate</p>
          <p class="text-xl font-semibold text-gray-900"><?php echo $fulfillment_rate; ?>%</p>
        </div>
      </div>

      <!-- Recent Orders Activity with scrollbar -->
      <?php if ($recent_orders_result && mysqli_num_rows($recent_orders_result) > 0): ?>
        <div class="mt-4">
          <p class="text-xs text-gray-500 mb-2">Latest Transactions</p>
          <!-- Added fixed height container with overflow-y-auto for scrollbar -->
          <div class="h-96 overflow-y-auto pr-1 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
            <div class="space-y-2">
              <?php while ($order = mysqli_fetch_assoc($recent_orders_result)): ?>
                <?php
                $status = $order['Status'];
                $status_class = isset($all_statuses[$status]) ? $all_statuses[$status][0] . ' ' . $all_statuses[$status][1] : 'bg-gray-100 text-gray-800';
                $date = date('M d, H:i', strtotime($order['Order_Date']));
                ?>
                <div class="flex justify-between items-center py-1.5 px-2 rounded-md bg-gray-50">
                  <div class="flex items-center">
                    <span class="text-xs px-1.5 py-0.5 rounded-full <?php echo $status_class; ?>"><?php echo $status; ?></span>
                    <span class="text-xs text-gray-500 ml-2"><?php echo $date; ?></span>
                  </div>
                  <span class="text-xs font-medium text-gray-700">₱<?php echo number_format($order['Total_Amount'], 2); ?></span>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="mt-4">
          <p class="text-xs text-gray-500 mb-2">Latest Transactions</p>
          <p class="text-xs text-gray-400 italic">No recent order activity available</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- Right Side Section: Revenue Insights and Order Status -->
    <div class="space-y-6">
      <!-- Revenue Insights Section -->
      <div class="space-y-4">
        <h3 class="text-sm font-medium text-gray-700">Revenue Insights</h3>

        <div class="grid grid-cols-2 gap-4">
          <!-- Total Revenue -->
          <div class="bg-gray-50 rounded-lg p-3 sm:p-4">
            <p class="text-xs text-gray-500 mb-1">Total Revenue</p>
            <p class="text-xl font-semibold text-gray-900">₱<?php echo number_format($total_revenue, 2); ?></p>
          </div>

          <!-- Average Order Value -->
          <div class="bg-gray-50 rounded-lg p-3 sm:p-4">
            <p class="text-xs text-gray-500 mb-1">Avg Order Value</p>
            <p class="text-xl font-semibold text-gray-900">₱<?php echo number_format($avg_order_value, 2); ?></p>
          </div>
        </div>
      </div>

      <!-- Order Status Breakdown -->
      <div class="space-y-4">
        <h3 class="text-sm font-medium text-gray-700">Order Status Breakdown</h3>

        <!-- Order status breakdown - enhanced version -->
        <div class="space-y-3">
          <p class="text-xs text-gray-500 mb-1">Status Distribution</p>

          <?php foreach ($status_counts as $status => $count):
            if (array_key_exists($status, $all_statuses)):
              $percentage = $total_orders > 0 ? round(($count / $total_orders) * 100) : 0;
              $bg_class = $all_statuses[$status][0];
              $text_class = $all_statuses[$status][1];
          ?>
              <div class="mb-2">
                <div class="flex justify-between items-center mb-1">
                  <div class="flex items-center">
                    <span class="inline-block w-2 h-2 rounded-full mr-2 <?php echo $bg_class; ?>"></span>
                    <span class="text-xs text-gray-600"><?php echo $status; ?></span>
                  </div>
                  <div class="flex items-center">
                    <span class="text-xs text-gray-500 mr-2"><?php echo $percentage; ?>%</span>
                    <span class="text-xs font-medium <?php echo $text_class; ?> px-2 py-0.5 rounded-full <?php echo $bg_class; ?>"><?php echo $count; ?></span>
                  </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                  <div class="<?php echo $bg_class; ?> h-1.5 rounded-full" style="width: <?php echo $percentage; ?>%"></div>
                </div>
              </div>
          <?php endif;
          endforeach; ?>
        </div>

        <!-- Monthly Revenue Trend (moved under status distribution) -->
        <?php
        // Monthly revenue trend (last 6 months) - safe from ONLY_FULL_GROUP_BY issues
        $monthly_revenue_query = "SELECT 
          DATE_FORMAT(Order_Date, '%b %Y') as month,
          SUM(Total_Amount) as revenue,
          MIN(DATE_FORMAT(Order_Date, '%Y-%m')) as month_sort
        FROM `order` 
        WHERE Status IN ('Confirmed', 'Delivered', 'Completed')
          AND Order_Date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
        GROUP BY DATE_FORMAT(Order_Date, '%b %Y')
        ORDER BY month_sort DESC
        LIMIT 6";

        $monthly_revenue_result = mysqli_query($conn, $monthly_revenue_query);
        $monthly_data = [];
        $max_revenue = 0;

        if ($monthly_revenue_result && mysqli_num_rows($monthly_revenue_result) > 0) {
          while ($row = mysqli_fetch_assoc($monthly_revenue_result)) {
            $monthly_data[] = $row;
            if ($row['revenue'] > $max_revenue) {
              $max_revenue = $row['revenue'];
            }
          }
        }

        if (!empty($monthly_data)): ?>
          <div class="mt-5">
            <p class="text-xs text-gray-500 mb-2">Revenue Trend (Last 6 Months)</p>
            <div class="space-y-2">
              <?php foreach (array_reverse($monthly_data) as $row):
                $percentage = $max_revenue > 0 ? round(($row['revenue'] / $max_revenue) * 100) : 0;
              ?>
                <div class="flex items-center">
                  <span class="text-xs text-gray-600 w-16"><?php echo $row['month']; ?></span>
                  <div class="flex-grow ml-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                      <div class="bg-blue-500 h-2 rounded-full" style="width: <?php echo $percentage; ?>%"></div>
                    </div>
                  </div>
                  <span class="text-xs text-gray-600 ml-2 w-16 text-right">₱<?php echo number_format($row['revenue'], 0); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php else: ?>
          <div class="mt-5">
            <p class="text-xs text-gray-500 mb-2">Revenue Trend (Last 6 Months)</p>
            <p class="text-xs text-gray-400 italic">No revenue data available for the last 6 months</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- Add custom scrollbar styling -->
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