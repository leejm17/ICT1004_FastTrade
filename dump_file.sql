-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: ft_db
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.37-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Home Appliance'),(2,'Furniture'),(3,'Computers and IT'),(4,'Kids'),(5,'Home Repair'),(6,'Services');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `description` mediumtext NOT NULL,
  `condition` int(11) NOT NULL,
  `price` float NOT NULL,
  `status` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `ad_duration` int(11) DEFAULT '0',
  PRIMARY KEY (`item_id`),
  KEY `FK_item_user_id_idx` (`user_id`),
  KEY `FK_item_category_id_idx` (`category_id`),
  CONSTRAINT `FK_item_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_item_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'PC for Sale','Buy PC from me! Cheap Cheap',0,93,1,0,'jonsaysquack',3,2,0),(2,'Mei Heong Yuan Vouchers','Mei Heong Yuan vouchers! Best dessert around.',0,15,1,0,'hoxiuqi',6,1,0);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_photo`
--

DROP TABLE IF EXISTS `item_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `item_photo` (
  `item_photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `photo` mediumblob NOT NULL,
  PRIMARY KEY (`item_photo_id`,`item_id`),
  KEY `FK_item_p_id_idx` (`item_id`),
  CONSTRAINT `FK_item_p_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_photo`
--

LOCK TABLES `item_photo` WRITE;
/*!40000 ALTER TABLE `item_photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_review`
--

DROP TABLE IF EXISTS `item_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `item_review` (
  `item_id` int(11) NOT NULL,
  `email_id` varchar(35) NOT NULL,
  `datetime` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `review` mediumtext NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`item_id`,`email_id`,`datetime`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_review`
--

LOCK TABLES `item_review` WRITE;
/*!40000 ALTER TABLE `item_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(20) NOT NULL,
  `receipient_id` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `message_text` mediumtext NOT NULL,
  `message_timestamp` datetime NOT NULL,
  PRIMARY KEY (`message_id`,`sender_id`,`receipient_id`,`item_id`),
  KEY `FK_message_item_id_idx` (`item_id`),
  CONSTRAINT `FK_message_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `offer` (
  `buyer_id` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `accept` int(11) NOT NULL,
  `asking_price` float DEFAULT NULL,
  `trading_place` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`buyer_id`,`item_id`,`seller_id`),
  KEY `FK_offer_item_id_idx` (`item_id`),
  CONSTRAINT `FK_offer_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email_hash` varchar(32) NOT NULL,
  `activated` int(11) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `contact_info` varchar(15) DEFAULT NULL,
  `pic` mediumblob,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('hohoho','Ho Xiu Qi','xiuqiho@gmail.com','$2y$10$Msc4UdXARG162DPzoQtljutif9sqNNSZQMTX5maqIeti0Tl4/1gAm','01882513d5fa7c329e940dda99b12147',0,NULL,NULL,NULL),('hoxiuqi','Xiu Qi Ho','xiuqi@gmail.com','1qwer$#@!','',0,'M','+65 9090 2903',NULL),('jonsaysquack','Jonathan Lee','jonlee@gmail.com','helloworld','',0,'M','+65 9283 2893',NULL),('wutdequack','Jonathan Lee','jonathanleejuler@gmail.com','$2y$10$PQNdzoP564ddVrrKHMDz6Ogt16cjbI72kTwVQHEHvcNSQLxWdI.bi','33e8075e9970de0cfea955afd4644bb2',0,NULL,NULL,NULL),('wutdequack.dev','Jonathan Lee','wutdequack.dev@gmail.com','$2y$10$PBgB1ng6kiEoPTpUOavul.yK3WysyzyO0WwwI3dcud6KTAZBMczS.','6c8349cc7260ae62e3b1396831a8398f',1,NULL,NULL,NULL);
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

-- Dump completed on 2019-03-27 13:24:04
