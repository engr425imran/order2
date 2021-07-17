-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2019 at 07:00 AM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cubeapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_postal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_postal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `vat_reg_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `delivery_method` int(11) DEFAULT NULL,
  `terms` int(11) DEFAULT NULL,
  `opening_balance` double(8,2) NOT NULL DEFAULT '0.00',
  `as_of_date` date DEFAULT NULL,
  `att` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `first_name`, `last_name`, `display_name`, `company`, `email`, `phone`, `mobile`, `fax`, `other`, `website`, `b_street`, `b_city`, `b_state`, `b_postal`, `b_country`, `c_street`, `c_city`, `c_state`, `c_postal`, `c_country`, `note`, `vat_reg_no`, `payment_method`, `delivery_method`, `terms`, `opening_balance`, `as_of_date`, `att`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mosheur', 'Rahman', 'Mosheur', 'BSD', 'mosheur.cs@gmail.com', '01685417086', '01685417086', '124523', '012012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 0.00, NULL, NULL, '1', '2019-08-18 22:07:33', '2019-08-18 22:07:33'),
(2, 'Paul', 'Paul', 'Paul', 'Paul IT ltd.', 'paul@gmail.com', NULL, '+27739199284', '001122', NULL, NULL, 'South Africa', 'Cape town', 'Cape town', 'Cape town', 'Cape town', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 2, 2, 100000.00, '2019-08-22', NULL, '1', '2019-08-19 15:00:57', '2019-08-19 15:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_14_062640_create_customers_table', 1),
(4, '2019_08_18_194707_create_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `sales_des` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_price` double(8,2) DEFAULT '0.00',
  `cost` double(8,2) DEFAULT '0.00',
  `q_on_hand` int(11) DEFAULT NULL,
  `reorder_point` int(11) DEFAULT NULL,
  `asset_account` int(11) DEFAULT NULL,
  `income_account` int(11) DEFAULT NULL,
  `expense_account` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `name`, `image`, `sku`, `type`, `sales_des`, `sales_price`, `cost`, `q_on_hand`, `reorder_point`, `asset_account`, `income_account`, `expense_account`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Powder', 'public/img/product/qubPowder.jpg', 'pow-001', 1, 'ok', 100.00, 80.00, 200, 10, 1, 1, 1, 1, '2019-08-19 00:02:49', '2019-08-19 00:02:49'),
(2, 'Olive-Oil', 'public/img/product/qlbOlive-Oil.jpg', 'oil-120450', 2, '1 liter Bottle', 150.00, 129.00, 500, 10, 2, 2, 2, 1, '2019-08-19 14:55:07', '2019-08-19 14:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
