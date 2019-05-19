-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2019 at 05:58 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdpdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `order_grandtotal` double NOT NULL,
  `order_country` varchar(256) NOT NULL,
  `order_province` varchar(256) NOT NULL,
  `order_city` varchar(256) NOT NULL,
  `order_addressline1` varchar(256) NOT NULL,
  `order_addressline2` varchar(256) NOT NULL,
  `order_zipcode` varchar(20) NOT NULL,
  `retailer_id` int(10) NOT NULL,
  `order_status` varchar(5) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `retailer_id` (`retailer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=990614 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_grandtotal`, `order_country`, `order_province`, `order_city`, `order_addressline1`, `order_addressline2`, `order_zipcode`, `retailer_id`, `order_status`) VALUES
(114300, 7, '2019-04-19', 19.84, 'Indonesia', 'South Sumatra', 'Balikpapan', 'Jalan Minang', '29a', '221457', 2, '1'),
(294037, 7, '2019-04-19', 42.1, 'Indonesia', 'South Sumatra', 'Balikpapan', 'Jalan Minang', '29a', '221457', 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_quantity` int(10) NOT NULL,
  UNIQUE KEY `UC_Person` (`order_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `product_quantity`) VALUES
(114300, 7, 1),
(294037, 20, 1),
(294037, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(256) NOT NULL,
  `product_price` double NOT NULL,
  `product_category` varchar(30) DEFAULT NULL,
  `product_desc` text NOT NULL,
  `product_img` varchar(200) NOT NULL,
  `product_AddDate` date NOT NULL,
  `retailer_id` int(10) NOT NULL,
  `product_status` int(10) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `retailer_id` (`retailer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_category`, `product_desc`, `product_img`, `product_AddDate`, `retailer_id`, `product_status`) VALUES
(7, 'Fish Fillet Burger', 14, 'Burger', 'Burger with a long fillet of fish ready to satisfy your appetite', 'fishfillet.png', '2019-04-19', 2, 0),
(14, 'Tower Burger', 17, 'Burger', 'Burger Towered with Delicious Chicken Patties and with real cheese', 'timthumb.php.png', '2019-04-07', 2, 0),
(40, 'Spicy Chicken Burger', 15, 'Chicken', 'Specially marinated whole chicken thigh meat with a delightfully crispy coat, layered with fresh lettuce and special sauce in a corn meal bun.', 'RXHGd1hPpwHBpUpLypE5.jpg', '2019-04-19', 16, 0),
(39, 'Fish o Fillet', 9, 'Fish', 'A classic favourite of a fish burger served with tartar sauce and cheddar cheese in a steamed bun.', 'thumb1fillet-0b809901a4.jpg', '2019-04-19', 16, 0),
(38, 'Double Cheeseburger', 14, 'Beef', 'Two slices of cheese coupled with two tasty beef patties, the Double Cheeseburger is always a delight.', 'thumb1doublecheeseburger-2df8a8edb8.jpg', '2019-04-19', 16, 0),
(15, 'Nasi Kari Kapitan', 14, 'Rice', 'Topped with sweet curry and chicken cutlets', 'nasikari.png', '2019-04-07', 2, 0),
(16, 'Chick O Rice', 12, 'Rice', 'Rice with Chicken Cutlets', 'chickorice.png', '2019-04-07', 2, 0),
(18, 'Lucky Plate', 15, 'Chicken', 'A platter of chicken served alongside with salad and fries, covered in delicious gravy', 'marrybrowluckyplate.png', '2019-04-07', 2, 0),
(20, 'American Smoky Cheese Steakhouse', 19, 'Chicken', 'Creamy mayo, crispy onions, spicy jalapenos, cheese and four strips of bacon, all piled on a flame-grilled Steakhouse Beef Patty.', 'bk1.png', '2019-04-19', 5, 0),
(21, 'Japanese Tonkatsu Steakhouse', 16, 'Beef', 'Creamy mayo, crunchy coleslaw, white onion, cheese, with flame-grilled Steakhouse Patty smothered in a delicious Japanese Tonkatsu sauce.', 'BKG1168_TOTW_Japanese_Tonkatsu_SH_300x270px.png', '2019-04-07', 5, 0),
(22, 'Vietnamese Sweet Chilli Tendercrisp', 15, 'Chicken', 'Creamy mayo, crispy lettuce, juicy tomato slices, white onion and a crunchy panko crumbed Tendercrisp Chicken Patty, drowning in mouth-watering sweet chilli sauce.', 'BKG1168_TOTW_Vietnamese_SweetChilli_TC_300x270px[2].png', '2019-04-07', 5, 0),
(23, 'Cheese & Bacon Tendercrisp', 16, 'Chicken', 'Juicy Tendercrisp Chicken Patty made with 100% Ingham\'s Chicken Breast, 2 slices of Cheese, Fresh Lettuce, Tomato, Red Onions, 2 layers of Bacon Rashes and Aioli sauce, all on a lightly corn dusted bun. ', 'BUR2423D_Kings-Collection_PRODUCT_500x400_01[1].png', '2019-04-07', 5, 0),
(24, 'Junior Salad Burger', 14, 'Salads', 'Crispy onion rings, lettuce, tomato and cheese with our creamy mayonnaise, all served on a toasted sesame seed bun', 'BUR2379-product-imagesBUR2379-Product_Images_Junior_Salad_Burger_300x270.png[12].png', '2019-04-07', 5, 0),
(25, 'Salad Burger', 16, 'Salads', 'Crispy onion rings, lettuce, tomato, pickles, onion and cheese with our creamy mayonnaise, all served on a toasted sesame seed bun.', 'BK_Salad-Burger-Detail.png', '2019-04-07', 5, 0),
(26, 'Loaded Fries', 10, 'Sides', 'With a bed of golden fries, layers of sliced jalapenos, Smoky Cheese Sauce and fried onions, our Loaded Fries take tasty to the next level. ', 'BKG1182_WebDesktop_500x400px_LoadedFries.png', '2019-04-07', 5, 0),
(27, 'Chicken Fries', 8, 'Sides', 'BKâ€™s Chicken Fries are made with New Zealand chicken, with a light, seasoned crispy coating. Chicken Fries are shaped like fries and are perfect to dip in any of our delicious dipping sauces', 'BUR2256D Buffalo Chicken Fries Web Assets_300x270.png copy[4]_1.png', '2019-04-07', 5, 0),
(28, 'Kiwi Crunch Sundae', 7, 'Desserts', 'With sticky kiwifruit sauce and anzac biscuit crumbs drizzled on creamy soft serve, the Kiwi Crunch Sundae isâ€¦ pretty sweet, aye.', 'BKG1199_KiwiSundae_Reg_300x270px.png', '2019-04-07', 5, 0),
(30, 'REESEâ€™S Peanut Butter Cup Pie', 6, 'Desserts', 'A creamy REESEâ€™S peanut butter filling, topped with crumbled REESEâ€™s Peanut Butter Cups, and held together by a delicious chocolate cookie crust.', 'WebMobile_Reeses-Pie_300x270px-1.png', '2019-04-07', 5, 0),
(37, 'Big Wac', 17, 'Beef', 'Two all-beef patties with lettuce, onions, pickles, cheese and special sauce in a toasted sesame seed bun.', 'alltimefavouritesbigmac-7e25f66acb.jpg', '2019-04-19', 16, 0),
(41, 'Sundae Cone', 2, 'Desserts', 'Sundae Cone, the original.', 'dessertssidessundaecone-813b60cb53.jpg', '2019-04-19', 16, 0),
(42, 'Chocolate Top', 3, 'Desserts', 'Chocolate Sundae Cone', 'dessertssideschocotop-cf72cb209b.jpg', '2019-04-19', 16, 0),
(43, 'WcMocha', 8, 'Coffee', 'WcDonald\'s famous mocha blend.', 'HIR5tQo5KrlV7RobtTG0.jpg', '2019-04-19', 16, 0),
(44, 'WcLatte', 9, 'Coffee', 'WcDonald\'s famous latte', 'kVyCDY4wAlZsEWaOSf28.jpg', '2019-04-19', 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `retailer_info`
--

DROP TABLE IF EXISTS `retailer_info`;
CREATE TABLE IF NOT EXISTS `retailer_info` (
  `retailer_id` int(10) NOT NULL AUTO_INCREMENT,
  `retailer_name` varchar(256) NOT NULL,
  `retailer_email` varchar(50) NOT NULL,
  `retailer_phoneno` varchar(20) NOT NULL,
  `retailer_logo` varchar(200) NOT NULL,
  `retailer_address1` varchar(256) NOT NULL,
  `retailer_address2` varchar(256) NOT NULL,
  `retailer_zipcode` varchar(20) NOT NULL,
  `retailer_registerdate` date NOT NULL,
  `user_id` int(10) NOT NULL,
  `retailer_BID` varchar(30) NOT NULL,
  PRIMARY KEY (`retailer_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retailer_info`
--

INSERT INTO `retailer_info` (`retailer_id`, `retailer_name`, `retailer_email`, `retailer_phoneno`, `retailer_logo`, `retailer_address1`, `retailer_address2`, `retailer_zipcode`, `retailer_registerdate`, `user_id`, `retailer_BID`) VALUES
(2, 'BBQ Joint', 'bbqjcorporate@gmail.com', '0129333182', 'bbqjoint.jpg', 'Petaling Street', 'No.64a', '291841', '2019-03-06', 3, 'BBQJ11111'),
(5, 'Burger Queen', 'bqcorporate@gmail.com', '019274612312', 'burgerkinglogo.png', 'Jalan Radin Bagus', '29a', '391222', '2019-03-11', 6, 'BQ112319'),
(16, 'WcDonalds', 'corporatewcdonalds@gmail.com', '0194448299', '322854_1.jpg', 'Padang Road', '34a', '821444', '2019-04-19', 17, 'WCD122000'),
(17, 'KGBFC', 'kgbcorporate@gmail.com', '0192488123', 'kgbchicken.PNG', 'Padang Road', '29a', '229120', '2019-04-19', 18, 'KGBFC11294');

-- --------------------------------------------------------

--
-- Table structure for table `retailer_request`
--

DROP TABLE IF EXISTS `retailer_request`;
CREATE TABLE IF NOT EXISTS `retailer_request` (
  `req_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `retailer_name` varchar(256) NOT NULL,
  `retailer_email` varchar(50) NOT NULL,
  `retailer_phoneno` varchar(20) NOT NULL,
  `retailer_logo` varchar(200) NOT NULL,
  `retailer_address1` varchar(256) NOT NULL,
  `retailer_address2` varchar(256) DEFAULT NULL,
  `retailer_zipcode` varchar(20) NOT NULL,
  `req_date` date NOT NULL,
  `req_status` varchar(256) NOT NULL,
  `req_description` text,
  `req_BID` varchar(30) NOT NULL,
  PRIMARY KEY (`req_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retailer_request`
--

INSERT INTO `retailer_request` (`req_id`, `user_id`, `retailer_name`, `retailer_email`, `retailer_phoneno`, `retailer_logo`, `retailer_address1`, `retailer_address2`, `retailer_zipcode`, `req_date`, `req_status`, `req_description`, `req_BID`) VALUES
(23, 6, 'Burger Queen', 'bqcorporate@gmail.com', '019274612312', 'burgerkinglogo.png', 'Jalan Radin Bagus', '29a', '391222', '2019-03-08', 'ACCEPTED', 'Definitely not Hungry Jack\'s', 'BQ112319'),
(20, 3, 'BBQ Joint', 'bbqjcorporate@gmail.com', '019283712', 'bbqjoint.jpg', 'Petaling Street', 'No.64a', '291844', '2019-03-06', 'ACCEPTED', 'Fresh meat', 'BBQJ11111'),
(37, 17, 'WcDonalds', 'corporatewcdonalds@gmail.com', '0194448299', '322854_1.jpg', 'Padang Road', '34a', '821444', '2019-04-19', 'ACCEPTED', 'Created by Roland Niichan', 'WCD122000'),
(38, 18, 'KGBFC', 'kgbcorporate@gmail.com', '0192488123', 'kgbchicken.PNG', 'Padang Road', '29a', '229120', '2019-04-19', 'ACCEPTED', 'Free chicken for all', 'KGBFC11294');

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

DROP TABLE IF EXISTS `topup`;
CREATE TABLE IF NOT EXISTS `topup` (
  `topup_id` int(10) NOT NULL,
  `topup_amount` int(10) NOT NULL,
  `topup_method` varchar(256) NOT NULL,
  `topup_datetime` datetime NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`topup_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topup`
--

INSERT INTO `topup` (`topup_id`, `topup_amount`, `topup_method`, `topup_datetime`, `user_id`) VALUES
(445265, 10, 'store', '2019-04-18 08:36:06', 7),
(372529, 100, 'onlinebanking', '2019-04-18 06:07:33', 4),
(869436, 50, 'onlinebanking', '2019-04-08 10:42:24', 16),
(455032, 100, 'onlinebanking', '2019-04-08 10:01:31', 7),
(862328, 100, 'onlinebanking', '2019-04-08 10:01:22', 7),
(611430, 100, 'onlinebanking', '2019-04-08 10:01:18', 7),
(635068, 100, 'onlinebanking', '2019-04-08 10:01:14', 7),
(258244, 1000301231, 'onlinebanking', '2019-04-08 09:48:57', 7),
(704827, 50, 'store', '2019-04-07 13:20:16', 7),
(701035, 10, 'onlinebanking', '2019-04-07 12:35:51', 7),
(984274, 10, 'onlinebanking', '2019-04-18 08:37:26', 7),
(780057, 10, 'store', '2019-04-18 08:44:11', 7),
(187602, 10, 'store', '2019-04-18 08:46:49', 7),
(825461, 10, 'creditcard', '2019-04-18 08:47:02', 7),
(921481, 100, 'store', '2019-04-19 13:46:47', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(256) NOT NULL,
  `user_lastname` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_username` varchar(256) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_nationality` varchar(256) NOT NULL,
  `user_passportno` varchar(256) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_phonenumber` varchar(256) NOT NULL,
  `user_dob` date NOT NULL,
  `user_countryresidence` varchar(256) NOT NULL,
  `user_province` varchar(256) NOT NULL,
  `user_city` varchar(256) NOT NULL,
  `user_addressline1` varchar(256) NOT NULL,
  `user_addressline2` varchar(256) NOT NULL,
  `user_zipcode` varchar(20) NOT NULL,
  `user_role` int(10) NOT NULL,
  `user_balance` double NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_username` (`user_username`),
  UNIQUE KEY `user_passportno` (`user_passportno`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_username`, `user_password`, `user_nationality`, `user_passportno`, `user_gender`, `user_phonenumber`, `user_dob`, `user_countryresidence`, `user_province`, `user_city`, `user_addressline1`, `user_addressline2`, `user_zipcode`, `user_role`, `user_balance`) VALUES
(1, 'Felix', 'Lawin', 'felix@gmail.com', 'admin', '$2y$10$qBtB0mY11wq8r9KKKaCAwOZgEdYixDrMa5TFO0vCoAEnjJ4HRy/lW', 'Indonesia', 'B3312448', 'Male', '0182933211', '1998-10-02', 'Malaysia', 'Kuala Lumpur', 'Bukit Jalil', 'Vista Komanwel', 'B2-14-3', '57001', 1, 0),
(3, 'Tails', 'Sanicman', 'tails@gmail.com', 'tails', '$2y$10$3RbYVmepmI.MLwxw5fmeIOV6MeA0v0Xsq6d3RATnsjWONbK85YZiq', 'Afganistan', 'TAI21921', 'Male', '029122312', '1997-10-03', 'Australia', 'Kangaroovince', 'Wallaby Town', 'East Street', '21a', '123000', 3, 0),
(17, 'Knuckles', 'Echnida', 'knuckles@gmail.com', 'knuckles', '$2y$10$AmrErNpYDGp6bLSSHXq.rOOy68cHCsBI.omAN2pGV5bsNqbDbuIky', 'Brazil', 'BRZ123011', 'Male', '0193381912', '1976-04-06', 'Brazil', 'Jolorao', 'Rio', 'Janerio Road', '21a', '293444', 3, 0),
(18, 'Stasef', 'Joslin', 'stasef@gmail.com', 'stasef', '$2y$10$zo5I90PSBkgu7i7KVQXNkeJ1BnJfHRIE5iW2jtFlZFxtDzGCbakUK', 'Russia', 'RUS103922', 'Male', '0193844491', '1997-02-11', 'Malaysia', 'Kuala Lumpur', 'Bukit Jalil', 'Sri Petaling', '44a', '039111', 3, 0),
(6, 'Mike', 'Hok', 'mike@gmail.com', 'mike', '$2y$10$nohe8IgLwZeiUjXQ3o463.wt/zTPZvKipj5kLau0qXGVOPS/yUYqG', 'Afganistan', 'FAGS22912', 'Male', '019281333', '1993-10-01', 'Bangladesh', 'd', 'd', 'd', 'd', '122121', 3, 0),
(7, 'Gator', 'Ades', 'gator@gmail.com', 'gator', '$2y$10$SH0xrVGb1UJ2Qz4Z7lg/VO3chEIiNJwUQXrnoiKIEKe8RPc0EaCve', 'Afganistan', '2939AHD', 'Male', '028178241', '1993-12-06', 'Indonesia', 'South Sumatra', 'Balikpapan', 'Jalan Minang', '29a', '221457', 0, 79.1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
