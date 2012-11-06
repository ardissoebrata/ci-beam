-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2012 at 02:42 AM
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

DROP TABLE IF EXISTS `acl_resources`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `acl_resources`
--

INSERT INTO `acl_resources` (`id`, `name`, `type`, `parent`, `created`, `modified`) VALUES
(1, 'account', 'module', NULL, '2012-02-02 13:32:38', NULL),
(2, 'account/sign-in', 'controller', 1, '2012-02-02 13:32:57', NULL),
(3, 'home', 'controller', NULL, '2012-02-02 13:34:23', NULL),
(4, 'index', 'action', 3, '2012-02-02 13:34:33', NULL),
(5, 'calendar', 'module', NULL, '2012-02-02 13:34:51', NULL),
(6, 'calendar/view', 'controller', 5, '2012-02-02 13:35:11', NULL),
(7, 'calendar/view/month', 'action', 6, '2012-02-02 13:35:51', NULL),
(8, 'calendar/view/week', 'action', 6, '2012-02-02 13:36:06', NULL),
(9, 'calendar/appointment', 'controller', 5, '2012-02-02 13:36:24', NULL),
(10, 'calendar/task', 'controller', 5, '2012-02-02 13:36:36', NULL),
(11, 'messaging', 'module', NULL, '2012-02-02 13:37:39', NULL),
(12, 'messaging/internal', 'controller', 11, '2012-02-02 13:37:55', NULL),
(13, 'messaging/internal/index', 'action', 12, '2012-02-02 13:38:29', NULL),
(14, 'messaging/internal/read', 'action', 12, '2012-02-02 13:38:48', NULL),
(15, 'account/profile', 'controller', 1, '2012-02-02 13:39:49', '2012-10-16 17:45:42'),
(16, 'account/profile/edit', 'action', 15, '2012-02-02 13:40:08', NULL),
(17, 'account/profile/view', 'action', 15, '2012-02-02 13:40:25', '2012-10-16 18:05:01'),
(18, 'document', 'module', NULL, '2012-02-02 13:43:38', NULL),
(19, 'document/manager', 'controller', 18, '2012-02-02 13:43:51', NULL),
(20, 'document/manager/index', 'action', 19, '2012-02-02 13:44:06', NULL),
(21, 'calendar/appointment/index', 'action', 9, '2012-02-02 13:44:42', NULL),
(22, 'calendar/appointment/add', 'action', 9, '2012-02-02 13:45:05', NULL),
(23, 'calendar/appointment/edit', 'action', 9, '2012-02-02 13:45:19', NULL),
(24, 'calendar/appointment/delete', 'action', 9, '2012-02-02 13:45:38', NULL),
(25, 'calendar/task/index', 'action', 10, '2012-02-02 13:46:08', NULL),
(26, 'calendar/task/edit', 'action', 10, '2012-02-02 13:46:21', NULL),
(27, 'calendar/task/add', 'action', 10, '2012-02-02 13:46:37', NULL),
(28, 'calendar/task/delete', 'action', 10, '2012-02-02 13:46:51', NULL),
(29, 'acl', 'module', NULL, '2012-02-02 13:47:43', NULL),
(30, 'acl/resource', 'controller', 29, '2012-02-02 13:47:57', NULL),
(31, 'acl/resource/index', 'action', 30, '2012-02-02 13:48:21', NULL),
(32, 'acl/resource/add', 'action', 30, '2012-02-02 13:48:35', '2012-10-16 17:26:12'),
(33, 'acl/resource/edit', 'action', 30, '2012-02-02 13:48:50', '2012-07-09 18:44:38'),
(34, 'acl/resource/delete', 'action', 30, '2012-02-02 13:49:06', NULL),
(36, 'marketing', 'controller', 91, '2012-07-12 12:19:44', '2012-07-24 08:22:47'),
(37, 'marketing/referrals', 'action', 36, '2012-07-12 12:21:34', '2012-07-24 08:26:35'),
(38, 'marketing/compliance', 'action', 36, '2012-07-12 12:24:59', '2012-07-24 08:23:19'),
(39, 'marketing/my_compliance_log', 'action', 36, '2012-07-12 12:25:37', '2012-07-24 08:25:50'),
(40, 'marketing/accounting', 'action', 36, '2012-07-12 12:26:01', '2012-07-24 08:23:04'),
(41, 'marketing/my_accounting_log', 'action', 36, '2012-07-12 12:26:20', '2012-07-24 08:25:06'),
(43, 'marketing/settlement', 'action', 36, '2012-07-12 12:43:12', '2012-07-24 08:26:50'),
(44, 'marketing/my_settlement_log', 'action', 36, '2012-07-12 12:43:25', '2012-07-24 08:26:06'),
(45, 'marketing/sett_accounts_log', 'action', 36, '2012-07-12 12:44:26', '2012-07-24 08:27:14'),
(46, 'marketing/contacts', 'action', 36, '2012-07-12 12:45:11', '2012-07-24 08:23:32'),
(47, 'marketing/leads', 'action', 36, '2012-07-12 12:50:16', '2012-07-24 08:24:52'),
(48, 'marketing/ncf', 'action', 36, '2012-07-12 12:50:33', '2012-07-24 08:26:19'),
(49, 'marketing/my_accounts', 'action', 36, '2012-07-12 12:50:49', '2012-07-24 08:25:36'),
(50, 'acl/rule', 'controller', 29, '2012-07-12 17:53:04', NULL),
(51, 'acl/rule/edit', 'action', 50, '2012-07-12 17:53:25', NULL),
(52, 'acl/role', 'controller', 29, '2012-07-12 17:54:16', NULL),
(53, 'acl/role/index', 'action', 52, '2012-07-12 17:55:29', NULL),
(54, 'acl/role/add', 'action', 52, '2012-07-12 17:56:00', NULL),
(55, 'acl/role/edit', 'action', 52, '2012-07-12 17:56:19', NULL),
(56, 'acl/role/delete', 'action', 52, '2012-07-12 17:56:55', NULL),
(57, 'commission', 'module', NULL, '2012-07-12 18:00:03', NULL),
(58, 'commission/conversions', 'controller', 57, '2012-07-12 18:00:39', NULL),
(59, 'commission/organization', 'controller', 57, '2012-07-12 18:01:06', NULL),
(60, 'commission/overriding', 'controller', 57, '2012-07-12 18:01:31', NULL),
(61, 'commission/referrals', 'controller', 57, '2012-07-12 18:02:00', NULL),
(62, 'commission/symbols', 'controller', 57, '2012-07-12 18:03:02', NULL),
(63, 'eis', 'module', NULL, '2012-07-12 18:04:24', NULL),
(64, 'eis/commission', 'controller', 63, '2012-07-12 18:04:53', NULL),
(65, 'organization', 'module', NULL, '2012-07-12 18:09:11', '2012-07-12 18:11:46'),
(66, 'organization/branch', 'controller', 65, '2012-07-12 18:09:53', NULL),
(67, 'organization/branch_group', 'controller', 65, '2012-07-12 18:10:23', NULL),
(68, 'organization/organization', 'controller', 65, '2012-07-12 18:10:50', NULL),
(69, 'organization/position', 'controller', 65, '2012-07-12 18:11:11', NULL),
(70, 'organization/structure', 'controller', 65, '2012-07-12 18:11:32', NULL),
(71, 'organization/branch/index', 'action', 66, '2012-07-12 18:13:26', NULL),
(72, 'organization/branch/add', 'action', 66, '2012-07-12 18:13:47', NULL),
(73, 'organization/branch/edit', 'action', 66, '2012-07-12 18:14:31', NULL),
(74, 'organization/branch/delete', 'action', 66, '2012-07-12 18:14:57', NULL),
(75, 'organization/branch_group/index', 'action', 67, '2012-07-12 18:15:34', NULL),
(76, 'organization/branch_group/add', 'action', 67, '2012-07-12 18:15:54', NULL),
(77, 'organization/branch_group/edit', 'action', 67, '2012-07-12 18:16:15', NULL),
(78, 'organization/branch_group/delete', 'action', 67, '2012-07-12 18:16:29', NULL),
(79, 'organization/organization/index', 'action', 68, '2012-07-12 18:25:25', NULL),
(80, 'organization/position/index', 'action', 69, '2012-07-12 18:25:48', NULL),
(81, 'organization/position/add', 'action', 69, '2012-07-12 18:26:04', NULL),
(82, 'organization/position/edit', 'action', 69, '2012-07-12 18:26:23', NULL),
(83, 'organization/position/delete', 'action', 69, '2012-07-12 18:26:40', NULL),
(84, 'organization/structure/index', 'action', 70, '2012-07-12 18:27:13', NULL),
(85, 'organization/structure/add', 'action', 70, '2012-07-12 18:27:39', NULL),
(86, 'organization/structure/edit', 'action', 70, '2012-07-12 18:27:54', NULL),
(87, 'organization/structure/delete', 'action', 70, '2012-07-12 18:28:14', NULL),
(88, 'account/profile/add', 'action', 15, '2012-07-23 07:39:18', NULL),
(89, 'account/profile/delete', 'action', 15, '2012-07-23 07:40:53', NULL),
(90, 'account/index', 'controller', 1, '2012-07-23 07:59:42', NULL),
(91, 'my work', 'module', NULL, '2012-07-24 08:00:59', NULL),
(92, 'events/my_event', 'action', 95, '2012-07-24 23:04:51', '2012-07-24 23:20:07'),
(93, 'events/event_proposal', 'action', 95, '2012-07-24 23:05:45', '2012-07-24 23:19:18'),
(94, 'events/finalized', 'action', 95, '2012-07-24 23:08:48', '2012-07-24 23:19:57'),
(95, 'events', 'controller', 91, '2012-07-24 23:18:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_roles`
--

DROP TABLE IF EXISTS `acl_roles`;
CREATE TABLE IF NOT EXISTS `acl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=26 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `acl_roles`
--

INSERT INTO `acl_roles` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator', '2011-12-27 12:00:00', NULL),
(2, 'Guest', '2011-12-27 12:00:00', NULL),
(3, 'Compliance Manager', '2011-12-27 12:00:00', '2012-07-09 20:54:23'),
(4, 'Accounting Manager', '2011-12-27 12:00:00', '2012-07-09 20:55:12'),
(5, 'Settlement Manager', '2011-12-27 12:00:00', '2012-07-09 20:55:55'),
(17, 'Head of Education', '2011-12-27 12:00:00', '2012-07-09 20:56:52'),
(35, 'Employee', '2012-02-06 10:52:26', NULL),
(36, 'Owner', '2012-07-09 20:44:03', NULL),
(37, 'Direktur', '2012-07-09 20:44:22', NULL),
(38, 'BM Regional', '2012-07-09 20:45:05', NULL),
(39, 'Branch Manager', '2012-07-09 20:45:51', NULL),
(40, 'Marketing Manager', '2012-07-09 20:46:18', '2012-07-12 11:31:20'),
(41, 'Division Manager', '2012-07-09 20:46:54', NULL),
(42, 'Assistant Manager', '2012-07-09 20:47:41', NULL),
(43, 'FC', '2012-07-09 20:48:02', '2012-07-09 21:51:08'),
(44, 'Head InHouse Manager', '2012-07-09 20:50:02', '2012-07-12 11:33:00'),
(45, 'InHouse Manager', '2012-07-09 20:51:07', NULL),
(46, 'Marketing', '2012-07-09 20:52:20', NULL),
(48, 'Compliance', '2012-07-09 20:54:37', '2012-07-12 11:55:31'),
(49, 'Accounting', '2012-07-09 20:55:27', '2012-10-16 19:18:55'),
(50, 'Settlement', '2012-07-09 20:56:13', '2012-07-12 11:57:10'),
(51, 'Education', '2012-07-09 20:57:13', '2012-07-12 11:53:53'),
(52, 'HRD', '2012-07-09 21:02:16', NULL),
(53, 'Head of Research & Analyst', '2012-07-09 21:03:30', NULL),
(54, 'Research & Analyst', '2012-07-09 21:04:01', '2012-07-12 11:56:44'),
(55, 'Head of Promotion', '2012-07-09 21:04:34', NULL),
(56, 'Promotion', '2012-07-09 21:05:05', '2012-07-12 11:56:13'),
(57, 'Bussiness Development Officer', '2012-07-09 21:07:11', '2012-07-12 11:34:48'),
(64, 'Assistant Branch Manager', '2012-07-12 11:30:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_role_parents`
--

DROP TABLE IF EXISTS `acl_role_parents`;
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
(3, 35, 0),
(4, 35, 0),
(5, 35, 0),
(17, 35, 0),
(35, 2, 0),
(36, 2, 0),
(37, 2, 0),
(38, 2, 0),
(39, 35, 0),
(40, 39, 0),
(40, 64, 1),
(41, 40, 0),
(42, 41, 0),
(43, 42, 0),
(43, 46, 1),
(44, 39, 0),
(44, 64, 1),
(45, 44, 0),
(46, 45, 0),
(48, 3, 0),
(48, 39, 1),
(48, 64, 2),
(49, 4, 0),
(49, 39, 1),
(49, 64, 2),
(50, 5, 0),
(50, 39, 1),
(50, 64, 2),
(51, 17, 0),
(51, 39, 1),
(51, 64, 2),
(52, 35, 0),
(53, 35, 0),
(54, 39, 1),
(54, 53, 0),
(54, 64, 2),
(55, 35, 0),
(56, 39, 1),
(56, 55, 0),
(56, 64, 2),
(57, 39, 0),
(57, 64, 1),
(64, 39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `acl_rules`
--

DROP TABLE IF EXISTS `acl_rules`;
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
(1, 36, 'allow', NULL),
(1, 37, 'allow', NULL),
(1, 38, 'allow', NULL),
(1, 39, 'allow', NULL),
(1, 40, 'allow', NULL),
(1, 41, 'allow', NULL),
(1, 43, 'allow', NULL),
(1, 44, 'allow', NULL),
(1, 45, 'allow', NULL),
(1, 46, 'allow', NULL),
(1, 47, 'allow', NULL),
(1, 48, 'allow', NULL),
(1, 49, 'allow', NULL),
(1, 91, 'allow', NULL),
(2, 1, 'allow', NULL),
(2, 2, 'allow', NULL),
(2, 3, 'allow', NULL),
(2, 4, 'allow', NULL),
(2, 5, 'allow', NULL),
(2, 6, 'allow', NULL),
(2, 7, 'allow', NULL),
(2, 8, 'allow', NULL),
(2, 9, 'allow', NULL),
(2, 10, 'allow', NULL),
(2, 11, 'allow', NULL),
(2, 12, 'allow', NULL),
(2, 13, 'allow', NULL),
(2, 14, 'allow', NULL),
(2, 15, 'allow', NULL),
(2, 16, 'allow', NULL),
(2, 17, 'allow', NULL),
(2, 18, 'allow', NULL),
(2, 19, 'allow', NULL),
(2, 20, 'allow', NULL),
(2, 21, 'allow', NULL),
(2, 22, 'allow', NULL),
(2, 23, 'allow', NULL),
(2, 24, 'allow', NULL),
(2, 25, 'allow', NULL),
(2, 26, 'allow', NULL),
(2, 27, 'allow', NULL),
(2, 28, 'allow', NULL),
(3, 38, 'allow', NULL),
(3, 39, 'allow', NULL),
(4, 36, 'allow', NULL),
(4, 40, 'allow', NULL),
(4, 41, 'allow', NULL),
(5, 43, 'allow', NULL),
(5, 44, 'allow', NULL),
(5, 45, 'allow', NULL),
(35, 1, 'allow', NULL),
(35, 3, 'allow', NULL),
(35, 5, 'allow', NULL),
(35, 11, 'allow', NULL),
(35, 18, 'allow', NULL),
(38, 1, 'allow', NULL),
(38, 2, 'allow', NULL),
(38, 3, 'allow', NULL),
(38, 4, 'allow', NULL),
(38, 5, 'allow', NULL),
(38, 6, 'allow', NULL),
(38, 7, 'allow', NULL),
(38, 8, 'allow', NULL),
(38, 9, 'allow', NULL),
(38, 10, 'allow', NULL),
(38, 11, 'allow', NULL),
(38, 12, 'allow', NULL),
(38, 13, 'allow', NULL),
(38, 14, 'allow', NULL),
(38, 15, 'allow', NULL),
(38, 16, 'allow', NULL),
(38, 17, 'allow', NULL),
(38, 18, 'allow', NULL),
(38, 19, 'allow', NULL),
(38, 20, 'allow', NULL),
(38, 21, 'allow', NULL),
(38, 22, 'allow', NULL),
(38, 23, 'allow', NULL),
(38, 24, 'allow', NULL),
(38, 25, 'allow', NULL),
(38, 26, 'allow', NULL),
(38, 27, 'allow', NULL),
(38, 28, 'allow', NULL),
(38, 29, 'deny', NULL),
(38, 30, 'deny', NULL),
(38, 31, 'deny', NULL),
(38, 32, 'deny', NULL),
(38, 33, 'deny', NULL),
(38, 34, 'deny', NULL),
(38, 36, 'deny', NULL),
(38, 37, 'deny', NULL),
(38, 38, 'deny', NULL),
(38, 39, 'deny', NULL),
(38, 40, 'deny', NULL),
(38, 41, 'deny', NULL),
(38, 43, 'deny', NULL),
(38, 44, 'deny', NULL),
(38, 45, 'deny', NULL),
(38, 46, 'deny', NULL),
(38, 47, 'deny', NULL),
(38, 48, 'deny', NULL),
(38, 49, 'deny', NULL),
(38, 91, 'allow', NULL),
(38, 92, 'allow', NULL),
(38, 93, 'allow', NULL),
(38, 94, 'allow', NULL),
(38, 95, 'allow', NULL),
(39, 36, 'allow', NULL),
(39, 37, 'deny', NULL),
(39, 38, 'deny', NULL),
(39, 39, 'deny', NULL),
(39, 40, 'deny', NULL),
(39, 41, 'deny', NULL),
(39, 43, 'deny', NULL),
(39, 44, 'deny', NULL),
(39, 45, 'deny', NULL),
(39, 46, 'allow', NULL),
(39, 47, 'allow', NULL),
(39, 48, 'allow', NULL),
(39, 49, 'allow', NULL),
(39, 91, 'allow', NULL),
(39, 92, 'allow', NULL),
(39, 93, 'allow', NULL),
(39, 94, 'allow', NULL),
(39, 95, 'allow', NULL),
(46, 65, 'deny', NULL),
(46, 66, 'deny', NULL),
(46, 67, 'deny', NULL),
(46, 68, 'deny', NULL),
(46, 69, 'deny', NULL),
(46, 70, 'deny', NULL),
(46, 71, 'deny', NULL),
(46, 72, 'deny', NULL),
(46, 73, 'deny', NULL),
(46, 74, 'deny', NULL),
(46, 75, 'deny', NULL),
(46, 76, 'deny', NULL),
(46, 77, 'deny', NULL),
(46, 78, 'deny', NULL),
(46, 79, 'deny', NULL),
(46, 80, 'deny', NULL),
(46, 81, 'deny', NULL),
(46, 82, 'deny', NULL),
(46, 83, 'deny', NULL),
(46, 84, 'deny', NULL),
(46, 85, 'deny', NULL),
(46, 86, 'deny', NULL),
(46, 87, 'deny', NULL),
(48, 36, 'deny', NULL),
(48, 37, 'deny', NULL),
(48, 38, 'allow', NULL),
(48, 39, 'allow', NULL),
(48, 40, 'deny', NULL),
(48, 41, 'deny', NULL),
(48, 43, 'deny', NULL),
(48, 44, 'deny', NULL),
(48, 45, 'deny', NULL),
(48, 46, 'deny', NULL),
(48, 47, 'deny', NULL),
(48, 48, 'deny', NULL),
(48, 49, 'deny', NULL),
(49, 36, 'allow', NULL),
(49, 40, 'allow', NULL),
(49, 41, 'allow', NULL),
(50, 36, 'deny', NULL),
(50, 37, 'deny', NULL),
(50, 38, 'deny', NULL),
(50, 39, 'deny', NULL),
(50, 40, 'deny', NULL),
(50, 41, 'deny', NULL),
(50, 43, 'allow', NULL),
(50, 44, 'allow', NULL),
(50, 45, 'allow', NULL),
(50, 46, 'deny', NULL),
(50, 47, 'deny', NULL),
(50, 48, 'deny', NULL),
(50, 49, 'deny', NULL),
(51, 36, 'deny', NULL),
(51, 37, 'deny', NULL),
(51, 38, 'deny', NULL),
(51, 39, 'deny', NULL),
(51, 40, 'deny', NULL),
(51, 41, 'deny', NULL),
(51, 43, 'deny', NULL),
(51, 44, 'deny', NULL),
(51, 45, 'deny', NULL),
(51, 46, 'deny', NULL),
(51, 47, 'deny', NULL),
(51, 48, 'deny', NULL),
(51, 49, 'deny', NULL),
(54, 36, 'deny', NULL),
(54, 37, 'deny', NULL),
(54, 38, 'deny', NULL),
(54, 39, 'deny', NULL),
(54, 40, 'deny', NULL),
(54, 41, 'deny', NULL),
(54, 43, 'deny', NULL),
(54, 44, 'deny', NULL),
(54, 45, 'deny', NULL),
(54, 46, 'deny', NULL),
(54, 47, 'deny', NULL),
(54, 48, 'deny', NULL),
(54, 49, 'deny', NULL),
(56, 36, 'deny', NULL),
(56, 37, 'deny', NULL),
(56, 38, 'deny', NULL),
(56, 39, 'deny', NULL),
(56, 40, 'deny', NULL),
(56, 41, 'deny', NULL),
(56, 43, 'deny', NULL),
(56, 44, 'deny', NULL),
(56, 45, 'deny', NULL),
(56, 46, 'deny', NULL),
(56, 47, 'deny', NULL),
(56, 48, 'deny', NULL),
(56, 49, 'deny', NULL),
(56, 91, 'allow', NULL),
(56, 92, 'allow', NULL),
(56, 93, 'allow', NULL),
(56, 94, 'allow', NULL),
(56, 95, 'allow', NULL),
(57, 36, 'deny', NULL),
(57, 37, 'deny', NULL),
(57, 38, 'deny', NULL),
(57, 39, 'deny', NULL),
(57, 40, 'deny', NULL),
(57, 41, 'deny', NULL),
(57, 43, 'deny', NULL),
(57, 44, 'deny', NULL),
(57, 45, 'deny', NULL),
(57, 46, 'deny', NULL),
(57, 47, 'deny', NULL),
(57, 48, 'deny', NULL),
(57, 49, 'deny', NULL),
(64, 36, 'allow', NULL),
(64, 37, 'allow', NULL),
(64, 38, 'deny', NULL),
(64, 39, 'deny', NULL),
(64, 40, 'deny', NULL),
(64, 41, 'deny', NULL),
(64, 43, 'deny', NULL),
(64, 44, 'deny', NULL),
(64, 45, 'deny', NULL),
(64, 46, 'allow', NULL),
(64, 47, 'allow', NULL),
(64, 48, 'allow', NULL),
(64, 49, 'allow', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_autologin`
--

DROP TABLE IF EXISTS `auth_autologin`;
CREATE TABLE IF NOT EXISTS `auth_autologin` (
  `user` int(11) NOT NULL,
  `series` varchar(255) NOT NULL,
  `privatekey` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`user`,`series`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

DROP TABLE IF EXISTS `auth_users`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1705 ;

--
-- Dumping data for table `auth_users`
--

INSERT INTO `auth_users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `lang`, `registered`, `role_id`) VALUES
(1002, 'Diane', 'Murphy', 'dmurphy', 'dmurphy@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1056, 'Mary', 'Patterson', 'mpatterso', 'mpatterso@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1076, 'Jeff', 'Firrelli', 'jeff.firrelli', 'jeff.firrelli@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1088, 'William', 'Patterson', 'wpatterson', 'wpatterson@classicmodelcars.com', '', NULL, '2012-03-01 05:54:30', NULL),
(1102, 'Gerard', 'Bondur', 'gbondur', 'gbondur@classicmodelcars.com', '$2a$08$/9GPAwtVkFug2y5yBIhmPOZWSev.Myt.ruNENXo9DT4VrqTwNBE2K', 'en', '2012-03-01 05:54:30', 37),
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
(1703, 'Ardi', 'Soebrata', 'ardissoebrata', 'ardissoebrata@gmail.com', '$2a$08$wXpIw9/0YX1ChTi2jH2UvO.gPpM0qTIwlmLJQyqfWaydkd83G44sS', NULL, '2012-03-09 12:57:48', NULL),
(1704, 'Administrator', '', 'admin', 'admin@vmt.co.id', '$2a$08$dxSn4NG3GUxu3XGLr4niIuemUHBohdWdBobNsRi6WpBE.h8zHNmXO', 'id', '2012-03-15 19:23:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_master`
--

DROP TABLE IF EXISTS `auth_users_master`;
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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl_resources`
--
ALTER TABLE `acl_resources`
  ADD CONSTRAINT `acl_resources_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `acl_resources` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `acl_role_parents`
--
ALTER TABLE `acl_role_parents`
  ADD CONSTRAINT `acl_role_parents_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_role_parents_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `acl_rules`
--
ALTER TABLE `acl_rules`
  ADD CONSTRAINT `acl_rules_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `acl_resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_rules_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD CONSTRAINT `auth_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
