-- MySQL dump 10.11
--
-- Host: localhost    Database: phpbg
-- ------------------------------------------------------
-- Server version	5.0.51a-5

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
-- Table structure for table `phpbg_log`
--

DROP TABLE IF EXISTS `phpbg_log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `phpbg_log` (
  `id` int(11) NOT NULL auto_increment,
  `date` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `phpbg_log`
--

LOCK TABLES `phpbg_log` WRITE;
/*!40000 ALTER TABLE `phpbg_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbg_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbg_news`
--

DROP TABLE IF EXISTS `phpbg_news`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `phpbg_news` (
  `id` int(11) NOT NULL auto_increment,
  `subject` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `phpbg_news`
--

LOCK TABLES `phpbg_news` WRITE;
/*!40000 ALTER TABLE `phpbg_news` DISABLE KEYS */;
INSERT INTO `phpbg_news` VALUES (1,'Lorem ipsum dolor sit amet, consectetuer','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euis\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euis\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euis',1211489733,1),(2,'Lorem ipsum dolor sit amet, consectetuer','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euis\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euis\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euis',1211489733,1);
/*!40000 ALTER TABLE `phpbg_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbg_users`
--

DROP TABLE IF EXISTS `phpbg_users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `phpbg_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) NOT NULL default '1',
  `lastlogin` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `phpbg_users`
--

LOCK TABLES `phpbg_users` WRITE;
/*!40000 ALTER TABLE `phpbg_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbg_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2008-05-22 21:09:06
