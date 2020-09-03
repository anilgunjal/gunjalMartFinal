-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2020 at 04:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gunjalmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminid` bigint(20) NOT NULL,
  `empid` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `empstat` int(11) NOT NULL,
  `logstatus` tinyint(4) DEFAULT 0,
  `lastlogindate` timestamp NULL DEFAULT NULL,
  `createDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminid`, `empid`, `name`, `email`, `password`, `contact`, `address`, `dob`, `avatar`, `designation`, `status`, `empstat`, `logstatus`, `lastlogindate`, `createDate`) VALUES
(5, 'NP0003', 'Anil', 'anil@ideamagix.com', '1eb47df00cd7ba445f43ada7eb64f80c', '95793214562', 'sdf', '2016-12-09', NULL, NULL, 1, 0, 1, '2020-08-29 19:27:38', '2016-12-26 17:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` bigint(20) NOT NULL,
  `adminid` int(11) DEFAULT NULL,
  `catname` varchar(100) DEFAULT NULL,
  `cat_img` varchar(200) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `adminid`, `catname`, `cat_img`, `createdDate`) VALUES
(9, 1, 'Electronics', 'uploads/cat_img/electronics.jpg', '2016-12-22 00:07:42'),
(10, 3, 'Appliances', 'uploads/cat_img/appliances.jpg', '2016-12-28 20:03:35'),
(11, 3, 'Footwear', 'uploads/cat_img/footwear.jpg', '2016-12-28 20:20:48'),
(12, 3, 'Clothing', 'uploads/cat_img/Clothing.jpg', '2016-12-29 02:23:08'),
(13, 2, 'Beauty And Grooming', 'uploads/cat_img/4.jpg', '2017-01-19 20:42:34'),
(14, 3, 'Test Review', 'uploads/cat_img/test_review.jpg', '2017-01-20 01:26:33'),
(15, 2, 'Grocery', 'uploads/cat_img/Grocery.png', '2017-01-27 18:29:48');

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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2018_10_18_055253_create_products_table', 1),
(9, '2018_10_18_055345_create_reviews_table', 1),
(10, '2020_05_22_104048_add_mobile_user_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('02c61cc1ed250e502ba65fbb2bcb6f512648d5c8e4b0cf21199f8a1000410a2d6da67f473794d0fa', 14, 1, 'MyApp', '[]', 0, '2020-05-22 05:16:53', '2020-05-22 05:16:53', '2021-05-22 10:46:53'),
('124bdc0d5bf365a50c7b13794fccb0e9f0b240de863efeaaba10183516b1ddda052b4471635ad0a7', 19, 1, 'MyApp', '[]', 0, '2020-05-22 05:36:16', '2020-05-22 05:36:16', '2021-05-22 11:06:16'),
('49a620cf54af499f91093e0c6510b96157c0b9ca6c4b7d2cef12d757037255b60c8f231253c4b231', 13, 1, 'MyApp', '[]', 0, '2020-05-21 23:42:34', '2020-05-21 23:42:34', '2021-05-22 05:12:34'),
('73eb3c5e5e596ecd8c2ec31161a3b88bff5b8083f5b72801d8a41976b2692ecadf8ffcef47d5bd1d', 21, 1, 'MyApp', '[]', 0, '2020-05-22 05:47:20', '2020-05-22 05:47:20', '2021-05-22 11:17:20'),
('89f772c02640e5a16f23043726693a2c91eb3ea6ac54790036c7605d3bbeaab07f66e84b02bd0ccb', 13, 1, 'MyApp', '[]', 0, '2020-05-21 23:42:52', '2020-05-21 23:42:52', '2021-05-22 05:12:52'),
('8c246ea90bebae9469c07205bb6fb1ef2c85a960b547b3a10a105ab935f434777a7e725f2305bb78', 22, 1, 'MyApp', '[]', 0, '2020-05-22 05:52:12', '2020-05-22 05:52:12', '2021-05-22 11:22:12'),
('b6f91bc886efb380efe0fbfe2a14c696dcb8ffbfe15549fceec48b1b32526712dacfff908f050ded', 18, 1, 'MyApp', '[]', 0, '2020-05-22 05:30:36', '2020-05-22 05:30:36', '2021-05-22 11:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'QbhvIdvdv6a6MA0BwJjCroJkoomr4nvTiTSe6ujO', 'http://localhost', 1, 0, 0, '2020-05-21 09:54:57', '2020-05-21 09:54:57'),
(2, NULL, 'Laravel Password Grant Client', 'JWwCU9k6BwqDd249EnRdJhzFOkMluNMeTn7mOlnf', 'http://localhost', 0, 1, 0, '2020-05-21 09:54:57', '2020-05-21 09:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-05-21 09:54:57', '2020-05-21 09:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id` int(10) UNSIGNED NOT NULL,
  `name_english` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_marathi` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_english` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_marathi` text CHARACTER SET utf8 DEFAULT NULL,
  `proimage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_price` int(11) DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `unit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_english`, `name_marathi`, `category`, `details_english`, `details_marathi`, `proimage`, `final_price`, `discount_price`, `unit`, `size`, `status`, `created_at`, `updated_at`) VALUES
(15, 'Apple', 'सफरचंद', 'Vegetables', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>\r\n', '<p>सफरचंद &nbsp;फ्डग्स डफडफग गड फग ड्फग डफ &nbsp;डफ डफडे डफ्फध डफडफ डफ डफ द डफडफ द्डफ द्सफ्फ्ड डफ ड्फह्दफह डफ डफडफ फध द्यसफ डफ डफ सफरचंद &nbsp;फ्डग्स डफडफग गड फग ड्फग डफ &nbsp;डफ डफडे डफ्फध डफडफ डफ डफ द डफडफ द्डफ द्सफ्फ्ड डफ ड्फह्दफह डफ डफडफ फध द्यसफ डफ डफ &nbsp;</p>\r\n', 'uploads/product_img/apple-7-front459.jpg', 300, 250, '1 kg', 'Big', 1, '2020-08-23 07:57:11', NULL),
(17, 'Papaya', 'पपई', 'Fruits', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>\r\n', '<p>सफरचंद &nbsp;फ्डग्स डफडफग गड फग ड्फग डफ &nbsp;डफ डफडे डफ्फध डफडफ डफ डफ द डफडफ द्डफ द्सफ्फ्ड डफ ड्फह्दफह डफ डफडफ फध द्यसफ डफ डफ सफरचंद &nbsp;फ्डग्स डफडफग गड फग ड्फग डफ &nbsp;डफ डफडे डफ्फध डफडफ डफ डफ द डफडफ द्डफ द्सफ्फ्ड डफ ड्फह्दफह डफ डफडफ फध द्यसफ डफ डफ</p>\r\n', 'uploads/product_img/papaya34.jpg', 30, 30, '1 Piece', 'Small', 1, '2020-08-23 11:02:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `mobile`) VALUES
(1, 'Prof. Amara Oberbrunner', 'opaucek@example.org', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'wB9zSdyRxq', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(2, 'Joaquin Torphy', 'hlindgren@example.com', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'OFuNZyjBfU', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(3, 'Wyatt Kemmer', 'annabel.bergstrom@example.org', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '85YmPhJzLB', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(4, 'Dr. Kip Pfannerstill DDS', 'delia85@example.com', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'BJx7nFmrjh', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(5, 'Skye Tillman', 'michaela.kozey@example.org', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'N2zB4CmDky', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(6, 'Dena Kemmer', 'feil.johnny@example.org', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'AJ7MOHI6ok', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(7, 'Lillian Berge', 'qturner@example.org', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'VyQDpMwaqi', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(8, 'Vada Schaden', 'flangworth@example.org', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'YiH1ElFCCy', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(9, 'Ross Ullrich', 'enos82@example.net', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'QxP7S2DNVN', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(10, 'Mrs. Kathryne Feil V', 'maximus.moore@example.net', '2020-05-17 06:44:41', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '9JKQekearb', '2020-05-17 06:44:41', '2020-05-17 06:44:41', ''),
(11, 'anil', 'anil@gmail.com', NULL, '$2y$10$j8I7Dh/feC7IPOC.5zNg6.GcrEjXl7YgTiRZNi0QUdXmieO36oFTa', NULL, '2020-05-21 10:29:36', '2020-05-21 10:29:36', ''),
(13, 'anil1', 'anil1@gmail.com', NULL, '$2y$10$UWPxYvzcJr5ZsO9rBPW1YeuNH9hlHTqqQcz9FqHm.y8N9on2nBJvm', NULL, '2020-05-21 23:42:33', '2020-05-21 23:42:33', ''),
(14, 'aniltest', 'ideaone@gmail.com', NULL, '$2y$10$brL9rseKCUlWcIrKlANWLuTDLLD9twc79zGAaKHsdGdHmCbnZz2PW', NULL, '2020-05-22 05:16:53', '2020-05-22 05:16:53', '1234566'),
(18, 'aniltest', 'ideaone1@gmail.com', NULL, '$2y$10$fYn15xtp7rFx485ad1svoOwPPRvLd2ppcPATbv8qOupwah5O2Lspa', NULL, '2020-05-22 05:30:35', '2020-05-22 05:30:35', '12345663'),
(19, 'Test clinic name', 'admin@thoughti.com', NULL, '$2y$10$kYY9waqiA8zdQO5BYwt//uWDn7g7dLFh.mrJgyUHW3u00NO2TQx72', NULL, '2020-05-22 05:36:15', '2020-05-22 05:36:15', '1234566'),
(21, 'nandu1', 'ideaonetest@gmail.com', NULL, '$2y$10$Eij2xpxWUT59PD/H/sVVCe3ijDH46V8.9i0geHJn05YxqMWuAc4Va', NULL, '2020-05-22 05:47:18', '2020-05-22 05:47:18', '979879898'),
(22, 'sfasfsaf', 'fdasfasf@sdfsdg.dsgsdg', NULL, '$2y$10$6mGTt.sGpmSY0tKOSh/lMe6PXlfCn/Dkkiv4SVFpWDKFNn9W6UZx.', NULL, '2020-05-22 05:52:12', '2020-05-22 05:52:12', '24214214');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_index` (`product_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
