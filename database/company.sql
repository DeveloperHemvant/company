-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2024 at 04:32 PM
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startmonth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endmonth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_sessions`
--

INSERT INTO `admission_sessions` (`id`, `name`, `startmonth`, `endmonth`, `university_id`, `created_at`, `updated_at`) VALUES
(10, 'January-June 2024', '2024-01', '2024-06', 12, '2024-05-20 02:23:34', '2024-05-20 02:35:45'),
(11, 'January-June 2024', '2024-01', '2024-06', 8, '2024-05-20 03:35:42', '2024-05-20 03:35:42'),
(12, 'March-August 2024', '2024-03', '2024-08', 9, '2024-05-20 03:36:06', '2024-05-20 03:36:06'),
(13, 'February-August 2024', '2024-02', '2024-08', 12, '2024-05-20 03:36:19', '2024-05-20 03:37:21'),
(14, 'February-June 2024', '2024-02', '2024-06', 8, '2024-05-20 03:36:54', '2024-05-20 03:36:54'),
(15, 'June-November 2024', '2024-06', '2024-11', 9, '2024-05-20 03:37:10', '2024-05-20 03:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `associates`
--

CREATE TABLE `associates` (
  `id` bigint UNSIGNED NOT NULL,
  `associate_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1716286161),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1716286161;', 1716286161),
('509a8d0bf4ae0a9f97cc43dbdbb624ba', 'i:1;', 1716288999),
('509a8d0bf4ae0a9f97cc43dbdbb624ba:timer', 'i:1716288999;', 1716288999),
('b5a0d52329a0c82038e180aa7fe9ad52', 'i:1;', 1716288795),
('b5a0d52329a0c82038e180aa7fe9ad52:timer', 'i:1716288795;', 1716288795);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cousres`
--

CREATE TABLE `cousres` (
  `id` bigint UNSIGNED NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `university_id` bigint UNSIGNED DEFAULT NULL,
  `course_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cousres`
--

INSERT INTO `cousres` (`id`, `course_name`, `created_at`, `updated_at`, `university_id`, `course_type`, `duration`) VALUES
(19, 'BA', '2024-05-20 00:48:14', '2024-05-20 01:38:10', 8, 'UG', '8 Semester'),
(20, 'BCA', '2024-05-20 03:37:50', '2024-05-20 03:37:50', 8, 'UG', '6 Semester'),
(21, 'MCA', '2024-05-20 03:38:40', '2024-05-20 03:38:40', 9, 'PG', '4 Semester'),
(22, 'MA', '2024-05-20 03:38:55', '2024-05-20 03:38:55', 9, 'PG', '4 Semester');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(25, '2024_05_20_074802_add_university_id_column_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `programme_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PqvkvPfHJC4Chn1XpHAdfjUrwHv9Y7dlXzG1A9eU', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS2ZyYjJ1cWpEWm0wTFVEZlZ1ZTlraExkaEVObmxSRHFDQVRrN3huViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRBdGJBVnRTdmc5R2R6R2FBOWtpRXEuZzdLMkhsSExDZXRkdzVTNGZuYVZrNVFDZ2piTjB6NiI7fQ==', 1716288939);

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint UNSIGNED NOT NULL,
  `specialization_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `specialization_name`, `course_id`, `created_at`, `updated_at`) VALUES
(13, 'Hindi', 19, '2024-05-20 01:11:33', '2024-05-20 01:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `university_id` bigint UNSIGNED NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `associate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sr_no` int DEFAULT NULL,
  `uni_reg_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mob_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `spl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sem_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` bigint UNSIGNED NOT NULL,
  `previous_migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uni_visit_date` date NOT NULL,
  `pass_back` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `documents` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint UNSIGNED NOT NULL,
  `university_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `university_name`, `university_code`, `created_at`, `updated_at`) VALUES
(8, 'SVSU', 'SVSU', '2024-05-07 00:55:37', '2024-05-21 01:08:34'),
(9, 'KU', 'KU', '2024-05-07 00:56:14', '2024-05-07 00:56:14'),
(10, 'SGVU', 'SGVU', '2024-05-07 00:56:25', '2024-05-07 00:56:25'),
(11, 'CVRU-BIHAR', 'CVRU-BIHAR', '2024-05-07 00:56:34', '2024-05-07 00:56:34'),
(12, 'CVRU-CG', 'CVRU-CG', '2024-05-07 00:56:43', '2024-05-07 00:56:43'),
(13, 'CVRU-MP', 'CVRU-MP', '2024-05-07 00:56:50', '2024-05-07 00:56:50'),
(14, 'RNTU-MP', 'RNTU-MP', '2024-05-07 00:56:57', '2024-05-07 00:56:57'),
(15, 'AISECT-JH', 'AISECT-JH', '2024-05-07 00:57:05', '2024-05-07 00:57:05'),
(16, 'SGU -MP', 'SGU -MP', '2024-05-07 00:57:12', '2024-05-07 00:57:12'),
(17, 'AISECT SKILL', 'AISECT SKILL', '2024-05-07 00:57:20', '2024-05-07 00:57:20'),
(18, 'MU', 'MU', '2024-05-07 00:57:28', '2024-05-07 00:57:28'),
(19, 'MSGU', 'MSGU', '2024-05-07 00:57:36', '2024-05-07 00:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Associate',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usertype`, `email_verified_at`, `password`, `mobile`, `address`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'hemvant@webguruz.in', 'admin', NULL, '$2y$12$KqDJ477DVc9jCIRHeMW81.ZJzPsOGD2XL1o02/ri39GPjNYsMtJCO', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-01 22:49:22', '2024-05-01 22:49:22'),
(2, 'Hemvant', 'gurpreet@webguruz.in', 'Associate', NULL, '$2y$12$AtbAVtSvg9GdzGaA9kiEq.g7K2HlHLCetdw5S4fnaVk5QCgjbN0z6', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-01 22:50:16', '2024-05-01 22:50:16'),
(4, 'Testing', 'testing@webguruz.in', 'Associate', NULL, '$2y$12$nWFY3kIg/DEqwg/ea7ZDPu5TQdpGnGFIANg04hF39xrDFYsHHzwDW', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-17 07:03:14', '2024-05-17 07:03:14'),
(7, 'asdfsadf', 'hemvant@gmail.com', 'Associate', NULL, NULL, '7894561230', 'mohali', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-20 01:57:58', '2024-05-20 01:57:58'),
(8, 'good', 'hemvnalskaj@gmail.com', 'Associate', NULL, NULL, '7897897897', 'asjlkflsadf', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-20 02:02:30', '2024-05-20 02:07:59');

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
  ADD KEY `specializations_course_id_foreign` (`course_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`aadhar_no`,`session`,`course_id`),
  ADD KEY `students_university_foreign` (`university_id`),
  ADD KEY `students_aadhar_no_session_course_index` (`aadhar_no`,`session`,`course_id`),
  ADD KEY `students_aadhar_no_index` (`aadhar_no`),
  ADD KEY `students_session_index` (`session`),
  ADD KEY `students_course_index` (`course_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `associates`
--
ALTER TABLE `associates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cousres`
--
ALTER TABLE `cousres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission_sessions`
--
ALTER TABLE `admission_sessions`
  ADD CONSTRAINT `admission_sessions_university_id_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cousres`
--
ALTER TABLE `cousres`
  ADD CONSTRAINT `cousres_university_id_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `specializations`
--
ALTER TABLE `specializations`
  ADD CONSTRAINT `specializations_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `cousres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_course_foreign` FOREIGN KEY (`course_id`) REFERENCES `cousres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_session_foreign` FOREIGN KEY (`session`) REFERENCES `admission_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_university_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
