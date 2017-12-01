-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2017 at 07:19 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

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
-- Table structure for table `aboutus`
--

CREATE TABLE IF NOT EXISTS `aboutus` (
  `id` int(11) NOT NULL,
  `content` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`id`, `content`) VALUES
(1, 'Working with a personal trainer is the first step to improving your health and fitness. People of all shapes and sizes, people with all types of goals have been proven to have better success when working with a personal trainer. At STPS Fitness we have over 20 trainers that have all different backgrounds so that our clients can get the results they want.');

-- --------------------------------------------------------

--
-- Table structure for table `bondapproval`
--

CREATE TABLE IF NOT EXISTS `bondapproval` (
  `id` int(11) NOT NULL,
  `trainerEmail` varchar(255) NOT NULL,
  `traineeEmail` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupsession`
--

INSERT INTO `groupsession` (`id`, `roomTypeID`, `typeofTrainingID`, `startTime`, `endTime`, `date`, `description`, `trainerEmail`, `groupCapacity`, `status`) VALUES
(8, 5, 4, '09:00:00', '12:00:00', '2017-12-06', 'Sweat it out', 'trainer1@gmail.com', 30, 'Approved'),
(9, 3, 1, '09:00:00', '10:00:00', '2017-12-14', 'Run', 'trainer1@gmail.com', 20, 'Approved'),
(10, 7, 2, '09:00:00', '10:00:00', '2017-12-26', 'Get tranquiled', 'trainer2@gmail.com', 35, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `groupsessionapplicant`
--

CREATE TABLE IF NOT EXISTS `groupsessionapplicant` (
  `groupSessionID` int(11) NOT NULL,
  `traineeEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupsessionapplicant`
--

INSERT INTO `groupsessionapplicant` (`groupSessionID`, `traineeEmail`) VALUES
(9, 'trainee1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `notificationlog`
--

CREATE TABLE IF NOT EXISTS `notificationlog` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `readStatus` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notificationlog`
--

INSERT INTO `notificationlog` (`id`, `message`, `userEmail`, `readStatus`) VALUES
(27, 'Trainer trainer1@gmail.com has created a group session', 'admin1@gmail.com', 1),
(28, 'Trainer trainer1@gmail.com has created a group session', 'admin1@gmail.com', 1),
(29, 'Trainer trainer2@gmail.com has created a group session', 'admin1@gmail.com', 1),
(30, 'Your group session on 2017-12-06 at 09:00:00 has been approved.', 'trainer1@gmail.com', 1),
(31, 'Your group session on 2017-12-14 at 09:00:00 has been approved.', 'trainer1@gmail.com', 1),
(32, 'Your group session on 2017-12-26 at 09:00:00 has been approved.', 'trainer2@gmail.com', 0),
(33, 'Trainee trainee1@gmail.com has joined your 1-1 training on 2017-12-04 at 10:00:00', 'trainer1@gmail.com', 1),
(34, 'A Trainee - trainee1@gmail.com, has proposed to bond to your training.', 'trainer1@gmail.com', 1),
(35, 'Trainer - trainer1@gmail.com, has approved your bond request.', 'trainee1@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personalsession`
--

CREATE TABLE IF NOT EXISTS `personalsession` (
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personalsession`
--

INSERT INTO `personalsession` (`id`, `category`, `roomTypeID`, `typeofTrainingID`, `startTime`, `endTime`, `date`, `description`, `trainerEmail`, `traineeEmail`) VALUES
(12, 'Personal Training', 1, 0, '13:00:00', '14:00:00', '2017-12-02', 'Work my body', 'trainer1@gmail.com', ''),
(13, '1-1 Training', 1, 2, '10:00:00', '12:00:00', '2017-12-04', 'Strengthen your core!', 'trainer1@gmail.com', 'trainee1@gmail.com'),
(14, '1-1 Training', 4, 5, '12:00:00', '14:00:00', '2017-12-18', 'Peace and relax', 'trainer1@gmail.com', ''),
(15, '1-1 Training', 1, 1, '14:00:00', '16:00:00', '2017-12-14', 'Shake it', 'trainer2@gmail.com', ''),
(16, '1-1 Training', 1, 3, '11:00:00', '12:00:00', '2017-12-18', 'Work it', 'trainer2@gmail.com', ''),
(17, 'Personal Training', 1, 0, '14:00:00', '15:00:00', '2017-12-05', 'Gym time', '', 'trainee2@gmail.com'),
(18, 'Personal Training', 4, 0, '13:00:00', '14:00:00', '2017-12-06', 'No pain no gain', '', 'trainee1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `featuredStatus` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `description`, `startDate`, `endDate`, `imagePath`, `featuredStatus`) VALUES
(1, '10% discount for students!', 'Get 10% discount when you are a student. That''s all. Don''t expect more. We are not charity.', '2017-11-17', '2018-11-17', '', 1),
(2, '1 for 1 on weekdays for everyone!', 'Get 1 for 1 on weekdays now! Come come sign up now! Yes now! Now!', '2017-11-02', '2017-12-21', '', 1);

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
(7, 'Yoga', 26, 1);

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

CREATE TABLE IF NOT EXISTS `userapproval` (
  `email` varchar(255) NOT NULL,
  `firstName` varchar(35) NOT NULL,
  `lastName` varchar(35) NOT NULL,
  `phoneNumber` int(8) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `subscription` int(2) NOT NULL,
  `expiryDate` date NOT NULL,
  `registerDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(255) NOT NULL,
  `firstName` varchar(35) NOT NULL,
  `lastName` varchar(35) NOT NULL,
  `phoneNumber` int(8) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `address` varchar(255) NOT NULL,
  `subscription` int(2) NOT NULL,
  `registerDate` date NOT NULL,
  `expiryDate` date NOT NULL,
  `featuredStatus` int(1) NOT NULL,
  `profileBio` varchar(255) NOT NULL,
  `bondTo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `firstName`, `lastName`, `phoneNumber`, `profilePicture`, `role`, `password`, `status`, `address`, `subscription`, `registerDate`, `expiryDate`, `featuredStatus`, `profileBio`, `bondTo`) VALUES
('admin1@gmail.com', 'admin', 'admin', 12121212, '', 'admin', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 1, '', 0, '0000-00-00', '0000-00-00', 0, '', ''),
('trainee1@gmail.com', 'Freeman', 'GordonT1', 15151515, '', 'trainee', 'ddf170f924ba1ce072cd91b54614289524e70db2', 1, 'Eunos', 6, '2017-05-17', '2017-12-17', 0, '', 'trainer1@gmail.com'),
('trainee2@gmail.com', 'James', 'LeeT2', 17171717, '', 'trainee', 'ddf170f924ba1ce072cd91b54614289524e70db2', 1, 'Bedok', 3, '2017-02-17', '2017-12-17', 0, '', ''),
('trainer1@gmail.com', 'Robert', 'SmithTr1', 12121212, '', 'trainer', '69a6439936f0ef293d0a713f0aaf7a04ca82d272', 1, 'Dover', 0, '2017-11-17', '2017-11-17', 1, 'Training is not just a way to stay in shape. For me it should build a good base to improve the way we live, tackle health issues and prepare and enable us to enjoy all kinds of movement such as skiing, hiking, or any other kind of sport!', ''),
('trainer2@gmail.com', 'Michael', 'JonesTr2', 13131313, '', 'trainer', '69a6439936f0ef293d0a713f0aaf7a04ca82d272', 1, 'Bugis', 0, '2017-11-17', '2017-11-17', 1, 'I try to help clients achieve a balanced lifestyle that encompasses all dimensions of health & wellness. With an extensive background in coaching, I try to create a training environment that not only motivates but also empowers individuals to continually', ''),
('trainer3@gmail.com', 'Lisa', 'Gervais', 81234098, '', 'trainer', '69a6439936f0ef293d0a713f0aaf7a04ca82d272', 1, 'Yishun', 0, '2017-11-17', '2017-11-17', 1, 'Our fitness is important and something we should all enjoy. My aim is to create a positive and fun experience for clients, as well as using the best of my knowledge and experience to help clients achieve their goals.', ''),
('trainer4@gmail.com', 'Claire', 'Madin', 90124356, '', 'trainer', '69a6439936f0ef293d0a713f0aaf7a04ca82d272', 1, 'Simei', 0, '2017-11-17', '2017-11-17', 1, 'There are many reasons why people choose to exercise. Whether you want to improve your sport performance, reduce health risks, or look and feel better I can help you achieve your goals. Using a functional, yet fun approach to your goal.', '');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` int(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `location`, `address`, `contact`) VALUES
(1, 'STPS@Bishan', '5 Bishan Street 14, Singapore 579783', 60981234),
(2, 'STPS@Jurong', '21 Jurong East Street 31, Singapore 609517', 60987654);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bondapproval`
--
ALTER TABLE `bondapproval`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notificationlog`
--
ALTER TABLE `notificationlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personalsession`
--
ALTER TABLE `personalsession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
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
-- AUTO_INCREMENT for table `bondapproval`
--
ALTER TABLE `bondapproval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `groupsession`
--
ALTER TABLE `groupsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `notificationlog`
--
ALTER TABLE `notificationlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `personalsession`
--
ALTER TABLE `personalsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
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
