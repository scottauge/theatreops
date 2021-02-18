-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2021 at 07:43 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `theatre`
--

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `RecID` varchar(60) NOT NULL,
  `Category` varchar(30) DEFAULT NULL,
  `ItemNumber` varchar(30) DEFAULT NULL,
  `Description` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`RecID`);
  
--
-- Table structure for table `inventorylocation`
--

CREATE TABLE `inventorylocation` (
  `RecID` varchar(60) NOT NULL,
  `Building` varchar(30) DEFAULT NULL,
  `Room` varchar(30) DEFAULT NULL,
  `Shelving` varchar(30) DEFAULT NULL,
  `Shelf` varchar(30) DEFAULT NULL,
  `Slot` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Where inventory parts can be located';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventorylocation`
--
ALTER TABLE `inventorylocation`
  ADD PRIMARY KEY (`RecID`),
  ADD UNIQUE KEY `UniqueLocationAscending` (`Building`,`Room`,`Shelving`,`Shelf`,`Slot`);



--
-- Table structure for table `parttoinventorylocation`
--

CREATE TABLE `parttoinventorylocation` (
  `RecID` varchar(60) NOT NULL,
  `InventoryLocationRecID` varchar(60) DEFAULT NULL,
  `PartRecID` varchar(60) DEFAULT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parttoinventorylocation`
--
ALTER TABLE `parttoinventorylocation`
  ADD PRIMARY KEY (`RecID`),
  ADD UNIQUE KEY `PartToInventoryLocation` (`PartRecID`,`InventoryLocationRecID`);


--
-- Table structure for table `presentation`
--

CREATE TABLE `presentation` (
  `RecID` varchar(60) NOT NULL,
  `Title` varchar(60) DEFAULT NULL,
  `BuildStartDate` date DEFAULT NULL,
  `DirectorRecID` varchar(60) DEFAULT NULL COMMENT 'mainlist.recid',
  `RunStartDate` date DEFAULT NULL,
  `RunEndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`RecID`);
  
  
  
COMMIT;


