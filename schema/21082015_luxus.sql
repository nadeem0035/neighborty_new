-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2015 at 04:53 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `luxus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `active`) VALUES
(1, 'admin@luxus.com', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE IF NOT EXISTS `amenities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `type` enum('common','additional','special','safety') NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `type`, `active`) VALUES
(1, 'Essentials', 'common', 1),
(2, 'TV', 'common', 1),
(3, 'Cable TV', 'common', 1),
(4, 'Air Conditioning', 'common', 1),
(5, 'Heating', 'common', 1),
(6, 'Kitchen', 'common', 1),
(7, 'Internet', 'common', 1),
(8, 'Wireless Internet', 'common', 1),
(9, 'Hot Tub', 'additional', 1),
(10, 'Washer', 'additional', 1),
(11, 'Pool', 'additional', 1),
(12, 'Dryer', 'additional', 1),
(13, 'Breakfast', 'additional', 1),
(14, 'Free Parking on Premises', 'additional', 1),
(15, 'Gym', 'additional', 1),
(16, 'Elevator in Building', 'additional', 1),
(17, 'Indoor Fireplace', 'additional', 1),
(18, 'Buzzer/Wireless Intercom', 'additional', 1),
(19, 'Doorman', 'additional', 1),
(20, 'Shampoo', 'additional', 1),
(21, 'Family/Kid Friendly', 'special', 1),
(22, 'Smoking Allowed ', 'special', 1),
(23, 'Suitable for Events', 'special', 1),
(24, 'Pets Allowed', 'special', 1),
(25, 'Pets live on this property', 'special', 1),
(26, 'Wheelchair Accessible', 'special', 1),
(27, 'Smoke Detector', 'safety', 1),
(28, 'Carbon Monoxide Detector', 'safety', 1),
(29, 'First Aid Kit', 'safety', 1),
(30, 'Safety Card', 'safety', 1),
(31, 'Fire Extinguisher', 'safety', 1);

-- --------------------------------------------------------

--
-- Table structure for table `home_type`
--

CREATE TABLE IF NOT EXISTS `home_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `home_type`
--

INSERT INTO `home_type` (`id`, `name`, `active`) VALUES
(1, 'Apartment', 1),
(2, 'House', 1),
(3, 'Bed & Breakfast', 1),
(4, 'Loft', 1),
(5, 'Town house', 1),
(6, 'Condominium', 1),
(7, 'Bungalow', 1),
(8, 'Cabin', 1),
(9, 'Villa', 1),
(10, 'Castle', 1),
(11, 'Dorm', 1),
(12, 'Tree house', 1),
(13, 'Boat', 1),
(14, 'Plane', 1),
(15, 'Camper/RV', 1),
(16, 'Igloo', 1),
(17, 'Lighthouse', 1),
(18, 'Yurt', 1),
(19, 'Tipi', 1),
(20, 'Cave', 1),
(21, 'Island', 1),
(22, 'Chalet', 1),
(23, 'Earth House', 1),
(24, 'Hut', 1),
(25, 'Train', 1),
(26, 'Tent', 1),
(27, 'Other', 1);

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE IF NOT EXISTS `listing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `listing_name` varchar(250) NOT NULL,
  `summary` text NOT NULL,
  `home_type` varchar(100) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `accommodates` int(11) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `beds` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `additional_note` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_type` (`room_type`),
  KEY `home_type` (`home_type`),
  KEY `location_id` (`location_id`),
  KEY `listing_ibfk_6` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `user_id`, `listing_name`, `summary`, `home_type`, `room_type`, `accommodates`, `bedrooms`, `beds`, `bathrooms`, `location_id`, `price`, `additional_note`, `active`) VALUES
(1, 2, 'Testing', 'A quick brown fox jumps over the lazy dog. a quick brown fox jumps over the lazy dog. a quick brown fox jumpes over the lazy dog', 'Hut', 'Private room', 10, 3, 5, 5, 1, 5455, 'No note', 1);

-- --------------------------------------------------------

--
-- Table structure for table `listing_amenities`
--

CREATE TABLE IF NOT EXISTS `listing_amenities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amenities_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `amenities_id` (`amenities_id`),
  KEY `listing_id` (`listing_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `listing_amenities`
--

INSERT INTO `listing_amenities` (`id`, `amenities_id`, `listing_id`) VALUES
(1, 17, 1),
(2, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `listing_location`
--

CREATE TABLE IF NOT EXISTS `listing_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(30) NOT NULL,
  `address_line_1` varchar(200) NOT NULL,
  `address_line_2` varchar(200) NOT NULL,
  `city_town` varchar(30) NOT NULL,
  `state_province` varchar(30) NOT NULL,
  `zip_postal_code` varchar(20) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `listing_location`
--

INSERT INTO `listing_location` (`id`, `country`, `address_line_1`, `address_line_2`, `city_town`, `state_province`, `zip_postal_code`, `latitude`, `longitude`) VALUES
(1, 'pakistan', 'lahore', 'lahore', 'lahore', 'province', '54200', '52.63114800', '-1.13091600');

-- --------------------------------------------------------

--
-- Table structure for table `listing_pictures`
--

CREATE TABLE IF NOT EXISTS `listing_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `listing_id` (`listing_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `listing_pictures`
--

INSERT INTO `listing_pictures` (`id`, `listing_id`, `picture`, `active`) VALUES
(1, 1, 'f354s9m5m5ck44w.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `listing_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `receiver_id`, `sender_id`, `message`, `listing_id`, `check_in`, `check_out`, `read_status`, `date_time`) VALUES
(1, 3, 2, 'Message goes here message goes here Message goes here message goes here Message goes here message goes here Message goes here message goes here Message goes here message goes here Message goes here message goes here', 1, '2015-08-12', '2015-08-28', 1, '2015-08-19 12:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `listing_id` (`listing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reviews_to` int(11) NOT NULL,
  `reviews_by` int(11) NOT NULL,
  `review` text NOT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `accuracy` int(11) NOT NULL,
  `communication` int(11) NOT NULL,
  `cleanliness` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `check_in` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reviews_by` (`reviews_by`),
  KEY `reviews_to` (`reviews_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `reviews_to`, `reviews_by`, `review`, `listing_id`, `accuracy`, `communication`, `cleanliness`, `location`, `check_in`, `value`, `date_time`) VALUES
(1, 2, 3, 'Great developer Ever.', 1, 5, 5, 5, 5, 5, 5, '2015-08-19 12:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE IF NOT EXISTS `room_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `name`, `active`) VALUES
(1, 'Entire home/apt', 1),
(2, 'Private room', 1),
(3, 'Shared room', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trust_verification`
--

CREATE TABLE IF NOT EXISTS `trust_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `document` varchar(250) NOT NULL,
  `document_type` enum('ID','Passport','Other') NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `trust_verification`
--

INSERT INTO `trust_verification` (`id`, `user_id`, `document`, `document_type`, `active`, `date_time`) VALUES
(1, 3, 'id-eu-passport-back-ver-1439203092000.png', 'ID', 1, '2015-08-19 13:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `picture` varchar(150) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(20) NOT NULL,
  `oauth_provider` varchar(10) NOT NULL,
  `oauth_uid` varchar(20) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `hash`, `phone`, `picture`, `address`, `city`, `state`, `zip`, `country`, `oauth_provider`, `oauth_uid`, `active`, `registered_date`) VALUES
(2, 'Nadeem', 'iqbal', 'nadeem@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', '', 'Desert.jpg', '722 siddiq trade center', 'lahore', 'punjab', '54200', 'pakistan', 'E-mail', NULL, 1, '2015-08-18 08:04:26'),
(3, 'Mr', 'Malik', 'malik@test.com', 'e10adc3949ba59abbe56e057f20f883e', '', '123456', '4v4fj3vw47ms8s8.jpg', '722 siddiq trade center', 'lahore', 'punjab', '54200', 'Pakistan', 'E-mail', NULL, 1, '2015-08-19 12:01:47'),
(11, 'Nadeem', 'iqbal', 'nadeem0035@gmail.com', '25f9e794323b453885f5181f1b624d0b', '', '', '', '', '', '', '', '', 'E-mail', NULL, 1, '2015-08-21 14:37:40');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
