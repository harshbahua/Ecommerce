-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2013 at 08:03 AM
-- Server version: 5.6.12
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `HBRD`
--
CREATE DATABASE IF NOT EXISTS `HBRD` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `HBRD`;

-- --------------------------------------------------------

--
-- Table structure for table `Bank`
--

CREATE TABLE IF NOT EXISTS `Bank` (
  `b_no` int(10) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(25) NOT NULL,
  `b_pwd` varchar(64) NOT NULL,
  `b_rs` int(10) NOT NULL,
  PRIMARY KEY (`b_no`),
  UNIQUE KEY `b_no` (`b_no`),
  KEY `b_no_2` (`b_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1111111113 ;

ALTER TABLE Bank ENGINE = InnoDB;

--
-- Dumping data for table `Bank`
--

INSERT INTO `Bank` (`b_no`, `b_name`, `b_pwd`, `b_rs`) VALUES
(1111111110, 'admin', '', 53690),
(1111111112, 'hb', 'e10adc3949ba59abbe56e057f20f883e', 41390);

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE IF NOT EXISTS `Cart` (
  `cid` int(4) NOT NULL AUTO_INCREMENT,
  `pid` int(4) NOT NULL,
  `pname` varchar(25) CHARACTER SET latin1 NOT NULL,
  `prs` int(6) NOT NULL,
  `categ` varchar(25) CHARACTER SET latin1 NOT NULL,
  `userid` varchar(25) CHARACTER SET latin1 NOT NULL,
  `user` varchar(25) CHARACTER SET latin1 NOT NULL,
  `pquant` int(3) NOT NULL,
  `pstatus` varchar(25) NOT NULL,
  `pstatusno` int(3) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

ALTER TABLE Cart ENGINE = InnoDB;

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`cid`, `pid`, `pname`, `prs`, `categ`, `userid`, `user`, `pquant`, `pstatus`, `pstatusno`) VALUES
(1, 1, 'Transcend 2GB', 1230, 'RAM', '123@gmail.com', 'hb', 1, 'PAID', 1),
(2, 1, 'Transcend 2GB', 1230, 'RAM', '123@gmail.com', 'adminhb', 1, 'PENDING', 0),
(3, 1, 'Transcend 2GB', 1230, 'RAM', '123@gmail.com', 'adminhb', 1, 'PENDING', 0),
(4, 1, 'Transcend 2GB', 1230, 'RAM', '123@gmail.com', 'hb', 1, 'PAID', 1),
(5, 1, 'Transcend 2GB', 1230, 'RAM', '123@gmail.com', 'hb', 1, 'PAID', 1),
(6, 1, 'Transcend 2GB', 1230, 'RAM', '123@gmail.com', 'hb', 1, 'PAID', 1),
(7, 1, 'Transcend 2GB', 1230, 'RAM', '123@gmail.com', 'hb', 1, 'PAID', 1),
(8, 1, 'Transcend 2GB', 1230, 'RAM', '123@gmail.com', 'hb', 1, 'PAID', 1),
(9, 1, 'Transcend 2GB', 1230, 'RAM', '123@gmail.com', 'hb', 1, 'PAID', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `c_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_id` (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

ALTER TABLE Category ENGINE = InnoDB;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`c_id`, `c_name`) VALUES
(1, 'Motherboard'),
(2, 'Processors'),
(3, 'RAM'),
(4, 'Storage'),
(5, 'Graphics');

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `p_id` int(4) NOT NULL AUTO_INCREMENT,
  `p_category` varchar(50) NOT NULL DEFAULT '',
  `p_name` varchar(50) NOT NULL DEFAULT '',
  `p_rs` int(6) NOT NULL,
  `p_initial_quantity` int(3) NOT NULL,
  `p_quantity` int(3) NOT NULL,
  `p_desc` varchar(500) NOT NULL DEFAULT '',
  `p_image` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_id` (`p_id`),
  KEY `p_id_2` (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

ALTER TABLE Product ENGINE = InnoDB;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`p_id`, `p_category`, `p_name`, `p_rs`, `p_initial_quantity`, `p_quantity`, `p_desc`, `p_image`) VALUES
(1, 'RAM', 'Transcend 2GB', 1230, 12, 3, '800 MHZ DDR3 2GB RAM', '2-gb-800-mhz-1yw-transcend-500x500.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) CHARACTER SET latin1 NOT NULL,
  `user_password` varchar(64) CHARACTER SET latin1 NOT NULL,
  `user_email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_is_admin` int(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

ALTER TABLE User ENGINE = InnoDB;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `user_name`, `user_password`, `user_email`, `created_at`, `updated_at`, `user_is_admin`) VALUES
(6, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '123@gmail.com', '2013-09-09 19:20:39', '2013-09-09 19:20:39', 1),
(10, 'hb', 'e10adc3949ba59abbe56e057f20f883e', '123@gmail.com', '2013-10-20 12:11:56', '2013-10-20 12:11:56', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
