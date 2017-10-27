-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2016 at 11:08 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cm`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_id`, `c_name`, `section`, `status`) VALUES
(1, 'Computer Networks', 'A', 'open'),
(2, 'Computer Networks', 'B', 'open'),
(3, 'Advanced Computer Networks', 'A', 'closed'),
(4, 'Advanced Computer Networks', 'B', 'open'),
(5, 'Web Techonologies', 'A', 'open'),
(6, 'Web Techonologies', 'B', 'open'),
(7, 'Computer Graphics', 'A', 'open'),
(8, 'Computer Graphics', 'B', 'open'),
(9, 'Compiler Design', 'A', 'open'),
(10, 'Compiler Design', 'B', 'open'),
(11, 'Algorithms', 'A', 'open'),
(12, 'Algorithms', 'B', 'open'),
(13, 'Data Structure', 'A', 'open'),
(14, 'Data Structure', 'B', 'closed'),
(15, 'Object Oriented Programming1', 'A', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fac_id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fac_id`, `first_name`, `last_name`, `user_name`, `phone`, `email`, `password`) VALUES
(8, 'Minhazul', 'Islam', 'Arnob', 1620117672, 'minhazarnob59@yahoo.com', '1234'),
(9, 'Imtiazul', 'Islam', 'Ontu', 1755364938, 'intu@yahoo.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_courses`
--

CREATE TABLE `faculty_courses` (
  `serial_no` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_courses`
--

INSERT INTO `faculty_courses` (`serial_no`, `user_name`, `faculty_name`, `course_title`, `section`) VALUES
(2, 'Arnob', 'Minhazul Islam', 'Advanced Computer Networks', 'A'),
(4, 'Arnob', 'Minhazul Islam', 'Data Structure', 'B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fac_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `faculty_courses`
--
ALTER TABLE `faculty_courses`
  ADD PRIMARY KEY (`serial_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fac_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `faculty_courses`
--
ALTER TABLE `faculty_courses`
  MODIFY `serial_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
