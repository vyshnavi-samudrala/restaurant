-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: restaurant
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Dumping data for table `restaurants`
--

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
INSERT INTO `restaurants` VALUES (1,'Dominos','9972377277',NULL,'Adyar','Gandhinagar 2nd Main Road','Chennai','restaurants/dominos.jpg',NULL,4,'2016-11-25 07:20:01'),(2,'French Loaf','9972377277',NULL,'Mylapore','Venkatachalam Street, Mylapore','Chennai','restaurants/french.jpg',NULL,3,'2016-11-25 07:20:01'),(3,'Wangs Kitchen','7898989777',NULL,'Tambaram','East Tamabaram','Chennai','restaurants/wangs.jpg',NULL,5,'2016-11-25 07:20:01'),(4,'Saravana Bhavan','9999911111',NULL,'Vadapalani','Vadapalni, Near Murugan Koil','Chennai','restaurants/saravana.jpg',NULL,4.5,'2016-11-25 07:20:01'),(5,'Ananda','8888811111',NULL,'Teynampet','AnnaSalai','Chennai','restaurants/ananda.jpg',NULL,3.5,'2016-11-25 07:20:01'),(6,'Pizza Hut','9972377277',NULL,'Nizampet','Cross Roads','Hyderabad','restaurants/pizzas.jpg',NULL,5,'2016-11-25 07:20:01'),(7,'Chutneys','9972377277',NULL,'Hitech City','Hitech City Complex','Hyderabad','restaurants/chutneys.jpg',NULL,4,'2016-11-25 07:20:02'),(8,'Paradise','7898989777',NULL,'Banjara Hills','2nd main Road','Hyderabad','restaurants/paradise.jpg',NULL,4.5,'2016-11-25 07:20:02'),(9,'Udipi Restaurant','9999911111',NULL,'Miapur','Opp Inox','Hyderabad','restaurants/udipi.jpg',NULL,4,'2016-11-25 07:20:02'),(10,'Sangeetha','8888811111',NULL,'JNTU','JNTU Campus','Hyderabad','restaurants/sangeetha.jpg',NULL,5,'2016-11-25 07:20:02');
/*!40000 ALTER TABLE `restaurants` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-28  1:09:20
