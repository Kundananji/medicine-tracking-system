-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 01:42 PM
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
  `Details` varchar(255) NOT NULL
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
  `Patient_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ID` int(10) NOT NULL,
  `Date_Of_Transaction` date NOT NULL,
  `Details` varchar(255) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Transaction_Type_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_actor`
--

CREATE TABLE `transaction_actor` (
  `ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Transaction_Role_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `transaction_role`
--

CREATE TABLE `transaction_role` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type_of_transaction`
--

CREATE TABLE `type_of_transaction` (
  `ID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `password` varchar(255) NOT NULL,
  `User_Type_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`ID`);

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
  ADD KEY `Transaction_Role_ID` (`Transaction_Role_ID`);

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_notification_medicine`
--
ALTER TABLE `delivery_notification_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription_medicine`
--
ALTER TABLE `prescription_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt_notification`
--
ALTER TABLE `receipt_notification`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt_notification_medicine`
--
ALTER TABLE `receipt_notification_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_notification`
--
ALTER TABLE `sale_notification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_notification_medicine`
--
ALTER TABLE `sale_notification_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_actor`
--
ALTER TABLE `transaction_actor`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_medicine`
--
ALTER TABLE `transaction_medicine`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_role`
--
ALTER TABLE `transaction_role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_of_transaction`
--
ALTER TABLE `type_of_transaction`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `prescription_ibfk_3` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`ID`);

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
  ADD CONSTRAINT `transaction_actor_ibfk_2` FOREIGN KEY (`Transaction_Role_ID`) REFERENCES `transaction` (`ID`);

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
