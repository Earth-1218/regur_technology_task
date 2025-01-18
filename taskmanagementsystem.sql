-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2025 at 04:08 PM
-- Server version: 8.0.30
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskmanagementsystem`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_01_17_143922_create_tasks_table', 2);

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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('todo','in_progress','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'todo',
  `category` enum('work','personal','miscellaneous') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `due_date`, `status`, `category`, `created_at`, `updated_at`) VALUES
(3, 2, 'Task 3', 'Description for Task 3', '2025-01-25', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(4, 2, 'Task 4', 'Description for Task 4', '2025-01-28', 'todo', 'work', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(5, 2, 'Task 5', 'Description for Task 5', '2025-01-30', 'in_progress', 'personal', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(6, 2, 'Task 6', 'Description for Task 6', '2025-02-02', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(7, 2, 'Task 7', 'Description for Task 7', '2025-02-04', 'todo', 'work', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(8, 2, 'Task 8', 'Description for Task 8', '2025-02-06', 'in_progress', 'personal', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(9, 2, 'Task 9', 'Description for Task 9', '2025-02-08', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(10, 2, 'Task 10', 'Description for Task 10', '2025-02-10', 'todo', 'work', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(11, 2, 'Task 77', 'Description for Task 11', '2025-02-12', 'in_progress', 'personal', '2025-01-18 07:03:36', '2025-01-18 02:42:26'),
(12, 2, 'Task 12', 'Description for Task 12', '2025-02-14', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(13, 2, 'Task 13', 'Description for Task 13', '2025-02-16', 'todo', 'work', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(14, 2, 'Task 14', 'Description for Task 14', '2025-02-18', 'in_progress', 'personal', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(15, 2, 'Task 15', 'Description for Task 15', '2025-02-20', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(16, 2, 'Task 16', 'Description for Task 16', '2025-02-22', 'todo', 'work', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(17, 2, 'Task 17', 'Description for Task 17', '2025-02-24', 'in_progress', 'personal', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(18, 2, 'Task 18', 'Description for Task 18', '2025-02-26', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(19, 2, 'Task 19', 'Description for Task 19', '2025-02-28', 'todo', 'work', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(20, 2, 'Task 20', 'Description for Task 20', '2025-03-02', 'in_progress', 'personal', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(21, 2, 'Task 21', 'Description for Task 21', '2025-03-04', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(22, 2, 'Task 22', 'Description for Task 22', '2025-03-06', 'todo', 'work', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(23, 2, 'Task 23', 'Description for Task 23', '2025-03-08', 'in_progress', 'personal', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(24, 2, 'Task 24', 'Description for Task 24', '2025-03-10', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(25, 2, 'Task 25', 'Description for Task 25', '2025-03-12', 'todo', 'work', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(26, 2, 'Task 26', 'Description for Task 26', '2025-03-14', 'in_progress', 'personal', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(27, 2, 'Task 27', 'Description for Task 27', '2025-03-16', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(28, 2, 'Task 28', 'Description for Task 28', '2025-03-18', 'todo', 'work', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(29, 2, 'Task 29', 'Description for Task 29', '2025-03-20', 'in_progress', 'personal', '2025-01-18 07:03:36', '2025-01-18 07:03:36'),
(30, 2, 'Task 30', 'Description test', '2025-03-22', 'done', 'miscellaneous', '2025-01-18 07:03:36', '2025-01-18 02:50:45'),
(33, 2, 'Test', 'Test', '2024-12-12', 'todo', 'work', '2025-01-18 05:11:04', '2025-01-18 05:11:04'),
(34, 2, 'Task completed', 'Task completed', '2025-12-12', 'todo', 'personal', '2025-01-18 05:12:22', '2025-01-18 07:59:07'),
(35, 2, 'Task completed', 'Task completed', '2025-12-12', 'in_progress', 'personal', '2025-01-18 05:12:22', '2025-01-18 05:12:22'),
(36, 2, 'Test', 'Test', '2025-01-24', 'in_progress', 'work', '2025-01-18 05:58:12', '2025-01-18 06:03:09'),
(37, 4, 'Test Task', 'Test Description', '2025-01-18', 'done', 'personal', '2025-01-18 07:25:04', '2025-01-18 07:25:28'),
(38, 5, 'test123', 'test123', '2025-01-21', 'in_progress', 'personal', '2025-01-18 07:57:24', '2025-01-18 07:57:45'),
(39, 2, 'test', 'test', '2025-01-22', 'todo', 'miscellaneous', '2025-01-18 07:59:28', '2025-01-18 07:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Ravi', 'ravimajithiya786@gmail.com', NULL, '$2y$12$tKBDGaKnblBF2yIYKJHm/.JPVjqJ8V8hTWfEBgzaEjqhezcz.BhUK', NULL, NULL, '2025-01-17 11:34:10', '2025-01-17 11:34:10'),
(2, 'John', 'john@doe.com', NULL, '$2y$12$RDXEwvcE5n4rBlPXVYyQ2.VvF7qzdiAFf6z.DcKM4wn7KrorP1LRG', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iLCJpYXQiOjE3MzcyMTU0ODIsImV4cCI6MTczNzIxOTA4MiwibmJmIjoxNzM3MjE1NDgyLCJqdGkiOiJpQXFXYWd4aEg4YjJRRDNGIiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.Qizw0m6Di6WNz3IwBFwSQp7X3s2ld2ZLRk1XKoYMeQI', '2025-01-17 11:59:11', '2025-01-18 10:21:22'),
(3, 'Ravi', 'ravimajithiya3287263@gmail.com', NULL, '$2y$12$moQRhZgD9BGkF6wZsDEAv.gJbLbUnsr9nTRxYfvJHhlWBJkn6eBgm', NULL, NULL, '2025-01-17 13:53:39', '2025-01-17 13:53:39'),
(4, 'Ravi', 'ravimajithiya1122@gmail.com', NULL, '$2y$12$afG.WYF10LlRsFNQG81/p.kvrNjlSyQ/NlLp2qdtBn16eGyEFmVLe', NULL, NULL, '2025-01-18 07:24:35', '2025-01-18 07:24:35'),
(5, 'Ravi', 'admin@admin.com', NULL, '$2y$12$jrYMwqVYWIBArU2naBOGYO/H97yTX5J1C4pKFh6cRr01ggcb9mSrG', NULL, NULL, '2025-01-18 07:56:50', '2025-01-18 07:56:50');

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
