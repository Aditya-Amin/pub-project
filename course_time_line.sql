-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2019 at 06:34 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_time_line`
--

-- --------------------------------------------------------

--
-- Table structure for table `pub_users`
--

CREATE TABLE `pub_users` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `useremail` varchar(100) NOT NULL,
  `userpass` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `pro_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pub_users`
--

INSERT INTO `pub_users` (`id`, `username`, `useremail`, `userpass`, `designation`, `pro_img`) VALUES
(1, ':name', ':email', ':pass', '', ''),
(2, 'Adi', 'adittyaamin@gmail.com', 'adi12', '', ''),
(3, 'Adi', 'adittyaamin@gmail.com', 'adi12', '', ''),
(4, 'Adi', 'adittyaamin@gmail.com', 'adi12', '', ''),
(5, 'aditya', 'adi@gmail.com', '1', '', ''),
(6, 'Adi', 'ad@gmail.com', '1', '', ''),
(7, 'safa', 'safa@gmail.com', '1', '', ''),
(8, 'adity', 'aditya@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
(9, 'wow.js', 'wow@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '', ''),
(10, 'sanjit', 'sanjit@gmail.com', '133408a7510620bf0c3cd88fbd0dd9f0', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pub_users`
--
ALTER TABLE `pub_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pub_users`
--
ALTER TABLE `pub_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
