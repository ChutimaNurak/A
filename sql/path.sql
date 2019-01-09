-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2019 at 05:01 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `path`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(10) NOT NULL COMMENT 'รหัสลูกค้า',
  `Name` varchar(50) NOT NULL COMMENT 'ชื่อ-นามสกุล',
  `Telephone` varchar(11) NOT NULL COMMENT 'เบอร์โทร',
  `Email` varchar(50) NOT NULL COMMENT 'อีเมล์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `Name`, `Telephone`, `Email`) VALUES
(1, 'บุญสิตา ธรรมคณา', '093-8453458', 'num@gmail.com'),
(2, 'นรวิชญ์ จันแก้ว', '098-4352356', 'na@gmail.com'),
(3, 'นัทธมน ใหม่นุ้ย', '084-4458493', 'nat@gmail.com'),
(4, 'จุฑามศ ทับเมือง', '092-3238979', 'an@gmail.com'),
(5, 'ชุติมา นุรักษ์', '099-5239602', 'nan@gmail.com'),
(6, 'ศุภลักษณ์ มุกสิ', '098-7898757', 'ooam@gmail.com'),
(7, 'ศุกลปัก ดวงอาจ', '096-3847938', 'par@gmail.com'),
(8, 'จารุวรรณ สาระบุตร', '098-2678769', 'nin@gmail.com'),
(9, 'ศุภลักษณ์ ภูอุทา', '098-3748920', 'Jun@gmail.com'),
(10, 'ศิริรัต เชื่อวงศ์', '087-9876567', 'mook@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `ID_Job` int(10) NOT NULL COMMENT 'รหัสรอบงาน',
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วัน/เดือน/ปี และเวลา',
  `Distance_Sum` int(10) NOT NULL DEFAULT '0' COMMENT 'ระยะทางรวม (กิโล)',
  `Time_Sum` int(10) NOT NULL DEFAULT '0' COMMENT 'ระยะเวลารวม (ชั่วโมง)',
  `Name_Job` varchar(50) NOT NULL COMMENT 'ชื่อรอบงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`ID_Job`, `Date`, `Distance_Sum`, `Time_Sum`, `Name_Job`) VALUES
(25, '2019-01-04 20:47:03', 85, 102, 'ปทุมธานี-สมุทรปราการ-กรุงเทพ'),
(26, '2019-01-06 19:40:48', 0, 0, 'นวนคร-ปะตูน้ำพระอิน-วังน้อย');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `ID_Position` int(10) NOT NULL COMMENT 'รหัสตำแหน่ง',
  `ID` int(10) NOT NULL COMMENT 'รหัสลูกค้า',
  `House_number` varchar(5) NOT NULL COMMENT 'บ้านเลขที่',
  `Village` varchar(5) NOT NULL COMMENT 'หมู่บ้าน',
  `Subdistrict` varchar(30) NOT NULL COMMENT 'ตำบล',
  `City` varchar(30) NOT NULL COMMENT 'อำเภอ',
  `Province` varchar(30) NOT NULL COMMENT 'จังหวัด',
  `Zip_code` varchar(5) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `Latitude` double NOT NULL COMMENT 'ละติจูด(X)',
  `Longitude` double NOT NULL COMMENT 'ลองจิจูด(Y)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`ID_Position`, `ID`, `House_number`, `Village`, `Subdistrict`, `City`, `Province`, `Zip_code`, `Latitude`, `Longitude`) VALUES
(1, 3, '533', '8', 'สนับทึบ', 'วังน้อย', 'พระนครศรีอยุธยา', '13170', 14.2904443, 100.81858280000006),
(3, 8, '532', '1', 'หนองปรือ', 'บางพลี', 'สมุทรปราการ', '10540', 13.6899991, 100.75011240000003),
(5, 9, '35', '5', 'บึงยี่โถ', 'ธัญบุรี', 'ปทุมธานี', '1213', 14.0079175, 100.70852809999997),
(6, 10, '116', '20', 'คลองห้า', 'คลองหลวง', 'ปทุมธานี', '12120', 14.0452275, 100.71046799999999),
(8, 7, '1/40', '15', 'คลองหก', 'คลองหลวง', 'ปทุมธานี', '12110', 13.9741241, 100.72861119999993),
(9, 5, '56', '13', 'ตลาดยอด', 'พระนคร', 'กรุงเทพมหานคร', '10200', 13.7596276, 100.49797639999997),
(10, 2, '333', '15', 'ลำไทร', 'วังน้อย', 'พระนครศรีอยุธยา', '13170', 14.2326314, 100.71964980000007),
(13, 4, '532', '5', 'สามวาตะวันตก', 'คลองสามวา', 'กรุงเทพมหานคร', '10510', 13.8654912, 100.70341009999993),
(15, 1, '3', '2', 'ตลาดยอด', 'พระนคร', 'กรุงเทพมหานคร', '10200', 13.7596276, 100.49797639999997),
(19, 6, '35', '4', 'สำราญราษฎร์', 'พระนคร', 'กรุงเทพมหานคร', '10200', 13.752492, 100.50404500000002);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `ID_Route` int(10) NOT NULL COMMENT 'รหัสเส้นทาง',
  `ID_Position` int(10) NOT NULL COMMENT 'รหัสตำแหน่ง',
  `Sequence` int(10) NOT NULL DEFAULT '0' COMMENT 'ลำดับที่',
  `District` int(11) NOT NULL DEFAULT '0' COMMENT 'ระยะทาง (กิโล)',
  `ID_Job` int(10) NOT NULL COMMENT 'รหัสรอบงาน',
  `Time` int(11) NOT NULL DEFAULT '0' COMMENT 'ระยะเวลา (นาที)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`ID_Route`, `ID_Position`, `Sequence`, `District`, `ID_Job`, `Time`) VALUES
(324, 3, 3, 36, 25, 43),
(325, 15, 4, 28, 25, 34),
(326, 6, 1, 17, 25, 21),
(327, 5, 2, 4, 25, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`ID_Job`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`ID_Position`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`ID_Route`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสลูกค้า', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `ID_Job` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรอบงาน', AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `ID_Position` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสตำแหน่ง', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `ID_Route` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเส้นทาง', AUTO_INCREMENT=328;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
