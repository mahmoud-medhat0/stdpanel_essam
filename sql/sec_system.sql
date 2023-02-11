-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2023 at 10:24 PM
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
(1, 'mahmoud medhat', 'hetlarhhs@gmail.com', '$2y$10$nXBOO53h.jep3IPxONDIEew26P3TRS0aE9zsk3jFhbfgO4CGXIhGq', NULL, 'VgVAXZH7e0XpnpI1vnYkNi6WNXop6eTSWR56g3ZwPxlTOjeZfLZDl2Dh3Mno', '2022-10-06 11:18:48', '2022-10-06 11:18:48'),
(4, 'mm mm', 'efotqz@hi2.in', '$2y$10$qWM24dGrGNjtmEAZEv7G.emVP3U3/cv8TvCYcmAUcAozvdthcz1qC', NULL, NULL, '2022-10-15 18:52:18', '2022-10-15 19:19:49'),
(5, 'hager', 'jkhjdbckjhbsd@gmail.com', '$2y$10$zH/eFdxT4D9ukaDK8hBPy.n/WoCoGqliPRJjEAh.QgIpdLvKglO46', NULL, NULL, '2022-11-09 13:53:17', '2022-11-09 13:53:17'),
(6, 'hagar hussain', 'hagarhussain@gmail.com', '$2y$10$mq4eqJqOs9CkCdpr7IelD.9Vh13Xs1ZeL4qVuXgeVsNeaHFf7A.Mq', NULL, NULL, '2023-02-11 13:27:41', '2023-02-11 13:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(20) UNSIGNED NOT NULL,
  `std_id` int(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `attendence` tinyint(1) UNSIGNED DEFAULT 0,
  `hw` tinyint(1) DEFAULT 0,
  `payed` char(5) DEFAULT NULL,
  `reset` char(5) DEFAULT '*',
  `branch_id` int(11) NOT NULL,
  `sec_type_id` int(11) NOT NULL,
  `attend_record` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `std_id`, `date`, `attendence`, `hw`, `payed`, `reset`, `branch_id`, `sec_type_id`, `attend_record`, `created_at`, `updated_at`) VALUES
(81, 28, '2023-02-08', 1, 0, '10', '0', 2, 1, 12, '2023-02-08 01:13:04', '2023-02-08 01:57:59'),
(82, 30, '2023-02-08', 2, 1, '15', '0', 2, 1, 12, '2023-02-08 01:13:04', '2023-02-08 01:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `attend_records`
--

CREATE TABLE `attend_records` (
  `id` int(20) NOT NULL,
  `date` date NOT NULL,
  `money` int(11) NOT NULL,
  `Branch_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attend_records`
--

INSERT INTO `attend_records` (`id`, `date`, `money`, `Branch_id`, `sec_id`, `created_at`, `updated_at`) VALUES
(12, '2023-02-08', 25, 2, 1, '2023-02-08 01:13:04', '2023-02-08 01:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `created_at`) VALUES
(1, 'رياضة', '2023-02-06 16:18:07'),
(2, 'ميكانيكا', '2023-02-06 20:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(20) UNSIGNED NOT NULL,
  `std_id` int(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `degree` char(50) DEFAULT '*',
  `branch_id` int(11) NOT NULL,
  `payed` char(10) DEFAULT '*',
  `sec_type_id` int(11) NOT NULL,
  `exam_record` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `std_id`, `date`, `degree`, `branch_id`, `payed`, `sec_type_id`, `exam_record`, `created_at`, `updated_at`) VALUES
(26, 30, '2023-02-10', '10', 1, '*', 1, 12, '2023-02-10 08:14:11', '2023-02-10 08:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `exam_records`
--

CREATE TABLE `exam_records` (
  `id` int(20) NOT NULL,
  `date` date NOT NULL,
  `Branch_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `maximum` int(20) NOT NULL DEFAULT 0,
  `money` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `exam_records`
--

INSERT INTO `exam_records` (`id`, `date`, `Branch_id`, `sec_id`, `maximum`, `money`, `created_at`, `updated_at`) VALUES
(12, '2023-02-08', 2, 1, 0, 0, '2023-02-08 01:13:04', '2023-02-10 08:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(20) UNSIGNED NOT NULL,
  `std_id` int(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `degree` char(50) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `sec_type_id` int(11) NOT NULL,
  `Exercise_Record` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `std_id`, `date`, `degree`, `branch_id`, `sec_type_id`, `Exercise_Record`, `created_at`, `updated_at`) VALUES
(34, 30, '2023-02-10', '20', 1, 1, 14, '2023-02-10 17:15:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exercise_records`
--

CREATE TABLE `exercise_records` (
  `id` int(20) NOT NULL,
  `date` date NOT NULL,
  `Branch_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `maximum` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `exercise_records`
--

INSERT INTO `exercise_records` (`id`, `date`, `Branch_id`, `sec_id`, `maximum`, `created_at`, `updated_at`) VALUES
(14, '2023-02-10', 1, 1, NULL, '2023-02-10 17:14:28', NULL);

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
-- Table structure for table `sec_type`
--

CREATE TABLE `sec_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sec_type`
--

INSERT INTO `sec_type` (`id`, `name`) VALUES
(1, 'الصف الأول الثانوي'),
(2, 'الصف الثاني الثانوي'),
(3, 'الصف الثالث الثانوي');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(512) NOT NULL,
  `username` char(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `p_phone` char(11) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `sumprep` char(4) DEFAULT NULL,
  `gender` enum('f','m') NOT NULL COMMENT '''f'' => ''female ''m''=>male',
  `sec_type_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `username`, `password`, `phone`, `p_phone`, `verified`, `sumprep`, `gender`, `sec_type_id`, `created_at`, `updated_at`) VALUES
(28, 'mahmoud medhat', 'mahmoud_medhat_60', '$2y$10$DYTz6f5GCqazamL/XrkDb.9aXo41vqGD/G9aWA4TMpugQo1EmzetG', '01148422820', '01148422820', 1, '', 'm', 1, '2023-02-06 14:39:42', '2023-02-06 14:39:42'),
(30, 'ahmed wa7ed', 'mohamed_123', '$2y$10$GtLzBx9DsLNg6rJXMcppwur6aElrooyAMmE48VcXI6TNWJh9/LtRa', '1118991231', '1118991231', 1, '3333', 'm', 1, '2023-02-06 17:49:51', '2023-02-10 17:22:53'),
(31, 'خالد', 'khaled_12', '$2y$10$ldMsTW4O4NbKf0pi8bdvOuBY9xEcvfagb50OMAY9yfvSamt9TO9gK', '1030492761', '1030492761', 1, NULL, 'm', 3, '2023-02-11 13:08:46', '2023-02-11 13:08:46'),
(32, 'خالد2', 'khaled_122', '$2y$10$6m3UqU5mvbENshmljJbu8e6bLZ/HJZ6WZGZoH28v/WjXTbSlFQ4aG', '1030492763', '1030492763', 1, NULL, 'm', 2, '2023-02-11 13:12:29', '2023-02-11 13:14:42'),
(33, 'اسماء محمد عثمان بهنساوى', '1068555363', '$2y$10$xpl/013VcJHeOOhDk0hSauvRV45P2m65bTkAolJFyUiJPTtswnXzm', '1068555363', '1022148878', 1, NULL, 'f', 2, '2023-02-11 13:42:46', '2023-02-11 13:42:46'),
(35, 'ايه طه عبدالسلام', '1122432977', '$2y$10$0o.TzIypPwzQe7VfxrIrauM3bI2RbtPkFYYi8CSfTqIT0kROwDcXe', '1122432977', '1117143963', 1, NULL, 'f', 2, '2023-02-11 13:42:46', '2023-02-11 13:42:46'),
(36, 'بسملة ياسر محمد', '1121026580', '$2y$10$nF7W8MtWzB6lkOaY/x9J/ugeXZiDRplFihWyHZIUvw8EdRhHcYbFe', '1121026580', '1155656366', 1, NULL, 'f', 2, '2023-02-11 13:42:46', '2023-02-11 13:42:46'),
(37, 'جنى احمد قاسم', '1147316696', '$2y$10$.U4lFBw.DDm2ZFaQv0f0hOd8.N0TKI0GPVobYUHjynG6hKZhoG29O', '1147316696', '1121114462', 1, NULL, 'f', 2, '2023-02-11 13:42:46', '2023-02-11 13:42:46'),
(38, 'حبيبة محمد صلاح', '1121916687', '$2y$10$VR2jrQYHuWTZbphJkrGH8eR8WhNInGaf/SvySbVY2k6JsDxDpq7Mm', '1121916687', '1121916687', 1, NULL, 'f', 2, '2023-02-11 13:42:46', '2023-02-11 13:42:46'),
(39, 'حبيبة منتصر سعيد', '1143881767', '$2y$10$MNuPeBp2PWpuNw7EH4T3BeRR0k5QyqTrtY0hCt6UMa7CNJ.W8njwi', '1143881767', '1124926404', 1, NULL, 'f', 2, '2023-02-11 13:42:46', '2023-02-11 13:42:46'),
(40, 'حبيبه سيد', '1148980017', '$2y$10$j/mFNtszXiuIz/oG8rWhEOmRg7U4p5E6tIU6J52gdMubIxkImKl0e', '1148980017', '1115941306', 1, NULL, 'f', 2, '2023-02-11 13:42:46', '2023-02-11 13:42:46'),
(41, 'حفصة عبدالخالق قاسم', '114581791', '$2y$10$WAhjVLzxHNIT3BpP7pif4.sd0YGWz29t/1cOVAF1GsDVud27Nh1Km', '114581791', '1121100711', 1, NULL, 'f', 2, '2023-02-11 13:42:47', '2023-02-11 13:42:47'),
(42, 'روان ابراهيم محمد', '1158258616', '$2y$10$4Fw830A44EPt8k8d4QgPoer382vHqJdjHnMdWdqIXBsENQDeC9Feq', '1158258616', '1154218364', 1, NULL, 'f', 2, '2023-02-11 13:42:47', '2023-02-11 13:42:47'),
(43, 'روان عربى ابوالعز', '1118374490', '$2y$10$uCI7lKMz4vS1uDPKk8oYS.WB3T2GUZrtCxEfKMN2Pmtw3k8FEtk2K', '1118374490', '1127198000', 1, NULL, 'f', 2, '2023-02-11 13:42:47', '2023-02-11 13:42:47'),
(44, 'روان محمد مسعود', '1122349444', '$2y$10$8ZQ2lFGCnsJ.QfjTujHME.oZIi6jY/Uipnfd8Fx7IoBuoJJsDR6fq', '1122349444', '1110142811', 1, NULL, 'f', 2, '2023-02-11 13:42:47', '2023-02-11 13:42:47'),
(111, 'فريدة حازم عبدالرحيم', '1140484988', '$2y$10$D6M4IvmBZJy7CSXsNr1Fm.FI/mpLH1TFZ7kcx.sLtMdfqWeUlZaDy', '1140484988', '112230662', 1, NULL, 'f', 1, '2023-02-11 14:42:19', '2023-02-11 14:42:19'),
(112, 'لمياء مصطفي', '1120141698', '$2y$10$fpV/zSC5Wl6Yud0kLzRkSORBuvjn6v0bRm6sKiUYmSB6E1NNRM3dq', '1120141698', '1120141698', 1, NULL, 'f', 1, '2023-02-11 14:42:19', '2023-02-11 14:42:19'),
(113, 'ليلى طارق محمد', '1122358597', '$2y$10$1ie1WE3Uk42yvS7V41UGyOljrVeIws.ubVGbFIGBRTLJ3huuoYMlS', '1122358597', '1147141034', 1, NULL, 'f', 1, '2023-02-11 14:42:19', '2023-02-11 14:42:19'),
(114, 'مروة سعيد السيد', '1100749035', '$2y$10$EliW/CfHPBh9vrjvazMeFOWlIB7YOEzuahel4THy0uWhtbi1DE3fa', '1100749035', '1129677577', 1, NULL, 'f', 1, '2023-02-11 14:42:19', '2023-02-11 14:42:19'),
(115, 'مريم احمد الدسوقي', '1153583259', '$2y$10$9v0iPcrHiQTTNPr2u0BHSeWIqsxSVDOngodZvVu5L9/uyhv2AKV5m', '1153583259', '1111977899', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(116, 'مريم احمد عبدالظاهر', '1154498987', '$2y$10$sdq8EcSOXINW4yg460rApOiX6vkbA/j/YHDJk/O35lT5J.pw78qeS', '1154498987', '1220127138', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(117, 'مريم عماد ', '1022988633', '$2y$10$zCbvP/x4KTXiH804MBnGaeM5Eh4PJqJfqAhAI05/FwUW5TeE8rDMi', '1022988633', '1062420444', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(118, 'مريم محمود عبدالفتاح', '1028884781', '$2y$10$.ZmOWOHp2AysMnaL9ys5R.4zzFP/k5F6BbY3hWobKT8BPm62.Vzjq', '1028884781', '1118514082', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(119, 'ملك احمد سعد', '1113303440', '$2y$10$LBw6ThDo7vmCaDFqczqSZ.zvEggPcgWBB4vtfo6Mz0knVEsMOmZdS', '1113303440', '1102666101', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(120, 'ملك محمد ربيع', '1100316727', '$2y$10$jV82d6WVghFzXt3jkwUW5OL1nwnE77W.Pn9L6Tw8hoz.fXerhJ7Ki', '1100316727', '1116377092', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(121, 'منة الله رافت سيد ', '1120062752', '$2y$10$4StwuDCXJfMyzzty57J4YeqGiRzg7uc/AbVBkgZrSJjEwiLe/xMJy', '1120062752', '1143361165', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(122, 'منة خالد', '1060306716', '$2y$10$xlqQrLXa9NhdVcH8Bvmq4./m53LXNagoQWMJTpUz0iMVNgdRpdrw2', '1060306716', '1026660418', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(123, 'منة علي عبدالظاهر', '1145961286', '$2y$10$/uvdPwrhf/BoxFMEGPE/yu7irTf/0/ruC6juOdEcAFi3PIgrf8JP6', '1145961286', '1141248492', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(124, 'مى مصطفى محمود', '1151428037', '$2y$10$rCNdzkGohKoBnWB9HKX.deCbGIp6iVHu8rm5PJSJIy1rCl24myrHC', '1151428037', '1153310556', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(125, 'ندي ربيع ابراهيم', '1116064058', '$2y$10$GbIxNYstn/H4i84wJ0Ou0.N2gHcAuiaTW7t9mcmXK8GhYS9bzTodq', '1116064058', '1151437432', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(126, 'نورا عمرو عوض ', '1557468877', '$2y$10$FEb8IVuSL0/36etM1Lnbx.F.rSvt3wfpAJgDbgJF1dpsZQ//5mOkK', '1557468877', '1017371598', 1, NULL, 'f', 1, '2023-02-11 14:42:20', '2023-02-11 14:42:20'),
(127, 'نورا محمود السيد', '1023473307', '$2y$10$aglUMGdduzBwaQfuIxn8xOk9tCQJfHk2EMyVUZj/KxAVDI51znAra', '1023473307', '1026994089', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(128, 'نورهان محمد احمد', '1148772446', '$2y$10$YQ2sqgIvIRcl43s5qWE4W.9kOiNTaXvONEwzmGXs3jGb.mpQdo0SO', '1148772446', '1127442838', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(129, 'هاجر سيد', '1061280177', '$2y$10$Ttj19E3MYWciKkQUSgv.luO5HjxN6H/2rxae6fpiVoB3yAQbVeeYq', '1061280177', '1001357023', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(130, 'هاجر وحيد فوزى', '1007578566', '$2y$10$qIJzjE6WOS93lRKnBIEqtOzAEOxPygxq7iYHOVmupx4TVq0pE9056', '1007578566', '1000784449', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(131, 'هنا احمد سعيد', '1157477084', '$2y$10$DIz9E1PT.sdTQpcx9tR8NeI.XVVf0zcWcqVPJ78Yl.9g87QlCiDDy', '1157477084', '1122044744', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(132, 'هنا علي عبداللاه', '1102593259', '$2y$10$NJ2dd8Nycdq1aq8NJRmPFuTCrHo57pskjtZ2u5J0lfzfk8QiggASq', '1102593259', '1147330633', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(133, 'هند عادل حسن', '1125171497', '$2y$10$1CIDNHUHXaMR.7MQd4R3T.qxQ8B5aX80.T9NvBokqqH0X0oqmz30O', '1125171497', '1128996985', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(134, 'يسرا انيس', '110265062', '$2y$10$qggt/V4qr9cE1w8Fqasd5.50EIAXScsjUh0n16krZt/AuhwgHIPR2', '110265062', '1147631187', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(135, 'اسراء طه ', '1117143963', '$2y$10$iVDMiq.ZkWlyKNmPQEEadef88rmFZ0nFHhPitXx4i8i/DdbY5ewWK', '1117143963', '1117143963', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(136, 'عزيزة حسن يوسف', '1208859266', '$2y$10$uwNqbuuShhLIgRioVu7XtOtT4R9yWasr73T1.QGHnZX.pgzkszkDm', '1208859266', '1208859277', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(137, 'سندس محمد ابراهيم محمد', '1008138430', '$2y$10$QIqtO/H7KXmXqT0wjxCwc.UawJdjTX/pZW3YeJ3zKXJ7CHuSvCxo.', '1008138430', '1144559123', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(138, 'ندي محمد السيد', '1007825214', '$2y$10$AEpDrRy95pm4Wm0ztpasqOPILWv/wV5Xg3KCZgWSRQWiBvXf/7Cna', '1007825214', '1002990489', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(139, 'مريم عادل عبد العزيز', '112885239', '$2y$10$PhnuO2BHfzS6p1gddEnxnOSHI4MgWLN8eL9CV2IjWPM12H0P2uxYy', '112885239', '1147416616', 1, NULL, 'f', 1, '2023-02-11 14:42:21', '2023-02-11 14:42:21'),
(140, 'ملك عادل عبد العزيز', '1120368575', '$2y$10$UMgv4QskgR.UuK/Pf5HI6uenmG5gVEZ7KE.N.mDpO7FeRKfFAJlIm', '1120368575', '1147416616', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(141, 'مريم جمال قرني', '1100546842', '$2y$10$cSX2xPcIG2WAllbVcuNQheW0wJ2IgV6EnqltaUkaMAChGnEWqnI6m', '1100546842', '11103943707', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(142, 'مريم محمد ناجح', '1101334389', '$2y$10$.LAZxIWrScxetTGbdhudsO8l/Mt8r5I6p79u8vjKPYk6wyBru7.IG', '1101334389', '1067541244', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(143, 'امل فتحي ابراهيم', '1152844451', '$2y$10$hdYwbq.Nvya.QyTTLwKZReBqdxAqxmrqs/XFPI3XsAkeeNnltUxAC', '1152844451', '1024890653', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(144, 'رقية وليد  بدوي ', '1142259573', '$2y$10$ZXZHHLUGy4dGWw7p4.hVmOsvbVpVZcVAG.FASzOCrE3Ch70QjM4Pq', '1142259573', '1123089913', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(145, 'مريم عيد عيد محمد ', '1143006300', '$2y$10$wqgwurB6XCX86TGqPw91.Oo1oL2l2xWOrBMgwaZt11fSam6nw1NLS', '1143006300', '113050787', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(146, 'سماح عادل الدمرداش', '1062257753', '$2y$10$Th1YOUrC/O.inYKGwSJD9euv/vfSrQxZGWcCVZKNhWKZHABzE5l02', '1062257753', '1119314986', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(147, 'شهد سيد رشاد', '1200046963', '$2y$10$LRffXIzolI2W6FLTCufBw.qPoE/lAJ1jEgDJ/6U8/TcmGOkKKX5U6', '1200046963', '1203354332', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(148, 'بسمله اشرف عبد الصبور', '1148816396', '$2y$10$uGxGv7kUMJVpbl3qZcgHVeD9jXpbb3ByydzxZvSBMLj7uO6RfITFm', '1148816396', '1159599665', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(149, 'سلمي محمد الستار', '1158952469', '$2y$10$dpekWU6N4wVO3hcAJJLSz./JDyH8Rt6gKL5p.VInPCj0uWLL0UtCu', '1158952469', '1128636024', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22'),
(150, 'الاء محمد موسي', '1120046116', '$2y$10$y.0AcXlJrZt9bBHu8AFVqOr8COI35AcMid3TZjsckNqV4lIn1KmPS', '1120046116', '1129788613', 1, NULL, 'f', 1, '2023-02-11 14:42:22', '2023-02-11 14:42:22');

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
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_attendence_branches` (`branch_id`),
  ADD KEY `FK_attendence_students` (`std_id`),
  ADD KEY `FK_attendence_sec_type` (`sec_type_id`),
  ADD KEY `FK_attendence_attendencerecords` (`attend_record`);

--
-- Indexes for table `attend_records`
--
ALTER TABLE `attend_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_attendencerecords_branches` (`Branch_id`),
  ADD KEY `FK_attendencerecords_sec_type` (`sec_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_exams_branches` (`branch_id`),
  ADD KEY `FK_exams_students` (`std_id`),
  ADD KEY `FK_exams_sec_type` (`sec_type_id`),
  ADD KEY `FK_exams_exam_records` (`exam_record`);

--
-- Indexes for table `exam_records`
--
ALTER TABLE `exam_records`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_attendencerecords_branches` (`Branch_id`) USING BTREE,
  ADD KEY `FK_attendencerecords_sec_type` (`sec_id`) USING BTREE;

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_exercises_students` (`std_id`),
  ADD KEY `FK_exercises_branches` (`branch_id`),
  ADD KEY `FK_exercises_sec_type` (`sec_type_id`),
  ADD KEY `FK_exercises_exercise_records` (`Exercise_Record`);

--
-- Indexes for table `exercise_records`
--
ALTER TABLE `exercise_records`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_attendencerecords_branches` (`Branch_id`) USING BTREE,
  ADD KEY `FK_attendencerecords_sec_type` (`sec_id`) USING BTREE;

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
-- Indexes for table `sec_type`
--
ALTER TABLE `sec_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `FK_students_sec_type` (`sec_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `attend_records`
--
ALTER TABLE `attend_records`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `exam_records`
--
ALTER TABLE `exam_records`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `exercise_records`
--
ALTER TABLE `exercise_records`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `sec_type`
--
ALTER TABLE `sec_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendence`
--
ALTER TABLE `attendence`
  ADD CONSTRAINT `FK_attendence_attendencerecords` FOREIGN KEY (`attend_record`) REFERENCES `attend_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_attendence_branches` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_attendence_sec_type` FOREIGN KEY (`sec_type_id`) REFERENCES `sec_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_attendence_students` FOREIGN KEY (`std_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attend_records`
--
ALTER TABLE `attend_records`
  ADD CONSTRAINT `FK_attendencerecords_branches` FOREIGN KEY (`Branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_attendencerecords_sec_type` FOREIGN KEY (`sec_id`) REFERENCES `sec_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `FK_exams_branches` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_exams_exam_records` FOREIGN KEY (`exam_record`) REFERENCES `exam_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_exams_sec_type` FOREIGN KEY (`sec_type_id`) REFERENCES `sec_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_exams_students` FOREIGN KEY (`std_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_records`
--
ALTER TABLE `exam_records`
  ADD CONSTRAINT `exam_records_ibfk_1` FOREIGN KEY (`Branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `exam_records_ibfk_2` FOREIGN KEY (`sec_id`) REFERENCES `sec_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `FK_exercises_branches` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_exercises_exercise_records` FOREIGN KEY (`Exercise_Record`) REFERENCES `exercise_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_exercises_sec_type` FOREIGN KEY (`sec_type_id`) REFERENCES `sec_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_exercises_students` FOREIGN KEY (`std_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exercise_records`
--
ALTER TABLE `exercise_records`
  ADD CONSTRAINT `exercise_records_ibfk_1` FOREIGN KEY (`Branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `exercise_records_ibfk_2` FOREIGN KEY (`sec_id`) REFERENCES `sec_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK_students_sec_type` FOREIGN KEY (`sec_type_id`) REFERENCES `sec_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
