-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 23, 2018 at 08:11 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meetbankdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `AccountMaster`
--

CREATE TABLE `AccountMaster` (
  `AccountID` int(50) NOT NULL,
  `AccountNumber` varchar(50) NOT NULL,
  `HolderName1` varchar(50) NOT NULL,
  `HolderName2` varchar(50) NOT NULL,
  `ContactNo` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Line1` varchar(50) NOT NULL,
  `Line2` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `OpeningBalance` int(50) NOT NULL,
  `KYC` varchar(10) NOT NULL,
  `ClosingBalance` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AccountMaster`
--

INSERT INTO `AccountMaster` (`AccountID`, `AccountNumber`, `HolderName1`, `HolderName2`, `ContactNo`, `Email`, `Line1`, `Line2`, `City`, `OpeningBalance`, `KYC`, `ClosingBalance`) VALUES
(1, '5001', 'Meet', 'Yash', '9909081296', 'mmeetpanchani@gmail.com', 'shantinagar', 'Gondal', 'Gondal', 5000, 'Yes', 18000),
(2, '5002', 'Vasu', 'Vinish', '9909081296', 'rahul6743@gmail.com', 'shantinagar', 'Gondal', 'Gondal', 7000, 'Yes', 17000),
(3, '5003', 'Karan', 'Arjun', '9909081296', 'mmeetpanchani@gmail.com', 'shantinagar', 'Gondal', 'Gondal', 6000, 'Yes', 16005),
(4, '5004', 'Jay', 'Viru', '9909081296', 'mmeetpanchani@gmail.com', 'shantinagar', 'Gondal', 'Gondal', 5000, 'Yes', 28000),
(5, '5005', 'Tanu', 'Manu', '9909081296', 'mmeetpanchani@gmail.com', 'shantinagar', 'Gondal', 'Gondal', 6000, 'Yes', 33000),
(6, '5006', 'Rahul', 'Rohan', '9909081296', 'mmeetpanchani@gmail.com', 'shantinagar', 'Gondal', 'Gondal', 7000, 'Yes', 16000),
(0, '9999', 'Cash Account', 'Cash Account', '', '', '', '', '', -36000, '', -128005);

-- --------------------------------------------------------

--
-- Table structure for table `Transaction`
--

CREATE TABLE `Transaction` (
  `TransactionID` int(50) NOT NULL,
  `TransactionDate` date NOT NULL,
  `Type` varchar(20) NOT NULL,
  `InputType` varchar(20) NOT NULL,
  `AccountIDcr` varchar(50) NOT NULL,
  `AccountIDdr` int(50) NOT NULL,
  `Amount` int(50) NOT NULL,
  `Narration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Transaction`
--

INSERT INTO `Transaction` (`TransactionID`, `TransactionDate`, `Type`, `InputType`, `AccountIDcr`, `AccountIDdr`, `Amount`, `Narration`) VALUES
(1, '2018-07-21', 'Cash', 'Deposit', '5001', 9999, 20000, 'add'),
(2, '2018-07-21', 'Cash', 'Deposit', '5002', 9999, 15000, 'add'),
(3, '2018-07-21', 'Cash', 'Deposit', '5003', 9999, 10000, 'add'),
(4, '2018-07-21', 'Cash', 'Deposit', '5004', 9999, 25000, 'add'),
(5, '2018-07-21', 'Cash', 'Deposit', '5005', 9999, 20000, 'add'),
(6, '2018-07-21', 'Cash', 'Deposit', '5006', 9999, 10000, 'add'),
(7, '2018-07-21', 'Cash', 'Withdraw', '9999', 5001, 5000, 'sub'),
(8, '2018-07-21', 'Cheque', 'Deposit', '5003', 5002, 5000, 'from5002'),
(9, '2018-07-21', 'Cheque', 'Withdraw', '5005', 5004, 7000, 'from5004'),
(10, '2018-07-21', 'Cash', 'Withdraw', '9999', 5006, 3000, 'sub'),
(11, '2018-07-21', 'Cheque', 'Deposit', '5004', 5003, 5000, 'from5003'),
(12, '2018-07-21', 'Cheque', 'Withdraw', '5006', 5001, 2000, 'from5001'),
(13, '2018-07-23', 'Cash', 'Deposit', '5003', 9999, 10, 'add'),
(14, '2018-07-23', 'Cash', 'Withdraw', '9999', 5003, 5, 'sub');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AccountMaster`
--
ALTER TABLE `AccountMaster`
  ADD PRIMARY KEY (`AccountNumber`);

--
-- Indexes for table `Transaction`
--
ALTER TABLE `Transaction`
  ADD PRIMARY KEY (`TransactionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
