-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2024 at 05:36 PM
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
-- Table structure for table `feetdetails`
--

CREATE TABLE `feetdetails` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `received_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode` enum('UPI','IMPS','NEFT','UNIVERSITY_ACCOUNT','CASH') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feetdetails`
--

INSERT INTO `feetdetails` (`id`, `date`, `received_from`, `received_amount`, `description`, `mode`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '2024-07-01', 'sfsdfsad', '4243242.00', 'sdfasdfasf', 'NEFT', 'sadfsadfas', '2024-07-01 00:48:04', '2024-07-01 00:58:22', NULL),
(3, '2024-07-05', 'ertrertert', '345345.00', 'dfgdfgdfg', 'IMPS', 'sdgfdfgds', '2024-07-01 00:48:28', '2024-07-01 00:48:28', NULL),
(4, '2024-07-05', 'ertrertert', '345345.00', 'dfgdfgdfg', 'IMPS', 'sdgfdfgds', '2024-07-01 00:48:57', '2024-07-01 00:48:57', NULL),
(5, '2024-07-03', 'yrtyr', '456465.00', 'tyrthdfhg', 'UPI', 'fdhfdhgf', '2024-07-01 00:50:20', '2024-07-01 05:22:52', '2024-07-01 05:22:52'),
(6, '2024-07-04', 'fdsfgd', '565464.00', 'gdfsgsdfg', 'UPI', 'sdfgfdsg', '2024-07-01 00:53:06', '2024-07-01 00:58:08', '2024-07-01 00:58:08'),
(7, '2024-07-04', 'fdsfgd', '565464.00', 'gdfsgsdfg', 'UPI', 'sdfgfdsg', '2024-07-01 00:54:26', '2024-07-01 00:54:30', '2024-07-01 00:54:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feetdetails`
--
ALTER TABLE `feetdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feetdetails`
--
ALTER TABLE `feetdetails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
