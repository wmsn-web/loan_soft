-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 20, 2022 at 05:57 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loan_soft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_admin` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `role` varchar(100) DEFAULT NULL,
  `role_slug` varchar(100) DEFAULT NULL,
  `permissions` text DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_admin`, `password`, `status`, `role`, `role_slug`, `permissions`, `name`, `email`, `phone`) VALUES
(1, 'admin', '$2y$10$juS.dH9w.VhvnjpVzuhps.1V8dyZIV0AiE5nAuh9mjJa/wSfHgAem', 1, 'Super_admin', 'super_admin', NULL, 'Admin', 'Admin@gmail.com', NULL),
(7, 'user3', '$2y$10$6PmFSd3BKXsbQETeivTvauU9n03OTB8sSmQAjorCGi79KamDHFt3e', 1, 'Data Entry Operator', 'data-entry-operator', '{\"create_account\":\"1\",\"review_account\":null,\"disburs_loan\":null,\"manage_repayment\":null,\"user_manage\":null,\"enquery\":null}', 'Suraj Sing', 'xmas@wmsn.in', '7063265845'),
(8, 'mithun_das', '$2y$10$tLd5crnlZDP8MmfaAhH8z.5s33k7ZD6vJP99VQPb8H4oIinWFGq72', 1, 'Reviewer', 'reviewer', '{\"create_account\":null,\"review_account\":\"1\",\"disburs_loan\":\"1\",\"manage_repayment\":null,\"user_manage\":null,\"enquery\":null}', 'Mithun Das', 'mithun@gmail.com', '9332565445');

-- --------------------------------------------------------

--
-- Table structure for table `emi_states`
--

DROP TABLE IF EXISTS `emi_states`;
CREATE TABLE IF NOT EXISTS `emi_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month_num` int(10) NOT NULL,
  `int_rate` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emi_states`
--

INSERT INTO `emi_states` (`id`, `month_num`, `int_rate`) VALUES
(4, 3, 12),
(3, 6, 8),
(5, 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submitted_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `application_id` varchar(100) DEFAULT NULL,
  `loan_ac_no` varchar(255) DEFAULT NULL,
  `affective_date` varchar(100) DEFAULT NULL,
  `down_pay` varchar(100) DEFAULT NULL,
  `down_pay_amt` varchar(100) DEFAULT NULL,
  `request_amount` varchar(100) DEFAULT NULL,
  `emi_period` varchar(100) DEFAULT NULL,
  `loan_type` varchar(100) NOT NULL,
  `step` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `cont_number` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pin` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `same_addr` varchar(255) DEFAULT NULL,
  `r_adress` varchar(100) DEFAULT NULL,
  `r_city` varchar(100) DEFAULT NULL,
  `r_pin` varchar(100) DEFAULT NULL,
  `r_state` varchar(100) DEFAULT NULL,
  `v_id` varchar(100) DEFAULT NULL,
  `adhar_no` varchar(100) DEFAULT NULL,
  `pan_no` varchar(100) DEFAULT NULL,
  `pro_img` varchar(255) DEFAULT NULL,
  `g_full_name` varchar(100) DEFAULT NULL,
  `g_gender` varchar(100) DEFAULT NULL,
  `g_dob` varchar(100) DEFAULT NULL,
  `g_cont_number` varchar(100) DEFAULT NULL,
  `g_email` varchar(100) DEFAULT NULL,
  `g_adress` text DEFAULT NULL,
  `g_city` varchar(100) DEFAULT NULL,
  `g_pin` varchar(100) DEFAULT NULL,
  `g_state` varchar(100) DEFAULT NULL,
  `g_same_addr` varchar(100) DEFAULT NULL,
  `g_r_adress` text DEFAULT NULL,
  `g_r_city` varchar(100) DEFAULT NULL,
  `g_r_pin` varchar(100) DEFAULT NULL,
  `g_r_state` varchar(100) DEFAULT NULL,
  `g_v_id` varchar(100) DEFAULT NULL,
  `g_adhar_no` varchar(100) DEFAULT NULL,
  `g_pan_no` varchar(100) DEFAULT NULL,
  `g_pro_img` varchar(255) DEFAULT NULL,
  `loan_status` varchar(100) NOT NULL DEFAULT 'pending',
  `updated_at` date NOT NULL DEFAULT current_timestamp(),
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `submitted_by`, `updated_by`, `application_id`, `loan_ac_no`, `affective_date`, `down_pay`, `down_pay_amt`, `request_amount`, `emi_period`, `loan_type`, `step`, `full_name`, `gender`, `dob`, `cont_number`, `email`, `adress`, `city`, `pin`, `state`, `same_addr`, `r_adress`, `r_city`, `r_pin`, `r_state`, `v_id`, `adhar_no`, `pan_no`, `pro_img`, `g_full_name`, `g_gender`, `g_dob`, `g_cont_number`, `g_email`, `g_adress`, `g_city`, `g_pin`, `g_state`, `g_same_addr`, `g_r_adress`, `g_r_city`, `g_r_pin`, `g_r_state`, `g_v_id`, `g_adhar_no`, `g_pan_no`, `g_pro_img`, `loan_status`, `updated_at`, `created_at`) VALUES
(4, '7', '8', 'AP-22-583441', 'LN-20105379981', '2022-05-06', '', '', '15000', '6', 'personal-loan-cash-emi', 4, 'Sanjay Natta', 'Male', '1985-08-14', '7063245845', 'xmas@wmsn.in', '3No. Durganagar', 'Chakdaha', '741222', 'West Bengal', 'yes', '3No. Durganagar', 'Chakdaha', '741222', 'West Bengal', 'CRZ0023556698', '665533221144', 'AZLPN1331J', '625b20f696a1a.jpg', 'Ayan Biswas', 'Male', '1992-08-15', '1234567890', 'ayan@gmail.com', 'Netajipark', 'Chakdaha', 'Chakdaha', 'West Bengal', 'yes', 'Netajipark', 'Chakdaha', '741222', 'West Bengal', 'CRZ885655478', '6655332211446', 'AZOPK1587K', '625c69ac21e44.jpg', 'approved', '2022-04-15', '2022-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `loan_documents`
--

DROP TABLE IF EXISTS `loan_documents`;
CREATE TABLE IF NOT EXISTS `loan_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` varchar(100) DEFAULT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `doc_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_documents`
--

INSERT INTO `loan_documents` (`id`, `application_id`, `doc_name`, `doc_img`) VALUES
(7, 'AP-22-583441', 'PAN Card', '625b22df1857a.jpg'),
(6, 'AP-22-583441', 'Adhaar Card', '625b22d555ab3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

DROP TABLE IF EXISTS `loan_types`;
CREATE TABLE IF NOT EXISTS `loan_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL,
  `type_slug` varchar(100) NOT NULL,
  `down_payment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`id`, `type_name`, `type_slug`, `down_payment`) VALUES
(1, 'Product Loan Pay Later', 'product-loan-pay-later', 'disable'),
(2, 'Product Loan EMI', 'product-loan-emi', 'enabled'),
(3, 'Personal Loan Cash EMI', 'personal-loan-cash-emi', 'disabled');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
