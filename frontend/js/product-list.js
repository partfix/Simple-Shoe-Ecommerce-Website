
// Notification handling
document.addEventListener('DOMContentLoaded', function () {
  const notification = document.getElementById('notification');
  if (notification) {
    // Add entrance animation
    notification.classList.add('translate-x-0');
    notification.classList.remove('translate-x-full');

    // Auto-hide after 5 seconds
    setTimeout(() => {
      closeNotification();
    }, 5000);
  }
});

function closeNotification() {
  const notification = document.getElementById('notification');
  if (notification) {
    notification.classList.add('translate-x-full', 'opacity-0');
    notification.style.transition = 'transform 0.5s ease, opacity 0.5s ease';

    setTimeout(() => {
      notification.remove();
      fetch('clear_message.php', {
        method: 'POST'
      });
    }, 500);
  }
}

// Filter toggle functionality
const filterPanel = document.getElementById('filterPanel');
const filterToggle = document.getElementById('filterToggle');
const chevronIcon = filterToggle.querySelector('.fa-chevron-up, .fa-chevron-down');

filterToggle.addEventListener('click', function () {
  filterPanel.classList.toggle('hidden');

  if (filterPanel.classList.contains('hidden')) {
    chevronIcon.classList.replace('fa-chevron-up', 'fa-chevron-down');
  } else {
    chevronIcon.classList.replace('fa-chevron-down', 'fa-chevron-up');
  }
});

// Modal Functions
function openEditModal(shoeId, name, price, brandId, categoryId, color, size, stock, picturePath) {
  document.getElementById('edit_shoe_id').value = shoeId;
  document.getElementById('edit_name').value = name;
  document.getElementById('edit_price').value = price;
  document.getElementById('edit_brand').value = brandId;
  document.getElementById('edit_category').value = categoryId;
  document.getElementById('edit_color').value = color;
  document.getElementById('edit_size').value = size;
  document.getElementById('edit_stock').value = stock;
  document.getElementById('edit_picture').value = picturePath;

  document.getElementById('modalOverlay').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  document.getElementById('modalOverlay').classList.add('hidden');
  document.body.style.overflow = '';
}

// Continue after closeModal() function

// Add event listeners for real-time search feedback
document.addEventListener('DOMContentLoaded', function () {
  // Auto-focus search input when page loads
  const searchInput = document.querySelector('input[name="search"]');
  if (searchInput) {
    searchInput.focus();
  }

  // Set up filter panel toggle state in local storage
  const savedFilterState = localStorage.getItem('filterPanelVisible');
  if (savedFilterState === 'hidden') {
    filterPanel.classList.add('hidden');
    chevronIcon.classList.replace('fa-chevron-up', 'fa-chevron-down');
  }

  // Save filter panel state when toggled
  filterToggle.addEventListener('click', function () {
    const isHidden = filterPanel.classList.contains('hidden');
    localStorage.setItem('filterPanelVisible', isHidden ? '' : 'hidden');
  });

  // Real-time price range validation
  const minPriceInput = document.querySelector('input[name="min_price"]');
  const maxPriceInput = document.querySelector('input[name="max_price"]');

  if (minPriceInput && maxPriceInput) {
    // Ensure min price is not greater than max price
    minPriceInput.addEventListener('change', function () {
      if (maxPriceInput.value && Number(minPriceInput.value) > Number(maxPriceInput.value)) {
        maxPriceInput.value = minPriceInput.value;
      }
    });

    // Ensure max price is not less than min price
    maxPriceInput.addEventListener('change', function () {
      if (minPriceInput.value && Number(maxPriceInput.value) < Number(minPriceInput.value)) {
        minPriceInput.value = maxPriceInput.value;
      }
    });
  }

  // Set up keyboard shortcuts
  document.addEventListener('keydown', function (e) {
    // Press '/' to focus search
    if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
      e.preventDefault();
      searchInput.focus();
    }

    // Press 'Escape' to close modal
    if (e.key === 'Escape') {
      closeModal();
    }
  });

  // Quick filter selection highlighting
  const filterSelects = document.querySelectorAll('#filterPanel select');
  filterSelects.forEach(select => {
    select.addEventListener('change', function () {
      if (this.value) {
        this.classList.add('bg-green-50', 'border-green-200');
      } else {
        this.classList.remove('bg-green-50', 'border-green-200');
      }
    });

    // Apply initial highlighting
    if (select.value) {
      select.classList.add('bg-green-50', 'border-green-200');
    }
  });
});

// Function to clear all filters
function clearAllFilters() {
  window.location.href = window.location.pathname;
}

// Function to add quick filter by brand
function quickFilterByBrand(brandId, brandName) {
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set('brand', brandId);
  window.location.search = urlParams.toString();
}

// Function to add quick filter by category
function quickFilterByCategory(categoryId, categoryName) {
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set('category', categoryId);
  window.location.search = urlParams.toString();
}

// Function to add quick filter by color
function quickFilterByColor(color) {
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set('color', color);
  window.location.search = urlParams.toString();
}

// Function to reset stock quantities when editing
function resetStockField() {
  document.getElementById('edit_stock').value = 0;
}

// Function to preview image in edit modal
function previewImage() {
  const imageUrl = document.getElementById('edit_picture').value;
  const previewElement = document.getElementById('image_preview');

  if (imageUrl && previewElement) {
    previewElement.src = imageUrl;
    previewElement.style.display = 'block';
  } else if (previewElement) {
    previewElement.style.display = 'none';
  }
}
