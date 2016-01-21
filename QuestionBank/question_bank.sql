-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2014 at 02:07 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `question_bank`
--
CREATE DATABASE IF NOT EXISTS `question_bank` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `question_bank`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE IF NOT EXISTS `admin_accounts` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `data` varchar(500) NOT NULL,
  `time` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `email`, `name`, `data`, `time`, `status`, `question_id`) VALUES
(2, 'a@b.com', 'a', 'Hello World, how are you?', '2014-07-14 13:05:11', 1, 61),
(3, 'a@b.com', 'a', 'Wow, life is wonderful.', '2014-07-14 13:08:21', 1, 61),
(4, 'a@b.com', 'a', 'Wow, life is wonderful.', '2014-07-14 13:08:26', 1, 61),
(5, 'a@b.com', 'a', 'Hi there', '2014-07-14 13:09:21', 1, 61),
(6, 'anik801@yahoo.com', 'Anik', 'Thank you very much, I really needed this.', '2014-07-14 13:53:43', 1, 61),
(14, 'anik801@yahoo.com', 'Anik', 'Nice share.', '2014-07-16 16:45:32', 1, 66),
(15, 'anik801@yahoo.com', 'Anik', 'Thank you.', '2014-07-16 17:23:09', 0, 63);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(4) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `semester` varchar(6) NOT NULL,
  `exam` varchar(20) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  PRIMARY KEY (`question_id`),
  UNIQUE KEY `id` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `department`, `year`, `semester`, `exam`, `subject_code`) VALUES
(61, 'Architecture', 2002, 'Fall', 'Final', 'ARCH2209'),
(62, 'Computer Science and Engineering', 2009, 'Spring', 'Carry_Clearance', 'CSE3321'),
(63, 'Civil Engineering', 2009, 'Fall', 'Final', 'CE2505'),
(64, 'Textile Technology', 2020, 'Spring', 'Carry_Clearance', 'TEX4100'),
(65, 'Mechanical Engineering', 2010, 'Fall', 'Final', 'ME1101'),
(66, 'Computer Science and Engineering', 2013, 'Spring', 'Final', 'CSE3220');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
