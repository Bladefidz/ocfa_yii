-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2016 at 07:41 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

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
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
('11', 'ACEH\r'),
('12', 'SUMATERA UTARA\r'),
('13', 'SUMATERA BARAT\r'),
('14', 'RIAU\r'),
('15', 'JAMBI\r'),
('16', 'SUMATERA SELATAN\r'),
('17', 'BENGKULU\r'),
('18', 'LAMPUNG\r'),
('19', 'KEPULAUAN BANGKA BELITUNG\r'),
('21', 'KEPULAUAN RIAU\r'),
('31', 'DKI JAKARTA\r'),
('32', 'JAWA BARAT\r'),
('33', 'JAWA TENGAH\r'),
('34', 'DI YOGYAKARTA\r'),
('35', 'JAWA TIMUR\r'),
('36', 'BANTEN\r'),
('51', 'BALI\r'),
('52', 'NUSA TENGGARA BARAT\r'),
('53', 'NUSA TENGGARA TIMUR\r'),
('61', 'KALIMANTAN BARAT\r'),
('62', 'KALIMANTAN TENGAH\r'),
('63', 'KALIMANTAN SELATAN\r'),
('64', 'KALIMANTAN TIMUR\r'),
('65', 'KALIMANTAN UTARA\r'),
('71', 'SULAWESI UTARA\r'),
('72', 'SULAWESI TENGAH\r'),
('73', 'SULAWESI SELATAN\r'),
('74', 'SULAWESI TENGGARA\r'),
('75', 'GORONTALO\r'),
('76', 'SULAWESI BARAT\r'),
('81', 'MALUKU\r'),
('82', 'MALUKU UTARA\r'),
('91', 'PAPUA BARAT\r'),
('94', 'PAPUA\r');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
