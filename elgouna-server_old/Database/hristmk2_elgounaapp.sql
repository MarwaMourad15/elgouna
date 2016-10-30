-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2016 at 01:45 AM
-- Server version: 5.5.42-37.1-log
-- PHP Version: 5.4.31

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hristmk2_elgounaapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `beaches`
--

DROP TABLE IF EXISTS `beaches`;
CREATE TABLE IF NOT EXISTS `beaches` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `location` text CHARACTER SET utf8 NOT NULL,
  `longitude` text CHARACTER SET utf8 NOT NULL,
  `latitude` text CHARACTER SET utf8 NOT NULL,
  `reviewScore` float NOT NULL,
  `ratingStar` int(11) NOT NULL,
  `offerExists` int(11) NOT NULL,
  `descrip` text CHARACTER SET utf8 NOT NULL,
  `offerTitle` text NOT NULL,
  `offerDescription` text CHARACTER SET utf8 NOT NULL,
  `isPoolAvailable` int(11) NOT NULL,
  `isGymAvailable` int(11) NOT NULL,
  `isWifiAvailable` int(11) NOT NULL,
  `isVisaPaymentAvailable` int(11) NOT NULL,
  `isDiningInAvailable` int(11) NOT NULL,
  `accomadtionType` text CHARACTER SET utf8 NOT NULL,
  `elgounaVoice` text CHARACTER SET utf8 NOT NULL,
  `email` text CHARACTER SET utf8 NOT NULL,
  `phoneNumber` text CHARACTER SET utf8 NOT NULL,
  `info` text CHARACTER SET utf8 NOT NULL,
  `facebookLink` text CHARACTER SET utf8 NOT NULL,
  `twitterLink` text CHARACTER SET utf8 NOT NULL,
  `instagramLink` text CHARACTER SET utf8 NOT NULL,
  `youtubeLink` text CHARACTER SET utf8 NOT NULL,
  `ord` int(11) NOT NULL,
  `hidden` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `beaches`
--

INSERT INTO `beaches` (`id`, `name`, `location`, `longitude`, `latitude`, `reviewScore`, `ratingStar`, `offerExists`, `descrip`, `offerTitle`, `offerDescription`, `isPoolAvailable`, `isGymAvailable`, `isWifiAvailable`, `isVisaPaymentAvailable`, `isDiningInAvailable`, `accomadtionType`, `elgounaVoice`, `email`, `phoneNumber`, `info`, `facebookLink`, `twitterLink`, `instagramLink`, `youtubeLink`, `ord`, `hidden`) VALUES
(1, 'Ali Pasha Hotel', 'El-Gouna', '33.673457', '27.406404', 0, 4, 0, 'Ali Pasha Hotel is located in the Abu Tig Marina, one of El Gouna’s liveliest areas, where guests have direct access to some of the best shopping, dining, and nightlife available. A modern oriental style sets the mood as guests enjoy Ali Pasha’s private and intimate environment with individualized service. Rooms are simple but comfortable and decorated with flair. The hotel’s restaurant, Tandoor, is El Gouna’s only Indian specialty restaurant serving authentic North Indian cuisine; it attracts both in-house guests and clients from all over El Gouna. \r\n', '', '', 1, 0, 1, 1, 0, 'Total rooms: 67  \r\nViews: pool, marina\r\n', '', 'reservations@elgouna.com', '(+2 065) 358 0088', '', 'www.facebook.com/AliPashaHotel', 'https://twitter.com/ElGounaRedSea', '', 'https://www.youtube.com/user/ELGOUNAofficial', 1, 1),
(2, 'Beach dummy no.1', 'El-Gouna', '33.673457', '27.406404', 0, 4, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 0, 0, 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'beach@mail.com', ' (+2 065) 358 0088', 'testinfo', 'http://www.facebook.com/AliPashaHotel', 'http://www.twitter.com/', 'http://www.instagram.com/', 'https://www.youtube.com/user/ELGOUNAofficial', 3, 0),
(3, 'Buzzha Beach', 'North Mangroovy', '1', '1', 4, 1, 0, 'Only 15 minutes from downtown. Soak up the sun and watch kitesurfers. Activities include billiards, table football, beach volleyball and a kids’ playground, all free of charge.', '', '', 0, 0, 0, 0, 0, '', '', '', '+2 012 2661 0878 ', '', '', '', '', '', 1, 0),
(4, 'Beach dummy no.2', 'El-Gouna', '33.673457', '27.406404', 0, 3, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 0, 0, 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'beach@mail.com', '(+2 065) 358 0088', 'testinfo', 'www.facebook.com/AliPashaHotel', 'https://twitter.com/ElGounaRedSea', 'http://www.instagram.com', 'https://www.youtube.com/user/ELGOUNAofficial', 3, 0),
(5, 'Beach dummy no.3', 'El-Gouna', '33.673457', '27.406404', 0, 3, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 0, 0, 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'beach@mail.com', '(+2 065) 358 0088', 'testinfo', 'www.facebook.com/AliPashaHotel', 'https://twitter.com/ElGounaRedSea', 'http://www.instagram.com', 'https://www.youtube.com/user/ELGOUNAofficial', 4, 0),
(6, 'Beach dummy no.4', 'El-Gouna', '33.673457', '27.406404', 0, 2, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '', 0, 0, 0, 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'elgouna@mail.com', '(+2 065) 358 0088', 'testinfo', 'www.facebook.com/AliPashaHotel', 'https://twitter.com/ElGounaRedSea', 'http://www.instagram.com', 'http://www.youtube.com', 5, 0),
(7, 'Beach dummy no.6', 'El-Gouna', '33.673457', '27.406404', 0, 5, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 0, 0, 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'beach@mail.com', '(+2 065) 358 0088', 'testinfo', 'www.facebook.com/AliPashaHotel', 'https://twitter.com/ElGounaRedSea', 'http://www.instagram.com', 'https://www.youtube.com/user/ELGOUNAofficial', 6, 0),
(8, 'Beach dummy no.7', 'El-Gouna', '33.673457', '27.406404', 0, 3, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 0, 0, 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'beach@mail.com', '(+2 065) 358 0088', 'testinfo', 'www.facebook.com/AliPashaHotel', 'https://twitter.com/ElGounaRedSea', 'http://www.instagram.com', 'https://www.youtube.com/user/ELGOUNAofficial', 7, 0),
(9, 'Beach dummy no. 8', 'El-Gouna', '33.673457', '27.406404', 0, 5, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 0, 0, 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', 'beach@mail.com', '(+2 065) 358 0088', 'testinfo', 'www.facebook.com/AliPashaHotel', 'https://twitter.com/ElGounaRedSea', 'http://www.instagram.com', 'https://www.youtube.com/user/ELGOUNAofficial', 8, 0),
(10, 'Beach dummy no.9', 'El-Gouna', '33.673457', '27.406404', 0, 5, 1, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\"de Finibus Bonorum et Malorum\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \\"Lorem ipsum dolor sit amet..\\", comes from a line in section 1.10.32.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\"de Finibus Bonorum et Malorum\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \\"Lorem ipsum dolor sit amet..\\", comes from a line in section 1.10.32.', '', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\"de Finibus Bonorum et Malorum\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \\"Lorem ipsum dolor sit amet..\\", comes from a line in section 1.10.32.', 0, 0, 0, 0, 0, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\"de Finibus Bonorum et Malorum\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \\"Lorem ipsum dolor sit amet..\\", comes from a line in section 1.10.32.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\"de Finibus Bonorum et Malorum\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \\"Lorem ipsum dolor sit amet..\\", comes from a line in section 1.10.32.', '', 'elgouna@mail.com', '(+2 065) 358 0088', 'testinfo', 'www.facebook.com/AliPashaHotel', 'https://twitter.com/ElGounaRedSea', 'http://www.instagram.com', 'https://www.youtube.com/user/ELGOUNAofficial', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `beaches_filter`
--

DROP TABLE IF EXISTS `beaches_filter`;
CREATE TABLE IF NOT EXISTS `beaches_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `query` text CHARACTER SET utf8 NOT NULL,
  `ord` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `beaches_filter`
--

INSERT INTO `beaches_filter` (`id`, `name`, `query`, `ord`) VALUES
(1, 'Name', 'order by name asc', 0),
(2, 'Rating', 'order by rating desc', 0),
(3, 'Offers', 'order by offers desc', 0);

-- --------------------------------------------------------

--
-- Table structure for table `beaches_img`
--

DROP TABLE IF EXISTS `beaches_img`;
CREATE TABLE IF NOT EXISTS `beaches_img` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `beach_id` bigint(20) NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `beaches_img`
--

INSERT INTO `beaches_img` (`id`, `beach_id`, `img`) VALUES
(1, 0, '1.jpg'),
(2, 0, '2.jpg'),
(3, 0, '3.jpg'),
(4, 0, '4.jpg'),
(5, 0, '5.jpg'),
(6, 0, '6.jpg'),
(7, 0, '7.jpg'),
(8, 0, '8.jpg'),
(9, 0, '9.jpg'),
(10, 1, '10.jpg'),
(12, 0, '12.jpg'),
(13, 0, '13.jpg'),
(14, 0, '14.jpg'),
(15, 0, '15.jpg'),
(16, 0, '16.jpg'),
(17, 0, '17.jpg'),
(18, 0, '18.jpg'),
(19, 0, '19.jpg'),
(20, 0, '20.jpg'),
(21, 0, '21.jpg'),
(22, 0, '22.jpg'),
(23, 0, '23.jpg'),
(24, 2, '24.jpg'),
(25, 3, '25.jpg'),
(26, 3, '26.jpg'),
(27, 4, '27.jpg'),
(28, 4, '28.jpg'),
(29, 4, '29.jpg'),
(30, 5, '30.jpg'),
(31, 5, '31.jpg'),
(32, 5, '32.jpg'),
(33, 6, '33.jpg'),
(34, 7, '34.jpg'),
(35, 7, '35.jpg'),
(36, 7, '36.jpg'),
(37, 7, '37.jpg'),
(38, 8, '38.jpg'),
(39, 8, '39.jpg'),
(40, 8, '40.jpg'),
(41, 8, '41.jpg'),
(42, 9, '42.jpg'),
(43, 9, '43.jpg'),
(44, 9, '44.jpg'),
(45, 9, '45.jpg'),
(46, 9, '46.jpg'),
(47, 9, '47.jpg'),
(48, 10, '48.jpg'),
(49, 10, '49.jpg'),
(50, 10, '50.jpg'),
(51, 10, '51.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `beach_filter`
--

DROP TABLE IF EXISTS `beach_filter`;
CREATE TABLE IF NOT EXISTS `beach_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `query` text CHARACTER SET utf8 NOT NULL,
  `ord` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `beach_filter`
--

INSERT INTO `beach_filter` (`id`, `name`, `query`, `ord`) VALUES
(1, 'Ratings from Heighest to Lowest', 'order by reviewScore desc', 0),
(2, 'Ratings from Lowest to Heighest', 'order by reviewScore asc', 0),
(3, 'Special Offers', 'order by offerExists desc', 0);

-- --------------------------------------------------------

--
-- Table structure for table `beach_review`
--

DROP TABLE IF EXISTS `beach_review`;
CREATE TABLE IF NOT EXISTS `beach_review` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `beach_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `review` text CHARACTER SET utf8 NOT NULL,
  `rating` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `approved` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `beach_review`
--

INSERT INTO `beach_review` (`id`, `beach_id`, `user_id`, `review`, `rating`, `date`, `approved`) VALUES
(1, 3, 7, 'Lorem ipsum dolor sit er elit lamet, consectetaur cillium adipisicing pecu, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nam liber te conscient to factor tum poen legum odioque civiuda.', 2, '2015-12-27 18:28:03', 1),
(2, 3, 7, 'Lorem ipsum dolor sit er elit lamet, consectetaur cillium adipisicing pecu, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nam liber te conscient to factor tum poen legum odioque civiuda.', 5, '2015-12-27 19:08:41', 1),
(3, 3, 7, 'Lorem ipsum dolor sit er elit lamet, consectetaur cillium adipisicing pecu, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nam liber te conscient to factor tum poen legum odioque civiuda.hshshhshajanananansnnsmsmsksksmsmsmsksmsm', 3, '2015-12-27 19:09:47', 1),
(4, 3, 12, 'Lorem ipsum dolor sit er elit lamet, consectetaur cillium adipisicing pecu, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, ', 5, '2016-01-17 18:45:55', 1),
(5, 3, 18, 'hello from the other side ', 5, '2016-01-22 05:16:54', 1),
(6, 3, 18, 'enty btstzrfy y5ty', 5, '2016-01-22 05:18:21', 2),
(7, 2, 4, 'first review test', 10, '2016-01-24 03:43:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_link`
--

DROP TABLE IF EXISTS `booking_link`;
CREATE TABLE IF NOT EXISTS `booking_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookingURL` text CHARACTER SET utf8 NOT NULL,
  `facebookURL` text NOT NULL,
  `elgounaURL` text NOT NULL,
  `twitterURL` text NOT NULL,
  `youtubeURL` text NOT NULL,
  `instagramURL` text NOT NULL,
  `elgounaPhone` text NOT NULL,
  `elgounaSMS` text NOT NULL,
  `elgounaemail` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `booking_link`
--

INSERT INTO `booking_link` (`id`, `bookingURL`, `facebookURL`, `elgounaURL`, `twitterURL`, `youtubeURL`, `instagramURL`, `elgounaPhone`, `elgounaSMS`, `elgounaemail`) VALUES
(1, 'http://www.hotels.elgouna.com/', 'https://www.facebook.com/elgouna.official.fanpage/', 'http://www.elgouna.com/', 'https://twitter.com/ElGounaRedSea', 'https://www.youtube.com/user/ELGOUNAofficial', 'https://www.instagram.com/elgounaredsea/', '01234567895', '01254856578', 'info@elgouna.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `msg` text CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `msg`, `date`) VALUES
(1, 'Mohammed Gamal Ragab', 'himodanger@hotmail.com', '01093147755', 'the walk, and I used to be a good time to time, I have a problem with the IOS developer and he told me that the app budget for the project is LE IOS only, so I think he won''t be able to do it. so I have an idea of the chat ', '2015-12-21 13:48:03'),
(2, 'Fouad', 'fouad22@mail.com', '04154045484804545', 'bahajskslalalalalalalallala\njansnsksksk', '2015-12-30 08:09:27'),
(3, 'Fouadjbv', 'fouad22@mail.combjj', '8539', 'vjidfvfs\n', '2015-12-30 20:58:25'),
(4, 'bcchddha', 'fhdng@hsdyf.chgjg', '2545484', 'Cndn. Ngmbmbnb\n\n', '2016-01-12 18:11:10'),
(5, 'Mohammed Gamal', 'm@icon.com', '34318646484', 'hello its me', '2016-01-22 15:18:55'),
(6, 'Eman', 'eman@icon-creations.com', '01283533583', 'hey', '2016-01-24 04:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
CREATE TABLE IF NOT EXISTS `hotels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `location` text CHARACTER SET utf8 NOT NULL,
  `longitude` text CHARACTER SET utf8 NOT NULL,
  `latitude` text CHARACTER SET utf8 NOT NULL,
  `reviewScore` float NOT NULL,
  `ratingStar` int(11) NOT NULL,
  `offerExists` int(11) NOT NULL,
  `descrip` text CHARACTER SET utf8 NOT NULL,
  `offerTitle` text NOT NULL,
  `offerDescription` text CHARACTER SET utf8 NOT NULL,
  `isPoolAvailable` int(11) NOT NULL,
  `isGymAvailable` int(11) NOT NULL,
  `isWifiAvailable` int(11) NOT NULL,
  `isVisaPaymentAvailable` int(11) NOT NULL,
  `isDiningInAvailable` int(11) NOT NULL,
  `accomadtionType` text CHARACTER SET utf8 NOT NULL,
  `elgounaVoice` text CHARACTER SET utf8 NOT NULL,
  `email` text CHARACTER SET utf8 NOT NULL,
  `phoneNumber` text CHARACTER SET utf8 NOT NULL,
  `info` text CHARACTER SET utf8 NOT NULL,
  `facebookLink` text CHARACTER SET utf8 NOT NULL,
  `twitterLink` text CHARACTER SET utf8 NOT NULL,
  `instagramLink` text CHARACTER SET utf8 NOT NULL,
  `youtubeLink` text CHARACTER SET utf8 NOT NULL,
  `pid` bigint(20) NOT NULL,
  `ord` int(11) NOT NULL,
  `hidden` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `location`, `longitude`, `latitude`, `reviewScore`, `ratingStar`, `offerExists`, `descrip`, `offerTitle`, `offerDescription`, `isPoolAvailable`, `isGymAvailable`, `isWifiAvailable`, `isVisaPaymentAvailable`, `isDiningInAvailable`, `accomadtionType`, `elgounaVoice`, `email`, `phoneNumber`, `info`, `facebookLink`, `twitterLink`, `instagramLink`, `youtubeLink`, `pid`, `ord`, `hidden`) VALUES
(1, 'Ali Pasha Hotel', 'El-Gouna', '33.673457', '27.406404', 6.3, 4, 0, 'Ali Pasha Hotel is located in the Abu Tig Marina, one of El Gouna’s liveliest areas, where guests have direct access to some of the best shopping, dining, and nightlife available. A modern oriental style sets the mood as guests enjoy Ali Pasha’s private and intimate environment with individualized service. Rooms are simple but comfortable and decorated with flair. The hotel’s restaurant, Tandoor, is El Gouna’s only Indian specialty restaurant serving authentic North Indian cuisine; it attracts both in-house guests and clients from all over El Gouna. \r\n', 'offer title', 'sadsadasdjkasdfhasjkdfhasdjkfhasdlkfjsadsadasdjkasdfhasjkdfhasdjkfhasdlkfjsadsadasdjkasdfhasjkdfhasdjkfhasdlkfjsadsadasdjkasdfhasjkdfhasdjkfhasdlkfjsadsadasdjkasdfhasjkdfhasdjkfhasdlkfjsadsadasdjkasdfhasjkdfhasdjkfhasdlkfjsadsadasdjkasdfhasjkdfhasdjkfhasdlkfjsadsadasdjkasdfhasjkdfhasdjkfhasdlkfjsadsadasdjkasdfhasjkdfhasdjkfhasdlkfj', 0, 0, 0, 0, 0, 'Total rooms: 67  \r\nViews: pool, marina\r\n', '', 'reservations@elgouna.com', '(+2 065) 358 0088', '', 'www.facebook.com/AliPashaHotel', 'https://twitter.com/ElGounaRedSea', '', 'https://www.youtube.com/user/ELGOUNAofficial', 104613, 1, 1),
(2, 'test', 'El-Gouna', '33.673457', '27.406404', 0, 5, 0, 'details', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', 104613, 1, 1),
(3, 'test', 'El-Gouna', '33.673457', '27.406404', 0, 4, 0, 'details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here details will be here ', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', 104613, 1, 1),
(4, 'Mövenpick Resort & Spa El Gouna', 'El Gouna', '33.813969       ', '27.252991 ', 5, 5, 1, 'Luxurious and discreet in a truly Swiss way. Each room is graced with breathtaking views of the sea, the lagoons or the hotel’s lush gardens. The hotel has received several awards for efforts in regard to the environment. Housed in a privileged location, guests are only a few minutes away from the downtown and resort''s extensive facilities of Downtown areas of  Tamr Henna and Kafr El Gouna, where shopping arcades, cafés, restaurants, and entertainment venues featuring folklore shows and live music await.', '', '', 0, 0, 0, 0, 0, 'Total rooms: 420\r\nClassic Rooms : 150  - Leisure Rooms 190\r\nLeisure sea view rooms: 46\r\nDeluxe lagoon view rooms: 125 Deluxe sea view rooms: 100\r\n	 Deluxe Suites: 17  Family  Duplex room: 28\r\nViews: sea, lagoon, garden ,pool \r\n', '', 'www.moevenpick-hotels.com/el-gouna', '(+2 065) 354 4501, 358 0120', '', ' https://www.facebook.com/moevenpick.elgouna.resort?fref=ts&ref=br_tf', '', '', '', 0, 1, 1),
(5, 'Sheraton Miramar Resort', 'El Gouna', '33.813969', '27.252991', 10, 2, 0, 'Sheraton Miramar Resort is an oasis of peace and tranquility built on nine islands amidst lush gardens. Designed by the renowned architect Michael Graves, its architecture is an inviting mix of Arabian and Nubian style. The unique seafront setting of the resort lies against the dramatic backdrop of desert  where crystalline lagoons, wooden bridges and lush gardens give you the sensation of being in another world.', '', '', 0, 0, 0, 0, 0, 'Total rooms: 339\r\nSuites: 11\r\nViews: beach front, lagoon and pool\r\n', '', 'reservations.miramargouna@sheraton.com', '(+2 065) 354 5606, 358 0100/ 01 ', '', 'https://www.facebook.com/sheratonmiramarresort                      ', 'https://twitter.com/SheratonMiramar', 'https://instagram.com/sheratonmiramar/', '', 0, 2, 1),
(6, 'Steigenberger Golf Resort', 'El Gouna', '33.678590', '27.390670', 0, 3, 1, 'Situated amidst the golf course, this luxurious resort mixes modern architecture with a regional tradition. The lush gardens are surrounded by lagoons. Offering fine cuisine and excellent service, the hotel caters to the sophisticated golfer and vacationer. Steigenberger wellness and\r\nHealth club located at the Golf Club house features. Golfers are attracted by the year-round sunshine gracing a challenging course, couples come for the hotel’s fine dining options and attentive service, and families enjoy the multitude of outdoor activities that characterize vacations in Egypt The Steigenberger Golf Resort is also a prized venue for weddings, from intimate affairs to large-scale banquets..\r\n', '', '', 0, 0, 0, 0, 0, 'Total rooms: 268    Standard: 141  Superior: 55 Apartments: 14 Family: 13   \r\nSuites: 45\r\nViews: golf course, pool, lagoon, garden\r\n', '', '', '', '', '', '', '', '', 0, 3, 1),
(7, 'Club Paradiso El Gouna', 'El Gouna', '33.682963', '27.38649 ', 0, 4, 0, 'With rooms overlooking of beachfront 100 meters from the golf course, Club Paradiso El Gouna is an all-inclusive beachfront resort built along the nicest bay of El Gouna on the Red Sea coast of Egypt. A myriad of activities, cheerful entertainment, and friendly service characterize this comfortable retreat in beautiful natural setting .Enjoy deluxe restaurants offering specialties and superb buffet. ', '', '', 0, 0, 0, 0, 0, 'Total rooms: 239 Club room garden view: 117 Club room pool view: 68 Club room Sea view: 40\r\nSuites: 14\r\nViews: Sea, pool, garden\r\n', '', '', '', '', '', '', '', '', 0, 4, 1),
(8, 'Ali Pasha', 'Abu Tig', '33.673457', '27.406404', 3.7, 4, 0, 'Ali Pasha Hotel is located in the AbuTig Marina, one of El Gouna’sliveliest areas, where guests have direct access to some of the best shopping, dining, and nightlife available. A modern oriental style sets the mood as guests enjoy Ali Pasha’s private and intimate environment with individualized service. Rooms are simple but comfortable and decorated with flair. The hotel’s restaurant, Tandoor, is El Gouna’s only Indian specialty restaurant serving authentic North Indian cuisine; it attracts both in-house guests and clients from all over El Gouna. \r\n\r\nPools: 2\r\nRestaurant (Indian): 1', '', '', 0, 0, 0, 0, 0, 'Total rooms: 67\r\nViews: Pool, Marina\r\n', '', 'reservations@elgouna.com', '(+2 065) 358 0088', 'http://alipasha.elgouna.com ', 'www.facebook.com/AliPashaHotel', '', '', '', 0, 1, 0),
(9, 'Arena Inn', 'Downtown', '33.675449', '27.394593', 0, 3, 1, 'Situated on the shores of a lagoon, the hotel is adjacent to the lively Downtown area with its colorful arcades, restaurants, bars and shops. The inn offers all amenity comforts of a full-service hotel. Visitors will appreciate the private swimming pool and beautifully designed restaurant overlooking the lagoon and beach. Arena Inn Hotel is within walking distance from the lively downtown area with shopping arcades, restaurants and bars. The hotel also features 33 apartments in a separate building with a private swimming pool.\r\n\r\nPools: 2 (1 adult, 1 junior) + 1 in Apartment building\r\nRestaurants & bars: 2\r\nInternal extension: 150\r\n', '', '', 0, 0, 0, 0, 0, 'Total rooms: 144\r\nApartments: 33\r\nViews: Lagoon, Downtown El Gouna, Golf Course\r\n', '', 'reservations@elgouna.com', '(+2 065) 358 0078/(+2 065) 358 0079', 'http://arenainn.elgouna.com', 'www.facebook.com/ArenaInnElGouna', '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotels_img`
--

DROP TABLE IF EXISTS `hotels_img`;
CREATE TABLE IF NOT EXISTS `hotels_img` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hotel_id` bigint(20) NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `hotels_img`
--

INSERT INTO `hotels_img` (`id`, `hotel_id`, `img`) VALUES
(1, 1, '1.jpg'),
(2, 2, '2.jpg'),
(3, 2, '3.jpg'),
(4, 2, '4.jpg'),
(5, 2, '5.jpg'),
(6, 2, '6.jpg'),
(7, 4, '7.jpg'),
(8, 4, '8.jpg'),
(9, 4, '9.jpg'),
(10, 5, '10.jpg'),
(11, 5, '11.jpg'),
(12, 5, '12.jpg'),
(13, 6, '13.jpg'),
(14, 6, '14.jpg'),
(15, 7, '15.jpg'),
(16, 7, '16.jpg'),
(17, 8, '17.jpg'),
(18, 8, '18.jpg'),
(19, 9, '19.jpg'),
(20, 9, '20.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_filter`
--

DROP TABLE IF EXISTS `hotel_filter`;
CREATE TABLE IF NOT EXISTS `hotel_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `query` text CHARACTER SET utf8 NOT NULL,
  `ord` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hotel_filter`
--

INSERT INTO `hotel_filter` (`id`, `name`, `query`, `ord`) VALUES
(1, 'Ratings from Heighest to Lowest', 'order by ratingStar desc', 0),
(2, 'Ratings from Lowest to Heighest', 'order by ratingStar asc', 0),
(3, 'Special Offers', 'order by offerExists desc', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_review`
--

DROP TABLE IF EXISTS `hotel_review`;
CREATE TABLE IF NOT EXISTS `hotel_review` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hotel_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `review` text CHARACTER SET utf8 NOT NULL,
  `rating` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `approved` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `hotel_review`
--

INSERT INTO `hotel_review` (`id`, `hotel_id`, `user_id`, `review`, `rating`, `date`, `approved`) VALUES
(1, 1, 1, 'Fineeeeeeeee', 4, '2015-12-21 13:41:51', 1),
(2, 1, 1, 'weeeeeeeeeeeeeeeeeFineeeeeeeee', 10, '2015-12-21 13:45:03', 1),
(3, 1, 7, 'Lorem ipsum dolor sit er elit lamet, consectetaur cillium adipisicing pecu, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nam liber te conscient to factor tum poen legum odioque civiuda.sjdndbzbzbbzbxbxbxnx', 5, '2015-12-27 19:22:32', 1),
(4, 4, 12, 'Lorem ipsum dolor sit er elit lamet, consectetaur cillium adipisicing pecu, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nam liber te conscient to factor tum poen legum odioque civiuda.', 5, '2016-01-12 18:06:37', 1),
(5, 5, 1, 'weeeeeeeeeeeeeeeeeFineeeeeeeee', 10, '2016-01-18 16:01:51', 1),
(6, 5, 1, 'weeeeeeeeeeeFineeeeeeeee', 10, '2016-01-18 16:02:26', 1),
(7, 5, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 10, '2016-01-18 16:17:23', 1),
(8, 5, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 10, '2016-01-18 16:18:22', 1),
(9, 5, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 10, '2016-01-19 14:13:26', 1),
(10, 5, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 10, '2016-01-19 14:28:18', 0),
(11, 4, 19, 'hi', 5, '2016-01-20 14:28:03', 1),
(12, 4, 19, 'hi', 5, '2016-01-20 14:28:09', 1),
(13, 4, 11, 'Lorem ipsum dolor sit er elit lamet, consectetaur cillium adipisicing pecu, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nam liber te conscient to factor tum poen legum odioque civiuda.', 5, '2016-01-20 17:23:07', 0),
(14, 4, 11, 'Lorem ipsum dolor sit er elit lamet, consectetaur cillium adipisicing pecu, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nam liber te conscient to factor tum jnhhjpoen legum odioque civiuda.', 3, '2016-01-20 17:24:02', 0),
(15, 8, 18, 'hello', 5, '2016-01-24 02:49:49', 1),
(16, 8, 18, 'helloooo', 5, '2016-01-24 02:50:41', 1),
(17, 9, 4, 'first review', 2, '2016-01-24 03:43:09', 0),
(18, 8, 18, 'hey ', 1, '2016-01-24 03:49:09', 1),
(19, 9, 18, ' hola', 5, '2016-01-24 04:04:02', 0),
(20, 8, 18, 'he', 5, '2016-01-24 06:05:04', 0),
(21, 8, 26, 'hello from the other siiiiiiiide ', 6, '2016-01-24 13:27:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rate_range`
--

DROP TABLE IF EXISTS `rate_range`;
CREATE TABLE IF NOT EXISTS `rate_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rate_range`
--

INSERT INTO `rate_range` (`id`, `start`, `end`, `title`) VALUES
(1, 0, 1, 'Poor'),
(2, 1, 2, 'Good'),
(3, 2, 4, 'Very Good'),
(4, 4, 5, 'Excellent');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `ord` int(11) NOT NULL,
  `hidden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `img`, `ord`, `hidden`) VALUES
(1, 'Pool', 'http://iconcreations-projects.com/elgounaApp/images/services/1.png', 0, 0),
(2, 'Restaurant', 'http://iconcreations-projects.com/elgounaApp/images/services/2.png', 0, 0),
(3, 'Bar', 'http://iconcreations-projects.com/elgounaApp/images/services/3.png', 0, 0),
(4, 'TV', 'http://iconcreations-projects.com/elgounaApp/images/services/4.png', 0, 0),
(5, 'AC', 'http://iconcreations-projects.com/elgounaApp/images/services/5.png', 0, 0),
(6, 'Minibar', 'http://iconcreations-projects.com/elgounaApp/images/services/6.png', 0, 0),
(7, 'Tel', 'http://iconcreations-projects.com/elgounaApp/images/services/7.png', 0, 0),
(8, 'Safe Box', 'http://iconcreations-projects.com/elgounaApp/images/services/8.png', 0, 0),
(9, 'Internet', 'http://iconcreations-projects.com/elgounaApp/images/services/9.png', 0, 0),
(10, 'Laundry', 'http://iconcreations-projects.com/elgounaApp/images/services/10.png', 0, 0),
(11, 'Sports', 'http://iconcreations-projects.com/elgounaApp/images/services/11.png', 0, 0),
(12, 'Spa', 'http://iconcreations-projects.com/elgounaApp/images/services/12.png', 0, 0),
(13, 'Diving Desk', 'http://iconcreations-projects.com/elgounaApp/images/services/13.png', 0, 0),
(14, 'Fitness Center', 'http://iconcreations-projects.com/elgounaApp/images/services/14.png', 0, 0),
(15, 'Kids Facilities', 'http://iconcreations-projects.com/elgounaApp/images/services/15.png', 0, 0),
(16, 'Room Service', 'http://iconcreations-projects.com/elgounaApp/images/services/16.png', 0, 0),
(17, 'Dine Around', 'http://iconcreations-projects.com/elgounaApp/images/services/17.png', 0, 0),
(18, 'Green Star', 'http://iconcreations-projects.com/elgounaApp/images/services/18.png', 0, 0),
(19, 'Kite Station', 'http://iconcreations-projects.com/elgounaApp/images/services/19.png', 0, 0),
(20, 'ATM Machine', 'http://iconcreations-projects.com/elgounaApp/images/services/20.png', 0, 0),
(21, 'Shops', 'http://iconcreations-projects.com/elgounaApp/images/services/21.png', 0, 0),
(22, 'Hairdresser', 'http://iconcreations-projects.com/elgounaApp/images/services/22.png', 0, 0),
(23, 'Archery', 'http://iconcreations-projects.com/elgounaApp/images/services/23.png', 0, 0),
(24, 'Tennis', 'http://iconcreations-projects.com/elgounaApp/images/services/24.png', 0, 0),
(25, 'Squash', 'http://iconcreations-projects.com/elgounaApp/images/services/25.png', 0, 0),
(26, 'Sailing', 'http://iconcreations-projects.com/elgounaApp/images/services/26.png', 0, 0),
(27, 'Windsurfing', 'http://iconcreations-projects.com/elgounaApp/images/services/27.png', 0, 0),
(28, 'Snorkeling', 'http://iconcreations-projects.com/elgounaApp/images/services/28.png', 0, 0),
(29, 'Beach Volleyball', 'http://iconcreations-projects.com/elgounaApp/images/services/29.png', 0, 0),
(30, 'Kitesurfing Station ', 'http://iconcreations-projects.com/elgounaApp/images/services/30.png', 0, 0),
(31, 'Diving Center', 'http://iconcreations-projects.com/elgounaApp/images/services/31.png', 0, 0),
(32, 'Sauna', 'http://iconcreations-projects.com/elgounaApp/images/services/32.png', 0, 0),
(33, 'Steam Bath', 'http://iconcreations-projects.com/elgounaApp/images/services/33.png', 0, 0),
(34, 'Hot and Cold Plunge Pools', 'http://iconcreations-projects.com/elgounaApp/images/services/34.png', 0, 0),
(35, 'Free Parking', 'http://iconcreations-projects.com/elgounaApp/images/services/35.png', 0, 0),
(36, 'Free Wi-Fi', 'http://iconcreations-projects.com/elgounaApp/images/services/36.png', 0, 0),
(37, 'Front Desk Services', 'http://iconcreations-projects.com/elgounaApp/images/services/37.png', 0, 0),
(38, 'Baggage service', 'http://iconcreations-projects.com/elgounaApp/images/services/38.png', 0, 0),
(39, 'Private Beach Area', 'http://iconcreations-projects.com/elgounaApp/images/services/39.png', 0, 0),
(40, 'Evening Entertainment', 'http://iconcreations-projects.com/elgounaApp/images/services/40.png', 0, 0),
(41, 'Snorkeling Tripdesk', 'http://iconcreations-projects.com/elgounaApp/images/services/41.png', 0, 0),
(42, 'Wellness Center', 'http://iconcreations-projects.com/elgounaApp/images/services/42.png', 0, 0),
(43, 'testx', 'http://iconcreations-projects.com/elgounaApp/images/services/43.png', 1, 1),
(44, 'test', 'http://iconcreations-projects.com/elgounaApp/images/services/44.png', 1, 1),
(45, 'Golf', 'http://iconcreations-projects.com/elgounaApp/images/services/45.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services_hotel`
--

DROP TABLE IF EXISTS `services_hotel`;
CREATE TABLE IF NOT EXISTS `services_hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `services_hotel`
--

INSERT INTO `services_hotel` (`id`, `service_id`, `hotel_id`) VALUES
(1, 2, 3),
(6, 5, 3),
(7, 1, 1),
(5, 3, 3),
(8, 2, 1),
(9, 3, 1),
(10, 4, 1),
(11, 5, 1),
(12, 6, 1),
(13, 21, 2),
(14, 22, 2),
(15, 27, 2),
(16, 28, 2),
(17, 33, 2),
(18, 34, 2),
(19, 39, 2),
(20, 40, 2),
(21, 1, 4),
(22, 2, 4),
(23, 3, 4),
(24, 4, 4),
(25, 5, 4),
(26, 7, 4),
(27, 10, 4),
(28, 11, 4),
(29, 15, 4),
(30, 16, 4),
(31, 19, 4),
(32, 20, 4),
(33, 21, 4),
(34, 25, 4),
(35, 1, 8),
(36, 2, 8),
(37, 3, 8),
(38, 4, 8),
(39, 5, 8),
(40, 6, 8),
(41, 7, 8),
(42, 8, 8),
(43, 9, 8),
(44, 10, 8),
(45, 15, 8),
(46, 17, 8),
(47, 18, 8),
(48, 32, 8),
(49, 37, 8),
(50, 1, 9),
(51, 2, 9),
(52, 3, 9),
(53, 4, 9),
(54, 5, 9),
(55, 6, 9),
(56, 7, 9),
(57, 8, 9),
(58, 9, 9),
(59, 10, 9),
(60, 13, 9),
(61, 16, 9),
(62, 17, 9),
(63, 18, 9),
(64, 37, 9),
(65, 39, 9),
(66, 40, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userAuth` text NOT NULL,
  `name` text NOT NULL,
  `imageURL` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `gender` int(11) NOT NULL,
  `birthDate` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `zipCode` text NOT NULL,
  `notificationsEnabled` int(11) NOT NULL,
  `mapsEnabled` int(11) NOT NULL,
  `elgounaPhone` text NOT NULL,
  `elgounaSMS` text NOT NULL,
  `elgounaemail` text NOT NULL,
  `fbId` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userAuth`, `name`, `imageURL`, `phoneNumber`, `gender`, `birthDate`, `address`, `email`, `zipCode`, `notificationsEnabled`, `mapsEnabled`, `elgounaPhone`, `elgounaSMS`, `elgounaemail`, `fbId`) VALUES
(1, '', 'Mohammed Gamal Ragab', 'http://iconcreations-projects.com/elgounaApp/images/users/1.png', '', 0, '06/16/1990', '', 'himodanger@hotmail.com', '', 1, 0, '', '', '', '10154319704785616'),
(2, '73dd2e5d59ee0b29b52058d4393b170f', 'Fouad', '', '', 0, '24 Dec, 1975', '', 'fouad@mail.com', '', 0, 0, '', '', '', ''),
(3, 'b5264fbbfa52942d92464dd9d6a19c82', 'JamJoom', '', '', 0, '16/6/1990', '', 'j@ic.com', '', 1, 1, '', '', '', ''),
(4, 'c2d4c8126355f4c442684c160f7027df', 'Fouad Helmy 2', 'http://iconcreations-projects.com/elgounaApp/images/users/4.png', '', 0, '22 Dec, 1997', '', 'fouad.helmy91@gmail2.com', '', 0, 0, '', '', '', ''),
(5, '88fb15c19a5fe15038ec69d840588d5b', 'fouad helmy', '', '', 1, '24 Feb, 1993', '', 'fo@mail.com', '', 0, 0, '', '', '', ''),
(6, '574773d68b551ad4d17bb4a6a0553415', 'Fouad Helmy', '', '01061650649', 0, '30/09/1988', 'City,Country', 'fouad32@mail.com', '', 1, 1, '', '', '', ''),
(7, 'b77031f2f1f59dc9e0bb845e72d8940a', 'Fouad', '', '', 0, '', '', 'fouad123@mail.com', '', 0, 0, '', '', '', ''),
(8, '2ea847f7e0935c4d10cf4746091b7eda', 'Fouadhahzhdjcjckfnfnmsbsnamajsbxnns', '', '', 1, '30 Dec, 2016', '', 'fouad22nnnnn@mail.com', '', 0, 0, '', '', '', ''),
(9, 'a3fc61ed7db8934f7032bfbd23aad36c', 'fouad', '', '', 0, '', '', 'fouad33@mail.com', '', 0, 0, '', '', '', ''),
(10, '6c84777a645c8827efce56fa75509cb5', 'fouad', '', '', 0, '', '', 'fouad09@mail.com', '', 0, 0, '', '', '', ''),
(11, '5c08f56496ace8f4d8530442759754e1', 'Fouad Helmy', '', '', 0, '13 Dec, 2016', '', 'fouad.helmy91@gmail.com', '', 0, 0, '', '', '', '10153550232625020'),
(12, '92008b065fc8224ade6adc2dea2d0464', 'yousra', 'http://iconcreations-projects.com/elgounaApp/images/users/12.png', '', 0, '', '', 'you.srasalem@hotmail.com', '', 0, 0, '', '', '', '10154468475952306'),
(13, '25d55ad283aa400af464c76d713c07ad', 'shhshddnbd', '', '', 0, '', '', 'djjdjdfjj@djdn.com', '', 0, 0, '', '', '', ''),
(14, '083c39a5e5d0b0776d0cc64f9aa45c43', 'yousra', '', '', 0, '', '', 'yousra@icon-creations.com', '', 0, 0, '', '', '', ''),
(15, 'e251d7a7af31a58d7f52818b4ab5f881', 'yousra', '', '', 0, '', '', 'yousra@icon.com', '', 0, 0, '', '', '', ''),
(16, '73dd2e5d59ee0b29b52058d4393b170f', 'Yousra Salem', '', '', 0, '', '', 'yousra@mail.com', '', 0, 0, '', '', '', ''),
(17, '119dc5973c1170ad83a910e261122fe0', 'Fouazz', '', '', 0, '13 Jan, 2018', '', 'fouad22@mail.com', '', 0, 1, '', '', '', ''),
(18, 'fc79ba04812ff27d28c33a203e1dbecf', 'Eman adham', 'http://iconcreations-projects.com/elgounaApp/images/users/18.png', '', 1, '19 Jun, 1992', '', 'eman@icon-creations.com', '', 0, 1, '', '', '', ''),
(19, '558f3af6dc84bef6a3dd70ccac28e5', 'Mohammed Gamal', 'http://iconcreations-projects.com/elgounaApp/images/users/19.png', '', 0, '10/7/2015', '', 'm@icon.com', '', 1, 0, '', '', '', ''),
(20, '8f81de63295e51adbb1b51da3de8f', 'yousra', '', '', 1, '2/1/2016', '', 'yo@icon.com', '', 1, 0, '', '', '', ''),
(21, '73dd2e5d59ee0b29b52058d4393b170f', 'Fouad Helmy 22', '', '', 0, '', '', 'fouad.helmy@outlook.com', '', 0, 0, '', '', '', ''),
(22, '0dd256a1d233d7e6d77b4274bed0a0a7', 'eman adham', 'http://iconcreations-projects.com/elgounaApp/images/users/22.png', '', 1, '19 Jun, 1992', '', 'eman.adham196@gmail.com', '', 0, 0, '', '', '', ''),
(23, '31e14e1f8a6e94c57df22e355d1bed7', 'Ahmed', 'http://iconcreations-projects.com/elgounaApp/images/users/23.png', '', 0, '', '', 'a@icon.com', '', 0, 0, '', '', '', ''),
(24, '17c79a8b85cd574865b021cca823b', 'eman', '', '', 0, '', '', 'eman.adham196@Hotmail.com', '', 0, 0, '', '', '', ''),
(25, '769fca8d000b53305feda5bcc6db3062', 'Fouad Helmy', '', '', 0, '24 Jan, 1889', '', 'fouad@icon-creations.com', '', 0, 0, '', '', '', ''),
(26, '518f665482b3e8eb3963c8ebb789d75a', 'eman', '', '', 1, '19 Jun, 1992', '', 'eman@ic.com', '', 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_beach_like`
--

DROP TABLE IF EXISTS `user_beach_like`;
CREATE TABLE IF NOT EXISTS `user_beach_like` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `beach_id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_beach_like`
--

INSERT INTO `user_beach_like` (`id`, `user_id`, `beach_id`, `date`) VALUES
(1, 9, 3, '2015-12-31 04:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_hotel_like`
--

DROP TABLE IF EXISTS `user_hotel_like`;
CREATE TABLE IF NOT EXISTS `user_hotel_like` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `hotel_id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_hotel_like`
--

INSERT INTO `user_hotel_like` (`id`, `user_id`, `hotel_id`, `date`) VALUES
(1, 8, 1, '2015-12-30 20:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

DROP TABLE IF EXISTS `weather`;
CREATE TABLE IF NOT EXISTS `weather` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `cloudCover` text NOT NULL,
  `feelsLike` text NOT NULL,
  `humidity` text NOT NULL,
  `pressure` text NOT NULL,
  `temperature` text NOT NULL,
  `windDirection` text NOT NULL,
  `windSpeed` text NOT NULL,
  `high` text NOT NULL,
  `low` text NOT NULL,
  `weatherDesc` text NOT NULL,
  `chanceofFog` text NOT NULL,
  `chanceOfRain` text NOT NULL,
  `chanceOfSnow` text NOT NULL,
  `sunrise` text NOT NULL,
  `sunset` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`id`, `date`, `cloudCover`, `feelsLike`, `humidity`, `pressure`, `temperature`, `windDirection`, `windSpeed`, `high`, `low`, `weatherDesc`, `chanceofFog`, `chanceOfRain`, `chanceOfSnow`, `sunrise`, `sunset`) VALUES
(1, '2015-11-16 15:48:52', '0', '29', '55', '1006', '28', 'WNW', '6', '31', '21', 'Sunny<br>', '0', '0', '0', '06:06 AM', '04:53 PM'),
(2, '2015-11-16 22:19:40', '0', '25', '61', '1010', '24', 'WNW', '6', '31', '20', 'Clear<br>', '0', '0', '0', '06:06 AM', '04:53 PM'),
(3, '2015-11-18 20:11:39', '0', '25', '61', '1016', '22', 'NW', '23', '26', '19', 'Clear<br>', '0', '0', '0', '06:08 AM', '04:53 PM'),
(4, '2015-11-19 11:08:49', '0', '26', '54', '1019', '25', 'NW', '19', '27', '18', 'Sunny<br>', '0', '0', '0', '06:08 AM', '04:52 PM'),
(5, '2015-11-22 11:42:02', '0', '28', '51', '1012', '27', 'NW', '12', '29', '20', 'Sunny<br>', '0', '0', '0', '06:11 AM', '04:52 PM'),
(6, '2015-11-25 13:51:50', '25', '31', '43', '1014', '30', 'ENE', '6', '27', '17', 'Partly Cloudy<br>', '0', '0', '0', '06:13 AM', '04:51 PM'),
(7, '2015-11-25 22:53:44', '0', '20', '68', '1014', '20', 'ENE', '6', '27', '17', 'Clear<br>', '0', '0', '0', '06:13 AM', '04:51 PM'),
(8, '2015-11-26 13:10:35', '0', '31', '49', '1014', '30', 'S', '1', '29', '18', 'Sunny<br>', '0', '0', '0', '06:14 AM', '04:51 PM'),
(9, '2015-11-26 17:33:23', '0', '29', '55', '1012', '28', 'SSE', '5', '28', '18', 'Clear<br>', '0', '0', '0', '06:14 AM', '04:51 PM'),
(10, '2015-11-27 15:42:42', '0', '35', '52', '1014', '32', 'S', '3', '28', '19', 'Sunny<br>', '0', '0', '0', '06:14 AM', '04:51 PM'),
(11, '2015-11-29 15:33:21', '0', '29', '51', '1014', '28', 'NW', '17', '30', '20', 'Sunny<br>', '0', '0', '0', '06:16 AM', '04:50 PM'),
(12, '2015-11-30 16:31:13', '0', '26', '44', '1014', '25', 'NW', '22', '28', '19', 'Sunny<br>', '0', '0', '0', '06:17 AM', '04:50 PM'),
(13, '2015-12-01 13:16:15', '50', '25', '47', '1018', '24', 'WNW', '30', '24', '17', 'Partly Cloudy<br>', '0', '0', '0', '06:17 AM', '04:50 PM'),
(14, '2015-12-01 18:54:39', '0', '21', '35', '1018', '21', 'WNW', '30', '25', '17', 'Clear<br>', '0', '0', '0', '06:17 AM', '04:50 PM'),
(15, '2015-12-02 18:18:58', '0', '21', '46', '1019', '21', 'NW', '35', '24', '17', 'Clear<br>', '0', '0', '0', '06:18 AM', '04:50 PM'),
(16, '2015-12-03 16:47:02', '0', '25', '50', '1019', '23', 'NW', '26', '24', '17', 'Sunny<br>', '0', '0', '0', '06:19 AM', '04:50 PM'),
(17, '2015-12-06 11:55:03', '0', '19', '26', '1025', '19', 'NW', '28', '20', '13', 'Sunny<br>', '0', '0', '0', '06:21 AM', '04:51 PM'),
(18, '2015-12-06 16:03:25', '0', '22', '23', '1023', '22', 'NW', '28', '20', '13', 'Sunny<br>', '0', '0', '0', '06:21 AM', '04:51 PM'),
(19, '2015-12-06 20:36:10', '0', '17', '27', '1025', '17', 'NW', '28', '21', '13', 'Clear<br>', '0', '0', '0', '06:21 AM', '04:51 PM'),
(20, '2015-12-07 14:10:01', '0', '24', '36', '1023', '23', 'NW', '18', '22', '14', 'Sunny<br>', '0', '0', '0', '06:22 AM', '04:51 PM'),
(21, '2015-12-10 11:56:19', '0', '21', '53', '1020', '21', 'NW', '19', '23', '16', 'Sunny<br>', '0', '0', '0', '06:24 AM', '04:51 PM'),
(22, '2015-12-13 13:40:46', '50', '19', '46', '1013', '19', 'W', '25', '22', '15', 'Partly Cloudy<br>', '0', '0', '0', '06:26 AM', '04:52 PM'),
(23, '2015-12-13 18:27:44', '75', '17', '59', '1014', '17', 'W', '25', '21', '16', 'Partly Cloudy<br>', '0', '0', '0', '06:26 AM', '04:52 PM'),
(24, '2015-12-14 12:52:21', '0', '21', '53', '1019', '21', 'NW', '23', '21', '15', 'Sunny<br>', '0', '0', '0', '06:27 AM', '04:53 PM'),
(25, '2015-12-14 16:56:56', '25', '21', '43', '1019', '21', 'NW', '23', '22', '15', 'Partly Cloudy<br>', '0', '0', '0', '06:27 AM', '04:53 PM'),
(26, '2015-12-15 12:21:08', '25', '21', '53', '1023', '21', 'WNW', '20', '23', '14', 'Partly Cloudy<br>', '0', '0', '0', '06:27 AM', '04:53 PM'),
(27, '2015-12-15 16:25:04', '50', '25', '39', '1021', '25', 'WNW', '20', '23', '15', 'Partly Cloudy<br>', '0', '0', '0', '06:27 AM', '04:53 PM'),
(28, '2015-12-16 13:19:38', '25', '25', '53', '1019', '23', 'WNW', '13', '24', '16', 'Partly Cloudy<br>', '0', '0', '0', '06:28 AM', '04:53 PM'),
(29, '2015-12-16 18:21:00', '0', '21', '53', '1017', '21', 'WNW', '13', '24', '16', 'Clear<br>', '0', '0', '0', '06:28 AM', '04:53 PM'),
(30, '2015-12-17 14:59:12', '0', '25', '44', '1016', '23', 'WNW', '18', '23', '15', 'Sunny<br>', '0', '0', '0', '06:28 AM', '04:54 PM'),
(31, '2015-12-20 12:50:01', '25', '20', '43', '1024', '20', 'WNW', '25', '22', '16', 'Partly Cloudy<br>', '0', '0', '0', '06:30 AM', '04:55 PM'),
(32, '2015-12-20 16:53:38', '25', '24', '35', '1022', '22', 'WNW', '25', '23', '16', 'Partly Cloudy<br>', '0', '0', '0', '06:30 AM', '04:55 PM'),
(33, '2015-12-21 12:52:54', '25', '25', '47', '1023', '23', 'WNW', '21', '23', '15', 'Partly Cloudy<br>', '0', '0', '0', '06:31 AM', '04:56 PM'),
(34, '2015-12-21 17:20:48', '0', '25', '47', '1021', '23', 'WNW', '21', '23', '15', 'Clear<br>', '0', '0', '0', '06:31 AM', '04:56 PM'),
(35, '2015-12-22 15:52:19', '0', '24', '34', '1018', '24', 'WNW', '17', '22', '15', 'Sunny<br>', '0', '0', '0', '06:31 AM', '04:56 PM'),
(36, '2015-12-24 11:34:19', '0', '19', '52', '1024', '19', 'WNW', '29', '21', '15', 'Sunny<br>', '0', '0', '0', '06:32 AM', '04:57 PM'),
(37, '2015-12-24 15:34:43', '50', '24', '41', '1021', '22', 'WNW', '29', '21', '15', 'Partly Cloudy<br>', '0', '0', '0', '06:32 AM', '04:57 PM'),
(38, '2015-12-26 04:18:16', '0', '12', '51', '1025', '13', 'NW', '10', '23', '14', 'Clear<br>', '0', '0', '0', '06:33 AM', '04:58 PM'),
(39, '2015-12-26 22:53:36', '0', '14', '48', '1023', '15', 'WNW', '9', '24', '14', 'Clear<br>', '0', '0', '0', '06:33 AM', '04:58 PM'),
(40, '2015-12-27 07:39:17', '0', '12', '44', '1023', '14', 'NW', '17', '23', '14', 'Sunny<br>', '0', '0', '0', '06:33 AM', '04:59 PM'),
(41, '2015-12-27 15:23:25', '0', '24', '41', '1021', '23', 'NW', '15', '23', '14', 'Sunny<br>', '0', '0', '0', '06:33 AM', '04:59 PM'),
(42, '2015-12-27 19:24:09', '0', '19', '64', '1021', '19', 'NW', '15', '23', '14', 'Clear<br>', '0', '0', '0', '06:33 AM', '04:59 PM'),
(43, '2015-12-28 12:49:58', '0', '21', '40', '1022', '21', 'NW', '14', '25', '15', 'Sunny<br>', '0', '0', '0', '06:34 AM', '04:59 PM'),
(44, '2015-12-28 17:14:15', '0', '25', '41', '1019', '25', 'NW', '14', '24', '15', 'Clear<br>', '0', '0', '0', '06:34 AM', '04:59 PM'),
(45, '2015-12-29 16:24:21', '0', '26', '37', '1012', '27', 'WNW', '5', '27', '16', 'Partly Cloudy<br>', '0', '0', '0', '06:34 AM', '05:00 PM'),
(46, '2015-12-30 06:52:57', '0', '13', '67', '1016', '14', 'WNW', '28', '21', '15', 'Sunny<br>', '0', '0', '0', '06:34 AM', '05:01 PM'),
(47, '2015-12-30 13:44:07', '25', '24', '50', '1015', '22', 'WNW', '29', '22', '15', 'Partly Cloudy<br>', '0', '0', '0', '06:34 AM', '05:01 PM'),
(48, '2015-12-30 18:38:15', '0', '20', '40', '1015', '20', 'WNW', '29', '22', '15', 'Clear<br>', '0', '0', '0', '06:34 AM', '05:01 PM'),
(49, '2015-12-31 04:39:19', '0', '12', '58', '1016', '13', 'WNW', '20', '22', '15', 'Clear<br>', '0', '0', '0', '06:35 AM', '05:01 PM'),
(50, '2015-12-31 14:44:06', '75', '20', '49', '1016', '20', 'WNW', '19', '22', '15', 'Partly Cloudy<br>', '0', '0', '0', '06:35 AM', '05:01 PM'),
(51, '2015-12-31 18:44:37', '50', '20', '40', '1015', '20', 'WNW', '19', '23', '15', 'Partly Cloudy<br>', '0', '0', '0', '06:35 AM', '05:01 PM'),
(52, '2016-01-01 21:19:05', '0', '13', '59', '1023', '15', 'W', '26', '20', '11', 'Clear<br>', '0', '0', '0', '06:35 AM', '05:02 PM'),
(53, '2016-01-02 01:22:35', '0', '11', '47', '1024', '13', 'NW', '30', '17', '11', 'Clear', '0', '0', '0', '06:35 AM', '05:03 PM'),
(54, '2016-01-02 13:31:19', '25', '16', '39', '1026', '16', 'NW', '29', '16', '11', 'Partly Cloudy', '0', '0', '0', '06:35 AM', '05:03 PM'),
(55, '2016-01-02 17:35:58', '0', '13', '44', '1025', '15', 'NW', '29', '16', '11', 'Clear', '0', '0', '0', '06:35 AM', '05:03 PM'),
(56, '2016-01-02 21:37:09', '0', '10', '47', '1026', '12', 'NW', '29', '16', '11', 'Clear', '0', '0', '0', '06:35 AM', '05:03 PM'),
(57, '2016-01-03 11:24:51', '0', '16', '55', '1026', '16', 'WNW', '20', '20', '13', 'Sunny', '0', '0', '0', '06:36 AM', '05:03 PM'),
(58, '2016-01-03 15:35:54', '0', '20', '43', '1022', '20', 'WNW', '20', '20', '13', 'Sunny', '0', '0', '0', '06:36 AM', '05:03 PM'),
(59, '2016-01-03 20:20:33', '0', '14', '51', '1023', '14', 'WNW', '20', '20', '14', 'Clear', '0', '0', '0', '06:36 AM', '05:03 PM'),
(60, '2016-01-04 11:29:59', '0', '19', '52', '1022', '19', 'NW', '16', '23', '15', 'Sunny', '0', '0', '0', '06:36 AM', '05:04 PM'),
(61, '2016-01-04 15:37:56', '0', '24', '41', '1018', '23', 'NW', '16', '23', '15', 'Sunny', '0', '0', '0', '06:36 AM', '05:04 PM'),
(62, '2016-01-04 20:51:19', '0', '19', '57', '1020', '19', 'NW', '16', '23', '15', 'Clear', '0', '0', '0', '06:36 AM', '05:04 PM'),
(63, '2016-01-05 13:15:47', '0', '24', '36', '1020', '23', 'NW', '16', '24', '16', 'Sunny', '0', '0', '0', '06:36 AM', '05:05 PM'),
(64, '2016-01-05 17:16:00', '0', '25', '39', '1018', '24', 'NW', '16', '24', '16', 'Clear', '0', '0', '0', '06:36 AM', '05:05 PM'),
(65, '2016-01-05 21:59:45', '0', '14', '63', '1020', '15', 'NW', '16', '24', '16', 'Clear', '0', '0', '0', '06:36 AM', '05:05 PM'),
(66, '2016-01-06 15:37:16', '0', '25', '26', '1017', '26', 'NW', '13', '26', '15', 'Sunny', '0', '0', '0', '06:36 AM', '05:06 PM'),
(67, '2016-01-08 13:53:29', '0', '23', '31', '1018', '22', 'WNW', '28', '23', '16', 'Widespread Dust', '0', '0', '0', '06:36 AM', '05:07 PM'),
(68, '2016-01-08 17:56:19', '0', '21', '46', '1016', '21', 'WNW', '28', '23', '16', 'Sand', '0', '0', '0', '06:36 AM', '05:07 PM'),
(69, '2016-01-08 22:39:42', '0', '16', '45', '1019', '16', 'WNW', '28', '23', '16', 'Haze', '0', '0', '0', '06:36 AM', '05:07 PM'),
(70, '2016-01-09 18:49:17', '0', '20', '56', '1019', '20', 'W', '30', '23', '16', 'Clear', '0', '0', '0', '06:37 AM', '05:08 PM'),
(71, '2016-01-09 23:44:24', '0', '16', '68', '1020', '16', 'W', '30', '23', '15', 'Clear', '0', '0', '0', '06:37 AM', '05:08 PM'),
(72, '2016-01-10 13:46:18', '0', '25', '50', '1019', '24', 'NW', '21', '23', '15', 'Sunny', '0', '0', '0', '06:37 AM', '05:09 PM'),
(73, '2016-01-10 18:02:31', '0', '21', '56', '1018', '21', 'NW', '21', '23', '15', 'Clear', '0', '0', '0', '06:37 AM', '05:09 PM'),
(74, '2016-01-10 22:02:52', '0', '16', '68', '1020', '16', 'NW', '21', '23', '15', 'Clear', '0', '0', '0', '06:37 AM', '05:09 PM'),
(75, '2016-01-11 11:44:50', '0', '19', '56', '1020', '19', 'NW', '16', '24', '15', 'Sunny', '0', '0', '0', '06:37 AM', '05:09 PM'),
(76, '2016-01-11 15:46:10', '0', '26', '44', '1017', '25', 'NW', '16', '24', '15', 'Sunny', '0', '0', '0', '06:37 AM', '05:09 PM'),
(77, '2016-01-11 23:42:57', '0', '17', '42', '1019', '17', 'NW', '16', '25', '15', 'Clear', '0', '0', '0', '06:37 AM', '05:09 PM'),
(78, '2016-01-12 17:35:32', '0', '25', '47', '1016', '23', 'NW', '22', '24', '15', 'Clear', '0', '0', '0', '06:37 AM', '05:10 PM'),
(79, '2016-01-12 22:14:07', '0', '18', '56', '1018', '18', 'NW', '22', '24', '15', 'Clear', '0', '0', '0', '06:37 AM', '05:10 PM'),
(80, '2016-01-13 12:48:15', '0', '25', '50', '1018', '23', 'NW', '16', '25', '16', 'Sunny', '0', '0', '0', '06:37 AM', '05:11 PM'),
(81, '2016-01-13 16:49:14', '0', '25', '54', '1016', '24', 'NW', '16', '25', '16', 'Sunny', '0', '0', '0', '06:37 AM', '05:11 PM'),
(82, '2016-01-13 21:07:56', '0', '17', '83', '1017', '17', 'NW', '16', '25', '16', 'Clear', '0', '0', '0', '06:37 AM', '05:11 PM'),
(83, '2016-01-14 11:32:17', '0', '24', '38', '1018', '22', 'NW', '17', '25', '16', 'Sunny', '0', '0', '0', '06:37 AM', '05:12 PM'),
(84, '2016-01-14 16:44:20', '0', '25', '39', '1015', '24', 'NW', '17', '25', '16', 'Sunny', '0', '0', '0', '06:37 AM', '05:12 PM'),
(85, '2016-01-14 21:24:28', '0', '18', '45', '1017', '18', 'NW', '17', '25', '16', 'Clear', '0', '0', '0', '06:37 AM', '05:12 PM'),
(86, '2016-01-15 13:08:04', '0', '25', '50', '1019', '23', 'NW', '27', '22', '15', 'Sunny', '0', '0', '0', '06:37 AM', '05:13 PM'),
(87, '2016-01-16 11:56:48', '0', '20', '53', '1018', '20', 'NW', '17', '23', '13', 'Sunny', '0', '0', '0', '06:36 AM', '05:13 PM'),
(88, '2016-01-17 12:52:42', '0', '28', '51', '1014', '27', 'WNW', '5', '26', '16', 'Sunny', '0', '0', '0', '06:36 AM', '05:14 PM'),
(89, '2016-01-17 17:01:07', '0', '26', '57', '1011', '25', 'WNW', '5', '25', '17', 'Sunny', '0', '0', '0', '06:36 AM', '05:14 PM'),
(90, '2016-01-17 21:11:24', '0', '19', '78', '1012', '19', 'WNW', '5', '25', '17', 'Clear', '0', '0', '0', '06:36 AM', '05:14 PM'),
(91, '2016-01-18 11:03:00', '0', '20', '40', '1015', '20', 'WNW', '10', '20', '13', 'Sunny', '0', '0', '0', '06:36 AM', '05:15 PM'),
(92, '2016-01-18 15:35:37', '0', '20', '12', '1013', '20', 'WNW', '10', '20', '13', 'Sand', '0', '0', '0', '06:36 AM', '05:15 PM'),
(93, '2016-01-18 21:24:47', '0', '14', '27', '1017', '15', 'WNW', '10', '21', '13', 'Clear', '0', '0', '0', '06:36 AM', '05:15 PM'),
(94, '2016-01-19 10:24:29', '0', '13', '38', '1021', '14', 'WNW', '27', '18', '13', 'Sunny', '0', '0', '0', '06:36 AM', '05:16 PM'),
(95, '2016-01-19 14:34:30', '0', '20', '28', '1019', '20', 'WNW', '27', '18', '13', 'Sunny', '0', '0', '0', '06:36 AM', '05:16 PM'),
(96, '2016-01-19 18:53:02', '0', '17', '36', '1019', '17', 'WNW', '27', '20', '13', 'Clear', '0', '0', '0', '06:36 AM', '05:16 PM'),
(97, '2016-01-19 22:54:06', '0', '12', '41', '1022', '14', 'WNW', '27', '20', '13', 'Clear', '0', '0', '0', '06:36 AM', '05:16 PM'),
(98, '2016-01-20 13:07:58', '0', '19', '40', '1021', '19', 'NW', '23', '20', '13', 'Sunny', '0', '0', '0', '06:36 AM', '05:17 PM'),
(99, '2016-01-20 17:08:13', '0', '20', '43', '1019', '20', 'NW', '23', '21', '14', 'Sunny', '0', '0', '0', '06:36 AM', '05:17 PM'),
(100, '2016-01-20 21:24:41', '0', '14', '59', '1020', '15', 'NW', '23', '21', '14', 'Clear', '0', '0', '0', '06:36 AM', '05:17 PM'),
(101, '2016-01-21 11:54:06', '0', '17', '48', '1020', '17', 'NW', '19', '23', '15', 'Sunny', '0', '0', '0', '06:36 AM', '05:17 PM'),
(102, '2016-01-21 15:57:04', '0', '24', '43', '1016', '22', 'NW', '19', '23', '15', 'Sunny', '0', '0', '0', '06:36 AM', '05:17 PM'),
(103, '2016-01-21 19:59:30', '0', '18', '60', '1016', '18', 'NW', '19', '24', '15', 'Clear', '0', '0', '0', '06:36 AM', '05:17 PM'),
(104, '2016-01-22 00:37:13', '0', '12', '55', '1017', '14', 'NW', '21', '24', '15', 'Clear', '0', '0', '0', '06:35 AM', '05:18 PM'),
(105, '2016-01-22 04:38:44', '0', '11', '54', '1016', '13', 'NW', '21', '24', '15', 'Clear', '0', '0', '0', '06:35 AM', '05:18 PM'),
(106, '2016-01-22 12:16:26', '0', '20', '46', '1016', '20', 'NW', '22', '24', '15', 'Sunny', '0', '0', '0', '06:35 AM', '05:18 PM'),
(107, '2016-01-22 17:10:09', '0', '20', '60', '1013', '20', 'NW', '22', '24', '16', 'Sunny', '0', '0', '0', '06:35 AM', '05:18 PM'),
(108, '2016-01-22 21:12:03', '0', '17', '52', '1016', '17', 'NW', '22', '24', '16', 'Clear', '0', '0', '0', '06:35 AM', '05:18 PM'),
(109, '2016-01-23 15:11:50', '0', '20', '46', '1016', '20', 'WNW', '27', '21', '14', 'Sunny', '0', '0', '0', '06:35 AM', '05:19 PM'),
(110, '2016-01-23 20:12:35', '75', '17', '45', '1017', '17', 'WNW', '27', '21', '14', 'Partly Cloudy', '0', '0', '0', '06:35 AM', '05:19 PM'),
(111, '2016-01-24 00:13:45', '0', '12', '55', '1019', '14', 'WNW', '33', '19', '11', 'Clear', '0', '0', '0', '06:35 AM', '05:20 PM'),
(112, '2016-01-24 04:15:09', '0', '9', '62', '1019', '12', 'WNW', '33', '19', '11', 'Clear', '0', '0', '0', '06:35 AM', '05:20 PM'),
(113, '2016-01-24 10:10:33', '0', '13', '55', '1022', '15', 'WNW', '33', '19', '11', 'Sunny', '0', '0', '0', '06:35 AM', '05:20 PM'),
(114, '2016-01-24 14:18:37', '50', '19', '40', '1021', '19', 'WNW', '33', '19', '11', 'Partly Cloudy', '0', '0', '0', '06:35 AM', '05:20 PM'),
(115, '2016-01-24 21:56:57', '0', '12', '67', '1024', '14', 'WNW', '33', '20', '11', 'Clear', '0', '0', '0', '06:35 AM', '05:20 PM'),
(116, '2016-01-26 00:03:55', '0', '10', '58', '1025', '11', 'WNW', '25', '18', '11', 'Clear', '0', '0', '0', '06:34 AM', '05:21 PM'),
(117, '2016-01-26 10:09:58', '0', '12', '38', '1024', '14', 'WNW', '24', '18', '12', 'Sunny', '0', '0', '0', '06:34 AM', '05:21 PM'),
(118, '2016-01-26 14:46:40', '25', '17', '32', '1023', '17', 'WNW', '24', '18', '12', 'Partly Cloudy', '0', '0', '0', '06:34 AM', '05:21 PM'),
(119, '2016-01-27 07:17:09', '0', '5', '53', '1023', '8', 'WNW', '23', '17', '11', 'Sunny', '0', '0', '0', '06:34 AM', '05:22 PM'),
(120, '2016-02-03 18:26:50', '0', '24', '41', '1021', '22', 'WNW', '20', '23', '13', 'Clear', '0', '0', '0', '06:31 AM', '05:28 PM'),
(121, '2016-02-04 10:52:47', '0', '21', '40', '1023', '21', 'W', '6', '25', '14', 'Sunny', '0', '0', '0', '06:30 AM', '05:29 PM'),
(122, '2016-02-05 17:59:30', '0', '27', '42', '1013', '27', 'NE', '3', '28', '17', 'Clear', '0', '0', '0', '06:29 AM', '05:29 PM'),
(123, '2016-02-07 17:35:00', '0', '18', '39', '1019', '18', 'NW', '30', '19', '12', 'Clear', '0', '0', '0', '06:28 AM', '05:31 PM'),
(124, '2016-02-10 00:39:10', '0', '12', '55', '1017', '14', 'WNW', '27', '19', '14', 'Clear', '0', '0', '0', '06:26 AM', '05:33 PM'),
(125, '2016-02-12 01:47:07', '0', '12', '51', '1022', '13', 'NW', '16', '24', '16', 'Clear', '0', '0', '0', '06:25 AM', '05:35 PM'),
(126, '2016-02-13 21:00:40', '0', '19', '60', '1017', '19', 'NW', '14', '28', '18', 'Clear', '0', '0', '0', '06:24 AM', '05:35 PM'),
(127, '2016-02-14 15:41:03', '0', '27', '25', '1016', '28', 'WNW', '18', '27', '18', 'Sunny', '0', '0', '0', '06:23 AM', '05:36 PM'),
(128, '2016-02-15 11:22:47', '0', '24', '22', '1020', '25', 'WNW', '14', '27', '18', 'Sunny', '0', '0', '0', '06:23 AM', '05:37 PM'),
(129, '2016-02-16 18:55:36', '0', '25', '23', '1020', '26', 'WNW', '12', '29', '18', 'Clear', '0', '0', '0', '06:22 AM', '05:37 PM'),
(130, '2016-02-17 10:57:22', '0', '27', '28', '1023', '28', 'WNW', '5', '29', '18', 'Sunny', '0', '0', '0', '06:21 AM', '05:38 PM'),
(131, '2016-02-22 15:24:40', '50', '21', '33', '1012', '21', 'WNW', '28', '21', '15', 'Partly Cloudy', '0', '0', '0', '06:17 AM', '05:41 PM');

-- --------------------------------------------------------

--
-- Table structure for table `weather_days`
--

DROP TABLE IF EXISTS `weather_days`;
CREATE TABLE IF NOT EXISTS `weather_days` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `w_id` bigint(20) NOT NULL,
  `dayName` text NOT NULL,
  `w_temp` text NOT NULL,
  `w_descr` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=525 ;

--
-- Dumping data for table `weather_days`
--

INSERT INTO `weather_days` (`id`, `w_id`, `dayName`, `w_temp`, `w_descr`) VALUES
(1, 1, 'Tue', '27', 'Clear'),
(2, 1, 'Wed', '26', 'Clear'),
(3, 1, 'Thu', '27', 'Clear'),
(4, 1, 'Fri', '28', 'Clear'),
(5, 2, 'Tue', '27', 'Clear'),
(6, 2, 'Wed', '26', 'Clear'),
(7, 2, 'Thu', '27', 'Clear'),
(8, 2, 'Fri', '28', 'Clear'),
(9, 3, 'Thu', '28', 'Clear'),
(10, 3, 'Fri', '29', 'Clear'),
(11, 3, 'Sat', '30', 'Clear'),
(12, 3, 'Sun', '27', 'Clear'),
(13, 4, 'Fri', '28', 'Clear'),
(14, 4, 'Sat', '30', 'Clear'),
(15, 4, 'Sun', '27', 'Clear'),
(16, 4, 'Mon', '28', 'Clear'),
(17, 5, 'Mon', '28', 'Clear'),
(18, 5, 'Tue', '27', 'Clear'),
(19, 5, 'Wed', '27', 'Clear'),
(20, 5, 'Thu', '28', 'Clear'),
(21, 6, 'Thu', '29', 'Clear'),
(22, 6, 'Fri', '28', 'Clear'),
(23, 6, 'Sat', '30', 'Clear'),
(24, 6, 'Sun', '28', 'Clear'),
(25, 7, 'Thu', '29', 'Clear'),
(26, 7, 'Fri', '28', 'Clear'),
(27, 7, 'Sat', '30', 'Clear'),
(28, 7, 'Sun', '28', 'Clear'),
(29, 8, 'Fri', '28', 'Clear'),
(30, 8, 'Sat', '30', 'Clear'),
(31, 8, 'Sun', '28', 'Clear'),
(32, 8, 'Mon', '28', 'Partly Cloudy'),
(33, 9, 'Fri', '29', 'Clear'),
(34, 9, 'Sat', '30', 'Clear'),
(35, 9, 'Sun', '28', 'Clear'),
(36, 9, 'Mon', '27', 'Partly Cloudy'),
(37, 10, 'Sat', '29', 'Clear'),
(38, 10, 'Sun', '28', 'Clear'),
(39, 10, 'Mon', '27', 'Clear'),
(40, 10, 'Tue', '25', 'Clear'),
(41, 11, 'Mon', '29', 'Cloudy'),
(42, 11, 'Tue', '25', 'Clear'),
(43, 11, 'Wed', '23', 'Clear'),
(44, 11, 'Thu', '23', 'Clear'),
(45, 12, 'Tue', '25', 'Clear'),
(46, 12, 'Wed', '23', 'Clear'),
(47, 12, 'Thu', '24', 'Clear'),
(48, 12, 'Fri', '24', 'Clear'),
(49, 13, 'Wed', '23', 'Clear'),
(50, 13, 'Thu', '24', 'Clear'),
(51, 13, 'Fri', '25', 'Clear'),
(52, 13, 'Sat', '25', 'Clear'),
(53, 14, 'Wed', '24', 'Clear'),
(54, 14, 'Thu', '24', 'Clear'),
(55, 14, 'Fri', '25', 'Clear'),
(56, 14, 'Sat', '23', 'Clear'),
(57, 15, 'Thu', '24', 'Clear'),
(58, 15, 'Fri', '25', 'Clear'),
(59, 15, 'Sat', '23', 'Clear'),
(60, 15, 'Sun', '21', 'Clear'),
(61, 16, 'Fri', '24', 'Clear'),
(62, 16, 'Sat', '23', 'Clear'),
(63, 16, 'Sun', '21', 'Clear'),
(64, 16, 'Mon', '22', 'Clear'),
(65, 17, 'Mon', '23', 'Clear'),
(66, 17, 'Tue', '23', 'Clear'),
(67, 17, 'Wed', '25', 'Clear'),
(68, 17, 'Thu', '24', 'Clear'),
(69, 18, 'Mon', '23', 'Clear'),
(70, 18, 'Tue', '23', 'Clear'),
(71, 18, 'Wed', '25', 'Clear'),
(72, 18, 'Thu', '24', 'Clear'),
(73, 19, 'Mon', '22', 'Clear'),
(74, 19, 'Tue', '24', 'Clear'),
(75, 19, 'Wed', '25', 'Clear'),
(76, 19, 'Thu', '23', 'Clear'),
(77, 20, 'Tue', '23', 'Clear'),
(78, 20, 'Wed', '24', 'Clear'),
(79, 20, 'Thu', '23', 'Clear'),
(80, 20, 'Fri', '23', 'Clear'),
(81, 21, 'Fri', '24', 'Clear'),
(82, 21, 'Sat', '23', 'Clear'),
(83, 21, 'Sun', '21', 'Clear'),
(84, 21, 'Mon', '20', 'Clear'),
(85, 22, 'Mon', '20', 'Clear'),
(86, 22, 'Tue', '23', 'Clear'),
(87, 22, 'Wed', '24', 'Clear'),
(88, 22, 'Thu', '23', 'Clear'),
(89, 23, 'Mon', '20', 'Clear'),
(90, 23, 'Tue', '22', 'Clear'),
(91, 23, 'Wed', '24', 'Clear'),
(92, 23, 'Thu', '23', 'Clear'),
(93, 24, 'Tue', '22', 'Clear'),
(94, 24, 'Wed', '24', 'Clear'),
(95, 24, 'Thu', '23', 'Clear'),
(96, 24, 'Fri', '21', 'Clear'),
(97, 25, 'Tue', '22', 'Clear'),
(98, 25, 'Wed', '24', 'Clear'),
(99, 25, 'Thu', '23', 'Clear'),
(100, 25, 'Fri', '22', 'Clear'),
(101, 26, 'Wed', '24', 'Clear'),
(102, 26, 'Thu', '22', 'Clear'),
(103, 26, 'Fri', '22', 'Clear'),
(104, 26, 'Sat', '23', 'Clear'),
(105, 27, 'Wed', '24', 'Clear'),
(106, 27, 'Thu', '24', 'Clear'),
(107, 27, 'Fri', '22', 'Clear'),
(108, 27, 'Sat', '23', 'Clear'),
(109, 28, 'Thu', '23', 'Clear'),
(110, 28, 'Fri', '21', 'Clear'),
(111, 28, 'Sat', '23', 'Clear'),
(112, 28, 'Sun', '23', 'Clear'),
(113, 29, 'Thu', '23', 'Clear'),
(114, 29, 'Fri', '22', 'Clear'),
(115, 29, 'Sat', '22', 'Clear'),
(116, 29, 'Sun', '22', 'Clear'),
(117, 30, 'Fri', '22', 'Clear'),
(118, 30, 'Sat', '23', 'Clear'),
(119, 30, 'Sun', '22', 'Clear'),
(120, 30, 'Mon', '23', 'Clear'),
(121, 31, 'Mon', '23', 'Clear'),
(122, 31, 'Tue', '22', 'Clear'),
(123, 31, 'Wed', '23', 'Clear'),
(124, 31, 'Thu', '22', 'Clear'),
(125, 32, 'Mon', '22', 'Clear'),
(126, 32, 'Tue', '23', 'Clear'),
(127, 32, 'Wed', '22', 'Clear'),
(128, 32, 'Thu', '21', 'Clear'),
(129, 33, 'Tue', '22', 'Clear'),
(130, 33, 'Wed', '22', 'Clear'),
(131, 33, 'Thu', '21', 'Clear'),
(132, 33, 'Fri', '22', 'Clear'),
(133, 34, 'Tue', '23', 'Clear'),
(134, 34, 'Wed', '22', 'Clear'),
(135, 34, 'Thu', '21', 'Clear'),
(136, 34, 'Fri', '21', 'Clear'),
(137, 35, 'Wed', '22', 'Clear'),
(138, 35, 'Thu', '21', 'Clear'),
(139, 35, 'Fri', '21', 'Clear'),
(140, 35, 'Sat', '22', 'Clear'),
(141, 36, 'Fri', '21', 'Clear'),
(142, 36, 'Sat', '22', 'Clear'),
(143, 36, 'Sun', '23', 'Clear'),
(144, 36, 'Mon', '23', 'Clear'),
(145, 37, 'Fri', '21', 'Clear'),
(146, 37, 'Sat', '22', 'Clear'),
(147, 37, 'Sun', '23', 'Clear'),
(148, 37, 'Mon', '23', 'Clear'),
(149, 38, 'Sun', '23', 'Clear'),
(150, 38, 'Mon', '24', 'Clear'),
(151, 38, 'Tue', '25', 'Clear'),
(152, 38, 'Wed', '22', 'Clear'),
(153, 39, 'Sun', '23', 'Clear'),
(154, 39, 'Mon', '24', 'Clear'),
(155, 39, 'Tue', '26', 'Clear'),
(156, 39, 'Wed', '22', 'Clear'),
(157, 40, 'Mon', '24', 'Clear'),
(158, 40, 'Tue', '26', 'Clear'),
(159, 40, 'Wed', '22', 'Clear'),
(160, 40, 'Thu', '22', 'Clear'),
(161, 41, 'Mon', '24', 'Clear'),
(162, 41, 'Tue', '26', 'Clear'),
(163, 41, 'Wed', '22', 'Clear'),
(164, 41, 'Thu', '22', 'Clear'),
(165, 42, 'Mon', '24', 'Clear'),
(166, 42, 'Tue', '27', 'Clear'),
(167, 42, 'Wed', '22', 'Clear'),
(168, 42, 'Thu', '22', 'Clear'),
(169, 43, 'Tue', '26', 'Clear'),
(170, 43, 'Wed', '22', 'Clear'),
(171, 43, 'Thu', '23', 'Clear'),
(172, 43, 'Fri', '22', 'Cloudy'),
(173, 44, 'Tue', '28', 'Clear'),
(174, 44, 'Wed', '22', 'Clear'),
(175, 44, 'Thu', '23', 'Clear'),
(176, 44, 'Fri', '20', 'Clear'),
(177, 45, 'Wed', '21', 'Clear'),
(178, 45, 'Thu', '22', 'Clear'),
(179, 45, 'Fri', '20', 'Clear'),
(180, 45, 'Sat', '18', 'Clear'),
(181, 46, 'Thu', '22', 'Clear'),
(182, 46, 'Fri', '19', 'Clear'),
(183, 46, 'Sat', '17', 'Clear'),
(184, 46, 'Sun', '20', 'Clear'),
(185, 47, 'Thu', '22', 'Clear'),
(186, 47, 'Fri', '19', 'Clear'),
(187, 47, 'Sat', '19', 'Clear'),
(188, 47, 'Sun', '20', 'Clear'),
(189, 48, 'Thu', '23', 'Clear'),
(190, 48, 'Fri', '18', 'Clear'),
(191, 48, 'Sat', '16', 'Clear'),
(192, 48, 'Sun', '20', 'Clear'),
(193, 49, 'Fri', '19', 'Clear'),
(194, 49, 'Sat', '16', 'Clear'),
(195, 49, 'Sun', '20', 'Clear'),
(196, 49, 'Mon', '23', 'Clear'),
(197, 50, 'Fri', '18', 'Clear'),
(198, 50, 'Sat', '16', 'Clear'),
(199, 50, 'Sun', '21', 'Clear'),
(200, 50, 'Mon', '23', 'Clear'),
(201, 51, 'Fri', '19', 'Clear'),
(202, 51, 'Sat', '16', 'Clear'),
(203, 51, 'Sun', '20', 'Clear'),
(204, 51, 'Mon', '23', 'Partly Cloudy'),
(205, 52, 'Sat', '17', 'Clear'),
(206, 52, 'Sun', '20', 'Clear'),
(207, 52, 'Mon', '23', 'Clear'),
(208, 52, 'Tue', '23', 'Clear'),
(209, 53, 'Sun', '20', 'Clear'),
(210, 53, 'Mon', '23', 'Clear'),
(211, 53, 'Tue', '23', 'Clear'),
(212, 53, 'Wed', '24', 'Clear'),
(213, 54, 'Sun', '20', 'Clear'),
(214, 54, 'Mon', '23', 'Clear'),
(215, 54, 'Tue', '23', 'Clear'),
(216, 54, 'Wed', '24', 'Clear'),
(217, 55, 'Sun', '19', 'Clear'),
(218, 55, 'Mon', '23', 'Clear'),
(219, 55, 'Tue', '23', 'Clear'),
(220, 55, 'Wed', '24', 'Clear'),
(221, 56, 'Sun', '19', 'Clear'),
(222, 56, 'Mon', '23', 'Clear'),
(223, 56, 'Tue', '23', 'Clear'),
(224, 56, 'Wed', '24', 'Clear'),
(225, 57, 'Mon', '22', 'Clear'),
(226, 57, 'Tue', '22', 'Clear'),
(227, 57, 'Wed', '24', 'Clear'),
(228, 57, 'Thu', '27', 'Clear'),
(229, 58, 'Mon', '22', 'Clear'),
(230, 58, 'Tue', '22', 'Clear'),
(231, 58, 'Wed', '24', 'Clear'),
(232, 58, 'Thu', '27', 'Clear'),
(233, 59, 'Mon', '22', 'Partly Cloudy'),
(234, 59, 'Tue', '23', 'Clear'),
(235, 59, 'Wed', '25', 'Clear'),
(236, 59, 'Thu', '26', 'Clear'),
(237, 60, 'Tue', '24', 'Clear'),
(238, 60, 'Wed', '24', 'Clear'),
(239, 60, 'Thu', '27', 'Clear'),
(240, 60, 'Fri', '23', 'Clear'),
(241, 61, 'Tue', '24', 'Clear'),
(242, 61, 'Wed', '24', 'Clear'),
(243, 61, 'Thu', '27', 'Clear'),
(244, 61, 'Fri', '23', 'Clear'),
(245, 62, 'Tue', '23', 'Clear'),
(246, 62, 'Wed', '26', 'Clear'),
(247, 62, 'Thu', '27', 'Clear'),
(248, 62, 'Fri', '22', 'Clear'),
(249, 63, 'Wed', '25', 'Clear'),
(250, 63, 'Thu', '26', 'Clear'),
(251, 63, 'Fri', '21', 'Clear'),
(252, 63, 'Sat', '23', 'Clear'),
(253, 64, 'Wed', '25', 'Clear'),
(254, 64, 'Thu', '28', 'Clear'),
(255, 64, 'Fri', '23', 'Clear'),
(256, 64, 'Sat', '22', 'Clear'),
(257, 65, 'Wed', '25', 'Clear'),
(258, 65, 'Thu', '28', 'Clear'),
(259, 65, 'Fri', '23', 'Clear'),
(260, 65, 'Sat', '22', 'Clear'),
(261, 66, 'Thu', '28', 'Clear'),
(262, 66, 'Fri', '23', 'Clear'),
(263, 66, 'Sat', '23', 'Clear'),
(264, 66, 'Sun', '23', 'Clear'),
(265, 67, 'Sat', '23', 'Clear'),
(266, 67, 'Sun', '23', 'Clear'),
(267, 67, 'Mon', '25', 'Clear'),
(268, 67, 'Tue', '23', 'Clear'),
(269, 68, 'Sat', '22', 'Clear'),
(270, 68, 'Sun', '23', 'Clear'),
(271, 68, 'Mon', '24', 'Clear'),
(272, 68, 'Tue', '23', 'Clear'),
(273, 69, 'Sat', '22', 'Clear'),
(274, 69, 'Sun', '23', 'Clear'),
(275, 69, 'Mon', '23', 'Clear'),
(276, 69, 'Tue', '23', 'Clear'),
(277, 70, 'Sun', '23', 'Clear'),
(278, 70, 'Mon', '25', 'Clear'),
(279, 70, 'Tue', '24', 'Clear'),
(280, 70, 'Wed', '25', 'Clear'),
(281, 71, 'Sun', '22', 'Clear'),
(282, 71, 'Mon', '24', 'Clear'),
(283, 71, 'Tue', '24', 'Clear'),
(284, 71, 'Wed', '24', 'Clear'),
(285, 72, 'Mon', '24', 'Clear'),
(286, 72, 'Tue', '24', 'Clear'),
(287, 72, 'Wed', '26', 'Clear'),
(288, 72, 'Thu', '25', 'Clear'),
(289, 73, 'Mon', '24', 'Clear'),
(290, 73, 'Tue', '24', 'Clear'),
(291, 73, 'Wed', '24', 'Clear'),
(292, 73, 'Thu', '24', 'Clear'),
(293, 74, 'Mon', '24', 'Clear'),
(294, 74, 'Tue', '24', 'Clear'),
(295, 74, 'Wed', '24', 'Clear'),
(296, 74, 'Thu', '24', 'Clear'),
(297, 75, 'Tue', '24', 'Clear'),
(298, 75, 'Wed', '24', 'Clear'),
(299, 75, 'Thu', '25', 'Clear'),
(300, 75, 'Fri', '22', 'Clear'),
(301, 76, 'Tue', '24', 'Clear'),
(302, 76, 'Wed', '24', 'Clear'),
(303, 76, 'Thu', '25', 'Clear'),
(304, 76, 'Fri', '22', 'Clear'),
(305, 77, 'Tue', '24', 'Clear'),
(306, 77, 'Wed', '25', 'Clear'),
(307, 77, 'Thu', '25', 'Clear'),
(308, 77, 'Fri', '24', 'Clear'),
(309, 78, 'Wed', '25', 'Clear'),
(310, 78, 'Thu', '25', 'Clear'),
(311, 78, 'Fri', '22', 'Clear'),
(312, 78, 'Sat', '23', 'Clear'),
(313, 79, 'Wed', '25', 'Clear'),
(314, 79, 'Thu', '25', 'Clear'),
(315, 79, 'Fri', '22', 'Clear'),
(316, 79, 'Sat', '23', 'Clear'),
(317, 80, 'Thu', '25', 'Clear'),
(318, 80, 'Fri', '23', 'Clear'),
(319, 80, 'Sat', '23', 'Clear'),
(320, 80, 'Sun', '25', 'Clear'),
(321, 81, 'Thu', '25', 'Clear'),
(322, 81, 'Fri', '23', 'Clear'),
(323, 81, 'Sat', '24', 'Clear'),
(324, 81, 'Sun', '26', 'Clear'),
(325, 82, 'Thu', '25', 'Clear'),
(326, 82, 'Fri', '23', 'Clear'),
(327, 82, 'Sat', '24', 'Clear'),
(328, 82, 'Sun', '26', 'Clear'),
(329, 83, 'Fri', '23', 'Clear'),
(330, 83, 'Sat', '23', 'Clear'),
(331, 83, 'Sun', '26', 'Clear'),
(332, 83, 'Mon', '19', 'Clear'),
(333, 84, 'Fri', '23', 'Clear'),
(334, 84, 'Sat', '23', 'Clear'),
(335, 84, 'Sun', '26', 'Clear'),
(336, 84, 'Mon', '19', 'Clear'),
(337, 85, 'Fri', '22', 'Clear'),
(338, 85, 'Sat', '24', 'Clear'),
(339, 85, 'Sun', '26', 'Clear'),
(340, 85, 'Mon', '21', 'Clear'),
(341, 86, 'Sat', '23', 'Clear'),
(342, 86, 'Sun', '26', 'Clear'),
(343, 86, 'Mon', '21', 'Clear'),
(344, 86, 'Tue', '18', 'Clear'),
(345, 87, 'Sun', '25', 'Partly Cloudy'),
(346, 87, 'Mon', '22', 'Clear'),
(347, 87, 'Tue', '18', 'Clear'),
(348, 87, 'Wed', '18', 'Clear'),
(349, 88, 'Mon', '21', 'Clear'),
(350, 88, 'Tue', '19', 'Clear'),
(351, 88, 'Wed', '19', 'Clear'),
(352, 88, 'Thu', '20', 'Clear'),
(353, 89, 'Mon', '21', 'Clear'),
(354, 89, 'Tue', '18', 'Clear'),
(355, 89, 'Wed', '20', 'Clear'),
(356, 89, 'Thu', '22', 'Clear'),
(357, 90, 'Mon', '21', 'Clear'),
(358, 90, 'Tue', '18', 'Clear'),
(359, 90, 'Wed', '20', 'Clear'),
(360, 90, 'Thu', '22', 'Clear'),
(361, 91, 'Tue', '18', 'Clear'),
(362, 91, 'Wed', '20', 'Clear'),
(363, 91, 'Thu', '22', 'Clear'),
(364, 91, 'Fri', '23', 'Clear'),
(365, 92, 'Tue', '18', 'Clear'),
(366, 92, 'Wed', '20', 'Clear'),
(367, 92, 'Thu', '22', 'Clear'),
(368, 92, 'Fri', '23', 'Clear'),
(369, 93, 'Tue', '18', 'Clear'),
(370, 93, 'Wed', '21', 'Clear'),
(371, 93, 'Thu', '23', 'Clear'),
(372, 93, 'Fri', '24', 'Clear'),
(373, 94, 'Wed', '20', 'Clear'),
(374, 94, 'Thu', '23', 'Clear'),
(375, 94, 'Fri', '24', 'Clear'),
(376, 94, 'Sat', '23', 'Partly Cloudy'),
(377, 95, 'Wed', '20', 'Clear'),
(378, 95, 'Thu', '23', 'Clear'),
(379, 95, 'Fri', '24', 'Clear'),
(380, 95, 'Sat', '23', 'Partly Cloudy'),
(381, 96, 'Wed', '20', 'Clear'),
(382, 96, 'Thu', '23', 'Partly Cloudy'),
(383, 96, 'Fri', '24', 'Clear'),
(384, 96, 'Sat', '22', 'Clear'),
(385, 97, 'Wed', '20', 'Clear'),
(386, 97, 'Thu', '24', 'Partly Cloudy'),
(387, 97, 'Fri', '24', 'Clear'),
(388, 97, 'Sat', '21', 'Clear'),
(389, 98, 'Thu', '23', 'Cloudy'),
(390, 98, 'Fri', '24', 'Clear'),
(391, 98, 'Sat', '21', 'Clear'),
(392, 98, 'Sun', '20', 'Clear'),
(393, 99, 'Thu', '24', 'Clear'),
(394, 99, 'Fri', '23', 'Clear'),
(395, 99, 'Sat', '21', 'Clear'),
(396, 99, 'Sun', '16', 'Clear'),
(397, 100, 'Thu', '24', 'Clear'),
(398, 100, 'Fri', '23', 'Clear'),
(399, 100, 'Sat', '21', 'Clear'),
(400, 100, 'Sun', '16', 'Clear'),
(401, 101, 'Fri', '23', 'Clear'),
(402, 101, 'Sat', '20', 'Clear'),
(403, 101, 'Sun', '17', 'Cloudy'),
(404, 101, 'Mon', '17', 'Clear'),
(405, 102, 'Fri', '23', 'Clear'),
(406, 102, 'Sat', '20', 'Clear'),
(407, 102, 'Sun', '17', 'Cloudy'),
(408, 102, 'Mon', '17', 'Clear'),
(409, 103, 'Fri', '23', 'Clear'),
(410, 103, 'Sat', '21', 'Clear'),
(411, 103, 'Sun', '16', 'Clear'),
(412, 103, 'Mon', '18', 'Clear'),
(413, 104, 'Sat', '21', 'Clear'),
(414, 104, 'Sun', '17', 'Clear'),
(415, 104, 'Mon', '18', 'Clear'),
(416, 104, 'Tue', '19', 'Clear'),
(417, 105, 'Sat', '21', 'Clear'),
(418, 105, 'Sun', '17', 'Clear'),
(419, 105, 'Mon', '18', 'Clear'),
(420, 105, 'Tue', '19', 'Clear'),
(421, 106, 'Sat', '21', 'Clear'),
(422, 106, 'Sun', '16', 'Clear'),
(423, 106, 'Mon', '18', 'Clear'),
(424, 106, 'Tue', '17', 'Clear'),
(425, 107, 'Sat', '21', 'Clear'),
(426, 107, 'Sun', '19', 'Clear'),
(427, 107, 'Mon', '17', 'Clear'),
(428, 107, 'Tue', '18', 'Clear'),
(429, 108, 'Sat', '21', 'Clear'),
(430, 108, 'Sun', '19', 'Clear'),
(431, 108, 'Mon', '17', 'Clear'),
(432, 108, 'Tue', '18', 'Clear'),
(433, 109, 'Sun', '19', 'Clear'),
(434, 109, 'Mon', '17', 'Clear'),
(435, 109, 'Tue', '17', 'Clear'),
(436, 109, 'Wed', '15', 'Clear'),
(437, 110, 'Sun', '19', 'Clear'),
(438, 110, 'Mon', '17', 'Clear'),
(439, 110, 'Tue', '18', 'Clear'),
(440, 110, 'Wed', '16', 'Clear'),
(441, 111, 'Mon', '17', 'Clear'),
(442, 111, 'Tue', '18', 'Clear'),
(443, 111, 'Wed', '15', 'Clear'),
(444, 111, 'Thu', '16', 'Clear'),
(445, 112, 'Mon', '17', 'Clear'),
(446, 112, 'Tue', '18', 'Clear'),
(447, 112, 'Wed', '15', 'Clear'),
(448, 112, 'Thu', '16', 'Clear'),
(449, 113, 'Mon', '17', 'Clear'),
(450, 113, 'Tue', '17', 'Partly Cloudy'),
(451, 113, 'Wed', '16', 'Partly Cloudy'),
(452, 113, 'Thu', '16', 'Clear'),
(453, 114, 'Mon', '17', 'Clear'),
(454, 114, 'Tue', '17', 'Partly Cloudy'),
(455, 114, 'Wed', '16', 'Partly Cloudy'),
(456, 114, 'Thu', '16', 'Clear'),
(457, 115, 'Mon', '17', 'Clear'),
(458, 115, 'Tue', '18', 'Cloudy'),
(459, 115, 'Wed', '15', 'Clear'),
(460, 115, 'Thu', '15', 'Clear'),
(461, 116, 'Wed', '17', 'Clear'),
(462, 116, 'Thu', '16', 'Clear'),
(463, 116, 'Fri', '17', 'Clear'),
(464, 116, 'Sat', '19', 'Clear'),
(465, 117, 'Wed', '15', 'Clear'),
(466, 117, 'Thu', '17', 'Clear'),
(467, 117, 'Fri', '17', 'Clear'),
(468, 117, 'Sat', '19', 'Clear'),
(469, 118, 'Wed', '15', 'Clear'),
(470, 118, 'Thu', '17', 'Clear'),
(471, 118, 'Fri', '17', 'Clear'),
(472, 118, 'Sat', '19', 'Clear'),
(473, 119, 'Thu', '17', 'Clear'),
(474, 119, 'Fri', '17', 'Clear'),
(475, 119, 'Sat', '19', 'Clear'),
(476, 119, 'Sun', '22', 'Clear'),
(477, 120, 'Thu', '25', 'Clear'),
(478, 120, 'Fri', '27', 'Clear'),
(479, 120, 'Sat', '23', 'Clear'),
(480, 120, 'Sun', '19', 'Clear'),
(481, 121, 'Fri', '26', 'Clear'),
(482, 121, 'Sat', '24', 'Clear'),
(483, 121, 'Sun', '20', 'Clear'),
(484, 121, 'Mon', '21', 'Clear'),
(485, 122, 'Sat', '23', 'Clear'),
(486, 122, 'Sun', '19', 'Clear'),
(487, 122, 'Mon', '19', 'Clear'),
(488, 122, 'Tue', '22', 'Clear'),
(489, 123, 'Mon', '19', 'Clear'),
(490, 123, 'Tue', '22', 'Clear'),
(491, 123, 'Wed', '20', 'Clear'),
(492, 123, 'Thu', '21', 'Clear'),
(493, 124, 'Thu', '21', 'Clear'),
(494, 124, 'Fri', '24', 'Clear'),
(495, 124, 'Sat', '26', 'Clear'),
(496, 124, 'Sun', '27', 'Clear'),
(497, 125, 'Sat', '27', 'Clear'),
(498, 125, 'Sun', '27', 'Clear'),
(499, 125, 'Mon', '28', 'Clear'),
(500, 125, 'Tue', '29', 'Clear'),
(501, 126, 'Sun', '28', 'Clear'),
(502, 126, 'Mon', '28', 'Clear'),
(503, 126, 'Tue', '28', 'Clear'),
(504, 126, 'Wed', '29', 'Clear'),
(505, 127, 'Mon', '27', 'Clear'),
(506, 127, 'Tue', '28', 'Clear'),
(507, 127, 'Wed', '28', 'Clear'),
(508, 127, 'Thu', '29', 'Partly Cloudy'),
(509, 128, 'Tue', '28', 'Clear'),
(510, 128, 'Wed', '29', 'Clear'),
(511, 128, 'Thu', '29', 'Partly Cloudy'),
(512, 128, 'Fri', '29', 'Cloudy'),
(513, 129, 'Wed', '29', 'Clear'),
(514, 129, 'Thu', '29', 'Clear'),
(515, 129, 'Fri', '29', 'Clear'),
(516, 129, 'Sat', '28', 'Clear'),
(517, 130, 'Thu', '29', 'Clear'),
(518, 130, 'Fri', '29', 'Clear'),
(519, 130, 'Sat', '28', 'Clear'),
(520, 130, 'Sun', '28', 'Clear'),
(521, 131, 'Tue', '22', 'Clear'),
(522, 131, 'Wed', '25', 'Clear'),
(523, 131, 'Thu', '27', 'Clear'),
(524, 131, 'Fri', '28', 'Cloudy');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
