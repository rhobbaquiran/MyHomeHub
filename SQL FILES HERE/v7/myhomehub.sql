-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 09, 2024 at 06:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(65, '2024-01-09 14:17:25', 'Super Admin', 'Updated Administrator: Daryl Sarmiento', NULL),
(66, '2024-01-09 14:48:30', 'Super Admin', 'Suspended Administrator: Jason De Guzman', NULL),
(67, '2024-01-09 14:48:33', 'Super Admin', 'Redeployed Administrator: Jason De Guzman', NULL),
(68, '2024-01-09 14:48:38', 'Super Admin', 'Suspended Administrator: Elon Musk', NULL),
(69, '2024-01-09 14:49:24', 'Super Admin', 'Redeployed Administrator: Elon Musk', NULL),
(70, '2024-01-09 14:49:40', 'Super Admin', 'Suspended Administrator: Elon Musk', NULL),
(71, '2024-01-09 14:49:52', 'Super Admin', 'Redeployed Administrator: Elon Musk', NULL),
(72, '2024-01-09 15:05:07', 'Super Admin', 'Suspended Administrator: Elon Musk', NULL),
(73, '2024-01-09 15:49:32', 'Super Admin', 'Suspended Administrator: Elon Musk', NULL),
(74, '2024-01-09 15:49:35', 'Super Admin', 'Redeployed Administrator: Elon Musk', NULL),
(75, '2024-01-09 16:15:23', 'Super Admin', 'Added Administrator: Yi Long Ma', NULL),
(76, '2024-01-09 16:18:16', 'Super Admin', 'Added Administrator: Yi Long Ma', NULL),
(77, '2024-01-09 16:33:44', 'Super Admin', 'Added Administrator: Yi Long Ma', NULL),
(78, '2024-01-09 16:36:42', 'Super Admin', 'Added Administrator: Yi Long Ma', NULL),
(79, '2024-01-09 16:57:54', 'Super Admin', 'Added Administrator: Yena Star', NULL),
(80, '2024-01-09 17:05:52', 'Super Admin', 'Updated Administrator: Ma Yi Long', NULL),
(81, '2024-01-09 17:06:37', 'Super Admin', 'Updated Administrator: Ma Yi Long', NULL),
(82, '2024-01-09 17:06:57', 'Super Admin', 'Updated Administrator: Ma Yi Long', NULL),
(83, '2024-01-09 17:07:35', 'Super Admin', 'Updated Administrator: Ma Yi Long', NULL),
(84, '2024-01-09 17:07:40', 'Super Admin', 'Updated Administrator: Ma Yi Long', NULL),
(85, '2024-01-09 17:07:46', 'Super Admin', 'Updated Administrator: Mai Yi Long', NULL),
(86, '2024-01-09 17:08:26', 'Super Admin', 'Suspended Administrator: Mai Yi Long', NULL),
(87, '2024-01-09 17:12:11', 'Super Admin', 'Added Administrator: Mike Schmidt', NULL),
(88, '2024-01-09 17:12:51', 'Super Admin', 'Updated Administrator: Billy Schmidt', NULL),
(89, '2024-01-09 17:16:08', 'Super Admin', 'Suspended Administrator: Billy Schmidt', NULL),
(90, '2024-01-09 17:16:18', 'Super Admin', 'Redeployed Administrator: Billy Schmidt', NULL),
(91, '2024-01-09 17:17:54', 'Super Admin', 'Updated Administrator: Hank Schrader', NULL),
(92, '2024-01-09 17:18:08', 'Super Admin', 'Updated Administrator: Hank Schrader', NULL),
(93, '2024-01-09 17:19:13', 'Super Admin', 'Added Administrator: Nicholas Cage', NULL),
(94, '2024-01-09 17:19:53', 'Super Admin', 'Updated Administrator: Nicholas Cage', NULL),
(95, '2024-01-09 17:23:39', 'Super Admin', 'Added Administrator: Nicholas Cage', NULL),
(96, '2024-01-09 17:24:39', 'Super Admin', 'Added Administrator: Mikey Mouse', NULL),
(97, '2024-01-09 17:27:00', 'Super Admin', 'Added Administrator: Patrick Star', NULL),
(98, '2024-01-09 17:28:58', 'Super Admin', 'Added Administrator: Patrick Star', NULL),
(99, '2024-01-09 17:30:50', 'Super Admin', 'Added Administrator: Yu Pei Mi', NULL),
(100, '2024-01-09 17:32:23', 'Super Admin', 'Added Administrator: Benjamin Franklin', NULL),
(101, '2024-01-09 17:33:29', 'Super Admin', 'Added Administrator: George Washington', NULL),
(102, '2024-01-09 17:37:00', 'Super Admin', 'Added Administrator: Sam Adams', NULL),
(103, '2024-01-09 17:38:51', 'Super Admin', 'Added Administrator: John Adams', NULL),
(104, '2024-01-09 17:39:37', 'Super Admin', 'Added Administrator: Thomas Jefferson', NULL),
(105, '2024-01-09 17:41:44', 'Super Admin', 'Added Administrator: John Calhoun', NULL),
(106, '2024-01-09 17:43:25', 'Super Admin', 'Added Administrator: Gordon Freeman', NULL),
(107, '2024-01-09 17:44:07', 'Super Admin', 'Added Administrator: Alyx Vance', NULL),
(108, '2024-01-09 17:44:29', 'Super Admin', 'Updated Administrator: Alyx Vance', NULL),
(109, '2024-01-09 17:44:33', 'Super Admin', 'Updated Administrator: Alyx Vance', NULL),
(110, '2024-01-09 17:44:37', 'Super Admin', 'Suspended Administrator: Alyx Vance', NULL),
(111, '2024-01-09 17:44:39', 'Super Admin', 'Redeployed Administrator: Alyx Vance', NULL),
(112, '2024-01-09 17:46:38', 'Super Admin', 'Updated Administrator: Gordon Freeman', NULL),
(113, '2024-01-09 17:56:45', 'Super Admin', 'Updated Administrator: Alyx Vance', NULL),
(114, '2024-01-09 17:58:31', 'Super Admin', 'Updated Administrator: Gordon Freeman', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `condominiums`
--

CREATE TABLE `condominiums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `disabled` tinyint(1) DEFAULT 0,
  `payment_status` varchar(10) NOT NULL DEFAULT 'UNPAID' COMMENT 'Payment Status: UNPAID or PAID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `condominium_id` int(11) DEFAULT NULL,
  `disabled` tinyint(1) DEFAULT 0,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_verified` tinyint(1) DEFAULT 0,
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `dashboard_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_number`, `username`, `password`, `email`, `role`, `condominium_id`, `disabled`, `otp_code`, `otp_verified`, `last_login_time`, `dashboard_url`) VALUES
(1, 0, 'Super Admin', 'superadmin', 'adm1nplk2022@yahoo.com', 'Super Administrator', NULL, 0, NULL, 0, '2023-11-04 13:53:18', 'superadmin_dashboard.php'),
(2, 1425648978, 'John Cena', 'john', 'cena@gmail.com', 'Resident', 1, 0, NULL, 0, '2023-11-04 14:46:21', 'casa_bougainvilla/resident_dashboard.php'),
(3, 1123456786, 'Dwayne Johnson', 'dwayne', 'johnson@gmail.com', 'Front Desk', 1, 0, NULL, 0, '2023-11-04 14:54:32', 'casa_bougainvilla/front_desk_dashboard.php'),
(4, 1315648790, 'Elon Musk', 'elon', 'musk@gmail.com', 'Administrator', 1, 0, NULL, 0, '2023-11-04 14:56:55', 'casa_bougainvilla/administrator_dashboard.php'),
(8, 1101483647, 'Jason De Guzman', 'deguzmancs', 'jasondeguzman@cssalamanca.com', 'Administrator', 1, 0, NULL, 0, '2024-01-09 12:20:41', 'casa_bougainvilla/administrator_dashboard.php'),
(10, 1095279156, 'Daryl Sarmiento', 'sarmientocs', 'darylsarmiento@cssalamanca.com', 'Administrator', 1, 0, NULL, 0, '2024-01-09 14:16:26', 'casa_bougainvilla/administrator_dashboard.php'),
(16, 1147483647, 'Hank Schrader', '1234567', 'minerals@gmail.com', 'Administrator', 19, 0, NULL, 0, '2024-01-09 16:36:42', 'casa_bougainvilla/administrator_dashboard.php'),
(31, 1448159203, 'Gordon Freeman', '12345', 'gordon@gmail.com', 'Administrator', 18, 0, NULL, 0, '2024-01-09 17:43:25', 'casa_bougainvilla/administrator_dashboard.php'),
(32, 1496955270, 'Alyx Vance', '654321', 'vance@gmail.com', 'Administrator', 19, 0, NULL, 0, '2024-01-09 17:44:07', 'casa_bougainvilla/administrator_dashboard.php');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `condominiums`
--
ALTER TABLE `condominiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
