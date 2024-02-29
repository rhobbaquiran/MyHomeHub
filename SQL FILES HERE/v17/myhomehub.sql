-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 11:33 AM
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
(185, '2024-01-11 12:06:49', 'Dwayne Johnson', 'Logged in', 1),
(186, '2024-01-11 12:07:43', 'Dwayne Johnson', 'Added visitor: James Garfield', 1),
(187, '2024-01-11 12:08:02', 'Dwayne Johnson', 'Updated visitor: James Garfield', 1),
(188, '2024-01-11 12:08:09', 'Dwayne Johnson', 'Deleted visitor: James Garfield', 1),
(189, '2024-01-11 12:08:15', 'Dwayne Johnson', 'Logged out', 1),
(190, '2024-01-11 12:08:40', 'Super Admin', 'Logged in', NULL),
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
(287, '2024-01-13 04:51:58', 'Super Admin', 'Added Administrator: George Washington', NULL),
(288, '2024-01-13 04:52:26', 'Super Admin', 'Updated Administrator: George Washington', NULL),
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
(310, '2024-01-13 05:01:13', 'Elon Musk', 'Updated Resident: Benjamin Franklin', 1),
(311, '2024-01-13 05:01:20', 'Elon Musk', 'Updated Resident: Benjamin Franklin X', 1),
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
(332, '2024-01-13 05:18:35', 'Elon Musk', 'Logged out', 1),
(333, '2024-01-13 05:18:42', 'Samuel Adams', 'Logged in', 1),
(334, '2024-01-13 05:18:46', 'Samuel Adams', 'Logged in', 1),
(335, '2024-01-13 05:18:50', 'Samuel Adams', 'Logged in', 1),
(336, '2024-01-13 05:18:57', 'Elon Musk', 'Logged in', 1),
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
(423, '2024-01-15 12:46:30', 'Elon Musk', 'Suspended Resident: Benedict Arnold. Reason: Failed to pay for the month of January', 1),
(424, '2024-01-15 12:46:39', 'Elon Musk', 'Reinstated Resident: Benedict Arnold', 1),
(425, '2024-01-15 12:47:36', 'Elon Musk', 'Added Resident: Andrew Jackson', 1),
(426, '2024-01-15 12:47:51', 'Elon Musk', 'Updated Resident: Andrew Jackson IV', 1),
(427, '2024-01-15 12:48:13', 'Elon Musk', 'Suspended Resident: Andrew Jackson IV. Reason: Failed to pay for the month of february', 1),
(428, '2024-01-15 12:48:23', 'Elon Musk', 'Reinstated Resident: Andrew Jackson IV', 1),
(429, '2024-01-15 12:48:33', 'Elon Musk', 'Logged out', 1),
(430, '2024-01-15 12:49:12', 'Super Admin', 'Logged in', NULL),
(443, '2024-01-15 13:01:17', 'Super Admin', 'Added Condominium: New Arizona', NULL),
(444, '2024-01-15 13:03:29', 'Super Admin', 'Updated Condominium: New Arizona', NULL),
(445, '2024-01-15 13:04:00', 'Super Admin', 'Suspended Condominium: New Arizona. Reason: failed to pay at the month of may', NULL),
(446, '2024-01-15 13:04:09', 'Super Admin', 'Reinstated Condominium: New Arizona', NULL),
(447, '2024-01-15 13:10:24', 'Super Admin', 'Added Administrator: Jimmy Carter', NULL),
(448, '2024-01-15 13:10:41', 'Super Admin', 'Updated Administrator: Jimmy Carter X', NULL),
(449, '2024-01-15 13:11:32', 'Super Admin', 'Suspended Administrator: Jimmy Carter X. Reason: failed to pay for the month of august', NULL),
(450, '2024-01-15 13:11:44', 'Super Admin', 'Reinstated Administrator: Jimmy Carter X', NULL),
(451, '2024-01-15 13:13:35', 'Super Admin', 'Added transaction of New Arizona with Bill Number: 1485088834', NULL),
(452, '2024-01-15 13:13:44', 'Super Admin', 'Updated transaction of New Arizona with Bill Number: 1485088834', NULL),
(453, '2024-01-15 13:13:58', 'Super Admin', 'Deleted transaction of New Arizona with Bill Number: 1485088834', NULL),
(454, '2024-01-15 13:14:38', 'Super Admin', 'Logged out', NULL),
(455, '2024-01-15 13:14:46', 'Elon Musk', 'Logged in', 1),
(456, '2024-01-15 13:15:16', 'Elon Musk', 'Added Resident: Nicholas Sasque', 1),
(457, '2024-01-15 13:15:34', 'Elon Musk', 'Updated Resident: Nicholas Sasquer', 1),
(458, '2024-01-15 13:15:41', 'Elon Musk', 'Updated Resident: Nicholas Sasquer', 1),
(459, '2024-01-15 13:16:08', 'Elon Musk', 'Suspended Resident: Nicholas Sasquer. Reason: failed to pay for the month of june', 1),
(460, '2024-01-15 13:16:15', 'Elon Musk', 'Reinstated Resident: Nicholas Sasquer', 1),
(461, '2024-01-15 13:17:11', 'Elon Musk', 'Logged out', 1),
(462, '2024-01-15 13:17:19', 'Dwayne Johnson', 'Logged in', 1),
(463, '2024-01-15 13:18:10', 'Dwayne Johnson', 'Added visitor: James Read', 1),
(464, '2024-01-15 13:18:23', 'Dwayne Johnson', 'Updated visitor: James Read', 1),
(465, '2024-01-15 13:18:33', 'Dwayne Johnson', 'Deleted visitor: James Read', 1),
(466, '2024-01-15 13:18:42', 'Dwayne Johnson', 'Logged out', 1),
(467, '2024-01-15 13:21:15', 'Super Admin', 'Logged in', NULL),
(468, '2024-01-15 13:22:51', 'Super Admin', 'Logged out', NULL),
(469, '2024-01-15 13:23:00', 'Elon Musk', 'Logged in', 1),
(474, '2024-01-15 15:28:05', 'Elon Musk', 'Added transaction of Tom Cruise with Bill Number: 1664288929', 1),
(475, '2024-01-15 15:28:59', 'Elon Musk', 'Added transaction of John Cena with Bill Number: 1767165030', 1),
(477, '2024-01-15 16:16:23', 'Elon Musk', 'Updated transaction for resident: Tom Cruise with Bill Number: 1767165030', 1),
(478, '2024-01-15 16:17:27', 'Elon Musk', 'Updated transaction for resident: Benedict Arnold with Bill Number: 1767165030', 1),
(487, '2024-01-15 16:59:45', 'Elon Musk', 'Updated transaction for resident: Marty McFry III with Bill Number: 1767165030', 1),
(488, '2024-01-15 17:00:00', 'Elon Musk', 'Updated transaction for resident: Marty McFry III with Bill Number: 1767165030', 1),
(489, '2024-01-15 17:00:12', 'Elon Musk', 'Deleted transaction of Marty McFry III with Bill Number: 1767165030', 1),
(490, '2024-01-15 17:01:26', 'Elon Musk', 'Added transaction of Samuel Adams with Bill Number: 1191966442', 1),
(491, '2024-01-15 17:01:32', 'Elon Musk', 'Updated transaction for resident: Samuel Adams with Bill Number: 1191966442', 1),
(492, '2024-01-15 17:01:40', 'Elon Musk', 'Deleted transaction of Samuel Adams with Bill Number: 1191966442', 1),
(493, '2024-01-15 17:02:02', 'Elon Musk', 'Added Resident: Jimmy Fallon', 1),
(494, '2024-01-15 17:02:16', 'Elon Musk', 'Suspended Resident: Jimmy Fallon. Reason: failed to pay for the month of may', 1),
(495, '2024-01-15 17:02:23', 'Elon Musk', 'Reinstated Resident: Jimmy Fallon', 1),
(496, '2024-01-15 17:02:29', 'Elon Musk', 'Logged out', 1),
(497, '2024-01-15 17:02:54', 'Super Admin', 'Logged in', NULL),
(498, '2024-01-15 17:03:43', 'Super Admin', 'Added Condominium: California', NULL),
(499, '2024-01-15 17:03:54', 'Super Admin', 'Updated Condominium: California', NULL),
(500, '2024-01-15 17:04:03', 'Super Admin', 'Updated Condominium: California', NULL),
(501, '2024-01-15 17:04:20', 'Super Admin', 'Suspended Condominium: California. Reason: failed to pay for the month of february', NULL),
(502, '2024-01-15 17:04:24', 'Super Admin', 'Reinstated Condominium: California', NULL),
(503, '2024-01-15 17:04:53', 'Super Admin', 'Added Administrator: Otto Bismarck', NULL),
(504, '2024-01-15 17:05:01', 'Super Admin', 'Updated Administrator: Otto Bismarck', NULL),
(505, '2024-01-15 17:05:11', 'Super Admin', 'Suspended Administrator: Otto Bismarck. Reason: failed to pay at the month of march', NULL),
(506, '2024-01-15 17:05:17', 'Super Admin', 'Reinstated Administrator: Otto Bismarck', NULL),
(507, '2024-01-15 17:05:48', 'Super Admin', 'Added transaction of Casa Salamanca with Bill Number: 1211644703', NULL),
(508, '2024-01-15 17:05:52', 'Super Admin', 'Updated transaction of Casa Salamanca with Bill Number: 1211644703', NULL),
(509, '2024-01-15 17:06:03', 'Super Admin', 'Deleted transaction of Casa Salamanca with Bill Number: 1211644703', NULL),
(510, '2024-01-15 17:06:11', 'Super Admin', 'Logged out', NULL),
(511, '2024-01-15 17:13:07', 'John Cena', 'Logged in', 1),
(512, '2024-01-15 17:14:14', 'Elon Musk', 'Logged in', 1),
(513, '2024-01-15 17:14:18', 'Elon Musk', 'Logged out', 1),
(514, '2024-01-22 11:04:27', 'Super Admin', 'Logged in', NULL),
(515, '2024-01-22 14:03:00', 'Super Admin', 'Suspended Condominium: Casa Salamanca. Reason: Breach of Contract', NULL),
(516, '2024-01-22 14:03:05', 'Super Admin', 'Reinstated Condominium: Casa Salamanca', NULL),
(517, '2024-01-22 14:32:18', 'Super Admin', 'Suspended Condominium: Casa Salamanca. Reason: Breach of Contract', NULL),
(518, '2024-01-22 14:32:32', 'Super Admin', 'Reinstated Condominium: Casa Salamanca. Reason: Contract Renewed', NULL),
(519, '2024-01-22 15:13:18', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees', NULL),
(520, '2024-01-22 15:17:06', 'Super Admin', 'Reinstated Administrator: Jimmy Gibbs Jr.', NULL),
(521, '2024-01-22 15:17:21', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees', NULL),
(522, '2024-01-22 15:18:01', 'Super Admin', 'Reinstated Administrator: Jimmy Gibbs Jr.', NULL),
(523, '2024-01-22 15:22:18', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees', NULL),
(524, '2024-01-22 15:22:48', 'Super Admin', 'Reinstated Administrator: Morgan Freeman. Reason: Paid on February', NULL),
(525, '2024-01-22 15:30:32', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees for the Month of January', NULL),
(526, '2024-01-22 15:30:49', 'Super Admin', 'Reinstated Administrator: Jimmy Gibbs Jr.. Reason: Paid on February', NULL),
(527, '2024-01-22 15:33:30', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees for the Month of March', NULL),
(528, '2024-01-22 15:33:39', 'Super Admin', 'Reinstated Administrator: Morgan Freeman. Reason: Paid on April', NULL),
(529, '2024-01-22 15:35:55', 'Super Admin', 'Suspended Administrator: . Reason: Non-Payment of Fees for the Month of August', NULL),
(530, '2024-01-22 15:36:05', 'Super Admin', 'Reinstated Administrator: Otto Bismarck. Reason: Paid in September', NULL),
(531, '2024-01-22 15:40:08', 'Super Admin', 'Suspended Administrator: Jimmy Carter X. Reason: Non-Payment of Fees for the Month of November', NULL),
(532, '2024-01-22 15:40:19', 'Super Admin', 'Logged out', NULL),
(533, '2024-01-22 15:40:32', 'Super Admin', 'Logged in', NULL),
(534, '2024-01-22 15:40:49', 'Super Admin', 'Reinstated Administrator: Jimmy Carter X. Reason: Paid in December', NULL),
(535, '2024-01-22 15:42:10', 'Super Admin', 'Suspended Administrator: Hank Schrader. Reason: Expired Contract', NULL),
(536, '2024-01-22 15:42:30', 'Super Admin', 'Reinstated Administrator: Hank Schrader. Reason: Renewed contract', NULL),
(537, '2024-01-22 15:58:10', 'Super Admin', 'Suspended Administrator: Otto Bismarck. Reason: Non-Payment of Fees for the Month of January', NULL),
(538, '2024-01-22 15:58:38', 'Super Admin', 'Reinstated Administrator: Otto Bismarck. Reason: Paid on February', NULL),
(539, '2024-01-22 16:01:09', 'Super Admin', 'Suspended Administrator: Conan Barbarian. Reason: Non-Payment of Fees for the Month of June', NULL),
(540, '2024-01-22 16:04:04', 'Super Admin', 'Reinstated Administrator: Conan Barbarian. Reason: Paid in July', NULL),
(541, '2024-01-22 16:06:35', 'Super Admin', 'Suspended Administrator: Jimmy Carter X. Reason: Non-Payment of Fees for the Month of November', NULL),
(542, '2024-01-22 16:07:23', 'Super Admin', 'Reinstated Administrator: Jimmy Carter X. Reason: Paid in December', NULL),
(543, '2024-01-22 16:09:10', 'Super Admin', 'Suspended Administrator: Daryl Sarmiento. Reason: Out of Reach', NULL),
(544, '2024-01-22 16:09:32', 'Super Admin', 'Reinstated Administrator: Daryl Sarmiento. Reason: Established connection again', NULL),
(545, '2024-01-24 04:24:11', 'Super Admin', 'Logged in', NULL),
(546, '2024-01-24 04:25:03', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1579434797', NULL),
(547, '2024-01-24 04:25:27', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1110782496', NULL),
(548, '2024-01-24 04:26:11', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1368997250', NULL),
(549, '2024-01-24 04:26:45', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1147911760', NULL),
(550, '2024-01-24 04:27:19', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 2027138614', NULL),
(551, '2024-01-24 04:28:22', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1624999527', NULL),
(552, '2024-01-24 04:28:28', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1624999527', NULL),
(553, '2024-01-24 04:29:14', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1920125792', NULL),
(554, '2024-01-24 04:29:39', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1124946631', NULL),
(555, '2024-01-24 04:30:10', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 2116930269', NULL),
(556, '2024-01-24 04:30:51', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL),
(557, '2024-01-24 04:31:34', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL),
(558, '2024-01-24 04:31:43', 'Super Admin', 'Logged out', NULL),
(559, '2024-01-24 04:31:54', 'Elon Musk', 'Logged in', 1),
(560, '2024-01-24 04:32:50', 'Elon Musk', 'Logged out', 1),
(561, '2024-01-24 04:33:00', 'Super Admin', 'Logged in', NULL),
(562, '2024-01-24 04:33:48', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1579434797', NULL),
(563, '2024-01-24 04:33:51', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1110782496', NULL),
(564, '2024-01-24 04:33:53', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1368997250', NULL),
(565, '2024-01-24 04:33:55', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1147911760', NULL),
(566, '2024-01-24 04:33:58', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2027138614', NULL),
(567, '2024-01-24 04:34:00', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1920125792', NULL),
(568, '2024-01-24 04:34:06', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1624999527', NULL),
(569, '2024-01-24 04:34:10', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1124946631', NULL),
(570, '2024-01-24 04:34:12', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2116930269', NULL),
(571, '2024-01-24 04:34:15', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL),
(572, '2024-01-24 04:34:22', 'Super Admin', 'Logged out', NULL),
(573, '2024-01-24 04:34:33', 'Elon Musk', 'Logged in', 1),
(574, '2024-01-24 04:54:50', 'Elon Musk', 'Logged out', 1),
(591, '2024-01-28 14:22:40', 'Elon Musk', 'Logged in', 1),
(592, '2024-01-28 14:24:55', 'Elon Musk', 'Added transaction of Marty McFry III with Bill Number: 1610255313', 1),
(593, '2024-01-28 14:25:24', 'Elon Musk', 'Added transaction of Tom Cruise with Bill Number: 1279789165', 1),
(594, '2024-01-28 14:25:43', 'Elon Musk', 'Updated transaction for resident: Tom Cruise with Bill Number: 1279789165', 1),
(595, '2024-01-28 14:25:49', 'Elon Musk', 'Updated transaction for resident: Tom Cruise with Bill Number: 1279789165', 1),
(596, '2024-01-28 14:26:31', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', 1),
(597, '2024-01-28 14:26:31', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', NULL),
(598, '2024-01-28 14:26:45', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', 1),
(599, '2024-01-28 14:26:45', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', NULL),
(600, '2024-01-28 15:00:56', 'Elon Musk', 'Logged out', 1),
(601, '2024-01-28 15:01:28', 'Super Admin', 'Logged in', NULL),
(602, '2024-01-28 15:01:35', 'Super Admin', 'Logged out', NULL),
(603, '2024-01-28 15:02:01', 'Dwayne Johnson', 'Logged in', 1),
(604, '2024-01-28 15:03:26', 'Dwayne Johnson', 'Logged out', 1),
(605, '2024-01-28 15:04:19', 'Elon Musk', 'Logged in', 1),
(606, '2024-01-28 15:10:38', 'Elon Musk', 'Logged out', 1),
(607, '2024-01-28 15:12:04', 'Elon Musk', 'Logged in', 1),
(609, '2024-01-28 16:09:10', 'Elon Musk', 'Added Unit: 102', 1),
(610, '2024-01-28 16:11:07', 'Elon Musk', 'Added Unit: 103', 1),
(612, '2024-01-28 16:11:23', 'Elon Musk', 'Added Unit: 103', 1),
(613, '2024-01-28 16:11:37', 'Elon Musk', 'Added Unit: 104', 1),
(614, '2024-01-28 16:11:46', 'Elon Musk', 'Added Unit: 105', 1),
(615, '2024-01-28 16:11:53', 'Elon Musk', 'Added Unit: 106', 1),
(616, '2024-01-28 16:12:02', 'Elon Musk', 'Added Unit: 107', 1),
(621, '2024-01-28 17:02:46', 'Elon Musk', 'Added Unit: 101', 1),
(622, '2024-01-28 17:04:17', 'Elon Musk', 'Added Unit: 101', 1),
(623, '2024-01-28 17:04:29', 'Elon Musk', 'Added Unit: 102', 1),
(624, '2024-01-28 17:07:58', 'Elon Musk', 'Added Unit: 101', 1),
(625, '2024-01-28 17:09:06', 'Elon Musk', 'Added Unit: 101', 1),
(627, '2024-01-28 17:14:07', 'Elon Musk', 'Deleted Unit 101', 1),
(628, '2024-01-28 17:34:42', 'Elon Musk', 'Added Unit: 102', 1),
(629, '2024-01-28 17:38:57', 'Elon Musk', 'Added Unit: 103', 1),
(630, '2024-01-28 17:42:10', 'Elon Musk', 'Added Unit: 104', 1),
(631, '2024-01-28 17:46:34', 'Elon Musk', 'Added Unit: 105', 1),
(632, '2024-01-28 17:46:46', 'Elon Musk', 'Added Unit: 106', 1),
(633, '2024-01-28 17:50:17', 'Elon Musk', 'Added Unit: 107', 1),
(635, '2024-01-28 17:52:26', 'Elon Musk', 'Added Unit: 108', 1),
(636, '2024-01-28 17:53:58', 'Elon Musk', 'Added Unit: 1', 1),
(637, '2024-01-28 18:01:53', 'Elon Musk', 'Added Unit: 107', 1),
(638, '2024-01-28 18:02:09', 'Elon Musk', 'Added Unit: 108', 1),
(639, '2024-01-28 18:02:21', 'Elon Musk', 'Added Unit: 109', 1),
(640, '2024-01-28 18:02:44', 'Elon Musk', 'Added Unit: 110', 1),
(641, '2024-01-28 18:02:55', 'Elon Musk', 'Added Unit: 111', 1),
(642, '2024-01-28 18:04:25', 'Elon Musk', 'Deleted Unit 111', 1),
(643, '2024-01-28 18:29:12', 'Elon Musk', 'Added Unit: 112', 1),
(644, '2024-01-28 18:30:41', 'Elon Musk', 'Updated Unit: 112', 1),
(645, '2024-01-28 18:31:05', 'Elon Musk', 'Deleted Unit 112', 1),
(646, '2024-01-28 18:31:38', 'Elon Musk', 'Added Unit: 112', 1),
(647, '2024-01-28 18:32:01', 'Elon Musk', 'Updated Unit: 112', 1),
(648, '2024-01-28 18:33:21', 'Elon Musk', 'Logged out', 1),
(649, '2024-01-28 18:33:45', 'Super Admin', 'Logged in', NULL),
(650, '2024-01-28 18:33:53', 'Super Admin', 'Logged out', NULL),
(651, '2024-01-28 18:34:05', 'Elon Musk', 'Logged in', 1),
(652, '2024-01-28 18:34:18', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', 1),
(653, '2024-01-28 18:34:18', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', NULL),
(654, '2024-01-28 18:34:34', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', 1),
(655, '2024-01-28 18:34:34', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', NULL),
(656, '2024-01-28 18:34:48', 'Elon Musk', 'Logged out', 1),
(657, '2024-01-28 18:35:01', 'Super Admin', 'Logged in', NULL),
(658, '2024-01-28 18:35:32', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL),
(659, '2024-01-28 18:36:00', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL),
(660, '2024-01-28 18:36:26', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL),
(661, '2024-01-28 18:36:49', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL),
(662, '2024-01-28 18:36:59', 'Super Admin', 'Logged out', NULL),
(663, '2024-01-29 03:39:14', 'Super Admin', 'Logged in', NULL),
(664, '2024-01-29 06:11:52', 'Super Admin', 'Logged out', NULL),
(665, '2024-01-29 06:12:15', 'Super Admin', 'Logged in', NULL),
(666, '2024-01-29 07:06:26', 'Super Admin', 'Added transaction of Casa Bougainvilla with Bill Number: 1992699870', NULL),
(667, '2024-01-29 07:32:20', 'Super Admin', 'Logged in', NULL),
(668, '2024-01-29 07:56:32', 'Super Admin', 'Logged out', NULL),
(669, '2024-01-29 07:56:47', 'Elon Musk', 'Logged in', 1),
(670, '2024-01-29 08:16:43', 'Elon Musk', 'Suspended Resident: Jimmy Fallon. Reason: Non-Payment of Fees for the Month of March', 1),
(671, '2024-01-29 08:35:30', 'Elon Musk', 'Suspended Resident: Marty McFry III. Reason: Non-Payment of Fees for the Month of June', 1),
(672, '2024-01-29 08:39:23', 'Elon Musk', 'Logged out', 1),
(673, '2024-01-29 08:39:40', 'Super Admin', 'Logged in', NULL),
(674, '2024-01-29 08:41:41', 'Super Admin', 'Logged out', NULL),
(675, '2024-01-29 08:41:48', 'Elon Musk', 'Logged in', 1),
(676, '2024-01-29 08:54:56', 'Elon Musk', 'Reinstated Resident: Marty McFry III. Reason: Paid on July', 1),
(677, '2024-01-29 08:55:11', 'Elon Musk', 'Reinstated Resident: Jimmy Fallon. Reason: Paid on April', 1),
(678, '2024-01-29 10:09:25', 'Elon Musk', 'Suspended Resident: Jimmy Fallon. Reason: Non-Payment of Fees for the Month of January', 1),
(679, '2024-01-29 10:28:25', 'Elon Musk', 'Logged out', 1),
(680, '2024-01-29 10:28:36', 'Super Admin', 'Logged in', NULL);

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
(13, 1315648790, 'Casa Bougainvilla', '1579434797', '2024-01-01', '2024-01-31', '2024-02-10', 1000.00, 'Paid', 0),
(14, 1315648790, 'Casa Bougainvilla', '1110782496', '2024-02-01', '2024-02-29', '2024-03-10', 2000.00, 'Paid', 0),
(15, 1315648790, 'Casa Bougainvilla', '1368997250', '2024-03-01', '2024-03-31', '2024-04-10', 3000.00, 'Paid', 0),
(16, 1315648790, 'Casa Bougainvilla', '1147911760', '2024-04-01', '2024-04-30', '2024-05-10', 4000.00, 'Paid', 0),
(17, 1315648790, 'Casa Bougainvilla', '2027138614', '2024-06-01', '2024-06-30', '2024-07-10', 5000.00, 'Paid', 0),
(18, 1315648790, 'Casa Bougainvilla', '1624999527', '2024-07-01', '2024-07-31', '2024-08-10', 6000.00, 'Paid', 0),
(19, 1315648790, 'Casa Bougainvilla', '1920125792', '2024-08-01', '2024-08-31', '2024-09-10', 7000.00, 'Paid', 0),
(20, 1315648790, 'Casa Bougainvilla', '1124946631', '2024-09-01', '2024-09-30', '2024-10-10', 8000.00, 'Paid', 0),
(21, 1315648790, 'Casa Bougainvilla', '2116930269', '2024-10-01', '2024-10-31', '2024-11-10', 9000.00, 'Paid', 0),
(22, 1315648790, 'Casa Bougainvilla', '1507498433', '2024-11-01', '2024-01-31', '2024-12-10', 10000.00, 'Pending', 0),
(23, 1315648790, 'Casa Bougainvilla', '2126914746', '2024-12-01', '2024-12-31', '2024-01-10', 11000.00, 'Pending', 0),
(24, 1315648790, 'Casa Bougainvilla', '1992699870', '2024-01-01', '2024-01-31', '2024-02-17', 3000.00, 'Paid', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `condominium_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `timestamp`, `username`, `bill_number`, `screenshot`, `status`, `condominium_id`, `is_deleted`) VALUES
(3, '2024-01-29 02:34:18', 'Elon Musk', '1507498433', '../../uploads/payment_proof/Elon Musk_1507498433_1.png', 'Unverified', 1, 0),
(4, '2024-01-29 02:34:34', 'Elon Musk', '2126914746', '../../uploads/payment_proof/Elon Musk_2126914746_1.png', 'Unverified', 1, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident_transactions`
--

INSERT INTO `resident_transactions` (`id`, `account_number`, `username`, `bill_number`, `billing_period_start`, `billing_period_end`, `due_date`, `total_amount_due`, `status`, `is_deleted`) VALUES
(4, 1425648978, 'John Cena', 1664288929, '2024-01-01', '2024-01-31', '2024-02-10', 1000.00, 'Paid', 0),
(7, 1983123405, 'Marty McFry III', 1610255313, '2024-01-01', '2024-01-31', '2024-02-10', 5000.00, 'Pending', 0),
(8, 1747194577, 'Tom Cruise', 1279789165, '2024-10-01', '2024-10-31', '2024-11-10', 4000.00, 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_number` int(16) NOT NULL,
  `unit_status` varchar(255) NOT NULL DEFAULT 'Free',
  `resident_id` varchar(255) DEFAULT NULL,
  `condominium_id` int(16) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_number`, `unit_status`, `resident_id`, `condominium_id`, `is_deleted`) VALUES
(17, 101, 'Free', '', 1, 0),
(18, 102, 'Free', '', 1, 0),
(19, 103, 'Occupied', 'Tom Cruise', 1, 0),
(20, 104, 'Renovating', '', 1, 0),
(21, 105, 'Occupied', 'Benedict Arnold', 1, 0),
(22, 106, 'Free', '', 1, 0),
(27, 107, 'Renovating', 'John Cena', 1, 0),
(28, 108, 'Occupied', 'Marty McFry III', 1, 0),
(29, 109, 'Renovating', '', 1, 0),
(30, 110, 'Occupied', 'John Cena', 1, 0),
(31, 111, 'Renovating', 'Samuel Adams', 1, 0),
(32, 112, 'Occupied', 'Benedict Arnold', 1, 1),
(33, 112, 'Occupied', 'Tom Cruise', 1, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_number`, `username`, `password`, `email`, `role`, `condominium_id`, `suspended`, `suspension_reason`, `suspend_timestamp`, `reinstatement_reason`, `otp_code`, `otp_verified`, `last_login_time`, `dashboard_url`) VALUES
(1, 0, 'Super Admin', '17c4520f6cfd1ab53d8745e84681eb49', 'adm1nplk2022@yahoo.com', 'Super Administrator', NULL, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 13:53:18', 'superadmin_dashboard.php'),
(2, 1425648978, 'John Cena', '527bd5b5d689e2c32ae974c6229ff785', 'cena@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 14:46:21', 'casa_bougainvilla/resident_dashboard.php'),
(3, 1123456786, 'Dwayne Johnson', '802dcc51ecfcb58c97258d064c017237', 'johnson@gmail.com', 'Front Desk', 1, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 14:54:32', 'casa_bougainvilla/front_desk_dashboard.php'),
(4, 1315648790, 'Elon Musk', '9e887375eaba77dc7568e4048268520e', 'musk@gmail.com', 'Administrator', 1, 0, 'failed to pay for the month of january', '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 14:56:55', 'casa_bougainvilla/administrator_dashboard.php'),
(8, 1101483647, 'Jason De Guzman', '53740f9f22d9f3425e379363d9b610e5', 'jasondeguzman@cssalamanca.com', 'Administrator', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-09 12:20:41', 'casa_bougainvilla/administrator_dashboard.php'),
(10, 1095279156, 'Daryl Sarmiento', 'a26d15e5f355f1b3d6d11e35010b9d03', 'darylsarmiento@cssalamanca.com', 'Administrator', 1, 0, 'Out of Reach', '0000-00-00 00:00:00', 'Established connection again', NULL, 0, '2024-01-09 14:16:26', 'casa_bougainvilla/administrator_dashboard.php'),
(16, 1147483647, 'Hank Schrader', 'fcea920f7412b5da7be0cf42b8c93759', 'minerals@gmail.com', 'Administrator', 19, 0, 'Expired Contract', '0000-00-00 00:00:00', 'Renewed contract', NULL, 0, '2024-01-09 16:36:42', 'casa_bougainvilla/administrator_dashboard.php'),
(34, 1883187512, 'Morgan Freeman', '81dc9bdb52d04dc20036dbd8313ed055', 'freeman@gmail.com', 'Administrator', 21, 0, 'Non-Payment of Fees for the Month of March', '0000-00-00 00:00:00', 'Paid on April', NULL, 0, '2024-01-11 12:11:23', 'casa_bougainvilla/administrator_dashboard.php'),
(35, 2028470966, 'Jimmy Gibbs Jr.', 'c2fe677a63ffd5b7ffd8facbf327dad0', 'jimmy@gmail.com', 'Administrator', 18, 0, 'Non-Payment of Fees for the Month of January', '0000-00-00 00:00:00', 'Paid on February', NULL, 0, '2024-01-13 02:23:55', 'casa_bougainvilla/administrator_dashboard.php'),
(36, 1510158441, 'Conan Barbarian', 'c9dc004fc3d039ad7fb49456e5902b01', 'conan@gmail.com', 'Administrator', 22, 0, 'Non-Payment of Fees for the Month of June', '0000-00-00 00:00:00', 'Paid in July', NULL, 0, '2024-01-13 02:45:56', 'casa_bougainvilla/administrator_dashboard.php'),
(37, 1747194577, 'Tom Cruise', '34b7da764b21d298ef307d04d8152dc5', 'impossible@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 04:19:59', 'casa_bougainvilla/resident_dashboard.php'),
(38, 1983123405, 'Marty McFry III', '9a09b4dfda82e3e665e31092d1c3ec8d', 'chicken85@gmail.com', 'Resident', 1, 0, 'Non-Payment of Fees for the Month of June', '0000-00-00 00:00:00', 'Paid on July', NULL, 0, '2024-01-13 04:21:48', 'casa_bougainvilla/resident_dashboard.php'),
(39, 2018384520, 'George Washington', 'ada53304c5b9e4a839615b6e8f908eb6', 'washington75@gmail.com', 'Administrator', 1, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 04:51:58', 'casa_bougainvilla/administrator_dashboard.php'),
(40, 2144409403, 'Benjamin Franklin X', '7fe4771c008a22eb763df47d19e2c6aa', 'ben769@gmail.com', 'Resident', 1, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 04:56:26', 'casa_bougainvilla/resident_dashboard.php'),
(41, 1617546162, 'Samuel Adams', '332532dcfaa1cbf61e2a266bd723612c', 'sam75@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 05:17:51', 'casa_bougainvilla/resident_dashboard.php'),
(43, 1374395981, 'Benedict Arnold', '7fe4771c008a22eb763df47d19e2c6aa', 'arnold79@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-15 12:21:33', 'casa_bougainvilla/resident_dashboard.php'),
(44, 1529915200, 'Andrew Jackson IV', 'd914e3ecf6cc481114a3f534a5faf90b', 'jackson1815@gmail.com', 'Resident', 18, 0, 'Failed to pay for the month of february', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-15 12:47:36', 'casa_bougainvilla/resident_dashboard.php'),
(45, 1710804190, 'Jimmy Carter X', '202cb962ac59075b964b07152d234b70', 'carter2000@gmail.com', 'Administrator', 26, 0, 'Non-Payment of Fees for the Month of November', '0000-00-00 00:00:00', 'Paid in December', NULL, 0, '2024-01-15 13:10:24', 'casa_bougainvilla/administrator_dashboard.php'),
(46, 1856179449, 'Nicholas Sasquer', '202cb962ac59075b964b07152d234b70', 'nich75@gmail.com', 'Resident', 18, 0, 'failed to pay for the month of june', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-15 13:15:16', 'casa_bougainvilla/resident_dashboard.php'),
(47, 2001454056, 'Jimmy Fallon', '202cb962ac59075b964b07152d234b70', 'fallon@gmail.com', 'Resident', 1, 1, 'Non-Payment of Fees for the Month of January', '2024-01-29 10:09:25', 'Paid on April', NULL, 0, '2024-01-15 17:02:02', 'casa_bougainvilla/resident_dashboard.php'),
(48, 1988229586, 'Otto Bismarck', '202cb962ac59075b964b07152d234b70', 'otto@gmail.com', 'Administrator', 19, 0, 'Non-Payment of Fees for the Month of January', '0000-00-00 00:00:00', 'Paid on February', NULL, 0, '2024-01-15 17:04:53', 'casa_bougainvilla/administrator_dashboard.php');

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
(11, 'Jason Vorhees XIII', '09293530031', 'crystal@gmail.com', '2024-01-13 11:04:00', '2024-01-13 15:01:00', 'visiting my mother at unit 13', 1, 0),
(12, 'James Read', '09293430076', 'read15@gmail.com', '2024-01-15 21:17:00', '2024-01-15 22:19:00', 'visiting friend at unit 7', 1, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resident_transactions`
--
ALTER TABLE `resident_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
