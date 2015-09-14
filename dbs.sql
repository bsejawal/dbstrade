-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db559338640.db.1and1.com
-- Generation Time: Sep 14, 2015 at 04:04 AM
-- Server version: 5.1.73-log
-- PHP Version: 5.4.44-0+deb7u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db559338640`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `description`) VALUES
(1, 'Solar panel', 'Solar panel'),
(2, 'Home appliances', 'Home appliances'),
(3, 'Solar water heater', 'Solar water heater'),
(4, 'Parqueting( Laminate flooring)', ' Laminate flooring');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `metadata` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`keyword`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `heading`, `content`, `description`, `keyword`, `metadata`) VALUES
(1, 'Contact Us', '<h1><strong>DBS Trade Centre Pvt. Ltd.</strong></h1>\n\n<p><strong>Mahaboudha-30, Kathmandu, Nepal</strong></p>\n\n<p><strong>Tel.: +977-01- 4225232 |&nbsp;Mobile: +977-9851044215</strong></p>\n\n<p><strong>Email: dbstradecentre@gmail.com</strong></p>\n\n<p><strong>URL: <a href="http://dbstradecentre.com.np" target="_blank">http://dbstradecentre.com.np</a></strong></p>\n', 'Contains everything about <strong>contact us</strong> page', 'contact', ''),
(2, 'About Us', '<h3><strong>What is DBS Trade Centre?</strong></h3>\n\n<p>DBS Trade centre was established on 2007 with crystal motive to produce quality products of the Solar panels, Parquet (laminate flooring), inverter, batteries, solar water heater, gas water heater, gas hobs (stove) and kitchen wares and more in the market of Nepal.</p>\n\n<h3><strong>Achievements</strong></h3>\n\n<p>Till the date the DBS Trade center has supplied the various products over the 75 Districts of Nepal, with the target implementing for whole Nepal, which will cover within a year period. Right at the moment, we do have 30 varieties of Electric items in the brand name of&nbsp; <strong>&ldquo;Sunrise&rdquo;</strong> in the market. We have a large variety and we have something for everyone. Our Company has created a solid reputation in the Electric goods suppliers in Nepal. Being one of the most trusted names in Electric goods suppliers is dedicated to providing quality and durable products to its customers.</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<div id="__if72ru4sdfsdfrkjahiuyi_once" style="display:none;">&nbsp;</div>\n\n<div id="__if72ru4sdfsdfruh7fewui_once" style="display:none;">&nbsp;</div>\n\n<div id="__hggasdgjhsagd_once" style="display:none;">&nbsp;</div>\n', 'Contains everything about <strong>About us</strong> page', 'about', ''),
(3, 'Copyright', '<p>Copyright &copy; 2015 DBS Trader Center. All Rights Reserved. Privacy and Terms.</p>\n', 'Contains footer information', 'copyright', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `category` varchar(200) NOT NULL,
  `imgPath` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `desc`, `category`, `imgPath`, `date`) VALUES
(2, 'Sunrise Water Heater', '<p>Features:</p>\n\n<ul>\n	<li><strong>Inner Tank:</strong> 0.6mm SUS304-2B food-grade stainless steel.</li>\n	<li><strong>Outer Tank:</strong> 0.5mm SUS304-2B food-grade stainless steel.</li>\n	<li><strong>Tank Support:</strong> material stainless stell 202-2B thickness 1.50mm.</li>\n	<li><strong>Heat insulation layer:</strong> 60mm polyurethane foaming.</li>\n	<li><strong>Electrical heating rod:</strong> Thernostat.</li>\n	<li><strong>Reflector: </strong>stainless steel 304-BA</li>\n	<li><strong>Two Air:</strong> vent and one safty valve.</li>\n	<li><strong>Inlet and outlet:</strong> 3/4 stainless steel and&nbsp; one drain outlet.</li>\n	<li><strong>Warrenty: </strong>5 years warrenty.</li>\n	<li><strong>Gurantee:</strong> 1 year guarantee in water tank.</li>\n	<li><strong>Others:</strong>&nbsp;Drain outlet with magnesium rod.</li>\n</ul>\n', 'Solar', 'images/product/water heater.jpg', '2015-01-11 01:29:00'),
(3, 'home appliances', '<p>Features:</p>\n\n<ul>\n	<li><strong>Material:</strong> Piant</li>\n	<li><strong>Lighting:</strong> Normal Lamp</li>\n	<li><strong>Switch:</strong> psuh button switch</li>\n	<li><strong>Air outlet:</strong> 150mm</li>\n	<li><strong>Dimension:</strong> 755mm</li>\n	<li><strong>Others:</strong> Oil collector, Auto Clean</li>\n	<li><strong>Warrenty:</strong> 2 years</li>\n</ul>\n', 'Home appliances', 'images/product/ch1.jpg', '2015-01-21 01:10:48'),
(5, 'Cooker Hob (DBS-113)', '<p>Features:</p>\n\n<ul>\n	<li>Temper glass panel of 7.0mm, european gas burner enamalled gas grills</li>\n	<li><strong>Rated input:</strong> 3.30+1.75+1.75+1.20 KW</li>\n	<li><strong>Product Size:</strong> 600x600mm</li>\n	<li><strong>Bulit in dimension:</strong> 550x550mm</li>\n	<li><strong>Warrenty:</strong>&nbsp;2 years&nbsp;</li>\n</ul>\n', 'Gas', 'images/product/cookerhub.jpg', '2015-01-21 01:17:49'),
(8, 'Chimney (DBS-105)', '<p>Features:</p>\n\n<ul>\n	<li><strong>Width: </strong>90cm</li>\n	<li><strong>Hood:</strong> Glass decorative hood</li>\n	<li><strong>Suction:</strong> 1000m3/hr</li>\n	<li><strong>Noise Level:</strong> 65dBa (Max)</li>\n	<li>Baffle filter oil collector</li>\n	<li>Digitial display</li>\n	<li><strong>Warrenty:</strong> 2 years</li>\n</ul>\n', 'Electronics', 'images/product/ch3.jpg', '2015-01-21 01:55:42'),
(9, 'Laminated Flooring', '', 'Flooring', 'images/product/Flooring.jpg', '2015-01-21 02:00:13'),
(10, 'Water Heater', '', 'Gas', 'images/product/Gas-Water-Heater.jpg', '2015-01-21 02:16:36'),
(11, 'Cooker Hob', '', 'Gas', 'images/product/cookerhub2.jpg', '2015-01-21 02:17:32'),
(12, 'Chimney', '', 'Electronics', 'images/product/ch2.jpg', '2015-01-21 02:18:02'),
(14, 'LAMINATE FLOORING', '', 'Parqueting( Laminate flooring)', 'images/product/DSC04878.JPG', '2015-02-08 04:17:59'),
(15, 'LAMINATE FLOORING', '', 'Parqueting( Laminate flooring)', 'images/product/DSC04885.JPG', '2015-02-08 04:22:41'),
(16, '', '', 'Solar panel', 'images/product/DSC04881.JPG', '2015-02-08 05:42:24'),
(17, 'home appliances', '', 'Home appliances', 'images/product/hood in button.jpg', '2015-02-10 00:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `mailTo` enum('none','yes') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `email`, `gender`, `username`, `password`, `role`, `mailTo`) VALUES
(1, 'Admin', 'vinayadahal@gmail.com', 'Male', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'yes'),
(3, 'DBS', 'dbstradecentre@gmail.com', 'Male', 'dbs', 'ad850bb81a30639fa6ef6564d7fc533f45879abe', 'dev', 'yes');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
