-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2019 at 05:01 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `clinic_id` int(11) NOT NULL,
  `clinic_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_name`) VALUES
(1, 'PTA'),
(2, 'JHB'),
(3, 'DBN'),
(4, 'CPT');

-- --------------------------------------------------------

--
-- Table structure for table `dispenser`
--

CREATE TABLE `dispenser` (
  `front_id` int(11) NOT NULL,
  `front_name` varchar(30) NOT NULL,
  `emp_no` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispenser`
--

INSERT INTO `dispenser` (`front_id`, `front_name`, `emp_no`, `password`) VALUES
(1, 'Receptionist', '101', 'passw0rd'),
(2, 'Pharmacist', '102', 'p@ssword');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `practice_no` varchar(30) NOT NULL,
  `doctor_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `practice_no`, `doctor_name`, `password`) VALUES
(1, '100', 'Dr Dinkles', 'd3ntist'),
(2, '200', 'Dr Kase', 'surg30n'),
(3, '300', 'Dr Benadi', 'g3n3ral'),
(4, '400', 'Dr Bengo', '.###');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(100) DEFAULT NULL,
  `dosage` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `medicine_name`, `dosage`, `qty`) VALUES
(1, 'Disprin 3 tablets', 'take 1 2 times a day', 2),
(2, 'Panado syrup', '1 spoon at night', 6),
(3, 'Grand-pa', '', 3),
(4, 'Alcophylix', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `med_clinic`
--

CREATE TABLE `med_clinic` (
  `medicine_id` int(11) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `med_clinic`
--

INSERT INTO `med_clinic` (`medicine_id`, `clinic_id`, `qty`) VALUES
(1, 1, 2),
(1, 2, 1),
(1, 3, 3),
(1, 4, 1),
(2, 1, 2),
(2, 2, 1),
(2, 3, 3),
(2, 4, 2),
(3, 1, 0),
(3, 2, 0),
(3, 3, 2),
(3, 4, 3),
(4, 1, 2),
(4, 2, 1),
(4, 3, 5),
(4, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `med_prescription`
--

CREATE TABLE `med_prescription` (
  `prescription_id` int(11) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `id_no` text NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(30) NOT NULL,
  `contact` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `name`, `surname`, `dob`, `id_no`, `age`, `address`, `contact`) VALUES
(1, 'Oupa', 'Katongo', '2000-01-01', '20000101', 19, '77 main, cape town', '55887744'),
(2, 'Jacob', 'Zuma', '2010-12-01', '20101201', 9, '54 str dd', '0115523112');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `prescription_details` varchar(100) DEFAULT NULL,
  `collected` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescription_id`, `patient_id`, `doctor_id`, `prescription_details`, `collected`) VALUES
(1, 1, 1, 'Panado Grand-pa', 1),
(2, 2, 1, 'grand-pa, disprin', NULL),
(3, 2, 1, 'Alcophylix', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pre_temp`
--

CREATE TABLE `pre_temp` (
  `medicine_desc` varchar(60) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `r_date` date DEFAULT NULL,
  `records` varchar(100) DEFAULT NULL,
  `comments` varchar(100) DEFAULT NULL,
  `next_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `dispenser`
--
ALTER TABLE `dispenser`
  ADD PRIMARY KEY (`front_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `med_clinic`
--
ALTER TABLE `med_clinic`
  ADD KEY `medicine_id` (`medicine_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `med_prescription`
--
ALTER TABLE `med_prescription`
  ADD KEY `prescription_id` (`prescription_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dispenser`
--
ALTER TABLE `dispenser`
  MODIFY `front_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `med_clinic`
--
ALTER TABLE `med_clinic`
  ADD CONSTRAINT `med_clinic_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`),
  ADD CONSTRAINT `med_clinic_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`);

--
-- Constraints for table `med_prescription`
--
ALTER TABLE `med_prescription`
  ADD CONSTRAINT `med_prescription_ibfk_1` FOREIGN KEY (`prescription_id`) REFERENCES `prescription` (`prescription_id`),
  ADD CONSTRAINT `med_prescription_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
