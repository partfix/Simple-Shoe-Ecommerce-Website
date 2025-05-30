document.addEventListener('DOMContentLoaded', function () {
  // Debug logging
  console.log('DOM fully loaded');

  // Elements
  const cartButton = document.getElementById('cart-button');
  const cartSidebar = document.getElementById('cart-sidebar');
  const cartOverlay = document.getElementById('cart-overlay');
  const closeCartButton = document.getElementById('close-cart');
  const continueShoppingButton = document.getElementById('continue-shopping');

  const likesButton = document.getElementById('likes-button');
  const likesSidebar = document.getElementById('likes-sidebar');
  const likesOverlay = document.getElementById('likes-overlay');
  const closeLikesButton = document.getElementById('close-likes');
  const continueShoppingLikesButton = document.getElementById('continue-shopping-likes');

  // Cart 
  if (cartButton) {
    cartButton.addEventListener('click', function (e) {
      e.preventDefault();
      openCart();
    });
  }

  function openCart() {
    // Prepare for animation
    cartOverlay.classList.remove('hidden');
    cartOverlay.style.opacity = '0';
    document.body.style.overflow = 'hidden'; // stop scrolling

    // Performance ni
    requestAnimationFrame(() => {
      cartOverlay.style.opacity = '1';
      cartSidebar.style.transform = 'translateX(0)';
    });

    // Update cart UI when opening the cart
    updateCartUI();
  }

  function closeCart() {
    // smoooth ugh close
    cartOverlay.style.opacity = '0';
    cartSidebar.style.transform = 'translateX(100%)';

    // After animation completes, hide overlay
    setTimeout(() => {
      cartOverlay.classList.add('hidden');
      document.body.style.overflow = ''; // Enable scrolling
    }, 300); // Match transition duration
  }

  if (closeCartButton) closeCartButton.addEventListener('click', closeCart);
  if (cartOverlay) cartOverlay.addEventListener('click', closeCart);
  if (continueShoppingButton) continueShoppingButton.addEventListener('click', closeCart);

  // Likes func
  if (likesButton) {
    likesButton.addEventListener('click', function (e) {
      console.log('Likes button clicked');
      e.preventDefault();
      openLikes();
    });
  }

  function openLikes() {
    console.log('Opening likes sidebar');
    // Prepare for animation
    likesOverlay.classList.remove('hidden');
    likesOverlay.style.opacity = '0';
    document.body.style.overflow = 'hidden'; // stop scrolling mf

    // Perform smooth animation
    requestAnimationFrame(() => {
      likesOverlay.style.opacity = '1';
      likesSidebar.style.transform = 'translateX(0)';
    });
  }

  function closeLikes() {
    // Smooth close
    likesOverlay.style.opacity = '0';
    likesSidebar.style.transform = 'translateX(100%)';

    // After animation completes
    setTimeout(() => {
      likesOverlay.classList.add('hidden');
      document.body.style.overflow = ''; // Enable scrolling
    }, 300);
  }

  if (closeLikesButton) closeLikesButton.addEventListener('click', closeLikes);
  if (likesOverlay) likesOverlay.addEventListener('click', closeLikes);
  if (continueShoppingLikesButton) continueShoppingLikesButton.addEventListener('click', closeLikes);

  // Add All To Cart 
  const addAllToCartButton = document.getElementById('add-all-to-cart');
  if (addAllToCartButton) {
    addAllToCartButton.addEventListener('click', function () {
      // Implement your add all to cart functionality here
      console.log('Adding all liked items to cart');
      closeLikes();
      // Wait for likes 
      setTimeout(() => {
        openCart();
      }, 300);
    });
  }

  // Make sure the Cart UI is initialized on page load
  updateCartUI();
});

// Expose these functions to the global scope so they can be called from HTML
window.openCart = openCart;
window.closeCart = closeCart;

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

  // Animate notification in
  setTimeout(() => notification.classList.remove('translate-x-full'), 100);

  // Hide and remove notification after delay
  setTimeout(() => {
    notification.classList.add('translate-x-full');
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300); // Wait for transition to finish
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