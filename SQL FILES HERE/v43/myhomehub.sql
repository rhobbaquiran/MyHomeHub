-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 07:27 AM
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
  `condominium_id` int(11) DEFAULT NULL,
  `account_number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `timestamp`, `user`, `action`, `condominium_id`, `account_number`) VALUES
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
(651, '2024-01-28 18:34:05', 'Elon Musk', 'Logged in', 1, 0),
(652, '2024-01-28 18:34:18', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', 1, 0),
(653, '2024-01-28 18:34:18', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1507498433', NULL, 0),
(654, '2024-01-28 18:34:34', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', 1, 0),
(655, '2024-01-28 18:34:34', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 2126914746', NULL, 0),
(656, '2024-01-28 18:34:48', 'Elon Musk', 'Logged out', 1, 0),
(669, '2024-01-29 07:56:47', 'Elon Musk', 'Logged in', 1, 0),
(670, '2024-01-29 08:16:43', 'Elon Musk', 'Suspended Resident: Jimmy Fallon. Reason: Non-Payment of Fees for the Month of March', 1, 0),
(671, '2024-01-29 08:35:30', 'Elon Musk', 'Suspended Resident: Marty McFry III. Reason: Non-Payment of Fees for the Month of June', 1, 0),
(672, '2024-01-29 08:39:23', 'Elon Musk', 'Logged out', 1, 0),
(675, '2024-01-29 08:41:48', 'Elon Musk', 'Logged in', 1, 0),
(676, '2024-01-29 08:54:56', 'Elon Musk', 'Reinstated Resident: Marty McFry III. Reason: Paid on July', 1, 0),
(677, '2024-01-29 08:55:11', 'Elon Musk', 'Reinstated Resident: Jimmy Fallon. Reason: Paid on April', 1, 0),
(678, '2024-01-29 10:09:25', 'Elon Musk', 'Suspended Resident: Jimmy Fallon. Reason: Non-Payment of Fees for the Month of January', 1, 0),
(679, '2024-01-29 10:28:25', 'Elon Musk', 'Logged out', 1, 0),
(681, '2024-01-29 10:49:47', 'Super Admin', 'Logged in', NULL, 0),
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
(900, '2024-02-14 06:43:09', 'Super Admin', 'Logged out', NULL, 0),
(901, '2024-02-21 14:34:21', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(902, '2024-02-21 14:34:38', 'Super Admin', 'Logged in', NULL, 0),
(903, '2024-02-21 14:35:18', 'Super Admin', 'Logged in', NULL, 0),
(904, '2024-02-23 08:56:01', 'Super Admin', 'Logged in', NULL, 0),
(905, '2024-02-23 08:56:12', 'Super Admin', 'Logged out', NULL, 0),
(906, '2024-02-23 08:56:18', 'Elon Musk', 'Logged in', 1, 1315648790),
(907, '2024-02-23 09:01:27', 'Elon Musk', 'Logged in', 1, 1315648790),
(908, '2024-02-23 09:11:06', 'Elon Musk', 'Updated Unit: 102', 1, 0),
(909, '2024-02-23 09:14:18', 'Elon Musk', 'Logged out', 1, 1315648790),
(910, '2024-02-23 09:14:41', 'John Cena', 'Logged in', 1, 1425648978),
(911, '2024-02-23 09:31:40', 'John Cena', 'Logged out', 1, 1425648978),
(912, '2024-02-23 09:33:00', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(913, '2024-02-23 09:39:35', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(914, '2024-02-23 09:40:22', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(915, '2024-02-23 13:55:09', 'John Cena', 'Logged in', 1, 1425648978),
(916, '2024-02-23 13:55:30', 'John Cena', 'Reinstated Tenant: Collin Hughes. Reason: conflict resolved', 1, 1425648978),
(917, '2024-02-23 13:55:34', 'John Cena', 'Suspended Tenant: Collin Hughes. Reason: Non-Payment of Fees for the Month of January', 1, 1425648978),
(918, '2024-02-23 13:55:43', 'John Cena', 'Reinstated Tenant: Collin Hughes. Reason: conflict resolved', 1, 1425648978),
(919, '2024-02-23 13:56:06', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(920, '2024-02-23 13:56:34', 'Elon Musk', 'Logged in', 1, 1315648790),
(921, '2024-02-23 13:56:55', 'Elon Musk', 'Logged out', 1, 1315648790),
(922, '2024-02-23 13:57:08', 'John Cena', 'Logged in', 1, 1425648978),
(923, '2024-02-23 13:57:27', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(924, '2024-02-23 14:13:38', 'Dwayne Johnson', 'Added visitor: Vladimir Putin', 1, 1123456786),
(925, '2024-02-23 14:14:10', 'Dwayne Johnson', 'Updated visitor: Vladimir Putin', 1, 1123456786),
(926, '2024-02-23 14:14:26', 'Dwayne Johnson', 'Deleted visitor: Vladimir Putin', 1, 1123456786),
(927, '2024-02-23 15:56:29', 'Super Admin', 'Logged in', NULL, 0),
(928, '2024-02-26 08:20:36', 'Super Admin', 'Logged in', NULL, 0),
(929, '2024-02-26 08:20:50', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(930, '2024-02-26 08:21:11', 'Super Admin', 'Updated Payment Status: Bill Number 1664288929, New Status: Unverified', NULL, 0),
(931, '2024-02-26 08:21:51', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Verified', NULL, 0),
(932, '2024-02-26 08:25:31', 'Super Admin', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', NULL, 0),
(933, '2024-02-26 08:31:43', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Rejected', NULL, 0),
(934, '2024-02-26 08:36:56', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(935, '2024-02-26 08:38:05', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Rejected', NULL, 0),
(936, '2024-02-26 08:40:00', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(937, '2024-02-26 08:42:38', 'Super Admin', 'Logged out', NULL, 0),
(938, '2024-02-26 08:42:50', 'Super Admin', 'Logged in', NULL, 0),
(939, '2024-02-26 08:45:01', 'Super Admin', 'Logged out', NULL, 0),
(940, '2024-02-26 08:47:57', 'Super Admin', 'Logged in', NULL, 0),
(941, '2024-02-26 08:48:11', 'Super Admin', 'Updated Payment Status: Bill Number 1664288929, New Status: Rejected', NULL, 0),
(942, '2024-02-26 09:15:03', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Rejected', NULL, 0),
(943, '2024-02-26 09:16:34', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(944, '2024-02-26 09:18:31', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Rejected', NULL, 0),
(945, '2024-02-26 09:19:33', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(946, '2024-02-26 09:21:58', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Rejected', NULL, 0),
(947, '2024-02-26 09:23:20', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(948, '2024-02-26 09:25:53', 'Super Admin', 'Deleted Payment of Jeff Bezos with Bill Number: 2011218909', NULL, 0),
(949, '2024-02-26 09:25:55', 'Super Admin', 'Deleted Payment of John Cena with Bill Number: 1664288929', NULL, 0),
(950, '2024-02-26 09:26:00', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Unverified', NULL, 0),
(951, '2024-02-26 09:26:23', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Unverified', NULL, 0),
(952, '2024-02-26 09:27:05', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Rejected', NULL, 0),
(953, '2024-02-26 09:27:48', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(954, '2024-02-26 09:27:58', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(955, '2024-02-26 09:28:52', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1992699870', NULL, 0),
(956, '2024-02-26 09:29:31', 'Super Admin', 'Deleted transaction of Casa Bougainvilla with Bill Number: 1992699870', NULL, 0),
(957, '2024-02-26 09:29:36', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(958, '2024-02-26 09:30:17', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(959, '2024-02-26 09:33:57', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(960, '2024-02-26 09:34:21', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(961, '2024-02-26 09:35:52', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(962, '2024-02-26 09:36:42', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(963, '2024-02-26 09:37:29', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(964, '2024-02-26 09:37:39', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Verified', NULL, 0),
(965, '2024-02-26 09:38:28', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(966, '2024-02-26 09:38:47', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(967, '2024-02-26 09:39:37', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Rejected', NULL, 0),
(968, '2024-02-26 09:47:07', 'Super Admin', 'Logged out', NULL, 0),
(969, '2024-02-26 09:47:19', 'Elon Musk', 'Logged in', 1, 1315648790),
(970, '2024-02-26 09:47:27', 'Elon Musk', 'Logged out', 1, 1315648790),
(971, '2024-02-26 09:48:02', 'John Cena', 'Logged in', 1, 1425648978),
(972, '2024-02-26 09:48:11', 'John Cena', 'Logged out', 1, 1425648978),
(973, '2024-02-26 09:48:23', 'Elon Musk', 'Logged in', 1, 1315648790),
(974, '2024-02-26 09:48:39', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(975, '2024-02-26 09:48:56', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(976, '2024-02-26 09:48:58', 'Elon Musk', 'Logged out', 1, 1315648790),
(977, '2024-02-26 09:49:08', 'John Cena', 'Logged in', 1, 1425648978),
(978, '2024-02-26 09:49:38', 'John Cena', 'John Cena submitted payment with Bill Number: 1664288929', 1, 1425648978),
(979, '2024-02-26 09:49:38', 'John Cena', 'John Cena submitted payment with Bill Number: 1664288929', 1, 0),
(980, '2024-02-26 09:49:54', 'John Cena', 'John Cena submitted payment with Bill Number: 1279789165', 1, 1425648978),
(981, '2024-02-26 09:49:54', 'John Cena', 'John Cena submitted payment with Bill Number: 1279789165', 1, 0),
(982, '2024-02-26 09:50:00', 'John Cena', 'Logged out', 1, 1425648978),
(983, '2024-02-26 09:50:15', 'Elon Musk', 'Logged in', 1, 1315648790),
(984, '2024-02-26 09:51:15', 'Elon Musk', 'Updated Payment Status: Bill Number 1279789165, New Status: Verified', 1, 1315648790),
(985, '2024-02-26 09:56:18', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(986, '2024-02-26 09:57:38', 'Elon Musk', 'Updated Payment Status: Bill Number 1279789165, New Status: Unverified', 1, 1315648790),
(987, '2024-02-26 09:57:47', 'Elon Musk', 'Updated Payment Status: Bill Number 1279789165, New Status: Unverified', 1, 1315648790),
(988, '2024-02-26 09:57:57', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Unverified', 1, 1315648790),
(989, '2024-02-26 09:59:28', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(990, '2024-02-26 09:59:38', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(991, '2024-02-26 11:17:20', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(992, '2024-02-26 11:17:23', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(993, '2024-02-26 11:19:11', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(994, '2024-02-26 11:19:26', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(995, '2024-02-26 11:21:18', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(996, '2024-02-26 11:21:27', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(997, '2024-02-26 11:22:44', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(998, '2024-02-26 11:27:05', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(999, '2024-02-26 11:27:21', 'Elon Musk', 'Logged out', 1, 1315648790),
(1000, '2024-02-26 11:27:39', 'Super Admin', 'Logged in', NULL, 0),
(1001, '2024-02-26 11:28:02', 'Super Admin', 'Deleted Payment of John Cena with Bill Number: 1664288929', NULL, 0),
(1002, '2024-02-26 11:28:04', 'Super Admin', 'Deleted Payment of John Cena with Bill Number: 1279789165', NULL, 0),
(1003, '2024-02-26 11:28:10', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Unverified', NULL, 0),
(1004, '2024-02-26 11:28:35', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Verified', NULL, 0),
(1005, '2024-02-26 11:28:45', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(1006, '2024-02-26 11:29:34', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(1007, '2024-02-26 11:29:52', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(1008, '2024-02-26 11:30:23', 'Super Admin', 'Logged out', NULL, 0),
(1009, '2024-02-26 11:30:34', 'Elon Musk', 'Logged in', 1, 1315648790),
(1010, '2024-02-26 11:31:02', 'Elon Musk', 'Logged out', 1, 1315648790),
(1011, '2024-02-26 11:31:06', 'John Cena', 'Logged in', 1, 1425648978),
(1012, '2024-02-26 11:31:15', 'John Cena', 'John Cena submitted payment with Bill Number: 1664288929', 1, 1425648978),
(1013, '2024-02-26 11:31:15', 'John Cena', 'John Cena submitted payment with Bill Number: 1664288929', 1, 0),
(1014, '2024-02-26 11:31:42', 'John Cena', 'John Cena submitted payment with Bill Number: 1279789165', 1, 1425648978),
(1015, '2024-02-26 11:31:42', 'John Cena', 'John Cena submitted payment with Bill Number: 1279789165', 1, 0),
(1016, '2024-02-26 11:31:49', 'John Cena', 'Logged out', 1, 1425648978),
(1017, '2024-02-26 11:32:12', 'Elon Musk', 'Logged in', 1, 1315648790),
(1018, '2024-02-26 11:32:29', 'Elon Musk', 'Updated Payment Status: Bill Number 1279789165, New Status: Verified', 1, 1315648790),
(1019, '2024-02-26 11:32:38', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(1020, '2024-02-26 11:35:25', 'Elon Musk', 'Updated Payment Status: Bill Number 1279789165, New Status: Rejected', 1, 1315648790),
(1021, '2024-02-26 11:35:44', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Rejected', 1, 1315648790),
(1022, '2024-02-26 11:36:13', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1023, '2024-02-26 11:36:23', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1024, '2024-02-26 11:41:34', 'Elon Musk', 'Logged out', 1, 1315648790),
(1025, '2024-02-26 11:41:49', 'John Cena', 'Logged in', 1, 1425648978),
(1026, '2024-02-26 11:41:56', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1027, '2024-02-26 11:43:29', 'John Cena', 'Logged out', 1, 1425648978),
(1028, '2024-02-26 11:43:45', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1029, '2024-02-26 11:43:55', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 2011218909', 1, 1603909324),
(1030, '2024-02-26 11:43:55', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 2011218909', 1, 0),
(1031, '2024-02-26 11:44:03', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 1387938587', 1, 1603909324),
(1032, '2024-02-26 11:44:03', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 1387938587', 1, 0),
(1033, '2024-02-26 11:44:06', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1034, '2024-02-26 11:44:16', 'John Cena', 'Logged in', 1, 1425648978),
(1035, '2024-02-26 11:51:20', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Verified', 1, 1425648978),
(1036, '2024-02-26 11:57:15', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1037, '2024-02-26 11:58:43', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1038, '2024-02-26 11:58:46', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1039, '2024-02-26 11:58:52', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Verified', 1, 1425648978),
(1040, '2024-02-26 11:58:55', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(1041, '2024-02-26 11:58:58', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(1042, '2024-02-26 11:59:02', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(1043, '2024-02-26 11:59:06', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Unverified', 1, 1425648978),
(1044, '2024-02-26 12:05:22', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Verified', 1, 1425648978),
(1045, '2024-02-26 12:05:31', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(1046, '2024-02-26 12:06:38', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1047, '2024-02-26 12:06:47', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(1048, '2024-02-26 12:13:43', 'John Cena', 'Logged out', 1, 1425648978),
(1049, '2024-02-26 12:13:53', 'Super Admin', 'Logged in', NULL, 0),
(1050, '2024-02-26 12:14:19', 'Super Admin', 'Deleted Payment of Jeff Bezos with Bill Number: 1387938587', NULL, 0),
(1051, '2024-02-26 12:14:22', 'Super Admin', 'Deleted Payment of Jeff Bezos with Bill Number: 2011218909', NULL, 0),
(1052, '2024-02-26 12:15:00', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Verified', NULL, 0),
(1053, '2024-02-26 12:15:13', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(1054, '2024-02-26 12:16:01', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Rejected', NULL, 0),
(1055, '2024-02-26 12:16:56', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Rejected', NULL, 0),
(1056, '2024-02-26 12:18:02', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(1057, '2024-02-26 12:18:11', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(1058, '2024-02-26 12:19:21', 'Super Admin', 'Logged out', NULL, 0),
(1059, '2024-02-26 12:19:32', 'Elon Musk', 'Logged in', 1, 1315648790),
(1060, '2024-02-26 12:19:41', 'Elon Musk', 'Updated Payment Status: Bill Number 1279789165, New Status: Rejected', 1, 1315648790),
(1061, '2024-02-26 12:19:51', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Rejected', 1, 1315648790),
(1062, '2024-02-26 12:20:38', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1063, '2024-02-26 12:20:48', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1064, '2024-02-26 12:21:26', 'Elon Musk', 'Logged out', 1, 1315648790),
(1065, '2024-02-26 12:21:38', 'John Cena', 'Logged in', 1, 1425648978),
(1066, '2024-02-26 12:21:50', 'John Cena', 'Logged out', 1, 1425648978),
(1067, '2024-02-26 12:22:02', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1068, '2024-02-26 12:22:09', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 2011218909', 1, 1603909324),
(1069, '2024-02-26 12:22:09', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 2011218909', 1, 0),
(1070, '2024-02-26 12:22:16', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 1387938587', 1, 1603909324),
(1071, '2024-02-26 12:22:16', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 1387938587', 1, 0),
(1072, '2024-02-26 12:22:19', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1073, '2024-02-26 12:22:29', 'John Cena', 'Logged in', 1, 1425648978),
(1074, '2024-02-26 12:22:36', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Verified', 1, 1425648978),
(1075, '2024-02-26 12:22:45', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(1076, '2024-02-26 12:23:24', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(1077, '2024-02-26 12:23:34', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(1078, '2024-02-26 12:23:44', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Unverified', 1, 1425648978),
(1079, '2024-02-26 12:24:13', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Verified', 1, 1425648978),
(1080, '2024-02-26 12:24:23', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(1081, '2024-02-26 12:25:07', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1082, '2024-02-26 12:25:16', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(1083, '2024-02-26 12:26:02', 'John Cena', 'Logged out', 1, 1425648978),
(1084, '2024-02-26 12:26:16', 'Super Admin', 'Logged in', NULL, 0),
(1085, '2024-02-26 12:27:51', 'Super Admin', 'Logged out', NULL, 0),
(1086, '2024-02-26 12:28:07', 'Elon Musk', 'Logged in', 1, 1315648790),
(1087, '2024-02-26 12:31:21', 'Elon Musk', 'Logged out', 1, 1315648790),
(1088, '2024-02-26 12:34:03', 'Super Admin', 'Logged in', NULL, 0),
(1089, '2024-02-26 13:07:02', 'Super Admin', 'Logged in', NULL, 0),
(1090, '2024-02-26 13:07:32', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Unverified', NULL, 0),
(1091, '2024-02-26 13:07:42', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Unverified', NULL, 0),
(1092, '2024-02-26 13:10:16', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 2126914746', NULL, 0),
(1093, '2024-02-26 13:10:25', 'Super Admin', 'Updated transaction of Casa Bougainvilla with Bill Number: 1507498433', NULL, 0),
(1094, '2024-02-26 13:11:00', 'Super Admin', 'Logged out', NULL, 0),
(1095, '2024-02-26 13:12:00', 'Elon Musk', 'Logged in', 1, 1315648790),
(1096, '2024-02-26 13:12:11', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1097, '2024-02-26 13:12:21', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1098, '2024-02-26 13:13:13', 'Elon Musk', 'Updated Payment Status: Bill Number 1279789165, New Status: Verified', 1, 1315648790),
(1099, '2024-02-26 13:13:22', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(1100, '2024-02-26 13:14:13', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1101, '2024-02-26 13:14:24', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1102, '2024-02-26 13:15:05', 'Elon Musk', 'Logged out', 1, 1315648790),
(1103, '2024-02-26 13:15:15', 'John Cena', 'Logged in', 1, 1425648978),
(1104, '2024-02-26 13:15:30', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Verified', 1, 1425648978),
(1105, '2024-02-26 13:15:39', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(1106, '2024-02-26 13:16:40', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1107, '2024-02-26 13:16:50', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(1108, '2024-02-26 13:18:00', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1109, '2024-02-26 13:18:13', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(1110, '2024-02-26 13:19:55', 'John Cena', 'Logged out', 1, 1425648978),
(1111, '2024-02-27 03:30:32', 'Super Admin', 'Logged in', NULL, 0),
(1112, '2024-02-27 03:37:44', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Rejected', NULL, 0),
(1113, '2024-02-27 03:45:26', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(1114, '2024-02-27 03:47:23', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Rejected', NULL, 0),
(1115, '2024-02-27 03:48:19', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Rejected', NULL, 0),
(1116, '2024-02-27 03:48:47', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(1117, '2024-02-27 03:51:28', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Unverified', NULL, 0),
(1118, '2024-02-27 03:55:44', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Rejected', NULL, 0),
(1119, '2024-02-27 03:56:26', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Rejected', NULL, 0),
(1120, '2024-02-27 03:56:50', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(1121, '2024-02-27 03:57:12', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Unverified', NULL, 0),
(1122, '2024-02-27 03:57:15', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Unverified', NULL, 0),
(1123, '2024-02-27 04:15:52', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(1124, '2024-02-27 04:18:00', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Verified', NULL, 0),
(1125, '2024-02-27 04:19:52', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Unverified', NULL, 0),
(1126, '2024-02-27 04:19:54', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Unverified', NULL, 0),
(1127, '2024-02-27 04:20:01', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Verified', NULL, 0),
(1128, '2024-02-27 04:20:09', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Verified', NULL, 0),
(1129, '2024-02-27 04:20:39', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Rejected', NULL, 0),
(1130, '2024-02-27 04:20:43', 'Super Admin', 'Updated Payment Status: Bill Number 1507498433, New Status: Unverified', NULL, 0),
(1131, '2024-02-27 04:20:45', 'Super Admin', 'Updated Payment Status: Bill Number 2126914746, New Status: Verified', NULL, 0),
(1157, '2024-02-27 05:10:13', 'Elon Musk', 'Logged in', 1, 1315648790),
(1158, '2024-02-27 05:10:32', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(1159, '2024-02-27 05:15:58', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1160, '2024-02-27 05:16:04', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1161, '2024-02-27 05:17:43', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1162, '2024-02-27 05:19:45', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1163, '2024-02-27 05:19:47', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1164, '2024-02-27 05:20:01', 'Elon Musk', 'Updated Payment Status: Bill Number 1279789165, New Status: Verified', 1, 1315648790),
(1165, '2024-02-27 05:20:57', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1166, '2024-02-27 05:22:52', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1167, '2024-02-27 05:22:54', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1168, '2024-02-27 05:23:08', 'Elon Musk', 'Updated Payment Status: Bill Number 1664288929, New Status: Verified', 1, 1315648790),
(1169, '2024-02-27 05:23:53', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1170, '2024-02-27 05:25:29', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1171, '2024-02-27 05:25:31', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1172, '2024-02-27 05:25:34', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1279789165', 1, 1315648790),
(1173, '2024-02-27 05:26:42', 'Elon Musk', 'Updated transaction for resident: John Cena with Bill Number: 1664288929', 1, 1315648790),
(1174, '2024-02-27 05:45:14', 'Elon Musk', 'Logged out', 1, 1315648790),
(1175, '2024-02-27 05:45:31', 'John Cena', 'Logged in', 1, 1425648978),
(1176, '2024-02-27 05:45:46', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(1177, '2024-02-27 05:45:47', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(1178, '2024-02-27 05:45:49', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Unverified', 1, 1425648978),
(1179, '2024-02-27 05:45:55', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(1180, '2024-02-27 05:46:51', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(1181, '2024-02-27 05:46:57', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(1182, '2024-02-27 05:47:36', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1183, '2024-02-27 05:48:47', 'John Cena', 'Logged out', 1, 1425648978),
(1201, '2024-02-27 06:35:45', 'Elon Musk', 'Logged in', 1, 1315648790),
(1202, '2024-02-27 06:36:19', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1497137188', 1, 0),
(1203, '2024-02-27 06:38:55', 'Elon Musk', 'Deleted transaction for resident: John Cena with Bill Number: 1497137188', 1, 0),
(1204, '2024-02-27 06:39:24', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1515815091', 1, 0),
(1205, '2024-02-27 07:07:11', 'Elon Musk', 'Logged out', 1, 1315648790),
(1206, '2024-02-27 07:07:22', 'John Cena', 'Logged in', 1, 1425648978),
(1207, '2024-02-27 07:07:57', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1031027443', 1, 1425648978),
(1208, '2024-02-27 07:11:09', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1031027443', 1, 1425648978),
(1209, '2024-02-27 07:11:31', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Unverified', 1, 1425648978),
(1210, '2024-02-27 07:11:33', 'John Cena', 'Updated Payment Status: Bill Number 1387938587, New Status: Unverified', 1, 1425648978),
(1211, '2024-02-27 07:11:37', 'John Cena', 'Deleted transaction of Jeff Bezos with Bill Number: 1031027443', 1, 1425648978),
(1212, '2024-02-27 07:11:43', 'John Cena', 'Updated Payment Status: Bill Number 2011218909, New Status: Verified', 1, 1425648978),
(1213, '2024-02-27 07:12:14', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1214, '2024-02-27 07:13:01', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(1215, '2024-02-27 07:13:03', 'John Cena', 'Updated transaction for tenant: Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1216, '2024-02-27 07:13:22', 'John Cena', 'Deleted Payment of Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(1217, '2024-02-27 07:13:24', 'John Cena', 'Deleted Payment of Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1218, '2024-02-27 07:13:28', 'John Cena', 'Deleted transaction of Jeff Bezos with Bill Number: 2011218909', 1, 1425648978),
(1219, '2024-02-27 07:13:30', 'John Cena', 'Deleted transaction of Jeff Bezos with Bill Number: 1387938587', 1, 1425648978),
(1220, '2024-02-27 07:16:35', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 2063449284', 1, 1425648978),
(1221, '2024-02-27 07:17:05', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1889294090', 1, 1425648978),
(1222, '2024-02-27 07:17:40', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 2100803446', 1, 1425648978),
(1223, '2024-02-27 07:18:36', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1432916449', 1, 1425648978),
(1224, '2024-02-27 07:19:10', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1787201882', 1, 1425648978),
(1225, '2024-02-27 07:19:57', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1311493035', 1, 1425648978),
(1226, '2024-02-27 07:20:48', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1546830751', 1, 1425648978),
(1227, '2024-02-27 07:21:37', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1157288865', 1, 1425648978);
INSERT INTO `activity_logs` (`id`, `timestamp`, `user`, `action`, `condominium_id`, `account_number`) VALUES
(1228, '2024-02-27 07:22:17', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 2043672277', 1, 1425648978),
(1229, '2024-02-27 07:23:09', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1945819371', 1, 1425648978),
(1230, '2024-02-27 07:23:59', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1794549695', 1, 1425648978),
(1231, '2024-02-27 07:24:48', 'John Cena', 'Added transaction for tenant: Jeff Bezos with Bill Number: 1597087706', 1, 1425648978),
(1232, '2024-02-27 07:25:51', 'John Cena', 'Updated Unit: 110', 1, 1425648978),
(1233, '2024-02-27 07:26:15', 'John Cena', 'Logged out', 1, 1425648978),
(1234, '2024-02-27 07:26:42', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1235, '2024-02-27 07:27:07', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 1597087706', 1, 1603909324),
(1236, '2024-02-27 07:27:07', 'Jeff Bezos', 'Jeff Bezos submitted payment with Bill Number: 1597087706', 1, 0),
(1237, '2024-02-27 07:27:14', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1238, '2024-02-27 07:27:25', 'John Cena', 'Logged in', 1, 1425648978),
(1239, '2024-02-27 07:28:04', 'John Cena', 'Logged out', 1, 1425648978),
(1240, '2024-02-27 07:28:18', 'Elon Musk', 'Logged in', 1, 1315648790),
(1241, '2024-02-27 07:28:23', 'Elon Musk', 'Deleted transaction for resident: John Cena with Bill Number: 1515815091', 1, 0),
(1242, '2024-02-27 07:28:25', 'Elon Musk', 'Deleted transaction for resident: John Cena with Bill Number: 1279789165', 1, 0),
(1243, '2024-02-27 07:28:26', 'Elon Musk', 'Deleted transaction for resident: John Cena with Bill Number: 1664288929', 1, 0),
(1244, '2024-02-27 07:28:33', 'Elon Musk', 'Deleted Payment of John Cena with Bill Number: 1279789165', 1, 1315648790),
(1245, '2024-02-27 07:28:34', 'Elon Musk', 'Deleted Payment of John Cena with Bill Number: 1664288929', 1, 1315648790),
(1246, '2024-02-27 07:29:38', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1421981708', 1, 0),
(1247, '2024-02-27 07:31:03', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1940050104', 1, 0),
(1248, '2024-02-27 07:31:43', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 2032858393', 1, 0),
(1249, '2024-02-27 07:34:31', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1126343899', 1, 0),
(1250, '2024-02-27 07:35:14', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1004724001', 1, 0),
(1251, '2024-02-27 07:36:41', 'Elon Musk', 'Reinstated Resident: Jimmy Fallon. Reason: conflict resolved', 1, 0),
(1252, '2024-02-27 07:37:37', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1704846284', 1, 0),
(1253, '2024-02-27 07:38:29', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1778301171', 1, 0),
(1254, '2024-02-27 07:39:16', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1785619747', 1, 0),
(1255, '2024-02-27 07:40:07', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1758874096', 1, 0),
(1256, '2024-02-27 07:41:11', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 2110738401', 1, 0),
(1257, '2024-02-27 07:41:45', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1862959364', 1, 0),
(1258, '2024-02-27 07:42:32', 'Elon Musk', 'Added transaction for resident: John Cena with Bill Number: 1879028146', 1, 0),
(1259, '2024-02-27 07:43:33', 'Elon Musk', 'Logged out', 1, 1315648790),
(1260, '2024-02-27 07:43:45', 'John Cena', 'Logged in', 1, 1425648978),
(1261, '2024-02-27 07:44:02', 'John Cena', 'John Cena submitted payment with Bill Number: 1497137188', 1, 1425648978),
(1262, '2024-02-27 07:44:02', 'John Cena', 'John Cena submitted payment with Bill Number: 1497137188', 1, 0),
(1263, '2024-02-27 07:44:22', 'John Cena', 'Logged out', 1, 1425648978),
(1264, '2024-02-27 07:45:25', 'John Cena', 'Logged in', 1, 1425648978),
(1265, '2024-02-27 07:45:38', 'John Cena', 'Logged out', 1, 1425648978),
(1266, '2024-02-27 07:45:52', 'Elon Musk', 'Logged in', 1, 1315648790),
(1267, '2024-02-27 07:46:10', 'Elon Musk', 'Logged out', 1, 1315648790),
(1297, '2024-02-27 08:01:08', 'Hank Schrader', 'Logged in', 19, 1147483647),
(1298, '2024-02-27 08:01:28', 'Hank Schrader', 'Hank Schrader submitted payment with Bill Number: 1224136885', 1, 0),
(1299, '2024-02-27 08:01:28', 'Hank Schrader', 'Hank Schrader submitted payment with Bill Number: 1224136885', NULL, 0),
(1300, '2024-02-27 08:01:32', 'Hank Schrader', 'Logged out', 19, 1147483647),
(1305, '2024-02-27 08:06:57', 'Elon Musk', 'Logged in', 1, 1315648790),
(1306, '2024-02-27 08:13:36', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1411683345', 1, 0),
(1307, '2024-02-27 08:13:36', 'Elon Musk', 'Elon Musk submitted payment with Bill Number: 1411683345', NULL, 0),
(1308, '2024-02-27 08:13:43', 'Elon Musk', 'Logged out', 1, 1315648790),
(1309, '2024-02-27 08:14:01', 'Super Admin', 'Logged in', NULL, 0),
(1310, '2024-02-27 08:24:58', 'Super Admin', 'Logged out', NULL, 0),
(1322, '2024-03-02 14:05:08', 'Elon Musk', 'Logged in', 1, 1315648790),
(1323, '2024-03-02 14:42:05', 'Elon Musk', 'Added an Item: Broom', 1, 0),
(1324, '2024-03-02 14:42:11', 'Elon Musk', 'Added an Item: Dustpan', 1, 0),
(1325, '2024-03-02 14:43:12', 'Elon Musk', 'Added an Item: Mop', 1, 0),
(1326, '2024-03-02 15:07:49', 'Elon Musk', 'Added an Item: Door Knob', 1, 0),
(1327, '2024-03-02 16:48:12', 'Elon Musk', 'Added an Item: Broom', 1, 0),
(1328, '2024-03-02 16:48:21', 'Elon Musk', 'Added an Item: Dustpan', 1, 0),
(1329, '2024-03-02 16:50:22', 'Elon Musk', 'Added an Item: Broom', 1, 0),
(1330, '2024-03-02 16:50:28', 'Elon Musk', 'Added an Item: Dustpan', 1, 0),
(1331, '2024-03-02 17:09:56', 'Elon Musk', 'Updated Item: Broom', 1, 0),
(1332, '2024-03-03 04:41:21', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(1333, '2024-03-03 04:47:51', 'Dwayne Johnson', 'Added an Item: Door Knob', 1, 0),
(1334, '2024-03-03 04:51:05', 'Dwayne Johnson', 'Updated Item: Door Knob', 1, 0),
(1335, '2024-03-03 05:03:51', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(1336, '2024-03-03 05:04:06', 'Elon Musk', 'Logged in', 1, 1315648790),
(1337, '2024-03-03 05:04:40', 'Elon Musk', 'Added an Item: Mop', 1, 0),
(1338, '2024-03-03 05:04:51', 'Elon Musk', 'Logged out', 1, 1315648790),
(1339, '2024-03-03 05:06:16', 'John Cena', 'Logged in', 1, 1425648978),
(1340, '2024-03-03 06:57:33', 'John Cena', 'Logged out', 1, 1425648978),
(1341, '2024-03-03 06:57:49', 'Elon Musk', 'Logged in', 1, 1315648790),
(1342, '2024-03-03 06:57:54', 'Elon Musk', 'Logged out', 1, 1315648790),
(1343, '2024-03-03 06:58:08', 'John Cena', 'Logged in', 1, 1425648978),
(1344, '2024-03-03 07:46:18', 'John Cena', 'Logged out', 1, 1425648978),
(1345, '2024-03-03 07:48:32', 'Elon Musk', 'Logged in', 1, 1315648790),
(1346, '2024-03-03 07:48:38', 'Elon Musk', 'Logged out', 1, 1315648790),
(1347, '2024-03-03 07:49:05', 'John Cena', 'Logged in', 1, 1425648978),
(1348, '2024-03-03 08:51:40', 'John Cena', 'Logged out', 1, 1425648978),
(1349, '2024-03-03 09:04:11', 'John Cena', 'Logged in', 1, 1425648978),
(1350, '2024-03-03 12:24:49', 'John Cena', 'Logged in', 1, 1425648978),
(1351, '2024-03-03 12:25:38', 'John Cena', 'Requested an Item: Broom and Quantity: 2', 1, 0),
(1352, '2024-03-03 12:27:05', 'John Cena', 'Requested an Item: Mop and Quantity: 1', 1, 0),
(1353, '2024-03-03 12:31:53', 'John Cena', 'Logged out', 1, 1425648978),
(1354, '2024-03-03 12:32:08', 'Elon Musk', 'Logged in', 1, 1315648790),
(1355, '2024-03-03 12:32:29', 'Elon Musk', 'Logged out', 1, 1315648790),
(1356, '2024-03-03 12:32:47', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1357, '2024-03-03 12:39:47', 'Jeff Bezos', 'Requested an Item: Door Knob and Quantity: 2', 1, 0),
(1358, '2024-03-03 12:45:42', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1359, '2024-03-03 12:45:58', 'Elon Musk', 'Logged in', 1, 1315648790),
(1360, '2024-03-03 12:59:59', 'Elon Musk', 'Logged out', 1, 1315648790),
(1361, '2024-03-03 13:00:55', 'Elon Musk', 'Logged in', 1, 1315648790),
(1362, '2024-03-03 14:12:43', 'Elon Musk', 'Added an Item: Light Bulb', 1, 0),
(1363, '2024-03-03 14:18:13', 'Elon Musk', 'Logged out', 1, 1315648790),
(1364, '2024-03-03 14:19:17', 'Elon Musk', 'Logged in', 1, 1315648790),
(1365, '2024-03-03 15:04:31', 'Elon Musk', 'Deleted Item: Mop, 3', 1, 0),
(1366, '2024-03-03 15:04:39', 'Elon Musk', 'Logged out', 1, 1315648790),
(1367, '2024-03-03 15:04:55', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(1368, '2024-03-03 15:11:24', 'Dwayne Johnson', 'Added an Item: Lamp', 1, 0),
(1369, '2024-03-03 15:11:26', 'Dwayne Johnson', 'Deleted Item: Light Bulb, 10', 1, 0),
(1370, '2024-03-03 15:11:34', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(1371, '2024-03-03 15:30:34', 'Elon Musk', 'Logged in', 1, 1315648790),
(1372, '2024-03-03 15:51:03', 'Elon Musk', 'Added a Category: ,  with Amount: 10000.', 1, 0),
(1373, '2024-03-03 15:51:30', 'Elon Musk', 'Added a Category: ,  with Amount: 11000.', 1, 0),
(1374, '2024-03-03 16:53:08', 'Elon Musk', 'Logged out', 1, 1315648790),
(1375, '2024-03-03 16:53:52', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(1376, '2024-03-03 16:54:51', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(1377, '2024-03-04 05:02:14', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1378, '2024-03-04 05:21:53', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1379, '2024-03-04 05:22:21', 'Elon Musk', 'Logged in', 1, 1315648790),
(1380, '2024-03-04 05:43:30', 'Elon Musk', 'Logged out', 1, 1315648790),
(1381, '2024-03-04 05:43:40', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(1382, '2024-03-04 05:57:08', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(1383, '2024-03-04 05:57:19', 'John Cena', 'Logged in', 1, 1425648978),
(1384, '2024-03-04 06:02:09', 'John Cena', 'Logged out', 1, 1425648978),
(1385, '2024-03-04 06:02:34', 'Elon Musk', 'Logged in', 1, 1315648790),
(1386, '2024-03-04 06:02:41', 'Elon Musk', 'Logged out', 1, 1315648790),
(1387, '2024-03-04 06:03:55', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1388, '2024-03-04 06:04:56', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1389, '2024-03-04 06:05:12', 'John Cena', 'Logged in', 1, 1425648978),
(1390, '2024-03-04 06:20:50', 'John Cena', 'Logged out', 1, 1425648978),
(1391, '2024-03-04 06:21:27', 'Elon Musk', 'Logged in', 1, 1315648790),
(1392, '2024-03-04 06:43:01', 'Elon Musk', 'Logged out', 1, 1315648790),
(1393, '2024-03-04 06:43:18', 'Elon Musk', 'Logged in', 1, 1315648790),
(1394, '2024-03-04 08:08:00', 'Elon Musk', 'Deleted Budget Category: , ', 1, 0),
(1395, '2024-03-04 08:08:02', 'Elon Musk', 'Deleted Budget Category: , ', 1, 0),
(1396, '2024-03-04 08:08:13', 'Elon Musk', 'Added a Category: Maintenance,  with Amount: 10000.', 1, 0),
(1397, '2024-03-04 08:08:25', 'Elon Musk', 'Added a Category: Security,  with Amount: 11000.', 1, 0),
(1398, '2024-03-04 08:16:13', 'Elon Musk', 'Deleted Budget Category: , Amount: ', 1, 0),
(1399, '2024-03-04 08:22:20', 'Elon Musk', 'Deleted Budget Category: , Amount: ', 1, 0),
(1400, '2024-03-04 08:24:01', 'Elon Musk', 'Deleted Budget Category: Security, Amount: 11000', 1, 0),
(1401, '2024-03-04 08:24:35', 'Elon Musk', 'Logged out', 1, 1315648790),
(1402, '2024-03-04 08:25:28', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(1403, '2024-03-04 08:25:40', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(1404, '2024-03-04 08:33:47', 'Elon Musk', 'Logged in', 1, 1315648790),
(1405, '2024-03-04 08:36:28', 'Elon Musk', 'Logged out', 1, 1315648790),
(1406, '2024-03-04 08:36:41', 'John Cena', 'Logged in', 1, 1425648978),
(1407, '2024-03-04 11:19:34', 'John Cena', 'Submitted a request: Fix Bathroom Sink', 1, 0),
(1408, '2024-03-04 12:37:57', 'John Cena', 'Submitted a request: Fix Bathroom Sink Leak', 1, 0),
(1409, '2024-03-04 12:45:42', 'John Cena', 'Submitted a request: Fix Bathroom Sink Leak', 1, 0),
(1410, '2024-03-04 13:37:12', 'John Cena', 'Logged out', 1, 1425648978),
(1411, '2024-03-04 13:37:45', 'Elon Musk', 'Logged in', 1, 1315648790),
(1412, '2024-03-04 14:21:01', 'Elon Musk', 'Logged out', 1, 1315648790),
(1413, '2024-03-04 14:22:00', 'John Cena', 'Logged in', 1, 1425648978),
(1414, '2024-03-04 14:26:53', 'John Cena', 'Submitted a request: Faucet is not working', 1, 0),
(1415, '2024-03-04 14:28:53', 'John Cena', 'Submitted a request: My laptop is broken', 1, 0),
(1416, '2024-03-04 14:53:29', 'John Cena', 'Submitted a request: Window Frame Replacement', 1, 0),
(1417, '2024-03-04 14:54:59', 'John Cena', 'Logged out', 1, 1425648978),
(1418, '2024-03-04 14:55:26', 'Elon Musk', 'Logged in', 1, 1315648790),
(1419, '2024-03-05 02:32:05', 'Elon Musk', 'Logged in', 1, 1315648790),
(1420, '2024-03-05 03:44:49', 'Elon Musk', 'Rejected a request: My laptop is broken', 1, 0),
(1421, '2024-03-05 05:02:31', 'Elon Musk', 'Resolved a request: Fix Bathroom Sink Leak', 1, 0),
(1422, '2024-03-05 05:03:11', 'Elon Musk', 'Logged out', 1, 1315648790),
(1423, '2024-03-05 05:03:49', 'John Cena', 'Logged in', 1, 1425648978),
(1424, '2024-03-05 05:21:12', 'John Cena', 'Logged out', 1, 1425648978),
(1425, '2024-03-05 05:21:24', 'Elon Musk', 'Logged in', 1, 1315648790),
(1426, '2024-03-05 05:22:08', 'Elon Musk', 'Logged out', 1, 1315648790),
(1427, '2024-03-05 05:22:22', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1428, '2024-03-05 05:36:20', 'Jeff Bezos', 'Submitted a repair request: Door Knob is not working', 1, 0),
(1429, '2024-03-05 05:38:11', 'Jeff Bezos', 'Submitted a repair request: PlayStation 4 Fix', 1, 0),
(1430, '2024-03-05 05:39:28', 'Jeff Bezos', 'Submitted a repair request: Kitchen light needs bulb replacement', 1, 0),
(1431, '2024-03-05 05:39:43', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1432, '2024-03-05 05:40:02', 'Elon Musk', 'Logged in', 1, 1315648790),
(1433, '2024-03-05 05:41:05', 'Elon Musk', 'Resolved a request: Door Knob is not working', 1, 0),
(1434, '2024-03-05 05:41:31', 'Elon Musk', 'Rejected a request: PlayStation 4 Fix', 1, 0),
(1435, '2024-03-05 05:41:43', 'Elon Musk', 'Logged out', 1, 1315648790),
(1436, '2024-03-05 05:41:52', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1437, '2024-03-05 05:42:54', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1438, '2024-03-05 05:43:04', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(1439, '2024-03-05 05:59:56', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(1440, '2024-03-05 06:00:24', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1441, '2024-03-05 06:00:56', 'Jeff Bezos', 'Submitted a repair request: My phone is not working', 1, 0),
(1442, '2024-03-05 06:01:11', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1443, '2024-03-05 06:01:23', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(1444, '2024-03-05 06:01:41', 'Dwayne Johnson', 'Rejected a request: My phone is not working', 1, 0),
(1445, '2024-03-05 06:04:43', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(1446, '2024-03-05 06:04:54', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1447, '2024-03-05 06:05:21', 'Jeff Bezos', 'Submitted a repair request: Speaker needs fixing', 1, 0),
(1448, '2024-03-05 06:05:31', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1449, '2024-03-05 06:05:40', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(1450, '2024-03-05 06:06:00', 'Dwayne Johnson', 'Rejected a request: Speaker needs fixing', 1, 0),
(1451, '2024-03-05 06:16:52', 'Dwayne Johnson', 'Logged out', 1, 1123456786),
(1452, '2024-03-05 06:17:12', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1453, '2024-03-05 06:17:27', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1454, '2024-03-05 06:24:08', 'Jeff Bezos', 'Logged in', 1, 1603909324),
(1455, '2024-03-05 06:25:00', 'Jeff Bezos', 'Submitted a repair request: Window Frame Replacement', 1, 0),
(1456, '2024-03-05 06:25:32', 'Jeff Bezos', 'Logged out', 1, 1603909324),
(1457, '2024-03-05 06:25:42', 'Dwayne Johnson', 'Logged in', 1, 1123456786),
(1458, '2024-03-05 06:26:05', 'Dwayne Johnson', 'Resolved a request: Window Frame Replacement', 1, 0),
(1459, '2024-03-05 06:27:27', 'Dwayne Johnson', 'Logged out', 1, 1123456786);

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
(13, 1315648790, 'Casa Bougainvilla', '1579434797', '2024-01-01', '2024-01-31', '2024-02-10', 1000.00, 'Paid', 1),
(14, 1315648790, 'Casa Bougainvilla', '1110782496', '2024-02-01', '2024-02-29', '2024-03-10', 2000.00, 'Paid', 1),
(15, 1315648790, 'Casa Bougainvilla', '1368997250', '2024-03-01', '2024-03-31', '2024-04-10', 3000.00, 'Paid', 1),
(16, 1315648790, 'Casa Bougainvilla', '1147911760', '2024-04-01', '2024-04-30', '2024-05-10', 4000.00, 'Paid', 1),
(17, 1315648790, 'Casa Bougainvilla', '2027138614', '2024-06-01', '2024-06-30', '2024-07-10', 5000.00, 'Paid', 1),
(18, 1315648790, 'Casa Bougainvilla', '1624999527', '2024-07-01', '2024-07-31', '2024-08-10', 6000.00, 'Paid', 1),
(19, 1315648790, 'Casa Bougainvilla', '1920125792', '2024-08-01', '2024-08-31', '2024-09-10', 7000.00, 'Paid', 1),
(20, 1315648790, 'Casa Bougainvilla', '1124946631', '2024-09-01', '2024-09-30', '2024-10-10', 8000.00, 'Paid', 1),
(21, 1315648790, 'Casa Bougainvilla', '2116930269', '2024-10-01', '2024-10-31', '2024-11-10', 9000.00, 'Paid', 1),
(22, 1315648790, 'Casa Bougainvilla', '1507498433', '2024-11-01', '2024-01-31', '2024-12-10', 10000.00, 'Paid', 1),
(23, 1315648790, 'Casa Bougainvilla', '2126914746', '2024-12-01', '2024-12-31', '2024-01-10', 11000.00, 'Paid', 1),
(24, 1315648790, 'Casa Bougainvilla', '1992699870', '2024-01-01', '2024-01-31', '2024-02-17', 3000.00, 'Pending', 1),
(25, 1315648790, 'Casa Bougainvilla', '1656073275', '2024-02-01', '2024-02-29', '2024-03-10', 10000.00, 'Pending', 1),
(26, 1315648790, 'Casa Bougainvilla', '2099310292', '2024-02-01', '2024-02-29', '2024-03-10', 6999.00, 'Pending', 1),
(27, 1315648790, 'Casa Bougainvilla', '2065473923', '2024-02-01', '2024-02-29', '2024-03-10', 4200.00, 'Pending', 1),
(28, 1315648790, 'Casa Bougainvilla', '1208486832', '2024-02-01', '2024-02-29', '2024-02-10', 5000.00, 'Pending', 1),
(29, 1315648790, 'Casa Bougainvilla', '1497011481', '2024-02-01', '2024-02-29', '2024-03-10', 9999.00, 'Pending', 1),
(30, 1315648790, 'Casa Bougainvilla', '1575992702', '2024-02-01', '2024-02-29', '2024-03-10', 7777.00, 'Pending', 1),
(31, 1315648790, 'Casa Bougainvilla', '1235824485', '2024-02-01', '2024-02-29', '2024-03-10', 4444.00, 'Pending', 1),
(32, 1315648790, 'Casa Bougainvilla', '1231313250', '2024-02-01', '2024-02-29', '2024-03-10', 3333.00, 'Pending', 1),
(33, 1315648790, 'Casa Bougainvilla', '1749419180', '2024-01-01', '2024-01-31', '2024-02-10', 3153.41, 'Pending', 0),
(34, 1315648790, 'Casa Bougainvilla', '1839887416', '2024-02-01', '2024-02-29', '2024-03-10', 3153.41, 'Pending', 0),
(35, 1315648790, 'Casa Bougainvilla', '1750138262', '2024-03-01', '2024-03-31', '2024-04-10', 3153.41, 'Pending', 0),
(36, 1315648790, 'Casa Bougainvilla', '1222375318', '2024-04-01', '2024-04-30', '2024-05-10', 3153.41, 'Pending', 0),
(37, 1315648790, 'Casa Bougainvilla', '1991362069', '2024-05-01', '2024-05-31', '2024-06-10', 3153.41, 'Pending', 0),
(38, 1315648790, 'Casa Bougainvilla', '1146581164', '2024-06-01', '2024-06-30', '2024-07-10', 3153.41, 'Pending', 0),
(39, 1315648790, 'Casa Bougainvilla', '1313556508', '2024-07-01', '2024-07-31', '2024-08-10', 3153.41, 'Pending', 0),
(40, 1315648790, 'Casa Bougainvilla', '1249238413', '2024-08-01', '2024-08-31', '2024-09-10', 3153.41, 'Pending', 0),
(41, 1315648790, 'Casa Bougainvilla', '1913541493', '2024-09-01', '2024-09-30', '2024-10-10', 3153.41, 'Pending', 0),
(42, 1315648790, 'Casa Bougainvilla', '1951223570', '2024-10-01', '2024-10-31', '2024-11-10', 3153.41, 'Pending', 0),
(43, 1315648790, 'Casa Bougainvilla', '1823144690', '2024-11-01', '2024-11-30', '2024-12-10', 3153.41, 'Pending', 0),
(44, 1315648790, 'Casa Bougainvilla', '1411683345', '2024-12-01', '2024-12-31', '2025-01-10', 3153.41, 'Pending', 0),
(45, 1147483647, 'Casa Salamanca', '1224136885', '2024-01-01', '2024-01-31', '2024-02-10', 3153.41, 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `association`
--

CREATE TABLE `association` (
  `account_number` int(11) NOT NULL,
  `condominium_id` int(11) NOT NULL,
  `role` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `association`
--

INSERT INTO `association` (`account_number`, `condominium_id`, `role`) VALUES
(0, 0, 'Super Administrator'),
(1425648978, 1, 'Resident'),
(1123456786, 1, 'Front Desk'),
(1315648790, 1, 'Administrator'),
(1101483647, 1, 'Administrator'),
(1095279156, 1, 'Administrator'),
(1147483647, 19, 'Administrator'),
(1883187512, 21, 'Administrator'),
(2028470966, 18, 'Administrator'),
(1510158441, 22, 'Administrator'),
(1747194577, 1, 'Resident'),
(1983123405, 1, 'Resident'),
(2018384520, 1, 'Administrator'),
(2144409403, 1, 'Resident'),
(1617546162, 1, 'Resident'),
(1374395981, 1, 'Resident'),
(1529915200, 18, 'Resident'),
(1710804190, 26, 'Administrator'),
(1856179449, 18, 'Resident'),
(2001454056, 1, 'Resident'),
(1988229586, 19, 'Administrator'),
(2097438436, 1, 'Front Desk'),
(1603909324, 1, 'Tenant'),
(1777213686, 1, 'Tenant');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `condominium_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`condominium_id`, `id`, `category`, `amount`, `is_deleted`) VALUES
(1, 1, 'Maintenance', 10000, 0),
(1, 2, 'Security', 11000, 0);

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
(1, 'Casa Bougainvilla', 'Elon Musk', '3834 Mascardo, Makati, 1204 Metro Manila', 0, '', NULL, 'PAID', 'APPROVED', 0x4d79486f6d6548756220436f6e74726163745f313730393133373332342e706466),
(18, 'Trump Tower', 'Hank Schrader', 'Manhattan, New York', 0, '', NULL, 'PAID', 'APPROVED', 0x4d79486f6d6548756220436f6e74726163745f313730393133373336332e706466),
(19, 'Casa Salamanca', 'Elon Musk', 'Kawit, Cavite', 0, 'Breach of Contract', 'Contract Renewed', 'PENDING', 'PENDING', 0x4d79486f6d6548756220436f6e74726163745f313730393133373537312e706466),
(21, 'Pinkerton Condominium', 'Jimmy Gibbs Jr.', 'New Austin, Texas', 0, '', NULL, 'PENDING', 'PENDING', 0x4d79486f6d6548756220436f6e74726163745f313730393133373535362e706466),
(22, 'West Viriginia', 'Jimmy Carter X', 'Westwoods, West Virginia', 0, '', NULL, 'PAID', 'APPROVED', 0x4d79486f6d6548756220436f6e74726163745f313730393133373535302e706466),
(24, 'Ang Tahanan', 'Elon Musk', 'Malate, Manila', 0, '', NULL, 'PENDING', 'PENDING', 0x4d79486f6d6548756220436f6e74726163745f313730393133373538382e706466),
(26, 'New Arizona', 'Conan Barbarian', 'haxton hill, arizona', 0, 'failed to pay at the month of may', NULL, 'PAID', 'APPROVED', 0x4d79486f6d6548756220436f6e74726163745f313730393133373536342e706466),
(27, 'California', 'Daryl Sarmiento', 'Los Angeles', 0, 'failed to pay for the month of february', NULL, 'PAID', 'APPROVED', 0x4d79486f6d6548756220436f6e74726163745f313730393133373537372e706466),
(28, 'Prussian Gloria', 'Otto Bismarck', 'Brandenburg, East Prussia', 0, NULL, NULL, 'PAID', 'APPROVED', 0x4d79486f6d6548756220436f6e74726163745f313730393133373532332e706466);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `condominium_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`condominium_id`, `id`, `item_name`, `quantity`, `is_deleted`) VALUES
(1, 1, 'Broom', 4, 0),
(1, 2, 'Dustpan', 5, 0),
(1, 3, 'Door Knob', 6, 0),
(1, 4, 'Mop', 3, 1),
(1, 5, 'Light Bulb', 10, 1),
(1, 6, 'Lamp', 12, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `timestamp`, `username`, `bill_number`, `screenshot`, `status`, `rejection_reason`, `condominium_id`, `is_deleted`) VALUES
(7, '2024-02-09 14:46:46', 'Elon Musk', '1507498433', '../../uploads/payment_proof/Elon Musk_1507498433_2.png', 'Verified', NULL, 1, 1),
(8, '2024-02-09 14:47:03', 'Elon Musk', '2126914746', '../../uploads/payment_proof/Elon Musk_2126914746_3.png', 'Verified', NULL, 1, 1),
(9, '2024-02-14 01:51:37', 'John Cena', '1664288929', '../../uploads/payment_proof/John Cena_1664288929.png', 'Verified', 'Invalid Receipt Sent', 1, 1),
(10, '2024-02-14 03:40:28', 'Jeff Bezos', '2011218909', '../../uploads/payment_proof/Jeff Bezos_2011218909.png', 'Unverified', NULL, 1, 1),
(11, '2024-02-26 17:49:38', 'John Cena', '1664288929', '../../uploads/payment_proof/John Cena_1664288929_1.png', 'Verified', NULL, 1, 1),
(12, '2024-02-26 17:49:54', 'John Cena', '1279789165', '../../uploads/payment_proof/John Cena_1279789165.png', 'Verified', NULL, 1, 1),
(13, '2024-02-26 19:31:15', 'John Cena', '1664288929', '../../uploads/payment_proof/John Cena_1664288929_2.png', 'Verified', NULL, 1, 1),
(14, '2024-02-26 19:31:42', 'John Cena', '1279789165', '../../uploads/payment_proof/John Cena_1279789165_1.png', 'Verified', NULL, 1, 1),
(15, '2024-02-26 19:43:55', 'Jeff Bezos', '2011218909', '../../uploads/payment_proof/Jeff Bezos_2011218909_1.png', 'Unverified', NULL, 1, 1),
(16, '2024-02-26 19:44:03', 'Jeff Bezos', '1387938587', '../../uploads/payment_proof/Jeff Bezos_1387938587.png', 'Unverified', NULL, 1, 1),
(17, '2024-02-26 20:22:09', 'Jeff Bezos', '2011218909', '../../uploads/payment_proof/Jeff Bezos_2011218909_2.png', 'Unverified', NULL, 1, 1),
(18, '2024-02-26 20:22:16', 'Jeff Bezos', '1387938587', '../../uploads/payment_proof/Jeff Bezos_1387938587_1.png', 'Unverified', NULL, 1, 1),
(19, '2024-02-27 15:27:07', 'Jeff Bezos', '1597087706', '../../uploads/payment_proof/Jeff Bezos_1597087706.png', 'Unverified', NULL, 1, 0),
(20, '2024-02-27 15:44:02', 'John Cena', '1497137188', '../../uploads/payment_proof/John Cena_1497137188.png', 'Unverified', NULL, 1, 0),
(21, '2024-02-27 16:01:28', 'Hank Schrader', '1224136885', '../../uploads/payment_proof/Hank Schrader_1224136885.png', '', 'invalid receipt, it\'s a picture of shrek', 1, 0),
(22, '2024-02-27 16:13:36', 'Elon Musk', '1411683345', '../../uploads/payment_proof/Elon Musk_1411683345.png', 'Unverified', NULL, 1, 0);

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
(4, 1425648978, 'John Cena', 1664288929, '2024-01-01', '2024-01-31', '2024-02-10', 1000.00, 'Paid', 1),
(7, 1983123405, 'Marty McFry III', 1610255313, '2024-01-01', '2024-01-31', '2024-02-10', 5000.00, 'Pending', 1),
(8, 1425648978, 'John Cena', 1279789165, '2024-10-01', '2024-10-31', '2024-11-10', 4000.00, 'Paid', 1),
(9, 1425648978, 'John Cena', 1497137188, '2024-02-01', '2024-02-29', '2024-03-10', 8888.00, 'Pending', 1),
(10, 1425648978, 'John Cena', 1515815091, '2024-03-01', '2024-03-31', '2024-04-10', 666.00, 'Pending', 1),
(11, 1425648978, 'John Cena', 1421981708, '2024-01-01', '2024-01-31', '2024-02-10', 3153.41, 'Pending', 0),
(12, 1425648978, 'John Cena', 1940050104, '2024-02-01', '2024-02-29', '2024-03-10', 3153.41, 'Pending', 0),
(13, 1425648978, 'John Cena', 2032858393, '2024-03-01', '2024-03-31', '2024-04-10', 3153.41, 'Pending', 0),
(14, 1425648978, 'John Cena', 1126343899, '2024-04-01', '2024-04-30', '2024-05-10', 3153.41, 'Pending', 0),
(15, 1425648978, 'John Cena', 1004724001, '2024-05-01', '2024-05-31', '2024-06-10', 3153.41, 'Pending', 0),
(16, 1425648978, 'John Cena', 1704846284, '2024-06-01', '2024-06-30', '2024-07-10', 3153.41, 'Pending', 0),
(17, 1425648978, 'John Cena', 1778301171, '2024-07-01', '2024-07-31', '2024-08-10', 3153.41, 'Pending', 0),
(18, 1425648978, 'John Cena', 1785619747, '2024-08-01', '2024-08-31', '2024-09-10', 3153.41, 'Pending', 0),
(19, 1425648978, 'John Cena', 1758874096, '2024-09-01', '2024-09-30', '2024-10-10', 3153.41, 'Pending', 0),
(20, 1425648978, 'John Cena', 2110738401, '2024-10-01', '2024-10-31', '2024-11-10', 3153.41, 'Pending', 0),
(21, 1425648978, 'John Cena', 1862959364, '2024-11-01', '2024-11-30', '2024-12-10', 3153.41, 'Pending', 0),
(22, 1425648978, 'John Cena', 1879028146, '2024-12-01', '2024-12-31', '2025-01-10', 3153.41, 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_ticket`
--

CREATE TABLE `service_ticket` (
  `ticket_number` int(11) NOT NULL,
  `condominium_id` int(11) NOT NULL,
  `target_unit` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date_issued` date NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_finished` date NOT NULL,
  `rejection_reason` varchar(255) NOT NULL,
  `resolve_confirmation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_ticket`
--

INSERT INTO `service_ticket` (`ticket_number`, `condominium_id`, `target_unit`, `username`, `date_issued`, `heading`, `description`, `status`, `date_finished`, `rejection_reason`, `resolve_confirmation`) VALUES
(1, 1, 107, 'John Cena', '2024-03-04', 'Fix Bathroom Sink Leak', 'Please send someone to fix bathroom sink leakage in Unit 107. Thank you.', 1, '2024-03-05', '', 'Maintenance is done fixing your bathroom sink leak.'),
(2, 1, 107, 'John Cena', '2024-03-04', 'Faucet is not working', 'Please send someone to fix the faucet at Unit 107. Thank you very much.', 0, '0000-00-00', '', ''),
(3, 1, 107, 'John Cena', '2024-03-04', 'My laptop is broken', 'Please send someone to fix my laptop at Unit 107. Thank you.', 2, '2024-03-05', 'Maintenance cannot fix personal belonging/items.', ''),
(4, 1, 107, 'John Cena', '2024-03-04', 'Window Frame Replacement', 'Hello, I need repairman\'s help replacing a window frame. Thank you.', 0, '0000-00-00', '', ''),
(5, 1, 107, 'Jeff Bezos', '2024-03-05', 'Door Knob is not working', 'Please send someone to fix the door knob at my unit. Thank you.', 1, '2024-03-05', '', 'Door Knob has already been replaced.'),
(6, 1, 107, 'Jeff Bezos', '2024-03-05', 'PlayStation 4 Fix', 'Please fix my PlayStation 4. Thank you.', 2, '2024-03-05', 'We cannot fix personal belonging/items.', ''),
(7, 1, 107, 'Jeff Bezos', '2024-03-05', 'Kitchen light needs bulb replacement', 'Please send maintenance to replace kitchen light at my unit. Thank you.', 0, '0000-00-00', '', ''),
(8, 1, 107, 'Jeff Bezos', '2024-03-05', 'My phone is not working', 'Please send someone to fix my phone. Thank you.', 2, '2024-03-05', 'We cannot fix personal belonging/items.', ''),
(9, 1, 107, 'Jeff Bezos', '2024-03-05', 'Speaker needs fixing', 'Please send someone to fix my speaker. Thank you.', 2, '2024-03-05', 'We cannot fix personal belonging/item.', ''),
(10, 1, 107, 'Jeff Bezos', '2024-03-05', 'Window Frame Replacement', 'Please send someone to replace my window frame. Thank you.', 1, '2024-03-05', '', 'Window Frame has been replaced.');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant_transactions`
--

INSERT INTO `tenant_transactions` (`id`, `account_number`, `username`, `bill_number`, `billing_period_start`, `billing_period_end`, `due_date`, `total_amount_due`, `status`, `is_deleted`) VALUES
(1, 1603909324, 'Jeff Bezos', 2011218909, '2024-01-01', '2024-01-31', '2024-02-10', 7000.00, 'Pending', 1),
(2, 1603909324, 'Jeff Bezos', 1387938587, '2024-11-01', '2024-11-30', '2024-12-10', 10000.00, 'Pending', 1),
(3, 1603909324, 'Jeff Bezos', 1031027443, '2024-02-01', '2024-02-29', '2024-03-10', 9999.00, 'Paid', 1),
(4, 1603909324, 'Jeff Bezos', 2063449284, '2024-01-01', '2024-01-31', '2024-02-10', 3153.41, 'Pending', 0),
(5, 1603909324, 'Jeff Bezos', 1889294090, '2024-02-01', '2024-02-29', '2024-03-10', 3153.41, 'Pending', 0),
(6, 1603909324, 'Jeff Bezos', 2100803446, '2024-03-01', '2024-03-31', '2024-04-10', 3153.41, 'Pending', 0),
(7, 1603909324, 'Jeff Bezos', 1432916449, '2024-04-01', '2024-04-30', '2024-05-10', 3153.41, 'Pending', 0),
(8, 1603909324, 'Jeff Bezos', 1787201882, '2024-05-01', '2024-05-31', '2024-06-10', 3153.41, 'Pending', 0),
(9, 1603909324, 'Jeff Bezos', 1311493035, '2024-06-01', '2024-06-30', '2024-07-10', 3153.41, 'Pending', 0),
(10, 1603909324, 'Jeff Bezos', 1546830751, '2024-07-01', '2024-07-31', '2024-08-10', 3153.41, 'Pending', 0),
(11, 1603909324, 'Jeff Bezos', 1157288865, '2024-08-01', '2024-08-31', '2024-09-10', 3153.41, 'Pending', 0),
(12, 1603909324, 'Jeff Bezos', 2043672277, '2024-09-01', '2024-09-30', '2024-10-10', 3153.41, 'Pending', 0),
(13, 1603909324, 'Jeff Bezos', 1945819371, '2024-10-01', '2024-10-31', '2024-11-10', 3153.41, 'Pending', 0),
(14, 1603909324, 'Jeff Bezos', 1794549695, '2024-11-01', '2024-11-30', '2024-12-10', 3153.41, 'Pending', 0),
(15, 1603909324, 'Jeff Bezos', 1597087706, '2024-12-01', '2024-12-31', '2025-01-10', 3153.41, 'Pending', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_number`, `unit_status`, `resident_id`, `tenant_id`, `condominium_id`, `is_deleted`) VALUES
(17, 102, 'Available', '', NULL, 1, 0),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_number`, `username`, `password`, `email`, `role`, `condominium_id`, `suspended`, `suspension_reason`, `suspend_timestamp`, `reinstatement_reason`, `otp_code`, `otp_verified`, `last_login_time`, `dashboard_url`) VALUES
(1, 0, 'Super Admin', '186cf774c97b60a1c106ef718d10970a6a06e06bef89553d9ae65d938a886eae', 'adm1nplk2022@yahoo.com', 'Super Administrator', NULL, 0, '', '0000-00-00 00:00:00', NULL, '0', 0, '2023-11-04 13:53:18', 'superadmin_dashboard/superadmin_dashboard.php'),
(2, 1425648978, 'John Cena', '96d9632f363564cc3032521409cf22a852f2032eec099ed5967c0d000cec607a', 'johncena220@myyahoo.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 14:46:21', 'casa_bougainvilla/resident_dashboard/resident_dashboard.php'),
(3, 1123456786, 'Dwayne Johnson', '4cc3f3b3897d1ed8511251ae70b84b95d40da6970bf201a397c33a4ce0268afd', 'd61332375@gmail.com', 'Front Desk', 1, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 14:54:32', 'casa_bougainvilla/front_desk_dashboard/front_desk_dashboard.php'),
(4, 1315648790, 'Elon Musk', '8b64d09d9a7290a3876504cdb0a64379c807c83bc45aa8e71eb46c5b0c772e07', '202001102@iacademy.edu.ph', 'Administrator', 1, 0, 'failed to pay for the month of january', '0000-00-00 00:00:00', NULL, NULL, 0, '2023-11-04 14:56:55', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(8, 1101483647, 'Jason De Guzman', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'jasondeguzman@cssalamanca.com', 'Administrator', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-09 12:20:41', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(10, 1095279156, 'Daryl Sarmiento', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'darylsarmiento@cssalamanca.com', 'Administrator', 1, 0, 'Out of Reach', '0000-00-00 00:00:00', 'Established connection again', NULL, 0, '2024-01-09 14:16:26', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(16, 1147483647, 'Hank Schrader', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'minerals@gmail.com', 'Administrator', 19, 0, 'Expired Contract', '0000-00-00 00:00:00', 'Renewed contract', NULL, 0, '2024-01-09 16:36:42', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(34, 1883187512, 'Morgan Freeman', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'freeman@gmail.com', 'Administrator', 21, 0, 'Non-Payment of Fees for the Month of March', '0000-00-00 00:00:00', 'Paid on April', NULL, 0, '2024-01-11 12:11:23', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(35, 2028470966, 'Jimmy Gibbs Jr.', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'jimmy@gmail.com', 'Administrator', 18, 0, 'Non-Payment of Fees for the Month of January', '0000-00-00 00:00:00', 'Paid on February', NULL, 0, '2024-01-13 02:23:55', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(36, 1510158441, 'Conan Barbarian', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'conan@gmail.com', 'Administrator', 22, 0, 'Non-Payment of Fees for the Month of June', '0000-00-00 00:00:00', 'Paid in July', NULL, 0, '2024-01-13 02:45:56', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(37, 1747194577, 'Tom Cruise', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'impossible@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 04:19:59', 'casa_bougainvilla/resident_dashboard/resident_dashboard.php'),
(38, 1983123405, 'Marty McFry III', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'chicken85@gmail.com', 'Resident', 1, 0, 'Non-Payment of Fees for the Month of June', '0000-00-00 00:00:00', 'Paid on July', NULL, 0, '2024-01-13 04:21:48', 'casa_bougainvilla/resident_dashboard/resident_dashboard.php'),
(39, 2018384520, 'George Washington', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'washington75@gmail.com', 'Administrator', 1, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 04:51:58', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(40, 2144409403, 'Benjamin Franklin X', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'ben769@gmail.com', 'Resident', 1, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 04:56:26', 'casa_bougainvilla/resident_dashboard/resident_dashboard.php'),
(41, 1617546162, 'Samuel Adams', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'sam75@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-13 05:17:51', 'casa_bougainvilla/resident_dashboard/resident_dashboard.php'),
(43, 1374395981, 'Benedict Arnold', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'arnold79@gmail.com', 'Resident', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-15 12:21:33', 'casa_bougainvilla/resident_dashboard/resident_dashboard.php'),
(44, 1529915200, 'Andrew Jackson IV', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'jackson1815@gmail.com', 'Resident', 18, 0, 'Failed to pay for the month of february', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-15 12:47:36', 'casa_bougainvilla/resident_dashboard/resident_dashboard.php'),
(45, 1710804190, 'Jimmy Carter X', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'carter2000@gmail.com', 'Administrator', 26, 0, 'Non-Payment of Fees for the Month of November', '0000-00-00 00:00:00', 'Paid in December', NULL, 0, '2024-01-15 13:10:24', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(46, 1856179449, 'Nicholas Sasquer', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'nich75@gmail.com', 'Resident', 18, 0, 'failed to pay for the month of june', '0000-00-00 00:00:00', NULL, NULL, 0, '2024-01-15 13:15:16', 'casa_bougainvilla/resident_dashboard/resident_dashboard.php'),
(47, 2001454056, 'Jimmy Fallon', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'fallon@gmail.com', 'Resident', 1, 0, 'Non-Payment of Fees for the Month of January', '2024-01-29 10:09:25', 'conflict resolved', NULL, 0, '2024-01-15 17:02:02', 'casa_bougainvilla/resident_dashboard/resident_dashboard.php'),
(48, 1988229586, 'Otto Bismarck', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'otto@gmail.com', 'Administrator', 19, 0, 'Non-Payment of Fees for the Month of January', '0000-00-00 00:00:00', 'Paid on February', NULL, 0, '2024-01-15 17:04:53', 'casa_bougainvilla/administrator_dashboard/administrator_dashboard.php'),
(60, 2097438436, 'Cer Spencer', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'spence77@gmail.com', 'Front Desk', 1, 0, 'Non-Payment of Fees for the Month of August', '2024-01-29 12:29:51', 'successfully paid for the month of august', NULL, 0, '2024-01-29 12:07:28', 'casa_bougainvilla/front_desk_dashboard/front_desk_dashboard.php'),
(61, 1603909324, 'Jeff Bezos', '2e0b8d61fa2a6959d254b6ff5d0fb512249329097336a35568089933b49abdde', 'rhobbaquiran76@gmail.com', 'Tenant', 1, 0, NULL, '2024-02-09 09:41:28', NULL, NULL, 0, '2024-02-09 09:41:28', 'casa_bougainvilla/tenant_dashboard/tenant_dashboard.php'),
(62, 1777213686, 'Collin Hughes', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'collin76@gmail.com', 'Tenant', 1, 0, 'Non-Payment of Fees for the Month of January', '2024-02-23 13:55:34', 'conflict resolved', NULL, 0, '2024-02-13 17:20:44', 'casa_bougainvilla/tenant_dashboard/tenant_dashboard.php');

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
(12, 'James Read', '09293430076', 'read15@gmail.com', '2024-01-15 21:17:00', '2024-01-15 22:19:00', 'visiting friend at unit 7', 1, 1),
(13, 'Elliot Decker', '09293530031', 'decker@gmail.com', '2024-02-07 10:58:00', '2024-02-10 23:00:00', 'howdy', 1, 1),
(15, 'Vladimir Putin', '123456789', 'sovietrussia1991@gmail.com', '2024-02-23 22:13:00', '2024-02-23 03:19:00', 'visiting old kgb friend at unit 20', 1, 1);

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
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `condominiums`
--
ALTER TABLE `condominiums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
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
-- Indexes for table `service_ticket`
--
ALTER TABLE `service_ticket`
  ADD PRIMARY KEY (`ticket_number`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1460;

--
-- AUTO_INCREMENT for table `admin_transactions`
--
ALTER TABLE `admin_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `condominiums`
--
ALTER TABLE `condominiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `resident_transactions`
--
ALTER TABLE `resident_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `service_ticket`
--
ALTER TABLE `service_ticket`
  MODIFY `ticket_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tenant_transactions`
--
ALTER TABLE `tenant_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
