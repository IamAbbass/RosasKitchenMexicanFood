/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.10-MariaDB : Database - rosa_dashboard
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`business_id`,`title`,`type`,`amount`,`details`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,1,'Rosa','Cash',0,'Cash In Hand',1,'1','2021-07-14 16:10:25','2021-07-14 16:10:25');

/*Table structure for table `activities` */

DROP TABLE IF EXISTS `activities`;

CREATE TABLE `activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uri` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activities` */

/*Table structure for table `badges` */

DROP TABLE IF EXISTS `badges`;

CREATE TABLE `badges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badges_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `badges` */

insert  into `badges`(`id`,`business_id`,`name`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,1,'Hurry up, selling fast',1,'1','2021-07-15 13:52:12','2021-07-15 13:52:12'),(2,1,'Limited quantity',1,'1','2021-07-15 13:52:19','2021-07-15 13:52:19'),(3,1,'10kg sold today',1,'1','2021-07-15 13:52:34','2021-07-15 13:52:34'),(4,1,'Max orders ♥',1,'1','2021-07-15 13:52:55','2021-07-15 13:52:55'),(5,1,'Max discount ♥',1,'1','2021-07-15 13:54:20','2021-09-25 09:43:42'),(6,1,'Top Selling',1,'1','2021-07-15 13:54:31','2021-07-15 13:54:31'),(7,1,'Top Reviewed',1,'1','2021-07-15 13:54:53','2021-07-15 13:54:53');

/*Table structure for table `businesses` */

DROP TABLE IF EXISTS `businesses`;

CREATE TABLE `businesses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'icon.png',
  `fcm_icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fcm_icon.png',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image.png',
  `fcm_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fcm_image.png',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ntn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_order` int(11) NOT NULL DEFAULT 300,
  `is_gift` tinyint(1) NOT NULL DEFAULT 0,
  `off_note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Due to the inclement weather, We are temporary closed',
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0,0',
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'light-theme',
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `businesses` */

insert  into `businesses`(`id`,`icon`,`fcm_icon`,`image`,`fcm_image`,`name`,`slogan`,`phone`,`website`,`email`,`address`,`facebook`,`instagram`,`youtube`,`twitter`,`ntn`,`strn`,`min_order`,`is_gift`,`off_note`,`location`,`theme`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,'icon.png','fcm_icon.png','default.png','fcm_image.png','Rosa','Rosa\'s Kitchen Mexican Food','923022203204','https://rosa.com','info@rosa.com','Karachi, Pakistan','https://www.facebook.com/rosa','https://www.instagram.com/rosa','https://www.youtube.com/channel/rosa','https://twitter.com/rosa','0','0',300,1,'Sorry, we\'re closed','24.915857, 67.125187','light-theme',1,'1','2021-07-19 02:03:25','2021-10-06 23:55:31');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_id` int(11) NOT NULL DEFAULT 0,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`business_id`,`image`,`name`,`sub_id`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,1,'default.png','Vegetable',0,1,'1','2021-07-14 16:08:39','2021-07-14 16:08:39'),(2,1,'default.png','Fruits',0,1,'1','2021-09-29 01:02:27','2021-09-29 01:02:27');

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imei` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `android_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `psid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_profile_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `township_id` int(11) DEFAULT NULL,
  `town_id` int(11) DEFAULT NULL,
  `device_token` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

/*Table structure for table `deliveries` */

DROP TABLE IF EXISTS `deliveries`;

CREATE TABLE `deliveries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `free_delivery_after` int(11) NOT NULL DEFAULT 300,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `deliveries` */

insert  into `deliveries`(`id`,`business_id`,`name`,`amount`,`free_delivery_after`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,1,'Free Delivery',0,300,0,'1','2021-09-27 02:54:22','2021-09-27 02:54:22'),(2,1,'Deliver Charges',49,700,1,'1','2021-09-27 02:54:22','2021-09-27 02:54:22');

/*Table structure for table `expenses` */

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `head_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `expenses` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `fcms` */

DROP TABLE IF EXISTS `fcms`;

CREATE TABLE `fcms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fcms` */

/*Table structure for table `fixes` */

DROP TABLE IF EXISTS `fixes`;

CREATE TABLE `fixes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fixes` */

/*Table structure for table `heads` */

DROP TABLE IF EXISTS `heads`;

CREATE TABLE `heads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `heads` */

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Confirmed','Preparing','Pick-Up','Arrived','Delivered','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Confirmed',
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `messages` */

insert  into `messages`(`id`,`business_id`,`type`,`status`,`icon`,`title`,`message`,`record_by`,`created_at`,`updated_at`) values (1,1,'Notification','Confirmed','default.png','Order Confirmed','Your Order ORDER_NO is confirmed.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(2,1,'Notification','Preparing','default.png','Order Prepairing','We\'re preparing your order ORDER_NO.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(3,1,'Notification','Pick-Up','default.png','Order Picked Up','Your Rosa\'s order ORDER_NO is on its way.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(4,1,'Notification','Arrived','default.png','Order Arrived','Our rider has now arrived at your location.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(5,1,'Notification','Delivered','default.png','Order Delivered','Your Order ORDER_NO is delivered.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(6,1,'Notification','Cancelled','default.png','Order Cancelled','Your Order ORDER_NO is cancelled.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(7,1,'SMS','Confirmed','default.png','Order Confirmed','Your Order ORDER_NO is confirmed.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(8,1,'SMS','Preparing','default.png','Order Prepairing','We\'re preparing your order ORDER_NO , Our rider will pick it up once it\'s ready.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(9,1,'SMS','Pick-Up','default.png','Order Picked Up','Your Rosa\'s order ORDER_NO is on its way. Your order amount is PKR ORDER_AMOUNT & payable in PAYMENT_METHOD. For any further assistance, please contact us at SABZIFY_SUPPORT or call at SABZIFY_PHONE.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(10,1,'SMS','Arrived','default.png','Order Arrived','Our rider has now arrived at your location with your SABZIFY order ORDER_NO. Your order amount is PKR ORDER_AMOUNT & payable in PAYMENT_METHOD.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(11,1,'SMS','Delivered','default.png','Order Delivered','Your Order ORDER_NO is delivered, For any queries about your order please contact us at SABZIFY_SUPPORT or call at SABZIFY_PHONE.','1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(12,1,'SMS','Cancelled','default.png','Order Cancelled','Your Order ORDER_NO is cancelled, For any queries about your order please contact us at SABZIFY_SUPPORT or call at SABZIFY_PHONE.','1','2021-07-19 02:03:25','2021-07-19 02:03:25');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_04_12_114232_create_customers_table',1),(5,'2021_04_12_115605_create_suppliers_table',1),(6,'2021_04_12_122034_create_businesses_table',1),(7,'2021_04_18_153806_create_roles_table',1),(8,'2021_04_18_175054_create_expenses_table',1),(9,'2021_04_18_210317_create_accounts_table',1),(10,'2021_04_18_215329_create_heads_table',1),(11,'2021_06_16_074725_create_transactions_table',1),(12,'2021_06_23_095440_create_fixes_table',1),(13,'2021_07_10_160800_create_categories_table',1),(14,'2021_07_10_181349_create_units_table',1),(15,'2021_07_10_184419_create_products_table',1),(16,'2021_07_10_194703_create_badges_table',1),(17,'2021_07_11_201926_create_deliveries_table',1),(18,'2021_07_11_201945_create_orders_table',1),(19,'2021_07_11_202040_create_order_details_table',1),(20,'2021_07_12_211658_create_messages_table',1),(21,'2021_07_15_135938_create_order_times_table',1),(22,'2021_07_19_003618_create_riders_table',1),(23,'2021_07_20_222801_add_min_order_to_businesses_table',1),(24,'2021_07_20_225204_add_off_note_to_businesses_table',1),(25,'2021_07_21_003441_add_is_gift_to_businesses_table',1),(26,'2021_07_22_143919_add_is_gift_to_orders_table',1),(27,'2021_07_25_152531_create_activities_table',1),(28,'2021_07_28_013110_add_icon_to_messages_table',1),(29,'2021_07_28_013131_add_title_to_messages_table',1),(30,'2021_08_23_130019_add_location_to_businesses_table',1),(31,'2021_09_14_151741_add_theme_to_businesses_table',1),(32,'2021_09_20_170349_add_purchase_to_order_details_table',1),(33,'2021_09_22_162115_create_fcms_table',1),(34,'2021_09_22_162142_create_whats_apps_table',1),(35,'2021_09_22_162324_create_sms_table',1),(36,'2021_09_11_131602_create_marketings_table',2),(37,'2021_09_25_103707_add_whatsapp_to_suppliers_table',3),(38,'2021_09_27_014915_add_free_delivery_after_to_deliveries_table',4),(39,'2021_10_03_015827_add_received_to_orders_table',5),(40,'2021_10_03_020237_add_change_return_to_orders_table',5),(41,'2021_10_06_003125_add_wallet_debit_to_orders_table',5),(42,'2021_10_06_012338_add_wallet_credit_to_orders_table',5),(43,'2021_10_06_140800_add_slogan_to_businesses_table',5),(44,'2021_10_06_142735_add_facebook_to_businesses_table',5),(45,'2021_10_06_142756_add_instagram_to_businesses_table',5),(46,'2021_10_06_142809_add_youtube_to_businesses_table',5),(47,'2021_10_06_142836_add_twitter_to_businesses_table',5),(48,'2021_10_06_145550_add_icon_to_businesses_table',5),(49,'2021_10_06_155907_add_website_to_businesses_table',5),(50,'2021_10_06_155931_add_fcm_icon_to_businesses_table',5),(51,'2021_10_06_155943_add_fcm_image_to_businesses_table',5),(52,'2021_11_04_104729_add_sub_id_to_categories_table',6);

/*Table structure for table `order_details` */

DROP TABLE IF EXISTS `order_details`;

CREATE TABLE `order_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase` int(11) NOT NULL DEFAULT 0,
  `sale` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_details` */

/*Table structure for table `order_times` */

DROP TABLE IF EXISTS `order_times`;

CREATE TABLE `order_times` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_times` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` enum('COD','Debit Card','Credit Card') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COD',
  `received` int(11) NOT NULL DEFAULT 0,
  `change_return` int(11) NOT NULL DEFAULT 0,
  `wallet_debit` int(11) NOT NULL DEFAULT 0,
  `wallet_credit` int(11) NOT NULL DEFAULT 0,
  `payment_status` enum('Paid','Unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `delivery_id` int(11) DEFAULT NULL,
  `is_gift` tinyint(1) NOT NULL DEFAULT 0,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rider_id` int(11) DEFAULT NULL,
  `dated` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ru` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('China') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `badge_id` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `purchase` int(11) NOT NULL,
  `purchased_qty` int(11) NOT NULL,
  `purchased_unit` int(11) NOT NULL,
  `sale` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `dated` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_highlight` tinyint(1) NOT NULL DEFAULT 0,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  UNIQUE KEY `products_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`business_id`,`sku`,`image`,`name`,`name_ur`,`name_ru`,`type`,`category_id`,`unit_id`,`supplier_id`,`badge_id`,`account_id`,`purchase`,`purchased_qty`,`purchased_unit`,`sale`,`discount`,`dated`,`description`,`note`,`is_highlight`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,1,'RKMF00041','default.png','Peas','مٹر','Matar',NULL,1,2,4,NULL,1,100,0,2,104,0,'1636000511','Peas are a good source of vitamins C and E, zinc, and other antioxidants that strengthen your immune system. Other nutrients, such as vitamins A and B and coumestrol, help reduce inflammation and lower your risk of chronic conditions, including diabetes, heart disease, and arthritis.',NULL,0,1,'1',NULL,'2021-11-04 09:35:11'),(2,1,'RKMF00040','default.png','Onion','پیاز','Piyaz',NULL,1,1,4,5,1,60,0,1,69,0,'1636000536','The onion, also known as the bulb onion or common onion, is a vegetable that is the most widely cultivated species of the genus Allium. The shallot is a botanical variety of the onion. Until 2010, the shallot was classified as a separate species','Onion 20Kg Bag: Rs.750 (37.5/Kg)\r\nAfter Wastage: 40/Kg',1,1,'1',NULL,'2021-11-04 09:35:36'),(3,1,'RKMF00043','default.png','Potato','آلو','Alu',NULL,1,5,4,2,1,40,0,5,48,0,'1636000543','Potatoes are a good source of fiber, which can help you lose weight by keeping you full longer. Fiber can help prevent heart disease by keeping cholesterol and blood sugar levels in check. Potatoes are also full of antioxidants that work to prevent diseases and vitamins that help your body function properly.','Potato 10kg:  Rs.280 (28/Kg)\r\nAfter Wastage: 30/Kg',1,1,'1',NULL,'2021-11-04 09:35:43'),(4,1,'RKMF00055','default.png','Tomato','ٹماٹر','Timatar',NULL,1,5,4,5,1,100,0,5,100,0,'1636000551','Tomatoes are the major dietary source of the antioxidant lycopene, which has been linked to many health benefits, including reduced risk of heart disease and cancer. They are also a great source of vitamin C, potassium, folate, and vitamin K.','Tomato 15kg Box: Rs.450 (30/Kg)\r\nAfter Wastage 35/Kg',1,1,'1',NULL,'2021-11-04 09:35:51'),(5,1,'RKMF00019','default.png','Cucumber','کھیرا','Kheera',NULL,1,5,4,NULL,1,40,0,5,48,0,'1636000560','Cucumbers are rich in electrolytes. They can prevent dehydration and may support cardiovascular, bone, and skin health and help fight diabetes and cancer.',NULL,1,1,'1',NULL,'2021-11-04 09:36:00'),(6,1,'RKMF00027','default.png','Green Chilli German','ہری مرچ','Hari Mirach',NULL,1,2,4,NULL,1,40,0,2,44,0,'1636000570','Chilies are known to be a rich source of antioxidants. Vitamins- A, B complex (B6 and B9), and C are found in abundance in green chilies. This compensates the damaging effects of bacteria in our bodies and is very helpful in preventing blood clots which is the primary reason for multiple cardiovascular diseases like heart stroke and cardiac arrest. Furthermore, helps in thwarting the spread of cancer to the colon, prostate, and lungs.',NULL,0,1,'1',NULL,'2021-11-04 09:36:10'),(7,1,'RKMF00025','default.png','Ginger','ادرک','Adrak',NULL,1,2,4,NULL,1,100,0,2,104,0,'1636000577','Certain chemical compounds in fresh ginger help your body ward off germs. They’re especially good at halting growth of bacteria like E.coli and shigella, and they may also keep viruses like RSV at bay.',NULL,0,1,'1',NULL,'2021-11-04 09:36:17'),(8,1,'RKMF00028','default.png','Green Coriander','ہرا دھنیا','Dhanya',NULL,1,3,4,NULL,1,15,0,3,20,0,'1636000583','Coriander or cilantro is a wonderful source of dietary fiber, manganese, iron and magnesium as well.\r\nIn addition, coriander leaves are rich in Vitamin C, Vitamin K and protein. They also contain small amounts of calcium, phosphorous, potassium, thiamin, niacin and carotene','Mandi Rate 100/Kg',1,1,'1',NULL,'2021-11-04 09:36:23'),(9,1,'RKMF00022','default.png','Garlic China','لہسن چائنا','Lassan','China',1,2,4,NULL,1,80,0,2,84,0,'1636000589','Garlic (Allium sativum), is used widely as a flavoring in cooking, but it has also been used as a medicine throughout ancient and modern history; it has been taken to prevent and treat a wide range of conditions and diseases.',NULL,1,1,'1',NULL,'2021-11-04 09:36:29'),(10,1,'RKMF00038','default.png','Mint','پودینہ','Podina',NULL,1,3,4,NULL,1,10,0,3,20,0,'1636000593','Mint is a calming herb that people have used for thousands of years to help soothe an upset stomach or indigestion.',NULL,1,1,'1',NULL,'2021-11-04 09:36:33'),(11,1,'RKMF00033','default.png','Lady Finger','بھنڈی','Bhendi',NULL,1,2,4,NULL,1,40,0,2,44,0,'1636000599','This gooey green vegetable is equally loved and hated for its taste and texture, but it is rich in fibre and other nutrients like vitamin A, B, and C with other minerals. Read on to find out more.',NULL,1,1,'1',NULL,'2021-11-04 09:36:39'),(12,1,'RKMF00035','default.png','Lemon Desi','لیموں دیسی','Lemu Desi',NULL,1,2,4,NULL,1,80,0,2,84,0,'1636000606','Lemons are a rich source of vitamin C, a powerful antioxidant. In fact, one squeezed lemon provides around 21% of a person\'s daily value (DV).',NULL,1,1,'1',NULL,'2021-11-04 09:36:46'),(13,1,'RKMF00011','default.png','Cabbage','بند گوبهی','Band Gobi',NULL,1,5,4,NULL,1,50,0,5,58,0,'1636000613','Cabbage, especially red cabbage, seems to raise levels of beta-carotene, lutein, and other heart-protective antioxidants. It also helps lower something called “oxidized” LDL, which is linked to hardening of the arteries. And since it eases inflammation, it can help prevent heart disease',NULL,0,1,'1',NULL,'2021-11-04 09:36:53'),(14,1,'RKMF00006','default.png','Brinjal Long','بینگن لمبا','Baingan Lamby',NULL,1,5,4,4,1,40,0,5,48,0,'1636000623','Brinjal lovers! can reduce your risk of heart disease and diabetes\r\nHigh in antioxidants.\r\nHelps to reduce risk of heart disease.\r\nHelps control blood sugar levels.\r\nPromotes weight loss.',NULL,1,1,'1',NULL,'2021-11-04 09:37:03'),(15,1,'RKMF00014','default.png','Carrot Red','گاجر سرخ','Gajar  Laal',NULL,1,2,4,6,1,40,0,2,44,0,'1636000636','The fiber in carrots can help keep blood sugar levels under control. And they\'re loaded with vitamin A and beta-carotene, which there\'s evidence to suggest can lower your diabetes risk. They can strengthen your bones. Carrots have calcium and vitamin K, both of which are important for bone health.',NULL,0,1,'1',NULL,'2021-11-04 09:37:16'),(16,1,'RKMF00015','default.png','Cauliflower','گوبھی','Phool Gobi',NULL,1,5,4,2,1,60,0,5,68,0,'1636000646','Eating more plant foods, such as cauliflower, has been found to decrease the risk of obesity, diabetes, heart disease, and overall mortality while promoting a healthy complexion, increased energy, and overall lower weight.',NULL,1,1,'1',NULL,'2021-11-04 09:37:26'),(17,1,'RKMF00029','default.png','Green Spring Onion','ہری پیاز','Hari Piyaz',NULL,1,2,4,NULL,1,40,0,2,44,0,'1636000665','Spring onions are rich in Vitamin C, Vitamin B2 and thiamine. Apart from that, they also contain Vitamin A and Vitamin K. They make good sources of elements like copper, phosphorous, magnesium, potassium, chromium, manganese and fibre.',NULL,0,1,'1',NULL,'2021-11-04 09:37:45'),(18,1,'RKMF00003','default.png','Bitter gourd','کریلا','Karaily',NULL,1,5,4,NULL,1,60,0,5,68,0,'1636000671','Bitter gourd acts as a hypoglycemic agent. It is rich source of soluble fiber and is low in glycemic index, which helps in lowering the blood sugar level. It is an excellent source of dietary fiber. Regular consumption of bitter gourd contributes to relieving constipation and indigestion.','Rs.2000/Man',1,1,'1',NULL,'2021-11-04 09:37:51'),(19,1,'RKMF00036','default.png','Green Lettuce Leaves','سلاد پتے','Salad ka Patty',NULL,1,2,4,NULL,1,60,0,2,64,0,'1636000676','Lettuce is particularly rich in antioxidants like vitamin C and other nutrients like vitamins A and K and potassium. This leafy green veggie helps fight inflammation and other related diseases like diabetes and cancer. The benefits only get better if you use the Romaine variety of lettuce, as not all lettuce is created equal. Also, the darker the lettuce, the more nutrient-dense it is.',NULL,0,1,'1',NULL,'2021-11-04 09:37:56'),(20,1,'RKMF00002','default.png','Beetroot','چقندر','Chukandar',NULL,1,5,4,NULL,1,40,0,5,48,0,'1636000687','Beetroots are a great source of fiber, folate (vitamin B9), manganese, potassium, iron, and vitamin C.\r\nBeetroots and beetroot juice have been associated with numerous health benefits, including improved blood flow, lower blood pressure, and increased exercise performance.',NULL,0,1,'1',NULL,'2021-11-04 09:38:07'),(21,1,'RKMF00053','default.png','Spinach','پالک','Palak',NULL,1,1,4,NULL,1,50,0,1,62,0,'1636000697','Spinach is a superstar among green leafy vegetables. This low-calorie food is full of nutrients that are good for your body in several ways. From boosting the immune system -- your body\'s defense against germs -- to helping your heart, its advantages might surprise you.',NULL,0,1,'1',NULL,'2021-11-04 09:38:17'),(22,1,'RKMF00056','default.png','Turnip','شلجم','Shaljam',NULL,1,2,4,NULL,1,30,0,2,34,0,'1636000706','Turnips are loaded with fiber and vitamins K, A, C, E, B1, B3, B5, B6, B2 and folate (one of the B vitamins), as well as minerals like manganese, potassium, magnesium, iron, calcium and copper. They are also a good source of phosphorus, omega-3 fatty acids and protein.',NULL,0,1,'1',NULL,'2021-11-04 09:38:26'),(23,1,'RKMF00051','default.png','Ridged Gourd - Luffa','توری','Torai',NULL,1,5,4,NULL,1,60,0,5,68,0,'1636000712','Like cucumbers, ridge gourd has very high moisture content. The fruit is also rich in dietary fiber, while extremely low in saturated fats',NULL,1,1,'1',NULL,'2021-11-04 09:38:32'),(24,1,'RKMF00042','default.png','Kiwi','کیوی','Kiwi',NULL,2,1,5,NULL,1,400,0,1,450,0,'1636000748','The kiwifruit possesses properties that lower blood pressure. By helping to maintain a healthy blood pressure and providing a boost of Vitamin C, the kiwifruit can reduce the risk of stroke and heart disease. Beyond this, kiwi also contains a high level of dietary fiber.',NULL,1,1,'1',NULL,'2021-11-04 09:39:08'),(25,1,'RKMF00054','default.png','Sweet Potatoes','شکر قندی','Shakar Kandi',NULL,1,5,4,NULL,1,80,0,5,88,0,'1636000795','Sweet potatoes are a rich source of fibre as well as containing an array of vitamins and minerals including iron, calcium, selenium, and they\'re a good source of most of our B vitamins and vitamin C.',NULL,0,1,'1',NULL,'2021-11-04 09:39:55'),(26,1,'RKMF00004','default.png','Bottle Gourd Long','لوکی لمبا','Looki',NULL,1,5,4,NULL,1,60,0,5,68,0,'1636000835','Bottle gourd is a vegetable high on water and is a rich source of vitamin C, K and calcium. It helps in maintaining a healthy heart and brings down bad cholesterol levels. The juice is also beneficial for diabetic patients as it stabilizes the blood sugar level and maintains blood pressure.',NULL,1,1,'1',NULL,'2021-11-04 09:40:35'),(27,1,'RKMF00013','default.png','Capsicum Green','شملہ مرچ','Shimla Mirch',NULL,1,5,4,4,1,70,0,5,78,0,'1636000853','Capsicums are incredibly nutritious. They contain antioxidants called carotenoids that may reduce inflammation.',NULL,0,1,'1',NULL,'2021-11-04 09:40:53'),(28,1,'RKMF00047','default.png','Raw Papaya','کچا پپیتے','Kacha Papita',NULL,1,5,4,NULL,1,40,0,5,48,0,'1636000879','Raw papaya can help you cleanse your body and improve digestion. It contains enzymes like papain which helps in promoting the secretion of gastric acids for digestion. Also, this nutrient helps our gut bacteria and keeps the stomach toxin-free.',NULL,0,1,'1',NULL,'2021-11-04 09:41:19'),(29,1,'RKMF00030','default.png','Pomegranate','انار','Anaar',NULL,2,4,5,NULL,1,250,0,4,299,0,'1636000901','The juice of a single pomegranate has more than 40 percent of your daily requirement of vitamin C. Vitamin C can be broken down when pasteurized, so opt for homemade or fresh pomegranate juice to get the most of the nutrient.',NULL,1,1,'1',NULL,'2021-11-04 09:41:41'),(30,1,'RKMF00045','default.png','Pumpkin','کدو','Kadu',NULL,1,4,4,NULL,1,250,0,4,299,0,'1636000913','In addition to beta carotene, pumpkins offer vitamin C, vitamin E, iron, and folate -- all of which strengthen your immune system. More pumpkin in your diet can help your immune cells work better to ward off germs and speed healing when you get a wound.',NULL,0,0,'1',NULL,'2021-11-04 09:41:53'),(31,1,'RKMF00008','default.png','Brinjal Round','گول بینگن','Gool Baingan',NULL,1,5,4,NULL,1,40,0,5,48,0,'1636000927','Brinjal lovers! can reduce your risk of heart disease and diabetes\r\nHigh in antioxidants.\r\nHelps to reduce risk of heart disease.\r\nHelps control blood sugar levels.\r\nPromotes weight loss.',NULL,1,1,'1',NULL,'2021-11-04 09:42:07'),(32,1,'RKMF00001','default.png','Apple Gourd (Round)','ٹنڈه','Tinday',NULL,1,5,4,NULL,1,150,0,5,158,0,'1636002131','Apple Gourd - Tinda is being eaten to a great extent nowadays and not just in its native milieus in Asia and Australia. The crop is, in fact, naturalized and propagated all over the world in tropical environments, so that people can procure its marvellous merits, for complete wellness.',NULL,1,1,'1',NULL,'2021-11-04 10:02:11'),(33,1,'RKMF00037','default.png','Lotus Root','بھ','Beeh',NULL,1,5,4,NULL,1,60,0,5,64,0,'1636001002','Lotus root is full of important nutrients, minerals, and vitamins. It\'s an excellent source of fiber, which is important to regulate our blood sugar, improve digestion, and manage our appetite. It is also a great source of vitamin C, a powerful antioxidant.',NULL,0,0,'1',NULL,'2021-11-04 09:43:22'),(34,1,'RKMF00050','default.png','Red Potato','سرخ آلو','Laal Aalu',NULL,1,5,4,NULL,1,40,0,5,48,0,'1636001042','Potatoes are a good source of fiber, which can help you lose weight by keeping you full longer. Fiber can help prevent heart disease by keeping cholesterol and blood sugar levels in check. Potatoes are also full of antioxidants that work to prevent diseases and vitamins that help your body function properly.',NULL,1,1,'1',NULL,'2021-11-04 09:44:02'),(35,1,'RKMF00048','default.png','Red Capsicum','شملہ مرچ سرخ','Laal Shimla Mirch',NULL,1,4,4,NULL,1,250,0,4,299,0,'1636001069','Capsicums are incredibly nutritious. They contain antioxidants called carotenoids that may reduce inflammation.',NULL,0,1,'1',NULL,'2021-11-04 09:44:29'),(36,1,'RKMF00057','default.png','Yellow Capsicum','شملہ مرچ پیلا','Peela Shimla Mirch',NULL,1,4,4,NULL,1,250,0,4,299,0,'1636001089','Capsicums are incredibly nutritious. They contain antioxidants called carotenoids that may reduce inflammation.',NULL,0,1,'1',NULL,'2021-11-04 09:44:49'),(37,1,'RKMF00017','default.png','Colocasia','اروی','Arvi',NULL,1,5,4,NULL,1,50,0,5,58,0,'1636001117','Nutrition. Taro root is an excellent source of dietary fiber and good carbohydrates, which both improve the function of your digestive system and can contribute to healthy weight loss. Its high levels of vitamin C, vitamin B6, and vitamin E also help to maintain a healthy immune system and may eliminate free radicals.','Rs. 800/Man',0,1,'1',NULL,'2021-11-04 09:45:17'),(38,1,'RKMF00007','default.png','Brinjal Long (White)','لمبا بینگن','Baingan Gool (Safaid)',NULL,1,5,4,NULL,1,30,0,5,34,0,'1636001127','Brinjal lovers! can reduce your risk of heart disease and diabetes\r\nHigh in antioxidants.\r\nHelps to reduce risk of heart disease.\r\nHelps control blood sugar levels.\r\nPromotes weight loss.',NULL,1,0,'1',NULL,'2021-11-04 09:45:27'),(39,1,'RKMF00005','default.png','Bottle Gourd Round','لوکی گول','Looki Gool',NULL,1,5,4,NULL,1,60,0,5,68,0,'1636001156','Bottle gourd is a vegetable high on water and is a rich source of vitamin C, K and calcium. It helps in maintaining a healthy heart and brings down bad cholesterol levels. The juice is also beneficial for diabetic patients as it stabilizes the blood sugar level and maintains blood pressure.',NULL,1,1,'1',NULL,'2021-11-04 09:45:56'),(40,1,'RKMF00010','default.png','Broccoli','بروکولی','Broccoli',NULL,1,2,4,NULL,1,300,0,2,329,0,'1636001180','Broccoli is a good source of fibre and protein, and contains iron, potassium, calcium, selenium and magnesium as well as the vitamins A, C, E, K and a good array of B vitamins including folic acid.',NULL,0,1,'1',NULL,'2021-11-04 09:46:20'),(41,1,'RKMF00012','default.png','Cabbage Red','سرخ گوبھی','Laal Band Gobi',NULL,1,2,4,NULL,1,80,0,2,84,0,'1636001186','Cabbage, especially red cabbage, seems to raise levels of beta-carotene, lutein, and other heart-protective antioxidants. It also helps lower something called “oxidized” LDL, which is linked to hardening of the arteries. And since it eases inflammation, it can help prevent heart disease',NULL,0,0,'1',NULL,'2021-11-04 09:46:26'),(42,1,'RKMF00046','default.png','Radish','مولی','Mooli',NULL,1,5,4,NULL,1,40,0,5,48,0,'1636001215','Radishes are rich in antioxidants and minerals like calcium and potassium. Together, these nutrients help lower high blood pressure and reduce your risks for heart disease. The radish is also a good source of natural nitrates that improve blood flow.',NULL,0,1,'1',NULL,'2021-11-04 09:46:55'),(43,1,'RKMF00026','default.png','Green Chilli Small','ہری مرچ','Choti Hari Mirch',NULL,1,2,4,NULL,1,40,0,2,44,0,'1636001248','Chilies are known to be a rich source of antioxidants. Vitamins- A, B complex (B6 and B9), and C are found in abundance in green chilies. This compensates the damaging effects of bacteria in our bodies and is very helpful in preventing blood clots which is the primary reason for multiple cardiovascular diseases like heart stroke and cardiac arrest. Furthermore, helps in thwarting the spread of cancer to the colon, prostate, and lungs.',NULL,0,1,'1',NULL,'2021-11-04 09:47:28'),(44,1,'RKMF00018','default.png','Corn','مکئی','Makkai',NULL,1,5,4,NULL,1,30,0,5,38,0,'1636001266','Corn is rich in vitamin C, an antioxidant that helps protect your cells from damage and wards off diseases like cancer and heart disease. Yellow corn is a good source of the carotenoids lutein and zeaxanthin, which are good for eye health and help prevent the lens damage that leads to cataracts.',NULL,0,1,'1',NULL,'2021-11-04 09:47:46'),(45,1,'RKMF00020','default.png','Curry Leaf','کڑی پتہ','Curry Patta',NULL,1,3,4,NULL,1,10,0,3,20,0,'1636001299','Curry leaves are a rich source of vitamin A, vitamin B, vitamin C, vitamin B2, calcium, and iron, apart from a heavy distinctive odor and pungent taste. It helps in the treatment of dysentery, diarrhea, diabetes, morning sickness, and nausea by adding curry leaves to your meals.',NULL,0,1,'1',NULL,'2021-11-04 09:48:19'),(46,1,'RKMF00021','default.png','Fenugreek Leaves','میتھی پتے','Mathi Pattta',NULL,1,2,4,NULL,1,60,0,2,64,0,'1636001333','Fenugreek leaves are eaten in India as a vegetable. Fenugreek is taken by mouth for digestive problems such as loss of appetite, upset stomach, constipation, inflammation of the stomach (gastritis). Fenugreek is also used for diabetes, painful menstruation, polycystic ovary syndrome, and obesity.',NULL,0,1,'1',NULL,'2021-11-04 09:48:53'),(47,1,'RKMF00023','default.png','Garlic Desi','لہسن دیسی','Lassan Desi',NULL,1,2,4,NULL,1,80,0,2,84,0,'1636001374','Garlic (Allium sativum), is used widely as a flavoring in cooking, but it has also been used as a medicine throughout ancient and modern history; it has been taken to prevent and treat a wide range of conditions and diseases.',NULL,0,1,'1',NULL,'2021-11-04 09:49:34'),(48,1,'RKMF00024','default.png','Garlic Peeled','چھیلا لہسن','Lassan Chilli Hue',NULL,1,2,4,NULL,1,100,0,2,104,0,'1636001395','Garlic (Allium sativum), is used widely as a flavoring in cooking, but it has also been used as a medicine throughout ancient and modern history; it has been taken to prevent and treat a wide range of conditions and diseases.',NULL,0,1,'1',NULL,'2021-11-04 09:49:55'),(49,1,'RKMF00016','default.png','Cluster Beans','گوار پھلیاں','Guar Phali',NULL,1,5,4,NULL,1,80,0,5,88,0,'1636001428','Cluster beans contain calcium and phosphorous, both of which help to strengthen your bones. These beans have laxative properties that improve your digestion and regulate your bowel movements. They also flush toxins from your system and help to prevent irritable bowel syndrome.',NULL,0,1,'1',NULL,'2021-11-04 09:50:28'),(50,1,'RKMF00031','default.png','Iceberg Lettuce','آئس برگ','Iceberg Salad',NULL,1,5,4,NULL,1,240,0,5,280,0,'1636001461','Although it\'s low in fiber, it has a high water content, making it a refreshing choice during hot weather. It also provides calcium, potassium, vitamin C, and folate. The nutrients in iceberg lettuce can help you to meet the standard daily requirements for several vitamins and minerals.',NULL,0,1,'1',NULL,'2021-11-04 09:51:01'),(51,1,'RKMF00034','default.png','Lemon China','چائنا لیموں','Lemu China','China',1,1,4,NULL,1,400,0,1,449,0,'1636001471','Lemons are a rich source of vitamin C, a powerful antioxidant. In fact, one squeezed lemon provides around 21% of a person\'s daily value (DV).',NULL,0,0,'1',NULL,'2021-11-04 09:51:11'),(52,1,'RKMF00039','default.png','Capsicum Orange','شملہ مرچ نارنگی','Orange Shimla Mirch',NULL,1,4,4,NULL,1,250,0,4,299,0,'1636001497','Capsicums are incredibly nutritious. They contain antioxidants called carotenoids that may reduce inflammation.',NULL,0,1,'1',NULL,'2021-11-04 09:51:37'),(53,1,'RKMF00044','default.png','Potato (New)','آلو نئی','Naya Alu',NULL,1,5,4,NULL,1,60,0,5,64,0,'1636001532','Potatoes are a good source of fiber, which can help you lose weight by keeping you full longer. Fiber can help prevent heart disease by keeping cholesterol and blood sugar levels in check. Potatoes are also full of antioxidants that work to prevent diseases and vitamins that help your body function properly.',NULL,0,1,'1',NULL,'2021-11-04 09:52:12'),(54,1,'RKMF00052','default.png','Soya','سویا','Soya',NULL,1,3,4,NULL,1,15,0,3,20,0,'1636001590','Soy contain antioxidants and phytonutrients that are linked to various health benefits.',NULL,0,1,'1',NULL,'2021-11-04 09:53:10'),(55,1,'RKMF00049','default.png','Red Chilli','سرخ مرچ','Laal Mirch',NULL,1,5,4,NULL,1,80,0,5,88,0,'1636001641','Chilies are known to be a rich source of antioxidants. Vitamins- A, B complex (B6 and B9), and C are found in abundance in green chilies. This compensates the damaging effects of bacteria in our bodies and is very helpful in preventing blood clots which is the primary reason for multiple cardiovascular diseases like heart stroke and cardiac arrest. Furthermore, helps in thwarting the spread of cancer to the colon, prostate, and lungs.',NULL,0,0,'1',NULL,'2021-11-04 09:54:01'),(56,1,'RKMF00009','default.png','Broad Bean','سیم پھلیاں','Sam Phalian',NULL,1,1,4,NULL,1,0,0,1,0,0,'1636001653','Broad beans are also rich in both folate and B vitamins, which we need for nerve and blood cell development, cognitive function and energy.',NULL,0,0,'1',NULL,'2021-11-04 09:54:13'),(57,1,'RKMF000057','default.png','Pear','ناشپاتی','Nashpati',NULL,2,1,5,NULL,1,300,0,1,319,0,'1636001665','A pear is a mild, sweet fruit with a fibrous center. Pears are rich in essential antioxidants, plant compounds, and dietary fiber. As part of a balanced, nutritious diet, consuming pears could support weight loss and reduce a person\'s risk of cancer, diabetes, and heart disease.',NULL,0,1,'1','2021-10-04 00:19:12','2021-11-04 09:54:25'),(58,1,'RKMF000058','default.png','Banana','کیلا','Kela',NULL,2,6,5,NULL,1,50,0,6,59,0,'1636001687','Vitamin B6 from bananas is easily absorbed by your body and a medium-sized banana can provide about a quarter of your daily vitamin B6 needs.',NULL,1,1,'1','2021-10-04 00:25:11','2021-11-04 09:54:47'),(59,1,'RKMF000059','default.png','Sweet Lime','مٹھا لیمو','Mitha',NULL,2,7,5,NULL,1,200,0,7,219,0,'1636001698','Citrus limetta, alternatively considered to be a cultivar of Citrus limon, C. limon \'Limetta\', is a species of citrus, commonly known as mousami, musami, sweet lime, sweet lemon, and sweet limetta, it is a member of the sweet lemons. It is small and round like a common lime in shape.',NULL,1,1,'1','2021-10-04 00:29:43','2021-11-04 09:54:58'),(60,1,'RKMF000060','default.png','Coconut','ناریل','Narial',NULL,2,4,5,NULL,1,190,0,4,209,0,'1636001722','Coconut is the fruit of the coconut palm (Cocos nucifera). It\'s used for its water, milk, oil, and tasty meat. Coconuts have been grown in tropical regions for more than 4,500 years but recently increased in popularity for their flavor, culinary uses, and potential health benefits',NULL,0,1,'1','2021-10-04 00:41:40','2021-11-04 09:55:22'),(61,1,'RKMF000061','default.png','Green Coconut','سبز ناریل','Sabz Narial',NULL,2,4,5,NULL,1,350,0,4,399,0,'1636001725','Green coconut is a young coconut that is not entirely brown and ripened. It is such a treat to enjoy this tropical delight as it is way sweeter than the regular coconut. It has tender meat than mature coconut and is prized for its refreshing and healthy water. You can eat its sweet, tender flesh or add to a protein shake for a perfect post-workout recovery drink. It keeps your body hydrated and energized.',NULL,0,1,'1','2021-10-04 00:45:07','2021-11-04 09:55:25'),(62,1,'RKMF000062','default.png','Apple Kalakullu','سیب کالاکولو','Saib Kalakullu',NULL,2,1,5,NULL,1,180,0,1,230,0,'1636001743','This crunchy, bright coloured fruit has a firm texture that helps satisfy your sweet tooth and makes you feel fuller longer. Can  be used it in fruit salads, pies, cakes, fruit custard, jams, and many other delicious dishes.',NULL,1,1,'1','2021-10-04 00:52:39','2021-11-04 09:55:43'),(63,1,'RKMF000063','default.png','Apple Green','سبز سیب','Sabz Saib',NULL,2,1,5,NULL,1,100,0,1,130,0,'1636001755','This green, crisp, and hard skin apple has a juicy flesh. Granny smith apple can be used in pies,  your breakfast with cereal,  muffins, slaw, juices, and pancakes.',NULL,1,1,'1','2021-10-04 00:56:39','2021-11-04 09:55:55'),(64,1,'RKMF000064','default.png','Apple Kajja','گاجا سیب','Kajja Saib',NULL,2,1,5,NULL,1,160,0,1,199,0,'1636001765','This bright coloured fruit has a firm texture that helps satisfy your sweet tooth and makes you feel fuller longer. Can  be used it in fruit salads, pies, cakes, fruit custard, jams, and many other delicious dishes.',NULL,1,1,'1','2021-10-04 01:00:14','2021-11-04 09:56:05'),(65,1,'RKMF000065','default.png','Grapes Green','سبز انگور','Sabz Angoor',NULL,2,2,5,NULL,1,100,0,2,119,0,'1636001770','A grape is a fruit, botanically a berry, of the deciduous woody vines of the flowering plant genus Vitis. Grapes can be eaten fresh as table grapes, used for making wine, jam, grape juice, jelly, grape seed extract, vinegar, and grape seed oil, or dried as raisins, currants and sultanas',NULL,1,1,'1','2021-10-04 01:03:57','2021-11-04 09:56:10'),(66,1,'RKMF000066','default.png','Papaya','پپیتا','Papita',NULL,2,1,5,NULL,1,150,0,1,169,0,'1636001774','The papaya, papaw, or pawpaw is the plant Carica papaya, one of the 22 accepted species in the genus Carica of the family Caricaceae. Its origin is in the tropics of the Americas, perhaps from Central America and southern Mexico.',NULL,0,1,'1','2021-10-04 01:09:15','2021-11-04 09:56:14'),(67,1,'RKMF000067','default.png','Grapes Red','سرخ انگور','Laal Angoor',NULL,2,2,5,NULL,1,120,120,2,159,0,'1635796123','A grape is a fruit, botanically a berry, of the deciduous woody vines of the flowering plant genus Vitis. Grapes can be eaten fresh as table grapes, used for making wine, jam, grape juice, jelly, grape seed extract, vinegar, and grape seed oil, or dried as raisins, currants and sultanas',NULL,1,1,'1','2021-11-02 00:36:24','2021-11-02 00:48:43'),(68,1,'RKMF000068','default.png','Grapefruit','چکوترا پھل','Grapefruit',NULL,2,4,5,NULL,1,40,0,4,45,0,'1635795983','This fruit is sweetly-tarted and sometimes you will also find it to be tangy and bitter. It is a rich source of vitamin C, can be eaten whole or used in salads and juices.',NULL,1,1,'1','2021-11-02 00:46:23','2021-11-02 00:46:23');

/*Table structure for table `riders` */

DROP TABLE IF EXISTS `riders`;

CREATE TABLE `riders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `riders_cnic_unique` (`cnic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `riders` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission` enum('Owner','Admin','Manager','User') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Limited Access',
  `index` tinyint(1) NOT NULL DEFAULT 1,
  `create` tinyint(1) NOT NULL DEFAULT 0,
  `store` tinyint(1) NOT NULL DEFAULT 0,
  `show` tinyint(1) NOT NULL DEFAULT 0,
  `edit` tinyint(1) NOT NULL DEFAULT 0,
  `update` tinyint(1) NOT NULL DEFAULT 0,
  `destroy` tinyint(1) NOT NULL DEFAULT 0,
  `is_available` tinyint(1) NOT NULL DEFAULT 0,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`permission`,`title`,`index`,`create`,`store`,`show`,`edit`,`update`,`destroy`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,'Owner','Full Access',1,1,1,1,1,1,1,1,'1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(2,'User','Limited Access',0,0,0,0,0,0,0,0,'1','2021-07-19 02:03:25','2021-07-19 02:03:25'),(3,'Admin','Full Access',1,1,1,1,1,1,1,1,'1','2021-09-10 01:10:55','2021-09-10 01:27:00');

/*Table structure for table `sms` */

DROP TABLE IF EXISTS `sms`;

CREATE TABLE `sms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sms` */

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ntn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suppliers` */

insert  into `suppliers`(`id`,`business_id`,`name`,`designation`,`business_name`,`phone`,`whatsapp`,`email`,`address`,`ntn`,`strn`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,1,'Supplier A','Salesman','Local Market','3022203204','3022203204',NULL,'Karachi, Pakistan',NULL,NULL,1,'1','2021-07-14 16:08:23','2021-09-25 10:52:55'),(2,1,'Supplier B','Salesman','Local Market','3022203204','3022203204',NULL,'Karachi, Pakistan',NULL,NULL,1,'1','2021-09-12 18:31:16','2021-09-12 18:31:16'),(3,1,'Supplier C','Salesman','Local Market','3022203204','3022203204',NULL,'Karachi, Pakistan',NULL,NULL,1,'1','2021-09-25 10:57:52','2021-09-25 10:57:52'),(4,1,'Supplier D','Salesman','Local Market','3022203204','3022203204',NULL,'Karachi, Pakistan',NULL,NULL,1,'1','2021-10-04 00:14:23','2021-11-04 10:28:16'),(5,1,'Supplier E','Salesman','Local Market','3022203204','3022203204',NULL,'Karachi, Pakistan',NULL,NULL,1,'1','2021-11-04 10:31:13','2021-11-04 10:31:13');

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `transaction` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` int(11) NOT NULL DEFAULT 0,
  `credit` int(11) NOT NULL DEFAULT 0,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`business_id`,`transaction_id`,`transaction`,`description`,`debit`,`credit`,`category`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,1,1,'Account Opening - Cash','Cash In Hand',0,0,'Account Opening',1,'1','2021-07-14 16:10:25','2021-07-14 16:10:25'),(2,1,1,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(3,1,2,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(4,1,3,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(5,1,4,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(6,1,5,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(7,1,6,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(8,1,7,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(9,1,8,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(10,1,9,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(11,1,10,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(12,1,11,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(13,1,12,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(14,1,13,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(15,1,14,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(16,1,15,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(17,1,16,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(18,1,17,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(19,1,18,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(20,1,19,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(21,1,20,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(22,1,21,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(23,1,22,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(24,1,23,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(25,1,24,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(26,1,25,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(27,1,26,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(28,1,27,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(29,1,28,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(30,1,29,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(31,1,30,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(32,1,31,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(33,1,32,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(34,1,33,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(35,1,34,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(36,1,35,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(37,1,36,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(38,1,37,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(39,1,38,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(40,1,39,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(41,1,40,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(42,1,41,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(43,1,42,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(44,1,43,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(45,1,44,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(46,1,45,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(47,1,46,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(48,1,47,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(49,1,48,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(50,1,49,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(51,1,50,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(52,1,51,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(53,1,52,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(54,1,53,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(55,1,54,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(56,1,55,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(57,1,56,'Vegetable - Default','Purchased Default',0,0,'Product - Purchases',1,'',NULL,NULL),(58,1,57,'Fruits - RKMF000057','Purchased 0Kg (Pear - Nashpati - ناشپاتی) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 00:19:12','2021-10-04 00:19:12'),(59,1,58,'Fruits - RKMF000058','Purchased 0Half Dozen (Banana - Kela - کیلا) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 00:25:11','2021-10-04 00:25:11'),(60,1,59,'Fruits - RKMF000059','Purchased 0Kg (Sweet Lime - Mitha - مٹھا لیمو) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 00:29:43','2021-10-04 00:29:43'),(61,1,60,'Fruits - RKMF000060','Purchased 0Pc(s) (Coconut - Narial - ناریل) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 00:41:40','2021-10-04 00:41:40'),(62,1,61,'Fruits - RKMF000061','Purchased 0Pc(s) (Green Coconut - Sabz Narial - سبز ناریل) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 00:45:07','2021-10-04 00:45:07'),(63,1,62,'Fruits - RKMF000062','Purchased 0Kg (Apple Kalakullu - Saib Kalakullu - سیب کالاکولو) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 00:52:39','2021-10-04 00:52:39'),(64,1,63,'Fruits - RKMF000063','Purchased 0Kg (Apple Green - Sabz Saib - سبز سیب) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 00:56:39','2021-10-04 00:56:39'),(65,1,64,'Fruits - RKMF000064','Purchased 0Kg (Apple Gaja - Gaja Saib - گاجا سیب) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 01:00:14','2021-10-04 01:00:14'),(66,1,65,'Fruits - RKMF000065','Purchased 0250g (Grapes Green - Sabz Angoor - سبز انگور) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 01:03:57','2021-10-04 01:03:57'),(67,1,66,'Fruits - RKMF000066','Purchased 0Kg (Papaya - Papita - پپیتا) From Local Market',0,0,'Product - Purchases',1,'1','2021-10-04 01:09:15','2021-10-04 01:09:15'),(68,1,67,'Fruits - RKMF000067','Purchased 120250g (Grapes Red - Laal Angoor - سرخ انگور) From Rana Liaquat',14400,0,'Product - Purchases',1,'1','2021-11-02 00:36:24','2021-11-02 00:36:24'),(69,1,68,'Fruits - RKMF000068','Purchased 0Pc(s) (Grapefruit - Grapefruit - چکوترا پھل) From Rana Liaquat',0,0,'Product - Purchases',1,'1','2021-11-02 00:46:23','2021-11-02 00:46:23');

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `record_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `units_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `units` */

insert  into `units`(`id`,`business_id`,`name`,`is_available`,`record_by`,`created_at`,`updated_at`) values (1,1,'Kg',1,'1','2021-07-14 16:08:53','2021-07-14 16:08:53'),(2,1,'250g',1,'1','2021-07-14 16:09:03','2021-07-16 17:53:46'),(3,1,'Bunch',1,'1','2021-07-14 16:09:12','2021-07-14 16:09:12'),(4,1,'Pc(s)',1,'1','2021-07-14 16:09:19','2021-07-14 16:09:19'),(5,1,'500g',1,'1','2021-07-16 17:53:58','2021-07-16 17:53:58'),(6,1,'6 (Pcs)',1,'1','2021-10-04 00:20:37','2021-10-04 01:18:00'),(7,1,'12 (Pcs)',1,'1','2021-10-04 00:20:56','2021-10-04 01:17:45');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet` int(11) NOT NULL DEFAULT 0,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `is_available` tinyint(1) NOT NULL DEFAULT 0,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`business_id`,`customer_id`,`api_token`,`image`,`name`,`email`,`email_verified_at`,`phone`,`is_verified`,`password`,`address`,`wallet`,`role_id`,`is_available`,`record_by`,`remember_token`,`created_at`,`updated_at`) values (1,1,0,'432021088bbea5c00125bbbe27697319ac8428d2c35dc295f12ca6842bf7a48f','default.png','Rosa\'s Kitchen','dashboard@rosa.com','2021-01-01 00:00:00','3022203204',1,'$2a$12$JM6OO89YGvsULIi7EAJ8GuI.lKcV/XPAkeSKAnLfna2H9fWe1jmpW','Karachi, Pakistan',30,1,1,'1','','2021-07-19 02:03:25','2021-07-19 02:03:25');

/*Table structure for table `whats_apps` */

DROP TABLE IF EXISTS `whats_apps`;

CREATE TABLE `whats_apps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `whats_apps` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
