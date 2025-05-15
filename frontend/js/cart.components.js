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
});