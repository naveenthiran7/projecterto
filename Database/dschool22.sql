-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2022 at 11:17 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dschool`
--
CREATE DATABASE IF NOT EXISTS `dschool` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dschool`;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `adate` date NOT NULL DEFAULT '0000-00-00',
  `attend` varchar(20) DEFAULT NULL,
  `af` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`userid`,`adate`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `userid`, `name`, `adate`, `attend`, `af`) VALUES
(113, 'D10012', 'Ram', '2022-05-25', 'present', NULL),
(112, 'D10011', 'Sabari', '2022-05-25', 'present', NULL),
(111, 'D10010', 'Jegan', '2022-05-25', 'present', NULL),
(110, 'D10009', 'Raghav', '2022-05-25', 'present', NULL),
(109, 'D10008', 'Sharvesh', '2022-05-25', 'present', NULL),
(108, 'D10007', 'Karunas', '2022-05-25', 'present', NULL),
(107, 'D10006', 'Gopi', '2022-05-25', 'absent', NULL),
(106, 'D10005', 'Gokul', '2022-05-25', 'present', NULL),
(105, 'D10004', 'Vasanth', '2022-05-25', 'present', NULL),
(104, 'D10003', 'Ganesh', '2022-05-25', 'present', NULL),
(103, 'D10002', 'Sundar', '2022-05-25', 'present', NULL),
(102, 'D10001', 'Anand', '2022-05-25', 'present', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `eattend`
--

CREATE TABLE IF NOT EXISTS `eattend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empid` int(11) DEFAULT NULL,
  `ename` varchar(50) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `absent` int(11) DEFAULT NULL,
  `present` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `eattend`
--

INSERT INTO `eattend` (`id`, `empid`, `ename`, `month`, `year`, `absent`, `present`) VALUES
(1, 1, 'Sundaram', 'Jan', 2022, 2, 29),
(2, 2, 'Guru', 'Jan', 2022, 1, 30),
(3, 3, 'Ram', 'Jan', 2022, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `addr` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `doj` varchar(15) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `gender`, `addr`, `city`, `mobile`, `doj`) VALUES
(1, 'Sundaram', 'male', '2342,north st', 'Madurai', '9878754578', '2007-1-1'),
(2, 'Guru', 'male', '33,North st', 'Madurai', '8785454878', '2010-12-25'),
(3, 'Ram', 'male', '323,north st', 'Madurai', '8675454547', '2006-5-16');

-- --------------------------------------------------------

--
-- Table structure for table `feemaster`
--

CREATE TABLE IF NOT EXISTS `feemaster` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `lictype` varchar(100) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  PRIMARY KEY (`fid`),
  UNIQUE KEY `lictype` (`lictype`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `feemaster`
--

INSERT INTO `feemaster` (`fid`, `lictype`, `duration`, `fee`) VALUES
(1, 'two_wheeler_lic_training', 1, 3600),
(2, 'two_wheeler_lic_only', 1, 2000),
(3, 'four_wheeler_lic_training', 1, 7000),
(4, 'four_wheeler_lic_only', 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

CREATE TABLE IF NOT EXISTS `license` (
  `licid` int(11) NOT NULL AUTO_INCREMENT,
  `llrno` varchar(20) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `lictype` varchar(50) DEFAULT NULL,
  `licno` varchar(30) NOT NULL,
  `issuedon` date NOT NULL,
  `expiryon` date NOT NULL,
  `issuedstatus` varchar(20) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`licid`),
  UNIQUE KEY `licid` (`licid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `license`
--

INSERT INTO `license` (`licid`, `llrno`, `userid`, `lictype`, `licno`, `issuedon`, `expiryon`, `issuedstatus`) VALUES
(1, 'L581000', 'D10000', 'two_with_gear', 'TN582012100', '2022-02-08', '2032-02-08', 'yes'),
(2, 'L581001', 'D10001', 'four_lmvg', 'TN582012101', '2022-02-08', '2032-02-08', 'no'),
(3, 'L581002', 'D10002', 'two_without_gear', 'TN582012102', '2022-02-08', '2032-02-08', 'no'),
(4, 'L581003', 'D10003', 'four_lmvg', 'TN582012103', '2022-02-08', '2032-02-08', 'no'),
(5, 'L581005', 'D10005', 'four_hmvg', 'TN582012104', '2022-02-08', '2032-02-08', 'no'),
(6, 'L581010', 'D10012', 'two_with_gear', 'TN58202210', '2022-06-27', '2032-06-27', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `licenserenewal`
--

CREATE TABLE IF NOT EXISTS `licenserenewal` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) DEFAULT NULL,
  `lictype` varchar(50) DEFAULT NULL,
  `licno` varchar(50) DEFAULT NULL,
  `rdate` date DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  UNIQUE KEY `rid` (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `llr`
--

CREATE TABLE IF NOT EXISTS `llr` (
  `llrno` varchar(30) NOT NULL,
  `userid` varchar(20) DEFAULT NULL,
  `llrtype` varchar(100) DEFAULT NULL,
  `validfrom` date DEFAULT NULL,
  `validto` date DEFAULT NULL,
  `amtpaid` int(11) DEFAULT NULL,
  PRIMARY KEY (`llrno`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `llr`
--

INSERT INTO `llr` (`llrno`, `userid`, `llrtype`, `validfrom`, `validto`, `amtpaid`) VALUES
('L581000', 'D10000', 'two_with_gear', '2022-01-01', '2022-07-01', 500),
('L581001', 'D10001', 'four_lmvg', '2022-01-01', '2022-07-01', 500),
('L581002', 'D10002', 'two_without_gear', '2022-01-01', '2022-07-01', 500),
('L581003', 'D10003', 'four_lmvg', '2022-01-01', '2022-07-02', 600),
('L581004', 'D10004', 'four_lmvg', '2022-01-01', '2022-07-02', 500),
('L581005', 'D10005', 'four_hmvg', '2022-01-01', '2022-07-02', 500),
('L581006', 'D10006', 'two_with_gear', '2022-01-02', '2022-07-02', 500),
('L581007', 'D10007', 'two_without_gear', '2022-01-01', '2022-07-02', 500),
('L581008', 'D10010', 'four_lmvg', '2022-03-29', '2022-09-29', 1000),
('L581009', 'D10011', 'four_lmvg', '2022-03-29', '2022-09-29', 2000),
('L581010', 'D10012', 'two_with_gear', '2022-05-25', '2022-11-25', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(20) DEFAULT NULL,
  `totamt` int(11) DEFAULT NULL,
  `paidamt` int(11) DEFAULT '0',
  UNIQUE KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pid`, `userid`, `totamt`, `paidamt`) VALUES
(1, 'D10000', 3600, 3600),
(2, 'D10001', 7000, 7000),
(3, 'D10002', 2000, 500),
(4, 'D10003', 7000, 600),
(5, 'D10004', 7000, 500),
(6, 'D10005', 3600, 3600),
(7, 'D10006', 5000, 500),
(8, 'D10007', 3600, 500),
(10, 'D10008', 3600, 0),
(11, 'D10009', 3600, 0),
(14, 'D10011', 7000, 2000),
(13, 'D10010', 7000, 1000),
(15, 'D10012', 3600, 3600);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `basic` float DEFAULT NULL,
  `da` float DEFAULT NULL,
  `hra` float DEFAULT NULL,
  `pf` float DEFAULT NULL,
  `esi` float DEFAULT NULL,
  `ded` float DEFAULT NULL,
  `gross` float DEFAULT NULL,
  `net` float DEFAULT NULL,
  UNIQUE KEY `sid` (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`sid`, `aid`, `basic`, `da`, `hra`, `pf`, `esi`, `ded`, `gross`, `net`) VALUES
(1, 1, 11600, 4060, 2900, 464, 232, 928, 18560, 17632),
(2, 2, 11250, 3937.5, 2812.5, 450, 225, 900, 18000, 17100);

-- --------------------------------------------------------

--
-- Table structure for table `userregn`
--

CREATE TABLE IF NOT EXISTS `userregn` (
  `userid` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `workst` varchar(10) DEFAULT NULL,
  `addr` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `lictype` varchar(50) DEFAULT NULL,
  `trngtype` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregn`
--

INSERT INTO `userregn` (`userid`, `name`, `gender`, `workst`, `addr`, `city`, `dob`, `age`, `lictype`, `trngtype`, `password`, `fee`, `mobile`) VALUES
('D10000', 'Arun Kumar', 'male', 'yes', '987,Cedar Street,', 'Madurai', '1981-09-23', 30, 'two_with_gear', 'with_training', 'arun', 3600, '9855566587'),
('D10001', 'Anand', 'male', 'yes', '7767,Park Avenue,', 'Madurai', '1985-11-13', 25, 'four_lmvg', 'with_training', 'anand', 7000, '9855566587'),
('D10002', 'Sundar', 'male', 'yes', '68,Main Street,', 'Madurai', '1980-12-14', 31, 'two_without_gear', 'without_training', 'sundar', 2000, '9855566587'),
('D10003', 'Ganesh', 'male', 'yes', '373,North Street,', 'Madurai', '1981-08-04', 30, 'four_lmvg', 'with_training', 'ganesh', 7000, '9855566587'),
('D10004', 'Vasanth', 'male', 'yes', '44,New Chitrai St.,', 'Madurai', '1981-12-11', 30, 'four_lmvg', 'with_training', 'vasanth', 7000, '9855566587'),
('D10005', 'Gokul', 'male', 'yes', '988,Sundaram Street,', 'Madurai', '1975-08-20', 36, 'four_hmvg', 'without_training', 'gokul', 5000, '9855566587'),
('D10006', 'Gopi', 'male', 'yes', '75,College Road', 'Madurai', '1982-08-30', 28, 'two_with_gear', 'with_training', 'gopi', 3600, '9855566587'),
('D10007', 'Karunas', 'male', 'yes', '373,Chettiyar Lane', 'Madurai', '1990-12-12', 21, 'two_without_gear', 'with_training', 'karunas', 3600, '9855566587'),
('D10008', 'Sharvesh', 'male', 'yes', '747,Chitrai Street,', 'Madurai', '1975-09-13', 36, 'two_with_gear', 'with_training', 'sharvesh', 3600, '9855566587'),
('D10009', 'Raghav', 'male', 'yes', '5875,Railway Colony', 'Madurai', '1981-06-03', 30, 'two_with_gear', 'with_training', 'raghav', 3600, '9855566587'),
('D10010', 'Jegan', 'male', 'yes', '2321,south st,', 'Madurai', '1985-03-03', 28, 'four_lmvg', 'with_training', 'jegan', 7000, '5555566555'),
('D10011', 'Sabari', 'male', 'yes', '2,North car st', 'Madurai', '1976-07-05', 37, 'four_lmvg', 'with_training', 'sabari', 7000, '8877788999'),
('D10012', 'Ram', 'male', 'yes', '343,South Car STreet,\r\n', 'Madurai', '1987-02-01', 35, 'two_with_gear', 'with_training', 'ram', 3600, '9876837483');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
