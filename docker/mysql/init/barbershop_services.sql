-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2026 at 01:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barbershop_services`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `barber_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `service_id`, `customer_name`, `phone`, `booking_date`, `booking_time`, `transaction_id`, `status`, `created_at`, `user_id`, `barber_id`) VALUES
(19, 3, 'Gauber', '0990009877', '2025-04-19', '13:30:00', 73, 'confirmed', '2025-04-17 22:18:49', 0, NULL),
(22, 2, 'Matt', '08798712345', '2025-04-19', '13:00:00', 76, 'confirmed', '2025-04-18 12:37:34', 0, NULL),
(27, 3, 'Garry Terry', '08798712345', '2025-04-19', '10:30:00', 92, 'confirmed', '2025-04-18 18:11:13', 0, NULL),
(61, 2, 'Marvin Zanchi', '08798712345', '2025-04-25', '10:30:00', 173, 'confirmed', '2025-04-24 18:32:07', 3, NULL),
(62, 5, 'Marvin Zanchi', '08798712345', '2025-04-25', '09:00:00', 174, 'confirmed', '2025-04-25 02:48:58', 3, NULL),
(69, 3, 'Marvin Zanchi', '08798712345', '2025-04-30', '10:00:00', 185, 'confirmed', '2025-04-29 17:23:58', 3, 5),
(78, 3, 'Marvin Zanchi', '08798712345', '2025-05-02', '11:00:00', 198, 'completed', '2025-04-30 14:06:22', 3, 5),
(88, 2, 'Barry Barry', '0879871345', '2025-05-29', '17:00:00', 209, 'confirmed', '2025-05-01 13:27:36', 3, 6),
(90, 1, 'William Walsh', '0837654322', '2025-05-09', '15:00:00', 212, 'confirmed', '2025-05-04 09:50:28', 12, 6),
(91, 4, 'Paddy Murphy', '0896544321', '2025-05-09', '15:30:00', 213, 'cancelled', '2025-05-04 09:57:55', 12, 6),
(103, 3, 'Robert Mayer', '0879871233', '2025-05-12', '10:00:00', 225, 'confirmed', '2025-05-06 08:31:03', 3, 6),
(104, 1, 'Marvin Zanchi', '08798712345', '2025-05-06', '15:00:00', 226, 'cancelled', '2025-05-06 09:20:07', 3, 5),
(105, 1, 'Carl Moore', '0876554413', '2025-05-09', '10:00:00', 227, 'cancelled', '2025-05-06 09:56:19', 25, 5),
(107, 1, 'Marvin Zanchi', '0879871235', '2025-09-26', '15:00:00', 229, 'confirmed', '2025-09-25 11:03:30', 3, 5),
(110, 2, 'John Doe', '0879871234', '2026-01-15', '13:00:00', 232, 'confirmed', '2026-01-12 10:54:05', 3, 6),
(111, 4, 'Adminuser', '01234567789', '2026-01-17', '13:30:00', 233, 'confirmed', '2026-01-12 16:09:06', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(50) DEFAULT NULL,
  `transaction_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_phone`, `transaction_id`, `status`, `created_at`, `user_id`) VALUES
(1, 'LateTest', '08798712345', 19, 'completed', '2025-04-14 23:13:28', NULL),
(2, '', '', 20, 'completed', '2025-04-14 23:16:04', NULL),
(3, '', '', 23, 'completed', '2025-04-15 21:16:31', NULL),
(4, '', '', 24, 'completed', '2025-04-15 21:53:40', NULL),
(5, '', '', 25, 'completed', '2025-04-15 22:26:23', NULL),
(6, '', '', 35, 'completed', '2025-04-15 23:43:06', NULL),
(7, '', '', 38, 'completed', '2025-04-16 00:05:53', NULL),
(8, '', '', 39, 'completed', '2025-04-16 00:07:03', NULL),
(9, '', '08798712345', 65, 'completed', '2025-04-17 18:28:04', NULL),
(10, '', '0990009877', 66, 'completed', '2025-04-17 21:13:34', NULL),
(11, '', '08798712345', 67, 'completed', '2025-04-17 21:30:20', NULL),
(12, '', '0990009877', 73, 'completed', '2025-04-17 22:18:49', NULL),
(13, '', '02023213354354', 74, 'completed', '2025-04-17 22:20:21', NULL),
(14, '', '08798712345', 75, 'completed', '2025-04-18 11:28:36', NULL),
(15, '', '08798712345', 76, 'completed', '2025-04-18 12:37:34', NULL),
(16, '', '02023213354354', 77, 'completed', '2025-04-18 12:52:02', NULL),
(17, '', '02023213354354', 78, 'completed', '2025-04-18 15:49:02', NULL),
(18, '', '08798712345', 79, 'completed', '2025-04-18 15:51:44', NULL),
(19, '', '08798712345', 81, 'completed', '2025-04-18 15:59:49', NULL),
(20, '', '08798712345', 92, 'completed', '2025-04-18 18:11:13', NULL),
(21, '', '02023213354354', 93, 'completed', '2025-04-18 19:02:47', NULL),
(22, '', '', 94, 'completed', '2025-04-18 19:18:41', NULL),
(23, '', '02023213354354', 95, 'completed', '2025-04-18 21:55:48', NULL),
(24, '', '', 96, 'completed', '2025-04-18 21:57:50', NULL),
(25, '', '02023213354354', 97, 'completed', '2025-04-18 22:14:44', NULL),
(26, '', '08998765432', 98, 'completed', '2025-04-18 22:23:33', NULL),
(27, '', '', 99, 'completed', '2025-04-18 22:24:49', NULL),
(28, '', '02023213354354', 100, 'completed', '2025-04-18 22:27:07', NULL),
(29, '', '0202321335435222', 102, 'completed', '2025-04-18 22:52:04', NULL),
(30, '', '', 103, 'completed', '2025-04-18 22:53:08', NULL),
(31, '', '02023213354354', 105, 'completed', '2025-04-18 23:22:57', NULL),
(32, '', '', 106, 'completed', '2025-04-18 23:23:49', NULL),
(33, '', '', 153, 'completed', '2025-04-22 13:07:38', NULL),
(34, 'John Doe', '0841341987', 166, 'completed', '2025-04-22 23:32:28', NULL),
(35, 'John Doe', '0841341987', 167, 'completed', '2025-04-22 23:36:09', NULL),
(36, 'Garry Terry', '0987666678888', 171, 'completed', '2025-04-23 12:25:20', NULL),
(37, 'Marvin Zanchi', '08798712345', 176, 'completed', '2025-04-29 11:09:15', NULL),
(38, 'Marvin Zanchi', '08798712345', 177, 'completed', '2025-04-29 11:13:41', NULL),
(39, 'John Doe', '0841341987', 187, 'completed', '2025-04-29 18:04:18', NULL),
(40, 'John Doe', '0841341987', 188, 'completed', '2025-04-29 18:08:17', NULL),
(41, 'John Doe', '0841341987', 189, 'completed', '2025-04-29 18:10:25', NULL),
(42, 'John Doe', '0841341987', 190, 'completed', '2025-04-29 18:11:27', NULL),
(43, 'John Doe', '0841341987', 192, 'completed', '2025-04-29 21:05:11', NULL),
(44, 'Adminuser', '01234567789', 193, 'completed', '2025-04-30 02:11:49', NULL),
(45, 'Marvin Zanchi', '08798712345', 201, 'completed', '2025-05-01 05:02:33', NULL),
(46, 'Marvin Zanchi', '08798712345', 202, 'completed', '2025-05-01 05:48:14', NULL),
(47, 'Marvin Zanchi', '08798712345', 205, 'completed', '2025-05-01 08:53:42', NULL),
(48, 'Adminuser', '01234567789', 207, 'completed', '2025-05-01 11:11:19', NULL),
(49, 'Marvin Zanchi', '08798712345', 210, 'completed', '2025-05-01 14:09:47', NULL),
(50, 'Adminuser', '01234567789', 211, 'completed', '2025-05-01 14:48:27', NULL),
(51, 'Paddy Murphy', '089765443245', 213, 'completed', '2025-05-04 09:57:55', NULL),
(52, 'Marvin Zanchi', '08798712345', 214, 'completed', '2025-05-04 11:16:47', NULL),
(53, 'Adminuser', '01234567789', 216, 'completed', '2025-05-04 12:25:44', NULL),
(54, 'Test Two', '098766635362', 218, 'completed', '2025-05-05 13:46:39', NULL),
(55, 'George Donavan', '09876553', 219, 'completed', '2025-05-05 20:16:31', NULL),
(56, 'TestNine', '098765443', 220, 'completed', '2025-05-05 21:02:33', NULL),
(57, 'John Doe', '09876533', 221, 'completed', '2025-05-05 21:50:12', NULL),
(58, 'Test8', '098765432', 222, 'completed', '2025-05-06 06:23:47', NULL),
(59, 'John Doe', '0987655364', 223, 'completed', '2025-05-06 06:49:26', NULL),
(60, 'John Doe', '0987766466', 224, 'completed', '2025-05-06 07:31:51', NULL),
(61, 'Marvin Zanchi', '08798712345', 226, 'completed', '2025-05-06 09:20:07', NULL),
(62, 'Emmanuel', '0998765544', 227, 'completed', '2025-05-06 09:56:19', NULL),
(63, 'Marvin Zanchi', '08798712345', 232, 'completed', '2026-01-12 10:54:05', NULL),
(64, 'Adminuser', '01234567789', 233, 'completed', '2026-01-12 16:09:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 5, 5.99, 1),
(2, 2, 1, 12.99, 1),
(3, 2, 2, 9.99, 1),
(4, 2, 5, 5.99, 1),
(5, 3, 2, 9.99, 1),
(6, 4, 2, 9.99, 1),
(7, 5, 2, 9.99, 1),
(8, 6, 5, 5.99, 1),
(9, 6, 2, 9.99, 1),
(10, 7, 1, 12.99, 1),
(11, 7, 2, 9.99, 1),
(12, 8, 5, 5.99, 1),
(13, 9, 2, 35.00, 1),
(14, 10, 1, 20.00, 1),
(15, 11, 5, 18.00, 1),
(16, 12, 3, 15.00, 1),
(17, 12, 5, 5.99, 1),
(18, 13, 3, 15.00, 1),
(19, 14, 3, 15.00, 1),
(20, 15, 2, 35.00, 1),
(21, 16, 4, 17.00, 1),
(22, 17, 3, 15.00, 1),
(23, 18, 3, 15.00, 1),
(24, 19, 4, 17.00, 1),
(25, 20, 3, 15.00, 1),
(26, 21, 3, 15.00, 1),
(27, 22, 2, 9.99, 1),
(28, 22, 5, 5.99, 1),
(29, 23, 2, 35.00, 1),
(30, 24, 1, 12.99, 1),
(31, 25, 2, 35.00, 1),
(32, 25, 5, 5.99, 1),
(33, 25, 1, 12.99, 1),
(34, 26, 5, 18.00, 1),
(35, 27, 1, 12.99, 1),
(36, 27, 2, 9.99, 1),
(37, 27, 5, 5.99, 1),
(38, 28, 2, 35.00, 1),
(39, 28, 1, 12.99, 1),
(40, 29, 3, 15.00, 1),
(41, 29, 5, 5.99, 1),
(42, 30, 1, 12.99, 1),
(43, 30, 2, 9.99, 1),
(44, 30, 5, 5.99, 1),
(45, 31, 3, 15.00, 1),
(46, 31, 5, 5.99, 1),
(47, 32, 1, 12.99, 1),
(48, 32, 2, 9.99, 1),
(49, 32, 5, 5.99, 1),
(50, 33, 1, 12.99, 1),
(51, 33, 2, 9.99, 1),
(52, 33, 5, 5.99, 1),
(53, 34, 1, 12.99, 1),
(54, 34, 2, 9.99, 1),
(55, 34, 5, 5.99, 1),
(56, 35, 1, 12.99, 1),
(57, 35, 4, 17.00, 1),
(58, 36, 3, 15.00, 1),
(59, 36, 5, 5.99, 1),
(60, 37, 1, 12.95, 1),
(61, 37, 2, 9.90, 1),
(62, 37, 5, 5.99, 1),
(63, 38, 1, 12.95, 1),
(64, 38, 5, 18.00, 1),
(65, 39, 4, 17.00, 1),
(66, 39, 1, 12.95, 1),
(67, 39, 2, 9.90, 1),
(68, 39, 5, 5.99, 1),
(69, 40, 5, 5.99, 1),
(70, 40, 2, 9.90, 1),
(71, 40, 1, 12.95, 1),
(72, 41, 2, 9.90, 1),
(73, 41, 5, 5.99, 1),
(74, 42, 5, 5.99, 1),
(75, 42, 2, 9.90, 1),
(76, 42, 1, 12.95, 1),
(77, 43, 1, 12.95, 1),
(78, 43, 2, 9.90, 1),
(79, 43, 5, 5.99, 1),
(80, 43, 4, 17.00, 1),
(81, 44, 1, 12.95, 1),
(82, 44, 2, 9.90, 1),
(83, 44, 5, 5.99, 1),
(84, 45, 1, 12.95, 1),
(85, 45, 2, 35.00, 2),
(86, 46, 1, 12.95, 1),
(87, 46, 2, 9.90, 1),
(88, 46, 5, 5.99, 1),
(89, 47, 3, 15.00, 1),
(90, 47, 2, 9.90, 1),
(91, 47, 1, 12.95, 1),
(92, 47, 5, 5.99, 1),
(93, 47, 2, 35.00, 1),
(94, 48, 2, 35.00, 1),
(95, 48, 5, 5.99, 1),
(96, 48, 2, 9.90, 1),
(97, 48, 1, 12.95, 1),
(98, 49, 2, 9.90, 1),
(99, 50, 2, 35.00, 1),
(100, 50, 5, 15.50, 1),
(101, 50, 1, 12.95, 1),
(102, 51, 1, 12.95, 1),
(103, 51, 4, 17.00, 1),
(104, 52, 1, 20.00, 1),
(105, 52, 5, 15.50, 1),
(106, 53, 8, 10.00, 1),
(107, 53, 4, 17.00, 1),
(108, 53, 5, 15.50, 1),
(109, 54, 4, 17.00, 1),
(110, 54, 5, 15.50, 1),
(111, 55, 3, 15.00, 1),
(112, 55, 5, 15.50, 1),
(113, 56, 1, 20.00, 1),
(114, 56, 2, 9.90, 1),
(115, 57, 1, 20.00, 1),
(116, 57, 1, 12.95, 1),
(117, 58, 1, 20.00, 1),
(118, 58, 5, 15.50, 1),
(119, 59, 1, 20.00, 1),
(120, 59, 5, 15.50, 1),
(121, 60, 1, 20.00, 1),
(122, 60, 5, 15.50, 1),
(123, 61, 1, 20.00, 1),
(124, 61, 1, 11.95, 1),
(125, 62, 1, 20.00, 1),
(126, 62, 5, 15.50, 1),
(127, 63, 2, 9.90, 1),
(128, 63, 2, 35.00, 1),
(129, 64, 4, 17.00, 1),
(130, 64, 5, 15.50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image_url`, `created_at`) VALUES
(1, 'Hair Pomade', 'Strong hold.', 11.95, 20, 'assets/images/hair_pomade.jpg', '2025-04-06 10:49:22'),
(2, 'Beard Oil', 'For beard care.', 9.90, 15, 'assets/images/beard_oil.jpg', '2025-04-06 10:49:22'),
(5, 'Barber Cologne', 'All skin types.', 15.50, 10, 'assets/images/barber_cologne.png', '2025-04-06 17:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `duration`, `price`) VALUES
(1, 'Haircut', 20, 20.00),
(2, 'Haircut & Beard', 30, 35.00),
(3, 'Beard', 15, 15.00),
(4, 'Shave', 10, 17.00),
(5, 'Skin Fade', 30, 18.00),
(15, 'Towel', 10, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('service','product','combined') NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `session_id`, `amount`, `type`, `status`, `created_at`) VALUES
(1, 'cs_test_a1ZAveqXahZqPzOI6yVQ9aCf0P5lKHUI4WgFbf3pyVnSfIWL05lBB72eal', 15.00, 'service', 'completed', '2025-04-13 04:06:43'),
(2, 'cs_test_a1ZAveqXahZqPzOI6yVQ9aCf0P5lKHUI4WgFbf3pyVnSfIWL05lBB72eal', 15.00, '', 'completed', '2025-04-13 04:08:34'),
(3, 'cs_test_a1ZAveqXahZqPzOI6yVQ9aCf0P5lKHUI4WgFbf3pyVnSfIWL05lBB72eal', 15.00, '', 'completed', '2025-04-13 04:18:32'),
(4, 'cs_test_a1ZAveqXahZqPzOI6yVQ9aCf0P5lKHUI4WgFbf3pyVnSfIWL05lBB72eal', 15.00, '', 'completed', '2025-04-13 04:19:43'),
(5, 'cs_test_a1ZAveqXahZqPzOI6yVQ9aCf0P5lKHUI4WgFbf3pyVnSfIWL05lBB72eal', 15.00, '', 'completed', '2025-04-13 04:23:19'),
(6, 'cs_test_a1ZAveqXahZqPzOI6yVQ9aCf0P5lKHUI4WgFbf3pyVnSfIWL05lBB72eal', 15.00, '', 'completed', '2025-04-13 04:33:51'),
(7, 'cs_test_a1ZAveqXahZqPzOI6yVQ9aCf0P5lKHUI4WgFbf3pyVnSfIWL05lBB72eal', 15.00, '', 'completed', '2025-04-13 04:34:15'),
(8, 'cs_test_a1QDBV7augKTAvl2LKa8zR6V5tOFRCdQTPAt3UW3O5aX5kzvfGpwgIkPkE', 20.00, 'service', 'completed', '2025-04-13 04:36:19'),
(9, 'cs_test_a1F1HVulEzdfMINcXzce7ekdauxlyAxOnkegHZzT16xilDS6HtFDuW09d4', 35.00, 'service', 'completed', '2025-04-13 06:06:02'),
(10, 'cs_test_a1rFzXD5CiaxohBSuXI95oIDg1KfbktJradeNZgPLVmq6AdkEgnO4RlwSf', 17.00, 'service', 'completed', '2025-04-13 06:20:02'),
(11, 'cs_test_a1blY2slo02URJGBRRGms0rj7E5Y8UYQ68HeMchia0AtzwN48j8wJynKGC', 18.00, 'service', 'completed', '2025-04-13 06:26:12'),
(12, 'cs_test_a1fc6ciExs77Ll3rp2R0L55EcvExKhwSq9fLkEMuG0xy3Dj8YYvFHRoADW', 35.00, 'service', 'completed', '2025-04-13 06:57:01'),
(13, 'cs_test_a1bkx4xp9zo9aMpz6raLvLxEvzCKhewRaCjMIEDNUnsxJPGqCDRPxwv6Ya', 15.00, 'service', 'completed', '2025-04-14 19:05:20'),
(14, 'cs_test_a1ov6VtH8U7JGVPYPQ97jIOteE2IsNroBiEEUqXhg0IeObvxzcimqxNQfN', 20.00, 'service', 'completed', '2025-04-14 20:25:20'),
(15, 'cs_test_a1otKJNqGKPHuvYJLogalyBlYI0UYEOV6UF2o5CcuUupNQzE3ZzGJMVLiX', 35.00, 'service', 'completed', '2025-04-14 20:37:35'),
(16, 'cs_test_a1TarNXTz8QFQXP6ubcKvmMyUO983dBvhc6ors60ahRox6cODeZhP7kctt', 15.00, 'service', 'completed', '2025-04-14 21:49:17'),
(17, 'cs_test_a13yxv6wZuwPboH1pd28bbstWYcxfKiUEsFpr2uYq78Zk7CNCJmlGtgpf1', 15.00, 'service', 'completed', '2025-04-14 22:20:27'),
(18, 'cs_test_a1NFuPlB1nRxIvdk97SMYfSE3sncTIGBaMBsBcFA4sFXyOKIxsoNSAZZxh', 15.00, 'service', 'completed', '2025-04-14 23:11:13'),
(19, 'cs_test_b1Ct8KNWq1Fejbc15TGutvWul7o2b405rHBS7bi2j87Zvkh8Mfyyd2NFq3', 20.99, 'combined', 'completed', '2025-04-14 23:13:28'),
(20, 'cs_test_b1iwn3ThZ3DnyQNPNCmlJUM9jeDDe8HFGujGV7n6Awa3pf9HgmnXifdVTE', 43.97, 'combined', 'completed', '2025-04-14 23:16:04'),
(21, 'cs_test_a1TpuBIQRlJ4yZTLi9S7giJBscXA7YQ69yap9ac02GzxTrve18sbilMJsQ', 15.00, 'service', 'completed', '2025-04-14 23:22:59'),
(22, 'cs_test_a1KSlsUVPiIve2PYwuxbzAUaAAqibg7Ov8u4OspAyqX4ZUoclMs6xlWS6X', 15.00, 'service', 'completed', '2025-04-15 21:07:17'),
(23, 'cs_test_b19L7nrmvHWqffn3E0aICOLIfZ9LPflt0RkUV62s8l53IUG2NjfWqEoeHA', 24.99, 'combined', 'completed', '2025-04-15 21:16:31'),
(24, 'cs_test_b1kjrpBWAP63egRTWxRTtIwPYDXl10jT15DvcD62rB3sXwq14GsNvMfmFb', 44.99, 'combined', 'completed', '2025-04-15 21:53:40'),
(25, 'cs_test_b1natVhXQZmp4GAZcHA7V2HXq6jNykn2eTBQW3ShLQ2f0UeTXfQIokKoEK', 24.99, 'combined', 'completed', '2025-04-15 22:26:23'),
(26, 'cs_test_a1WqYYQZxiiIwr5ns8daMDDQs8N1ZblgPrdK7Xci0RZhDaQfEf5UbuNbVY', 17.00, 'service', 'completed', '2025-04-15 22:50:23'),
(27, 'cs_test_a1KtPdbDa6iSkA1eWbkf5zka6OIFqLmP8GnlBCJ23J9i8Wx7mpBsVq7ZON', 17.00, 'service', 'completed', '2025-04-15 23:25:40'),
(28, 'cs_test_a1d6XUZGWegbMUrrqSORQzlIBFCqSePo6O0qJ64cK1AVEm1lhhMJ25QcnZ', 20.00, 'service', 'completed', '2025-04-15 23:27:17'),
(29, 'cs_test_a1CHCOYU3h9OE1sDy4S855wIEBn6sT5astkqP6DcO8cY6BHzfwFKvhdhVP', 20.00, 'service', 'completed', '2025-04-15 23:30:24'),
(30, 'cs_test_a1JdnJDn4PkMny9YouTF8a7BUFueHI77vMUz9V3tjVqyVcywL2EZAAYX9J', 15.00, 'service', 'completed', '2025-04-15 23:33:47'),
(31, 'cs_test_a1xXx1nXGUam020s3CSi1QIwiE4p2eEeucTEXnAIXfy0yVNSXOnXZAOFR9', 18.00, 'service', 'completed', '2025-04-15 23:35:28'),
(32, 'cs_test_a1aDGLEjmhcPh3LCi8yEUy7H1z79NXbcuT35gwZ9YDaMXcUz5CYprGXgxA', 17.00, 'service', 'completed', '2025-04-15 23:37:04'),
(33, 'cs_test_a18P42wdfoei7GxDCp2whr7uflnlqwJiOYAcFqVnPrX61oSNqCtu1e3d9W', 17.00, 'service', 'completed', '2025-04-15 23:39:57'),
(34, 'cs_test_a17697VzKzKD99pNDnKpIx68XCV4wKrVqBIqmHU8a6IyLnWGiRJqmd9Gzs', 17.00, 'service', 'completed', '2025-04-15 23:42:02'),
(35, 'cs_test_b10FyH9zIx5sVa7JdOA6TtU6K5rizqxjEzZFnFfQpzjok6XXCbx2q6zPHI', 15.98, 'product', 'completed', '2025-04-15 23:43:06'),
(36, 'cs_test_a1So3YC5fVq86EdjSqNCBu6KyrgNEunD1Sx4IQ02KVeDPGxtm3w08jntJb', 15.00, 'service', 'completed', '2025-04-15 23:55:43'),
(37, 'cs_test_a1rXfGJ2SgPny4bKQzX9luYkw8HTpg1qky2j13wARC0ifNWrpNNHZLy3S8', 15.00, 'service', 'completed', '2025-04-16 00:04:15'),
(38, 'cs_test_b1BDwQupGKKQQIH5IgQgk97fsSMIil9TQyyJIhuBaaLIYb8HqKysuMMXfm', 22.98, 'product', 'completed', '2025-04-16 00:05:53'),
(39, 'cs_test_b1QibXvMMnqeIn2vDmmGQxZxmt38uJ9tFNQJCas4peYKIwMPh1bFNM40RN', 20.99, 'combined', 'completed', '2025-04-16 00:07:03'),
(40, 'cs_test_a1FmL3GorRUKGmGefcuCdTK0Xid1kgbTl2tJsOM5yat6yvt5d52uEEyg8d', 15.00, 'service', 'completed', '2025-04-16 12:09:12'),
(41, 'cs_test_a1iMG7NEOTpgOyOG41Ol2QVt4BLs03hW9K4a2IitKmMdbm9abP6vtrf4if', 15.00, 'service', 'completed', '2025-04-16 12:14:04'),
(42, 'cs_test_a1aPTY9fzdglwg1PGvdcqv6PWSko903sECN8ikRyYJX2s20LAcv79OtVYR', 20.00, 'service', 'completed', '2025-04-16 14:00:19'),
(43, 'cs_test_a1Afow68rg1LtAtI0b1Ws7cgnVfwq37VXlKynVAhiGPAyBikcuRLSdi0UB', 35.00, 'service', 'completed', '2025-04-16 18:44:34'),
(44, 'cs_test_a1hDHeLVCZfopVo6NiG8gyCY5DiMsU9Fvjk6wL2szd22RzgjFsHaagwoD7', 17.00, 'service', 'completed', '2025-04-16 18:53:36'),
(45, 'cs_test_a1TG8qHszUx6LNdNTT7uT9NxwZ93UwtqDT7f7UoIVD6pReYg2fKfMp7inc', 17.00, 'service', 'completed', '2025-04-16 18:57:50'),
(46, 'cs_test_a1eRY63Kx3mnAXLQbeMWFfIWfzO2Y1F1QY8FXtiaWobWuLPsF51v3AGoRr', 18.00, 'service', 'completed', '2025-04-16 18:59:55'),
(47, 'cs_test_a16Qiwmg0CAQOuo3QOBCgI8Q3ziAnITAbpuUyHTPCr86yVjjis5zo11MiE', 18.00, 'service', 'completed', '2025-04-16 19:01:33'),
(48, 'cs_test_a1lnA4GiCTHTTrD8dfhMWXA9c5QkAByiIDnjH8Naf02Eqee1yHbFlJlcXM', 18.00, 'service', 'completed', '2025-04-16 19:02:16'),
(49, 'cs_test_a1DmqUkQqbHpe9g4YXpsDNSt6Kcdn1wJE8spc2W5PDUjn5pWiHtGiTUTcB', 18.00, 'service', 'completed', '2025-04-16 19:39:51'),
(50, 'cs_test_a1xpMFibIbHFgiFTDZjXI3uNZyTQxOYhUjRkGu2ZULWr6glQwdDIKbLS42', 20.00, 'service', 'completed', '2025-04-16 19:42:15'),
(51, 'cs_test_a1yWlpNBEIZiK2wxnE5tXzr9JEtR3tPUMCp4WxecE8s7TI2OotfU9619Wq', 20.00, 'service', 'completed', '2025-04-16 19:42:57'),
(52, 'cs_test_a1NIplONoRKHJmVzMuKuoIWLxh6QB1q9J2BWmawb1rN2en1Qt0MSWRXcKv', 20.00, 'service', 'completed', '2025-04-16 19:46:53'),
(53, 'cs_test_a1CwDlVng8e1NbdUWWXJbrVmvOs6xfsgV4XkWoMRIECkH8PDrcaFzh4R1W', 20.00, 'service', 'completed', '2025-04-16 19:47:50'),
(54, 'cs_test_a1Q6SKPi0oyC56aNacNjaHSw06DS2ZSVUoWdLoIHuG9j98vfLtBC2NvamP', 18.00, 'service', 'completed', '2025-04-16 19:52:45'),
(55, 'cs_test_a1BoTjlkSp0DKyQYY3Xq2bfQmNG4XL46m09uYHrb96385cBiygDzVfzvUe', 15.00, 'service', 'completed', '2025-04-16 20:49:42'),
(56, 'cs_test_a11zpZ5TmpePbSKTykFkOkmlUQ8zH9EgCPcFZjLHxv8GBmY5Ub0yNkIR69', 15.00, 'service', 'completed', '2025-04-16 20:53:42'),
(57, 'cs_test_a1VFb7vjHIM7SylD5xqwZ72MBthW5B7xM1EWYbHh6YsO08JZxBC6KDzqch', 15.00, 'service', 'completed', '2025-04-16 21:47:27'),
(58, 'cs_test_a1gzhmH9JQO0YWq2PDlTnWOyhbQFEoYtdwIlle2YLTdNWW8ddUc2yy1qYG', 17.00, 'service', 'completed', '2025-04-16 22:07:12'),
(59, 'cs_test_a1bwhNoV0ohsLiXK2W5QI8E9bkUumn60mfSrbzjIR9ibSdXRXkwB4cVnMw', 20.00, 'service', 'completed', '2025-04-16 22:19:16'),
(60, 'cs_test_a1sXpmf2uKnRZii09bmBXlGH93O8RqWqMPmSEMg0FcvV2Pl1vMzXeuOzpK', 15.00, 'service', 'completed', '2025-04-17 12:03:40'),
(61, 'cs_test_a1v7DwopowrCEeAASRJFDCAN8RuYnSUe0a9xs45EsNnZnt8ZsBkutsP4mW', 15.00, 'service', 'completed', '2025-04-17 15:04:36'),
(62, 'cs_test_a1v7DwopowrCEeAASRJFDCAN8RuYnSUe0a9xs45EsNnZnt8ZsBkutsP4mW', 15.00, 'service', 'completed', '2025-04-17 15:16:37'),
(63, 'cs_test_a1DQBgwRYqzGtVydMp2slo0vCt6ynQdk77v48eyVkzu2R5mNRobMfuhipL', 17.00, 'service', 'completed', '2025-04-17 17:45:06'),
(64, 'cs_test_a19ibsVSNSzUfvceD3z02Co0QoFXnLpFyrF3626zJo5cVulvRrt007UKWs', 18.00, 'service', 'completed', '2025-04-17 17:54:13'),
(65, 'cs_test_a1v2qHakcrMfcmAyMJStBbPxYOOqjXS2vMeY7kVAtiTbeA8mSeBcv8cZeX', 9.99, 'combined', 'completed', '2025-04-17 18:28:04'),
(66, 'cs_test_a1EDO5LgWacf6x3NtkM8LtVI8GUTOLdWhaSPBKgOTldTyO7ysYSIClTsq2', 12.99, 'combined', 'completed', '2025-04-17 21:13:34'),
(67, 'cs_test_a1IP2ga1yNxSSIQ5SdMxFy24MnBHunqRiZEDfU2LKgqmJzet2l8OJ3nCan', 18.00, 'product', 'completed', '2025-04-17 21:30:20'),
(68, 'cs_test_a1B76J7i4uuiMr6ncE5CjydvQIgoX0oJxgUiWww04GejmfsQDjBIlLODeY', 20.00, 'service', 'completed', '2025-04-17 21:31:45'),
(69, 'cs_test_a1M9tr7he55WEMU0ET81e4AaUvnwuEqgO5ilPfyVdeY1kCdzuAVqOXIiC8', 35.00, 'service', 'completed', '2025-04-17 21:33:21'),
(70, 'cs_test_a1O28A9NxdgP8pyzQ8KbXEcyNG2uB2Qari0YnIu6U7MBrDY0X3LFYYpFCt', 20.00, 'service', 'completed', '2025-04-17 21:46:23'),
(71, 'cs_test_b1CeZ4OPqxsxrVbyGzbgUGdDeI9JTEuUSMjJmaqVOY3m5ml9Xxeo0e2h2o', 28.97, '', 'completed', '2025-04-17 21:54:08'),
(72, 'cs_test_b1VhMqVIk1A1aGeDAaiLBqAYnpoY6Jsv3OSwqEhKuVyJS8becwefeXpORM', 20.99, 'service', 'completed', '2025-04-17 21:57:41'),
(73, 'cs_test_b1h9lllf8Da51yMWsH9Zy8tu6GHBqilZQh55bivPk2pj3ntJYGleCJoWHX', 35.99, 'combined', 'completed', '2025-04-17 22:18:49'),
(74, 'cs_test_b1fBf1naTsIb763zGYvib2ipXpdHDcGm84YWd9H8kTVs5oFc4uInFDxAkA', 30.00, 'combined', 'completed', '2025-04-17 22:20:21'),
(75, 'cs_test_b1LzAmMD1SIGiEH3PbTRSiy8jDQerdpQpAOIcGqxiXs1IVIb75xCIbcQHZ', 30.00, 'combined', 'completed', '2025-04-18 11:28:36'),
(76, 'cs_test_a1vmOdcMu8zPtblgoTXvObH0ZbPPcybDYCnACZ2Tw16t91neWHFIHZ9wUN', 35.00, 'combined', 'completed', '2025-04-18 12:37:34'),
(77, 'cs_test_a14j1VKK99slzNR1HtV7dDbM01N7ifrcxyDH5V0bNuDQxdDw4CZCpVEM5m', 17.00, 'combined', 'completed', '2025-04-18 12:52:02'),
(78, 'cs_test_a1sYeRS001ZYUDy2xe3iHOIJfOSeyc61WvdFbZAMSi4x4RPYVIZRxDbBAy', 15.00, 'combined', 'completed', '2025-04-18 15:49:02'),
(79, 'cs_test_a1bTtk5qSa4M3JJXBwZMF7I1wtzME6VTiAF9X7wZ0T5aZS7T6Ni9D7CYcb', 15.00, 'combined', 'completed', '2025-04-18 15:51:44'),
(80, 'cs_test_a1PYfEKMla0KJoWwGDcLYdTBSCzJgbbz2sWdHj30pU6bEWAkQ9T6b37LXI', 17.00, '', 'completed', '2025-04-18 15:57:53'),
(81, 'cs_test_a1iX3c1fGXqVFJCjmAzDpFPK4gt1B1XFzBo9DaSZoOQDOkRJWvTreh7XBN', 17.00, 'combined', 'completed', '2025-04-18 15:59:49'),
(82, 'cs_test_a1Ci51OvqkjdKBJnROBhqlsBUJOxjuovztxieDDLY5A50WY5bpwIx9hmvR', 18.00, 'combined', 'completed', '2025-04-18 16:02:26'),
(83, 'cs_test_b1GapyluIo7x60XtBLWShIUJcvgjRRPtdG6oaL7ZqbdyFFmv8hJkA41GUK', 22.98, 'product', 'completed', '2025-04-18 16:07:18'),
(84, 'cs_test_b1BnpXu4V1Rb8Yx98lX1PCuRbiN8LsJWI9AtGxTMTqEbSgb5q9oSXesce8', 44.99, 'combined', 'completed', '2025-04-18 16:55:14'),
(85, 'cs_test_a1nW9668Ps432uxYVIWTxMnkJKiu2SOiF5KQcTsAbY8cOKdsk4QT324B9r', 5.99, 'product', 'completed', '2025-04-18 17:03:32'),
(86, 'cs_test_a1uLi3bTi6HS19BrWs3TfhnLPOkXj8oFREX6dd9Qv10Krr44VLfUwQGAqt', 18.00, 'combined', 'completed', '2025-04-18 17:28:37'),
(87, 'cs_test_a1xxK3ElZt9twZDyYT7INs6li9McJDxIsubDc7lOiTotZb8fFGXvJJLN4f', 15.00, 'service', 'completed', '2025-04-18 17:33:22'),
(88, 'cs_test_b1ep6Zoo4h1GOBdHFSbkeKMssAB600vqe6Or1XqKZbQ2ybX9KlYu3cbfB9', 40.99, 'service', 'completed', '2025-04-18 17:43:43'),
(89, 'cs_test_b1XLcEEL1UdbUehQzBPXEPXJr3lVQB6ad2dK2kk6iVhLcmxlrEk4Ryu5Af', 22.99, 'combined', 'completed', '2025-04-18 17:45:10'),
(90, 'cs_test_a15RqXj2BsNQC9qIermNLnCwB3WW0M7vYDwaRtcTvSBt69HQzrB3C3cAF1', 15.00, 'combined', 'completed', '2025-04-18 17:46:10'),
(91, 'cs_test_a1JLTQpG1RBOzifuxVvILyEDV0h8AZubwcBepw1zHW3Jg0FQsq6uBOmEF9', 15.00, 'product', 'completed', '2025-04-18 18:04:26'),
(92, 'cs_test_a1u49d19Cqtj2YF073mih0WK7ZQMc9zxAhBIiehUbvyR5EVuTyZ0uIM2uY', 15.00, 'combined', 'completed', '2025-04-18 18:11:13'),
(93, 'cs_test_a16hLIUTc9JyfpxxeUby71Ga2VbLUb8t1IyAVn1u408tqhTdlDstdwm8Ep', 15.00, 'combined', 'completed', '2025-04-18 19:02:47'),
(94, 'cs_test_b1l7sxIY53N47SwErlcWi6dQRQknkyWnX8SFLeC3fY6NdV5ch3qOHp0cp3', 15.98, 'product', 'completed', '2025-04-18 19:18:41'),
(95, 'cs_test_a1RBn1t50pKDbmco8bCAy5B0KvB6bHcraahO2PI7vzEboL0inJz7fA7850', 35.00, 'combined', 'completed', '2025-04-18 21:55:48'),
(96, 'cs_test_a1ElGqLzUOqmOa9hmaMZgWXRzoViwt0BEm11hlJQMLXllTGuDyZ5ceUUOJ', 12.99, 'product', 'completed', '2025-04-18 21:57:50'),
(97, 'cs_test_b1SGOruNbGAWAqLX4LGB2caEdruakJuFlHKMT5O97mkFUuT0bs9dGrejyh', 53.98, 'combined', 'completed', '2025-04-18 22:14:44'),
(98, 'cs_test_a1NuTYzUMGquDqOSmRZOf4sMaRN5dA34Shv3R0E5kEVpwLyD3JWUuELh8p', 18.00, 'combined', 'completed', '2025-04-18 22:23:33'),
(99, 'cs_test_b1rK8Y36Rdl29PwgIKAq2Q8vHn930XeJbacssqjq8xBGrog2T5R30OMSXU', 28.97, 'product', 'completed', '2025-04-18 22:24:49'),
(100, 'cs_test_b1yMGBl6150l2mMDYge2xQYil2LhXUpKYyzgyerD3RghDaS5tIEbfP8pYW', 47.99, 'combined', 'completed', '2025-04-18 22:27:07'),
(101, 'cs_test_a1oHKeSqKVIHIlwcZUcO3tXDEOkB8sy51pUiTKJxJpOBJiBIReqKLhtchN', 35.00, 'service', 'completed', '2025-04-18 22:48:56'),
(102, 'cs_test_b1ZvGdB4eWFsBrOGMiu8haaReSLhAouaKLGqVoK1UbC19C9VeA6ju2sH4P', 20.99, 'combined', 'completed', '2025-04-18 22:52:04'),
(103, 'cs_test_b1pSTwb45TAmDu8p0a2KQpYDX8G4DJsjJt3Jv8c0NIyWlMovmNY6nlcdk0', 28.97, 'product', 'completed', '2025-04-18 22:53:08'),
(104, 'cs_test_a1nycNHFqKFdeVDXrBIZmwZLw3bx3T05lB5s3kmM9NdFEloefPBEM1ZB7Q', 15.00, 'service', 'completed', '2025-04-18 23:19:13'),
(105, 'cs_test_b1uWBPsc6FOrysNxiSH1lnbEPnj7Ttd4woMTdzcFHNXT7B1AlrODslBPdA', 20.99, 'combined', 'completed', '2025-04-18 23:22:57'),
(106, 'cs_test_b1umWo6UqQTqIzsfSyAzl0oVxajPhfIrilD6jJUPNcM7Y7owmyDdCFnS86', 28.97, 'product', 'completed', '2025-04-18 23:23:49'),
(107, 'cs_test_a1A7DiITA89NxdI527LLYJ9F4PlZB7S7DdY9EcvKtJQYhtu4lsWIPUUF3u', 15.00, 'service', 'completed', '2025-04-19 08:27:52'),
(108, 'cs_test_a1TRiIolTP26Td5rdSiUe2YdWkzxY9gClk45bmQBpVeGUGT0jqGwkbFZrK', 15.00, 'service', 'completed', '2025-04-19 16:53:35'),
(109, 'cs_test_a1KmL6WUz085hm2vLIBYUa8Mho7gj12JEuwFaOuq26InjvwzCPE7Mgfu1N', 15.00, 'service', 'completed', '2025-04-19 20:16:32'),
(110, 'cs_test_a1KmL6WUz085hm2vLIBYUa8Mho7gj12JEuwFaOuq26InjvwzCPE7Mgfu1N', 15.00, 'service', 'completed', '2025-04-19 20:17:36'),
(111, 'cs_test_a1g7zNMEdr7Wb9fye9wedp3xUdLwrM7ZzdjOPANLPkA9J6YepQ550dnj2s', 20.00, 'service', 'completed', '2025-04-19 20:18:22'),
(112, 'cs_test_a1g7zNMEdr7Wb9fye9wedp3xUdLwrM7ZzdjOPANLPkA9J6YepQ550dnj2s', 20.00, 'service', 'completed', '2025-04-19 20:20:03'),
(113, 'cs_test_a12ak2s3bYm52vAI6iUCXOgQPAXGv13wMolMou9V3JXsFLOA23q97Vby6S', 35.00, 'service', 'completed', '2025-04-19 22:41:04'),
(114, 'cs_test_a1ad8C5SVxcnGhmDLSmykKlTeLQNpOdWhEOlugstcK00VG16un7YX7BTal', 15.00, 'service', 'completed', '2025-04-20 00:09:52'),
(115, 'cs_test_a1F8h78yy0PDbIAuaBtD5EC013KBPGLPJiqXajUg0wXoP4DnnbHU3u7vib', 15.00, 'service', 'completed', '2025-04-21 09:30:25'),
(116, 'cs_test_a1nZeqk5MAVeCIAgQ4AeyFXJYCTrs8BlZVcLlLTJTQnzRH7Gm62rSqmds7', 20.00, 'service', 'completed', '2025-04-21 10:14:34'),
(117, 'cs_test_a1hGkXEvYNF8UyYbXxEG471LMsPDy9Ka87agNrDMWvJpXUngevNwpDzrFA', 35.00, 'service', 'completed', '2025-04-21 10:17:55'),
(118, 'cs_test_a1E7irYmIOKMFs4m3NusDS022IR5WZz1RESuE0gcBnTUiJAYvWQTLw7K9i', 35.00, 'service', 'completed', '2025-04-21 10:20:30'),
(119, 'cs_test_a1TVLE4c14i9hJaBkefM53ZuZmcr17pvtnhzJVKFbYjFUsSJnhLcC1Auo3', 18.00, 'service', 'completed', '2025-04-21 10:28:38'),
(120, 'cs_test_a1eHnGrHPY5D8mQXtD1nnA7WFDVvL1MrJv7Cz4qfkZNbdiKrHienH2NTV0', 20.00, 'service', 'completed', '2025-04-21 10:40:28'),
(121, 'cs_test_a1FeygFJSCkE1tuNlX8ZMFxD4VqyepLu98hsO46OkyKwDtaQgBuvysLKWj', 15.00, 'service', 'completed', '2025-04-21 10:59:12'),
(122, 'cs_test_a1bjDhTErGBdbTHgRMqLpHmiPb6E0rz52x3863j8JYSdNJhog8HxMUUnV3', 20.00, 'service', 'completed', '2025-04-21 11:41:46'),
(123, 'cs_test_a1HPvZGOMRfhMTlQKWdMwRds8fljrxxMPdTMmI6rH4QFn3E1BbKWBMnW86', 20.00, 'service', 'completed', '2025-04-21 16:54:26'),
(124, 'cs_test_a15YRXrd5WBP7RL2G0v8VbbycX3Pxvt1HLC0oSId6ynaJGsV3OdbKayAEz', 15.00, 'service', 'completed', '2025-04-21 17:06:56'),
(125, 'cs_test_a1WDXZm1nc8X7fxVapT8EvISFduocUlj3JJrsTllqcSHPlJ4y7bon4FWD2', 35.00, 'service', 'completed', '2025-04-21 17:23:49'),
(126, 'cs_test_a1TTe2Z4GgujEktdvLf1qx0W139xVAzgOplG5gIJvu3MD56XGq4djkO2eU', 18.00, 'service', 'completed', '2025-04-21 17:31:17'),
(127, 'cs_test_a100R29vkrR5eGs6WrMzaoSvRFyVPGAdbPtNwHOqMaKZNPlG0fwOBNMQIW', 15.00, 'service', 'completed', '2025-04-21 18:09:35'),
(128, 'cs_test_a1uuBi2HqvW1m5cX9BX3ivnP1nVsTPtBlVbwoLgAMPDUpYDvgrbEAOAQJi', 15.00, 'service', 'completed', '2025-04-21 18:13:38'),
(129, 'cs_test_a1YPPsRlaCz904WqVBry2L4mgbdxNgQ7lL7wPaUVWzMki24R4nlJVSmVCG', 17.00, 'service', 'completed', '2025-04-21 18:38:04'),
(130, 'cs_test_a1Ccf7ehGmy5fXWM6eg2mhUoE8jw8gQvVvLml9wxjsfnqWXd0hoDCNQ4TN', 15.00, 'service', 'completed', '2025-04-21 18:49:34'),
(131, 'cs_test_a1S0wZSSn2zJu6qbruQan69Ay5oc1Iw3mYQ0QrmntiWhsB8OYYmJOPrdCU', 18.00, 'service', 'completed', '2025-04-21 18:51:19'),
(132, 'cs_test_a1mY1DonYLQal8zn0MZQ0ewor8praNe5vvU3QlZTXzUM6rmRfrYeGKdN40', 15.00, 'service', 'completed', '2025-04-21 20:15:02'),
(133, 'cs_test_a1J5zZi0UkdNe7EokgC8Bp94mllDqnkBV7oz9eCQRPYPw7tVo7d7Lj9Ae7', 15.00, 'service', 'completed', '2025-04-22 00:09:47'),
(134, 'cs_test_a1bnzvMg7WMzUsAOLRjqjUrGwmeuyyPKXUOwETIIKkZpBhF5LtPISsMhQ8', 15.00, 'service', 'completed', '2025-04-22 00:39:48'),
(135, 'cs_test_a1COZ7BBVblkyadLwUJml4c5NcgWNRCcXTaBxQirEzGZxWl93tPbAeSefJ', 35.00, 'service', 'completed', '2025-04-22 00:52:20'),
(136, 'cs_test_a1PZOvkVfID8W44rDeoX149uL6Fp4zWgd6dv2jTThSlyoEiRyw8X5PO9jc', 35.00, 'service', 'completed', '2025-04-22 00:56:45'),
(137, 'cs_test_a1vt8Pj0gp43nRa4YTA1KrjPG8L7fCDU2mkEwGx2hzhSh8JsSbtvR9gfsW', 17.00, 'service', 'completed', '2025-04-22 01:01:06'),
(138, 'cs_test_a1hTi3BFuZkaXJO2T9xfWrFjjdlR2vZp4BA7eEzLYM8icbORfvGwOmHu7B', 20.00, 'service', 'completed', '2025-04-22 01:18:12'),
(139, 'cs_test_a1I3QDeqYZjjobHPbZlTHzLbGfaJCGTqrKYxDvU9W5wRFPSJmVMkofYyF7', 17.00, 'service', 'completed', '2025-04-22 10:41:28'),
(140, 'cs_test_a1334mUkMEpDZ9oZR5TGTJ6YvYBDi5csurNuHamQyxfskBNKPLBuVcRsEL', 35.00, 'service', 'completed', '2025-04-22 10:49:13'),
(141, 'cs_test_a1H4DLQZD4d6ahpbsTdrTGt78MPqJGWE5MXS6WETNO4dq4FYoS1VwG62wk', 15.00, 'service', 'completed', '2025-04-22 10:56:31'),
(142, 'cs_test_a1gsQSinhi3Am1XygePctwH8WhB07uKYhtpEI0vo1jfrkLIGjtLjreGihH', 15.00, 'service', 'completed', '2025-04-22 11:05:53'),
(143, 'cs_test_a1RoL8EZvJH4AlWbGElB4lGiJ8VBZX2GShf6VaVCwBUgzMp6QQmIFFvBjd', 20.00, 'service', 'completed', '2025-04-22 11:08:34'),
(144, 'cs_test_a1y0awCUkfiWdWyIpkDUGdiWS4sYa8wg1wJdukkeGR3yiU8qQwHOjbOq7l', 17.00, 'service', 'completed', '2025-04-22 11:12:58'),
(145, 'cs_test_a1fY3BBXQYoakTigb3spC53HFkOsSFV76rpucf4VpdfmypvXlxZv9JvUuR', 20.00, 'service', 'completed', '2025-04-22 11:33:39'),
(146, 'cs_test_a1nucDWpPwWSMtjRvmrMOoiWggJDbU668z6hq3y68UgTgOhMTAXIKVhBfC', 18.00, 'service', 'completed', '2025-04-22 11:41:16'),
(147, 'cs_test_a1yelvm2BMWoSVE3FCJoIfgcDek7oX7KBzdAr9ptfGfF0mPH3BkHv83tUD', 15.00, 'service', 'completed', '2025-04-22 11:50:02'),
(148, 'cs_test_a1TDt2Z6VnPmZvo0Z6WBZrqka3LDAKLKaWxRcqBNZcUCTGKiiTvQQHy4nl', 35.00, 'service', 'completed', '2025-04-22 11:53:57'),
(149, 'cs_test_a1cNsDhyEWwUwUhFMEcXSS2iHWnOYTcOBULJqrD5HWdICQNcDvNBtquexq', 35.00, 'service', 'completed', '2025-04-22 11:58:39'),
(150, 'cs_test_a1eWDR07JIJymWFMdOAkgOsxBGf4Rqj6jl849hlaF8P77A1lTp4ICe2ivv', 18.00, 'service', 'completed', '2025-04-22 12:27:53'),
(151, 'cs_test_a1gMYIfwmpK72oojfm9rnv6R3xg7lQxkFQyPauscUu8IwAzYEEuurjyONN', 20.00, 'service', 'completed', '2025-04-22 12:35:41'),
(152, 'cs_test_a1tsD2Gjyq6X0IQqAWy04S6BpAlqwEBss1jPWmte0DIWtUDSfOM6o79bje', 20.00, 'service', 'completed', '2025-04-22 12:49:05'),
(153, 'cs_test_b1Z8Taq5gh56I0EdlE66hMTwhAen4IZQTFdwaM3BvmqE4HfgWAK9hVpIey', 28.97, 'product', 'completed', '2025-04-22 13:07:38'),
(154, 'cs_test_a1h1GEb3l8qJwhR7cCVn1xyiZlW10A1pmyJRfFtv7pqPnxELgFnZ8VTo5W', 20.00, 'service', 'completed', '2025-04-22 13:16:42'),
(155, 'cs_test_a1DFvGwtDgMJhH31g3czAqVjTH3mQmzBGDbhFrDgVBWPd3Jbnv3B1mmVwF', 15.00, 'service', 'completed', '2025-04-22 13:25:26'),
(156, 'cs_test_a1Dp1z1nvGEyIl23uMo0PYYhvILdRx74wYVa0QWDnlb3MKSLm7LnJmM18I', 15.00, 'service', 'completed', '2025-04-22 13:34:17'),
(157, 'cs_test_a1S465n1TGBpoMdolH24fZqCZGNkaltyftj1m4RFxPs2UvtZLTEeAHQpBC', 15.00, 'service', 'completed', '2025-04-22 17:47:17'),
(158, 'cs_test_a1qZMilBlI7gXvZWlBNg5pSZZAc6iqpDG2SGqUKs4Sz82vbARKosqw5h02', 17.00, 'service', 'completed', '2025-04-22 17:52:25'),
(159, 'cs_test_a1qZMilBlI7gXvZWlBNg5pSZZAc6iqpDG2SGqUKs4Sz82vbARKosqw5h02', 17.00, 'service', 'completed', '2025-04-22 17:54:08'),
(160, 'cs_test_a1q3PMirPACJmu8NavubeW0TC4u7BTugp9H1oPBhGBdaIzx9In6btqFjAY', 35.00, 'service', 'completed', '2025-04-22 17:56:11'),
(161, 'cs_test_a1FBTRR208WCDr65V11B2doRx9u15jYG5lHRH3MT5MlG6ipWwajLpyH8C0', 17.00, 'service', 'completed', '2025-04-22 18:13:04'),
(162, 'cs_test_a1GlRiVdC4EVUEVu3HtbQP8OhQz44mJ71Yq2UVSkTldLKWR6U6q0rDa7nA', 35.00, 'service', 'completed', '2025-04-22 20:04:51'),
(163, 'cs_test_a1yKMEvlifhsMk8PBqH31sR8eQ0Z2WE7S92TQeaOwCXDMoggvxe5xGbzWO', 17.00, 'service', 'completed', '2025-04-22 22:04:30'),
(164, 'cs_test_a1JVb8LisHTjwI2GvkZwVlOpXwTLuBgZqoSLSBU5E7efMyNyGLDyGzBDXh', 15.00, 'service', 'completed', '2025-04-22 22:13:31'),
(165, 'cs_test_a1MxP67AFmkD12nNxtvhuazj0Ml3WSkgsX1R4vJ5jfveZuuQdNL8Az0kYf', 15.00, 'service', 'completed', '2025-04-22 23:30:00'),
(166, 'cs_test_b1ZcfQk6lGlqfICVxGCTxB23O0KyCkMeXvsaTBcDBmYUmYVlILyBQ20IvB', 28.97, 'product', 'completed', '2025-04-22 23:32:28'),
(167, 'cs_test_b10vBdP8deIC3PH0TzcV1a8qncmPrVKKWPp63LLHfHapWpxEazJB3Rgx4t', 29.99, 'combined', 'completed', '2025-04-22 23:36:09'),
(168, 'cs_test_a1a0l8DixdcbGzKooUkBJqMTEkFzmfzGZV9WPummxHNEtLSFi8TEGR6ljV', 15.00, 'service', 'completed', '2025-04-23 00:05:45'),
(169, 'cs_test_a1Lfy4LkX6n69UWolhnEDFoyAYdFrHLfm02w3zw2VV2NjUfrjay9bqFcK5', 35.00, 'service', 'completed', '2025-04-23 00:14:08'),
(170, 'cs_test_a1CjFeQPAlGvF4Kr48ud7qnm0XWwp07OLQUQBahGTJAZg1uiCAZKqQbw3E', 17.00, 'service', 'completed', '2025-04-23 10:11:24'),
(171, 'cs_test_b1otnqNpIvp6Bmc5Rq0Zsu2G7eCZu41hY9ch8KXDrxjVGEORKukMNbnfE4', 20.99, 'combined', 'completed', '2025-04-23 12:25:20'),
(172, 'cs_test_a125rwjWdYIkkLpQStADRl1xcxzrtG8NnOp1FT6CEVdfJEHZuSBeBJ1Llv', 15.00, 'service', 'completed', '2025-04-23 23:00:57'),
(173, 'cs_test_a1spi5kqgEuYKfVprr7SkNaYvfJioQ7CcW5Y0Q1aSWUTqgx7jN9RycLM1g', 35.00, 'service', 'completed', '2025-04-24 18:32:07'),
(174, 'cs_test_a1QfLcn7eGmnYekRr96GTXnt5HbiQo43jf5Xbg7fKtj3ErgdU2n3hikEp2', 18.00, 'service', 'completed', '2025-04-25 02:48:58'),
(175, 'cs_test_a1d5yt5Vf6L1tZHrvLbb5f48edJHyQeZagpKcNYjSpiA39AoaXptiOdS3M', 15.00, 'service', 'completed', '2025-04-29 10:56:34'),
(176, 'cs_test_b1HJIN6Bij4DJVI9Y8nuPseO3S37xmGSEJHQRaB6IZaUlc6wd5XzEOMVaw', 28.84, 'product', 'completed', '2025-04-29 11:09:15'),
(177, 'cs_test_b1NfB4PMDLwgRwQZRrBKMr1Ecv3Mnmfdxi0SSrHaVsK6r6RGyXvMT3Z78O', 30.95, 'combined', 'completed', '2025-04-29 11:13:40'),
(178, 'cs_test_a18WAAlSfCkfMkLSf6LlW1xYOuAr5rzrKcuvIhIxWQc9YA93GFe0UzoYZd', 15.00, 'service', 'completed', '2025-04-29 12:38:37'),
(179, 'cs_test_a1yyq6zv2zMXIZcZH58Inyj6HIQcVQBn1okP1EqZcVmnsH2cmFirufZDjY', 15.00, 'service', 'completed', '2025-04-29 13:08:19'),
(180, 'cs_test_a1xw302pGaqF4rAcyQTOjGbrDB6FQXDWmH0xBqMqKXTPmZFEsAESB1chpC', 20.00, 'service', 'completed', '2025-04-29 13:14:48'),
(181, 'cs_test_a1zJwuLmAO2dSnYPnF8WUrhlm2Syz2pyI3mnnj4U06ahaPLByRiXSFrx8G', 15.00, 'service', 'completed', '2025-04-29 14:08:50'),
(182, 'cs_test_a1STzUcVQyER7fzzpKdh5GaeMcc15zPiS7xyef0lZ8TkFTbEaGUpyVcIaP', 15.00, 'service', 'completed', '2025-04-29 15:51:05'),
(183, 'cs_test_a1STzUcVQyER7fzzpKdh5GaeMcc15zPiS7xyef0lZ8TkFTbEaGUpyVcIaP', 15.00, 'service', 'completed', '2025-04-29 15:53:16'),
(184, 'cs_test_a1xBssGyxk6XMUzhZZtnh7KJKfOht6d3aqyRdzP6mYDTzSR0zPWXWFgr66', 15.00, 'service', 'completed', '2025-04-29 15:55:00'),
(185, 'cs_test_a1gVFVk310kQTnTThIrqmJ93gWvfrU2I1DWZCB96HUOhZAuBAsxNvLHZ0m', 15.00, 'service', 'completed', '2025-04-29 17:23:58'),
(186, 'cs_test_a1qCkhh4qannjQHlKFbKvnSy2CFxU6ImgoWZUmabvx12F2YoOt1eBz5sgh', 15.00, 'service', 'completed', '2025-04-29 18:02:36'),
(187, 'cs_test_b1dYngt4zRGoDlYn8mzRejF6XtKM6TTxj3F30ZoYdy0GodjFBdMCq6L376', 45.84, 'combined', 'completed', '2025-04-29 18:04:18'),
(188, 'cs_test_b1VGDrOIfgGrIQ1ZVw8LJ6EosssLCy2kI2B0tWUXMXh5cN8dRHyqliFsJ4', 28.84, 'product', 'completed', '2025-04-29 18:08:17'),
(189, 'cs_test_b1kVq8NHmaCcUIeRcUWckB7Ne5amKShjYdzHZNlvCTWQtq8j6jaagpHZwg', 15.89, 'product', 'completed', '2025-04-29 18:10:25'),
(190, 'cs_test_b15IUnRuoT7GAhANQHQ751xeSOvOHzeKQsnhRGtEvG6PWFbMBePuMdKkUn', 28.84, 'product', 'completed', '2025-04-29 18:11:27'),
(191, 'cs_test_a1yZqQR3g2nLLRX2LYQMo7baZWy6dIXZYYTG6CAUz77bp2wwxVAMvFGHiB', 99.00, 'service', 'completed', '2025-04-29 19:20:14'),
(192, 'cs_test_b1XawPCXdaPbEcSUNPGkd4nlR3JrOdRCZtVdTwJMsLSUuTYYq6Ip7VPrPc', 45.84, 'combined', 'completed', '2025-04-29 21:05:11'),
(193, 'cs_test_b1GORyyWrjpNXG3rkR8BpACziN1ZbWpJW9rPxqC3RjLIPNBFabGlUkJ0Xh', 28.84, 'product', 'completed', '2025-04-30 02:11:49'),
(194, 'cs_test_a1wLXIxCJqPx6C1sz5hcORY6HPvFRIEoBcIXtcigTevzWu3G4Iyu1v3Ov4', 18.00, 'service', 'completed', '2025-04-30 10:44:47'),
(195, 'cs_test_a1jTCemE8FUdtylhMny4Fojhr2VWa2omD5HjC3v23PVKituqj5XcsDgsEw', 18.00, 'service', 'completed', '2025-04-30 11:32:34'),
(196, 'cs_test_a18bLCv8crUahXTFCRFqc1JHG0JfwI20MlgLeKmcvzBtnsaNCgMTyaDdam', 35.00, 'service', 'completed', '2025-04-30 12:51:25'),
(197, 'cs_test_a1hXzPzC3zU5AlGTvbJBf9fsSELxg57ouqwOI7btweiDrNSx8bCIgYPf3H', 35.00, 'service', 'completed', '2025-04-30 13:41:35'),
(198, 'cs_test_a1Udy65s47VkWInWye9Lk5fMaZQZwz2j8lksbEHRqmD5HnHsAxNVBughKc', 35.00, 'service', 'completed', '2025-04-30 14:06:22'),
(199, 'cs_test_a1xgf6EvlYecP5iHiwo79eE8EXQVPe3DAqP8EiwELUzhPqXzoucaTftcPG', 15.00, 'service', 'completed', '2025-04-30 16:01:37'),
(200, 'cs_test_a1VMXGdOS36DNN7gS0qWaCS4NvRrSJUaED36mhoKijiu5Z4SVyaB0pP0eH', 17.00, 'service', 'completed', '2025-04-30 16:34:29'),
(201, 'cs_test_b1mkXu7BWrI5CHLhw53apsJkv6Amxsi7B1dbc0kfj6D0baR7WoutZiX6K9', 47.95, 'combined', 'completed', '2025-05-01 05:02:33'),
(202, 'cs_test_b1OFMGRlzDCGGl0kEx8c6TMh8awsQnnYWQKgVBJaInlcCTwQvWxiCluvW0', 28.84, 'product', 'completed', '2025-05-01 05:48:14'),
(203, 'cs_test_a17uowibrm7Vpi9Y7jXj7eTKkpiMgCaORktbznA1wsuJ8e6kJ1AWIhZBnt', 20.00, 'service', 'completed', '2025-05-01 05:49:36'),
(204, 'cs_test_a1Gs1L1LW4XDFwAOgYf4pniwlckBU1wuZwc1bgdGXvqUQEmyQE6I6UUM1p', 20.00, 'service', 'completed', '2025-05-01 05:50:57'),
(205, 'cs_test_b1GJNWYS8PlbkLszD2E097tYoqMBgsxcdJZbMfESraX4nX4yHDY29DWWTU', 78.84, 'combined', 'completed', '2025-05-01 08:53:42'),
(206, 'cs_test_a1fR4ldVgnTYlRBJaYuXdzNb9RDulBKqNxVKydkGR4Z5HjNBYrqWEZ421F', 15.00, 'service', 'completed', '2025-05-01 11:08:48'),
(207, 'cs_test_b1iAY2KPUNKWzhjngzcOBdQdja5Kmd5NfEw0ehgGG2ep3RXD6NfRWDrTnz', 63.84, 'combined', 'completed', '2025-05-01 11:11:19'),
(208, 'cs_test_a1okPpKN8t5R1KsKYnGHuH0qtOjUVDAeYPGta87sjUP53zZfhKjBptQsuU', 35.00, 'service', 'completed', '2025-05-01 13:16:58'),
(209, 'cs_test_a1PCAjXp6HIIIXPyGo5qXexAgPTHgWwjCf5rBCuao8XIyG9VSNoAwxuISx', 35.00, 'service', 'completed', '2025-05-01 13:27:36'),
(210, 'cs_test_a1Qn34vYdePL4j2cVvkZhaYzn27pOlGMnW9rGiW4ztTdCuai2JUY2O48vW', 9.90, 'product', 'completed', '2025-05-01 14:09:47'),
(211, 'cs_test_b1GjvHuIus1Ggw7cRn7Mxjf7KclnKf905xmJNt30RCljU3vrJpvsM8esxC', 63.45, 'combined', 'completed', '2025-05-01 14:48:27'),
(212, 'cs_test_a1Z5MPhSVehr5m8fk7p1bpHRzSwXcbZXY2v4huPG0zsBx9nrn22wz1uJo7', 20.00, 'service', 'completed', '2025-05-04 09:50:28'),
(213, 'cs_test_b1JNatPSEaw08HKj73dSajzZflG4eM3llnreMZIwtnPfJYd06gCIznhgWt', 29.95, 'combined', 'completed', '2025-05-04 09:57:55'),
(214, 'cs_test_b1T0yJrjpOGe0WrkkBHcI1cBSWGnlhGAEBhCK4dqtOU73V0muZhXUucutN', 35.50, 'combined', 'completed', '2025-05-04 11:16:47'),
(215, 'cs_test_a1E8H2zlGBkelJRHpeaHHxgBIhonYsQVpezv1CM1MIISWR5XnkYWBL6Bh0', 20.00, 'service', 'completed', '2025-05-04 12:15:55'),
(216, 'cs_test_b1Kkoun4bvsotaaKxHSDYzeSHRztn6P2HTf3Mpw3bxuxmQg4iqT0R3vTEH', 42.50, 'combined', 'completed', '2025-05-04 12:25:44'),
(217, 'cs_test_a1cE2oD6KQGKhZUrJ2wof09UtqRvnqeN2I1EtcIaPpU8RLpbsqYu1F8cfe', 20.00, 'service', 'completed', '2025-05-05 11:05:35'),
(218, 'cs_test_b19YII62B3EOuup9wIACjFej0fJ2PfCNJ5oRCodOieXT3WfDNd1Dez2VbO', 32.50, 'combined', 'completed', '2025-05-05 13:46:39'),
(219, 'cs_test_b1XX4W0hajntXdI01YdkFg2wOwgO8ie8at3cJlPGILAwzOPm7Whs1W02gt', 30.50, 'combined', 'completed', '2025-05-05 20:16:31'),
(220, 'cs_test_b1BL8wxcz8F5bp1m6NkVDrYgscTwUQGhdF8gdrSjj6eqiQnSgrV526WGHH', 29.90, 'combined', 'completed', '2025-05-05 21:02:33'),
(221, 'cs_test_b1Cx1gDxxUTnidWobwOkDTvXoJylmD4ndTYPAAayLs9hxr60Og8UmF1dAI', 32.95, 'combined', 'completed', '2025-05-05 21:50:12'),
(222, 'cs_test_b1ZFq4FLDkJWpEtemz2rP7FFQameDH5aNWaHWexuZwROwzKIim9CWpOaG5', 35.50, 'combined', 'completed', '2025-05-06 06:23:47'),
(223, 'cs_test_b1eUGD7OkRVLkydr4kRd3jDwTPZw5S1n2UEvb8LtghyIDEkKTJ68i7SSC5', 35.50, 'combined', 'completed', '2025-05-06 06:49:26'),
(224, 'cs_test_b1RnphLlIsM5WmP59MfQyDtdxtQhokYLAs8VzWYbP1DirCzFiR8ePynpBu', 35.50, 'combined', 'completed', '2025-05-06 07:31:51'),
(225, 'cs_test_a1OAlzHsmneoQapVzhdQRBHlaFYcRh1d8KFXbyDvVEEF9k7Oe2GzWG5iW2', 15.00, 'service', 'completed', '2025-05-06 08:31:03'),
(226, 'cs_test_b1TmaFC0Si8LoYUbW4EjbOY51hU40MAh8diKt0ipqJ0aufaOs67TK6h3av', 31.95, 'combined', 'completed', '2025-05-06 09:20:07'),
(227, 'cs_test_b1unvZAEmw1vtcvfeVUqWz9Y0JjS3RAAv989nJVFT1cvQFnDs9BrL3AS69', 35.50, 'combined', 'completed', '2025-05-06 09:56:19'),
(228, 'cs_test_a1SlWCBfaySoAmFZbA6bXsYERWCmmxcObN4eWRboLoAsh4YbJBz1l1sWkx', 15.00, 'service', 'completed', '2025-09-10 08:19:00'),
(229, 'cs_test_a1CNyhxYENDfR7kczq2hI2lZnXcdfs6D0LyKdGOKeaW9B8lGxSvoU2tnrL', 20.00, 'service', 'completed', '2025-09-25 11:03:30'),
(230, 'cs_test_a1ChYuEhPqdZv6ufHMJSRcZ5fWW2Stb75714USzD7QqoATO2hOXGI7y8j6', 15.00, 'service', 'completed', '2025-10-16 13:58:24'),
(231, 'cs_test_a1XQEQ97pys7yC0XFJ1H5rmwZf3FDYwspuxKpAyljvzCSozmDlbEJUDE5a', 15.00, 'service', 'completed', '2026-01-09 10:59:39'),
(232, 'cs_test_b1sRqFNFv4uIHGOIoDLoUE85WpaCt0mX4E4UzRRnjCN4wITsEzadkZ8wNM', 44.90, 'combined', 'completed', '2026-01-12 10:54:05'),
(233, 'cs_test_b1GIpw7YgUluy96pdLTd1wIJa5XtDUSCHjVhKqd6mr4jzgb4rdeQhbQNB9', 32.50, 'combined', 'completed', '2026-01-12 16:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','barber') NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'adminuser', '$2y$10$Uho9Bv3Y5G6Ryz.cH2ixvugS2JDblmBu3/tWkZkYdW.SQDWOe9FrW', 'admin', 'Adminuser', 'adminuser@example.com', '01234567789', '2025-04-22 23:17:08', '2025-04-22 23:17:08'),
(3, 'mazds', '$2y$10$c3MILTi71rDSS3CgvRZu1uHFScMNhMOofP4.rHQsCmC0nt5if5CIS', 'user', 'Marvin Zanchi', 'mazds.dev@gmail.com', '08798712345', '2025-04-23 11:33:14', '2025-04-23 11:33:14'),
(4, 'garry', '$2y$10$7cPQRhOee/5BxEBw/l/qqO5jjcpO80cmdsyAXysY4/WAWsn2zspyy', 'user', 'Garry Terry', 'example@email.com', '0987666678888', '2025-04-23 12:22:08', '2025-04-23 12:22:08'),
(5, 'barber1', '$2y$10$Y.a/.jWY4mKkqFZ0MgKp9ue1NQRF4jtG1FSYfRoM3eWLr6aymkV4G', 'barber', 'Jay Styles', 'jay@example.com', '1234567890', '2025-04-29 14:30:29', '2025-05-05 11:16:34'),
(6, 'barber2', '$2y$10$RSukv9kOTSuXV/LnQBD4zuKBMHGpS3.bVFiLguNBYAmrvKb8DeL4C', 'barber', 'Patrick Smith', 'patrick@example.com', '0987654321', '2025-04-29 14:30:29', '2025-05-01 08:57:08'),
(7, 'geo', '$2y$10$Qn4AJRoZfxICqj30plkMW.cISfgPRmqxKDQdiemTiD/zL9QyrtGpy', 'user', 'George Donavan', 'geo@email.ie', '098765443345', '2025-05-01 13:44:57', '2025-05-01 13:44:57'),
(9, 'Carl', '$2y$10$mLrpaa19l0QzLClJrQUUQeB7LGIQ3lLZa3D4QtCHFHVvwKJkGaLIq', 'user', 'Carl Dunny', 'carl@email.com', '098876678999', '2025-05-01 14:05:02', '2025-05-01 14:05:02'),
(10, 'Martin', '$2y$10$Oq1hVfhq.oY5qFx/i5RQyemynO/k5PJvUXJy6fwbX6WtSWY6KOi12', 'user', 'Martin Bolan', 'martin@example.ie', '09876635637238', '2025-05-01 14:10:48', '2025-05-01 14:10:48'),
(12, 'Paddy', '$2y$10$ZUTC8aVEk9MY31Po3si/MedydUVGNLbEBzIfyrlypItR/FNpTUZWW', 'user', 'Paddy Murphy', 'paddy@email.ie', '089765443245', '2025-05-04 09:47:44', '2025-05-04 09:47:44'),
(13, 'Naiara', '$2y$10$SlCfJfILEKscfgY.G2dyhuUDoJp.rqIlGSuDGYxpjJDesnatYpR6q', 'user', 'Naiara Zanchi', 'naiara@email.com', '099876655', '2025-05-04 12:13:28', '2025-05-04 12:13:28'),
(15, 'Paul', '$2y$10$lQunisHEQIqSpCk9WuPcjOS18AwmqypCCytWCJYSPhMjwDHhjV3mG', 'user', 'Paul Power', 'paul@email.com', '09887763726266', '2025-05-05 10:47:54', '2025-05-05 10:47:54'),
(18, 'George', '$2y$10$RaOPqunBIYHgPv7xkU9dxeUMTjjR654Ts5eXe.nxUJYeWTuk3c9.2', 'user', 'George Donavan', 'george@email.com', '09876553', '2025-05-05 20:12:49', '2025-05-05 20:12:49'),
(23, 'Robert', '$2y$10$WNm1iwE/od80PSghDQslNuk0KF0McBHk8Hv9jDAmBYIUSP0L5bLQ.', 'user', 'Robert Doole', 'robert@example.com', '0987723445', '2025-05-06 06:59:39', '2025-05-06 06:59:39'),
(25, 'Emmanuel', '$2y$10$ETsUFeY5vU3qXboRX0GGPu/zAKtGtgHFqZmb653uylHzdyZJI/fqK', 'user', 'Emmanuel', 'abolade.emmanuel@gmail.com', '0998765544', '2025-05-06 09:53:12', '2025-05-06 09:53:12'),
(27, 'melara', '$2y$10$/8lVrscNcx65KU.NAOgpSebw94VEjPntkdkA.PrfXBfxTZRJjIou6', 'user', 'melara', 'marvin.zanchi@gmail.com', '0101010101', '2026-01-09 10:57:39', '2026-01-09 10:57:39'),
(28, 'test', '$2y$10$6NfdzJPc1fP8pUc8VW3hFOrXJedi5mQgEhGTrhjShsA/B.tJbBSUW', 'user', 'Cloud', 'mazds.web@gmail.com', '0851941315', '2026-04-26 10:27:37', '2026-04-26 10:27:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `fk_bookings_barber` (`barber_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `fk_bookings_barber` FOREIGN KEY (`barber_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
