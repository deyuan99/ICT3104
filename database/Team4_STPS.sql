-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2017 at 02:35 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Team4_STPS`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(1, 'frist try', '#FFD700', '2017-09-30 00:00:00', '2017-10-01 00:00:00'),
(2, 'what to do today??', '#40E0D0', '2017-09-27 00:00:00', '2017-09-28 00:00:00'),
(3, 'how about now', '#000', '2017-09-20 00:00:00', '2017-09-21 00:00:00'),
(4, 'hi', '#008000', '2017-09-13 00:00:00', '2017-09-14 00:00:00'),
(5, '', '', '2017-08-31 00:00:00', '2017-09-01 00:00:00'),
(6, '', '', '2017-10-05 00:00:00', '2017-10-06 00:00:00'),
(7, 'dddd', '', '2017-10-12 00:00:00', '2017-10-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `users` (
  `email` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `profilePicture` varchar(50) NOT NULL,
  `phoneNumber` int(8) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `role`, `firstName`, `lastName`, `profilePicture`, `phoneNumber`, `status`) VALUES
('admin1@gmail.com', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 'admin', 'admin', 'ad1', '', 12121212, 1),
('trainee1@gmail.com', 'ddf170f924ba1ce072cd91b54614289524e70db2', 'trainee', 'trainee1', 'te11', '', 13231323, 1),
('trainee2@gmail.com', 'ddf170f924ba1ce072cd91b54614289524e70db2', 'trainee', 'trainee2', 'te11', '', 12345567, 1),
('trainer1@gmail.com', 'ddf170f924ba1ce072cd91b54614289524e70db2', 'trainer', 'trainer1', 'te11', '', 12351231, 1),
('trainer2@gmail.com', 'ddf170f924ba1ce072cd91b54614289524e70db2', 'trainer', 'trainer2', 'te11', '', 12351231, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
