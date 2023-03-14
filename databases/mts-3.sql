-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2023 at 11:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mts`
--

-- --------------------------------------------------------

--
-- Table structure for table `damage_notification`
--

CREATE TABLE `damage_notification` (
  `ID` int(10) NOT NULL,
  `Date_Of_Notification` int(10) NOT NULL,
  `Reported_By_ID` int(10) NOT NULL,
  `Details` varchar(255) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `damage_notification_medicine`
--

CREATE TABLE `damage_notification_medicine` (
  `ID` int(10) NOT NULL,
  `Damage_Notification_ID` int(10) NOT NULL,
  `Medicine_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_notification`
--

CREATE TABLE `delivery_notification` (
  `ID` int(10) NOT NULL,
  `Date_Of_Delivery` date NOT NULL,
  `Delivered_By_ID` int(10) NOT NULL,
  `Delivered_To_ID` int(10) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_notification`
--

INSERT INTO `delivery_notification` (`ID`, `Date_Of_Delivery`, `Delivered_By_ID`, `Delivered_To_ID`, `Location`) VALUES
(13, '2023-03-12', 2, 4, '-12.847519075541177,28.250778751911895'),
(14, '2023-03-12', 2, 4, '-12.847519075541177,28.250778751911895');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_notification_medicine`
--

CREATE TABLE `delivery_notification_medicine` (
  `ID` int(10) NOT NULL,
  `Delivery_Notification_ID` int(10) NOT NULL,
  `Medicine_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_notification_medicine`
--

INSERT INTO `delivery_notification_medicine` (`ID`, `Delivery_Notification_ID`, `Medicine_ID`, `Quantity`) VALUES
(6, 13, 6, 1),
(7, 14, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Manufactured_Date` date NOT NULL,
  `Expiry_Date` date NOT NULL,
  `GTIN` varchar(100) NOT NULL,
  `Serial_Number` varchar(100) NOT NULL,
  `LOT_Number` varchar(100) NOT NULL,
  `Package_Details` varchar(255) NOT NULL,
  `Manufacturer_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`ID`, `Name`, `Description`, `Manufactured_Date`, `Expiry_Date`, `GTIN`, `Serial_Number`, `LOT_Number`, `Package_Details`, `Manufacturer_ID`) VALUES
(5, 'Brustan', 'Ibuprofen and Paracetamol Suspension', '2022-01-01', '2023-12-04', '18901296108038', 'BSP8372GA9251C', 'ALZ0008', '100 ml bottle', 3),
(6, 'LONART 20/120', 'Powerder for oral suspension. Curative Antimalarial Paediatric', '2021-12-01', '2023-11-01', '18906009235674', '0BP1202A10999430F27', 'A1ALM088', '24g / 60 ml', 7);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `ID` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `User_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `ID` int(11) NOT NULL,
  `Details` varchar(255) NOT NULL,
  `Prescription_Date` date NOT NULL,
  `Hospital_ID` int(10) NOT NULL,
  `Patient_ID` int(10) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`ID`, `Details`, `Prescription_Date`, `Hospital_ID`, `Patient_ID`, `Location`) VALUES
(7, '', '2023-03-14', 2, 4, '-12.81579482863663,28.233165609631275'),
(8, '', '2023-03-14', 2, 4, '-12.81579482863663,28.233165609631275');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicine`
--

CREATE TABLE `prescription_medicine` (
  `ID` int(10) NOT NULL,
  `Prescription_ID` int(10) NOT NULL,
  `Medicine_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Dosage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription_medicine`
--

INSERT INTO `prescription_medicine` (`ID`, `Prescription_ID`, `Medicine_ID`, `Quantity`, `Dosage`) VALUES
(2, 7, 6, 1, '5mls 2 times daily'),
(3, 8, 6, 1, '5mls 2 times daily');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_notification`
--

CREATE TABLE `receipt_notification` (
  `ID` int(10) NOT NULL,
  `Date_Of_Receipt` date NOT NULL,
  `Buyer_ID` int(10) NOT NULL,
  `Seller_ID` int(10) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipt_notification`
--

INSERT INTO `receipt_notification` (`ID`, `Date_Of_Receipt`, `Buyer_ID`, `Seller_ID`, `Location`) VALUES
(2, '2023-03-11', 4, 2, '-15.261034832499778,28.759407079051623');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_notification_medicine`
--

CREATE TABLE `receipt_notification_medicine` (
  `ID` int(10) NOT NULL,
  `Receipt_Notification_ID` int(10) NOT NULL,
  `Medicine_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipt_notification_medicine`
--

INSERT INTO `receipt_notification_medicine` (`ID`, `Receipt_Notification_ID`, `Medicine_ID`, `Quantity`, `Amount`) VALUES
(1, 2, 5, 1, '89.00');

-- --------------------------------------------------------

--
-- Table structure for table `sale_notification`
--

CREATE TABLE `sale_notification` (
  `ID` int(11) NOT NULL,
  `Date_Of_Sale` date NOT NULL,
  `Buyer_ID` int(11) NOT NULL,
  `Seller_ID` int(11) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_notification`
--

INSERT INTO `sale_notification` (`ID`, `Date_Of_Sale`, `Buyer_ID`, `Seller_ID`, `Location`) VALUES
(15, '2023-02-14', 4, 2, '-15.416667,28.283333'),
(16, '2023-02-14', 4, 2, '-15.437847958485463,28.37122362500001'),
(33, '2023-02-22', 4, 2, '-15.411536952091348,28.05411829074789'),
(34, '2023-02-22', 4, 2, '-15.411536952091348,28.05411829074789'),
(35, '2023-02-22', 4, 2, '-15.411536952091348,28.05411829074789'),
(36, '2023-02-22', 4, 2, '-15.411536952091348,28.05411829074789'),
(37, '2023-02-22', 4, 2, '-15.411536952091348,28.05411829074789'),
(38, '2023-02-24', 4, 2, '-15.586219368291168,27.790446499566922'),
(39, '2023-02-24', 4, 2, '-15.586219368291168,27.790446499566922'),
(40, '2023-02-23', 4, 2, '-15.416667,28.283333'),
(41, '2023-02-23', 4, 2, '-15.416667,28.283333'),
(42, '2023-02-23', 4, 2, '-15.416667,28.283333'),
(43, '2023-02-26', 4, 2, '-15.416667,28.283333'),
(44, '2023-02-26', 4, 2, '-14.99589570521356,28.201545573975334'),
(45, '2023-02-26', 4, 2, '-15.382886878254793,27.740119792725334'),
(46, '2023-02-26', 4, 2, '-15.722689578168772,28.32470713276461'),
(47, '2023-03-07', 4, 2, '-15.080776281617272,28.333381511475334');

-- --------------------------------------------------------

--
-- Table structure for table `sale_notification_medicine`
--

CREATE TABLE `sale_notification_medicine` (
  `ID` int(10) NOT NULL,
  `Sale_Notification_ID` int(10) NOT NULL,
  `Medicine_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_notification_medicine`
--

INSERT INTO `sale_notification_medicine` (`ID`, `Sale_Notification_ID`, `Medicine_ID`, `Quantity`, `Amount`) VALUES
(4, 15, 5, 1, '50.00'),
(5, 16, 5, 1, '57.00'),
(22, 33, 5, 1, '50.00'),
(23, 34, 5, 1, '50.00'),
(24, 35, 5, 1, '50.00'),
(25, 36, 5, 1, '50.00'),
(26, 37, 5, 1, '50.00'),
(27, 38, 5, 1, '6.00'),
(28, 39, 5, 1, '6.00'),
(29, 40, 5, 1, '223.00'),
(30, 41, 5, 1, '223.00'),
(31, 42, 5, 1, '223.00'),
(32, 43, 5, 1, '13.00'),
(33, 44, 5, 1, '78.00'),
(34, 45, 5, 1, '89.00'),
(35, 46, 5, 1, '236.00'),
(36, 47, 5, 1, '23.00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ID` int(10) NOT NULL,
  `Date_Of_Transaction` date NOT NULL,
  `Details` varchar(255) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Transaction_Type_ID` int(10) NOT NULL,
  `Synced` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`ID`, `Date_Of_Transaction`, `Details`, `Location`, `Transaction_Type_ID`, `Synced`) VALUES
(15, '2023-02-22', 'Sale of Medicine', '-15.411536952091348,28.05411829074789', 1, 1),
(16, '2023-02-22', 'Sale of Medicine', '-15.411536952091348,28.05411829074789', 1, 1),
(17, '2023-02-22', 'Sale of Medicine', '-15.411536952091348,28.05411829074789', 1, 1),
(18, '2023-02-22', 'Sale of Medicine', '-15.411536952091348,28.05411829074789', 1, 1),
(19, '2023-02-22', 'Sale of Medicine', '-15.411536952091348,28.05411829074789', 1, 1),
(20, '2023-02-22', 'Sale of Medicine', '-15.586219368291168,27.790446499566922', 1, 1),
(21, '2023-02-22', 'Sale of Medicine', '-15.586219368291168,27.790446499566922', 1, 1),
(22, '2023-02-23', 'Sale of Medicine', '-15.416667,28.283333', 1, 1),
(23, '2023-02-23', 'Sale of Medicine', '-15.416667,28.283333', 1, 1),
(24, '2023-02-23', 'Sale of Medicine', '-15.416667,28.283333', 1, 1),
(25, '2023-02-26', 'Sale of Medicine', '-15.416667,28.283333', 1, 1),
(26, '2023-02-26', 'Sale of Medicine', '-14.99589570521356,28.201545573975334', 1, 1),
(27, '2023-02-26', 'Sale of Medicine', '-15.382886878254793,27.740119792725334', 1, 1),
(28, '2023-02-26', 'Sale of Medicine', '-15.722689578168772,28.32470713276461', 1, 1),
(29, '2023-03-07', 'Sale of Medicine', '-15.080776281617272,28.333381511475334', 1, 1),
(30, '2023-03-11', 'Receipt of Medicine', '-15.261034832499778,28.759407079051623', 1, 0),
(32, '2023-03-12', 'Delivery of Medicine', '-12.847519075541177,28.250778751911895', 4, 0),
(33, '2023-03-12', 'Delivery of Medicine', '-12.847519075541177,28.250778751911895', 4, 0),
(34, '2023-03-14', 'Dispensation of Medicine', '-12.81579482863663,28.233165609631275', 5, 0),
(35, '2023-03-14', 'Dispensation of Medicine', '-12.81579482863663,28.233165609631275', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_actor`
--

CREATE TABLE `transaction_actor` (
  `ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Transaction_Role_ID` int(10) NOT NULL,
  `Transaction_ID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_actor`
--

INSERT INTO `transaction_actor` (`ID`, `User_ID`, `Transaction_Role_ID`, `Transaction_ID`) VALUES
(22, 4, 1, 15),
(23, 2, 2, 15),
(24, 4, 1, 16),
(25, 2, 2, 16),
(26, 4, 1, 17),
(27, 2, 2, 17),
(28, 4, 1, 18),
(29, 2, 2, 18),
(30, 4, 1, 19),
(31, 2, 2, 19),
(32, 4, 1, 20),
(33, 2, 2, 20),
(34, 4, 1, 21),
(35, 2, 2, 21),
(36, 4, 1, 22),
(37, 2, 2, 22),
(38, 4, 1, 23),
(39, 2, 2, 23),
(40, 4, 1, 24),
(41, 2, 2, 24),
(42, 4, 1, 25),
(43, 2, 2, 25),
(44, 4, 1, 26),
(45, 2, 2, 26),
(46, 4, 1, 27),
(47, 2, 2, 27),
(48, 4, 1, 28),
(49, 2, 2, 28),
(50, 4, 1, 29),
(51, 2, 2, 29),
(52, 4, 1, 30),
(53, 2, 2, 30),
(54, 2, 5, 32),
(55, 4, 4, 32),
(56, 2, 5, 33),
(57, 4, 4, 33),
(58, 4, 6, 34),
(59, 2, 7, 34),
(60, 4, 6, 35),
(61, 2, 7, 35);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_medicine`
--

CREATE TABLE `transaction_medicine` (
  `ID` int(10) NOT NULL,
  `Transaction_ID` int(10) NOT NULL,
  `Medicine_ID` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Details` varchar(255) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_medicine`
--

INSERT INTO `transaction_medicine` (`ID`, `Transaction_ID`, `Medicine_ID`, `Quantity`, `Details`, `Amount`) VALUES
(2, 15, 5, 1, 'medicine details', '50.00'),
(3, 16, 5, 1, 'medicine details', '50.00'),
(4, 17, 5, 1, 'medicine details', '50.00'),
(5, 18, 5, 1, 'medicine details', '50.00'),
(6, 19, 5, 1, 'medicine details', '50.00'),
(7, 20, 5, 1, 'medicine details', '6.00'),
(8, 21, 5, 1, 'medicine details', '6.00'),
(9, 22, 5, 1, 'medicine details', '223.00'),
(10, 23, 5, 1, 'medicine details', '223.00'),
(11, 24, 5, 1, 'medicine details', '223.00'),
(12, 25, 5, 1, 'medicine details', '13.00'),
(13, 26, 5, 1, 'medicine details', '78.00'),
(14, 27, 5, 1, 'medicine details', '89.00'),
(15, 28, 5, 1, 'medicine details', '236.00'),
(16, 29, 5, 1, 'medicine details', '23.00'),
(17, 30, 5, 1, 'medicine details', '89.00'),
(18, 32, 6, 1, 'medicine details', NULL),
(19, 33, 6, 1, 'medicine details', '0.00'),
(20, 34, 6, 1, 'medicine details', NULL),
(21, 35, 6, 1, 'medicine details', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_role`
--

CREATE TABLE `transaction_role` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_role`
--

INSERT INTO `transaction_role` (`ID`, `Name`, `Description`) VALUES
(1, 'Buyer', 'Buyer of Medicine'),
(2, 'Seller', 'Seller of Medicine'),
(3, 'Manfacturer', 'Manufacturer of Medicines'),
(4, 'Receiver', 'Receiver of medicine'),
(5, 'Deliverer', 'Deliverer of medicine'),
(6, 'Patient', 'Receives medicine from hospital'),
(7, 'Prescriber', 'Issues medicine to patient');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_transaction`
--

CREATE TABLE `type_of_transaction` (
  `ID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_of_transaction`
--

INSERT INTO `type_of_transaction` (`ID`, `Name`, `Description`) VALUES
(1, 'Sale', 'Selling of medicine'),
(2, 'Manufacture', 'Making of Medicine'),
(3, 'Receipt', 'Receiving of Medicine'),
(4, 'Delivery', 'Delivery of medicine to receipient'),
(5, 'Prescription', 'Dispensation of medicine to patient');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `User_Type_ID` int(10) NOT NULL,
  `Public_Key` text DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Name`, `Address`, `Email`, `Username`, `Password`, `User_Type_ID`, `Public_Key`, `IP_Address`) VALUES
(2, 'Link Pharmacy', 'Kitwe, Riverside, ZAMBIA   ', 'info@linkpharmacy.co.zm', 'link', '$2y$10$AlP4zo/AWcoF5UCmp9x4.eUtagj6nmJqblfBw4qxP7G3pH5MbX/yS', 3, NULL, NULL),
(3, 'Sun Pharmaceutical Ind LTd', 'The Madras Pharmaceuticals 137-B,\nOld Mahabalipuram Road,\nKarapakkam, Chennai - 600 096\nINDIA       ', 'info@sunpharmaceuticalsindltdtest.com', 'sunpharma', '$2y$10$AlP4zo/AWcoF5UCmp9x4.eUtagj6nmJqblfBw4qxP7G3pH5MbX/yS', 1, NULL, NULL),
(4, 'Michael Sinkolongo', 'Plot No. 5740, Kitwe', 'michaelsinkolongo@gmail.com', 'michael', '$2y$10$3YeFPS.517B/jtjiI9g4kegwiRMHobefbPwRU3lWIpFe4EvoDVGZS ', 5, NULL, NULL),
(5, 'Miner', 'House No 1.', 'michaelsinkolongo@yahoo.com', 'miner', '$2y$10$AlP4zo/AWcoF5UCmp9x4.eUtagj6nmJqblfBw4qxP7G3pH5MbX/yS', 8, '', 'localhost:8080'),
(6, 'Kitwe Miner', 'Kitwe', 'kudsink@gmail.com', 'miner2', '$2y$10$AlP4zo/AWcoF5UCmp9x4.eUtagj6nmJqblfBw4qxP7G3pH5MbX/yS', 8, '', 'localhost:8081'),
(7, 'Bliss GVS Pharma LTD', '102, Hyde Park, Saki Vihar Road,\nAndheri (E), Mumbai - 400 072, INDIA', 'bliss@example.com', 'bliss', '$2y$10$nO3oz8JikTucI9cphM6L5eGB.a7I8xqlp8lvXxziY4F0Nksk/ZEOG', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Can_Add_Medicine` int(1) NOT NULL DEFAULT 0,
  `Can_View_Medicine` int(1) NOT NULL DEFAULT 0,
  `Can_Sale` int(1) NOT NULL DEFAULT 0,
  `Can_Receive` int(1) NOT NULL DEFAULT 0,
  `Can_Deliver` int(1) NOT NULL DEFAULT 0,
  `Can_Dispense` int(1) NOT NULL DEFAULT 0,
  `Can_View_Report` int(1) NOT NULL DEFAULT 0,
  `Can_Report_Damage` int(1) NOT NULL DEFAULT 0,
  `Can_Mine` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`ID`, `Name`, `Description`, `Can_Add_Medicine`, `Can_View_Medicine`, `Can_Sale`, `Can_Receive`, `Can_Deliver`, `Can_Dispense`, `Can_View_Report`, `Can_Report_Damage`, `Can_Mine`) VALUES
(1, 'Manufacturer', 'Create of Medicines', 1, 1, 1, 0, 0, 0, 0, 0, 0),
(2, 'Wholesaler', 'Buys medicine from manufacturer and sells it in bulk.', 0, 1, 1, 1, 0, 0, 1, 1, 0),
(3, 'Retailer', 'Buys medicine from the wholesaler and sales it to the end user or the Hospital', 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 'Hospital', 'Healthcare provider', 0, 1, 0, 1, 0, 1, 1, 1, 0),
(5, 'Patient', 'End consumer of the medicine', 0, 1, 0, 1, 0, 0, 1, 1, 0),
(6, 'Regulator', '', 0, 1, 0, 0, 0, 0, 1, 0, 0),
(7, 'Logistics and Transport', 'These are responsible for Tracking medicine', 0, 1, 0, 1, 1, 0, 1, 0, 0),
(8, 'Miner', 'This user can mine transactions, adding them to the blockchain.', 0, 0, 0, 0, 0, 0, 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `damage_notification`
--
ALTER TABLE `damage_notification`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Reported_By_ID` (`Reported_By_ID`);

--
-- Indexes for table `damage_notification_medicine`
--
ALTER TABLE `damage_notification_medicine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Damage_Notification_ID` (`Damage_Notification_ID`),
  ADD KEY `Medicine_ID` (`Medicine_ID`);

--
-- Indexes for table `delivery_notification`
--
ALTER TABLE `delivery_notification`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Delivered_By_ID` (`Delivered_By_ID`),
  ADD KEY `Delivered_To_ID` (`Delivered_To_ID`);

--
-- Indexes for table `delivery_notification_medicine`
--
ALTER TABLE `delivery_notification_medicine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Delivery_Notification_ID` (`Delivery_Notification_ID`),
  ADD KEY `Medicine_ID` (`Medicine_ID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `GTIN` (`GTIN`),
  ADD UNIQUE KEY `Serial_Number` (`Serial_Number`),
  ADD KEY `Manufacturer_ID` (`Manufacturer_ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Hospital_ID` (`Hospital_ID`),
  ADD KEY `Patient_ID` (`Patient_ID`);

--
-- Indexes for table `prescription_medicine`
--
ALTER TABLE `prescription_medicine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Prescription_ID` (`Prescription_ID`),
  ADD KEY `Medicine_ID` (`Medicine_ID`);

--
-- Indexes for table `receipt_notification`
--
ALTER TABLE `receipt_notification`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Buyer_ID` (`Buyer_ID`),
  ADD KEY `Seller_ID` (`Seller_ID`);

--
-- Indexes for table `receipt_notification_medicine`
--
ALTER TABLE `receipt_notification_medicine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Receipt_Notification_ID` (`Receipt_Notification_ID`),
  ADD KEY `Medicine_ID` (`Medicine_ID`);

--
-- Indexes for table `sale_notification`
--
ALTER TABLE `sale_notification`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Buyer_ID` (`Buyer_ID`),
  ADD KEY `Seller_ID` (`Seller_ID`);

--
-- Indexes for table `sale_notification_medicine`
--
ALTER TABLE `sale_notification_medicine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Sale_Notification_ID` (`Sale_Notification_ID`),
  ADD KEY `Medicine_ID` (`Medicine_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Transaction_Type_ID` (`Transaction_Type_ID`);

--
-- Indexes for table `transaction_actor`
--
ALTER TABLE `transaction_actor`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Transaction_Role_ID` (`Transaction_Role_ID`),
  ADD KEY `Transaction_ID` (`Transaction_ID`);

--
-- Indexes for table `transaction_medicine`
--
ALTER TABLE `transaction_medicine`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Transaction_ID` (`Transaction_ID`),
  ADD KEY `Medicine_ID` (`Medicine_ID`);

--
-- Indexes for table `transaction_role`
--
ALTER TABLE `transaction_role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `type_of_transaction`
--
ALTER TABLE `type_of_transaction`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `User_Type_ID` (`User_Type_ID`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `damage_notification`
--
ALTER TABLE `damage_notification`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage_notification_medicine`
--
ALTER TABLE `damage_notification_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_notification`
--
ALTER TABLE `delivery_notification`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `delivery_notification_medicine`
--
ALTER TABLE `delivery_notification_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prescription_medicine`
--
ALTER TABLE `prescription_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receipt_notification`
--
ALTER TABLE `receipt_notification`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `receipt_notification_medicine`
--
ALTER TABLE `receipt_notification_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_notification`
--
ALTER TABLE `sale_notification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `sale_notification_medicine`
--
ALTER TABLE `sale_notification_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `transaction_actor`
--
ALTER TABLE `transaction_actor`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `transaction_medicine`
--
ALTER TABLE `transaction_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaction_role`
--
ALTER TABLE `transaction_role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `type_of_transaction`
--
ALTER TABLE `type_of_transaction`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `damage_notification`
--
ALTER TABLE `damage_notification`
  ADD CONSTRAINT `damage_notification_ibfk_1` FOREIGN KEY (`Reported_By_ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `damage_notification_medicine`
--
ALTER TABLE `damage_notification_medicine`
  ADD CONSTRAINT `damage_notification_medicine_ibfk_1` FOREIGN KEY (`Damage_Notification_ID`) REFERENCES `damage_notification` (`ID`),
  ADD CONSTRAINT `damage_notification_medicine_ibfk_2` FOREIGN KEY (`Medicine_ID`) REFERENCES `medicine` (`ID`);

--
-- Constraints for table `delivery_notification`
--
ALTER TABLE `delivery_notification`
  ADD CONSTRAINT `delivery_notification_ibfk_1` FOREIGN KEY (`Delivered_By_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `delivery_notification_ibfk_2` FOREIGN KEY (`Delivered_To_ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `delivery_notification_medicine`
--
ALTER TABLE `delivery_notification_medicine`
  ADD CONSTRAINT `delivery_notification_medicine_ibfk_1` FOREIGN KEY (`Delivery_Notification_ID`) REFERENCES `delivery_notification` (`ID`),
  ADD CONSTRAINT `delivery_notification_medicine_ibfk_2` FOREIGN KEY (`Medicine_ID`) REFERENCES `medicine` (`ID`);

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`Manufacturer_ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`Hospital_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`Hospital_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `prescription_ibfk_3` FOREIGN KEY (`Patient_ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `prescription_medicine`
--
ALTER TABLE `prescription_medicine`
  ADD CONSTRAINT `prescription_medicine_ibfk_1` FOREIGN KEY (`Prescription_ID`) REFERENCES `prescription` (`ID`),
  ADD CONSTRAINT `prescription_medicine_ibfk_2` FOREIGN KEY (`Medicine_ID`) REFERENCES `medicine` (`ID`);

--
-- Constraints for table `receipt_notification`
--
ALTER TABLE `receipt_notification`
  ADD CONSTRAINT `receipt_notification_ibfk_1` FOREIGN KEY (`Buyer_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `receipt_notification_ibfk_2` FOREIGN KEY (`Seller_ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `receipt_notification_medicine`
--
ALTER TABLE `receipt_notification_medicine`
  ADD CONSTRAINT `receipt_notification_medicine_ibfk_1` FOREIGN KEY (`Receipt_Notification_ID`) REFERENCES `receipt_notification` (`ID`),
  ADD CONSTRAINT `receipt_notification_medicine_ibfk_2` FOREIGN KEY (`Medicine_ID`) REFERENCES `medicine` (`ID`);

--
-- Constraints for table `sale_notification`
--
ALTER TABLE `sale_notification`
  ADD CONSTRAINT `sale_notification_ibfk_1` FOREIGN KEY (`Buyer_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `sale_notification_ibfk_2` FOREIGN KEY (`Seller_ID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `sale_notification_medicine`
--
ALTER TABLE `sale_notification_medicine`
  ADD CONSTRAINT `sale_notification_medicine_ibfk_1` FOREIGN KEY (`Sale_Notification_ID`) REFERENCES `sale_notification` (`ID`),
  ADD CONSTRAINT `sale_notification_medicine_ibfk_2` FOREIGN KEY (`Medicine_ID`) REFERENCES `medicine` (`ID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`Transaction_Type_ID`) REFERENCES `type_of_transaction` (`ID`);

--
-- Constraints for table `transaction_actor`
--
ALTER TABLE `transaction_actor`
  ADD CONSTRAINT `transaction_actor_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `transaction_actor_ibfk_3` FOREIGN KEY (`Transaction_ID`) REFERENCES `transaction` (`ID`),
  ADD CONSTRAINT `transaction_actor_ibfk_4` FOREIGN KEY (`Transaction_ID`) REFERENCES `transaction` (`ID`);

--
-- Constraints for table `transaction_medicine`
--
ALTER TABLE `transaction_medicine`
  ADD CONSTRAINT `transaction_medicine_ibfk_1` FOREIGN KEY (`Transaction_ID`) REFERENCES `transaction` (`ID`),
  ADD CONSTRAINT `transaction_medicine_ibfk_2` FOREIGN KEY (`Medicine_ID`) REFERENCES `medicine` (`ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`User_Type_ID`) REFERENCES `user_type` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
