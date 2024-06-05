-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2024 at 03:23 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.17

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
-- Table structure for table `admission_sessions`
--

CREATE TABLE `admission_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `startmonth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `endmonth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `university_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_sessions`
--

INSERT INTO `admission_sessions` (`id`, `name`, `startmonth`, `endmonth`, `university_id`, `created_at`, `updated_at`) VALUES
(17, 'January-July 2024', '2024-01', '2024-07', 9, '2024-05-27 01:58:59', '2024-05-27 01:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `associates`
--

CREATE TABLE `associates` (
  `id` bigint UNSIGNED NOT NULL,
  `associate_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `associates`
--

INSERT INTO `associates` (`id`, `associate_name`, `created_at`, `updated_at`) VALUES
(3, 'hello', '2024-05-02 05:29:42', '2024-05-02 05:29:42'),
(5, 'sdfasfdasd', '2024-05-02 05:29:47', '2024-05-02 05:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1717574875),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1717574875;', 1717574875),
('509a8d0bf4ae0a9f97cc43dbdbb624ba', 'i:1;', 1716349038),
('509a8d0bf4ae0a9f97cc43dbdbb624ba:timer', 'i:1716349038;', 1716349038),
('b5a0d52329a0c82038e180aa7fe9ad52', 'i:1;', 1716447231),
('b5a0d52329a0c82038e180aa7fe9ad52:timer', 'i:1716447231;', 1716447231),
('da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1716295946),
('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1716295946;', 1716295946);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cousres`
--

CREATE TABLE `cousres` (
  `id` bigint UNSIGNED NOT NULL,
  `course_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `university_id` bigint UNSIGNED DEFAULT NULL,
  `course_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cousres`
--

INSERT INTO `cousres` (`id`, `course_name`, `created_at`, `updated_at`, `university_id`, `course_type`, `duration`, `deleted_at`) VALUES
(19, 'BA', '2024-05-20 00:48:14', '2024-05-20 01:38:10', 8, 'UG', '8 Semester', NULL),
(20, 'BCA', '2024-05-20 03:37:50', '2024-05-20 03:37:50', 8, 'UG', '6 Semester', NULL),
(21, 'MCA', '2024-05-20 03:38:40', '2024-05-20 03:38:40', 9, 'PG', '4 Semester', NULL),
(22, 'MA', '2024-05-20 03:38:55', '2024-05-20 03:38:55', 9, 'PG', '4 Semester', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_02_041117_add_two_factor_columns_to_users_table', 1),
(5, '2024_05_02_045515_create_universities_table', 2),
(6, '2024_05_02_093914_create_associates_table', 3),
(7, '2024_05_02_123730_create_admission_sessions_table', 4),
(11, '2024_05_02_041514_create_personal_access_tokens_table', 5),
(12, '2024_05_03_061313_create_admission_sessions_table', 5),
(13, '2024_05_03_074951_create_programmes_table', 6),
(14, '2024_05_03_075141_create_cousres_table', 7),
(16, '2024_05_06_045126_create_students_table', 8),
(17, '2024_05_07_065226_create_specializations_table', 9),
(18, '2024_05_09_110723_create_admission_sessions_table', 10),
(19, '2024_05_09_111503_create_students_table', 11),
(20, '2024_05_13_063821_create_students_table', 12),
(21, '2024_05_14_064113_add_columns_to_students_table', 13),
(22, '2024_05_20_041714_add_university_id_to_cousres_table', 14),
(23, '2024_05_20_043048_add_course_duration_to_cousres_table', 15),
(24, '2024_05_20_071714_add_mobile_address_column_table', 16),
(25, '2024_05_20_074802_add_university_id_column_table', 17),
(26, '2024_05_23_124120_add_user_id_to_students_table', 18),
(27, '2024_06_04_103803_add_columns_to_users_table', 19),
(28, '2024_06_04_120342_add_university_id_to_specializations_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` bigint UNSIGNED NOT NULL,
  `programme_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `programme_name`, `created_at`, `updated_at`) VALUES
(3, 'B.com', '2024-05-03 04:42:49', '2024-05-05 22:25:36'),
(5, 'B.Tech', '2024-05-05 23:16:05', '2024-05-05 23:16:05'),
(6, 'B.A', '2024-05-05 23:16:20', '2024-05-05 23:16:20'),
(7, 'MA', '2024-05-07 01:05:44', '2024-05-07 01:05:44'),
(8, 'MBA', '2024-05-07 01:06:05', '2024-05-07 01:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rSFfJvB1Tsmv2gXazUgvqwhy1f5Kb7CBKIGMPTE1', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRlJ6cmVQbkNlbUJRaThCRTZOWkNFWFZ6Q2FWVkFsWnRFUWFaUDA3OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hbGwtc3R1ZGVudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJEtxREo0NzdEVmM5akNJUkhlTVc4MS5aSnpQc09HRDJYTDFvMDIvcmkzOUdQak5Zc010SkNPIjt9', 1717581065);

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint UNSIGNED NOT NULL,
  `specialization_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cousre_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `university_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `specialization_name`, `cousre_id`, `created_at`, `updated_at`, `university_id`) VALUES
(13, 'Hindi', 19, '2024-05-20 01:11:33', '2024-05-20 01:11:33', NULL),
(14, 'Hindi', 20, '2024-05-27 02:09:09', '2024-05-27 02:09:09', NULL),
(15, 'English', 21, '2024-05-27 02:17:31', '2024-05-27 02:17:31', NULL),
(17, 'testi', 21, '2024-06-04 07:09:53', '2024-06-04 23:17:15', 9);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `university_id` bigint UNSIGNED NOT NULL,
  `source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `associate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `sr_no` int DEFAULT NULL,
  `uni_reg_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `aadhar_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mob_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `specialization_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sem_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` bigint UNSIGNED NOT NULL,
  `previous_migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uni_visit_date` date DEFAULT NULL,
  `pass_back` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marksheet_1st_sem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marksheet_2nd_sem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marksheet_3rd_sem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marksheet_4th_sem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marksheet_5th_sem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marksheet_6th_sem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marksheet_7th_sem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marksheet_8th_sem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provisional_diploma_degree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_docs` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `documents` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `university_id`, `source`, `associate`, `user_id`, `sr_no`, `uni_reg_no`, `password`, `name`, `father_name`, `mother_name`, `dob`, `aadhar_no`, `email_id`, `address`, `mob_no`, `course_id`, `specialization_id`, `type`, `sem_year`, `session_id`, `previous_migration`, `fee`, `exam_status`, `project_status`, `uni_visit_date`, `pass_back`, `marksheet_1st_sem`, `marksheet_2nd_sem`, `marksheet_3rd_sem`, `marksheet_4th_sem`, `marksheet_5th_sem`, `marksheet_6th_sem`, `marksheet_7th_sem`, `marksheet_8th_sem`, `provisional_diploma_degree`, `additional_docs`, `additional_remarks`, `nc`, `created_at`, `updated_at`, `documents`, `deleted_at`) VALUES
(6, 9, 'ASSOCIATE', 'Hemvant', 2, NULL, NULL, NULL, 'sfsdfdsaf', 'sadfsdfsf', 'sdfsdfsdf', '2024-05-27', '123321222111', 'sadfsafsdfs@yopmail.com', 'xyz\nxyz', '1234554321', 21, 15, 'FRESH', '8 Semester', 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-05 02:37:03', '2024-06-05 04:02:47', 'documentspdf/66601ca6f28d0.pdf', NULL),
(4, 9, 'DIRECT', NULL, NULL, NULL, NULL, NULL, 'sdafsdaf', 'sdfasdf', 'sdfsdafdsaf', '2024-06-06', '1234122345678', 'fsdfsd@yopmail.com', 'sdfasdfasdfsdf', '1234123412', 21, 15, 'FRESH', '2 Semester', 17, '2024-01', '345435', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-05 02:12:54', '2024-06-05 02:12:54', 'documentspdf/666016fdc4c63.pdf', NULL),
(3, 9, 'ASSOCIATE', 'Hemvant', 2, NULL, NULL, NULL, 'xyz', 'sdfsadf', 'testing1', '2024-05-30', '123454321234', 'goodsdf@yopmail.com', 'dsfgdsfgdfg', '8278309129', 21, 15, 'RE REG', '2 Semester', 17, '2024-01', '70000', 'pass', 'done', '2024-06-04', 'done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-05 00:26:01', '2024-06-05 01:32:39', 'documentspdf/66600d8f4d38d.pdf', NULL),
(2, 9, 'ASSOCIATE', 'Hemvant', 2, NULL, NULL, NULL, 'xyz', 'sdfsadf', 'hello', '2024-06-05', '123454321578', 'corporate@yopmail.com', 'xyz\nxyz', '1234567890', 21, 15, 'RE REG', '1 Semester', 17, '2024-01', '70000', 'pass', 'done', '2024-06-04', 'done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-05 00:21:06', '2024-06-05 00:21:06', 'documentspdf/665ffcc98eafa.pdf', NULL),
(5, 9, 'DIRECT', 'source', NULL, NULL, NULL, NULL, 'sadfsadf', 'sdfsafsd', 'fsdfsdf', '2024-06-04', '753654125896', 'sfdhasddfs@yopmail.com', 'sdfsfds', '8523697412', 21, 15, 'FRESH', '1 Semester', 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-05 02:21:23', '2024-06-05 02:21:23', 'documentspdf/666018fb31e3c.pdf', NULL),
(1, 9, 'ASSOCIATE', 'Hemvant', 2, NULL, '123456123456', 'hello', 'xyz', 'sdfsadf', 'hello', '2024-04-30', '931762514190', 'corporate@yopmail.com', 'xyz\nxyz', '8278309129', 21, 15, 'FRESH', '1 Semester', 17, '2024-01', '70000', 'pass', 'done', '2024-04-30', 'done', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-27 02:19:13', '2024-05-27 02:31:54', 'documentspdf/66543af9887c2.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint UNSIGNED NOT NULL,
  `university_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `university_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `university_name`, `university_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'SVSU', 'SVSU', '2024-05-07 00:55:37', '2024-06-04 04:36:59', NULL),
(9, 'KU', 'KU', '2024-05-07 00:56:14', '2024-05-26 22:17:25', NULL),
(10, 'SGVU', 'SGVU', '2024-05-07 00:56:25', '2024-05-07 00:56:25', NULL),
(11, 'CVRU-BIHAR', 'CVRU-BIHAR', '2024-05-07 00:56:34', '2024-05-07 00:56:34', NULL),
(12, 'CVRU-CG', 'CVRU-CG', '2024-05-07 00:56:43', '2024-05-07 00:56:43', NULL),
(13, 'CVRU-MP', 'CVRU-MP', '2024-05-07 00:56:50', '2024-05-07 00:56:50', NULL),
(14, 'RNTU-MP', 'RNTU-MP', '2024-05-07 00:56:57', '2024-05-07 00:56:57', NULL),
(15, 'AISECT-JH', 'AISECT-JH', '2024-05-07 00:57:05', '2024-05-07 00:57:05', NULL),
(16, 'SGU -MP', 'SGU -MP', '2024-05-07 00:57:12', '2024-05-07 00:57:12', NULL),
(17, 'AISECT SKILL', 'AISECT SKILL', '2024-05-07 00:57:20', '2024-05-07 00:57:20', NULL),
(18, 'MU', 'MU', '2024-05-07 00:57:28', '2024-05-07 00:57:28', NULL),
(19, 'MSGU', 'MSGU', '2024-05-07 00:57:36', '2024-05-07 00:57:36', NULL),
(34, 'testing', 'testing', '2024-05-24 04:52:10', '2024-05-24 04:52:24', '2024-05-24 04:52:24'),
(35, 'hello', 'hello', '2024-05-24 06:35:37', '2024-05-24 06:35:39', '2024-05-24 06:35:39'),
(36, 'sadfsadfsafs', 'fsdfasdf', '2024-05-26 22:18:24', '2024-05-26 22:19:23', '2024-05-26 22:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Associate',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `pname`, `email`, `usertype`, `email_verified_at`, `password`, `mobile`, `landmobile`, `smobile`, `address`, `city`, `pincode`, `state`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, 'admin@webguruz.in', 'admin', NULL, '$2y$12$KqDJ477DVc9jCIRHeMW81.ZJzPsOGD2XL1o02/ri39GPjNYsMtJCO', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-01 22:49:22', '2024-05-01 22:49:22', NULL),
(2, 'Hemvant', NULL, 'hemvant@webguruz.in', 'Associate', NULL, '$2y$12$AtbAVtSvg9GdzGaA9kiEq.g7K2HlHLCetdw5S4fnaVk5QCgjbN0z6', '1234123234', NULL, NULL, 'dsfgdgdfs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-01 22:50:16', '2024-05-24 04:23:57', NULL),
(4, 'Testing', NULL, 'testing@webguruz.in', 'Associate', NULL, '$2y$12$nWFY3kIg/DEqwg/ea7ZDPu5TQdpGnGFIANg04hF39xrDFYsHHzwDW', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-17 07:03:14', '2024-05-17 07:03:14', NULL),
(9, 'Final Testing  testing', NULL, 'associate@webguruz.in', 'Associate', NULL, '$2y$12$R3QLNZ6S6jrcljggebiQXebsS7Ycnd58sIFdylzU1QYu8QbasqzOu', '7878787878', NULL, NULL, 'asdfsfd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23 03:51:39', '2024-05-24 04:31:00', NULL),
(22, 'asdfsafsadfs', NULL, 'admintest@webguruz.in', 'staff', NULL, '$2y$12$elHO3twzqFqwc/a2l86OhOPF20z5KdHd97IsCCylxCmNmTVRbbjOm', '1234124234', NULL, NULL, 'xyz\nxyz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-24 05:16:56', '2024-05-24 05:16:56', NULL),
(23, 'asdfsafsadfsdfgdg', NULL, 'helloji@gmail.com', 'Associate', NULL, '$2y$12$whQVWkYFf7NloJJagW6ykeA9tD5VE7D3Z5dBlzx92ZTHovqyqcS8K', '1234567890', NULL, NULL, 'asdfsafdsadfsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-24 05:30:19', '2024-05-24 05:30:19', NULL),
(26, 'gurpreet helllo', NULL, 'hello@gmail.com', 'staff', NULL, '$2y$12$1tizaUSrhwgkyV2FCLIW8.CWVHF9TyXxKKg.zZYdKSAu0QvXQXTSq', '1234567890', NULL, NULL, 'asdfsfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-24 05:39:14', '2024-05-24 05:39:30', '2024-05-24 05:39:30'),
(27, 'Gurpreet', NULL, 'simran@webguruz.in', 'staff', NULL, '$2y$12$g6snhOJLUQxv/HXxdS2gpeRf1IFWTJ69W9zgTd7XA10vRKFjbtUYu', '1234554321', NULL, NULL, 'asdfsadfasdfdasf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-24 07:24:31', '2024-05-26 22:28:31', '2024-05-26 22:28:31'),
(28, 'admintesttestsdfsdf', NULL, 'admintesttest@webguruz.in', 'staff', NULL, '$2y$12$CjEJzmJvVEH/EyTAAWMHiOJEDfh1OlreR5r0rU004lYlgqNe.m1Py', '1234567890', NULL, NULL, 'dsfgdsfgd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-27 02:27:23', '2024-05-27 02:27:34', NULL),
(29, 'hello', NULL, 'hellohello@gmail.com', 'staff', NULL, '$2y$12$WxHhvtAVw91Pt0eveQM4lepzrGYhwS2nBsVzwSGecjWh6lSENwtCC', '1234554321', NULL, NULL, 'sdfsadfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-27 02:29:16', '2024-05-27 02:29:16', NULL),
(30, 'dsfg', NULL, 'good@gmail.com', 'staff', NULL, '$2y$12$N6x3/IDsqaXgDrVpZKmzfukgjji2mewnvUvMKbes9L57f0wjLIorG', '2423234234', NULL, NULL, 'tgdgfsfgs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-27 02:30:45', '2024-05-27 02:31:03', NULL),
(31, 'sfsfs', 'asdfsdf', 'hello@yopmail.com', 'Associate', NULL, '$2y$12$cTzbK4NjHUk52o8AqgVCZem1imcK09gaOKbcXE.d2VaOVS7jSRN9a', '2342345345', '34523', 'sdfsdf', 'safsadfsdf', 'dfgdg', '1', 'dsfgd', NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-04 05:14:45', '2024-06-04 06:20:57', NULL),
(32, 'testing', 'sadfsdafsd', 'guru@yopmail.com', 'Associate', NULL, '$2y$12$QQP6OpQJIDRsfisPKhK.K.1lAjW7qIQ58A.oGX5Bo/5NTg73zw3Ee', '1234567890', '1234567890', '1234567890', 'asfsadf', 'safsdf', '123', 'sdafsadf', NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-04 05:45:47', '2024-06-04 06:30:29', '2024-06-04 06:30:29'),
(33, 'refname', 'Trycia Murazik', 'trace.upton@example.net', 'Associate', '2024-06-05 02:37:02', '$2y$12$teGPMnsPvlvyKKTZa1gLMOEVpk03m2qEaQb0S0UpoPKQMHxEoyUTy', '+1-254-616-1382', '838-343-5222', '1-680-950-9755', '940 Rosemary Circles\nWest Cayla, NC 51480-0744', 'Port Jordynshire', '44891', 'Hawaii', NULL, NULL, NULL, '295wKBMJq6', NULL, NULL, '2024-06-05 02:37:02', '2024-06-05 02:37:02', NULL),
(34, 'refname', 'Guiseppe Beatty', 'sporer.scot@example.com', 'Associate', '2024-06-05 03:55:32', '$2y$12$67gn/KZCwpUQCnvzLkUPjeexoEe4uh/cunHvJAQknPBFlYZ1NhNSi', '906-559-3240', '+1 (806) 298-3795', '(805) 702-1891', '83026 Homenick Shores Apt. 527\nPort Mikelfurt, MS 07915-5180', 'East Beaulah', '21733', 'Idaho', NULL, NULL, NULL, 'oXTp9CD0b9', NULL, NULL, '2024-06-05 03:55:32', '2024-06-05 03:55:32', NULL),
(35, 'refnamefhfg', 'Camron Rogahn', 'waelchi.noel@example.org', 'Associate', '2024-06-05 04:01:46', '$2y$12$KEIa.Gq4MiEFGTXBl9lnAOu8m2S6KBWF/2nzbHagk4HjJ0zLTfC2O', '930-282-3898', '+17579311937', '1-714-288-7781', '532 Karli Hollow\nBradtkebury, RI 33447', 'Presleyshire', '16042-8753', 'Indiana', NULL, NULL, NULL, 'cJov03RR1Z', NULL, NULL, '2024-06-05 04:01:46', '2024-06-05 04:01:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_sessions`
--
ALTER TABLE `admission_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_sessions_university_id_foreign` (`university_id`);

--
-- Indexes for table `associates`
--
ALTER TABLE `associates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cousres`
--
ALTER TABLE `cousres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cousres_university_id_foreign` (`university_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specializations_course_id_foreign` (`cousre_id`),
  ADD KEY `specializations_university_id_foreign` (`university_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`aadhar_no`,`session_id`,`course_id`),
  ADD KEY `students_university_foreign` (`university_id`),
  ADD KEY `students_aadhar_no_session_course_index` (`aadhar_no`,`session_id`,`course_id`),
  ADD KEY `students_aadhar_no_index` (`aadhar_no`),
  ADD KEY `students_session_index` (`session_id`),
  ADD KEY `students_course_index` (`course_id`),
  ADD KEY `students_user_id_foreign` (`user_id`),
  ADD KEY `students_specialization_id_foreign` (`specialization_id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admission_sessions`
--
ALTER TABLE `admission_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `associates`
--
ALTER TABLE `associates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cousres`
--
ALTER TABLE `cousres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission_sessions`
--
ALTER TABLE `admission_sessions`
  ADD CONSTRAINT `admission_sessions_university_id_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`);

--
-- Constraints for table `cousres`
--
ALTER TABLE `cousres`
  ADD CONSTRAINT `cousres_university_id_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`);

--
-- Constraints for table `specializations`
--
ALTER TABLE `specializations`
  ADD CONSTRAINT `specializations_course_id_foreign` FOREIGN KEY (`cousre_id`) REFERENCES `cousres` (`id`),
  ADD CONSTRAINT `specializations_university_id_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_course_foreign` FOREIGN KEY (`course_id`) REFERENCES `cousres` (`id`),
  ADD CONSTRAINT `students_session_foreign` FOREIGN KEY (`session_id`) REFERENCES `admission_sessions` (`id`),
  ADD CONSTRAINT `students_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`),
  ADD CONSTRAINT `students_university_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`),
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
