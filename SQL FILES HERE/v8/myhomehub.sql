-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 11, 2024 at 01:18 PM
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
(185, '2024-01-11 12:06:49', 'Dwayne Johnson', 'Logged in', 1),
(186, '2024-01-11 12:07:43', 'Dwayne Johnson', 'Added visitor: James Garfield', 1),
(187, '2024-01-11 12:08:02', 'Dwayne Johnson', 'Updated visitor: James Garfield', 1),
(188, '2024-01-11 12:08:09', 'Dwayne Johnson', 'Deleted visitor: James Garfield', 1),
(189, '2024-01-11 12:08:15', 'Dwayne Johnson', 'Logged out', 1),
(190, '2024-01-11 12:08:40', 'Super Admin', 'Logged in', NULL),
(191, '2024-01-11 12:10:16', 'Super Admin', 'Added Condominium: Pinkerton Condominium', NULL),
(192, '2024-01-11 12:10:28', 'Super Admin', 'Updated Condominium: Pinkerton Condominium', NULL),
(193, '2024-01-11 12:10:35', 'Super Admin', 'Suspended Condominium: Pinkerton Condominium', NULL),
(194, '2024-01-11 12:10:42', 'Super Admin', 'Redeployed Condominium: Pinkerton Condominium', NULL),
(195, '2024-01-11 12:11:23', 'Super Admin', 'Added Administrator: Morgan Freeman', NULL),
(196, '2024-01-11 12:11:46', 'Super Admin', 'Updated Administrator: Morgan Freeman', NULL),
(197, '2024-01-11 12:11:55', 'Super Admin', 'Suspended Administrator: Morgan Freeman', NULL),
(198, '2024-01-11 12:12:05', 'Super Admin', 'Redeployed Administrator: Morgan Freeman', NULL),
(199, '2024-01-11 12:12:47', 'Super Admin', 'Added transaction of Pinkerton Condominium with Bill Number: 1005736248', NULL),
(200, '2024-01-11 12:13:10', 'Super Admin', 'Updated transaction of Pinkerton Condominium with Bill Number: 1005736248', NULL),
(201, '2024-01-11 12:13:41', 'Super Admin', 'Deleted transaction of Pinkerton Condominium with Bill Number: 1005736248', NULL),
(202, '2024-01-11 12:15:52', 'Super Admin', 'Logged out', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_transactions`
--

CREATE TABLE `admin_transactions` (
  `id` int(11) NOT NULL,
  `account_number` int(10) NOT NULL,
  `condominium` varchar(255) NOT NULL,
  `bill_number` varchar(255) NOT NULL,
  `billing_period_start` date NOT NULL,
  `billing_period_end` date NOT NULL,
  `due_date` date NOT NULL,
  `total_amount_due` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT 'Paid, Pending',
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_transactions`
--

INSERT INTO `admin_transactions` (`id`, `account_number`, `condominium`, `bill_number`, `billing_period_start`, `billing_period_end`, `due_date`, `total_amount_due`, `status`, `is_deleted`) VALUES
(1, 1315648790, 'Casa Bougainvilla', '1024827810', '2024-01-01', '2024-01-31', '2024-02-10', '2000.00', 'Pending', 0),
(3, 1448159203, 'Trump Tower', '1997241191', '2024-01-01', '2024-01-31', '2024-02-10', '2000.00', 'Paid', 1),
(4, 1496955270, 'Casa Salamanca', '1810154634', '2023-12-01', '2023-12-31', '2024-01-10', '2000.00', 'Paid', 1),
(5, 1448159203, 'Trump Tower', '2069142444', '2024-04-04', '2024-02-04', '2024-03-04', '444.00', 'Paid', 1),
(6, 1448159203, 'Trump Tower', '1485663559', '2024-02-01', '2024-02-29', '2024-03-10', '2000.00', 'Paid', 0),
(7, 1315648790, 'Casa Bougainvilla', '1117254594', '2024-01-10', '2024-01-26', '2024-01-24', '2.00', 'Pending', 1),
(8, 1883187512, 'Pinkerton Condominium', '1005736248', '2024-01-01', '2024-01-31', '2024-02-10', '2000.00', 'Paid', 1);

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
(19, 'Casa Salamanca', 0, 'PENDING'),
(21, 'Pinkerton Condominium', 0, 'PENDING');

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
(34, 1883187512, 'Morgan Freeman', '1234', 'freeman@gmail.com', 'Administrator', 21, 0, NULL, 0, '2024-01-11 12:11:23', 'casa_bougainvilla/administrator_dashboard.php');

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
(6, 'Micheal Corleon', '09346780076', 'mafia@gmail.com', '2023-12-04 15:31:00', '2023-12-13 05:35:00', 'visiting a cousin at room 7', 1, 0),
(10, 'James Garfield', '09293530031', 'garfield@gmail.com', '2024-01-11 20:07:00', '2024-01-11 21:07:00', 'visiting john', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_transactions`
--
ALTER TABLE `admin_transactions`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `admin_transactions`
--
ALTER TABLE `admin_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `condominiums`
--
ALTER TABLE `condominiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
