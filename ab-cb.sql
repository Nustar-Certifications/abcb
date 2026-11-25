-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2021 at 09:52 PM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ab-cb`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_certification`
--

CREATE TABLE `r_certification` (
  `id` int(11) NOT NULL,
  `certificationNumber` varchar(145) NOT NULL,
  `companyName` varchar(145) NOT NULL,
  `address` varchar(500) NOT NULL,
  `scheme` varchar(45) NOT NULL,
  `validTill` date NOT NULL,
  `accredited` enum('0','1') NOT NULL DEFAULT '0',
  `createdOn` datetime NOT NULL,
  `updatedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_certification`
--

INSERT INTO `r_certification` (`id`, `certificationNumber`, `companyName`, `address`, `scheme`, `validTill`, `accredited`, `createdOn`, `updatedOn`) VALUES
(1, '12527 ', 'INTERNATIONAL CERTIFICATION & INSPECTION UK LIMITED', ' 27, Old Gloucester\r\nStreet, LONDON, WC1N 3AX, UNITED KINGDOM.\r\nAdditional Location:-  USA, INDIA', 'IMS & Others (Please refer Accreditation Doc.', '2020-12-12', '0', '2016-07-23 02:33:07', '2019-09-12 04:35:47'),
(13, 'ICIIND/1292/XVII', 'NIHARIKA TECHNOLOGIES', 'H. O. BXXII/44 A, Harnam Nagar, Sultanpur Road, Kapurthala, Punjab, India.\r\nB.O. SCO 51 FF, Improvement Trust Market, Kapurthala Chowk, Jalandhar - 144001, Punjab, India.', 'ISO 9001:2015  ', '2020-04-12', '0', '2017-04-29 01:42:56', '2018-07-23 11:59:55'),
(17, '12/528/IND (IMS) & Others', 'STAR ', 'House No. 81 3rd floor, Satya Niketan,New Delhi - 110021, India', 'IMS & Others', '2022-11-11', '1', '2017-11-22 10:55:21', '0000-00-00 00:00:00'),
(18, '12/528/IND ISO (IMS) & Product Certification', 'SYSTEM TRAINING & ASSSSMENT REGISTRAR', 'House No. 81 3rd floor, Satya Niketan,New Delhi - 110021, India', 'IMS & Others', '2022-11-11', '1', '2017-11-22 10:57:33', '0000-00-00 00:00:00'),
(19, '1328/2018', 'ROHAN GLOVES MANUFACTURING PVT. LTD.', 'OFFICE - T - 61A/34, DR. S.C .BANERJEE ROAD, KOLKATA â€“700010 (W.B.) INDIA, FACTORY - BANTOLA LEATHER COMPLEX, ZONE - 9, PLOT NO - 1566, P.O. - KANTOLA, KOLKATA - 743502 (W.B.) INDIA', 'SA 8000', '2021-02-20', '0', '2018-03-19 02:43:25', '2018-03-19 02:44:37'),
(20, 'ICIINDS/1514/XVIII', 'M/S. PROFESSIONAL WELLA LLP', 'PLOT NO. 2, FIRST FLOOR, JAIHIND SOCIETY LAYOUT, OPPOSITE RELIANCE FRESH MARKET,\r\nBELATRODI ROAD, MANISH NAGAR, NAGPUR - 440015 (MAHARASHTRA) INDIA.', 'ISO 9001:2015, SCOPE - BEAUTY SALON, HAIR SAL', '2021-07-18', '0', '2018-07-23 11:56:33', '2018-07-23 11:59:00'),
(21, 'ABCB/12528', 'ARABOL INTERNATIONAL LTD.', 'Plot No.44/2, Sector 27-28, Industrial Area, Hisar - 125005, Haryana, India.', 'ISO/IEC 17025:2017', '2020-12-05', '1', '2018-12-07 01:02:21', '2018-12-07 01:04:50'),
(22, 'kjckkljlkjclk', 'ICI (UK)', 'Office No. 7, Plot No ', 'hjjkckjiiljck;v', '2020-12-20', '0', '2019-05-15 05:12:02', '0000-00-00 00:00:00'),
(23, 'ABCB/14435 ', 'Dada Corporation', '51, Vijay Nagar-1, Katargam Darwaja, Surat â€“ 395004, Gujarat, India.', 'ISO/IEC 17025:2017', '2023-02-23', '0', '2020-03-04 01:27:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `r_control`
--

CREATE TABLE `r_control` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(45) NOT NULL,
  `cookiesToken` varchar(100) NOT NULL,
  `lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_control`
--

INSERT INTO `r_control` (`id`, `username`, `password`, `cookiesToken`, `lastLogin`) VALUES
(1, 'admin@gmail.com', '479dc4a0de3d6275be7cfed05900c39e97625687', '', '2020-03-04 01:24:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_certification`
--
ALTER TABLE `r_certification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `r_control`
--
ALTER TABLE `r_control`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_certification`
--
ALTER TABLE `r_certification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `r_control`
--
ALTER TABLE `r_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
