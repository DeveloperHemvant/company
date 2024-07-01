-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2024 at 05:35 PM
-- Server version: 8.0.37-0ubuntu0.22.04.3
-- PHP Version: 8.1.2-1ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- Table structure for table `courier_records`
--

CREATE TABLE `courier_records` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('inward','outward') COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_type` enum('associate','university','direct') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `associate_id` bigint UNSIGNED DEFAULT NULL,
  `university_id` bigint UNSIGNED DEFAULT NULL,
  `direct_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `particular_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `courier_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_status` enum('Delivered','Undelivered') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courier_records`
--

INSERT INTO `courier_records` (`id`, `type`, `form_type`, `associate_id`, `university_id`, `direct_data`, `particular_details`, `courier_type`, `tracking_no`, `delivery_status`, `remarks`, `created_at`, `updated_at`) VALUES
(2, 'inward', 'associate', NULL, NULL, NULL, 'dfsgfds', 'courier', '34534534sdfsdaf', 'Delivered', 'sdfgdgdfg', '2024-07-01 05:24:45', '2024-07-01 06:07:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courier_records`
--
ALTER TABLE `courier_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_records_associate_id_foreign` (`associate_id`),
  ADD KEY `courier_records_university_id_foreign` (`university_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courier_records`
--
ALTER TABLE `courier_records`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courier_records`
--
ALTER TABLE `courier_records`
  ADD CONSTRAINT `courier_records_associate_id_foreign` FOREIGN KEY (`associate_id`) REFERENCES `associates` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courier_records_university_id_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
