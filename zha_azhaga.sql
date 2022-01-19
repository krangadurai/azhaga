-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2020 at 01:47 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+05:30";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azhaga`
--

-- --------------------------------------------------------

--
-- Table structure for table `zha_admins`
--

CREATE TABLE `zha_admins` (
  `zha_admin_id` int(11) NOT NULL,
  `zha_admin_name` text NOT NULL,
  `zha_admin_email` varchar(200) NOT NULL,
  `zha_admin_password` varchar(45) NOT NULL,
  `zha_login_start` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_login_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zha_admins`
--

INSERT INTO `zha_admins` (`zha_admin_id`, `zha_admin_name`, `zha_admin_email`, `zha_admin_password`, `zha_login_start`, `zha_login_end`) VALUES
(1, 'ra', 'ra@azhaga.com', 'Qwerty12345!', '2020-10-24 07:59:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zha_auth_tokens`
--

CREATE TABLE `zha_auth_tokens` (
  `zha_id` int(11) NOT NULL,
  `zha_phone` text DEFAULT NULL,
  `zha_email` varchar(200) DEFAULT NULL,
  `zha_auth_type` text NOT NULL,
  `zha_selector` text NOT NULL,
  `zha_token` varchar(100) NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_expiry_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `zha_category`
--

CREATE TABLE `zha_category` (
  `zha_id` int(11) NOT NULL,
  `zha_catagory_name` text NOT NULL,
  `zha_admin_id` int(11) NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_comments`
--

CREATE TABLE `zha_comments` (
  `zha_comment_id` int(11) NOT NULL,
  `zha_user_id` int(11) NOT NULL,
  `zha_order_id` text NOT NULL,
  `zha_comment` text NOT NULL,
  `zha_like` int(1) DEFAULT NULL,
  `zha_dislike` int(1) DEFAULT NULL,
  `zha_created_at` datetime NOT NULL,
  `zha_update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_contacts`
--

CREATE TABLE `zha_contacts` (
  `zha_id` int(11) NOT NULL,
  `zha_conect_email` varchar(200) NOT NULL,
  `zha_contact_id` text NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_status` text DEFAULT NULL,
  `zha_clear_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_delivery`
--

CREATE TABLE `zha_delivery` (
  `zha_id` int(11) NOT NULL,
  `zha_product_name` text NOT NULL,
  `zha_fullname` text NOT NULL,
  `zha_order_id` text NOT NULL,
  `zha_delivery_id` text NOT NULL,
  `zha_delivery_status` text NOT NULL,
  `zha_created_at` datetime NOT NULL,
  `zha_updated_at` datetime NOT NULL,
  `zha_clear_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_discounts`
--

CREATE TABLE `zha_discounts` (
  `zha_discount_id` int(11) NOT NULL,
  `zha_admin_id` int(11) NOT NULL,
  `zha_product_id` int(11) NOT NULL,
  `zha_discount_name` text NOT NULL,
  `zha_dicount_price` text NOT NULL,
  `zha_discount_start` datetime NOT NULL,
  `zha_discount_end` datetime NOT NULL,
  `zha_dicount_active` int(1) NOT NULL,
  `zha_discount_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_orders`
--

CREATE TABLE `zha_orders` (
  `zha_id` int(11) NOT NULL,
  `zha_order_id` text NOT NULL,
  `zha_payment_id` text NOT NULL,
  `zha_currency` text NOT NULL,
  `zha_status` text NOT NULL,
  `zha_product_id` int(11) NOT NULL,
  `zha_product_name` text NOT NULL,
  `zha_product_quantity` text NOT NULL,
  `zha_product_price` text NOT NULL,
  `zha_product_total_price` text NOT NULL,
  `zha_user_id` text NOT NULL,
  `zha_order_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `zha_payments`
--

CREATE TABLE `zha_payments` (
  `id` int(11) NOT NULL,
  `zha_payment_id` text NOT NULL,
  `zha_order_id` text NOT NULL,
  `zha_signature` text NOT NULL,
  `zha_payment` text NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_products`
--

CREATE TABLE `zha_products` (
  `zha_product_id` int(11) NOT NULL,
  `zha_admin_id` int(11) NOT NULL,
  `zha_product_name` text NOT NULL,
  `zha_product_oneline` text NOT NULL,
  `zha_product_description` longtext NOT NULL,
  `zha_stock_quantity` varchar(10) NOT NULL,
  `zha_category_name` text NOT NULL,
  `zha_price` varchar(45) NOT NULL,
  `zha_old_price` varchar(45) NOT NULL,
  `zha_color` varchar(45) DEFAULT NULL,
  `zha_size` varchar(45) NOT NULL,
  `zha_product_thumb` varchar(100) NOT NULL,
  `zha_product_weight` text NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Table structure for table `zha_products_image`
--

CREATE TABLE `zha_products_image` (
  `zha_id` int(11) NOT NULL,
  `zha_image` text NOT NULL,
  `zha_product_id` int(11) NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_products_sale`
--

CREATE TABLE `zha_products_sale` (
  `zha_id` int(11) NOT NULL,
  `zha_product_id` int(11) NOT NULL,
  `zha_order_id` text NOT NULL,
  `zha_prdouct_name` text NOT NULL,
  `zha_sale_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_products_tags`
--

CREATE TABLE `zha_products_tags` (
  `zha_id` int(11) NOT NULL,
  `zha_product_id` int(11) NOT NULL,
  `zha_tag_id` int(11) NOT NULL,
  `zha_admin_id` int(11) NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_ratings`
--

CREATE TABLE `zha_ratings` (
  `zha_rating _id` int(11) NOT NULL,
  `zha_user_id` int(11) NOT NULL,
  `zha_product_id` int(11) NOT NULL,
  `zha_order_id` text NOT NULL,
  `zha_rating` int(1) NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_reply_comments`
--

CREATE TABLE `zha_reply_comments` (
  `zha_reply_comment_id` int(11) NOT NULL,
  `zha_user_id` int(11) NOT NULL,
  `zha_comment_id` int(11) NOT NULL,
  `zha_reply_comment` text NOT NULL,
  `zha_like` int(1) NOT NULL,
  `zha_dislike` int(1) NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_tags`
--

CREATE TABLE `zha_tags` (
  `zha_tag_id` int(11) NOT NULL,
  `zha_tag_name` text NOT NULL,
  `zha_admin_id` int(11) NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zha_users`
--

CREATE TABLE `zha_users` (
  `zha_user_id` int(11) NOT NULL,
  `zha_fullname` varchar(100) NOT NULL,
  `zha_email` varchar(200) NOT NULL,
  `zha_phone` varchar(45) NOT NULL,
  `zha_password` varchar(100) NOT NULL,
  `zha_terms` varchar(8) NOT NULL DEFAULT 'accepted',
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime DEFAULT NULL,
  `zha_verified_at` datetime DEFAULT NULL,
  `zha_last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `zha_user_addresses`
--

CREATE TABLE `zha_user_addresses` (
  `zha_address_id` int(11) NOT NULL,
  `zha_user_id` int(11) NOT NULL,
  `zha_address_types` text NOT NULL,
  `zha_user_address` text DEFAULT NULL,
  `zha_city` text NOT NULL,
  `zha_state` text NOT NULL,
  `zha_country` text NOT NULL,
  `zha_Postal_code` text NOT NULL,
  `zha_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `zha_update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Indexes for dumped tables
--

--
-- Indexes for table `zha_admins`
--
ALTER TABLE `zha_admins`
  ADD PRIMARY KEY (`zha_admin_id`);

--
-- Indexes for table `zha_auth_tokens`
--
ALTER TABLE `zha_auth_tokens`
  ADD PRIMARY KEY (`zha_id`);

--
-- Indexes for table `zha_category`
--
ALTER TABLE `zha_category`
  ADD PRIMARY KEY (`zha_id`);

--
-- Indexes for table `zha_comments`
--
ALTER TABLE `zha_comments`
  ADD PRIMARY KEY (`zha_comment_id`);

--
-- Indexes for table `zha_contacts`
--
ALTER TABLE `zha_contacts`
  ADD PRIMARY KEY (`zha_id`);

--
-- Indexes for table `zha_delivery`
--
ALTER TABLE `zha_delivery`
  ADD PRIMARY KEY (`zha_id`);

--
-- Indexes for table `zha_discounts`
--
ALTER TABLE `zha_discounts`
  ADD PRIMARY KEY (`zha_discount_id`);

--
-- Indexes for table `zha_orders`
--
ALTER TABLE `zha_orders`
  ADD PRIMARY KEY (`zha_id`);

--
-- Indexes for table `zha_payments`
--
ALTER TABLE `zha_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zha_products`
--
ALTER TABLE `zha_products`
  ADD PRIMARY KEY (`zha_product_id`);

--
-- Indexes for table `zha_products_image`
--
ALTER TABLE `zha_products_image`
  ADD PRIMARY KEY (`zha_id`);

--
-- Indexes for table `zha_products_sale`
--
ALTER TABLE `zha_products_sale`
  ADD PRIMARY KEY (`zha_id`);

--
-- Indexes for table `zha_products_tags`
--
ALTER TABLE `zha_products_tags`
  ADD PRIMARY KEY (`zha_id`);

--
-- Indexes for table `zha_ratings`
--
ALTER TABLE `zha_ratings`
  ADD PRIMARY KEY (`zha_rating _id`);

--
-- Indexes for table `zha_reply_comments`
--
ALTER TABLE `zha_reply_comments`
  ADD PRIMARY KEY (`zha_reply_comment_id`);

--
-- Indexes for table `zha_tags`
--
ALTER TABLE `zha_tags`
  ADD PRIMARY KEY (`zha_tag_id`);

--
-- Indexes for table `zha_users`
--
ALTER TABLE `zha_users`
  ADD PRIMARY KEY (`zha_user_id`);

--
-- Indexes for table `zha_user_addresses`
--
ALTER TABLE `zha_user_addresses`
  ADD PRIMARY KEY (`zha_address_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zha_auth_tokens`
--
ALTER TABLE `zha_auth_tokens`
  MODIFY `zha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_category`
--
ALTER TABLE `zha_category`
  MODIFY `zha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_comments`
--
ALTER TABLE `zha_comments`
  MODIFY `zha_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_contacts`
--
ALTER TABLE `zha_contacts`
  MODIFY `zha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_delivery`
--
ALTER TABLE `zha_delivery`
  MODIFY `zha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_orders`
--
ALTER TABLE `zha_orders`
  MODIFY `zha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_payments`
--
ALTER TABLE `zha_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_products`
--
ALTER TABLE `zha_products`
  MODIFY `zha_product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_products_image`
--
ALTER TABLE `zha_products_image`
  MODIFY `zha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_products_sale`
--
ALTER TABLE `zha_products_sale`
  MODIFY `zha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_products_tags`
--
ALTER TABLE `zha_products_tags`
  MODIFY `zha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_ratings`
--
ALTER TABLE `zha_ratings`
  MODIFY `zha_rating _id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_reply_comments`
--
ALTER TABLE `zha_reply_comments`
  MODIFY `zha_reply_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_tags`
--
ALTER TABLE `zha_tags`
  MODIFY `zha_tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_users`
--
ALTER TABLE `zha_users`
  MODIFY `zha_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zha_user_addresses`
--
ALTER TABLE `zha_user_addresses`
  MODIFY `zha_address_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;