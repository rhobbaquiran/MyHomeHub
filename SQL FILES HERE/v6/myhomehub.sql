-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 03:29 PM
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
-- Database: `myhomehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `condominium_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `timestamp`, `user`, `action`, `condominium_id`) VALUES
(10, '2023-12-04 07:31:54', 'Dwayne Johnson', 'Added visitor: Micheal Corleon', 1),
(11, '2023-12-04 07:32:47', 'Dwayne Johnson', 'Added visitor: Jedediah Longtree', 1),
(12, '2023-12-04 07:33:02', 'Dwayne Johnson', 'Updated visitor: Jedediah Longtree', 1),
(13, '2023-12-04 07:33:12', 'Dwayne Johnson', 'Deleted visitor: Jedediah Longtree', 1),
(14, '2023-12-04 07:33:42', 'Dwayne Johnson', 'Updated visitor: Micheal Corleon', 1),
(47, '2024-01-08 10:14:13', 'Super Admin', 'Added Condominium: Trump Tower', NULL),
(48, '2024-01-08 10:14:21', 'Super Admin', 'Updated Condominium: Trump Tower', NULL),
(49, '2024-01-08 10:14:24', 'Super Admin', 'Updated Condominium: Trump Tower', NULL),
(50, '2024-01-08 10:14:41', 'Super Admin', 'Suspended Condominium: Trump Tower', NULL),
(51, '2024-01-08 10:14:46', 'Super Admin', 'Redeployed Condominium: Trump Tower', NULL),
(52, '2024-01-09 08:47:50', 'Super Admin', 'Added Condominium: Casa Salamanca', NULL),
(53, '2024-01-09 08:48:04', 'Super Admin', 'Updated Condominium: Casa Salamanca', NULL),
(54, '2024-01-09 08:48:07', 'Super Admin', 'Suspended Condominium: Casa Salamanca', NULL),
(55, '2024-01-09 08:48:15', 'Super Admin', 'Redeployed Condominium: Casa Salamanca', NULL),
(56, '2024-01-09 12:04:47', 'Super Admin', 'Added Administrator: Jason De Guzman', NULL),
(57, '2024-01-09 12:05:10', 'Super Admin', 'Added Administrator: Jason De Guzman', NULL),
(58, '2024-01-09 12:18:06', 'Super Admin', 'Added Administrator: Jason De Guzman', NULL),
(59, '2024-01-09 12:20:41', 'Super Admin', 'Added Administrator: Jason De Guzman', NULL),
(60, '2024-01-09 13:51:24', 'Super Admin', 'Suspended Administrator: Jason De Guzman', NULL),
(61, '2024-01-09 13:51:27', 'Super Admin', 'Redeployed Administrator: Jason De Guzman', NULL),
(62, '2024-01-09 14:06:13', 'Super Admin', 'Redeployed Administrator: Jason De Guzman', NULL),
(63, '2024-01-09 14:11:11', 'Super Admin', 'Added Administrator: Arnel Cruz', NULL),
(64, '2024-01-09 14:16:26', 'Super Admin', 'Added Administrator: Daryl Romero', NULL),
(65, '2024-01-09 14:17:25', 'Super Admin', 'Updated Administrator: Daryl Sarmiento', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `condominiums`
--

CREATE TABLE `condominiums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `disabled` tinyint(1) DEFAULT 0,
  `payment_status` varchar(10) NOT NULL DEFAULT 'UNPAID' COMMENT 'Payment Status: UNPAID or PAID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `condominiums`
--

INSERT INTO `condominiums` (`id`, `name`, `disabled`, `payment_status`) VALUES
(1, 'Casa Bougainvilla', 0, 'PAID'),
(18, 'Trump Tower', 0, 'SUSPENDED'),
(19, 'Casa Salamanca', 0, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `account_number` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `condominium` varchar(255) NOT NULL,
  `condominium_id` int(11) DEFAULT NULL,
  `disabled` tinyint(1) DEFAULT 0,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_verified` tinyint(1) DEFAULT 0,
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `dashboard_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_number`, `username`, `password`, `email`, `role`, `condominium`, `condominium_id`, `disabled`, `otp_code`, `otp_verified`, `last_login_time`, `dashboard_url`) VALUES
(1, 0, 'Super Admin', 'superadmin', 'adm1nplk2022@yahoo.com', 'Super Administrator', '', NULL, 0, NULL, 0, '2023-11-04 13:53:18', 'superadmin_dashboard.php'),
(2, 0, 'John Cena', 'john', 'cena@gmail.com', 'Resident', '', 1, 0, NULL, 0, '2023-11-04 14:46:21', 'casa_bougainvilla/resident_dashboard.php'),
(3, 0, 'Dwayne Johnson', 'dwayne', 'johnson@gmail.com', 'Front Desk', '', 1, 0, NULL, 0, '2023-11-04 14:54:32', 'casa_bougainvilla/front_desk_dashboard.php'),
(4, 0, 'Elon Musk', 'elon', 'musk@gmail.com', 'Administrator', '', 1, 0, NULL, 0, '2023-11-04 14:56:55', 'casa_bougainvilla/administrator_dashboard.php'),
(8, 2147483647, 'Jason De Guzman', 'deguzmancs', 'jasondeguzman@cssalamanca.com', 'Administrator', 'Casa Salamanca', NULL, 0, NULL, 0, '2024-01-09 12:20:41', ''),
(10, 1095279156, 'Daryl Sarmiento', 'sarmientocs', 'darylsarmiento@cssalamanca.com', 'Administrator', 'Casa Salamanca', NULL, 0, NULL, 0, '2024-01-09 14:16:26', '');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `arrival_time` datetime NOT NULL,
  `departure_time` datetime NOT NULL,
  `purpose` text NOT NULL,
  `condominium_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `name`, `phone_number`, `email`, `arrival_time`, `departure_time`, `purpose`, `condominium_id`, `is_deleted`) VALUES
(6, 'Micheal Corleon', '09346780076', 'mafia@gmail.com', '2023-12-04 15:31:00', '2023-12-13 05:35:00', 'visiting a cousin at room 7', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `condominiums`
--
ALTER TABLE `condominiums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `condominium_id` (`condominium_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `condominium_id` (`condominium_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `condominiums`
--
ALTER TABLE `condominiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`condominium_id`) REFERENCES `condominiums` (`id`);

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`condominium_id`) REFERENCES `condominiums` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
