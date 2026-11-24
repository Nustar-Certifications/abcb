-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 166.62.8.53
-- Generation Time: Nov 26, 2018 at 10:07 PM
-- Server version: 5.5.51
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `abcbjatin1`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_certification`
--

CREATE TABLE `r_certification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `certificationNumber` varchar(145) NOT NULL,
  `companyName` varchar(145) NOT NULL,
  `address` varchar(500) NOT NULL,
  `scheme` varchar(45) NOT NULL,
  `validTill` date NOT NULL,
  `accredited` enum('0','1') NOT NULL DEFAULT '0',
  `createdOn` datetime NOT NULL,
  `updatedOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `r_certification`
--

INSERT INTO `r_certification` VALUES(1, '12527 (IMS) & Others', 'ICIUK ', 'International Certification & Inspection UK LTD , Kemp House, 160 City Road, London, United Kingdom, EC1V 2NX\r\nAdditional Location:-  USA, INDIA', 'IMS & Others (Please refer Accreditation Doc.', '2020-12-12', '1', '2016-07-23 02:33:07', '2018-05-03 02:48:02');
INSERT INTO `r_certification` VALUES(13, 'ICIIND/1292/XVII', 'NIHARIKA TECHNOLOGIES', 'H. O. BXXII/44 A, Harnam Nagar, Sultanpur Road, Kapurthala, Punjab, India.\r\nB.O. SCO 51 FF, Improvement Trust Market, Kapurthala Chowk, Jalandhar - 144001, Punjab, India.', 'ISO 9001:2015  ', '2020-04-12', '0', '2017-04-29 01:42:56', '2018-07-23 11:59:55');
INSERT INTO `r_certification` VALUES(17, '12/528/IND (IMS) & Others', 'STAR ', 'House No. 81 3rd floor, Satya Niketan,New Delhi - 110021, India', 'IMS & Others', '2022-11-11', '1', '2017-11-22 10:55:21', '0000-00-00 00:00:00');
INSERT INTO `r_certification` VALUES(18, '12/528/IND ISO (IMS) & Product Certification', 'SYSTEM TRAINING & ASSSSMENT REGISTRAR', 'House No. 81 3rd floor, Satya Niketan,New Delhi - 110021, India', 'IMS & Others', '2022-11-11', '1', '2017-11-22 10:57:33', '0000-00-00 00:00:00');
INSERT INTO `r_certification` VALUES(19, '1328/2018', 'ROHAN GLOVES MANUFACTURING PVT. LTD.', 'OFFICE - T - 61A/34, DR. S.C .BANERJEE ROAD, KOLKATA â€“700010 (W.B.) INDIA, FACTORY - BANTOLA LEATHER COMPLEX, ZONE - 9, PLOT NO - 1566, P.O. - KANTOLA, KOLKATA - 743502 (W.B.) INDIA', 'SA 8000', '2021-02-20', '0', '2018-03-19 02:43:25', '2018-03-19 02:44:37');
INSERT INTO `r_certification` VALUES(20, 'ICIINDS/1514/XVIII', 'M/S. PROFESSIONAL WELLA LLP', 'PLOT NO. 2, FIRST FLOOR, JAIHIND SOCIETY LAYOUT, OPPOSITE RELIANCE FRESH MARKET,\r\nBELATRODI ROAD, MANISH NAGAR, NAGPUR - 440015 (MAHARASHTRA) INDIA.', 'ISO 9001:2015, SCOPE - BEAUTY SALON, HAIR SAL', '2021-07-18', '0', '2018-07-23 11:56:33', '2018-07-23 11:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `r_control`
--

CREATE TABLE `r_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(45) NOT NULL,
  `cookiesToken` varchar(100) NOT NULL,
  `lastLogin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `r_control`
--

INSERT INTO `r_control` VALUES(1, 'admin@gmail.com', '0bafdc5f08c2bf2ec44fe058b2312ef5d688a3a5', '', '2018-08-25 01:44:11');
