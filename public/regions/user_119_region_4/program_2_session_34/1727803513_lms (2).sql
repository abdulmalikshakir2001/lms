-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 05:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `facilitators`
--

CREATE TABLE `facilitators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, 'add_teams_fields', 2),
(6, 'create_permission_tables', 2),
(7, '2024_09_17_055649_create_regions_table', 3),
(8, '2024_09_17_075936_create_programs_table', 4),
(9, '2024_09_17_082115_create_session_fors_table', 5),
(10, '2024_09_17_114302_create_sessions_table', 6),
(11, '2024_09_18_143246_create_session_deliverables_table', 7),
(18, '2024_09_18_170217_create_schools_table', 8),
(19, '2024_09_18_170535_create_parents_table', 8),
(20, '2024_09_18_170740_create_students_table', 8),
(21, '2024_09_18_170951_create_teachers_table', 8),
(22, '2024_09_18_171138_create_facilitators_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(10, 'App\\Models\\User', 108),
(13, 'App\\Models\\User', 57),
(13, 'App\\Models\\User', 108),
(14, 'App\\Models\\User', 110),
(14, 'App\\Models\\User', 111),
(14, 'App\\Models\\User', 116),
(14, 'App\\Models\\User', 117),
(14, 'App\\Models\\User', 118),
(14, 'App\\Models\\User', 119),
(14, 'App\\Models\\User', 120),
(14, 'App\\Models\\User', 121),
(14, 'App\\Models\\User', 122),
(15, 'App\\Models\\User', 109),
(15, 'App\\Models\\User', 112),
(15, 'App\\Models\\User', 113),
(15, 'App\\Models\\User', 114),
(15, 'App\\Models\\User', 115),
(15, 'App\\Models\\User', 123),
(15, 'App\\Models\\User', 124),
(15, 'App\\Models\\User', 125),
(15, 'App\\Models\\User', 126),
(15, 'App\\Models\\User', 127),
(15, 'App\\Models\\User', 128),
(15, 'App\\Models\\User', 129),
(15, 'App\\Models\\User', 130),
(16, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `father_name`, `mother_name`, `region_id`, `program_id`, `session_id`, `trainer_id`, `created_at`, `updated_at`) VALUES
(2, 'kp father 1', 'kp mother 1', 1, 1, 28, 123, '2024-09-28 14:39:14', '2024-09-28 14:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'Add Users', 'web', '2024-09-16 23:08:10', '2024-09-16 23:08:10'),
(7, 'Edit Users', 'web', '2024-09-16 23:08:17', '2024-09-16 23:08:17'),
(8, 'Delete Users', 'web', '2024-09-16 23:08:24', '2024-09-16 23:08:24'),
(9, 'View Users', 'web', '2024-09-16 23:08:32', '2024-09-16 23:08:41'),
(10, 'Add Roles', 'web', '2024-09-16 23:09:02', '2024-09-16 23:09:02'),
(11, 'View Roles', 'web', '2024-09-16 23:09:07', '2024-09-16 23:09:14'),
(12, 'Edit Roles', 'web', '2024-09-16 23:09:21', '2024-09-16 23:09:21'),
(13, 'Delete Roles', 'web', '2024-09-16 23:09:53', '2024-09-16 23:09:53'),
(14, 'Add Sessions', 'web', '2024-09-21 13:37:18', '2024-09-21 17:27:42'),
(15, 'View Sessions', 'web', '2024-09-21 13:37:40', '2024-09-21 13:37:40'),
(16, 'Edit Sessions', 'web', '2024-09-21 13:37:51', '2024-09-21 13:42:06'),
(17, 'Delete Sessions', 'web', '2024-09-21 13:38:00', '2024-09-21 13:38:00'),
(18, 'View Session Deliverables', 'web', '2024-09-21 13:40:04', '2024-09-21 13:40:04'),
(19, 'Add Schools', 'web', '2024-09-21 13:40:28', '2024-09-21 13:40:28'),
(20, 'View Schools', 'web', '2024-09-21 13:40:37', '2024-09-21 13:40:37'),
(21, 'Edit Schools', 'web', '2024-09-21 13:40:56', '2024-09-21 13:40:56'),
(22, 'Delete Schools', 'web', '2024-09-21 13:41:07', '2024-09-21 13:41:07'),
(23, 'Add Parents', 'web', '2024-09-21 13:42:23', '2024-09-21 13:42:23'),
(24, 'View Parents', 'web', '2024-09-21 13:42:30', '2024-09-21 13:42:30'),
(25, 'Edit Parents', 'web', '2024-09-21 13:42:40', '2024-09-21 13:42:40'),
(26, 'Delete Parents', 'web', '2024-09-21 13:42:51', '2024-09-21 13:42:51'),
(27, 'Add Students', 'web', '2024-09-21 13:43:00', '2024-09-21 13:43:00'),
(28, 'View Students', 'web', '2024-09-21 13:43:08', '2024-09-21 13:43:08'),
(29, 'Edit Students', 'web', '2024-09-21 13:43:16', '2024-09-21 13:43:16'),
(30, 'Delete Students', 'web', '2024-09-21 13:43:26', '2024-09-21 13:43:26'),
(31, 'Add Teachers', 'web', '2024-09-21 13:43:48', '2024-09-21 13:43:48'),
(32, 'View Teachers', 'web', '2024-09-21 13:43:56', '2024-09-21 13:43:56'),
(33, 'Edit Teachers', 'web', '2024-09-21 13:44:02', '2024-09-21 13:44:02'),
(34, 'Delete Teachers', 'web', '2024-09-21 13:44:11', '2024-09-21 13:44:11'),
(35, 'Add Facilitators', 'web', '2024-09-21 13:44:27', '2024-09-21 13:44:27'),
(36, 'View Facilitators', 'web', '2024-09-21 13:44:35', '2024-09-21 13:44:35'),
(37, 'Edit Facilitators', 'web', '2024-09-21 13:44:43', '2024-09-21 13:44:43'),
(38, 'Delete Facilitators', 'web', '2024-09-21 13:44:54', '2024-09-21 13:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Child Online Protection', 'A program aimed at protecting children online by raising awareness and providing resources.', '2024-09-17 15:17:48', '2024-09-17 15:17:48'),
(2, 'Facilitator', 'A program designed to train facilitators for various educational initiatives.', '2024-09-17 15:17:48', '2024-09-17 15:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'KPK', '2024-09-17 13:06:39', '2024-09-17 13:06:39'),
(2, 'Punjab', '2024-09-17 13:06:39', '2024-09-17 13:06:39'),
(3, 'Sindh', '2024-09-17 13:06:39', '2024-09-17 13:06:39'),
(4, 'Balochistan', '2024-09-17 13:06:39', '2024-09-17 13:06:39'),
(5, 'AJK', '2024-09-17 13:06:39', '2024-09-17 13:06:39'),
(6, 'Gilgit Baltistan', '2024-09-17 13:06:39', '2024-09-17 13:06:39'),
(7, 'Islamabad', '2024-09-17 13:06:39', '2024-09-17 13:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(10, 'Admin', 'web', '2024-09-16 23:31:55', '2024-09-16 23:31:55'),
(13, 'Staff', 'web', '2024-09-17 00:52:45', '2024-09-17 00:52:45'),
(14, 'Regional Facilitator', 'web', '2024-09-21 13:47:33', '2024-09-21 13:47:33'),
(15, 'Local Facilitator', 'web', '2024-09-21 13:48:39', '2024-09-21 13:48:39'),
(16, 'Super Admin', 'web', '2024-09-26 23:12:36', '2024-09-26 23:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 10),
(7, 10),
(8, 10),
(9, 10),
(10, 10),
(11, 10),
(11, 13),
(12, 10),
(13, 10),
(14, 14),
(14, 15),
(15, 14),
(15, 15),
(16, 14),
(16, 15),
(17, 14),
(17, 15),
(18, 14),
(18, 15),
(19, 15),
(20, 15),
(21, 15),
(22, 15),
(23, 15),
(24, 15),
(25, 15),
(26, 15),
(27, 15),
(28, 15),
(29, 15),
(30, 15),
(31, 15),
(32, 15),
(33, 15),
(34, 15),
(35, 14),
(36, 14),
(37, 14),
(38, 14);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `location`, `contact`, `region_id`, `trainer_id`, `created_at`, `updated_at`) VALUES
(1, 'kp school 1', 'kp', '231231', 1, 123, '2024-09-28 14:05:55', '2024-09-28 14:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainer` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `session_for_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'on time',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `trainer`, `program_id`, `session_for_id`, `region_id`, `name`, `description`, `status`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(9, 116, 2, 3, 1, 'For KP facilitators', NULL, 'on time', '2024-09-25', '2024-09-26', '2024-09-25 21:59:02', '2024-09-25 21:59:02'),
(10, 116, 1, 1, 1, 'For Kp students', NULL, 'postponed', '2024-09-26', '2024-09-27', '2024-09-25 22:02:33', '2024-09-26 10:50:38'),
(11, 120, 2, 3, 7, 'For Isb facillitators', NULL, 'on time', '2024-09-25', '2024-09-27', '2024-09-25 22:23:16', '2024-09-25 22:23:16'),
(12, 124, 1, 1, 7, 'For isb students', NULL, 'on time', '2024-09-25', '2024-09-27', '2024-09-25 22:25:04', '2024-09-25 22:25:04'),
(13, 117, 2, 3, 2, 'for punjab trainers', NULL, 'on time', '2024-09-04', '2024-09-19', '2024-09-25 22:31:11', '2024-09-25 22:31:11'),
(14, 125, 1, 1, 2, 'for  pj students', NULL, 'on time', '2024-09-25', '2024-09-27', '2024-09-25 22:33:43', '2024-09-25 22:33:43'),
(15, 118, 2, 3, 6, 'for gb trainers', NULL, 'on time', '2024-09-25', '2024-09-27', '2024-09-25 22:39:29', '2024-09-25 22:39:29'),
(16, 126, 1, 1, 6, 'For gb students', NULL, 'on time', '2024-09-25', '2024-09-26', '2024-09-25 22:40:56', '2024-09-25 22:40:56'),
(17, 121, 2, 3, 5, 'For ajk trainers', NULL, 'on time', '2024-09-25', '2024-09-27', '2024-09-25 22:49:41', '2024-09-25 22:49:41'),
(18, 127, 1, 1, 5, 'for ajk students', NULL, 'on time', '2024-09-25', '2024-09-26', '2024-09-25 22:51:52', '2024-09-25 22:51:52'),
(19, 122, 2, 3, 3, 'For sindh trainer', NULL, 'on time', '2024-09-25', '2024-09-27', '2024-09-25 23:46:39', '2024-09-25 23:46:39'),
(20, 128, 1, 1, 3, 'For sindh students', NULL, 'on time', '2024-09-26', '2024-09-27', '2024-09-25 23:48:57', '2024-09-25 23:48:57'),
(21, 119, 2, 3, 4, 'For bch trainers', NULL, 'on time', '2024-09-25', '2024-09-26', '2024-09-25 23:58:01', '2024-09-25 23:58:01'),
(22, 129, 1, 1, 4, 'For bch students', NULL, 'on time', '2024-09-25', '2024-09-27', '2024-09-26 00:00:49', '2024-09-26 00:00:49'),
(23, 116, 2, 3, 1, 'abc', NULL, 'on time', '2024-09-27', '2024-09-28', '2024-09-26 10:50:21', '2024-09-26 10:50:21'),
(28, 123, 1, 1, 1, 'for kp students', NULL, 'on time', '2024-09-27', '2024-09-30', '2024-09-28 14:38:03', '2024-09-28 14:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `session_deliverables`
--

CREATE TABLE `session_deliverables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session_deliverables`
--

INSERT INTO `session_deliverables` (`id`, `path`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 'regions/user_108_region_1/program_1_session_4/1726674959_husssainApplication.pdf', 4, '2024-09-18 22:55:59', '2024-09-18 22:55:59'),
(2, 'regions/user_108_region_1/program_1_session_4/1726674959_admission.pdf', 4, '2024-09-18 22:55:59', '2024-09-18 22:55:59'),
(3, 'regions/user_108_region_1/program_1_session_4/1726675091_lms (1).sql', 4, '2024-09-18 22:58:11', '2024-09-18 22:58:11'),
(4, 'regions/user_108_region_1/program_1_session_4/1726675322_Demo  DataTables - Tables  sneat - Bootstrap Dashboard PRO.csv', 4, '2024-09-18 23:02:02', '2024-09-18 23:02:02'),
(7, 'regions/user_111_region_7/program_1_session_8/1726941008_download (1).pdf', 8, '2024-09-22 00:50:08', '2024-09-22 00:50:08'),
(8, 'regions/user_111_region_7/program_1_session_8/1726941008_download.pdf', 8, '2024-09-22 00:50:08', '2024-09-22 00:50:08'),
(9, 'regions/user_116_region_1/program_2_session_9/1727276342_Fee Structure_2024_25.pdf', 9, '2024-09-25 21:59:02', '2024-09-25 21:59:02'),
(10, 'regions/user_123_region_1/program_1_session_10/1727276553_download (1).pdf', 10, '2024-09-25 22:02:33', '2024-09-25 22:02:33'),
(11, 'regions/user_120_region_7/program_2_session_11/1727277796_complex_numbers.pdf', 11, '2024-09-25 22:23:16', '2024-09-25 22:23:16'),
(12, 'regions/user_124_region_7/program_1_session_12/1727277904_download.pdf', 12, '2024-09-25 22:25:04', '2024-09-25 22:25:04'),
(13, 'regions/user_117_region_2/program_2_session_13/1727278271_letter.pdf', 13, '2024-09-25 22:31:11', '2024-09-25 22:31:11'),
(14, 'regions/user_125_region_2/program_1_session_14/1727278423_Hassnain Hafeez.pdf', 14, '2024-09-25 22:33:43', '2024-09-25 22:33:43'),
(15, 'regions/user_118_region_6/program_2_session_15/1727278769_complex_numbers.pdf', 15, '2024-09-25 22:39:29', '2024-09-25 22:39:29'),
(16, 'regions/user_126_region_6/program_1_session_16/1727278856_bg_pic.webp', 16, '2024-09-25 22:40:56', '2024-09-25 22:40:56'),
(17, 'regions/user_121_region_5/program_2_session_17/1727279381_bg_pic.webp', 17, '2024-09-25 22:49:41', '2024-09-25 22:49:41'),
(18, 'regions/user_127_region_5/program_1_session_18/1727279512_1726674959_husssainApplication.pdf', 18, '2024-09-25 22:51:52', '2024-09-25 22:51:52'),
(19, 'regions/user_122_region_3/program_2_session_19/1727282799_bg_pic.webp', 19, '2024-09-25 23:46:39', '2024-09-25 23:46:39'),
(20, 'regions/user_128_region_3/program_1_session_20/1727282937_1726674959_husssainApplication.pdf', 20, '2024-09-25 23:48:57', '2024-09-25 23:48:57'),
(21, 'regions/user_119_region_4/program_2_session_21/1727283481_react-handbook.pdf', 21, '2024-09-25 23:58:01', '2024-09-25 23:58:01'),
(22, 'regions/user_129_region_4/program_1_session_22/1727283649_bg_pic.webp', 22, '2024-09-26 00:00:49', '2024-09-26 00:00:49'),
(23, 'regions/user_116_region_1/program_2_session_23/1727322621_1726674959_husssainApplication.pdf', 23, '2024-09-26 10:50:21', '2024-09-26 10:50:21'),
(25, 'regions/user_123_region_1/program_1_session_25/1727455670_1726674959_husssainApplication.pdf', 25, '2024-09-27 23:47:50', '2024-09-27 23:47:50'),
(26, 'regions/user_123_region_1/program_2_session_26/1727456260_1726674959_husssainApplication.pdf', 26, '2024-09-27 23:57:40', '2024-09-27 23:57:40'),
(28, 'regions/user_123_region_1/program_1_session_28/1727509083_download (1).pdf', 28, '2024-09-28 14:38:03', '2024-09-28 14:38:03'),
(29, 'regions/user_123_region_1/program_1_session_28/1727509083_download.pdf', 28, '2024-09-28 14:38:03', '2024-09-28 14:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `session_fors`
--

CREATE TABLE `session_fors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session_fors`
--

INSERT INTO `session_fors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Students', '2024-09-17 15:35:33', '2024-09-17 15:35:33'),
(2, 'Edu Partners', '2024-09-17 15:35:33', '2024-09-17 15:35:33'),
(3, 'Trainers', '2024-09-17 15:35:33', '2024-09-17 15:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `parent_id`, `school_id`, `program_id`, `session_id`, `region_id`, `trainer_id`, `created_at`, `updated_at`) VALUES
(2, 'abc', 2, 1, 1, 28, 1, 123, '2024-09-28 14:39:36', '2024-09-28 14:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `region_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `region_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'hassnain', 'company@example.com', NULL, '$2y$12$bGuC4WogDFupf/tzhkzxrOkzO.witPxl5DiFcbWC3xdLu6W/uluEu', 'user', NULL, NULL, '2024-08-29 19:26:38', '2024-08-29 19:26:38'),
(116, 'kpregional', 'kpregional@example.com', NULL, '$2y$12$4ZC0LLiV7pzLvjWt13koAurKMycGv36uVgQ3Alsdy95vJO5uLWWEO', 'intra trainer', 1, NULL, '2024-09-25 21:51:48', '2024-09-25 21:51:48'),
(117, 'pjregional', 'pjregional@example.com', NULL, '$2y$12$gAX2vv0WoCAgP00ALWmjwOP4vGwhoIRAUfjGVv7JU7RFnh/c/.KUy', 'intra trainer', 2, NULL, '2024-09-25 21:52:33', '2024-09-25 21:52:33'),
(118, 'gbregional', 'gbregional@example.com', NULL, '$2y$12$0qYPQK.UwLkfATzVAlN9Z.N2KpCxEA0TWGiXm96tEgrvOBT1JRxOu', 'intra trainer', 6, NULL, '2024-09-25 21:53:09', '2024-09-25 21:53:09'),
(119, 'bchregional', 'bchregional@example.com', NULL, '$2y$12$Wf7dJBLHSxNoLFMgq3bpiesdAN5MldfTdjM7Rkig8bDINnbAqaUzK', 'intra trainer', 4, NULL, '2024-09-25 21:53:58', '2024-09-25 21:53:58'),
(120, 'isbregional', 'isbregional@example.com', NULL, '$2y$12$J3UtMXUJh84lJWZSWZWBtuN3KMFjjpssS.ctCKfTmNlhC.ffk/xlO', 'intra trainer', 7, NULL, '2024-09-25 21:54:41', '2024-09-25 21:54:41'),
(121, 'ajkregional', 'ajkregional@example.com', NULL, '$2y$12$2OkkpLB/zHKMRp/D4S6sTuq2rfDVZ7uBKbaVPClUQnVYlvML75vQm', 'intra trainer', 5, NULL, '2024-09-25 21:55:27', '2024-09-25 21:55:27'),
(122, 'sdregional', 'sdregional@example.com', NULL, '$2y$12$cJGQ.DlxNtmnHSlRH2GW8epftdnKGTFki0CQggQoBij2WfcuVUA6y', 'intra trainer', 3, NULL, '2024-09-25 21:56:08', '2024-09-25 21:56:08'),
(123, 'kplocal', 'kplocal@example.com', NULL, '$2y$12$h7hgK.mpjFC7KmtXyuQYvOHD6M3wThS50k/I67BaI9v.am9gnR4A2', 'local trainer', 1, NULL, '2024-09-25 21:59:40', '2024-09-25 21:59:40'),
(124, 'isb facilitator', 'isblocal@example.com', NULL, '$2y$12$PsbxdUkKT7RPjuk4HqzmRO/1OxQXrJt9s9NkNPdrz6piKSUcgUaGC', 'local trainer', 7, NULL, '2024-09-25 22:24:02', '2024-09-25 22:24:02'),
(125, 'pjlocal', 'pjlocal@example.com', NULL, '$2y$12$pinna99H0GvGc3/CjkNJt.6LZx.37OIQrjLn5ceTyaOK/eIvjBhcC', 'local trainer', 2, NULL, '2024-09-25 22:31:50', '2024-09-25 22:31:50'),
(126, 'gblocal', 'gblocal@example.com', NULL, '$2y$12$j4tYX6E58Spe2xo47wJo4.wK5wVKWka7YXu7Gm2hHOk3vVQ16.XGq', 'local trainer', 6, NULL, '2024-09-25 22:39:59', '2024-09-25 22:39:59'),
(127, 'ajk local', 'ajklocal@example.com', NULL, '$2y$12$9UX5Q3UtFohcOCd4XDvizO7Ukp2kygDgtnTayweg/yi9AYyDU9fNu', 'local trainer', 5, NULL, '2024-09-25 22:50:40', '2024-09-25 22:50:40'),
(128, 'sd local', 'sdlocal@example.com', NULL, '$2y$12$yPk8D3iRUi4v91EhsDTiR.3mzkdvFZG/BCoUnq.t5Bp8eepdEYdVW', 'local trainer', 3, NULL, '2024-09-25 23:47:15', '2024-09-25 23:47:15'),
(129, 'bch local', 'bchlocal@example.com', NULL, '$2y$12$DUwy6jtDdDDAzR54Ba3glOfSQ8YjiRldIVwzK72Xd4mS1jLYIcK0W', 'local trainer', 4, NULL, '2024-09-25 23:58:57', '2024-09-25 23:58:57'),
(130, 'abc local', 'abclocal@example.com', NULL, '$2y$12$pwZuuQTbeN9khB/0n86fSOTVSHiYbY2jDYkHWVaCvZ15.57jwyp4G', 'local trainer', 1, NULL, '2024-09-26 10:51:13', '2024-09-26 10:51:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facilitators`
--
ALTER TABLE `facilitators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facilitators_session_id_foreign` (`session_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parents_session_id_foreign` (`session_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_deliverables`
--
ALTER TABLE `session_deliverables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_fors`
--
ALTER TABLE `session_fors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_session_id_foreign` (`session_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_session_id_foreign` (`session_id`);

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
-- AUTO_INCREMENT for table `facilitators`
--
ALTER TABLE `facilitators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `session_deliverables`
--
ALTER TABLE `session_deliverables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `session_fors`
--
ALTER TABLE `session_fors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `facilitators`
--
ALTER TABLE `facilitators`
  ADD CONSTRAINT `facilitators_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
