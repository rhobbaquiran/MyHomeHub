-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2024 at 06:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(202, '2024-01-11 12:15:52', 'Super Admin', 'Logged out', NULL),
(203, '2024-01-13 02:17:03', 'Super Admin', 'Logged in', NULL),
(204, '2024-01-13 02:23:55', 'Super Admin', 'Added Administrator: Jimmy Gibbs Jr.', NULL),
(205, '2024-01-13 02:24:17', 'Super Admin', 'Logged out', NULL),
(206, '2024-01-13 02:24:26', 'Jimmy Gibbs Jr.', 'Logged in', 18),
(207, '2024-01-13 02:28:08', 'Jimmy Gibbs Jr.', 'Logged in', 18),
(208, '2024-01-13 02:28:38', 'Super Admin', 'Logged in', NULL),
(209, '2024-01-13 02:42:28', 'Super Admin', 'Added Condominium: West Viriginia', NULL),
(210, '2024-01-13 02:45:56', 'Super Admin', 'Added Administrator: Conan Brian', NULL),
(211, '2024-01-13 02:47:12', 'Super Admin', 'Logged out', NULL),
(212, '2024-01-13 02:47:20', 'Conan Brian', 'Logged in', 22),
(213, '2024-01-13 02:47:33', 'Super Admin', 'Logged in', NULL),
(214, '2024-01-13 02:50:00', 'Super Admin', 'Added transaction of West Viriginia with Bill Number: 1510390405', NULL),
(215, '2024-01-13 02:54:01', 'Super Admin', 'Updated Condominium: West Viriginia', NULL),
(216, '2024-01-13 02:54:11', 'Super Admin', 'Updated Condominium: West Viriginia', NULL),
(217, '2024-01-13 02:54:15', 'Super Admin', 'Updated Condominium: West Viriginia', NULL),
(218, '2024-01-13 02:54:19', 'Super Admin', 'Updated Condominium: West Viriginia', NULL),
(219, '2024-01-13 02:56:18', 'Super Admin', 'Updated Administrator: Conan Barbarian', NULL),
(220, '2024-01-13 02:59:17', 'Super Admin', 'Updated transaction of West Viriginia with Bill Number: 1510390405', NULL),
(221, '2024-01-13 02:59:26', 'Super Admin', 'Updated transaction of West Viriginia with Bill Number: 1510390405', NULL),
(222, '2024-01-13 03:00:10', 'Super Admin', 'Logged out', NULL),
(223, '2024-01-13 03:01:47', 'Super Admin', 'Logged in', NULL),
(224, '2024-01-13 03:01:51', 'Super Admin', 'Logged out', NULL),
(225, '2024-01-13 03:02:07', 'Elon Musk', 'Logged in', 1),
(226, '2024-01-13 03:02:17', 'Dwayne Johnson', 'Logged in', 1),
(227, '2024-01-13 03:04:29', 'Dwayne Johnson', 'Added visitor: Jason Vorhees', 1),
(228, '2024-01-13 03:07:01', 'Dwayne Johnson', 'Updated visitor: Jason Vorhees XIII', 1),
(229, '2024-01-13 03:07:32', 'Dwayne Johnson', 'Logged out', 1),
(230, '2024-01-13 03:15:22', 'Elon Musk', 'Logged in', 1),
(231, '2024-01-13 03:28:37', 'Elon Musk', 'Logged out', 1),
(232, '2024-01-13 03:28:55', 'Elon Musk', 'Logged in', 1),
(233, '2024-01-13 03:29:14', 'Elon Musk', 'Logged out', 1),
(234, '2024-01-13 03:29:53', 'Elon Musk', 'Logged in', 1),
(235, '2024-01-13 03:30:07', 'Elon Musk', 'Logged out', 1),
(236, '2024-01-13 03:30:16', 'Dwayne Johnson', 'Logged in', 1),
(237, '2024-01-13 03:30:21', 'Dwayne Johnson', 'Logged out', 1),
(238, '2024-01-13 03:31:20', 'Dwayne Johnson', 'Logged in', 1),
(239, '2024-01-13 03:31:37', 'Dwayne Johnson', 'Logged out', 1),
(282, '2024-01-13 04:50:45', 'Super Admin', 'Logged in', NULL),
(283, '2024-01-13 04:51:00', 'Super Admin', 'Added Condominium: Little America', NULL),
(284, '2024-01-13 04:51:05', 'Super Admin', 'Updated Condominium: Little America', NULL),
(285, '2024-01-13 04:51:09', 'Super Admin', 'Suspended Condominium: Little America', NULL),
(286, '2024-01-13 04:51:12', 'Super Admin', 'Redeployed Condominium: Little America', NULL),
(287, '2024-01-13 04:51:58', 'Super Admin', 'Added Administrator: George Washington', NULL),
(288, '2024-01-13 04:52:26', 'Super Admin', 'Updated Administrator: George Washington', NULL),
(289, '2024-01-13 04:52:32', 'Super Admin', 'Suspended Condominium: Little America', NULL),
(290, '2024-01-13 04:52:37', 'Super Admin', 'Redeployed Condominium: Little America', NULL),
(291, '2024-01-13 04:52:42', 'Super Admin', 'Suspended Administrator: George Washington', NULL),
(292, '2024-01-13 04:52:44', 'Super Admin', 'Redeployed Administrator: George Washington', NULL),
(293, '2024-01-13 04:53:20', 'Super Admin', 'Added transaction of Little America with Bill Number: 1169611717', NULL),
(294, '2024-01-13 04:54:02', 'Super Admin', 'Updated transaction of Little America with Bill Number: 1169611717', NULL),
(295, '2024-01-13 04:54:19', 'Super Admin', 'Deleted transaction of Little America with Bill Number: 1169611717', NULL),
(296, '2024-01-13 04:54:58', 'Super Admin', 'Logged out', NULL),
(297, '2024-01-13 04:55:03', 'George Washington', 'Logged in', 23),
(298, '2024-01-13 04:55:33', 'George Washington', 'Logged out', 23),
(299, '2024-01-13 04:55:44', 'Elon Musk', 'Logged in', 1),
(300, '2024-01-13 04:56:26', 'Elon Musk', 'Added Resident: Benjamin Franklin', 1),
(301, '2024-01-13 04:56:35', 'Elon Musk', 'Updated Resident: Benjamin Franklin', 1),
(302, '2024-01-13 04:57:11', 'Elon Musk', 'Logged out', 1),
(303, '2024-01-13 04:57:18', 'Elon Musk', 'Logged in', 1),
(306, '2024-01-13 05:00:44', 'Elon Musk', 'Suspended Resident: Benjamin Franklin', 1),
(307, '2024-01-13 05:00:46', 'Elon Musk', 'Redeployed Resident: Benjamin Franklin', 1),
(308, '2024-01-13 05:00:48', 'Elon Musk', 'Suspended Resident: Benjamin Franklin', 1),
(309, '2024-01-13 05:00:50', 'Elon Musk', 'Redeployed Resident: Benjamin Franklin', 1),
(310, '2024-01-13 05:01:13', 'Elon Musk', 'Updated Resident: Benjamin Franklin', 1),
(311, '2024-01-13 05:01:20', 'Elon Musk', 'Updated Resident: Benjamin Franklin X', 1),
(312, '2024-01-13 05:01:35', 'Elon Musk', 'Suspended Resident: Benjamin Franklin X', 1),
(313, '2024-01-13 05:01:37', 'Elon Musk', 'Redeployed Resident: Benjamin Franklin X', 1),
(314, '2024-01-13 05:02:33', 'Elon Musk', 'Suspended Resident: Benjamin Franklin X', 1),
(315, '2024-01-13 05:02:34', 'Elon Musk', 'Redeployed Resident: Benjamin Franklin X', 1),
(316, '2024-01-13 05:02:40', 'Elon Musk', 'Suspended Resident: Benjamin Franklin X', 1),
(317, '2024-01-13 05:02:45', 'Elon Musk', 'Redeployed Resident: Benjamin Franklin X', 1),
(318, '2024-01-13 05:03:30', 'Elon Musk', 'Logged out', 1),
(319, '2024-01-13 05:04:31', 'Elon Musk', 'Logged in', 1),
(320, '2024-01-13 05:11:58', 'Elon Musk', 'Logged out', 1),
(321, '2024-01-13 05:12:46', 'Super Admin', 'Logged in', NULL),
(322, '2024-01-13 05:12:54', 'Super Admin', 'Logged out', NULL),
(323, '2024-01-13 05:13:02', 'Elon Musk', 'Logged in', 1),
(324, '2024-01-13 05:13:08', 'Elon Musk', 'Logged out', 1),
(325, '2024-01-13 05:17:25', 'Elon Musk', 'Logged in', 1),
(326, '2024-01-13 05:17:51', 'Elon Musk', 'Added Resident: Sam Adams', 1),
(327, '2024-01-13 05:17:57', 'Elon Musk', 'Updated Resident: Sam Adams', 1),
(328, '2024-01-13 05:18:02', 'Elon Musk', 'Updated Resident: Samuel Adams', 1),
(329, '2024-01-13 05:18:07', 'Elon Musk', 'Suspended Resident: Samuel Adams', 1),
(330, '2024-01-13 05:18:17', 'Elon Musk', 'Redeployed Resident: Samuel Adams', 1),
(331, '2024-01-13 05:18:32', 'Elon Musk', 'Suspended Resident: Samuel Adams', 1),
(332, '2024-01-13 05:18:35', 'Elon Musk', 'Logged out', 1),
(333, '2024-01-13 05:18:42', 'Samuel Adams', 'Logged in', 1),
(334, '2024-01-13 05:18:46', 'Samuel Adams', 'Logged in', 1),
(335, '2024-01-13 05:18:50', 'Samuel Adams', 'Logged in', 1),
(336, '2024-01-13 05:18:57', 'Elon Musk', 'Logged in', 1),
(337, '2024-01-13 05:19:00', 'Elon Musk', 'Redeployed Resident: Samuel Adams', 1),
(338, '2024-01-13 05:19:01', 'Elon Musk', 'Logged out', 1),
(340, '2024-01-13 05:19:26', 'Elon Musk', 'Logged in', 1),
(341, '2024-01-13 05:19:57', 'Elon Musk', 'Logged out', 1),
(342, '2024-01-13 06:05:15', 'Super Admin', 'Logged in', NULL),
(343, '2024-01-13 07:02:01', 'Super Admin', 'Updated Condominium: Casa Bougainvilla', NULL),
(344, '2024-01-13 07:05:00', 'Super Admin', 'Updated Condominium: Casa Salamanca', NULL),
(345, '2024-01-13 07:05:13', 'Super Admin', 'Updated Condominium: Pinkerton Condominium', NULL),
(346, '2024-01-13 07:05:31', 'Super Admin', 'Updated Condominium: Little America', NULL),
(347, '2024-01-13 07:05:43', 'Super Admin', 'Updated Condominium: Trump Tower', NULL),
(348, '2024-01-13 07:05:57', 'Super Admin', 'Updated Condominium: West Viriginia', NULL),
(349, '2024-01-13 08:27:00', 'Super Admin', 'Logged in', NULL),
(350, '2024-01-13 10:10:17', 'Super Admin', 'Updated Condominium: Casa Salamanca', NULL),
(351, '2024-01-13 11:29:40', 'Super Admin', 'Updated Condominium: Casa Salamanca', NULL),
(352, '2024-01-13 11:44:44', 'Super Admin', 'Added Condominium: Ang Tahanan', NULL),
(353, '2024-01-13 11:56:33', 'Super Admin', 'Suspended Condominium: Casa Bougainvilla', NULL),
(354, '2024-01-13 11:56:36', 'Super Admin', 'Redeployed Condominium: Casa Bougainvilla', NULL),
(355, '2024-01-13 12:02:14', 'Super Admin', 'Logged in', NULL),
(356, '2024-01-15 04:35:18', 'Super Admin', 'Logged in', NULL),
(357, '2024-01-15 05:07:25', 'Super Admin', 'Suspended Condominium: Trump Tower', NULL),
(358, '2024-01-15 05:08:56', 'Super Admin', 'Reinstateed Condominium: Trump Tower', NULL),
(359, '2024-01-15 05:08:59', 'Super Admin', 'Suspended Condominium: Trump Tower', NULL),
(360, '2024-01-15 05:09:00', 'Super Admin', 'Reinstateed Condominium: Trump Tower', NULL),
(361, '2024-01-15 05:09:04', 'Super Admin', 'Suspended Condominium: Trump Tower', NULL),
(362, '2024-01-15 05:09:06', 'Super Admin', 'Reinstateed Condominium: Trump Tower', NULL),
(363, '2024-01-15 05:09:31', 'Super Admin', 'Suspended Condominium: Trump Tower', NULL),
(364, '2024-01-15 05:22:14', 'Super Admin', 'Suspended Condominium: West Viriginia', NULL),
(365, '2024-01-15 05:22:16', 'Super Admin', 'Reinstated Condominium: West Viriginia', NULL),
(366, '2024-01-15 05:22:20', 'Super Admin', 'Suspended Condominium: West Viriginia', NULL),
(367, '2024-01-15 05:22:22', 'Super Admin', 'Reinstated Condominium: West Viriginia', NULL),
(368, '2024-01-15 05:29:25', 'Super Admin', 'Reinstated Condominium: Trump Tower', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_transactions`
--

INSERT INTO `admin_transactions` (`id`, `account_number`, `condominium`, `bill_number`, `billing_period_start`, `billing_period_end`, `due_date`, `total_amount_due`, `status`, `is_deleted`) VALUES
(1, 1315648790, 'Casa Bougainvilla', '1024827810', '2024-01-01', '2024-01-31', '2024-02-10', 2000.00, 'Pending', 0),
(3, 1448159203, 'Trump Tower', '1997241191', '2024-01-01', '2024-01-31', '2024-02-10', 2000.00, 'Paid', 1),
(4, 1496955270, 'Casa Salamanca', '1810154634', '2023-12-01', '2023-12-31', '2024-01-10', 2000.00, 'Paid', 1),
(5, 1448159203, 'Trump Tower', '2069142444', '2024-04-04', '2024-02-04', '2024-03-04', 444.00, 'Paid', 1),
(6, 1448159203, 'Trump Tower', '1485663559', '2024-02-01', '2024-02-29', '2024-03-10', 2000.00, 'Paid', 0),
(7, 1315648790, 'Casa Bougainvilla', '1117254594', '2024-01-10', '2024-01-26', '2024-01-24', 2.00, 'Pending', 1),
(8, 1883187512, 'Pinkerton Condominium', '1005736248', '2024-01-01', '2024-01-31', '2024-02-10', 2000.00, 'Paid', 1),
(9, 1510158441, 'West Viriginia', '1510390405', '2024-03-01', '2024-03-31', '2024-04-10', 2000.00, 'Paid', 0),
(10, 2018384520, 'Little America', '1169611717', '2024-01-01', '2024-01-23', '2024-01-10', 1790.00, 'Paid', 1);

-- --------------------------------------------------------

--
-- Table structure for table `condominiums`
--

CREATE TABLE `condominiums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `person_of_contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `suspended` tinyint(1) DEFAULT 0,
  `payment_status` varchar(10) NOT NULL DEFAULT 'UNPAID' COMMENT 'Payment Status: UNPAID or PAID',
  `suspension_reason` varchar(255) NOT NULL,
  `condominium_status` varchar(11) NOT NULL,
  `legal_documents` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `condominiums`
--

INSERT INTO `condominiums` (`id`, `name`, `person_of_contact`, `address`, `suspended`, `payment_status`, `suspension_reason`, `condominium_status`, `legal_documents`) VALUES
(1, 'Casa Bougainvilla', '', '', 0, 'PAID', '', 'APPROVED', ''),
(18, 'Trump Tower', '', '', 0, 'SUSPENDED', '', 'APPROVED', ''),
(19, 'Casa Salamanca', 'Hector Salamanca', 'Kawit, Cavite', 0, 'PENDING', '', 'PENDING', 0x6941434144454d595f55475f48616e64626f6f6b5f323032312e706466),
(21, 'Pinkerton Condominium', '', '', 0, 'PENDING', '', 'PENDING', ''),
(22, 'West Viriginia', '', '', 0, 'SUSPENDED', '', 'APPROVED', ''),
(23, 'Little America', '', '', 0, 'PENDING', '', 'PENDING', ''),
(24, 'Ang Tahanan', 'Damian Ang', 'Malate, Manila', 0, 'PENDING', '', 'PENDING', 0x5468657369735f50726f706f73616c5f2d5f53454733315f2d5f5265736964656e7469616c5f4d616e6167656d656e745f53797374656d2d312e706466);

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
  `suspended` tinyint(1) DEFAULT 0,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_verified` tinyint(1) DEFAULT 0,
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `dashboard_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_number`, `username`, `password`, `email`, `role`, `condominium_id`, `suspended`, `otp_code`, `otp_verified`, `last_login_time`, `dashboard_url`) VALUES
(1, 0, 'Super Admin', '17c4520f6cfd1ab53d8745e84681eb49', 'adm1nplk2022@yahoo.com', 'Super Administrator', NULL, 0, NULL, 0, '2023-11-04 13:53:18', 'superadmin_dashboard.php'),
(2, 1425648978, 'John Cena', '527bd5b5d689e2c32ae974c6229ff785', 'cena@gmail.com', 'Resident', 1, 0, NULL, 0, '2023-11-04 14:46:21', 'casa_bougainvilla/resident_dashboard.php'),
(3, 1123456786, 'Dwayne Johnson', '802dcc51ecfcb58c97258d064c017237', 'johnson@gmail.com', 'Front Desk', 1, 0, NULL, 0, '2023-11-04 14:54:32', 'casa_bougainvilla/front_desk_dashboard.php'),
(4, 1315648790, 'Elon Musk', '9e887375eaba77dc7568e4048268520e', 'musk@gmail.com', 'Administrator', 1, 0, NULL, 0, '2023-11-04 14:56:55', 'casa_bougainvilla/administrator_dashboard.php'),
(8, 1101483647, 'Jason De Guzman', '53740f9f22d9f3425e379363d9b610e5', 'jasondeguzman@cssalamanca.com', 'Administrator', 1, 0, NULL, 0, '2024-01-09 12:20:41', 'casa_bougainvilla/administrator_dashboard.php'),
(10, 1095279156, 'Daryl Sarmiento', 'a26d15e5f355f1b3d6d11e35010b9d03', 'darylsarmiento@cssalamanca.com', 'Administrator', 1, 0, NULL, 0, '2024-01-09 14:16:26', 'casa_bougainvilla/administrator_dashboard.php'),
(16, 1147483647, 'Hank Schrader', 'fcea920f7412b5da7be0cf42b8c93759', 'minerals@gmail.com', 'Administrator', 19, 0, NULL, 0, '2024-01-09 16:36:42', 'casa_bougainvilla/administrator_dashboard.php'),
(34, 1883187512, 'Morgan Freeman', '81dc9bdb52d04dc20036dbd8313ed055', 'freeman@gmail.com', 'Administrator', 21, 0, NULL, 0, '2024-01-11 12:11:23', 'casa_bougainvilla/administrator_dashboard.php'),
(35, 2028470966, 'Jimmy Gibbs Jr.', 'c2fe677a63ffd5b7ffd8facbf327dad0', 'jimmy@gmail.com', 'Administrator', 18, 0, NULL, 0, '2024-01-13 02:23:55', 'casa_bougainvilla/administrator_dashboard.php'),
(36, 1510158441, 'Conan Barbarian', 'c9dc004fc3d039ad7fb49456e5902b01', 'conan@gmail.com', 'Administrator', 22, 0, NULL, 0, '2024-01-13 02:45:56', 'casa_bougainvilla/administrator_dashboard.php'),
(37, 1747194577, 'Tom Cruise', '34b7da764b21d298ef307d04d8152dc5', 'impossible@gmail.com', 'Resident', 1, 0, NULL, 0, '2024-01-13 04:19:59', 'casa_bougainvilla/resident_dashboard.php'),
(38, 1983123405, 'Marty McFry III', '9a09b4dfda82e3e665e31092d1c3ec8d', 'chicken85@gmail.com', 'Resident', 1, 1, NULL, 0, '2024-01-13 04:21:48', 'casa_bougainvilla/resident_dashboard.php'),
(39, 2018384520, 'George Washington', 'ada53304c5b9e4a839615b6e8f908eb6', 'washington75@gmail.com', 'Administrator', 23, 0, NULL, 0, '2024-01-13 04:51:58', 'casa_bougainvilla/administrator_dashboard.php'),
(40, 2144409403, 'Benjamin Franklin X', '7fe4771c008a22eb763df47d19e2c6aa', 'ben769@gmail.com', 'Resident', 1, 0, NULL, 0, '2024-01-13 04:56:26', 'casa_bougainvilla/resident_dashboard.php'),
(41, 1617546162, 'Samuel Adams', '332532dcfaa1cbf61e2a266bd723612c', 'sam75@gmail.com', 'Resident', 1, 0, NULL, 0, '2024-01-13 05:17:51', 'casa_bougainvilla/resident_dashboard.php');

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
(6, 'Micheal Corleon', '09346780076', 'mafia@gmail.com', '2023-12-04 15:31:00', '2023-12-13 05:35:00', 'visiting a cousin at room 7', 1, 0),
(10, 'James Garfield', '09293530031', 'garfield@gmail.com', '2024-01-11 20:07:00', '2024-01-11 21:07:00', 'visiting john', 1, 1),
(11, 'Jason Vorhees XIII', '09293530031', 'crystal@gmail.com', '2024-01-13 11:04:00', '2024-01-13 15:01:00', 'visiting my mother at unit 13', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT for table `admin_transactions`
--
ALTER TABLE `admin_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `condominiums`
--
ALTER TABLE `condominiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
