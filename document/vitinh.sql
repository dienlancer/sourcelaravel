-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 11, 2017 lúc 09:38 AM
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

DROP PROCEDURE IF EXISTS `pro_getBanner`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getBanner` (IN `keyword` VARCHAR(255) charset utf8)  BEGIN
SELECT 
	0 AS  is_checked
	,n.id
	,n.fullname
	,n.alias
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
	 FROM 
    `banner` n
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))    
    GROUP BY
	n.id
    	,n.fullname
    	,n.alias
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
    ORDER BY n.sort_order ASC;
    END$$

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
    ( (keyword='') OR ( LOWER(n.fullname) LIKE CONCAT('%',LOWER(keyword),'%')  ) )
    ORDER BY n.sort_order ASC       
    ;
END$$

DROP PROCEDURE IF EXISTS `pro_getCategoryProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getCategoryProduct` (IN `keyword` VARCHAR(255) CHARSET utf8)  BEGIN
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
    `category_product` n
    LEFT JOIN `category_product` a ON n.parent_id = a.id
    WHERE
    ( (keyword='') OR ( LOWER(n.fullname) LIKE CONCAT('%',LOWER(keyword),'%')  ) )
    ORDER BY n.sort_order ASC;
END$$

DROP PROCEDURE IF EXISTS `pro_getCustomer`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getCustomer` (IN `keyword` VARCHAR(255) CHARSET utf8)  NO SQL
SELECT
    0 AS is_checked,
	n.id,
	n.username,
	n.password,
	n.email,	
	n.fullname,
    n.address,
    n.phone,
    n.mobilephone,
    n.fax,
    n.status,
    n.sort_order,
	n.created_at,
	n.updated_at
	FROM 
    `customer` n
    WHERE
    ( (keyword='') OR ( LOWER(n.fullname) LIKE CONCAT('%',LOWER(keyword),'%')  ) )
    ORDER BY n.sort_order ASC$$

DROP PROCEDURE IF EXISTS `pro_getGroupMember`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getGroupMember` (IN `keyword` VARCHAR(255))  NO SQL
SELECT
	0 as is_checked
	,n.id
	,n.fullname
	,n.sort_order
	,n.created_at
	,n.updated_at
     FROM 
    `group_member` n
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))    
    group by
    n.id
	,n.fullname
	,n.sort_order
	,n.created_at
	,n.updated_at
    ORDER BY n.sort_order ASC$$

DROP PROCEDURE IF EXISTS `pro_getInvoice`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getInvoice` (IN `keyword` VARCHAR(255) CHARSET utf8)  NO SQL
SELECT
    0 AS is_checked,
	n.id,
	n.code,
	n.username,
	n.email,	
	n.fullname,
    n.address,
    n.phone,
    n.mobilephone,
    n.fax,
    n.quantity,
    n.total_price,
    n.status,
    n.sort_order,
	n.created_at,
	n.updated_at
	FROM 
    `invoice` n
    WHERE
    ( (keyword='') OR ( LOWER(n.fullname) LIKE CONCAT('%',LOWER(keyword),'%')  ) )
    ORDER BY n.sort_order ASC$$

DROP PROCEDURE IF EXISTS `pro_getMenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getMenu` (IN `keyword` VARCHAR(255), IN `menu_type_id` INT(11))  BEGIN
SELECT 
0 AS is_checked
	,n.id
	,n.fullname
	,n.alias
	,n.site_link
	,n.parent_id
	,a.fullname AS parent_fullname
	,n.menu_type_id
	,n.level
	,n.sort_order
	,n.status
	,n.created_at
	,n.updated_at
	 FROM 
    `menu` n
    LEFT JOIN `menu` a ON n.parent_id = a.id
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))
    AND (menu_type_id = '' OR n.menu_type_id = menu_type_id)
    ORDER BY n.sort_order ASC    ;
    END$$

DROP PROCEDURE IF EXISTS `pro_getMenuType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getMenuType` (IN `keyword` VARCHAR(255))  BEGIN
	SELECT 
	0 AS is_checked
	,n.id
	,n.fullname
	,n.sort_order
	,n.created_at
	,n.updated_at
	 FROM 
    `menu_type` n
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))    
    ORDER BY n.sort_order ASC
    ;
END$$

DROP PROCEDURE IF EXISTS `pro_getModuleArticle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getModuleArticle` (IN `keyword` VARCHAR(255))  NO SQL
SELECT 
	0 AS  is_checked
	,n.id
	,n.fullname
	,n.article_id
	,n.position
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
	 FROM 
    `module_article` n
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))    
    GROUP BY
	n.id
    	,n.fullname
	,n.article_id
	,n.position
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
    ORDER BY n.sort_order ASC$$

DROP PROCEDURE IF EXISTS `pro_getModuleItem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getModuleItem` (IN `keyword` VARCHAR(255))  BEGIN
SELECT 
	0 AS  is_checked
	,n.id
	,n.fullname
	,n.item_id
	,n.position
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
	 FROM 
    `module_item` n
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))    
    GROUP BY
	n.id
    	,n.fullname
	,n.item_id
	,n.position
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
    ORDER BY n.sort_order ASC;
    END$$

DROP PROCEDURE IF EXISTS `pro_getModuleMenu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getModuleMenu` (IN `keyword` VARCHAR(255))  SELECT 
	0 as  is_checked
	,n.id
	,n.fullname
	,n.menu_type_id
	,n.position
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
	 FROM 
    `module_menu` n
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))    
    group by
	n.id
    	,n.fullname
	,n.menu_type_id
	,n.position
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
    ORDER BY n.sort_order ASC$$

DROP PROCEDURE IF EXISTS `pro_getPaymentMethod`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getPaymentMethod` (IN `keyword` VARCHAR(255) charset utf8)  BEGIN
SELECT 
	0 AS  is_checked
	,n.id
	,n.fullname
	,n.alias
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
	 FROM 
    `payment_method` n
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))    
    GROUP BY
	n.id
    	,n.fullname
    	,n.alias
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
    ORDER BY n.sort_order ASC;
    END$$

DROP PROCEDURE IF EXISTS `pro_getPrivilege`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getPrivilege` (IN `keyword` VARCHAR(255) CHARSET utf8)  NO SQL
SELECT
    0 AS is_checked,
	n.id,
	n.fullname,
	n.controller,
	n.action,	
	n.sort_order,
	n.created_at,
	n.updated_at
	FROM 
    `privilege` n
  
    WHERE
    ( (keyword='') OR ( LOWER(n.fullname) LIKE CONCAT('%',LOWER(keyword),'%')  ) )
    ORDER BY n.controller ASC , n.sort_order ASC$$

DROP PROCEDURE IF EXISTS `pro_getProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getProduct` (IN `keyword` VARCHAR(255), IN `strCategoryProductID` VARCHAR(255))  begin
SELECT
    0 AS is_checked
    ,n.id
    ,n.code
    ,n.fullname
    ,n.alias   
    ,n.image
    ,n.status
    ,n.child_image
    ,n.price
    ,n.detail
    ,n.sort_order
    ,n.created_at    
    ,n.updated_at
	 FROM 
    `product` n
    LEFT JOIN `product_category` ac ON n.id = ac.product_id
    LEFT JOIN `category_product` cate ON ac.category_product_id = cate.id
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%',LOWER(keyword),'%'))
    AND (strCategoryProductID = '#0#' OR INSTR(strCategoryProductID,'#'+ac.category_product_id+'#') > 0)
     GROUP BY 
    n.id
    ,n.code
    ,n.fullname
    ,n.alias   
    ,n.image
    ,n.status
    ,n.child_image
    ,n.price
    ,n.detail
    ,n.sort_order
    ,n.created_at    
    ,n.updated_at
    ORDER BY n.sort_order ASC;
end$$

DROP PROCEDURE IF EXISTS `pro_getSettingSystem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getSettingSystem` (IN `keyword` VARCHAR(255) charset utf8)  BEGIN
SELECT 
	0 AS  is_checked
	,n.id
	,n.fullname
	,n.alias
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
	 FROM 
    `setting_system` n
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))    
    GROUP BY
	n.id
    	,n.fullname
    	,n.alias
	,n.status
	,n.sort_order
	,n.created_at
	,n.updated_at
    ORDER BY n.sort_order ASC;
    END$$

DROP PROCEDURE IF EXISTS `pro_getUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_getUser` (IN `keyword` VARCHAR(255), IN `group_member_id` INT)  NO SQL
SELECT 
    0 as is_checked
    ,n.id
    ,n.username
    ,n.email
    ,n.password
    ,n.level
    ,n.fullname
    ,n.group_member_id
    ,g.fullname as group_member_name
    ,n.sort_order
    ,n.created_at
    ,n.updated_at
    FROM 
    `users` n 
    inner join group_member g on n.group_member_id = g.id
    WHERE
    (keyword ='' OR LOWER(n.fullname) LIKE CONCAT('%', LOWER(keyword) ,'%'))    
    AND (group_member_id = 0 OR n.group_member_id = group_member_id)
    ORDER BY n.sort_order ASC$$

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
  `status` int(1) DEFAULT NULL,
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
  `description` longtext COLLATE utf8_unicode_ci,
  `meta_keyword` text COLLATE utf8_unicode_ci,
  `meta_description` text COLLATE utf8_unicode_ci,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `article`
--

INSERT INTO `article` (`id`, `fullname`, `title`, `alias`, `image`, `intro`, `content`, `description`, `meta_keyword`, `meta_description`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Giảm Mỡ Bụng - Giảm Mỡ Bụng Sau Sinh - Cùng Ưu Đãi 60%', '1', 'giam-mo-bung-giam-mo-bung-sau-sinh-cung-uu-dai-60', '12965808_1.jpg', '1', '1', '1', '1', '1', 4, 1, '2017-10-02 16:12:20', '2017-10-05 17:26:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `article_category`
--

DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `id` bigint(20) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `category_article_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `category_article_id`, `created_at`, `updated_at`) VALUES
(42, 3, 58, '2017-10-05 17:26:11', '2017-10-05 17:26:11'),
(43, 3, 59, '2017-10-05 17:26:11', '2017-10-05 17:26:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `fullname`, `alias`, `image`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Banner1', 'banner-1', 'slideshow-1.jpg', 1, 1, '2017-11-10 19:20:58', '2017-11-10 19:29:11');

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
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_article`
--

INSERT INTO `category_article` (`id`, `fullname`, `alias`, `parent_id`, `image`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(55, 'Công nghệ Hifu', 'cong-nghe-hifu', NULL, '12987989_1.jpg', 8, 1, '2017-10-02 12:54:01', '2017-10-14 04:02:14'),
(56, 'Trị mụn thâm da', 'tri-mun-tham-da', NULL, '12997238_1001.jpg', 3, 1, '2017-10-02 12:54:23', '2017-10-14 04:02:14'),
(57, 'Giảm cân', 'giam-can', 0, '12997947_1.jpg', 2, 1, '2017-10-02 12:54:34', '2017-10-14 04:05:29'),
(58, 'Chăm sóc da mặt', 'cham-soc-da-mat', NULL, '13000660_1.jpg', 1, 1, '2017-10-02 12:54:56', '2017-10-14 04:02:14'),
(59, 'Triệt lông', 'triet-long', NULL, '12997953_1.jpg', 7, 1, '2017-10-02 12:55:12', '2017-10-14 04:02:14'),
(67, 'Phi kim siêu vi điểm', 'phi-kim-sieu-vi-diem', NULL, '12956480_19.jpg', 6, 1, '2017-10-02 17:22:48', '2017-10-14 04:02:14'),
(68, 'Phun thêu thẩm mỹ', 'phun-theu-tham-my', NULL, '12964555_1.jpg', 5, 1, '2017-10-02 17:23:07', '2017-10-14 04:02:14'),
(69, 'Tắm trắng', 'tam-trang', NULL, '12965808_1.jpg', 4, 1, '2017-10-02 17:23:18', '2017-10-14 04:02:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_product`
--

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE `category_product` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `category_product`
--

INSERT INTO `category_product` (`id`, `fullname`, `alias`, `image`, `status`, `parent_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(10, 'Laptop', 'laptop', NULL, 1, 0, 1, '2017-10-05 15:08:13', '2017-10-05 15:08:13'),
(11, 'Máy tính bảng', 'may-tinh-bang', NULL, 1, 0, 2, '2017-10-05 15:08:25', '2017-10-11 06:45:46'),
(12, 'Máy tính để bàn', 'may-tinh-de-ban', '', 1, 0, 3, '2017-10-05 15:08:38', '2017-10-05 17:26:36'),
(13, 'Máy tính All In One', 'may-tinh-all-in-one', NULL, 1, 0, 3, '2017-10-05 15:08:57', '2017-10-05 15:08:57'),
(14, 'Workstation', 'workstation', NULL, 1, 0, 4, '2017-10-05 15:09:11', '2017-10-05 15:09:16'),
(15, 'Máy chủ', 'may-chu', NULL, 1, 0, 5, '2017-10-05 15:09:45', '2017-10-05 15:09:45'),
(16, 'Màn hình', 'man-hinh', NULL, 1, 0, 6, '2017-10-05 15:09:57', '2017-10-05 15:09:57'),
(17, 'Máy in', 'may-in', NULL, 1, 0, 7, '2017-10-05 15:10:07', '2017-10-05 15:10:07'),
(18, 'Mực in - Giấy in', 'muc-in-giay-in', '', 1, 0, 8, '2017-10-05 15:10:24', '2017-10-05 15:10:36'),
(19, 'Phần mềm', 'phan-mem', NULL, 1, 0, 9, '2017-10-05 15:10:50', '2017-10-05 15:10:50'),
(20, 'Linh kiện', 'link-kien', NULL, 1, 0, 10, '2017-10-05 15:11:00', '2017-10-05 15:11:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mobilephone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
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
(9, 'thangnc', '$2y$10$t1x/pR//bw/OaBZh5GbdiubXy9hfQF3TgKtOm6lGGTo/J88NQuPQy', 'thangnc@ttcgroup.vn', 'Nguyễn Chí Thăng', '83 Nguyễn Trọng Tuyển', '3322116677', '0988666222', '4888221111', 1, 2, '2017-05-13 09:29:29', '2017-11-10 12:04:58'),
(10, 'thaihst', '$2y$10$n4w/Kcbpq0IQLU3izh1t2uqm4GPWxDSW8ta9XPKbUFsDqpzThqYmm', 'thaihst@ttcgroup.vn', 'Hồ Sỹ Thiên Thai', '16 Nguyễn Văn Trỗi', '0811111111', '0911111111', '1111111111', 1, 1, '2017-05-14 10:05:55', '2017-11-10 12:05:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_member`
--

DROP TABLE IF EXISTS `group_member`;
CREATE TABLE `group_member` (
  `id` bigint(20) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `group_member`
--

INSERT INTO `group_member` (`id`, `fullname`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 3, '2016-12-17 05:05:18', '2017-10-07 19:06:51'),
(2, 'Bài viết', 2, '2016-12-17 05:05:41', '2017-10-07 19:06:35'),
(4, 'Hệ thống', 1, '2016-12-17 05:26:59', '2017-10-07 19:06:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_privilege`
--

DROP TABLE IF EXISTS `group_privilege`;
CREATE TABLE `group_privilege` (
  `id` int(11) NOT NULL,
  `group_member_id` int(11) DEFAULT NULL,
  `privilege_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mobilephone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice_detail`
--

DROP TABLE IF EXISTS `invoice_detail`;
CREATE TABLE `invoice_detail` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `product_fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_total_price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

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
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `fullname`, `alias`, `site_link`, `parent_id`, `menu_type_id`, `level`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(10, 'menu 2-1', 'alias-2-1', 'sitelink-2-1', 0, 14, 0, 1, 1, '2017-10-06 13:49:05', '2017-10-07 15:18:11'),
(11, 'menu 2-2', 'alias-2-2', 'sitelink-2-2', 0, 14, 0, 2, 1, '2017-10-06 13:49:21', '2017-10-07 15:18:15'),
(12, 'menu 2-3', 'alias-2-3', 'sitelink-2-3', 0, 14, 0, 3, 1, '2017-10-06 13:50:08', '2017-10-07 15:18:18'),
(13, 'menu 4-1', 'alias-4-1', 'sitelink-4-1', 0, 17, 0, 1, 1, '2017-10-06 13:50:35', '2017-10-06 13:50:35'),
(14, 'menu 4-2', 'alias-4-2', 'sitelink-4-2', 0, 17, 0, 2, 1, '2017-10-06 13:50:58', '2017-10-06 13:50:58'),
(15, 'menu 4-3', 'alias-4-3', 'sitelink-4-3', 0, 17, 0, 3, 1, '2017-10-06 13:51:19', '2017-10-06 13:51:19'),
(16, 'menu 3 - 1', 'alias-3-1', 'sitelink-3-1', 0, 16, 0, 1, 1, '2017-10-08 02:54:32', '2017-10-08 02:54:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_type`
--

DROP TABLE IF EXISTS `menu_type`;
CREATE TABLE `menu_type` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu_type`
--

INSERT INTO `menu_type` (`id`, `fullname`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'mainmenu-1', 1, '2017-10-03 09:25:24', '2017-10-05 05:03:53'),
(5, 'mainmenu-5', 5, '2017-10-03 10:32:11', '2017-10-05 05:03:53'),
(14, 'mainmenu-2', 2, '2017-10-03 10:38:36', '2017-10-05 05:03:53'),
(16, 'mainmenu-3', 3, '2017-10-03 10:39:00', '2017-10-05 05:03:53'),
(17, 'mainmenu-4', 4, '2017-10-04 03:49:07', '2017-10-05 05:03:53');

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
  `status` int(1) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `module_article`
--

INSERT INTO `module_article` (`id`, `fullname`, `article_id`, `position`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'module article 3', '7,8,9', 'position-3', 0, 3, '2017-10-08 18:52:22', '2017-10-08 18:56:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `module_item`
--

DROP TABLE IF EXISTS `module_item`;
CREATE TABLE `module_item` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `module_item`
--

INSERT INTO `module_item` (`id`, `fullname`, `item_id`, `position`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'ModuleItem1', '1', 'position-1', 1, 1, '2017-11-10 11:24:02', '2017-11-10 11:28:09');

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
  `status` int(1) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `module_menu`
--

INSERT INTO `module_menu` (`id`, `fullname`, `menu_type_id`, `position`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'module menu 2', 14, 'position-2', 1, 2, '2017-10-08 18:51:08', '2017-10-08 18:51:29');

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
(5, 11, 1, 'module-menu', '2017-10-08 18:51:29', '2017-10-08 18:51:29'),
(6, 12, 1, 'module-menu', '2017-10-08 18:51:29', '2017-10-08 18:51:29'),
(13, 15, 2, 'module-article', '2017-10-08 18:56:18', '2017-10-08 18:56:18'),
(14, 16, 2, 'module-article', '2017-10-08 18:56:18', '2017-10-08 18:56:18'),
(23, 12, 1, 'module-item', '2017-11-10 11:26:15', '2017-11-10 11:26:15'),
(24, 13, 1, 'module-item', '2017-11-10 11:26:15', '2017-11-10 11:26:15');

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
-- Cấu trúc bảng cho bảng `payment_method`
--

DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `content` text,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `payment_method`
--

INSERT INTO `payment_method` (`id`, `fullname`, `alias`, `content`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'paymentmethod1', 'payment-method-1', 'content-1', 1, 1, '2017-11-10 18:10:47', '2017-11-10 18:17:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
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
(92, 'album-form', 'album', 'form', 16, '2017-05-19 18:19:54', '2017-10-08 16:46:24'),
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
  `alias` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
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

INSERT INTO `product` (`id`, `code`, `fullname`, `alias`, `image`, `status`, `child_image`, `price`, `detail`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, '123456', 'Sản phẩm 1', 'san-pham-1', '12997238_1001.jpg', 1, NULL, '300000.00', '', 21, '2017-10-05 17:51:11', '2017-10-07 17:49:50'),
(7, '654321', 'sản phẩm 2', 'san-pham-2', '12919228_1.jpg', 1, NULL, '100000.00', '', 52, '2017-10-07 17:47:51', '2017-10-07 17:49:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `id` bigint(20) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_product_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_product_id`, `created_at`, `updated_at`) VALUES
(17, 6, 12, '2017-10-05 17:51:11', '2017-10-05 17:51:11'),
(18, 6, 18, '2017-10-05 17:51:11', '2017-10-05 17:51:11'),
(19, 7, 14, '2017-10-07 17:47:51', '2017-10-07 17:47:51'),
(20, 7, 18, '2017-10-07 17:47:51', '2017-10-07 17:47:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_system`
--

DROP TABLE IF EXISTS `setting_system`;
CREATE TABLE `setting_system` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `article_perpage` int(11) DEFAULT NULL,
  `article_width` int(11) DEFAULT NULL,
  `article_height` int(11) DEFAULT NULL,
  `product_perpage` int(11) DEFAULT NULL,
  `product_width` int(11) DEFAULT NULL,
  `product_height` int(11) DEFAULT NULL,
  `currency_unit` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `encription` varchar(255) DEFAULT NULL,
  `authentication` int(11) NOT NULL,
  `smtp_username` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `email_from` varchar(255) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `to_name` varchar(255) DEFAULT NULL,
  `contacted_phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `opened_time` varchar(255) DEFAULT NULL,
  `opened_date` varchar(255) DEFAULT NULL,
  `contacted_name` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `google_plus` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `pinterest_url` varchar(255) DEFAULT NULL,
  `slogan_about` text,
  `map_url` text,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `setting_system`
--

INSERT INTO `setting_system` (`id`, `fullname`, `alias`, `article_perpage`, `article_width`, `article_height`, `product_perpage`, `product_width`, `product_height`, `currency_unit`, `smtp_host`, `smtp_port`, `encription`, `authentication`, `smtp_username`, `smtp_password`, `email_from`, `email_to`, `from_name`, `to_name`, `contacted_phone`, `address`, `website`, `telephone`, `opened_time`, `opened_date`, `contacted_name`, `facebook_url`, `twitter_url`, `google_plus`, `youtube_url`, `instagram_url`, `pinterest_url`, `slogan_about`, `map_url`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'settingsystem1', 'setting-system-1', 6, 400, 400, 12, 500, 500, 'vi_VN', 'smtp.gmail.com', '465', 'ssl', 1, 'dien.toannang@gmail.com', 'lienhoancuoc', 'dienit02@gmail.com', 'tichtacso.com@gmail.com', 'Hệ thống', 'Công Ty TNHH VIDOCO', '096.302.7720', '35/6 Bùi Quang Là - P.12 - Q. Gò Vấp - HCM', 'noithatgialai.net', '096.302.7720', '8h - 20h', '(T2-T7). Chủ Nhật nghỉ', 'Mr. Vinh', 'https://www.facebook.com/nguyenvan.laptrinh', 'https://twitter.com/', 'https://plus.google.com/u/0/?hl=vi', 'https://www.youtube.com/watch?v=kAcV7S3sySU', 'http://flickr.com', 'http://daidung.vn/', 'Mipec cung cấp thực phẩm sạch, an toàn, đảm bảo chất lượng hàng đầu. Xóa đi nỗi lo về an toàn thực phẩm', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.605543764119!2d108.07355431421081!3d13.982069195684272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDU4JzU1LjQiTiAxMDjCsDA0JzMyLjciRQ!5e0!3m2!1svi!2s!4v1508913801584', 1, 1, '2017-11-10 19:46:32', '2017-11-11 08:37:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_member_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`, `fullname`, `group_member_id`, `sort_order`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'diennk@ttcgroup.vn', '$2y$10$JFDAOKVX5zgqa4GvRlRTlOdc3.epNdMC03RSB7E0I52NtW0LA8mlC', 0, 'Nguyễn Kim Điền', 4, 1, 'v1s3qvm4jQ1L5hnG9rXgEo8zIla62Qs4EgSYWDzCKBuCUXDeGbaIPh3P5Psk', '2016-12-15 19:15:48', '2017-10-08 08:47:59');

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
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_article`
--
ALTER TABLE `category_article`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_product`
--
ALTER TABLE `category_product`
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
-- Chỉ mục cho bảng `module_item`
--
ALTER TABLE `module_item`
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
-- Chỉ mục cho bảng `payment_method`
--
ALTER TABLE `payment_method`
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
-- Chỉ mục cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `setting_system`
--
ALTER TABLE `setting_system`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `category_article`
--
ALTER TABLE `category_article`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT cho bảng `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT cho bảng `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT cho bảng `module_article`
--
ALTER TABLE `module_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `module_item`
--
ALTER TABLE `module_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `module_menu`
--
ALTER TABLE `module_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `mod_menu_type`
--
ALTER TABLE `mod_menu_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT cho bảng `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT cho bảng `setting_system`
--
ALTER TABLE `setting_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
