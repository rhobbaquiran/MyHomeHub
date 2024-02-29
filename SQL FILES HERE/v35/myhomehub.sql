-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Feb 14, 2024 at 07:56 AM
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
  `condominium_id` int(11) DEFAULT NULL,
  `account_number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `timestamp`, `user`, `action`, `condominium_id`, `account_number`) VALUES
(186, '2024-01-11 12:07:43', 'Dwayne Johnson', 'Added visitor: James Garfield', 1, 0),
(187, '2024-01-11 12:08:02', 'Dwayne Johnson', 'Updated visitor: James Garfield', 1, 0),
(188, '2024-01-11 12:08:09', 'Dwayne Johnson', 'Deleted visitor: James Garfield', 1, 0),
(189, '2024-01-11 12:08:15', 'Dwayne Johnson', 'Logged out', 1, 0),
(190, '2024-01-11 12:08:40', 'Super Admin', 'Logged in', NULL, 0),
(199, '2024-01-11 12:12:47', 'Super Admin', 'Added transaction of Pinkerton Condominium with Bill Number: 1005736248', NULL, 0),
(200, '2024-01-11 12:13:10', 'Super Admin', 'Updated transaction of Pinkerton Condominium with Bill Number: 1005736248', NULL, 0),
(201, '2024-01-11 12:13:41', 'Super Admin', 'Deleted transaction of Pinkerton Condominium with Bill Number: 1005736248', NULL, 0),
(202, '2024-01-11 12:15:52', 'Super Admin', 'Logged out', NULL, 0),
(203, '2024-01-13 02:17:03', 'Super Admin', 'Logged in', NULL, 0),
(204, '2024-01-13 02:23:55', 'Super Admin', 'Added Administrator: Jimmy Gibbs Jr.', NULL, 0),
(205, '2024-01-13 02:24:17', 'Super Admin', 'Logged out', NULL, 0),
(206, '2024-01-13 02:24:26', 'Jimmy Gibbs Jr.', 'Logged in', 18, 0),
(207, '2024-01-13 02:28:08', 'Jimmy Gibbs Jr.', 'Logged in', 18, 0),
(208, '2024-01-13 02:28:38', 'Super Admin', 'Logged in', NULL, 0),
(209, '2024-01-13 02:42:28', 'Super Admin', 'Added Condominium: West Viriginia', NULL, 0),
(210, '2024-01-13 02:45:56', 'Super Admin', 'Added Administrator: Conan Brian', NULL, 0),
(211, '2024-01-13 02:47:12', 'Super Admin', 'Logged out', NULL, 0),
(212, '2024-01-13 02:47:20', 'Conan Brian', 'Logged in', 22, 0),
(213, '2024-01-13 02:47:33', 'Super Admin', 'Logged in', NULL, 0),
(214, '2024-01-13 02:50:00', 'Super Admin', 'Added transaction of West Viriginia with Bill Number: 1510390405', NULL, 0),
(215, '2024-01-13 02:54:01', 'Super Admin', 'Updated Condominium: West Viriginia', NULL, 0),
(216, '2024-01-13 02:54:11', 'Super Admin', 'Updated Condominium: West Viriginia', NULL, 0),
(217, '2024-01-13 02:54:15', 'Super Admin', 'Updated Condominium: West Viriginia', NULL, 0),
(218, '2024-01-13 02:54:19', 'Super Admin', 'Updated Condominium: West Viriginia', NULL, 0),
(219, '2024-01-13 02:56:18', 'Super Admin', 'Updated Administrator: Conan Barbarian', NULL, 0),
(220, '2024-01-13 02:59:17', 'Super Admin', 'Updated transaction of West Viriginia with Bill Number: 1510390405', NULL, 0),
(221, '2024-01-13 02:59:26', 'Super Admin', 'Updated transaction of West Viriginia with Bill Number: 1510390405', NULL, 0),
(222, '2024-01-13 03:00:10', 'Super Admin', 'Logged out', NULL, 0),
(223, '2024-01-13 03:01:47', 'Super Admin', 'Logged in', NULL, 0),
(224, '2024-01-13 03:01:51', 'Super Admin', 'Logged out', NULL, 0),
(225, '2024-01-13 03:02:07', 'Elon Musk', 'Logged in', 1, 0),
(226, '2024-01-13 03:02:17', 'Dwayne Johnson', 'Logged in', 1, 0),
(227, '2024-01-13 03:04:29', 'Dwayne Johnson', 'Added visitor: Jason Vorhees', 1, 0),
(228, '2024-01-13 03:07:01', 'Dwayne Johnson', 'Updated visitor: Jason Vorhees XIII', 1, 0),
(229, '2024-01-13 03:07:32', 'Dwayne Johnson', 'Logged out', 1, 0),
(230, '2024-01-13 03:15:22', 'Elon Musk', 'Logged in', 1, 0),
(231, '2024-01-13 03:28:37', 'Elon Musk', 'Logged out', 1, 0),
(232, '2024-01-13 03:28:55', 'Elon Musk', 'Logged in', 1, 0),
(233, '2024-01-13 03:29:14', 'Elon Musk', 'Logged out', 1, 0),
(234, '2024-01-13 03:29:53', 'Elon Musk', 'Logged in', 1, 0),
(235, '2024-01-13 03:30:07', 'Elon Musk', 'Logged out', 1, 0),
(236, '2024-01-13 03:30:16', 'Dwayne Johnson', 'Logged in', 1, 0),
(237, '2024-01-13 03:30:21', 'Dwayne Johnson', 'Logged out', 1, 0),
(238, '2024-01-13 03:31:20', 'Dwayne Johnson', 'Logged in', 1, 0),
(239, '2024-01-13 03:31:37', 'Dwayne Johnson', 'Logged out', 1, 0),
(282, '2024-01-13 04:50:45', 'Super Admin', 'Logged in', NULL, 0),
(283, '2024-01-13 04:51:00', 'Super Admin', 'Added Condominium: Little America', NULL, 0),
(284, '2024-01-13 04:51:05', 'Super Admin', 'Updated Condominium: Little America', NULL, 0),
(287, '2024-01-13 04:51:58', 'Super Admin', 'Added Administrator: George Washington', NULL, 0),
(288, '2024-01-13 04:52:26', 'Super Admin', 'Updated Administrator: George Washington', NULL, 0),
(293, '2024-01-13 04:53:20', 'Super Admin', 'Added transaction of Little America with Bill Number: 1169611717', NULL, 0),
(294, '2024-01-13 04:54:02', 'Super Admin', 'Updated transaction of Little America with Bill Number: 1169611717', NULL, 0),
(295, '2024-01-13 04:54:19', 'Super Admin', 'Deleted transaction of Little America with Bill Number: 1169611717', NULL, 0),
(296, '2024-01-13 04:54:58', 'Super Admin', 'Logged out', NULL, 0),
(297, '2024-01-13 04:55:03', 'George Washington', 'Logged in', 23, 0),
(298, '2024-01-13 04:55:33', 'George Washington', 'Logged out', 23, 0),
(299, '2024-01-13 04:55:44', 'Elon Musk', 'Logged in', 1, 0),
(300, '2024-01-13 04:56:26', 'Elon Musk', 'Added Resident: Benjamin Franklin', 1, 0),
(301, '2024-01-13 04:56:35', 'Elon Musk', 'Updated Resident: Benjamin Franklin', 1, 0),
(302, '2024-01-13 04:57:11', 'Elon Musk', 'Logged out', 1, 0),
(303, '2024-01-13 04:57:18', 'Elon Musk', 'Logged in', 1, 0),
(310, '2024-01-13 05:01:13', 'Elon Musk', 'Updated Resident: Benjamin Franklin', 1, 0),
(311, '2024-01-13 05:01:20', 'Elon Musk', 'Updated Resident: Benjamin Franklin X', 1, 0),
(318, '2024-01-13 05:03:30', 'Elon Musk', 'Logged out', 1, 0),
(319, '2024-01-13 05:04:31', 'Elon Musk', 'Logged in', 1, 0),
(320, '2024-01-13 05:11:58', 'Elon Musk', 'Logged out', 1, 0),
(321, '2024-01-13 05:12:46', 'Super Admin', 'Logged in', NULL, 0),
(322, '2024-01-13 05:12:54', 'Super Admin', 'Logged out', NULL, 0),
(323, '2024-01-13 05:13:02', 'Elon Musk', 'Logged in', 1, 0),
(324, '2024-01-13 05:13:08', 'Elon Musk', 'Logged out', 1, 0),
(325, '2024-01-13 05:17:25', 'Elon Musk', 'Logged in', 1, 0),
(326, '2024-01-13 05:17:51', 'Elon Musk', 'Added Resident: Sam Adams', 1, 0),
(327, '2024-01-13 05:17:57', 'Elon Musk', 'Updated Resident: Sam Adams', 1, 0),
(328, '2024-01-13 05:18:02', 'Elon Musk', 'Updated Resident: Samuel Adams', 1, 0),
(332, '2024-01-13 05:18:35', 'Elon Musk', 'Logged out', 1, 0),
(333, '2024-01-13 05:18:42', 'Samuel Adams', 'Logged in', 1, 0),
(334, '2024-01-13 05:18:46', 'Samuel Adams', 'Logged in', 1, 0),
(335, '2024-01-13 05:18:50', 'Samuel Adams', 'Logged in', 1, 0),
(336, '2024-01-13 05:18:57', 'Elon Musk', 'Logged in', 1, 0),
(338, '2024-01-13 05:19:01', 'Elon Musk', 'Logged out', 1, 0),
(340, '2024-01-13 05:19:26', 'Elon Musk', 'Logged in', 1, 0),
(341, '2024-01-13 05:19:57', 'Elon Musk', 'Logged out', 1, 0),
(342, '2024-01-13 06:05:15', 'Super Admin', 'Logged in', NULL, 0),
(343, '2024-01-13 07:02:01', 'Super Admin', 'Updated Condominium: Casa Bougainvilla', NULL, 0),
(344, '2024-01-13 07:05:00', 'Super Admin', 'Updated Condominium: Casa Salamanca', NULL, 0),
(345, '2024-01-13 07:05:13', 'Super Admin', 'Updated Condominium: Pinkerton Condominium', NULL, 0),
(346, '2024-01-13 07:05:31', 'Super Admin', 'Updated Condominium: Little America', NULL, 0),
(347, '2024-01-13 07:05:43', 'Super Admin', 'Updated Condominium: Trump Tower', NULL, 0),
(348, '2024-01-13 07:05:57', 'Super Admin', 'Updated Condominium: West Viriginia', NULL, 0),
(349, '2024-01-13 08:27:00', 'Super Admin', 'Logged in', NULL, 0),
(350, '2024-01-13 10:10:17', 'Super Admin', 'Updated Condominium: Casa Salamanca', NULL, 0),
(351, '2024-01-13 11:29:40', 'Super Admin', 'Updated Condominium: Casa Salamanca', NULL, 0),
(352, '2024-01-13 11:44:44', 'Super Admin', 'Added Condominium: Ang Tahanan', NULL, 0),
(423, '2024-01-15 12:46:30', 'Elon Musk', 'Suspended Resident: Benedict Arnold. Reason: Failed to pay for the month of January', 1, 0),
(424, '2024-01-15 12:46:39', 'Elon Musk', 'Reinstated Resident: Benedict Arnold', 1, 0),
(425, '2024-01-15 12:47:36', 'Elon Musk', 'Added Resident: Andrew Jackson', 1, 0),
(426, '2024-01-15 12:47:51', 'Elon Musk', 'Updated Resident: Andrew Jackson IV', 1, 0),
(427, '2024-01-15 12:48:13', 'Elon Musk', 'Suspended Resident: Andrew Jackson IV. Reason: Failed to pay for the month of february', 1, 0),
(428, '2024-01-15 12:48:23', 'Elon Musk', 'Reinstated Resident: Andrew Jackson IV', 1, 0),
(429, '2024-01-15 12:48:33', 'Elon Musk', 'Logged out', 1, 0),
(430, '2024-01-15 12:49:12', 'Super Admin', 'Logged in', NULL, 0),
(443, '2024-01-15 13:01:17', 'Super Admin', 'Added Condominium: New Arizona', NULL, 0),
(444, '2024-01-15 13:03:29', 'Super Admin', 'Updated Condominium: New Arizona', NULL, 0),
(445, '2024-01-15 13:04:00', 'Super Admin', 'Suspended Condominium: New Arizona. Reason: failed to pay at the month of may', NULL, 0),
(446, '2024-01-15 13:04:09', 'Super Admin', 'Reinstated Condominium: New Arizona', NULL, 0),
(447, '2024-01-15 13:10:24', 'Super Admin', 'Added Administrator: Jimmy Carter', NULL, 0),
(448, '2024-01-15 13:10:41', 'Super Admin', 'Updated Administrator: Jimmy Carter X', NULL, 0),
(449, '2024-01-15 13:11:32', 'Super Admin', 'Suspended Administrator: Jimmy Carter X. Reason: failed to pay for the month of august', NULL, 0),
(450, '2024-01-15 13:11:44', 'Super Admin', 'Reinstated Administrator: Jimmy Carter X', NULL, 0),
(451, '2024-01-15 13:13:35', 'Super Admin', 'Added transaction of New Arizona with Bill Number: 1485088834', NULL, 0),
(452, '2024-01-15 13:13:44', 'Super Admin', 'Updated transaction of New Arizona with Bill Number: 1485088834', NULL, 0),
(453, '2024-01-15 13:13:58', 'Super Admin', 'Deleted transaction of New Arizona with Bill Number: 1485088834', NULL, 0),
(454, '2024-01-15 13:14:38', 'Super Admin', 'Logged out', NULL, 0),
(455, '2024-01-15 13:14:46', 'Elon Musk', 'Logged in', 1, 0),
(456, '2024-01-15 13:15:16', 'Elon Musk', 'Added Resident: Nicholas Sasque', 1, 0),
(457, '2024-01-15 13:15:34', 'Elon Musk', 'Updated Resident: Nicholas Sasquer', 1, 0),
(458, '2024-01-15 13:15:41', 'Elon Musk', 'Updated Resident: Nicholas Sasquer', 1, 0),
(459, '2024-01-15 13:16:08', 'Elon Musk', 'Suspended Resident: Nicholas Sasquer. Reason: failed to pay for the month of june', 1, 0),
(460, '2024-01-15 13:16:15', 'Elon Musk', 'Reinstated Resident: Nicholas Sasquer', 1, 0),
(461, '2024-01-15 13:17:11', 'Elon Musk', 'Logged out', 1, 0),
(462, '2024-01-15 13:17:19', 'Dwayne Johnson', 'Logged in', 1, 0),
(463, '2024-01-15 13:18:10', 'Dwayne Johnson', 'Added visitor: James Read', 1, 0),
(464, '2024-01-15 13:18:23', 'Dwayne Johnson', 'Updated visitor: James Read', 1, 0),
(465, '2024-01-15 13:18:33', 'Dwayne Johnson', 'Deleted visitor: James Read', 1, 0),
(466, '2024-01-15 13:18:42', 'Dwayne Johnson', 'Logged out', 1, 0),
(467, '2024-01-15 13:21:15', 'Super Admin', 'Logged in', NULL, 0),
(468, '2024-01-15 13:22:51', 'Super Admin', 'Logged out', NULL, 0),
(469, '2024-01-15 13:23:00', 'Elon Musk', 'Logged in', 1, 0),
(474, '2024-01-15 15:28:05', 'Elon Musk', 'Added transaction of Tom Cruise with Bill Number: 1664288929', 1, 0),
(475, '2024-01-15 15:28:59', 'Elon Musk', 'Added transaction of John Cena with Bill Number: 1767165030', 1, 0),
(477, '2024-01-15 16:16:23', 'Elon Musk', 'Updated transaction for resident: Tom Cruise with Bill Number: 1767165030', 1, 0),
(478, '2024-01-15 16:17:27', 'Elon Musk', 'Updated transaction for resident: Benedict Arnold with Bill Number: 1767165030', 1, 0),
(487, '2024-01-15 16:59:45', 'Elon Musk', 'Updated transaction for resident: Marty McFry III with Bill Number: 1767165030', 1, 0),
(488, '2024-01-15 17:00:00', 'Elon Musk', 'Updated transaction for resident: Marty McFry III with Bill Number: 1767165030', 1, 0),
(489, '2024-01-15 17:00:12', 'Elon Musk', 'Deleted transaction of Marty McFry III with Bill Number: 1767165030', 1, 0),
(490, '2024-01-15 17:01:26', 'Elon Musk', 'Added transaction of Samuel Adams with Bill Number: 1191966442', 1, 0),
(491, '2024-01-15 17:01:32', 'Elon Musk', 'Updated transaction for resident: Samuel Adams with Bill Number: 1191966442', 1, 0),
(492, '2024-01-15 17:01:40', 'Elon Musk', 'Deleted transaction of Samuel Adams with Bill Number: 1191966442', 1, 0),
(493, '2024-01-15 17:02:02', 'Elon Musk', 'Added Resident: Jimmy Fallon', 1, 0),
(494, '2024-01-15 17:02:16', 'Elon Musk', 'Suspended Resident: Jimmy Fallon. Reason: failed to pay for the month of may', 1, 0),
(495, '2024-01-15 17:02:23', 'Elon Musk', 'Reinstated Resident: Jimmy Fallon', 1, 0),
(496, '2024-01-15 17:02:29', 'Elon Musk', 'Logged out', 1, 0),
(497, '2024-01-15 17:02:54', 'Super Admin', 'Logged in', NULL, 0),
(498, '2024-01-15 17:03:43', 'Super Admin', 'Added Condominium: California', NULL, 0),
(499, '2024-01-15 17:03:54', 'Super Admin', 'Updated Condominium: California', NULL, 0),
(500, '2024-01-15 17:04:03', 'Super Admin', 'Updated Condominium: California', NULL, 0),
(501, '2024-01-15 17:04:20', 'Super Admin', 'Suspended Condominium: California. Reason: failed to pay for the month of february', NULL, 0),
(502, '2024-01-15 17:04:24', 'Super Admin', 'Reinstated Condominium: California', NULL, 0),
(503, '2024-01-15 17:04:53', 'Super Admin', 'Added Administrator: Otto Bismarck', NULL, 0),
(504, '2024-01-15 17:05:01', 'Super Admin', 'Updated Administrator: Otto Bismarck', NULL, 0),
(505, '2024-01-15 17:05:11', 'Super Admin', 'Suspended Administrator: Otto Bismarck. Reason: failed to pay at the month of march', NULL, 0),
(506, '2024-01-15 17:05:17', 'Super Admin', 'Reinstated Administrator: Otto Bismarck', NULL, 0),
(507, '2024-01-15 17:05:48', 'Super Admin', 'Added transaction of Casa Salamanca with Bill Number: 1211644703', NULL, 0),
(508, '2024-01-15 17:05:52', 'Super Admin', 'Updated transaction of Casa Salamanca with Bill Number: 1211644703', NULL, 0),
(509, '2024-01-15 17:06:03', 'Super Admin', 'Deleted transaction of Casa Salamanca with Bill Number: 1211644703', NULL, 0),
(510, '2024-01-15 17:06:11', 'Super Admin', 'Logged out', NULL, 0),
(511, '2024-01-15 17:13:07', 'John Cena', 'Logged in', 1, 0),
(512, '2024-01-15 17:14:14', 'Elon Musk', 'Logged in', 1, 0),
(513, '2024-01-15 17:14:18', 'Elon Musk', 'Logged out', 1, 0),
(514, '2024-01-22 11:04:27', 'Super Admin', 'Logged in', NULL, 0),
(515, '2024-01-22 14:03:00', 'Super Admin', 'Suspended Condominium: Casa Salamanca. Reason: Breach of Contract', NULL, 0),
(516, '2024-01-22 14:03:05', 'Super Admin', 'Reinstated Condominium: Casa Salamanca', NULL, 0),
(517, '2024-01-22 14:32:18', 'Super Admin', 'Suspended Condominium: Casa Salamanca. Reason: Breach of Contract', NULL, 0),
(518, '2024-01-22 14:32:32', 'Super Admin', 'Reinstated Condominium: Casa Salamanca. Reason: Contract Renewed', NULL, 0),
(519, '2024-01-22 15:13:18', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees', NULL, 0),
(520, '2024-01-22 15:17:06', 'Super Admin', 'Reinstated Administrator: Jimmy Gibbs Jr.', NULL, 0),
(521, '2024-01-22 15:17:21', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees', NULL, 0),
(522, '2024-01-22 15:18:01', 'Super Admin', 'Reinstated Administrator: Jimmy Gibbs Jr.', NULL, 0),
(523, '2024-01-22 15:22:18', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees', NULL, 0),
(524, '2024-01-22 15:22:48', 'Super Admin', 'Reinstated Administrator: Morgan Freeman. Reason: Paid on February', NULL, 0),
(525, '2024-01-22 15:30:32', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees for the Month of January', NULL, 0),
(526, '2024-01-22 15:30:49', 'Super Admin', 'Reinstated Administrator: Jimmy Gibbs Jr.. Reason: Paid on February', NULL, 0),
(527, '2024-01-22 15:33:30', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees for the Month of March', NULL, 0),
(528, '2024-01-22 15:33:39', 'Super Admin', 'Reinstated Administrator: Morgan Freeman. Reason: Paid on April', NULL, 0),
(529, '2024-01-22 15:35:55', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees for the Month of August', NULL, 0),
(530, '2024-01-22 15:36:05', 'Super Admin', 'Reinstated Administrator: Otto Bismarck. Reason: Paid in September', NULL, 0),
(531, '2024-01-22 15:40:08', 'Super Admin', 'Suspended Administrator: Jimmy Carter X. Reason: Non-Payment of Fees for the Month of November', NULL, 0),
(532, '2024-01-22 15:40:19', 'Super Admin', 'Logged out', NULL, 0),
(533, '2024-01-22 15:40:32', 'Super Admin', 'Logged in', NULL, 0),
(534, '2024-01-22 15:40:49', 'Super Admin', 'Reinstated Administrator: Jimmy Carter X. Reason: Paid in December', NULL, 0),
(535, '2024-01-22 15:42:10', 'Super Admin', 'Suspended Administrator: Hank Schrader. Reason: Expired Contract', NULL, 0),
(536, '2024-01-22 15:42:30', 'Super Admin', 'Reinstated Administrator: Hank Schrader. Reason: Renewed contract', NULL, 0),
(537, '2024-01-22 15:58:10', 'Super Admin', 'Suspended Administrator: Otto Bismarck. Reason: Non-Payment of Fees for the Month of January', NULL, 0),
(538, '2024-01-22 15:58:38', 'Super Admin', 'Reinstated Administrator: Otto Bismarck. Reason: Paid on February', NULL, 0),
(539, '2024-01-22 16:01:09', 'Super Admin', 'Suspended Administrator: Conan Barbarian. Reason: Non-Payment of Fees for the Month of June', NULL, 0),
(540, '2024-01-22 16:04:04', 'Super Admin', 'Reinstated Administrator: Conan Barbarian. Reason: Paid in July', NULL, 0),
(541, '2024-01-22 16:06:35', 'Super Admin', 'Suspended Administrator: Jimmy Carter X. Reason: Non-Payment of Fees for the Month of November', NULL, 0),
(542, '2024-01-22 16:07:23', 'Super Admin', 'Reinstated Administrator: Jimmy Carter X. Reason: Paid in December', NULL, 0),
(543, '2024-01-22 16:09:10', 'Super Admin', 'Suspended Administrator: Daryl Sarmiento. Reason: Out of Reach', NULL, 0),
(544, '2024-01-22 16:09:32', 'Super Admin', 'Reinstated Administrator: Daryl Sarmiento. Reason: Established connection again', NULL, 0),
(545, '2024-01-24 04:24:11', 'Super Admin', 'Logged in', NULL, 0),
(546, '2024-01-24 04:25:03', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1579434797', NULL, 0),
(547, '2024-01-24 04:25:27', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1110782496', NULL, 0),
(548, '2024-01-24 04:26:11', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1368997250', NULL, 0),
(549, '2024-01-24 04:26:45', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1147911760', NULL, 0),
(550, '2024-01-24 04:27:19', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 2027138614', NULL, 0),
(551, '2024-01-24 04:28:22', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1624999527', NULL, 0),
(552, '2024-01-24 04:28:28', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1624999527', NULL, 0),
(553, '2024-01-24 04:29:14', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1920125792', NULL, 0),
(554, '2024-01-24 04:29:39', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1124946631', NULL, 0),
(555, '2024-01-24 04:30:10', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 2116930269', NULL, 0),
(556, '2024-01-24 04:30:51', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(557, '2024-01-24 04:31:34', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(558, '2024-01-24 04:31:43', 'Super Admin', 'Logged out', NULL, 0),
(559, '2024-01-24 04:31:54', 'Elon Musk', 'Logged in', 1, 0),
(560, '2024-01-24 04:32:50', 'Elon Musk', 'Logged out', 1, 0),
(561, '2024-01-24 04:33:00', 'Super Admin', 'Logged in', NULL, 0),
(562, '2024-01-24 04:33:48', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1579434797', NULL, 0),
(563, '2024-01-24 04:33:51', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1110782496', NULL, 0),
(564, '2024-01-24 04:33:53', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1368997250', NULL, 0),
(565, '2024-01-24 04:33:55', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1147911760', NULL, 0),
(566, '2024-01-24 04:33:58', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2027138614', NULL, 0),
(567, '2024-01-24 04:34:00', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1920125792', NULL, 0),
(568, '2024-01-24 04:34:06', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1624999527', NULL, 0),
(569, '2024-01-24 04:34:10', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1124946631', NULL, 0),
(570, '2024-01-24 04:34:12', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2116930269', NULL, 0),
(571, '2024-01-24 04:34:15', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(572, '2024-01-24 04:34:22', 'Super Admin', 'Logged out', NULL, 0),
(573, '2024-01-24 04:34:33', 'Elon Musk', 'Logged in', 1, 0),
(574, '2024-01-24 04:54:50', 'Elon Musk', 'Logged out', 1, 0),
(591, '2024-01-28 14:22:40', 'Elon Musk', 'Logged in', 1, 0),
(592, '2024-01-28 14:24:55', 'Elon Musk', 'Added transaction of Marty McFry III with Bill Number: 1610255313', 1, 0),
(593, '2024-01-28 14:25:24', 'Elon Musk', 'Added transaction of Tom Cruise with Bill Number: 1279789165', 1, 0),
(594, '2024-01-28 14:25:43', 'Elon Musk', 'Updated transaction for resident: Tom Cruise with Bill Number: 1279789165', 1, 0),
(595, '2024-01-28 14:25:49', 'Elon Musk', 'Updated transaction for resident: Tom Cruise with Bill Number: 1279789165', 1, 0),
(596, '2024-01-28 14:26:31', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', 1, 0),
(597, '2024-01-28 14:26:31', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', NULL, 0),
(598, '2024-01-28 14:26:45', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', 1, 0),
(599, '2024-01-28 14:26:45', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', NULL, 0),
(600, '2024-01-28 15:00:56', 'Elon Musk', 'Logged out', 1, 0),
(601, '2024-01-28 15:01:28', 'Super Admin', 'Logged in', NULL, 0),
(602, '2024-01-28 15:01:35', 'Super Admin', 'Logged out', NULL, 0),
(603, '2024-01-28 15:02:01', 'Dwayne Johnson', 'Logged in', 1, 0),
(604, '2024-01-28 15:03:26', 'Dwayne Johnson', 'Logged out', 1, 0),
(605, '2024-01-28 15:04:19', 'Elon Musk', 'Logged in', 1, 0),
(606, '2024-01-28 15:10:38', 'Elon Musk', 'Logged out', 1, 0),
(607, '2024-01-28 15:12:04', 'Elon Musk', 'Logged in', 1, 0),
(609, '2024-01-28 16:09:10', 'Elon Musk', 'Added Unit: 102', 1, 0),
(610, '2024-01-28 16:11:07', 'Elon Musk', 'Added Unit: 103', 1, 0),
(612, '2024-01-28 16:11:23', 'Elon Musk', 'Added Unit: 103', 1, 0),
(613, '2024-01-28 16:11:37', 'Elon Musk', 'Added Unit: 104', 1, 0),
(614, '2024-01-28 16:11:46', 'Elon Musk', 'Added Unit: 105', 1, 0),
(615, '2024-01-28 16:11:53', 'Elon Musk', 'Added Unit: 106', 1, 0),
(616, '2024-01-28 16:12:02', 'Elon Musk', 'Added Unit: 107', 1, 0),
(621, '2024-01-28 17:02:46', 'Elon Musk', 'Added Unit: 101', 1, 0),
(622, '2024-01-28 17:04:17', 'Elon Musk', 'Added Unit: 101', 1, 0),
(623, '2024-01-28 17:04:29', 'Elon Musk', 'Added Unit: 102', 1, 0),
(624, '2024-01-28 17:07:58', 'Elon Musk', 'Added Unit: 101', 1, 0),
(625, '2024-01-28 17:09:06', 'Elon Musk', 'Added Unit: 101', 1, 0),
(627, '2024-01-28 17:14:07', 'Elon Musk', 'Deleted Unit 101', 1, 0),
(628, '2024-01-28 17:34:42', 'Elon Musk', 'Added Unit: 102', 1, 0),
(629, '2024-01-28 17:38:57', 'Elon Musk', 'Added Unit: 103', 1, 0),
(630, '2024-01-28 17:42:10', 'Elon Musk', 'Added Unit: 104', 1, 0),
(631, '2024-01-28 17:46:34', 'Elon Musk', 'Added Unit: 105', 1, 0),
(632, '2024-01-28 17:46:46', 'Elon Musk', 'Added Unit: 106', 1, 0),
(633, '2024-01-28 17:50:17', 'Elon Musk', 'Added Unit: 107', 1, 0),
(635, '2024-01-28 17:52:26', 'Elon Musk', 'Added Unit: 108', 1, 0),
(636, '2024-01-28 17:53:58', 'Elon Musk', 'Added Unit: 1', 1, 0),
(637, '2024-01-28 18:01:53', 'Elon Musk', 'Added Unit: 107', 1, 0),
(638, '2024-01-28 18:02:09', 'Elon Musk', 'Added Unit: 108', 1, 0),
(639, '2024-01-28 18:02:21', 'Elon Musk', 'Added Unit: 109', 1, 0),
(640, '2024-01-28 18:02:44', 'Elon Musk', 'Added Unit: 110', 1, 0),
(641, '2024-01-28 18:02:55', 'Elon Musk', 'Added Unit: 111', 1, 0),
(642, '2024-01-28 18:04:25', 'Elon Musk', 'Deleted Unit 111', 1, 0),
(643, '2024-01-28 18:29:12', 'Elon Musk', 'Added Unit: 112', 1, 0),
(644, '2024-01-28 18:30:41', 'Elon Musk', 'Updated Unit: 112', 1, 0),
(645, '2024-01-28 18:31:05', 'Elon Musk', 'Deleted Unit 112', 1, 0),
(646, '2024-01-28 18:31:38', 'Elon Musk', 'Added Unit: 112', 1, 0),
(647, '2024-01-28 18:32:01', 'Elon Musk', 'Updated Unit: 112', 1, 0),
(648, '2024-01-28 18:33:21', 'Elon Musk', 'Logged out', 1, 0),
(649, '2024-01-28 18:33:45', 'Super Admin', 'Logged in', NULL, 0),
(650, '2024-01-28 18:33:53', 'Super Admin', 'Logged out', NULL, 0),
(651, '2024-01-28 18:34:05', 'Elon Musk', 'Logged in', 1, 0),
(652, '2024-01-28 18:34:18', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', 1, 0),
(653, '2024-01-28 18:34:18', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', NULL, 0),
(654, '2024-01-28 18:34:34', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', 1, 0),
(655, '2024-01-28 18:34:34', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', NULL, 0),
(656, '2024-01-28 18:34:48', 'Elon Musk', 'Logged out', 1, 0),
(657, '2024-01-28 18:35:01', 'Super Admin', 'Logged in', NULL, 0),
(658, '2024-01-28 18:35:32', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(659, '2024-01-28 18:36:00', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(660, '2024-01-28 18:36:26', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(661, '2024-01-28 18:36:49', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(662, '2024-01-28 18:36:59', 'Super Admin', 'Logged out', NULL, 0),
(663, '2024-01-29 03:39:14', 'Super Admin', 'Logged in', NULL, 0),
(664, '2024-01-29 06:11:52', 'Super Admin', 'Logged out', NULL, 0),
(665, '2024-01-29 06:12:15', 'Super Admin', 'Logged in', NULL, 0),
(666, '2024-01-29 07:06:26', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1992699870', NULL, 0),
(667, '2024-01-29 07:32:20', 'Super Admin', 'Logged in', NULL, 0),
(668, '2024-01-29 07:56:32', 'Super Admin', 'Logged out', NULL, 0),
(669, '2024-01-29 07:56:47', 'Elon Musk', 'Logged in', 1, 0),
(670, '2024-01-29 08:16:43', 'Elon Musk', 'Suspended Resident: Jimmy Fallon. Reason: Non-Payment of Fees for the Month of March', 1, 0),
(671, '2024-01-29 08:35:30', 'Elon Musk', 'Suspended Resident: Marty McFry III. Reason: Non-Payment of Fees for the Month of June', 1, 0),
(672, '2024-01-29 08:39:23', 'Elon Musk', 'Logged out', 1, 0),
(673, '2024-01-29 08:39:40', 'Super Admin', 'Logged in', NULL, 0),
(674, '2024-01-29 08:41:41', 'Super Admin', 'Logged out', NULL, 0),
(675, '2024-01-29 08:41:48', 'Elon Musk', 'Logged in', 1, 0),
(676, '2024-01-29 08:54:56', 'Elon Musk', 'Reinstated Resident: Marty McFry III. Reason: Paid on July', 1, 0),
(677, '2024-01-29 08:55:11', 'Elon Musk', 'Reinstated Resident: Jimmy Fallon. Reason: Paid on April', 1, 0),
(678, '2024-01-29 10:09:25', 'Elon Musk', 'Suspended Resident: Jimmy Fallon. Reason: Non-Payment of Fees for the Month of January', 1, 0),
(679, '2024-01-29 10:28:25', 'Elon Musk', 'Logged out', 1, 0),
(680, '2024-01-29 10:28:36', 'Super Admin', 'Logged in', NULL, 0),
(681, '2024-01-29 10:49:47', 'Super Admin', 'Logged in', NULL, 0),
(682, '2024-01-29 10:50:22', 'Super Admin', 'Logged out', NULL, 0),
(683, '2024-01-29 10:50:37', 'Elon Musk', 'Logged in', 1, 0),
(684, '2024-01-29 11:27:44', 'Elon Musk', 'Logged out', 1, 0),
(685, '2024-01-29 11:31:30', 'Elon Musk', 'Logged in', 1, 0),
(686, '2024-01-29 12:07:28', 'Elon Musk', 'Added Front Desk: Cer Spence', 1, 0),
(687, '2024-01-29 12:07:39', 'Elon Musk', 'Logged out', 1, 0),
(688, '2024-01-29 12:07:43', 'Cer Spence', 'Logged in', 1, 0),
(689, '2024-01-29 12:07:52', 'Cer Spence', 'Logged out', 1, 0),
(690, '2024-01-29 12:08:05', 'Elon Musk', 'Logged in', 1, 0),
(691, '2024-01-29 12:15:41', 'Elon Musk', 'Updated Front Desk: Cer Spence', 1, 0),
(692, '2024-01-29 12:15:46', 'Elon Musk', 'Updated Front Desk: Cer Spencer', 1, 0),
(695, '2024-01-29 12:29:51', 'Elon Musk', 'Suspended Front Desk: Cer Spencer. Reason: Non-Payment of Fees for the Month of August', 1, 0),
(696, '2024-01-29 12:30:21', 'Elon Musk', 'Reinstated Front Desk: Cer Spencer. Reason: successfully paid for the month of august', 1, 0),
(697, '2024-01-29 12:31:00', 'Elon Musk', 'Logged out', 1, 0),
(698, '2024-02-07 02:36:48', 'Super Admin', 'Logged in', NULL, 0),
(699, '2024-02-07 02:49:13', 'Super Admin', 'Logged out', NULL, 0),
(700, '2024-02-07 02:49:21', 'Elon Musk', 'Logged in', 1, 0),
(701, '2024-02-07 02:49:25', 'Elon Musk', 'Logged out', 1, 0),
(702, '2024-02-07 02:49:33', 'Elon Musk', 'Logged in', 1, 0),
(703, '2024-02-07 02:52:19', 'Elon Musk', 'Logged out', 1, 0),
(704, '2024-02-07 02:58:27', 'Dwayne Johnson', 'Logged in', 1, 0),
(705, '2024-02-07 02:59:05', 'Dwayne Johnson', 'Added visitor: Elliot Decker', 1, 0),
(706, '2024-02-07 02:59:22', 'Dwayne Johnson', 'Updated visitor: Elliot Decker', 1, 0),
(707, '2024-02-07 02:59:50', 'Dwayne Johnson', 'Logged out', 1, 0),
(708, '2024-02-07 03:00:02', 'Elon Musk', 'Logged in', 1, 0),
(709, '2024-02-07 03:01:15', 'Elon Musk', 'Added Unit: 113', 1, 0),
(710, '2024-02-07 03:01:48', 'Elon Musk', 'Updated Unit: 113', 1, 0),
(711, '2024-02-07 03:02:21', 'Elon Musk', 'Updated Unit: 113', 1, 0),
(712, '2024-02-07 03:02:40', 'Elon Musk', 'Updated Unit: 113', 1, 0),
(713, '2024-02-07 03:02:48', 'Elon Musk', 'Logged out', 1, 0),
(714, '2024-02-07 03:03:59', 'Elon Musk', 'Logged in', 1, 0),
(715, '2024-02-07 03:06:00', 'Elon Musk', 'Logged out', 1, 0),
(716, '2024-02-07 03:06:12', 'Super Admin', 'Logged in', NULL, 0),
(717, '2024-02-07 03:07:03', 'Super Admin', 'Logged out', NULL, 0),
(718, '2024-02-07 03:07:18', 'Elon Musk', 'Logged in', 1, 0),
(719, '2024-02-07 03:07:38', 'Elon Musk', 'Logged out', 1, 0),
(720, '2024-02-07 03:07:49', 'Elon Musk', 'Logged in', 1, 0),
(721, '2024-02-07 03:07:52', 'Elon Musk', 'Logged out', 1, 0),
(722, '2024-02-07 10:22:27', 'Super Admin', 'Deleted Payment of Elon Musk with Bill Number: 2126914746', NULL, 0),
(723, '2024-02-07 10:22:29', 'Super Admin', 'Deleted Payment of Elon Musk with Bill Number: 1507498433', NULL, 0),
(724, '2024-02-07 10:22:33', 'Super Admin', 'Logged out', NULL, 0),
(725, '2024-02-07 10:22:52', 'Elon Musk', 'Logged in', 1, 0),
(726, '2024-02-07 10:27:24', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', 1, 0),
(727, '2024-02-07 10:27:24', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', NULL, 0),
(728, '2024-02-07 10:27:53', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', 1, 0),
(729, '2024-02-07 10:27:53', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', NULL, 0),
(730, '2024-02-07 10:27:58', 'Elon Musk', 'Logged out', 1, 0),
(750, '2024-02-09 06:45:15', 'Super Admin', 'Logged in', NULL, 0),
(751, '2024-02-09 06:45:38', 'Super Admin', 'Logged out', NULL, 0),
(752, '2024-02-09 06:45:47', 'Elon Musk', 'Logged in', 1, 0),
(753, '2024-02-09 06:46:46', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', 1, 0),
(754, '2024-02-09 06:46:46', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', NULL, 0),
(755, '2024-02-09 06:47:03', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', 1, 0),
(756, '2024-02-09 06:47:03', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', NULL, 0),
(757, '2024-02-09 06:52:31', 'Elon Musk', 'Logged out', 1, 0),
(758, '2024-02-09 06:52:41', 'Super Admin', 'Logged in', NULL, 0),
(759, '2024-02-09 09:38:54', 'John Cena', 'Logged out', 1, 0),
(760, '2024-02-09 09:39:03', 'John Cena', 'Logged in', 1, 1425648978),
(761, '2024-02-09 09:39:09', 'John Cena', 'Logged out', 1, 0),
(762, '2024-02-09 09:39:21', 'John Cena', 'Logged in', 1, 1425648978),
(763, '2024-02-09 09:39:24', 'John Cena', 'Logged out', 1, 0),
(764, '2024-02-09 09:40:13', 'Super Admin', 'Logged in', NULL, 0),
(766, '2024-02-09 09:42:09', 'Super Admin', 'Logged out', NULL, 0),
(767, '2024-02-09 09:42:41', 'Elon Musk', 'Logged in', 1, 1315648790),
(768, '2024-02-09 09:42:46', 'Elon Musk', 'Logged out', 1, 0),
(769, '2024-02-09 09:42:54', 'John Cena', 'Logged in', 1, 1425648978),
(777, '2024-02-09 09:56:19', 'John Cena', 'Updated Unit: 107', 1, 1425648978),
(778, '2024-02-09 09:56:35', 'John Cena', 'Updated Unit: 110', 1, 1425648978),
(779, '2024-02-09 09:57:16', 'John Cena', 'Updated Unit: 107', 1, 1425648978),
(780, '2024-02-09 09:57:23', 'John Cena', 'Updated Unit: 110', 1, 1425648978),
(781, '2024-02-09 09:57:26', 'John Cena', 'Updated Unit: 107', 1, 1425648978),
(782, '2024-02-09 10:33:51', 'John Cena', 'Logged out', 1, 0),
(783, '2024-02-09 10:34:07', 'Elon Musk', 'Logged in', 1, 1315648790),
(784, '2024-02-09 10:34:41', 'Elon Musk', 'Logged out', 1, 0),
(785, '2024-02-09 10:34:50', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(787, '2024-02-09 10:35:03', 'Dwayne Johnson', 'Logged out', 1, 0),
(788, '2024-02-09 10:35:11', 'John Cena', 'Logged in', 1, 1425648978),
(790, '2024-02-09 11:01:46', 'John Cena', 'Added transaction of Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(791, '2024-02-09 11:09:12', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(792, '2024-02-09 11:12:10', 'John Cena', 'Updated Unit: 110', 1, 1425648978),
(793, '2024-02-09 11:12:30', 'John Cena', 'Updated Unit: 110', 1, 1425648978),
(794, '2024-02-09 11:12:54', 'John Cena', 'Updated Unit: 110', 1, 1425648978),
(795, '2024-02-09 11:46:55', 'John Cena', 'Logged out', 1, 0),
(796, '2024-02-09 11:47:06', 'Super Admin', 'Logged in', NULL, 0),
(797, '2024-02-09 11:48:37', 'Super Admin', 'Logged out', NULL, 0),
(798, '2024-02-09 11:48:46', 'Elon Musk', 'Logged in', 1, 1315648790),
(799, '2024-02-09 11:51:10', 'Elon Musk', 'Deleted transaction of Marty McFry III with Bill Number: 1610255313', 1, 0),
(800, '2024-02-09 11:53:23', 'Elon Musk', 'Logged out', 1, 0),
(801, '2024-02-09 11:53:34', 'John Cena', 'Logged in', 1, 1425648978),
(802, '2024-02-09 11:56:00', 'John Cena', 'Updated Unit: 107', 1, 1425648978),
(804, '2024-02-09 12:08:31', 'John Cena', 'Deleted transaction of Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(805, '2024-02-09 12:08:33', 'John Cena', 'Deleted transaction of Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(806, '2024-02-13 17:14:48', 'Elon Musk', 'Logged in', 1, 1315648790),
(807, '2024-02-13 17:20:17', 'Elon Musk', 'Logged out', 1, 1315648790),
(808, '2024-02-13 17:20:26', 'John Cena', 'Logged in', 1, 1425648978),
(809, '2024-02-13 17:20:44', 'John Cena', 'Added Tenant: Collin Hugh', 1, 1425648978),
(810, '2024-02-13 17:24:41', 'John Cena', 'Updated Tenant: Collin Hughes', 1, 1425648978),
(811, '2024-02-13 17:28:41', 'John Cena', 'Suspended Tenant: Collin Hughes. Reason: Non-Payment of Fees for the Month of July', 1, 1425648978),
(812, '2024-02-13 17:51:37', 'John Cena', 'John Cena submitted payment with Bill Number: 1664288929', 1, 1425648978),
(813, '2024-02-13 17:51:37', 'John Cena', 'John Cena submitted payment with Bill Number: 1664288929', 1, 0),
(814, '2024-02-13 17:58:08', 'John Cena', 'Logged out', 1, 1425648978),
(815, '2024-02-13 17:58:54', 'Super Admin', 'Logged in', NULL, 0),
(816, '2024-02-13 18:00:30', 'Super Admin', 'Logged out', NULL, 0),
(817, '2024-02-13 18:00:38', 'Elon Musk', 'Logged in', 1, 1315648790),
(820, '2024-02-13 18:31:48', 'Elon Musk', 'Deleted Payment of John Cena with Bill Number: 1664288929', 1, 1315648790),
(821, '2024-02-13 18:39:39', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(822, '2024-02-13 18:40:23', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Unverified', 1, 1315648790),
(823, '2024-02-13 18:41:01', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(824, '2024-02-13 18:41:21', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Unverified', 1, 1315648790),
(825, '2024-02-13 18:41:32', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 0),
(826, '2024-02-13 18:41:46', 'Elon Musk', 'Updated transaction for resident: Tom Cruise with Bill Number: 1279789165', 1, 0),
(827, '2024-02-13 18:42:42', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 0),
(828, '2024-02-13 18:42:44', 'Elon Musk', 'Updated transaction for resident: Tom Cruise with Bill Number: 1279789165', 1, 0),
(829, '2024-02-13 18:42:51', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(830, '2024-02-13 18:43:00', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 0),
(831, '2024-02-13 18:43:31', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Unverified', 1, 1315648790),
(832, '2024-02-13 18:43:38', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(833, '2024-02-13 18:45:54', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Unverified', 1, 1315648790),
(834, '2024-02-13 18:45:59', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(835, '2024-02-13 18:46:03', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 0),
(836, '2024-02-13 18:46:26', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(837, '2024-02-13 18:46:35', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 0),
(838, '2024-02-13 18:46:40', 'Elon Musk', 'Logged out', 1, 1315648790),
(839, '2024-02-13 18:50:05', 'Elon Musk', 'Logged in', 1, 1315648790),
(840, '2024-02-13 18:50:19', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(841, '2024-02-13 18:50:25', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Unverified', 1, 1315648790),
(842, '2024-02-13 18:50:32', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(843, '2024-02-13 18:50:51', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Unverified', 1, 1315648790),
(844, '2024-02-13 18:50:55', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(845, '2024-02-13 18:51:39', 'Elon Musk', 'Logged out', 1, 1315648790),
(846, '2024-02-13 18:51:46', 'John Cena', 'Logged in', 1, 1425648978),
(847, '2024-02-13 18:52:00', 'John Cena', 'Updated Unit: 110', 1, 1425648978),
(848, '2024-02-13 18:52:34', 'John Cena', 'Logged out', 1, 1425648978),
(849, '2024-02-13 18:53:16', 'Super Admin', 'Logged in', NULL, 0),
(850, '2024-02-13 18:53:17', 'Super Admin', 'Logged out', NULL, 0),
(852, '2024-02-13 19:02:19', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(853, '2024-02-13 19:02:58', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(854, '2024-02-13 19:40:28', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 2011218909', 1, 1603909324),
(855, '2024-02-13 19:40:28', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 2011218909', 1, 0),
(856, '2024-02-13 19:45:13', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(857, '2024-02-13 19:45:38', 'Elon Musk', 'Logged in', 1, 1315648790),
(858, '2024-02-13 19:45:57', 'Elon Musk', 'Logged out', 1, 1315648790),
(859, '2024-02-13 19:46:07', 'John Cena', 'Logged in', 1, 1425648978),
(860, '2024-02-13 19:52:40', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(861, '2024-02-13 19:53:59', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(862, '2024-02-13 19:54:09', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(863, '2024-02-13 19:54:20', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(864, '2024-02-13 19:55:10', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(865, '2024-02-13 19:55:16', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(866, '2024-02-13 19:55:27', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(867, '2024-02-13 19:55:42', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(868, '2024-02-13 19:55:51', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(869, '2024-02-13 19:56:24', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(870, '2024-02-13 19:56:43', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(871, '2024-02-13 19:56:47', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(872, '2024-02-13 19:57:20', 'John Cena', 'Deleted Payment of Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(873, '2024-02-13 19:59:04', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(874, '2024-02-13 19:59:09', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(875, '2024-02-13 20:00:05', 'John Cena', 'Logged out', 1, 1425648978),
(876, '2024-02-13 20:03:59', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(880, '2024-02-13 20:15:45', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(881, '2024-02-13 20:19:18', 'Super Admin', 'Logged in', NULL, 0),
(882, '2024-02-13 20:19:52', 'Super Admin', 'Logged out', NULL, 0),
(883, '2024-02-13 20:25:01', 'Super Admin', 'Logged in', NULL, 0),
(884, '2024-02-13 20:25:37', 'Super Admin', 'Logged out', NULL, 0),
(885, '2024-02-13 20:28:49', 'Super Admin', 'Logged in', NULL, 0),
(886, '2024-02-13 20:29:23', 'Super Admin', 'Logged out', NULL, 0),
(887, '2024-02-13 20:37:35', 'John Cena', 'Logged in', 1, 1425648978),
(888, '2024-02-13 20:38:03', 'John Cena', 'Logged out', 1, 1425648978),
(889, '2024-02-13 20:40:39', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(890, '2024-02-13 20:41:02', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(891, '2024-02-14 06:37:14', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(892, '2024-02-14 06:38:32', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(893, '2024-02-14 06:39:05', 'Elon Musk', 'Logged in', 1, 1315648790),
(894, '2024-02-14 06:39:35', 'Elon Musk', 'Logged out', 1, 1315648790),
(895, '2024-02-14 06:40:07', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(896, '2024-02-14 06:40:51', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(897, '2024-02-14 06:41:06', 'John Cena', 'Logged in', 1, 1425648978),
(898, '2024-02-14 06:42:03', 'John Cena', 'Logged out', 1, 1425648978),
(899, '2024-02-14 06:42:16', 'Super Admin', 'Logged in', NULL, 0),
(900, '2024-02-14 06:43:09', 'Super Admin', 'Logged out', NULL, 0);

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
(13, 1315648790, 'Casa Bougainvilla', '1579434797', '2024-01-01', '2024-01-31', '2024-02-10', '1000.00', 'Paid', 0),
(14, 1315648790, 'Casa Bougainvilla', '1110782496', '2024-02-01', '2024-02-29', '2024-03-10', '2000.00', 'Paid', 0),
(15, 1315648790, 'Casa Bougainvilla', '1368997250', '2024-03-01', '2024-03-31', '2024-04-10', '3000.00', 'Paid', 0),
(16, 1315648790, 'Casa Bougainvilla', '1147911760', '2024-04-01', '2024-04-30', '2024-05-10', '4000.00', 'Paid', 0),
(17, 1315648790, 'Casa Bougainvilla', '2027138614', '2024-06-01', '2024-06-30', '2024-07-10', '5000.00', 'Paid', 0),
(18, 1315648790, 'Casa Bougainvilla', '1624999527', '2024-07-01', '2024-07-31', '2024-08-10', '6000.00', 'Paid', 0),
(19, 1315648790, 'Casa Bougainvilla', '1920125792', '2024-08-01', '2024-08-31', '2024-09-10', '7000.00', 'Paid', 0),
(20, 1315648790, 'Casa Bougainvilla', '1124946631', '2024-09-01', '2024-09-30', '2024-10-10', '8000.00', 'Paid', 0),
(21, 1315648790, 'Casa Bougainvilla', '2116930269', '2024-10-01', '2024-10-31', '2024-11-10', '9000.00', 'Paid', 0),
(22, 1315648790, 'Casa Bougainvilla', '1507498433', '2024-11-01', '2024-01-31', '2024-12-10', '10000.00', 'Pending', 0),
(23, 1315648790, 'Casa Bougainvilla', '2126914746', '2024-12-01', '2024-12-31', '2024-01-10', '11000.00', 'Pending', 0),
(24, 1315648790, 'Casa Bougainvilla', '1992699870', '2024-01-01', '2024-01-31', '2024-02-17', '3000.00', 'Paid', 0);

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
  `suspension_reason` varchar(255) DEFAULT NULL,
  `reinstatement_reason` varchar(255) DEFAULT NULL,
  `payment_status` varchar(10) NOT NULL DEFAULT 'UNPAID' COMMENT 'Payment Status: UNPAID or PAID',
  `condominium_status` varchar(11) NOT NULL,
  `legal_documents` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `condominiums`
--

INSERT INTO `condominiums` (`id`, `name`, `person_of_contact`, `address`, `suspended`, `suspension_reason`, `reinstatement_reason`, `payment_status`, `condominium_status`, `legal_documents`) VALUES
(1, 'Casa Bougainvilla', '', '', 0, '', NULL, 'PAID', 'APPROVED', ''),
(18, 'Trump Tower', '', '', 0, '', NULL, 'SUSPENDED', 'APPROVED', ''),
(19, 'Casa Salamanca', 'Hector Salamanca', 'Kawit, Cavite', 0, 'Breach of Contract', 'Contract Renewed', 'PAID', 'PENDING', 0x6941434144454d595f55475f48616e64626f6f6b5f323032312e706466),
(21, 'Pinkerton Condominium', '', '', 0, '', NULL, 'PENDING', 'PENDING', ''),
(22, 'West Viriginia', '', '', 0, '', NULL, 'PAID', 'APPROVED', ''),
(24, 'Ang Tahanan', 'Damian Ang', 'Malate, Manila', 0, '', NULL, 'PENDING', 'PENDING', 0x5468657369735f50726f706f73616c5f2d5f53454733315f2d5f5265736964656e7469616c5f4d616e6167656d656e745f53797374656d2d312e706466),
(26, 'New Arizona', 'arizona@gmail.com', 'haxton hill, arizona', 0, 'failed to pay at the month of may', NULL, 'PAID', 'APPROVED', 0x746573745f636f6e74726163745f313730353332333830392e646f6378),
(27, 'California', 'california@gmail.com', 'Los Angeles', 0, 'failed to pay for the month of february', NULL, 'PAID', 'APPROVED', 0x746573745f636f6e74726163745f313730353333383233342e646f6378);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `username` varchar(255) NOT NULL,
  `bill_number` varchar(50) NOT NULL,
  `screenshot` varchar(255) DEFAULT NULL,
  `status` enum('Unverified','Verified') NOT NULL DEFAULT 'Unverified',
  `rejection_reason` varchar(255) DEFAULT NULL,
  `condominium_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `timestamp`, `username`, `bill_number`, `screenshot`, `status`, `rejection_reason`, `condominium_id`, `is_deleted`) VALUES
(7, '2024-02-09 14:46:46', 'Elon Musk', '1507498433', '../../uploads/payment_proof/Elon Musk_1507498433_2.png', 'Unverified', NULL, 1, 0),
(8, '2024-02-09 14:47:03', 'Elon Musk', '2126914746', '../../uploads/payment_proof/Elon Musk_2126914746_3.png', 'Unverified', NULL, 1, 0),
(9, '2024-02-14 01:51:37', 'John Cena', '1664288929', '../../uploads/payment_proof/John Cena_1664288929.png', 'Verified', NULL, 1, 0),
(10, '2024-02-14 03:40:28', 'Jeff Bezos', '2011218909', '../../uploads/payment_proof/Jeff Bezos_2011218909.png', 'Unverified', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resident_transactions`
--

CREATE TABLE `resident_transactions` (
  `id` int(11) NOT NULL,
  `account_number` bigint(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `bill_number` int(11) DEFAULT NULL,
  `billing_period_start` date DEFAULT NULL,
  `billing_period_end` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `total_amount_due` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resident_transactions`
--

INSERT INTO `resident_transactions` (`id`, `account_number`, `username`, `bill_number`, `billing_period_start`, `billing_period_end`, `due_date`, `total_amount_due`, `status`, `is_deleted`) VALUES
(4, 1425648978, 'John Cena', 1664288929, '2024-01-01', '2024-01-31', '2024-02-10', '1000.00', 'Paid', 0),
(7, 1983123405, 'Marty McFry III', 1610255313, '2024-01-01', '2024-01-31', '2024-02-10', '5000.00', 'Pending', 1),
(8, 1747194577, 'Tom Cruise', 1279789165, '2024-10-01', '2024-10-31', '2024-11-10', '4000.00', 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tenant_transactions`
--

CREATE TABLE `tenant_transactions` (
  `id` int(11) NOT NULL,
  `account_number` bigint(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `bill_number` int(11) DEFAULT NULL,
  `billing_period_start` date DEFAULT NULL,
  `billing_period_end` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `total_amount_due` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenant_transactions`
--

INSERT INTO `tenant_transactions` (`id`, `account_number`, `username`, `bill_number`, `billing_period_start`, `billing_period_end`, `due_date`, `total_amount_due`, `status`, `is_deleted`) VALUES
(1, 1603909324, 'Jeff Bezos', 2011218909, '2024-01-01', '2024-01-31', '2024-02-10', '7000.00', 'Pending', 0),
(2, 1603909324, 'Jeff Bezos', 1387938587, '2024-11-01', '2024-11-30', '2024-12-10', '10000.00', 'Paid', 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_number` int(16) NOT NULL,
  `unit_status` varchar(255) NOT NULL DEFAULT 'Free',
  `resident_id` varchar(255) DEFAULT NULL,
  `tenant_id` varchar(255) DEFAULT NULL,
  `condominium_id` int(16) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_number`, `unit_status`, `resident_id`, `tenant_id`, `condominium_id`, `is_deleted`) VALUES
(17, 101, 'Available', '', NULL, 1, 0),
(18, 102, 'Available', '', NULL, 1, 0),
(19, 103, 'Occupied', 'Tom Cruise', NULL, 1, 0),
(20, 104, 'Renovating', '', NULL, 1, 0),
(21, 105, 'Occupied', 'Benedict Arnold', NULL, 1, 0),
(22, 106, 'Available', '', NULL, 1, 0),
(27, 107, 'Occupied', 'John Cena', 'Jeff Bezos', 1, 0),
(28, 108, 'Occupied', 'Marty McFry III', NULL, 1, 0),
(29, 109, 'Renovating', '', NULL, 1, 0),
(30, 110, 'Available', 'John Cena', '', 1, 0),
(31, 111, 'Renovating', 'Samuel Adams', NULL, 1, 0),
(32, 112, 'Occupied', 'Benedict Arnold', NULL, 1, 1),
(33, 112, 'Occupied', 'Tom Cruise', NULL, 1, 0),
(34, 113, 'Occupied', 'Tom Cruise', NULL, 1, 0);

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
  `suspended` tinyint(1) DEFAULT NULL,
  `suspension_reason` varchar(255) DEFAULT NULL,
  `suspend_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `reinstatement_reason` varchar(255) DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_verified` tinyint(1) DEFAULT 0,
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `dashboard_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_number`, `username`, `password`, `email`, `role`, `condominium_id`, `suspended`, `suspension_reason`, `suspend_timestamp`, `reinstatement_reason`, `otp_code`, `otp_verified`, `last_login_time`, `dashboard_url`) VALUES
(1, 0, 'Super Admin', '186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae', 'adm1nplk2022@yahoo.com', 'Super Administrator', NULL, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 13:53:18', 'superadmin_dashboard.php'),
(2, 1425648978, 'John Cena', '96d9632f363564cc3032521409cf22a852f2032eec099ed5967c0d000cec607a', 'johncena220@myyahoo.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 14:46:21', 'casa_bougainvilla/resident_dashboard.php'),
(3, 1123456786, 'Dwayne Johnson', '4cc3f3b3897d1ed8511251ae70b84b95d40da6970bf201a397c33a4ce0268afd', 'd61332375@gmail.com', 'Front Desk', 1, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 14:54:32', 'casa_bougainvilla/front_desk_dashboard.php'),
(4, 1315648790, 'Elon Musk', '8b64d09d9a7290a3876504cdb0a64379c807c83bc45aa8e71eb46c5b0c772e07', '202001102@iacademy.edu.ph', 'Administrator', 1, 0, 'failed to pay for the month of january', '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 14:56:55', 'casa_bougainvilla/administrator_dashboard.php'),
(8, 1101483647, 'Jason De Guzman', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'jasondeguzman@cssalamanca.com', 'Administrator', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-09 12:20:41', 'casa_bougainvilla/administrator_dashboard.php'),
(10, 1095279156, 'Daryl Sarmiento', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'darylsarmiento@cssalamanca.com', 'Administrator', 1, 0, 'Out of Reach', '0000-00-00 00:00:00', 'Established connection again', NULL, 0, '2024-01-09 14:16:26', 'casa_bougainvilla/administrator_dashboard.php'),
(16, 1147483647, 'Hank Schrader', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'minerals@gmail.com', 'Administrator', 19, 0, 'Expired Contract', '0000-00-00 00:00:00', 'Renewed contract', NULL, 0, '2024-01-09 16:36:42', 'casa_bougainvilla/administrator_dashboard.php'),
(34, 1883187512, 'Morgan Freeman', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'freeman@gmail.com', 'Administrator', 21, 0, 'Non-Payment of Fees for the Month of March', '0000-00-00 00:00:00', 'Paid on April', NULL, 0, '2024-01-11 12:11:23', 'casa_bougainvilla/administrator_dashboard.php'),
(35, 2028470966, 'Jimmy Gibbs Jr.', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'jimmy@gmail.com', 'Administrator', 18, 0, 'Non-Payment of Fees for the Month of January', '0000-00-00 00:00:00', 'Paid on February', NULL, 0, '2024-01-13 02:23:55', 'casa_bougainvilla/administrator_dashboard.php'),
(36, 1510158441, 'Conan Barbarian', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'conan@gmail.com', 'Administrator', 22, 0, 'Non-Payment of Fees for the Month of June', '0000-00-00 00:00:00', 'Paid in July', NULL, 0, '2024-01-13 02:45:56', 'casa_bougainvilla/administrator_dashboard.php'),
(37, 1747194577, 'Tom Cruise', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'impossible@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 04:19:59', 'casa_bougainvilla/resident_dashboard.php'),
(38, 1983123405, 'Marty McFry III', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'chicken85@gmail.com', 'Resident', 1, 0, 'Non-Payment of Fees for the Month of June', '0000-00-00 00:00:00', 'Paid on July', NULL, 0, '2024-01-13 04:21:48', 'casa_bougainvilla/resident_dashboard.php'),
(39, 2018384520, 'George Washington', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'washington75@gmail.com', 'Administrator', 1, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 04:51:58', 'casa_bougainvilla/administrator_dashboard.php'),
(40, 2144409403, 'Benjamin Franklin X', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'ben769@gmail.com', 'Resident', 1, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 04:56:26', 'casa_bougainvilla/resident_dashboard.php'),
(41, 1617546162, 'Samuel Adams', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'sam75@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 05:17:51', 'casa_bougainvilla/resident_dashboard.php'),
(43, 1374395981, 'Benedict Arnold', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'arnold79@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-15 12:21:33', 'casa_bougainvilla/resident_dashboard.php'),
(44, 1529915200, 'Andrew Jackson IV', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'jackson1815@gmail.com', 'Resident', 18, 0, 'Failed to pay for the month of february', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-15 12:47:36', 'casa_bougainvilla/resident_dashboard.php'),
(45, 1710804190, 'Jimmy Carter X', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'carter2000@gmail.com', 'Administrator', 26, 0, 'Non-Payment of Fees for the Month of November', '0000-00-00 00:00:00', 'Paid in December', NULL, 0, '2024-01-15 13:10:24', 'casa_bougainvilla/administrator_dashboard.php'),
(46, 1856179449, 'Nicholas Sasquer', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'nich75@gmail.com', 'Resident', 18, 0, 'failed to pay for the month of june', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-15 13:15:16', 'casa_bougainvilla/resident_dashboard.php'),
(47, 2001454056, 'Jimmy Fallon', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'fallon@gmail.com', 'Resident', 1, 1, 'Non-Payment of Fees for the Month of January', '2024-01-29 10:09:25', 'Paid on April', NULL, 0, '2024-01-15 17:02:02', 'casa_bougainvilla/resident_dashboard.php'),
(48, 1988229586, 'Otto Bismarck', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'otto@gmail.com', 'Administrator', 19, 0, 'Non-Payment of Fees for the Month of January', '0000-00-00 00:00:00', 'Paid on February', NULL, 0, '2024-01-15 17:04:53', 'casa_bougainvilla/administrator_dashboard.php'),
(60, 2097438436, 'Cer Spencer', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'spence77@gmail.com', 'Front Desk', 1, 0, 'Non-Payment of Fees for the Month of August', '2024-01-29 12:29:51', 'successfully paid for the month of august', NULL, 0, '2024-01-29 12:07:28', 'casa_bougainvilla/front_desk_dashboard.php'),
(61, 1603909324, 'Jeff Bezos', '2e0b8d61fa2a6959d254b6ff5d0fb512249329097336a35568089933b49abdde', 'rhobbaquiran76@gmail.com', 'Tenant', 1, 0, NULL, '2024-02-09 09:41:28', NULL, NULL, 0, '2024-02-09 09:41:28', 'casa_bougainvilla/tenant_dashboard.php'),
(62, 1777213686, 'Collin Hughes', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'collin76@gmail.com', 'Tenant', 1, 1, 'Non-Payment of Fees for the Month of July', '2024-02-13 17:28:41', NULL, NULL, 0, '2024-02-13 17:20:44', 'casa_bougainvilla/tenant_dashboard.php');

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
(10, 'James Garfield', '09293530031', 'garfield@gmail.com', '2024-01-11 20:07:00', '2024-01-11 21:07:00', 'visiting john', 1, 1),
(11, 'Jason Vorhees XIII', '09293530031', 'crystal@gmail.com', '2024-01-13 11:04:00', '2024-01-13 15:01:00', 'visiting my mother at unit 13', 1, 0),
(12, 'James Read', '09293430076', 'read15@gmail.com', '2024-01-15 21:17:00', '2024-01-15 22:19:00', 'visiting friend at unit 7', 1, 1),
(13, 'Elliot Decker', '09293530031', 'decker@gmail.com', '2024-02-07 10:58:00', '2024-02-10 23:00:00', 'howdy', 1, 1);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `condominium_id` (`condominium_id`);

--
-- Indexes for table `resident_transactions`
--
ALTER TABLE `resident_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_transactions`
--
ALTER TABLE `tenant_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901;

--
-- AUTO_INCREMENT for table `admin_transactions`
--
ALTER TABLE `admin_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `condominiums`
--
ALTER TABLE `condominiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `resident_transactions`
--
ALTER TABLE `resident_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tenant_transactions`
--
ALTER TABLE `tenant_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`condominium_id`) REFERENCES `condominiums` (`id`);

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
