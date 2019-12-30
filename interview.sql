-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2019 at 02:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interview`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enquiry`
--

CREATE TABLE `tbl_enquiry` (
  `id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(255) NOT NULL,
  `phno` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_enquiry`
--

INSERT INTO `tbl_enquiry` (`id`, `name`, `phno`, `email`, `status`, `createdAt`) VALUES
(00000000006, 'Saurav Chakraborty', '9832098320', 'aa@gmail.com', 'new', '2019-12-28 18:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pack`
--

CREATE TABLE `tbl_pack` (
  `id` int(50) UNSIGNED ZEROFILL NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `rate` int(255) DEFAULT NULL,
  `night` int(10) DEFAULT NULL,
  `day` int(10) DEFAULT NULL,
  `minPerson` int(10) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `hotel` varchar(255) DEFAULT NULL,
  `trans` varchar(255) DEFAULT NULL,
  `meal` varchar(255) DEFAULT NULL,
  `sight` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `pckImage` varchar(255) DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pack`
--

INSERT INTO `tbl_pack` (`id`, `title`, `rate`, `night`, `day`, `minPerson`, `description`, `code`, `tag`, `status`, `hotel`, `trans`, `meal`, `sight`, `createdAt`, `pckImage`, `updatedAt`) VALUES
(00000000000000000000000000000000000000000000000002, 'Title', 100, 4, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'FGF-456', 'New', 'active', 'selected', 'selected', 'selected', 'selected', NULL, '../images/packageslandingBg.jpg', '2019-12-28 18:49:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pack`
--
ALTER TABLE `tbl_pack`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_enquiry`
--
ALTER TABLE `tbl_enquiry`
  MODIFY `id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_pack`
--
ALTER TABLE `tbl_pack`
  MODIFY `id` int(50) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
