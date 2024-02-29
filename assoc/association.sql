-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2024 at 04:19 AM
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
