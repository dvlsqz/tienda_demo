CREATE DATABASE  IF NOT EXISTS `cms` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;
USE `cms`;
-- MariaDB dump 10.19  Distrib 10.4.20-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cms
-- ------------------------------------------------------
-- Server version	10.4.20-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Labiales','0',0,'labiales','{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"314-lipstick2.png\",\"final_name\":\"314-lipstick2png-1633902707.png\"}',0,NULL,'2021-06-27 07:21:44','2021-10-10 21:51:47'),(2,'Esmaltes','0',0,'esmaltes','{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"918-nail-polish.png\",\"final_name\":\"918-nail-polishpng-1633902945.png\"}',0,NULL,'2021-06-27 07:23:24','2021-10-10 21:55:45'),(3,'Brochas','0',0,'brochas','{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"798-brushes.png\",\"final_name\":\"798-brushespng-1633902958.png\"}',0,NULL,'2021-06-27 07:24:14','2021-10-10 21:55:58'),(4,'Labiales Mate','0',1,'labiales-mate','{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"649-lipstick2.png\",\"final_name\":\"649-lipstick2png-1633903026.png\"}',0,NULL,'2021-06-27 07:26:34','2021-10-10 21:57:06'),(5,'Labiales Gloss','0',1,'labiales-gloss','{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"649-lipstick2.png\",\"final_name\":\"649-lipstick2png-1633903040.png\"}',0,NULL,'2021-06-27 07:28:35','2021-10-10 21:57:20'),(10,'Paleta de Ojos','0',0,'paleta-de-ojos','{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"eye-shadows.png\",\"final_name\":\"eye-shadowspng-1633893793.png\"}',0,NULL,'2021-10-10 19:23:13','2021-10-10 19:23:13'),(11,'Cremas Faciales','0',0,'cremas-faciales','{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"face.png\",\"final_name\":\"facepng-1633893812.png\"}',0,NULL,'2021-10-10 19:23:32','2021-10-10 19:23:32'),(12,'Labial Velvet','0',1,'labial-velvet','{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"314-lipstick2.png\",\"final_name\":\"314-lipstick2png-1633905287.png\"}',0,NULL,'2021-10-10 22:34:47','2021-10-10 22:34:47');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coverage`
--

DROP TABLE IF EXISTS `coverage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coverage` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT 1,
  `ctype` int(11) NOT NULL,
  `state_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `days` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coverage`
--

LOCK TABLES `coverage` WRITE;
/*!40000 ALTER TABLE `coverage` DISABLE KEYS */;
INSERT INTO `coverage` VALUES (1,1,0,0,'Guatemala',0.00,2,NULL,'2021-06-27 07:32:36','2021-06-27 07:32:36'),(2,1,0,0,'Izabal',0.00,3,NULL,'2021-06-27 07:32:46','2021-06-27 07:32:46'),(3,1,0,0,'Peten',0.00,3,NULL,'2021-06-27 07:32:53','2021-10-10 16:58:29'),(4,1,1,1,'Villa Nueva',35.00,2,NULL,'2021-06-27 07:33:12','2021-06-27 07:33:12'),(5,1,1,1,'Mixco',35.00,2,NULL,'2021-06-27 07:33:18','2021-06-27 07:33:18'),(6,1,1,1,'zona 10',35.00,2,NULL,'2021-06-27 07:33:25','2021-06-27 07:33:25'),(7,1,1,3,'Flores',35.00,3,NULL,'2021-06-27 07:33:41','2021-06-27 07:33:41'),(8,1,0,0,'Quetzaltenango',0.00,2,NULL,'2021-06-27 07:33:54','2021-06-27 07:33:54'),(9,1,1,8,'La Esperanza',35.00,2,NULL,'2021-06-27 07:34:08','2021-06-27 07:34:08'),(10,1,1,8,'zona 5',35.00,2,NULL,'2021-06-27 07:34:15','2021-06-27 07:34:15'),(11,1,0,0,'San Marcos',0.00,1,NULL,'2021-06-27 07:36:14','2021-06-27 07:36:14'),(12,1,1,11,'San Pedro',10.00,1,NULL,'2021-06-27 07:36:28','2021-06-27 07:36:28');
/*!40000 ALTER TABLE `coverage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_08_09_021535_create_categories_table',2),(5,'2020_08_09_043343_create_products_table',3),(6,'2020_08_09_191421_add_field_file_path_to_products_table',4),(7,'2020_08_09_234451_create_products_gallery_table',5),(8,'2020_08_20_223506_add_field_avatar_status_to_users_table',6),(9,'2020_08_28_234944_add_password_code_to_users_table',7),(10,'2020_08_29_030821_add_field_permissions_to_users_table',8),(11,'2020_09_06_022641_add_field_inventory_and_code_to_products_table',9),(12,'2021_01_10_002231_add_fields_phone_year_gender',10),(13,'2021_01_12_010503_add_field_file__path_to_categories_table',11),(14,'2021_01_14_025007_create_sliders_table',12),(15,'2021_01_19_010951_create_table_user_favorites',13),(16,'2021_02_23_154204_add_field_parent_to_categories',14),(17,'2021_02_23_162535_add_field_order_to_categories_table',15),(18,'2021_02_23_172434_add_field_sub_category_id_to_products_table',16),(20,'2021_04_13_183222_create_product_inventory_table',17),(21,'2021_04_13_210315_create_product_inventory_variants',18),(22,'2021_04_13_214643_drop_products_table_price_inventory',19),(23,'2021_04_13_222141_add_price_field_to_products_table',20),(24,'2021_05_01_210333_create_orders_table',21),(29,'2021_05_01_213932_create_orders_items_table',22),(30,'2021_05_02_121211_ad__field_price_org_to_table_orders_items',22),(31,'2021_05_02_125533_add_field_discount_until_date_to_table_products',23),(32,'2021_05_02_170513_add_field_discount_until_date_to_table_orders_items',24),(33,'2021_05_02_204004_create_coverage_table',25),(34,'2021_05_02_205131_add_field_state_id_to_table_coverage',26),(35,'2021_05_03_112549_add_field_status_to_coverage_table',27),(36,'2021_06_06_175514_create_user_address_table',28),(37,'2021_06_06_180940_add_field_default_to_user_address',29),(38,'2021_10_09_125341_add_times_activity_fields_to_order_table',30),(39,'2021_10_09_161503_add_times_activity_fields2_to_order_table',31);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `o_number` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `o_type` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `user_address_id` int(11) DEFAULT NULL,
  `user_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(11,2) DEFAULT 0.00,
  `delivery` decimal(11,2) DEFAULT 0.00,
  `total` decimal(11,2) DEFAULT 0.00,
  `payment_method` int(11) DEFAULT NULL,
  `payment_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `request_at` timestamp NULL DEFAULT NULL,
  `process_at` timestamp NULL DEFAULT NULL,
  `send_at` timestamp NULL DEFAULT NULL,
  `delivery_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'1',4,0,1,2,NULL,325.00,10.00,335.00,0,NULL,NULL,'2021-09-26 10:57:21','2021-10-09 10:49:32','2021-10-09 10:50:14',NULL,NULL,'2021-09-26 10:57:10','2021-10-09 22:50:14'),(2,'2',1,1,1,NULL,NULL,455.00,0.00,455.00,0,NULL,NULL,'2021-09-26 10:58:02',NULL,NULL,NULL,NULL,'2021-09-26 10:57:46','2021-09-26 10:58:02'),(3,'3',4,0,1,2,NULL,520.00,10.00,530.00,0,NULL,NULL,'2021-09-25 17:00:17','2021-10-09 10:32:21','2022-06-18 09:54:55',NULL,NULL,'2021-09-26 05:00:08','2022-06-18 21:54:55'),(5,'4',6,0,1,2,NULL,130.00,10.00,140.00,0,NULL,NULL,'2021-10-09 18:41:21','2021-10-09 10:13:40','2021-10-09 10:13:56','2021-10-09 10:14:18',NULL,'2021-10-09 18:40:45','2021-10-09 22:14:18'),(6,NULL,0,0,1,2,NULL,130.00,10.00,140.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-06-18 19:08:37','2022-06-19 03:56:53');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_items`
--

DROP TABLE IF EXISTS `orders_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `label_item` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `discount_status` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `discount_until_date` date DEFAULT NULL,
  `price_initial` decimal(11,2) DEFAULT NULL,
  `price_unit` decimal(11,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_items`
--

LOCK TABLES `orders_items` WRITE;
/*!40000 ALTER TABLE `orders_items` DISABLE KEYS */;
INSERT INTO `orders_items` VALUES (1,1,1,2,1,NULL,'Yuya Labial Líquido Mate / Me Quiero',5,0,0,NULL,65.00,65.00,325.00,'2021-09-26 10:57:10','2021-09-26 10:57:10'),(2,1,2,1,4,NULL,'Yuya Labial Velvet / Te Quiero',7,0,0,NULL,65.00,65.00,455.00,'2021-09-26 10:57:46','2021-09-26 10:57:46'),(3,1,3,1,3,NULL,'Yuya Labial Velvet / Traviesa',8,0,0,NULL,65.00,65.00,520.00,'2021-09-26 05:00:08','2021-09-26 05:00:08'),(6,1,5,2,1,NULL,'Yuya Labial Líquido Mate / Me Quiero',1,0,0,NULL,65.00,65.00,65.00,'2021-10-09 18:40:59','2021-10-09 18:40:59'),(7,1,5,1,3,NULL,'Yuya Labial Velvet / Traviesa',1,0,0,NULL,65.00,65.00,65.00,'2021-10-09 18:41:10','2021-10-09 18:41:10'),(8,1,6,1,3,NULL,'Yuya Labial Velvet / Vive la Vida',2,0,0,NULL,65.00,65.00,130.00,'2022-06-19 03:56:51','2022-06-19 03:56:51');
/*!40000 ALTER TABLE `orders_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_gallery`
--

DROP TABLE IF EXISTS `product_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_gallery` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `file_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_gallery`
--

LOCK TABLES `product_gallery` WRITE;
/*!40000 ALTER TABLE `product_gallery` DISABLE KEYS */;
INSERT INTO `product_gallery` VALUES (1,3,'{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"LabialGloss2.jpg\",\"final_name\":\"labialgloss2jpg-1633905821.jpg\"}',NULL,'2021-10-10 22:43:42','2021-10-10 22:43:42'),(2,3,'{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"LabialGloss3_1024x1024.jpg\",\"final_name\":\"labialgloss3-1024x1024jpg-1633905829.jpg\"}',NULL,'2021-10-10 22:43:49','2021-10-10 22:47:20'),(3,2,'{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"descarga.jpg\",\"final_name\":\"descargajpg-1633906469.jpg\"}',NULL,'2021-10-10 22:54:29','2021-10-10 22:54:29'),(4,2,'{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"QUEDATE_1024x1024.jpg\",\"final_name\":\"quedate-1024x1024jpg-1633906477.jpg\"}',NULL,'2021-10-10 22:54:38','2021-10-10 22:54:38'),(5,1,'{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"UNBESITO2_1800x1800.jpg\",\"final_name\":\"unbesito2-1800x1800jpg-1633906567.jpg\"}',NULL,'2021-10-10 22:56:08','2021-10-10 22:56:08'),(6,1,'{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"LabialVelvetApapacho_grande.jpg\",\"final_name\":\"labialvelvetapapacho-grandejpg-1633906576.jpg\"}',NULL,'2021-10-10 22:56:16','2021-10-10 22:56:16');
/*!40000 ALTER TABLE `product_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_inventory`
--

DROP TABLE IF EXISTS `product_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_inventory` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `limited` int(11) NOT NULL,
  `minium` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_inventory`
--

LOCK TABLES `product_inventory` WRITE;
/*!40000 ALTER TABLE `product_inventory` DISABLE KEYS */;
INSERT INTO `product_inventory` VALUES (1,2,'Quédate',10,65.00,0,1,NULL,'2021-06-27 07:48:02','2021-10-10 22:37:55'),(2,2,'Mi Amor',10,65.00,0,1,NULL,'2021-06-27 07:48:34','2021-10-10 22:38:13'),(3,1,'Vive la Vida',15,65.00,0,1,NULL,'2021-06-27 07:57:18','2021-10-10 22:36:58'),(4,1,'Apapacho',20,65.00,0,1,NULL,'2021-06-27 07:57:42','2021-10-10 22:37:18'),(5,3,'Tu Magia',10,65.00,0,1,NULL,'2021-10-10 22:36:18','2021-10-10 22:36:18'),(6,3,'Equilibrio',10,65.00,0,1,NULL,'2021-10-10 22:36:37','2021-10-10 22:36:37');
/*!40000 ALTER TABLE `product_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_inventory_variants`
--

DROP TABLE IF EXISTS `product_inventory_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_inventory_variants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_inventory_variants`
--

LOCK TABLES `product_inventory_variants` WRITE;
/*!40000 ALTER TABLE `product_inventory_variants` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_inventory_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL DEFAULT 0,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(11,2) NOT NULL DEFAULT 0.00,
  `in_discount` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `discount_until_date` date DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'0','Yuya Labial Velvet','yuya-labial-velvet',1,12,'{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"labiales velvet.jpg\",\"final_name\":\"labiales-velvetjpg-1633904602.jpg\"}',65.00,0,0,NULL,'&lt;p&gt;Traviesa es el color perfecto para el d&amp;iacute;a y la noche, un rosita que nos va a todos.&lt;/p&gt;',NULL,'2021-06-27 07:47:01','2021-10-10 22:35:08'),(2,1,'0','Yuya Labial Líquido Mate','yuya-labial-liquido-mate',1,4,'{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"labiales mate.jpg\",\"final_name\":\"labiales-matejpg-1633904757.jpg\"}',65.00,0,0,NULL,'&lt;p&gt;&amp;iexcl;Si eres fan de los labiales rositas intensos esto es para ti! (Y si no tambi&amp;eacute;n porque al final todos terminamos am&amp;aacute;ndolo jajaja) . (Dise&amp;ntilde;o exclusivo)&lt;/p&gt;',NULL,'2021-06-27 07:47:29','2021-10-10 22:25:57'),(3,1,'0','Yuya Labial Gloss','yuya-labial-gloss',1,5,'{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"labiales gloss.jpg\",\"final_name\":\"labiales-glossjpg-1633905183.jpg\"}',65.00,0,0,NULL,'&lt;p&gt;Labiales tipo gloss&lt;/p&gt;',NULL,'2021-10-10 22:33:03','2021-10-10 22:36:18');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorder` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,1,1,'Principal','2021-06-27','33-1-original-pantalla.png','Distribuidora de Cosmeticos en San Marcos, Productos de las marcas Yuya, Maybelline, Lure, Wet´n Will, Millani, Beauty Creations, Freeman, Garnier,  Garnier Skincare, entre otras',0,'2021-06-27 08:03:58','2021-06-27 08:03:58'),(2,1,1,'Yuya','2021-06-27','802-banner-yuya.jpg','Nuestra marca lider',1,'2021-06-27 08:05:46','2021-06-27 08:05:46');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_address` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_address`
--

LOCK TABLES `user_address` WRITE;
/*!40000 ALTER TABLE `user_address` DISABLE KEYS */;
INSERT INTO `user_address` VALUES (1,1,8,10,'Oficina','{\"add1\":\"5ta avenida 1-79\",\"add2\":\"5\",\"add3\":\"Molina\",\"add4\":\"IGSS garita no.4\"}',0,NULL,'2021-06-27 07:35:49','2021-06-27 07:58:31'),(2,1,11,12,'Casa','{\"add1\":\"Diagonal 4A 3-15\",\"add2\":\"4\",\"add3\":\"\",\"add4\":\"A la vuelta de lab alameda, porton color negro\"}',1,NULL,'2021-06-27 07:37:28','2021-06-27 07:58:31');
/*!40000 ALTER TABLE `user_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_favorites`
--

DROP TABLE IF EXISTS `user_favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_favorites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_favorites`
--

LOCK TABLES `user_favorites` WRITE;
/*!40000 ALTER TABLE `user_favorites` DISABLE KEYS */;
INSERT INTO `user_favorites` VALUES (1,1,1,2,'2021-06-27 07:50:31','2021-06-27 07:50:31');
/*!40000 ALTER TABLE `user_favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,0,1,'Daniel','Velasquez','daniel.vel@hotmail.com','{\"upload\":\"success\",\"path\":\"2021\\/10\\/10\",\"original_name\":\"815_images.jpg\",\"final_name\":\"815-imagesjpg-1633907661.jpg\"}',37569098,'1997-07-31',1,NULL,'$2y$10$iqVSd7iPkExQzkKI5WfkouxtH92nCOvB6dt1W2L42qcLIPwAfR7yW',NULL,'{\"home\":\"true\",\"dashboard\":\"true\",\"dashboard_small_stats\":\"true\",\"dashboard_sell_today\":\"true\",\"categories\":\"true\",\"category_add\":\"true\",\"category_edit\":\"true\",\"category_delete\":\"true\",\"products\":\"true\",\"product_add\":\"true\",\"product_edit\":\"true\",\"product_delete\":\"true\",\"product_search\":\"true\",\"product_gallery_add\":\"true\",\"product_gallery_delete\":\"true\",\"product_inventory\":\"true\",\"user_list\":\"true\",\"user_view\":\"true\",\"user_edit\":\"true\",\"user_banned\":\"true\",\"user_permissions\":\"true\",\"sliders_list\":\"true\",\"sliders_add\":\"true\",\"sliders_edit\":\"true\",\"sliders_delete\":\"true\",\"settings\":\"true\",\"orders_list\":\"true\",\"order_view\":\"true\",\"order_change_status\":\"true\",\"coverage_list\":\"true\",\"coverage_add\":\"true\",\"coverage_edit\":\"true\",\"coverage_delete\":\"true\"}','QGdxZDEMgFG7YTXLqc0hL50OrtuNRZS0E9lLdDpQ8p1CRA2wRslx8lzlC1xK','2021-06-27 06:51:31','2022-06-18 19:16:48');
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

-- Dump completed on 2022-06-20 21:52:10
