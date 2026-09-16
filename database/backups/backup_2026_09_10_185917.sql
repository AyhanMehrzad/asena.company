-- ASENA Enterprise Master Database Backup
-- Generated: 2026-09-10 18:59:17

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tracking_code` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
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
  `pet_weight` decimal(5,2) DEFAULT NULL,
  `visit_purpose` varchar(255) DEFAULT NULL,
  `pet_notes` text DEFAULT NULL,
  `fee` int(11) NOT NULL DEFAULT 350000,
  `commission_amount` int(11) NOT NULL DEFAULT 0,
  `net_amount` int(11) NOT NULL DEFAULT 0,
  `service_type` varchar(50) DEFAULT 'consultation',
  `settlement_status` varchar(50) DEFAULT 'held_in_escrow',
  `doctor_diagnosis` text DEFAULT NULL,
  `doctor_prescription` text DEFAULT NULL,
  `reschedule_reason` varchar(500) DEFAULT NULL,
  `rescheduled_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `idx_doc_date` (`doctor_id`,`appointment_date`),
  KEY `idx_user_status` (`user_id`,`status`),
  KEY `idx_org_id` (`organization_id`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `appointments` (`id`, `tracking_code`, `user_id`, `doctor_id`, `organization_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `pet_type`, `pet_race`, `pet_id`, `pet_name`, `pet_gender`, `pet_age`, `pet_weight`, `visit_purpose`, `pet_notes`, `fee`, `commission_amount`, `net_amount`, `service_type`, `settlement_status`, `doctor_diagnosis`, `doctor_prescription`, `reschedule_reason`, `rescheduled_at`) VALUES ('1', NULL, '2', '4', NULL, '2026-07-26', '17:30', 'completed', '2026-07-24 17:53:19', 'گربه', 'persian', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350000', '0', '0', 'consultation', 'held_in_escrow', NULL, NULL, NULL, NULL);
INSERT INTO `appointments` (`id`, `tracking_code`, `user_id`, `doctor_id`, `organization_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `pet_type`, `pet_race`, `pet_id`, `pet_name`, `pet_gender`, `pet_age`, `pet_weight`, `visit_purpose`, `pet_notes`, `fee`, `commission_amount`, `net_amount`, `service_type`, `settlement_status`, `doctor_diagnosis`, `doctor_prescription`, `reschedule_reason`, `rescheduled_at`) VALUES ('2', NULL, '5', '4', NULL, '2026-07-26', '09:00', 'cancelled', '2026-07-25 03:38:32', 'سگ', 'Husky', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350000', '0', '0', 'consultation', 'held_in_escrow', NULL, NULL, NULL, NULL);
INSERT INTO `appointments` (`id`, `tracking_code`, `user_id`, `doctor_id`, `organization_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `pet_type`, `pet_race`, `pet_id`, `pet_name`, `pet_gender`, `pet_age`, `pet_weight`, `visit_purpose`, `pet_notes`, `fee`, `commission_amount`, `net_amount`, `service_type`, `settlement_status`, `doctor_diagnosis`, `doctor_prescription`, `reschedule_reason`, `rescheduled_at`) VALUES ('3', NULL, '6', '4', NULL, '2026-07-26', '16:45', 'cancelled', '2026-07-25 04:04:34', 'سگ', 'Husky', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350000', '0', '0', 'consultation', 'held_in_escrow', NULL, NULL, NULL, NULL);
INSERT INTO `appointments` (`id`, `tracking_code`, `user_id`, `doctor_id`, `organization_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `pet_type`, `pet_race`, `pet_id`, `pet_name`, `pet_gender`, `pet_age`, `pet_weight`, `visit_purpose`, `pet_notes`, `fee`, `commission_amount`, `net_amount`, `service_type`, `settlement_status`, `doctor_diagnosis`, `doctor_prescription`, `reschedule_reason`, `rescheduled_at`) VALUES ('4', NULL, '7', '4', NULL, '2026-08-01', '08:00', 'pending', '2026-07-25 14:57:01', 'سگ', 'bulldog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350000', '0', '0', 'consultation', 'held_in_escrow', NULL, NULL, NULL, NULL);
INSERT INTO `appointments` (`id`, `tracking_code`, `user_id`, `doctor_id`, `organization_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `pet_type`, `pet_race`, `pet_id`, `pet_name`, `pet_gender`, `pet_age`, `pet_weight`, `visit_purpose`, `pet_notes`, `fee`, `commission_amount`, `net_amount`, `service_type`, `settlement_status`, `doctor_diagnosis`, `doctor_prescription`, `reschedule_reason`, `rescheduled_at`) VALUES ('5', NULL, '2', '4', NULL, '2026-08-02', '09:45', 'cancelled', '2026-07-31 21:10:41', 'سگ', 'germenshepert', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350000', '0', '0', 'consultation', 'held_in_escrow', NULL, NULL, NULL, NULL);
INSERT INTO `appointments` (`id`, `tracking_code`, `user_id`, `doctor_id`, `organization_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `pet_type`, `pet_race`, `pet_id`, `pet_name`, `pet_gender`, `pet_age`, `pet_weight`, `visit_purpose`, `pet_notes`, `fee`, `commission_amount`, `net_amount`, `service_type`, `settlement_status`, `doctor_diagnosis`, `doctor_prescription`, `reschedule_reason`, `rescheduled_at`) VALUES ('6', NULL, '2', '4', NULL, '2026-08-08', '08:45', 'pending', '2026-08-01 19:03:51', 'گربه', 'persian', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350000', '0', '0', 'consultation', 'held_in_escrow', NULL, NULL, NULL, NULL);
INSERT INTO `appointments` (`id`, `tracking_code`, `user_id`, `doctor_id`, `organization_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `pet_type`, `pet_race`, `pet_id`, `pet_name`, `pet_gender`, `pet_age`, `pet_weight`, `visit_purpose`, `pet_notes`, `fee`, `commission_amount`, `net_amount`, `service_type`, `settlement_status`, `doctor_diagnosis`, `doctor_prescription`, `reschedule_reason`, `rescheduled_at`) VALUES ('7', NULL, '11', '4', NULL, '2026-08-08', '17:30', 'pending', '2026-08-03 13:54:19', 'سگ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350000', '0', '0', 'consultation', 'held_in_escrow', NULL, NULL, NULL, NULL);
INSERT INTO `appointments` (`id`, `tracking_code`, `user_id`, `doctor_id`, `organization_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `pet_type`, `pet_race`, `pet_id`, `pet_name`, `pet_gender`, `pet_age`, `pet_weight`, `visit_purpose`, `pet_notes`, `fee`, `commission_amount`, `net_amount`, `service_type`, `settlement_status`, `doctor_diagnosis`, `doctor_prescription`, `reschedule_reason`, `rescheduled_at`) VALUES ('8', NULL, '11', '5', NULL, '2026-08-12', '18:15', 'pending', '2026-08-03 14:39:51', 'سگ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350000', '0', '0', 'consultation', 'held_in_escrow', NULL, NULL, NULL, NULL);
INSERT INTO `appointments` (`id`, `tracking_code`, `user_id`, `doctor_id`, `organization_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `pet_type`, `pet_race`, `pet_id`, `pet_name`, `pet_gender`, `pet_age`, `pet_weight`, `visit_purpose`, `pet_notes`, `fee`, `commission_amount`, `net_amount`, `service_type`, `settlement_status`, `doctor_diagnosis`, `doctor_prescription`, `reschedule_reason`, `rescheduled_at`) VALUES ('9', NULL, '12', '4', NULL, '2026-08-22', '08:45', 'pending', '2026-08-18 15:00:21', 'سگ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350000', '0', '0', 'consultation', 'held_in_escrow', NULL, NULL, NULL, NULL);

DROP TABLE IF EXISTS `autoship_plans`;
CREATE TABLE `autoship_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `interval_months` int(11) NOT NULL,
  `discount_percent` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `autoship_plans` (`id`, `name`, `interval_months`, `discount_percent`, `created_at`) VALUES ('1', 'اشتراک ۳ ماهه', '3', '5', '2026-07-25 03:51:50');
INSERT INTO `autoship_plans` (`id`, `name`, `interval_months`, `discount_percent`, `created_at`) VALUES ('2', 'اشتراک ۶ ماهه', '6', '10', '2026-07-25 03:51:50');
INSERT INTO `autoship_plans` (`id`, `name`, `interval_months`, `discount_percent`, `created_at`) VALUES ('3', 'اشتراک ۱۲ ماهه', '12', '20', '2026-07-25 03:51:50');

DROP TABLE IF EXISTS `autoship_subscriptions`;
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

DROP TABLE IF EXISTS `b2b_rfq_items`;
CREATE TABLE `b2b_rfq_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfq_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `is_pharmacy` tinyint(1) DEFAULT 0,
  `product_title` varchar(255) NOT NULL,
  `requested_quantity` int(11) NOT NULL,
  `target_unit_price` int(11) DEFAULT NULL,
  `quoted_unit_price` int(11) DEFAULT NULL,
  `quoted_notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_rfq_item` (`rfq_id`),
  CONSTRAINT `fk_rfq_item` FOREIGN KEY (`rfq_id`) REFERENCES `b2b_rfqs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `b2b_rfqs`;
CREATE TABLE `b2b_rfqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `clinic_name` varchar(255) NOT NULL,
  `vet_license_num` varchar(100) DEFAULT NULL,
  `contact_person` varchar(150) NOT NULL,
  `contact_phone` varchar(50) NOT NULL,
  `status` enum('submitted','under_review','quoted','accepted','rejected','expired') DEFAULT 'submitted',
  `target_delivery_date` date DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `proforma_invoice_num` varchar(100) DEFAULT NULL,
  `quoted_total_amount` int(11) DEFAULT NULL,
  `quote_valid_until` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_rfq_user` (`user_id`),
  KEY `idx_rfq_status` (`status`),
  CONSTRAINT `fk_rfq_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` varchar(500) NOT NULL,
  `short_desc` text DEFAULT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'medical',
  `category_name` varchar(100) NOT NULL DEFAULT 'پزشکی و سلامت',
  `content` longtext NOT NULL,
  `faqs_json` longtext DEFAULT NULL,
  `author_name` varchar(255) NOT NULL DEFAULT 'آسنا',
  `author_role` varchar(255) DEFAULT 'تیم تخصصی آسنا',
  `icon` varchar(50) DEFAULT 'article',
  `accent_color` varchar(100) DEFAULT 'from-blue-600 to-indigo-700',
  `read_time` varchar(50) DEFAULT '۵ دقیقه مطالعه',
  `created_by_user_id` int(11) DEFAULT NULL,
  `status` enum('published','draft') DEFAULT 'published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_slug` (`slug`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `campaigns`;
CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `goal_amount` int(11) NOT NULL,
  `current_amount` int(11) DEFAULT 0,
  `image_url` varchar(500) DEFAULT NULL,
  `status` enum('active','completed','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `campaigns` (`id`, `title`, `description`, `goal_amount`, `current_amount`, `image_url`, `status`, `created_at`) VALUES ('1', 'Save Homeless Animals', 'Please help us raise funds for our shelter to support homeless pets. Every small donation counts.', '10000000', '1000000', 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=500', 'active', '2026-08-01 15:57:26');
INSERT INTO `campaigns` (`id`, `title`, `description`, `goal_amount`, `current_amount`, `image_url`, `status`, `created_at`) VALUES ('2', 'پویش واکسیناسیون و عقیم‌سازی حیوانات خیابانی', 'تامین واکسن‌های هاری و هفت‌گانه و خدمات درمان فوری برای فرشتگان بی‌سرپرست در کلینیک تخصصی آسنا.', '18000000', '9700000', 'https://images.unsplash.com/photo-1548767797-d8c844163c4c?w=800', 'active', '2026-09-07 16:45:02');
INSERT INTO `campaigns` (`id`, `title`, `description`, `goal_amount`, `current_amount`, `image_url`, `status`, `created_at`) VALUES ('3', 'تامین غذای گرم و جیره زمستانه پناهگاه', 'خرید و توزیع غذای خشک باکیفیت و مکمل‌های تقویتی برای سگ‌ها و گربه‌های آسیب‌دیده پناهگاه‌های حومه.', '12000000', '1450000', 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=800', 'active', '2026-09-07 16:45:02');

DROP TABLE IF EXISTS `chat_messages`;
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

INSERT INTO `chat_messages` (`id`, `user_id`, `sender_type`, `message`, `is_read`, `created_at`) VALUES ('1', '6', 'user', '[AI] Hello, how can I feed my cat?', '0', '2026-07-25 04:00:20');
INSERT INTO `chat_messages` (`id`, `user_id`, `sender_type`, `message`, `is_read`, `created_at`) VALUES ('2', '6', 'ai', 'این یک پیام خودکار از دستیار هوشمند پت‌کر است. شما پرسیدید: \'Hello, how can I feed my cat?\'. در حال حاضر من در فاز آزمایشی هستم.', '1', '2026-07-25 04:00:20');

DROP TABLE IF EXISTS `curated_recommendations`;
CREATE TABLE `curated_recommendations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slot_type` enum('banner','notification','cart_upsell','spotlight') NOT NULL,
  `product_id` int(11) NOT NULL,
  `custom_badge` varchar(100) DEFAULT NULL,
  `custom_title` varchar(255) DEFAULT NULL,
  `custom_subtitle` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_slot` (`slot_type`,`is_active`),
  KEY `idx_product` (`product_id`),
  CONSTRAINT `fk_rec_prem_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `curated_recommendations` (`id`, `slot_type`, `product_id`, `custom_badge`, `custom_title`, `custom_subtitle`, `is_active`, `display_order`, `created_at`) VALUES ('1', 'banner', '1', '🔥 پرفروش‌ترین محصول ماه', 'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult', 'تغذیه کامل و بهینه شده، هم‌اکنون با ۱۰٪ تخفیف اشتراک خودکار', '1', '1', '2026-08-25 17:21:55');
INSERT INTO `curated_recommendations` (`id`, `slot_type`, `product_id`, `custom_badge`, `custom_title`, `custom_subtitle`, `is_active`, `display_order`, `created_at`) VALUES ('2', 'notification', '2', '⚡ شگفت‌انگیز هفتگی', 'کنسرو گربه گورمت گلد با طعم مرغ در تخفیف ویژه به مدت محدود!', 'خرید آنلاین و تحویل اکسپرس درب منزل', '1', '1', '2026-08-25 17:21:55');
INSERT INTO `curated_recommendations` (`id`, `slot_type`, `product_id`, `custom_badge`, `custom_title`, `custom_subtitle`, `is_active`, `display_order`, `created_at`) VALUES ('3', 'cart_upsell', '6', '⭐ مکمل پیشنهادی', 'قطره مولتی ویتامین سگ و گربه شایر', 'پیشنهاد طلایی برای شادابی و درخشش موی پت شما', '1', '1', '2026-08-25 17:21:55');
INSERT INTO `curated_recommendations` (`id`, `slot_type`, `product_id`, `custom_badge`, `custom_title`, `custom_subtitle`, `is_active`, `display_order`, `created_at`) VALUES ('4', 'spotlight', '7', '🐱 سرگرمی خانگی', 'درخت گربه ۳ طبقه کدیپک', 'بهترین انتخاب برای استراحت و اسکرچ گربه‌ها', '1', '1', '2026-08-25 17:21:55');

DROP TABLE IF EXISTS `dashboard_events`;
CREATE TABLE `dashboard_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `event_time` varchar(5) NOT NULL,
  `color` varchar(20) DEFAULT 'primary',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dashboard_events` (`id`, `title`, `event_time`, `color`, `created_at`) VALUES ('1', 'شروع شیفت کلینیک', '08:00', 'primary', '2026-07-25 04:30:42');
INSERT INTO `dashboard_events` (`id`, `title`, `event_time`, `color`, `created_at`) VALUES ('2', 'بررسی سفارشات', '12:00', 'secondary', '2026-07-25 04:30:42');

DROP TABLE IF EXISTS `doctor_blocked_slots`;
CREATE TABLE `doctor_blocked_slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `block_date` date NOT NULL,
  `start_time` varchar(20) DEFAULT NULL,
  `end_time` varchar(20) DEFAULT NULL,
  `reason` varchar(255) DEFAULT 'نوبت تلفنی / خارج از سامانه',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_doc` (`doctor_id`),
  KEY `idx_org` (`organization_id`),
  CONSTRAINT `fk_block_doc` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `provider_type` varchar(50) NOT NULL DEFAULT 'doctor',
  `rating` decimal(2,1) DEFAULT 5.0,
  `baseline_rating` decimal(3,1) DEFAULT 4.9,
  `review_count` int(11) DEFAULT 0,
  `image_url` varchar(500) DEFAULT NULL,
  `price` int(11) DEFAULT 450000,
  `clinic_name` varchar(255) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `is_emergency` tinyint(1) NOT NULL DEFAULT 0,
  `bio` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `services_json` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `schedule_info` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_provider_type` (`provider_type`),
  KEY `idx_org_id` (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('4', 'akbar nami', 'پزشک عمومی', 'doctor', '5.0', '4.9', '0', 'uploads/doctors/6a63b8fcdf04e_329748003990695799.jpeg', '150000', NULL, NULL, '0', NULL, NULL, NULL, '2026-07-23 22:12:40', '4', '09990999', '{\"sat\":{\"m_start\":\"08:00\",\"m_end\":\"14:00\",\"a_start\":\"16:00\",\"a_end\":\"21:00\"},\"sun\":{\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_start\":\"16:00\",\"a_end\":\"20:00\"}}');
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('5', 'ali', 'vet', 'doctor', '5.0', '4.9', '0', 'uploads/doctors/6a63b90c61a3d_doctor kitty.jpeg', '600000', NULL, NULL, '0', NULL, NULL, NULL, '2026-07-23 22:35:20', '3', NULL, '{\"sat\":{\"m_active\":true,\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_active\":true,\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"sun\":{\"m_active\":true,\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_active\":true,\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"mon\":{\"m_active\":true,\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_active\":true,\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"tue\":{\"m_active\":true,\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_active\":true,\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"wed\":{\"m_active\":true,\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_active\":true,\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"thu\":{\"m_active\":true,\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_active\":true,\"a_start\":\"16:00\",\"a_end\":\"20:00\"},\"fri\":{\"m_active\":true,\"m_start\":\"09:00\",\"m_end\":\"13:00\",\"a_active\":true,\"a_start\":\"16:00\",\"a_end\":\"20:00\"}}');
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('8', 'doctor', 'عمومی', 'doctor', '5.0', '4.9', '0', NULL, '450000', NULL, NULL, '0', NULL, NULL, NULL, '2026-08-03 10:24:56', '10', 'user.doctor', NULL);
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('9', 'دکتر سهراب علوی', 'بورد تخصصی جراحی ارتوپدی و ستون فقرات', 'doctor', '4.9', '4.9', '84', 'assets/images/vet-hero.png', '380000', NULL, NULL, '0', NULL, NULL, NULL, '2026-09-05 13:50:26', NULL, '09121112233', 'شنبه، دوشنبه، چهارشنبه از ساعت ۱۶:۰۰ الی ۲۱:۰۰');
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('10', 'دکتر هما مهرزاد', 'متخصص بیماری‌های داخلی و تصویربرداری تشخیصی', 'doctor', '4.9', '4.9', '96', 'assets/images/vet-hero.png', '320000', NULL, NULL, '0', NULL, NULL, NULL, '2026-09-05 13:50:26', '24', '09122223344', 'یکشنبه، سه‌شنبه، پنجشنبه از ساعت ۱۰:۰۰ الی ۱۸:۰۰');
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('11', 'دکتر کامران شایان', 'متخصص جراحی بافت نرم و بیهوشی استنشاقی', 'doctor', '4.8', '4.9', '67', 'assets/images/vet-hero.png', '350000', NULL, NULL, '0', NULL, NULL, NULL, '2026-09-05 13:50:26', NULL, '09123334455', 'همه روزه به جز جمعه از ساعت ۱۴:۰۰ الی ۲۰:۰۰');
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('12', 'دکتر مریم صادقی', 'متخصص دندانپزشکی و جرم‌گیری اولتراسونیک پت', 'doctor', '4.9', '4.9', '52', 'assets/images/vet-hero.png', '290000', NULL, NULL, '0', NULL, NULL, NULL, '2026-09-05 13:50:26', NULL, '09124445566', 'شنبه تا چهارشنبه از ساعت ۹:۰۰ الی ۱۵:۰۰');
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('13', 'دکتر پوریا رستمی', 'فوق‌تخصص پرندگان زینتی، طوطی‌سانان و حیوانات اگزوتیک', 'doctor', '4.8', '4.9', '73', 'assets/images/vet-hero.png', '310000', NULL, NULL, '0', NULL, NULL, NULL, '2026-09-05 13:50:26', NULL, '09125556677', 'یکشنبه و چهارشنبه از ساعت ۱۵:۰۰ الی ۲۱:۰۰');
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('14', 'دکتر نیلوفر بختیاری', 'متخصص مراقبت‌های ویژه (ICU) و اورژانس دامپزشکی', 'doctor', '5.0', '4.9', '41', 'assets/images/vet-hero.png', '360000', NULL, NULL, '0', NULL, NULL, NULL, '2026-09-05 13:50:26', NULL, '09126667788', 'شیفت شب و روزهای فرد به صورت ۲۴ ساعته');
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('15', 'امید رضایی', 'شستشو، اصلاح ژورنالی و گرومینگ تخصصی پت', 'groomer', '4.9', '4.9', '38', 'assets/images/vet-hero.png', '400000', 'سالن زیبایی و گرومینگ پایتخت', '1', '0', NULL, 'گرومر,آرایشگاه پت,کوتاهی مو', '[\"اصلاح ژورنالی سگ و گربه\",\"حمام درمانی و ضدانگل\",\"کوتاهی ناخن و فرم‌دهی\"]', '2026-09-07 17:21:40', NULL, NULL, 'شنبه تا چهارشنبه ۱۰:۰۰ الی ۱۹:۰۰');
INSERT INTO `doctors` (`id`, `name`, `specialty`, `provider_type`, `rating`, `baseline_rating`, `review_count`, `image_url`, `price`, `clinic_name`, `organization_id`, `is_emergency`, `bio`, `tags`, `services_json`, `created_at`, `user_id`, `phone`, `schedule_info`) VALUES ('16', 'امید رضایی', 'شستشو، اصلاح ژورنالی و گرومینگ تخصصی پت', 'groomer', '4.9', '4.9', '38', 'assets/images/vet-hero.png', '400000', 'سالن زیبایی و گرومینگ پایتخت', '1', '0', NULL, 'گرومر,آرایشگاه پت,کوتاهی مو', '[\"اصلاح ژورنالی سگ و گربه\",\"حمام درمانی و ضدانگل\",\"کوتاهی ناخن و فرم‌دهی\"]', '2026-09-07 17:21:58', NULL, NULL, 'شنبه تا چهارشنبه ۱۰:۰۰ الی ۱۹:۰۰');

DROP TABLE IF EXISTS `donations`;
CREATE TABLE `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `donor_name` varchar(255) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `status` enum('pending','successful','failed') DEFAULT 'pending',
  `payment_reference` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `campaign_id` (`campaign_id`),
  CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('1', '2', 'ناشناس', '1', '50000', 'successful', '360976201', '2026-08-01 16:30:46');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('2', '2', 'Sina', '1', '100000', 'successful', '360977501', '2026-08-01 16:31:47');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('3', NULL, 'ناشناس', NULL, '3000000', 'successful', 'TRX-81076211', '2026-09-07 16:26:08');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('4', NULL, 'دکتر گلزاری', '1', '250000', 'successful', 'TRX-62178166', '2026-09-07 16:44:44');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('5', NULL, 'سارا رادمهر', '2', '1200000', 'successful', 'TRX-91028341', '2026-09-07 14:45:02');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('6', NULL, 'امیرحسین کیانی', '3', '850000', 'successful', 'TRX-71928401', '2026-09-07 12:45:02');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('7', NULL, 'مهندس علوی', '2', '500000', 'successful', 'TRX-82937401', '2026-09-06 16:45:02');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('8', NULL, 'نیکوکار مهرآیین', '3', '300000', 'successful', 'TRX-19284729', '2026-09-05 16:45:02');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('9', NULL, 'پرهام شریفی', '1', '600000', 'successful', 'TRX-66692679', '2026-09-07 16:46:52');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('10', NULL, 'ناشناس', '2', '3000000', 'successful', 'TRX-98810815', '2026-09-07 16:48:16');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('11', NULL, 'ناشناس', '3', '300000', 'successful', 'TRX-41079533', '2026-09-07 16:48:35');
INSERT INTO `donations` (`id`, `user_id`, `donor_name`, `campaign_id`, `amount`, `status`, `payment_reference`, `created_at`) VALUES ('12', NULL, 'ali', '2', '5000000', 'successful', 'TRX-12249284', '2026-09-07 16:49:04');

DROP TABLE IF EXISTS `flash_sales`;
CREATE TABLE `flash_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `is_pharmacy` tinyint(1) DEFAULT 0,
  `special_price` int(11) NOT NULL,
  `stock_quota` int(11) NOT NULL DEFAULT 10,
  `claimed_count` int(11) NOT NULL DEFAULT 0,
  `starts_at` datetime NOT NULL,
  `ends_at` datetime NOT NULL,
  `badge_text` varchar(100) DEFAULT 'پیشنهاد شگفت‌انگیز',
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_flash_dates` (`starts_at`,`ends_at`,`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `attempt_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `login_attempts` (`id`, `ip_address`, `username`, `attempt_time`) VALUES ('12', '127.0.0.1', '09120000001', '2026-09-10 15:09:07');
INSERT INTO `login_attempts` (`id`, `ip_address`, `username`, `attempt_time`) VALUES ('13', '127.0.0.1', '09120000003', '2026-09-10 15:09:07');

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_purchase` int(11) NOT NULL,
  `product_name_snapshot` varchar(500) NOT NULL DEFAULT '',
  `seller_id` int(11) DEFAULT NULL,
  `commission_rate` decimal(5,2) DEFAULT 10.00,
  `commission_amount` bigint(20) DEFAULT 0,
  `seller_net_amount` bigint(20) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `idx_order_prod` (`order_id`,`product_id`),
  KEY `idx_seller_order` (`seller_id`,`order_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `product_name_snapshot`, `seller_id`, `commission_rate`, `commission_amount`, `seller_net_amount`) VALUES ('1', '3', '1', '1', '1980000', 'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult', NULL, '10.00', '0', '0');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `product_name_snapshot`, `seller_id`, `commission_rate`, `commission_amount`, `seller_net_amount`) VALUES ('2', '3', '8', '1', '280000', 'شامپو ضد ریزش موی سگ تریکسی', NULL, '10.00', '0', '0');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `product_name_snapshot`, `seller_id`, `commission_rate`, `commission_amount`, `seller_net_amount`) VALUES ('3', '3', '31', '1', '100000', 'Cat Toy Mouse Updated', NULL, '10.00', '0', '0');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `product_name_snapshot`, `seller_id`, `commission_rate`, `commission_amount`, `seller_net_amount`) VALUES ('4', '4', '1', '1', '1980000', 'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult', NULL, '10.00', '0', '0');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `product_name_snapshot`, `seller_id`, `commission_rate`, `commission_amount`, `seller_net_amount`) VALUES ('5', '4', '31', '1', '100000', 'Cat Toy Mouse Updated', NULL, '10.00', '0', '0');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `product_name_snapshot`, `seller_id`, `commission_rate`, `commission_amount`, `seller_net_amount`) VALUES ('6', '5', '1', '1', '1980000', 'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult', NULL, '10.00', '0', '0');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `product_name_snapshot`, `seller_id`, `commission_rate`, `commission_amount`, `seller_net_amount`) VALUES ('7', '5', '31', '1', '100000', 'Cat Toy Mouse Updated', NULL, '10.00', '0', '0');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `product_name_snapshot`, `seller_id`, `commission_rate`, `commission_amount`, `seller_net_amount`) VALUES ('8', '6', '32', '1', '740000', 'خمیر ضد انگل آیورمکتین مخصوص اسب اکولان', NULL, '10.00', '0', '0');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `product_name_snapshot`, `seller_id`, `commission_rate`, `commission_amount`, `seller_net_amount`) VALUES ('9', '6', '38', '1', '690000', 'بلوس آهسته‌رهش کلسیم و ویتامین D3 گاو تازه زا', NULL, '10.00', '0', '0');

DROP TABLE IF EXISTS `order_logs`;
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

INSERT INTO `order_logs` (`id`, `order_id`, `old_status`, `new_status`, `changed_at`) VALUES ('1', '2', 'delivered', 'processing', '2026-07-25 04:49:02');
INSERT INTO `order_logs` (`id`, `order_id`, `old_status`, `new_status`, `changed_at`) VALUES ('2', '2', 'processing', 'delivered', '2026-07-25 04:49:07');
INSERT INTO `order_logs` (`id`, `order_id`, `old_status`, `new_status`, `changed_at`) VALUES ('3', '1', 'cancelled', 'pending_payment', '2026-07-25 04:49:18');
INSERT INTO `order_logs` (`id`, `order_id`, `old_status`, `new_status`, `changed_at`) VALUES ('4', '1', 'pending_payment', 'processing', '2026-07-25 04:49:24');
INSERT INTO `order_logs` (`id`, `order_id`, `old_status`, `new_status`, `changed_at`) VALUES ('5', '1', 'processing', 'shipped', '2026-07-25 04:49:27');
INSERT INTO `order_logs` (`id`, `order_id`, `old_status`, `new_status`, `changed_at`) VALUES ('6', '1', 'shipped', 'delivered', '2026-07-25 04:49:32');
INSERT INTO `order_logs` (`id`, `order_id`, `old_status`, `new_status`, `changed_at`) VALUES ('7', '3', 'processing', 'shipped', '2026-07-25 15:01:51');
INSERT INTO `order_logs` (`id`, `order_id`, `old_status`, `new_status`, `changed_at`) VALUES ('8', '4', 'processing', 'shipped', '2026-07-31 21:11:16');
INSERT INTO `order_logs` (`id`, `order_id`, `old_status`, `new_status`, `changed_at`) VALUES ('9', '3', 'shipped', 'delivered', '2026-07-31 21:11:21');

DROP TABLE IF EXISTS `order_status_logs`;
CREATE TABLE `order_status_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `from_status` varchar(50) DEFAULT NULL,
  `to_status` varchar(50) NOT NULL,
  `actor_type` enum('system','admin','doctor','user','carrier') DEFAULT 'admin',
  `actor_id` int(11) DEFAULT NULL,
  `carrier_name` varchar(100) DEFAULT NULL,
  `tracking_code` varchar(150) DEFAULT NULL,
  `tracking_url` varchar(500) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `sms_sent` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_log_order` (`order_id`),
  CONSTRAINT `fk_log_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `discount_amount` int(11) DEFAULT 0,
  `status` enum('pending_payment','processing','shipped','delivered','cancelled') DEFAULT 'pending_payment',
  `gateway_ref_id` varchar(100) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `carrier_name` varchar(100) DEFAULT NULL,
  `tracking_code` varchar(150) DEFAULT NULL,
  `shipping_cost` int(11) DEFAULT 0,
  `tax_amount` int(11) DEFAULT 0,
  `post_tracking_code` varchar(50) DEFAULT NULL,
  `delivered_at` datetime DEFAULT NULL,
  `post_delivery_verified` tinyint(1) DEFAULT 0,
  `escrow_status` enum('pending_delivery','delivered_in_inspection','cleared_for_payout','settled','disputed') DEFAULT 'pending_delivery',
  `escrow_cleared_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_user_status` (`user_id`,`status`),
  KEY `idx_escrow_status` (`escrow_status`,`post_delivery_verified`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `discount_amount`, `status`, `gateway_ref_id`, `shipping_address`, `created_at`, `carrier_name`, `tracking_code`, `shipping_cost`, `tax_amount`, `post_tracking_code`, `delivered_at`, `post_delivery_verified`, `escrow_status`, `escrow_cleared_at`) VALUES ('1', '6', '5490000', '0', 'delivered', NULL, NULL, '2026-07-25 04:13:27', NULL, NULL, '0', '0', NULL, NULL, '0', 'pending_delivery', NULL);
INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `discount_amount`, `status`, `gateway_ref_id`, `shipping_address`, `created_at`, `carrier_name`, `tracking_code`, `shipping_cost`, `tax_amount`, `post_tracking_code`, `delivered_at`, `post_delivery_verified`, `escrow_status`, `escrow_cleared_at`) VALUES ('2', '6', '5490000', '0', 'delivered', NULL, NULL, '2026-07-25 04:18:18', NULL, NULL, '0', '0', NULL, NULL, '0', 'pending_delivery', NULL);
INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `discount_amount`, `status`, `gateway_ref_id`, `shipping_address`, `created_at`, `carrier_name`, `tracking_code`, `shipping_cost`, `tax_amount`, `post_tracking_code`, `delivered_at`, `post_delivery_verified`, `escrow_status`, `escrow_cleared_at`) VALUES ('3', '7', '2360000', '0', 'delivered', NULL, NULL, '2026-07-25 14:58:00', NULL, NULL, '0', '0', NULL, NULL, '0', 'pending_delivery', NULL);
INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `discount_amount`, `status`, `gateway_ref_id`, `shipping_address`, `created_at`, `carrier_name`, `tracking_code`, `shipping_cost`, `tax_amount`, `post_tracking_code`, `delivered_at`, `post_delivery_verified`, `escrow_status`, `escrow_cleared_at`) VALUES ('4', '2', '2080000', '0', 'shipped', NULL, NULL, '2026-07-31 21:10:57', NULL, NULL, '0', '0', NULL, NULL, '0', 'pending_delivery', NULL);
INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `discount_amount`, `status`, `gateway_ref_id`, `shipping_address`, `created_at`, `carrier_name`, `tracking_code`, `shipping_cost`, `tax_amount`, `post_tracking_code`, `delivered_at`, `post_delivery_verified`, `escrow_status`, `escrow_cleared_at`) VALUES ('5', '11', '2080000', '0', 'processing', NULL, NULL, '2026-08-03 13:54:02', NULL, NULL, '0', '0', NULL, NULL, '0', 'pending_delivery', NULL);
INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `discount_amount`, `status`, `gateway_ref_id`, `shipping_address`, `created_at`, `carrier_name`, `tracking_code`, `shipping_cost`, `tax_amount`, `post_tracking_code`, `delivered_at`, `post_delivery_verified`, `escrow_status`, `escrow_cleared_at`) VALUES ('6', '13', '1430000', '0', 'processing', NULL, NULL, '2026-08-24 22:56:07', NULL, NULL, '0', '0', NULL, NULL, '0', 'pending_delivery', NULL);

DROP TABLE IF EXISTS `organization_admins`;
CREATE TABLE `organization_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_role` varchar(50) NOT NULL DEFAULT 'manager',
  `title` varchar(100) DEFAULT NULL,
  `permissions_json` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_org_user` (`organization_id`,`user_id`),
  KEY `idx_org_admins_org` (`organization_id`),
  KEY `idx_org_admins_user` (`user_id`),
  KEY `idx_org_admins_status` (`status`),
  CONSTRAINT `organization_admins_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `organization_admins_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `organization_admins` (`id`, `organization_id`, `user_id`, `admin_role`, `title`, `permissions_json`, `status`, `created_by`, `created_at`, `updated_at`) VALUES ('2', '1', '18', 'assistant_manager', 'معاون اجرایی و سرپرست شیفت', '[\"manage_appointments\",\"manage_doctors\",\"manage_shifts\",\"manage_profile\",\"manage_inventory\",\"manage_orders\",\"manage_tickets\"]', 'active', '1', '2026-09-07 18:57:14', '2026-09-07 18:57:14');
INSERT INTO `organization_admins` (`id`, `organization_id`, `user_id`, `admin_role`, `title`, `permissions_json`, `status`, `created_by`, `created_at`, `updated_at`) VALUES ('9', '1', '5', 'owner', 'مدیر ارشد و موسس', '[\"all\"]', 'active', '5', '2026-09-07 20:07:05', '2026-09-07 20:07:05');

DROP TABLE IF EXISTS `organization_doctors`;
CREATE TABLE `organization_doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `is_head_physician` tinyint(1) DEFAULT 0,
  `role_type` varchar(50) DEFAULT 'doctor',
  `working_days` varchar(255) DEFAULT 'شنبه تا چهارشنبه',
  `working_hours` varchar(100) DEFAULT '۱۶:۰۰ الی ۲۱:۰۰',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_org_doc` (`organization_id`,`doctor_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `idx_role_type` (`role_type`),
  CONSTRAINT `organization_doctors_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `organization_doctors_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('1', '1', '4', '1', 'doctor', 'شنبه تا چهارشنبه', '۱۵:۰۰ الی ۲۱:۰۰', '2026-09-05 13:32:08');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('2', '2', '8', '0', 'doctor', 'یکشنبه و سه‌شنبه', '۱۰:۰۰ الی ۱۸:۰۰', '2026-09-05 13:32:08');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('3', '1', '11', '1', 'doctor', 'شنبه تا چهارشنبه', '۱۴:۰۰ الی ۲۰:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('4', '1', '9', '0', 'doctor', 'یکشنبه و سه‌شنبه', '۱۶:۰۰ الی ۲۱:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('5', '1', '14', '0', 'doctor', 'همه روزه (شیفت اورژانس)', '۲۱:۰۰ الی ۰۸:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('6', '4', '9', '1', 'doctor', 'شنبه، دوشنبه، چهارشنبه', '۱۶:۰۰ الی ۲۱:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('7', '4', '14', '0', 'doctor', 'روزهای فرد و پنجشنبه', '۱۴:۰۰ الی ۲۲:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('8', '2', '10', '1', 'doctor', 'شنبه تا پنجشنبه', '۱۰:۰۰ الی ۱۸:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('9', '2', '12', '0', 'doctor', 'یکشنبه و سه‌شنبه', '۱۴:۰۰ الی ۲۰:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('10', '6', '12', '1', 'doctor', 'شنبه تا چهارشنبه', '۰۹:۰۰ الی ۱۵:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('11', '6', '10', '0', 'doctor', 'پنجشنبه‌ها', '۱۰:۰۰ الی ۱۷:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('12', '7', '13', '1', 'doctor', 'شنبه تا پنجشنبه', '۱۰:۰۰ الی ۲۰:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('13', '9', '11', '1', 'doctor', 'جمعه‌ها (امداد و جراحی)', '۰۹:۰۰ الی ۱۸:۰۰', '2026-09-05 13:50:26');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('14', '1', '15', '0', 'groomer', 'شنبه تا چهارشنبه', '۱۰:۰۰ الی ۱۹:۰۰', '2026-09-07 17:21:40');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('15', '1', '16', '0', 'groomer', 'شنبه تا چهارشنبه', '۱۰:۰۰ الی ۱۹:۰۰', '2026-09-07 17:21:58');
INSERT INTO `organization_doctors` (`id`, `organization_id`, `doctor_id`, `is_head_physician`, `role_type`, `working_days`, `working_hours`, `created_at`) VALUES ('17', '2', '16', '0', 'doctor', 'یکشنبه و سه‌شنبه', '۱۰:۰۰ الی ۱۸:۰۰', '2026-09-09 17:21:19');

DROP TABLE IF EXISTS `organization_inventory`;
CREATE TABLE `organization_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `item_type` enum('product','medicine') DEFAULT 'medicine',
  `item_id` int(11) NOT NULL,
  `stock` int(11) DEFAULT 10,
  `custom_price` decimal(12,2) DEFAULT NULL,
  `is_in_stock` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_org_item` (`organization_id`,`item_type`,`item_id`),
  CONSTRAINT `organization_inventory_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('1', '1', 'medicine', '1', '20', '280000.00', '1', '2026-09-05 13:32:08');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('2', '1', 'medicine', '2', '15', '195000.00', '1', '2026-09-05 13:32:08');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('3', '1', 'product', '1', '8', '650000.00', '1', '2026-09-05 13:32:08');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('4', '2', 'medicine', '3', '12', '310000.00', '1', '2026-09-05 13:32:08');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('5', '2', 'product', '2', '40', '95000.00', '1', '2026-09-05 13:32:08');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('6', '1', 'medicine', '1', '20', '280000.00', '1', '2026-09-09 17:21:19');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('7', '1', 'medicine', '2', '15', '195000.00', '1', '2026-09-09 17:21:19');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('8', '1', 'product', '1', '8', '650000.00', '1', '2026-09-09 17:21:19');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('9', '2', 'medicine', '3', '12', '310000.00', '1', '2026-09-09 17:21:19');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('10', '2', 'product', '2', '40', '95000.00', '1', '2026-09-09 17:21:19');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('11', '1', 'medicine', '1', '20', '280000.00', '1', '2026-09-09 18:30:17');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('12', '1', 'medicine', '2', '15', '195000.00', '1', '2026-09-09 18:30:17');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('13', '1', 'product', '1', '8', '650000.00', '1', '2026-09-09 18:30:17');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('14', '2', 'medicine', '3', '12', '310000.00', '1', '2026-09-09 18:30:17');
INSERT INTO `organization_inventory` (`id`, `organization_id`, `item_type`, `item_id`, `stock`, `custom_price`, `is_in_stock`, `created_at`) VALUES ('15', '2', 'product', '2', '40', '95000.00', '1', '2026-09-09 18:30:17');

DROP TABLE IF EXISTS `organizations`;
CREATE TABLE `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` enum('hospital','clinic','pharmacy','shelter_charity','emergency_center','diagnostic_lab') DEFAULT 'clinic',
  `license_number` varchar(100) DEFAULT NULL,
  `license_document_url` varchar(255) DEFAULT NULL,
  `manager_name` varchar(150) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `emergency_phone` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `province` varchar(100) NOT NULL DEFAULT 'تهران',
  `city` varchar(100) NOT NULL DEFAULT 'تهران',
  `address` text NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `operating_hours` varchar(255) NOT NULL DEFAULT 'شنبه تا پنجشنبه ۸ الی ۲۲',
  `is_24_7` tinyint(1) DEFAULT 0,
  `hide_doctors_roster` tinyint(1) DEFAULT 0,
  `direct_booking_enabled` tinyint(1) DEFAULT 1,
  `consultation_fee` int(11) DEFAULT 250000,
  `logo_url` varchar(255) DEFAULT NULL,
  `banner_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `facilities` text DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 5.0,
  `review_count` int(11) DEFAULT 0,
  `status` enum('pending','approved','rejected','suspended') DEFAULT 'approved',
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_org_slug` (`slug`),
  KEY `idx_org_city` (`city`),
  KEY `idx_org_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `organizations` (`id`, `user_id`, `name`, `slug`, `type`, `license_number`, `license_document_url`, `manager_name`, `phone`, `emergency_phone`, `email`, `website`, `instagram`, `province`, `city`, `address`, `latitude`, `longitude`, `operating_hours`, `is_24_7`, `hide_doctors_roster`, `direct_booking_enabled`, `consultation_fee`, `logo_url`, `banner_url`, `description`, `facilities`, `rating`, `review_count`, `status`, `rejection_reason`, `created_at`) VALUES ('1', '5', 'بیمارستان فوق تخصصی دامپزشکی پایتخت', 'payetakht-hospital', 'hospital', 'IR-VET-HOSP-9481', NULL, 'دکتر کامران شایان', '02188776655', '09121112233', 'info@payetakht-vet.ir', 'https://payetakht-vet.ir', 'payetakht_vet_hospital', 'تهران', 'تهران', 'خیابان ولیعصر، بالاتر از پارک ساعی، نبش کوچه شمس، پلاک ۱۲', '35.73500000', '51.41100000', 'شبانه روزی ۲۴/۷ (شامل اورژانس و ICU)', '1', '0', '1', '250000', 'assets/images/organizations/payetakht-hospital-logo.svg', 'assets/images/cat-hero.jpg', 'مجهزترین مرکز درمانی، جراحی و تشخیصی حیوانات خانگی کشور با کادر اساتید دانشگاهی و بخش‌های بستری مجزا برای سگ و گربه.', 'بخش جراحی قلب و ارتوپدی, رادیولوژی دیجیتال DR, سونوگرافی کالر داپلر, انکوباتور اکسیژن ICU, آزمایشگاه تخصصی خون, آمبولانس اختصاصی, داروخانه شبانه‌روزی', '5.0', '4', 'approved', NULL, '2026-09-05 13:32:08');
INSERT INTO `organizations` (`id`, `user_id`, `name`, `slug`, `type`, `license_number`, `license_document_url`, `manager_name`, `phone`, `emergency_phone`, `email`, `website`, `instagram`, `province`, `city`, `address`, `latitude`, `longitude`, `operating_hours`, `is_24_7`, `hide_doctors_roster`, `direct_booking_enabled`, `consultation_fee`, `logo_url`, `banner_url`, `description`, `facilities`, `rating`, `review_count`, `status`, `rejection_reason`, `created_at`) VALUES ('2', NULL, 'کلینیک تخصصی و جراحی پرشین پت', 'persian-pet-clinic', 'clinic', 'IR-VET-CLN-8812', NULL, 'دکتر هما مهرزاد', '02122334455', '09122223344', 'contact@persianpetclinic.com', 'https://persianpetclinic.com', 'persian_pet_clinic', 'تهران', 'تهران', 'سعادت‌آباد، میدان کاج، خیابان سرو غربی، پلاک ۲۸، طبقه همکف', '35.78200000', '51.37400000', 'شنبه تا پنجشنبه ۹:۰۰ الی ۲۲:۰۰', '0', '0', '1', '250000', 'assets/images/organizations/persian-pet-clinic-logo.svg', 'assets/images/dog-avatar.svg', 'ارائه کلیه خدمات واکسیناسیون، دندانپزشکی، جراحی بافت نرم، عقیم‌سازی و مشاوره تغذیه با پیشرفته‌ترین دستگاه‌های بیهوشی استنشاقی.', 'جراحی بافت نرم و عقیم‌سازی, یونیت دندانپزشکی اولتراسونیک, پت‌شاپ دارویی, آرایش و شستشوی طبی, میکروچیپ و شناسنامه بین‌المللی', '4.8', '92', 'approved', NULL, '2026-09-05 13:32:08');
INSERT INTO `organizations` (`id`, `user_id`, `name`, `slug`, `type`, `license_number`, `license_document_url`, `manager_name`, `phone`, `emergency_phone`, `email`, `website`, `instagram`, `province`, `city`, `address`, `latitude`, `longitude`, `operating_hours`, `is_24_7`, `hide_doctors_roster`, `direct_booking_enabled`, `consultation_fee`, `logo_url`, `banner_url`, `description`, `facilities`, `rating`, `review_count`, `status`, `rejection_reason`, `created_at`) VALUES ('4', NULL, 'بیمارستان مرکزی دامپزشکی شیراز', 'shiraz-central-hospital', 'hospital', 'IR-VET-HOSP-7201', NULL, 'دکتر سهراب علوی', '07136280000', '09173339900', 'contact@shiraz-vethospital.com', 'https://shiraz-vethospital.com', 'shiraz_central_vet', 'فارس', 'شیراز', 'بلوار قصرالدشت، روبروی کوچه ۵۸، جنب مجتمع پزشکی نگین', '29.63800000', '52.51200000', 'شبانه روزی ۲۴/۷ (اورژانس، ترومای جراحی و بستری)', '1', '0', '1', '250000', 'assets/images/organizations/shiraz-hospital-logo.svg', 'assets/images/cat-hero.jpg', 'بزرگترین بیمارستان مرجع دامپزشکی جنوب کشور مجهز به بخش جراحی مغز و اعصاب حیوانات، سی‌تی‌اسکن، فیزیوتراپی و استخر آب‌درمانی، با ظرفیت بستری ۵۰ قلاده سگ و گربه در فضایی کاملاً استاندارد و استریل.', 'اورژانس شبانه‌روزی ۲۴ ساعته, جراحی ستون فقرات و مفاصل, فیزیوتراپی و هیدروتراپی, آندوسکوپی گوارشی, آزمایشگاه پاتولوژی, داروخانه تخصصی', '4.9', '112', 'approved', NULL, '2026-09-05 13:50:26');
INSERT INTO `organizations` (`id`, `user_id`, `name`, `slug`, `type`, `license_number`, `license_document_url`, `manager_name`, `phone`, `emergency_phone`, `email`, `website`, `instagram`, `province`, `city`, `address`, `latitude`, `longitude`, `operating_hours`, `is_24_7`, `hide_doctors_roster`, `direct_booking_enabled`, `consultation_fee`, `logo_url`, `banner_url`, `description`, `facilities`, `rating`, `review_count`, `status`, `rejection_reason`, `created_at`) VALUES ('6', NULL, 'کلینیک تخصصی دامپزشکی باران اصفهان', 'baran-vet-clinic', 'clinic', 'IR-VET-CLN-5120', NULL, 'دکتر مریم صادقی', '03136691234', '09132228811', 'info@baran-vet.ir', 'https://baran-vet.ir', 'baran_vet_isfahan', 'اصفهان', 'اصفهان', 'خیابان مرداویج، میدان برج، خیابان رسالت، پلاک ۱۴', '32.61500000', '51.66800000', 'شنبه تا پنجشنبه ۸:۳۰ الی ۲۱:۳۰ (جمعه‌ها با هماهنگی قبلی)', '0', '0', '1', '250000', 'assets/images/organizations/baran-clinic-logo.svg', 'assets/images/cat-hero.jpg', 'کلینیک پیشرو در استان اصفهان در زمینه چکاپ‌های منظم پیشگیرانه، واکسیناسیون استاندارد، دندانپزشکی بدون درد، چشم‌پزشکی و مراقبت‌های گوارشی گربه و سگ با محیطی آرامش‌بخش و بدون استرس (Fear-Free).', 'کلینیک دوستدار گربه (Cat Friendly), دندانپزشکی تخصصی, آزمایشگاه سریع و تست‌های ویروسی, داروخانه ملزومات, پانسیون روزانه', '4.7', '64', 'approved', NULL, '2026-09-05 13:50:26');
INSERT INTO `organizations` (`id`, `user_id`, `name`, `slug`, `type`, `license_number`, `license_document_url`, `manager_name`, `phone`, `emergency_phone`, `email`, `website`, `instagram`, `province`, `city`, `address`, `latitude`, `longitude`, `operating_hours`, `is_24_7`, `hide_doctors_roster`, `direct_booking_enabled`, `consultation_fee`, `logo_url`, `banner_url`, `description`, `facilities`, `rating`, `review_count`, `status`, `rejection_reason`, `created_at`) VALUES ('7', NULL, 'کلینیک تخصصی پرندگان زینتی و اگزوتیک کاسپین', 'caspian-exotic-clinic', 'clinic', 'IR-VET-CLN-6390', NULL, 'دکتر پوریا رستمی', '05138405555', '09151234567', 'info@caspian-birds.ir', 'https://caspian-birds.ir', 'caspian_exotic_vet', 'خراسان رضوی', 'مشهد', 'خیابان احمدآباد، نبش ملاصدرا ۲، ساختمان پزشکان سپهر', '36.29700000', '59.57500000', 'شنبه تا چهارشنبه ۱۰:۰۰ الی ۲۰:۰۰', '0', '0', '1', '250000', 'assets/images/organizations/caspian-exotic-logo.svg', 'assets/images/cat-hero.jpg', 'تنها مرکز فوق‌تخصصی شمال شرق کشور برای ویزیت، درمان بیماری‌های قارچی و تنفسی، جراحی ارتوپدی استخوان بال، منقار و بیهوشی ایمن طوطی کاسکو، مرغ عشق، خرگوش، همستر و خزندگان.', 'انکوباتور پرندگان, رادیوگرافی میکرو, آندوسکوپی تنفسی, تست‌های تعیین جنسیت DNA, آزمایشگاه تخصصی پرندگان', '4.9', '78', 'approved', NULL, '2026-09-05 13:50:26');
INSERT INTO `organizations` (`id`, `user_id`, `name`, `slug`, `type`, `license_number`, `license_document_url`, `manager_name`, `phone`, `emergency_phone`, `email`, `website`, `instagram`, `province`, `city`, `address`, `latitude`, `longitude`, `operating_hours`, `is_24_7`, `hide_doctors_roster`, `direct_booking_enabled`, `consultation_fee`, `logo_url`, `banner_url`, `description`, `facilities`, `rating`, `review_count`, `status`, `rejection_reason`, `created_at`) VALUES ('8', NULL, 'داروخانه تخصصی دامپزشکی رازی', 'razi-vet-pharmacy', 'pharmacy', 'IR-VET-PHAR-3392', NULL, 'دکتر بهنام فرهمند', '02166442211', '09127778899', 'order@razi-vetpharmacy.com', 'https://razi-vetpharmacy.com', 'razi_vet_pharmacy', 'تهران', 'تهران', 'خیابان انقلاب، ابتدای خیابان فلسطین جنوبی، پلاک ۸۲', '35.70100000', '51.40300000', 'شبانه روزی ۲۴/۷ (تامین داروهای نایاب و مکمل‌های درمانی)', '1', '0', '1', '250000', 'assets/images/organizations/razi-pharmacy-logo.svg', 'assets/images/cat-hero.jpg', 'جامع‌ترین مرکز پخش و تامین داروهای تخصصی دامپزشکی، آنتی‌بیوتیک‌های کمیاب، داروهای قلبی و کلیوی، رژیم‌های درمانی رویال کنین و هیلز، و زنجیره سرد واکسن با ارسال فوری به سراسر کشور.', 'زنجیره سرد استاندارد واکسن, تایید آنلاین نسخ دامپزشکی, ارسال با پیک یخچالی, مشاوره داروساز دامی, رژیم‌های درمانی ویژه', '4.9', '135', 'approved', NULL, '2026-09-05 13:50:26');
INSERT INTO `organizations` (`id`, `user_id`, `name`, `slug`, `type`, `license_number`, `license_document_url`, `manager_name`, `phone`, `emergency_phone`, `email`, `website`, `instagram`, `province`, `city`, `address`, `latitude`, `longitude`, `operating_hours`, `is_24_7`, `hide_doctors_roster`, `direct_booking_enabled`, `consultation_fee`, `logo_url`, `banner_url`, `description`, `facilities`, `rating`, `review_count`, `status`, `rejection_reason`, `created_at`) VALUES ('9', NULL, 'پناهگاه و نقاهتگاه حمایتی حیوانات وفا', 'vafa-animal-shelter', 'shelter_charity', 'IR-NGO-SHELTER-104', NULL, 'مهندس آرش شریفی', '02644229988', '09359998877', 'help@vafa-shelter.org', 'https://vafa-shelter.org', 'vafa_animal_shelter', 'البرز', 'کرج', 'جاده مخصوص کرج، انتهای هشتگرد، دشت بهشت، مجتمع توانبخشی حیوانات', '35.95200000', '50.68100000', 'همه روزه ۸:۰۰ الی ۱۸:۰۰ (پذیرش کیس امدادی ۲۴ ساعته)', '1', '0', '1', '250000', 'assets/images/organizations/vafa-shelter-logo.svg', 'assets/images/dog-avatar.svg', 'بزرگترین پناهگاه مردم‌نهاد و غیرانتفاعی جهت نجات، درمان، عقیم‌سازی و بازپروری سگ‌ها و گربه‌های آسیب‌دیده با کلینیک صحرایی و همکاری داوطلبانه مجرب‌ترین جراحان کشور.', 'کلینیک جراحی و عقیم‌سازی امدادی, بخش قرنطینه و واکسیناسیون, حیاط‌های بازی و توانبخشی, سامانه آنلاین سرپرستی رایگان, آمبولانس امداد', '5.0', '240', 'approved', NULL, '2026-09-05 13:50:26');

DROP TABLE IF EXISTS `pet_documents`;
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

DROP TABLE IF EXISTS `pet_health_records`;
CREATE TABLE `pet_health_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pet_name` varchar(150) NOT NULL,
  `species` enum('dog','cat','bird','horse','cow','rabbit','other') DEFAULT 'dog',
  `breed` varchar(150) DEFAULT NULL,
  `gender` enum('male','female','neutered_male','spayed_female') DEFAULT 'male',
  `birth_date` date DEFAULT NULL,
  `weight_kg` decimal(5,2) DEFAULT NULL,
  `microchip_id` varchar(100) DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `chronic_conditions` text DEFAULT NULL,
  `rabies_tag_num` varchar(100) DEFAULT NULL,
  `avatar_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_pet_user` (`user_id`),
  CONSTRAINT `fk_pet_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pet_vaccinations`;
CREATE TABLE `pet_vaccinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_id` int(11) NOT NULL,
  `vaccine_name` varchar(200) NOT NULL,
  `administered_date` date NOT NULL,
  `next_due_date` date DEFAULT NULL,
  `vet_name` varchar(150) DEFAULT NULL,
  `clinic_name` varchar(200) DEFAULT NULL,
  `batch_number` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `reminder_sent_sms` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_vac_pet` (`pet_id`),
  CONSTRAINT `fk_vac_pet` FOREIGN KEY (`pet_id`) REFERENCES `pet_health_records` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pharmacy_medicines`;
CREATE TABLE `pharmacy_medicines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `generic_name` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `brand` varchar(100) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 10,
  `target_animal` varchar(50) DEFAULT 'all',
  `pharmacy_tag` varchar(100) DEFAULT NULL,
  `requires_cold_chain` tinyint(1) NOT NULL DEFAULT 0,
  `requires_prescription` tinyint(1) NOT NULL DEFAULT 0,
  `storage_temperature` varchar(50) DEFAULT '15-25°C',
  `dosage_instructions` text DEFAULT NULL,
  `is_autoship` tinyint(1) NOT NULL DEFAULT 0,
  `baseline_rating` decimal(3,1) DEFAULT 4.8,
  `autoship_discount` int(11) DEFAULT 10,
  `rating_cache` decimal(2,1) DEFAULT 4.5,
  `review_count_cache` int(11) DEFAULT 0,
  `moq` int(11) DEFAULT 1,
  `is_b2b_only` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_medicines_category` (`category`),
  KEY `idx_med_animal` (`category`,`target_animal`),
  KEY `idx_med_pharmacy_tag` (`pharmacy_tag`),
  KEY `idx_med_is_autoship` (`is_autoship`),
  KEY `idx_med_cold_chain` (`requires_cold_chain`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('1', 'مکمل ویتامینه و اسید آمینه بایوتین پلاس تقویت سم و موی اسب', 'Biotin + Zinc + Methionine Equine Supplement', 'مکمل درمانی اسب', '1450000', '1290000', 'https://images.unsplash.com/photo-1553284965-83fd3e82fa5a?w=600&auto=format&fit=crop&q=80', 'مکمل تخصصی سم اسب حاوی دوز بالای بایوتین، متیونین و روی آلی جهت تسریع در ترمیم دیواره و کف سم و براقیت پوشش مو.', '2026-08-27 11:47:32', 'وتوکینول (Vetoquinol)', '15', 'horse', 'hoof_care', '0', '0', '15-25°C', NULL, '1', '4.8', '10', '4.9', '32', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('2', 'پماد موضعی ضد باکتری و ترمیم‌کننده زخم و ترک گوشت سم اسب', 'Antibacterial Equine Hoof Ointment', 'پماد و ضدعفونی', '780000', '690000', 'https://images.unsplash.com/photo-1534447677768-be436bb09401?w=600&auto=format&fit=crop&q=80', 'حاوی روغن درخت چای، اسید سالیسیلیک و اکسید روی با خاصیت ضدقارچ و ضد رطوبت شدید برای درمان گندیدگی شیار سم (Thrush).', '2026-08-27 11:47:32', 'فارنام (Farnam)', '20', 'horse', 'hoof_care', '0', '0', '15-25°C', NULL, '1', '4.8', '15', '4.8', '24', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('3', 'ژل ضد التهاب و مسکن مفاصل و تاندون‌های اسب مسابقه اکوافلکس', 'Menthol & Arnica Cooling Equine Gel', 'داروهای موضعی و تسکین‌دهنده', '920000', '840000', 'https://images.unsplash.com/photo-1598974357801-cbca100e6571?w=600&auto=format&fit=crop&q=80', 'ژل خنک‌کننده گیاهی بر پایه منتول و آرنیکا برای کاهش ورم تاندون، رفع اسپاسم عضلانی و کوفتگی پس از تمرینات سنگین.', '2026-08-27 11:47:32', 'اکواین آمریکا', '12', 'horse', 'pain_management', '0', '0', '15-25°C', NULL, '1', '4.8', '10', '5.0', '41', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('4', 'خمیر خوراکی ضد انگل آیورمکتین اسب (اکوئالان دوتایی)', 'Ivermectin 1.87% Equine Oral Paste', 'ضد انگل و کرم‌کش', '540000', '480000', 'https://images.unsplash.com/photo-1568640347023-a616a30bc3bd?w=600&auto=format&fit=crop&q=80', 'سرنگ مدرج دوز دقیق برای از بین بردن انواع انگل‌های دستگاه گوارش، لارو ربات و انگل‌های ریوی در اسب و کره اسب.', '2026-08-27 11:47:32', 'بوریینگر اینگلهایم', '30', 'horse', 'dewormer', '0', '1', '15-25°C', NULL, '1', '4.8', '12', '4.9', '56', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('5', 'سوسپانسیون پستانی آنتی‌بیوتیک دوره خشکی گاو شیری (مستیکس)', 'Cloxacillin + Ampicillin Dry Cow Intramammary Infusion', 'آنتی بیوتیک پستانی', '320000', '280000', 'https://images.unsplash.com/photo-1546445317-29f4545e9d53?w=600&auto=format&fit=crop&q=80', 'سرنگ پستانی با اثر درازمدت جهت پیشگیری و درمان ورم پستان زیربالینی در دوره خشکی گله‌های صنعتی.', '2026-08-27 11:47:32', 'زوئتیس (Zoetis)', '50', 'cow', 'antibiotics', '0', '1', '15-25°C', NULL, '1', '4.8', '10', '4.9', '64', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('6', 'بولوس کلسیم دیرحل تقویتی پس از زایمان گاو شیری (کالسی‌بل)', 'Calcium Bolus for Dairy Cows', 'مکمل الکترولیت و کلسیم', '890000', '790000', 'https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?w=600&auto=format&fit=crop&q=80', 'حاوی کلرید و سولفات کلسیم با جذب سریع و ماندگار جهت جلوگیری از فلج زایمان (تب شیر) و افت کلسیم خون.', '2026-08-27 11:47:32', 'وت‌فارما', '25', 'cow', 'vitamins', '0', '0', '15-25°C', NULL, '1', '4.8', '15', '4.7', '19', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('7', 'محلول غلیظ اسپری و غوطه‌وری ضدعفونی سم گاو (دیپ سم سولفات مس و روی)', 'Copper & Zinc Chelate Hoof Bath Solution', 'مراقبت سم و بهداشت دامپزشکی', '1250000', '1100000', 'https://images.unsplash.com/photo-1527153857715-3908f2ae5e81?w=600&auto=format&fit=crop&q=80', 'فرمولاسیون پایدار کلات روی و مس جهت درمان و کنترل درماتیت انگشتی، گندیدگی سم و لنگش گله.', '2026-08-27 11:47:32', 'دلاوال (DeLaval)', '18', 'cow', 'hoof_care', '0', '0', '15-25°C', NULL, '1', '4.8', '10', '4.8', '27', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('8', 'محلول تزریقی اکسی‌تتراسایکلین طولانی‌اثر ۲۰٪ (ال‌ای)', 'Oxytetracycline 20% LA Injectable', 'آنتی بیوتیک سیستمیک', '430000', '380000', 'https://images.unsplash.com/photo-1500595046743-cd271d694d30?w=600&auto=format&fit=crop&q=80', 'آنتی‌بیوتیک وسیع‌الطیف تزریقی با اثر ۴۸ ساعته جهت عفونت‌های ریوی، پنومونی، آناپلاسموز و عفونت‌های رحمی دام.', '2026-08-27 11:47:32', 'نصر داروی دامی', '40', 'cow', 'antibiotics', '0', '1', '15-25°C', NULL, '0', '4.8', '5', '4.9', '48', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('9', 'محلول خوراکی مولتی ویتامین + الکترولیت + اسید آمینه طیور (ویتالیت)', 'Multi-Vitamin + Amino Acids + Electrolytes Solution', 'ویتامین و الکترولیت طیور', '380000', '330000', 'https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?w=600&auto=format&fit=crop&q=80', 'کاهش سریع استرس گرمایی، استرس واکسیناسیون، تقویت سیستم ایمنی و افزایش راندمان رشد جوجه گوشتی و تخم‌گذار.', '2026-08-27 11:47:32', 'کیمیافام', '60', 'chick', 'vitamins', '0', '0', '15-25°C', NULL, '1', '4.8', '12', '4.8', '52', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('10', 'پودر محلول در آب ضد کوکسیدیوز و اسهال خونی طیور (آمپرولیوم ۲۰٪)', 'Amprolium 20% Soluble Powder', 'ضد انگل گوارشی و کوکسیدیوز', '290000', '250000', 'https://images.unsplash.com/photo-1563281577-a7be47e20db9?w=600&auto=format&fit=crop&q=80', 'داروی انتخابی در کنترل و ریشه‌کنی انواع گونه‌های ایمریا (کوکسیدیوز روده‌ای و سکومی) در گله‌های جوجه و بوقلمون.', '2026-08-27 11:47:32', 'داروسازی دامپزشکی ایران', '45', 'chick', 'dewormer', '0', '1', '15-25°C', NULL, '1', '4.8', '10', '4.9', '38', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('11', 'محلول برونکودیلاتور گیاهی تنفسی و ضد سرفه جوجه و پرندگان (منتوفین)', 'Menthol + Eucalyptus Respiratory Solution', 'تقویت سیستم تنفسی', '510000', '450000', 'https://images.unsplash.com/photo-1596797882870-8c33deeac224?w=600&auto=format&fit=crop&q=80', 'عصاره خالص اکالیپتوس و نعناع فلفلی جهت اسپری محیطی یا آبخوری برای تسکین خس‌خس سینه و بازکردن مجاری هوایی.', '2026-08-27 11:47:32', 'یوولس (Ewabo)', '35', 'chick', 'inflammation', '0', '0', '15-25°C', NULL, '1', '4.8', '10', '4.7', '29', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('12', 'واکسن زنجیره سرد برونشیت عفونی و نیوکاسل جوجه (H120 + لاسونا)', 'Newcastle + Infectious Bronchitis Live Vaccine (Cold Chain 2-8°C)', 'واکسن و بیولوژیک (زنجیره سرد)', '620000', '550000', 'https://images.unsplash.com/photo-1516467508483-a7212febe31a?w=600&auto=format&fit=crop&q=80', 'واکسن زنده لیوفیلیزه با ارسال فوق سریع با یخدان آیس‌پک استاندارد برای مصونیت‌بخشی قطره چشمی یا اسپری.', '2026-08-27 11:47:32', 'مریال / بوهرینگر', '20', 'chick', 'cold_chain', '1', '1', '2-8°C (یخدان زنجیره سرد)', NULL, '0', '4.8', '5', '5.0', '74', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('13', 'قرص تخصصی غضروف‌ساز و ضد درد مفاصل سگ آرتروفلکس پلاس', 'Glucosamine + Chondroitin + MSM Joint Care', 'غضروف ساز و استخوان', '780000', '690000', 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=600&auto=format&fit=crop&q=80', 'فرمول حاوی گلوکوزامین، کندرویتین و MSM جهت کاهش خشکی مفاصل، بهبود دیسپلازی مفصل ران و روان‌سازی حرکت سگ‌های سالخورده.', '2026-08-27 11:47:32', 'بفار (Beaphar)', '40', 'dog', 'pain_management', '0', '0', '15-25°C', NULL, '1', '4.8', '15', '5.0', '49', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('14', 'قرص جویدنی ضد انگل ۴ گانه سگ درونتال پلاس', 'Praziquantel + Pyrantel + Febantel (Drontal Plus)', 'ضد انگل گوارشی', '380000', '340000', 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=600&auto=format&fit=crop&q=80', 'طعم‌دار گوشتی با پذیرش بالا، ریشه‌کن‌کننده انواع کرم‌های نواری، قلابدار، گرد و ژیاردیا در سگ.', '2026-08-27 11:47:32', 'بایر (Bayer)', '55', 'dog', 'dewormer', '0', '1', '15-25°C', NULL, '1', '4.8', '10', '4.9', '61', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('15', 'محلول گوش‌پاک‌کن ضد باکتری و ضد قارچ سگ و گربه اتوفلوکس', 'Chlorhexidine + Tris-EDTA Otic Cleanser', 'قطره و مراقبت گوش', '310000', '260000', 'https://images.unsplash.com/photo-1537151608828-ea2b11777ee8?w=600&auto=format&fit=crop&q=80', 'شستشوی عمقی کانال گوش، رفع بوی بد، تجزیه جرم‌های چرب و تسکین خارش ناشی از عفونت‌های اوتیت میانی.', '2026-08-27 11:47:32', 'وتوکینول (Vetoquinol)', '30', 'dog', 'first_aid', '0', '0', '15-25°C', NULL, '1', '4.8', '10', '4.7', '15', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('16', 'کپسول دارویی ضد درد و ضد التهاب غیر استروئیدی سگ کارپروفن ۵۰', 'Carprofen 50mg NSAID Analgesic', 'مسکن و ضد درد', '590000', '520000', 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=600&auto=format&fit=crop&q=80', 'تسکین فوق‌العاده درد و التهاب پس از اعمال جراحی ارتوپدی و کنترل دردهای مزمن استئوآرتریت سگ.', '2026-08-27 11:47:32', 'وت‌فارما', '25', 'dog', 'pain_management', '0', '1', '15-25°C', NULL, '1', '4.8', '10', '4.8', '29', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('17', 'اسپری استنشاقی و ضد اسپاسم تنفسی سگ‌های نژاد پوزه‌کوتاه', 'Salbutamol + Beclomethasone Vet Inhaler', 'اسپری تنفسی و ضد التهاب', '640000', '560000', 'https://images.unsplash.com/photo-1517849845537-4d257902454a?w=600&auto=format&fit=crop&q=80', 'اسپری تخصصی جهت بهبود تنفس، کاهش التهاب مجاری تنفسی و آسم در سگ‌های بولداگ، پاگ و شیتزو.', '2026-08-27 11:47:32', 'پت‌مدیکال', '18', 'dog', 'inflammation', '0', '1', '15-25°C', NULL, '1', '4.8', '10', '4.9', '21', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('18', 'کیت جامع کمک‌های اولیه اورژانسی سگ و حیوانات خانگی', 'Veterinary Emergency First Aid Kit', 'کمک‌های اولیه و پانسمان', '890000', '780000', 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600&auto=format&fit=crop&q=80', 'شامل بتادین حیوانی، بانداژ خودچسب، پنس کنه کش، دماسنج دیجیتال، پد گاز استریل و اسپری التیام زخم.', '2026-08-27 11:47:32', 'تریکسی', '30', 'dog', 'first_aid', '0', '0', '15-25°C', NULL, '0', '4.8', '5', '4.9', '35', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('19', 'بالم ارگانیک نرم‌کننده و محافظ پد پنجه سگ و گربه', 'Organic Paw Protection & Repair Balm', 'مراقبت پوست و پنجه', '280000', '230000', 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=600&auto=format&fit=crop&q=80', 'بالم کاملاً طبیعی حاوی شی باتر و موم عسل برای بازسازی ترک خوردگی و خشکی پنجه ناشی از پیاده‌روی روی آسفالت گرم یا سرد.', '2026-08-27 11:47:32', 'پت‌کر', '35', 'dog', 'hoof_care', '0', '0', '15-25°C', NULL, '1', '4.8', '10', '4.7', '18', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('20', 'خمیر مالت و مکمل ویتامینه تقویت ایمنی گربه جیم کت', 'GimCat Multi-Vitamin & Hairball Paste', 'مکمل مالت و ویتامینه گربه', '460000', '390000', 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=600&auto=format&fit=crop&q=80', 'دفع آسان گلوله‌های مویی (Hairball) و تقویت پوشش مو و ناخن گربه با ویتامین‌های گروه B و زینک.', '2026-08-27 11:47:32', 'جیم کت (GimCat)', '45', 'cat', 'vitamins', '0', '0', '15-25°C', NULL, '1', '4.8', '15', '5.0', '78', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('21', 'قطره ضد استرس و فرومون آرامبخش درمانی گربه فلی‌وی', 'Feliway Feline Facial Pheromone Calming Spray', 'فرومون و آرامبخش درمانی', '720000', '640000', 'https://images.unsplash.com/photo-1573865526739-10659fec78a5?w=600&auto=format&fit=crop&q=80', 'کاهش اضطراب محیطی، ترس از سفر، پرخاشگری و رفتارهای نشانه‌گذاری با تقلید فرومون چهره‌ای مادر.', '2026-08-27 11:47:32', 'فلی‌وی (Feliway)', '20', 'cat', 'therapy', '0', '0', '15-25°C', NULL, '1', '4.8', '10', '4.9', '43', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('22', 'قطره موضعی ضد کک، کنه و انگل‌های پوستی گربه ادوکیت', 'Advocate Imidacloprid + Moxidectin Spot-On', 'ضد کک، کنه و انگل موضعی', '520000', '450000', 'https://images.unsplash.com/photo-1533738363-b7f9aef128ce?w=600&auto=format&fit=crop&q=80', 'محافظت ماهیانه پشت گردنی علیه طیف گسترده‌ای از انگل‌های خارجی و جرب گوش در گربه‌ها.', '2026-08-27 11:47:32', 'بایر (Bayer)', '35', 'cat', 'dewormer', '0', '1', '15-25°C', NULL, '1', '4.8', '12', '4.8', '37', '1', '0');
INSERT INTO `pharmacy_medicines` (`id`, `name`, `generic_name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `target_animal`, `pharmacy_tag`, `requires_cold_chain`, `requires_prescription`, `storage_temperature`, `dosage_instructions`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('23', 'قطره اشک شستشو و رفع عفونت و التهاب چشم گربه', 'Sterile Ophthalmic Eye Drops for Cats', 'قطره و شستشوی چشم', '290000', '240000', 'https://images.unsplash.com/photo-1495360010541-f48722b34f7d?w=600&auto=format&fit=crop&q=80', 'محلول استریل پاک‌کننده لکه‌های اشک زیر چشم و تسکین سوزش و التهابات ملتحمه در گربه‌های پرشین و DSH.', '2026-08-27 11:47:32', 'پت‌مدیکال', '40', 'cat', 'inflammation', '0', '0', '15-25°C', NULL, '1', '4.8', '10', '4.6', '19', '1', '0');

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `rx_file_url` varchar(500) NOT NULL,
  `clinic_name` varchar(255) DEFAULT NULL,
  `vet_name` varchar(150) DEFAULT NULL,
  `vet_phone` varchar(50) DEFAULT NULL,
  `vet_license_number` varchar(100) DEFAULT NULL,
  `status` enum('pending','approved','rejected','expired') DEFAULT 'pending',
  `pharmacist_notes` text DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_rx_user` (`user_id`),
  KEY `idx_rx_status` (`status`),
  KEY `idx_prescriptions_doctor` (`doctor_id`),
  CONSTRAINT `fk_rx_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `product_price_tiers`;
CREATE TABLE `product_price_tiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `is_pharmacy` tinyint(1) DEFAULT 0,
  `min_qty` int(11) NOT NULL DEFAULT 1,
  `max_qty` int(11) DEFAULT NULL,
  `discount_percent` decimal(5,2) NOT NULL DEFAULT 0.00,
  `unit_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_tier_product` (`product_id`,`is_pharmacy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(100) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `brand` varchar(100) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 10,
  `low_stock_threshold` int(11) DEFAULT 5,
  `target_animal` varchar(50) DEFAULT 'all',
  `pharmacy_tag` varchar(100) DEFAULT NULL,
  `is_autoship` tinyint(1) NOT NULL DEFAULT 0,
  `baseline_rating` decimal(3,1) DEFAULT 4.8,
  `autoship_discount` int(11) DEFAULT 10,
  `rating_cache` decimal(2,1) DEFAULT 4.5,
  `review_count_cache` int(11) DEFAULT 0,
  `moq` int(11) DEFAULT 1,
  `is_b2b_only` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_products_category` (`category`),
  KEY `idx_cat_animal` (`category`,`target_animal`),
  KEY `idx_pharmacy_tag` (`pharmacy_tag`),
  KEY `idx_is_autoship` (`is_autoship`),
  KEY `idx_seller` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('1', NULL, NULL, 'غذای خشک سگ بالغ نژاد کوچک رویال کنین مدل Mini Adult', 'غذای سگ', '2450000', '1980000', 'assets/images/products/royal-canin-mini-adult-dog.jpg', NULL, '2026-07-21 15:23:55', 'رویال کنین', '7', '5', 'dog', NULL, '1', '4.8', '15', '4.8', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('2', NULL, NULL, 'کنسرو لذیذ سالمون و مرغ فیست اند فلیور مخصوص گربه', 'غذای گربه', '420000', '245000', 'assets/images/products/gourmet-salmon-canned-cat.jpg', NULL, '2026-07-21 15:23:55', 'فیست اند فلیور', '10', '5', 'cat', NULL, '1', '4.8', '15', '4.8', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('3', NULL, NULL, 'قلاده چرمی سگ زولاکس سایز لارج', 'لوازم بهداشتی', '850000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR', NULL, '2026-07-21 15:23:55', 'جوسرا', '10', '5', 'all', NULL, '0', '4.8', '10', '4.8', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('4', NULL, NULL, 'توپ دندانی طناب‌دار', 'اسباب‌بازی', '220000', '180000', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR', NULL, '2026-07-21 15:23:55', 'جوسرا', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('5', NULL, NULL, 'خاک گربه پتوپیا ۱۰ کیلویی', 'لوازم بهداشتی', '350000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj', NULL, '2026-07-21 15:23:55', 'رفلکس', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('6', NULL, NULL, 'قطره مولتی‌ویتامین و تقویت ایمنی و مفاصل سگ و گربه وتری ویتالیتی', 'مکمل دارویی', '650000', '490000', 'assets/images/products/vetri-vitality-pet-drops.jpg', NULL, '2026-07-21 15:23:55', 'وتری ویتالیتی', '10', '5', 'all', 'therapy', '1', '4.8', '15', '4.8', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('7', NULL, NULL, 'درخت گربه ۳ طبقه کدیپک', 'اسباب‌بازی', '4200000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj', NULL, '2026-07-21 15:23:55', 'نوتری پت', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('8', NULL, NULL, 'شامپو ضد ریزش موی سگ تریکسی', 'لوازم بهداشتی', '280000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o', NULL, '2026-07-21 15:23:55', 'رفلکس', '9', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('9', NULL, NULL, 'غذای خشک گربه عقیم‌شده فلاین مدل Sterilised Adult', 'غذای گربه', '2850000', '2340000', 'assets/images/products/feline-sterilised-cat-food.jpg', NULL, '2026-07-21 15:23:55', 'رویال کنین / ناریش', '10', '5', 'cat', NULL, '1', '4.8', '15', '4.8', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('10', NULL, NULL, 'تشک خواب سگ سایز متوسط', 'لوازم بهداشتی', '950000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj', NULL, '2026-07-21 15:23:55', 'رفلکس', '10', '5', 'all', NULL, '0', '4.8', '10', '4.8', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('11', NULL, NULL, 'غذای خشک سگ بالغ مینی ادولت جوسرا مدل Miniwell', 'غذای سگ', '2450000', '1980000', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0', NULL, '2026-07-21 15:23:55', 'جوسرا', '10', '5', 'dog', NULL, '0', '4.8', '10', '4.8', '14', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('12', NULL, NULL, 'کنسرو گربه گورمت گلد با طعم مرغ', 'غذای گربه', '150000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0', NULL, '2026-07-21 15:23:55', 'رفلکس', '10', '5', 'cat', NULL, '1', '4.8', '10', '4.9', '22', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('13', NULL, NULL, 'قلاده چرمی سگ زولاکس سایز لارج', 'لوازم بهداشتی', '850000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR', NULL, '2026-07-21 15:23:55', 'نوتری پت', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('14', NULL, NULL, 'توپ دندانی طناب‌دار', 'اسباب‌بازی', '220000', '180000', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('15', NULL, NULL, 'خاک گربه پتوپیا ۱۰ کیلویی', 'لوازم بهداشتی', '350000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj', NULL, '2026-07-21 15:23:55', 'شایر', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('16', NULL, NULL, 'قطره مولتی ویتامین سگ و گربه', 'مکمل دارویی', '450000', '390000', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'all', 'therapy', '1', '4.8', '15', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('17', NULL, NULL, 'درخت گربه ۳ طبقه کدیپک', 'اسباب‌بازی', '4200000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('18', NULL, NULL, 'شامپو ضد ریزش موی سگ تریکسی', 'لوازم بهداشتی', '280000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o', NULL, '2026-07-21 15:23:55', 'پت‌کر', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('19', NULL, NULL, 'غذای خشک گربه بالغ عقیم شده رویال کنین', 'غذای گربه', '2850000', '2600000', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0', NULL, '2026-07-21 15:23:55', 'شایر', '10', '5', 'cat', NULL, '0', '4.8', '10', '4.9', '22', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('20', NULL, NULL, 'تشک خواب سگ سایز متوسط', 'لوازم بهداشتی', '950000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('21', NULL, NULL, 'غذای خشک سگ بالغ نژاد کوچک نوتری پت مدل Nutri Dog', 'غذای سگ', '2450000', '1980000', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0', NULL, '2026-07-21 15:23:55', 'نوتری پت', '10', '5', 'dog', NULL, '0', '4.8', '10', '4.8', '14', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('22', NULL, NULL, 'کنسرو گربه گورمت گلد با طعم مرغ', 'غذای گربه', '150000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'cat', NULL, '1', '4.8', '10', '4.9', '22', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('23', NULL, NULL, 'قلاده چرمی سگ زولاکس سایز لارج', 'لوازم بهداشتی', '850000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('24', NULL, NULL, 'توپ دندانی طناب‌دار', 'اسباب‌بازی', '220000', '180000', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR', NULL, '2026-07-21 15:23:55', 'رفلکس', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('25', NULL, NULL, 'خاک گربه پتوپیا ۱۰ کیلویی', 'لوازم بهداشتی', '350000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('26', NULL, NULL, 'قطره مولتی ویتامین سگ و گربه', 'مکمل دارویی', '450000', '390000', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'all', 'therapy', '1', '4.8', '15', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('27', NULL, NULL, 'درخت گربه ۳ طبقه کدیپک', 'اسباب‌بازی', '4200000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj', NULL, '2026-07-21 15:23:55', 'رفلکس', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('28', NULL, NULL, 'شامپو ضد ریزش موی سگ تریکسی', 'لوازم بهداشتی', '280000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o', NULL, '2026-07-21 15:23:55', 'رفلکس', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('29', NULL, NULL, 'غذای خشک گربه بالغ عقیم شده رویال کنین', 'غذای گربه', '2850000', '2600000', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'cat', NULL, '0', '4.8', '10', '4.9', '22', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('30', NULL, NULL, 'تشک خواب سگ سایز متوسط', 'لوازم بهداشتی', '950000', NULL, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj', NULL, '2026-07-21 15:23:55', 'رویال کنین', '10', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('31', NULL, NULL, 'Cat Toy Mouse Updated', 'Toys', '120000', '100000', 'assets/images/toy-mouse.jpg', 'Great toy for cats', '2026-07-25 03:20:40', 'Test Brand', '12', '5', 'all', NULL, '0', '4.8', '10', '4.5', '0', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('53', NULL, NULL, 'خمیر ضد انگل آیورمکتین مخصوص اسب اکولان', 'داروخانه تخصصی', '850000', '740000', 'https://images.unsplash.com/photo-1553284965-83fd3e82fa5a?w=600&auto=format&fit=crop&q=80', 'ژل خوراکی ضد انگل و کرم‌کش قوی برای کنترل انواع انگل‌های داخلی و روده‌ای اسب‌ها با اثرگذاری طولانی‌مدت.', '2026-09-04 23:33:27', 'اکولان', '15', '5', 'horse', 'dewormer', '1', '4.8', '12', '4.9', '18', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('54', NULL, NULL, 'روغن و مرهم تقویتی سم اسب مدل Hoof Care Pro', 'داروخانه تخصصی', '620000', '540000', 'https://images.unsplash.com/photo-1534447677768-be436bb09401?w=600&auto=format&fit=crop&q=80', 'فرمولاسیون ویژه حاوی تار طبیعی و بیوتین جهت تقویت بافت شاخی سم اسب و جلوگیری از ترک خوردگی و خشکی.', '2026-09-04 23:33:27', 'کاوامیرا', '20', '5', 'horse', 'hoof_care', '1', '4.8', '10', '4.7', '9', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('55', NULL, NULL, 'محلول مسکن و ضدالتهاب اسب فینیل بوتازون خوراکی', 'داروخانه تخصصی', '980000', '890000', 'https://images.unsplash.com/photo-1598974357801-cbca100e6571?w=600&auto=format&fit=crop&q=80', 'داروی ضد درد و تسکین التهابات تاندونی و مفاصل اسب‌های کورس و پرش، موثر در بهبودی سریع صدمات عضلانی.', '2026-09-04 23:33:28', 'وت‌فارما', '12', '5', 'horse', 'pain_management', '0', '4.8', '5', '5.0', '24', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('56', NULL, NULL, 'پودر مکمل الکترولیت و ویتامین E اسب اکواین', 'داروخانه تخصصی', '1250000', '1100000', 'https://images.unsplash.com/photo-1566251037378-5e04e3bec343?w=600&auto=format&fit=crop&q=80', 'مکمل تامین املاح ضروری و ویتامین‌های آنتی‌اکسیدان پس از تمرینات سنگین، جلوگیری از دهیدراتاسیون و گرفتگی عضلات.', '2026-09-04 23:33:28', 'نوترینت پرو', '25', '5', 'horse', 'vitamins', '1', '4.8', '15', '4.8', '16', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('57', NULL, NULL, 'پماد پستانی ضد ورم پستان حاد و تحت حاد گاو شیری', 'داروخانه تخصصی', '450000', '390000', 'https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?w=600&auto=format&fit=crop&q=80', 'سوسپانسیون آنتی بیوتیکی فوق العاده قوی جهت درمان و کنترل ورم پستان با دوره پرهیز کوتاه مدت.', '2026-09-04 23:33:28', 'وت‌مکس', '30', '5', 'cow', 'inflammation', '1', '4.8', '10', '4.9', '31', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('58', NULL, NULL, 'اسپری اکسید روی و تار ضد گندیدگی سم دام (Foot Rot)', 'داروخانه تخصصی', '320000', '280000', 'https://images.unsplash.com/photo-1546445317-29f4545e9d53?w=600&auto=format&fit=crop&q=80', 'اسپری درمانی و ضدعفونی کننده لایه‌های شاخی سم گاو و گوسفند جهت پیشگیری از لنگش و عفونت سم.', '2026-09-04 23:33:28', 'کاوامیرا', '40', '5', 'cow', 'hoof_care', '1', '4.8', '10', '4.6', '14', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('59', NULL, NULL, 'بلوس آهسته‌رهش کلسیم و ویتامین D3 گاو تازه زا', 'داروخانه تخصصی', '780000', '690000', 'https://images.unsplash.com/photo-1527153857715-3908f2ae5e81?w=600&auto=format&fit=crop&q=80', 'پیشگیری قطعی از تب شیر (Hypocalcemia) و فلجی زایمان با فراهمی زیستی بالا در شکمبه دام سنگین.', '2026-09-04 23:33:28', 'فارماپرو', '20', '5', 'cow', 'vitamins', '1', '4.8', '15', '5.0', '27', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('60', NULL, NULL, 'واکسن کشته دامی آنتروتوکسمی و شاربن علامتی', 'داروخانه تخصصی', '550000', NULL, 'https://images.unsplash.com/photo-1588693951525-6b7a5ee2e3d3?w=600&auto=format&fit=crop&q=80', 'ایمن‌سازی فعال گله در برابر پرخوری و کلستریدیوزهای شایع با بالاترین تیتر آنتی‌بادی ایمنی‌بخش.', '2026-09-04 23:33:28', 'رازی وت', '50', '5', 'cow', 'vaccines', '0', '4.8', '0', '4.8', '19', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('61', NULL, NULL, 'محلول خوراکی مولتی ویتامین + اسیدهای آمینه پرورشی طیور', 'داروخانه تخصصی', '290000', '245000', 'https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?w=600&auto=format&fit=crop&q=80', 'تقویت ضریب تبدیل غذایی، بهبود رشد جوجه یک‌روزه و ارتقای مقاومت سیستم ایمنی در شرایط استرس گرمایی.', '2026-09-04 23:33:28', 'اویسان', '60', '5', 'chick', 'vitamins', '1', '4.8', '10', '4.9', '42', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('62', NULL, NULL, 'پودر محلول در آب ضد کوکسیدیوز و عفونت‌های گوارشی جوجه', 'داروخانه تخصصی', '380000', '330000', 'https://images.unsplash.com/photo-1563281577-a7be47e20db9?w=600&auto=format&fit=crop&q=80', 'داروی درمانی و کنترل‌کننده کوکسیدیوز روده‌ای و اسهال‌های خونی در مزارع پرورش جوجه و نیمچه گوشتی.', '2026-09-04 23:33:28', 'کمی فارما', '35', '5', 'chick', 'drugs', '1', '4.8', '12', '4.7', '15', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('63', NULL, NULL, 'واکسن قطره چشمی نیوکاسل سویه لاسوتا + برونشیت طیور', 'داروخانه تخصصی', '420000', NULL, 'https://images.unsplash.com/photo-1516467508483-a7212febe31a?w=600&auto=format&fit=crop&q=80', 'واکسیناسیون زنده جهت ایجاد ایمنی مخاطی و همورال فوق‌العاده قوی در سیستم تنفسی جوجه و طیور تخمگذار.', '2026-09-04 23:33:28', 'رازی وت', '80', '5', 'chick', 'vaccines', '0', '4.8', '0', '5.0', '38', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('64', NULL, NULL, 'محلول ضدعفونی کننده و کمک‌های اولیه هوای سالن و آب طیور', 'داروخانه تخصصی', '310000', '260000', 'https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=600&auto=format&fit=crop&q=80', 'ضدعفونی کننده غیرسمی با پایه نانو نقره برای التیام زخم‌ها، استریل کردن خطوط آبرسانی و هوای سالن.', '2026-09-04 23:33:28', 'نانووت', '45', '5', 'chick', 'first_aid', '1', '4.8', '10', '4.6', '11', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('65', NULL, NULL, 'قرص ضد انگل و کرم‌کش سگ درنتال پلاس بایر آلمان', 'داروخانه تخصصی', '490000', '420000', 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=600&auto=format&fit=crop&q=80', 'معتبرترین قرص ضدانگل طیف وسیع برای سگ‌ها جهت نابودی تضمینی کرم‌های نواری، گرد و ژیاردیا.', '2026-09-04 23:33:28', 'بایر (Bayer)', '50', '5', 'dog', 'dewormer', '1', '4.8', '15', '5.0', '64', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('66', NULL, NULL, 'شربت ضد التهاب و مسکن ملئوکسیکام خوراکی سگ', 'داروخانه تخصصی', '580000', '495000', 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=600&auto=format&fit=crop&q=80', 'داروی ضد التهاب غیر استروئیدی (NSAID) برای کاهش سریع دردهای ناشی از استئوآرتریت و جراحی‌های ارتوپدی.', '2026-09-04 23:33:28', 'وت‌فارما', '25', '5', 'dog', 'pain_management', '1', '4.8', '10', '4.8', '29', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('67', NULL, NULL, 'اسپری استنشاقی و ضد اسپاسم تنفسی سگ‌های نژاد پوزه‌کوتاه', 'داروخانه تخصصی', '640000', '560000', 'https://images.unsplash.com/photo-1517849845537-4d257902454a?w=600&auto=format&fit=crop&q=80', 'اسپری تخصصی جهت بهبود تنفس، کاهش التهاب مجاری تنفسی و آسم در سگ‌های بولداگ، پاگ و شیتزو.', '2026-09-04 23:33:28', 'پت‌مدیکال', '18', '5', 'dog', 'inflammation', '1', '4.8', '10', '4.9', '21', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('68', NULL, NULL, 'کیت جامع کمک‌های اولیه اورژانسی سگ و حیوانات خانگی', 'داروخانه تخصصی', '890000', '780000', 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600&auto=format&fit=crop&q=80', 'شامل بتادین حیوانی، بانداژ خودچسب، پنس کنه کش، دماسنج دیجیتال، پد گاز استریل و اسپری التیام زخم.', '2026-09-04 23:33:28', 'تریکسی', '30', '5', 'dog', 'first_aid', '0', '4.8', '5', '4.9', '35', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('69', NULL, NULL, 'بالم ارگانیک نرم‌کننده و محافظ پد پنجه سگ و گربه', 'داروخانه تخصصی', '280000', '230000', 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=600&auto=format&fit=crop&q=80', 'بالم کاملاً طبیعی حاوی شی باتر و موم عسل برای بازسازی ترک خوردگی و خشکی پنجه ناشی از پیاده‌روی روی آسفالت گرم یا سرد.', '2026-09-04 23:33:28', 'پت‌کر', '35', '5', 'dog', 'hoof_care', '1', '4.8', '10', '4.7', '18', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('70', NULL, NULL, 'خمیر مالت و مکمل ویتامینه تقویت ایمنی گربه جیم کت', 'داروخانه تخصصی', '460000', '390000', 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=600&auto=format&fit=crop&q=80', 'دفع آسان گلوله‌های مویی (Hairball) و تقویت پوشش مو و ناخن گربه با ویتامین‌های گروه B و زینک.', '2026-09-04 23:33:28', 'جیم کت (GimCat)', '45', '5', 'cat', 'vitamins', '1', '4.8', '15', '5.0', '78', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('71', NULL, NULL, 'قطره ضد استرس و فرومون آرامبخش درمانی گربه فلی‌وی', 'داروخانه تخصصی', '720000', '640000', 'https://images.unsplash.com/photo-1573865526739-10659fec78a5?w=600&auto=format&fit=crop&q=80', 'کاهش اضطراب محیطی، ترس از سفر، پرخاشگری و رفتارهای نشانه‌گذاری با تقلید فرومون چهره‌ای مادر.', '2026-09-04 23:33:28', 'فلی‌وی (Feliway)', '20', '5', 'cat', 'therapy', '1', '4.8', '10', '4.9', '43', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('72', NULL, NULL, 'قطره موضعی ضد کک، کنه و انگل‌های پوستی گربه ادوکیت', 'داروخانه تخصصی', '520000', '450000', 'https://images.unsplash.com/photo-1533738363-b7f9aef128ce?w=600&auto=format&fit=crop&q=80', 'محافظت ماهیانه پشت گردنی علیه طیف گسترده‌ای از انگل‌های خارجی و جرب گوش در گربه‌ها.', '2026-09-04 23:33:28', 'بایر (Bayer)', '35', '5', 'cat', 'dewormer', '1', '4.8', '12', '4.8', '37', '1', '0');
INSERT INTO `products` (`id`, `sku`, `seller_id`, `name`, `category`, `price`, `discount_price`, `image_url`, `description`, `created_at`, `brand`, `stock`, `low_stock_threshold`, `target_animal`, `pharmacy_tag`, `is_autoship`, `baseline_rating`, `autoship_discount`, `rating_cache`, `review_count_cache`, `moq`, `is_b2b_only`) VALUES ('73', NULL, NULL, 'قطره اشک شستشو و رفع عفونت و التهاب چشم گربه', 'داروخانه تخصصی', '290000', '240000', 'https://images.unsplash.com/photo-1495360010541-f48722b34f7d?w=600&auto=format&fit=crop&q=80', 'محلول استریل پاک‌کننده لکه‌های اشک زیر چشم و تسکین سوزش و التهابات ملتحمه در گربه‌های پرشین و DSH.', '2026-09-04 23:33:28', 'پت‌مدیکال', '40', '5', 'cat', 'inflammation', '1', '4.8', '10', '4.6', '19', '1', '0');

DROP TABLE IF EXISTS `promo_codes`;
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

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `target_type` enum('product','doctor','organization') NOT NULL,
  `target_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `is_verified_buyer` tinyint(1) DEFAULT 1,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_target_rating` (`target_type`,`target_id`,`rating`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('1', '6', 'product', '31', '5', 'great product!', '1', 'approved', '2026-07-25 03:59:27');
INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('3', '5', 'organization', '1', '5', 'سگ من تصادف کرده بود و ساعت ۳ بامداد رسوندیمش بیمارستان پایتخت. بخش اورژانس و دکتر شایان فوق‌العاده سریع عمل جراحی لگن رو انجام دادن و الان کاملاً سلامته. دست مریزاد به کادر دلسوزتون.', '1', 'approved', '2026-09-05 13:50:26');
INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('4', '5', 'organization', '1', '5', 'نظافت و استریل بودن بخش بستری گربه‌ها واقعاً در حد بیمارستان‌های انسانی بود. گزارش‌های دوره‌ای با ویدیو برام ارسال می‌شد که خیلی خیالم رو راحت کرد.', '1', 'approved', '2026-08-24 13:50:26');
INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('5', '5', 'organization', '2', '5', 'برای عقیم‌سازی گربه‌ام به کلینیک پرشین مراجعه کردم. خانم دکتر مهرزاد با بیهوشی استنشاقی جراحی رو انجام دادن و بعد از ۳ ساعت کاملاً سرحال و بدون درد راه می‌رفت.', '1', 'approved', '2026-08-18 13:50:26');
INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('6', '5', 'organization', '2', '4', 'کادر پذیرش بسیار خوش‌برخورد، سیستم نوبت‌دهی آنلاین بدون هیچ معطلی اجرا شد. پت‌شاپ دارویی هم هر چی نیاز داشتیم داشت.', '1', 'approved', '2026-08-19 13:50:26');
INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('7', '5', 'organization', '4', '5', 'بهترین و مجهزترین مرکز درمانی در کل استان فارس. سونوگرافی داپلر با دقت عالی انجام شد و داروها رو بلافاصله از داروخانه داخلی تحویل گرفتیم.', '1', 'approved', '2026-08-27 13:50:26');
INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('8', '5', 'organization', '7', '5', 'کاسکوی من مشکل شدید تنفسی داشت و هیچ کلینیکی قبولش نمی‌کرد. آقای دکتر رستمی با مهارت عالی اکسیژن‌تراپی و نبولایزر انجام دادن و نجاتش دادن.', '1', 'approved', '2026-08-20 13:50:26');
INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('9', '5', 'organization', '8', '5', 'داروی کاردیولوژی برای سگم پیدا نمی‌شد، داروخانه رازی بلافاصله برام ارسال کرد با پک یخ و زنجیره سرد کامل. قیمت‌ها هم کاملاً منصفانه و شرکتی بود.', '1', 'approved', '2026-08-25 13:50:26');
INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('10', '14', 'organization', '1', '5', 'تست سیستم ثبت نظر مراکز درمانی', '1', 'approved', '2026-09-05 13:58:06');
INSERT INTO `reviews` (`id`, `user_id`, `target_type`, `target_id`, `rating`, `comment`, `is_verified_buyer`, `status`, `created_at`) VALUES ('11', '16', 'organization', '1', '5', 'خدمات بسیار عالی و اورژانس دقیق', '1', 'approved', '2026-09-07 17:22:28');

DROP TABLE IF EXISTS `role_applications`;
CREATE TABLE `role_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `applied_role` enum('doctor','pharmacist','organization','supplier') NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `license_number` varchar(100) DEFAULT NULL,
  `specialty` varchar(150) DEFAULT NULL,
  `degree_document_url` varchar(255) DEFAULT NULL,
  `license_document_url` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `organization_type` varchar(50) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('pending','under_review','approved','rejected') DEFAULT 'pending',
  `rejection_reason` text DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_app_status` (`status`),
  KEY `idx_app_role` (`applied_role`),
  KEY `user_id` (`user_id`),
  KEY `idx_status_role` (`status`,`applied_role`),
  CONSTRAINT `role_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `security_audit_logs`;
CREATE TABLE `security_audit_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `event_type` varchar(64) NOT NULL COMMENT 'auth_fail, auth_success, waf_blocked, privilege_escalation, file_upload, csrf_mismatch, rate_limit_exceeded, role_change',
  `severity` enum('info','warning','critical','emergency') DEFAULT 'info',
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `request_uri` varchar(255) DEFAULT NULL,
  `request_method` varchar(10) DEFAULT NULL,
  `payload_summary` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_event_type` (`event_type`),
  KEY `idx_severity` (`severity`),
  KEY `idx_ip_time` (`ip_address`,`created_at`),
  KEY `idx_user_time` (`user_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `security_banned_ips`;
CREATE TABLE `security_banned_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `threat_type` varchar(50) DEFAULT 'manual',
  `cf_ray` varchar(64) DEFAULT NULL,
  `banned_until` datetime NOT NULL,
  `banned_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_address` (`ip_address`),
  KEY `idx_ip` (`ip_address`),
  KEY `idx_banned_until` (`banned_until`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `seller_escrow_ledger`;
CREATE TABLE `seller_escrow_ledger` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `gross_amount` bigint(20) NOT NULL,
  `commission_amount` bigint(20) NOT NULL,
  `net_seller_amount` bigint(20) NOT NULL,
  `status` enum('held_in_escrow','released_to_available','settled_in_batch','refunded','disputed') DEFAULT 'held_in_escrow',
  `delivered_at` datetime DEFAULT NULL,
  `payout_eligible_at` datetime DEFAULT NULL COMMENT 'delivered_at + 7 days',
  `settlement_batch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_escrow_seller_status` (`seller_id`,`status`),
  KEY `idx_escrow_order` (`order_id`),
  KEY `idx_escrow_payout_time` (`payout_eligible_at`),
  KEY `idx_escrow_batch` (`settlement_batch_id`),
  KEY `idx_seller_eligible` (`seller_id`,`status`,`payout_eligible_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `seller_payout_batches`;
CREATE TABLE `seller_payout_batches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_code` varchar(50) NOT NULL,
  `total_payout_amount` bigint(20) NOT NULL,
  `seller_count` int(11) NOT NULL,
  `status` enum('pending','processing','completed','failed') DEFAULT 'completed',
  `paya_export_file_url` varchar(255) DEFAULT NULL,
  `paya_export_content` text DEFAULT NULL,
  `processed_by` int(11) DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `batch_code` (`batch_code`),
  KEY `idx_batch_code` (`batch_code`),
  KEY `idx_batch_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `seller_wallets`;
CREATE TABLE `seller_wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_account_holder` varchar(150) DEFAULT NULL,
  `bank_sheba` varchar(30) DEFAULT NULL COMMENT 'Format: IR followed by 24 digits',
  `bank_card_number` varchar(20) DEFAULT NULL,
  `balance_pending_escrow` bigint(20) DEFAULT 0 COMMENT 'Held in 7-day post-delivery guarantee escrow',
  `balance_available_for_payout` bigint(20) DEFAULT 0 COMMENT 'Released from escrow, eligible for weekly payout',
  `balance_settled_lifetime` bigint(20) DEFAULT 0 COMMENT 'Cumulative total settled through Paya',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `seller_id` (`seller_id`),
  KEY `idx_seller_wallet` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `seller_wallets` (`id`, `seller_id`, `bank_name`, `bank_account_holder`, `bank_sheba`, `bank_card_number`, `balance_pending_escrow`, `balance_available_for_payout`, `balance_settled_lifetime`, `created_at`, `updated_at`) VALUES ('1', '1', NULL, NULL, NULL, NULL, '0', '0', '0', '2026-09-07 17:20:04', '2026-09-07 17:20:04');
INSERT INTO `seller_wallets` (`id`, `seller_id`, `bank_name`, `bank_account_holder`, `bank_sheba`, `bank_card_number`, `balance_pending_escrow`, `balance_available_for_payout`, `balance_settled_lifetime`, `created_at`, `updated_at`) VALUES ('2', '14', 'بانک سامان', 'امید رضایی', 'IR120560000000012345678901', NULL, '0', '5000000', '0', '2026-09-07 17:22:07', '2026-09-07 17:22:07');
INSERT INTO `seller_wallets` (`id`, `seller_id`, `bank_name`, `bank_account_holder`, `bank_sheba`, `bank_card_number`, `balance_pending_escrow`, `balance_available_for_payout`, `balance_settled_lifetime`, `created_at`, `updated_at`) VALUES ('3', '5', NULL, NULL, NULL, NULL, '0', '0', '0', '2026-09-07 20:07:48', '2026-09-07 20:07:48');
INSERT INTO `seller_wallets` (`id`, `seller_id`, `bank_name`, `bank_account_holder`, `bank_sheba`, `bank_card_number`, `balance_pending_escrow`, `balance_available_for_payout`, `balance_settled_lifetime`, `created_at`, `updated_at`) VALUES ('4', '16', NULL, NULL, NULL, NULL, '0', '0', '0', '2026-09-07 20:31:17', '2026-09-07 20:31:17');
INSERT INTO `seller_wallets` (`id`, `seller_id`, `bank_name`, `bank_account_holder`, `bank_sheba`, `bank_card_number`, `balance_pending_escrow`, `balance_available_for_payout`, `balance_settled_lifetime`, `created_at`, `updated_at`) VALUES ('5', '7', NULL, NULL, NULL, NULL, '0', '0', '0', '2026-09-07 21:13:06', '2026-09-07 21:13:06');

DROP TABLE IF EXISTS `shipping_rates`;
CREATE TABLE `shipping_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrier_code` varchar(50) NOT NULL,
  `carrier_name_fa` varchar(100) NOT NULL,
  `base_weight_grams` int(11) DEFAULT 1000,
  `base_cost` int(11) NOT NULL DEFAULT 45000,
  `extra_kg_cost` int(11) NOT NULL DEFAULT 15000,
  `inter_provincial_surcharge` int(11) NOT NULL DEFAULT 20000,
  `cold_chain_surcharge` int(11) NOT NULL DEFAULT 50000,
  `estimated_days_min` int(11) DEFAULT 1,
  `estimated_days_max` int(11) DEFAULT 3,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `shipping_rates` (`id`, `carrier_code`, `carrier_name_fa`, `base_weight_grams`, `base_cost`, `extra_kg_cost`, `inter_provincial_surcharge`, `cold_chain_surcharge`, `estimated_days_min`, `estimated_days_max`, `is_active`) VALUES ('1', 'pishtaz', 'پست پیشتاز جمهوری اسلامی ایران', '1000', '48000', '15000', '22000', '0', '2', '4', '1');
INSERT INTO `shipping_rates` (`id`, `carrier_code`, `carrier_name_fa`, `base_weight_grams`, `base_cost`, `extra_kg_cost`, `inter_provincial_surcharge`, `cold_chain_surcharge`, `estimated_days_min`, `estimated_days_max`, `is_active`) VALUES ('2', 'tipax', 'تیپاکس اکسپرس (تحویل درب منزل / کلینیک)', '1000', '65000', '20000', '25000', '0', '1', '2', '1');
INSERT INTO `shipping_rates` (`id`, `carrier_code`, `carrier_name_fa`, `base_weight_grams`, `base_cost`, `extra_kg_cost`, `inter_provincial_surcharge`, `cold_chain_surcharge`, `estimated_days_min`, `estimated_days_max`, `is_active`) VALUES ('3', 'express_courier', 'پیک موتوری فوری اختصاصی (الوپیک / اسنپ‌باکس)', '5000', '55000', '10000', '0', '0', '1', '1', '1');
INSERT INTO `shipping_rates` (`id`, `carrier_code`, `carrier_name_fa`, `base_weight_grams`, `base_cost`, `extra_kg_cost`, `inter_provincial_surcharge`, `cold_chain_surcharge`, `estimated_days_min`, `estimated_days_max`, `is_active`) VALUES ('4', 'cold_chain_express', 'پیک ویژه زنجیره سرد دارویی (ایزوترمال + یخ خشک)', '2000', '120000', '30000', '45000', '60000', '1', '1', '1');

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sms_delivery_logs`;
CREATE TABLE `sms_delivery_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `action_tag` varchar(50) NOT NULL,
  `body_id` varchar(30) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_mock` tinyint(1) DEFAULT 0,
  `status` enum('sent','failed','mock_delivered') DEFAULT 'sent',
  `gateway_response` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_sms_phone` (`phone`),
  KEY `idx_sms_tag` (`action_tag`),
  KEY `idx_sms_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `subscription_deliveries`;
CREATE TABLE `subscription_deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_id` int(11) NOT NULL,
  `delivery_month` int(11) NOT NULL,
  `scheduled_date` date DEFAULT NULL,
  `status` enum('pending','shipped','delivered','not_received') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `subscription_id` (`subscription_id`),
  CONSTRAINT `subscription_deliveries_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `user_subscriptions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('1', '2', '1', '2026-08-03', 'delivered');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('2', '2', '2', '2026-09-02', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('3', '2', '3', '2026-10-02', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('4', '2', '4', '2026-11-01', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('5', '2', '5', '2026-12-01', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('6', '2', '6', '2026-12-31', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('7', '3', '1', '2026-08-24', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('8', '3', '2', '2026-09-05', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('9', '3', '3', '2026-10-05', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('10', '4', '1', '2026-08-25', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('11', '4', '2', '2026-09-24', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('12', '4', '3', '2026-10-24', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('13', '5', '1', '2026-08-15', 'shipped');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('14', '5', '2', '2026-08-28', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('15', '6', '1', '2026-08-20', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('16', '6', '2', '2026-09-20', 'pending');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('17', '3', '4', '2026-08-24', 'shipped');
INSERT INTO `subscription_deliveries` (`id`, `subscription_id`, `delivery_month`, `scheduled_date`, `status`) VALUES ('18', '6', '3', '2026-08-20', 'shipped');

DROP TABLE IF EXISTS `subscription_logs`;
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

DROP TABLE IF EXISTS `subscriptions`;
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

DROP TABLE IF EXISTS `system_request_logs`;
CREATE TABLE `system_request_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(150) DEFAULT NULL,
  `session_id` varchar(128) DEFAULT NULL,
  `action_type` varchar(50) DEFAULT 'page_view' COMMENT 'browse, auth, checkout, admin, api, suspicious_probe, ddos_flood',
  `request_method` varchar(10) NOT NULL,
  `request_uri` varchar(500) NOT NULL,
  `payload_summary` text DEFAULT NULL COMMENT 'Sanitized parameters with passwords/tokens redacted',
  `cf_ray` varchar(64) DEFAULT NULL COMMENT 'Cloudflare Ray ID',
  `cf_country` varchar(10) DEFAULT NULL COMMENT 'Cloudflare Two-Letter Country Code',
  `user_agent` varchar(255) DEFAULT NULL,
  `response_code` int(11) DEFAULT 200,
  `is_suspicious` tinyint(1) DEFAULT 0,
  `suspicion_reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_req_ip_time` (`ip_address`,`created_at`),
  KEY `idx_req_user_time` (`user_id`,`created_at`),
  KEY `idx_req_session` (`session_id`),
  KEY `idx_req_suspicious` (`is_suspicious`,`created_at`),
  KEY `idx_req_action` (`action_type`),
  KEY `idx_req_created` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('1', '::1', NULL, NULL, '83964abur26gp0trglii540i4m', 'browse', 'HEAD', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:57:28');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('2', '::1', NULL, NULL, 'fiuug842amnfas3gqc5vp0kb0g', 'browse', 'HEAD', '/asena/asena-enterprise/organization_profile.php?slug=payetakht-hospital', '{\"slug\":\"payetakht-hospital\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:57:55');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('3', '::1', NULL, NULL, 'qdci2qppfqegd12sqdj54q0m5q', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=payetakht-hospital', '{\"slug\":\"payetakht-hospital\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:57:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('4', '::1', NULL, NULL, '2bug4ssjasf9l1fsit9tehf2p9', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=shiraz-central-hospital', '{\"slug\":\"shiraz-central-hospital\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:57:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('5', '::1', NULL, NULL, 'njikiugb8f4l69pn031t6op6b6', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=persian-pet-clinic', '{\"slug\":\"persian-pet-clinic\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:57:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('6', '::1', NULL, NULL, '5ch0478de8tck43dpcrhj9d74q', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=baran-vet-clinic', '{\"slug\":\"baran-vet-clinic\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:57:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('7', '::1', NULL, NULL, 'f8jmu0s6j3jqnlov5ds3qk4o7b', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=caspian-exotic-clinic', '{\"slug\":\"caspian-exotic-clinic\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:57:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('8', '::1', NULL, NULL, 'fgk7glpuaqap86eoq6m5mcccnq', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=razi-vet-pharmacy', '{\"slug\":\"razi-vet-pharmacy\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:57:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('9', '::1', NULL, NULL, '3bc01o2jggbm8pm4q6nkfjvauk', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=vafa-animal-shelter', '{\"slug\":\"vafa-animal-shelter\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:57:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('10', '::1', NULL, NULL, 'sfkjjpp6l75406e23ttok81gcf', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?q=پایتخت', '{\"q\":\"پایتخت\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:58:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('11', '::1', NULL, NULL, 'k2ssg7i5il134pn2peum6cvs3s', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?city=تهران', '{\"city\":\"تهران\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:58:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('12', '::1', NULL, NULL, 'gt0jq1glfistbk5km7n8opnv91', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?city=شیراز', '{\"city\":\"شیراز\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:58:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('13', '::1', NULL, NULL, 'o3nd1ud87k33hd9mtfhl2jer44', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?type=hospital', '{\"type\":\"hospital\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:58:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('14', '::1', NULL, NULL, 'e8u67koves2se7lijfbp4so4f2', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?type=pharmacy', '{\"type\":\"pharmacy\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:58:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('15', '::1', NULL, NULL, 'bvundcgilakclarpom816p97cm', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?is_24_7=1', '{\"is_24_7\":\"1\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:58:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('16', '::1', NULL, NULL, 'cprtmdd82b419fdsgaosfevphi', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?sort=rating', '{\"sort\":\"rating\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-05 13:58:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('17', '127.0.0.1', NULL, NULL, 'h0ub66juo1iafp6f90l7fa0g0o', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-05 13:59:26');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('18', '127.0.0.1', NULL, NULL, 'h0ub66juo1iafp6f90l7fa0g0o', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=vafa-animal-shelter', '{\"slug\":\"vafa-animal-shelter\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-05 13:59:39');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('19', '127.0.0.1', NULL, NULL, 'h0ub66juo1iafp6f90l7fa0g0o', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-05 13:59:47');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('20', '127.0.0.1', NULL, NULL, 'h0ub66juo1iafp6f90l7fa0g0o', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-05 14:00:10');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('21', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:12:34');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('22', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:20:10');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('23', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'auth', 'GET', '/asena/asena-enterprise/register.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:25:14');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('24', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'auth', 'GET', '/asena/asena-enterprise/register.php?step=2&role=supplier', '{\"step\":\"2\",\"role\":\"supplier\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:25:30');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('25', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'auth', 'GET', '/asena/asena-enterprise/register.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:25:33');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('26', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:25:43');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('27', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:25:46');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('28', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:25:46');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('29', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:25:51');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('30', '::1', NULL, NULL, 'kjb4060dhhutq392ae2m0m508u', 'browse', 'HEAD', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 16:25:55');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('31', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:26:08');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('32', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:26:14');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('33', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:26:26');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('34', '::1', NULL, NULL, 'taoh2p9rs9gh9q2f63hd291meo', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 16:27:58');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('35', '::1', NULL, NULL, 'sge0bpamadsfmq4ta548lat31t', 'browse', 'HEAD', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 16:31:13');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('36', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:40:53');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('37', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:40:58');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('38', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:41:41');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('39', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/shop.php?category=%D8%A7%D8%B3%D8%A8%D8%A7%D8%A8%E2%80%8C%D8%A8%D8%A7%D8%B2%DB%8C', '{\"category\":\"اسباب‌بازی\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:42:01');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('40', '127.0.0.1', NULL, NULL, 'fbapsqbc67q7bjj8ljo7qvflih', 'browse', 'GET', '/asena/asena-enterprise/subscriptions.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:42:32');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('41', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'cart', 'GET', '/asena/asena-enterprise/cart.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:42:41');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('42', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'cart', 'GET', '/asena/asena-enterprise/cart.php?tab=standard', '{\"tab\":\"standard\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:42:46');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('43', '::1', NULL, NULL, 'rr4mle12phelkfv1kmn29u12q9', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 16:43:31');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('44', '::1', NULL, NULL, 'bgshvptmpa9nsefv1oq2co6ta2', 'browse', 'HEAD', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 16:46:38');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('45', '::1', NULL, NULL, 'duaebdh2juupt31j5uarftv9gr', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 16:46:46');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('46', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'cart', 'GET', '/asena/asena-enterprise/cart.php?tab=standard', '{\"tab\":\"standard\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:47:40');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('47', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:47:42');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('48', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:47:52');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('49', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:48:22');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('50', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:48:35');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('51', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:48:41');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('52', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:49:04');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('53', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:50:04');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('54', '::1', NULL, NULL, 'chalrdrtqfvio0tpracktusk56', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 16:51:24');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('55', '::1', NULL, NULL, 'abh0iroq88ks70ub8dvu815ak3', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 16:54:29');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('56', '::1', NULL, NULL, 'sal6ckki29r41qm0d6ir32g9dt', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 16:54:36');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('57', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/booking.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:58:07');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('58', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/subscriptions.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:58:28');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('59', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/knowledge_base.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:58:35');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('60', '127.0.0.1', NULL, NULL, 'hrqlf4mpbsbq4f8fg74j1ikvu6', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 16:58:48');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('61', '::1', NULL, NULL, 'fe07kek2g8c8oq7sb8uvv70qu7', 'browse', 'GET', '/asena/asena-enterprise/charity.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:01:56');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('62', '::1', NULL, NULL, 'u24sjtbriigtc5r57lpugu7rep', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:10:04');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('63', '::1', NULL, NULL, 'ai1hcb2acej25e8inl9glgmvru', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:10:09');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('64', '::1', NULL, NULL, 'q4kp2dta24ekbmhv6n2c71am17', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:12:53');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('65', '::1', NULL, NULL, 'dodat84bm2apv4dl3vrpshs8uc', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:17:32');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('66', '::1', NULL, NULL, '57360khd652oqafpijp7kjq64d', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=payetakht-hospital', '{\"slug\":\"payetakht-hospital\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:17:38');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('67', '::1', NULL, NULL, '7qrb4hbi91t6mlc5r5gumuuabe', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:22:15');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('68', '::1', NULL, NULL, '6ao6gqfu3leuqpj92ekqoes6du', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=payetakht-hospital', '{\"slug\":\"payetakht-hospital\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:22:19');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('69', '127.0.0.1', NULL, NULL, 'aji73o94fkfv2f8f4k9n8tdc58', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 17:24:46');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('70', '::1', NULL, NULL, '0m5c9550rhn5esiqaq890vl6qh', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:37:16');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('71', '::1', NULL, NULL, 'ji9t46tg0kac1ug8lh9odb2oku', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=vafa-animal-shelter', '{\"slug\":\"vafa-animal-shelter\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:37:21');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('72', '127.0.0.1', NULL, NULL, 'aji73o94fkfv2f8f4k9n8tdc58', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 17:48:26');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('73', '127.0.0.1', NULL, NULL, 'aji73o94fkfv2f8f4k9n8tdc58', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=payetakht-hospital', '{\"slug\":\"payetakht-hospital\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 17:49:09');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('74', '::1', NULL, NULL, 'bc2ivhajei57tk27jj8ufl6jai', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 17:52:45');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('75', '::1', NULL, NULL, 'lm1en15dpetjoukpee7cbu92sh', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:54:46');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('76', '::1', NULL, NULL, 'lm1en15dpetjoukpee7cbu92sh', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:54:48');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('77', '::1', NULL, NULL, 'lm1en15dpetjoukpee7cbu92sh', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:54:48');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('78', '::1', NULL, NULL, 'qu6si4rjn0f6ee39b0gcb9g1ee', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:54:57');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('79', '::1', NULL, NULL, 'qu6si4rjn0f6ee39b0gcb9g1ee', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:54:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('80', '::1', NULL, NULL, 'qu6si4rjn0f6ee39b0gcb9g1ee', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:54:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('81', '::1', NULL, NULL, 'ciusgi8oegb7t7rskj82sduuuc', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:55:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('82', '::1', NULL, NULL, 'ciusgi8oegb7t7rskj82sduuuc', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:55:22');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('83', '::1', NULL, NULL, 'ciusgi8oegb7t7rskj82sduuuc', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:55:22');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('84', '::1', NULL, NULL, 'ok7jf6j936p3c6r0eb023sh9ro', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=payetakht-hospital', '{\"slug\":\"payetakht-hospital\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:55:48');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('85', '::1', NULL, NULL, 'ok7jf6j936p3c6r0eb023sh9ro', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:55:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('86', '::1', NULL, NULL, 'ok7jf6j936p3c6r0eb023sh9ro', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:55:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('87', '::1', NULL, NULL, 'earj50fiola8tn6l33fg6jmilp', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=payetakht-hospital', '{\"slug\":\"payetakht-hospital\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:56:42');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('88', '::1', NULL, NULL, 'earj50fiola8tn6l33fg6jmilp', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:56:44');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('89', '::1', NULL, NULL, 'earj50fiola8tn6l33fg6jmilp', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:56:44');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('90', '::1', NULL, NULL, '94hj55cktk6tbhviunmfcf2ai2', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=vafa-animal-shelter', '{\"slug\":\"vafa-animal-shelter\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:57:05');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('91', '::1', NULL, NULL, '94hj55cktk6tbhviunmfcf2ai2', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:57:06');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('92', '::1', NULL, NULL, '94hj55cktk6tbhviunmfcf2ai2', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:57:06');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('93', '::1', NULL, NULL, 'v21m67mi4g4qm60htkad0tbimv', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:57:25');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('94', '::1', NULL, NULL, 'v21m67mi4g4qm60htkad0tbimv', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:57:34');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('95', '::1', NULL, NULL, 'v21m67mi4g4qm60htkad0tbimv', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 17:57:34');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('96', '127.0.0.1', NULL, NULL, 'ujtnlh0bauurprk9sp0ujbq94m', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 17:59:28');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('97', '127.0.0.1', NULL, NULL, 'ujtnlh0bauurprk9sp0ujbq94m', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?q=&city=&type=shelter_charity&sort=featured&is_24_7=0', '{\"q\":\"\",\"city\":\"\",\"type\":\"shelter_charity\",\"sort\":\"featured\",\"is_24_7\":\"0\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 18:03:28');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('98', '127.0.0.1', NULL, NULL, 'ujtnlh0bauurprk9sp0ujbq94m', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?q=&city=&type=pharmacy&sort=featured&is_24_7=0', '{\"q\":\"\",\"city\":\"\",\"type\":\"pharmacy\",\"sort\":\"featured\",\"is_24_7\":\"0\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 18:03:33');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('99', '127.0.0.1', NULL, NULL, 'ujtnlh0bauurprk9sp0ujbq94m', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?q=&city=&type=&sort=featured&is_24_7=0', '{\"q\":\"\",\"city\":\"\",\"type\":\"\",\"sort\":\"featured\",\"is_24_7\":\"0\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 18:03:37');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('100', '::1', NULL, NULL, 'fvbrbem83o4dqn99phdf0jp9m7', 'browse', 'GET', '/asena/asena-enterprise/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 18:04:40');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('101', '::1', NULL, NULL, 'fvbrbem83o4dqn99phdf0jp9m7', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 18:04:42');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('102', '::1', NULL, NULL, 'fvbrbem83o4dqn99phdf0jp9m7', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 18:04:42');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('103', '127.0.0.1', NULL, NULL, 'ujtnlh0bauurprk9sp0ujbq94m', 'browse', 'GET', '/asena/asena-enterprise/organizations.php?q=&city=&type=&sort=featured&is_24_7=0', '{\"q\":\"\",\"city\":\"\",\"type\":\"\",\"sort\":\"featured\",\"is_24_7\":\"0\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 18:07:51');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('104', '127.0.0.1', NULL, NULL, 'ujtnlh0bauurprk9sp0ujbq94m', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 18:14:14');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('105', '::1', NULL, NULL, 'hlcreudpne3i6212kq9jsi3js6', 'browse', 'HEAD', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 18:22:46');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('106', '::1', NULL, NULL, 'rksbloccg0tof0ed9qlhekq9uq', 'auth', 'GET', '/asena/asena-enterprise/register.php?role=organization', '{\"role\":\"organization\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 18:22:50');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('107', '127.0.0.1', NULL, NULL, 'f00uslbvu8t4v35c9166j7d9to', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 18:56:42');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('108', '127.0.0.1', NULL, NULL, 'f00uslbvu8t4v35c9166j7d9to', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=10', '{\"id\":\"10\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:01:27');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('109', '127.0.0.1', NULL, NULL, 'f00uslbvu8t4v35c9166j7d9to', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=10', '{\"id\":\"10\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:01:32');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('110', '127.0.0.1', NULL, NULL, 'f00uslbvu8t4v35c9166j7d9to', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=3', '{\"id\":\"3\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:03:26');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('111', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:05:26');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('112', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:05:28');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('113', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:05:28');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('114', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=6', '{\"id\":\"6\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:05:36');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('115', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:05:39');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('116', '127.0.0.1', NULL, NULL, 'f00uslbvu8t4v35c9166j7d9to', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:06:46');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('117', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:07:35');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('118', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:08:58');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('119', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=10', '{\"id\":\"10\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:13:02');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('120', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=10', '{\"id\":\"10\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:13:51');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('121', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=10', '{\"id\":\"10\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:16:11');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('122', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=1', '{\"id\":\"1\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:16:39');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('123', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=10', '{\"id\":\"10\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:17:42');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('124', '127.0.0.1', NULL, NULL, 'f00uslbvu8t4v35c9166j7d9to', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=2', '{\"id\":\"2\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:20:48');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('125', '::1', NULL, NULL, '3i462avpamq8es5s8rbk9lfq75', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:29:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('126', '::1', NULL, NULL, 'pvqj29k3g5gb69du7qif2ondg7', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:33:48');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('127', '::1', NULL, NULL, 'pvqj29k3g5gb69du7qif2ondg7', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:33:50');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('128', '::1', NULL, NULL, 'pvqj29k3g5gb69du7qif2ondg7', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:33:50');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('129', '::1', NULL, NULL, '2g3bc8jgfogirra3fm0oddk1bo', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:35:15');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('130', '::1', NULL, NULL, '2g3bc8jgfogirra3fm0oddk1bo', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:35:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('131', '::1', NULL, NULL, '2g3bc8jgfogirra3fm0oddk1bo', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 19:35:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('132', '127.0.0.1', NULL, NULL, 'v7n75hg54us167u2e0p9aa98dk', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:37:53');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('133', '127.0.0.1', NULL, NULL, 'v7n75hg54us167u2e0p9aa98dk', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:38:02');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('134', '127.0.0.1', NULL, NULL, 'v7n75hg54us167u2e0p9aa98dk', 'browse', 'GET', '/asena/asena-enterprise/product_details.php?id=9', '{\"id\":\"9\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:38:10');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('135', '127.0.0.1', '1', NULL, 'iofe0sfdbiapm0jaa9m0ml9674', 'browse', 'GET', '/asena/asena-enterprise/organization_profile.php?slug=vafa-animal-shelter', '{\"slug\":\"vafa-animal-shelter\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:49:28');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('136', '127.0.0.1', '1', NULL, 'iofe0sfdbiapm0jaa9m0ml9674', 'admin_action', 'GET', '/asena/asena-enterprise/admin/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:49:35');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('137', '127.0.0.1', '1', NULL, 'iofe0sfdbiapm0jaa9m0ml9674', 'admin_action', 'GET', '/asena/asena-enterprise/admin/doctors.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:49:48');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('138', '127.0.0.1', '1', NULL, 'iofe0sfdbiapm0jaa9m0ml9674', 'admin_action', 'GET', '/asena/asena-enterprise/admin/sellers.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:50:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('139', '127.0.0.1', '1', NULL, 'iofe0sfdbiapm0jaa9m0ml9674', 'admin_action', 'GET', '/asena/asena-enterprise/admin/payouts.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:50:21');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('140', '::1', NULL, NULL, 'ah0lpu16qsvjmug9udhkk5178l', 'admin_action', 'GET', '/asena/asena-enterprise/admin/doctors.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 19:50:45');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('141', '127.0.0.1', NULL, NULL, 'iofe0sfdbiapm0jaa9m0ml9674', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 19:51:32');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('142', '::1', '1', NULL, '1f24sjvf7hcek4jt2pc92n5ub6', 'admin_action', 'GET', '/asena/asena-enterprise/admin/doctors.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 19:54:22');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('143', '::1', '1', NULL, '1f24sjvf7hcek4jt2pc92n5ub6', 'admin_action', 'GET', '/asena/asena-enterprise/admin/doctors.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 19:54:26');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('144', '::1', '1', NULL, '1f24sjvf7hcek4jt2pc92n5ub6', 'admin_action', 'GET', '/asena/asena-enterprise/admin/doctors.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 19:55:31');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('145', '127.0.0.1', NULL, NULL, 'iofe0sfdbiapm0jaa9m0ml9674', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:05:09');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('146', '127.0.0.1', NULL, NULL, 'iofe0sfdbiapm0jaa9m0ml9674', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:05:09');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('147', '127.0.0.1', NULL, NULL, 'iofe0sfdbiapm0jaa9m0ml9674', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:05:10');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('148', '127.0.0.1', NULL, NULL, 'aa59nlmcn5uu07f3oatgnhqb29', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:05:49');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('149', '127.0.0.1', '1', NULL, 'i9fqcqphfnfd45jkmh9lat0vb2', 'admin_action', 'GET', '/asena/asena-enterprise/admin/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:06:05');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('150', '127.0.0.1', '1', NULL, 'i9fqcqphfnfd45jkmh9lat0vb2', 'admin_action', 'POST', '/asena/asena-enterprise/admin/organizations.php', '{\"action\":\"toggle_status\",\"org_id\":\"9\",\"status\":\"suspended\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:06:35');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('151', '127.0.0.1', '1', NULL, 'i9fqcqphfnfd45jkmh9lat0vb2', 'admin_action', 'GET', '/asena/asena-enterprise/admin/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:06:35');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('152', '127.0.0.1', '1', NULL, 'i9fqcqphfnfd45jkmh9lat0vb2', 'admin_action', 'POST', '/asena/asena-enterprise/admin/organizations.php', '{\"action\":\"toggle_status\",\"org_id\":\"9\",\"status\":\"approved\"}', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:06:40');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('153', '127.0.0.1', '1', NULL, 'i9fqcqphfnfd45jkmh9lat0vb2', 'admin_action', 'GET', '/asena/asena-enterprise/admin/organizations.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:06:40');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('154', '127.0.0.1', '1', NULL, 'i9fqcqphfnfd45jkmh9lat0vb2', 'admin_action', 'GET', '/asena/asena-enterprise/admin/doctors.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:06:44');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('155', '127.0.0.1', NULL, NULL, 'i9fqcqphfnfd45jkmh9lat0vb2', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:06:52');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('156', '127.0.0.1', NULL, NULL, 'qajsld1rou8p399h5bp09d5i62', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:07:52');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('157', '127.0.0.1', NULL, NULL, 'ogsr46ldtqvi7idrkjvp4u918o', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:08:30');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('158', '127.0.0.1', '16', NULL, '9041aru27orlrriji08aqrr2ae', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:31:04');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('159', '127.0.0.1', '16', NULL, '9041aru27orlrriji08aqrr2ae', 'browse', 'GET', '/asena/asena-enterprise/profile.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:31:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('160', '127.0.0.1', NULL, NULL, '9041aru27orlrriji08aqrr2ae', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:33:35');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('161', '127.0.0.1', '16', NULL, '92v6rfd5c9nspl8a8jd5djv18l', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:33:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('162', '127.0.0.1', '16', NULL, '92v6rfd5c9nspl8a8jd5djv18l', 'browse', 'GET', '/asena/asena-enterprise/profile.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:34:04');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('163', '127.0.0.1', NULL, NULL, '92v6rfd5c9nspl8a8jd5djv18l', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:34:14');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('164', '127.0.0.1', '16', NULL, '3mk547fl51k09dhsnps9lmtej2', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:35:05');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('165', '127.0.0.1', '16', NULL, '3mk547fl51k09dhsnps9lmtej2', 'browse', 'GET', '/asena/asena-enterprise/profile.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:35:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('166', '::1', NULL, NULL, 'riahucdvughen797jmjks7c81j', 'api', 'GET', '/asena/asena-enterprise/api/v1/pets.php?action=calculate_dosage&species=dog&weight_kg=12&medication_type=dewormer', '{\"action\":\"calculate_dosage\",\"species\":\"dog\",\"weight_kg\":\"12\",\"medication_type\":\"dewormer\"}', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 20:36:46');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('167', '::1', '1', NULL, 'ta705so34vhh3btu9kmuc6dm2h', 'browse', 'GET', '/asena/asena-enterprise/profile.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 20:37:42');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('168', '127.0.0.1', NULL, NULL, 'e47ju2el3ev0kr8j8uceq09on9', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:45:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('169', '127.0.0.1', NULL, NULL, 'e47ju2el3ev0kr8j8uceq09on9', 'admin_action', 'GET', '/asena/asena-enterprise/admin/organizations.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:45:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('170', '127.0.0.1', NULL, NULL, 'e47ju2el3ev0kr8j8uceq09on9', 'admin_action', 'GET', '/asena/asena-enterprise/admin/doctors.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:45:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('171', '127.0.0.1', NULL, NULL, 'e47ju2el3ev0kr8j8uceq09on9', 'admin_action', 'GET', '/asena/asena-enterprise/admin/sellers.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:45:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('172', '127.0.0.1', NULL, NULL, 'e47ju2el3ev0kr8j8uceq09on9', 'admin_action', 'GET', '/asena/asena-enterprise/admin/payouts.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:45:59');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('173', '127.0.0.1', NULL, NULL, 'vn41s6i9moqnf4nl73i7l1ohnn', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:46:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('174', '127.0.0.1', NULL, NULL, 'vn41s6i9moqnf4nl73i7l1ohnn', 'admin_action', 'GET', '/asena/asena-enterprise/admin/organizations.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:46:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('175', '127.0.0.1', NULL, NULL, 'vn41s6i9moqnf4nl73i7l1ohnn', 'admin_action', 'GET', '/asena/asena-enterprise/admin/doctors.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:46:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('176', '127.0.0.1', NULL, NULL, 'vn41s6i9moqnf4nl73i7l1ohnn', 'admin_action', 'GET', '/asena/asena-enterprise/admin/sellers.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:46:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('177', '127.0.0.1', NULL, NULL, 'vn41s6i9moqnf4nl73i7l1ohnn', 'admin_action', 'GET', '/asena/asena-enterprise/admin/payouts.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 20:46:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('178', '127.0.0.1', '16', NULL, '3mk547fl51k09dhsnps9lmtej2', 'browse', 'GET', '/asena/asena-enterprise/profile.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 20:56:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('179', '127.0.0.1', NULL, NULL, 'f5sj63nkqus8503ppg5sgkfloi', 'browse', 'GET', '/asena/asena-enterprise/booking.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 21:00:19');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('180', '127.0.0.1', NULL, NULL, 'm76tidfo1vl6jemb69od495ggv', 'browse', 'GET', '/asena/asena-enterprise/booking.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-07 21:00:25');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('181', '127.0.0.1', '16', NULL, '3mk547fl51k09dhsnps9lmtej2', 'browse', 'GET', '/asena/asena-enterprise/profile.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 21:01:11');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('182', '127.0.0.1', '16', NULL, '3mk547fl51k09dhsnps9lmtej2', 'browse', 'GET', '/asena/asena-enterprise/profile.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 21:02:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('183', '127.0.0.1', '16', NULL, 'hlcjj4ibtm81pa4okr7ctc0qg1', 'browse', 'GET', '/asena/asena-enterprise/profile.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 21:14:49');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('184', '127.0.0.1', NULL, NULL, 'hlcjj4ibtm81pa4okr7ctc0qg1', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1', '200', '0', NULL, '2026-09-07 21:22:42');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('185', '127.0.0.1', NULL, NULL, 'hlcjj4ibtm81pa4okr7ctc0qg1', 'cart', 'GET', '/asena/asena-enterprise/cart.php', '', NULL, NULL, 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1', '200', '0', NULL, '2026-09-07 21:22:51');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('186', '127.0.0.1', NULL, NULL, 'hlcjj4ibtm81pa4okr7ctc0qg1', 'browse', 'GET', '/asena/asena-enterprise/booking.php', '', NULL, NULL, 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1', '200', '0', NULL, '2026-09-07 21:23:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('187', '127.0.0.1', NULL, NULL, 'hlcjj4ibtm81pa4okr7ctc0qg1', 'browse', 'GET', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1', '200', '0', NULL, '2026-09-07 21:23:12');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('188', '127.0.0.1', NULL, NULL, 'hlcjj4ibtm81pa4okr7ctc0qg1', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1', '200', '0', NULL, '2026-09-07 21:23:18');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('189', '::1', NULL, NULL, 'g3uas93lopme90jt534cbpmgdo', 'cart', 'HEAD', '/asena/asena-enterprise/cart.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-07 21:43:40');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('190', '::1', NULL, NULL, 'chum603jlenremnme94s920t51', 'cart', 'GET', '/asena/asena-enterprise/cart.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 21:44:03');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('191', '::1', NULL, NULL, 'chum603jlenremnme94s920t51', 'cart', 'GET', '/asena/asena-enterprise/cart.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 21:44:28');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('192', '::1', NULL, NULL, 'chum603jlenremnme94s920t51', 'cart', 'GET', '/asena/asena-enterprise/cart.php?tab=standard', '{\"tab\":\"standard\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 21:44:40');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('193', '::1', NULL, NULL, 'chum603jlenremnme94s920t51', 'cart', 'GET', '/asena/asena-enterprise/cart.php?tab=standard', '{\"tab\":\"standard\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 21:44:40');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('194', '::1', NULL, NULL, 'chum603jlenremnme94s920t51', 'cart', 'GET', '/asena/asena-enterprise/cart.php?tab=standard', '{\"tab\":\"standard\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 21:46:45');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('195', '::1', NULL, NULL, 'chum603jlenremnme94s920t51', 'cart', 'GET', '/asena/asena-enterprise/cart.php?tab=standard', '{\"tab\":\"standard\"}', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-07 21:49:15');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('196', '127.0.0.1', NULL, NULL, 'hlcjj4ibtm81pa4okr7ctc0qg1', 'cart', 'GET', '/asena/asena-enterprise/cart.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', '200', '0', NULL, '2026-09-07 21:49:25');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('197', '127.0.0.1', NULL, NULL, 'p18n914tqbgk2kgg9gjmm94bef', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-08 16:13:40');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('198', '127.0.0.1', NULL, NULL, 'k1s0mtu5aagf9mo5bgkm77ufea', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-08 17:43:33');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('199', '127.0.0.1', NULL, NULL, 'k1s0mtu5aagf9mo5bgkm77ufea', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-08 17:51:09');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('200', '127.0.0.1', NULL, NULL, 'uqqposkkl546hapf6dlr3lc96a', 'api', 'GET', '/actions/print_shipping_label.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-09 16:25:43');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('201', '127.0.0.1', NULL, NULL, '625k64agkn5rmllf76ij321h6l', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-09 16:26:11');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('202', '127.0.0.1', NULL, NULL, 'uqqposkkl546hapf6dlr3lc96a', 'api', 'GET', '/actions/print_shipping_label.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-09 16:41:28');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('203', '127.0.0.1', '1', 'مدیر سیستم', '4rm1s41dbc0m0gh1k4iveba1lk', 'api', 'GET', '/actions/print_shipping_label.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-09 19:59:25');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('204', '::1', NULL, NULL, '8h7ol2nemhu6d5vfnqdhgktgsc', 'browse', 'HEAD', '/asena/asena-enterprise/', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-10 14:41:30');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('205', '127.0.0.1', NULL, NULL, 'o4j1s4mle9jbe92b5lqjvlciv4', 'browse', 'GET', '/asena/asena-enterprise/index.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-10 14:42:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('206', '127.0.0.1', NULL, NULL, 'o4j1s4mle9jbe92b5lqjvlciv4', 'admin_action', 'GET', '/asena/asena-enterprise/admin/organizations.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-10 14:42:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('207', '127.0.0.1', NULL, NULL, 'o4j1s4mle9jbe92b5lqjvlciv4', 'admin_action', 'GET', '/asena/asena-enterprise/admin/doctors.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-10 14:42:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('208', '127.0.0.1', NULL, NULL, 'o4j1s4mle9jbe92b5lqjvlciv4', 'admin_action', 'GET', '/asena/asena-enterprise/admin/sellers.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-10 14:42:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('209', '127.0.0.1', NULL, NULL, 'o4j1s4mle9jbe92b5lqjvlciv4', 'admin_action', 'GET', '/asena/asena-enterprise/admin/payouts.php', '', NULL, NULL, 'Unknown', '200', '0', NULL, '2026-09-10 14:42:18');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('210', '::1', NULL, NULL, 'r2avi2dgqph506v02lf0oe2m91', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-10 14:43:17');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('211', '::1', NULL, NULL, 'lskfju2rvciuv2r8aoq1cukjcm', 'cart', 'HEAD', '/asena/asena-enterprise/cart.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-10 14:43:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('212', '::1', NULL, NULL, '1vpnjfct97cuqhq8aad6e64u03', 'auth', 'HEAD', '/asena/asena-enterprise/register.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-10 14:43:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('213', '::1', NULL, NULL, '3ffpdukhj5scuhp2kmk4eafqc5', 'browse', 'HEAD', '/asena/asena-enterprise/shop.php', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-10 14:43:20');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('214', '::1', NULL, NULL, 'jajulafsbud4dslsooolf6iard', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'curl/8.16.0', '200', '0', NULL, '2026-09-10 14:43:32');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('215', '127.0.0.1', NULL, NULL, 'solbek6a2mm3nj19iiaivaoibr', 'browse', 'GET', '/asena/asena-enterprise/', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-10 14:43:43');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('216', '127.0.0.1', '1', 'مدیر سیستم', '18keh6mpdfa6l8lsf7mqp80u0s', 'admin_action', 'GET', '/asena/asena-enterprise/admin/payouts.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-10 16:25:11');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('217', '127.0.0.1', '1', 'مدیر سیستم', '882ejq3fgf3sf6qq27trf04ili', 'admin_action', 'GET', '/asena/asena-enterprise/admin/payouts.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', '200', '0', NULL, '2026-09-10 17:27:29');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('218', '::1', NULL, NULL, '7tmja7a3cvhke6lsk0gggrdhe1', 'browse', 'GET', '/asena/asena-enterprise/privacy.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-10 18:07:12');
INSERT INTO `system_request_logs` (`id`, `ip_address`, `user_id`, `user_name`, `session_id`, `action_type`, `request_method`, `request_uri`, `payload_summary`, `cf_ray`, `cf_country`, `user_agent`, `response_code`, `is_suspicious`, `suspicion_reason`, `created_at`) VALUES ('219', '::1', NULL, NULL, '7tmja7a3cvhke6lsk0gggrdhe1', 'browse', 'GET', '/asena/asena-enterprise/terms.php', '', NULL, NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', '200', '0', NULL, '2026-09-10 18:07:26');

DROP TABLE IF EXISTS `ticket_messages`;
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('1', '1', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-07-31 14:31:35');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('2', '2', 'admin', 'درخواست شما ثبت شد. یکی از کارشناسان ما به زودی پاسخگوی شما خواهد بود.', NULL, '2026-07-31 14:31:51');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('3', '1', 'user', 'hi', NULL, '2026-07-31 14:51:15');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('4', '1', 'ai', 'خطا در برقراری ارتباط با مغز لئو.', NULL, '2026-07-31 14:51:17');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('5', '2', 'user', 'hello', NULL, '2026-07-31 14:51:31');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('6', '2', 'admin', 'hi', NULL, '2026-07-31 14:51:45');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('7', '2', 'admin', 'what is the problem with your pet', NULL, '2026-07-31 14:52:01');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('8', '2', 'user', 'hi', NULL, '2026-07-31 15:04:41');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('9', '3', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-01 15:16:39');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('10', '4', 'admin', 'درخواست شما ثبت شد. یکی از کارشناسان ما به زودی پاسخگوی شما خواهد بود.', NULL, '2026-08-01 19:04:41');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('11', '5', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-01 20:17:18');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('12', '6', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-03 10:16:02');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('13', '7', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-03 10:23:13');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('14', '8', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-03 10:24:18');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('15', '9', 'admin', 'درخواست شما ثبت شد. یکی از کارشناسان ما به زودی پاسخگوی شما خواهد بود.', NULL, '2026-08-03 11:05:41');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('16', '10', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-03 13:52:33');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('17', '11', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-03 13:55:12');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('18', '14', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-18 14:04:24');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('19', '15', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-18 14:58:32');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('20', '16', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-24 21:20:40');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('21', '17', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-08-27 12:29:32');
INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_type`, `message`, `image_url`, `created_at`) VALUES ('29', '26', 'ai', 'سلام! من لئو هستم، دستیار هوشمند شما. چطور می‌تونم به فرشته کوچولوت کمک کنم؟', NULL, '2026-09-07 20:31:07');

DROP TABLE IF EXISTS `tickets`;
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('1', '2', 'ai', 'closed', '2026-07-31 14:31:35', '2026-08-01 15:16:03');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('2', '2', 'admin', 'closed', '2026-07-31 14:31:51', '2026-08-01 15:16:03');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('3', '2', 'ai', 'closed', '2026-08-01 15:16:39', '2026-08-03 10:12:56');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('4', '2', 'admin', 'closed', '2026-08-01 19:04:41', '2026-08-03 10:12:56');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('5', '9', 'ai', 'closed', '2026-08-01 20:17:18', '2026-08-03 10:12:56');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('6', '7', 'ai', 'closed', '2026-08-03 10:16:02', '2026-08-24 21:31:37');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('7', '2', 'ai', 'closed', '2026-08-03 10:23:13', '2026-08-24 21:31:37');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('8', '10', 'ai', 'closed', '2026-08-03 10:24:18', '2026-08-24 21:31:37');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('9', '2', 'admin', 'closed', '2026-08-03 11:05:41', '2026-08-24 21:31:37');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('10', '11', 'ai', 'closed', '2026-08-03 13:52:33', '2026-08-24 21:31:37');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('11', '3', 'ai', 'closed', '2026-08-03 13:55:12', '2026-08-24 21:31:37');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('14', '1', 'ai', 'closed', '2026-08-18 14:04:24', '2026-08-24 21:31:37');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('15', '12', 'ai', 'closed', '2026-08-18 14:58:32', '2026-08-24 21:31:37');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('16', '13', 'ai', 'closed', '2026-08-24 21:20:40', '2026-09-10 17:27:05');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('17', '5', 'ai', 'closed', '2026-08-27 12:29:32', '2026-09-10 17:27:05');
INSERT INTO `tickets` (`id`, `user_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES ('26', '16', 'ai', 'closed', '2026-09-07 20:31:07', '2026-09-10 17:27:05');

DROP TABLE IF EXISTS `user_pets`;
CREATE TABLE `user_pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `race` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(20) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `weight_kg` decimal(5,2) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `microchip_number` varchar(100) DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `last_doctor_id` int(11) DEFAULT NULL,
  `clinical_verified_at` datetime DEFAULT NULL,
  `pending_doctor_proposal` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_pets` (`id`, `user_id`, `name`, `type`, `race`, `created_at`, `gender`, `age`, `weight_kg`, `birth_date`, `microchip_number`, `allergies`, `medical_history`, `last_doctor_id`, `clinical_verified_at`, `pending_doctor_proposal`) VALUES ('1', '2', 'joei', 'سگ', 'germenshepert', '2026-07-23 13:51:15', 'نر', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user_pets` (`id`, `user_id`, `name`, `type`, `race`, `created_at`, `gender`, `age`, `weight_kg`, `birth_date`, `microchip_number`, `allergies`, `medical_history`, `last_doctor_id`, `clinical_verified_at`, `pending_doctor_proposal`) VALUES ('3', '2', 'pisi', 'گربه', 'persian', '2026-07-23 15:41:51', 'ماده', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user_pets` (`id`, `user_id`, `name`, `type`, `race`, `created_at`, `gender`, `age`, `weight_kg`, `birth_date`, `microchip_number`, `allergies`, `medical_history`, `last_doctor_id`, `clinical_verified_at`, `pending_doctor_proposal`) VALUES ('4', '5', 'Bobby2', 'سگ', 'Husky', '2026-07-25 03:35:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user_pets` (`id`, `user_id`, `name`, `type`, `race`, `created_at`, `gender`, `age`, `weight_kg`, `birth_date`, `microchip_number`, `allergies`, `medical_history`, `last_doctor_id`, `clinical_verified_at`, `pending_doctor_proposal`) VALUES ('5', '7', 'dogie', 'سگ', 'bulldog', '2026-07-25 14:32:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user_pets` (`id`, `user_id`, `name`, `type`, `race`, `created_at`, `gender`, `age`, `weight_kg`, `birth_date`, `microchip_number`, `allergies`, `medical_history`, `last_doctor_id`, `clinical_verified_at`, `pending_doctor_proposal`) VALUES ('6', '11', 'akbar', 'سگ', '', '2026-08-03 13:52:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

DROP TABLE IF EXISTS `user_subscriptions`;
CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` enum('active','ended','cancelled') DEFAULT 'active',
  `next_delivery_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `duration_months` int(11) DEFAULT 3,
  `payment_model` enum('monthly','upfront') DEFAULT 'monthly',
  `delivery_frequency` varchar(50) DEFAULT '1_month',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_user_subs_status` (`status`),
  CONSTRAINT `user_subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_subscriptions` (`id`, `user_id`, `plan_name`, `amount`, `status`, `next_delivery_date`, `created_at`, `duration_months`, `payment_model`, `delivery_frequency`) VALUES ('2', '2', 'اشتراک ۶ ماهه', '2100000', 'active', '2026-09-02', '2026-07-31 21:08:06', '6', 'monthly', '1_month');
INSERT INTO `user_subscriptions` (`id`, `user_id`, `plan_name`, `amount`, `status`, `next_delivery_date`, `created_at`, `duration_months`, `payment_model`, `delivery_frequency`) VALUES ('3', '11', 'اشتراک ۳ ماهه', '2500000', 'active', '2026-09-23', '2026-08-03 13:53:44', '3', 'monthly', '1_month');
INSERT INTO `user_subscriptions` (`id`, `user_id`, `plan_name`, `amount`, `status`, `next_delivery_date`, `created_at`, `duration_months`, `payment_model`, `delivery_frequency`) VALUES ('4', '4', 'اشتراک ۳ ماهه ویژه گربه', '1850000', 'active', '2026-08-25', '2026-08-20 10:00:00', '3', 'monthly', '2_weeks');
INSERT INTO `user_subscriptions` (`id`, `user_id`, `plan_name`, `amount`, `status`, `next_delivery_date`, `created_at`, `duration_months`, `payment_model`, `delivery_frequency`) VALUES ('5', '6', 'اشتراک ماهانه داروهای قلبی سگ', '950000', 'active', '2026-08-28', '2026-08-10 12:00:00', '1', 'monthly', '2_weeks');
INSERT INTO `user_subscriptions` (`id`, `user_id`, `plan_name`, `amount`, `status`, `next_delivery_date`, `created_at`, `duration_months`, `payment_model`, `delivery_frequency`) VALUES ('6', '5', 'اشتراک ۶ ماهه مکمل و سم اسب', '3200000', 'active', '2026-09-19', '2026-08-01 09:00:00', '6', 'monthly', '1_month');

DROP TABLE IF EXISTS `user_wallets`;
CREATE TABLE `user_wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `currency` varchar(10) DEFAULT 'IRT',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `fk_wallet_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_wallets` (`id`, `user_id`, `balance`, `currency`, `created_at`, `updated_at`) VALUES ('1', '16', '0', 'IRT', '2026-09-07 20:31:17', '2026-09-07 20:31:17');
INSERT INTO `user_wallets` (`id`, `user_id`, `balance`, `currency`, `created_at`, `updated_at`) VALUES ('2', '1', '0', 'IRT', '2026-09-07 20:37:42', '2026-09-07 20:37:42');
INSERT INTO `user_wallets` (`id`, `user_id`, `balance`, `currency`, `created_at`, `updated_at`) VALUES ('3', '14', '0', 'IRT', '2026-09-07 21:11:21', '2026-09-07 21:11:21');
INSERT INTO `user_wallets` (`id`, `user_id`, `balance`, `currency`, `created_at`, `updated_at`) VALUES ('4', '7', '0', 'IRT', '2026-09-07 21:13:06', '2026-09-07 21:13:06');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sms_code` varchar(10) DEFAULT NULL,
  `role` enum('user','admin','doctor','organization','pharmacist','seller') DEFAULT 'user',
  `pending_role` varchar(50) DEFAULT NULL,
  `verification_status` enum('none','pending','approved','rejected') DEFAULT 'none',
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
  `national_id` varchar(20) DEFAULT NULL,
  `vet_council_number` varchar(50) DEFAULT NULL,
  `is_verified_vet` tinyint(1) DEFAULT 0,
  `sheba_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `phone_2` (`phone`),
  UNIQUE KEY `google_id` (`google_id`),
  UNIQUE KEY `apple_id` (`apple_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('1', '09123456789', 'مدیر سیستم', NULL, 'admin', NULL, 'none', '2026-07-21 15:23:55', '$2y$10$ZAeDLnSqy8Hn0ZcShAY6/O.mLBntXBzfnyAvcy8NCsbrQiOhhEzse', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', '2026-09-07', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('2', '096154654', 'ayhan', NULL, 'admin', NULL, 'none', '2026-07-21 19:16:18', '$2y$10$wQ/UJ0eAxhmzvST6hlmYaOuNu/jWLHjPytzydJbiEit.l3.ZOx1D.', NULL, NULL, 'mehrzad.ayhan@gmail.com', 'تبریز', '', 'نارمک, Golgasht, مرز محله, Tabriz, بخش مرکزی شهرستان تبریز, Tabriz County, East Azerbaijan Province, 51639-17697, Iran', '38.06273998', '46.32526875', '220', '2026-08-01', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('3', 'doctor@gmail.com', 'ali', NULL, 'doctor', NULL, 'none', '2026-07-23 21:19:04', '$2y$10$cseRCBybswwGyndV1Z4s6OqWMRgp5YK2l54SE2MzJgPYnczSIsLKO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '90', '2026-08-03', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('4', '09990999', 'akbar nami', NULL, 'doctor', NULL, 'none', '2026-07-23 21:21:54', '$2y$10$GqI3ekTbgb9F8IiomfpCmec32eUnAJaSTwIsfTuJacVzTL7UJGcWu', NULL, NULL, 'nami.akbar@gmail.com', NULL, NULL, '', NULL, NULL, '0', '2026-07-23', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('5', '09000000001', 'test user', NULL, 'organization', NULL, 'none', '2026-07-25 03:33:28', '$2y$10$y.vkUVuQAmW5rZZFDfgvcOLUto/d//fRDeApmu/zL0u1BVhqPATUK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '110', '2026-08-27', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('6', '09194360331', 'کاربر تستی OAuth', NULL, 'admin', NULL, 'none', '2026-07-25 03:57:34', NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, '90', '2026-07-25', 'mock_123456', NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('7', 'user.user@gmail.com', 'آیهان تستی دیجی‌کالا', NULL, 'user', NULL, 'none', '2026-07-25 14:07:59', '$2y$10$5wgtg5LAG.faU2Og.BmO8ed.Xu8G22XAOjTEWji3ZWokIMhjN6pyy', NULL, NULL, 'ayhan.enterprise@test.com', 'تبریز', '5138612345', 'خیابان ولیعصر، برج تجارت، طبقه ۴', '38.07000000', '46.30000000', '160', '2026-09-07', NULL, NULL, '0012345678', NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('8', 'user.admin@gmail.com', 'user.admin', NULL, 'admin', NULL, 'none', '2026-07-25 14:59:15', '$2y$10$eOfr0iUrovwG7ALhRvEijeLquk3DZ9RxP64GhHFPDWD8I1zZlqryy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', '2026-07-25', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('9', 'cataloguser', 'Catalog User', NULL, 'user', NULL, 'none', '2026-08-01 20:17:17', '$2y$10$A1x/tZQKwG29pTij62yKhermzbVR0XpvsuZ.Zjm5bWHbd3PcfEFKC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', '2026-08-01', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('10', 'user.doctor', 'doctor', NULL, 'doctor', NULL, 'none', '2026-08-03 10:24:18', '$2y$10$CxgspghNotQUWswEVjnZnegT4UdZ.X26hkw0/5KO8FAwtN0lTrGXe', NULL, NULL, '', NULL, NULL, '', NULL, NULL, '70', '2026-08-03', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('11', 'user.more', 'user1', NULL, 'user', NULL, 'none', '2026-08-03 13:52:32', '$2y$10$k5PC7Jh7bgb/C99hRg5eHOD1kRAfqFctGHiJaSoLzF/UOrM2u/.ae', NULL, NULL, NULL, 'تبریز', '1234567890', 'پردیس ۲, Baghmisheh, Tabriz, بخش مرکزی شهرستان تبریز, Tabriz County, East Azerbaijan Province, 51584-46719, Iran', '38.06741958', '46.38874054', '170', '2026-08-03', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('12', '09144046728', 'ayxan mehrzad', NULL, 'user', NULL, 'none', '2026-08-18 14:58:29', '$2y$10$Ges1WajBHR5DqyKcJUhoH.LAvyrBk/ZPof7Mv18vK3qrdMbd4caIe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', '2026-08-18', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('13', '09146676978', 'ayhan', NULL, 'admin', NULL, 'none', '2026-08-24 21:20:39', '$2y$10$vX.FbOnuI2eP8BVVR./a1.oxGb.d4O.oywOLigJKuKLL/EkYvn25e', NULL, NULL, NULL, 'تبریز', '1234567890', 'امیرالمومنین, World trade, Vali asr, ولیعصر, Valiasr, Tabriz, بخش مرکزی شهرستان تبریز, Tabriz County, East Azerbaijan Province, 51578-48778, Iran', '38.06606810', '46.36505127', '120', '2026-08-24', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('14', '09129998877', 'تستر آسنا', NULL, 'seller', NULL, 'none', '2026-09-05 13:58:06', '$2y$10$SO/7sE8h.DzSOKmPG7ZFluFm9zqGPfmamFCHI.oR5TFNsYlye.MP6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', '2026-09-07', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('16', '09121234567', 'مهدی حسینی', NULL, 'user', NULL, 'none', '2026-09-07 17:22:28', '$2y$10$xq8AF0bzrW4.aizVo.L6MeZ./stKh1unGEHWm7Vi9IgybWWOzeaKu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', '2026-09-07', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('18', '09121112233', 'مهندس رضا کریمی', NULL, 'organization', NULL, 'approved', '2026-09-07 18:57:14', '$2y$10$ucmz74L14E31oFTIe3Ja1u.hZvicFhDRGwrrKDUgQAyVG8fHwQ2ly', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('23', '09128889900', 'دکتر رامین مهدوی (داروخانه رازی)', NULL, 'pharmacist', NULL, 'approved', '2026-09-07 19:44:43', '$2y$10$4a2gZbi82fZ.B7T8mVHXYOdQd12I9QJaDT1uyljKGf56EzOYMR2W6', NULL, NULL, 'mahdavi.pharma@gmail.com', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO `users` (`id`, `phone`, `name`, `sms_code`, `role`, `pending_role`, `verification_status`, `created_at`, `password`, `pet_type`, `pet_race`, `email`, `city`, `postal_code`, `address`, `latitude`, `longitude`, `loyalty_points`, `last_monthly_points_date`, `google_id`, `apple_id`, `national_id`, `vet_council_number`, `is_verified_vet`, `sheba_number`) VALUES ('24', '09122223344', 'دکتر هما مهرزاد', NULL, 'doctor', NULL, 'approved', '2026-09-07 19:45:54', '$2y$10$GxvDru2dms6P2diGg9qNnOvl9TiGGHkFju0glBpeyswsz0qMHvTmq', NULL, NULL, 'homa.mehrzad@gmail.com', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', NULL);

DROP TABLE IF EXISTS `wallet_transactions`;
CREATE TABLE `wallet_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wallet_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `type` enum('deposit','withdrawal','refund','cashback','purchase') NOT NULL,
  `description` varchar(500) NOT NULL,
  `reference_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_wallet_tx` (`wallet_id`),
  CONSTRAINT `fk_tx_wallet` FOREIGN KEY (`wallet_id`) REFERENCES `user_wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_product` (`user_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`) VALUES ('1', '6', '31', '2026-07-25 03:58:06');
INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`) VALUES ('2', '6', '2', '2026-07-25 04:31:06');
INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`) VALUES ('3', '7', '31', '2026-07-25 14:08:41');

SET FOREIGN_KEY_CHECKS=1;
