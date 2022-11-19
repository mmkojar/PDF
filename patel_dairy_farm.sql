-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
<<<<<<< HEAD:patel_dairy_farm.sql
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 19, 2022 at 06:17 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4
=======
-- Host: localhost
-- Generation Time: Nov 05, 2022 at 06:03 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29
>>>>>>> f654dd8f47ef4609397334fd30d5d28846e09d48:patel_dairy_farm.mssql

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patel_dairy_farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_list`
--

CREATE TABLE `attendance_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `eid` bigint(20) UNSIGNED NOT NULL,
  `entry` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_day_salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_list`
--

INSERT INTO `attendance_list` (`id`, `eid`, `entry`, `per_day_salary`, `month`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '406.57', 'Oct', '2022-10-01', '2022-10-19 05:56:15', NULL),
(2, 2, '1', '425.30', 'Oct', '2022-10-01', '2022-10-19 05:56:15', NULL),
(3, 3, '1', '406.93', 'Oct', '2022-10-01', '2022-10-19 05:56:15', NULL),
(4, 4, '1', '380.03', 'Oct', '2022-10-01', '2022-10-19 05:56:15', NULL),
(5, 5, '1', '449.23', 'Oct', '2022-10-01', '2022-10-19 05:56:15', NULL),
(7, 7, '1', '415.13', 'Oct', '2022-10-01', '2022-10-19 05:56:15', NULL),
(8, 8, '1', '483.27', 'Oct', '2022-10-01', '2022-10-19 05:56:15', NULL),
(9, 9, '1', '306.13', 'Oct', '2022-10-01', '2022-10-19 05:56:16', NULL),
(21, 1, '1', '406.57', 'Oct', '2022-10-02', '2022-10-19 21:11:17', NULL),
(22, 2, '1', '425.30', 'Oct', '2022-10-02', '2022-10-19 21:11:17', NULL),
(23, 3, '1', '500.00', 'Oct', '2022-10-02', '2022-10-19 21:11:17', NULL),
(24, 4, '1', '380.03', 'Oct', '2022-10-02', '2022-10-19 21:11:17', NULL),
(25, 5, '1', '449.23', 'Oct', '2022-10-02', '2022-10-19 21:11:17', NULL),
(27, 7, '1', '415.13', 'Oct', '2022-10-02', '2022-10-19 21:11:17', NULL),
(28, 8, '1', '483.27', 'Oct', '2022-10-02', '2022-10-19 21:11:17', NULL),
(29, 9, '0.5', '153.07', 'Oct', '2022-10-02', '2022-10-19 21:11:17', NULL),
(31, 1, '1', '406.57', 'Oct', '2022-10-03', '2022-10-19 22:25:39', NULL),
(32, 2, '1', '425.30', 'Oct', '2022-10-03', '2022-10-19 22:25:39', NULL),
(33, 3, '1', '500.00', 'Oct', '2022-10-03', '2022-10-19 22:25:39', NULL),
(34, 4, '1', '380.03', 'Oct', '2022-10-03', '2022-10-19 22:25:39', NULL),
(35, 5, '1', '449.23', 'Oct', '2022-10-03', '2022-10-19 22:25:39', NULL),
(36, 7, '1', '415.13', 'Oct', '2022-10-03', '2022-10-19 22:25:39', NULL),
(37, 8, '0.5', '241.63', 'Oct', '2022-10-03', '2022-10-19 22:25:39', NULL),
(38, 9, '0', '0', 'Oct', '2022-10-03', '2022-10-19 22:25:39', NULL),
(39, 10, '1', '400.00', 'Nov', '2022-11-02', '2022-10-20 03:31:11', NULL),
(40, 1, '1', '406.57', 'Nov', '2022-11-02', '2022-10-20 03:31:11', NULL),
(41, 2, '1', '425.30', 'Nov', '2022-11-02', '2022-10-20 03:31:11', NULL),
(42, 3, '1', '500.00', 'Nov', '2022-11-02', '2022-10-20 03:31:12', NULL),
(43, 4, '1', '380.03', 'Nov', '2022-11-02', '2022-10-20 03:31:12', NULL),
(44, 5, '1', '449.23', 'Nov', '2022-11-02', '2022-10-20 03:31:12', NULL),
(45, 7, '1', '415.13', 'Nov', '2022-11-02', '2022-10-20 03:31:12', NULL),
(46, 8, '0.5', '241.63', 'Nov', '2022-11-02', '2022-10-20 03:31:12', NULL),
(47, 9, '0', '0', 'Nov', '2022-11-02', '2022-10-20 03:31:12', NULL),
(49, 10, '1', '400.00', 'Oct', '2022-10-04', '2022-10-20 04:16:24', NULL),
(50, 1, '1', '406.57', 'Oct', '2022-10-04', '2022-10-20 04:16:24', NULL),
(51, 2, '1', '425.30', 'Oct', '2022-10-04', '2022-10-20 04:16:24', NULL),
(52, 3, '1', '500.00', 'Oct', '2022-10-04', '2022-10-20 04:16:24', NULL),
(53, 4, '1', '380.03', 'Oct', '2022-10-04', '2022-10-20 04:16:24', NULL),
(54, 5, '1', '449.23', 'Oct', '2022-10-04', '2022-10-20 04:16:24', NULL),
(55, 7, '1', '415.13', 'Oct', '2022-10-04', '2022-10-20 04:16:24', NULL),
(56, 8, '1', '483.27', 'Oct', '2022-10-04', '2022-10-20 04:16:24', NULL),
(57, 9, '1', '306.13', 'Oct', '2022-10-04', '2022-10-20 04:16:24', NULL),
(59, 10, '1', '400.00', 'Oct', '2022-10-05', '2022-10-20 04:20:33', NULL),
(60, 1, '1', '406.57', 'Oct', '2022-10-05', '2022-10-20 04:20:33', NULL),
(61, 2, '1', '425.30', 'Oct', '2022-10-05', '2022-10-20 04:20:34', NULL),
(62, 3, '1', '500.00', 'Oct', '2022-10-05', '2022-10-20 04:20:34', NULL),
(63, 4, '1', '380.03', 'Oct', '2022-10-05', '2022-10-20 04:20:34', NULL),
(64, 5, '1', '449.23', 'Oct', '2022-10-05', '2022-10-20 04:20:34', NULL),
(65, 7, '1', '415.13', 'Oct', '2022-10-05', '2022-10-20 04:20:34', NULL),
(66, 8, '1', '483.27', 'Oct', '2022-10-05', '2022-10-20 04:20:34', NULL),
(67, 9, '1', '306.13', 'Oct', '2022-10-05', '2022-10-20 04:20:34', NULL),
(69, 10, '1', '400.00', 'Oct', '2022-10-06', '2022-10-20 04:22:14', NULL),
(70, 1, '1', '406.57', 'Oct', '2022-10-06', '2022-10-20 04:22:14', NULL),
(71, 2, '1', '425.30', 'Oct', '2022-10-06', '2022-10-20 04:22:14', NULL),
(72, 3, '1', '500.00', 'Oct', '2022-10-06', '2022-10-20 04:22:14', NULL),
(73, 4, '1', '380.03', 'Oct', '2022-10-06', '2022-10-20 04:22:14', NULL),
(74, 5, '1', '449.23', 'Oct', '2022-10-06', '2022-10-20 04:22:14', NULL),
(75, 7, '1', '415.13', 'Oct', '2022-10-06', '2022-10-20 04:22:14', NULL),
(76, 8, '1', '483.27', 'Oct', '2022-10-06', '2022-10-20 04:22:14', NULL),
(77, 9, '1', '306.13', 'Oct', '2022-10-06', '2022-10-20 04:22:14', NULL),
(79, 10, '1', '400.00', 'Oct', '2022-10-07', '2022-10-20 04:23:49', NULL),
(80, 1, '1', '406.57', 'Oct', '2022-10-07', '2022-10-20 04:23:49', NULL),
(81, 2, '1', '425.30', 'Oct', '2022-10-07', '2022-10-20 04:23:49', NULL),
(82, 3, '1', '500.00', 'Oct', '2022-10-07', '2022-10-20 04:23:49', NULL),
(83, 4, '1', '380.03', 'Oct', '2022-10-07', '2022-10-20 04:23:49', NULL),
(84, 5, '1', '449.23', 'Oct', '2022-10-07', '2022-10-20 04:23:49', NULL),
(85, 7, '1', '415.13', 'Oct', '2022-10-07', '2022-10-20 04:23:50', NULL),
(86, 8, '1', '483.27', 'Oct', '2022-10-07', '2022-10-20 04:23:50', NULL),
(87, 9, '1', '306.13', 'Oct', '2022-10-07', '2022-10-20 04:23:50', NULL),
(88, 10, '1', '400.00', 'Oct', '2022-10-08', '2022-10-20 05:43:55', NULL),
(89, 1, '1', '406.57', 'Oct', '2022-10-08', '2022-10-20 05:43:55', NULL),
(90, 2, '1', '425.30', 'Oct', '2022-10-08', '2022-10-20 05:43:55', NULL),
(91, 3, '1', '500.00', 'Oct', '2022-10-08', '2022-10-20 05:43:55', NULL),
(92, 4, '1', '380.03', 'Oct', '2022-10-08', '2022-10-20 05:43:55', NULL),
(93, 5, '1', '449.23', 'Oct', '2022-10-08', '2022-10-20 05:43:55', NULL),
(94, 7, '1', '415.13', 'Oct', '2022-10-08', '2022-10-20 05:43:55', NULL),
(95, 8, '1', '483.27', 'Oct', '2022-10-08', '2022-10-20 05:43:56', NULL),
(96, 9, '1', '306.13', 'Oct', '2022-10-08', '2022-10-20 05:43:56', NULL),
(97, 10, '1', '400.00', 'Oct', '2022-10-09', '2022-10-20 21:47:41', NULL),
(98, 1, '1', '500.00', 'Oct', '2022-10-09', '2022-10-20 21:47:41', NULL),
(99, 2, '1', '425.30', 'Oct', '2022-10-09', '2022-10-20 21:47:41', NULL),
(100, 3, '1', '500.00', 'Oct', '2022-10-09', '2022-10-20 21:47:41', NULL),
(101, 4, '1', '380.03', 'Oct', '2022-10-09', '2022-10-20 21:47:41', NULL),
(102, 5, '1', '449.23', 'Oct', '2022-10-09', '2022-10-20 21:47:41', NULL),
(103, 7, '1', '415.13', 'Oct', '2022-10-09', '2022-10-20 21:47:41', NULL),
(104, 8, '1', '483.27', 'Oct', '2022-10-09', '2022-10-20 21:47:42', NULL),
(105, 9, '1', '306.13', 'Oct', '2022-10-09', '2022-10-20 21:47:42', NULL),
(106, 10, '1', '400.00', 'Oct', '2022-10-10', '2022-10-20 21:48:20', NULL),
(107, 1, '1', '500.00', 'Oct', '2022-10-10', '2022-10-20 21:48:20', NULL),
(108, 2, '1', '425.30', 'Oct', '2022-10-10', '2022-10-20 21:48:20', NULL),
(109, 3, '1', '500.00', 'Oct', '2022-10-10', '2022-10-20 21:48:20', NULL),
(110, 4, '1', '380.03', 'Oct', '2022-10-10', '2022-10-20 21:48:21', NULL),
(111, 5, '1', '449.23', 'Oct', '2022-10-10', '2022-10-20 21:48:21', NULL),
(112, 7, '1', '415.13', 'Oct', '2022-10-10', '2022-10-20 21:48:21', NULL),
(113, 8, '1', '483.27', 'Oct', '2022-10-10', '2022-10-20 21:48:21', NULL),
(114, 9, '1', '306.13', 'Oct', '2022-10-10', '2022-10-20 21:48:21', NULL),
(115, 10, '1', '400.00', 'Oct', '2022-10-11', '2022-10-20 21:48:50', NULL),
(116, 1, '1', '500.00', 'Oct', '2022-10-11', '2022-10-20 21:48:50', NULL),
(117, 2, '1', '425.30', 'Oct', '2022-10-11', '2022-10-20 21:48:50', NULL),
(118, 3, '1', '500.00', 'Oct', '2022-10-11', '2022-10-20 21:48:50', NULL),
(119, 4, '1', '380.03', 'Oct', '2022-10-11', '2022-10-20 21:48:50', NULL),
(120, 5, '1', '449.23', 'Oct', '2022-10-11', '2022-10-20 21:48:50', NULL),
(121, 7, '1', '415.13', 'Oct', '2022-10-11', '2022-10-20 21:48:50', NULL),
(122, 8, '1', '483.27', 'Oct', '2022-10-11', '2022-10-20 21:48:50', NULL),
(123, 9, '1', '306.13', 'Oct', '2022-10-11', '2022-10-20 21:48:50', NULL),
(124, 10, '1', '400.00', 'Oct', '2022-10-12', '2022-10-20 21:49:00', NULL),
(125, 1, '1', '500.00', 'Oct', '2022-10-12', '2022-10-20 21:49:00', NULL),
(126, 2, '1', '425.30', 'Oct', '2022-10-12', '2022-10-20 21:49:00', NULL),
(127, 3, '1', '500.00', 'Oct', '2022-10-12', '2022-10-20 21:49:01', NULL),
(128, 4, '1', '380.03', 'Oct', '2022-10-12', '2022-10-20 21:49:01', NULL),
(129, 5, '1', '449.23', 'Oct', '2022-10-12', '2022-10-20 21:49:01', NULL),
(130, 7, '1', '415.13', 'Oct', '2022-10-12', '2022-10-20 21:49:01', NULL),
(131, 8, '1', '483.27', 'Oct', '2022-10-12', '2022-10-20 21:49:01', NULL),
(132, 9, '1', '306.13', 'Oct', '2022-10-12', '2022-10-20 21:49:01', NULL),
(133, 10, '1', '400.00', 'Oct', '2022-10-13', '2022-10-20 21:49:05', NULL),
(134, 1, '1', '500.00', 'Oct', '2022-10-13', '2022-10-20 21:49:05', NULL),
(135, 2, '1', '425.30', 'Oct', '2022-10-13', '2022-10-20 21:49:06', NULL),
(136, 3, '1', '500.00', 'Oct', '2022-10-13', '2022-10-20 21:49:06', NULL),
(137, 4, '1', '380.03', 'Oct', '2022-10-13', '2022-10-20 21:49:06', NULL),
(138, 5, '1', '449.23', 'Oct', '2022-10-13', '2022-10-20 21:49:06', NULL),
(139, 7, '1', '415.13', 'Oct', '2022-10-13', '2022-10-20 21:49:06', NULL),
(140, 8, '1', '483.27', 'Oct', '2022-10-13', '2022-10-20 21:49:06', NULL),
(141, 9, '1', '306.13', 'Oct', '2022-10-13', '2022-10-20 21:49:06', NULL),
(142, 10, '1', '400.00', 'Oct', '2022-10-14', '2022-10-20 21:49:10', NULL),
(143, 1, '1', '500.00', 'Oct', '2022-10-14', '2022-10-20 21:49:10', NULL),
(144, 2, '1', '425.30', 'Oct', '2022-10-14', '2022-10-20 21:49:10', NULL),
(145, 3, '1', '500.00', 'Oct', '2022-10-14', '2022-10-20 21:49:10', NULL),
(146, 4, '1', '380.03', 'Oct', '2022-10-14', '2022-10-20 21:49:10', NULL),
(147, 5, '1', '449.23', 'Oct', '2022-10-14', '2022-10-20 21:49:10', NULL),
(148, 7, '1', '415.13', 'Oct', '2022-10-14', '2022-10-20 21:49:10', NULL),
(149, 8, '1', '483.27', 'Oct', '2022-10-14', '2022-10-20 21:49:10', NULL),
(150, 9, '1', '306.13', 'Oct', '2022-10-14', '2022-10-20 21:49:10', NULL),
(151, 10, '1', '400.00', 'Oct', '2022-10-15', '2022-10-20 21:49:14', NULL),
(152, 1, '1', '500.00', 'Oct', '2022-10-15', '2022-10-20 21:49:14', NULL),
(153, 2, '1', '425.30', 'Oct', '2022-10-15', '2022-10-20 21:49:14', NULL),
(154, 3, '1', '500.00', 'Oct', '2022-10-15', '2022-10-20 21:49:14', NULL),
(155, 4, '1', '380.03', 'Oct', '2022-10-15', '2022-10-20 21:49:14', NULL),
(156, 5, '1', '449.23', 'Oct', '2022-10-15', '2022-10-20 21:49:14', NULL),
(157, 7, '1', '415.13', 'Oct', '2022-10-15', '2022-10-20 21:49:14', NULL),
(158, 8, '1', '483.27', 'Oct', '2022-10-15', '2022-10-20 21:49:14', NULL),
(159, 9, '1', '306.13', 'Oct', '2022-10-15', '2022-10-20 21:49:14', NULL),
(160, 10, '1', '400.00', 'Oct', '2022-10-16', '2022-10-20 21:49:18', NULL),
(161, 1, '1', '500.00', 'Oct', '2022-10-16', '2022-10-20 21:49:18', NULL),
(162, 2, '1', '425.30', 'Oct', '2022-10-16', '2022-10-20 21:49:18', NULL),
(163, 3, '1', '500.00', 'Oct', '2022-10-16', '2022-10-20 21:49:18', NULL),
(164, 4, '1', '380.03', 'Oct', '2022-10-16', '2022-10-20 21:49:18', NULL),
(165, 5, '1', '449.23', 'Oct', '2022-10-16', '2022-10-20 21:49:18', NULL),
(166, 7, '1', '415.13', 'Oct', '2022-10-16', '2022-10-20 21:49:19', NULL),
(167, 8, '1', '483.27', 'Oct', '2022-10-16', '2022-10-20 21:49:19', NULL),
(168, 9, '1', '306.13', 'Oct', '2022-10-16', '2022-10-20 21:49:19', NULL),
(169, 10, '1', '400.00', 'Oct', '2022-10-17', '2022-10-20 21:49:22', NULL),
(170, 1, '1', '500.00', 'Oct', '2022-10-17', '2022-10-20 21:49:22', NULL),
(171, 2, '1', '425.30', 'Oct', '2022-10-17', '2022-10-20 21:49:22', NULL),
(172, 3, '1', '500.00', 'Oct', '2022-10-17', '2022-10-20 21:49:22', NULL),
(173, 4, '1', '380.03', 'Oct', '2022-10-17', '2022-10-20 21:49:22', NULL),
(174, 5, '1', '449.23', 'Oct', '2022-10-17', '2022-10-20 21:49:22', NULL),
(175, 7, '1', '415.13', 'Oct', '2022-10-17', '2022-10-20 21:49:22', NULL),
(176, 8, '1', '483.27', 'Oct', '2022-10-17', '2022-10-20 21:49:22', NULL),
(177, 9, '1', '306.13', 'Oct', '2022-10-17', '2022-10-20 21:49:22', NULL),
(178, 10, '1', '400.00', 'Oct', '2022-10-18', '2022-10-20 21:49:25', NULL),
(179, 1, '1', '500.00', 'Oct', '2022-10-18', '2022-10-20 21:49:26', NULL),
(180, 2, '1', '425.30', 'Oct', '2022-10-18', '2022-10-20 21:49:26', NULL),
(181, 3, '1', '500.00', 'Oct', '2022-10-18', '2022-10-20 21:49:26', NULL),
(182, 4, '1', '380.03', 'Oct', '2022-10-18', '2022-10-20 21:49:26', NULL),
(183, 5, '1', '449.23', 'Oct', '2022-10-18', '2022-10-20 21:49:26', NULL),
(184, 7, '1', '415.13', 'Oct', '2022-10-18', '2022-10-20 21:49:26', NULL),
(185, 8, '1', '483.27', 'Oct', '2022-10-18', '2022-10-20 21:49:26', NULL),
(186, 9, '1', '306.13', 'Oct', '2022-10-18', '2022-10-20 21:49:26', NULL),
(187, 10, '1', '400.00', 'Oct', '2022-10-19', '2022-10-20 21:49:29', NULL),
(188, 1, '1', '500.00', 'Oct', '2022-10-19', '2022-10-20 21:49:29', NULL),
(189, 2, '1', '425.30', 'Oct', '2022-10-19', '2022-10-20 21:49:29', NULL),
(190, 3, '1', '500.00', 'Oct', '2022-10-19', '2022-10-20 21:49:29', NULL),
(191, 4, '1', '380.03', 'Oct', '2022-10-19', '2022-10-20 21:49:29', NULL),
(192, 5, '1', '449.23', 'Oct', '2022-10-19', '2022-10-20 21:49:29', NULL),
(193, 7, '1', '415.13', 'Oct', '2022-10-19', '2022-10-20 21:49:29', NULL),
(194, 8, '1', '483.27', 'Oct', '2022-10-19', '2022-10-20 21:49:29', NULL),
(195, 9, '1', '306.13', 'Oct', '2022-10-19', '2022-10-20 21:49:29', NULL),
(196, 10, '1', '400.00', 'Oct', '2022-10-20', '2022-10-20 21:49:32', NULL),
(197, 1, '1', '500.00', 'Oct', '2022-10-20', '2022-10-20 21:49:33', NULL),
(198, 2, '1', '425.30', 'Oct', '2022-10-20', '2022-10-20 21:49:33', NULL),
(199, 3, '1', '500.00', 'Oct', '2022-10-20', '2022-10-20 21:49:33', NULL),
(200, 4, '1', '380.03', 'Oct', '2022-10-20', '2022-10-20 21:49:33', NULL),
(201, 5, '1', '449.23', 'Oct', '2022-10-20', '2022-10-20 21:49:33', NULL),
(202, 7, '1', '415.13', 'Oct', '2022-10-20', '2022-10-20 21:49:33', NULL),
(203, 8, '1', '483.27', 'Oct', '2022-10-20', '2022-10-20 21:49:33', NULL),
(204, 9, '1', '306.13', 'Oct', '2022-10-20', '2022-10-20 21:49:33', NULL),
(205, 10, '1', '400.00', 'Oct', '2022-10-21', '2022-10-20 21:49:36', NULL),
(206, 1, '1', '500.00', 'Oct', '2022-10-21', '2022-10-20 21:49:36', NULL),
(207, 2, '1', '425.30', 'Oct', '2022-10-21', '2022-10-20 21:49:36', NULL),
(208, 3, '1', '500.00', 'Oct', '2022-10-21', '2022-10-20 21:49:36', NULL),
(209, 4, '1', '380.03', 'Oct', '2022-10-21', '2022-10-20 21:49:36', NULL),
(210, 5, '1', '449.23', 'Oct', '2022-10-21', '2022-10-20 21:49:36', NULL),
(211, 7, '1', '415.13', 'Oct', '2022-10-21', '2022-10-20 21:49:36', NULL),
(212, 8, '1', '483.27', 'Oct', '2022-10-21', '2022-10-20 21:49:36', NULL),
(213, 9, '1', '306.13', 'Oct', '2022-10-21', '2022-10-20 21:49:36', NULL),
(214, 10, '1', '400.00', 'Oct', '2022-10-22', '2022-10-20 21:49:40', NULL),
(215, 1, '1', '500.00', 'Oct', '2022-10-22', '2022-10-20 21:49:40', NULL),
(216, 2, '1', '425.30', 'Oct', '2022-10-22', '2022-10-20 21:49:40', NULL),
(217, 3, '1', '500.00', 'Oct', '2022-10-22', '2022-10-20 21:49:40', NULL),
(218, 4, '1', '380.03', 'Oct', '2022-10-22', '2022-10-20 21:49:40', NULL),
(219, 5, '1', '449.23', 'Oct', '2022-10-22', '2022-10-20 21:49:40', NULL),
(220, 7, '1', '415.13', 'Oct', '2022-10-22', '2022-10-20 21:49:40', NULL),
(221, 8, '1', '483.27', 'Oct', '2022-10-22', '2022-10-20 21:49:40', NULL),
(222, 9, '1', '306.13', 'Oct', '2022-10-22', '2022-10-20 21:49:40', NULL),
(223, 10, '1', '400.00', 'Oct', '2022-10-23', '2022-10-20 21:49:43', NULL),
(224, 1, '1', '500.00', 'Oct', '2022-10-23', '2022-10-20 21:49:44', NULL),
(225, 2, '1', '425.30', 'Oct', '2022-10-23', '2022-10-20 21:49:44', NULL),
(226, 3, '1', '500.00', 'Oct', '2022-10-23', '2022-10-20 21:49:44', NULL),
(227, 4, '1', '380.03', 'Oct', '2022-10-23', '2022-10-20 21:49:44', NULL),
(228, 5, '1', '449.23', 'Oct', '2022-10-23', '2022-10-20 21:49:44', NULL),
(229, 7, '1', '415.13', 'Oct', '2022-10-23', '2022-10-20 21:49:44', NULL),
(230, 8, '1', '483.27', 'Oct', '2022-10-23', '2022-10-20 21:49:44', NULL),
(231, 9, '1', '306.13', 'Oct', '2022-10-23', '2022-10-20 21:49:44', NULL),
(232, 10, '1', '400.00', 'Oct', '2022-10-24', '2022-10-20 21:49:47', NULL),
(233, 1, '1', '500.00', 'Oct', '2022-10-24', '2022-10-20 21:49:48', NULL),
(234, 2, '1', '425.30', 'Oct', '2022-10-24', '2022-10-20 21:49:48', NULL),
(235, 3, '1', '500.00', 'Oct', '2022-10-24', '2022-10-20 21:49:48', NULL),
(236, 4, '1', '380.03', 'Oct', '2022-10-24', '2022-10-20 21:49:48', NULL),
(237, 5, '1', '449.23', 'Oct', '2022-10-24', '2022-10-20 21:49:48', NULL),
(238, 7, '1', '415.13', 'Oct', '2022-10-24', '2022-10-20 21:49:48', NULL),
(239, 8, '1', '483.27', 'Oct', '2022-10-24', '2022-10-20 21:49:48', NULL),
(240, 9, '1', '306.13', 'Oct', '2022-10-24', '2022-10-20 21:49:48', NULL),
(241, 10, '1', '400.00', 'Oct', '2022-10-25', '2022-10-20 21:49:56', NULL),
(242, 1, '1', '500.00', 'Oct', '2022-10-25', '2022-10-20 21:49:56', NULL),
(243, 2, '1', '425.30', 'Oct', '2022-10-25', '2022-10-20 21:49:56', NULL),
(244, 3, '1', '500.00', 'Oct', '2022-10-25', '2022-10-20 21:49:56', NULL),
(245, 4, '1', '380.03', 'Oct', '2022-10-25', '2022-10-20 21:49:56', NULL),
(246, 5, '1', '449.23', 'Oct', '2022-10-25', '2022-10-20 21:49:56', NULL),
(247, 7, '1', '415.13', 'Oct', '2022-10-25', '2022-10-20 21:49:56', NULL),
(248, 8, '0.5', '241.63', 'Oct', '2022-10-25', '2022-10-20 21:49:56', NULL),
(249, 9, '1', '306.13', 'Oct', '2022-10-25', '2022-10-20 21:49:56', NULL),
(250, 10, '1', '400.00', 'Oct', '2022-10-26', '2022-10-20 21:49:59', NULL),
(251, 1, '1', '500.00', 'Oct', '2022-10-26', '2022-10-20 21:49:59', NULL),
(252, 2, '1', '425.30', 'Oct', '2022-10-26', '2022-10-20 21:49:59', NULL),
(253, 3, '1', '500.00', 'Oct', '2022-10-26', '2022-10-20 21:49:59', NULL),
(254, 4, '1', '380.03', 'Oct', '2022-10-26', '2022-10-20 21:49:59', NULL),
(255, 5, '1', '449.23', 'Oct', '2022-10-26', '2022-10-20 21:49:59', NULL),
(256, 7, '1', '415.13', 'Oct', '2022-10-26', '2022-10-20 21:50:00', NULL),
(257, 8, '0.5', '241.63', 'Oct', '2022-10-26', '2022-10-20 21:50:00', NULL),
(258, 9, '1', '306.13', 'Oct', '2022-10-26', '2022-10-20 21:50:00', NULL),
(259, 10, '1', '400.00', 'Oct', '2022-10-27', '2022-10-20 21:50:03', NULL),
(260, 1, '1', '500.00', 'Oct', '2022-10-27', '2022-10-20 21:50:03', NULL),
(261, 2, '1', '425.30', 'Oct', '2022-10-27', '2022-10-20 21:50:03', NULL),
(262, 3, '1', '500.00', 'Oct', '2022-10-27', '2022-10-20 21:50:03', NULL),
(263, 4, '1', '380.03', 'Oct', '2022-10-27', '2022-10-20 21:50:03', NULL),
(264, 5, '1', '449.23', 'Oct', '2022-10-27', '2022-10-20 21:50:03', NULL),
(265, 7, '1', '415.13', 'Oct', '2022-10-27', '2022-10-20 21:50:03', NULL),
(266, 8, '0.5', '241.63', 'Oct', '2022-10-27', '2022-10-20 21:50:03', NULL),
(267, 9, '1', '306.13', 'Oct', '2022-10-27', '2022-10-20 21:50:04', NULL),
(268, 10, '1', '400.00', 'Oct', '2022-10-28', '2022-10-20 21:50:07', NULL),
(269, 1, '1', '500.00', 'Oct', '2022-10-28', '2022-10-20 21:50:07', NULL),
(270, 2, '1', '425.30', 'Oct', '2022-10-28', '2022-10-20 21:50:07', NULL),
(271, 3, '1', '500.00', 'Oct', '2022-10-28', '2022-10-20 21:50:07', NULL),
(272, 4, '1', '380.03', 'Oct', '2022-10-28', '2022-10-20 21:50:07', NULL),
(273, 5, '1', '449.23', 'Oct', '2022-10-28', '2022-10-20 21:50:07', NULL),
(274, 7, '1', '415.13', 'Oct', '2022-10-28', '2022-10-20 21:50:07', NULL),
(275, 8, '0.5', '241.63', 'Oct', '2022-10-28', '2022-10-20 21:50:08', NULL),
(276, 9, '1', '306.13', 'Oct', '2022-10-28', '2022-10-20 21:50:08', NULL),
(277, 10, '1', '400.00', 'Oct', '2022-10-29', '2022-10-20 21:50:12', NULL),
(278, 1, '1', '500.00', 'Oct', '2022-10-29', '2022-10-20 21:50:12', NULL),
(279, 2, '1', '425.30', 'Oct', '2022-10-29', '2022-10-20 21:50:13', NULL),
(280, 3, '1', '500.00', 'Oct', '2022-10-29', '2022-10-20 21:50:13', NULL),
(281, 4, '1', '380.03', 'Oct', '2022-10-29', '2022-10-20 21:50:13', NULL),
(282, 5, '1', '449.23', 'Oct', '2022-10-29', '2022-10-20 21:50:13', NULL),
(283, 7, '1', '415.13', 'Oct', '2022-10-29', '2022-10-20 21:50:13', NULL),
(284, 8, '0.5', '241.63', 'Oct', '2022-10-29', '2022-10-20 21:50:13', NULL),
(285, 9, '1', '306.13', 'Oct', '2022-10-29', '2022-10-20 21:50:13', NULL),
(286, 10, '1', '400.00', 'Oct', '2022-10-30', '2022-10-20 21:50:16', NULL),
(287, 1, '1', '500.00', 'Oct', '2022-10-30', '2022-10-20 21:50:16', NULL),
(288, 2, '1', '425.30', 'Oct', '2022-10-30', '2022-10-20 21:50:16', NULL),
(289, 3, '1', '500.00', 'Oct', '2022-10-30', '2022-10-20 21:50:17', NULL),
(290, 4, '1', '380.03', 'Oct', '2022-10-30', '2022-10-20 21:50:17', NULL),
(291, 5, '1', '449.23', 'Oct', '2022-10-30', '2022-10-20 21:50:17', NULL),
(292, 7, '1', '415.13', 'Oct', '2022-10-30', '2022-10-20 21:50:17', NULL),
(293, 8, '0.5', '241.63', 'Oct', '2022-10-30', '2022-10-20 21:50:17', NULL),
(294, 9, '1', '306.13', 'Oct', '2022-10-30', '2022-10-20 21:50:17', NULL),
(295, 10, '1', '400.00', 'Oct', '2022-10-31', '2022-10-20 21:50:21', NULL),
(296, 1, '1', '500.00', 'Oct', '2022-10-31', '2022-10-20 21:50:21', NULL),
(297, 2, '1', '425.30', 'Oct', '2022-10-31', '2022-10-20 21:50:21', NULL),
(298, 3, '1', '500.00', 'Oct', '2022-10-31', '2022-10-20 21:50:21', NULL),
(299, 4, '1', '380.03', 'Oct', '2022-10-31', '2022-10-20 21:50:21', NULL),
(300, 5, '1', '449.23', 'Oct', '2022-10-31', '2022-10-20 21:50:21', NULL),
(301, 7, '1', '415.13', 'Oct', '2022-10-31', '2022-10-20 21:50:21', NULL),
(302, 8, '0.5', '241.63', 'Oct', '2022-10-31', '2022-10-20 21:50:21', NULL),
(303, 9, '1', '306.13', 'Oct', '2022-10-31', '2022-10-20 21:50:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_date` date DEFAULT NULL,
  `actual_or_further_processing_date` date DEFAULT NULL,
  `is_processed_or_not` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_period` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `milk_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `morning` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evening` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` bigint(15) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_type`, `bill_period`, `customer_location`, `description`, `milk_rate`, `morning`, `evening`, `mobile_no`, `email`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Noble', NULL, NULL, NULL, NULL, '75', '480', '320', NULL, NULL, 'active', '2022-10-21 12:11:25', '2022-10-21 12:11:25'),
(11, 'Punjab', NULL, NULL, NULL, NULL, '77', '240', '0', NULL, NULL, 'active', '2022-10-21 12:31:47', '2022-10-21 12:31:47'),
(12, 'Royal In', NULL, NULL, NULL, NULL, '74', '400', '0', NULL, NULL, 'active', '2022-10-21 12:32:00', '2022-10-21 12:32:00'),
(13, 'United', NULL, NULL, NULL, NULL, '75', '0', '80', NULL, NULL, 'active', '2022-10-21 12:32:13', '2022-10-21 12:32:13'),
(14, 'Shantilal', NULL, NULL, NULL, NULL, '78', '0', '70', NULL, NULL, 'active', '2022-10-21 12:32:39', '2022-10-21 12:32:39'),
(15, 'Madhvi', NULL, NULL, NULL, NULL, '76', '40', '40', NULL, NULL, 'active', '2022-10-21 12:32:51', '2022-10-21 12:32:51'),
(16, 'Harish', NULL, NULL, NULL, NULL, '77', '40', '35', NULL, NULL, 'active', '2022-10-21 12:33:09', '2022-10-21 12:33:09'),
(17, 'Bharat', NULL, NULL, NULL, NULL, '78', '45', '25', NULL, NULL, 'active', '2022-10-21 12:33:23', '2022-10-21 12:33:23'),
(18, 'Kailash', NULL, NULL, NULL, NULL, '78', '35', '10', NULL, NULL, 'active', '2022-10-21 12:33:37', '2022-10-21 12:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `processing_days` bigint(20) DEFAULT NULL,
  `medical_days1` bigint(20) DEFAULT NULL,
  `medical_days2` bigint(20) DEFAULT NULL,
  `days_in_salves` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` bigint(15) DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `mobile_no`, `location`, `salary`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Employee 1', 9999999991, 'goregaon (W)', '15000', 'active', '2022-10-15 05:56:53', '2022-10-21 09:44:06'),
(2, 'Employee 2', 9999999992, 'goregaon(E)', '12759', 'active', '2022-10-15 05:56:53', '2022-10-20 09:00:48'),
(3, 'Employee 3', 9999999997, 'malad(W)', '15000', 'active', '2022-10-15 05:56:53', '2022-10-20 09:05:00'),
(4, 'Employee 4', 9999999998, 'malad(E)', '11401', 'active', '2022-10-15 05:56:53', '2022-10-15 05:56:53'),
(5, 'Employee 5', 446848, 'Enim.', '13477', 'active', '2022-10-15 05:56:53', '2022-10-15 05:56:53'),
(7, 'Employee 7', 1437, 'Ut.', '12454', 'active', '2022-10-15 05:56:53', '2022-10-15 05:56:53'),
(8, 'Employee 8', 0, 'Illo.', '14498', 'active', '2022-10-15 05:56:53', '2022-10-15 05:56:53'),
(9, 'Employee 9', 1351, 'Enim.', '9184', 'active', '2022-10-15 05:56:53', '2022-10-15 05:56:53'),
(10, 'alex wade', 4646456456, 'sdasd', '12000', 'active', '2022-10-20 14:21:38', '2022-10-21 09:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `external_collection`
--

CREATE TABLE `external_collection` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext_party_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `morning` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evening` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_given_taken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `total_litres` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `external_collection`
--

INSERT INTO `external_collection` (`id`, `type`, `party_name`, `ext_party_name`, `morning`, `evening`, `total_given_taken`, `rate`, `date`, `total_litres`, `amount_paid`, `created_at`, `updated_at`) VALUES
(4, 'bazaar', NULL, NULL, '200', '0', NULL, NULL, '2022-10-22', '200', NULL, '2022-10-22 06:26:44', NULL),
(5, 'fridge', NULL, NULL, '100', '408', NULL, NULL, '2022-10-22', '508', NULL, '2022-10-22 06:26:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount_by_customer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount_by_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount_paid_by_customer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount_paid_by_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_amount_paid`
--

CREATE TABLE `food_amount_paid` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `party_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_paid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_stock_use`
--

CREATE TABLE `food_stock_use` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ghabhan_detail`
--

CREATE TABLE `ghabhan_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `processing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `medical_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_date` date DEFAULT NULL,
  `medical_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `send_to_salves_or_not` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salve_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salve_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salves_date` date DEFAULT NULL,
  `back_to_mumbai_date` date DEFAULT NULL,
  `status` enum('inactive','salves','mumbai','pending') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khilla`
--

CREATE TABLE `khilla` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `khilla_no` bigint(20) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicals`
--

CREATE TABLE `medicals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buy_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `units` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_checkup`
--

CREATE TABLE `medical_checkup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `processing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_date` date DEFAULT NULL,
  `medical_date` date DEFAULT NULL,
  `actual_medical_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `is_pregnant_or_not` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2020_09_15_073708_create_sessions_table', 1),
(12, '2020_09_15_150043_create_products_table', 1),
(13, '2020_09_15_150431_create_product_stock_table', 1),
(14, '2020_09_16_145446_create_customers_table', 1),
(15, '2020_09_16_181637_create_milkcollections_table', 1),
(16, '2020_09_17_085440_create_milksolds_table', 1),
(17, '2020_09_17_173513_create_salves_table', 1),
(18, '2020_09_19_045215_create_rents_table', 1),
(19, '2020_09_19_045611_create_medicals_table', 1),
(20, '2020_09_19_045630_create_food_table', 1),
(21, '2020_09_20_123306_create_weekly_billing_table', 1),
(22, '2020_09_24_081726_create_days_table', 1),
(23, '2020_09_24_165631_create_transfer_salve_table', 1),
(24, '2020_09_25_125904_create_processing_data_table', 1),
(25, '2020_10_01_055001_create_medical_checkup_table', 1),
(26, '2020_10_04_173451_create_locations_table', 1),
(27, '2020_10_04_173807_create_khilla_table', 1),
(28, '2020_10_25_123803_create_audit_log_table', 1),
(29, '2020_11_02_053821_create_ghabhan_detail_table', 1),
(30, '2020_11_06_045028_create_external_collection_table', 1),
(31, '2020_11_10_041906_create_roles_table', 1),
(32, '2020_11_10_050450_create_role_user_table', 1),
(33, '2020_11_16_053320_create_food_stock_use_table', 1),
(34, '2020_11_24_161242_create_expenses_table', 1),
(35, '2020_11_25_134955_create_weights_table', 1),
(36, '2020_12_09_120857_create_food_amount_paid_table', 1),
(37, '2022_10_13_154833_create_employees_table', 1),
(38, '2022_10_13_163637_create_attendance_list', 1),
(39, '2022_10_15_111045_create_stock_items_table', 1),
(40, '2022_10_15_111046_create_stock_in_table', 1),
(41, '2022_10_15_111055_create_stock_out_table', 1),
(42, '2022_10_15_112527_create_stock_available_table', 1),
(43, '2022_10_21_190906_create_milk_users_table', 2),
(44, '2022_10_21_190907_create_milk_users_table', 3),
(45, '2022_10_21_210409_create_milk_user_entry_table', 4),
(46, '2022_10_21_190908_create_milk_users_table', 5),
(47, '2022_10_21_190910_create_milk_users_table', 6),
(48, '2022_10_21_210411_create_milk_user_entry_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `milkcollections`
--

CREATE TABLE `milkcollections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `morning` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evening` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `givenreturn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `takenreturn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_litres` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milkcollections`
--

INSERT INTO `milkcollections` (`id`, `morning`, `evening`, `given`, `givenreturn`, `taken`, `takenreturn`, `total_litres`, `grand_total`, `collection_date`, `created_at`, `updated_at`) VALUES
(3, '1280', '580', NULL, NULL, NULL, NULL, '1860', NULL, '2022-10-22', '2022-10-22 06:26:43', '2022-10-22 06:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `milksolds`
--

CREATE TABLE `milksolds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `normal_customer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `milk_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `morning` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evening` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_litres` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sold_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milksolds`
--

INSERT INTO `milksolds` (`id`, `customer_id`, `type`, `normal_customer_name`, `milk_rate`, `morning`, `evening`, `total_litres`, `amount_paid`, `pending_amount`, `total_amount`, `sold_date`, `created_at`, `updated_at`) VALUES
(12, 10, NULL, NULL, NULL, '480', '320', '800', NULL, NULL, '60000', '2022-10-22', '2022-10-22 18:26:43', '2022-10-22 18:26:43'),
(13, 11, NULL, NULL, NULL, '240', '0', '240', NULL, NULL, '18480', '2022-10-22', '2022-10-22 18:26:43', '2022-10-22 18:26:43'),
(14, 12, NULL, NULL, NULL, '400', '0', '400', NULL, NULL, '29600', '2022-10-22', '2022-10-22 18:26:43', '2022-10-22 18:26:43'),
(15, 13, NULL, NULL, NULL, '0', '80', '80', NULL, NULL, '6000', '2022-10-22', '2022-10-22 18:26:43', '2022-10-22 18:26:43'),
(16, 14, NULL, NULL, NULL, '0', '70', '70', NULL, NULL, '5460', '2022-10-22', '2022-10-22 18:26:43', '2022-10-22 18:26:43'),
(17, 15, NULL, NULL, NULL, '40', '40', '80', NULL, NULL, '6080', '2022-10-22', '2022-10-22 18:26:43', '2022-10-22 18:26:43'),
(18, 16, NULL, NULL, NULL, '40', '35', '75', NULL, NULL, '5775', '2022-10-22', '2022-10-22 18:26:43', '2022-10-22 18:26:43'),
(19, 17, NULL, NULL, NULL, '45', '25', '70', NULL, NULL, '5460', '2022-10-22', '2022-10-22 18:26:44', '2022-10-22 18:26:44'),
(20, 18, NULL, NULL, NULL, '35', '10', '45', NULL, NULL, '3510', '2022-10-22', '2022-10-22 18:26:44', '2022-10-22 18:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `milk_users`
--

CREATE TABLE `milk_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `morning` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evening` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_litres` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milk_users`
--

INSERT INTO `milk_users` (`id`, `name`, `morning`, `evening`, `total_litres`, `created_at`, `updated_at`) VALUES
(1, 'N.Patel', '195', '190', '385', '2022-10-20 21:37:08', NULL),
(2, 'Patel', '442', '417', '859', '2022-10-20 21:37:08', NULL),
(3, 'Altaf', '193', '181', '859', '2022-10-20 21:37:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `milk_user_entry`
--

CREATE TABLE `milk_user_entry` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `morning` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evening` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_litres` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milk_user_entry`
--

INSERT INTO `milk_user_entry` (`id`, `user_id`, `morning`, `evening`, `total_litres`, `date`, `created_at`, `updated_at`) VALUES
(4, 1, '195', '190', '385', '2022-10-22', '2022-10-22 06:26:44', NULL),
(5, 2, '442', '417', '859', '2022-10-22', '2022-10-22 06:26:44', NULL),
(6, 3, '193', '181', '374', '2022-10-22', '2022-10-22 06:26:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'PATEL_DAIRY_FARM Personal Access Client', 'LhdKMEwS3wivDS53jW5KeCCfFNGswz2e6kG8vksM', NULL, 'http://localhost', 1, 0, 0, '2022-10-20 14:15:30', '2022-10-20 14:15:30'),
(2, NULL, 'PATEL_DAIRY_FARM Password Grant Client', '9zVeJufjCuRnELncYcc94PQIxZESYZDZC5L5WIeA', 'users', 'http://localhost', 0, 1, 0, '2022-10-20 14:15:31', '2022-10-20 14:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-10-20 14:15:30', '2022-10-20 14:15:30');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `processing_data`
--

CREATE TABLE `processing_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_date` date DEFAULT NULL,
  `actual_or_further_processing_date` date DEFAULT NULL,
  `is_processed_or_not` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_process` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `khilla_no` bigint(20) DEFAULT NULL,
  `extra_khilla_no` bigint(20) DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `purchase_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `party_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent_paid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', '2022-10-15 05:56:44', '2022-10-15 05:56:44'),
(2, 'admin', '2022-10-15 05:56:44', '2022-10-15 05:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salves`
--

CREATE TABLE `salves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salve_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
<<<<<<< HEAD:patel_dairy_farm.sql
('Jv8ATGgjx1nRGrk2cKjDpKpE8AQtz9NyWEtEWh2y', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYVF1NGJoSWYxV2hhZm5rUm1mNm1iWHV2eFdpUElMMldsOFBZakF2dyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDgwL1BERi9hdHRlbmRhbmNlIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9QREYvbG9naW4iO319', 1667626647),
('TIPjmX2G7goYB5tyAhf73zaizokfJu1jvHNVXrBd', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYXlpN0w3YXlZZ1hWRXFTbk9CUkFGdk5PeEpkOWJCSVpmejNKSW5SVyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNToiaHR0cDovL2xvY2FsaG9zdDo4MDgwL1BERiI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0OjgwODAvUERGL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1667655441);
=======
('aKJABCimCc3CK0WprW80ZGDK49p7KBcQcU1rFH8n', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRlFJRldSYldpUVR0eUVKc2JPdmhsMVBCV1A5SU55RzFqQThEU1Q2RSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vbG9jYWxob3N0OjgwODAvUERGL21pbGtfZW50cmllcy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkUzhsRGl1S1k1L1hvZzVZS25WY3p3ZVMvRlBDTUkwUUREUFNXMzNKcDRVTU5hSTVOSTBnRGEiO30=', 1666442599),
('rom8C1WuKdfecwp6J3DfecGiExOWlNC57jjdKZG4', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSEhESmRQMGNmd3JjQ1pBNDN6SGowbmRKUlM5NzBkY1JCRG9tUXRFWiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NToiaHR0cDovL2xvY2FsaG9zdDo4MDgwL1BERi9taWxrX2VudHJpZXMvY3JlYXRlIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9QREYvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1666842774),
('YhfUUKviQz99lYTVoirwCXz4qHbuQKCVpJvpAB8q', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWXFUekVaR0w3bkV3V3BsTHdGSUFrQ1VueDZSS1psbHBCMkN6S2FOaiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovL2xvY2FsaG9zdDo4MDgwL215cHJvamVjdHMvUERGMSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vbG9jYWxob3N0OjgwODAvbXlwcm9qZWN0cy9QREYxL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1666874181),
('yQoUKnN1MvPdSnFd2jSJgWagKIEza2ORSWiuG0bQ', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMU5HZUtpaWQ2ejR6azVuT1F0U3JOTEpxeEJ0eThFa016NGkwNzRYNCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ3OiJodHRwOi8vbG9jYWxob3N0OjgwODAvbXlwcm9qZWN0cy9QREYvYXR0ZW5kYW5jZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRTOGxEaXVLWTUvWG9nNVlLblZjendlUy9GUENNSTBRRERQU1czM0pwNFVNTmFJNU5JMGdEYSI7fQ==', 1667624566),
('ZLH926TqpTMVRqX1FDQUAT8ppcGGxqYyUIGq7Hbw', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTk53TmtDak5iMk5odm5neG54RU1yWk9iaVpTOW40RDRnTGtaMWVpYSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vbG9jYWxob3N0OjgwODAvUERGL21pbGtfZW50cmllcy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkUzhsRGl1S1k1L1hvZzVZS25WY3p3ZVMvRlBDTUkwUUREUFNXMzNKcDRVTU5hSTVOSTBnRGEiO30=', 1666465053);
>>>>>>> f654dd8f47ef4609397334fd30d5d28846e09d48:patel_dairy_farm.mssql

-- --------------------------------------------------------

--
-- Table structure for table `stock_available`
--

CREATE TABLE `stock_available` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` bigint(20) UNSIGNED NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_available`
--

INSERT INTO `stock_available` (`id`, `item_id`, `unit`, `qty`, `rate`, `date`, `created_at`, `updated_at`) VALUES
(1, 2, 'PCS', 106, '95.85', '2022-10-15', '2022-10-15 06:56:51', '2022-10-19 05:55:01'),
(2, 1, 'BOX', 25, '52.43', '2022-10-19', '2022-10-15 07:28:48', '2022-10-20 22:53:50'),
(3, 3, 'PCS', 113, '54', '2022-10-17', '2022-10-17 05:28:51', '2022-10-18 22:46:46'),
<<<<<<< HEAD:patel_dairy_farm.sql
(5, 4, 'GUNI', 0, '340.91', '2022-10-19', '2022-10-19 00:04:11', '2022-11-05 05:31:12');
=======
(5, 4, 'GUNI', 25, '789.47', '2022-10-19', '2022-10-19 00:04:11', '2022-10-20 22:53:09');
>>>>>>> f654dd8f47ef4609397334fd30d5d28846e09d48:patel_dairy_farm.mssql

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `party_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` bigint(20) UNSIGNED NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`id`, `item_id`, `party_name`, `unit`, `qty`, `rate`, `total_amount`, `date`, `created_at`, `updated_at`) VALUES
(1, 2, 'amit', 'PCS', 50, '150', '7500', '2022-10-15', '2022-10-15 06:56:51', NULL),
(2, 1, 'raj', 'BOX', 65, '62', '4030', '2022-10-19', '2022-10-15 07:28:47', NULL),
(3, 2, 'raju', 'BOX', 40, '62', '2480', '2022-10-25', '2022-10-15 00:28:41', NULL),
(4, 2, 'raju', 'BOX', 40, '62', '2480', '2022-10-25', '2022-10-15 00:29:06', NULL),
(7, 3, 'test', 'PCS', 129, '54', '6966', '2022-10-17', '2022-10-17 05:28:51', NULL),
(8, 1, NULL, 'BOX', 20, '0', '0', '2022-10-19', '2022-10-19 07:21:40', NULL),
(9, 1, 'test', 'BOX', 20, '100', '2000', '2022-10-25', '2022-10-18 21:05:32', NULL),
(12, 4, 'TEST', 'GUNI', 10, '1500', '15000', '2022-10-19', '2022-10-19 00:04:11', NULL),
(13, 4, NULL, 'GUNI', 8, '1500', '12000', '2022-10-20', '2022-10-19 00:05:02', '2022-10-19 00:08:16'),
(14, 4, 'FS', 'GUNI', 20, '150', '3000', '2022-10-20', '2022-10-19 21:57:16', NULL),
<<<<<<< HEAD:patel_dairy_farm.sql
(15, 1, 'test', 'GUNI', 10, '0', '0', '2022-10-21', '2022-10-20 22:53:50', NULL),
(16, 4, 'amit', 'GUNI', 50, '0', '0', '2022-11-05', '2022-11-05 05:29:33', NULL);
=======
(15, 1, 'test', 'GUNI', 10, '0', '0', '2022-10-21', '2022-10-20 22:53:50', NULL);
>>>>>>> f654dd8f47ef4609397334fd30d5d28846e09d48:patel_dairy_farm.mssql

-- --------------------------------------------------------

--
-- Table structure for table `stock_items`
--

CREATE TABLE `stock_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
<<<<<<< HEAD:patel_dairy_farm.sql
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
=======
  `created_at` datetime DEFAULT current_timestamp(),
>>>>>>> f654dd8f47ef4609397334fd30d5d28846e09d48:patel_dairy_farm.mssql
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_items`
--

INSERT INTO `stock_items` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'tuwar', '2022-10-19 00:00:00', NULL),
(2, 'chana', '2022-10-19 00:00:00', NULL),
(3, 'daal', '2022-10-19 00:00:00', NULL),
(4, 'bhusa', '2022-10-19 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`id`, `item_id`, `unit`, `qty`, `rate`, `total_amount`, `date`, `created_at`, `updated_at`) VALUES
(1, 2, 'PCS', 12, '1', '12', '2022-10-15', '2022-10-15 06:59:38', NULL),
(3, 1, 'PCS', 13, NULL, NULL, '2022-10-15', '2022-10-15 05:53:32', NULL),
(6, 3, 'PCS', 12, NULL, NULL, '2022-10-19', '2022-10-19 07:03:30', NULL),
(8, 1, 'PCS', 3, NULL, NULL, '2022-10-19', '2022-10-19 07:20:08', NULL),
(9, 1, 'PCS', 49, NULL, NULL, '2022-10-19', '2022-10-19 07:20:36', NULL),
(10, 3, 'PCS', 4, NULL, NULL, '2022-10-19', '2022-10-18 22:46:45', NULL),
(12, 4, 'GUNI', 6, NULL, NULL, '2022-10-19', '2022-10-19 00:04:42', NULL),
(13, 4, 'GUNI', 1, NULL, NULL, '2022-10-19', '2022-10-19 00:19:42', '2022-10-19 00:20:05'),
(14, 2, 'PCS', 12, NULL, NULL, '2022-10-19', '2022-10-19 05:55:00', NULL),
(15, 4, 'GUNI', 1, NULL, NULL, '2022-10-20', '2022-10-19 21:57:49', NULL),
(16, 4, 'GUNI', 2, NULL, NULL, NULL, '2022-10-20 05:07:21', NULL),
(17, 4, 'GUNI', 3, NULL, NULL, NULL, '2022-10-20 22:53:09', NULL),
<<<<<<< HEAD:patel_dairy_farm.sql
(18, 1, 'GUNI', 25, NULL, NULL, '2022-10-21', '2022-10-20 22:53:32', NULL),
(19, 4, 'GUNI', 2, NULL, NULL, '2022-11-06', '2022-11-05 05:30:48', NULL),
(20, 4, 'GUNI', 73, NULL, NULL, '2022-11-07', '2022-11-05 05:31:12', NULL);
=======
(18, 1, 'GUNI', 25, NULL, NULL, '2022-10-21', '2022-10-20 22:53:32', NULL);
>>>>>>> f654dd8f47ef4609397334fd30d5d28846e09d48:patel_dairy_farm.mssql

-- --------------------------------------------------------

--
-- Table structure for table `transfer_salve`
--

CREATE TABLE `transfer_salve` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salve_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
<<<<<<< HEAD:patel_dairy_farm.sql
(1, 'mmk', 'mmk@gmail.com', '2022-10-15 05:56:49', '$2y$10$S8lDiuKY5/Xog5YKnVczweS/FPCMI0QDDPSW33Jp4UMNaI5NI0gDa', NULL, NULL, 'PsA6r9RzKVkUFCM9SCQ0DaSlms8J37u6D6uj4FlWIzAo5dvwgwAzp8BULirr', NULL, NULL, '2022-10-15 05:56:49', '2022-10-15 05:56:49'),
=======
(1, 'mmk', 'mmk@gmail.com', '2022-10-15 05:56:49', '$2y$10$S8lDiuKY5/Xog5YKnVczweS/FPCMI0QDDPSW33Jp4UMNaI5NI0gDa', NULL, NULL, 'zaXAzUpOxPzSxNy8CoFvpcbEamtqXNmjYPjg0Ezjegeq8qCwTmnkbzbmoiZs', NULL, NULL, '2022-10-15 05:56:49', '2022-10-15 05:56:49'),
>>>>>>> f654dd8f47ef4609397334fd30d5d28846e09d48:patel_dairy_farm.mssql
(2, 'admin', 'admin@gmail.com', '2022-10-15 05:56:49', '$2y$10$LYm0AhrRw/oBu6z58uwyK.wMkF3rjQqCFDKqF06MxlnC.xK8iBCP.', NULL, NULL, 'ecd49ONzA4', NULL, NULL, '2022-10-15 05:56:49', '2022-10-15 05:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_billing`
--

CREATE TABLE `weekly_billing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bill_no` bigint(20) DEFAULT NULL,
  `bill_period` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_litres` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adjusted` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE `weights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `morning` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evening` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `month_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_list`
--
ALTER TABLE `attendance_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_list_eid_foreign` (`eid`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `external_collection`
--
ALTER TABLE `external_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_amount_paid`
--
ALTER TABLE `food_amount_paid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_stock_use`
--
ALTER TABLE `food_stock_use`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ghabhan_detail`
--
ALTER TABLE `ghabhan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khilla`
--
ALTER TABLE `khilla`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicals`
--
ALTER TABLE `medicals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_checkup`
--
ALTER TABLE `medical_checkup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkcollections`
--
ALTER TABLE `milkcollections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milksolds`
--
ALTER TABLE `milksolds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milk_users`
--
ALTER TABLE `milk_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milk_user_entry`
--
ALTER TABLE `milk_user_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `milk_user_entry_user_id_foreign` (`user_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `processing_data`
--
ALTER TABLE `processing_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salves`
--
ALTER TABLE `salves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_available`
--
ALTER TABLE `stock_available`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_available_item_id_foreign` (`item_id`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_in_item_id_foreign` (`item_id`);

--
-- Indexes for table `stock_items`
--
ALTER TABLE `stock_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_out_item_id_foreign` (`item_id`);

--
-- Indexes for table `transfer_salve`
--
ALTER TABLE `transfer_salve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weekly_billing`
--
ALTER TABLE `weekly_billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weights`
--
ALTER TABLE `weights`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_list`
--
ALTER TABLE `attendance_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `external_collection`
--
ALTER TABLE `external_collection`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_amount_paid`
--
ALTER TABLE `food_amount_paid`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_stock_use`
--
ALTER TABLE `food_stock_use`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ghabhan_detail`
--
ALTER TABLE `ghabhan_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khilla`
--
ALTER TABLE `khilla`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicals`
--
ALTER TABLE `medicals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_checkup`
--
ALTER TABLE `medical_checkup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `milkcollections`
--
ALTER TABLE `milkcollections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `milksolds`
--
ALTER TABLE `milksolds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `milk_users`
--
ALTER TABLE `milk_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `milk_user_entry`
--
ALTER TABLE `milk_user_entry`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `processing_data`
--
ALTER TABLE `processing_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock`
--
ALTER TABLE `product_stock`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salves`
--
ALTER TABLE `salves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_available`
--
ALTER TABLE `stock_available`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
<<<<<<< HEAD:patel_dairy_farm.sql
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
=======
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
>>>>>>> f654dd8f47ef4609397334fd30d5d28846e09d48:patel_dairy_farm.mssql

--
-- AUTO_INCREMENT for table `stock_items`
--
ALTER TABLE `stock_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
<<<<<<< HEAD:patel_dairy_farm.sql
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
=======
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
>>>>>>> f654dd8f47ef4609397334fd30d5d28846e09d48:patel_dairy_farm.mssql

--
-- AUTO_INCREMENT for table `transfer_salve`
--
ALTER TABLE `transfer_salve`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `weekly_billing`
--
ALTER TABLE `weekly_billing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weights`
--
ALTER TABLE `weights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_list`
--
ALTER TABLE `attendance_list`
  ADD CONSTRAINT `attendance_list_eid_foreign` FOREIGN KEY (`eid`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `milk_user_entry`
--
ALTER TABLE `milk_user_entry`
  ADD CONSTRAINT `milk_user_entry_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `milk_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_available`
--
ALTER TABLE `stock_available`
  ADD CONSTRAINT `stock_available_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `stock_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD CONSTRAINT `stock_in_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `stock_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD CONSTRAINT `stock_out_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `stock_items` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
