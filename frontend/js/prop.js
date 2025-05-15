document.addEventListener('DOMContentLoaded', function () {
  // Form toggle functionality
  const showAddFormBtn = document.getElementById('showAddForm');
  const addUserForm = document.getElementById('addUserForm');
  const cancelFormBtn = document.getElementById('cancelForm');

  if (showAddFormBtn && addUserForm && cancelFormBtn) {
    showAddFormBtn.addEventListener('click', function () {
      addUserForm.classList.remove('hidden');
    });

    cancelFormBtn.addEventListener('click', function () {
      // If we're in edit mode, redirect back to the main page
      const editMode = document.querySelector('input[name="user_id"]');
      if (editMode) {
        window.location.href = 'admin.dashboard.php';
      } else {
        addUserForm.classList.add('hidden');
      }
    });
  }

  // Password confirmation validation
  const passwordField = document.getElementById('password');
  const confirmPasswordField = document.getElementById('confirm_password');

  if (passwordField && confirmPasswordField) {
    confirmPasswordField.addEventListener('input', function () {
      if (passwordField.value !== confirmPasswordField.value) {
        confirmPasswordField.setCustomValidity("Passwords don't match");
      } else {
        confirmPasswordField.setCustomValidity('');
      }
    });

    passwordField.addEventListener('input', function () {
      if (passwordField.value !== confirmPasswordField.value) {
        confirmPasswordField.setCustomValidity("Passwords don't match");
      } else {
        confirmPasswordField.setCustomValidity('');
      }
    });
  }

  // Notification system
  const notification = document.getElementById('notification');

  if (notification && notification.classList.contains('show')) {
    // Auto hide notification after 5 seconds
    setTimeout(function () {
      notification.classList.remove('show');
    }, 5000);

    // Allow clicking on notification to dismiss it
    notification.addEventListener('click', function () {
      notification.classList.remove('show');
    });
  }

  // Confirm delete action
  const deleteLinks = document.querySelectorAll('a[href*="delete"]');

  deleteLinks.forEach(function (link) {
    link.addEventListener('click', function (event) {
      const confirmed = confirm('Are you sure you want to delete this user?');
      if (!confirmed) {
        event.preventDefault();
      }
    });
  });

  // Form validation
  const forms = document.querySelectorAll('form');

  forms.forEach(function (form) {
    form.addEventListener('submit', function (event) {
      const requiredFields = form.querySelectorAll('[required]');
      let valid = true;

      requiredFields.forEach(function (field) {
        if (!field.value.trim()) {
          field.classList.add('border-red-500');
          valid = false;
        } else {
          field.classList.remove('border-red-500');
        }
      });

      if (!valid) {
        event.preventDefault();
        showNotification('Please fill in all required fields', 'error');
      }
    });
  });
});

// Helper function to show notifications programmatically
function showNotification(message, type = 'success') {
  // Create notification if it doesn't exist
  let notification = document.getElementById('notification');

  if (!notification) {
    notification = document.createElement('div');
    notification.id = 'notification';
    notification.className = 'notification';
    document.body.appendChild(notification);
  }

  // Set notification content
  notification.innerHTML = `
    <div class="notification-content">
      <div class="notification-icon">
        ${type === 'success'
      ? '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>'
      : '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>'}
      </div>
      <div class="notification-message">${message}</div>
    </div>
  `;

  // Set type class and show notification
  notification.className = 'notification show ' + type;

  // Auto hide after 5 seconds
  setTimeout(function () {
    notification.classList.remove('show');
  }, 5000);
}