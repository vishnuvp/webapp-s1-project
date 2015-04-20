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
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (89,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.3','Computer Science',''),(90,'Compilers','Alfred V Aho','MIT Press','4','Compiler','002.4','Computer Science',''),(91,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.3','Computer Science',''),(92,'Compilers','Alfred V Aho','MIT Press','4','Compiler','002.4','Computer Science',''),(93,'Computer Architecture: A Quantitative Approach','Hennesy, Patterson','MIT Press','3','Computer Architecture','002.5','Computer Science',''),(94,'Data Communication','William Stallings','','','Networks','002.6','Computer Science',''),(95,'Microprocessors','Bhurchandi','','','Computer Architecture','002.7','Computer Science',''),(96,'Opearting Systems','Abraham Shilbershatz','','','Operating Systems','002.8','Computer Science',''),(97,'Computer Networks','William Stallings','','','Networks','002.9','Computer Science',''),(98,'Theory of Computations','Aho, Ullman','MIT Press','','Theory of computations','002.10','Computer Science',''),(99,'Introduction to Algorithms','CLRS','MIT Press','4','Algorithms','002.3','Computer Science',''),(100,'Compilers','Alfred V Aho','MIT Press','4','Compiler','002.4','Computer Science',''),(101,'Computer Architecture: A Quantitative Approach','Hennesy, Patterson','MIT Press','5','Computer Architecture','002.5','Computer Science',''),(102,'Data Communication','William Stallings','','','Networks','002.6','Computer Science',''),(103,'Microprocessors','Bhurchandi','','','Computer Architecture','002.7','Computer Science',''),(104,'Opearting Systems','Abraham Shilbershatz','','','Operating Systems','002.8','Computer Science',''),(105,'Computer Networks','William Stallings','','','Networks','002.9','Computer Science',''),(106,'Theory of Computations','Aho, Ullman','MIT Press','','Theory of computations','002.10','Computer Science',''),(107,'Introduction to Algorithms','CLRS','MIT Press','4','Algorithms','002.3','Computer Science',''),(108,'Compilers','Alfred V Aho','MIT Press','4','Compiler','002.4','Computer Science',''),(109,'Computer Architecture: A Quantitative Approach','Hennesy, Patterson','MIT Press','5','Computer Architecture','002.5','Computer Science',''),(111,'Microprocessors','Bhurchandi','','','Computer Architecture','002.7','Computer Science',''),(113,'Computer Networks','William Stallings','','','Networks','002.9','Computer Science',''),(114,'Theory of Computations','Aho, Ullman','MIT Press','','Theory of computations','002.10','Computer Science',''),(115,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science',''),(116,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science',''),(117,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science',''),(118,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science',''),(119,'Introduction to Algorithms','CLRS','MIT Press','3','Algorithms','002.39','Computer Science',''),(121,'Computer Networks','Tanenbaum','','4','Networks','004.34','Computer Science',''),(122,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(123,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(124,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(125,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(126,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(127,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(128,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(129,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(130,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(131,'Programming in C','Balaguruswamy','','5','C Programming','004.56','Programming',''),(132,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(133,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(134,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(135,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(136,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(137,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(138,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(139,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(140,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(141,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(142,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(143,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(144,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(145,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(146,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(147,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(148,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(149,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(150,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(151,'Programming in C','Balaguruswamy','','7','C Programming','009.123','Programming',''),(152,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(153,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(154,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(155,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(156,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(157,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(158,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(159,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(160,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(161,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(162,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(163,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(164,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(165,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(166,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(167,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(168,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(169,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(170,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(171,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(172,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(173,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(174,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(175,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(176,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(177,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(178,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(179,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(180,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(181,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(182,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(183,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(184,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(185,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(186,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(187,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(188,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(189,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(190,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(191,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(192,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(193,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(194,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(195,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(196,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(197,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(198,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(199,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(200,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(201,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(202,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(203,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(204,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(205,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(206,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(207,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(208,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(209,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(210,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(211,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(212,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(213,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(214,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(215,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(216,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(217,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(218,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(219,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(220,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming',''),(221,'Programming in C','Balaguruswamy','','9','C Programming','100.100','Programming','');
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
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_status`
--

LOCK TABLES `book_status` WRITE;
/*!40000 ALTER TABLE `book_status` DISABLE KEYS */;
INSERT INTO `book_status` VALUES (89,1),(90,2),(91,1),(92,1),(93,3),(94,3),(95,1),(96,1),(97,1),(98,1),(99,1),(100,1),(101,1),(102,1),(103,1),(104,1),(105,1),(106,1),(107,1),(108,1),(109,1),(111,1),(113,1),(114,1),(115,3),(116,3),(117,1),(118,1),(119,3),(121,1),(122,1),(123,1),(124,1),(125,1),(126,1),(127,1),(128,1),(129,1),(130,1),(131,1),(132,1),(133,1),(134,1),(135,1),(136,1),(137,1),(138,1),(139,1),(140,1),(141,1),(142,1),(143,1),(144,1),(145,1),(146,1),(147,1),(148,1),(149,1),(150,1),(151,1),(152,1),(153,1),(154,1),(155,1),(156,1),(157,1),(158,1),(159,1),(160,1),(161,1),(162,1),(163,1),(164,1),(165,1),(166,1),(167,1),(168,1),(169,1),(170,1),(171,1),(172,1),(173,1),(174,1),(175,1),(176,1),(177,1),(178,1),(179,1),(180,1),(181,1),(182,1),(183,1),(184,1),(185,1),(186,1),(187,1),(188,1),(189,1),(190,1),(191,1),(192,1),(193,1),(194,1),(195,1),(196,1),(197,1),(198,1),(199,1),(200,1),(201,1),(202,1),(203,1),(204,1),(205,1),(206,1),(207,1),(208,1),(209,1),(210,1),(211,1),(212,1),(213,1),(214,1),(215,1),(216,1),(217,1),(218,1),(219,1),(220,1),(221,1);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
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
INSERT INTO `user` VALUES ('admin','OLM Admin','c657540d5b315892f950ff30e1394480','vishnuvp@ymail.com','7736522808','Admin'),('E940001CS','Vineeth Paleri','ee41a016463824be2f9aed52eaf13586','vineeth_e940001cs@nitc.ac.in','9988776655','Faculty'),('E940002CS','Sudeep K S','1ad0df79c344bb30ae1bc1e44caa83c3','sudeep@nitc.ac.in','9876543210','Faculty'),('E940003CS','Vinod Pathari','84ab45d6c90fe9b58f5ec072754ee3b6','vinod@nitc.ac.in','9786543210','Faculty'),('E940005','Saidalavi Kalady','f3c6b1a713be288d3ea67cd598831a52','saidalavik@nitc.ac.in','9988776655','Faculty'),('M140143CS','Rakesh','7ea063814753df0319f230d98b71a6de','rakesh_m140143cs@nitc.ac.in','9098764321','Student'),('M140153CS','Arun','304f802f3480fdc11b6719a71f4e297e','arun_m140123cs@nitc.ac.in','2345678011','Student'),('M140163CS','Vishnu V P','5af0c9c25c98e4262ef5b98dc97d181a','vishnu_m140163cs@nitc.ac.in','7736522808','Student'),('M140400CS','Denny','4df28e702cf6c2c8fb46475e6cdef085','denny_m140400cs@nitc.ac.in','2313141678','Student');
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

-- Dump completed on 2014-10-05 16:37:21
