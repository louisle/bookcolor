-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2016 at 05:23 AM
-- Server version: 5.6.32
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bookcolor`
--

-- --------------------------------------------------------

--
-- Table structure for table `caro_phase`
--

CREATE TABLE IF NOT EXISTS `caro_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `childrentCount` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `side` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `caro_phase`
--

INSERT INTO `caro_phase` (`id`, `parent`, `childrentCount`, `x`, `y`, `side`) VALUES
(1, 0, 1, 2, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cf_article`
--

CREATE TABLE IF NOT EXISTS `cf_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `cf_article`
--

INSERT INTO `cf_article` (`id`, `url`, `title`, `content`, `status`, `create_at`, `update_at`) VALUES
(12, 'banh-ga-to-nhan-socola-a', 'Bánh ga to nhân socola a', '<p>adawdawdad</p>', 0, 1474512482, 1478074701),
(13, 'banh-chung-chung', 'Bánh chung chung', '<p>đă a</p>', 0, 1474516570, 1474622518),
(14, 'test', 'test', '<p>test</p>', 1, 1474538691, 1478075508),
(15, 'banh-tag', 'bánh tag', '<p>dăd</p>', 0, 1474604882, 1474621217),
(16, 'banh-ga-to-nhan-socola-edit', 'Bánh ga to nhân socola edit', '<p>adawdawdad</p>', 0, 1474604927, 1474604927),
(17, 'banh-ga-to-nhan-socola-edit', 'Bánh ga to nhân socola edit', '<p>adawdawdad</p>', 0, 1474605028, 1474605028),
(18, 'banh-ga-to-nhan-socola-edit', 'Bánh ga to nhân socola edit', '<p>adawdawdad</p>', 0, 1474605034, 1474605034),
(19, 'banh-ga-to-nhan-socola-edit', 'Bánh ga to nhân socola edit', '<p>adawdawdad</p>', 0, 1474605046, 1474605046),
(20, 'banh-ga-to-nhan-socola', 'Bánh ga to nhân socola', '<p>adawdawdad</p>', 0, 1474605057, 1474605057),
(21, 'banh-ga-to-nhan-socola', 'Bánh ga to nhân socola', '<p>adawdawdad</p>', 0, 1474605082, 1474605082),
(22, 'banh-ga-to-nhan-socola', 'Bánh ga to nhân socola', '<p>adawdawdad</p>', 0, 1474605092, 1478665766),
(23, 'banh-ga-to-nhan-socola', 'Bánh ga to nhân socola', '<p>adawdawdad</p>', 0, 1474605100, 1478665978),
(24, 'test', 'test', '<p>aaa</p>', 1, 1478665950, 1478665950);

-- --------------------------------------------------------

--
-- Table structure for table `cf_article_blog`
--

CREATE TABLE IF NOT EXISTS `cf_article_blog` (
  `article_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`blog_id`),
  KEY `IDX_D5F71A8B7294869C` (`article_id`),
  KEY `IDX_D5F71A8BDAE07E97` (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cf_article_blog`
--

INSERT INTO `cf_article_blog` (`article_id`, `blog_id`) VALUES
(12, 14),
(12, 15),
(12, 16),
(12, 17),
(12, 18),
(12, 19),
(12, 20),
(12, 21),
(12, 22),
(12, 23),
(12, 24),
(12, 25),
(12, 26),
(12, 27),
(12, 28),
(12, 29),
(12, 30),
(12, 31),
(12, 32),
(12, 33),
(12, 34),
(12, 35),
(12, 36),
(12, 37),
(12, 38),
(12, 39),
(12, 40),
(12, 41),
(12, 42),
(12, 43),
(12, 44),
(12, 45),
(12, 46),
(12, 47),
(12, 48),
(12, 49),
(12, 50),
(12, 51),
(12, 52),
(12, 53),
(12, 54),
(12, 55),
(12, 56),
(12, 57),
(12, 58),
(12, 59),
(12, 60),
(12, 61),
(12, 62),
(12, 63),
(12, 64),
(12, 65),
(13, 14),
(13, 15),
(14, 65),
(15, 14),
(22, 14),
(22, 15),
(22, 16),
(22, 17),
(22, 18),
(23, 63),
(23, 65),
(24, 15),
(24, 18),
(24, 19);

-- --------------------------------------------------------

--
-- Table structure for table `cf_article_tags`
--

CREATE TABLE IF NOT EXISTS `cf_article_tags` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`,`article_id`),
  KEY `IDX_7A5EDFEE7294869C` (`article_id`),
  KEY `IDX_7A5EDFEEBAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cf_article_tags`
--

INSERT INTO `cf_article_tags` (`article_id`, `tag_id`) VALUES
(12, 10),
(12, 11),
(12, 12),
(12, 16),
(13, 14),
(14, 14),
(22, 14),
(23, 25),
(23, 26),
(24, 25),
(24, 26);

-- --------------------------------------------------------

--
-- Table structure for table `cf_blog`
--

CREATE TABLE IF NOT EXISTS `cf_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL,
  `total_article` int(11) DEFAULT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

--
-- Dumping data for table `cf_blog`
--

INSERT INTO `cf_blog` (`id`, `status`, `total_article`, `url`, `title`, `create_at`, `update_at`) VALUES
(14, 1, 0, 'banh-kem', 'Bánh kem', 1474511909, 1478072079),
(15, 1, 0, 'banh-nuong', 'Bánh nướng', 1474511919, 1474516484),
(16, 0, 0, 'blog-1', 'BLog 1', 1474876420, 1474876420),
(17, 0, 0, 'blog-1', 'BLog 1', 1474876420, 1474876420),
(18, 0, 0, 'blog-1', 'BLog 1', 1474876420, 1474876420),
(19, 0, 0, 'blog-1', 'BLog 2', 1474876420, 1474876420),
(20, 0, 0, 'blog-1', 'BLog 3', 1474876420, 1474876420),
(21, 0, 0, 'blog-1', 'BLog 4', 1474876420, 1474876420),
(22, 0, 0, 'blog-1', 'BLog 5', 1474876420, 1474876420),
(23, 0, 0, 'blog-1', 'BLog 6', 1474876420, 1474876420),
(24, 0, 0, 'blog-1', 'BLog 7', 1474876420, 1474876420),
(25, 0, 0, 'blog-1', 'BLog 87', 1474876420, 1474876420),
(26, 0, 0, 'blog-1', 'BLog 98', 1474876420, 1474876420),
(27, 0, 0, 'blog-1', 'BLog 19', 1474876420, 1474876420),
(28, 0, 0, 'blog-1', 'BLog 110', 1474876420, 1474876420),
(29, 0, 0, 'blog-1', 'BLog 111', 1474876420, 1474876420),
(30, 0, 0, 'blog-1', 'BLog 112', 1474876420, 1474876420),
(31, 0, 0, 'blog-1', 'BLog 113', 1474876420, 1474876420),
(32, 0, 0, 'blog-1', 'BLog 114', 1474876420, 1474876420),
(33, 0, 0, 'blog-1', 'BLog 115', 1474876420, 1474876420),
(34, 0, 0, 'blog-1', 'BLog 116', 1474876420, 1474876420),
(35, 0, 0, 'blog-1', 'BLog 117', 1474876420, 1474876420),
(36, 0, 0, 'blog-1', 'BLog 118', 1474876420, 1474876420),
(37, 0, 0, 'blog-1', 'BLog 119', 1474876420, 1474876420),
(38, 0, 0, 'blog-1', 'BLog 120', 1474876420, 1474876420),
(39, 0, 0, 'blog-1', 'BLog 121', 1474876420, 1474876420),
(40, 0, 0, 'blog-1', 'BLog 122', 1474876420, 1474876420),
(41, 0, 0, 'blog-1', 'BLog 123', 1474876420, 1474876420),
(42, 0, 0, 'blog-1', 'BLog 124', 1474876420, 1474876420),
(43, 0, 0, 'blog-1', 'BLog 125', 1474876420, 1474876420),
(44, 0, 0, 'blog-1', 'BLog 126', 1474876420, 1474876420),
(45, 0, 0, 'blog-1', 'BLog 127', 1474876420, 1474876420),
(46, 0, 0, 'blog-1', 'BLog 128', 1474876420, 1474876420),
(47, 0, 0, 'blog-1', 'BLog 129', 1474876420, 1474876420),
(48, 0, 0, 'blog-1', 'BLog 130', 1474876420, 1474876420),
(49, 0, 0, 'blog-1', 'BLog 131', 1474876420, 1474876420),
(50, 0, 0, 'blog-1', 'BLog 132', 1474876420, 1474876420),
(51, 0, 0, 'blog-1', 'BLog 133', 1474876420, 1474876420),
(52, 0, 0, 'blog-1', 'BLog 134', 1474876420, 1474876420),
(53, 0, 0, 'blog-1', 'BLog 135', 1474876420, 1474876420),
(54, 0, 0, 'blog-1', 'BLog 136', 1474876420, 1474876420),
(55, 0, 0, 'blog-1', 'BLog 137', 1474876420, 1474876420),
(56, 0, 0, 'blog-1', 'BLog 138', 1474876420, 1474876420),
(57, 0, 0, 'blog-1', 'BLog 139', 1474876420, 1474876420),
(58, 0, 0, 'blog-1', 'BLog 140', 1474876420, 1474876420),
(59, 0, 0, 'blog-1', 'BLog 141', 1474876420, 1474876420),
(60, 0, 0, 'blog-1', 'BLog 142', 1474876420, 1474876420),
(61, 0, 0, 'blog-1', 'BLog 143', 1474876420, 1474876420),
(62, 0, 0, 'blog-1', 'BLog 144', 1474876420, 1474876420),
(63, 0, 0, 'blog-1', 'BLog 145', 1474876420, 1474876420),
(64, 0, 0, 'blog-1', 'BLog 146', 1474876420, 1474876420),
(65, 1, 0, 'qua-tang', 'Quà tặng', 1474876420, 1478659853);

-- --------------------------------------------------------

--
-- Table structure for table `cf_category`
--

CREATE TABLE IF NOT EXISTS `cf_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `total_product` int(11) DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cf_config`
--

CREATE TABLE IF NOT EXISTS `cf_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cf_image`
--

CREATE TABLE IF NOT EXISTS `cf_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `path` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2DE7488E4584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cf_link`
--

CREATE TABLE IF NOT EXISTS `cf_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `target_type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `target_id` int(11) NOT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_54347BB6727ACA70` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cf_link`
--

INSERT INTO `cf_link` (`id`, `parent_id`, `title`, `target_type`, `target_id`, `create_at`, `update_at`, `status`) VALUES
(0, NULL, 'Gốc', '', -1, NULL, NULL, NULL),
(1, 0, 'Bánh kem', 'ARTICLE', 20, 1478668305, 1478668305, NULL),
(2, 1, 'link test 2', 'BLOG', 59, 1478668740, 1478668740, NULL),
(3, 0, 'aa', 'ARTICLE', 20, 1478684461, 1478684461, NULL),
(4, 0, 'aa', 'ARTICLE', 20, 1478684490, 1478684490, NULL),
(5, 0, 'aa', 'ARTICLE', 20, 1478684654, 1478684654, NULL),
(7, 0, 'test', 'ARTICLE', 23, 1478753492, 1478753492, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cf_product`
--

CREATE TABLE IF NOT EXISTS `cf_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `compare_price` int(11) NOT NULL,
  `inventory` int(11) NOT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cf_tag`
--

CREATE TABLE IF NOT EXISTS `cf_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `cf_tag`
--

INSERT INTO `cf_tag` (`id`, `url`, `title`, `create_at`, `update_at`) VALUES
(10, 'tag1', 'tag1', 1474512482, 1474606493),
(11, 'tag2', 'tag2', 1474512482, 1474606493),
(12, 'banh', 'bánh', 1474516570, 1474614465),
(13, 'ga-vit', 'gà vịt', 1474516570, 1474516570),
(14, '', '', 1474538691, 1474538691),
(15, 'banh-tag', 'bánh tag', 1474604882, 1474604882),
(16, 'tag', 'tag', 1474606358, 1474606493),
(17, 'choom-chom', 'choom chom', 1474620365, 1474620365),
(18, 'a', 'a', 1474620394, 1474620394),
(19, 'cho-meo', 'cho meo', 1474621690, 1474621690),
(20, 'bbb', 'bbb', 1474622179, 1474622179),
(21, 'dddd', 'dddd', 1474622228, 1474622228),
(22, 'dddddd', 'dddddd', 1474622338, 1474622338),
(23, 'eeee', 'eeee', 1474622375, 1474622375),
(24, 'jjj', 'jjj', 1474622500, 1474622500),
(25, 'abc', 'abc', 1478665950, 1478665950),
(26, 'deg', 'deg', 1478665950, 1478665950);

-- --------------------------------------------------------

--
-- Table structure for table `cf_user`
--

CREATE TABLE IF NOT EXISTS `cf_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EF0B340EF85E0677` (`username`),
  UNIQUE KEY `UNIQ_EF0B340EE7927C74` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cf_user`
--

INSERT INTO `cf_user` (`id`, `username`, `password`, `email`, `avatar`, `address`, `type`, `create_at`, `update_at`, `status`) VALUES
(1, 'Lê Hoàng Vũ', 'e10adc3949ba59abbe56e057f20f883e', 'hoangvu171819@gmail.com', '1.jpg', NULL, 1, 1467379678, 1467379678, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `IDX_CDFC73564584665A` (`product_id`),
  KEY `IDX_CDFC735612469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cf_article_blog`
--
ALTER TABLE `cf_article_blog`
  ADD CONSTRAINT `FK_D5F71A8B7294869C` FOREIGN KEY (`article_id`) REFERENCES `cf_article` (`id`),
  ADD CONSTRAINT `FK_D5F71A8BDAE07E97` FOREIGN KEY (`blog_id`) REFERENCES `cf_blog` (`id`);

--
-- Constraints for table `cf_article_tags`
--
ALTER TABLE `cf_article_tags`
  ADD CONSTRAINT `FK_7A5EDFEE7294869C` FOREIGN KEY (`article_id`) REFERENCES `cf_article` (`id`),
  ADD CONSTRAINT `FK_7A5EDFEEBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `cf_tag` (`id`);

--
-- Constraints for table `cf_image`
--
ALTER TABLE `cf_image`
  ADD CONSTRAINT `FK_2DE7488E4584665A` FOREIGN KEY (`product_id`) REFERENCES `cf_product` (`id`);

--
-- Constraints for table `cf_link`
--
ALTER TABLE `cf_link`
  ADD CONSTRAINT `FK_54347BB6727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `cf_link` (`id`);

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `FK_CDFC735612469DE2` FOREIGN KEY (`category_id`) REFERENCES `cf_category` (`id`),
  ADD CONSTRAINT `FK_CDFC73564584665A` FOREIGN KEY (`product_id`) REFERENCES `cf_product` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
