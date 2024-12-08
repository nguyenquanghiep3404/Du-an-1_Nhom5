-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2024 at 06:38 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `variant_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `status`) VALUES
(5, 'Áo Len', 'Áo Len Nỉ', 1),
(6, 'Áo khoác nam ', 'Áo khoác nam ', 0),
(7, 'Áo polo nam', 'Áo polo nam', 1),
(8, 'Áo phao nam', 'Áo phao nam', 1),
(9, 'Áo sơ mi nam', 'Áo sơ mi nam', 1),
(10, 'Áo hoodie - Áo nỉ nam', 'Áo hoodie - Áo nỉ nam', 1),
(12, 'Áo thun nam', 'Áo thun nam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `create_at` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment`, `user_id`, `product_id`, `create_at`, `name`, `email`) VALUES
(1, 'huivbiubnb', 6, 18, '2024-12-07 07:08:58', 'admin', 'saohoa@gmail.com'),
(2, 'ihruinbtntr', 6, 29, '2024-12-08 23:43:41', 'admin', 'saohoa@gmail.com'),
(3, 'tyuhi.ol/;kjhjgmfns', 6, 33, '2024-12-09 00:59:47', 'admin', 'saohoa@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `coupon_type` int NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('hiden','unhiden') COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `variant_id` int DEFAULT NULL,
  `order_detail_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `variant_id`, `order_detail_id`, `quantity`, `price`, `created_at`, `updated_at`, `total`) VALUES
(154, 6, 31, NULL, 222, 5, '100000.00', NULL, NULL, '500000.00'),
(155, 6, 17, NULL, 223, 5, '99000.00', NULL, NULL, '495000.00'),
(156, 6, 31, NULL, 224, 6, '100000.00', NULL, NULL, '600000.00'),
(157, 6, 31, NULL, 225, 6, '100000.00', NULL, NULL, '600000.00'),
(158, 1, 31, NULL, 226, 5, '100000.00', NULL, NULL, '500000.00'),
(159, 1, 17, NULL, 226, 5, '99000.00', NULL, NULL, '495000.00'),
(160, 1, 31, NULL, 227, 6, '100000.00', NULL, NULL, '600000.00'),
(161, 6, 31, NULL, 228, 4, '100000.00', NULL, NULL, '400000.00'),
(162, 6, 30, NULL, 228, 4, '230000.00', NULL, NULL, '920000.00'),
(163, 6, 31, NULL, 229, 4, '100000.00', NULL, NULL, '400000.00'),
(164, 6, 30, NULL, 229, 4, '230000.00', NULL, NULL, '920000.00'),
(165, 6, 31, NULL, 230, 4, '100000.00', NULL, NULL, '800000.00'),
(166, 6, 30, NULL, 230, 4, '230000.00', NULL, NULL, '1840000.00'),
(167, 6, 31, NULL, 231, 4, '100000.00', NULL, NULL, '800000.00'),
(168, 6, 30, NULL, 231, 4, '230000.00', NULL, NULL, '1840000.00'),
(169, 6, 31, NULL, 232, 4, '100000.00', NULL, NULL, '400000.00'),
(170, 6, 30, NULL, 232, 4, '230000.00', NULL, NULL, '920000.00'),
(171, 6, 31, NULL, 233, 4, '100000.00', NULL, NULL, '400000.00'),
(172, 6, 30, NULL, 233, 4, '230000.00', NULL, NULL, '1320000.00'),
(173, 6, 31, NULL, 234, 4, '100000.00', NULL, NULL, '400000.00'),
(174, 6, 30, NULL, 234, 4, '230000.00', NULL, NULL, '920000.00'),
(175, 6, 17, NULL, 235, 4, '99000.00', NULL, NULL, '396000.00'),
(176, 6, 31, NULL, 235, 4, '100000.00', NULL, NULL, '400000.00'),
(177, 6, 17, NULL, 236, 5, '99000.00', NULL, NULL, '495000.00'),
(178, 6, 30, NULL, 236, 5, '230000.00', NULL, NULL, '1150000.00'),
(179, 6, 17, NULL, 237, 5, '99000.00', NULL, NULL, '495000.00'),
(180, 6, 31, NULL, 237, 3, '100000.00', NULL, NULL, '300000.00'),
(181, 6, 17, NULL, 238, 5, '99000.00', NULL, NULL, '495000.00'),
(182, 6, 31, NULL, 238, 5, '100000.00', NULL, NULL, '500000.00'),
(183, 6, 17, NULL, 239, 5, '99000.00', NULL, NULL, '495000.00'),
(184, 6, 19, NULL, 239, 3, '130000.00', NULL, NULL, '885000.00'),
(185, 6, 17, NULL, 240, 5, '99000.00', NULL, NULL, '495000.00'),
(186, 6, 31, NULL, 240, 4, '100000.00', NULL, NULL, '400000.00'),
(187, 6, 17, NULL, 241, 6, '99000.00', NULL, NULL, '594000.00'),
(188, 6, 31, NULL, 241, 4, '100000.00', NULL, NULL, '400000.00'),
(189, 6, 17, NULL, 242, 9, '99000.00', NULL, NULL, '891000.00'),
(190, 6, 31, NULL, 242, 3, '100000.00', NULL, NULL, '1191000.00'),
(191, 6, 31, NULL, 243, 6, '100000.00', NULL, NULL, '600000.00'),
(192, 6, 17, NULL, 243, 7, '99000.00', NULL, NULL, '1293000.00'),
(193, 6, 17, NULL, 244, 6, '99000.00', NULL, NULL, '594000.00'),
(194, 6, 31, NULL, 244, 7, '100000.00', NULL, NULL, '1294000.00'),
(195, 6, 31, NULL, 245, 3, '100000.00', NULL, NULL, '300000.00'),
(196, 6, 17, NULL, 245, 4, '99000.00', NULL, NULL, '396000.00'),
(197, 6, 31, NULL, 246, 4, '100000.00', NULL, NULL, '400000.00'),
(198, 6, 17, NULL, 246, 6, '99000.00', NULL, NULL, '594000.00'),
(199, 6, 17, NULL, 247, 3, '99000.00', NULL, NULL, '297000.00'),
(200, 6, 31, NULL, 247, 6, '100000.00', NULL, NULL, '600000.00'),
(201, 6, 31, NULL, 248, 11, '100000.00', NULL, NULL, '1100000.00'),
(202, 6, 31, NULL, 248, 10, '100000.00', NULL, NULL, '1000000.00'),
(203, 6, 17, NULL, 249, 7, '99000.00', NULL, NULL, '693000.00'),
(204, 6, 31, NULL, 249, 5, '100000.00', NULL, NULL, '500000.00'),
(205, 6, 18, NULL, 250, 6, '99000.00', NULL, NULL, '594000.00'),
(206, 6, 18, NULL, 250, 1, '99000.00', NULL, NULL, '99000.00'),
(207, 1, 33, NULL, 251, 4, '523100.00', NULL, NULL, '2092400.00'),
(208, 1, 32, NULL, 251, 6, '539100.00', NULL, NULL, '3234600.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_id` int NOT NULL,
  `coupon_id` int DEFAULT NULL,
  `shipping_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0. Chờ xác nhận 1. Đã xác nhận 2. Đang vận chuyển 3. Hoàn thành'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `name`, `email`, `phone`, `address`, `note`, `user_id`, `coupon_id`, `shipping_id`, `created_at`, `updated_at`, `status`) VALUES
(222, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-07 14:54:33', NULL, 0),
(223, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-07 14:55:51', NULL, 0),
(224, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-07 15:00:17', NULL, 0),
(225, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-07 15:02:07', NULL, 0),
(226, 'hiep', 'hza95332@nowni.com', '971647692', '', '', 1, NULL, NULL, '2024-12-08 03:30:57', NULL, 0),
(227, 'hiep', 'hza95332@nowni.com', '971647692', '', '', 1, NULL, NULL, '2024-12-08 03:35:23', NULL, 0),
(228, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', 'hhhhhhhh', 6, NULL, NULL, '2024-12-08 14:32:21', NULL, 0),
(229, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:33:27', NULL, 0),
(230, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:36:21', NULL, 0),
(231, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:36:52', NULL, 0),
(232, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:37:39', NULL, 0),
(233, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:39:39', NULL, 0),
(234, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:40:04', NULL, 0),
(235, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:41:11', NULL, 0),
(236, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:52:44', NULL, 0),
(237, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '795', 6, NULL, NULL, '2024-12-08 14:53:44', NULL, 0),
(238, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:55:17', NULL, 0),
(239, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 14:58:00', NULL, 0),
(240, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 15:00:24', NULL, 0),
(241, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 15:10:11', NULL, 0),
(242, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 15:22:51', NULL, 0),
(243, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 15:24:46', NULL, 0),
(244, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 15:28:46', NULL, 0),
(245, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 15:33:35', NULL, 0),
(246, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 15:35:48', NULL, 0),
(247, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 15:36:45', NULL, 0),
(248, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', 'thanh toán tiền mặt 2 triệu 100k', 6, NULL, NULL, '2024-12-08 15:47:22', NULL, 0),
(249, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', 'Thanh toán online qua vnpay 1.193.000đ', 6, NULL, NULL, '2024-12-08 15:48:25', NULL, 0),
(250, 'admin', 'saohoa@gmail.com', '0971647692', 'sao hoả', '', 6, NULL, NULL, '2024-12-08 15:51:26', '2024-12-08 16:31:24', 1),
(251, 'hiep', 'hza95332@nowni.com', '971647692', '', '', 1, NULL, NULL, '2024-12-08 18:34:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `price` float NOT NULL,
  `sale_price` float DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gallery` json DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `image`, `price`, `sale_price`, `description`, `category_id`, `created_at`, `updated_at`, `gallery`, `status`) VALUES
(17, 'Polo Nam Sorona Thêu Gấu Trúc', './uploads/product/ao-polo-nam-apm6225-xng-qam6049-den-2-yody.webp', 99000, 100000, 'Thoải mái, trẻ trung cùng áo polo nam dáng suông basic. Chất vải sorona mềm mại mang đến sự hài lòng cho rất nhiều khách hàng tại YODY. Thiết kế basic nhưng tạo điểm nhấn bằng hình thêu gấu trúc thú vị.', 7, '2024-12-02 01:01:02', '2024-12-02 01:01:02', '[\"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-3-yody.webp\", \"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-5-yody.webp\", \"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-6-yody.webp\", \"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-7-yody.webp\", \"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-10-yody.webp\"]', 1),
(18, 'Polo Nam Sorona Thêu Gấu Trúc', './uploads/product/ao-polo-nam-apm6225-xng-qam6049-den-6-yody.webp', 99000, 98000, 'aa', 7, '2024-12-02 01:03:18', '2024-12-02 01:03:18', '[\"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-3-yody.webp\", \"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-5-yody.webp\", \"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-6-yody.webp\", \"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-7-yody.webp\", \"./uploads/product_gallery/ao-polo-nam-apm6225-xng-qam6049-den-10-yody.webp\"]', 1),
(19, 'Áo khoác nam Kaki', './uploads/product/ao-khoac-nam-akm6017-nau-1.webp', 130000, 120000, 'Áo khoác nam Kaki chất lượng cao, xuất sứ 100%', 8, '2024-12-02 02:08:28', '2024-12-08 17:07:40', '[\"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-4.webp\", \"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-5.webp\", \"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-6.webp\"]', 1),
(25, 'Áo khoác nâu ', './uploads/product/ao-khoac-nam-akm6017-nau-1.webp', 100, 99, 'áo nam cao cấp', 6, '2024-12-08 16:41:34', '2024-12-08 16:42:05', '[\"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-1.webp\", \"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-2.webp\", \"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-3.webp\", \"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-4 (1).webp\"]', 1),
(29, 'Áo 12', './uploads/product/ao-polo-nam-apm6225-xng-qam6049-den-2-yody.webp', 12345, 12123, 'aaaa', 1, '2024-12-06 17:27:28', '2024-12-06 17:27:28', '[\"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-1.webp\", \"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-2.webp\", \"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-3.webp\", \"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-4 (1).webp\"]', 1),
(30, 'Áo Denim Nam Light Weight', './uploads/product/ao-khoac-jeans-nam-yody-AJM7002-XTU0152.webp', 230000, 199000, 'Sản phẩm áo denim nam với trọng lượng được cải tiến mang đến cho người mặc sự thoải mái, nhẹ nhàng mà không quá nặng nề. Áo có thiết kế cổ điển nhưng chất thông thoáng, độ bền cao cùng khả năng thấm hút tốt. Đây sẽ là item để các anh tự tin lên đồ thật khoẻ khoắn và nam tính.', 1, '2024-12-06 20:24:15', '2024-12-06 20:24:15', '[\"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU (3).webp\", \"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU (4).webp\", \"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU0148.webp\", \"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU0150.webp\"]', 1),
(31, 'Áo Thun Đông Nam Giữ Nhiệt Cổ Tròn', './uploads/product/ao-khoac-jeans-nam-yody-AJM7002-XTU0154.webp', 100000, 99000, 'Thoải mái, trẻ trung cùng áo polo nam dáng suông basic. Chất vải sorona mềm mại mang đến sự hài lòng cho rất nhiều khách hàng tại YODY. Thiết kế basic nhưng tạo điểm nhấn bằng hình thêu gấu trúc thú vị.', 1, '2024-12-06 20:23:42', '2024-12-06 20:23:42', '[\"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU (3).webp\", \"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU (4).webp\", \"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU0148.webp\", \"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU0150.webp\", \"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU0152.webp\", \"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU0153.webp\", \"./uploads/product_gallery/ao-khoac-jeans-nam-yody-AJM7002-XTU0154.webp\", \"./uploads/product_gallery/ao-khoac-nam-akm6017-nau-1.webp\"]', 1),
(32, 'Áo Phao Nam 3S Siêu Nhẹ Tay Raglan', './uploads/product/ao-phao-nam-3s-yody-phm6005-xtn-18.webp', 539100, 599000, 'Trải nghiệm sự thoải mái siêu nhẹ - ấm áp cùng áo phao nam 3S. Áo có trọng lượng nhẹ, mặc dễ chịu mà vẫn có khả năng giữ ấm tốt nhờ cấu trúc vải và bông kẹp ba lớp.', 8, '2024-12-08 17:00:01', NULL, '[\"./uploads/product_gallery/ao-phao-nam-3s-yody-phm6005-xtn-24.webp\", \"./uploads/product_gallery/ao-phao-nam-3s-yody-phm6005-xtn-22.webp\", \"./uploads/product_gallery/ao-phao-nam-3s-yody-phm6005-xtn-23.webp\"]', 1),
(33, 'Áo Khoác Phao Nam 3s Plus - Trượt Nước, Siêu Ấm', './uploads/product/phm5017-ghi-1.webp', 523100, 519000, 'Siêu nhẹ chỉ ~300g, dễ dàng gấp gọn mang theo mọi lúc mọi nơi. Giữ ấm tối ưu với lớp bông dày dặn, thiết kế ôm sát cơ thể. Phong cách khỏe khoắn phù hợp hoạt động ngoài trời, di chuyển. Mũ tháo rời, cổ tay & gấu chun, túi khóa kéo an toàn, tiện lợi.', 8, '2024-12-08 17:12:19', NULL, '[\"./uploads/product_gallery/phm5017-ghi-2.webp\", \"./uploads/product_gallery/phm5017-ghi-4.webp\", \"./uploads/product_gallery/phm5017-ghi-5.webp\", \"./uploads/product_gallery/phm5017-ghi-7.webp\"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `product_variant_id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`product_variant_id`, `product_id`, `size`, `color`, `quantity`) VALUES
(17, 17, '2XL', 'Xanh ngọc', 36),
(18, 18, 'M', 'Xanh rêu', 36),
(19, 19, 'S', 'Nâu', 98),
(20, 20, 'S', 'Đỏ', 0),
(21, 23, 'S', 'Đỏ', 2),
(22, 23, 'K', 'Tím', 4),
(23, 24, 'A', 'B', 5),
(24, 24, 'C', 'D', 6),
(25, 24, 'E', 'F', 7),
(26, 25, 'M', 'Cam', 2),
(27, 25, 'L', 'Đỏ', 11),
(28, 26, 'M', 'Xanh', 10),
(29, 26, 'L', 'Tím', 11),
(30, 26, 'XL', 'Mận Chín Rơi Khỏi Cây', 15),
(31, 28, 'AB', 'Cam', 2),
(32, 28, 'M', 'Xanh', 2),
(33, 29, 'M', 'Xanh', 2),
(34, 29, 'M', 'Mận Chín Rơi Khỏi Cây', 2),
(35, 30, 'M', 'xanh trung', 15),
(36, 30, 'L', 'xanh trung', 29),
(37, 30, 'XL', 'xanh trung', 17),
(38, 31, 'M', 'Đỏ', 30),
(39, 31, 'L', 'Cam', 15),
(40, 32, 'M', 'Xanh than nhạt', 20),
(41, 32, 'L', 'Xanh Biển', 23),
(42, 32, 'XL', 'Đỏ đô', 27),
(43, 33, 'M', 'Ghi', 45),
(44, 33, 'L', 'Xanh vỏ đỗ', 26);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `role_id` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `avatar`, `address`, `email`, `phone`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'hiep', NULL, 'Hà Nội', 'hza95332@nowni.com', '971647692', '12345', 1, NULL, NULL),
(2, 'huy', NULL, 'abc', 'abc@gmail.com', '98765432', '123456', NULL, NULL, NULL),
(3, 'hiephehe', NULL, 'ninh binh', 'nguyenquanghiep3404@gmail.com', '0971647692', '123456', NULL, NULL, NULL),
(4, 'hiepadmin', NULL, 'Hà Nội', 'hiep@gmail.com', '0971647692', '12345', NULL, NULL, NULL),
(5, 'hiepadmin', NULL, 'Hà Nội', 'nguyenvu@uf.edu.pl', '0978123455', '1234567', 0, NULL, NULL),
(6, 'admin', NULL, 'sao hoả', 'saohoa@gmail.com', '0971647692', '123456789', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `order_detail_id` (`order_detail_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`product_variant_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `product_variant_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `carts_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`product_variant_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`product_variant_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`order_detail_id`) REFERENCES `order_details` (`order_detail_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
