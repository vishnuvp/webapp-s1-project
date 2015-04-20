-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_m140163cs
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `bid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `author` varchar(256) NOT NULL,
  `publisher` varchar(256) NOT NULL,
  `edition` varchar(64) NOT NULL,
  `subject` varchar(256) NOT NULL,
  `rack_no` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `comments` varchar(1024) NOT NULL,
  PRIMARY KEY (`bid`),
  UNIQUE KEY `bid` (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (89,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.3','Computer Science',''),(90,'Compilers','Alfred V Aho','MIT Press','4','Compiler','002.4','Computer Science',''),(91,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.3','Computer Science',''),(92,'Compilers','Alfred V Aho','MIT Press','4','Compiler','002.4','Computer Science',''),(93,'Computer Architecture: A Quantitative Approach','Hennesy, Patterson','MIT Press','3','Computer Architecture','002.5','Computer Science',''),(94,'Data Communication','William Stallings','','','Networks','002.6','Computer Science',''),(95,'Microprocessors','Bhurchandi','','','Computer Architecture','002.7','Computer Science',''),(96,'Opearting Systems','Abraham Shilbershatz','','','Operating Systems','002.8','Computer Science',''),(97,'Computer Networks','William Stallings','','','Networks','002.9','Computer Science',''),(98,'Theory of Computations','Aho, Ullman','MIT Press','','Theory of computations','002.10','Computer Science',''),(99,'Introduction to Algorithms','CLRS','MIT Press','4','Algorithms','002.3','Computer Science',''),(100,'Compilers','Alfred V Aho','MIT Press','4','Compiler','002.4','Computer Science',''),(101,'Computer Architecture: A Quantitative Approach','Hennesy, Patterson','MIT Press','5','Computer Architecture','002.5','Computer Science',''),(102,'Data Communication','William Stallings','','','Networks','002.6','Computer Science',''),(103,'Microprocessors','Bhurchandi','','','Computer Architecture','002.7','Computer Science',''),(104,'Opearting Systems','Abraham Shilbershatz','','','Operating Systems','002.8','Computer Science',''),(105,'Computer Networks','William Stallings','','','Networks','002.9','Computer Science',''),(106,'Theory of Computations','Aho, Ullman','MIT Press','','Theory of computations','002.10','Computer Science',''),(107,'Introduction to Algorithms','CLRS','MIT Press','4','Algorithms','002.3','Computer Science',''),(108,'Compilers','Alfred V Aho','MIT Press','4','Compiler','002.4','Computer Science',''),(109,'Computer Architecture: A Quantitative Approach','Hennesy, Patterson','MIT Press','5','Computer Architecture','002.5','Computer Science',''),(111,'Microprocessors','Bhurchandi','','','Computer Architecture','002.7','Computer Science',''),(113,'Computer Networks','William Stallings','','','Networks','002.9','Computer Science',''),(114,'Theory of Computations','Aho, Ullman','MIT Press','','Theory of computations','002.10','Computer Science',''),(115,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science',''),(116,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science',''),(117,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science',''),(118,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science',''),(119,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science','');
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_status`
--

DROP TABLE IF EXISTS `book_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_status` (
  `bid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL COMMENT '0 - unavailable, 1 - on shelf, 2 - on loan, 3 - on shelf reserved, 4 - on loan reserved',
  PRIMARY KEY (`bid`),
  UNIQUE KEY `bid` (`bid`),
  CONSTRAINT `bookid_ref` FOREIGN KEY (`bid`) REFERENCES `book` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_status`
--

LOCK TABLES `book_status` WRITE;
/*!40000 ALTER TABLE `book_status` DISABLE KEYS */;
INSERT INTO `book_status` VALUES (89,1),(90,2),(91,1),(92,1),(93,3),(94,3),(95,1),(96,1),(97,1),(98,1),(99,1),(100,1),(101,1),(102,1),(103,1),(104,1),(105,1),(106,1),(107,1),(108,1),(109,1),(111,1),(113,1),(114,1),(115,3),(116,3),(117,1),(118,1),(119,3);
/*!40000 ALTER TABLE `book_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue`
--

DROP TABLE IF EXISTS `issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue` (
  `issue_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bid` bigint(20) unsigned NOT NULL,
  `uid` varchar(15) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date NOT NULL,
  PRIMARY KEY (`issue_id`),
  KEY `issue_uid_ref` (`uid`),
  KEY `issue_bid_ref` (`bid`),
  CONSTRAINT `issue_bid_ref` FOREIGN KEY (`bid`) REFERENCES `book` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `issue_uid_ref` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue`
--

LOCK TABLES `issue` WRITE;
/*!40000 ALTER TABLE `issue` DISABLE KEYS */;
INSERT INTO `issue` VALUES (1,89,'M140400CS','2014-09-01','2014-10-01'),(2,90,'M140400CS','2014-10-04','2014-11-03');
/*!40000 ALTER TABLE `issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_archive`
--

DROP TABLE IF EXISTS `issue_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_archive` (
  `issue_id` bigint(20) NOT NULL,
  `bid` bigint(20) unsigned NOT NULL,
  `uid` varchar(15) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date NOT NULL,
  PRIMARY KEY (`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue_archive`
--

LOCK TABLES `issue_archive` WRITE;
/*!40000 ALTER TABLE `issue_archive` DISABLE KEYS */;
INSERT INTO `issue_archive` VALUES (6,89,'M140163CS','2014-10-03','2014-11-02'),(7,93,'M140163CS','2014-10-03','2014-11-02'),(8,90,'M140163CS','2014-10-03','2014-11-02'),(9,94,'M140163CS','2014-10-03','2014-11-02');
/*!40000 ALTER TABLE `issue_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `nid` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `msg` varchar(4096) NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserve`
--

DROP TABLE IF EXISTS `reserve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserve` (
  `reserve_id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` bigint(20) unsigned NOT NULL,
  `uid` varchar(15) NOT NULL,
  `reserve_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`reserve_id`),
  UNIQUE KEY `bid` (`bid`),
  KEY `reserve_uid_ref` (`uid`),
  CONSTRAINT `reserve_bid_ref` FOREIGN KEY (`bid`) REFERENCES `book` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reserve_uid_ref` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserve`
--

LOCK TABLES `reserve` WRITE;
/*!40000 ALTER TABLE `reserve` DISABLE KEYS */;
INSERT INTO `reserve` VALUES (11,119,'M140400CS','2014-10-04','2014-10-11'),(12,115,'M140400CS','2014-10-05','2014-10-12');
/*!40000 ALTER TABLE `reserve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserve_archive`
--

DROP TABLE IF EXISTS `reserve_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserve_archive` (
  `reserve_id` int(11) NOT NULL,
  `bid` bigint(20) unsigned NOT NULL,
  `uid` varchar(15) NOT NULL,
  `reserve_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`reserve_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserve_archive`
--

LOCK TABLES `reserve_archive` WRITE;
/*!40000 ALTER TABLE `reserve_archive` DISABLE KEYS */;
INSERT INTO `reserve_archive` VALUES (4,89,'M140400CS','2014-10-03','0000-00-00'),(5,93,'M140400CS','2014-10-03','0000-00-00'),(6,90,'M140400CS','2014-10-03','0000-00-00'),(7,94,'M140400CS','2014-10-03','0000-00-00'),(10,116,'M140400CS','2014-10-04','0000-00-00'),(13,89,'M140400CS','2014-10-03','0000-00-00'),(14,93,'M140400CS','2014-10-03','0000-00-00'),(15,90,'M140400CS','2014-10-03','0000-00-00'),(24,89,'M140400CS','2014-10-03','0000-00-00'),(25,93,'M140400CS','2014-10-03','0000-00-00'),(26,90,'M140400CS','2014-10-03','0000-00-00'),(27,94,'M140400CS','2014-10-03','0000-00-00'),(28,116,'M140400CS','2014-10-04','0000-00-00'),(29,89,'M140400CS','2014-10-03','0000-00-00');
/*!40000 ALTER TABLE `reserve_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return`
--

DROP TABLE IF EXISTS `return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` bigint(20) unsigned NOT NULL,
  `uid` varchar(15) NOT NULL,
  `return_date` date NOT NULL,
  `fine` int(11) NOT NULL,
  PRIMARY KEY (`return_id`),
  KEY `return_uid_ref` (`uid`),
  KEY `bid` (`bid`),
  CONSTRAINT `return_bid_ref` FOREIGN KEY (`bid`) REFERENCES `book` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `return_uid_ref` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return`
--

LOCK TABLES `return` WRITE;
/*!40000 ALTER TABLE `return` DISABLE KEYS */;
INSERT INTO `return` VALUES (9,89,'M140163CS','2014-10-03',24),(10,93,'M140163CS','2014-10-03',0),(11,90,'M140163CS','2014-10-03',0),(12,94,'M140163CS','2014-10-03',0);
/*!40000 ALTER TABLE `return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` varchar(15) NOT NULL COMMENT 'User ID of user',
  `name` varchar(64) NOT NULL COMMENT 'Name of user',
  `password` varchar(256) NOT NULL COMMENT 'Hashed password',
  `email` varchar(256) DEFAULT NULL,
  `phoneno` varchar(15) DEFAULT NULL,
  `type` varchar(16) NOT NULL COMMENT 'Admin, Faculty or Student',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin','OLM Admin','c657540d5b315892f950ff30e1394480','vishnuvp@ymail.com','7736522808','Admin'),('E940001CS','Vineeth Paleri','ee41a016463824be2f9aed52eaf13586','vineeth_e940001cs@nitc.ac.in','9988776655','Faculty'),('M140143CS','Rakesh','7ea063814753df0319f230d98b71a6de','rakesh_m140143cs@nitc.ac.in','9098764321','Student'),('M140153CS','Arun','304f802f3480fdc11b6719a71f4e297e','arun_m140123cs@nitc.ac.in','2345678011','Student'),('M140163CS','Vishnu V P','5af0c9c25c98e4262ef5b98dc97d181a','vishnu_m140163cs@nitc.ac.in','7736522808','Student'),('M140400CS','Denny','4df28e702cf6c2c8fb46475e6cdef085','denny_m140400cs@nitc.ac.in','2313141678','Student');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-05 13:44:07
