-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2016 at 11:36 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocfa_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_public`
--

CREATE TABLE `user_public` (
  `nik` bigint(16) NOT NULL,
  `nama_aplikasi` varchar(128) NOT NULL,
  `nama_instansi` varchar(64) NOT NULL,
  `email_instansi` varchar(64) NOT NULL,
  `no_telp_instansi` char(18) NOT NULL,
  `alamat_instansi` varchar(128) NOT NULL,
  `tdp` int(12) NOT NULL,
  `scan_tdp` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_public`
--
ALTER TABLE `user_public`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `nik` (`nik`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_public`
--
ALTER TABLE `user_public`
  ADD CONSTRAINT `user_public` FOREIGN KEY (`nik`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
