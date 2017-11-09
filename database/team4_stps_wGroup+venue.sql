-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2017 at 01:56 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team4_stps`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupsession`
--

CREATE TABLE IF NOT EXISTS `groupsession` (
  `id` int(11) NOT NULL,
  `roomTypeID` int(11) NOT NULL,
  `typeofTrainingID` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `trainerEmail` varchar(255) NOT NULL,
  `groupCapacity` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
INSERT INTO `groupsession` (`id`, `roomTypeID`, `typeofTrainingID`, `startTime`, `endTime`, `date`, `description`, `trainerEmail`, `groupCapacity`, `status`) VALUES
(1, 7, 5, '10:00:00', '11:00:00', '2017-11-12', 'for yoga at yogaroom', 'trainer1@gmail.com', 20, 'Pending'),
(2, 6, 1, '12:00:00', '13:00:00', '2017-11-13', 'welcome to training', 'trainer2@gmail.com', 8, 'Approved'),
(3, 1, 2, '15:00:00', '17:00:00', '2017-11-13', 'for workout at treadmill', 'trainer1@gmail.com', 13, 'Approved'),
(4, 6, 4, '12:00:00', '13:00:00', '2017-11-15', 'for freestyle at openspace', 'trainer1@gmail.com', 10, 'Approved'),
(5, 1, 3, '10:00:00', '12:00:00', '2017-11-14', 'for freestyle at openspace', 'trainer2@gmail.com', 30, 'Rejected');
--
-- Table structure for table `groupsessionapplicant`
--

CREATE TABLE IF NOT EXISTS `groupsessionapplicant` (
  `groupSessionID` int(11) NOT NULL,
  `traineeEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `personalsession`
--

CREATE TABLE `personalsession` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `roomTypeID` int(11) NOT NULL,
  `typeofTrainingID` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `trainerEmail` varchar(255) NOT NULL,
  `traineeEmail` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `personalsession` (`id`, `category`, `startTime`, `endTime`, `date`, `description`, `trainerEmail`, `traineeEmail`) VALUES
(1, 'Own Training', '09:00:00', '10:00:00', '2017-10-10', 'Workout!!', '', 'trainee1@gmail.com'),
(2, 'Personal Training', '09:00:00', '10:00:00', '2017-10-11', '1v1 workout!!', 'trainer2@gmail.com', 'trainee2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE IF NOT EXISTS `roomtype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `venueID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`id`, `name`, `capacity`, `venueID`) VALUES
(1, 'OpenSpace', 100, 1),
(2, 'Dumbbell', 50, 1),
(3, 'Treadmill', 30, 1),
(4, 'OpenSpace', 100, 2),
(5, 'Dumbbell', 50, 2),
(6, 'Treadmill', 30, 2),
(7, 'Yoga', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `typeoftraining`
--

CREATE TABLE IF NOT EXISTS `typeoftraining` (
  `id` int(11) NOT NULL,
  `trainingName` varchar(255) NOT NULL,
  `cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `typeoftraining`
--

INSERT INTO `typeoftraining` (`id`, `trainingName`, `cost`) VALUES
(1, 'Cardio', '32.00'),
(2, 'Core', '30.00'),
(3, 'Freestyle', '25.00'),
(4, 'Workout', '30.00'),
(5, 'Yoga', '35.00');

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
  `password` varchar(50) NOT NULL,
  `subscription` varchar(255) NOT NULL,
  `expiryDate` date NOT NULL,
  `registerDate` date NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userapproval`
--

INSERT INTO `userapproval` (`email`, `firstName`, `lastName`, `phoneNumber`, `profilePicture`, `role`, `password`, `subscription`, `expiryDate`, `registerDate`, `address`) VALUES
('5234@mail.com', 'fg', 'dfgd', 872334578, '', 'trainee', '356a192b7913b04c54574d18c28d46e6395428ab', '+3 month', '0000-00-00', '0000-00-00', ''),
('wet@mail.com', '234', '435', 987654321, '', 'trainee', '356a192b7913b04c54574d18c28d46e6395428ab', '3', '0000-00-00', '2017-11-08', ''),
('wqr12@mail.com', '24354', 'rgewr', 98763211, '', 'trainee', '356a192b7913b04c54574d18c28d46e6395428ab', '+3 month', '0000-00-00', '0000-00-00', ''),
('wqrq2@mail.com', '24354', 'rgewr', 98763211, '', 'trainee', '356a192b7913b04c54574d18c28d46e6395428ab', '+3 month', '0000-00-00', '0000-00-00', '');
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
  `address` varchar(255) NOT NULL,
  `subscription` varchar(255) NOT NULL,
  `registerDate` date NOT NULL,
  `expiryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `firstName`, `lastName`, `phoneNumber`, `profilePicture`, `role`, `password`, `status`, `address`, `subscription`, `registerDate`, `expiryDate`) VALUES
('admin1@gmail.com', 'admin', 'min', 12121212, 'images/uploads/profileadmin1@gmail.com.jpg', 'admin', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 1, '', '0', '0000-00-00', '0000-00-00'),
('trainee1@gmail.com', 'nurul', 'trainee1', 0, '', 'trainee', 'ddf170f924ba1ce072cd91b54614289524e70db2', 1, '', '0', '0000-00-00', '0000-00-00'),
('trainee2@gmail.com', '', '', 0, '', 'trainee', 'ddf170f924ba1ce072cd91b54614289524e70db2', 1, '', '3', '0000-00-00', '0000-00-00'),
('trainer1@gmail.com', 'trainer123', 'tr1', 14141414, '', 'trainer', '69a6439936f0ef293d0a713f0aaf7a04ca82d272', 1, '', '0', '0000-00-00', '0000-00-00'),
('trainer2@gmail.com', 'trainer2', 'tr2', 14141415, '', 'trainer', '69a6439936f0ef293d0a713f0aaf7a04ca82d272', 1, '123 abc s890234', '0', '0000-00-00', '0000-00-00'),
('yellow6629@hotmail.com', 'test', 'ff', 987654321, '', 'trainee', 'pyVrIi2H', 1, '', '0', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `location`) VALUES
(1, 'Bishan'),
(2, 'Jurong');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupsession`
--
ALTER TABLE `groupsession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupsessionapplicant`
--
ALTER TABLE `groupsessionapplicant`
  ADD PRIMARY KEY (`groupSessionID`,`traineeEmail`);

--
-- Indexes for table `personalsession`
--
ALTER TABLE `personalsession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typeoftraining`
--
ALTER TABLE `typeoftraining`
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
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupsession`
--
ALTER TABLE `groupsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personalsession`
--
ALTER TABLE `personalsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `typeoftraining`
--
ALTER TABLE `typeoftraining`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
