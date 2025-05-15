<!-- Notif-->
<div id="notification" class="notification <?php echo $success_message ? 'show' : ''; ?> <?php echo $message_type; ?>">
  <?php if ($success_message): ?>
    <div class="notification-content">
      <div class="notification-icon">
        <?php if ($message_type == 'success'): ?>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        <?php else: ?>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        <?php endif; ?>
      </div>
      <div class="notification-message"><?php echo $success_message; ?></div>
    </div>
  <?php endif; ?>
</div>

<!-- err -->
<?php if (isset($error_message)): ?>
  <div class="mx-5 mt-5 bg-red-50 border-l-4 border-red-400 p-4">
    <div class="flex">
      <div class="flex-shrink-0">
        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
      </div>
      <div class="ml-3">
        <p class="text-sm text-red-700"><?php echo $error_message; ?></p>
      </div>
    </div>
  </div>
<?php endif; ?>