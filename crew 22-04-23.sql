-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 03:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crew`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(1) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `email`, `pass`) VALUES
(1, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `did` int(11) NOT NULL,
  `dname` varchar(30) NOT NULL,
  `demail` varchar(30) NOT NULL,
  `dphone` varchar(10) NOT NULL,
  `dgender` varchar(6) NOT NULL,
  `daadhar` varchar(12) NOT NULL,
  `dlicense` varchar(20) NOT NULL,
  `dcar` varchar(15) NOT NULL,
  `dprice` int(4) NOT NULL,
  `dpass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`did`, `dname`, `demail`, `dphone`, `dgender`, `daadhar`, `dlicense`, `dcar`, `dprice`, `dpass`) VALUES
(1, 'Pranav', 'pranavv2002@gmail.com', '8618994561', 'male', '123412341234', 'KA1231234111111', 'small', 6, '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `nid` int(5) NOT NULL,
  `tripid` int(5) NOT NULL,
  `did` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `drvad` int(1) NOT NULL,
  `usrad` int(1) NOT NULL,
  `dend` int(1) NOT NULL,
  `uend` int(1) NOT NULL,
  `strt` datetime NOT NULL,
  `endt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`nid`, `tripid`, `did`, `uid`, `drvad`, `usrad`, `dend`, `uend`, `strt`, `endt`) VALUES
(9, 42, 1, 1, 1, 1, 1, 1, '2023-04-30 15:46:00', '2023-04-22 03:49:11'),
(11, 42, 1, 1, 1, 1, 1, 1, '2023-04-30 15:46:00', '2023-04-22 04:16:26'),
(13, 42, 1, 1, 1, 1, 1, 1, '2023-04-30 15:46:00', '2023-04-22 04:44:51'),
(15, 42, 1, 1, 1, 1, 0, 1, '2023-04-30 15:46:00', '2023-04-22 06:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `did` int(3) NOT NULL,
  `uid` int(3) NOT NULL,
  `star` int(1) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`did`, `uid`, `star`, `comment`) VALUES
(1, 1, 3, 'Awesomeeee');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `tripid` int(5) NOT NULL,
  `did` int(5) NOT NULL,
  `src` text NOT NULL,
  `dest` text NOT NULL,
  `strt` datetime NOT NULL,
  `km` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`tripid`, `did`, `src`, `dest`, `strt`, `km`) VALUES
(42, 1, 'Bangalore', 'Davangere Benne Dose', '2023-04-30 15:46:00', 264.4),
(43, 1, 'Tumkur', 'Cubbon Park', '2023-04-18 15:57:00', 71.5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `uphone` varchar(10) NOT NULL,
  `uemail` varchar(30) NOT NULL,
  `uaadhar` varchar(12) NOT NULL,
  `ugender` varchar(7) NOT NULL,
  `upass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `uphone`, `uemail`, `uaadhar`, `ugender`, `upass`) VALUES
(1, 'jainvpranav', '9731644383', 'jainvpranav@gmail.com', '123412341234', 'male', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `did` int(3) NOT NULL,
  `vacancy` int(1) NOT NULL,
  `available` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`did`, `vacancy`, `available`) VALUES
(1, 4, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`did`),
  ADD UNIQUE KEY `dname` (`dname`),
  ADD UNIQUE KEY `demail` (`demail`),
  ADD UNIQUE KEY `dphone` (`dphone`),
  ADD UNIQUE KEY `daadhar` (`daadhar`),
  ADD UNIQUE KEY `dlicense` (`dlicense`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `tripid` (`tripid`),
  ADD KEY `did` (`did`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `did` (`did`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`tripid`),
  ADD KEY `did` (`did`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD UNIQUE KEY `uphone` (`uphone`),
  ADD UNIQUE KEY `uemail` (`uemail`),
  ADD UNIQUE KEY `uaadhar` (`uaadhar`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD KEY `did` (`did`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `nid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `tripid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notify`
--
ALTER TABLE `notify`
  ADD CONSTRAINT `notify_ibfk_1` FOREIGN KEY (`tripid`) REFERENCES `trip` (`tripid`),
  ADD CONSTRAINT `notify_ibfk_2` FOREIGN KEY (`did`) REFERENCES `driver` (`did`),
  ADD CONSTRAINT `notify_ibfk_3` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`did`) REFERENCES `driver` (`did`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`did`) REFERENCES `driver` (`did`);

--
-- Constraints for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD CONSTRAINT `vacancy_ibfk_1` FOREIGN KEY (`did`) REFERENCES `driver` (`did`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
