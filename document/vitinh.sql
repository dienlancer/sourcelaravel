-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 02, 2017 lúc 08:22 PM
-- Phiên bản máy phục vụ: 10.1.22-MariaDB
-- Phiên bản PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vitinh`
--

DELIMITER $$
--
-- Thủ tục
--
DROP PROCEDURE IF EXISTS `pro_getArticle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getArticle` (IN `keyword` VARCHAR(255), IN `strCategoryArticleID` VARCHAR(255))  begin
SELECT
    0 AS is_checked
    ,n.id
    ,n.fullname
    ,n.title
    ,n.alias        
    ,n.image
    ,n.intro
    ,n.content
    ,n.description
    ,n.meta_keyword
    ,n.meta_description
    ,n.sort_order
    ,n.status
    ,n.created_at
    ,n.updated_at
	 FROM 
    `article` n
    LEFT JOIN `article_category` ac ON n.id = ac.article_id
    LEFT JOIN `category_article` cate ON ac.category_article_id = cate.id
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%',LOWER(keyword),'%'))
    AND (strCategoryArticleID = '#0#' OR INSTR(strCategoryArticleID,'#'+ac.category_article_id+'#') > 0)
     GROUP BY 
    n.id
    ,n.fullname
    ,n.title
    ,n.alias        
    ,n.image
    ,n.intro
    ,n.content
    ,n.description
    ,n.meta_keyword
    ,n.meta_description
    ,n.sort_order
    ,n.status
    ,n.created_at
    ,n.updated_at
    ORDER BY n.sort_order ASC;
end$$

DROP PROCEDURE IF EXISTS `pro_getCategoryArticle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getCategoryArticle` (IN `keyword` VARCHAR(255))  BEGIN
	SELECT
    0 AS is_checked,
	n.id,
	n.fullname,
	n.alias,
	n.parent_id,
	a.fullname AS parent_fullname,
	n.image,
	n.sort_order,
	n.status,
	n.created_at,
	n.updated_at
	FROM 
    `category_article` n
    LEFT JOIN `category_article` a ON n.parent_id = a.id
    WHERE
    ( (keyword='') or ( LOWER(n.fullname) LIKE CONCAT('%',keyword,'%')  ) )
    ORDER BY n.sort_order ASC       
    ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activations`
--

DROP TABLE IF EXISTS `activations`;
CREATE TABLE `activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `id` bigint(20) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `album`
--

INSERT INTO `album` (`id`, `fullname`, `alias`, `parent_id`, `image`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Du lịch Tà pao', 'du-lich-ta-pao', NULL, 'i4tveyphj1oxa63s.jpg', 1, 1, '2017-05-16 15:30:23', '2017-05-20 10:52:06'),
(2, 'Tắm biển', 'tam-bien', 1, 'yugh5bcj9qmftdns.jpg', 2, 1, '2017-05-16 15:37:40', '2017-05-20 10:52:06'),
(3, 'Mũi né', 'mui-ne', 1, 'iave2lz7q6gbr0jm.png', 1, 1, '2017-05-16 15:39:11', '2017-05-20 11:26:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` bigint(20) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` longtext COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8_unicode_ci,
  `meta_description` text COLLATE utf8_unicode_ci,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `article`
--

INSERT INTO `article` (`id`, `fullname`, `title`, `alias`, `image`, `intro`, `content`, `description`, `meta_keyword`, `meta_description`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(3, '1', '1', '1', '12965808_1.jpg', '1', '1', '1', '1', '1', 1, 1, '2017-10-02 16:12:20', '2017-10-02 17:34:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `article_category`
--

DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `id` bigint(20) NOT NULL,
  `article_id` int(11) NOT NULL,
  `category_article_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `category_article_id`, `created_at`, `updated_at`) VALUES
(12, 3, 55, '2017-10-02 16:12:20', '2017-10-02 16:12:20'),
(13, 3, 58, '2017-10-02 16:12:20', '2017-10-02 16:12:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_article`
--

DROP TABLE IF EXISTS `category_article`;
CREATE TABLE `category_article` (
  `id` bigint(20) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_article`
--

INSERT INTO `category_article` (`id`, `fullname`, `alias`, `parent_id`, `image`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(51, 'Nám tàn nhang', 'nam-tan-nhang', NULL, '12919228_1.jpg', 1, 1, '2017-10-02 12:52:39', '2017-10-02 17:34:53'),
(55, 'Công nghệ Hifu', 'cong-nghe-hifu', NULL, '12987989_1.jpg', 5, 1, '2017-10-02 12:54:01', '2017-10-02 17:35:19'),
(56, 'Trị mụn thâm da', 'tri-mun-tham-da', NULL, '12997238_1001.jpg', 6, 1, '2017-10-02 12:54:23', '2017-10-02 17:35:25'),
(57, 'Giảm cân', 'giam-can', NULL, '12997947_1.jpg', 7, 1, '2017-10-02 12:54:34', '2017-10-02 17:35:32'),
(58, 'Chăm sóc da mặt', 'cham-soc-da-mat', NULL, '13000660_1.jpg', 9, 1, '2017-10-02 12:54:56', '2017-10-02 17:35:48'),
(59, 'Triệt lông', 'triet-long', NULL, '12997953_1.jpg', 10, 1, '2017-10-02 12:55:12', '2017-10-02 17:35:39'),
(67, 'Phi kim siêu vi điểm', 'phi-kim-sieu-vi-diem', NULL, '12956480_19.jpg', 2, 1, '2017-10-02 17:22:48', '2017-10-02 17:35:00'),
(68, 'Phun thêu thẩm mỹ', 'phun-theu-tham-my', NULL, '12964555_1.jpg', 3, 1, '2017-10-02 17:23:07', '2017-10-02 17:35:05'),
(69, 'Tắm trắng', 'tam-trang', NULL, '12965808_1.jpg', 4, 1, '2017-10-02 17:23:18', '2017-10-02 17:35:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_product`
--

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE `category_product` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mobilephone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fax` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `email`, `fullname`, `address`, `phone`, `mobilephone`, `fax`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'dienit02', 'e10adc3949ba59abbe56e057f20f883e', 'dienit02@gmail.com', 'Nguyễn Kim Điền', '11 Tân Canh , P.1 , Q. Tân Phú , TP. Hồ Chí Minh', '0889715690', '0988162753', '1781378878', 1, 10, '2017-05-12 16:41:57', '2017-05-26 11:22:44'),
(2, 'sanghv', 'e10adc3949ba59abbe56e057f20f883e', 'sanghv@gmail.com', 'Huỳnh Văn Sang', '234 Gò Vấp', '0889715691', '0988162751', '9731738124', 1, 9, '2017-05-13 04:12:55', '2017-05-20 10:51:48'),
(3, 'cuongtt', 'e10adc3949ba59abbe56e057f20f883e', 'cuongtt@ttcgroup.vn', 'Trương Trí Cường', '24 Nguyễn Trọng Tuyển', '0889715692', '0988162752', '8727821812', 1, 8, '2017-05-13 04:17:02', '2017-05-20 10:51:48'),
(4, 'trietnk01', 'e10adc3949ba59abbe56e057f20f883e', 'trietnk01@gmail.com', 'Nguyễn Kim Triết', '538/27 Lý Thường Kiệt', '0889715693', '0988162756', '8728748188', 1, 7, '2017-05-13 04:25:11', '2017-05-20 10:51:48'),
(5, 'tailm', 'e10adc3949ba59abbe56e057f20f883e', 'tailm@gmail.com', 'Lê Minh Tài', '781 Hoàng Văn Thụ', '0889715612', '0988953215', '8238778843', 1, 6, '2017-05-13 04:29:15', '2017-05-20 10:51:48'),
(6, 'chauttn', 'e10adc3949ba59abbe56e057f20f883e', 'chautt@gmail.com', 'Từ Thị Ngọc Châu', '76 Lý Thái Tổ', '0812345678', '0988123456', '2222233333', 1, 5, '2017-05-13 04:33:51', '2017-05-20 10:51:48'),
(7, 'duyla', 'e10adc3949ba59abbe56e057f20f883e', 'duyla@ttcgroup.vn', 'Lý Anh Duy', '28 Trần Huy Liệu', '0872732772', '0988956123', '8787238728', 1, 4, '2017-05-13 09:22:00', '2017-05-20 10:51:48'),
(8, 'chauvn', 'e10adc3949ba59abbe56e057f20f883e', 'chauvn@ttcgroup.vn', 'Võ Ngọc Châu', '70 Trương Quốc Dung', '88113322', '0988111222', '99887711', 1, 3, '2017-05-13 09:28:01', '2017-05-20 10:51:48'),
(9, 'thangnc', 'e10adc3949ba59abbe56e057f20f883e', 'thangnc@ttcgroup.vn', 'Nguyễn Chí Thăng', '83 Nguyễn Trọng Tuyển', '3322116677', '0988666222', '4888221111', 1, 2, '2017-05-13 09:29:29', '2017-05-20 11:24:35'),
(10, 'thaihst', '', 'thaihst@ttcgroup.vn', 'Hồ Sỹ Thiên Thai', '16 Nguyễn Văn Trỗi', '0811111111', '0911111111', '1111111111', 1, 1, '2017-05-14 10:05:55', '2017-05-20 10:51:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_member`
--

DROP TABLE IF EXISTS `group_member`;
CREATE TABLE `group_member` (
  `id` bigint(20) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `group_member`
--

INSERT INTO `group_member` (`id`, `fullname`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, '2016-12-17 05:05:18', '2017-05-19 18:47:03'),
(2, 'Bài viết', 2, '2016-12-17 05:05:41', '2017-05-20 09:21:12'),
(4, 'Hệ thống', 3, '2016-12-17 05:26:59', '2017-05-20 09:21:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_privilege`
--

DROP TABLE IF EXISTS `group_privilege`;
CREATE TABLE `group_privilege` (
  `id` int(11) NOT NULL,
  `group_member_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `group_privilege`
--

INSERT INTO `group_privilege` (`id`, `group_member_id`, `privilege_id`, `created_at`, `updated_at`) VALUES
(509, 1, 1, '2017-05-19 18:25:43', '2017-05-19 18:25:43'),
(510, 1, 2, '2017-05-19 18:25:43', '2017-05-19 18:25:43'),
(511, 1, 3, '2017-05-19 18:25:43', '2017-05-19 18:25:43'),
(512, 1, 4, '2017-05-19 18:25:43', '2017-05-19 18:25:43'),
(513, 1, 5, '2017-05-19 18:25:43', '2017-05-19 18:25:43'),
(514, 1, 6, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(515, 1, 7, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(516, 1, 8, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(517, 1, 9, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(518, 1, 10, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(519, 1, 11, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(520, 1, 12, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(521, 1, 13, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(522, 1, 14, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(523, 1, 15, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(524, 1, 16, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(525, 1, 17, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(526, 1, 18, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(527, 1, 19, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(528, 1, 20, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(529, 1, 21, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(530, 1, 22, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(531, 1, 23, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(532, 1, 24, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(533, 1, 25, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(534, 1, 26, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(535, 1, 27, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(536, 1, 28, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(537, 1, 29, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(538, 1, 30, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(539, 1, 31, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(540, 1, 32, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(541, 1, 33, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(542, 1, 34, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(543, 1, 35, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(544, 1, 36, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(545, 1, 37, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(546, 1, 38, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(547, 1, 39, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(548, 1, 40, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(549, 1, 41, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(550, 1, 42, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(551, 1, 43, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(552, 1, 44, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(553, 1, 45, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(554, 1, 46, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(555, 1, 47, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(556, 1, 48, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(557, 1, 49, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(558, 1, 50, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(559, 1, 51, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(560, 1, 52, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(561, 1, 53, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(562, 1, 54, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(563, 1, 55, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(564, 1, 56, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(565, 1, 57, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(566, 1, 58, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(567, 1, 59, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(568, 1, 60, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(569, 1, 61, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(570, 1, 62, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(571, 1, 63, '2017-05-19 18:25:44', '2017-05-19 18:25:44'),
(572, 1, 64, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(573, 1, 65, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(574, 1, 66, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(575, 1, 67, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(576, 1, 68, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(577, 1, 69, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(578, 1, 70, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(579, 1, 71, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(580, 1, 72, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(581, 1, 73, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(582, 1, 74, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(583, 1, 75, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(584, 1, 76, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(585, 1, 77, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(586, 1, 78, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(587, 1, 79, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(588, 1, 80, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(589, 1, 81, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(590, 1, 82, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(591, 1, 83, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(592, 1, 84, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(593, 1, 85, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(594, 1, 86, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(595, 1, 87, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(596, 1, 88, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(597, 1, 89, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(598, 1, 90, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(599, 1, 91, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(600, 1, 92, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(601, 1, 93, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(602, 1, 94, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(603, 1, 95, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(604, 1, 96, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(605, 1, 97, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(606, 1, 98, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(607, 1, 99, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(608, 1, 100, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(609, 1, 101, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(610, 1, 102, '2017-05-19 18:25:45', '2017-05-19 18:25:45'),
(719, 2, 1, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(720, 2, 2, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(721, 2, 3, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(722, 2, 4, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(723, 2, 5, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(724, 2, 6, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(725, 2, 16, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(726, 2, 17, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(727, 2, 30, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(728, 2, 31, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(729, 2, 32, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(730, 2, 33, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(731, 2, 61, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(732, 2, 62, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(733, 2, 63, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(734, 2, 64, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(735, 2, 65, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(736, 2, 66, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(737, 2, 67, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(738, 2, 68, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(739, 2, 69, '2017-05-19 18:34:33', '2017-05-19 18:34:33'),
(740, 2, 70, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(741, 2, 71, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(742, 2, 72, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(743, 2, 73, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(744, 2, 74, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(745, 2, 75, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(746, 2, 76, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(747, 2, 77, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(748, 2, 78, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(749, 2, 79, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(750, 2, 80, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(751, 2, 81, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(752, 2, 82, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(753, 2, 83, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(754, 2, 84, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(755, 2, 85, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(756, 2, 86, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(757, 2, 87, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(758, 2, 88, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(759, 2, 89, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(760, 2, 90, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(761, 2, 91, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(762, 2, 92, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(763, 2, 93, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(764, 2, 94, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(765, 2, 95, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(766, 2, 96, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(767, 2, 97, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(768, 2, 98, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(769, 2, 99, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(770, 2, 100, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(771, 2, 101, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(772, 2, 102, '2017-05-19 18:34:34', '2017-05-19 18:34:34'),
(863, 4, 7, '2017-05-19 18:38:17', '2017-05-19 18:38:17'),
(864, 4, 8, '2017-05-19 18:38:17', '2017-05-19 18:38:17'),
(865, 4, 9, '2017-05-19 18:38:17', '2017-05-19 18:38:17'),
(866, 4, 10, '2017-05-19 18:38:17', '2017-05-19 18:38:17'),
(867, 4, 11, '2017-05-19 18:38:17', '2017-05-19 18:38:17'),
(868, 4, 12, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(869, 4, 13, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(870, 4, 14, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(871, 4, 15, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(872, 4, 34, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(873, 4, 35, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(874, 4, 36, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(875, 4, 37, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(876, 4, 38, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(877, 4, 39, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(878, 4, 40, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(879, 4, 41, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(880, 4, 42, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(881, 4, 49, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(882, 4, 50, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(883, 4, 51, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(884, 4, 52, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(885, 4, 53, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(886, 4, 54, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(887, 4, 55, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(888, 4, 56, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(889, 4, 57, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(890, 4, 58, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(891, 4, 59, '2017-05-19 18:38:18', '2017-05-19 18:38:18'),
(892, 4, 60, '2017-05-19 18:38:18', '2017-05-19 18:38:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mobilephone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fax` varchar(255) CHARACTER SET utf8 NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `invoice`
--

INSERT INTO `invoice` (`id`, `code`, `customer_id`, `username`, `email`, `fullname`, `address`, `phone`, `mobilephone`, `fax`, `quantity`, `total_price`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, '07e3pq9wx61mcbt2u8ny', 1, 'dienit02', 'dienit02@gmail.com', 'Nguyễn Kim Điền-8', '11 Tân Canh , P.1 , Q. Tân Bình , TP. Hồ Chí Minh-8', '0889715690-8', '0988162753-8', '1781378878-8', 3, '83498000.00', 1, 4, '2017-05-13 19:00:36', '2017-05-20 10:51:40'),
(3, 'h4wc2i6peqzoum3t05yg', 1, 'dienit02', 'dienit02@gmail.com', 'Nguyễn Kim Điền', '11 Tân Canh , P.1 , Q. Tân Bình , TP. Hồ Chí Minh', '0889715690', '0988162753', '1781378878', 5, '99997000.00', 1, 3, '2017-05-14 05:08:51', '2017-05-20 10:51:40'),
(4, 'la1o2mxy4kqbscphf5iz', 3, 'cuongtt', 'cuongtt@ttcgroup.vn', 'Trương Trí Cường', '24 Nguyễn Trọng Tuyển', '0889715692', '0988162752', '8727821812', 1, '33500000.00', 1, 2, '2017-05-14 15:46:14', '2017-05-20 10:51:40'),
(5, 'qsho3iey9zkupv2a5r4f', 1, 'dienit02', 'dienit02@gmail.com', 'Nguyễn Kim Điền', '11 Tân Canh , P.1 , Q. Tân Phú , TP. Hồ Chí Minh', '0889715690', '0988162753', '1781378878', 3, '88500000.00', 1, 1, '2017-05-16 07:29:26', '2017-05-20 10:51:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice_detail`
--

DROP TABLE IF EXISTS `invoice_detail`;
CREATE TABLE `invoice_detail` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `product_fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_total_price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `invoice_detail`
--

INSERT INTO `invoice_detail` (`id`, `invoice_id`, `product_id`, `product_code`, `product_fullname`, `product_image`, `product_price`, `product_quantity`, `product_total_price`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '123456789', 'Dell XPS13_9360, Core i7 7500U, SSD 256GB, Ram 8GB, 13.3in QHD+ Touch, Win 10', '5920ilx1cqnj7hbv.png', '33500000.00', 1, '33500000.00', '2017-05-13 19:00:36', '2017-05-13 19:00:36'),
(2, 2, 3, '987654321', 'Dell XPS13_9360, Core i5 7200U, SSD 256GB, Ram 8GB, 13.3inch FHD, Win 10', 'vi15of8jarwuldcp.png', '27499000.00', 1, '27499000.00', '2017-05-13 19:00:36', '2017-05-13 19:00:36'),
(3, 2, 4, '321456789', 'Dell Inspiron 15-7559, Core i7-6700HQ, 1TB, 8GB, 4GB GTX 960M, 15.6 inch 4K Touch, Win 10', 'nz26gicpxwys4eol.png', '22499000.00', 1, '22499000.00', '2017-05-13 19:00:36', '2017-05-13 19:00:36'),
(4, 3, 6, '512311891', 'Dell Inspiron 5378, Core i7-7500U, 256GB SSD, 8GB, Intel, 13.3in FHD Touch, Window 10', 'ke68yibf23rpuwda.png', '21500000.00', 2, '43000000.00', '2017-05-14 05:08:51', '2017-05-14 05:08:51'),
(5, 3, 10, '213789123', 'Dell Inspiron 5378, Core i7-7500U, 1TB, 8GB, Intel, 13.3in FHD Touch, Window 10', 'hse69cxt170vnior.png', '18999000.00', 3, '56997000.00', '2017-05-14 05:08:51', '2017-05-14 05:08:51'),
(6, 4, 2, '123456789', 'Dell XPS13_9360, Core i7 7500U, SSD 256GB, Ram 8GB, 13.3in QHD+ Touch, Win 10', '5920ilx1cqnj7hbv.png', '33500000.00', 1, '33500000.00', '2017-05-14 15:46:14', '2017-05-14 15:46:14'),
(7, 5, 2, '123456789', 'Dell XPS13_9360, Core i7 7500U, SSD 256GB, Ram 8GB, 13.3in QHD+ Touch, Win 10', '5920ilx1cqnj7hbv.png', '33500000.00', 2, '67000000.00', '2017-05-16 07:29:26', '2017-05-16 07:29:26'),
(8, 5, 6, '512311891', 'Dell Inspiron 5378, Core i7-7500U, 256GB SSD, 8GB, Intel, 13.3in FHD Touch, Window 10', 'ke68yibf23rpuwda.png', '21500000.00', 1, '21500000.00', '2017-05-16 07:29:26', '2017-05-16 07:29:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` bigint(20) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `menu_type_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `fullname`, `alias`, `site_link`, `parent_id`, `menu_type_id`, `level`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Trang chủ', 'trang-chu', '', 0, 1, 0, 1, 1, '2016-12-23 01:08:53', '2017-01-18 03:12:52'),
(2, 'Tin nội bộ', 'tin-noi-bo', '/chu-de/tin-noi-bo', 0, 1, 0, 4, 1, '2016-12-23 01:11:57', '2017-05-10 10:56:18'),
(3, 'Tin khuyến mãi', 'tin-khuyen-mai', '/chu-de/tin-khuyen-mai', 0, 1, 0, 5, 1, '2016-12-23 01:12:40', '2017-05-10 10:56:18'),
(52, 'Thủ thuật công nghệ', 'thu-thuat-cong-nghe', '/chu-de/thu-thuat-cong-nghe', 0, 1, 0, 7, 1, '2016-12-28 19:06:01', '2017-05-10 10:56:18'),
(53, 'Tin công nghệ', 'tin-cong-nghe', '/chu-de/tin-cong-nghe', 0, 1, 0, 6, 1, '2016-12-30 17:23:17', '2017-05-10 10:56:18'),
(63, 'Dịch vụ kỹ thuật', 'dich-vu-ky-thuat', '/chu-de/dich-vu-ky-thuat', 0, 1, 0, 8, 1, '2017-02-11 09:05:57', '2017-05-10 10:56:18'),
(64, 'Liên hệ', 'lien-he', '/bai-viet/lien-he', 0, 1, 0, 9, 1, '2017-05-09 03:55:16', '2017-05-10 10:56:18'),
(65, 'Laptop', 'laptop', '/nhom-san-pham/laptop', 0, 3, 0, 1, 1, '2017-05-09 04:11:04', '2017-05-09 04:20:12'),
(66, 'PC - All in one', 'pc-all-in-one', '/nhom-san-pham/pc-all-in-one', 0, 3, 0, 2, 1, '2017-05-09 04:11:31', '2017-05-09 04:20:43'),
(67, 'Workstation', 'workstation', '/nhom-san-pham/workstation', 0, 3, 0, 3, 1, '2017-05-09 04:11:49', '2017-05-09 04:21:05'),
(68, 'Server', 'server', '/nhom-san-pham/server', 0, 3, 0, 4, 1, '2017-05-09 04:12:10', '2017-05-09 04:21:19'),
(69, 'LCD', 'lcd', '/nhom-san-pham/lcd', 0, 3, 0, 5, 1, '2017-05-09 04:12:26', '2017-05-09 04:21:32'),
(70, 'Máy in đơn năng', 'may-in-don-nang', '/nhom-san-pham/may-in-don-nang', 0, 3, 0, 6, 1, '2017-05-09 04:12:58', '2017-05-09 04:21:50'),
(71, 'Máy in đa năng', 'may-in-da-nang', '/nhom-san-pham/may-in-da-nang', 0, 3, 0, 7, 1, '2017-05-09 04:13:20', '2017-05-09 04:22:09'),
(72, 'Máy in kim', 'may-in-kim', '/nhom-san-pham/may-in-kim', 0, 3, 0, 8, 1, '2017-05-09 04:13:59', '2017-05-09 04:22:26'),
(73, 'Scan-fax', 'scan-fax', '/nhom-san-pham/scan-fax', 0, 3, 0, 9, 1, '2017-05-09 04:14:22', '2017-05-09 04:22:37'),
(74, 'Mực in', 'muc-in', '/nhom-san-pham/muc-in', 0, 3, 0, 10, 1, '2017-05-09 04:14:47', '2017-05-09 04:22:48'),
(75, 'Linh kiện', 'linh-kien', '/nhom-san-pham/linh-kien', 0, 3, 0, 11, 1, '2017-05-09 04:15:06', '2017-05-09 04:23:00'),
(76, 'Phụ kiện', 'phu-kien', '/nhom-san-pham/phu-kien', 0, 3, 0, 12, 1, '2017-05-09 04:15:25', '2017-05-09 04:23:11'),
(77, 'Thiết bị mạng', 'thiet-bi-mang', '/nhom-san-pham/thiet-bi-mang', 0, 3, 0, 13, 1, '2017-05-09 04:15:41', '2017-05-09 04:23:36'),
(78, 'Thiết bị kết nối aten', 'thiet-bi-ket-noi-aten', '/nhom-san-pham/thiet-bi-ket-noi-aten', 0, 3, 0, 14, 1, '2017-05-09 04:16:02', '2017-05-09 04:23:53'),
(79, 'Thiết bị văn phòng camera', 'thiet-bi-van-phong-camera', '/nhom-san-pham/thiet-bi-van-phong-camera', 0, 3, 0, 15, 1, '2017-05-09 04:16:26', '2017-05-09 04:24:08'),
(80, 'Sản phẩm', 'san-pham', '/san-pham', 0, 1, 0, 3, 1, '2017-05-10 10:55:37', '2017-05-10 10:56:18'),
(81, 'Giới thiệu', 'trung-tam-tin-hoc-hoan-long', '/bai-viet/trung-tam-tin-hoc-hoan-long', 0, 1, 0, 2, 1, '2017-05-10 10:56:05', '2017-05-30 03:41:37'),
(82, 'Laptop', 'laptop', '/danh-muc/laptop', 80, 1, 1, 1, 1, '2017-05-10 12:56:18', '2017-05-14 02:16:10'),
(83, 'PC - All in one', 'pc-all-in-one', '/danh-muc/pc-all-in-one', 80, 1, 1, 2, 1, '2017-05-10 12:59:23', '2017-05-20 09:41:49'),
(84, 'Workstation', 'workstation', '/danh-muc/workstation', 80, 1, 1, 3, 1, '2017-05-10 12:59:56', '2017-05-14 02:16:32'),
(85, 'Server', 'server', '/danh-muc/server', 80, 1, 1, 4, 1, '2017-05-10 13:00:18', '2017-05-14 02:17:03'),
(86, 'LCD', 'lcd', '/danh-muc/lcd', 80, 1, 1, 5, 1, '2017-05-10 13:00:47', '2017-05-14 02:17:34'),
(87, 'Máy in đơn năng', 'may-in-don-nang', '/danh-muc/may-in-don-nang', 80, 1, 1, 6, 1, '2017-05-10 13:01:22', '2017-05-14 02:17:48'),
(88, 'Máy in đa năng', 'may-in-da-nang', '/danh-muc/may-in-da-nang', 80, 1, 1, 7, 1, '2017-05-10 13:01:54', '2017-05-14 02:17:57'),
(89, 'Máy in kim', 'may-in-kim', '/danh-muc/may-in-kim', 80, 1, 1, 8, 1, '2017-05-10 13:02:20', '2017-05-14 02:18:05'),
(90, 'Scan-fax', 'scan-fax', '/danh-muc/scan-fax', 80, 1, 1, 9, 1, '2017-05-10 13:02:52', '2017-05-14 02:18:13'),
(91, 'Mực in', 'muc-in', '/danh-muc/muc-in', 80, 1, 1, 10, 1, '2017-05-10 13:03:16', '2017-05-14 02:18:22'),
(92, 'Linh kiện', 'linh-kien', '/danh-muc/linh-kien', 80, 1, 1, 11, 1, '2017-05-10 13:03:42', '2017-05-14 02:18:28'),
(93, 'Phụ kiện', 'phu-kien', '/danh-muc/phu-kien', 80, 1, 1, 12, 1, '2017-05-10 13:04:11', '2017-05-14 02:18:35'),
(94, 'Thiết bị mạng', 'thiet-bi-mang', '/danh-muc/thiet-bi-mang', 80, 1, 1, 13, 1, '2017-05-10 13:04:37', '2017-05-14 02:18:42'),
(95, 'Thiết bị kết nối aten', 'thiet-bi-ket-noi-aten', '/danh-muc/thiet-bi-ket-noi-aten', 80, 1, 1, 14, 1, '2017-05-10 13:05:04', '2017-05-14 02:18:49'),
(96, 'Thiết bị văn phòng camera', 'thiet-bi-van-phong-camera', '/danh-muc/thiet-bi-van-phong-camera', 80, 1, 1, 15, 1, '2017-05-10 13:05:25', '2017-05-14 02:18:56'),
(97, 'Đăng nhập', 'dang-nhap', '/dang-nhap', 0, 1, 0, 9, 1, '2017-05-13 09:33:18', '2017-05-13 09:33:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_type`
--

DROP TABLE IF EXISTS `menu_type`;
CREATE TABLE `menu_type` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu_type`
--

INSERT INTO `menu_type` (`id`, `fullname`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'MainMenu', 1, '2016-12-22 01:09:17', '2017-05-20 09:23:15'),
(2, 'FooterMenu', 2, '2016-12-22 03:25:32', '2017-05-20 08:57:26'),
(3, 'ProductMenu', 3, '2017-05-09 04:09:20', '2017-05-20 09:23:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_12_08_040743_create_cates_table', 1),
('2016_12_08_041407_create_products_table', 2),
('2016_12_08_042123_create_product_images_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `module_article`
--

DROP TABLE IF EXISTS `module_article`;
CREATE TABLE `module_article` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `article_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `module_custom`
--

DROP TABLE IF EXISTS `module_custom`;
CREATE TABLE `module_custom` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `standard_text` text COLLATE utf8_unicode_ci,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `module_menu`
--

DROP TABLE IF EXISTS `module_menu`;
CREATE TABLE `module_menu` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_type_id` int(11) DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `module_menu`
--

INSERT INTO `module_menu` (`id`, `fullname`, `menu_type_id`, `position`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'MainMenu', 1, 'main-menu', 1, 1, '2017-05-29 18:57:17', '2017-05-31 06:52:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mod_menu_type`
--

DROP TABLE IF EXISTS `mod_menu_type`;
CREATE TABLE `mod_menu_type` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `module_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mod_menu_type`
--

INSERT INTO `mod_menu_type` (`id`, `menu_id`, `module_id`, `module_type`, `created_at`, `updated_at`) VALUES
(524, 1, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(525, 2, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(526, 3, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(527, 52, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(528, 53, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(529, 63, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(530, 64, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(531, 65, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(532, 66, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(533, 67, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(534, 80, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(535, 81, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(536, 82, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(537, 83, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(538, 84, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(539, 85, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(540, 86, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(541, 87, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(542, 88, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(543, 89, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(544, 90, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(545, 91, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(546, 92, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(547, 93, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(548, 94, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(549, 95, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(550, 96, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32'),
(551, 97, 2, 'module-menu', '2017-05-31 06:37:32', '2017-05-31 06:37:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `persistences`
--

DROP TABLE IF EXISTS `persistences`;
CREATE TABLE `persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `album_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `photo`
--

INSERT INTO `photo` (`id`, `fullname`, `alias`, `album_id`, `image`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'photo 1', 'photo-1', 2, 'w734cxfqmi502yt1.jpg', 1, 3, '2017-05-16 16:16:18', '2017-05-20 10:51:59'),
(2, 'photo 2', 'photo-2', 3, '9ximzjobdl0g762c.jpg', 1, 4, '2017-05-16 16:17:33', '2017-05-20 10:51:59'),
(3, 'photo 4', 'photo-4', 2, 'fpexy647nzagu13l.jpg', 1, 1, '2017-05-16 16:19:30', '2017-05-20 10:51:59'),
(4, 'photo 3', 'photo-3', 2, '963r7kl0hidmfx2b.png', 1, 2, '2017-05-16 17:17:24', '2017-05-20 11:26:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `privilege`
--

INSERT INTO `privilege` (`id`, `fullname`, `controller`, `action`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'category-article-list', 'category-article', 'list', 1, '2017-05-18 06:49:30', '2017-05-19 17:26:33'),
(2, 'category-article-form', 'category-article', 'form', 1, '2017-05-18 06:50:32', '2017-05-19 17:26:44'),
(3, 'category-article-trash', 'category-article', 'trash', 1, '2017-05-18 06:51:27', '2017-05-19 17:26:54'),
(4, 'article-list', 'article', 'list', 1, '2017-05-18 08:34:41', '2017-05-19 18:11:35'),
(5, 'article-form', 'article', 'form', 2, '2017-05-18 08:35:17', '2017-05-19 17:24:54'),
(6, 'article-trash', 'article', 'trash', 3, '2017-05-18 08:35:54', '2017-05-19 18:11:35'),
(7, 'module-menu-list', 'module-menu', 'list', 3, '2017-05-19 03:42:58', '2017-05-19 17:38:02'),
(8, 'module-menu-form', 'module-menu', 'form', 3, '2017-05-19 03:44:16', '2017-05-19 17:38:14'),
(9, 'module-menu-trash', 'module-menu', 'trash', 3, '2017-05-19 03:44:35', '2017-05-19 17:38:25'),
(10, 'module-custom-list', 'module-custom', 'list', 4, '2017-05-19 03:45:27', '2017-05-19 17:34:38'),
(11, 'module-custom-form', 'module-custom', 'form', 4, '2017-05-19 03:46:10', '2017-05-19 17:34:53'),
(12, 'module-custom-trash', 'module-custom', 'trash', 4, '2017-05-19 03:46:31', '2017-05-19 17:35:04'),
(13, 'module-article-list', 'module-article', 'list', 5, '2017-05-19 03:47:14', '2017-05-19 17:31:22'),
(14, 'module-article-form', 'module-article', 'form', 5, '2017-05-19 03:50:20', '2017-05-19 17:31:43'),
(15, 'module-article-trash', 'module-article', 'trash', 5, '2017-05-19 03:51:00', '2017-05-19 17:31:57'),
(16, 'category-article-status', 'category-article', 'status', 1, '2017-05-19 08:23:46', '2017-05-19 17:27:04'),
(17, 'category-article-delete', 'category-article', 'delete', 1, '2017-05-19 08:25:14', '2017-05-19 17:27:16'),
(18, 'privilege-list', 'privilege', 'list', 6, NULL, '2017-05-19 17:38:47'),
(19, 'privilege-form', 'privilege', 'form', 6, NULL, '2017-05-19 17:38:55'),
(20, 'privilege-trash', 'privilege', 'trash', 6, '2017-05-19 11:57:04', '2017-05-19 17:39:02'),
(21, 'privilege-status', 'privilege', 'status', 6, '2017-05-19 11:57:33', '2017-05-19 17:39:14'),
(22, 'privilege-delete', 'privilege', 'delete', 6, '2017-05-19 11:57:49', '2017-05-19 17:39:25'),
(23, 'privilege-ordering', 'privilege', 'ordering', 6, '2017-05-19 11:58:10', '2017-05-19 17:39:33'),
(24, 'group-member-list', 'group-member', 'list', 7, '2017-05-19 11:59:40', '2017-05-19 17:27:44'),
(25, 'group-member-form', 'group-member', 'form', 7, '2017-05-19 12:00:09', '2017-05-19 17:27:55'),
(26, 'group-member-trash', 'group-member', 'trash', 7, '2017-05-19 12:00:56', '2017-05-19 17:28:06'),
(27, 'group-member-ordering', 'group-member', 'ordering', 7, '2017-05-19 12:01:20', '2017-05-19 17:28:17'),
(28, 'group-member-delete', 'group-member', 'delete', 7, '2017-05-19 12:01:48', '2017-05-19 17:28:28'),
(29, 'group-member-status', 'group-member', 'status', 7, '2017-05-19 12:02:27', '2017-05-19 17:28:39'),
(30, 'article-delete', 'article', 'delete', 4, '2017-05-19 17:22:05', '2017-05-19 18:11:35'),
(31, 'article-ordering', 'article', 'ordering', 6, '2017-05-19 17:22:53', '2017-05-19 18:11:35'),
(32, 'article-status', 'article', 'status', 5, '2017-05-19 17:23:34', '2017-05-19 18:11:35'),
(33, 'category-article-ordering', 'category-article', 'ordering', 1, '2017-05-19 17:29:14', '2017-05-19 17:29:14'),
(34, 'module-article-delete', 'module-article', 'delete', 5, '2017-05-19 17:33:19', '2017-05-19 17:33:19'),
(35, 'module-article-status', 'module-article', 'status', 5, '2017-05-19 17:33:42', '2017-05-19 17:33:42'),
(36, 'module-article-ordering', 'module-article', 'ordering', 5, '2017-05-19 17:33:59', '2017-05-19 17:33:59'),
(37, 'module-custom-delete', 'module-custom', 'delete', 4, '2017-05-19 17:36:07', '2017-05-19 17:36:23'),
(38, 'module-custom-status', 'module-custom', 'status', 4, '2017-05-19 17:36:49', '2017-05-19 17:36:55'),
(39, 'module-custom-ordering', 'module-custom', 'ordering', 4, '2017-05-19 17:37:27', '2017-05-19 17:37:27'),
(40, 'module-menu-delete', 'module-menu', 'delete', 3, '2017-05-19 17:40:29', '2017-05-19 17:40:36'),
(41, 'module-menu-status', 'module-menu', 'status', 3, '2017-05-19 17:40:55', '2017-05-19 17:40:55'),
(42, 'module-menu-ordering', 'module-menu', 'ordering', 3, '2017-05-19 17:41:14', '2017-05-19 17:41:14'),
(43, 'user-list', 'user', 'list', 8, '2017-05-19 17:45:27', '2017-05-19 17:45:27'),
(44, 'user-form', 'user', 'form', 8, '2017-05-19 17:45:57', '2017-05-19 17:45:57'),
(45, 'user-trash', 'user', 'trash', 8, '2017-05-19 17:46:22', '2017-05-19 17:46:22'),
(46, 'user-status', 'user', 'status', 8, '2017-05-19 17:46:51', '2017-05-19 17:46:51'),
(47, 'user-delete', 'user', 'delete', 8, '2017-05-19 17:47:13', '2017-05-19 17:47:13'),
(48, 'user-ordering', 'user', 'ordering', 8, '2017-05-19 17:47:32', '2017-05-19 17:47:32'),
(49, 'menu-type-list', 'menu-type', 'list', 9, '2017-05-19 17:49:35', '2017-05-19 17:49:35'),
(50, 'menu-type-form', 'menu-type', 'form', 9, '2017-05-19 17:49:53', '2017-05-19 17:49:53'),
(51, 'menu-type-trash', 'menu-type', 'trash', 9, '2017-05-19 17:50:07', '2017-05-19 17:50:07'),
(52, 'menu-type-delete', 'menu-type', 'delete', 9, '2017-05-19 17:50:29', '2017-05-19 17:50:29'),
(53, 'menu-type-status', 'menu-type', 'status', 9, '2017-05-19 17:50:43', '2017-05-19 17:50:43'),
(54, 'menu-type-ordering', 'menu-type', 'ordering', 9, '2017-05-19 17:50:55', '2017-05-19 17:50:55'),
(55, 'menu-list', 'menu', 'list', 10, '2017-05-19 18:01:20', '2017-05-19 18:01:20'),
(56, 'menu-form', 'menu', 'form', 10, '2017-05-19 18:01:38', '2017-05-19 18:01:38'),
(57, 'menu-trash', 'menu', 'trash', 10, '2017-05-19 18:01:52', '2017-05-19 18:01:52'),
(58, 'menu-delete', 'menu', 'delete', 10, '2017-05-19 18:02:17', '2017-05-19 18:02:17'),
(59, 'menu-status', 'menu', 'status', 10, '2017-05-19 18:02:31', '2017-05-19 18:02:31'),
(60, 'menu-ordering', 'menu', 'ordering', 10, '2017-05-19 18:02:50', '2017-05-19 18:02:50'),
(61, 'media-list', 'media', 'list', 11, '2017-05-19 18:05:47', '2017-05-19 18:05:47'),
(62, 'media-form', 'media', 'form', 11, '2017-05-19 18:06:05', '2017-05-19 18:06:05'),
(63, 'media-trash', 'media', 'trash', 11, '2017-05-19 18:06:22', '2017-05-19 18:06:22'),
(64, 'media-delete', 'media', 'delete', 11, '2017-05-19 18:06:49', '2017-05-19 18:06:49'),
(65, 'media-status', 'media', 'status', 11, '2017-05-19 18:07:37', '2017-05-19 18:07:37'),
(66, 'media-ordering', 'media', 'ordering', 11, '2017-05-19 18:07:51', '2017-05-19 18:07:51'),
(67, 'product-list', 'product', 'list', 12, '2017-05-19 18:09:08', '2017-05-19 18:09:08'),
(68, 'product-form', 'product', 'form', 12, '2017-05-19 18:09:20', '2017-05-19 18:09:20'),
(69, 'product-trash', 'product', 'trash', 12, '2017-05-19 18:09:30', '2017-05-19 18:09:30'),
(70, 'product-delete', 'product', 'delete', 12, '2017-05-19 18:09:42', '2017-05-19 18:09:42'),
(71, 'product-ordering', 'product', 'ordering', 12, '2017-05-19 18:09:56', '2017-05-19 18:09:56'),
(72, 'product-status', 'product', 'status', 12, '2017-05-19 18:10:26', '2017-05-19 18:10:26'),
(73, 'category-list', 'category', 'list', 13, '2017-05-19 18:12:13', '2017-05-19 18:12:13'),
(74, 'category-form', 'category', 'form', 13, '2017-05-19 18:12:25', '2017-05-19 18:12:25'),
(75, 'category-trash', 'category', 'trash', 13, '2017-05-19 18:12:40', '2017-05-19 18:12:40'),
(76, 'category-delete', 'category', 'delete', 13, '2017-05-19 18:12:59', '2017-05-19 18:12:59'),
(77, 'category-status', 'category', 'status', 13, '2017-05-19 18:13:12', '2017-05-19 18:13:12'),
(78, 'category-ordering', 'category', 'ordering', 13, '2017-05-19 18:13:25', '2017-05-19 18:13:25'),
(79, 'invoice-list', 'invoice', 'list', 14, '2017-05-19 18:14:02', '2017-05-19 18:14:02'),
(80, 'invoice-form', 'invoice', 'form', 14, '2017-05-19 18:14:30', '2017-05-19 18:14:30'),
(81, 'invoice-trash', 'invoice', 'trash', 14, '2017-05-19 18:14:44', '2017-05-19 18:14:44'),
(82, 'invoice-delete', 'invoice', 'delete', 14, '2017-05-19 18:14:58', '2017-05-19 18:14:58'),
(83, 'invoice-status', 'invoice', 'status', 14, '2017-05-19 18:15:11', '2017-05-19 18:15:11'),
(84, 'invoice-ordering', 'invoice', 'ordering', 14, '2017-05-19 18:15:39', '2017-05-19 18:15:39'),
(85, 'customer-list', 'customer', 'list', 15, '2017-05-19 18:16:10', '2017-05-19 18:16:10'),
(86, 'customer-form', 'customer', 'form', 15, '2017-05-19 18:16:33', '2017-05-19 18:16:33'),
(87, 'customer-trash', 'customer', 'trash', 15, '2017-05-19 18:16:47', '2017-05-19 18:16:47'),
(88, 'customer-delete', 'customer', 'delete', 15, '2017-05-19 18:17:02', '2017-05-19 18:17:02'),
(89, 'customer-status', 'customer', 'status', 15, '2017-05-19 18:17:38', '2017-05-19 18:17:38'),
(90, 'customer-ordering', 'customer', 'ordering', 15, '2017-05-19 18:17:51', '2017-05-19 18:17:51'),
(91, 'album-list', 'album', 'list', 16, '2017-05-19 18:19:21', '2017-05-19 18:19:21'),
(92, 'album-form', 'album', 'form', 16, '2017-05-19 18:19:54', '2017-05-19 18:19:54'),
(93, 'album-trash', 'album', 'trash', 16, '2017-05-19 18:20:10', '2017-05-19 18:20:10'),
(94, 'album-delete', 'album', 'delete', 16, '2017-05-19 18:20:34', '2017-05-19 18:20:34'),
(95, 'album-status', 'album', 'status', 16, '2017-05-19 18:21:08', '2017-05-19 18:21:08'),
(96, 'album-ordering', 'album', 'ordering', 16, '2017-05-19 18:21:27', '2017-05-19 18:21:27'),
(97, 'photo-list', 'photo', 'list', 17, '2017-05-19 18:22:22', '2017-05-19 18:22:22'),
(98, 'photo-form', 'photo', 'form', 17, '2017-05-19 18:22:43', '2017-05-19 18:22:43'),
(99, 'photo-trash', 'photo', 'trash', 17, '2017-05-19 18:22:59', '2017-05-19 18:22:59'),
(100, 'photo-delete', 'photo', 'delete', 17, '2017-05-19 18:23:22', '2017-05-19 18:23:22'),
(101, 'photo-status', 'photo', 'status', 17, '2017-05-19 18:23:48', '2017-05-19 18:23:48'),
(102, 'photo-ordering', 'photo', 'ordering', 17, '2017-05-19 18:24:06', '2017-05-19 18:24:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `child_image` text CHARACTER SET utf8,
  `price` decimal(10,2) DEFAULT NULL,
  `detail` text CHARACTER SET utf8,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `code`, `fullname`, `alias`, `category_id`, `image`, `status`, `child_image`, `price`, `detail`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, '123456789', 'Dell XPS13_9360, Core i7 7500U, SSD 256GB, Ram 8GB, 13.3in QHD+ Touch, Win 10', 'dell-xps13-9360-core-i7-7500u', 5, '5920ilx1cqnj7hbv.png', 1, NULL, '33500000.00', 'ghi chú 1', 1, '2017-05-08 11:08:11', '2017-05-20 10:51:21'),
(3, '987654321', 'Dell XPS13_9360, Core i5 7200U, SSD 256GB, Ram 8GB, 13.3inch FHD, Win 10', 'dell-xp-s13-9360-core-i5-7200u', 5, 'vi15of8jarwuldcp.png', 1, NULL, '27499000.00', 'chi tiết 1', 2, '2017-05-09 03:10:16', '2017-05-20 10:51:21'),
(4, '321456789', 'Dell Inspiron 15-7559, Core i7-6700HQ, 1TB, 8GB, 4GB GTX 960M, 15.6 inch 4K Touch, Win 10', 'dell-inspiron-15-7559-core-i7-6700-hq', 5, 'nz26gicpxwys4eol.png', 1, NULL, '22499000.00', 'chi tiết 1', 3, '2017-05-09 03:16:57', '2017-05-20 10:51:21'),
(5, '456321789', 'Dell XPS13_9350_4007SLV (NEW 2016), core i5 6200U, 256GB SSD, 8GB, 13.3 QHD Touch, Win 10', 'dell-xps13-9350-4007slv', 5, 'mo7g1izrj2k4yvef.png', 1, NULL, '23499000.00', 'chi tiết 1', 4, '2017-05-09 03:19:07', '2017-05-20 10:51:21'),
(6, '512311891', 'Dell Inspiron 5378, Core i7-7500U, 256GB SSD, 8GB, Intel, 13.3in FHD Touch, Window 10', 'dell-inspiron-5378-core-i7-7500-u', 5, 'ke68yibf23rpuwda.png', 1, NULL, '21500000.00', '', 5, '2017-05-09 03:22:40', '2017-05-20 10:51:22'),
(7, '776123821', 'Dell Inspiron 13 5378, Core i5-7200U, 256GB SSD, 8GB, Intel, 13.3in FHD Touch, Window 10', 'dell-inspiron-13-5378-core-i5-7200-u', 5, 'xuih91a4wc58s2ol.png', 1, NULL, '17500000.00', 'chi tiết 1', 6, '2017-05-09 03:24:47', '2017-05-20 10:51:22'),
(8, '456987222', 'Dell XPS13_9360_1718SLV, Core i5 7200U, 128GB, 8GB, 13.3 FHD Touch, Win 10.', 'dell-xps13-9360-1718-slv-core-i5-7200-u', 5, 'bihxg0d4o2jmutcy.png', 1, NULL, '26999000.00', 'chi tiết 1', 7, '2017-05-09 03:27:41', '2017-05-20 10:51:22'),
(9, '617123981', 'Dell Inspiron 13 5378, Core i5-7200U, 1TB, 8GB, Intel, 13.3in FHD Touch, Window 10', 'dell-inspiron-13-5378-core-i5-7200-u-1-tb', 5, 'uem9z5bfxsqpaw1i.png', 1, NULL, '16500000.00', 'chi tiết 1', 8, '2017-05-09 03:41:21', '2017-05-20 10:51:22'),
(10, '213789123', 'Dell Inspiron 5378, Core i7-7500U, 1TB, 8GB, Intel, 13.3in FHD Touch, Window 10', 'dell-inspiron-5378-core-i7-7500-u-1-tb', 5, 'hse69cxt170vnior.png', 1, NULL, '18999000.00', 'chi tiết 1', 9, '2017-05-09 03:43:01', '2017-05-20 10:51:22'),
(11, '567123789', 'Dell Inspiron 7460, Core i5-7200U, 500GB + 128GB SSD, 4GB, 2GB GT940MX, 14in FHD, Win10', 'dell-inspiron-7460-core-i5-7200-u', 5, 'mxcui7whynpezv2s.png', 1, NULL, '17700000.00', 'chi tiết 1', 10, '2017-05-09 03:44:43', '2017-05-20 10:51:22'),
(12, '677123981', 'Dell Inspiron 5567, Core i5 7200U, 1TB, 4GB, 2G Radeon M445, 15.6inch FHD, Linux', 'dell-inspiron-5567-core-i5-7200-u', 5, 'zs7jxwfm92uybor8.png', 1, NULL, '13999000.00', 'chi tiết 1', 11, '2017-05-09 03:46:21', '2017-05-20 10:51:22'),
(13, '726123998', 'Dell XPS13_9360, Core i7 7500U, SSD 256GB, Ram 8GB, 13.3inch FHD, Win 10', 'dell-xps13-9360-core-i7-7500u-ssd-256-gb', 5, '175f8uzhjsyqmca3.png', 1, NULL, '30500000.00', 'chi tiết 1', 12, '2017-05-09 03:47:46', '2017-05-20 10:51:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_member_id` int(11) NOT NULL,
  `user_order` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`, `name`, `group_member_id`, `user_order`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'diennk@ttcgroup.vn', '$2y$10$Ldz/pO3bAkeE3bk3P/hDwuRoFXsya.cOZ4BXj8L10jAJGU/FcVhpa', 1, 'Nguyễn Kim Điền', 1, 1, 'v1s3qvm4jQ1L5hnG9rXgEo8zIla62Qs4EgSYWDzCKBuCUXDeGbaIPh3P5Psk', '2016-12-15 19:15:48', '2017-05-20 03:48:30'),
(2, 'trietnk', 'trietnk@ttcgroup.vn', '$2y$10$Ik1Q0rzlY1dBHxo3h.Kj8.itn/j/qB8SEgxiI66fQnzDacJpkfX8e', 1, 'Nguyễn Kim Triết', 2, 2, 'rPN5Un8gSv0CaorpuSTtAfKjVwgSvYAZfXgXIJxEXZLxWXTWnbbnakUmzSrJ', '2017-05-18 21:40:16', '2017-05-20 03:48:30'),
(3, 'hoanglk', 'hoanglk@ttcgroup.vn', '$2y$10$KLFOj4PXMtCYUHknS/dgdO3xmzgLHJhf292gESULdsYi8Qtyn3Ft6', 1, 'Lê Kim Hoàng', 4, 3, 'DwgCnKUA12QqgHChZSJoAZiky7W8KEEkq1mhWVseHGjTqrxLzPE5BYqai56J', '2017-05-18 21:41:03', '2017-05-20 03:48:30');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_article`
--
ALTER TABLE `category_article`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `group_member`
--
ALTER TABLE `group_member`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `group_privilege`
--
ALTER TABLE `group_privilege`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `module_article`
--
ALTER TABLE `module_article`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `module_custom`
--
ALTER TABLE `module_custom`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `module_menu`
--
ALTER TABLE `module_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mod_menu_type`
--
ALTER TABLE `mod_menu_type`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Chỉ mục cho bảng `persistences`
--
ALTER TABLE `persistences`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `album`
--
ALTER TABLE `album`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `article`
--
ALTER TABLE `article`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT cho bảng `category_article`
--
ALTER TABLE `category_article`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT cho bảng `group_member`
--
ALTER TABLE `group_member`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `group_privilege`
--
ALTER TABLE `group_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=893;
--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT cho bảng `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `module_article`
--
ALTER TABLE `module_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `module_custom`
--
ALTER TABLE `module_custom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `module_menu`
--
ALTER TABLE `module_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `mod_menu_type`
--
ALTER TABLE `mod_menu_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=552;
--
-- AUTO_INCREMENT cho bảng `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
