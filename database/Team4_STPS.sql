-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2017 at 01:56 PM
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
-- Table structure for table `personalsession`
--

CREATE TABLE `personalsession` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `trainerEmail` varchar(255) NOT NULL,
  `traineeEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personalsession`
--

INSERT INTO `personalsession` (`id`, `category`, `cost`, `startTime`, `endTime`, `date`, `description`, `trainerEmail`, `traineeEmail`) VALUES
(1, 'Own Training', '0.00', '09:00:00', '10:00:00', '2017-10-10', 'Workout!!', '', 'trainee1@gmail.com'),
(2, 'Personal Training', '10.50', '09:00:00', '10:00:00', '2017-10-11', '1v1 workout!!', 'trainer2@gmail.com', 'trainee2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `userapproval`
--

CREATE TABLE `userapproval` (
  `email` varchar(255) NOT NULL,
  `firstName` varchar(35) NOT NULL,
  `lastName` varchar(35) NOT NULL,
  `phoneNumber` int(8) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userapproval`
--

INSERT INTO `userapproval` (`email`, `firstName`, `lastName`, `phoneNumber`, `profilePicture`, `role`, `password`) VALUES
('test@gmail.com', 'test', 'testing', 12312312, '', 'trainee', 'ddf170f924ba1ce072cd91b54614289524e70db2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `firstName` varchar(35) NOT NULL,
  `lastName` varchar(35) NOT NULL,
  `phoneNumber` int(8) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `firstName`, `lastName`, `phoneNumber`, `profilePicture`, `role`, `password`, `status`, `address`) VALUES
('admin1@gmail.com', 'ad', 'min', 12121212, 'images/uploads/profileadmin1@gmail.com.jpg', 'admin', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 1, ''),
('trainee1@gmail.com', 'trainee11', 'tr1', 123456789, '', 'trainee', 'ddf170f924ba1ce072cd91b54614289524e70db2', 1, ''),
('trainee2@gmail.com', 'trainee2', 'te2', 13131314, '', 'trainee', 'ddf170f924ba1ce072cd91b54614289524e70db2', 1, '212 afgreokmgr 23-234 s324235'),
('trainer1@gmail.com', 'trainer123', 'tr1', 14141414, '', 'trainer', '69a6439936f0ef293d0a713f0aaf7a04ca82d272', 1, ''),
('trainer2@gmail.com', 'trainer2', 'tr2', 14141415, '', 'trainer', '69a6439936f0ef293d0a713f0aaf7a04ca82d272', 1, '123 abc s890234');

--
-- Indexes for dumped tables
--

CREATE TABLE `groupsession` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `roomTypeID` int(11) NOT NULL,
  `typeofTrainingID` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `trainerEmail` varchar(255) NOT NULL,
  `groupCapacity` int(11),
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for table `personalsession`
--
ALTER TABLE `personalsession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userapproval`
--
ALTER TABLE `userapproval`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personalsession`
--
ALTER TABLE `personalsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
