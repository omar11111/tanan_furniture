-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2021 at 05:43 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nti_ecommerce_last`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `street` text NOT NULL,
  `building` varchar(20) NOT NULL,
  `floor` varchar(50) NOT NULL,
  `flat` smallint(5) UNSIGNED NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `building`, `floor`, `flat`, `type`, `notes`, `lat`, `longitude`, `region_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'nozaha road', '60', '10', 50, 'Home', NULL, 30.5, 30.1, 2, 10, '2021-02-09 12:16:21', '2021-02-09 13:18:40'),
(2, 'fawzy moaaz', '4', '5', 8, 'Home', 'odam elkornesh shwya', 30.1, 30.2, 4, 10, '2021-02-09 12:17:10', '2021-02-09 14:18:46'),
(3, 'gg', '25', '4', 2, 'Work', NULL, 20.5, 50.3, 1, 9, '2021-02-09 12:34:49', '2021-02-09 13:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quantity` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(60) NOT NULL,
  `name_ar` varchar(60) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'category.png',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-->active  \r\n2-->not active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_en`, `name_ar`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sofa', 'ركنة', 'category.png', 1, '2021-02-10 08:00:54', '2021-03-13 04:38:35'),
(2, 'انتريه', 'خضار', 'category.png', 1, '2021-02-10 08:00:54', '2021-03-13 04:38:35'),
(3, 'صالون', 'زيوت', 'category.png', 1, '2021-02-10 08:01:14', '2021-03-13 04:38:35'),
(4, 'نيش', 'عسل', 'category.png', 1, '2021-02-10 08:40:07', '2021-03-13 04:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `center` int(10) NOT NULL,
  `distance` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `center`, `distance`, `created_at`, `updated_at`) VALUES
(1, 'cairo', 20, 20, '2021-02-09 12:14:21', '2021-02-09 12:14:21'),
(2, 'alex', 30, 30, '2021-02-09 12:14:21', '2021-02-09 12:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `lat` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:active\r\n2:not active',
  `total_price` decimal(10,3) NOT NULL,
  `notes` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `lat`, `longitude`, `status`, `total_price`, `notes`, `date`, `created_at`, `updated_at`, `user_id`) VALUES
(1, NULL, NULL, 1, '200.000', NULL, '2021-02-11 19:24:37', '2021-02-13 17:26:26', '2021-02-13 17:26:26', 10),
(2, NULL, NULL, 1, '300.000', NULL, '2021-02-24 19:24:37', '2021-02-13 17:26:26', '2021-02-13 17:26:26', 9),
(3, NULL, NULL, 1, '200.000', NULL, '2021-02-11 19:24:37', '2021-02-13 17:27:49', '2021-02-13 17:27:49', 9),
(4, NULL, NULL, 1, '300.000', NULL, '2021-02-24 19:24:37', '2021-02-13 17:27:49', '2021-02-13 17:27:49', 10),
(5, NULL, NULL, 1, '200.000', NULL, '2021-02-11 19:24:37', '2021-02-13 19:52:54', '2021-02-13 19:52:54', 9),
(6, NULL, NULL, 1, '300.000', NULL, '2021-02-24 19:24:37', '2021-02-13 19:52:54', '2021-02-13 19:52:54', 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-02-13 17:29:19', '2021-02-13 17:29:19'),
(2, 3, '2021-02-13 17:29:51', '2021-02-13 17:29:51'),
(4, 3, '2021-02-13 17:29:19', '2021-02-13 17:29:19'),
(4, 5, '2021-02-13 17:29:51', '2021-02-13 17:29:51'),
(5, 1, '2021-02-13 19:55:30', '2021-02-13 19:55:30'),
(5, 6, '2021-02-13 19:55:30', '2021-02-13 19:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(60) NOT NULL,
  `name_ar` varchar(60) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'product.jpg',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1--> active\r\n2-->not active',
  `stock` varchar(50) DEFAULT NULL,
  `subcat_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `viewer` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_en`, `name_ar`, `price`, `photo`, `status`, `stock`, `subcat_id`, `supplier_id`, `viewer`, `created_at`, `updated_at`) VALUES
(1, 'zet 3bad elshams', 'زيت عباد الشمس', '12354.00', '1.jpg', 1, '5', 1, 1, 1, '2021-02-10 08:50:32', '2021-02-13 21:18:12'),
(2, 'zet zaton', 'زيت زتون', '122.00', '2.jpg', 1, '22', 1, 1, 2, '2021-02-10 08:50:32', '2021-02-13 21:18:19'),
(3, 'zet dora', 'زيت ذرة', '225.00', '3.jpg', 1, '6', 1, 1, 3, '2021-02-10 08:52:27', '2021-02-13 21:18:38'),
(4, 'shta', 'شطة', '123.00', '4.jpg', 1, '5', 3, 1, 4, '2021-02-10 08:52:27', '2021-02-13 21:18:44'),
(5, 'flfl aswd', 'فلفل اسود', '22.00', '7.jpg', 1, '5', 3, 1, 0, '2021-02-10 08:53:50', '2021-02-10 08:53:50'),
(6, 'mol5ya mogffa', 'ملخية ناشفة', '21.00', '6.jpg', 1, NULL, 6, 1, 0, '2021-02-10 08:53:50', '2021-02-10 08:53:50');

-- --------------------------------------------------------

--
-- Stand-in structure for view `products_details`
-- (See below for the actual view)
--
CREATE TABLE `products_details` (
`id` int(10) unsigned
,`name_en` varchar(60)
,`name_ar` varchar(60)
,`price` decimal(8,2)
,`photo` varchar(255)
,`status` tinyint(1)
,`stock` varchar(50)
,`subcat_id` int(10) unsigned
,`supplier_id` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`value_ar` varchar(255)
,`value_en` varchar(255)
,`key_en` varchar(60)
,`key_ar` varchar(60)
);

-- --------------------------------------------------------

--
-- Table structure for table `products_specs`
--

CREATE TABLE `products_specs` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `spec_id` int(10) UNSIGNED NOT NULL,
  `value_ar` varchar(255) NOT NULL,
  `value_en` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_specs`
--

INSERT INTO `products_specs` (`product_id`, `spec_id`, `value_ar`, `value_en`, `created_at`, `updated_at`) VALUES
(5, 1, 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هن', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ip', '2021-02-10 09:22:13', '2021-02-10 09:22:13'),
(6, 1, 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هن', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, co', '2021-02-10 09:22:13', '2021-02-10 09:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `center` int(10) NOT NULL,
  `distance` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `city_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `center`, `distance`, `created_at`, `updated_at`, `city_id`) VALUES
(1, 'naser city', 30, 30, '2021-02-09 12:15:08', '2021-02-09 12:15:08', 1),
(2, 'maadi', 30, 25, '2021-02-09 12:15:08', '2021-02-09 12:15:08', 1),
(3, 'abu kier', 30, 25, '2021-02-09 12:15:33', '2021-02-09 12:15:33', 2),
(4, 'smo7a', 25, 620, '2021-02-09 12:15:33', '2021-02-09 12:15:33', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `comment` text NOT NULL,
  `value` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`product_id`, `user_id`, `created_at`, `updated_at`, `comment`, `value`) VALUES
(2, 9, '2021-02-13 20:10:44', '2021-02-13 20:10:44', '', 4),
(2, 10, '2021-02-13 20:11:30', '2021-02-13 20:11:30', '', 4),
(3, 9, '2021-02-13 20:11:30', '2021-02-13 20:11:30', '', 5),
(4, 9, '2021-02-13 20:19:26', '2021-02-13 20:19:26', '', 1),
(6, 10, '2021-02-13 20:10:44', '2021-02-13 20:10:44', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `id` int(10) UNSIGNED NOT NULL,
  `key_en` varchar(60) NOT NULL,
  `key_ar` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specs`
--

INSERT INTO `specs` (`id`, `key_en`, `key_ar`, `created_at`, `updated_at`) VALUES
(1, 'details', 'التفاصيل', '2021-02-10 09:19:14', '2021-02-10 09:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `subcats`
--

CREATE TABLE `subcats` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_en` varchar(60) NOT NULL,
  `name_ar` varchar(60) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'subcat.png',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-->active\r\n2-->not active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcats`
--

INSERT INTO `subcats` (`id`, `name_en`, `name_ar`, `photo`, `status`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Modern Sofa', 'ركنة مودرن', 'subcat.png', 1, '2021-02-10 08:02:39', '2021-03-13 04:42:50', 1),
(2, 'Classic Sofa', 'ركنة كلاسيك', 'subcat.png', 1, '2021-02-10 08:02:39', '2021-03-13 04:42:50', 1),
(3, 'Golden Antareh', 'انتريه مدهب', 'subcat.png', 1, '2021-02-10 08:05:23', '2021-03-13 04:42:50', 2),
(4, 'Brown Nesh', 'اعشاب طبية', 'subcat.png', 1, '2021-02-10 08:05:23', '2021-03-13 04:42:50', 4),
(5, 'Silver Nesh', 'اعشاب تخسيس', 'subcat.png', 1, '2021-02-10 08:06:15', '2021-03-13 04:42:51', 4),
(6, 'Golden Nesh', 'خضار مجفف', 'subcat.png', 1, '2021-02-10 08:07:01', '2021-03-13 04:42:51', 4);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `national_id` int(14) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-->active\r\n2-->not active',
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `national_id`, `phone`, `password`, `gender`, `status`, `email`, `created_at`, `updated_at`) VALUES
(1, 'galal', 29621532, '2135123', 'galal', 'male', 1, 'galal.husseny@gmail.com', '2021-02-10 08:46:36', '2021-02-10 08:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'default.png',
  `status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1:active2:not Verified',
  `code` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `photo`, `status`, `code`, `created_at`, `updated_at`) VALUES
(9, 'andrew', 'ramy', 'andrew_ramy@outlook.com', '1234563', '7f9f88b8d17ca91772028a6a3fa19dbcf5a4e5d9', 'default.png', 1, '24336', '2021-02-07 13:14:50', '2021-02-08 08:51:09'),
(10, 'galal', 'husseny', 'galal.husseny@gmail.com', '123456789', 'fe012728adea02cdc41c5deb4cbe79d6e8b57d26', '4.png', 1, '67403', '2021-02-08 07:23:40', '2021-02-09 12:08:44'),
(15, 'Omar', 'ALGalfy', 'algalfy71@gmail.com', '01272305641', 'Omar@1234', 'default.png', 2, NULL, '2021-02-28 01:01:08', '2021-02-28 01:01:08'),
(16, 'Algalfy', 'ALGalfy', 'omar150196@fci.bu.edu.eg', '01276938658', 'Omar@1234', 'default.png', 2, NULL, '2021-02-28 01:03:16', '2021-02-28 01:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `products_details`
--
DROP TABLE IF EXISTS `products_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_details`  AS  (select `products`.`id` AS `id`,`products`.`name_en` AS `name_en`,`products`.`name_ar` AS `name_ar`,`products`.`price` AS `price`,`products`.`photo` AS `photo`,`products`.`status` AS `status`,`products`.`stock` AS `stock`,`products`.`subcat_id` AS `subcat_id`,`products`.`supplier_id` AS `supplier_id`,`products`.`created_at` AS `created_at`,`products`.`updated_at` AS `updated_at`,`products_specs`.`value_ar` AS `value_ar`,`products_specs`.`value_en` AS `value_en`,`specs`.`key_en` AS `key_en`,`specs`.`key_ar` AS `key_ar` from ((`products` left join `products_specs` on(`products`.`id` = `products_specs`.`product_id`)) left join `specs` on(`specs`.`id` = `products_specs`.`spec_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_regions_fk` (`region_id`),
  ADD KEY `addresses_users_fk` (`user_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `carts_users_fk` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user_fk` (`user_id`) USING BTREE;

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `products_orders_fk` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_subcat_fk` (`subcat_id`) USING BTREE,
  ADD KEY `products_suppliers_fk` (`supplier_id`);

--
-- Indexes for table `products_specs`
--
ALTER TABLE `products_specs`
  ADD PRIMARY KEY (`product_id`,`spec_id`),
  ADD KEY `specs_products_fk` (`spec_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regions_cities_fk` (`city_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `reviews_users_fk` (`user_id`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcats`
--
ALTER TABLE `subcats`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `subcats_categories_fk` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `wishlists_users_fk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specs`
--
ALTER TABLE `specs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcats`
--
ALTER TABLE `subcats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_regions_fk` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addresses_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_products_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `orders_products_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_orders_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_subcats_fk` FOREIGN KEY (`subcat_id`) REFERENCES `subcats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_suppliers_fk` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_specs`
--
ALTER TABLE `products_specs`
  ADD CONSTRAINT `products_specs_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specs_products_fk` FOREIGN KEY (`spec_id`) REFERENCES `specs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_cities_fk` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_products_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `subcats`
--
ALTER TABLE `subcats`
  ADD CONSTRAINT `subcats_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_products_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlists_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
