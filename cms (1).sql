-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2015 at 02:01 AM
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

DROP TABLE IF EXISTS `access_level`;
CREATE TABLE IF NOT EXISTS `access_level` (
  `access_level_id` int(2) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `level` int(2) DEFAULT NULL,
  `admin_flg` char(1) DEFAULT NULL,
  PRIMARY KEY (`access_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Truncate table before insert `access_level`
--

TRUNCATE TABLE `access_level`;
--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`access_level_id`, `status`, `entered`, `updated`, `title`, `level`, `admin_flg`) VALUES
(2, '+', '2015-01-19 23:07:23', '2015-04-30 03:05:07', 'Admin', 3, 'y'),
(3, '+', '2015-01-19 23:07:29', NULL, 'User', 1, NULL),
(4, '+', '2015-01-19 23:07:35', NULL, 'Guest', 0, NULL),
(5, '+', '2015-01-23 04:01:27', '2015-04-30 03:05:11', 'Portal Admin', 2, 'y'),
(6, '+', '2015-04-30 05:29:28', NULL, 'Developer', 5, 'y'),
(7, '+', '2015-05-03 01:30:57', NULL, 'Super Admin', 4, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `admin_user_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) NOT NULL DEFAULT '+',
  `entered` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `access_level_id` int(8) NOT NULL,
  `site_owner_flg` char(1) DEFAULT NULL,
  PRIMARY KEY (`admin_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `admin_user`
--

TRUNCATE TABLE `admin_user`;
--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_user_id`, `status`, `entered`, `updated`, `first_name`, `last_name`, `email`, `username`, `password`, `access_level_id`, `site_owner_flg`) VALUES
(1, '+', '2015-04-30 03:42:32', '2015-04-30 04:04:34', 'John', 'Leider', 'john.j.leider@gmail.com', 'john.j.leider', '$2y$10$zUyW38LmgfsoMtK86rNDUushssT5OVteMthR6ErEdeCj8XVXQqF8e', -1, 'y'),
(2, '+', '2015-04-30 05:34:29', NULL, 'Cynthia', 'Burke', 'cynthia@furrylogic.net', 'cburke', '$2y$10$Dby6BWnRqU15T1Kv6MHXuubOHqXC9pB8FwcC2BSDukpxf5A/fcTfa', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `column`
--

DROP TABLE IF EXISTS `column`;
CREATE TABLE IF NOT EXISTS `column` (
  `column_id` int(8) NOT NULL AUTO_INCREMENT,
  `framework_id` int(8) NOT NULL DEFAULT '0',
  `target` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`column_id`,`framework_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `column`
--

TRUNCATE TABLE `column`;
--
-- Dumping data for table `column`
--

INSERT INTO `column` (`column_id`, `framework_id`, `target`) VALUES
(1, 1, 'column_1'),
(2, 1, 'column_2'),
(3, 1, 'column_3');

-- --------------------------------------------------------

--
-- Table structure for table `framework`
--

DROP TABLE IF EXISTS `framework`;
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
-- Truncate table before insert `framework`
--

TRUNCATE TABLE `framework`;
--
-- Dumping data for table `framework`
--

INSERT INTO `framework` (`framework_id`, `status`, `entered`, `updated`, `title`, `file`, `mockup`) VALUES
(1, '+', '2015-05-02 04:15:39', NULL, 'Home Page', 'home_page_fr', '[["8","4"],["12"]]');

-- --------------------------------------------------------

--
-- Table structure for table `fr_menu_item`
--

DROP TABLE IF EXISTS `fr_menu_item`;
CREATE TABLE IF NOT EXISTS `fr_menu_item` (
  `fr_menu_item_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `portal_id` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `access_level_id` int(2) DEFAULT NULL,
  `parent_id` int(8) DEFAULT NULL,
  `sequence` int(2) DEFAULT NULL,
  `icon` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`fr_menu_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `fr_menu_item`
--

TRUNCATE TABLE `fr_menu_item`;
--
-- Dumping data for table `fr_menu_item`
--

INSERT INTO `fr_menu_item` (`fr_menu_item_id`, `status`, `entered`, `updated`, `portal_id`, `title`, `alias`, `access_level_id`, `parent_id`, `sequence`, `icon`) VALUES
(1, '+', '2015-05-02 04:19:00', NULL, -1, 'Home', 'home', 4, 0, 1, 'home'),
(2, '+', '2015-05-02 04:20:06', NULL, -1, 'Feed Central', 'feeds', 4, 0, 2, 'rss'),
(3, '+', '2015-05-02 04:22:39', NULL, -1, 'Profile', 'profile', 4, 0, 3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `fr_menu_item_portal_xref`
--

DROP TABLE IF EXISTS `fr_menu_item_portal_xref`;
CREATE TABLE IF NOT EXISTS `fr_menu_item_portal_xref` (
  `fr_menu_item_id` int(8) NOT NULL,
  `portal_id` int(8) NOT NULL,
  `meta_data` text,
  `sequence` int(2) NOT NULL,
  PRIMARY KEY (`fr_menu_item_id`,`portal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `fr_menu_item_portal_xref`
--

TRUNCATE TABLE `fr_menu_item_portal_xref`;
--
-- Dumping data for table `fr_menu_item_portal_xref`
--

INSERT INTO `fr_menu_item_portal_xref` (`fr_menu_item_id`, `portal_id`, `meta_data`, `sequence`) VALUES
(1, 1, '{"status":"+","title":"Home","alias":"home","icon":"home","access_level_id":"4"}', 1),
(2, 1, '{"status":"+","title":"Feed Central","alias":"feeds","icon":"rss","access_level_id":"4"}', 2),
(3, 1, '{"status":"+","title":"Profile","alias":"profile","icon":"user","access_level_id":"4"}', 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

DROP TABLE IF EXISTS `menu_item`;
CREATE TABLE IF NOT EXISTS `menu_item` (
  `menu_item_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `portal_id` int(8) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `view` varchar(45) DEFAULT NULL,
  `access_level_id` int(2) DEFAULT NULL,
  `section` char(2) DEFAULT NULL,
  `parent_id` int(8) DEFAULT NULL,
  `sequence` int(2) DEFAULT NULL,
  `icon` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`menu_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Truncate table before insert `menu_item`
--

TRUNCATE TABLE `menu_item`;
--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`menu_item_id`, `status`, `entered`, `updated`, `portal_id`, `title`, `view`, `access_level_id`, `section`, `parent_id`, `sequence`, `icon`) VALUES
(1, '+', '2015-01-17 12:00:00', '2015-05-03 01:23:22', -1, 'Dashboard', 'admin/dashboard', 5, 'ad', 0, 1, 'home'),
(2, '+', '2015-01-17 12:00:00', '2015-05-03 01:27:57', -1, 'Portal Management', '', 5, 'ad', 0, 2, 'globe'),
(3, '+', '2015-01-17 12:00:00', '2015-05-03 01:29:13', -1, 'Display Management', '', 2, 'ad', 0, 3, 'laptop'),
(4, '+', '2015-01-17 12:00:00', '2015-05-03 01:51:07', -1, 'CMS Management', '', 7, 'ad', 0, 4, 'lock'),
(5, '+', '2015-04-24 05:00:55', '2015-05-03 01:28:07', -1, 'Portals', 'admin/portals', 5, 'ad', 2, 1, 'users'),
(6, '+', '2015-04-26 00:39:45', '2015-05-03 01:34:34', -1, 'Portal Menu', 'admin/menu_items?section=po', 6, 'ad', 4, 4, 'list-ol'),
(7, '+', '2015-01-17 12:00:00', '2015-05-03 01:29:27', -1, 'Objects', 'admin/objects', 6, 'ad', 3, 1, 'cube'),
(8, '+', '2015-01-17 12:00:00', '2015-05-03 01:29:43', -1, 'Widgets', 'admin/widgets', 2, 'ad', 3, 2, 'cubes'),
(9, '+', '2015-01-17 12:00:00', '2015-05-03 01:29:54', -1, 'Frameworks', 'admin/frameworks', 6, 'ad', 3, 3, 'building'),
(10, '+', '2015-01-17 12:00:00', '2015-05-03 01:30:07', -1, 'Templates', 'admin/templates', 2, 'ad', 3, 4, 'picture-o'),
(12, '+', '2015-04-26 03:01:13', '2015-05-03 01:29:01', -1, 'Defaults', 'admin/defaults', 2, 'ad', 2, 2, 'magic'),
(13, '+', '2015-01-17 12:00:00', '2015-05-03 01:31:32', -1, 'Access Levels', 'admin/access_levels', 7, 'ad', 4, 2, 'key'),
(14, '+', '2015-01-17 12:00:00', '2015-05-03 01:31:18', -1, 'Admin Users', 'admin/admin_users', 7, 'ad', 4, 1, 'user-secret'),
(15, '+', '2015-01-17 12:00:00', '2015-05-03 01:34:23', -1, 'Admin Menu', 'admin/menu_items?section=ad', 6, 'ad', 4, 3, 'list-ol'),
(16, '+', NULL, '2015-05-03 01:34:46', -1, 'Settings', 'admin/settings', 7, 'ad', 4, 5, 'cogs'),
(17, '+', '2015-02-07 21:42:48', '2015-05-03 01:51:19', -1, 'Dashboard', 'portal/dashboard', 5, 'po', 0, 3, 'home'),
(18, '+', '2015-02-07 21:58:39', '2015-05-03 01:51:30', -1, 'Front-End', '', 5, 'po', 0, 4, 'database'),
(19, '+', '2015-02-07 21:47:20', '2015-05-03 01:52:01', -1, 'Portal Admin', '', 5, 'po', 0, 5, 'lock'),
(20, '+', '2015-02-07 22:07:35', '2015-05-03 01:51:40', -1, 'Menu Items', 'portal/fr_menu_items', 5, 'po', 18, NULL, 'list-ol'),
(21, '+', '2015-04-25 20:21:11', '2015-05-03 01:51:52', -1, 'Pages', 'portal/pages', 5, 'po', 18, 1, 'file'),
(22, '+', '2015-02-07 21:48:37', '2015-05-03 01:52:36', -1, 'Profile', 'portal/profile', 5, 'po', 19, 2, 'cogs'),
(23, '+', '2015-05-01 02:54:52', '2015-05-03 01:52:10', NULL, 'Defaults', 'portal/defaults', 5, 'po', 19, 1, 'magic');

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

DROP TABLE IF EXISTS `object`;
CREATE TABLE IF NOT EXISTS `object` (
  `object_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `file` varchar(45) DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`object_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `object`
--

TRUNCATE TABLE `object`;
--
-- Dumping data for table `object`
--

INSERT INTO `object` (`object_id`, `status`, `entered`, `updated`, `title`, `file`, `params`) VALUES
(1, '+', '2015-05-02 04:11:38', '2015-05-02 04:13:15', 'WYSIWYG', 'wysiwyg_ob', '[{"type":"wysiwyg","label":"WYSIWYG","field_name":"wysiwyg"}]'),
(2, '+', '2015-05-02 04:12:38', NULL, 'RSS Feeds', 'rss_feeds_ob', '[{"type":"text","label":"Title","field_name":"title"},{"type":"text","label":"URL","field_name":"url"},{"type":"text","label":"# of Feeds","field_name":"count"}]');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `page_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `template_id` int(8) DEFAULT NULL,
  `portal_id` int(8) DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `access_level_id` int(2) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `page`
--

TRUNCATE TABLE `page`;
--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `status`, `entered`, `updated`, `template_id`, `portal_id`, `title`, `alias`, `access_level_id`) VALUES
(1, '+', '2015-05-02 04:16:52', '2015-05-02 05:27:10', 1, -1, 'Home Page', 'home', 4);

-- --------------------------------------------------------

--
-- Table structure for table `page_portal_xref`
--

DROP TABLE IF EXISTS `page_portal_xref`;
CREATE TABLE IF NOT EXISTS `page_portal_xref` (
  `page_id` int(8) NOT NULL,
  `portal_id` int(8) NOT NULL,
  `alias` varchar(45) NOT NULL,
  `meta_data` text NOT NULL,
  PRIMARY KEY (`page_id`,`portal_id`,`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `page_portal_xref`
--

TRUNCATE TABLE `page_portal_xref`;
--
-- Dumping data for table `page_portal_xref`
--

INSERT INTO `page_portal_xref` (`page_id`, `portal_id`, `alias`, `meta_data`) VALUES
(1, 1, 'home', '{"status":"+","title":"Home","template_id":"1","access_level_id":"4"}');

-- --------------------------------------------------------

--
-- Table structure for table `portal`
--

DROP TABLE IF EXISTS `portal`;
CREATE TABLE IF NOT EXISTS `portal` (
  `portal_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(2) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`portal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `portal`
--

TRUNCATE TABLE `portal`;
--
-- Dumping data for table `portal`
--

INSERT INTO `portal` (`portal_id`, `status`, `entered`, `updated`, `name`) VALUES
(1, '+', '2015-04-25 00:00:00', NULL, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
CREATE TABLE IF NOT EXISTS `position` (
  `position_id` int(8) NOT NULL AUTO_INCREMENT,
  `framework_id` int(8) NOT NULL DEFAULT '0',
  `template_id` int(8) NOT NULL DEFAULT '0',
  `widget_id` int(8) NOT NULL DEFAULT '0',
  `column_id` int(8) NOT NULL DEFAULT '0',
  `sequence` int(2) DEFAULT NULL,
  PRIMARY KEY (`position_id`,`framework_id`,`template_id`,`widget_id`,`column_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Truncate table before insert `position`
--

TRUNCATE TABLE `position`;
--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `framework_id`, `template_id`, `widget_id`, `column_id`, `sequence`) VALUES
(11, 1, 1, 1, 1, 1),
(12, 1, 1, 2, 2, 1),
(13, 1, 1, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `setting_id` int(1) NOT NULL,
  `site_title` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `setting`
--

TRUNCATE TABLE `setting`;
--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `site_title`) VALUES
(1, 'CMS2Go');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
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
-- Truncate table before insert `template`
--

TRUNCATE TABLE `template`;
--
-- Dumping data for table `template`
--

INSERT INTO `template` (`template_id`, `status`, `entered`, `updated`, `framework_id`, `title`) VALUES
(1, '+', '2015-05-02 04:16:14', '2015-05-02 05:14:34', 1, 'Home Page');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

DROP TABLE IF EXISTS `widget`;
CREATE TABLE IF NOT EXISTS `widget` (
  `widget_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `object_id` int(8) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`widget_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `widget`
--

TRUNCATE TABLE `widget`;
--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`widget_id`, `status`, `entered`, `updated`, `object_id`, `alias`, `params`) VALUES
(1, '+', '2015-05-02 04:13:56', NULL, 1, 'Home Intro', '{"wysiwyg":"<p>Cras sagittis. Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Fusce risus nisl, viverra et, tempor et, pretium in, sapien.<\\/p><p><br><\\/p><p>Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. In ac felis quis tortor malesuada pretium. Fusce pharetra convallis urna. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Quisque ut nisi.<\\/p><p><br><\\/p><p>Cras risus ipsum, faucibus ut, ullamcorper id, varius ac, leo. Phasellus dolor. Ut tincidunt tincidunt erat. Etiam feugiat lorem non metus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.<\\/p><p><br><\\/p><p>Nam adipiscing. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Donec vitae sapien ut libero venenatis faucibus. Praesent egestas tristique nibh. Nullam cursus lacinia erat.<\\/p><p><br><\\/p><p>Suspendisse potenti. Vivamus euismod mauris. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Praesent venenatis metus at tortor pulvinar varius.<\\/p>"}'),
(2, '+', '2015-05-02 04:14:26', '2015-05-02 05:14:39', 2, 'League of Legends RSS', '{"title":"League of Legends","url":"http:\\/\\/www.reddit.com\\/r\\/leagueoflegends\\/.rss","count":"10"}'),
(3, '+', '2015-05-02 04:14:55', NULL, 2, 'Heroes of the Storm RSS', '{"title":"Heroes of the Storm","url":"http:\\/\\/www.reddit.com\\/r\\/heroesofthestorm\\/.rss","count":"3"}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
