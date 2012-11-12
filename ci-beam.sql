-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2012 at 01:20 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci-beam`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_resources`
--

CREATE TABLE IF NOT EXISTS `acl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` enum('module','controller','action','other') NOT NULL DEFAULT 'other',
  `parent` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `acl_resources`
--

INSERT INTO `acl_resources` (`id`, `name`, `type`, `parent`, `created`, `modified`) VALUES
(1, 'welcome', 'module', NULL, '2012-11-12 12:07:26', NULL),
(2, 'auth', 'module', NULL, '2012-11-12 04:00:23', NULL),
(3, 'auth/login', 'controller', 2, '2012-11-12 12:43:42', '2012-11-12 12:44:06'),
(4, 'auth/logout', 'controller', 2, '2012-11-12 12:43:56', NULL),
(5, 'auth/user', 'controller', 2, '2012-11-12 04:07:59', '2012-11-12 08:29:29'),
(6, 'acl', 'module', NULL, '2012-02-02 13:47:43', NULL),
(7, 'acl/resource', 'controller', 6, '2012-02-02 13:47:57', NULL),
(8, 'acl/resource/index', 'action', 7, '2012-02-02 13:48:21', NULL),
(9, 'acl/resource/add', 'action', 7, '2012-02-02 13:48:35', '2012-10-16 17:26:12'),
(10, 'acl/resource/edit', 'action', 7, '2012-02-02 13:48:50', '2012-07-09 18:44:38'),
(11, 'acl/resource/delete', 'action', 7, '2012-02-02 13:49:06', NULL),
(12, 'acl/role', 'controller', 6, '2012-07-12 17:54:16', NULL),
(13, 'acl/role/index', 'action', 12, '2012-07-12 17:55:29', NULL),
(14, 'acl/role/add', 'action', 12, '2012-07-12 17:56:00', NULL),
(15, 'acl/role/edit', 'action', 12, '2012-07-12 17:56:19', NULL),
(16, 'acl/role/delete', 'action', 12, '2012-07-12 17:56:55', NULL),
(17, 'acl/rule', 'controller', 6, '2012-07-12 17:53:04', NULL),
(18, 'acl/rule/edit', 'action', 17, '2012-07-12 17:53:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_roles`
--

CREATE TABLE IF NOT EXISTS `acl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=26 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `acl_roles`
--

INSERT INTO `acl_roles` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator', '2011-12-27 12:00:00', NULL),
(2, 'Guest', '2011-12-27 12:00:00', NULL),
(3, 'Staf', '2012-11-12 04:30:02', '2012-11-12 04:30:39'),
(4, 'Manager', '2012-11-12 04:30:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_role_parents`
--

CREATE TABLE IF NOT EXISTS `acl_role_parents` (
  `role_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`,`parent`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acl_role_parents`
--

INSERT INTO `acl_role_parents` (`role_id`, `parent`, `order`) VALUES
(3, 2, 0),
(4, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `acl_rules`
--

CREATE TABLE IF NOT EXISTS `acl_rules` (
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `access` enum('allow','deny') NOT NULL DEFAULT 'deny',
  `priviledge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`resource_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acl_rules`
--

INSERT INTO `acl_rules` (`role_id`, `resource_id`, `access`, `priviledge`) VALUES
(2, 1, 'allow', NULL),
(2, 3, 'allow', NULL),
(2, 4, 'allow', NULL),
(4, 2, 'allow', NULL),
(4, 5, 'allow', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_autologin`
--

CREATE TABLE IF NOT EXISTS `auth_autologin` (
  `user` int(11) NOT NULL,
  `series` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`user`,`series`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

CREATE TABLE IF NOT EXISTS `auth_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `registered` datetime NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1707 ;

--
-- Dumping data for table `auth_users`
--

INSERT INTO `auth_users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `lang`, `registered`, `role_id`) VALUES
(1002, 'Diane', 'Murphy', 'dmurphy', 'dmurphy@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1056, 'Mary', 'Patterson', 'mpatterso', 'mpatterso@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1076, 'Jeff', 'Firrelli', 'jeff.firrelli', 'jeff.firrelli@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1088, 'William', 'Patterson', 'wpatterson', 'wpatterson@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1102, 'Gerard', 'Bondur', 'gbondur', 'gbondur@classicmodelcars.com', '$2a$08$/9GPAwtVkFug2y5yBIhmPOZWSev.Myt.ruNENXo9DT4VrqTwNBE2K', 'en', '2012-03-01 05:54:30', NULL),
(1143, 'Anthony', 'Bow', 'abow', 'abow@classicmodelcars.com', '$2a$08$w6grERmP9T3r7FOBAuxLjO0l9H05ZgFTgGUY26hA89/g/Wq.QLqye', NULL, '2012-03-01 05:54:30', NULL),
(1165, 'Leslie', 'Jennings', 'ljennings', 'ljennings@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1166, 'Leslie', 'Thompson', 'lthompson', 'lthompson@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1188, 'Julie', 'Firrelli', 'julie.firrelli', 'julie.firrelli@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1216, 'Steve', 'Patterson', 'spatterson', 'spatterson@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1337, 'Loui', 'Bondur', 'lbondur', 'lbondur@classicmodelcars.com', '$2a$08$tGx5NElKJIm2hkX3OwRYSOp/VZ/r.oaB2YHdK.HBCDM921rfUVAta', NULL, '2012-03-01 05:54:30', NULL),
(1370, 'Gerard', 'Hernandez', 'ghernande', 'ghernande@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1401, 'Pamela', 'Castillo', 'pcastillo', 'pcastillo@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1501, 'Larry', 'Bott', 'lbott', 'lbott@classicmodelcars.com', '$2a$08$Njus3nhJ9bX5YYGra6xRu.ldrTylOMebKHXW/Wfl0o2wMvtppY476', NULL, '2012-03-01 05:54:30', NULL),
(1504, 'Barry', 'Jones', 'bjones', 'bjones@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1611, 'Andy', 'Fixter', 'afixter', 'afixter@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1612, 'Peter', 'Marsh', 'pmarsh', 'pmarsh@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1619, 'Tom', 'King', 'tking', 'tking@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1621, 'Mami', 'Nishi', 'mnishi', 'mnishi@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1625, 'Yoshimi', 'Kato', 'ykato', 'ykato@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1702, 'Martin', 'Gerard', 'mgerard', 'mgerard@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1703, 'Ardi', 'Soebrata', 'ardissoebrata', 'ardissoebrata@gmail.com', '$2a$08$KZRME/RCMM.ikhJvS9IQtOD/qQcM/922akreUjQ7fgL6BanTAwsIm', 'en', '2012-03-09 12:57:48', 4),
(1704, 'Administrator', 'Tea', 'admin', 'admin@vmt.co.id', '$2a$08$dxSn4NG3GUxu3XGLr4niIuemUHBohdWdBobNsRi6WpBE.h8zHNmXO', 'en', '2012-03-15 19:23:59', 1),
(1706, 'Test', 'TestLast', 'test', 'test@test.com', 'test', 'en', '2012-11-09 10:58:34', 2);

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_master`
--

CREATE TABLE IF NOT EXISTS `auth_users_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1703 ;

--
-- Dumping data for table `auth_users_master`
--

INSERT INTO `auth_users_master` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `registered`) VALUES
(1002, 'Diane', 'Murphy', 'dmurphy', 'dmurphy@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1056, 'Mary', 'Patterson', 'mpatterso', 'mpatterso@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1076, 'Jeff', 'Firrelli', 'jeff.firrelli', 'jeff.firrelli@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1088, 'William', 'Patterson', 'wpatterson', 'wpatterson@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1102, 'Gerard', 'Bondur', 'gbondur', 'gbondur@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1143, 'Anthony', 'Bow', 'abow', 'abow@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1165, 'Leslie', 'Jennings', 'ljennings', 'ljennings@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1166, 'Leslie', 'Thompson', 'lthompson', 'lthompson@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1188, 'Julie', 'Firrelli', 'julie.firrelli', 'julie.firrelli@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1216, 'Steve', 'Patterson', 'spatterson', 'spatterson@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1286, 'Foon Yue', 'Tseng', 'ftseng', 'ftseng@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1323, 'George', 'Vanauf', 'gvanauf', 'gvanauf@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1337, 'Loui', 'Bondur', 'lbondur', 'lbondur@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1370, 'Gerard', 'Hernandez', 'ghernande', 'ghernande@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1401, 'Pamela', 'Castillo', 'pcastillo', 'pcastillo@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1501, 'Larry', 'Bott', 'lbott', 'lbott@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1504, 'Barry', 'Jones', 'bjones', 'bjones@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1611, 'Andy', 'Fixter', 'afixter', 'afixter@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1612, 'Peter', 'Marsh', 'pmarsh', 'pmarsh@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1619, 'Tom', 'King', 'tking', 'tking@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1621, 'Mami', 'Nishi', 'mnishi', 'mnishi@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1625, 'Yoshimi', 'Kato', 'ykato', 'ykato@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1702, 'Martin', 'Gerard', 'mgerard', 'mgerard@classicmodelcars.com', '', '2012-03-01 05:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl_role_parents`
--
ALTER TABLE `acl_role_parents`
  ADD CONSTRAINT `acl_role_parents_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_role_parents_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `acl_rules`
--
ALTER TABLE `acl_rules`
  ADD CONSTRAINT `acl_rules_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_rules_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `acl_resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD CONSTRAINT `auth_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
