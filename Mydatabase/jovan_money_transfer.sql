-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2018 at 03:40 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jovan_money_transfer`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` enum('bank_account','mobile_money') COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_name`, `account_type`, `account_number`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Charles\' Mtn', 'mobile_money', '0778963452', 2, '2018-07-04 05:08:51', '2018-07-04 05:08:51'),
(2, 'Charles\' Airtel', 'mobile_money', '0708963452', 2, '2018-07-04 05:12:40', '2018-07-04 05:12:40'),
(3, 'Charles\' Africell', 'mobile_money', '0798963452', 2, '2018-07-04 05:14:02', '2018-07-04 05:14:02'),
(4, 'Mutesasira Jovan', 'mobile_money', '+256702563825', 1, '2018-07-04 12:49:40', '2018-07-04 12:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2018_07_03_160600_create_accounts_table', 2),
(6, '2018_07_03_161159_create_transactions_table', 2);

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
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `sender_account` int(10) UNSIGNED NOT NULL,
  `reciever_account` int(10) UNSIGNED NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `sender_account`, `reciever_account`, `Created_at`) VALUES
(1, '1000.00', 4, 1, '2018-07-04 16:10:55'),
(2, '30000.00', 4, 2, '2018-07-05 13:35:40'),
(3, '30000.00', 4, 2, '2018-07-05 13:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phonenumber`, `country`, `password`, `created_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'giov', 'giovanni', 'mutesasirajovan@gmail.com', '+256702563825', 'Uganda', '$2y$10$hXMu2kh4tqRUgJlQBGUdiOWFlmirOkv.7xdcCCmPUBdbOCY5aAz0m', NULL, 'wGWijmJm5apXtk9AultzNXkJdKzu7jyFUIL7EPNyvMwIIAVvctUaL3y6pSth', '2018-07-03 07:14:40', '2018-07-03 07:14:40'),
(2, 'charles', 'Okoth', 'otkotherr@gmail.com', '+256779890344', 'Uganda', NULL, '1', NULL, '2018-07-03 10:36:53', '2018-07-03 10:36:53'),
(3, 'Joseph', 'Oketh', 'okechoel0@gmail.com', '+256778965432', 'Uganda', NULL, '1', NULL, '2018-07-03 10:39:47', '2018-07-03 11:58:35'),
(4, 'joshua', 'Muhumuza', 'jesusreigns0@gmail.com', '+25675881156', 'Uganda', NULL, '1', NULL, '2018-07-03 10:49:03', '2018-07-03 12:25:06'),
(5, 'Jack', 'Martins', 'jackmartz0@gmail.com', '+256770965432', 'Uganda', NULL, '1', NULL, '2018-07-03 10:52:26', '2018-07-03 12:03:45'),
(6, 'Henry', 'Okecho', 'henryokecho99l0@gmail.com', '+256778900432', 'Uganda', NULL, '1', NULL, '2018-07-03 10:53:27', '2018-07-03 12:23:53'),
(7, 'Joel', 'Okoth', 'okellojoel0@gmail.com', '+256778965432', 'Uganda', NULL, '1', NULL, '2018-07-03 10:54:05', '2018-07-03 10:54:05'),
(8, 'Joel', 'Okoth', 'okellojoel0@gmail.com', '+256778965432', 'Uganda', NULL, '1', NULL, '2018-07-03 10:56:20', '2018-07-03 10:56:20'),
(9, 'Joel', 'Okoth', 'okellojoel0@gmail.com', '+256778965432', 'Uganda', NULL, '1', NULL, '2018-07-03 10:57:52', '2018-07-03 10:57:52'),
(10, 'Joel', 'Okoth', 'okellojoel0@gmail.com', '+256778965432', 'Uganda', NULL, '1', NULL, '2018-07-03 11:01:11', '2018-07-03 11:01:11'),
(12, 'Joel', 'Okoth', 'okellojoel0@gmail.com', '+256778965432', 'Uganda', NULL, '1', NULL, '2018-07-03 11:05:39', '2018-07-03 11:05:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_user_id_foreign` (`user_id`);

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
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_sender_account_foreign` (`sender_account`),
  ADD KEY `transactions_reciever_account_foreign` (`reciever_account`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2393;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_reciever_account_foreign` FOREIGN KEY (`reciever_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `transactions_sender_account_foreign` FOREIGN KEY (`sender_account`) REFERENCES `accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
