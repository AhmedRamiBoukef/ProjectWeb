-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 27, 2023 at 06:44 PM
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
  `Content` text,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`NewsID`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`NewsID`, `Title`, `Content`, `Date`) VALUES
(1, 'Latest Car Models Released', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi vitae a ea quia voluptatum atque neque eveniet architecto perspiciatis asperiores assumenda, magnam iure soluta iusto distinctio odit dolorum! Voluptatum, repellat.lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa iusto molestiae sint quibusdam repellat iure! Qui ut provident alias harum voluptatibus voluptatum rerum praesentium voluptates sed aliquam, molestiae cum ullam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas accusamus nemo alias magni molestiae nesciunt nihil exercitationem quia ducimus veniam dolorum iure, itaque quod facere excepturi odit quasi dicta qui. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, laudantium qui possimus, rem soluta sequi neque accusamus aspernatur nisi cupiditate alias exercitationem nobis? Dolorum enim explicabo consequuntur iusto, sequi deleniti. Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, optio facilis maxime, exercitationem est nostrum quia placeat labore officia, hic ipsum modi blanditiis reprehenderit dolorum! Voluptate odio itaque laboriosam tenetur. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia eius doloribus laboriosam aperiam eligendi, amet optio culpa eos impedit facere ducimus repellat eveniet molestias a numquam consequuntur, omnis libero doloremque.', '2022-01-31 23:00:00'),
(2, 'Safety Features Comparison', 'Comparing safety features across popular brands.', '2022-02-14 23:00:00'),
(3, 'Latest Car Models Released', 'Check out the newest car models on the market.', '2023-12-14 23:00:00'),
(4, 'Safety Features Comparison', 'Comparing safety features across popular brands.', '2023-12-14 23:00:00'),
(5, 'Exciting New Model Released', 'A highly anticipated model has been released with cutting-edge features and performance.', '2023-12-15 19:39:05'),
(6, 'Green Revolution in Automotive Industry', 'The automotive industry takes a step towards sustainability with the introduction of eco-friendly vehicles.', '2023-12-15 19:39:05'),
(7, 'Record-Breaking Speed Achieved', 'A new sports car breaks records, achieving incredible speed and performance on the racetrack.', '2023-12-15 19:39:05'),
(8, 'Innovations in Electric Vehicle Technology', 'Discover the latest advancements in electric vehicle technology that promise a brighter and greener future.', '2023-12-15 19:39:05'),
(9, 'Classic Cars Showcase Event', 'Join us at the upcoming classic car showcase event, where vintage beauties will be on display for enthusiasts.', '2023-12-15 19:39:05'),
(10, 'Safety First: New Vehicle Safety Standards', 'Learn about the enhanced safety standards implemented in the latest vehicle models to protect drivers and passengers.', '2023-12-15 19:39:05'),
(11, 'Revolutionizing Autonomous Driving', 'Explore the advancements in autonomous driving technology, paving the way for a new era in transportation.', '2023-12-15 19:39:05'),
(12, 'Luxury Redefined in the Automotive World', 'Experience the epitome of luxury with the introduction of new high-end models boasting premium features.', '2023-12-15 19:39:05'),
(13, 'Rugged Off-Road Adventure Vehicles', 'Discover the thrill of off-road adventures with the release of rugged vehicles designed for extreme terrains.', '2023-12-15 19:39:05'),
(14, 'Futuristic Design Concepts Unveiled', 'Get a glimpse of the future with concept cars showcasing innovative and futuristic designs.', '2023-12-15 19:39:05'),
(15, 'The Rise of Electric SUVs', 'Electric SUVs gain popularity as automakers focus on creating sustainable and spacious electric vehicles.', '2023-12-15 19:39:05'),
(16, 'Smart Connectivity in Modern Cars', 'Stay connected on the go with smart features integrated into the latest car models.', '2023-12-15 19:39:05'),
(17, 'Top Picks for Family-Friendly Cars', 'Explore the best family-friendly cars with safety features and spacious interiors for a comfortable journey.', '2023-12-15 19:39:05'),
(18, 'Efficiency Meets Style in Hybrid Cars', 'Hybrid cars redefine efficiency without compromising on style, offering a perfect balance for eco-conscious consumers.', '2023-12-15 19:39:05'),
(19, 'Customization Trends in Car Accessories', 'Personalize your ride with the latest trends in car accessories, allowing you to express your unique style.', '2023-12-15 19:39:05'),
(20, 'Celebrating Milestones in Automotive History', 'Take a trip down memory lane as we celebrate significant milestones and achievements in the history of automobiles.', '2023-12-15 19:39:05'),
(21, 'Elevating the Driving Experience with AI', 'Artificial Intelligence transforms the driving experience with features like voice commands and predictive analytics.', '2023-12-15 19:39:05'),
(22, 'Top Fuel-Efficient Cars for Eco-Conscious Drivers', 'Discover the top fuel-efficient cars that prioritize environmental sustainability without compromising performance.', '2023-12-15 19:39:05'),
(23, 'Iconic Cars from the Silver Screen', 'Explore iconic cars that have left a mark on popular culture, featured in blockbuster movies and television.', '2023-12-15 19:39:05'),
(24, 'The Art of Automotive Photography', 'Appreciate the beauty of automobiles through the lens of skilled photographers capturing stunning images.', '2023-12-15 19:39:05'),
(25, 'Breaking Ground: New Manufacturing Technologies', 'Learn about the latest manufacturing technologies shaping the production of modern vehicles.', '2023-12-15 19:39:05'),
(26, 'Exploring Heritage Car Museums', 'Immerse yourself in the rich history of automobiles by visiting renowned car museums around the world.', '2023-12-15 19:39:05'),
(27, 'Future-Proofing Cars with Upgradable Software', 'Discover how automakers are future-proofing cars by introducing upgradable software for enhanced features and performance.', '2023-12-15 19:39:05'),
(28, 'The Allure of Convertible Cars', 'Experience the freedom of the open road with convertible cars that combine style and exhilarating driving experiences.', '2023-12-15 19:39:05'),
(29, 'Exploring Unique Car Colors and Finishes', 'Dive into the world of automotive aesthetics with unique paint colors and finishes that set cars apart.', '2023-12-15 19:39:05'),
(30, 'Adventures in Electric Racing', 'Electric racing gains popularity as a thrilling and eco-friendly motorsport, showcasing the speed of electric vehicles.', '2023-12-15 19:39:05'),
(31, 'The Evolution of Car Safety Features', 'Trace the evolution of safety features in cars, from the introduction of seatbelts to advanced driver-assistance systems.', '2023-12-15 19:39:05'),
(32, 'Preserving Vintage Cars: A Labor of Love', 'Explore the passion and dedication of collectors who are committed to preserving and restoring vintage cars.', '2023-12-15 19:39:05'),
(33, 'Cruising in Style: Luxury Yachts with Car-Inspired Designs', 'Discover luxury yachts that draw inspiration from the sleek designs and features of high-end cars.', '2023-12-15 19:39:05'),
(34, 'The Art of Car Detailing', 'Learn the intricacies of car detailing, from paint correction to interior rejuvenation, for a showroom-worthy finish.', '2023-12-15 19:39:05');

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
(1, 16),
(2, 16),
(3, 15),
(4, 15),
(5, 15),
(6, 15),
(7, 15),
(8, 15),
(9, 15),
(10, 15),
(11, 15),
(12, 15),
(13, 15),
(14, 15),
(15, 15),
(16, 15),
(17, 15),
(18, 15),
(19, 15),
(20, 15),
(21, 15),
(22, 15),
(23, 15),
(24, 15),
(25, 15),
(26, 15),
(27, 15),
(28, 15),
(29, 15),
(30, 15),
(31, 15),
(32, 15),
(33, 15),
(34, 15);

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
(1, '6.5s (0-100)', '210 km/h'),
(2, '4.0s (0-100)', '250 km/h'),
(3, '6.0s (0-100)', '200 km/h'),
(4, '4.2s (0-100)', '260 km/h');

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
  `Comment` text,
  `Rating` int(11) DEFAULT NULL,
  `Status` enum('Approved','Rejected') DEFAULT NULL,
  `DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ReviewID`),
  KEY `UserID` (`UserID`),
  KEY `VehicleID` (`VehicleID`),
  KEY `BrandID` (`BrandID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewID`, `UserID`, `VehicleID`, `BrandID`, `Comment`, `Rating`, `Status`, `DATE`) VALUES
(3, 1, 1, NULL, 'This vehicle exceeded my expectations in every way. The performance is outstanding, and the sleek design is simply breathtaking. The interior is luxurious, and the advanced technology features make driving a joy. I highly recommend this car!', 5, 'Rejected', '2023-12-22 15:07:07'),
(5, 2, 1, NULL, 'I have been driving this car for a few months now, and I am impressed with its fuel efficiency. The handling is smooth, and the safety features add an extra layer of confidence. The spacious interior is perfect for long drives. Overall, a great investment!', 4, 'Approved', '2023-12-22 15:07:07'),
(6, 1, 2, NULL, 'My experience with this vehicle has been mixed. While the exterior design is eye-catching, I ve encountered some issues with the transmission. The customer service was responsive, and the problem was fixed, but it was still an inconvenience. Hoping for better reliability in the future.', 3, 'Approved', '2023-12-22 15:07:07'),
(7, 2, 2, NULL, 'I recently purchased this car, and it has quickly become my favorite. The acceleration is impressive, and the handling is superb. The infotainment system is user-friendly, and the overall build quality is top-notch. Definitely worth the investment!', 5, 'Approved', '2023-12-22 15:07:07'),
(8, 2, 3, NULL, 'Unfortunately, I had a negative experience with this vehicle. The engine had a strange noise that persisted even after multiple visits to the service center. The car was eventually replaced, but it was a frustrating ordeal.Disappointed with the overall reliability.', 2, 'Approved', '2023-12-22 15:07:07'),
(12, 2, 1, NULL, 'I love the design of this vehicle. It\'s stylish and modern. The performance is outstanding, especially the acceleration. The safety features add an extra layer of confidence on the road.', 4, 'Approved', '2023-01-02 00:00:00'),
(14, 2, 1, NULL, 'Spacious interior with plenty of legroom. The cargo space is generous, making it ideal for family trips. The handling is responsive, and the ride is comfortable. Overall, a reliable and practical choice.', 5, 'Approved', '2023-01-04 00:00:00'),
(16, 2, 1, NULL, 'The technology in this vehicle is cutting-edge. The infotainment system is user-friendly, and the connectivity options are impressive. A joy to drive with advanced features at your fingertips.', 4, 'Approved', '2023-01-06 00:00:00'),
(17, 1, 1, NULL, 'Decent value for the money. It\'s not the flashiest car, but it gets the job done. Fuel economy is satisfactory, and maintenance costs are reasonable. A practical choice for daily commuting.', 3, 'Approved', '2023-01-07 00:00:00');

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
  `Gender` enum('Male','Female') DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `IsAuthenticated` tinyint(1) DEFAULT '1',
  `IsBlocked` tinyint(1) DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `username`, `FirstName`, `LastName`, `Gender`, `DateOfBirth`, `Email`, `Password`, `IsAuthenticated`, `IsBlocked`, `admin`) VALUES
(1, 'rami', 'Boukef', 'Ahmed Rami', 'Male', '2002-05-26', 'ka_boukef@esi.dz', '$2y$10$.m.9uNuUOL.vmL67cRZf6e/l9bGupT7fGt7TgAELQTC7LmNnEzziG', 1, 1, 0),
(2, 'ahmed', 'Boukef', 'Ahmed Rami', 'Male', '2002-05-26', 'ahmed@gmail.dz', '$2y$10$dwB2axCn/pIpHx1Ose7KKuYiNXAgLi7eG82Dd2zFk5eWpFA2kAm/C', 1, 1, 0),
(3, 'admin', 'admin', 'admin', 'Male', '2002-05-26', 'admin@gmail.dz', '$2y$10$FELZ.R3kZ6kspwsmMcttJu9z/oHZ0slHCW2OzPwbjA9Mt6xPHKGIy', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicleinfo`
--

DROP TABLE IF EXISTS `vehicleinfo`;
CREATE TABLE IF NOT EXISTS `vehicleinfo` (
  `VehicleID` int(11) NOT NULL AUTO_INCREMENT,
  `VehiculeName` varchar(50) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL,
  `IndicativePrice` varchar(50) DEFAULT NULL,
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
(1, 'Toyota Camry XLE', 4, '3000000 DA', 1, 'XLE', '4.8776 x 1.8288 x 1.4224', '5 passengers', '7.5 L/100km', 11, 1, 'Automatic', 1),
(2, 'Ford Mustang GT', 5, '4500000 DA', 2, 'GT Premium', '4.7752 x 1.905 x 1.3716', '4 passengers', '9.4 L/100km', 12, 2, 'Manual', 2),
(3, 'Dodge Charger SXT', 4, '3200000 DA', 3, 'SXT', '5.08 x 1.905 x 1.4732', '5 passengers', '8.4 L/100km', 13, 3, 'Automatic', 3),
(4, 'Chevrolet Camaro SS', 4, '4000000 DA', 4, 'SS', '4.7752 x 1.905 x 1.3462', '4 passengers', '12.4 L/100km', 14, 4, 'Manual', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
