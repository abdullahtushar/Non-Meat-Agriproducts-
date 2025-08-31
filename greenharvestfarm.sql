-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2025 at 12:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Drop database if it exists to start fresh
DROP DATABASE IF EXISTS `greenharvestfarm`;
CREATE DATABASE IF NOT EXISTS `greenharvestfarm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `greenharvestfarm`;

-- Table structure for table `tblagriculturecrop`
CREATE TABLE `tblagriculturecrop` (
  `nCropID` int(11) NOT NULL AUTO_INCREMENT,
  `cCropName` varchar(50) NOT NULL,
  `cHarvestingSeasons` varchar(50) NOT NULL,
  `nShelfLife` int(11) NOT NULL,
  `cOptimumStorageConditions` text NOT NULL,
  PRIMARY KEY (`nCropID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblagriculturecrop`
INSERT INTO `tblagriculturecrop` (`nCropID`, `cCropName`, `cHarvestingSeasons`, `nShelfLife`, `cOptimumStorageConditions`) VALUES
(1, 'Potato', 'Winter', 90, 'Store in a cool, dry, and dark place'),
(2, 'Rice', 'Summer', 365, 'Keep in airtight containers in dry storage'),
(3, 'Tomato', 'Summer', 14, 'Refrigerate at 12-15°C to extend shelf life');

-- Table structure for table `tblbatchpackage`
CREATE TABLE `tblbatchpackage` (
  `nPackageBatchNumber` int(11) NOT NULL AUTO_INCREMENT,
  `dPackagingDate` date NOT NULL,
  `nPackagingQuantity` int(11) NOT NULL,
  `dExpiryDate` date NOT NULL,
  `nHarvestID` int(11) NOT NULL,
  `nStationID` int(11) NOT NULL,
  PRIMARY KEY (`nPackageBatchNumber`),
  CONSTRAINT `tblbatchpackage_ibfk_1` FOREIGN KEY (`nHarvestID`) REFERENCES `tblcropharvest` (`nHarvestID`) ON DELETE CASCADE,
  CONSTRAINT `tblbatchpackage_ibfk_2` FOREIGN KEY (`nStationID`) REFERENCES `tblpackagingfacility` (`nStationID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblbatchpackage`
INSERT INTO `tblbatchpackage` (`nPackageBatchNumber`, `dPackagingDate`, `nPackagingQuantity`, `dExpiryDate`, `nHarvestID`, `nStationID`) VALUES
(1, '2025-08-01', 500, '2025-11-01', 1, 1),
(2, '2025-08-05', 300, '2025-09-15', 2, 2),
(3, '2025-08-10', 1000, '2026-02-10', 3, 1);

-- Table structure for table `tblcropharvest`
CREATE TABLE `tblcropharvest` (
  `nHarvestID` int(11) NOT NULL AUTO_INCREMENT,
  `nHarvestQuantity` int(11) NOT NULL,
  `cStorageRequirement` text NOT NULL,
  `dExpiryDate` date NOT NULL,
  PRIMARY KEY (`nHarvestID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblcropharvest`
INSERT INTO `tblcropharvest` (`nHarvestID`, `nHarvestQuantity`, `cStorageRequirement`, `dExpiryDate`) VALUES
(1, 2000, 'Cool and dry storage required', '2025-11-30'),
(2, 1500, 'Refrigerated at 4°C', '2025-09-20'),
(3, 3500, 'Normal warehouse storage', '2026-02-15');

-- Table structure for table `tblcropsowing`
CREATE TABLE `tblcropsowing` (
  `cSeedType` varchar(50) NOT NULL,
  `dSowingTime` datetime NOT NULL,
  `cSowingSeason` varchar(50) NOT NULL,
  `nSeedRequirement` int(11) NOT NULL,
  `nCropID` int(11) NOT NULL,
  PRIMARY KEY (`cSeedType`, `dSowingTime`, `nCropID`),
  CONSTRAINT `tblcropsowing_ibfk_1` FOREIGN KEY (`nCropID`) REFERENCES `tblagriculturecrop` (`nCropID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblcropsowing`
INSERT INTO `tblcropsowing` (`cSeedType`, `dSowingTime`, `cSowingSeason`, `nSeedRequirement`, `nCropID`) VALUES
('Corn Seed', '2025-04-01 09:00:00', 'Summer', 400, 2),
('Rice Seed', '2025-05-01 07:00:00', 'Monsoon', 600, 3),
('Wheat Seed', '2025-03-01 08:00:00', 'Autumn', 500, 1);

-- Table structure for table `tblcustomerorder`
CREATE TABLE `tblcustomerorder` (
  `nOrderID` int(11) NOT NULL AUTO_INCREMENT,
  `nCustomerID` int(11) NOT NULL,
  `dShipmentDate` date NOT NULL,
  `nItemID` int(11) NOT NULL,
  PRIMARY KEY (`nOrderID`),
  CONSTRAINT `tblcustomerorder_ibfk_1` FOREIGN KEY (`nItemID`) REFERENCES `tblpackageditem` (`nItemID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblcustomerorder`
INSERT INTO `tblcustomerorder` (`nOrderID`, `nCustomerID`, `dShipmentDate`, `nItemID`) VALUES
(1, 101, '2025-08-15', 1),
(2, 102, '2025-08-20', 2),
(3, 103, '2025-08-25', 3);

-- Table structure for table `tblfarmingreqinventory`
CREATE TABLE `tblfarmingreqinventory` (
  `cDataStored` text NOT NULL,
  `cSeedType` varchar(50) NOT NULL,
  `cPestiside` varchar(50) NOT NULL,
  `cFertilizer` varchar(50) NOT NULL,
  `nFarmID` int(11) NOT NULL,
  `nWarehouseID` int(11) NOT NULL,
  CONSTRAINT `tblfarmingreqinventory_ibfk_1` FOREIGN KEY (`nFarmID`) REFERENCES `tblfarmingunit` (`nFarmID`) ON DELETE CASCADE,
  CONSTRAINT `tblfarmingreqinventory_ibfk_2` FOREIGN KEY (`nWarehouseID`) REFERENCES `tblwarehouse` (`nWarehouseID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblfarmingreqinventory`
INSERT INTO `tblfarmingreqinventory` (`cDataStored`, `cSeedType`, `cPestiside`, `cFertilizer`, `nFarmID`, `nWarehouseID`) VALUES
('Inventory data for Farm A', 'Wheat Seed', 'PestGuard', 'NitroFert', 1, 1),
('Inventory data for Farm B', 'Corn Seed', 'BugOff', 'PhosFert', 2, 2);

-- Table structure for table `tblfarmingunit`
CREATE TABLE `tblfarmingunit` (
  `nFarmID` int(11) NOT NULL AUTO_INCREMENT,
  `cLocation` text NOT NULL,
  PRIMARY KEY (`nFarmID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblfarmingunit`
INSERT INTO `tblfarmingunit` (`nFarmID`, `cLocation`) VALUES
(1, 'Field A, Rural Area'),
(2, 'Field B, Countryside');

-- Table structure for table `tblpackageditem`
CREATE TABLE `tblpackageditem` (
  `nItemID` int(11) NOT NULL AUTO_INCREMENT,
  `cItemName` varchar(50) NOT NULL,
  `cCategory` varchar(50) NOT NULL,
  `nShelfLife` int(11) NOT NULL,
  PRIMARY KEY (`nItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblpackageditem`
INSERT INTO `tblpackageditem` (`nItemID`, `cItemName`, `cCategory`, `nShelfLife`) VALUES
(1, 'Wheat Grain', 'Grain', 180),
(2, 'Corn Kernel', 'Grain', 120),
(3, 'Rice Grain', 'Grain', 150);

-- Table structure for table `tblpackagingfacility`
CREATE TABLE `tblpackagingfacility` (
  `nStationID` int(11) NOT NULL AUTO_INCREMENT,
  `cLocation` text NOT NULL,
  `nPackagingLoadCapacity` int(11) NOT NULL,
  PRIMARY KEY (`nStationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblpackagingfacility`
INSERT INTO `tblpackagingfacility` (`nStationID`, `cLocation`, `nPackagingLoadCapacity`) VALUES
(1, 'Dhaka Packaging Unit A', 5000),
(2, 'Chittagong Packaging Unit B', 3000),
(3, 'Rajshahi Packaging Unit C', 4000);

-- Table structure for table `tblsensordata`
CREATE TABLE `tblsensordata` (
  `dTimeStamp` datetime NOT NULL,
  `nTemperature` decimal(5,2) NOT NULL,
  `nHumidity` decimal(5,2) NOT NULL,
  `nWarehouseID` int(11) NOT NULL,
  PRIMARY KEY (`dTimeStamp`, `nWarehouseID`),
  CONSTRAINT `tblsensordata_ibfk_1` FOREIGN KEY (`nWarehouseID`) REFERENCES `tblwarehouse` (`nWarehouseID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblsensordata`
INSERT INTO `tblsensordata` (`dTimeStamp`, `nTemperature`, `nHumidity`, `nWarehouseID`) VALUES
('2025-08-29 12:00:00', 25.50, 60.20, 1),
('2025-08-29 12:05:00', 24.80, 62.10, 2),
('2025-08-29 12:10:00', 25.10, 61.50, 1),
('2025-08-29 12:15:00', 24.90, 63.00, 2);

-- Table structure for table `tblvendor`
CREATE TABLE `tblvendor` (
  `nVendorID` int(11) NOT NULL AUTO_INCREMENT,
  `cVendorName` varchar(50) NOT NULL,
  PRIMARY KEY (`nVendorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblvendor`
INSERT INTO `tblvendor` (`nVendorID`, `cVendorName`) VALUES
(1, 'Green Supplies'),
(2, 'Farm Fresh Co.');

-- Table structure for table `tblwarehouse`
CREATE TABLE `tblwarehouse` (
  `nWarehouseID` int(11) NOT NULL AUTO_INCREMENT,
  `cLocation` text NOT NULL,
  `nStorageCapacity` int(11) NOT NULL,
  PRIMARY KEY (`nWarehouseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `tblwarehouse`
INSERT INTO `tblwarehouse` (`nWarehouseID`, `cLocation`, `nStorageCapacity`) VALUES
(1, 'Warehouse A, North', 2000),
(2, 'Warehouse B, South', 1500);

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data for table `users`
INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'crop_user', 'crop123', 'crop_user'),
(2, 'inventory_user', 'inv456', 'inventory_user'),
(3, 'storage_user', 'store789', 'storage_user'),
(4, 'packaging_user', 'pack101', 'packaging_user'),
(5, 'vendor_user', 'vend112', 'vendor_user'),
(6, 'admin', 'admin123', 'admin');

-- Indexes and Constraints (already applied in CREATE TABLE)
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;