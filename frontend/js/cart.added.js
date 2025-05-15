// This file extends cart.components.js with the addToCart functionality

/**
 * Add item to cart function
 * @param {number} productId - The ID of the shoe to add to cart
 */
function addToCart(productId) {
  // Get existing cart from localStorage or create a new one
  let cart = JSON.parse(localStorage.getItem('soleStyleCart')) || [];

  // Find if the product is already in the cart
  const existingItemIndex = cart.findIndex(item => item.id === productId);

  if (existingItemIndex !== -1) {
    // Product already in cart, increase quantity
    cart[existingItemIndex].quantity += 1;
  } else {
    // Fetch product info from the page
    // Get the parent element of the clicked button to extract product details
    // This is a direct DOM approach but for production an API call would be better
    const productElement = event.target.closest('.bg-white');

    if (productElement) {
      const name = productElement.querySelector('h3').textContent.trim();
      const price = parseFloat(productElement.querySelector('.text-xl').textContent.replace('₱', '').replace(',', ''));
      const size = productElement.querySelector('.text-sm').textContent.split('|')[0].trim();
      const color = productElement.querySelector('.text-sm').textContent.split('|')[1].trim();
      const imageUrl = productElement.querySelector('img').src;

      // Add new item to cart
      cart.push({
        id: productId,
        name: name,
        price: price,
        size: size,
        color: color,
        imageUrl: imageUrl,
        quantity: 1
      });
    }
  }

  // Save updated cart to localStorage
  localStorage.setItem('soleStyleCart', JSON.stringify(cart));

  // Show notification
  showCartNotification();

  // Update cart UI
  updateCartUI();

  // Optional: Open cart after adding item
  openCart();
}

/**
 * Show a brief notification when item is added to cart
 */
function showCartNotification() {
  // Create notification element if it doesn't exist
  let notification = document.getElementById('cart-notification');

  if (!notification) {
    notification = document.createElement('div');
    notification.id = 'cart-notification';
    notification.className = 'fixed top-24 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg transform transition-all duration-300 translate-x-full';
    document.body.appendChild(notification);
  }

  // Set notification content
  notification.textContent = 'Item added to cart!';

  // Animate notification
  setTimeout(() => notification.classList.remove('translate-x-full'), 100);

  // Hide notification after delay
  setTimeout(() => {
    notification.classList.add('translate-x-full');
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300); // Wait for transition to finish before removing
  }, 3000);
}

/**
 * Update the cart UI with the current items
 */
function updateCartUI() {
  const cartItemsContainer = document.getElementById('cart-items-container');
  const emptyCart = document.getElementById('empty-cart');
  const cartSubtotal = document.getElementById('cart-subtotal');
  const checkoutButton = document.getElementById('checkout-button');

  if (!cartItemsContainer) return;

  // Get cart from localStorage
  const cart = JSON.parse(localStorage.getItem('soleStyleCart')) || [];

  // Clear existing cart items (except empty cart message)
  Array.from(cartItemsContainer.children).forEach(child => {
    if (child.id !== 'empty-cart') {
      child.remove();
    }
  });

  // Show/hide empty cart message
  if (cart.length === 0) {
    if (emptyCart) emptyCart.classList.remove('hidden');
    if (checkoutButton) checkoutButton.classList.add('opacity-50', 'cursor-not-allowed');
  } else {
    if (emptyCart) emptyCart.classList.add('hidden');
    if (checkoutButton) checkoutButton.classList.remove('opacity-50', 'cursor-not-allowed');

    // Add each item to the cart UI
    cart.forEach((item, index) => {
      const itemElement = document.createElement('div');
      itemElement.className = 'flex border-b border-gray-200 pb-4 last:border-0';
      itemElement.innerHTML = `
        <div class="w-20 h-20 mr-4 flex-shrink-0 bg-gray-100 rounded overflow-hidden">
          <img src="${item.imageUrl}" alt="${item.name}" class="w-full h-full object-cover">
        </div>
        <div class="flex-grow">
          <h4 class="text-gray-800 font-medium">${item.name}</h4>
          <div class="text-sm text-gray-600 mb-1">${item.size} | ${item.color}</div>
          <div class="flex justify-between items-center">
            <div class="text-gray-800 font-medium">₱${item.price.toFixed(2)}</div>
            <div class="flex items-center border rounded">
              <button class="px-2 py-1 text-gray-600 hover:bg-gray-100" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
              <span class="px-2 py-1">${item.quantity}</span>
              <button class="px-2 py-1 text-gray-600 hover:bg-gray-100" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
            </div>
          </div>
        </div>
        <button class="ml-2 text-gray-400 hover:text-red-500" onclick="removeFromCart(${item.id})">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      `;

      cartItemsContainer.appendChild(itemElement);
    });
  }

  // Update cart subtotal
  const subtotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
  if (cartSubtotal) cartSubtotal.textContent = `₱${subtotal.toFixed(2)}`;

  // Update cart count badge
  updateCartBadge();
}

/**
 * Update quantity of an item in the cart
 * @param {number} productId - The ID of the product to update
 * @param {number} newQuantity - The new quantity to set
 */
function updateQuantity(productId, newQuantity) {
  // Get cart from localStorage
  let cart = JSON.parse(localStorage.getItem('soleStyleCart')) || [];

  if (newQuantity <= 0) {
    // Remove item if quantity is 0 or less
    removeFromCart(productId);
  } else {
    // Update quantity
    const itemIndex = cart.findIndex(item => item.id === productId);
    if (itemIndex !== -1) {
      cart[itemIndex].quantity = newQuantity;

      // Save updated cart
      localStorage.setItem('soleStyleCart', JSON.stringify(cart));

      // Update UI
      updateCartUI();
    }
  }
}

/**
 * Remove an item from the cart
 * @param {number} productId - The ID of the product to remove
 */
function removeFromCart(productId) {
  // Get cart from localStorage
  let cart = JSON.parse(localStorage.getItem('soleStyleCart')) || [];

  // Filter out the item to remove
  cart = cart.filter(item => item.id !== productId);

  // Save updated cart
  localStorage.setItem('soleStyleCart', JSON.stringify(cart));

  // Update UI
  updateCartUI();
}

/**
 * Update the cart badge with the current number of items
 */
function updateCartBadge() {
  const cart = JSON.parse(localStorage.getItem('soleStyleCart')) || [];
  const totalItems = cart.reduce((total, item) => total + item.quantity, 0);

  // Get or create cart badge
  let cartBadge = document.getElementById('cart-badge');
  const cartButton = document.getElementById('cart-button');

  if (!cartBadge && cartButton) {
    cartBadge = document.createElement('span');
    cartBadge.id = 'cart-badge';
    cartBadge.className = 'absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold';
    cartButton.appendChild(cartBadge);
  }

  if (cartBadge) {
    if (totalItems > 0) {
      cartBadge.textContent = totalItems;
      cartBadge.classList.remove('hidden');
    } else {
      cartBadge.classList.add('hidden');
    }
  }
}

// Initialize cart UI when page loads
document.addEventListener('DOMContentLoaded', function () {
  // Update cart UI on page load
  updateCartUI();

  // Make sure the cart button has the correct position style
  const cartButton = document.getElementById('cart-button');
  if (cartButton && !cartButton.classList.contains('relative')) {
    cartButton.classList.add('relative');
  }
});