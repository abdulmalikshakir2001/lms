-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 07:58 PM
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
(6, 'create_permission_tables', 2);

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
(10, 'App\\Models\\User', 4),
(13, 'App\\Models\\User', 4);

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
(13, 'Delete Roles', 'web', '2024-09-16 23:09:53', '2024-09-16 23:09:53');

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
(13, 'Staff', 'web', '2024-09-17 00:52:45', '2024-09-17 00:52:45');

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
(9, 13),
(10, 10),
(11, 10),
(11, 13),
(12, 10),
(13, 10);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'hassnain', 'company@example.com', NULL, '$2y$12$bGuC4WogDFupf/tzhkzxrOkzO.witPxl5DiFcbWC3xdLu6W/uluEu', NULL, '2024-08-29 19:26:38', '2024-08-29 19:26:38'),
(7, 'Gerardo Schumm', 'hegmann.erick@example.org', '2024-09-15 16:24:05', '$2y$12$dWpqdVUxGe3gND839YJQW.mgzf58nkYYkN1wsD.Wf.JBf8OEo4i3W', 'vSVezabzfp', '2024-09-15 16:24:06', '2024-09-15 16:24:06'),
(8, 'Nyasia Armstrong', 'clifton80@example.net', '2024-09-15 16:24:06', '$2y$12$dWpqdVUxGe3gND839YJQW.mgzf58nkYYkN1wsD.Wf.JBf8OEo4i3W', 'AWnV1BnTSw', '2024-09-15 16:24:06', '2024-09-15 16:24:06'),
(9, 'Cristal McCullough', 'prosacco.omer@example.com', '2024-09-15 16:24:06', '$2y$12$dWpqdVUxGe3gND839YJQW.mgzf58nkYYkN1wsD.Wf.JBf8OEo4i3W', 'T3huhlHAt7', '2024-09-15 16:24:06', '2024-09-15 16:24:06'),
(57, 'Staff', 'staff@example.com', NULL, '$2y$12$tMToc.ZKcG1/8LCv4p9HuuKLDZd5APW.DEs41V92ZnfeUlLQ.hRTK', NULL, '2024-09-16 23:51:44', '2024-09-16 23:51:44'),
(58, 'Dr. Stefanie Huel IV', 'rosalyn68@example.com', '2024-09-17 00:50:50', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', '1VbNWGvchx', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(59, 'Shea Fritsch', 'lframi@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'A8OgsA0YCZ', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(60, 'Cleta Terry', 'wwintheiser@example.net', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', '2GiqcAwud9', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(61, 'Peggie Emard', 'grady.quentin@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', '4C8bRkZJWC', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(62, 'Dr. Narciso Bosco', 'oconner.frederique@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'l6gEvJqlE0', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(63, 'Heidi Simonis', 'kennith.ziemann@example.net', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', '3EMG2TljM7', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(64, 'Prof. Jayson Pfannerstill Jr.', 'nico32@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'Zpaw9GMNon', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(65, 'Mr. Bryce Keeling Sr.', 'gaylord.rubie@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'BMdwm6Ebif', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(66, 'Grady Reynolds', 'dziemann@example.net', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'EBLW5YFh2B', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(67, 'Carley Stroman', 'caitlyn.stiedemann@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'N1SYVLfME3', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(68, 'Mrs. Marisol Goldner IV', 'sibyl.witting@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', '2gFkzphzLC', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(69, 'Westley Koelpin', 'jeanne48@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'hzi76Xoy68', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(70, 'Mr. Cyril Boehm III', 'zboncak.favian@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'HMlreqbgpG', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(71, 'Ayana Ruecker Jr.', 'okeefe.mariana@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'xpg2CltH7P', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(72, 'Gabriella Towne', 'gjast@example.net', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'FTaA6k6Mus', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(73, 'Jaylon Pfeffer II', 'gusikowski.connie@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'VpoTqAD1Lp', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(74, 'Berneice Schneider', 'ryder86@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'LumU8qtKOr', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(75, 'Josephine Harber', 'patsy.larkin@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'xgd1mI31Zn', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(76, 'Garrison Dietrich I', 'ignatius82@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'SMlFdIYtLF', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(77, 'Elisabeth Jacobi', 'beaulah.stiedemann@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'iEhYmCftRW', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(78, 'Mckayla McClure', 'kkling@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'uXTW5zCobt', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(79, 'Rossie Langworth', 'shettinger@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', '3q3PCKo2S9', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(80, 'Dr. Ramona Ortiz', 'fromaguera@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', '8dW5AwaMHR', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(81, 'Rudy Lebsack IV', 'jewel.rempel@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'v3VF7wqaue', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(82, 'Mrs. Candace Ortiz Sr.', 'fmarvin@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'mq6iA20JIj', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(83, 'Martine Ullrich I', 'tsatterfield@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'k42cy88gZY', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(84, 'Ardella Murphy', 'price.nichole@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'HjBIln3387', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(85, 'Ms. Marietta Pagac II', 'earnestine80@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'PLUfAFqi3Q', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(86, 'Queenie Pfannerstill', 'georgiana97@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'hZ1WLUilIM', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(87, 'Gail Langosh', 'rolando.oreilly@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'U2ZBWui4pB', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(88, 'Hoyt Schowalter', 'lziemann@example.net', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'ebmtNtIVNI', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(89, 'Miss Sallie Bechtelar', 'cruz.stiedemann@example.net', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'xLaFBDsHC1', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(90, 'Brandt Kunde', 'bobbie.dickinson@example.org', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'Efj55bzaNH', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(91, 'Dr. Garland Steuber III', 'dulce87@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'W12JDkzxk5', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(92, 'Miss Jenifer Dach', 'louvenia49@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'JJKaWNYTWR', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(93, 'Claudia Schulist', 'cweimann@example.net', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'SSoh1xDvuO', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(94, 'Cayla Langworth', 'torp.westley@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', '4BkWPv5jZv', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(95, 'Prof. Fabian Toy V', 'troob@example.net', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'Q7y3YTa2xQ', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(96, 'Oma Jakubowski', 'emilie24@example.com', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'At6xUPWsLh', '2024-09-17 00:50:51', '2024-09-17 00:50:51'),
(97, 'Marguerite Block', 'ezequiel97@example.net', '2024-09-17 00:50:51', '$2y$12$1J2BdpeoG37VRCNrSwQ/AOC8Xp6yp/FAiFR5SmawvtZPTwHxhilES', 'CsnsZzMLXl', '2024-09-17 00:50:51', '2024-09-17 00:50:51');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
