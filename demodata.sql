-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2019 at 05:21 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `amduusco_demotheater`
--

--
-- Dumping data for table `Activity`
--

INSERT INTO `Activity` (`RecID`, `Name`) VALUES
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

--
-- Dumping data for table `Advertisers`
--

INSERT INTO `Advertisers` (`RecID`, `ContactName`, `ContactEmail`, `ContactPhone`, `AdvertiserName`, `AdvertiserPhone`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Note`) VALUES
('1562719330xlbjIE3vd91NwyfcWZZHalfMCQmg2QQ4zyiccQUl', 'Scott Auge', 'scott_auge@yahoo.com', 'NA', 'Amduus', NULL, '1918 Briarwood Dr.', '', 'Flint', 'MI', '48507', ''),
('1562719380xFQWRDfHZLLOHJXdlGdklCalHNOHCMABzjRmKTLU', 'Scott Auge', 'sage', '', 'All Star Theatre', NULL, '100 Main St', '', 'Anytown', 'MI', '48607', '');

--
-- Dumping data for table `Contact`
--

INSERT INTO `Contact` (`RecID`, `ContactName`, `Phone`, `Email`, `RelationRecID`, `RelationTable`) VALUES
('1562719330jYnodThPbUYrrIruVXdVYN8CbbGeM6Ouv0rXe1l3', 'Scott Auge', '4082055743', 'scott_auge@yahoo.com', '1562719330xlbjIE3vd91NwyfcWZZHalfMCQmg2QQ4zyiccQUl', 'Advertisers'),
('15627193806shAkdS45io0y2OGafOiASZFR1CxrQ8wc4dGtIMi', 'Scott Auge', '4082055743', 'scott_auge@yahoo.com', '1562719380xFQWRDfHZLLOHJXdlGdklCalHNOHCMABzjRmKTLU', 'Advertisers');

--
-- Dumping data for table `Letter`
--

INSERT INTO `Letter` (`RecID`, `Name`, `Body`) VALUES
('1540573709otfmbtQtvyLBziPJo2nCuaHQCJ4x3gx0sSnJGjO8', 'Test Email 2018/10/26', '<p>Hi, %NAME%!</p>\r\n<p>&nbsp;</p>\r\n<p>This is a <em><strong>test</strong></em> to determine if the system will send out from amduus.com to other addresses with a from with yet another address.</p>\r\n<p>Be sure to change rptemailletter.php to send to an override else <span style=\"text-decoration: underline;\">EVERYONE</span> will get this!</p>\r\n<p>&nbsp;</p>\r\n<p>Here to hope your email comes!</p>'),
('1562799954G4mn2xoyGOZLmulB81Lfu9cG8CQk3jOzaYjUZS8t', 'Advertiser Test', '<p>%ADVERTISERNAME%<br /><br />%ADDRESS1%<br /><br />%ADDRESS2%<br /><br />%CITY%<br /><br />%STATE%<br /><br />%ZIP%<br /><br />%CONTACTPHONE%<br /><br />%CONTACTEMAIL%<br /><br />%CONTACTNAME%<br /><br />%ADVERTISERPHONE%<br /><br /></p>'),
('1562799970pSTIOR2Wi6P1I0OkxAyXHE1mucsNz7G6WXZAZrCF', 'Vendor Test', '<p>%COMPANYNAME%<br /><br />%ADDRESS1%<br /><br />%ADDRESS2%<br /><br />%CITY%<br /><br />%STATE%<br /><br />%ZIP%<br /><br />%CONTACTPHONE%<br /><br />%CONTACTEMAIL%<br /><br />%CONTACTNAME%<br /><br />%CONTACTPHONE%</p>');

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

--
-- Dumping data for table `Logins`
--

INSERT INTO `Logins` (`RecID`, `UserID`, `Password`, `IsActive`, `IsSuperUser`, `EMail`, `Question1`, `Answer1`, `Question2`, `Answer2`) VALUES
('1', 'test', 'tset', 1, 0, '', '', '', '', ''),
('1562720226J5RTm9to6nAF8p1VwemFUXGssJ4Vuk9vdjdgaOQB', 'demo', 'demo', 1, 0, 'demo@amduus.com', '', '', '', ''),
('20180723asldufhakdjfblkdasjbc', 'sauge@amduus.com', 'testme1', 1, 1, 'sauge@amduus.com', '', '', '', '');

--
-- Dumping data for table `MainList`
--

INSERT INTO `MainList` (`RecID`, `Name`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Phone`, `Email`, `IM`, `SocialNetwork`, `PersonalUserID`, `PersonalPassword`) VALUES
('1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO', 'Scott Auge', '1918 Briarwood Dr.', '', 'Flint', 'MI', '48507', '4082055743', 'scott_auge@yahoo.com', '', '', NULL, NULL),
('1562719535xX1zG7O0fQ0ZP5La9SANZnvBM3J2bQQXbUePuJJt', 'Craig Auge', '123 Main', '', 'Flint', 'MI', '48507', '4082055743', 'scott_auge@yahoo.com', '', '', NULL, NULL);

--
-- Dumping data for table `Membership`
--

INSERT INTO `Membership` (`MainListRecID`, `RecID`, `StartDate`, `EndDate`, `Payment`) VALUES
('1562719488g2vTQwgDoXPGhnxyugyLHoAsT3CxJPELeiYQXSgO', '1562719488eQFfKdKntri1wPwr6IngEEdUyWwZUtHhvWMjrJkc', '0000-00-00', '0000-00-00', 0),
('1562719535xX1zG7O0fQ0ZP5La9SANZnvBM3J2bQQXbUePuJJt', '15627195351j6IxgVsDEdfZGNa4EcE7IUeYyZ59GCBLJupgMVK', '0000-00-00', '0000-00-00', 0);

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

--
-- Dumping data for table `Session`
--

INSERT INTO `Session` (`RecID`, `CookieID`, `SessionName`, `SessionValue`, `LastUsed`) VALUES
('1562799881lopnm6OKH4U91z5Mxw9Lo9VIuFrPPJQY1c0humBR', '1562787933bntfdvVtl29IpxpfHKiphdnZn2Zr2jZZZ0yUNEvS', 'Login', '1562720226J5RTm9to6nAF8p1VwemFUXGssJ4Vuk9vdjdgaOQB', '2019-07-11 01:09:08');

--
-- Dumping data for table `Tasks`
--

INSERT INTO `Tasks` (`RecID`, `Description`, `MainLoginRecID`, `Status`, `Priority`, `Title`) VALUES
('1562719784YT9umESFDekX92vbXkzuNMWJ653InU1BzV7Kne5G', 'Set needs to be built from design', '20180723asldufhakdjfblkdasjbc', 'Open', 3, 'Build Set for Mary Pokins'),
('1562719829HvRbvGBYsypm15c6XanygjGDtGcBeBrv3pKRRSSW', 'Design set - get hold of director and see if script has hints that match planned blocking', '1', 'Open', 2, 'Design set for Mary Pokins');

--
-- Dumping data for table `Vendor`
--

INSERT INTO `Vendor` (`RecID`, `CompanyName`, `Address1`, `Address2`, `City`, `State`, `Zip`, `Note`, `ContactName`, `ContactPhone`, `ContactEmail`) VALUES
('1562719588PPGUhZbGFk27QwPud7NrERX91NHQc7aKNVIvHQDe', 'Vendor A', '345 My Street', '', 'Anytown', 'MI', '46573', 'Used for lighting equipment', 'Scott Auge', '', ''),
('1562719608pzINBfyMUYJQuf8ZUP59YZRDgvtdm6Te6ZnvYElc', 'Vendor B', '367 That Street', '', 'Anytown', 'MI', '46573', 'Used for sound equipment', 'Scott Auge', '', ''),
('1562719638Iij5PN4g4I8d0IiwTGNk2gFmGCsJ9dv1tKaERjac', 'Vendor C', '789 Curtains', '', 'Anytown', 'MI', '46573', 'Used for set curtains and main drapes', 'Scott Auge', '', '');
COMMIT;

