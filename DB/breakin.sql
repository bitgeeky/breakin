-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2013 at 07:44 PM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `breakin`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `qcat` int(11) NOT NULL,
  `qnum` int(11) NOT NULL,
  `cdes` varchar(1000) NOT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`username`, `qcat`, `qnum`, `cdes`, `cdate`) VALUES
('testusera', 1, 1, 'this is comment on qnum 1 and qcat 1 by testusera', '2013-12-12 08:57:31'),
('testuserb', 1, 2, 'this is comment on qnum 2 and qcat 1 by testuserb', '2013-12-12 09:00:06'),
('testusera', 2, 1, 'this is comment on qnum 1 and qcat 2 by testusera', '2013-12-12 09:01:04'),
('testuserb', 2, 2, 'this is comment on qnum 2 and qcat 2 by testuserb', '2013-12-12 09:02:03'),
('testusera', 3, 1, 'this is comment on qnum 1 and qcat 3 by testusera', '2013-12-12 09:02:46'),
('testuserb', 3, 2, 'this is comment on qnum 2 and qcat 3 by testuserb', '2013-12-12 09:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `ques`
--

CREATE TABLE IF NOT EXISTS `ques` (
  `qnum` int(11) NOT NULL,
  `qcat` int(11) NOT NULL,
  `qdes` varchar(1000) NOT NULL,
  `ans` varchar(1000) NOT NULL,
  `qhint` varchar(1000) NOT NULL,
  `hintflag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ques`
--

INSERT INTO `ques` (`qnum`, `qcat`, `qdes`, `ans`, `qhint`, `hintflag`) VALUES
(2, 1, 'This is ques 2 of cat 1 (the actual ques description) !', 'This is ans 2 of cat 1 (the actual ques description) !', 'This is hint 2 of cat 1 (the actual ques description) !', 1),
(1, 2, 'This is ques 1 of cat 2 (the actual ques description) !', 'This is ans 1 of cat 2 (the actual ques description) !', 'This is hint 1 of cat 2 (the actual ques description) !', 0),
(1, 1, 'This is ques 1 of cat 1 (the actual ques description) !', 'This is ans 1 of cat 1 (the actual ques description) !', 'This is hint 1 of cat 1 (the actual ques description) !', 0),
(2, 2, 'This is ques 2 of cat 2 (the actual ques description) !', 'This is ans 2 of cat 2 (the actual ques description) !', 'This is hint 2 of cat 2 (the actual ques description) !', 1),
(1, 3, 'This is ques 1 of cat 3 (the actual ques description) !', 'ans to 3 1 ', 'This is hint 1 of cat 3 (the actual ques description) !', 0),
(2, 3, 'This is ques 2 of cat 3 (the actual ques description) !', 'This is ans 2 of cat 3 (the actual ques description) !', 'This is hint 2 of cat 3 (the actual ques description) !', 1);

-- --------------------------------------------------------

--
-- Table structure for table `solved`
--

CREATE TABLE IF NOT EXISTS `solved` (
  `username` varchar(20) NOT NULL,
  `qcat` int(11) NOT NULL,
  `qnum` int(11) NOT NULL,
  `sdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solved`
--

INSERT INTO `solved` (`username`, `qcat`, `qnum`, `sdate`) VALUES
('testusera', 1, 1, '2013-12-12 10:21:52'),
('testuserb', 2, 1, '2013-12-12 10:22:16'),
('testusera', 3, 1, '2013-12-12 13:47:11');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
