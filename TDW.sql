-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2023 at 08:43 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projecttdw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Gender` tinyint(1) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `username`, `FirstName`, `LastName`, `Gender`, `DateOfBirth`, `Email`, `Password`) VALUES
(1, 'admin', 'Boukef', 'Ahmed Rami', 1, '2002-05-26', 'ka_boukef@esi.dz', '$2y$10$jorRTAVKMn.3jDv37TC5n.ajRzm.n1xuXKUtj8cy.Y.MS8eN2tOuO');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `BrandID` int(11) NOT NULL AUTO_INCREMENT,
  `BrandName` varchar(100) DEFAULT NULL,
  `CountryOfOrigin` varchar(50) DEFAULT NULL,
  `Siegesocial` varchar(100) DEFAULT NULL,
  `YearOfEstablishment` int(11) DEFAULT NULL,
  `Logo` int(11) DEFAULT NULL,
  PRIMARY KEY (`BrandID`),
  KEY `Logo` (`Logo`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`, `CountryOfOrigin`, `Siegesocial`, `YearOfEstablishment`, `Logo`) VALUES
(1, 'Toyota', 'Japan', 'Tokyo', 1937, 7),
(2, 'Ford', 'United States', 'Dearborn', 1903, 8),
(3, 'Dodge', 'United States', 'Auburn Hills', 1914, 9),
(4, 'Chevrolet', 'United States', 'Detroit', 1911, 10);

-- --------------------------------------------------------

--
-- Table structure for table `comparison`
--

DROP TABLE IF EXISTS `comparison`;
CREATE TABLE IF NOT EXISTS `comparison` (
  `ComparisonID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `Vehicle1ID` int(11) DEFAULT NULL,
  `Vehicle2ID` int(11) DEFAULT NULL,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ComparisonCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`ComparisonID`),
  KEY `UserID` (`UserID`),
  KEY `Vehicle1ID` (`Vehicle1ID`),
  KEY `Vehicle2ID` (`Vehicle2ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comparison`
--

INSERT INTO `comparison` (`ComparisonID`, `UserID`, `Vehicle1ID`, `Vehicle2ID`, `Date`, `ComparisonCount`) VALUES
(1, 1, 1, 2, '2023-12-09 23:00:00', 1),
(2, 2, 3, 4, '2023-12-04 23:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `ContactID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `LOGO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ContactID`),
  KEY `LOGO` (`LOGO`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ContactID`, `Type`, `URL`, `LOGO`) VALUES
(1, 'Facebook', 'www.facebook.com', 1),
(2, 'Instagram', 'www.instagram.com', 2),
(3, 'LinkedIn', 'www.linkedin.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `engine`
--

DROP TABLE IF EXISTS `engine`;
CREATE TABLE IF NOT EXISTS `engine` (
  `EngineID` int(11) NOT NULL AUTO_INCREMENT,
  `EngineName` varchar(20) DEFAULT NULL,
  `EngineType` varchar(20) DEFAULT NULL,
  `Power` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`EngineID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `engine`
--

INSERT INTO `engine` (`EngineID`, `EngineName`, `EngineType`, `Power`) VALUES
(1, 'V6', 'Gasoline', '300 hp'),
(2, 'V8', 'Gasoline', '450 hp'),
(3, 'V6', 'Gasoline', '310 hp'),
(4, 'V8', 'Gasoline', '455 hp');

-- --------------------------------------------------------

--
-- Table structure for table `guidesetting`
--

DROP TABLE IF EXISTS `guidesetting`;
CREATE TABLE IF NOT EXISTS `guidesetting` (
  `GuideSettingID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `ImageID` int(11) DEFAULT NULL,
  `VehicleID` int(11) DEFAULT NULL,
  PRIMARY KEY (`GuideSettingID`),
  KEY `VehicleID` (`VehicleID`),
  KEY `ImageID` (`ImageID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guidesetting`
--

INSERT INTO `guidesetting` (`GuideSettingID`, `Title`, `Description`, `ImageID`, `VehicleID`) VALUES
(1, 'Guide 1', 'Description for guide 1', 1, 1),
(2, 'Guide 2', 'Description for guide 2', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `ImageID` int(11) NOT NULL AUTO_INCREMENT,
  `ImagePath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ImageID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`ImageID`, `ImagePath`) VALUES
(1, 'facebook.png'),
(2, 'instagram.png'),
(3, 'linkedin.png'),
(4, 'slide1.jpg'),
(5, 'slide2.jpg'),
(6, 'slide3.jpg'),
(7, 'toyota.png'),
(8, 'ford.png'),
(9, 'dodge.png'),
(10, 'Chevrolet.png'),
(11, 'Toyota_Camry_XLE.png'),
(12, 'Ford_Mustang_GT.png'),
(13, 'Dodge_Charger_SXT.png'),
(14, 'Chevrolet_Camaro_SS.png'),
(15, 'news1.jpg'),
(16, 'news2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE IF NOT EXISTS `model` (
  `ModelID` int(11) NOT NULL AUTO_INCREMENT,
  `ModelName` varchar(50) DEFAULT NULL,
  `BrandID` int(11) DEFAULT NULL,
  `ModelYear` int(11) DEFAULT NULL,
  PRIMARY KEY (`ModelID`),
  KEY `BrandID` (`BrandID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`ModelID`, `ModelName`, `BrandID`, `ModelYear`) VALUES
(1, 'Camry', 1, 2022),
(2, 'Mustang', 2, 2021),
(3, 'Charger', 3, 2023),
(4, 'Camaro', 4, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `NewsID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Content` varchar(255) DEFAULT NULL,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`NewsID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`NewsID`, `Title`, `Content`, `Date`) VALUES
(1, 'Latest Car Models Released', 'Check out the newest car models on the market.', '2022-01-31 23:00:00'),
(2, 'Safety Features Comparison', 'Comparing safety features across popular brands.', '2022-02-14 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `newsimage`
--

DROP TABLE IF EXISTS `newsimage`;
CREATE TABLE IF NOT EXISTS `newsimage` (
  `NewsID` int(11) NOT NULL,
  `ImageID` int(11) NOT NULL,
  PRIMARY KEY (`NewsID`,`ImageID`),
  KEY `ImageID` (`ImageID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsimage`
--

INSERT INTO `newsimage` (`NewsID`, `ImageID`) VALUES
(1, 15),
(2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

DROP TABLE IF EXISTS `performance`;
CREATE TABLE IF NOT EXISTS `performance` (
  `PerformanceID` int(11) NOT NULL AUTO_INCREMENT,
  `Acceleration` varchar(20) DEFAULT NULL,
  `TopSpeed` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`PerformanceID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `performance`
--

INSERT INTO `performance` (`PerformanceID`, `Acceleration`, `TopSpeed`) VALUES
(1, '6.5s', '210 km/h'),
(2, '4.0s', '250 km/h'),
(3, '6.0s', '200 km/h'),
(4, '4.2s', '260 km/h');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `ReviewID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `VehicleID` int(11) DEFAULT NULL,
  `BrandID` int(11) DEFAULT NULL,
  `Comment` varchar(255) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Status` enum('Approved','Rejected') DEFAULT NULL,
  PRIMARY KEY (`ReviewID`),
  KEY `UserID` (`UserID`),
  KEY `VehicleID` (`VehicleID`),
  KEY `BrandID` (`BrandID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewID`, `UserID`, `VehicleID`, `BrandID`, `Comment`, `Rating`, `Status`) VALUES
(1, 1, 1, 1, 'Great car, excellent fuel efficiency!', 5, 'Approved'),
(2, 2, 2, 2, 'Awesome performance, love the design.', 4, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `slideshowsetting`
--

DROP TABLE IF EXISTS `slideshowsetting`;
CREATE TABLE IF NOT EXISTS `slideshowsetting` (
  `SlideshowSettingID` int(11) NOT NULL AUTO_INCREMENT,
  `SlideshowImageURL` int(11) DEFAULT NULL,
  `SlideshowLinkURL` varchar(255) DEFAULT NULL,
  `Publicite` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`SlideshowSettingID`),
  KEY `SlideshowImageURL` (`SlideshowImageURL`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slideshowsetting`
--

INSERT INTO `slideshowsetting` (`SlideshowSettingID`, `SlideshowImageURL`, `SlideshowLinkURL`, `Publicite`) VALUES
(1, 4, 'https://example.com/link1', 1),
(2, 5, 'https://example.com/link2', 0),
(3, 6, 'https://example.com/link3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Gender` tinyint(1) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `IsAuthenticated` tinyint(1) DEFAULT NULL,
  `IsBlocked` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `username`, `FirstName`, `LastName`, `Gender`, `DateOfBirth`, `Email`, `Password`, `IsAuthenticated`, `IsBlocked`) VALUES
(1, 'rami', 'Boukef', 'Ahmed Rami', 1, '2002-05-26', 'ka_boukef@esi.dz', '$2y$10$.m.9uNuUOL.vmL67cRZf6e/l9bGupT7fGt7TgAELQTC7LmNnEzziG', 1, 1),
(2, 'ahmed', 'Boukef', 'Ahmed Rami', 1, '2002-05-26', 'ahmed@gmail.dz', '$2y$10$dwB2axCn/pIpHx1Ose7KKuYiNXAgLi7eG82Dd2zFk5eWpFA2kAm/C', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicleinfo`
--

DROP TABLE IF EXISTS `vehicleinfo`;
CREATE TABLE IF NOT EXISTS `vehicleinfo` (
  `VehicleID` int(11) NOT NULL AUTO_INCREMENT,
  `VehiculeName` varchar(50) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL,
  `IndicativePrice` decimal(10,2) DEFAULT NULL,
  `ModelID` int(11) DEFAULT NULL,
  `Version` varchar(50) DEFAULT NULL,
  `Dimensions` varchar(50) DEFAULT NULL,
  `Capacity` varchar(20) DEFAULT NULL,
  `Consumption` varchar(20) DEFAULT NULL,
  `ImageID` int(11) DEFAULT NULL,
  `EngineID` int(11) DEFAULT NULL,
  `VitesseTYPE` enum('Automatic','Manual') DEFAULT NULL,
  `PerformanceID` int(11) DEFAULT NULL,
  PRIMARY KEY (`VehicleID`),
  KEY `ImageID` (`ImageID`),
  KEY `ModelID` (`ModelID`),
  KEY `EngineID` (`EngineID`),
  KEY `PerformanceID` (`PerformanceID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicleinfo`
--

INSERT INTO `vehicleinfo` (`VehicleID`, `VehiculeName`, `Note`, `IndicativePrice`, `ModelID`, `Version`, `Dimensions`, `Capacity`, `Consumption`, `ImageID`, `EngineID`, `VitesseTYPE`, `PerformanceID`) VALUES
(1, 'Toyota Camry XLE', 4, '3000000.00', 1, 'XLE', '4.8776 x 1.8288 x 1.4224', '5 passengers', '7.5 L/100km', 11, 1, 'Automatic', 1),
(2, 'Ford Mustang GT', 5, '4500000.00', 2, 'GT Premium', '4.7752 x 1.905 x 1.3716', '4 passengers', '9.4 L/100km', 12, 2, 'Manual', 2),
(3, 'Dodge Charger SXT', 4, '3200000.00', 3, 'SXT', '5.08 x 1.905 x 1.4732', '5 passengers', '8.4 L/100km', 13, 3, 'Automatic', 3),
(4, 'Chevrolet Camaro SS', 4, '4000000.00', 4, 'SS', '4.7752 x 1.905 x 1.3462', '4 passengers', '12.4 L/100km', 14, 4, 'Manual', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
