-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2024 at 05:29 PM
-- Server version: 10.11.9-MariaDB-log
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezypaycc_assetsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL,
  `activity_date` date NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `user_level` int(11) NOT NULL,
  `action` varchar(55) NOT NULL,
  `item` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `activity_date`, `user_id`, `user_level`, `action`, `item`) VALUES
(5, '2024-09-15', 'admin', 1, 'Add', 'ICT Equipment, Computer, Dell'),
(6, '2024-09-15', 'admin', 1, 'Register', 'ICT Equipment, Computer, Dell'),
(7, '2024-09-15', 'admin', 1, 'Receive', 'ICT Equipment, Computer, Dell'),
(8, '2024-09-15', 'admin', 1, 'Inspection', 'Categories, Sub-categories, Serial# (test)'),
(9, '2024-09-15', 'admin', 1, 'Disposal', 'ICT Equipment, Computer, Dell'),
(109, '2024-10-15', 'admin', 1, 'Add Asset', 'ICT Equipment, Computer, Dell'),
(110, '2024-10-15', 'admin', 1, 'Inspection', 'ICT Equipment, Computer, Serial# (STDCin5GLFI)'),
(111, '2024-10-15', 'admin', 1, 'Disposal', 'ICT Equipment, Computer, Dell'),
(112, '2024-10-15', 'admin', 1, 'Disposal', 'ICT Equipment, Computer, Dell'),
(113, '2024-10-15', 'admin', 1, 'Disposal', 'ICT Equipment, Computer, Dell'),
(115, '2024-10-16', 'admin', 1, 'Inspection', 'ICT Equipment, Computer, Serial# (STDCin7VBQB)'),
(116, '2024-10-16', 'admin', 1, 'Disposal', 'ICT Equipment, Computer, Dell'),
(117, '2024-10-16', 'admin', 1, 'Add Asset', 'ICT Equipment, Computer, Dell'),
(118, '2024-10-16', 'admin', 1, 'Add Asset', 'a, a, a'),
(119, '2024-10-17', 'admin', 1, 'Add Asset', 'ICT Equipment, Computer, HP'),
(120, '2024-10-17', 'admin', 1, 'Add Asset', 'Automotive, Car, BMW'),
(121, '2024-10-17', 'admin', 1, 'Add Asset', 'Air Conditioning, Compressor, Daikin'),
(122, '2024-10-17', 'admin', 1, 'Receive', 'Automotive , Car, Perodua Bezza'),
(123, '2024-10-17', 'admin', 1, 'Add Asset', 'Culinary Utensils, Stand Mixer, KHIND'),
(124, '2024-10-17', 'admin', 1, 'Add Asset', 'Sewing, Sewing machines, SINGER'),
(125, '2024-10-17', 'admin', 1, 'Add Asset', 'Automotive , Sedan, Peroduo Myvi'),
(126, '2024-10-17', 'admin', 1, 'Add Asset', 'Automotive , Engine, Daihatsu'),
(127, '2024-10-17', 'admin', 1, 'Add Asset', 'Automotive 	, Car Maintenance Equipment, Innovator'),
(128, '2024-10-17', 'admin', 1, 'Add Asset', 'Automotive , Oil Filter, Perodua'),
(129, '2024-10-17', 'admin', 1, 'Add Asset', 'Automotive , Oil, Perodua'),
(130, '2024-10-17', 'admin', 1, 'Add Asset', 'Motorcycle, Sprocket, Yamaha'),
(131, '2024-10-17', 'admin', 1, 'Add Asset', 'Motorcycle, Sprocket, Yamaha'),
(132, '2024-10-18', 'admin', 1, 'Add Asset', 'Motorcycle, Motorcycle, Yamaha'),
(133, '2024-10-18', 'admin', 1, 'Add Asset', 'ICT, Computer part, Western Digital (WD)'),
(134, '2024-10-18', 'admin', 1, 'Add Asset', 'Motorcycle, Motorcycle, Modenas'),
(135, '2024-10-18', 'admin', 1, 'Add Asset', 'ICT, Computer part, Toshiba'),
(136, '2024-10-18', 'admin', 1, 'Add Asset', 'General Asset, furniture, -'),
(137, '2024-10-18', 'admin', 1, 'Add Asset', 'General Asset, Furniture, -'),
(138, '2024-10-18', 'admin', 1, 'Add Asset', 'Electrical Engineering, Tools, Fluke'),
(139, '2024-10-18', 'admin', 1, 'Add Asset', 'ICT, Peripheral, Dell'),
(140, '2024-10-18', 'admin', 1, 'Add Asset', 'ICT, Peripheral, Dell'),
(141, '2024-10-18', 'admin', 1, 'Receive', 'Automotive , Engine, Daihatsu'),
(142, '2024-10-18', 'admin', 1, 'Registration', 'Automotive , Engine, Daihatsu'),
(143, '2024-10-18', 'admin', 1, 'Inspection', 'Automotive , Engine, Serial# (STDCin9DRN2)'),
(144, '2024-10-18', 'admin', 1, 'Inspection', 'Automotive , Engine, Serial# (STDCin9DRN2)'),
(145, '2024-10-18', 'admin', 1, 'Registration', 'Automotive , Car, Perodua Bezza'),
(146, '2024-10-18', 'admin', 1, 'Registration', 'General Asset, Furniture, -'),
(147, '2024-10-18', 'admin', 1, 'Inspection', 'Automotive , Car, Serial# (STDCin2GVDL)'),
(148, '2024-10-18', 'admin', 1, 'Add Asset', 'ICT, Peripheral, Benq'),
(149, '2024-10-18', 'admin', 1, 'Receive', 'ICT, Peripheral, Benq'),
(150, '2024-10-18', 'admin', 1, 'Registration', 'ICT, Peripheral, Benq'),
(151, '2024-10-18', 'admin', 1, 'Inspection', 'ICT, Peripheral, Serial# (STDCin9GRYA)'),
(152, '2024-10-18', 'admin', 1, 'Add Asset', 'ICT, Computer, Asus'),
(153, '2024-10-18', 'admin', 1, 'Receive', 'ICT, Computer, Asus'),
(154, '2024-10-18', 'admin', 1, 'Registration', 'ICT, Computer, Asus'),
(155, '2024-10-18', 'admin', 1, 'Inspection', 'ICT, Computer, Serial# (STDCin7W02K)'),
(156, '2024-10-18', 'admin', 1, 'Disposal', 'Automotive , Car, Perodua Bezza'),
(157, '2024-10-23', 'admin', 1, 'Registration', 'ICT, Computer part, Toshiba'),
(158, '2024-10-23', 'admin', 1, 'Disposal', 'ICT, Computer part, Toshiba'),
(159, '2024-10-23', 'admin', 1, 'Add Asset', 'a, a, a'),
(160, '2024-10-23', 'admin', 1, 'Add Asset', 'ICT, COM Part, Dell'),
(161, '2024-10-23', 'admin', 1, 'Receive', 'ICT, COM Part, Dell');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(55) NOT NULL,
  `name` varchar(30) NOT NULL,
  `position` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `gender_id` char(11) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `name`, `position`, `email`, `phone`, `gender_id`, `photo`) VALUES
('admin', 'Zarihan Binti Yaakub', 'HOD Asset', 'zarihan@stdc.edu.my', '0199099909', 'F', 'Screenshot 2024-10-18 012546.png');

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `asset_id` varchar(55) NOT NULL,
  `category` varchar(55) NOT NULL,
  `sub_category` varchar(55) NOT NULL,
  `type` varchar(55) NOT NULL,
  `brand` varchar(55) NOT NULL,
  `quantity` int(11) NOT NULL,
  `picture` text NOT NULL,
  `qrcode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`asset_id`, `category`, `sub_category`, `type`, `brand`, `quantity`, `picture`, `qrcode`) VALUES
('STDCin2GVDL', 'Automotive ', 'Car', 'Sedan', 'Perodua Bezza', 1, 'download__1_-removebg-preview.png', '0246c8f68407272648992e1e9fce88b0.png'),
('STDCin7W02K', 'ICT', 'Computer', 'Laptop', 'Asus', 1, 'ASUS_RoG_GL552JX-removebg-preview.png', 'a0d0f2b3dbb4b36257b356cde57c1eb3.png'),
('STDCin9DRN2', 'Automotive ', 'Engine', 'Single Engine', 'Daihatsu', 1, 'Engine.png', '3fd3bb12c7c4f16564d30f4eab56be1c.png'),
('STDCin9GRYA', 'ICT', 'Peripheral', 'Monitor', 'Benq', 1, '73ad41c5417394d3250bbc0fd928-removebg-preview.png', 'c047a664b83432568a73a51bb18197c3.png'),
('STDCin9Z5FY', 'Sewing', 'Sewing machines', 'Sewing Equipment', 'SINGER', 4, 'Sewing_Machine.png', 'a069f29eaffa2cfd729cf4e1780cf6de.png'),
('STDCinDLI4Q', 'ICT', 'COM Part', 'Harddisk 2TB', 'Dell', 100, 'man.png', '36958a88dc80d047f046e566264ce6e8.png'),
('STDCinEUMG8', 'Motorcycle', 'Motorcycle', 'Lagenda  115z', 'Yamaha', 1, 'Lagenda-115Z.png', '4a8188dfa793e1d635cf565407f125d3.png'),
('STDCinFEAIL', 'ICT', 'Computer part', 'Harddisk 2TB', 'Toshiba', 20, 'Toshiba_HD.png', 'e5f8030c17463f641179eb5448018c11.png'),
('STDCinFHO78', 'Automotive 	', 'Car Maintenance Equipment', 'Car Jack', 'Innovator', 4, 'car_jack.png', '58f00ea5a165b43c602559e63f18b9e4.png'),
('STDCinFID6U', 'Air Conditioning', 'Compressor', 'Inverter', 'Daikin', 1, 'th (1).jpg', 'f28e49f2d1c471c0ad5ef5daa88cc589.png'),
('STDCinG0VYH', 'ICT', 'Peripheral', 'Keyboard', 'Dell', 25, 'keyboard.png', 'dc0107a67dc879cde84454c7f2000069.png'),
('STDCinG49C7', 'Motorcycle', 'Sprocket', 'countershaft sprocket', 'Yamaha', 4, 'Sprocket1.png', '7c0708cc15e4b96f16d5761fb4f43634.png'),
('STDCinG5QII', 'General Asset', 'Furniture', 'Office Chair', '-', 8, 'Office_Chair-removebg-preview.png', '560cdb7e782551f3e861f4b326d1890d.png'),
('STDCinGMRQA', 'Culinary', 'Cooking Equipment', 'Stand Mixer', 'KHIND', 5, 'stand mixer.jpg', '700a50fa9c33293b7541e868d342fa0a.png'),
('STDCinGSCBB', 'ICT', 'Peripheral', 'Mouse ', 'Dell', 25, 'Mouse.png', '2e89465249f97ec926cbc41ab5b40026.png'),
('STDCinH7IL2', 'Motorcycle', 'Sprocket', 'Duplex Sprocket', 'Yamaha', 4, 'Sprocket.png', 'b1746375dd82ae7d1e50160958894cf5.png'),
('STDCinHX99C', 'General Asset', 'Furniture', 'Table', '-', 8, 'Table.jpg', 'f2508f53b998af0215593a1636e79e67.png'),
('STDCinJMT0D', 'ICT', 'Computer part', 'Harddisk 500GB', 'Western Digital (WD)', 20, 'Harddisk_WD.png', '5b530e921de9e97f58966a81d9374a18.png'),
('STDCinL7ZWB', 'ICT', 'Computer', 'Laptop', 'HP', 1, 'f0d47ae7ca5532defab18a40b3ff39fa.jpg', '1e3dcf9ade733bcfa70985da0cde1b99.png'),
('STDCinO0TMA', 'Electrical Engineering', 'Tools', 'Voltage Tester', 'Fluke', 100, 'voltage_tester.png', 'e02c13e9e4f2c58fc236b18e05c5bfeb.png'),
('STDCinOH3PM', 'Automotive ', 'Oil', 'Engine Oil', 'Perodua', 6, 'Engine_Oil.png', '6a357969e82b7330f75f9c81b5299737.png'),
('STDCinP284E', 'Motorcycle', 'Motorcycle', 'NINJA ZX-25R SE', 'Modenas', 1, 'Modenas.png', '0d8b949c80f5a2af8ae95577f7bb616b.png'),
('STDCinQDJ8Z', 'Automotive ', 'Oil Filter', 'Service Part', 'Perodua', 4, 'Perodua-Genuine-White.png', '448657456f6a82709c1d237ddc011a1e.png'),
('STDCinRM74U', 'Automotive ', 'Car', 'Sedan', 'Peroduo Myvi', 1, 'myvi.png', '6a9cec9a7ac039b395a9f4da48f712af.png');

-- --------------------------------------------------------

--
-- Table structure for table `disposal`
--

CREATE TABLE `disposal` (
  `disposal_id` int(11) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `type` varchar(55) NOT NULL,
  `serial_no` varchar(55) NOT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `component` varchar(100) NOT NULL,
  `barcode_no` varchar(55) NOT NULL,
  `ori_acq_price` decimal(11,2) NOT NULL,
  `brand_model` varchar(55) NOT NULL,
  `gov_order_no` varchar(55) NOT NULL,
  `file_ref_no` varchar(55) NOT NULL,
  `purchase_date` date NOT NULL,
  `retrieval_date` date NOT NULL,
  `made_by` varchar(55) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(55) NOT NULL,
  `type_engine_no` varchar(55) NOT NULL,
  `cost_per_unit` decimal(11,2) NOT NULL,
  `warranty_year` int(11) NOT NULL,
  `chasis_series` varchar(55) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `spec_notes` text NOT NULL,
  `supplier_address` text NOT NULL,
  `hod_date` date NOT NULL,
  `placement_date` date NOT NULL,
  `hod_name` varchar(100) NOT NULL,
  `placement_code` varchar(55) NOT NULL,
  `hod_position` varchar(55) NOT NULL,
  `placement_location` varchar(100) NOT NULL,
  `placement_name` varchar(100) NOT NULL,
  `placement_position` varchar(100) NOT NULL,
  `disposal_date` date NOT NULL,
  `method` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `asset_id` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `disposal`
--

INSERT INTO `disposal` (`disposal_id`, `organization`, `category`, `sector`, `subcategory`, `type`, `serial_no`, `warranty`, `component`, `barcode_no`, `ori_acq_price`, `brand_model`, `gov_order_no`, `file_ref_no`, `purchase_date`, `retrieval_date`, `made_by`, `qty`, `unit`, `type_engine_no`, `cost_per_unit`, `warranty_year`, `chasis_series`, `supplier`, `spec_notes`, `supplier_address`, `hod_date`, `placement_date`, `hod_name`, `placement_code`, `hod_position`, `placement_location`, `placement_name`, `placement_position`, `disposal_date`, `method`, `signature`, `asset_id`) VALUES
(19, 'Selangor Technical Skills Development Centre', 'Automotive ', 'Automotive', 'Car', 'Sedan', 'JM1NB3538Y0153757', '5 Years', '-', '-', 45000.00, 'Perodua Bezza', '20241030', 'ST-002', '2024-09-18', '2024-10-19', 'Perodua', 3, '1', '4 cylinder Petrol engine  - 10227', 45000.00, 5, 'JH4DC4350SS000058', 'PERODUA SUASA SURIA SDN BHD', 'Flagship/Fullspec', '24 Jln PBS 14/11, Taman Perindustrian Bukit Serdang, 43300, Seri Kembangan, Selangor', '2024-10-10', '2024-10-10', 'Faizal', '100', 'Internal Verification Officer', 'Automotive Sector', 'FARIS HAQ ', 'TEST', '2024-10-23', '2222test ', 'VICTORIA A/P ROBAT ', 'STDCin2GVDL'),
(20, 'Selangor Technical Skills Development Centre', 'Automotive ', 'Automotive', 'Car', 'Sedan', 'JM1NB3538Y0153757', '5 Years', '-', '-', 45000.00, 'Perodua Bezza', '20241030', 'ST-002', '2024-09-18', '2024-10-19', 'Perodua', 2, '1', '4 cylinder Petrol engine  - 10227', 45000.00, 5, 'JH4DC4350SS000058', 'PERODUA SUASA SURIA SDN BHD', 'Flagship/Fullspec', '24 Jln PBS 14/11, Taman Perindustrian Bukit Serdang, 43300, Seri Kembangan, Selangor', '2024-10-10', '2024-10-10', 'Faizal', '100', 'Internal Verification Officer', 'Automotive Sector', 'FARIS HAQ ', 'hod', '2024-10-24', 'a', 'MOHD FARIQ IZMEER BIN MAT SHARIE', 'STDCin2GVDL');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` char(11) NOT NULL,
  `gender` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender`) VALUES
('F', 'Female'),
('M', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `ref_no` varchar(55) NOT NULL,
  `inspection_date_officer` date NOT NULL,
  `inspection_title` varchar(100) NOT NULL,
  `inspection_officer` varchar(100) NOT NULL,
  `serial_no` varchar(55) NOT NULL,
  `asset_category` varchar(55) NOT NULL,
  `asset_sub_category` varchar(55) NOT NULL,
  `inspection_date_asset` date NOT NULL,
  `location` varchar(100) NOT NULL,
  `local_officer` varchar(100) NOT NULL,
  `complete` char(11) NOT NULL,
  `correction` char(11) NOT NULL,
  `inspection_status` varchar(55) NOT NULL,
  `inspection_notes` text NOT NULL,
  `registration_id` varchar(50) DEFAULT NULL,
  `asset_id` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inspection`
--

INSERT INTO `inspection` (`ref_no`, `inspection_date_officer`, `inspection_title`, `inspection_officer`, `serial_no`, `asset_category`, `asset_sub_category`, `inspection_date_asset`, `location`, `local_officer`, `complete`, `correction`, `inspection_status`, `inspection_notes`, `registration_id`, `asset_id`) VALUES
('ST-001', '2025-01-23', 'Vehicle Inspection', 'MOHD. FAIZ', 'STDCin2GVDL', 'Automotive ', 'Car', '2025-01-23', 'Automotive Sector', 'FARIS HAQ ', 'Yes', 'No', 'In use', 'All Conditions good', 'STDCin5FKHJ', 'STDCin2GVDL'),
('ST-002', '2025-01-18', 'Vehicle Part Inspection', 'MOHD. FAIZ', 'STDCin9DRN2', 'Automotive ', 'Engine', '2025-01-18', 'Automotive Sector', 'FARIS HAQ ', 'Yes', 'No', 'In use', 'All conditions good', 'STDCinIYINE', 'STDCin9DRN2'),
('ST-003', '2025-01-24', 'Computer Part Inspection', 'SITI AISYAH BINTI HASSAN', 'STDCin9GRYA', 'ICT', 'Peripheral', '2025-01-24', 'Information Technology Sector', 'SABRRY BIN LASUPIN', 'Yes', 'No', 'In use', '-', 'STDCinLD45W', 'STDCin9GRYA'),
('ST-004', '2025-02-18', 'Computer Laptop Inspection', 'SITI AISYAH BINTI HASSAN', 'STDCin7W02K', 'ICT', 'Computer', '2025-02-18', 'Information Technology Sector', 'SABRRY BIN LASUPIN', 'Yes', 'No', 'In use', 'Everything is running according to standards.', 'STDCin6DMC7', 'STDCin7W02K');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `UserID` varchar(50) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `UserLvl` int(11) NOT NULL DEFAULT 4,
  `Status` varchar(55) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserID`, `Password`, `UserLvl`, `Status`) VALUES
('Abi', 'Abi', 2, 'Active'),
('adam', 'adam', 2, 'Active'),
('admin', 'admin', 1, 'Active'),
('admin2', 'admin2', 2, 'Active'),
('Azmi', 'Azmi', 2, 'Active'),
('Bab', 'Bab', 2, 'Active'),
('Faiz', 'Faiz', 2, 'Active'),
('Fariq', 'Fariq', 2, 'Active'),
('Faris', 'Faris', 2, 'Active'),
('Fatimah', 'Fatimah', 2, 'Active'),
('Hafiz', 'Hafiz', 2, 'Active'),
('Moona ', 'Moona ', 2, 'Active'),
('nabilah', 'nabilah', 4, 'Active'),
('Nurulhuda', 'Nurulhuda', 2, 'Active'),
('Nurulsyafika', 'Nurulsyafika', 2, 'Active'),
('SABRRY', 'SABRRY', 2, 'Active'),
('Sobrina', 'Sobrina', 2, 'Active'),
('Syamimi', 'Syamimi', 2, 'Active'),
('Syazwani', 'Syazwani', 2, 'Active'),
('victoria', 'victoria', 2, 'Active'),
('Waheeda', 'Waheeda', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `receive_id` int(11) NOT NULL,
  `ordered_by` varchar(55) NOT NULL,
  `no_LO` varchar(55) NOT NULL,
  `LO_date` date NOT NULL,
  `acceptance_type` varchar(55) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `no_DO` varchar(55) NOT NULL,
  `DO_date` date NOT NULL,
  `received_date` date NOT NULL,
  `transportation` varchar(55) NOT NULL,
  `receive_officer_name` varchar(100) NOT NULL,
  `receive_officer_position` varchar(55) NOT NULL,
  `receive_officer_department` varchar(100) NOT NULL,
  `receive_officer_date` date NOT NULL,
  `technical_officer_name` varchar(100) NOT NULL,
  `technical_officer_position` varchar(55) NOT NULL,
  `technical_officer_department` varchar(55) NOT NULL,
  `technical_officer_date` date NOT NULL,
  `section` varchar(55) NOT NULL,
  `procurement` varchar(55) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `category` varchar(55) NOT NULL,
  `subcategory` varchar(55) NOT NULL,
  `type` varchar(55) NOT NULL,
  `brand_model` varchar(55) NOT NULL,
  `qty_requested` int(11) NOT NULL,
  `qty_sent` int(11) NOT NULL,
  `qty_receive` int(11) NOT NULL,
  `unit_price` decimal(11,2) NOT NULL,
  `total_price` decimal(11,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `notes` text NOT NULL,
  `asset_id` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `receive`
--

INSERT INTO `receive` (`receive_id`, `ordered_by`, `no_LO`, `LO_date`, `acceptance_type`, `supplier`, `address`, `no_DO`, `DO_date`, `received_date`, `transportation`, `receive_officer_name`, `receive_officer_position`, `receive_officer_department`, `receive_officer_date`, `technical_officer_name`, `technical_officer_position`, `technical_officer_department`, `technical_officer_date`, `section`, `procurement`, `phone`, `category`, `subcategory`, `type`, `brand_model`, `qty_requested`, `qty_sent`, `qty_receive`, `unit_price`, `total_price`, `expiry_date`, `notes`, `asset_id`) VALUES
(2, 'Mr. Salehudin', '20243333', '2024-09-15', 'Good', 'Sky Tech Sdn. Bhd', 'No. 7 Jalan Setia Alam, 40000, Shah Alam Selangor.', '20247777', '2024-09-15', '2024-09-15', 'Lorry', 'Miss Victoria', 'Ceo', 'IT', '2024-09-15', 'M. Adam', 'Technician', 'IT', '2024-09-15', 'Section A New', 'Sample Procurement', '0133033303', 'ICT Equipment', 'Computer', 'Desktop', 'Dell', 5, 20, 20, 2000.00, 40000.00, '2025-09-15', 'All item in good condition as pe requested.', 'STDCinF6NB3'),
(5, 'Faizal', '20241111', '2024-09-18', 'Good', 'PERODUA SUASA SURIA SDN BHD', '24 Jln PBS 14/11, Taman Perindustrian Bukit Serdang, 43300, Seri Kembangan, Selangor', 'STDC-001', '2024-09-19', '2024-10-09', 'Lorry', 'FARIS HAQ ', 'Instructor', 'Automotive', '2024-10-10', 'MOHD. FAIZ', 'Technician', 'Automotive', '2024-10-10', 'Automotive', 'Full Bodykit', '0133033303', 'Automotive ', 'Car', 'Sedan', 'Perodua Bezza', 1, 1, 1, 45000.00, 45000.00, '2029-12-17', '- Kampus STDC Kuala Sleangor', 'STDCin2GVDL'),
(6, 'Faizal', '20241000', '2024-09-23', 'Good', 'Shinjuku Auto Parts Sdn Bhd', 'Lot 49673, Jalan Sungai Putus, Kg Batu Belah, 42100 Klang, Selangor, Malaysia. 42100 Selangor Selangor', 'STDC-002', '2024-09-24', '2024-10-24', 'Lorry', 'FARIS HAQ ', 'Instructor', 'Automotive', '2024-10-25', 'MOHD. FAIZ', 'Technician', 'Automotive', '2024-10-25', 'Automotive', 'Daihatsu Engine', '0133033303', 'Automotive ', 'Engine', 'Single Engine', 'Daihatsu', 1, 1, 1, 900.00, 900.00, '2024-12-18', '- Kampus STDC Kuala Sleangor', 'STDCin9DRN2'),
(7, 'SITI SOBRINA BINTI ABDUL RAHIM', '20241645', '2024-09-12', 'Good', 'Bits And Bytes Technology', '150A, Jalan Layang 16, Taman Perling, 81200 Johor Bahru, Johor', 'STDC-003', '2024-10-26', '2024-11-07', 'Lorry', 'SABRRY BIN LASUPIN', 'IT Instructor', 'Information Technology', '2024-11-08', 'SITI AISYAH BINTI HASSAN', 'IT Instructor', 'Information Technology', '2024-11-08', 'Information Technology', 'Benq Monitor', '0198802376', 'ICT', 'Peripheral', 'Monitor', 'Benq', 1, 1, 1, 760.00, 760.00, '2026-11-18', '- Kampus STDC Kuala Sleangor', 'STDCin9GRYA'),
(8, 'SITI SOBRINA BINTI ABDUL RAHIM', '20241655', '2024-09-22', 'Good', 'Bits And Bytes Technology', '150A, Jalan Layang 16, Taman Perling, 81200 Johor Bahru, Johor', 'STDC-004', '2024-10-02', '2024-10-15', 'Lorry', 'SABRRY BIN LASUPIN', 'IT Instructor', 'Information Technology', '2024-10-16', 'SITI AISYAH BINTI HASSAN', 'IT Instructor', 'Information Technology', '2024-10-16', 'Information Technology', 'Asus Laptop', '0198802376', 'ICT', 'Computer', 'Laptop', 'Asus', 1, 1, 1, 3500.00, 3500.00, '2027-10-21', 'Receive in good condition.', 'STDCin7W02K'),
(9, 'asd', 'asd', '2024-10-17', 'asd', '-', 'asd', 'asd', '2024-10-24', '2024-10-25', 'asd', 'asd', 'asd', 'asd', '2024-11-01', 'asdsad', 'asdsa', 'asdsad', '2024-10-31', 'asd', 'asd', '0146897425', 'ICT', 'COM Part', 'Harddisk 2TB', 'Dell', 100, 100, 100, 120.00, 12000.00, '2024-10-24', 'sadasd', 'STDCinDLI4Q');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `registration_id` varchar(50) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `type` varchar(55) NOT NULL,
  `serial_no` varchar(55) NOT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `component` varchar(100) NOT NULL,
  `barcode_no` varchar(55) NOT NULL,
  `ori_acq_price` decimal(11,2) NOT NULL,
  `brand_model` varchar(55) NOT NULL,
  `gov_order_no` varchar(55) NOT NULL,
  `file_ref_no` varchar(55) NOT NULL,
  `purchase_date` date NOT NULL,
  `retrieval_date` date NOT NULL,
  `made_by` varchar(55) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit` varchar(55) NOT NULL,
  `type_engine_no` varchar(55) NOT NULL,
  `cost_per_unit` decimal(11,2) NOT NULL,
  `warranty_year` int(11) NOT NULL,
  `chasis_series` varchar(55) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `spec_notes` text NOT NULL,
  `supplier_address` text NOT NULL,
  `hod_date` date NOT NULL,
  `placement_date` date NOT NULL,
  `hod_name` varchar(100) NOT NULL,
  `placement_code` varchar(55) NOT NULL,
  `hod_position` varchar(55) NOT NULL,
  `placement_location` varchar(100) NOT NULL,
  `placement_name` varchar(100) NOT NULL,
  `placement_position` varchar(100) NOT NULL,
  `asset_id` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`registration_id`, `organization`, `category`, `sector`, `subcategory`, `type`, `serial_no`, `warranty`, `component`, `barcode_no`, `ori_acq_price`, `brand_model`, `gov_order_no`, `file_ref_no`, `purchase_date`, `retrieval_date`, `made_by`, `qty`, `unit`, `type_engine_no`, `cost_per_unit`, `warranty_year`, `chasis_series`, `supplier`, `spec_notes`, `supplier_address`, `hod_date`, `placement_date`, `hod_name`, `placement_code`, `hod_position`, `placement_location`, `placement_name`, `placement_position`, `asset_id`) VALUES
('STDCin2HNNH', 'STDC', 'General Asset', 'STDC Office', 'Furniture', 'Office Chair', '12345', 'CHR-WTY-2024-XYZ123', 'Not applicable', '123456789012', 150.00, '-', 'PO-2024-001234', 'l12355', '2024-10-01', '2024-10-08', '-', 1, 'Unit', '-', 150.00, 2, '-', 'AGP Chair P.J', '4 others are spares', ' 20c, Jalan Penchala, Section 51, 46050 Petaling Jaya, Selangor', '2024-10-08', '2024-10-09', 'Zarihan Binti Yaakub', '000001', 'HOD Asset', 'STDC Office', 'NORIDAH BINTI ISMAIL', 'HR', 'STDCinG5QII'),
('STDCin5FKHJ', 'Selangor Technical Skills Development Centre', 'Automotive ', 'Automotive', 'Car', 'Sedan', 'JM1NB3538Y0153757', '5 Years', '-', '-', 45000.00, 'Perodua Bezza', '20241030', 'ST-002', '2024-09-18', '2024-10-19', 'Perodua', 5, '1', '4 cylinder Petrol engine  - 10227', 45000.00, 5, 'JH4DC4350SS000058', 'PERODUA SUASA SURIA SDN BHD', 'Flagship/Fullspec', '24 Jln PBS 14/11, Taman Perindustrian Bukit Serdang, 43300, Seri Kembangan, Selangor', '2024-10-10', '2024-10-10', 'Faizal', '100', 'Internal Verification Officer', 'Automotive Sector', 'FARIS HAQ ', 'Automotive Instructor', 'STDCin2GVDL'),
('STDCin6DMC7', 'Selangor Technical Skills Development Centre', 'ICT', 'Information Technology', 'Computer', 'Laptop', 'Bw7GrtQj', 'LP-WTY-2024-YZ345', 'Power Adapter Cable Included', 'A-0040-Z', 3500.00, 'Asus', '20241655', 'ST-004', '2024-09-22', '2024-10-15', 'Asus', 1, '1', '-', 3500.00, 3, '-', 'Bits And Bytes Technology', 'Workstation Laptop-', '150A, Jalan Layang 16, Taman Perling, 81200 Johor Bahru, Johor', '2024-10-16', '2024-10-16', 'SITI SOBRINA BINTI ABDUL RAHIM', '150', 'Internal Verification Officer', 'Information Technology Sector', 'SABRRY BIN LASUPIN', 'IT Instructor', 'STDCin7W02K'),
('STDCinIYINE', 'Selangor Technical Skills Development Centre', 'Automotive ', 'Automotive', 'Engine', 'Single Engine', 'TP0035', '3 Months', 'Engine Coolant, Oil Pan', '705632', 900.00, 'Daihatsu', '20241000', 'ST-002', '2024-09-23', '2024-10-24', 'Daihatsu', 1, '1', 'DOHC - 10338', 900.00, 3, '-', 'Shinjuku Auto Parts Sdn Bhd', '4 Clylindar Inline', 'Lot 49673, Jalan Sungai Putus, Kg Batu Belah, 42100 Klang, Selangor, Malaysia. 42100 Selangor Selangor', '2024-10-24', '2024-10-24', 'Faizal', '100', 'Internal Verification Officer', 'Automotive Sector', 'FARIS HAQ ', 'Automotive Instructor', 'STDCin9DRN2'),
('STDCinLD45W', 'Selangor Technical Skills Development Centre', 'ICT', 'Information Technology', 'Peripheral', 'Monitor', 'w9VZKGhh', 'BNQ-WTY-2024-YZ279', 'HDMI Cable', '0101234567890128TEC-IT', 760.00, 'Benq', '20241645', 'ST-003', '2024-09-12', '2024-11-07', 'Benq ', 1, '1', '-', 760.00, 2, '-', 'Bits And Bytes Technology', '-', '150A, Jalan Layang 16, Taman Perling, 81200 Johor Bahru, Johor', '2024-11-08', '2024-11-08', 'SITI SOBRINA BINTI ABDUL RAHIM', '150', 'Internal Verification Officer', 'Information Technology Sector', 'SABRRY BIN LASUPIN', 'IT Instructor', 'STDCin9GRYA'),
('STDCinPVZPU', 'STDC', 'ICT', 'Pentadbiran Sistem Komputer', 'Computer part', 'Harddisk 2TB', '-', '-', '-', '-', 0.01, 'Toshiba', '1', '-', '2024-10-25', '2024-10-29', '-', 1, 'unit', '-', 0.01, 1, '-', '-', '-', '-', '2024-10-24', '2024-10-25', 'adam', '2', 'officer', 'ict', 'adam', 'Hod ', 'STDCinFEAIL');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `username` varchar(55) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `position` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `gender_id` char(11) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`username`, `name`, `position`, `email`, `phone`, `gender_id`, `photo`) VALUES
('Abi', 'ABI KHURAIRAH BIN ALI', 'Electrical Instructors', 'abiemail@stdc.edu.my', '0174352852', 'M', 'man.png'),
('adam', 'Muhammad Adam', 'Asset Officer', 'adam@gmail.com', '0133033303', 'M', 'Screenshot 2024-06-01 164950.png'),
('admin2', 'VICTORIA A/P ROBAT ', 'admin', 'victorobat18@gmail.com', '0146897425', 'F', 'female.png'),
('Azmi', 'MOHD AZMI BIN YASSIN', 'IT Instructors', 'azmiemail@stdc.edu.my', '0136258491', 'M', 'man.png'),
('Bab', 'BAB YUZAL BIN TOLIT', 'Air conditionning Technology Sector Instructors', 'babemail@stdc.edu.my', '0174352852', 'M', 'man.png'),
('Faiz', 'MOHD. FAIZ BIN MOHAMMED ASHAARI', ' Automotive Instructor', 'mohdfaizemail@stdc.edu.my', '0174352852', 'M', 'man.png'),
('Fariq', 'MOHD FARIQ IZMEER BIN MAT SHARIE', ' Automotive Instructor', 'nurulemail@stdc.edu.my', '0146897425', 'M', 'man.png'),
('Faris', 'FARIS HAQ BIN ABDUL RAHMAN', ' Automotive Instructor', 'farisemail@stdc.edu.my', '0146897425', 'M', 'man.png'),
('Fatimah', 'SITI NOR FATIMAH BINTI MOHD NOR', 'Electrical Instructors', 'fatimahemail@stdc.edu.my', '0146897425', 'F', 'female.png'),
('Hafiz', 'TC. MUHAMMAD HAFIZ BIN NORDIN', 'Air conditionning Technology Sector Instructors', 'hafizemail@stdc.edu.my', '0146897425', 'M', 'man.png'),
('Moona ', 'MOONA BINTI AZIZ', 'Textile Appreal Instructor', 'moonaemail@stdc.edu.my', '0107584964', 'F', 'female.png'),
('Nurulhuda', '	NURULHUDA BINTI ALI', ' Automotive Instructor', 'nuruleemail@stdc.edu.my', '010-3695837', 'F', 'female.png'),
('Nurulsyafika', 'CHE NURULSYAFIKA BINTI CHE ROSLAN', 'Spa Theraphy Instructor', 'nurulsyafikaemail@stdc.edu.my', '0111149820', 'F', 'female.png'),
('SABRRY', 'SABRRY BIN LASUPIN', 'IT Instructor', 'sabrry@stdc.edu.my', '0198802376', 'M', 'download (2).jpg'),
('Sobrina', 'SITI SOBRINA BINTI ABDUL RAHIM', 'IT Instructors/Internal Verification Officer', 'sobrinaemail@stdc.edu.my', '0196668574', 'F', 'female.png'),
('Syamimi', 'NUR SYAMIMI BINT MD JAAFAR', 'Textile Appreal Instructors', 'mimiemail@stdc.edu.my', '01875964127', 'F', 'female.png'),
('Syazwani', 'NUR SYAZWANI BINTI HAMSAN', 'Bakery and Pastry Instructors', 'syazwaniemail@stdc.edu.my', '01458247569', 'F', 'female.png'),
('victoria', 'Victoria', 'CEO', 'Victoria@gmail.com', '0177077707', 'F', 'Screenshot 2024-06-01 164930.png'),
('Waheeda', 'NUR WAHEEDA BINTI ABDUL RAHMAN', 'Bakery and Pastry Instructors', 'waheedaemail@stdc.edu.my', '0168547129', 'F', 'female.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `disposal`
--
ALTER TABLE `disposal`
  ADD PRIMARY KEY (`disposal_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`ref_no`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `receive`
--
ALTER TABLE `receive`
  ADD PRIMARY KEY (`receive_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `disposal`
--
ALTER TABLE `disposal`
  MODIFY `disposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `receive`
--
ALTER TABLE `receive`
  MODIFY `receive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
