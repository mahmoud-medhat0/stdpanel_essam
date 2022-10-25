-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2022 at 07:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sec_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mahmoud medhat', 'hetlarhhs@gmail.com', '$2y$10$nXBOO53h.jep3IPxONDIEew26P3TRS0aE9zsk3jFhbfgO4CGXIhGq', NULL, 'SBMKjm3yNM93Rfs9wCi3VidPZxWKDJH4bCeRsElRvfXT89eRPi1mT2JKTxY1', '2022-10-06 11:18:48', '2022-10-06 11:18:48'),
(4, 'mm mm', 'efotqz@hi2.in', '$2y$10$qWM24dGrGNjtmEAZEv7G.emVP3U3/cv8TvCYcmAUcAozvdthcz1qC', NULL, NULL, '2022-10-15 18:52:18', '2022-10-15 19:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `attendence_f`
--

CREATE TABLE `attendence_f` (
  `id` int(20) UNSIGNED NOT NULL,
  `std_id` int(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `attendence` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `hw` tinyint(1) NOT NULL DEFAULT 0,
  `payed` char(5) DEFAULT NULL,
  `reset` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `attendence_m`
--

CREATE TABLE `attendence_m` (
  `id` int(20) UNSIGNED NOT NULL,
  `std_id` int(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `attendence` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `hw` tinyint(1) NOT NULL DEFAULT 0,
  `payed` char(5) DEFAULT NULL,
  `reset` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendence_m`
--

INSERT INTO `attendence_m` (`id`, `std_id`, `date`, `attendence`, `hw`, `payed`, `reset`) VALUES
(59, 20, '2022-10-22', 2, 0, '*', '*');

-- --------------------------------------------------------

--
-- Table structure for table `exams_f`
--

CREATE TABLE `exams_f` (
  `id` int(20) UNSIGNED NOT NULL,
  `std_id` int(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `degree` char(50) DEFAULT '*',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `exams_m`
--

CREATE TABLE `exams_m` (
  `id` int(20) UNSIGNED NOT NULL,
  `std_id` int(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `degree` char(50) DEFAULT '*',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exercises_f`
--

CREATE TABLE `exercises_f` (
  `id` int(20) UNSIGNED NOT NULL,
  `std_id` int(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `degree` char(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `exercises_m`
--

CREATE TABLE `exercises_m` (
  `id` int(20) UNSIGNED NOT NULL,
  `std_id` int(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `degree` char(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_10_06_122311_admins', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_f`
--

CREATE TABLE `students_f` (
  `id` int(20) UNSIGNED NOT NULL,
  `username` char(50) NOT NULL,
  `name` varchar(512) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `phone` char(11) DEFAULT NULL,
  `p_phone` char(11) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `sumprep` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `students_f`
--

INSERT INTO `students_f` (`id`, `username`, `name`, `password`, `created_at`, `updated_at`, `phone`, `p_phone`, `verified`, `sumprep`) VALUES
(21, 'hetltik1@gmail.com', 'hagar', '$2y$10$OWOK1D5Hp.lsZ8ZX1noS0.El5G/1SeTPpEf4Af32uN/MqCliyyaQW', '2022-10-22 16:01:48', '2022-10-22 16:56:28', '1148422800', '1148422800', 1, '111');

-- --------------------------------------------------------

--
-- Table structure for table `students_m`
--

CREATE TABLE `students_m` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(512) NOT NULL,
  `username` char(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `phone` char(11) DEFAULT NULL,
  `p_phone` char(11) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `sumprep` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_m`
--

INSERT INTO `students_m` (`id`, `name`, `username`, `password`, `created_at`, `updated_at`, `phone`, `p_phone`, `verified`, `sumprep`) VALUES
(20, 'mm mm', '[\"required\",\"max:255\"]', '$2y$10$4TVl/.or9T6msgIGaMdunOr/0k4lQ4Yagykwg49ucRP/C18Z8jCGe', '2022-10-21 00:12:54', '2022-10-22 16:44:39', '1148422820', '1148422820', 1, NULL),
(24, 'mm mm', 'rflkdlk', '$2y$10$h.EtQxSNBu5Za6gU4A77AOz757gLbQ.GTkU1GXVuWuJgQo9Bgpyuy', '2022-10-22 15:34:44', '2022-10-22 17:06:49', '*', '01148422821', 1, NULL),
(25, 'mm mm', 'Mouuabdallah@gmail.com', '$2y$10$XGOAkKcSwKxnXRlVn6/tT.UyEEl6CXq.XwSKr4VNDH3w.xF4cJfI6', '2022-10-22 16:54:09', '2022-10-23 13:41:08', '01148422899', '01148422899', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attendence_f`
--
ALTER TABLE `attendence_f`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_attendence_students` (`std_id`) USING BTREE;

--
-- Indexes for table `attendence_m`
--
ALTER TABLE `attendence_m`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_attendence_students` (`std_id`);

--
-- Indexes for table `exams_f`
--
ALTER TABLE `exams_f`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_exams_students` (`std_id`) USING BTREE;

--
-- Indexes for table `exams_m`
--
ALTER TABLE `exams_m`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_exams_students` (`std_id`);

--
-- Indexes for table `exercises_f`
--
ALTER TABLE `exercises_f`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_exercises_students` (`std_id`) USING BTREE;

--
-- Indexes for table `exercises_m`
--
ALTER TABLE `exercises_m`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_exercises_students` (`std_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `students_f`
--
ALTER TABLE `students_f`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `phone` (`phone`) USING BTREE;

--
-- Indexes for table `students_m`
--
ALTER TABLE `students_m`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendence_f`
--
ALTER TABLE `attendence_f`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `attendence_m`
--
ALTER TABLE `attendence_m`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `exams_f`
--
ALTER TABLE `exams_f`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `exams_m`
--
ALTER TABLE `exams_m`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `exercises_f`
--
ALTER TABLE `exercises_f`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `exercises_m`
--
ALTER TABLE `exercises_m`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_f`
--
ALTER TABLE `students_f`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students_m`
--
ALTER TABLE `students_m`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendence_f`
--
ALTER TABLE `attendence_f`
  ADD CONSTRAINT `attendence_f_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `students_m` (`id`);

--
-- Constraints for table `attendence_m`
--
ALTER TABLE `attendence_m`
  ADD CONSTRAINT `FK_attendence_students` FOREIGN KEY (`std_id`) REFERENCES `students_m` (`id`);

--
-- Constraints for table `exams_f`
--
ALTER TABLE `exams_f`
  ADD CONSTRAINT `exams_f_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `students_m` (`id`);

--
-- Constraints for table `exams_m`
--
ALTER TABLE `exams_m`
  ADD CONSTRAINT `FK_exams_students` FOREIGN KEY (`std_id`) REFERENCES `students_m` (`id`);

--
-- Constraints for table `exercises_f`
--
ALTER TABLE `exercises_f`
  ADD CONSTRAINT `exercises_f_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `students_m` (`id`);

--
-- Constraints for table `exercises_m`
--
ALTER TABLE `exercises_m`
  ADD CONSTRAINT `FK_exercises_students` FOREIGN KEY (`std_id`) REFERENCES `students_m` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
