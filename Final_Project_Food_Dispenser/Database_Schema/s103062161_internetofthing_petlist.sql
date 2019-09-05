-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: s103062161
-- ------------------------------------------------------
-- Server version	5.7.10

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
-- Table structure for table `internetofthing_petlist`
--

DROP TABLE IF EXISTS `internetofthing_petlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `internetofthing_petlist` (
  `petlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `petlist_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `petlist_deviceId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `petlist_access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`petlist_id`),
  UNIQUE KEY `petlist_deviceId_UNIQUE` (`petlist_deviceId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internetofthing_petlist`
--

LOCK TABLES `internetofthing_petlist` WRITE;
/*!40000 ALTER TABLE `internetofthing_petlist` DISABLE KEYS */;
INSERT INTO `internetofthing_petlist` VALUES (1,'fydhd','txyxudfi','8BD33D28-2368-C245-349C-6D93206298AF'),(2,'dog1','fjf','8BD33D28-2368-C245-349C-6D93206298AF'),(3,'dog2','fyejsdh','8BD33D28-2368-C245-349C-6D93206298AF'),(6,'Bob','iotdevice1','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(7,'due','iotprototype1','8BD33D28-2368-C245-349C-6D93206298AF'),(8,'bbb','bbb','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(9,'bbn','','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(10,'bbb','jjj','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(11,'bbb','bbbb','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(12,'bnnn','bnnn','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(13,'bbbb','bbbn','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(14,'bbnkk','jnnn','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(15,'ihjiuj','jjhii','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(16,'dsryg','esfcx','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(17,'hcuvjv.','kvjvjvi','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(18,'joonn','nknn','A6267E46-E923-8B92-43BE-A9EEE01267A2'),(19,'hjvjvjv','ivjvjviv','A6267E46-E923-8B92-43BE-A9EEE01267A2');
/*!40000 ALTER TABLE `internetofthing_petlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-25 10:41:06
