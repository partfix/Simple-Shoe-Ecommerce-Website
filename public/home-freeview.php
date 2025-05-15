<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SoleStyle-home</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@heroicons/react@2.0.18/dist/heroicons.min.js"></script>
  <link rel="stylesheet" href="../frontend/css/style.css">
</head>

<body class="bg-gray-100 font-sans">
  <!-- Nav -->
  <nav class="bg-amber-00 bg-opacity-50 backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-4">
      <div class="flex items-center">
        <span class="text-xl font-bold text-gray-900">SoleStyle</span>
      </div>

      <div class="md:hidden">
        <button id="menu-btn" class="text-gray-600 hover:text-gray-900 focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
      </div>

      <div id="nav-links"
        class="hidden md:flex md:space-x-3 absolute top-full left-0 w-full shadow-md md:static md:shadow-none md:w-auto">
        <a href="#" class="block py-2 px-3 text-gray-600 hover:text-gray-900">Home</a>
        <a href="../log/user/login.user.php" class="block py-2 px-3 text-gray-600 hover:text-gray-900">Shop</a>

        <div class="relative group">
          <a href="../log/user/login.user.php" class="block py-2 px-3 text-gray-600 hover:text-gray-900 flex items-center">
            Products
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7"></path>
            </svg>
          </a>
          <div
            class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-1 z-10 w-40">
            <a href="../log/user/login.user.php" class="block px-4 py-2 text-gray-600 hover:bg-red-200">Running Shoe</a>
            <a href="../log/user/login.user.php" class="block px-4 py-2 text-gray-600 hover:bg-red-200">Sneakers</a>
            <a href="../log/user/login.user.php" class="block px-4 py-2 text-gray-600 hover:bg-red-200">New Arrival</a>
          </div>
        </div>

        <a href="../log/user/login.user.php" class="block py-2 px-3 text-gray-600 hover:text-gray-900 flex items-center gap-2">
          <img src="/asset/philippines.png" alt="Philippine Flag" class="w-5 h-5">
          Contact
        </a>

      </div>

      <div class="hidden md:flex items-center space-x-3">
        <div class="flex items-center space-x-2">
          <a href="../log/user/login.user.php" class="text-white-900 border border-orange-600 hover:bg-orange-50 px-3 py-1 rounded">Login</a>
          <a href="../log/user/register.user.php" class="bg-orange-600 text-white hover:bg-orange-700 px-3 py-1 rounded">Sign Up</a>
        </div>
        <a href="../log/user/login.user.php" class="text-gray-600 hover:text-gray-900">
          <img src="../asset/user.png" alt="user icon" class="w-6 h-6">
        </a>
        <a href="../log/user/login.user.php" class="text-gray-600 hover:text-gray-900">
          <img src="../asset/favorite.png" alt="favorite icon" class="w-6 h-6">
        </a>
        <a href="../log/user/login.user.php" class="text-gray-600 hover:text-gray-900">
          <img src="../asset/add-to-basket.png" alt="cart icon" class="w-6 h-6 ">
        </a>
      </div>
    </div>
  </nav>


  <!-- Banner -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-5">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <div class="lg:col-span-1 bg-cover bg-center rounded-lg p-8 flex flex-col justify-between relative h-auto" style="background-image: url('../asset/pink.jpg');">
        <div class="absolute inset-0 bg-black opacity-30 rounded-lg"></div> <!-- Overlay for readability -->
        <div class="relative z-10">
          <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Mega Sale: Up To 50% Off On All Shoes!</h2>
          <p class="text-gray-200 mb-6 nowrap">Don't miss out on our biggest sale of the season. Upgrade your footwear collection with unbeatable discounts on all styles!</p>
        </div>
        <a href="../log/user/login.user.php" class="relative z-10 bg-orange-700 text-white py-2 px-6 rounded hover:bg-orange-800 inline-block transition-colors duration-300 ease-in-out bottom-10 w-40">Grab The Offer</a>
      </div>

      <!--  Promos -->
      <div class="lg:col-span-2 flex flex-col gap-6">

        <div class="bg-cover bg-center rounded-lg p-6 flex items-center relative h-48" style="background-image: url('../asset/pretty.jpg');">
          <div class="absolute inset-0 bg-black opacity-30 rounded-lg"></div> <!-- Overlay for readability -->
          <div class="relative z-10 flex-1">
            <h3 class="text-xl font-semibold text-white">Summer Sneaker Collection</h3>
            <a href="../log/user/login.user.php" class="bg-orange-700 text-white py-2 px-5 rounded hover:bg-orange-800 transition-colors duration-300 ease-in-out mt-5 inline-block">Discover Now</a>
          </div>
        </div>

        <!--Discount -->
        <div class="bg-cover bg-center rounded-lg p-6 flex items-center relative h-48" style="background-image: url('../asset/run.jpg');">
          <div class="absolute inset-0 bg-black opacity-30 rounded-lg"></div> <!-- Overlay for readability -->
          <div class="relative z-10 flex-1">
            <h3 class="text-xl font-semibold text-white">Get 30% Off On Running Shoes</h3>
            <a href="../log/user/login.user.php" class="bg-orange-700 text-white py-2 px-5 rounded hover:bg-orange-800 inline-block transition-colors duration-300 ease-in-out mt-5 ">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--  Carousel -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!--  Header -->
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-gray-900">You may also like</h2>
      <div class="w-24 h-1 bg-blue-600 mx-auto mt-2"></div>
      <p class="text-gray-600 mt-4">
        There are many variations of passages of Lorem Ipsum available
        but the majority have suffered alteration in some form.
      </p>
    </div>

    <!-- Container -->
    <div id="carousel-container" class="relative">


      <div id="slide-1" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Product 1-->
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
          <div class="relative overflow-hidden">
            <img
              src="../asset/air-force.jpg"
              alt="Stylish Women Bag"
              class="w-full h-64 object-cover transition-transform duration-300"
              id="zoom-image">

            <div class="absolute top-4 left-4 bg-red-500 text-white px-2 py-1 text-sm font-semibold rounded">
              Hot
            </div>
          </div>
          <div class="p-4 flex-1 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-900 text-center">Nike Air Force</h3>
            <div class="text-center mt-1">
              <p class="text-gray-700 font-bold">₱5,895</p>
            </div>
            <div class="flex justify-center mt-2">
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
            </div>
            <a href="../log/user/login.user.php" class="w-full bg-red-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition-colors duration-300 text-center block">
              Add to Cart
            </a>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
          <div class="relative overflow-hidden">
            <img src="../asset/nike-pegasus.jpg" alt="Stylish Watch For Man" class="w-full h-64 object-cover transition-transform duration-300" id="zoom-image-2">
            <div class="absolute top-4 left-4  bg-blue-500 text-white px-2 py-1 text-sm font-semibold rounded">
              <span>-50%</span>
            </div>
            <div class="absolute top-4 left-20 bg-blue-500 text-white px-2 py-1 text-sm font-semibold rounded flex items-center gap-2">
              <p class="text-grey-100 font-bold hover:text-red-300 pointer">SAVE</p>
              <span class="line-through">₱7,895</span>
            </div>

          </div>


          <div class="p-4 flex-1 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-900 text-center">Nike Air Zoom Pegasus 38</h3>
            <div class="text-center mt-1">
              <p class="text-gray-700 font-bold">₱3,947.5</p>

            </div>
            <div class="flex justify-center mt-2">
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
            </div>
            <a href="../log/user/login.user.php" class="w-full bg-red-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition-colors duration-300 text-center block">
              Add to Cart
            </a>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
          <div class="relative overflow-hidden">
            <img src="../asset/nike-court.jpg" alt="Polo T-shirt For Man" class="w-full h-64 object-cover transition-transform duration-300" id="zoom-image-3">
          </div>
          <div class="p-4 flex-1 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-900 text-center">Nike Court</h3>
            <div class="text-center mt-1">
              <p class="text-gray-700 font-medium">£25.00</p>
            </div>
            <div class="flex justify-center mt-2">
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
            </div>
            <a href="../log/user/login.user.php" class="w-full bg-red-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition-colors duration-300 text-center block">
              Add to Cart
            </a>
          </div>
        </div>

        <!-- Product 4 -->
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
          <div class="relative overflow-hidden">
            <img src="../asset/nike-jordan-mid.jpg" alt="Luxury Wallet For Male" class="w-full h-64 object-cover transition-transform duration-300 " id="zoom-image-4">
            <div class="absolute top-4 left-4 bg-green-500 text-white px-2 py-1 text-sm font-semibold rounded">
              New
            </div>
          </div>
          <div class="p-4 flex-1 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-900 text-center">Nike Air Jordan 1 Mid</h3>
            <div class="text-center mt-1">
              <p class="text-gray-700 font-medium">£95.00</p>
            </div>
            <div class="flex justify-center mt-2">
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
            </div>
            <a href="../log/user/login.user.php" class="w-full bg-red-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition-colors duration-300 text-center block">
              Add to Cart
            </a>
          </div>
        </div>
      </div>

      <!-- Second Slide -->
      <div id="slide-2" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Product  -->
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
          <div class="relative">
            <img src="../asset/super-addidas.jpg" alt="Premium Sneakers" class="w-full h-64 object-cover">
            <div class="absolute top-4 left-4 bg-purple-500 text-white px-2 py-1 text-sm font-semibold rounded">
              Popular
            </div>
          </div>
          <div class="p-4 flex-1 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-900 text-center">Adidas Superstar</h3>
            <div class="text-center mt-1">
              <p class="text-gray-700 font-medium">£120.00</p>
            </div>
            <div class="flex justify-center mt-2">
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
            </div>
            <a href="../log/user/login.user.php" class="w-full bg-red-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition-colors duration-300 text-center block">
              Add to Cart
            </a>
          </div>
        </div>

        <!-- Product 6 -->
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
          <div class="relative">
            <img src="../asset/samba.jpg" alt="Stylish Sunglasses" class="w-full h-64 object-cover">
            <div class="absolute top-4 left-4 bg-yellow-500 text-white px-2 py-1 text-sm font-semibold rounded">
              Sale
            </div>
            <div class="absolute top-4 left-16 bg-yellow-500 text-white px-2 py-1 text-sm font-semibold rounded flex items-center gap-2">
              <span class="line-through">£90.00</span>
            </div>

          </div>
          <div class="p-4 flex-1 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-900 text-center">Adidas Samba</h3>
            <div class="text-center mt-1">
              <p class="text-gray-700 font-medium">£45.00</p>

            </div>
            <div class="flex justify-center mt-2">
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
            </div>
            <a href="../log/user/login.user.php" class="w-full bg-red-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition-colors duration-300 text-center block">
              Add to Cart
            </a>
          </div>
        </div>

        <!-- Product 7 -->
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
          <div class="relative">
            <img src="../asset/forum.jpg" alt="Trendy Hat" class="w-full h-64 object-cover">
            <div class="absolute top-4 left-4 bg-green-500 text-white px-2 py-1 text-sm font-semibold rounded">
              New
            </div>
          </div>
          <div class="p-4 flex-1 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-900 text-center">Adidas Forum</h3>
            <div class="text-center mt-1">
              <p class="text-gray-700 font-medium">£30.00</p>
            </div>
            <div class="flex justify-center mt-2">
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
            </div>
            <a href="../log/user/login.user.php" class="w-full bg-red-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition-colors duration-300 text-center block">
              Add to Cart
            </a>
          </div>
        </div>

        <!-- Product 8 -->
        <div class="bg-white rounded-lg shadow overflow-hidden h-full flex flex-col">
          <div class="relative">
            <img src="../asset/NMD.jpg" alt="Slim Fit Jeans" class="w-full h-64 object-cover">
          </div>
          <div class="p-4 flex-1 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-900 text-center">addidas NMD</h3>
            <div class="text-center mt-1">
              <p class="text-gray-700 font-medium">£65.00</p>
            </div>
            <div class="flex justify-center mt-2">
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
            </div>
            <a href="../log/user/login.user.php" class="w-full bg-red-600 text-white py-2 rounded mt-4 hover:bg-green-700 transition-colors duration-300 text-center block">
              Add to Cart
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- ang arrow sa coursel -->
    <div class="flex justify-center mt-6">
      <button id="prev-slide" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">
        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
      </button>
      <button id="next-slide" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100 ml-4">
        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>
    </div>
  </section>


  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row items-center justify-between">

      <div class="md:w-1/2 mb-10 md:mb-0 pr-0 md:pr-8">
        <p class="text-blue-600 font-medium text-xl mb-4">Start From <span class="font-bold text-red-600">₱2,000</span></p>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">New Arrival From Creative Clock Collections</h1>

        <p class="text-gray-600 mb-8">
          Discover the perfect blend of style and functionality with our latest Creative Clock Collections. Designed to complement any space, these clocks are a testament to timeless elegance and modern craftsmanship.
        </p>

        <button onclick="window.location.href='../log/user/login.user.php'" class="bg-orange-700 hover:bg-orange-800 text-white font-medium py-3 px-8 rounded-md">
          View All Items
        </button>
      </div>

      <!-- Right -->
      <div class="md:w-1/2 flex justify-center">

        <div class="w-full max-w-lg h-80 md:h-96 shadow-lg rounded-lg overflow-hidden">
          <img
            src="../asset/new.jpg"
            alt="Minimalist Wall Clock"
            class="w-full h-full object-cover" />
        </div>
      </div>
    </div>


    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row items-center justify-between mt-5">

      <div class="md:w-1/2 mb-10 md:mb-0">
        <div class="w-full h-96 rounded-lg shadow-lg overflow-hidden">
          <img
            src="../asset/fashion.jpg"
            alt="Gold Frame Sunglasses"
            class="w-full h-full object-cover" />
        </div>
      </div>

      <!-- Right decription -->
      <div class="md:w-1/2 md:pl-12">
        <p class="text-blue-600 font-medium text-xl mb-4">Start From<span class="font-bold text-red-700 "> ₱1,982</span></p>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">New Summer Collections For Fashion.</h1>

        <p class="text-gray-600 mb-8">
          Discover the latest trends in summer fashion. Embrace vibrant colors, lightweight fabrics, and stylish designs that keep you cool and chic all season long. Elevate your wardrobe with our exclusive summer collection.
        </p>

        <a href="../log/user/login.user.php" class="bg-orange-700 hover:bg-orange-800 text-white font-medium py-3 px-8 rounded-md">
          View All Items
        </a>
      </div>
    </div>
  </section>



  <!-- products avail--->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="container mx-auto px-4 py-12 ">
      <!-- header -->
      <div class="text-center mb-10">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Shop By Category</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Explore our curated collection of footwear designed for style and performance.
        </p>
      </div>
      <!-- grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Sneakers Card -->
        <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group">
          <a href="../log/user/login.user.php">
            <div class="h-64 overflow-hidden">
              <img
                src="../asset/sneak.jpg"
                alt="Sneakers"
                class="w-full h-full object-cover" />
            </div>
            <div class="p-6 text-center">
              <h3 class="text-2xl font-bold text-gray-900 mb-2">
                <span class="group-hover:text-yellow-800 transition-colors duration-300">Sneakers</span>
              </h3>
              <p class="text-gray-600 mb-4">12 Products Available</p>
            </div>
          </a>
        </div>
        <!-- Running Shoes Card -->
        <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group">
          <a href="../log/user/login.user.php">
            <div class="h-64 overflow-hidden">
              <img
                src="../asset/running.jpg"
                alt="Running Shoes"
                class="w-full h-full object-cover" />
            </div>
            <div class="p-6 text-center">
              <h3 class="text-2xl font-bold text-gray-900 mb-2">
                <span class="group-hover:text-yellow-700 transition-colors duration-300">Running Shoes</span>
              </h3>
              <p class="text-gray-600 mb-4">6 Products Available</p>
            </div>
          </a>
        </div>
      </div>
      <div class="mt-10 text-center">
        <a href="../log/user/login.user.php" class="inline-block bg-blue-600 text-white py-3 px-8 rounded-md hover:bg-blue-700 transition-colors duration-300">Explore All Footwear</a>
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
    <!-- Features Section -->
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-gray-900">Our services</h2>
      <div class="w-24 h-1 bg-blue-600 mx-auto mt-2"></div>
      <p class="text-gray-600 mt-4">
        SoleStyle will always fullfill any services to our valued customer
      </p>
    </div>
    <div class="container mx-auto py-16 px-20 mb-20">
      <!-- Grid for the three features -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <!-- Free delivery feature -->
        <div class=" border-2 border-blue-300 flex flex-col items-center text-center p-8 border-r border-gray-200 rounded-2xl">
          <div class="bg-gray-100 p-4 rounded-full mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17H4a2 2 0 01-2-2V7a2 2 0 012-2h12a2 2 0 012 2v4" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-3">Free delivery</h3>
          <p class="text-gray-500">Enjoy free shipping on all orders with no minimum purchase required.</p>
        </div>

        <!-- Online Payment feature -->
        <div class=" border-2 border-red-100 flex flex-col items-center text-center p-8 border-r border-gray-200 rounded-2xl">
          <div class="bg-gray-100 p-4 rounded-full mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-3">Online Payment</h3>
          <p class="text-gray-500">Experience a secure and hassle-free payment process. </p>
        </div>

        <!-- Easy Return feature -->
        <div class=" border-2 border-green-200 flex flex-col items-center text-center p-8 rounded-2xl ">
          <div class="bg-gray-100 p-4 rounded-full mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-3">Easy Return.</h3>
          <p class="text-gray-500">Shop with confidence knowing that our easy return policy allows you to return or exchange items</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white pt-10 pb-8 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto">
        <!-- Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

          <!-- Info -->
          <div>
            <div class="flex items-center justify-center md:justify-start mb-6">
              <span class="text-blue-600 text-3xl mr-2">
                <span class="text-xl font-bold text-gray-900">SoleStyle.</span>
              </span>
            </div>

            <div class="space-y-2">
              <p class="text-gray-600">Toledo, Cebu City</p>
              <p class="text-gray-600">+69 9234 1231 12</p>
              <p class="text-gray-600">johnlcarencepalma.edu@gmail.com</p>
            </div>
          </div>

          <!-- My Account Column -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-center md:text-left">My Account</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">My Profile</a></li>
              <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">My Order History</a></li>
              <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Order Tracking</a></li>
              <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Shopping Cart</a></li>
            </ul>
          </div>

          <!-- Pro -->
          <div>
            <h3 class="text-lg font-semibold mb-4 text-center md:text-left">Products</h3>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Sneakers</a></li>
              <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Running Shoes</a></li>
            </ul>
          </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 text-center text-gray-600">
          <p>© 2024 partfix. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="/frontend/js/index.js"> </script>
</body>

</html>