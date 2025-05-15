<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title></title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>


<nav class="bg-white border-green-200 dark:bg-green-700">
	<div
		class="w-full max-w-9/10 flex flex-wrap items-center justify-between mx-auto p-4"> <!--max-w-screen-xl, tailwind docs-->
		<form>
			<span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white ">ShoePH</span>

		</form>
		<ul
			class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 dark:border-gray-700">
			<li>
				<div class="m-2">
					<a
						href="#"
						class="inblock py-1 px-1 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500 justify-center"
						aria-current="page">Home</a>
				</div>
			</li>
			<li>
				<div class="m-2">
					<a
						href="../pages/about.php"
						class=" justify-center block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent
						md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-
						700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
				</div>
			</li>
			<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

				<button type="submit" name="logout" class="focus:outline-none text-white bg-red-500 hover:bg-red-700 focus:ring-4 
						focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 
						dark:focus:ring-red-900 md:ml-auto">Log out</button>

			</form>
		</ul>
	</div>
</nav>
</div>
</body>

</html>