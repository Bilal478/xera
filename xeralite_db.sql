-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2023 at 03:42 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xeralite_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `xb_posts`
--

DROP TABLE IF EXISTS `xb_posts`;
CREATE TABLE IF NOT EXISTS `xb_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(6000) NOT NULL,
  `picture` varchar(252) NOT NULL,
  `created_At` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xb_posts`
--

INSERT INTO `xb_posts` (`id`, `user_id`, `title`, `picture`, `created_At`) VALUES
(55, 16, '', '22406WhatsApp Image 2022-12-27 at 11.10.01 AM.jpeg', '2023-01-11 18:58:45'),
(54, 16, '', '62462WhatsApp Image 2022-12-27 at 11.10.01 AM.jpeg', '2023-01-11 18:58:43'),
(53, 16, '', '67353WhatsApp Image 2022-12-27 at 11.10.01 AM.jpeg', '2023-01-11 18:58:40'),
(52, 16, '', '5469WhatsApp Image 2022-12-27 at 11.10.01 AM.jpeg', '2023-01-11 18:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `xb_sessions`
--

DROP TABLE IF EXISTS `xb_sessions`;
CREATE TABLE IF NOT EXISTS `xb_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `session_id` varchar(20) NOT NULL DEFAULT '',
  `platform` varchar(32) NOT NULL DEFAULT '',
  `ip_address` varchar(20) NOT NULL,
  `time_created` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_id` (`session_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xb_sessions`
--

INSERT INTO `xb_sessions` (`id`, `user_id`, `session_id`, `platform`, `ip_address`, `time_created`) VALUES
(239, 5, '1Q1EvtBQTsTlhGxV', 'Desktop', '::1', 1673208120),
(240, 16, 'H32lmKdpHg3Sy0ch', 'Desktop', '::1', 1673247671);

-- --------------------------------------------------------

--
-- Table structure for table `xb_users`
--

DROP TABLE IF EXISTS `xb_users`;
CREATE TABLE IF NOT EXISTS `xb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(32) NOT NULL DEFAULT '',
  `sponsor_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(70) NOT NULL DEFAULT '',
  `first_name` varchar(60) NOT NULL DEFAULT '',
  `last_name` varchar(32) NOT NULL DEFAULT '',
  `avatar` varchar(100) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `background_image` varchar(100) NOT NULL DEFAULT '',
  `relationship_id` int(11) NOT NULL DEFAULT '0',
  `address` varchar(100) NOT NULL DEFAULT '',
  `working` varchar(32) NOT NULL DEFAULT '',
  `about` varchar(400) DEFAULT NULL,
  `school` varchar(32) NOT NULL DEFAULT '',
  `profession` varchar(150) DEFAULT NULL,
  `gender` varchar(32) NOT NULL DEFAULT 'male',
  `birthday` varchar(50) NOT NULL DEFAULT '0000-00-00',
  `country_id` int(11) NOT NULL DEFAULT '0',
  `website` varchar(50) NOT NULL DEFAULT '',
  `facebook` varchar(50) NOT NULL DEFAULT '',
  `google` varchar(50) NOT NULL DEFAULT '',
  `twitter` varchar(50) NOT NULL DEFAULT '',
  `linkedin` varchar(32) NOT NULL DEFAULT '',
  `youtube` varchar(100) NOT NULL DEFAULT '',
  `vk` varchar(32) NOT NULL DEFAULT '',
  `instagram` varchar(100) NOT NULL DEFAULT '',
  `qq` varchar(100) DEFAULT NULL,
  `wechat` varchar(100) DEFAULT NULL,
  `discord` varchar(100) DEFAULT NULL,
  `language` varchar(31) NOT NULL DEFAULT 'english',
  `email_code` varchar(32) NOT NULL DEFAULT '',
  `src` varchar(32) NOT NULL DEFAULT 'Undefined',
  `ip_address` varchar(32) DEFAULT '',
  `follow_privacy` enum('1','0') NOT NULL DEFAULT '0',
  `message_privacy` enum('1','0','2') NOT NULL DEFAULT '0',
  `confirm_followers` enum('1','0') NOT NULL DEFAULT '0',
  `verified` enum('1','0') NOT NULL DEFAULT '0',
  `level_access` int(11) NOT NULL DEFAULT '1',
  `lastseen` int(32) NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `active` enum('0','1','2') NOT NULL DEFAULT '0',
  `phone_number` varchar(32) NOT NULL DEFAULT '',
  `sms_code` int(11) NOT NULL DEFAULT '0',
  `is_pro` enum('0','1') NOT NULL DEFAULT '0',
  `pro_type` int(11) NOT NULL DEFAULT '0',
  `joined` int(11) NOT NULL DEFAULT '0',
  `timezone` varchar(50) NOT NULL DEFAULT '',
  `notifications_sound` enum('0','1') NOT NULL DEFAULT '0',
  `social_login` enum('0','1') NOT NULL DEFAULT '0',
  `lat` varchar(200) NOT NULL DEFAULT '0',
  `lng` varchar(200) NOT NULL DEFAULT '0',
  `last_follow_id` int(11) NOT NULL DEFAULT '0',
  `two_factor` int(11) NOT NULL DEFAULT '0',
  `new_email` varchar(255) NOT NULL DEFAULT '',
  `two_factor_verified` int(11) NOT NULL DEFAULT '0',
  `city` varchar(50) NOT NULL DEFAULT '',
  `state` varchar(50) NOT NULL DEFAULT '',
  `zipcode` int(11) NOT NULL DEFAULT '0',
  `school_completed` int(11) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `active` (`active`),
  KEY `src` (`src`),
  KEY `gender` (`gender`),
  KEY `avatar` (`avatar`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `joined` (`joined`),
  KEY `phone_number` (`phone_number`) USING BTREE,
  KEY `lat` (`lat`),
  KEY `lng` (`lng`),
  KEY `order1` (`username`,`id`),
  KEY `order2` (`email`,`id`),
  KEY `order3` (`lastseen`,`id`),
  KEY `order4` (`active`,`id`),
  KEY `email` (`email`) USING BTREE,
  KEY `username` (`username`) USING BTREE,
  KEY `date_created` (`date_created`),
  KEY `site_id` (`site_id`),
  KEY `pro_type` (`pro_type`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `xb_users`
--

INSERT INTO `xb_users` (`id`, `site_id`, `username`, `sponsor_id`, `email`, `password`, `first_name`, `last_name`, `avatar`, `cover`, `background_image`, `relationship_id`, `address`, `working`, `about`, `school`, `profession`, `gender`, `birthday`, `country_id`, `website`, `facebook`, `google`, `twitter`, `linkedin`, `youtube`, `vk`, `instagram`, `qq`, `wechat`, `discord`, `language`, `email_code`, `src`, `ip_address`, `follow_privacy`, `message_privacy`, `confirm_followers`, `verified`, `level_access`, `lastseen`, `status`, `active`, `phone_number`, `sms_code`, `is_pro`, `pro_type`, `joined`, `timezone`, `notifications_sound`, `social_login`, `lat`, `lng`, `last_follow_id`, `two_factor`, `new_email`, `two_factor_verified`, `city`, `state`, `zipcode`, `school_completed`, `date_created`) VALUES
(1, 1, 'xproject', 1, 'wmg2009@gmail.com', '$2y$10$hVerhWrFNaLUdxlMgDM03eOKNm304kQfnjTuIXDWEtME0ZiiovsLi', 'CliffordX', 'Clarke', '1671882585.png,', '', '', 0, '', '', NULL, '', 'Software engineer and founder of Xera Tech Startup', 'male', '0000-00-00', 159, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'english', '', 'Undefined', '127.0.0.1', '0', '0', '0', '0', 7, 0, '0', '1', '08132118447', 0, '0', 0, 0, '', '0', '0', '0', '0', 0, 0, '', 0, '', '', 0, 0, 1631729657),
(2, 1, 'gilbert', 0, 'gilbertclarke@gmail.com', '$2y$10$YiOmwCiPFiVsbQjDL7/MW.AyXu3u34QDyJ9nBFEy0adGHIyQKgXiS', 'Gilbert', 'Clarke', '', '', '', 0, '', '', NULL, '', NULL, 'male', '0000-00-00', 159, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'english', '', 'Undefined', '::1', '0', '0', '0', '0', 1, 0, '0', '1', '', 0, '1', 0, 0, '', '0', '0', '0', '0', 0, 0, '', 0, '', '', 0, 0, 1635114527),
(5, 1, 'prosper', 0, 'contact@xera.ng', '$2y$10$YiOmwCiPFiVsbQjDL7/MW.AyXu3u34QDyJ9nBFEy0adGHIyQKgXiS', 'Ovie', 'ClarkeX', '1642892347.jpg,', '', '', 0, '2 Onekpo Road Ugbeyiyi', '', 'Former corporate sales wizard turned dharma bum. Trying to see things clearly. Twenty years of meditation. Still not Enlightened.\r\n\r\nI help professionals sound like the leaders they already are. Visit me at truestoryconsulting.com.', '', 'Web Developer and Designer', 'male', '1979-07-16', 159, '', 'http://facebook.com/cliff', '', 'http://twitter.com/cliff', '', 'http://youtube.com/cliffy', '', 'http://instagram.com/cliff', NULL, NULL, NULL, 'english', '', 'Undefined', '::1', '0', '0', '0', '1', 7, 1628570996, '0', '1', '08132118447', 0, '1', 0, 1623206514, '', '0', '0', '5.875415', '5.701188', 0, 0, '', 0, 'Sapele', 'Delta State', 23401, 0, 0),
(16, 4, '478bilal', 0, '478bilal@gmail.com', '$2y$10$QWVP1LzkX.aTlkGidcf.KuwVmr4smXUdhjBvQj4T8IZjvjnXCZM7C', 'Gilbert', 'Clarke', NULL, NULL, '', 0, '', '', NULL, '', NULL, 'male', '0000-00-00', 0, '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'english', '', 'Undefined', '::1', '0', '0', '0', '0', 1, 0, '0', '1', '', 0, '1', 0, 0, '', '0', '0', '0', '0', 0, 0, '', 0, '', '', 0, 0, 1651271435);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
