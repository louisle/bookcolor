-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2016 at 09:52 PM
-- Server version: 5.6.32
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bookcolor`
--

-- --------------------------------------------------------

--
-- Table structure for table `cf_site`
--

CREATE TABLE IF NOT EXISTS `cf_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `domain` text COLLATE utf8_unicode_ci NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BDBEBA359027487` (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cf_site`
--

INSERT INTO `cf_site` (`id`, `name`, `status`, `create_at`, `update_at`, `domain`, `theme_id`) VALUES
(1, 'Cifire', 1, 0, 0, 'http://cifire.dev', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cf_site`
--
ALTER TABLE `cf_site`
  ADD CONSTRAINT `FK_BDBEBA359027487` FOREIGN KEY (`theme_id`) REFERENCES `cf_theme` (`id`);
