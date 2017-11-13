-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 13, 2017 lúc 03:31 PM
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
	,n.alias
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
    ,n.status
    ,n.fullname
    ,n.group_member_id
    ,g.fullname as group_member_name
    ,n.sort_order
    ,n.created_at
    ,n.updated_at
    FROM 
    `users` n 
    left join group_member g on n.group_member_id = g.id
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
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'ilPOiDhmKqsxtUpi7ZgWe5vDYjt2ICJK', 1, '2017-11-12 06:15:56', '2017-11-12 06:15:55', '2017-11-12 06:15:56'),
(2, 1, 'rcp04qHne8oATtrTCwKl9FuckJEarSCb', 1, '2017-11-12 06:20:02', '2017-11-12 06:20:02', '2017-11-12 06:20:02'),
(3, 1, 'AHbwHv4BMq4Z5b7nkdvOlvcOvXnPqMk0', 1, '2017-11-12 06:24:14', '2017-11-12 06:24:14', '2017-11-12 06:24:14'),
(4, 1, 'JqmoT6nwuNXt0D5jape2qCQsEVQgWEqA', 1, '2017-11-12 06:26:26', '2017-11-12 06:26:26', '2017-11-12 06:26:26'),
(5, 1, '1TnyfEnFLs7gdNZXKP2r35tc1hBvcnPg', 1, '2017-11-12 07:22:52', '2017-11-12 07:22:52', '2017-11-12 07:22:52'),
(6, 1, 'QlzbRQWzVJgg01NkGUVewoQhT4qPKTMZ', 1, '2017-11-12 07:23:56', '2017-11-12 07:23:56', '2017-11-12 07:23:56'),
(8, 4, '3DIqppaoRZI0iaNdlvDo6id9OOnpOE45', 1, '2017-11-12 10:59:09', '2017-11-12 10:59:09', '2017-11-12 10:59:09');

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
(3, 'Cuộc Cách Mạng Trong Điều Trị Nám Tàn Nhang Bằng Laser Toning', 'Trị nám tàn nhang bằng laser toning cam kết đạt hiệu quả 99%', 'cuoc-cach-mang-trong-dieu-tri-nam-tan-nhang-bang-laser-toning', '', 'Sở hữu một khuôn mặt đẹp khả ái là niềm khao khát của không ít các chị em phụ nữ nhưng giờ việc điều trị nám tàn nhang bằng công nghệ Laser Toning sẽ giúp bạn biến giấc mơ đó thành hiện thực', '<p style=\"text-align:justify\">Kh&ocirc;ng Gordon Hayward, kh&ocirc;ng Al Horford, chủ nh&agrave; nhập cuộc tồi tệ với chỉ một lần th&agrave;nh c&ocirc;ng trong 11 t&igrave;nh huống b&oacute;ng sống đầu trận. Hy vọng tắt dần khi ng&ocirc;i sao Kyrie Irving chấn thương v&ugrave;ng mặt ngay trong hiệp một, rời s&acirc;n v&agrave; kh&ocirc;ng quay trở lại.</p>\n\n<p style=\"text-align:justify\">Celtics chỉ n&eacute;m th&agrave;nh c&ocirc;ng 33% trong nửa đầu trận, v&agrave; để đối thủ ghi 57 điểm trong hai hiệp đầu (cao thứ hai từ đầu giải).</p>', 'http://thammyvienngocdung.com/dich-vu/giam-mo-cong-nghe-lipo-hifu.html', 'trị nám tàn nhang', 'Cuộc cách mạng trong điều trị nám tàn nhang bằng laser toning luôn cho kết quả như mong muốn', 1, 1, '2017-10-02 16:12:20', '2017-11-13 01:47:08');

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
(1, 'Banner1', 'banner-1', 'slideshow-1.jpg', 1, 1, '2017-11-10 19:20:58', '2017-11-12 14:44:50');

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
(55, 'Công nghệ Hifu', 'cong-nghe-hifu', 0, '', 8, 1, '2017-10-02 12:54:01', '2017-11-11 10:11:37'),
(56, 'Trị mụn thâm da', 'tri-mun-tham-da', 0, '', 3, 1, '2017-10-02 12:54:23', '2017-11-13 01:00:14'),
(57, 'Giảm cân', 'giam-can', 0, '', 2, 1, '2017-10-02 12:54:34', '2017-11-12 19:18:34'),
(58, 'Chăm sóc da mặt', 'cham-soc-da-mat', 0, '', 1, 1, '2017-10-02 12:54:56', '2017-11-11 18:53:56'),
(59, 'Triệt lông', 'triet-long', 0, '', 7, 1, '2017-10-02 12:55:12', '2017-11-11 10:11:31'),
(67, 'Phi kim siêu vi điểm', 'phi-kim-sieu-vi-diem', 0, '', 6, 1, '2017-10-02 17:22:48', '2017-11-11 10:11:26'),
(68, 'Phun thêu thẩm mỹ', 'phun-theu-tham-my', 0, '', 5, 1, '2017-10-02 17:23:07', '2017-11-11 10:11:10'),
(69, 'Tắm trắng', 'tam-trang', 0, '', 4, 1, '2017-10-02 17:23:18', '2017-11-12 19:59:59');

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
(10, 'Laptop', 'laptop', '', 1, 0, 1, '2017-10-05 15:08:13', '2017-11-11 18:54:54'),
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
(9, 'thangnc', 'c33367701511b4f6020ec61ded352059', 'thangnc@ttcgroup.vn', 'Nguyễn Chí Thăng', '83 Nguyễn Trọng Tuyển', '3322116677', '0988666222', '4888221111', 1, 2, '2017-05-13 09:29:29', '2017-11-11 19:22:12'),
(10, 'thaihst', 'e10adc3949ba59abbe56e057f20f883e', 'thaihst@ttcgroup.vn', 'Hồ Sỹ Thiên Thai', '16 Nguyễn Văn Trỗi', '0811111111', '0911111111', '1111111111', 1, 1, '2017-05-14 10:05:55', '2017-11-11 19:20:26');

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
(1, 'Trang chủ', 'trang-chu', '/trang-chu', 0, 1, 0, 1, 1, '2017-11-13 04:31:34', '2017-11-13 13:38:06'),
(5, 'Liên hệ', 'lien-he', '/lien-he', 0, 1, 0, 5, 1, '2017-11-13 04:34:54', '2017-11-13 04:34:54'),
(6, 'Giới thiệu', 'gioi-thieu', '/bai-viet/gioi-thieu', 0, 1, 0, 2, 1, '2017-11-13 04:36:20', '2017-11-13 04:36:20'),
(7, 'Tin tức', 'tin-tuc', '/chu-de/tin-tuc', 0, 1, 0, 3, 1, '2017-11-13 04:36:41', '2017-11-13 04:36:41'),
(8, 'Sản phẩm', 'san-pham', '/san-pham', 0, 1, 0, 4, 1, '2017-11-13 04:37:00', '2017-11-13 04:37:00'),
(9, 'Phòng khách', 'phong-khach', '/loai-san-pham/phong-khach', 8, 1, 1, 1, 1, '2017-11-13 04:37:45', '2017-11-13 04:37:45'),
(10, 'Phòng ngủ', 'phong-phu', '/loai-san-pham/phong-ngu', 8, 1, 1, 2, 1, '2017-11-13 04:38:12', '2017-11-13 04:38:19'),
(11, 'Sofa', 'sofa', '/loai-san-pham/sofa', 8, 1, 1, 3, 1, '2017-11-13 04:38:44', '2017-11-13 04:38:44'),
(12, 'Phòng bếp', 'phong-bep', '/loai-san-pham/phong-bep', 8, 1, 1, 4, 1, '2017-11-13 04:39:09', '2017-11-13 04:39:09'),
(13, 'Phòng trẻ em', 'phong-tre-em', '/loai-san-pham/phong-tre-em', 8, 1, 1, 5, 1, '2017-11-13 04:39:34', '2017-11-13 04:39:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_type`
--

DROP TABLE IF EXISTS `menu_type`;
CREATE TABLE `menu_type` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu_type`
--

INSERT INTO `menu_type` (`id`, `fullname`, `alias`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'MainMenu', 'main-menu', 1, '2017-11-13 04:27:56', '2017-11-13 04:55:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_07_02_230147_migration_cartalyst_sentinel', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Chuyển khoản bằng tiền mặt', 'chuyen-khoan-bang-tien-mat', '<p style=\"text-align:justify\">Cờ vua Việt Nam từng sở hữu nhiều kỳ thủ v&ocirc; địch thế giới c&aacute;c cấp độ trẻ. Ti&ecirc;n phong l&agrave; Đ&agrave;o Thi&ecirc;n Hải &ndash; người thầy hiện tại của Anh Kh&ocirc;i. Thi&ecirc;n Hải học đ&aacute;nh cờ khi mới năm tuổi, sớm bộc lộ năng khiếu v&agrave; được dạy dỗ bởi &ocirc;ng Đặng Tất Thắng - từng c&oacute; c&ocirc;ng mang cờ vua về Việt Nam.</p>', 1, 1, '2017-11-10 18:10:47', '2017-11-11 19:33:27'),
(2, 'Chuyển khoản qua ngân hàng', 'chuyen-khoan-qua-ngan-hang', '<p style=\"text-align:justify\">Nhưng trong nh&oacute;m n&agrave;y chỉ c&oacute; Quang Li&ecirc;m đang tiến dần đến nh&oacute;m kỳ thủ h&agrave;ng đầu thế giới. Với Elo 2737 v&agrave; thứ 24 thế giới, kỳ thủ sinh năm 1991 trở th&agrave;nh niềm tự h&agrave;o l&agrave;ng cờ Việt. Quang Li&ecirc;m từng v&ocirc; địch cờ chớp thế giới, c&ugrave;ng những giải mở uy t&iacute;n như Aeroflot, SPICE Cup v&agrave; HDBank Cup&ndash; giải cờ quốc tế của Việt Nam. B&ecirc;n cạnh những yếu tố nội lực, si&ecirc;u đại kiện tướng duy nhất của Đ&ocirc;ng Nam &Aacute; tiến xa hơn cả nhờ được đầu tư, tập luyện c&ugrave;ng chuy&ecirc;n gia ngoại. Alexander Khalifman - thầy của Quang Li&ecirc;m, từng v&ocirc; địch thế giới do FIDE tổ chức.</p>', 2, 1, '2017-11-11 19:34:03', '2017-11-11 19:34:03'),
(3, 'Thanh toán qua paypal', 'paypal', '<p style=\"text-align:justify\">Gia đ&igrave;nh Anh Kh&ocirc;i cũng sẵn s&agrave;ng theo bước kỳ thủ sinh năm 2002, ở cả kh&iacute;a cạnh tinh thần v&agrave; t&agrave;i ch&iacute;nh. &ldquo;Mỗi c&acirc;y mỗi hoa, mỗi nh&agrave; mỗi cảnh. Kh&ocirc;ng phải gia đ&igrave;nh n&agrave;o cũng c&oacute; điều kiện giống nhau. Nhưng nếu Anh Kh&ocirc;i thực sự c&oacute; đam m&ecirc; v&agrave; quyết t&acirc;m, gia đ&igrave;nh sẽ quyết t&acirc;m hỗ trợ con&rdquo;, mẹ Anh Kh&ocirc;i chia sẻ</p>', 3, 1, '2017-11-11 19:44:25', '2017-11-11 19:44:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `persistences`
--

DROP TABLE IF EXISTS `persistences`;
CREATE TABLE `persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(6, 1, 'WphP2gHqBbRpGKp2WcZb6APTYCNo1onf', '2017-11-12 08:12:08', '2017-11-12 08:12:08'),
(12, 1, 'HMMWMPpBDgdUbv54tKOldPvWyvcaeDCp', '2017-11-12 08:20:55', '2017-11-12 08:20:55'),
(20, 1, 'F4bWDfEvllT0fTv4EzWDp3NWpLxGo4n5', '2017-11-12 08:44:06', '2017-11-12 08:44:06'),
(27, 1, 'f7VCzyYASPW5vTVgTfv3Ji50sxy2ckIt', '2017-11-12 10:14:09', '2017-11-12 10:14:09'),
(35, 1, 'Zlbi5ja6c9Z7no06i5MvPsa8kZI3oLEZ', '2017-11-12 10:41:59', '2017-11-12 10:41:59'),
(43, 3, 'ZsvbfzLh4A4k34VMpmZCqIO2KIDk9pzP', '2017-11-12 10:51:37', '2017-11-12 10:51:37'),
(45, 3, '61CQHzrI8v42ppzJ35HclGUgzulYNwKD', '2017-11-12 10:51:57', '2017-11-12 10:51:57'),
(48, 4, 'M1VbjAgWRrVuXhVCqqvWAQHP287e5fuk', '2017-11-12 11:00:38', '2017-11-12 11:00:38'),
(52, 4, 'zWj9obfujhk7L1DEKOcSOMTi49HvkeVo', '2017-11-12 11:04:17', '2017-11-12 11:04:17'),
(64, 4, 'sGcmm3lmMPLTUyFeagebRe9YiPjWxHn0', '2017-11-12 11:20:36', '2017-11-12 11:20:36'),
(68, 4, 'DsgzaC5yhMG3miJpNrQFeWCpBwqfsMuO', '2017-11-12 11:21:48', '2017-11-12 11:21:48'),
(71, 4, 'aFa63uj6gzLcV0mZtU0nYvVinHZnvyAi', '2017-11-12 11:22:33', '2017-11-12 11:22:33'),
(73, 4, 'P672dGDcBqxGazfRAzJtUxPwSjTq9N4K', '2017-11-12 11:22:59', '2017-11-12 11:22:59'),
(74, 4, 'm0D8Z9mVczUYgqkSJXAwGQi8S9EaqrSg', '2017-11-12 11:23:03', '2017-11-12 11:23:03'),
(94, 1, 'W1uglu6PzKaOfwxa766IOJ33NDdulIri', '2017-11-12 13:01:17', '2017-11-12 13:01:17'),
(105, 4, 'lpP9axx2fJB8SUi7t2NlNMHasH10fl9N', '2017-11-12 19:31:42', '2017-11-12 19:31:42'),
(106, 4, '1PNxpqM3E2RYNr5CT1NzPzCOlNu4xILB', '2017-11-12 19:31:45', '2017-11-12 19:31:45'),
(107, 4, 'IJleJPrQEduTCpRbolCVqNbD3vzzhqXH', '2017-11-12 19:31:51', '2017-11-12 19:31:51'),
(110, 4, 'RyU6rnrEVVwusqJpB1boWgpODKNKthib', '2017-11-12 19:32:50', '2017-11-12 19:32:50'),
(113, 4, '2iWGSejY4rkJdkY2iK65Na0UV05uJEZ3', '2017-11-12 19:34:34', '2017-11-12 19:34:34'),
(115, 1, 'WQkHX9pd7HnW6Fwd58b6FNwURcoRYyK6', '2017-11-12 19:36:57', '2017-11-12 19:36:57'),
(119, 4, 'FGLu6nkqZkVigimI5Chx4mNmXgdi22qe', '2017-11-12 19:44:50', '2017-11-12 19:44:50'),
(124, 1, '1kZXCQqSfCEwmILvBACrUaHl5MpzQWXX', '2017-11-12 20:47:34', '2017-11-12 20:47:34'),
(125, 1, 'RMVSsrsld3Bt2yiDuw8k5VhfohZMSTnH', '2017-11-13 06:37:54', '2017-11-13 06:37:54');

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
  `price` decimal(11,2) DEFAULT NULL,
  `sale_price` decimal(11,2) DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `detail` text CHARACTER SET utf8,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `code`, `fullname`, `alias`, `image`, `status`, `child_image`, `price`, `sale_price`, `intro`, `detail`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, '123456', 'Sản phẩm 1', 'san-pham-1', 'iphone-8-plus-256gb-h11-org.jpg', 1, '[\"iphone-8-plus-256gb-den-6-org.jpg\",\"iphone-8-plus-256gb-den-8-org.jpg\",\"iphone-8-plus-256gb-den-1-org.jpg\"]', '300000.00', '200000.00', 'Mục tiêu đạt chuẩn Đại kiện tướng năm 2018 chỉ là bước đầu trong hành trình trở thành kỳ thủ chuyên nghiệp của Nguyễn Anh Khôi.', '<p style=\"text-align:justify\">L&agrave; kỳ thủ Việt Nam duy nhất hai lần v&ocirc; địch trẻ thế giới, Anh Kh&ocirc;i sở hữu tiềm năng kh&ocirc;ng thể b&agrave;n c&atilde;i. Cuối th&aacute;ng 10/2017, kỳ thủ 15 tuổi cũng đoạt th&ecirc;m hai HC v&agrave;ng cờ nhanh chớp trẻ thế giới, d&ugrave; kh&ocirc;ng phải so t&agrave;i với nhiều đối thủ xứng tầm. Bảng th&agrave;nh t&iacute;ch ở giải trẻ của Anh Kh&ocirc;i sẽ được k&eacute;o d&agrave;i trong những năm mới, c&ugrave;ng với đ&oacute; l&agrave; những giải mở, d&agrave;nh cho &ldquo;người lớn&rdquo;. Anh Kh&ocirc;i mới 15 tuổi, nhưng đọ sức với những kỳ thủ h&agrave;ng đầu lu&ocirc;n kh&ocirc;ng thừa.</p>', 1, '2017-10-05 17:51:11', '2017-11-13 01:00:32');

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
(18, 6, 18, '2017-10-05 17:51:11', '2017-10-05 17:51:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reminders`
--

DROP TABLE IF EXISTS `reminders`;
CREATE TABLE `reminders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_users`
--

DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'settingsystem', 'setting-system', 6, 360, 230, 12, 510, 340, 'vi_VN', 'smtp.gmail.com', '465', 'ssl', 1, 'dien.toannang@gmail.com', 'lienhoancuoc', 'dienit02@gmail.com', 'tichtacso.com@gmail.com', 'Hệ thống', 'Công Ty TNHH VIDOCO', '096.302.7720', '35/6 Bùi Quang Là - P.12 - Q. Gò Vấp - HCM', 'noithatgialai.net', '096.302.7720', '8h - 20h', '(T2-T7). Chủ Nhật nghỉ', 'Mr. Vinh', 'https://www.facebook.com/nguyenvan.laptrinh', 'https://twitter.com/', 'https://plus.google.com/u/0/?hl=vi', 'https://www.youtube.com/watch?v=kAcV7S3sySU', 'http://flickr.com', 'http://daidung.vn/', 'Mipec cung cấp thực phẩm sạch, an toàn, đảm bảo chất lượng hàng đầu. Xóa đi nỗi lo về an toàn thực phẩm', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.605543764119!2d108.07355431421081!3d13.982069195684272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDU4JzU1LjQiTiAxMDjCsDA0JzMyLjciRQ!5e0!3m2!1svi!2s!4v1508913801584', 1, 1, '2017-11-10 19:46:32', '2017-11-11 10:28:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `throttle`
--

DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(1, NULL, 'global', NULL, '2017-11-12 07:00:10', '2017-11-12 07:00:10'),
(2, NULL, 'ip', '127.0.0.1', '2017-11-12 07:00:10', '2017-11-12 07:00:10'),
(3, NULL, 'global', NULL, '2017-11-12 07:00:22', '2017-11-12 07:00:22'),
(4, NULL, 'ip', '127.0.0.1', '2017-11-12 07:00:22', '2017-11-12 07:00:22'),
(5, NULL, 'global', NULL, '2017-11-12 07:00:36', '2017-11-12 07:00:36'),
(6, NULL, 'ip', '127.0.0.1', '2017-11-12 07:00:36', '2017-11-12 07:00:36'),
(7, NULL, 'global', NULL, '2017-11-12 07:05:02', '2017-11-12 07:05:02'),
(8, NULL, 'ip', '127.0.0.1', '2017-11-12 07:05:02', '2017-11-12 07:05:02'),
(9, NULL, 'global', NULL, '2017-11-12 07:30:11', '2017-11-12 07:30:11'),
(10, NULL, 'ip', '127.0.0.1', '2017-11-12 07:30:11', '2017-11-12 07:30:11'),
(11, NULL, 'global', NULL, '2017-11-12 07:32:49', '2017-11-12 07:32:49'),
(12, NULL, 'ip', '127.0.0.1', '2017-11-12 07:32:49', '2017-11-12 07:32:49'),
(13, NULL, 'global', NULL, '2017-11-12 07:39:23', '2017-11-12 07:39:23'),
(14, NULL, 'ip', '127.0.0.1', '2017-11-12 07:39:23', '2017-11-12 07:39:23'),
(15, NULL, 'global', NULL, '2017-11-12 07:55:42', '2017-11-12 07:55:42'),
(16, NULL, 'ip', '127.0.0.1', '2017-11-12 07:55:42', '2017-11-12 07:55:42'),
(17, NULL, 'global', NULL, '2017-11-12 07:59:33', '2017-11-12 07:59:33'),
(18, NULL, 'ip', '127.0.0.1', '2017-11-12 07:59:33', '2017-11-12 07:59:33'),
(19, NULL, 'global', NULL, '2017-11-12 08:01:13', '2017-11-12 08:01:13'),
(20, NULL, 'ip', '127.0.0.1', '2017-11-12 08:01:13', '2017-11-12 08:01:13'),
(21, NULL, 'global', NULL, '2017-11-12 08:01:34', '2017-11-12 08:01:34'),
(22, NULL, 'ip', '127.0.0.1', '2017-11-12 08:01:34', '2017-11-12 08:01:34'),
(23, NULL, 'global', NULL, '2017-11-12 08:01:41', '2017-11-12 08:01:41'),
(24, NULL, 'ip', '127.0.0.1', '2017-11-12 08:01:41', '2017-11-12 08:01:41'),
(25, NULL, 'global', NULL, '2017-11-12 08:02:05', '2017-11-12 08:02:05'),
(26, NULL, 'ip', '127.0.0.1', '2017-11-12 08:02:05', '2017-11-12 08:02:05'),
(27, NULL, 'global', NULL, '2017-11-12 08:12:23', '2017-11-12 08:12:23'),
(28, NULL, 'ip', '127.0.0.1', '2017-11-12 08:12:23', '2017-11-12 08:12:23'),
(29, NULL, 'global', NULL, '2017-11-12 08:18:51', '2017-11-12 08:18:51'),
(30, NULL, 'ip', '127.0.0.1', '2017-11-12 08:18:51', '2017-11-12 08:18:51'),
(31, NULL, 'global', NULL, '2017-11-12 08:19:22', '2017-11-12 08:19:22'),
(32, NULL, 'ip', '127.0.0.1', '2017-11-12 08:19:22', '2017-11-12 08:19:22'),
(33, NULL, 'global', NULL, '2017-11-12 08:34:38', '2017-11-12 08:34:38'),
(34, NULL, 'ip', '127.0.0.1', '2017-11-12 08:34:38', '2017-11-12 08:34:38'),
(35, NULL, 'global', NULL, '2017-11-12 10:21:38', '2017-11-12 10:21:38'),
(36, NULL, 'ip', '127.0.0.1', '2017-11-12 10:21:38', '2017-11-12 10:21:38'),
(37, NULL, 'global', NULL, '2017-11-12 10:38:16', '2017-11-12 10:38:16'),
(38, NULL, 'ip', '127.0.0.1', '2017-11-12 10:38:16', '2017-11-12 10:38:16'),
(39, 1, 'user', NULL, '2017-11-12 10:38:16', '2017-11-12 10:38:16'),
(40, NULL, 'global', NULL, '2017-11-12 10:39:37', '2017-11-12 10:39:37'),
(41, NULL, 'ip', '127.0.0.1', '2017-11-12 10:39:37', '2017-11-12 10:39:37'),
(42, 1, 'user', NULL, '2017-11-12 10:39:37', '2017-11-12 10:39:37'),
(43, NULL, 'global', NULL, '2017-11-12 10:58:13', '2017-11-12 10:58:13'),
(44, NULL, 'ip', '127.0.0.1', '2017-11-12 10:58:13', '2017-11-12 10:58:13'),
(45, NULL, 'global', NULL, '2017-11-12 10:59:19', '2017-11-12 10:59:19'),
(46, NULL, 'ip', '127.0.0.1', '2017-11-12 10:59:19', '2017-11-12 10:59:19'),
(47, 4, 'user', NULL, '2017-11-12 10:59:19', '2017-11-12 10:59:19'),
(48, NULL, 'global', NULL, '2017-11-12 11:00:10', '2017-11-12 11:00:10'),
(49, NULL, 'ip', '127.0.0.1', '2017-11-12 11:00:10', '2017-11-12 11:00:10'),
(50, 4, 'user', NULL, '2017-11-12 11:00:10', '2017-11-12 11:00:10'),
(51, NULL, 'global', NULL, '2017-11-12 11:04:27', '2017-11-12 11:04:27'),
(52, NULL, 'ip', '127.0.0.1', '2017-11-12 11:04:27', '2017-11-12 11:04:27'),
(53, 4, 'user', NULL, '2017-11-12 11:04:27', '2017-11-12 11:04:27'),
(54, NULL, 'global', NULL, '2017-11-12 11:05:04', '2017-11-12 11:05:04'),
(55, NULL, 'ip', '127.0.0.1', '2017-11-12 11:05:04', '2017-11-12 11:05:04'),
(56, 1, 'user', NULL, '2017-11-12 11:05:04', '2017-11-12 11:05:04'),
(57, NULL, 'global', NULL, '2017-11-12 11:08:43', '2017-11-12 11:08:43'),
(58, NULL, 'ip', '127.0.0.1', '2017-11-12 11:08:43', '2017-11-12 11:08:43'),
(59, 1, 'user', NULL, '2017-11-12 11:08:43', '2017-11-12 11:08:43'),
(60, NULL, 'global', NULL, '2017-11-12 11:14:37', '2017-11-12 11:14:37'),
(61, NULL, 'ip', '127.0.0.1', '2017-11-12 11:14:37', '2017-11-12 11:14:37'),
(62, 1, 'user', NULL, '2017-11-12 11:14:37', '2017-11-12 11:14:37'),
(63, NULL, 'global', NULL, '2017-11-12 11:18:13', '2017-11-12 11:18:13'),
(64, NULL, 'ip', '127.0.0.1', '2017-11-12 11:18:13', '2017-11-12 11:18:13'),
(65, 4, 'user', NULL, '2017-11-12 11:18:13', '2017-11-12 11:18:13'),
(66, NULL, 'global', NULL, '2017-11-12 11:19:22', '2017-11-12 11:19:22'),
(67, NULL, 'ip', '127.0.0.1', '2017-11-12 11:19:22', '2017-11-12 11:19:22'),
(68, 4, 'user', NULL, '2017-11-12 11:19:22', '2017-11-12 11:19:22'),
(69, NULL, 'global', NULL, '2017-11-12 12:21:15', '2017-11-12 12:21:15'),
(70, NULL, 'ip', '127.0.0.1', '2017-11-12 12:21:15', '2017-11-12 12:21:15'),
(71, 1, 'user', NULL, '2017-11-12 12:21:15', '2017-11-12 12:21:15'),
(72, NULL, 'global', NULL, '2017-11-12 12:30:54', '2017-11-12 12:30:54'),
(73, NULL, 'ip', '127.0.0.1', '2017-11-12 12:30:54', '2017-11-12 12:30:54'),
(74, 1, 'user', NULL, '2017-11-12 12:30:54', '2017-11-12 12:30:54'),
(75, NULL, 'global', NULL, '2017-11-12 12:31:09', '2017-11-12 12:31:09'),
(76, NULL, 'ip', '127.0.0.1', '2017-11-12 12:31:09', '2017-11-12 12:31:09'),
(77, 1, 'user', NULL, '2017-11-12 12:31:09', '2017-11-12 12:31:09'),
(78, NULL, 'global', NULL, '2017-11-12 19:20:51', '2017-11-12 19:20:51'),
(79, NULL, 'ip', '127.0.0.1', '2017-11-12 19:20:51', '2017-11-12 19:20:51'),
(80, NULL, 'global', NULL, '2017-11-12 19:20:51', '2017-11-12 19:20:51'),
(81, NULL, 'ip', '127.0.0.1', '2017-11-12 19:20:51', '2017-11-12 19:20:51'),
(82, NULL, 'global', NULL, '2017-11-12 19:20:52', '2017-11-12 19:20:52'),
(83, NULL, 'ip', '127.0.0.1', '2017-11-12 19:20:52', '2017-11-12 19:20:52'),
(84, NULL, 'global', NULL, '2017-11-12 19:20:52', '2017-11-12 19:20:52'),
(85, NULL, 'ip', '127.0.0.1', '2017-11-12 19:20:52', '2017-11-12 19:20:52'),
(86, NULL, 'global', NULL, '2017-11-12 19:20:52', '2017-11-12 19:20:52'),
(87, NULL, 'ip', '127.0.0.1', '2017-11-12 19:20:52', '2017-11-12 19:20:52'),
(88, NULL, 'global', NULL, '2017-11-12 19:20:52', '2017-11-12 19:20:52'),
(89, NULL, 'ip', '127.0.0.1', '2017-11-12 19:20:52', '2017-11-12 19:20:52'),
(90, NULL, 'global', NULL, '2017-11-12 19:24:30', '2017-11-12 19:24:30'),
(91, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:30', '2017-11-12 19:24:30'),
(92, NULL, 'global', NULL, '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(93, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(94, NULL, 'global', NULL, '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(95, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(96, NULL, 'global', NULL, '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(97, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(98, NULL, 'global', NULL, '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(99, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(100, NULL, 'global', NULL, '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(101, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:31', '2017-11-12 19:24:31'),
(102, NULL, 'global', NULL, '2017-11-12 19:24:32', '2017-11-12 19:24:32'),
(103, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:32', '2017-11-12 19:24:32'),
(104, NULL, 'global', NULL, '2017-11-12 19:24:32', '2017-11-12 19:24:32'),
(105, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:32', '2017-11-12 19:24:32'),
(106, NULL, 'global', NULL, '2017-11-12 19:24:32', '2017-11-12 19:24:32'),
(107, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:32', '2017-11-12 19:24:32'),
(108, NULL, 'global', NULL, '2017-11-12 19:24:33', '2017-11-12 19:24:33'),
(109, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:33', '2017-11-12 19:24:33'),
(110, NULL, 'global', NULL, '2017-11-12 19:24:33', '2017-11-12 19:24:33'),
(111, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:33', '2017-11-12 19:24:33'),
(112, NULL, 'global', NULL, '2017-11-12 19:24:33', '2017-11-12 19:24:33'),
(113, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:33', '2017-11-12 19:24:33'),
(114, NULL, 'global', NULL, '2017-11-12 19:24:33', '2017-11-12 19:24:33'),
(115, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:33', '2017-11-12 19:24:33'),
(116, NULL, 'global', NULL, '2017-11-12 19:24:34', '2017-11-12 19:24:34'),
(117, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:34', '2017-11-12 19:24:34'),
(118, NULL, 'global', NULL, '2017-11-12 19:24:34', '2017-11-12 19:24:34'),
(119, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:34', '2017-11-12 19:24:34'),
(120, NULL, 'global', NULL, '2017-11-12 19:24:34', '2017-11-12 19:24:34'),
(121, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:34', '2017-11-12 19:24:34'),
(122, NULL, 'global', NULL, '2017-11-12 19:24:35', '2017-11-12 19:24:35'),
(123, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:35', '2017-11-12 19:24:35'),
(124, NULL, 'global', NULL, '2017-11-12 19:24:35', '2017-11-12 19:24:35'),
(125, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:35', '2017-11-12 19:24:35'),
(126, NULL, 'global', NULL, '2017-11-12 19:24:35', '2017-11-12 19:24:35'),
(127, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:35', '2017-11-12 19:24:35'),
(128, NULL, 'global', NULL, '2017-11-12 19:24:35', '2017-11-12 19:24:35'),
(129, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:35', '2017-11-12 19:24:35'),
(130, NULL, 'global', NULL, '2017-11-12 19:24:39', '2017-11-12 19:24:39'),
(131, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:39', '2017-11-12 19:24:39'),
(132, NULL, 'global', NULL, '2017-11-12 19:24:40', '2017-11-12 19:24:40'),
(133, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:40', '2017-11-12 19:24:40'),
(134, NULL, 'global', NULL, '2017-11-12 19:24:40', '2017-11-12 19:24:40'),
(135, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:40', '2017-11-12 19:24:40'),
(136, NULL, 'global', NULL, '2017-11-12 19:24:40', '2017-11-12 19:24:40'),
(137, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:40', '2017-11-12 19:24:40'),
(138, NULL, 'global', NULL, '2017-11-12 19:24:40', '2017-11-12 19:24:40'),
(139, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:40', '2017-11-12 19:24:40'),
(140, NULL, 'global', NULL, '2017-11-12 19:24:41', '2017-11-12 19:24:41'),
(141, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:41', '2017-11-12 19:24:41'),
(142, NULL, 'global', NULL, '2017-11-12 19:24:41', '2017-11-12 19:24:41'),
(143, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:41', '2017-11-12 19:24:41'),
(144, NULL, 'global', NULL, '2017-11-12 19:24:41', '2017-11-12 19:24:41'),
(145, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:41', '2017-11-12 19:24:41'),
(146, NULL, 'global', NULL, '2017-11-12 19:24:41', '2017-11-12 19:24:41'),
(147, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:41', '2017-11-12 19:24:41'),
(148, NULL, 'global', NULL, '2017-11-12 19:24:42', '2017-11-12 19:24:42'),
(149, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:42', '2017-11-12 19:24:42'),
(150, NULL, 'global', NULL, '2017-11-12 19:24:42', '2017-11-12 19:24:42'),
(151, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:42', '2017-11-12 19:24:42'),
(152, NULL, 'global', NULL, '2017-11-12 19:24:42', '2017-11-12 19:24:42'),
(153, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:42', '2017-11-12 19:24:42'),
(154, NULL, 'global', NULL, '2017-11-12 19:24:42', '2017-11-12 19:24:42'),
(155, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:42', '2017-11-12 19:24:42'),
(156, NULL, 'global', NULL, '2017-11-12 19:24:43', '2017-11-12 19:24:43'),
(157, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:43', '2017-11-12 19:24:43'),
(158, NULL, 'global', NULL, '2017-11-12 19:24:43', '2017-11-12 19:24:43'),
(159, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:43', '2017-11-12 19:24:43'),
(160, NULL, 'global', NULL, '2017-11-12 19:24:43', '2017-11-12 19:24:43'),
(161, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:43', '2017-11-12 19:24:43'),
(162, NULL, 'global', NULL, '2017-11-12 19:24:44', '2017-11-12 19:24:44'),
(163, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:44', '2017-11-12 19:24:44'),
(164, NULL, 'global', NULL, '2017-11-12 19:24:44', '2017-11-12 19:24:44'),
(165, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:44', '2017-11-12 19:24:44'),
(166, NULL, 'global', NULL, '2017-11-12 19:24:44', '2017-11-12 19:24:44'),
(167, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:44', '2017-11-12 19:24:44'),
(168, NULL, 'global', NULL, '2017-11-12 19:24:44', '2017-11-12 19:24:44'),
(169, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:45', '2017-11-12 19:24:45'),
(170, NULL, 'global', NULL, '2017-11-12 19:24:45', '2017-11-12 19:24:45'),
(171, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:45', '2017-11-12 19:24:45'),
(172, NULL, 'global', NULL, '2017-11-12 19:24:45', '2017-11-12 19:24:45'),
(173, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:45', '2017-11-12 19:24:45'),
(174, NULL, 'global', NULL, '2017-11-12 19:24:45', '2017-11-12 19:24:45'),
(175, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:45', '2017-11-12 19:24:45'),
(176, NULL, 'global', NULL, '2017-11-12 19:24:45', '2017-11-12 19:24:45'),
(177, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:45', '2017-11-12 19:24:45'),
(178, NULL, 'global', NULL, '2017-11-12 19:24:46', '2017-11-12 19:24:46'),
(179, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:46', '2017-11-12 19:24:46'),
(180, NULL, 'global', NULL, '2017-11-12 19:24:46', '2017-11-12 19:24:46'),
(181, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:46', '2017-11-12 19:24:46'),
(182, NULL, 'global', NULL, '2017-11-12 19:24:46', '2017-11-12 19:24:46'),
(183, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:46', '2017-11-12 19:24:46'),
(184, NULL, 'global', NULL, '2017-11-12 19:24:46', '2017-11-12 19:24:46'),
(185, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:46', '2017-11-12 19:24:46'),
(186, NULL, 'global', NULL, '2017-11-12 19:24:47', '2017-11-12 19:24:47'),
(187, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:47', '2017-11-12 19:24:47'),
(188, NULL, 'global', NULL, '2017-11-12 19:24:47', '2017-11-12 19:24:47'),
(189, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:47', '2017-11-12 19:24:47'),
(190, NULL, 'global', NULL, '2017-11-12 19:24:47', '2017-11-12 19:24:47'),
(191, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:47', '2017-11-12 19:24:47'),
(192, NULL, 'global', NULL, '2017-11-12 19:24:48', '2017-11-12 19:24:48'),
(193, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:48', '2017-11-12 19:24:48'),
(194, NULL, 'global', NULL, '2017-11-12 19:24:48', '2017-11-12 19:24:48'),
(195, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:48', '2017-11-12 19:24:48'),
(196, NULL, 'global', NULL, '2017-11-12 19:24:48', '2017-11-12 19:24:48'),
(197, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:48', '2017-11-12 19:24:48'),
(198, NULL, 'global', NULL, '2017-11-12 19:24:49', '2017-11-12 19:24:49'),
(199, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:49', '2017-11-12 19:24:49'),
(200, NULL, 'global', NULL, '2017-11-12 19:24:49', '2017-11-12 19:24:49'),
(201, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:49', '2017-11-12 19:24:49'),
(202, NULL, 'global', NULL, '2017-11-12 19:24:49', '2017-11-12 19:24:49'),
(203, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:49', '2017-11-12 19:24:49'),
(204, NULL, 'global', NULL, '2017-11-12 19:24:50', '2017-11-12 19:24:50'),
(205, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:50', '2017-11-12 19:24:50'),
(206, NULL, 'global', NULL, '2017-11-12 19:24:50', '2017-11-12 19:24:50'),
(207, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:50', '2017-11-12 19:24:50'),
(208, NULL, 'global', NULL, '2017-11-12 19:24:50', '2017-11-12 19:24:50'),
(209, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:50', '2017-11-12 19:24:50'),
(210, NULL, 'global', NULL, '2017-11-12 19:24:51', '2017-11-12 19:24:51'),
(211, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:51', '2017-11-12 19:24:51'),
(212, NULL, 'global', NULL, '2017-11-12 19:24:51', '2017-11-12 19:24:51'),
(213, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:51', '2017-11-12 19:24:51'),
(214, NULL, 'global', NULL, '2017-11-12 19:24:57', '2017-11-12 19:24:57'),
(215, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:57', '2017-11-12 19:24:57'),
(216, NULL, 'global', NULL, '2017-11-12 19:24:57', '2017-11-12 19:24:57'),
(217, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:57', '2017-11-12 19:24:57'),
(218, NULL, 'global', NULL, '2017-11-12 19:24:57', '2017-11-12 19:24:57'),
(219, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:57', '2017-11-12 19:24:57'),
(220, NULL, 'global', NULL, '2017-11-12 19:24:57', '2017-11-12 19:24:57'),
(221, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:57', '2017-11-12 19:24:57'),
(222, NULL, 'global', NULL, '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(223, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(224, NULL, 'global', NULL, '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(225, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(226, NULL, 'global', NULL, '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(227, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(228, NULL, 'global', NULL, '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(229, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(230, NULL, 'global', NULL, '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(231, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:58', '2017-11-12 19:24:58'),
(232, NULL, 'global', NULL, '2017-11-12 19:24:59', '2017-11-12 19:24:59'),
(233, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:59', '2017-11-12 19:24:59'),
(234, NULL, 'global', NULL, '2017-11-12 19:24:59', '2017-11-12 19:24:59'),
(235, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:59', '2017-11-12 19:24:59'),
(236, NULL, 'global', NULL, '2017-11-12 19:24:59', '2017-11-12 19:24:59'),
(237, NULL, 'ip', '127.0.0.1', '2017-11-12 19:24:59', '2017-11-12 19:24:59'),
(238, NULL, 'global', NULL, '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(239, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(240, NULL, 'global', NULL, '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(241, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(242, NULL, 'global', NULL, '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(243, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(244, NULL, 'global', NULL, '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(245, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(246, NULL, 'global', NULL, '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(247, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:00', '2017-11-12 19:25:00'),
(248, NULL, 'global', NULL, '2017-11-12 19:25:01', '2017-11-12 19:25:01'),
(249, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:01', '2017-11-12 19:25:01'),
(250, NULL, 'global', NULL, '2017-11-12 19:25:01', '2017-11-12 19:25:01'),
(251, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:01', '2017-11-12 19:25:01'),
(252, NULL, 'global', NULL, '2017-11-12 19:25:01', '2017-11-12 19:25:01'),
(253, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:01', '2017-11-12 19:25:01'),
(254, NULL, 'global', NULL, '2017-11-12 19:25:02', '2017-11-12 19:25:02'),
(255, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:02', '2017-11-12 19:25:02'),
(256, NULL, 'global', NULL, '2017-11-12 19:25:32', '2017-11-12 19:25:32'),
(257, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:32', '2017-11-12 19:25:32'),
(258, NULL, 'global', NULL, '2017-11-12 19:25:32', '2017-11-12 19:25:32'),
(259, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:32', '2017-11-12 19:25:32'),
(260, NULL, 'global', NULL, '2017-11-12 19:25:32', '2017-11-12 19:25:32'),
(261, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:32', '2017-11-12 19:25:32'),
(262, NULL, 'global', NULL, '2017-11-12 19:25:33', '2017-11-12 19:25:33'),
(263, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:33', '2017-11-12 19:25:33'),
(264, NULL, 'global', NULL, '2017-11-12 19:25:33', '2017-11-12 19:25:33'),
(265, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:33', '2017-11-12 19:25:33'),
(266, NULL, 'global', NULL, '2017-11-12 19:25:33', '2017-11-12 19:25:33'),
(267, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:33', '2017-11-12 19:25:33'),
(268, NULL, 'global', NULL, '2017-11-12 19:25:34', '2017-11-12 19:25:34'),
(269, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:34', '2017-11-12 19:25:34'),
(270, NULL, 'global', NULL, '2017-11-12 19:25:34', '2017-11-12 19:25:34'),
(271, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:34', '2017-11-12 19:25:34'),
(272, NULL, 'global', NULL, '2017-11-12 19:25:34', '2017-11-12 19:25:34'),
(273, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:34', '2017-11-12 19:25:34'),
(274, NULL, 'global', NULL, '2017-11-12 19:25:34', '2017-11-12 19:25:34'),
(275, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:34', '2017-11-12 19:25:34'),
(276, NULL, 'global', NULL, '2017-11-12 19:25:35', '2017-11-12 19:25:35'),
(277, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:35', '2017-11-12 19:25:35'),
(278, NULL, 'global', NULL, '2017-11-12 19:25:35', '2017-11-12 19:25:35'),
(279, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:35', '2017-11-12 19:25:35'),
(280, NULL, 'global', NULL, '2017-11-12 19:25:35', '2017-11-12 19:25:35'),
(281, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:35', '2017-11-12 19:25:35'),
(282, NULL, 'global', NULL, '2017-11-12 19:25:35', '2017-11-12 19:25:35'),
(283, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:35', '2017-11-12 19:25:35'),
(284, NULL, 'global', NULL, '2017-11-12 19:25:36', '2017-11-12 19:25:36'),
(285, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:36', '2017-11-12 19:25:36'),
(286, NULL, 'global', NULL, '2017-11-12 19:25:36', '2017-11-12 19:25:36'),
(287, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:36', '2017-11-12 19:25:36'),
(288, NULL, 'global', NULL, '2017-11-12 19:25:36', '2017-11-12 19:25:36'),
(289, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:36', '2017-11-12 19:25:36'),
(290, NULL, 'global', NULL, '2017-11-12 19:25:37', '2017-11-12 19:25:37'),
(291, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:37', '2017-11-12 19:25:37'),
(292, NULL, 'global', NULL, '2017-11-12 19:25:37', '2017-11-12 19:25:37'),
(293, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:37', '2017-11-12 19:25:37'),
(294, NULL, 'global', NULL, '2017-11-12 19:25:37', '2017-11-12 19:25:37'),
(295, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:37', '2017-11-12 19:25:37'),
(296, NULL, 'global', NULL, '2017-11-12 19:25:37', '2017-11-12 19:25:37'),
(297, NULL, 'ip', '127.0.0.1', '2017-11-12 19:25:37', '2017-11-12 19:25:37'),
(298, NULL, 'global', NULL, '2017-11-12 19:36:41', '2017-11-12 19:36:41'),
(299, NULL, 'ip', '127.0.0.1', '2017-11-12 19:36:41', '2017-11-12 19:36:41'),
(300, 4, 'user', NULL, '2017-11-12 19:36:41', '2017-11-12 19:36:41'),
(301, NULL, 'global', NULL, '2017-11-12 19:44:35', '2017-11-12 19:44:35'),
(302, NULL, 'ip', '127.0.0.1', '2017-11-12 19:44:35', '2017-11-12 19:44:35'),
(303, 1, 'user', NULL, '2017-11-12 19:44:35', '2017-11-12 19:44:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_member_id` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `group_member_id`, `password`, `permissions`, `last_login`, `fullname`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'diennk@dienkim.com', 1, '$2y$10$rpZe6oM3GUJmwL/ZMTKm/OSe24l9TJKFU9lwd8VmohkqH0Oax6rVK', NULL, '2017-11-13 06:37:54', 'Nguyễn Kim Điền', 1, 1, '2017-11-12 07:23:56', '2017-11-13 06:37:54'),
(4, 'trietnk', 'trietnk@dienkim.com', 1, '$2y$10$0zm9JjK..Cr6zZSzlhxrbuCQAHSy1HjptXb5.02PIzDNubHYD0dje', NULL, '2017-11-12 20:47:22', 'Nguyễn Kim Triết', 2, 0, '2017-11-12 10:59:09', '2017-11-12 20:47:40');

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
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
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
-- Chỉ mục cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `persistences`
--
ALTER TABLE `persistences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persistences_code_unique` (`code`);

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
-- Chỉ mục cho bảng `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Chỉ mục cho bảng `setting_system`
--
ALTER TABLE `setting_system`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT cho bảng `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT cho bảng `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `setting_system`
--
ALTER TABLE `setting_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
