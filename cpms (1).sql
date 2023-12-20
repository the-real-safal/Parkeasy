-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 02:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `area` text NOT NULL,
  `lot_no` text NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `v_type` text NOT NULL,
  `lis_no` text NOT NULL,
  `plate_no` text NOT NULL,
  `e_date` text NOT NULL,
  `d_date` text NOT NULL,
  `status` text NOT NULL,
  `charge` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `area`, `lot_no`, `username`, `email`, `v_type`, `lis_no`, `plate_no`, `e_date`, `d_date`, `status`, `charge`) VALUES
(9, 'Lot C', '10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '1234567890', '2345 AAB', '2023-08-08 13:10:17', '2023-08-09 20:05:08', 'unbooked', ''),
(10, 'Lot B', '10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Truck', '1234567890', 'BA A 1342', '2023-08-08 13:21:10', '2023-08-08 13:26:25', 'unbooked', ''),
(11, 'Lot A', '10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Truck', '1234567890', 'BA A 1342', '2023-08-08 13:53:33', '2023-08-08 17:52:33', 'unbooked', ''),
(12, 'Lot A', '10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'awefresfg', 'erfwwef', '2023-08-08 17:52:19', '2023-08-08 17:52:55', 'unbooked', ''),
(13, 'Lot A', '20', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'awefresfg', 'erfwwef', '2023-08-08 18:10:28', '2023-08-08 18:10:46', 'unbooked', ''),
(19, 'Lot A', '150', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'erwfgawer', 'egfaegfa', '2023-08-08 20:20:09', '2023-08-08 20:27:30', 'unbooked', ''),
(20, 'Lot A', '90', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'erwfgawer', 'egfaegfa', '2023-08-08 20:26:46', '2023-08-08 20:27:35', 'unbooked', ''),
(21, 'Lot A', '100', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'erwfgawer', 'egfaegfa', '2023-08-08 20:27:25', '2023-08-08 20:27:39', 'unbooked', ''),
(23, 'Lot B', '20', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '12345678', '1234', '2023-08-09 11:38:40', '2023-08-09 11:41:34', 'unbooked', ''),
(24, 'Lot B', '30', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '12345678', '1234', '2023-08-09 11:58:43', '2023-08-09 11:58:53', 'unbooked', ''),
(25, 'Lot B', '40', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '12345678', '1234', '2023-08-09 12:00:21', '2023-08-09 12:00:31', 'unbooked', ''),
(27, 'Lot A', '2', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'ergerg', 'rgserg', '2023-08-09 19:03:14', '2023-08-09 19:07:34', 'unbooked', ''),
(28, 'Lot A', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '123', '123', '2023-08-09 19:07:12', '2023-08-09 19:07:22', 'unbooked', ''),
(29, 'Lot A', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '123', '123', '2023-08-09 20:05:40', '2023-08-09 20:45:01', 'unbooked', ''),
(30, 'Lot A', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'dfgbdsfg', 'dfgbdsfg', '2023-08-09 20:46:19', '2023-08-09 20:46:24', 'unbooked', ''),
(32, 'Lot A', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'dsfgdsrg', 'fgddsfgers', '2023-08-09 20:54:14', '2023-08-09 20:59:32', 'unbooked', '2.5'),
(33, 'Ground Floor', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Truck', 'drgertygh', 'ergerg', '2023-08-09 21:34:01', '2023-08-09 21:35:02', 'unbooked', '0'),
(34, 'First Floor', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'rtherth', 'ertghrktg', '2023-08-09 21:42:00', '2023-08-09 21:45:51', 'unbooked', '1.5'),
(35, 'First Floor', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '1234567890', 'BA A 2345', '2023-08-10 10:22:06', '2023-08-10 11:23:14', 'unbooked', '30.5'),
(36, 'First Floor', '2', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '1234', 'BA A 2056', '2023-08-10 11:23:03', '2023-08-10 11:32:40', 'unbooked', '4.5'),
(37, 'First Floor', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '12345567', 'BA A 2345', '2023-08-10 11:36:33', '2023-08-10 11:41:31', 'unbooked', '2'),
(38, 'First Floor', '2', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '12345567', 'BA A 2345', '2023-08-10 11:39:02', '2023-08-10 11:41:38', 'unbooked', '1'),
(39, 'First Floor', '3', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'sdgfsdfvsd', 'dsgfvsdfvg', '2023-08-10 11:40:38', '2023-08-10 11:41:46', 'unbooked', '0.5'),
(40, 'First Floor', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'ehkjrbge', '4r', '2023-08-10 11:45:35', '2023-08-10 16:35:31', 'unbooked', '144.5'),
(41, 'First Floor', '2', 'User User', 'user@gmail.com', 'Car', 'wefwef', 'wefwefwef', '2023-08-10 11:47:25', '2023-08-10 11:55:03', 'unbooked', '3.5'),
(42, 'Second Floor', '20', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '234123', '6780', '2023-08-10 20:42:16', '2023-08-10 21:39:31', 'unbooked', '28'),
(43, 'Second Floor', '18', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '234123', '6780', '2023-08-10 20:57:06', '2023-08-10 21:40:56', 'unbooked', '21.5'),
(44, 'Second Floor', '19', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '234123', '6780', '2023-08-10 20:57:38', '2023-08-10 21:41:10', 'unbooked', '21.5'),
(45, 'First Floor', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'Helllo', 'Hello ', '2023-08-10 21:11:00', '2023-08-10 21:42:19', 'unbooked', '15.5'),
(46, 'First Floor', '2', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'Helllo', 'Hello ', '2023-08-10 21:12:06', '2023-08-10 21:43:26', 'unbooked', '15.5'),
(47, 'First Floor', '3', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'Helllo', 'Hello ', '2023-08-10 21:12:59', '2023-08-10 21:43:44', 'unbooked', '15'),
(48, 'First Floor', '4', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'Helllo', 'Hello ', '2023-08-10 21:14:57', '2023-08-10 21:44:00', 'unbooked', '14.5'),
(49, 'First Floor', '20', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'Helllo', 'Hello ', '2023-08-10 21:20:33', '2023-08-10 21:44:15', 'unbooked', '11.5'),
(50, 'First Floor', '9', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'Helllo', 'Hello ', '2023-08-10 21:20:43', '2023-08-10 21:44:39', 'unbooked', '11.5'),
(51, 'First Floor', '19', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'dsfsdfsd', 'sdfsdf', '2023-08-10 21:24:30', '2023-08-10 21:44:53', 'unbooked', '10'),
(52, 'First Floor', '14', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', 'dsfsdfsd', 'sdfsdf', '2023-08-10 21:26:04', '2023-08-10 21:45:19', 'unbooked', '9.5'),
(53, 'First Floor', '1', 'Safal Adhikari', 'lucifer.safal@gmail.com', 'Car', '1234567890', 'BA A 2312', '2023-08-11 11:32:04', '2023-08-11 11:47:18', 'unbooked', '7.5'),
(54, 'First Floor', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '1234356', '1234', '2023-08-11 12:49:24', '2023-08-11 18:39:06', 'unbooked', '174.5'),
(55, 'First Floor', '2', 'Safal Adhikari', 'lucifer.safal@gmail.com', 'Car', '1234', 'BA A 1234', '2023-08-11 18:38:24', '', 'booked', ''),
(56, 'First Floor', '1', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Car', '1234', 'BA A 2345', '2023-08-11 18:47:47', '2023-08-11 19:50:48', 'unbooked', '41');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `msgdate` text NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `msgdate`, `name`, `phone`, `msg`) VALUES
(2, '07.10.23 11:09', 'Safal Adhkari', '9865206654', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `otp` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `email`, `otp`) VALUES
(33, 'irakihda.lafas@gmail.com', '912116'),
(34, 'irakihda.lafas@gmail.com', '614678');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `date` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `area` text NOT NULL,
  `lot_no` text NOT NULL,
  `duration` text NOT NULL,
  `charge` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `date`, `name`, `email`, `area`, `lot_no`, `duration`, `charge`, `status`) VALUES
(1, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot B', '10', '38', '19', 'paid'),
(2, '2023-08-08', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot B', '10', '38minutes', '19', 'paid'),
(3, '2023-08-07', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '10', '238 minutes', '238', 'paid'),
(4, '2023-08-05', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '10', '0 minutes', '0', 'paid'),
(5, '2023-08-05', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '20', '0 minutes', '0', 'paid'),
(6, '2023-08-08', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '100', '7 minutes', '3.5', 'paid'),
(7, '2023-08-08', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '100', '0 minutes', '0', 'paid'),
(8, '2023-08-08', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '100', '0 minutes', '0', 'paid'),
(9, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot B', '20', '2 minutes', '1', 'paid'),
(10, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot B', '30', '0 minutes', '0', 'paid'),
(11, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot B', '40', '0 minutes', '0', 'paid'),
(12, '2023-08-09', '', '', 'Lot A', '1', '0 minutes', '0', 'paid'),
(13, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '1', '0 minutes', '0', 'paid'),
(14, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '1', '4 minutes', '2', 'paid'),
(15, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '1', '1854 minutes', '927', 'paid'),
(16, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '1', '39 minutes', '19.5', 'paid'),
(17, '', '', '', '', '', '', '19.5', ''),
(18, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '1', '0 minutes', '0', 'paid'),
(19, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot A', '1', '5 minutes', '2.5', 'paid'),
(20, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Ground Floor', '1', '0 minutes', '0', 'paid'),
(21, '2023-08-09', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '1', '3 minutes', '1.5', 'paid'),
(22, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '2', '61 minutes', '30.5', 'paid'),
(23, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '2', '9 minutes', '4.5', 'paid'),
(24, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '3', '4 minutes', '2', 'paid'),
(25, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '3', '2 minutes', '1', 'paid'),
(26, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '3', '1 minutes', '0.5', 'paid'),
(27, '2023-08-10', 'User User', 'user@gmail.com', 'First Floor', '2', '7 minutes', '3.5', 'paid'),
(28, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '1', '289 minutes', '144.5', 'paid'),
(29, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '56 minutes', '28', 'paid'),
(30, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '43 minutes', '21.5', 'paid'),
(31, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '43 minutes', '21.5', 'paid'),
(32, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '43 minutes', '21.5', 'paid'),
(33, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '31 minutes', '15.5', 'paid'),
(34, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '31 minutes', '15.5', 'paid'),
(35, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '30 minutes', '15', 'paid'),
(36, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '29 minutes', '14.5', 'paid'),
(37, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '23 minutes', '11.5', 'paid'),
(38, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '23 minutes', '11.5', 'paid'),
(39, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '20 minutes', '10', 'paid'),
(40, '2023-08-10', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '14', '19 minutes', '9.5', 'paid'),
(41, '2023-08-11', 'Safal Adhikari', 'lucifer.safal@gmail.com', 'First Floor', '1', '15 minutes', '7.5', 'paid'),
(42, '2023-08-11', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'First Floor', '1', '349 minutes', '174.5', 'paid'),
(43, '2023-08-11', 'Safal Adhikari', 'irakihda.lafas@gmail.com', 'Lot C', '10', '62 minutes', '41', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `plate_no` text NOT NULL,
  `id` int(11) NOT NULL,
  `pl_booked` text NOT NULL,
  `access` int(11) NOT NULL,
  `verification` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `phone`, `name`, `password`, `plate_no`, `id`, `pl_booked`, `access`, `verification`) VALUES
('admin', 'admin@gmail.com', '012345', 'Super Admin', '12345', '', 1, 'NO', 0, ''),
('safal', 'irakihda.lafas@gmail.com', '9865206654', 'Safal Adhikari', 'safal2000', 'BA A 2314', 8, 'NO', 2, 'YES'),
('Santosh ', '19antoshrimal@gmail.com', '9861220524', 'Santosh  Sir Rimal', 'santoshrimalsir', '', 17, '', 1, ''),
('User', 'user@gmail.com', '12345', 'User User', 'user', 'BA A 2345', 18, '', 2, ''),
('Safal', 'lucifer.safal@gmail.com', '9865206654', 'Safal Adhikari', 'safal', 'BA A 2314', 30, '', 2, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `street` text NOT NULL,
  `plot` text NOT NULL,
  `status` text NOT NULL,
  `model` text NOT NULL,
  `vehicle` text NOT NULL,
  `platenumber` text NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `account` text NOT NULL,
  `tdate` text NOT NULL,
  `d1` text NOT NULL,
  `d2` text NOT NULL,
  `charge` text NOT NULL,
  `id` int(5) NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`street`, `plot`, `status`, `model`, `vehicle`, `platenumber`, `name`, `email`, `account`, `tdate`, `d1`, `d2`, `charge`, `id`, `phone`) VALUES
('Second Floor', 'PL 001', 'UNBOOKED', 'Tata Safari', 'car', 'B AA 223458743', '', 'irakihda.lafas@gmail.com', '6237642873682', '', '2023-08-06 19:16:38', '', '120', 21, '9865206654'),
('First Floor', 'PL 001', 'UNBOOKED', 'Truxo', 'truck', 'B AA 2345', '', 'irakihda.lafas@gmail.com', '2364927362369823', '', '2023-08-06 19:29:17', '', '120', 22, '9865206654'),
('Second Floor', 'PL 010', 'RESERVED', 'G-WAgen', 'car', 'BA A 3874', '', 'irakihda.lafas@gmail.com', '237642876', '', '2023-08-07 17:25:42', '', '120', 25, '9865206654'),
('Second Floor', 'PL 002', 'RESERVED', 'Porche', 'car', 'BA A 3456', '', 'irakihda.lafas@gmail.com', '346543564', '', '2023-08-07 17:29:43', '', '120', 26, '9865206654'),
('Second Floor', 'PL 001', 'RESERVED', 'Honda', 'car', 'hjv8329874', '', 'irakihda.lafas@gmail.com', 'sefkwusef732485683', '', '2023-08-07 17:32:38', '', '120', 27, '9865206654');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
