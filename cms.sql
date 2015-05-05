CREATE DATABASE  IF NOT EXISTS `structure` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `structure`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: cms
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `access_level`
--

DROP TABLE IF EXISTS `access_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_level` (
  `access_level_id` int(2) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `level` int(2) DEFAULT NULL,
  `admin_flg` char(1) DEFAULT NULL,
  PRIMARY KEY (`access_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_level`
--

LOCK TABLES `access_level` WRITE;
/*!40000 ALTER TABLE `access_level` DISABLE KEYS */;
INSERT INTO `access_level` VALUES (2,'+','2015-01-19 23:07:23','2015-04-30 03:05:07','Admin',3,'y'),(3,'+','2015-01-19 23:07:29',NULL,'User',1,NULL),(4,'+','2015-01-19 23:07:35',NULL,'Guest',0,NULL),(5,'+','2015-01-23 04:01:27','2015-04-30 03:05:11','Portal Admin',2,'y'),(6,'+','2015-04-30 05:29:28',NULL,'Developer',5,'y'),(7,'+','2015-05-03 01:30:57',NULL,'Super Admin',4,'y');
/*!40000 ALTER TABLE `access_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
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
  PRIMARY KEY (`admin_user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` VALUES (1,'+','2015-04-30 03:42:32','2015-04-30 04:04:34','John','Leider','john.j.leider@gmail.com','john.j.leider','$2y$10$zUyW38LmgfsoMtK86rNDUushssT5OVteMthR6ErEdeCj8XVXQqF8e',-1,'y'),(2,'+','2015-04-30 05:34:29',NULL,'Cynthia','Burke','cynthia@furrylogic.net','cburke','$2y$10$Dby6BWnRqU15T1Kv6MHXuubOHqXC9pB8FwcC2BSDukpxf5A/fcTfa',6,NULL),(3,'+','2015-05-04 11:56:19',NULL,'Test','Portal Admin','admin@admin.com','testportal','$2y$10$Qrb5ZMw8qdVfLutArnc.wOhnN86/LwL1Xd9SXIEFalflv1lgUkEdy',5,NULL);
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `column`
--

DROP TABLE IF EXISTS `column`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `column` (
  `column_id` int(8) NOT NULL AUTO_INCREMENT,
  `framework_id` int(8) NOT NULL DEFAULT '0',
  `target` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`column_id`,`framework_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `column`
--

LOCK TABLES `column` WRITE;
/*!40000 ALTER TABLE `column` DISABLE KEYS */;
INSERT INTO `column` VALUES (1,1,'column_1'),(2,1,'column_2'),(3,1,'column_3');
/*!40000 ALTER TABLE `column` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_menu_item`
--

DROP TABLE IF EXISTS `fr_menu_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_menu_item` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_menu_item`
--

LOCK TABLES `fr_menu_item` WRITE;
/*!40000 ALTER TABLE `fr_menu_item` DISABLE KEYS */;
INSERT INTO `fr_menu_item` VALUES (1,'+','2015-05-02 04:19:00',NULL,-1,'Home','home',4,0,1,'home'),(2,'+','2015-05-02 04:20:06','2015-05-04 00:08:49',-1,'Feed Central','feeds',3,0,2,'rss'),(3,'+','2015-05-02 04:22:39',NULL,-1,'Profile','profile',4,0,3,'user'),(4,'+','2015-05-05 04:03:03',NULL,1,'Test Portal 1','test',3,0,4,'globe');
/*!40000 ALTER TABLE `fr_menu_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_menu_item_portal_xref`
--

DROP TABLE IF EXISTS `fr_menu_item_portal_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_menu_item_portal_xref` (
  `fr_menu_item_id` int(8) NOT NULL,
  `portal_id` int(8) NOT NULL,
  `meta_data` text,
  `sequence` int(2) NOT NULL,
  PRIMARY KEY (`fr_menu_item_id`,`portal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_menu_item_portal_xref`
--

LOCK TABLES `fr_menu_item_portal_xref` WRITE;
/*!40000 ALTER TABLE `fr_menu_item_portal_xref` DISABLE KEYS */;
INSERT INTO `fr_menu_item_portal_xref` VALUES (1,1,'{\"status\":\"+\",\"title\":\"Home\",\"alias\":\"home\",\"icon\":\"home\",\"access_level_id\":\"4\"}',1),(1,3,'{\"status\":\"+\",\"title\":\"Home\",\"alias\":\"home\",\"icon\":\"home\",\"access_level_id\":\"4\"}',1),(2,1,'{\"status\":\"+\",\"title\":\"Feed Central\",\"alias\":\"feeds\",\"icon\":\"rss\",\"access_level_id\":\"4\"}',2),(2,3,'{\"status\":\"+\",\"title\":\"Feed Central\",\"alias\":\"feeds\",\"icon\":\"rss\",\"access_level_id\":\"3\"}',2),(3,1,'{\"status\":\"+\",\"title\":\"Profile\",\"alias\":\"profile\",\"icon\":\"user\",\"access_level_id\":\"4\"}',3),(3,3,'{\"status\":\"+\",\"title\":\"Profile\",\"alias\":\"profile\",\"icon\":\"user\",\"access_level_id\":\"4\"}',3);
/*!40000 ALTER TABLE `fr_menu_item_portal_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `framework`
--

DROP TABLE IF EXISTS `framework`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `framework` (
  `framework_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `file` varchar(45) DEFAULT NULL,
  `mockup` text,
  PRIMARY KEY (`framework_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `framework`
--

LOCK TABLES `framework` WRITE;
/*!40000 ALTER TABLE `framework` DISABLE KEYS */;
INSERT INTO `framework` VALUES (1,'+','2015-05-02 04:15:39',NULL,'Home Page','home_page_fr','[[\"8\",\"4\"],[\"12\"]]'),(2,'+','2015-05-03 02:48:15',NULL,'404','404_fr','[[\"12*\"]]');
/*!40000 ALTER TABLE `framework` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_item`
--

DROP TABLE IF EXISTS `menu_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_item` (
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_item`
--

LOCK TABLES `menu_item` WRITE;
/*!40000 ALTER TABLE `menu_item` DISABLE KEYS */;
INSERT INTO `menu_item` VALUES (1,'+','2015-01-17 12:00:00','2015-05-03 01:23:22',-1,'Dashboard','admin/dashboard',5,'ad',0,1,'home'),(2,'+','2015-01-17 12:00:00','2015-05-03 01:27:57',-1,'Portal Management','',5,'ad',0,2,'globe'),(3,'+','2015-01-17 12:00:00','2015-05-03 01:29:13',-1,'Display Management','',2,'ad',0,3,'laptop'),(4,'+','2015-01-17 12:00:00','2015-05-03 01:51:07',-1,'CMS Management','',7,'ad',0,4,'lock'),(5,'+','2015-04-24 05:00:55','2015-05-03 01:28:07',-1,'Portals','admin/portals',5,'ad',2,1,'users'),(6,'+','2015-04-26 00:39:45','2015-05-03 01:34:34',-1,'Portal Menu','admin/menu_items?section=po',6,'ad',4,4,'list-ol'),(7,'+','2015-01-17 12:00:00','2015-05-03 01:29:27',-1,'Objects','admin/objects',6,'ad',3,1,'cube'),(8,'+','2015-01-17 12:00:00','2015-05-03 01:29:43',-1,'Widgets','admin/widgets',2,'ad',3,2,'cubes'),(9,'+','2015-01-17 12:00:00','2015-05-03 01:29:54',-1,'Frameworks','admin/frameworks',6,'ad',3,3,'building'),(10,'+','2015-01-17 12:00:00','2015-05-03 01:30:07',-1,'Templates','admin/templates',2,'ad',3,4,'picture-o'),(12,'+','2015-04-26 03:01:13','2015-05-03 01:29:01',-1,'Defaults','admin/defaults',2,'ad',2,2,'magic'),(13,'+','2015-01-17 12:00:00','2015-05-04 11:27:18',-1,'Access Levels','admin/access_levels',6,'ad',4,2,'key'),(14,'+','2015-01-17 12:00:00','2015-05-03 01:31:18',-1,'Admin Users','admin/admin_users',7,'ad',4,1,'user-secret'),(15,'+','2015-01-17 12:00:00','2015-05-03 01:34:23',-1,'Admin Menu','admin/menu_items?section=ad',6,'ad',4,3,'list-ol'),(16,'+',NULL,'2015-05-03 01:34:46',-1,'Settings','admin/settings',7,'ad',4,5,'cogs'),(17,'+','2015-02-07 21:42:48','2015-05-03 01:51:19',-1,'Dashboard','portal/dashboard',5,'po',0,3,'home'),(18,'+','2015-02-07 21:58:39','2015-05-03 01:51:30',-1,'Front-End','',5,'po',0,4,'database'),(19,'+','2015-02-07 21:47:20','2015-05-03 01:52:01',-1,'Portal Admin','',5,'po',0,5,'lock'),(20,'+','2015-02-07 22:07:35','2015-05-03 01:51:40',-1,'Menu Items','portal/fr_menu_items',5,'po',18,NULL,'list-ol'),(21,'+','2015-04-25 20:21:11','2015-05-03 01:51:52',-1,'Pages','portal/pages',5,'po',18,1,'file'),(22,'+','2015-02-07 21:48:37','2015-05-03 01:52:36',-1,'Profile','portal/profile',5,'po',19,2,'cogs'),(23,'+','2015-05-01 02:54:52','2015-05-03 01:52:10',NULL,'Defaults','portal/defaults',5,'po',19,1,'magic'),(24,'+','2015-05-05 03:17:58',NULL,NULL,'Users','portal/users',5,'po',19,3,'users');
/*!40000 ALTER TABLE `menu_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object`
--

DROP TABLE IF EXISTS `object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object` (
  `object_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `file` varchar(45) DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`object_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object`
--

LOCK TABLES `object` WRITE;
/*!40000 ALTER TABLE `object` DISABLE KEYS */;
INSERT INTO `object` VALUES (1,'+','2015-05-02 04:11:38','2015-05-02 04:13:15','WYSIWYG','wysiwyg_ob','[{\"type\":\"wysiwyg\",\"label\":\"WYSIWYG\",\"field_name\":\"wysiwyg\"}]'),(2,'+','2015-05-02 04:12:38',NULL,'RSS Feeds','rss_feeds_ob','[{\"type\":\"text\",\"label\":\"Title\",\"field_name\":\"title\"},{\"type\":\"text\",\"label\":\"URL\",\"field_name\":\"url\"},{\"type\":\"text\",\"label\":\"# of Feeds\",\"field_name\":\"count\"}]');
/*!40000 ALTER TABLE `object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,'+','2015-05-02 04:16:52','2015-05-03 23:27:49',1,-1,'Home Page','home',4),(3,'+','2015-05-03 02:57:31',NULL,3,-1,'404','404',4),(4,'+','2015-05-03 23:29:04',NULL,4,-1,'Feeds','feeds',3);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_portal_xref`
--

DROP TABLE IF EXISTS `page_portal_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_portal_xref` (
  `page_id` int(8) NOT NULL,
  `portal_id` int(8) NOT NULL,
  `alias` varchar(45) NOT NULL,
  `meta_data` text NOT NULL,
  PRIMARY KEY (`page_id`,`portal_id`,`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_portal_xref`
--

LOCK TABLES `page_portal_xref` WRITE;
/*!40000 ALTER TABLE `page_portal_xref` DISABLE KEYS */;
INSERT INTO `page_portal_xref` VALUES (1,1,'home','{\"status\":\"+\",\"title\":\"Home\",\"template_id\":\"1\",\"access_level_id\":\"4\"}'),(1,3,'home','{\"status\":\"+\",\"title\":\"Home Page\",\"template_id\":\"1\",\"access_level_id\":\"4\"}'),(3,1,'404','{\"status\":\"+\",\"title\":\"404\",\"template_id\":\"3\",\"access_level_id\":\"4\"}'),(3,3,'404','{\"status\":\"+\",\"title\":\"404\",\"template_id\":\"3\",\"access_level_id\":\"4\"}'),(4,1,'feeds','{\"status\":\"+\",\"title\":\"Feeds\",\"template_id\":\"4\",\"access_level_id\":\"3\"}'),(4,3,'feeds','{\"status\":\"+\",\"title\":\"Feeds\",\"template_id\":\"4\",\"access_level_id\":\"3\"}');
/*!40000 ALTER TABLE `page_portal_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portal`
--

DROP TABLE IF EXISTS `portal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portal` (
  `portal_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(2) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`portal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portal`
--

LOCK TABLES `portal` WRITE;
/*!40000 ALTER TABLE `portal` DISABLE KEYS */;
INSERT INTO `portal` VALUES (1,'+','2015-04-25 00:00:00',NULL,'Test'),(2,'+','2015-05-05 03:53:47',NULL,'Test 2'),(3,'+','2015-05-05 04:14:30',NULL,'Test 3');
/*!40000 ALTER TABLE `portal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position` (
  `position_id` int(8) NOT NULL AUTO_INCREMENT,
  `framework_id` int(8) NOT NULL DEFAULT '0',
  `template_id` int(8) NOT NULL DEFAULT '0',
  `widget_id` int(8) NOT NULL DEFAULT '0',
  `column_id` int(8) NOT NULL DEFAULT '0',
  `sequence` int(2) DEFAULT NULL,
  PRIMARY KEY (`position_id`,`framework_id`,`template_id`,`widget_id`,`column_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (18,1,4,3,1,1),(19,1,4,2,2,1),(20,1,4,1,3,1),(21,1,1,1,1,1),(22,1,1,3,2,1),(23,1,1,1,3,1);
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `setting_id` int(1) NOT NULL,
  `site_title` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'Structure CMS');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `template` (
  `template_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT NULL,
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `framework_id` int(8) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template`
--

LOCK TABLES `template` WRITE;
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
INSERT INTO `template` VALUES (1,'+','2015-05-02 04:16:14','2015-05-05 03:12:40',1,'Home Page'),(3,'+','2015-05-03 02:57:08',NULL,2,'404'),(4,'+','2015-05-03 23:28:30',NULL,1,'Feeds');
/*!40000 ALTER TABLE `template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) NOT NULL DEFAULT '+',
  `entered` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `access_level_id` int(8) NOT NULL,
  `portal_id` int(8) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'+','2015-05-05 03:29:59','2015-05-05 04:00:21','Test','User','test@test.com','asdf','$2y$10$lpOfuzPb..XKX1NuvMAfgOYiNjJTTIJDGgjjXSUH/fII.vCM2AE4.',3,1),(2,'+','2015-05-05 04:02:38',NULL,'Test','User 2','asdf@asdf.com','asdfasdf','$2y$10$z41b09kwXaUqtfnuyz5wk.gPrZfpR57jXdJgYATjcXfpj9elA1O82',3,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget`
--

DROP TABLE IF EXISTS `widget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widget` (
  `widget_id` int(8) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '+',
  `entered` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `object_id` int(8) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`widget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget`
--

LOCK TABLES `widget` WRITE;
/*!40000 ALTER TABLE `widget` DISABLE KEYS */;
INSERT INTO `widget` VALUES (1,'+','2015-05-02 04:13:56',NULL,1,'Home Intro','{\"wysiwyg\":\"<p>Cras sagittis. Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Fusce risus nisl, viverra et, tempor et, pretium in, sapien.<\\/p><p><br><\\/p><p>Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. In ac felis quis tortor malesuada pretium. Fusce pharetra convallis urna. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Quisque ut nisi.<\\/p><p><br><\\/p><p>Cras risus ipsum, faucibus ut, ullamcorper id, varius ac, leo. Phasellus dolor. Ut tincidunt tincidunt erat. Etiam feugiat lorem non metus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.<\\/p><p><br><\\/p><p>Nam adipiscing. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Donec vitae sapien ut libero venenatis faucibus. Praesent egestas tristique nibh. Nullam cursus lacinia erat.<\\/p><p><br><\\/p><p>Suspendisse potenti. Vivamus euismod mauris. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Praesent venenatis metus at tortor pulvinar varius.<\\/p>\"}'),(2,'+','2015-05-02 04:14:26','2015-05-02 05:14:39',2,'League of Legends RSS','{\"title\":\"League of Legends\",\"url\":\"http:\\/\\/www.reddit.com\\/r\\/leagueoflegends\\/.rss\",\"count\":\"10\"}'),(3,'+','2015-05-02 04:14:55',NULL,2,'Heroes of the Storm RSS','{\"title\":\"Heroes of the Storm\",\"url\":\"http:\\/\\/www.reddit.com\\/r\\/heroesofthestorm\\/.rss\",\"count\":\"3\"}');
/*!40000 ALTER TABLE `widget` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-04 22:18:38
