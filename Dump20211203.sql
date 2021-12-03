-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: u488180748_UBSU0gc
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_announcement`
--

DROP TABLE IF EXISTS `tbl_announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_announcement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banner_img` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_announcement`
--

LOCK TABLES `tbl_announcement` WRITE;
/*!40000 ALTER TABLE `tbl_announcement` DISABLE KEYS */;
INSERT INTO `tbl_announcement` VALUES (6,'banner-990x240-red.jpg','2021-10-17 03:08:49'),(7,'banner-990x240-blue.jpg','2021-10-17 03:08:49'),(8,'banner-990x240-green.jpg','2021-10-17 03:08:49'),(9,'sample-banner.jpg','2021-10-17 03:12:13');
/*!40000 ALTER TABLE `tbl_announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_appointment`
--

DROP TABLE IF EXISTS `tbl_appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_appointment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appointment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `members` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_appointment`
--

LOCK TABLES `tbl_appointment` WRITE;
/*!40000 ALTER TABLE `tbl_appointment` DISABLE KEYS */;
INSERT INTO `tbl_appointment` VALUES (18,'group_counseling','2021-12-02 05:00:00','approved',5,'2021-12-02 00:48:51','John Maenard Semira\nJohn Doe\nDoe John'),(19,'group_counseling','2021-12-07 23:00:00','pending',4,'2021-12-03 09:40:13',NULL),(22,'group_counseling','2021-12-07 23:00:00','pending',6,'2021-12-03 10:32:54','<br>john semira<br>john semira2<br>john semira3'),(24,'exit_interview','2021-12-09 03:00:00','approved',6,'2021-12-03 11:12:42',''),(25,'initial_interview','2021-12-21 23:00:00','pending',6,'2021-12-03 11:17:17',''),(26,'post_interview','2021-12-26 23:00:00','pending',6,'2021-12-03 11:17:32','');
/*!40000 ALTER TABLE `tbl_appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_forms`
--

DROP TABLE IF EXISTS `tbl_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_forms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `form_title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `form_file` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_forms`
--

LOCK TABLES `tbl_forms` WRITE;
/*!40000 ALTER TABLE `tbl_forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_options`
--

DROP TABLE IF EXISTS `tbl_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_options` (
  `option_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_options`
--

LOCK TABLES `tbl_options` WRITE;
/*!40000 ALTER TABLE `tbl_options` DISABLE KEYS */;
INSERT INTO `tbl_options` VALUES (1,'announcement',''),(2,'disable_hour','s:63:\"[\"7:00 am - 8:00 am\",\"8:00 am - 9:00 am\",\"11:00 am - 12:00 pm\"]\";'),(3,'disable_day','s:25:\"[\"1\",\"12\",\"13\",\"16\",\"24\"]\";'),(4,'disable_month','s:23:\"[\"November\",\"December\"]\";');
/*!40000 ALTER TABLE `tbl_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_request_cgmc_job_application`
--

DROP TABLE IF EXISTS `tbl_request_cgmc_job_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_request_cgmc_job_application` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receipt_number` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tor_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tor_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cgmc_form_file` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cgmc_form_status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_request_cgmc_job_application`
--

LOCK TABLES `tbl_request_cgmc_job_application` WRITE;
/*!40000 ALTER TABLE `tbl_request_cgmc_job_application` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_request_cgmc_job_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_request_cgmc_ojt`
--

DROP TABLE IF EXISTS `tbl_request_cgmc_ojt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_request_cgmc_ojt` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_form_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration_form_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_form_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_form_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `career_advising_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `career_advising_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_request_cgmc_ojt`
--

LOCK TABLES `tbl_request_cgmc_ojt` WRITE;
/*!40000 ALTER TABLE `tbl_request_cgmc_ojt` DISABLE KEYS */;
INSERT INTO `tbl_request_cgmc_ojt` VALUES (1,'','pending','','pending','','pending','',3,'2021-12-01 09:45:20');
/*!40000 ALTER TABLE `tbl_request_cgmc_ojt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_request_cgmc_rnu_rep`
--

DROP TABLE IF EXISTS `tbl_request_cgmc_rnu_rep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_request_cgmc_rnu_rep` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_form_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration_form_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cgmc_form_file` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cgmc_form_status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_request_cgmc_rnu_rep`
--

LOCK TABLES `tbl_request_cgmc_rnu_rep` WRITE;
/*!40000 ALTER TABLE `tbl_request_cgmc_rnu_rep` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_request_cgmc_rnu_rep` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_request_cgmc_scholarship`
--

DROP TABLE IF EXISTS `tbl_request_cgmc_scholarship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_request_cgmc_scholarship` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receipt_number` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `application_form_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `application_form_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration_form_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration_form_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grades_from_prev_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grades_from_prev_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_request_cgmc_scholarship`
--

LOCK TABLES `tbl_request_cgmc_scholarship` WRITE;
/*!40000 ALTER TABLE `tbl_request_cgmc_scholarship` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_request_cgmc_scholarship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_request_cgmc_tosa_app`
--

DROP TABLE IF EXISTS `tbl_request_cgmc_tosa_app`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_request_cgmc_tosa_app` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receipt_number` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tosa_app_form_of_scholarship_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tosa_app_form_of_scholarship_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `proof_of_app_of_ha_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `proof_of_app_of_ha_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cgmc_form_file` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cgmc_form_status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_request_cgmc_tosa_app`
--

LOCK TABLES `tbl_request_cgmc_tosa_app` WRITE;
/*!40000 ALTER TABLE `tbl_request_cgmc_tosa_app` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_request_cgmc_tosa_app` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_request_cgmc_transferee`
--

DROP TABLE IF EXISTS `tbl_request_cgmc_transferee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_request_cgmc_transferee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receipt_number` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `exit_interview_form_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `exit_interview_form_status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cgmc_form_file` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cgmc_form_status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_request_cgmc_transferee`
--

LOCK TABLES `tbl_request_cgmc_transferee` WRITE;
/*!40000 ALTER TABLE `tbl_request_cgmc_transferee` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_request_cgmc_transferee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_students`
--

DROP TABLE IF EXISTS `tbl_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_students` (
  `student_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `suffixes` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` datetime NOT NULL,
  `department` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_students`
--

LOCK TABLES `tbl_students` WRITE;
/*!40000 ALTER TABLE `tbl_students` DISABLE KEYS */;
INSERT INTO `tbl_students` VALUES (1,'Ronald','Bee','Test','Jr.','1990-11-16 18:31:50','Informatics and Computing Sciences','BS Information Technology'),(2,'John','Doe','A','','2000-10-04 21:05:12','Informatics and Computing Sciences','BS Information Technology'),(3,'maenard','semira','','','0000-00-00 00:00:00','College Of Informatics and Computing Sciences','Bachelor of Science in Computer Science'),(4,'Sekretoz01','Sekretoz','','','0000-00-00 00:00:00','College Of Informatics and Computing Sciences','Bachelor of Science in Computer Science'),(5,'john','semira','','','0000-00-00 00:00:00','College Of Informatics and Computing Sciences','Bachelor of Science in Computer Science'),(6,'maenard','semira','','','0000-00-00 00:00:00','College Of Informatics and Computing Sciences','Bachelor of Science in Computer Science');
/*!40000 ALTER TABLE `tbl_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_role`
--

DROP TABLE IF EXISTS `tbl_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_role`
--

LOCK TABLES `tbl_user_role` WRITE;
/*!40000 ALTER TABLE `tbl_user_role` DISABLE KEYS */;
INSERT INTO `tbl_user_role` VALUES (1,'administrator','2021-09-18 06:12:00'),(2,'student','2021-09-18 06:12:08');
/*!40000 ALTER TABLE `tbl_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_level` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `google_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'super_admin','656c19427c33d7b048b4a98017bc0299','','','administrator','0000-00-00 00:00:00','2021-12-03 13:58:19',NULL,NULL),(3,'18-01990','656c19427c33d7b048b4a98017bc0299','ron.fastmedia@gmail.com','1','student','0000-00-00 00:00:00','2021-11-22 09:41:37',NULL,NULL),(4,'18-01991','656c19427c33d7b048b4a98017bc0299','ron.fastmedia@gmail.com','2','student','0000-00-00 00:00:00','2021-10-17 09:42:32',NULL,NULL),(5,'testsetsetset','','sekretoz02@gmail.com','3','student','0000-00-00 00:00:00','2021-12-01 14:48:33','107612606943371945604','https://lh3.googleusercontent.com/a/AATXAJwwP'),(6,'test1234','','sekretoz01@gmail.com','4','student','0000-00-00 00:00:00','2021-12-03 16:39:48','113623098040083569055','https://lh3.googleusercontent.com/a/AATXAJytP'),(7,'test','','sekretoz001@gmail.com','5','student','0000-00-00 00:00:00','0000-00-00 00:00:00','116603392379781972839','https://lh3.googleusercontent.com/a/AATXAJwl3'),(8,'12313123123','','sekretoz17@gmail.com','6','student','0000-00-00 00:00:00','0000-00-00 00:00:00','103659420360592042988','https://lh3.googleusercontent.com/a/AATXAJxob');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-03 19:18:22
