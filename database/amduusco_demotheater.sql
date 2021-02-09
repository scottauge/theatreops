-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2021 at 03:19 PM
-- Server version: 5.7.23-23
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
-- Database: `amduusco_demotheater`
--

-- --------------------------------------------------------

--
-- Table structure for table `Activity`
--

CREATE TABLE `Activity` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `Name` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `Activity`
--

INSERT INTO `Activity` (`RecID`, `Name`) VALUES
('16044442710VIb2DW2Cd9cYVlKsIboXFpVTrYMYH42uJyJo5Z2', ''),
('1531006571nYSspU9CgH2LuKNgusYdXZJcKa7vCF63xVpBju6m', '50/50'),
('1537366364VWXFuy2HVI3Y0xQARoUfyEbN5scXDvYwpfGfzB1R', 'Accounting'),
('1531007149wXQeOkL5sdBuopP3Id8eMawEiabE8EP8aC99LJ36', 'Actor'),
('15310067488frpkg4uQWDxpSly6Dwza3EZmL8S5oCpkHznCmja', 'Box Office'),
('1531006778ELNpvYrbGIRhftKXVVAxy9pfCuKZGvbnEZcZDIid', 'Building and Grounds'),
('1531006926AIo8S0nydDNIcoUPI08H9lUdAzL9g5STHLIpKyg4', 'Choreagrapher'),
('1531006563mZf8RG3KCmSDZgLWgHKL1bmVleQmNii1HvRn7KwM', 'Concessions'),
('1530219797beOvl1VfcmX59QOirIxrmFRcd2YUFGm7HuaT6Y0f', 'Costume'),
('1531006847lJS3xGTIXNGMgM8WL1WMznQ7k9Mb4Avrp45VCLl9', 'Director'),
('1531337271JE3DjIaST7zjNAxcNDTbX6e8O27N6jtIrH4Y4NXQ', 'Education'),
('1531006738N4eBVmb7N0ROevYOM8ZNSVuNEYRR0Ph2OKzugZ0j', 'Front Of House Activities'),
('153100679287rBNIvYO3vw4EZw55h0y0oj1y1Qt54w17BdJWzL', 'Fund Raising'),
('1530048924QVGaLbrauQF1ckaPUWQ3xzarSrNAJDmNw0UPvR9B', 'Lighting'),
('1537366385fo4Ej65ztpr1upm5LIvmK1XUdflVIHy7U9U63Jg7', 'Memberships'),
('1531006857a5Nc4eNKwW2yPDu65H9ACrxwRzUc9fOdpoFelwLl', 'Music Director'),
('1531006765obIZVJDzGVxFC3LZxT6zti9Idlgfy4rhdYUIva8Y', 'Play Reading'),
('1531006943dQVbVWRQSkEUBW64y9xlflhPuj87DVjn7S1UxLdX', 'Props'),
('153100681096LgpMkls5rWS0tayDSoxi2fRtSZ0VW7bVpZ3xLp', 'Publicity'),
('1531007008hrNpb2UwW2lZEKihspTPAk3ZnbJECpsPkOQAASSc', 'Running Crew (While play is shown)'),
('1530219788pPY8SuYxffVUE7mLyjVIWElEsk5yGteUURLd2nFu', 'Set'),
('1530047153A0Vs60Txmms7WMcftusuxL5F8gc5GkMFKPFDKc3r', 'Sound'),
('1530219808w6fcyNpiOc8S9yN3FAE7WeWJ6PaPuFCuCUMSpDLQ', 'Stage Manager'),
('1531006555AP5HgEmZgF2MnGzIa3SkJeddu1WhvOUwFxfbIYv7', 'Usher'),
('1531006828HL37Xc01swV6FGcEsxnQ8eOJWfbjjSZEhbIOIOA9', 'Web/Computer');

-- --------------------------------------------------------

--
-- Table structure for table `Advertisers`
--

CREATE TABLE `Advertisers` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `ContactName` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `ContactEmail` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `ContactPhone` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `AdvertiserName` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `AdvertiserPhone` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Address1` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Address2` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `City` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `State` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Zip` varchar(10) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Note` varchar(1000) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `Advertisers`
--

INSERT INTO `Advertisers` (`RecID`, `ContactName`, `ContactEmail`, `ContactPhone`, `AdvertiserName`, `AdvertiserPhone`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Note`) VALUES
('1562719330xlbjIE3vd91NwyfcWZZHalfMCQmg2QQ4zyiccQUl', 'Scott Auge', 'scott_auge@yahoo.com', 'NA', 'Amduus', NULL, '1918 Briarwood Dr.', '', 'Flint', 'MI', '48507', ''),
('1562719380xFQWRDfHZLLOHJXdlGdklCalHNOHCMABzjRmKTLU', 'Scott Auge', 'sage', '408 205 5743', 'All Star Theatre', NULL, '100 Main St', '', 'Anytown', 'MI', '48607', 'Professional theatre group');

-- --------------------------------------------------------

--
-- Table structure for table `AdvertiserSale`
--

CREATE TABLE `AdvertiserSale` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `AdvertisersRecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Amount` float DEFAULT NULL,
  `Note` varchar(1000) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `AdvertiserSale`
--

INSERT INTO `AdvertiserSale` (`RecID`, `AdvertisersRecID`, `StartDate`, `EndDate`, `Amount`, `Note`) VALUES
('15628610316hZnW2RxzhZFfRITL4EjdJv0aRVQcgLrL7k8Y5VJ', '1562719380xFQWRDfHZLLOHJXdlGdklCalHNOHCMABzjRmKTLU', '2019-01-01', '2019-01-30', 100, '3 x 5 in Program for the show in this time period.');

-- --------------------------------------------------------

--
-- Table structure for table `Audit`
--

CREATE TABLE `Audit` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `LoginRecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `WasValue` text COLLATE utf16_unicode_ci NOT NULL,
  `ToValue` text COLLATE utf16_unicode_ci NOT NULL,
  `DateTime` datetime NOT NULL,
  `Operation` varchar(60) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Campaign`
--

CREATE TABLE `Campaign` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `LetterRecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Type` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Email,Letter',
  `FromEMail` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Contact`
--

CREATE TABLE `Contact` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL COMMENT 'Unique Record Identifier',
  `ContactName` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Full Name',
  `Phone` varchar(30) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Phone + extension',
  `Email` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Email',
  `RelationRecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `RelationTable` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `Contact`
--

INSERT INTO `Contact` (`RecID`, `ContactName`, `Phone`, `Email`, `RelationRecID`, `RelationTable`) VALUES
('1562719330jYnodThPbUYrrIruVXdVYN8CbbGeM6Ouv0rXe1l3', 'Scott Auge', '4082055743', 'scott_auge@yahoo.com', '1562719330xlbjIE3vd91NwyfcWZZHalfMCQmg2QQ4zyiccQUl', 'Advertisers'),
('15627193806shAkdS45io0y2OGafOiASZFR1CxrQ8wc4dGtIMi', 'Scott Auge', '4082055743', 'scott_auge@yahoo.com', '1562719380xFQWRDfHZLLOHJXdlGdklCalHNOHCMABzjRmKTLU', 'Advertisers');

-- --------------------------------------------------------

--
-- Table structure for table `Letter`
--

CREATE TABLE `Letter` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `Name` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Body` text COLLATE utf16_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci COMMENT='Letter Templates';

--
-- Dumping data for table `Letter`
--

INSERT INTO `Letter` (`RecID`, `Name`, `Body`) VALUES
('1562799954G4mn2xoyGOZLmulB81Lfu9cG8CQk3jOzaYjUZS8t', 'Advertiser Test', '<p>%ADVERTISERNAME%<br /><br />%ADDRESS1%<br /><br />%ADDRESS2%<br /><br />%CITY%<br /><br />%STATE%<br /><br />%ZIP%<br /><br />%CONTACTPHONE%<br /><br />%CONTACTEMAIL%<br /><br />%CONTACTNAME%<br /><br />%ADVERTISERPHONE%<br /><br /></p>\r\n<p>Dear %CONTACTNAME%,</p>\r\n<p>It is that time again - the opportunity to tell the audiences at Anytown Theatre about the products and services you provide.&nbsp;</p>\r\n<p>Since ours is a live theatre - you know you are reaching an market that is specific to this location.&nbsp; Also, since it is live theatre, you know the audiences are in the middle to upper middle class.</p>\r\n<p>So if you need to reach out to an affluent group of people who read our program while seating is being done, contact us at .....</p>\r\n<p>Sincerely,</p>\r\n<p>The Marketing Team at Anytown Theatre</p>'),
('1562799970pSTIOR2Wi6P1I0OkxAyXHE1mucsNz7G6WXZAZrCF', 'Vendor Test', '<p>%COMPANYNAME%<br /><br />%ADDRESS1%<br /><br />%ADDRESS2%<br /><br />%CITY%<br /><br />%STATE%<br /><br />%ZIP%<br /><br />%CONTACTPHONE%<br /><br />%CONTACTEMAIL%<br /><br />%CONTACTNAME%<br /><br />%CONTACTPHONE%</p>'),
('1562861809F7XgCE4sa6GhyXfLZPMGzkYWIGrmhDLLQVQdMjHz', 'Membership All', '<p>Dear %NAME%,</p>\r\n<p>It\'s that time of year again!&nbsp;</p>\r\n<p>Membership renewals are due on ...</p>\r\n<p>Why become a member?</p>\r\n<p>Membership helps with the educational arts programs we provide the community - and doing so means you help too!</p>\r\n<p>Membership means we can increase the quality and quantity of the arts programs.</p>\r\n<p>Membership means you will have x free admission tickets to use through out our season.</p>\r\n<p>So, if you want to be a member, contact ....</p>\r\n<p>Sincerely,</p>\r\n<p>John Doe</p>\r\n<p>The Membership Committee</p>');

-- --------------------------------------------------------

--
-- Table structure for table `ListToActivity`
--

CREATE TABLE `ListToActivity` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `ActivityRecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `MainListRecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `ListToActivity`
--

INSERT INTO `ListToActivity` (`RecID`, `ActivityRecID`, `MainListRecID`) VALUES
('1531337554zxE5nNgZhkiJg3VDDwInxCjKYTa6VAhRxiROAhYk', '15310067488frpkg4uQWDxpSly6Dwza3EZmL8S5oCpkHznCmja', '1531337554TKeVRx7pHoJSHPHAgoE9HMrT2cISpQzEQcdFKjIf'),
('1531337554zbnk18Y1KiloaE2ryTXH9s6yrHHeWcjiIFsAZbli', '1531337271JE3DjIaST7zjNAxcNDTbX6e8O27N6jtIrH4Y4NXQ', '1531337554TKeVRx7pHoJSHPHAgoE9HMrT2cISpQzEQcdFKjIf'),
('1531337554ZanzoNb4602j46gCAfa2NnDwLyAKNPY78ogyDG9V', '1531006765obIZVJDzGVxFC3LZxT6zti9Idlgfy4rhdYUIva8Y', '1531337554TKeVRx7pHoJSHPHAgoE9HMrT2cISpQzEQcdFKjIf'),
('1562719488JSa38Dnx09LTuSutt3HkrUvCX9eNeaJhek7S6KPf', '1530048924QVGaLbrauQF1ckaPUWQ3xzarSrNAJDmNw0UPvR9B', '1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO'),
('15627194889G7nEebmGRZGnoZAnbHU04MERZ6XvPRM05gxmJf6', '1531007008hrNpb2UwW2lZEKihspTPAk3ZnbJECpsPkOQAASSc', '1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO'),
('1562719488OpzCHMsT85cSsmCOAzUnXtsJ6aZ6XGSWOQB868Wd', '1530047153A0Vs60Txmms7WMcftusuxL5F8gc5GkMFKPFDKc3r', '1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO'),
('1562719488kEzO0GcKVJfoSgDRBRzVP9wjZQNm1MW0t5whr6yV', '1531006828HL37Xc01swV6FGcEsxnQ8eOJWfbjjSZEhbIOIOA9', '1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO'),
('1562719535GKtK6shiPHBXRDKHYPpzYlbo5Bofjsib0HLXmHCZ', '1531007149wXQeOkL5sdBuopP3Id8eMawEiabE8EP8aC99LJ36', '1562719535xX1zG7O0fQ0ZP5La9SANZnvBM3J2bQQXbUePuJJt');

-- --------------------------------------------------------

--
-- Table structure for table `Logins`
--

CREATE TABLE `Logins` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `UserID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Password` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL,
  `IsSuperUser` tinyint(1) DEFAULT '0',
  `EMail` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Question1` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Answer1` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Question2` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Answer2` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `Logins`
--

INSERT INTO `Logins` (`RecID`, `UserID`, `Password`, `IsActive`, `IsSuperUser`, `EMail`, `Question1`, `Answer1`, `Question2`, `Answer2`) VALUES
('1', 'test', 'tset', 1, 0, '', '', '', '', ''),
('1562720226J5RTm9to6nAF8p1VwemFUXGssJ4Vuk9vdjdgaOQB', 'demo', 'demo', 1, 0, 'demo@amduus.com', '', '', '', ''),
('20180723asldufhakdjfblkdasjbc', 'sauge@amduus.com', 'testme1', 1, 1, 'sauge@amduus.com', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `MainList`
--

CREATE TABLE `MainList` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `Name` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Address1` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Address2` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `City` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `State` varchar(4) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Zip` varchar(10) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Phone` varchar(14) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Email` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `IM` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `SocialNetwork` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `PersonalUserID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `PersonalPassword` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `MainList`
--

INSERT INTO `MainList` (`RecID`, `Name`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Phone`, `Email`, `IM`, `SocialNetwork`, `PersonalUserID`, `PersonalPassword`) VALUES
('1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO', 'Scott Auge', '125 Main', '', 'Flint', 'MI', '48507', '555 555 5555', '', '', '', NULL, NULL),
('1562719535xX1zG7O0fQ0ZP5La9SANZnvBM3J2bQQXbUePuJJt', 'Craig Auge', '123 Main', '', 'Flint', 'MI', '48507', '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Membership`
--

CREATE TABLE `Membership` (
  `MainListRecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL DEFAULT '',
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Payment` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `Membership`
--

INSERT INTO `Membership` (`MainListRecID`, `RecID`, `StartDate`, `EndDate`, `Payment`) VALUES
('1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO', '1562719488eQFfKdKntri1wPwr6IngEEdUyWwZUtHhvWMjrJkc', '0000-00-00', '0000-00-00', 0),
('1562719535xX1zG7O0fQ0ZP5La9SANZnvBM3J2bQQXbUePuJJt', '15627195351j6IxgVsDEdfZGNa4EcE7IUeYyZ59GCBLJupgMVK', '0000-00-00', '0000-00-00', 0),
('1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO', '1562860649XtGeW9boRn6YGyYiOXcZXLNZl8h83dIwdWZCDJWt', '2019-01-01', '2040-12-31', 30),
(NULL, '1563900263mc2Y9g9wjT3YYAteWYxZ3cmOc4Clm2A4kKBVx0vX', NULL, NULL, NULL),
(NULL, '1563900284ythQJYSUMR0Z5B6gB9T2JT6veeuoiK9w56JpVGkn', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Notes`
--

CREATE TABLE `Notes` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `RelationTable` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `RelationRecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Text` varchar(2024) COLLATE utf16_unicode_ci DEFAULT NULL,
  `CreateDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `Notes`
--

INSERT INTO `Notes` (`RecID`, `RelationTable`, `RelationRecID`, `Text`, `CreateDate`) VALUES
('1531337054JOcJ6SuLka5NLRaMD7t0igEAUxnfVySuT3IPMWxG', 'MainList', '1531337054ZmdvUBeJ2EVewfgCYJjdsb32RELLNklQMXS2AlIz', '', '2019-06-29 17:24:06'),
('1531337554FWKBU37fihuAGKAfUr4pUJyPTzTz5IRVZM5fs1Cb', 'MainList', '1531337554TKeVRx7pHoJSHPHAgoE9HMrT2cISpQzEQcdFKjIf', '', '2019-06-29 17:24:06'),
('1562719330PvzCLz9jsBfl6ohaJ7TWkzSeCkmxJlDLv1gfNdR6', 'Advertisers', '1562719330xlbjIE3vd91NwyfcWZZHalfMCQmg2QQ4zyiccQUl', 'Entered into system', '2019-07-09 18:42:10'),
('1562719380uJj5KXwFvSDs6M0UmeifywdMc4I27kr8gTuHd7dZ', 'Advertisers', '1562719380xFQWRDfHZLLOHJXdlGdklCalHNOHCMABzjRmKTLU', 'Entered into system', '2019-07-09 18:43:00'),
('1562719488HovfSkv2TAfjoG6h7emPydDOUVbtec73WFi4RJGh', 'MainList', '1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO', '', '2019-07-09 18:44:48'),
('1562719535vC34HjVnAs4R1QFlHe2Xn6C1WEb3DuYijj6FlfEG', 'MainList', '1562719535xX1zG7O0fQ0ZP5La9SANZnvBM3J2bQQXbUePuJJt', '', '2019-07-09 18:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `Parameter`
--

CREATE TABLE `Parameter` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `Name` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Value` text COLLATE utf16_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `Parameter`
--

INSERT INTO `Parameter` (`RecID`, `Name`, `Value`) VALUES
('1', 'title', 'Theatre Management'),
('1540573194OB2WxLtoY9ca1ExN9QGHovrRYTLFDJAftnrneuXT', 'ReturnEmail', 'sauge@amduus.com'),
('1551834808kuo6hgA36VM4tAX1hVrK1VrzdG2JiLOaYWj7eUW7', 'SendEmail', 'Off'),
('1551902034Lw9PB4C7TRsZYL8J1nCYFN6uee1udZe5ZF93r5JW', 'EmailDebug', 'Off'),
('1562718162lM5IrVodQk4GrAlWnDp13XmxonBoycsff5kvsglt', 'BarColor', '#CED8F6'),
('1562787517L21Kfi1J1dzewj2kgE72XKIy6MadgiSmIoIh8m0f', 'FrontPageMessage', '<p align=\"center\">A demonstration account is available - it is user \"demo\" and password \"demo\" - that information will be refreshed often!<br><br>As a demonstration user, the My Account will not be<br> available since you could change the password and then the program would not be very public eh?<br><br>  Also, the parameters are off limits since the program can send mail out - so spammers, go somewhere else!</p>'),
('2', 'Organization', 'Demonstration Site'),
('3', 'StatusOptions', 'Open,Working,Closed'),
('4', 'SessionTimeOut', 'INTERVAL \'10:0\' MINUTE_SECOND'),
('5', 'TimeZone', 'America/Detroit');

-- --------------------------------------------------------

--
-- Table structure for table `Security`
--

CREATE TABLE `Security` (
  `UserRecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `Description` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Active` tinyint(1) DEFAULT NULL,
  `Level` int(11) DEFAULT NULL,
  `CodeDescription` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Session`
--

CREATE TABLE `Session` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `CookieID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `SessionName` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `SessionValue` text COLLATE utf16_unicode_ci,
  `LastUsed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'For auto time outs'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `Session`
--

INSERT INTO `Session` (`RecID`, `CookieID`, `SessionName`, `SessionValue`, `LastUsed`) VALUES
('1612627285dlsHIjoQtwTH8s8cnCyuUlBNACpIEbagxKG7d6A0', NULL, 'Login', NULL, '2021-02-06 18:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `Tasks`
--

CREATE TABLE `Tasks` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL,
  `Description` varchar(2048) COLLATE utf16_unicode_ci DEFAULT NULL,
  `MainLoginRecID` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Who assigned to',
  `Status` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL,
  `Priority` int(11) DEFAULT NULL,
  `Title` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `Tasks`
--

INSERT INTO `Tasks` (`RecID`, `Description`, `MainLoginRecID`, `Status`, `Priority`, `Title`) VALUES
('1562719784YT9umESFDekX92vbXkzuNMWJ653InU1BzV7Kne5G', 'Set needs to be built from design', '20180723asldufhakdjfblkdasjbc', 'Open', 3, 'Build Set for Mary Pokins'),
('1562719829HvRbvGBYsypm15c6XanygjGDtGcBeBrv3pKRRSSW', 'Design set - get hold of director and see if script has hints that match planned blocking', '1', 'Open', 2, 'Design set for Mary Pokins');

-- --------------------------------------------------------

--
-- Table structure for table `Vendor`
--

CREATE TABLE `Vendor` (
  `RecID` varchar(60) COLLATE utf16_unicode_ci NOT NULL COMMENT 'Unique record identifier',
  `CompanyName` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Company Name',
  `Address1` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Main Address',
  `Address2` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Secondary Address',
  `City` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'City',
  `State` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'State',
  `Zip` varchar(9) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Zip',
  `Note` varchar(1000) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Notes about conversations',
  `ContactName` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Contact Name',
  `ContactPhone` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Phone for the contact',
  `ContactEmail` varchar(60) COLLATE utf16_unicode_ci DEFAULT NULL COMMENT 'Email'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci COMMENT='Vendors';

--
-- Dumping data for table `Vendor`
--

INSERT INTO `Vendor` (`RecID`, `CompanyName`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Note`, `ContactName`, `ContactPhone`, `ContactEmail`) VALUES
('1562719588PPGUhZbGFk27QwPud7NrERX91NHQc7aKNVIvHQDe', 'Vendor A', '345 My Street', '', 'Anytown', 'MI', '46573', 'Used for lighting equipment', 'Scott Auge', '', ''),
('1562719608pzINBfyMUYJQuf8ZUP59YZRDgvtdm6Te6ZnvYElc', 'Vendor B', '367 That Street', '', 'Anytown', 'MI', '46573', 'Used for sound equipment', 'Scott Auge', '', ''),
('1562719638Iij5PN4g4I8d0IiwTGNk2gFmGCsJ9dv1tKaERjac', 'Vendor C', '789 Curtains', '', 'Anytown', 'MI', '46573', 'Used for set curtains and main drapes', 'Scott Auge', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Activity`
--
ALTER TABLE `Activity`
  ADD UNIQUE KEY `RecID` (`RecID`),
  ADD UNIQUE KEY `Activity` (`Name`);

--
-- Indexes for table `Advertisers`
--
ALTER TABLE `Advertisers`
  ADD UNIQUE KEY `AdvertiserRecID` (`RecID`);

--
-- Indexes for table `AdvertiserSale`
--
ALTER TABLE `AdvertiserSale`
  ADD UNIQUE KEY `AdSaleRecID` (`RecID`);

--
-- Indexes for table `Audit`
--
ALTER TABLE `Audit`
  ADD UNIQUE KEY `RecID` (`RecID`),
  ADD UNIQUE KEY `DateTime` (`DateTime`),
  ADD KEY `Login` (`LoginRecID`);

--
-- Indexes for table `Campaign`
--
ALTER TABLE `Campaign`
  ADD UNIQUE KEY `RecID` (`RecID`);

--
-- Indexes for table `Contact`
--
ALTER TABLE `Contact`
  ADD UNIQUE KEY `ContactRecID` (`RecID`);

--
-- Indexes for table `Letter`
--
ALTER TABLE `Letter`
  ADD UNIQUE KEY `RecID` (`RecID`),
  ADD KEY `Name` (`Name`);

--
-- Indexes for table `ListToActivity`
--
ALTER TABLE `ListToActivity`
  ADD UNIQUE KEY `WhoToActivity` (`MainListRecID`,`ActivityRecID`);

--
-- Indexes for table `Logins`
--
ALTER TABLE `Logins`
  ADD UNIQUE KEY `pukey` (`RecID`),
  ADD UNIQUE KEY `UserPass` (`UserID`,`Password`);

--
-- Indexes for table `MainList`
--
ALTER TABLE `MainList`
  ADD PRIMARY KEY (`RecID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `Membership`
--
ALTER TABLE `Membership`
  ADD PRIMARY KEY (`RecID`),
  ADD UNIQUE KEY `MembershipTime` (`MainListRecID`,`StartDate`,`EndDate`);

--
-- Indexes for table `Notes`
--
ALTER TABLE `Notes`
  ADD UNIQUE KEY `recid` (`RecID`),
  ADD KEY `pukeyNotes` (`RelationTable`,`RelationRecID`) USING BTREE;

--
-- Indexes for table `Parameter`
--
ALTER TABLE `Parameter`
  ADD PRIMARY KEY (`RecID`) USING BTREE,
  ADD UNIQUE KEY `ParameterName` (`Name`);

--
-- Indexes for table `Security`
--
ALTER TABLE `Security`
  ADD UNIQUE KEY `SecurityRecID` (`RecID`),
  ADD KEY `UserRecID` (`UserRecID`,`Description`);

--
-- Indexes for table `Session`
--
ALTER TABLE `Session`
  ADD UNIQUE KEY `RecID` (`RecID`),
  ADD KEY `Cookie` (`CookieID`);

--
-- Indexes for table `Tasks`
--
ALTER TABLE `Tasks`
  ADD UNIQUE KEY `TaskRecID` (`RecID`);

--
-- Indexes for table `Vendor`
--
ALTER TABLE `Vendor`
  ADD PRIMARY KEY (`RecID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
