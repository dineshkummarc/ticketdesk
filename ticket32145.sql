-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2016 at 11:49 AM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ticket32145`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `groupId` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventlog`
--

CREATE TABLE IF NOT EXISTS `eventlog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ticketid` bigint(20) NOT NULL,
  `eventdate` datetime NOT NULL,
  `oldclientid` bigint(20) DEFAULT NULL,
  `oldsubject` varchar(255) DEFAULT NULL,
  `oldcategoryid` bigint(20) DEFAULT NULL,
  `oldsubcategoryid` bigint(20) DEFAULT NULL,
  `oldassigneduser` varchar(30) DEFAULT NULL,
  `oldparentticketid` bigint(20) DEFAULT NULL,
  `oldgroupid` bigint(20) DEFAULT NULL,
  `newclientid` bigint(20) DEFAULT NULL,
  `newsubject` varchar(255) DEFAULT NULL,
  `newcategoryid` bigint(20) DEFAULT NULL,
  `newsubcategoryid` bigint(20) DEFAULT NULL,
  `newassigneduser` varchar(30) DEFAULT NULL,
  `newparentticketid` bigint(20) DEFAULT NULL,
  `newgroupid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'accounting'),
(2, 'IT'),
(3, 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `categoryid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;


-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `name`, `value`) VALUES
(1, 'version', '0.1'),
(2, 'Authentication', 'Native'),
(3, 'system email', 'notice@ticketdesk.com'),
(4, 'language', 'English'),
(5, 'siteurl', 'http://devmonkeyz.com/ticketdev/');

-- --------------------------------------------------------

--
-- Table structure for table `systemlanguage`
--

CREATE TABLE IF NOT EXISTS `systemlanguage` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `systemlanguage`
--

INSERT INTO `systemlanguage` (`id`, `language`, `keyword`, `value`) VALUES
(1, 'english', 'save', 'save'),
(2, 'english', 'ticket', 'ticket'),
(3, 'english', 'client', 'client'),
(4, 'english', 'subject', 'subject'),
(5, 'english', 'details', 'details'),
(6, 'english', 'create', 'create'),
(7, 'english', 'close', 'close'),
(8, 'english', 'category', 'category'),
(9, 'english', 'subcategory', 'sub category'),
(10, 'english', 'assigned', 'assigned'),
(11, 'english', 'status', 'status'),
(12, 'english', 'reset', 'reset'),
(13, 'english', 'New Ticket', 'New Ticket'),
(14, 'english', 'Recent Ticket', 'Recent Ticket'),
(15, 'english', 'Search', 'Search'),
(16, 'english', 'Submit', 'Submit'),
(17, 'english', 'Open', 'Open'),
(18, 'english', 'Closed', 'Closed'),
(19, 'english', 'Ticket Desk', 'Ticket Desk'),
(20, 'english', 'Tickets', 'Tickets'),
(21, 'english', 'Reports', 'Reports'),
(22, 'english', 'System', 'System'),
(23, 'english', 'My Tickets', 'My Tickets'),
(24, 'english', 'All', 'All'),
(25, 'english', 'Waiting On Client', 'Waiting On Client'),
(26, 'english', 'Waiting On Agent', 'Waiting On Agent'),
(27, 'english', 'Waiting On Other', 'Waiting On Other'),
(28, 'english', 'Report Name', 'Report Name'),
(29, 'english', 'Start Date', 'Start Date'),
(30, 'english', 'End Date', 'End Date'),
(31, 'english', 'Created by', 'Created by'),
(32, 'english', 'Categories', 'Categories'),
(33, 'english', 'Users', 'Users'),
(34, 'english', 'Groups', 'Groups'),
(35, 'english', 'Log Out', 'Log Out'),
(36, 'english', 'Log In', 'Log In'),
(37, 'english', 'Forgot?', 'Forgot?'),
(38, 'english', 'Register', 'Register'),
(39, 'english', 'Username', 'Username'),
(40, 'english', 'Password', 'Password'),
(41, 'english', 'Add', 'Add'),
(42, 'english', 'Delete', 'Delete'),
(43, 'english', 'Save', 'Save');

-- --------------------------------------------------------

--
-- Table structure for table `ticketnotes`
--

CREATE TABLE IF NOT EXISTS `ticketnotes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ticketid` bigint(20) NOT NULL,
  `note` varchar(8000) NOT NULL,
  `user` varchar(30) NOT NULL,
  `notedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;


--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `clientid` bigint(20) DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `categoryid` bigint(20) NOT NULL,
  `subcategoryid` bigint(20) DEFAULT NULL,
  `comments` varchar(8000) DEFAULT NULL,
  `transferyn` tinyint(1) DEFAULT NULL,
  `groupid` mediumint(9) DEFAULT NULL,
  `opendate` datetime NOT NULL,
  `parentticketid` bigint(20) DEFAULT '0',
  `assigneduser` varchar(30) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticketstatus`
--

CREATE TABLE IF NOT EXISTS `ticketstatus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ticketid` bigint(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `statusdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=333 ;

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `groupid` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

