-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 11:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`) VALUES
(1, 'Phòng Ngủ', NULL, '2025-12-29 16:42:59'),
(2, 'Phòng Khách', NULL, '2025-12-29 16:42:59'),
(3, 'Phòng Ăn', NULL, '2025-12-29 16:42:59'),
(4, 'Phòng Làm Việc', NULL, '2025-12-29 16:42:59'),
(5, 'Nệm', NULL, '2025-12-29 16:42:59'),
(12, 'Giường ngủ', 1, '2025-12-29 16:43:13'),
(13, 'Tủ quần áo', 1, '2025-12-29 16:43:13'),
(14, 'Bàn trang điểm', 1, '2025-12-29 16:43:13'),
(15, 'Ghế Sofa', 2, '2025-12-29 16:43:13'),
(16, 'Bàn Sofa', 2, '2025-12-29 16:43:13'),
(17, 'Tủ kệ Tivi', 2, '2025-12-29 16:43:13'),
(18, 'Tủ giày - Tủ trang trí', 2, '2025-12-29 16:43:13'),
(19, 'Bàn ăn', 3, '2025-12-29 16:43:13'),
(20, 'Ghế ăn', 3, '2025-12-29 16:43:13'),
(21, 'Bàn làm việc', 4, '2025-12-29 16:43:13'),
(22, 'Ghế văn phòng', 4, '2025-12-29 16:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_05_101707_create_orders_table', 2),
(5, '2026_01_07_105508_add_role_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) NOT NULL,
  `payment_method` enum('bank','cod') NOT NULL,
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `payment_method`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(4, NULL, 'phuoc chau', '0968111512', 'phuoccua1512@gmail.com', '77 thiên long quốc', 'bank', 2800000.00, 'pending', '2026-01-05 04:10:59', '2026-01-05 04:10:59'),
(5, 1, 'phuoc chau', '0968111512', 'phuoccua1512@gmail.com', '77 thiên long quốc', 'bank', 12500000.00, 'cancelled', '2026-01-07 07:47:16', '2026-01-13 03:55:36'),
(6, 1, 'phuoc chau', '0968111512', 'phuoccua1512@gmail.com', '130 ngự bình, thành phố huế', 'bank', 12800000.00, 'completed', '2026-01-09 08:41:43', '2026-01-13 03:05:17'),
(7, 1, 'phuoc chau', '0968111512', 'phuoccua1512@gmail.com', '130 ngự bình, thành phố huế', 'bank', 3000000.00, 'completed', '2026-01-13 01:10:06', '2026-01-13 04:53:13'),
(8, 1, 'phuoc chau', '0968111512', 'phuoccua1512@gmail.com', '130 ngự bình, thành phố huế', 'cod', 16000000.00, 'cancelled', '2026-01-13 04:48:03', '2026-01-13 04:48:43'),
(9, 1, 'phuoc chau', '0968111512', 'phuoccua1512@gmail.com', '130 ngự bình, thành phố huế', 'bank', 35970000.00, 'cancelled', '2026-01-17 00:53:23', '2026-01-17 01:00:58'),
(10, 1, 'phuoc chau', '0968111512', 'phuoccua1512@gmail.com', '77 thiên long quốc, vạn ma đường, tp HỒ CHÍ MINH', 'bank', 2900000.00, 'completed', '2026-01-17 00:59:33', '2026-01-17 01:02:40'),
(11, 1, 'phuoc chau', '0968111512', 'phuoccua1512@gmail.com', '130 ngự bình, thành phố huế', 'bank', 10510000.00, 'cancelled', '2026-01-28 02:07:03', '2026-02-04 02:17:47'),
(12, 9, 'Chau thanh phuoc', '0968111512', 'phucnam1512@gmail.com', '128 nguyen khoa chiem, phuong thuan hoa, thành phố huế', 'cod', 5490000.00, 'pending', '2026-02-04 01:31:08', '2026-02-04 01:31:08'),
(13, 1, 'Chau thanh phuoc', '0968111512', 'phucnam1512@gmail.com', '128 nguyen khoa chiem, phuong thuan hoa, thành phố huế', 'bank', 11980000.00, 'shipping', '2026-02-04 02:17:31', '2026-02-04 02:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variant_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `variant_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant_id`, `product_name`, `variant_name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(4, 4, 4, 8, 'Combo Tủ Quần Áo VLINE V3', '2 cánh kệ góc', 1, 2800000.00, '2026-01-05 04:10:59', '2026-01-05 04:10:59'),
(5, 5, 11, 17, 'Tủ Quần Áo Gỗ MOHO DALUMD Ngăn Kệ', '1 hộc', 1, 4520000.00, '2026-01-07 07:47:16', '2026-01-07 07:47:16'),
(6, 5, 15, 24, 'Bàn Trang Điểm Gỗ Đa Năng MOHO VIENNA 202 Màu Tự Nhiên', '1 hộc', 2, 3990000.00, '2026-01-07 07:47:16', '2026-01-07 07:47:16'),
(7, 6, 7, 13, 'Set Tủ Quần Áo Gỗ MOHO VIENNA 201 3 Cánh Thanh Treo 4 Màu', '3 thanh treo', 2, 2500000.00, '2026-01-09 08:41:43', '2026-01-09 08:41:43'),
(8, 6, 1, 2, 'Tủ quần áo MDF cao cấp', '4 Cánh hộc kéo', 1, 7800000.00, '2026-01-09 08:41:43', '2026-01-09 08:41:43'),
(9, 7, 6, 11, 'Tủ Quần Áo Cửa Lùa VIENNA 1m2', '2 cánh thanh treo', 2, 1500000.00, '2026-01-13 01:10:06', '2026-01-13 01:10:06'),
(10, 8, 3, 5, 'Tủ Quần Áo Cánh Kính 60cm MOHO ASTRO - Nhiều mẫu tủ đơn', 'Ngăn kệ', 2, 3500000.00, '2026-01-13 04:48:03', '2026-01-13 04:48:03'),
(11, 8, 10, 16, 'Tủ Quần Áo Ubeda Ngăn Kệ 201 Có Gương', '2 cánh thanh treo', 2, 4500000.00, '2026-01-13 04:48:03', '2026-01-13 04:48:03'),
(12, 9, 18, 37, 'Ghế Sofa Góc Chữ L Gỗ Cao Su Tự Nhiên MOHO VLINE 601', 'Nâu', 3, 11990000.00, '2026-01-17 00:53:23', '2026-01-17 00:53:23'),
(13, 10, 24, 45, 'Tủ Giày - Tủ Trang Trí Gỗ MOHO VLINE 601', 'Nâu', 1, 2900000.00, '2026-01-17 00:59:33', '2026-01-17 00:59:33'),
(14, 11, 11, 17, 'Tủ Quần Áo Gỗ MOHO DALUMD Ngăn Kệ', '1 hộc', 1, 4520000.00, '2026-01-28 02:07:03', '2026-01-28 02:07:03'),
(15, 11, 19, 39, 'Ghế Sofa Băng 2m2 VERONA', 'Cam', 1, 5990000.00, '2026-01-28 02:07:03', '2026-01-28 02:07:03'),
(16, 12, 14, 23, 'Bàn Trang Điểm Gỗ Đa Năng MOHO VIENNA 202 Màu Nâu', '1 hộc', 1, 3990000.00, '2026-02-04 01:31:08', '2026-02-04 01:31:08'),
(17, 12, 6, 11, 'Tủ Quần Áo Cửa Lùa VIENNA 1m2', '2 cánh thanh treo', 1, 1500000.00, '2026-02-04 01:31:08', '2026-02-04 01:31:08'),
(18, 13, 19, 39, 'Ghế Sofa Băng 2m2 VERONA', 'Cam', 2, 5990000.00, '2026-02-04 02:17:31', '2026-02-04 02:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `material` varchar(100) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `origin` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `material`, `size`, `color`, `origin`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 13, 'Tủ quần áo MDF cao cấp', 'Gỗ MDF chống ẩm', '200x180x60 cm', 'Trắng - Vân gỗ', 'Việt Nam', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu1.png', '2025-12-30 08:27:01', NULL),
(2, 13, 'Tủ Quần Áo Cánh Kính Cao Cấp 1m2 MOHO ASTRO', '- Thân tủ: Gỗ MFC phủ Melamine chuẩn CARB-P2 (*)\r\n    - Lưng tủ: Gỗ MDF phủ Melamine chuẩn CARB-P2 (', 'Ngang 120cm x Sâu 60cm x Cao 2m', 'Trắng - Vân gỗ', 'Việt Nam', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu2.png', '2025-12-30 08:37:15', NULL),
(3, 13, 'Tủ Quần Áo Cánh Kính 60cm MOHO ASTRO - Nhiều mẫu tủ đơn', 'Thân tủ: Gỗ MFC phủ Melamine chuẩn CARB-P2 (*)\r\n    Lưng tủ: Gỗ MDF phủ Melamine chuẩn CARB-P2 (*)\r\n', 'Sâu 60cm x Rộng 60cm x Cao 200cm', 'Nâu - Vân gỗ', 'Hàn Quốc', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu3.png', '2025-12-30 08:48:03', NULL),
(4, 13, 'Combo Tủ Quần Áo VLINE V3', 'Gỗ tự nhiên sáng.', 'Tủ 2 cánh VLINE: Dài 120cm x Sâu 60cm x Cao 200cm\r\n     Tủ đơn VLINE:  Dài 60cm x Sâu 60cm x Cao 200', 'Nâu - Gỗ công nghiệp MFC/ MDF phủ melamine chuẩn C', 'Việt Nam', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu4.jpg', '2025-12-30 11:42:11', NULL),
(5, 13, 'Tủ Quần Áo Gỗ Tần Bì Châu Âu SCARLET - MOHO Signature', '- Gỗ Ash nhập khẩu Châu Âu\r\n     - MDF veneer Ash tiêu chuẩn CARB - P2', 'Dài 150 × Rộng 60 × Cao 200 (cm)', 'Nâu', 'Việt Nam', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu5.jpg', '2025-12-30 11:47:21', NULL),
(6, 13, 'Tủ Quần Áo Cửa Lùa VIENNA 1m2', 'Gỗ tự nhiên sáng.', 'Cánh tủ + Thân tủ: Gỗ công nghiệp MFC phủ Melamin chuẩn CARB-P2 (*)\r\n    Lưng tủ: Gỗ công nghiệp MDF', 'Nâu - Gỗ công nghiệp MFC/ MDF phủ melamine chuẩn C', 'Nhật Bản', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu6.jpg', '2025-12-30 11:53:40', NULL),
(7, 13, 'Set Tủ Quần Áo Gỗ MOHO VIENNA 201 3 Cánh Thanh Treo 4 Màu', '- Cánh tủ + Thân tủ: Gỗ MFC phủ Melamine chuẩn CARB-P2 (*)\r\n    - Lưng tủ: Gỗ MDF phủ Melamine chuẩn', 'Dài 150cm x Rộng 60cm x Cao 2m1', 'Trắng', 'Hàn Quốc', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu7.jpg', '2025-12-30 11:59:24', NULL),
(8, 13, 'Tủ Quần Áo Gỗ 1m6 MOHO MONZA 4 Cánh', 'Gỗ công nghiệp phủ Melamine CARB-P2 (*)', 'Dài 160 x Rộng 60 x Cao 200 cm', 'Trắng', 'Nhật Bản', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu8.jpg', '2025-12-30 12:04:48', NULL),
(9, 13, 'Set Tủ Quần Áo MOHO HOBRO 301 3 Cánh Ngăn Kệ', '- Thân tủ: Gỗ MFC/ MDF phủ Melamine chuẩn CARB-P2 (*)\r\n    - Cửa tủ: Gỗ MDF phủ Melamine chuẩn CARB-', 'Dài 150cm x Rộng 60cm x Cao 210cm', 'Trắng', 'Nhật Bản', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu9.jpg', '2025-12-30 12:08:05', NULL),
(10, 13, 'Tủ Quần Áo Ubeda Ngăn Kệ 201 Có Gương', 'Gỗ cao su và gỗ MFC chuẩn CARB P2 (*)', 'Tủ quần áo 2 cánh 1m2: Dài 120 X Rộng 60 X Cao 200 (cm)', 'Nâu', 'Việt Nam', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu10.jpg', '2025-12-30 12:10:41', NULL),
(11, 13, 'Tủ Quần Áo Gỗ MOHO DALUMD Ngăn Kệ', '- Gỗ công nghiệp phủ Melamine chuẩn CARB-P2 (*)', 'Dài 60 x Rộng 60 x Cao 200 cm', 'Nâu', 'Hàn Quốc', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu11.jpg', '2026-01-05 15:16:19', NULL),
(12, 13, 'Tủ Quần Áo Nóc MOHO VIENNA', 'Cánh tủ + Thân tủ: Gỗ công nghiệp MFC phủ Melamin chuẩn CARB-P2 (*)', 'Tủ đơn: D50 x R60 x C40 (cm)\r\n    Tủ 2 cánh: D100 x R60 x C40 (cm)\r\n    Tủ 3 cánh: D150 x R60 x C40 ', 'Tự nhiên', 'Việt Nam', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu12.jpg', '2026-01-05 15:22:28', NULL),
(13, 13, 'Tủ Quần Áo Gỗ HOBRO 301 Thanh Treo', '- Thân tủ: Gỗ MFC/ MDF phủ Melamine chuẩn CARB-P2 (*)\r\n    - Cửa tủ: Gỗ MDF phủ Melamine chuẩn CARB-', 'Dài 50cm x Rộng 60cm x Cao 210cm', 'Nâu', 'Nâu', 'Tủ quần áo thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/tu13.jpg', '2026-01-05 15:36:22', NULL),
(14, 14, 'Bàn Trang Điểm Gỗ Đa Năng MOHO VIENNA 202 Màu Nâu', 'Gỗ công nghiệp MFC chuẩn CARB-P2 (*), Sơn phủ UV', 'Bàn trang điểm: Dài 100cm x Rộng 40cm x Cao 75cm', 'Nâu', 'Việt Nam', 'Bàn trang điểm thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/btd1.jpg', '2026-01-05 15:43:07', NULL),
(15, 14, 'Bàn Trang Điểm Gỗ Đa Năng MOHO VIENNA 202 Màu Tự Nhiên', 'Gỗ công nghiệp MFC chuẩn CARB-P2 (*), Sơn phủ UV', 'Dài 100cm x Rộng 40cm x Cao 75cm', 'Tự nhiên', 'Việt Nam', 'Bàn trang điểm thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/btd2.jpg', '2026-01-05 15:45:58', NULL),
(16, 12, 'Giường Ngủ Bọc Vải Cao Cấp MOHO BOND', 'Vải: 100% polyester    Plywood chuẩn CARB-P2', 'W235 × D1950 × H115 cm    W195 × D1950 × H115 cm', 'Xám Nâu', 'Việt Nam', 'Giuong thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/giuong1.jpg', '2026-01-05 15:50:17', '2026-01-11 03:28:17'),
(17, 12, 'Giường Ngủ Bọc Vải 1m6 SCARLET - MOHO Signature', 'Vải: 100% polyester\r\n    Plywood chuẩn CARB-P2', 'W235 × D1950 × H115 cm', 'Xám', 'Việt Nam', 'Giuong thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/giuong2.jpg', '2026-01-17 07:08:26', NULL),
(18, 15, 'Ghế Sofa Góc Chữ L Gỗ Cao Su Tự Nhiên MOHO VLINE 601', 'Vải sợi tổng hợp có khả năng chống thấm nước và dầu\r\n    Gỗ cao su tự nhiên', '180cm x Rộng 85cm x Cao 69cm', 'Xám - Be', 'Nhật Bản', 'Giuong thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/sofa1.jpg', '2026-01-17 07:13:16', NULL),
(19, 15, 'Ghế Sofa Băng 2m2 VERONA', 'Vải sợi tổng hợp có khả năng chống thấm nước và dầu\r\n    Gỗ cao su tự nhiên', 'D220cm x S90cm x C70cm', 'Cam', 'Hàn Quốc', 'Giuong thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/sofa2.jpg', '2026-01-17 07:18:15', NULL),
(20, 15, 'Ghế Sofa Băng Gỗ Tự Nhiên MOHO VLINE 601', 'Vải sợi tổng hợp có khả năng chống thấm nước và dầu\r\n    Gỗ cao su tự nhiên', 'D220cm x S90cm x C70cm', 'Nâu', 'Hàn Quốc', 'Giuong thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/sofa3.jpg', '2026-01-17 07:20:31', NULL),
(21, 16, 'Set Bàn Sofa - Bàn Trà - Bàn Cafe Gỗ KLINE', 'Gỗ công nghiệp MFC chuẩn CARB-P2\r\n     Gỗ cao su tự nhiên', 'Dài 75cm x Rộng 40cm x Cao 38cm', 'Trắng', 'Hàn Quốc', 'Giuong thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/bsofa1.jpg', '2026-01-17 07:24:51', NULL),
(22, 16, 'Bàn Sofa HOBRO 301 (màu nâu 90)', 'Gỗ công nghiệp MFC chuẩn CARB-P2\r\n     Gỗ cao su tự nhiên', 'Dài 75cm x Rộng 40cm x Cao 38cm', 'Nâu', 'Hàn Quốc', 'Giuong thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/bsofa2.jpg', '2026-01-17 07:31:16', NULL),
(23, 17, 'Kệ TV MOHO HOBRO 301 (Màu Nâu 180)', 'Gỗ công nghiệp MFC chuẩn CARB-P2\r\n     Gỗ cao su tự nhiên', 'Dài 75cm x Rộng 40cm x Cao 38cm', 'Nâu', 'Hàn Quốc', 'Giuong thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/ketv1.jpg', '2026-01-17 07:35:32', NULL),
(24, 18, 'Tủ Giày - Tủ Trang Trí Gỗ MOHO VLINE 601', 'Gỗ công nghiệp MFC chuẩn CARB-P2\r\n     Gỗ cao su tự nhiên', 'Dài 80cm x Rộng 41cm x Cao 75cm', 'Nâu', 'Việt Nam', 'Giuong thiết kế hiện đại, nhiều ngăn tiện lợi', 'products/keg1.jpg', '2026-01-17 07:42:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `variant_name`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, '4 Cánh thanh treo', 7500000.00, 5, 'variants/tu1-2.png', '2025-12-30 08:30:20', NULL),
(2, 1, '4 Cánh hộc kéo', 7800000.00, 3, 'variants/tu1-3.png', '2025-12-30 08:30:20', '2026-01-09 08:41:43'),
(3, 1, '3 Cánh ngăn kệ', 6000000.00, 6, 'variants/tu1-1.png', '2025-12-30 08:30:20', NULL),
(4, 2, '2 Cánh thanh treo', 5500000.00, 5, 'variants/tu2-1.png', '2025-12-30 08:39:26', NULL),
(5, 3, 'Ngăn kệ', 3500000.00, 3, 'variants/tu3-1.png', '2025-12-30 08:53:11', '2026-01-13 04:48:03'),
(6, 3, 'hộc kéo', 4800000.00, 4, 'variants/tu3-2.png', '2025-12-30 08:53:11', NULL),
(7, 4, '3 cánh thanh treo', 2500000.00, 5, 'variants/tu4-1.jpg', '2025-12-30 11:43:49', NULL),
(8, 4, '2 cánh kệ góc', 2800000.00, 3, 'variants/tu4-2.jpg', '2025-12-30 11:43:49', '2026-01-05 04:10:59'),
(9, 4, '4 cánh', 5000000.00, 6, 'variants/tu4-3.jpg', '2025-12-30 11:43:49', NULL),
(10, 5, 'Contemporary Italian Style', 3500000.00, 5, 'variants/tu5-1.jpg', '2025-12-30 11:48:12', NULL),
(11, 6, '2 cánh thanh treo', 1500000.00, 2, 'variants/tu6-1.jpg', '2025-12-30 11:55:49', '2026-02-04 01:31:08'),
(13, 7, '3 thanh treo', 2500000.00, 3, 'variants/tu7-1.jpg', '2025-12-30 12:01:27', '2026-01-09 08:41:43'),
(14, 8, '4 cánh', 6500000.00, 5, 'variants/tu8-1.jpg', '2025-12-30 12:05:34', NULL),
(15, 9, '3 cánh thanh treo', 6500000.00, 5, 'variants/tu9-1.jpg', '2025-12-30 12:08:31', NULL),
(16, 10, '2 cánh thanh treo', 4500000.00, 3, 'variants/tu10-1.jpg', '2025-12-30 12:11:11', '2026-01-13 04:48:03'),
(17, 11, '1 hộc', 4520000.00, 9, 'variants/tu11-1.jpg', '2026-01-05 15:18:02', '2026-01-28 02:07:03'),
(18, 12, '1 hộc', 1520000.00, 12, 'variants/tu12-1.jpg', '2026-01-05 15:23:40', '2026-01-11 02:17:36'),
(19, 12, '2 hộc', 2520000.00, 11, 'variants/tu12-2.jpg', '2026-01-05 15:23:40', NULL),
(20, 12, '3 hộc', 3520000.00, 11, 'variants/tu12-3.jpg', '2026-01-05 15:23:40', NULL),
(21, 12, '4 hộc', 4520000.00, 11, 'variants/tu12-4.jpg', '2026-01-05 15:23:40', NULL),
(22, 13, '1 hộc', 4990000.00, 11, 'variants/tu13-1.jpg', '2026-01-05 15:36:47', NULL),
(23, 14, '1 hộc', 3990000.00, 10, 'variants/btd1-1.jpg', '2026-01-05 15:43:37', '2026-02-04 01:31:08'),
(24, 15, '1 hộc', 3990000.00, 9, 'variants/btd2-1.jpg', '2026-01-05 15:46:21', '2026-01-07 07:47:16'),
(25, 16, '1m6', 13990000.00, 14, 'variants/giuong1-1.jpg', '2026-01-05 15:51:19', '2026-01-11 01:27:43'),
(26, 16, '1m8', 14990000.00, 11, 'variants/giuong1-2.jpg', '2026-01-05 15:51:19', NULL),
(36, 17, '1m6', 16990000.00, 11, 'variants/giuong2-1.jpg', '2026-01-17 07:09:27', NULL),
(37, 18, 'Nâu', 11990000.00, 8, 'variants/sofa1-1.jpg', '2026-01-17 07:14:07', '2026-01-17 00:53:23'),
(38, 18, 'Be', 11990000.00, 11, 'variants/sofa1-2.jpg', '2026-01-17 07:14:07', NULL),
(39, 19, 'Cam', 5990000.00, 8, 'variants/sofa2-1.jpg', '2026-01-17 07:18:50', '2026-02-04 02:17:31'),
(40, 20, 'Nâu', 8990000.00, 11, 'variants/sofa3-1.jpg', '2026-01-17 07:21:06', NULL),
(42, 21, 'Trắng', 1900000.00, 11, 'variants/bsofa1-1.jpg', '2026-01-17 07:25:29', NULL),
(43, 22, 'Nâu', 1900000.00, 11, 'variants/bsofa2-1.jpg', '2026-01-17 07:31:40', NULL),
(44, 23, 'Nâu', 4900000.00, 11, 'variants/ketv1-1.jpg', '2026-01-17 07:36:06', NULL),
(45, 24, 'Nâu', 2900000.00, 10, 'variants/keg1-1.jpg', '2026-01-17 07:43:34', '2026-01-17 00:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 3, 'fdaf', '2026-01-02 01:34:49', '2026-01-02 01:34:49'),
(2, 1, 8, 4, 'xịn sò', '2026-01-02 08:16:53', '2026-01-02 08:16:53'),
(3, 1, 7, 5, 'đầu tư vào hdpe là ngon', '2026-01-13 01:07:23', '2026-01-13 01:07:23'),
(4, 1, 24, 2, 'tệ', '2026-01-17 00:53:48', '2026-01-17 00:53:48'),
(5, 1, 19, 4, 'san pham tot', '2026-02-04 02:17:08', '2026-02-04 02:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gepT2asegyPJvMPNclnYMGpXVmrdr810luQJZyxa', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjFvMk5WZWYzRUZ2R3VxYUV5OUZVeEFDR2lNZXN5ZHpnanpUdXg2MyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0IjtzOjU6InJvdXRlIjtzOjEwOiJjYXJ0LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1774628005),
('gOCfcCivfAYXjNaRXC4UX673imMVb2iUfNKwyT7z', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUXJJTUNLN3hnUmFVekRqWFhUb25RNjN2ZG1TWGhuMXl3T1U0SDR2bSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoyMjoiYWRtaW4uYWRwcm9kdWN0cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1769591656),
('wQJV9rmWsrkZzbQGNx7tjLFH6x0XvY9RHarZPWm6', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjMyRXBnMG51dzZmT3lqWjlPZXppekxRSE96SVlEb0lvcHdhd2ZaZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoyMjoiYWRtaW4uYWRwcm9kdWN0cy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1770196735);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'phuoc chau', 'phuoccua1512@gmail.com', 'user', NULL, '$2y$12$AbZzEJz0U.bmqID3PtiKSuiJlFelCOEkUItJaS5DcOvCvEgxhXwb2', NULL, '2025-12-23 09:13:14', '2025-12-23 09:13:14'),
(2, 'gfg', 'phuocgfi1512@gmail.com', 'user', NULL, '$2y$12$rQxhsLtVd9jeWZ43VAv1EexdIIwvW438zo.qmjVo6IehD.2sz/tg.', NULL, '2025-12-26 02:09:53', '2025-12-26 02:09:53'),
(3, 'admin1', 'admin@gmail.com', 'admin', NULL, '$2y$12$cyzJ4rZlfZxSxUeuviZem.yuAoNtVAYZQmTZ178b88tgkjEF7KU4u', NULL, '2026-01-07 07:48:05', '2026-01-07 07:48:05'),
(8, 'admin233', 'admin23@gmail.com', 'admin', NULL, '$2y$12$rmfJKipRO/qgxE2k6i3Rg.XrJcTX/gmjrJjUOshCFyf.vX20cB6ne', NULL, '2026-02-04 01:19:34', '2026-02-04 01:29:42'),
(9, 'thanh phuc', 'phuoc23@gmail.com', 'user', NULL, '$2y$12$o12kdizz4oMcvZHAk9FBP.yMFVh46.T6XUTGoyn.GtU9AeRYs1KBu', NULL, '2026-02-04 01:29:17', '2026-02-04 01:29:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
