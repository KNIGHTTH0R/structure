-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2015 at 08:52 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE IF NOT EXISTS `access_level` (
  `access_level_id` int(2) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `level` int(2) DEFAULT NULL,
  PRIMARY KEY (`access_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`access_level_id`, `status`, `entered`, `updated`, `title`, `level`) VALUES
(1, '+', '2015-01-19 23:07:17', NULL, 'Super Admin', 3),
(2, '+', '2015-01-19 23:07:23', NULL, 'Admin', 2),
(3, '+', '2015-01-19 23:07:29', NULL, 'User', 1),
(4, '+', '2015-01-19 23:07:35', NULL, 'Guest', 0),
(5, '+', '2015-01-23 04:01:27', NULL, 'Portal Admin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `column`
--

CREATE TABLE IF NOT EXISTS `column` (
  `column_id` int(8) NOT NULL AUTO_INCREMENT,
  `framework_id` int(8) NOT NULL DEFAULT '0',
  `target` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`column_id`,`framework_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `column`
--

INSERT INTO `column` (`column_id`, `framework_id`, `target`) VALUES
(1, 1, 'column-1');

-- --------------------------------------------------------

--
-- Table structure for table `framework`
--

CREATE TABLE IF NOT EXISTS `framework` (
  `framework_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `file` varchar(45) DEFAULT NULL,
  `mockup` text,
  PRIMARY KEY (`framework_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `framework`
--

INSERT INTO `framework` (`framework_id`, `status`, `entered`, `updated`, `title`, `file`, `mockup`) VALUES
(1, '+', '2015-04-24 04:14:15', NULL, 'Standard', 'standard_fr', '[["12"]]');

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE IF NOT EXISTS `menu_item` (
  `menu_item_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `portal_id` int(8) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `view` varchar(45) DEFAULT NULL,
  `access_level` int(2) DEFAULT NULL,
  `section` char(2) DEFAULT NULL,
  `parent_id` int(8) DEFAULT NULL,
  `sequence` int(2) DEFAULT NULL,
  `icon` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`menu_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`menu_item_id`, `status`, `entered`, `updated`, `portal_id`, `title`, `view`, `access_level`, `section`, `parent_id`, `sequence`, `icon`) VALUES
(1, '+', '2015-01-17 12:00:00', '2015-04-25 05:27:34', -1, 'Dashboard', 'admin/dashboard', 0, 'ad', 0, 1, 'home'),
(2, '+', '2015-01-17 12:00:00', '2015-01-22 03:31:28', -1, 'Display Management', '', 0, 'ad', 0, 3, 'laptop'),
(3, '+', '2015-01-17 12:00:00', '2015-01-22 03:31:58', -1, 'Frameworks', 'admin/frameworks', 0, 'ad', 2, 3, 'building'),
(4, '+', '2015-01-17 12:00:00', '2015-04-25 03:45:49', -1, 'Objects', 'admin/objects', 0, 'ad', 2, 1, 'cube'),
(5, '+', '2015-01-17 12:00:00', '2015-02-01 04:39:13', -1, 'Templates', 'admin/templates', 0, 'ad', 2, 4, 'picture-o'),
(6, '+', '2015-01-17 12:00:00', '2015-01-22 03:32:35', -1, 'Widgets', 'admin/widgets', 0, 'ad', 2, 2, 'cubes'),
(7, '+', '2015-01-17 12:00:00', '2015-04-25 19:58:45', -1, 'CMS Management', '', 0, 'ad', 0, 4, 'lock'),
(8, '+', '2015-01-17 12:00:00', '2015-04-25 20:48:24', -1, 'Menu Items', 'admin/menu_items', 0, 'ad', 7, 3, 'list'),
(9, '+', '2015-01-17 12:00:00', '2015-01-22 03:29:07', -1, 'Admin Users', 'admin/admin_users', 0, 'ad', 7, 2, 'users'),
(10, '+', '2015-01-17 12:00:00', '2015-04-24 05:01:46', -1, 'Portal Management', '', 0, 'ad', 0, 2, 'globe'),
(12, '+', '2015-01-17 12:00:00', '2015-01-22 03:26:11', -1, 'Access Levels', 'admin/access_levels', 0, 'ad', 7, 1, 'key'),
(14, '+', NULL, NULL, -1, 'Settings', 'admin/settings', 0, 'ad', 7, 4, 'cogs'),
(19, '+', '2015-02-07 21:42:48', '2015-04-25 20:16:01', -1, 'Dashboard', 'portal/dashboard', 0, 'po', 0, 3, 'home'),
(20, '+', '2015-02-07 21:47:20', '2015-02-07 21:59:20', -1, 'Portal Admin', '', 0, 'po', 0, 5, 'lock'),
(22, '+', '2015-02-07 21:48:37', '2015-04-25 20:17:54', -1, 'Settings', 'portal/settings', 0, 'po', 20, 2, 'cogs'),
(23, '+', '2015-02-07 21:58:39', '2015-02-07 22:05:39', -1, 'Front-End', '', 0, 'po', 0, 4, 'database'),
(24, '+', '2015-02-07 22:07:35', '2015-04-25 20:18:03', -1, 'Menu Items', 'portal/menu_items/portal', 0, 'po', 23, NULL, 'list'),
(25, '+', '2015-02-07 22:13:48', NULL, -1, 'Home', '', 0, 'fr', 0, NULL, 'home'),
(26, '+', '2015-02-07 22:17:26', NULL, -1, 'News', '', 0, 'fr', 0, NULL, 'cog'),
(27, '+', '2015-04-24 04:47:58', '2015-04-25 19:35:44', -1, 'Pages', 'admin/pages/index', 0, 'ad', 2, 5, 'file'),
(34, '+', '2015-04-24 05:00:55', '2015-04-24 05:01:39', -1, 'List', 'admin/portal_list', 0, 'ad', 10, 1, 'list-ol'),
(35, '+', '2015-04-25 20:21:11', NULL, -1, 'Pages', 'portal/pages', 0, 'po', 23, 1, 'file-o');

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE IF NOT EXISTS `object` (
  `object_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `file` varchar(45) DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`object_id`, `status`, `entered`, `updated`, `title`, `file`, `params`) VALUES
(1, '+', '2015-04-25 04:39:15', NULL, 'Test WYSIWYG', 'test_wysiwyg_ob', '[{"type":"wysiwyg","label":"wysiwyg","field_name":"wysiwyg"}]');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `page_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `template_id` int(8) DEFAULT NULL,
  `portal_id` int(8) DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `view` varchar(45) DEFAULT NULL,
  `access_level` int(2) DEFAULT NULL,
  `section` char(2) DEFAULT NULL,
  `default_view` char(1) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `status`, `entered`, `updated`, `template_id`, `portal_id`, `title`, `view`, `access_level`, `section`, `default_view`) VALUES
(1, '+', NULL, NULL, 1, -1, 'Home', 'home_view', 0, NULL, 'y'),
(2, '+', NULL, NULL, 2, -1, 'Test', 'test_view', 0, NULL, 'n'),
(3, '+', '2015-04-25 19:10:22', '2015-04-25 19:38:09', 1, -1, 'Test 2', 'asdf', 0, NULL, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `portal`
--

CREATE TABLE IF NOT EXISTS `portal` (
  `portal_id` int(8) NOT NULL,
  `status` char(2) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`portal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portal`
--

INSERT INTO `portal` (`portal_id`, `status`, `entered`, `updated`, `name`) VALUES
(-1, '+', '2015-07-02 18:17:23', NULL, 'Default Portal');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `position_id` int(8) NOT NULL AUTO_INCREMENT,
  `framework_id` int(8) NOT NULL DEFAULT '0',
  `template_id` int(8) NOT NULL DEFAULT '0',
  `widget_id` int(8) NOT NULL DEFAULT '0',
  `column_id` int(8) NOT NULL DEFAULT '0',
  `sequence` int(2) DEFAULT NULL,
  PRIMARY KEY (`position_id`,`framework_id`,`template_id`,`widget_id`,`column_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `framework_id`, `template_id`, `widget_id`, `column_id`, `sequence`) VALUES
(1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `setting_id` int(1) NOT NULL,
  `site_title` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `site_title`) VALUES
(1, 'CMS2Go');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `template_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `framework_id` int(8) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`template_id`, `status`, `entered`, `updated`, `framework_id`, `title`) VALUES
(1, '+', '2015-04-24 04:14:27', NULL, 1, 'Test Template');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE IF NOT EXISTS `widget` (
  `widget_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `object_id` int(8) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `params` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`widget_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`widget_id`, `status`, `entered`, `updated`, `object_id`, `alias`, `params`) VALUES
(1, '+', '2015-04-25 04:39:38', '2015-04-25 04:42:04', 1, 'WYSIWYG Widget', '{"wysiwyg":"<p>test<\\/p>"}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
