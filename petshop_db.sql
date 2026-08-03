-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: petshop_db
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pet_type` varchar(50) DEFAULT NULL,
  `pet_race` varchar(50) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `pet_name` varchar(255) DEFAULT NULL,
  `pet_gender` varchar(50) DEFAULT NULL,
  `pet_age` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (1,2,4,'2026-07-26','17:30','completed','2026-07-24 15:53:19','گربه','persian',NULL,NULL,NULL,NULL),(2,5,4,'2026-07-26','09:00','cancelled','2026-07-25 01:38:32','سگ','Husky',NULL,NULL,NULL,NULL),(3,6,4,'2026-07-26','16:45','cancelled','2026-07-25 02:04:34','سگ','Husky',NULL,NULL,NULL,NULL),(4,7,4,'2026-08-01','08:00','pending','2026-07-25 12:57:01','سگ','bulldog',NULL,NULL,NULL,NULL),(5,2,4,'2026-08-02','09:45','pending','2026-07-31 19:10:41','سگ','germenshepert',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autoship_plans`
--

DROP TABLE IF EXISTS `autoship_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autoship_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `interval_months` int(11) NOT NULL,
  `discount_percent` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autoship_plans`
--

LOCK TABLES `autoship_plans` WRITE;
/*!40000 ALTER TABLE `autoship_plans` DISABLE KEYS */;
INSERT INTO `autoship_plans` VALUES (1,'اشتراک ۳ ماهه',3,5,'2026-07-25 01:51:50'),(2,'اشتراک ۶ ماهه',6,10,'2026-07-25 01:51:50'),(3,'اشتراک ۱۲ ماهه',12,20,'2026-07-25 01:51:50');
/*!40000 ALTER TABLE `autoship_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autoship_subscriptions`
--

DROP TABLE IF EXISTS `autoship_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autoship_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `next_delivery_date` date NOT NULL,
  `status` enum('active','paused','cancelled') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `plan_id` (`plan_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `autoship_subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `autoship_subscriptions_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `autoship_plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `autoship_subscriptions_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autoship_subscriptions`
--

LOCK TABLES `autoship_subscriptions` WRITE;
/*!40000 ALTER TABLE `autoship_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `autoship_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sender_type` enum('user','admin','ai') NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_messages`
--

LOCK TABLES `chat_messages` WRITE;
/*!40000 ALTER TABLE `chat_messages` DISABLE KEYS */;
INSERT INTO `chat_messages` VALUES (1,6,'user','[AI] Hello, how can I feed my cat?',0,'2026-07-25 02:00:20'),(2,6,'ai','این یک پیام خودکار از دستیار هوشمند پت‌کر است. شما پرسیدید: \'Hello, how can I feed my cat?\'. در حال حاضر من در فاز آزمایشی هستم.',1,'2026-07-25 02:00:20');
/*!40000 ALTER TABLE `chat_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_events`
--

DROP TABLE IF EXISTS `dashboard_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashboard_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `event_time` varchar(5) NOT NULL,
  `color` varchar(20) DEFAULT 'primary',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_events`
--

LOCK TABLES `dashboard_events` WRITE;
/*!40000 ALTER TABLE `dashboard_events` DISABLE KEYS */;
INSERT INTO `dashboard_events` VALUES (1,'شروع شیفت کلینیک','08:00','primary','2026-07-25 02:30:42'),(2,'بررسی سفارشات','12:00','secondary','2026-07-25 02:30:42');
/*!40000 ALTER TABLE `dashboard_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `rating` decimal(2,1) DEFAULT 5.0,
  `review_count` int(11) DEFAULT 0,
  `image_url` varchar(500) DEFAULT NULL,
  `price` int(11) DEFAULT 450000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `schedule_info` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (4,'akbar nami','پزشک عمومی',5.0,0,'uploads/doctors/6a63b8fcdf04e_329748003990695799.jpeg',150000,'2026-07-23 20:12:40',4,'09990999','{\"sat\":{\"m_start\":\"08:00\",\"m_end\":\"14:00\",\"a_start\":\"16:00\",\"a_end\":\"21:00\"},\"sun\":{\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_start\":\"16:00\",\"a_end\":\"20:00\"}}'),(5,'ali','vet edited',5.0,0,'uploads/doctors/6a63b90c61a3d_doctor kitty.jpeg',600000,'2026-07-23 20:35:20',3,NULL,NULL),(7,'کاربر تستی OAuth','عمومی',5.0,0,NULL,450000,'2026-07-25 04:18:37',6,'09194360331','{\"sat\":{\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"sun\":{\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"tue\":{\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"wed\":{\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"thu\":{\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_start\":\"17:00\",\"a_end\":\"23:00\"},\"fri\":{\"m_start\":\"10:00\",\"m_end\":\"12:00\",\"a_start\":\"16:00\",\"a_end\":\"20:00\"}}');
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `attempt_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_purchase` int(11) NOT NULL,
  `product_name_snapshot` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,3,1,1,1980000,'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult'),(2,3,8,1,280000,'شامپو ضد ریزش موی سگ تریکسی'),(3,3,31,1,100000,'Cat Toy Mouse Updated'),(4,4,1,1,1980000,'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult'),(5,4,31,1,100000,'Cat Toy Mouse Updated');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_logs`
--

DROP TABLE IF EXISTS `order_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `old_status` varchar(50) NOT NULL,
  `new_status` varchar(50) NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_logs_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_logs`
--

LOCK TABLES `order_logs` WRITE;
/*!40000 ALTER TABLE `order_logs` DISABLE KEYS */;
INSERT INTO `order_logs` VALUES (1,2,'delivered','processing','2026-07-25 02:49:02'),(2,2,'processing','delivered','2026-07-25 02:49:07'),(3,1,'cancelled','pending_payment','2026-07-25 02:49:18'),(4,1,'pending_payment','processing','2026-07-25 02:49:24'),(5,1,'processing','shipped','2026-07-25 02:49:27'),(6,1,'shipped','delivered','2026-07-25 02:49:32'),(7,3,'processing','shipped','2026-07-25 13:01:51'),(8,4,'processing','shipped','2026-07-31 19:11:16'),(9,3,'shipped','delivered','2026-07-31 19:11:21');
/*!40000 ALTER TABLE `order_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `discount_amount` int(11) DEFAULT 0,
  `status` enum('pending_payment','processing','shipped','delivered','cancelled') DEFAULT 'pending_payment',
  `shipping_address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,6,5490000,0,'delivered',NULL,'2026-07-25 02:13:27'),(2,6,5490000,0,'delivered',NULL,'2026-07-25 02:18:18'),(3,7,2360000,0,'delivered',NULL,'2026-07-25 12:58:00'),(4,2,2080000,0,'shipped',NULL,'2026-07-31 19:10:57');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet_documents`
--

DROP TABLE IF EXISTS `pet_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet_documents`
--

LOCK TABLES `pet_documents` WRITE;
/*!40000 ALTER TABLE `pet_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `pet_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `brand` varchar(100) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 10,
  PRIMARY KEY (`id`),
  KEY `idx_products_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult','غذای سگ',2450000,1980000,'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0',NULL,'2026-07-21 13:23:55','شایر',8),(2,'کنسرو گربه گورمت گلد با طعم مرغ','غذای گربه',150000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0',NULL,'2026-07-21 13:23:55','جوسرا',10),(3,'قلاده چرمی سگ زولاکس سایز لارج','لوازم بهداشتی',850000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR',NULL,'2026-07-21 13:23:55','جوسرا',10),(4,'توپ دندانی طناب‌دار','اسباب‌بازی',220000,180000,'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR',NULL,'2026-07-21 13:23:55','جوسرا',10),(5,'خاک گربه پتوپیا ۱۰ کیلویی','لوازم بهداشتی',350000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj',NULL,'2026-07-21 13:23:55','رفلکس',10),(6,'قطره مولتی ویتامین سگ و گربه','مکمل دارویی',450000,390000,'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o',NULL,'2026-07-21 13:23:55','شایر',10),(7,'درخت گربه ۳ طبقه کدیپک','اسباب‌بازی',4200000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj',NULL,'2026-07-21 13:23:55','نوتری پت',10),(8,'شامپو ضد ریزش موی سگ تریکسی','لوازم بهداشتی',280000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o',NULL,'2026-07-21 13:23:55','رفلکس',9),(9,'غذای خشک گربه بالغ عقیم شده رویال کنین','غذای گربه',2850000,2600000,'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0',NULL,'2026-07-21 13:23:55','شایر',10),(10,'تشک خواب سگ سایز متوسط','لوازم بهداشتی',950000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj',NULL,'2026-07-21 13:23:55','رفلکس',10),(11,'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult','غذای سگ',2450000,1980000,'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0',NULL,'2026-07-21 13:23:55','جوسرا',10),(12,'کنسرو گربه گورمت گلد با طعم مرغ','غذای گربه',150000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0',NULL,'2026-07-21 13:23:55','رفلکس',10),(13,'قلاده چرمی سگ زولاکس سایز لارج','لوازم بهداشتی',850000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR',NULL,'2026-07-21 13:23:55','نوتری پت',10),(14,'توپ دندانی طناب‌دار','اسباب‌بازی',220000,180000,'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR',NULL,'2026-07-21 13:23:55','رویال کنین',10),(15,'خاک گربه پتوپیا ۱۰ کیلویی','لوازم بهداشتی',350000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj',NULL,'2026-07-21 13:23:55','شایر',10),(16,'قطره مولتی ویتامین سگ و گربه','مکمل دارویی',450000,390000,'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o',NULL,'2026-07-21 13:23:55','رویال کنین',10),(17,'درخت گربه ۳ طبقه کدیپک','اسباب‌بازی',4200000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj',NULL,'2026-07-21 13:23:55','رویال کنین',10),(18,'شامپو ضد ریزش موی سگ تریکسی','لوازم بهداشتی',280000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o',NULL,'2026-07-21 13:23:55','پت‌کر',10),(19,'غذای خشک گربه بالغ عقیم شده رویال کنین','غذای گربه',2850000,2600000,'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0',NULL,'2026-07-21 13:23:55','شایر',10),(20,'تشک خواب سگ سایز متوسط','لوازم بهداشتی',950000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj',NULL,'2026-07-21 13:23:55','رویال کنین',10),(21,'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult','غذای سگ',2450000,1980000,'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0',NULL,'2026-07-21 13:23:55','نوتری پت',10),(22,'کنسرو گربه گورمت گلد با طعم مرغ','غذای گربه',150000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0',NULL,'2026-07-21 13:23:55','رویال کنین',10),(23,'قلاده چرمی سگ زولاکس سایز لارج','لوازم بهداشتی',850000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR',NULL,'2026-07-21 13:23:55','رویال کنین',10),(24,'توپ دندانی طناب‌دار','اسباب‌بازی',220000,180000,'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR',NULL,'2026-07-21 13:23:55','رفلکس',10),(25,'خاک گربه پتوپیا ۱۰ کیلویی','لوازم بهداشتی',350000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj',NULL,'2026-07-21 13:23:55','رویال کنین',10),(26,'قطره مولتی ویتامین سگ و گربه','مکمل دارویی',450000,390000,'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o',NULL,'2026-07-21 13:23:55','رویال کنین',10),(27,'درخت گربه ۳ طبقه کدیپک','اسباب‌بازی',4200000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj',NULL,'2026-07-21 13:23:55','رفلکس',10),(28,'شامپو ضد ریزش موی سگ تریکسی','لوازم بهداشتی',280000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o',NULL,'2026-07-21 13:23:55','رفلکس',10),(29,'غذای خشک گربه بالغ عقیم شده رویال کنین','غذای گربه',2850000,2600000,'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0',NULL,'2026-07-21 13:23:55','رویال کنین',10),(30,'تشک خواب سگ سایز متوسط','لوازم بهداشتی',950000,NULL,'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj',NULL,'2026-07-21 13:23:55','رویال کنین',10),(31,'Cat Toy Mouse Updated','Toys',120000,100000,'assets/images/toy-mouse.jpg','Great toy for cats','2026-07-25 01:20:40','Test Brand',13);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_codes`
--

DROP TABLE IF EXISTS `promo_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `points_cost` int(11) NOT NULL,
  `is_used` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `promo_codes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_codes`
--

LOCK TABLES `promo_codes` WRITE;
/*!40000 ALTER TABLE `promo_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `target_type` enum('product','doctor') NOT NULL,
  `target_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,6,'product',31,5,'great product!','approved','2026-07-25 01:59:27');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_deliveries`
--

DROP TABLE IF EXISTS `subscription_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_id` int(11) NOT NULL,
  `delivery_month` int(11) NOT NULL,
  `scheduled_date` date DEFAULT NULL,
  `status` enum('pending','shipped','delivered','not_received') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `subscription_id` (`subscription_id`),
  CONSTRAINT `subscription_deliveries_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `user_subscriptions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_deliveries`
--

LOCK TABLES `subscription_deliveries` WRITE;
/*!40000 ALTER TABLE `subscription_deliveries` DISABLE KEYS */;
INSERT INTO `subscription_deliveries` VALUES (1,2,1,'2026-08-03','delivered'),(2,2,2,'2026-09-02','pending'),(3,2,3,'2026-10-02','pending'),(4,2,4,'2026-11-01','pending'),(5,2,5,'2026-12-01','pending'),(6,2,6,'2026-12-31','pending');
/*!40000 ALTER TABLE `subscription_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_logs`
--

DROP TABLE IF EXISTS `subscription_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_id` int(11) NOT NULL,
  `old_status` enum('pending_payment','processing','shipped','delivered','cancelled') DEFAULT NULL,
  `new_status` enum('pending_payment','processing','shipped','delivered','cancelled') NOT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `subscription_id` (`subscription_id`),
  CONSTRAINT `subscription_logs_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `user_subscriptions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_logs`
--

LOCK TABLES `subscription_logs` WRITE;
/*!40000 ALTER TABLE `subscription_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `frequency_days` int(11) NOT NULL,
  `next_delivery_date` date NOT NULL,
  `status` enum('active','paused','cancelled') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_messages`
--

DROP TABLE IF EXISTS `ticket_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `sender_type` enum('user','ai','admin') NOT NULL,
  `message` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  CONSTRAINT `ticket_messages_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_messages`
--

LOCK TABLES `ticket_messages` WRITE;
/*!40000 ALTER TABLE `ticket_messages` DISABLE KEYS */;
INSERT INTO `ticket_messages` VALUES (1,1,'ai','سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟',NULL,'2026-07-31 12:31:35'),(2,2,'admin','درخواست شما ثبت شد. یکی از کارشناسان ما به زودی پاسخگوی شما خواهد بود.',NULL,'2026-07-31 12:31:51'),(3,1,'user','hi',NULL,'2026-07-31 12:51:15'),(4,1,'ai','خطا در برقراری ارتباط با مغز لئو.',NULL,'2026-07-31 12:51:17'),(5,2,'user','hello',NULL,'2026-07-31 12:51:31'),(6,2,'admin','hi',NULL,'2026-07-31 12:51:45'),(7,2,'admin','what is the problem with your pet',NULL,'2026-07-31 12:52:01'),(8,2,'user','hi',NULL,'2026-07-31 13:04:41');
/*!40000 ALTER TABLE `ticket_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mode` enum('ai','admin') DEFAULT 'admin',
  `status` enum('open','closed','resolved') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_tickets_status` (`status`),
  CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,2,'ai','open','2026-07-31 12:31:35','2026-07-31 12:31:35'),(2,2,'admin','open','2026-07-31 12:31:51','2026-07-31 12:31:51');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_pets`
--

DROP TABLE IF EXISTS `user_pets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `race` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(20) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_pets`
--

LOCK TABLES `user_pets` WRITE;
/*!40000 ALTER TABLE `user_pets` DISABLE KEYS */;
INSERT INTO `user_pets` VALUES (1,2,'joei','سگ','germenshepert','2026-07-23 11:51:15','نر','8'),(3,2,'pisi','گربه','persian','2026-07-23 13:41:51','ماده','2'),(4,5,'Bobby2','سگ','Husky','2026-07-25 01:35:21',NULL,NULL),(5,7,'dogie','سگ','bulldog','2026-07-25 12:32:50',NULL,NULL);
/*!40000 ALTER TABLE `user_pets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_subscriptions`
--

DROP TABLE IF EXISTS `user_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` enum('active','ended','cancelled') DEFAULT 'active',
  `next_delivery_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_user_subs_status` (`status`),
  CONSTRAINT `user_subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_subscriptions`
--

LOCK TABLES `user_subscriptions` WRITE;
/*!40000 ALTER TABLE `user_subscriptions` DISABLE KEYS */;
INSERT INTO `user_subscriptions` VALUES (2,2,'اشتراک ۶ ماهه',2100000,'active','2026-08-03','2026-07-31 19:08:06');
/*!40000 ALTER TABLE `user_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sms_code` varchar(10) DEFAULT NULL,
  `role` enum('user','admin','doctor') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) DEFAULT NULL,
  `pet_type` varchar(50) DEFAULT NULL,
  `pet_race` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `loyalty_points` int(11) DEFAULT 0,
  `last_monthly_points_date` date DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `apple_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `phone_2` (`phone`),
  UNIQUE KEY `google_id` (`google_id`),
  UNIQUE KEY `apple_id` (`apple_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'09123456789','مدیر سیستم',NULL,'admin','2026-07-21 13:23:55',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,20,'2026-07-25',NULL,NULL),(2,'096154654','ayhan edited',NULL,'admin','2026-07-21 17:16:18','$2y$10$wQ/UJ0eAxhmzvST6hlmYaOuNu/jWLHjPytzydJbiEit.l3.ZOx1D.',NULL,NULL,'mehrzad.ayhan@gmail.com','','','',38.07195846,46.23498291,200,'2026-07-23',NULL,NULL),(3,'doctor@gmail.com','ali',NULL,'doctor','2026-07-23 19:19:04','$2y$10$cseRCBybswwGyndV1Z4s6OqWMRgp5YK2l54SE2MzJgPYnczSIsLKO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,70,'2026-07-23',NULL,NULL),(4,'09990999','akbar nami',NULL,'doctor','2026-07-23 19:21:54','$2y$10$GqI3ekTbgb9F8IiomfpCmec32eUnAJaSTwIsfTuJacVzTL7UJGcWu',NULL,NULL,'nami.akbar@gmail.com',NULL,NULL,'',NULL,NULL,0,'2026-07-23',NULL,NULL),(5,'09000000001','test user',NULL,'user','2026-07-25 01:33:28','$2y$10$qIF//jFhW3RAys4qL31UoORnmBRDO8ghsGa.7LgCmdgw8f4t5MOne',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,90,'2026-07-25',NULL,NULL),(6,'09194360331','کاربر تستی OAuth',NULL,'admin','2026-07-25 01:57:34',NULL,NULL,NULL,'',NULL,NULL,'',NULL,NULL,90,'2026-07-25','mock_123456',NULL),(7,'user.user@gmail.com','user.user',NULL,'user','2026-07-25 12:07:59','$2y$10$NRVKFcOVP96F.KVePQwFlec1FgVGLNge/J9FjoSTVYnSzVJmGZM6m',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,120,'2026-07-25',NULL,NULL),(8,'user.admin@gmail.com','user.admin',NULL,'admin','2026-07-25 12:59:15','$2y$10$eOfr0iUrovwG7ALhRvEijeLquk3DZ9RxP64GhHFPDWD8I1zZlqryy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,70,'2026-07-25',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_product` (`user_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` VALUES (1,6,31,'2026-07-25 01:58:06'),(2,6,2,'2026-07-25 02:31:06'),(3,7,31,'2026-07-25 12:08:41');
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-31 22:31:01
