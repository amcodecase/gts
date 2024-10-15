/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gts_db
-- ------------------------------------------------------
-- Server version	10.6.18-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_name` varchar(100) NOT NULL,
  `job_description` text NOT NULL,
  `number_of_people_needed` int(11) NOT NULL,
  `requirements` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `job_pdf` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expiry_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'Testing','Testing',5,'0','Lusaka','uploads/RoadMaster.pdf','2024-10-15 16:37:59','2024-10-15 16:37:59','0000-00-00 00:00:00'),(2,'Testing Title','Testing desc',5,'0','Shimabala','uploads/RoadMaster.pdf','2024-10-15 16:42:47','2024-10-15 16:42:47','0000-00-00 00:00:00'),(3,'Home','Hmom desc',4,'0','Chisamba','uploads/OSI Model Template.pdf','2024-10-15 17:30:40','2024-10-15 17:30:40','2024-10-16 00:00:00'),(4,'Testing','sa',3,'0','fff','uploads/OSI Model Template.pdf','2024-10-15 17:43:19','2024-10-15 17:43:19','2024-10-16 00:00:00'),(5,'saxas','sas',3,'0','Chisamba','uploads/OSI Model Template.pdf','2024-10-15 17:47:54','2024-10-15 17:47:54','2024-10-14 00:00:00'),(6,'Testing Title','ss',3,'0','Lusaka','uploads/OSI Model Template.pdf','2024-10-15 17:55:54','2024-10-15 17:55:54','2024-10-16 00:00:00');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'amcodecase','justusmichelo@chau.ac.zm','e4351455bcb4a1a05e6591fa1fb19bbe','superadmin','2024-10-15 15:51:51','2024-10-15 18:08:27'),(2,'charles','charles@gmail.com','$2y$10$A93yYI1s7RiqKeicOrynmOG5o7WgJeMK0zgc2SEYp0VBGHdCilcjS','admin','2024-10-15 16:38:21','2024-10-15 16:38:21'),(4,'charlesd','charles@gmail.comd','$2y$10$RbwOedolmaAnzyVcy9C71.FIF8d/Q716p4uyYmQut2H3fIna8aIG2','admin','2024-10-15 16:43:15','2024-10-15 16:43:15'),(6,'charless','charles@gmail.com',NULL,'superadmin','2024-10-15 17:32:06','2024-10-15 17:32:06'),(8,'hh','h@w.s',NULL,'admin','2024-10-15 17:41:13','2024-10-15 17:41:13'),(9,'charlesx','charles@gmail.com',NULL,'superadmin','2024-10-15 17:46:16','2024-10-15 17:46:16'),(10,'charlesxs','charles@gmail.comdss',NULL,'superadmin','2024-10-15 17:54:47','2024-10-15 17:54:47'),(11,'justus','jsutsu@gaml.c',NULL,'superadmin','2024-10-15 18:08:56','2024-10-15 18:08:56');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-15 20:39:51
