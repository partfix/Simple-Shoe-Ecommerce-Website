-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2025 at 03:22 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `master`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` text,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `admin_name`, `action`, `details`, `created_at`) VALUES
(184, 'Admin', 'Delete User', 'Deleted user: asurascan (ID: 33) and all related orders', '2025-05-12 11:24:58'),
(204, 'john', 'Add Product', 'Added product: Nike Court Vision (Brand: Nike, Category: Sneakers, Price: ₱6000)', '2025-05-14 02:22:04'),
(205, 'john', 'Delete Product', 'Removed product ID #68 \"Nike Court Vision\". Details: Brand: Nike, Category: Sneakers, Color: #ffffff, Size: UK 5, Price: ₱6000.00, Stock: 15', '2025-05-14 02:22:20'),
(206, 'john', 'Add Product', 'Added product: Nike Court (Brand: Nike, Category: Sneakers, Price: ₱5000)', '2025-05-14 02:22:45'),
(207, 'john', 'Add Product', 'Added product: Nike Court (Brand: Nike, Category: Running Shoe, Price: ₱5000)', '2025-05-15 08:38:36'),
(208, 'john', 'Delete Product', 'Removed product ID #69 \"Nike Court\". Details: Brand: Nike, Category: Sneakers, Color: #ffffff, Size: UK 5, Price: ₱5000.00, Stock: 15', '2025-05-15 08:38:41'),
(209, 'john', 'Add Product', 'Added product: Nike Court (Brand: Nike, Category: Sneakers, Price: ₱5000)', '2025-05-15 08:41:49'),
(210, 'john', 'Delete Product', 'Removed product ID #71 \"Nike Court\". Details: Brand: Nike, Category: Sneakers, Color: #ffffff, Size: UK 5, Price: ₱5000.00, Stock: 21', '2025-05-15 08:42:31'),
(211, 'john', 'Delete Product', 'Removed product ID #70 \"Nike Court\". Details: Brand: Nike, Category: Running Shoe, Color: #ffffff, Size: UK 5, Price: ₱5000.00, Stock: 12', '2025-05-15 08:42:32'),
(212, 'john', 'Add Product', 'Added product: Nike Men\'s Court  (Brand: Nike, Category: Sneakers, Price: ₱5000)', '2025-05-15 08:42:55'),
(213, 'john', 'Add Product', 'Added product: Air (Brand: Nike, Category: Sneakers, Price: ₱2000)', '2025-05-15 08:44:28'),
(214, 'john', 'Add Product', 'Added product: Nike NMD (Brand: Nike, Category: Sneakers, Price: ₱5000)', '2025-05-15 08:54:48'),
(215, 'john', 'Add Product', 'Added product: Jordan (Brand: Nike, Category: Sneakers, Price: ₱24242)', '2025-05-15 08:57:11'),
(216, 'john', 'Add Product', 'Added product: Jordan (Brand: Adidas, Category: Running Shoe, Price: ₱2123)', '2025-05-15 08:57:43'),
(217, 'john', 'Add Product', 'Added product: youru (Brand: Nike, Category: Sneakers, Price: ₱5000)', '2025-05-15 08:58:19'),
(218, 'john', 'Add Product', 'Added product: Test (Brand: Nike, Category: Running Shoe, Price: ₱5000)', '2025-05-15 08:59:25'),
(219, 'john', 'Add Product', 'Added product: sdfsd (Brand: Nike, Category: Running Shoe, Price: ₱4000)', '2025-05-15 09:00:43'),
(220, 'john', 'Delete Product', 'Removed product ID #78 \"Test\". Details: Brand: Nike, Category: Running Shoe, Color: #ffffff, Size: EU 2, Price: ₱5000.00, Stock: 12324', '2025-05-15 09:02:15'),
(221, 'john', 'Delete Product', 'Removed product ID #77 \"youru\". Details: Brand: Nike, Category: Sneakers, Color: #fafafa, Size: UK 5, Price: ₱5000.00, Stock: 12', '2025-05-15 09:02:17'),
(222, 'john', 'Delete Product', 'Removed product ID #76 \"Jordan\". Details: Brand: Adidas, Category: Running Shoe, Color: #f0f0f0, Size: UK 5, Price: ₱2123.00, Stock: 5', '2025-05-15 09:02:19'),
(223, 'john', 'Delete Product', 'Removed product ID #75 \"Jordan\". Details: Brand: Nike, Category: Sneakers, Color: #f5f5f5, Size: UK 5, Price: ₱24242.00, Stock: 2', '2025-05-15 09:02:21'),
(224, 'john', 'Delete Product', 'Removed product ID #74 \"Nike NMD\". Details: Brand: Nike, Category: Sneakers, Color: #ffffff, Size: UK 5, Price: ₱5000.00, Stock: 12', '2025-05-15 09:02:23'),
(225, 'john', 'Delete Product', 'Removed product ID #72 \"Nike Men\'s Court \". Details: Brand: Nike, Category: Sneakers, Color: #ffffff, Size: UK 5, Price: ₱5000.00, Stock: 12', '2025-05-15 09:02:27'),
(226, 'john', 'Update Product', 'Updated product ID #79 \"Nike NMD\". Changes: Name: sdfsd → Nike NMD', '2025-05-15 09:09:30'),
(227, 'john', 'Add Product', 'Added product: Jordan (Mid) (Brand: Nike, Category: Running Shoe, Price: ₱4000)', '2025-05-15 09:10:10'),
(228, 'john', 'Add Product', 'Added product: Nike Court Men (Brand: Nike, Category: Sneakers, Price: ₱5000)', '2025-05-15 09:10:48'),
(229, 'john', 'Add Product', 'Added product: Addidas Data 1 (Brand: Adidas, Category: Sneakers, Price: ₱5000)', '2025-05-15 09:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_ID` int NOT NULL,
  `Brand_Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_ID`, `Brand_Name`) VALUES
(1, 'Nike'),
(2, 'Adidas');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_ID` int NOT NULL,
  `Category_Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_ID`, `Category_Name`) VALUES
(1, 'Running Shoe'),
(2, 'Sneakers');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_ID` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_ID`, `name`, `email`, `phone`, `address`, `password`, `user_type`) VALUES
(47, 'john', 'admin@gmail.com', '09212392191', 'Toledo, Cebu City', '$2y$10$4w3ziUk/W2BGpTS7HOQrEe5TmB6f8eAnjmdUXpssGCRjknE1TFtZW', 'admin'),
(48, 'asurascan22', 'testuser@gmail.com', '09212312981', 'Toledo, Cebu City', '$2y$10$9Hm4NIlF/qYp5rbh7uzxpupFbt3w.Nk4f4e.SPWcHnpYpnITXQTLS', 'customer'),
(49, 'johnclarence', 'test@gmai.com', '09232112125', 'Toledo, Cebu City', '$2y$10$7Meyu51zclBtJQe/eUNU6elaRp1fTxWaQ3ETuEtZRRyba/odKfEF2', 'customer'),
(50, 'paulcart', 'yestouserr@gmail.com', '09232112311', 'Toledo, Cebu City', '$2y$10$ilsatWbcWP2VMN3ZnIZT0uB4p15iQUrHqSMLbv/omeVT7ChsPAloC', 'customer'),
(51, 'makingway', 'wat@gmail.com', '09232112311', 'Toledo, Cebu City', '$2y$10$GwLRKly8e4cZExubzbwAJe2dA.Nh1.2NWSkhpOm8rIEEOa8GmTN9O', 'customer'),
(52, 'nebulara', 'yournebula@gmail.com', '09232112311', 'Toledo, Cebu City', '$2y$10$VPXeJnOTRNYWVYtCeosBJ.rSmiO4zIn/xePW3bPjecHJzStZkviDG', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_ID` int NOT NULL,
  `customer_ID` int DEFAULT NULL,
  `Order_Date` datetime DEFAULT NULL,
  `Total_Amount` decimal(10,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_Detail_ID` int NOT NULL,
  `order_ID` int DEFAULT NULL,
  `shoe_ID` int DEFAULT NULL,
  `Quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_ID` int NOT NULL,
  `order_ID` int DEFAULT NULL,
  `payment_Method` varchar(50) DEFAULT NULL,
  `payment_Status` enum('Complete','Not-paid','Cancel') DEFAULT NULL,
  `payment_Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shoe`
--

CREATE TABLE `shoe` (
  `shoe_ID` int NOT NULL,
  `brand_ID` int DEFAULT NULL,
  `category_ID` int DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Size` varchar(450) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Stock_Quantity` int DEFAULT NULL,
  `picture_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shoe`
--

INSERT INTO `shoe` (`shoe_ID`, `brand_ID`, `category_ID`, `Name`, `Size`, `Color`, `Price`, `Stock_Quantity`, `picture_path`) VALUES
(73, 1, 2, 'Air', 'UK 5', '#ffffff', 2000.00, 12, 'uploads/products/682538ec9b9b0.jpg'),
(79, 1, 1, 'Nike NMD', 'UK 10', '#ffffff', 4000.00, 12, 'uploads/products/68253cbbdfcd9.JPG'),
(80, 1, 1, 'Jordan (Mid)', 'UK 5', '#ffffff', 4000.00, 12, 'uploads/products/68253ef2c7788.jpg'),
(81, 1, 2, 'Nike Court Men', 'UK 5, EU 10', '#f5f5f5', 5000.00, 12, 'uploads/products/68253f1862ce3.jpg'),
(82, 2, 2, 'Addidas Data 1', 'UK 5', '#ffffff', 5000.00, 20, 'uploads/products/68253f553d147.avif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_ID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `fk_order_customer` (`customer_ID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_Detail_ID`),
  ADD KEY `fk_orderdetails_order` (`order_ID`),
  ADD KEY `fk_orderdetails_shoe` (`shoe_ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `fk_payment_order` (`order_ID`);

--
-- Indexes for table `shoe`
--
ALTER TABLE `shoe`
  ADD PRIMARY KEY (`shoe_ID`),
  ADD KEY `fk_shoe_brand` (`brand_ID`),
  ADD KEY `fk_shoe_category` (`category_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_Detail_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoe`
--
ALTER TABLE `shoe`
  MODIFY `shoe_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_customer` FOREIGN KEY (`customer_ID`) REFERENCES `customer` (`customer_ID`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_orderdetails_order` FOREIGN KEY (`order_ID`) REFERENCES `order` (`order_ID`),
  ADD CONSTRAINT `fk_orderdetails_shoe` FOREIGN KEY (`shoe_ID`) REFERENCES `shoe` (`shoe_ID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payment_order` FOREIGN KEY (`order_ID`) REFERENCES `order` (`order_ID`);

--
-- Constraints for table `shoe`
--
ALTER TABLE `shoe`
  ADD CONSTRAINT `fk_shoe_brand` FOREIGN KEY (`brand_ID`) REFERENCES `brand` (`brand_ID`),
  ADD CONSTRAINT `fk_shoe_category` FOREIGN KEY (`category_ID`) REFERENCES `category` (`category_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
