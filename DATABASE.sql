-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2019 at 02:13 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btl_masterserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `server_list`
--

CREATE TABLE `server_list` (
  `servername` varchar(45) NOT NULL,
  `serverip` varchar(45) NOT NULL,
  `serverport` int(5) NOT NULL,
  `version` varchar(45) NOT NULL,
  `currplayers` int(10) NOT NULL,
  `maxplayers` int(10) NOT NULL,
  `gamestarted` tinyint(1) NOT NULL DEFAULT '0',
  `password` tinyint(1) NOT NULL,
  `contentpackage` varchar(45) DEFAULT NULL,
  `timelisted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `server_list`
--
ALTER TABLE `server_list`
  ADD PRIMARY KEY (`serverip`,`serverport`),
  ADD KEY `INDEX_TIMESTAMP` (`timelisted`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `PurgeServerList` ON SCHEDULE EVERY 1 MINUTE STARTS '2019-06-07 06:35:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `server_list` WHERE `timelisted` < (CURRENT_TIMESTAMP - INTERVAL 35 SECOND)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
