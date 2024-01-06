-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 04, 2023 at 04:00 PM
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
-- Table structure for table `condominiums`
--

CREATE TABLE `condominiums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `disabled` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `condominiums`
--

INSERT INTO `condominiums` (`id`, `name`, `disabled`) VALUES
(1, 'Casa Bougainvilla', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `condominium_id` int(11) DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_verified` tinyint(1) DEFAULT 0,
  `last_login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `dashboard_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `condominium_id`, `otp_code`, `otp_verified`, `last_login_time`, `dashboard_url`) VALUES
(1, 'Super Admin', 'superadmin', 'adm1nplk2022@yahoo.com', 'Super Administrator', NULL, NULL, 0, '2023-11-04 13:53:18', 'superadmin_dashboard.php'),
(2, 'John Cena', 'john', 'cena@gmail.com', 'Resident', 1, NULL, 0, '2023-11-04 14:46:21', 'casa_bougainvilla/resident_dashboard.php'),
(3, 'Dwayne Johnson', 'dwayne', 'johnson@gmail.com', 'Front Desk', 1, NULL, 0, '2023-11-04 14:54:32', 'casa_bougainvilla/front_desk_dashboard.php'),
(4, 'Elon Musk', 'elon', 'musk@gmail.com', 'Administrator', 1, NULL, 0, '2023-11-04 14:56:55', 'casa_bougainvilla/administrator_dashboard.php');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `condominiums`
--
ALTER TABLE `condominiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`condominium_id`) REFERENCES `condominiums` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Add a new table for visitors
CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `arrival_time` datetime NOT NULL,
  `departure_time` datetime NOT NULL,
  `purpose` text NOT NULL,
  `condominium_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `condominium_id` (`condominium_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- AUTO_INCREMENT for table `visitors`
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Constraints for table `visitors`
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`condominium_id`) REFERENCES `condominiums` (`id`);