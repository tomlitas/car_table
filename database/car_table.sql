-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 07:01 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_table`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int(10) UNSIGNED NOT NULL,
  `registr_num` varchar(8) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `owener_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `registr_num`, `brand`, `model`, `color`, `owener_id`, `created`, `updated`) VALUES
(2, 'RTY 587', 'BMW', '', '', 1, '2022-03-25 17:57:01', '2022-03-25 18:40:06'),
(3, 'GHJ 236', 'Audi', 'GTI', 'red', 3, '2022-03-25 18:43:21', '2022-03-25 18:43:21'),
(4, 'AWE 852', 'Ford', 'Focus', 'green', 3, '2022-03-25 18:50:19', '2022-03-25 18:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `driving_license_date` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `first_name`, `last_name`, `email`, `driving_license_date`, `password`, `created`, `updated`) VALUES
(1, 'Anupras', 'Anupraitis', 'anupras@gmail.com', '1990 02 14', '$2y$10$Y.88oCnxKBFyn2yLZiN7X.vsBoGTeAMxVbbK.lgF.grH3LtPxydsy', '2022-03-23 19:56:57', '2022-03-24 16:01:35'),
(3, 'Lukas', 'Lukauskas', 'lukas@gmail.com', '2000 05 19', '$2y$10$Q004gvwbP5FUzH.XxAEQz.t42k2MeJEj0LhjJMSrqCIYrC8BWBNzm', '2022-03-24 17:38:51', '2022-03-24 16:55:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
