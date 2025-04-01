-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql108.infinityfree.com
-- Generation Time: Apr 01, 2025 at 08:45 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37760387_primelendrow`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_wallet`
--

CREATE TABLE `admin_wallet` (
  `id` int(11) NOT NULL,
  `admin_wallet_name` varchar(255) NOT NULL,
  `virtual_balance` varchar(255) NOT NULL,
  `system_balance` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_wallet`
--

INSERT INTO `admin_wallet` (`id`, `admin_wallet_name`, `virtual_balance`, `system_balance`, `created_at`, `updated_at`) VALUES
(1, 'Prime LendRow', '850.00', '36,000.00', '2024-12-20 17:43:13', '2025-02-03 14:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `admin_wallet_transactions`
--

CREATE TABLE `admin_wallet_transactions` (
  `id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_wallet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_wallet_transactions`
--

INSERT INTO `admin_wallet_transactions` (`id`, `amount`, `status`, `method`, `created_at`, `updated_at`, `admin_wallet_id`) VALUES
(1, '20,000.00', 'Added', 'Virtual CashIn', '2024-12-20 17:22:32', '2024-12-20 17:43:13', 1),
(2, '5,000.00', 'Deducted', 'CashIn', '2024-12-21 08:23:16', '2024-12-21 08:23:16', 1),
(3, '5,000.00', 'Deducted', 'CashIn', '2024-12-30 09:14:06', '2024-12-30 09:14:06', 1),
(4, '5,000.00', 'Deducted', 'CashIn', '2024-12-30 09:18:11', '2024-12-30 09:18:11', 1),
(5, '50.00', 'Deducted', 'CashIn', '2025-01-04 22:43:20', '2025-01-04 22:43:20', 1),
(6, '4,000.00', 'Deducted', 'CashIn', '2025-01-05 01:54:47', '2025-01-05 01:54:47', 1),
(7, '15,000.00', 'Added', 'Virtual CashIn', '2025-01-05 01:55:36', '2025-01-05 01:55:45', 1),
(8, '4,000.00', 'Deducted', 'CashIn', '2025-01-05 01:59:33', '2025-01-05 01:59:33', 1),
(9, '200.00', 'Deducted', 'CashIn', '2025-01-05 02:04:40', '2025-01-05 02:04:40', 1),
(10, '5,000.00', 'Deducted', 'CashIn', '2025-01-06 02:19:12', '2025-01-06 02:19:12', 1),
(11, '3,000.00', 'Deducted', 'CashIn', '2025-01-06 02:21:45', '2025-01-06 02:21:45', 1),
(12, '200.00', 'Deducted', 'CashIn', '2025-01-12 05:54:56', '2025-01-12 05:54:56', 1),
(13, '100.00', 'Deducted', 'CashIn', '2025-01-12 05:55:29', '2025-01-12 05:55:29', 1),
(14, '2,000.00', 'Deducted', 'CashIn', '2025-02-03 22:39:20', '2025-02-03 22:39:20', 1),
(15, '1,000.00', 'Deducted', 'CashIn', '2025-02-03 22:46:00', '2025-02-03 22:46:00', 1),
(16, '100.00', 'Deducted', 'CashIn', '2025-02-03 22:52:26', '2025-02-03 22:52:26', 1),
(17, '1,000.00', 'Added', 'Virtual CashIn', '2025-02-08 14:31:26', '2025-02-08 14:31:31', 1),
(18, '500.00', 'Deducted', 'CashIn', '2025-02-08 14:31:45', '2025-02-08 14:31:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `borrowername` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `collateral` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `lending_terms_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `picture`, `borrowername`, `mobile`, `collateral`, `status`, `created_at`, `updated_at`, `lending_terms_id`, `users_id`) VALUES
(1, NULL, 'Jenard M Yap', '09185567669', '../collaterals/collateral_677ccea086a891.79207775.png', 'Paid', '2024-12-30 09:50:08', '2025-01-05 02:04:59', 1, 4),
(2, '../pictures/profile_677cfb98617c38.11056330.jpg', 'Kent Ryan Gonzales Entice', '09100000002', '../collaterals/collateral_677cfbe15cba36.14023614.png', 'Rejected', '2025-01-03 02:03:13', '2025-01-03 02:07:31', 2, 2),
(3, '../pictures/profile_677cfb98617c38.11056330.jpg', 'Kent Ryan Gonzales Entice', '09100000002', '../collaterals/collateral_677cfcf52ab581.71596617.png', 'Paid', '2025-01-03 03:23:00', '2025-01-04 22:44:42', 2, 2),
(4, '../pictures/profile_677cfb98617c38.11056330.jpg', 'Kent Ryan Gonzales Entice', '09100000002', '../collaterals/collateral_67863c0316b8a5.28458014.png', 'Paid', '2025-01-12 02:27:15', '2025-01-13 06:01:43', 4, 2),
(5, '../pictures/profile_677cfb98617c38.11056330.jpg', 'Kent Ryan Gonzales Entice', '09100000002', '../collaterals/collateral_67a1b69fdd0326.88519364.jpg', 'Pending', '2025-02-03 22:41:35', '2025-02-03 22:41:35', 3, 2),
(6, '../pictures/profile_677cfb98617c38.11056330.jpg', 'Kent Ryan Gonzales Entice', '09100000002', '../collaterals/collateral_67a1b7cbe82527.66122627.jpg', 'Paid', '2025-02-03 22:46:35', '2025-03-13 05:01:49', 6, 2),
(7, NULL, 'Marly G Entice', '09690755742', '../collaterals/collateral_67a387e83ff987.27423064.jpg', 'Cancelled', '2025-01-14 07:46:48', '2025-01-14 07:46:48', 5, 5),
(8, NULL, 'Marly G Entice', '09690755742', '../collaterals/collateral_67a7dc283bf6b6.37241914.png', 'Paid', '2025-01-14 14:35:20', '2025-01-14 14:36:30', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cash_transactions`
--

CREATE TABLE `cash_transactions` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `payment_number` varchar(255) NOT NULL,
  `payment_account_name` varchar(255) NOT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `wallet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash_transactions`
--

INSERT INTO `cash_transactions` (`id`, `fullname`, `method`, `payment_method`, `amount`, `mobile`, `payment_number`, `payment_account_name`, `receipt`, `status`, `created_at`, `updated_at`, `wallet_id`) VALUES
(1, 'Prime LendRow Official', 'CashIn', 'Gcash', '5,000.00', '09000000000', '09000000000', 'Prime LendRow Official', '../receipts/receipt_677a214a0383a2.89927509.png', 'Added', '2024-12-21 06:39:22', '2024-12-21 08:23:16', 1),
(2, 'Prime LendRow Official', 'CashOut', 'Gcash', '1,010.00', '09000000000', '09000000000', 'Prime LendRow Official', NULL, 'Rejected', '2024-12-21 09:13:08', '2024-12-21 09:20:54', 1),
(3, 'Prime LendRow Official', 'CashOut', 'Gcash', '110.00', '09000000000', '09000000000', 'Prime LendRow Official', NULL, 'Rejected', '2024-12-21 09:30:38', '2024-12-21 09:32:07', 1),
(4, 'Prime LendRow Official', 'CashIn', 'Gcash', '50.00', '09000000000', '09000000000', 'Prime LendRow Official', '../receipts/receipt_677b2d6c83f401.44815849.jpg', 'Rejected', '2024-12-21 09:43:04', '2024-12-21 09:45:04', 1),
(5, 'Lourdes Mahinay Gonzales', 'CashIn', 'Gcash', '5,000.00', '09690755743', '09690755743', 'Lourdes Mahinay Gonzales', '../receipts/receipt_677bb9ff80c462.97679244.jpg', 'Added', '2024-12-30 09:11:24', '2024-12-30 09:14:06', 3),
(6, 'Lourdes Mahinay Gonzales', 'CashIn', 'Gcash', '5,000.00', '09690755743', '09690755743', 'Lourdes Mahinay Gonzales', '../receipts/receipt_677bba751f1299.62240727.jpg', 'Added', '2024-12-30 09:11:49', '2024-12-30 09:18:11', 3),
(7, 'Kent Ryan Gonzales Entice', 'CashIn', 'Gcash', '50.00', '09100000002', '09100000002', 'Kent Ryan Gonzales Entice', '../receipts/receipt_6783647155eca2.91380639.png', 'Added', '2025-01-04 22:42:57', '2025-01-04 22:43:20', 2),
(8, 'Rey M Gonzales', 'CashIn', 'Gcash', '4,000.00', '09214086578', '09214086578', 'Rey M Gonzales', '../receipts/receipt_67863451065218.28225371.png', 'Added', '2025-01-05 01:54:25', '2025-01-05 01:54:47', 6),
(9, 'Rey M Gonzales', 'CashIn', 'Gcash', '4,000.00', '09214086578', '09214086578', 'Rey M Gonzales', '../receipts/receipt_6786347875a5e0.13353213.png', 'Rejected', '2025-01-05 01:55:04', '2025-01-05 01:58:45', 6),
(10, 'Rey M Gonzales', 'CashIn', 'Gcash', '4,000.00', '09214086578', '09214086578', 'Rey M Gonzales', '../receipts/receipt_6786356b9dbd27.27982258.png', 'Added', '2025-01-05 01:59:07', '2025-01-05 01:59:33', 6),
(11, 'Jenard M Yap', 'CashIn', 'Gcash', '200.00', '09185567669', '09185567669', 'Jenard M Yap', '../receipts/receipt_6786364b880c05.22982900.png', 'Added', '2025-01-05 02:02:51', '2025-01-05 02:04:40', 4),
(12, 'Marly G Entice', 'CashIn', 'Gcash', '5,000.00', '09690755742', '09690755742', 'Marly G Entice', '../receipts/receipt_67863a097ede29.05575832.png', 'Added', '2025-01-06 02:18:49', '2025-01-06 02:19:12', 5),
(13, 'Marly G Entice', 'CashIn', 'Gcash', '3,000.00', '09690755742', '09690755742', 'Marly G Entice', '../receipts/receipt_67863aacb9a1f8.67725226.png', 'Added', '2025-01-06 02:21:32', '2025-01-06 02:21:45', 5),
(14, 'Kent Ryan Gonzales Entice', 'CashIn', 'Gcash', '200.00', '09100000002', '09100000002', 'Kent Ryan Gonzales Entice', '../receipts/receipt_679b849f553367.28934672.png', 'Added', '2025-01-12 05:54:39', '2025-01-12 05:54:56', 2),
(15, 'Kent Ryan Gonzales Entice', 'CashIn', 'Gcash', '100.00', '09100000002', '09100000002', 'Kent Ryan Gonzales Entice', '../receipts/receipt_679b84bfddcd69.53155055.png', 'Added', '2025-01-12 05:55:11', '2025-01-12 05:55:29', 2),
(16, 'Kent Ryan Gonzales Entice', 'CashIn', 'Gcash', '2,000.00', '09100000002', '09100000002', 'Kent Ryan Gonzales Entice', '../receipts/receipt_67a1b6036bb734.18836288.jpg', 'Added', '2025-02-03 22:38:59', '2025-02-03 22:39:20', 2),
(17, 'Clint Clay Entice', 'CashIn', 'Gcash', '1,000.00', '09100000010', '09100000010', 'Clint Clay Entice', '../receipts/receipt_67a1b7920d8722.48796247.jpg', 'Added', '2025-02-03 22:45:38', '2025-02-03 22:46:00', 9),
(18, 'Kent Ryan Gonzales Entice', 'CashIn', 'Gcash', '100.00', '09100000002', '09100000002', 'Kent Ryan Gonzales Entice', '../receipts/receipt_67a1b918e15b51.09136920.jpg', 'Added', '2025-02-03 22:52:08', '2025-02-03 22:52:26', 2),
(19, 'Marly G Entice', 'CashIn', 'Gcash', '500.00', '09690755742', '09690755742', 'Marly G Entice', '../receipts/receipt_67a389f7c545b0.02157164.jpg', 'Added', '2025-01-14 07:55:35', '2025-01-14 07:56:26', 5),
(20, 'Kent Ryan Gonzales Entice', 'CashIn', 'Gcash', '500.00', '09100000002', '09100000002', 'Kent Ryan Gonzales Entice', '../receipts/receipt_67a5cb48699c34.71070929.png', 'Pending', '2025-01-14 07:58:48', '2025-01-14 07:58:48', 2);

-- --------------------------------------------------------

--
-- Table structure for table `financial_details`
--

CREATE TABLE `financial_details` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `lendername` varchar(255) NOT NULL,
  `borrowername` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `interest` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `monthly` varchar(255) NOT NULL,
  `month_1` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_1` datetime NOT NULL DEFAULT current_timestamp(),
  `month_2` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_2` datetime NOT NULL DEFAULT current_timestamp(),
  `month_3` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_3` datetime NOT NULL DEFAULT current_timestamp(),
  `month_4` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_4` datetime NOT NULL DEFAULT current_timestamp(),
  `month_5` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_5` datetime NOT NULL DEFAULT current_timestamp(),
  `month_6` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_6` datetime NOT NULL DEFAULT current_timestamp(),
  `month_7` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_7` datetime NOT NULL DEFAULT current_timestamp(),
  `month_8` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_8` datetime NOT NULL DEFAULT current_timestamp(),
  `month_9` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_9` datetime NOT NULL DEFAULT current_timestamp(),
  `month_10` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_10` datetime NOT NULL DEFAULT current_timestamp(),
  `month_11` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_11` datetime NOT NULL DEFAULT current_timestamp(),
  `month_12` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `updated_at_month_12` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'UnPaid',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `lending_terms_id` int(11) DEFAULT NULL,
  `applications_id` int(11) DEFAULT NULL,
  `lending_agreements_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financial_details`
--

INSERT INTO `financial_details` (`id`, `picture`, `lendername`, `borrowername`, `mobile`, `amount`, `interest`, `term`, `monthly`, `month_1`, `updated_at_month_1`, `month_2`, `updated_at_month_2`, `month_3`, `updated_at_month_3`, `month_4`, `updated_at_month_4`, `month_5`, `updated_at_month_5`, `month_6`, `updated_at_month_6`, `month_7`, `updated_at_month_7`, `month_8`, `updated_at_month_8`, `month_9`, `updated_at_month_9`, `month_10`, `updated_at_month_10`, `month_11`, `updated_at_month_11`, `month_12`, `updated_at_month_12`, `status`, `created_at`, `updated_at`, `lending_terms_id`, `applications_id`, `lending_agreements_id`) VALUES
(1, '', 'Lourdes Mahinay Gonzales', 'Jenard M Yap', '09185567669', '2,000.00', '10% Monthly', '1 Month', '2,200.00', 'Paid', '2025-01-05 02:04:59', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'UnPaid', '2024-12-30 11:17:25', 'Paid', '2024-12-30 11:17:25', '2025-01-05 02:04:59', 1, 1, 4),
(2, '../pictures/profile_677b52bea74c06.71383355.png', 'Prime LendRow Official', 'Kent Ryan Gonzales Entice', '09100000002', '500.00', '10% Monthly', '1 Month', '550.00', 'Paid', '2025-01-04 22:44:42', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'UnPaid', '2025-01-04 22:44:24', 'Paid', '2025-01-04 22:44:24', '2025-01-04 22:44:42', 2, 3, 5),
(3, '', 'Rey M Gonzales', 'Kent Ryan Gonzales Entice', '09100000002', '3,000.00', '10% Monthly', '1 Month', '3,300.00', 'Paid', '2025-01-13 06:01:43', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'UnPaid', '2025-01-12 02:28:05', 'Paid', '2025-01-12 02:28:05', '2025-01-13 06:01:43', 4, 4, 6),
(4, '', 'Clint Clay Entice', 'Kent Ryan Gonzales Entice', '09100000002', '1,000.00', '10% Monthly', '1 Month', '1,100.00', 'Paid', '2025-03-13 05:01:49', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'UnPaid', '2025-02-03 22:50:19', 'Paid', '2025-02-03 22:50:19', '2025-03-13 05:01:49', 6, 6, 7),
(5, '../pictures/profile_677cfb98617c38.11056330.jpg', 'Kent Ryan Gonzales Entice', 'Marly G Entice', '09690755742', '2,000.00', '10% Monthly', '2 Months', '1,200.00', 'Paid', '2025-01-14 14:36:25', 'Paid', '2025-01-14 14:36:30', 'UnPaid', '2025-01-14 14:35:38', 'UnPaid', '2025-01-14 14:35:38', 'UnPaid', '2025-01-14 14:35:38', 'UnPaid', '2025-02-08 14:35:38', 'UnPaid', '2025-02-08 14:35:38', 'UnPaid', '2025-02-08 14:35:38', 'UnPaid', '2025-02-08 14:35:38', 'UnPaid', '2025-02-08 14:35:38', 'UnPaid', '2025-01-14 14:35:38', 'UnPaid', '2025-01-14 14:35:38', 'Paid', '2025-01-14 14:35:38', '2025-01-14 14:36:30', 5, 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `lending_agreement`
--

CREATE TABLE `lending_agreement` (
  `id` int(11) NOT NULL,
  `lendername` varchar(255) NOT NULL,
  `borrowername` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `interest` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `monthly` varchar(255) NOT NULL,
  `collateral` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `lending_terms_id` int(11) DEFAULT NULL,
  `applications_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lending_agreement`
--

INSERT INTO `lending_agreement` (`id`, `lendername`, `borrowername`, `mobile`, `amount`, `interest`, `term`, `monthly`, `collateral`, `created_at`, `updated_at`, `lending_terms_id`, `applications_id`) VALUES
(4, 'Lourdes Mahinay Gonzales', 'Jenard M Yap', '09185567669', '2,000.00', '10% Monthly', '1 Month', '2,200.00', 'Items', '2024-12-30 11:17:25', '2025-01-05 02:04:59', 1, 1),
(5, 'Prime LendRow Official', 'Kent Ryan Gonzales Entice', '09100000002', '500.00', '10% Monthly', '1 Month', '550.00', 'Items', '2025-01-03 03:27:49', '2025-01-04 22:44:42', 2, 3),
(6, 'Rey M Gonzales', 'Kent Ryan Gonzales Entice', '09100000002', '3,000.00', '10% Monthly', '1 Month', '3,300.00', 'Items', '2025-01-12 02:27:51', '2025-01-13 06:01:43', 4, 4),
(7, 'Clint Clay Entice', 'Kent Ryan Gonzales Entice', '09100000002', '1,000.00', '10% Monthly', '1 Month', '1,100.00', 'Items', '2025-02-03 22:48:56', '2025-03-13 05:01:49', 6, 6),
(8, 'Kent Ryan Gonzales Entice', 'Marly G Entice', '09690755742', '2,000.00', '10% Monthly', '2 Months', '1,200.00', 'Items', '2025-01-14 14:35:38', '2025-01-14 14:36:30', 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `lending_terms`
--

CREATE TABLE `lending_terms` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `lendername` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `monthly` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `interest` varchar(255) NOT NULL,
  `collateral` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lending_terms`
--

INSERT INTO `lending_terms` (`id`, `picture`, `lendername`, `mobile`, `monthly`, `amount`, `interest`, `collateral`, `term`, `status`, `created_at`, `updated_at`, `users_id`) VALUES
(1, NULL, 'Lourdes Mahinay Gonzales', '09690755743', '2,200.00', '2,000.00', '10% Monthly', 'Items', '1 Month', 'Closed', '2024-12-30 10:14:19', '2024-12-30 11:17:25', 3),
(2, '../pictures/profile_677b52bea74c06.71383355.png', 'Prime LendRow Official', '09000000000', '550.00', '500.00', '10% Monthly', 'Items', '1 Month', 'Closed', '2025-01-02 02:02:51', '2025-01-03 02:02:51', 1),
(3, NULL, 'Marly G Entice', '09690755742', '8,800.00', '8,000.00', '10% Monthly', 'Items', '1 Month', 'Open', '2025-01-08 02:23:44', '2025-01-08 02:23:44', 5),
(4, NULL, 'Rey M Gonzales', '09214086578', '3,300.00', '3,000.00', '10% Monthly', 'Items', '1 Month', 'Closed', '2025-01-12 02:24:46', '2025-01-12 02:24:46', 6),
(5, '../pictures/profile_677cfb98617c38.11056330.jpg', 'Kent Ryan Gonzales Entice', '09100000002', '1,200.00', '2,000.00', '10% Monthly', 'Items', '2 Months', 'Closed', '2025-01-14 22:40:11', '2025-01-14 22:40:11', 2),
(6, NULL, 'Clint Clay Entice', '09100000010', '1,100.00', '1,000.00', '10% Monthly', 'Items', '1 Month', 'Closed', '2025-02-03 22:46:23', '2025-02-03 22:46:23', 9);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `user_agent` text NOT NULL,
  `login_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `fullname`, `device`, `browser`, `ip_address`, `user_agent`, `login_time`) VALUES
(1, 'PrimeLendRow', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.195', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-04 22:01:56'),
(2, 'PrimeLendRow', 'Linux 6.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.195', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-04 22:06:27'),
(3, 'PrimeLendRow', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-05 16:44:38'),
(4, 'adminkentryan', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-05 16:57:37'),
(5, 'PrimeLendRow', 'Linux 5.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-05 17:05:32'),
(6, 'ondit123', 'Linux 6.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.63', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', '2025-01-05 18:00:00'),
(7, 'PrimeLendRow', 'Linux 6.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.63', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', '2025-01-05 21:39:11'),
(8, 'ondit123', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.187', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', '2025-01-06 02:58:33'),
(9, 'ondit123', 'Linux 5.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.224', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-06 22:29:53'),
(10, 'PrimeLendRow', 'Linux 6.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.96', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-06 22:36:20'),
(11, 'jenard', 'Linux 6.6.7-362.18.1.el9_5.x86_64', 'Chrome', '202.137.122.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-06 22:44:38'),
(12, 'PrimeLendRow', 'Linux 5.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-06 22:48:03'),
(13, 'jenard', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-06 22:49:19'),
(14, 'ondit123', 'Linux 5.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-07 00:59:12'),
(15, 'PrimeLendRow', 'Linux 6.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-07 02:01:11'),
(16, 'adminkentryan', 'Linux 5.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-07 02:01:38'),
(17, 'PrimeLendRow', 'Linux 5.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-07 02:02:37'),
(18, 'ondit123', 'Linux 6.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.150', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', '2025-01-08 01:16:51'),
(19, 'ondit123', 'Linux 5.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.150', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', '2025-01-08 01:17:32'),
(20, 'PrimeLendRow', 'Linux 6.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-09 02:11:38'),
(21, 'ondit123', 'Linux 6.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-09 02:11:49'),
(22, 'PrimeLendRow', 'Linux 6.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-09 02:27:06'),
(23, 'ondit123', 'Linux 5.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-09 02:56:03'),
(24, 'PrimeLendRow', 'Linux 6.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-09 03:17:28'),
(25, 'ondit123', 'Linux 6.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.23', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', '2025-01-09 23:44:36'),
(26, 'PrimeLendRow', 'Linux 6.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.104', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', '2025-01-10 23:08:18'),
(27, 'adminkentryan', 'Linux 6.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.213', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-11 22:42:14'),
(28, 'PrimeLendRow', 'Linux 6.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.213', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-11 22:43:59'),
(29, 'marly', 'Linux 5.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.213', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-12 01:39:22'),
(30, 'rey123', 'Linux 6.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.213', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-12 01:41:45'),
(31, 'marly', 'Linux 5.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 01:52:42'),
(32, 'rey123', 'Linux 6.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 01:52:59'),
(33, 'rey123', 'Linux 5.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 01:53:16'),
(34, 'PrimeLendRow', 'Linux 6.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 01:53:29'),
(35, 'adminkentryan', 'Linux 5.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 01:59:58'),
(36, 'marly', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 02:00:46'),
(37, 'ondit123', 'Linux 5.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 02:02:05'),
(38, 'jenard', 'Linux 6.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 02:02:32'),
(39, 'PrimeLendRow', 'Linux 5.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 02:03:16'),
(40, 'adminkentryan', 'Linux 6.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-14 02:25:05'),
(41, 'PrimeLendRow', 'Linux 6.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.62', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', '2025-01-19 17:51:18'),
(42, 'PrimeLendRow', 'Linux 5.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.254', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-23 00:22:26'),
(43, 'test', 'Linux 6.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.209', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-25 21:28:10'),
(44, 'adminkentryan', 'Linux 6.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.212', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '2025-01-27 19:36:14'),
(45, 'test', 'Linux 6.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.89', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-01-28 20:02:46'),
(46, 'adminkentryan', 'Linux 6.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-01-30 05:54:02'),
(47, 'test', 'Linux 6.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-01 18:16:29'),
(48, 'test', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-01 18:58:07'),
(49, 'PrimeLendRow', 'Linux 6.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.57', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36', '2025-02-03 22:05:27'),
(50, 'adminkentryan', 'Linux 5.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.57', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36', '2025-02-03 22:06:26'),
(51, 'adminkentryan', 'Linux 6.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-03 22:33:40'),
(52, 'clint', 'Linux 5.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-03 22:44:16'),
(53, 'clint', 'Linux 5.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-03 22:45:15'),
(54, 'marly', 'Linux 5.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', '2025-02-03 22:53:13'),
(55, 'adminkentryan', 'Linux 5.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-05 06:32:51'),
(56, 'marly', 'Linux 5.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-05 06:50:54'),
(57, 'ondit123', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-05 06:51:25'),
(58, 'jenard', 'Linux 6.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-05 07:14:18'),
(59, 'jenard', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-05 07:46:14'),
(60, 'marly', 'Linux 6.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-05 07:46:37'),
(61, 'adminkentryan', 'Linux 6.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.147', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-02-05 09:04:52'),
(62, 'marly', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.147', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-02-05 09:05:12'),
(63, 'PrimeLendRow', 'Linux 5.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.147', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-02-05 09:05:37'),
(64, 'adminkentryan', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.147', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-02-05 09:05:51'),
(65, 'adminkentryan', 'Linux 5.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.181', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-02-07 00:13:43'),
(66, 'adminkentryan', 'Linux 5.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-07 00:24:02'),
(67, '1', 'Linux 6.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-07 00:32:28'),
(68, 'adminkentryan', 'Linux 5.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-07 00:48:38'),
(69, '1', 'Linux 6.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.224', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-07 16:28:06'),
(70, 'marly', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-08 14:30:30'),
(71, 'marly', 'Linux 6.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-08 14:30:35'),
(72, 'marly', 'Linux 6.3.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-08 14:30:38'),
(73, 'adminkentryan', 'Linux 6.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-08 14:31:03'),
(74, 'adminkentryan', 'Linux 5.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-08 14:34:42'),
(75, 'adminkentryan', 'Linux 5.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-10 23:28:47'),
(76, 'ondit123', 'Linux 5.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-10 23:51:08'),
(77, 'adminkentryan', 'Linux 5.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-11 05:51:12'),
(78, 'adminkentryan', 'Linux 6.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.245', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-02-12 13:11:15'),
(79, 'adminkentryan', 'Linux 5.8.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-15 01:09:21'),
(80, 'adminkentryan', 'Linux 6.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-15 02:48:56'),
(81, 'adminkentryan', 'Linux 5.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-15 02:52:20'),
(82, 'adminkentryan', 'Linux 5.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.188', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-15 23:01:28'),
(83, 'adminkentryan', 'Linux 5.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-19 18:22:37'),
(84, 'adminkentryan', 'Linux 6.7.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-19 18:25:15'),
(85, 'adminkentryan', 'Linux 6.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.240', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-02-21 00:29:19'),
(86, 'adminkentryan', 'Linux 6.7.7-362.18.1.el9_5.x86_64', 'Chrome', '202.137.122.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-23 21:10:40'),
(87, 'adminkentryan', 'Linux 6.4.7-362.18.1.el9_5.x86_64', 'Chrome', '202.137.122.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-23 21:11:33'),
(88, 'adminkentryan', 'Linux 5.7.7-362.18.1.el9_5.x86_64', 'Chrome', '202.137.122.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-02-23 21:14:57'),
(89, 'adminkentryan', 'Linux 5.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.96', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-02-24 18:19:52'),
(90, 'adminkentryan', 'Linux 5.5.7-362.18.1.el9_5.x86_64', 'Chrome', '49.145.201.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '2025-03-04 18:52:44'),
(91, 'adminkentryan', 'Linux 6.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.207', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-03-05 23:53:56'),
(92, 'adminkentryan', 'Linux 6.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.92.207', 'Mozilla/5.0 (Linux; Android 13; RMX3363 Build/TP1A.220905.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/133.0.6943.121 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/497.0.0.34.109;]', '2025-03-06 02:01:09'),
(93, 'adminkentryan', 'Linux 6.5.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.222', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36', '2025-03-09 00:49:10'),
(94, 'clint', 'Linux 5.6.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:00:56'),
(95, 'adminkentryan', 'Linux 5.4.7-362.18.1.el9_5.x86_64', 'Chrome', '175.176.93.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 05:01:33'),
(96, 'clayn', 'Linux 5.4.7-362.18.1.el9_5.x86_64', 'Chrome', '49.145.201.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 22:52:58'),
(97, 'adminkentryan', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '49.145.201.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-13 22:54:20'),
(98, 'adminkentryan', 'Linux 5.3.7-362.18.1.el9_5.x86_64', 'Chrome', '49.145.192.143', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', '2025-03-19 23:23:05'),
(99, 'Kentr', 'Linux 6.3.7-362.18.1.el9_5.x86_64', 'Chrome', '49.145.195.180', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36', '2025-04-01 00:14:28'),
(100, 'PrimeLendRow', 'Linux 5.5.7-362.18.1.el9_5.x86_64', 'Chrome', '49.145.195.180', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36', '2025-04-01 00:14:45'),
(101, 'adminkentryan', 'Linux 6.5.7-362.18.1.el9_5.x86_64', 'Chrome', '49.145.195.180', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Mobile Safari/537.36', '2025-04-01 00:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `primaryid` varchar(255) DEFAULT NULL,
  `primaryid2` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '@gmail.com',
  `pass` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `usertype` varchar(255) NOT NULL DEFAULT 'Pending',
  `userlevel` varchar(255) NOT NULL DEFAULT '0',
  `userbadge` varchar(255) NOT NULL DEFAULT 'Normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `picture`, `primaryid`, `primaryid2`, `firstname`, `middlename`, `lastname`, `username`, `mobile`, `email`, `pass`, `created_at`, `updated_at`, `usertype`, `userlevel`, `userbadge`) VALUES
(1, '../pictures/profile_677b52bea74c06.71383355.png', NULL, NULL, 'Prime', 'LendRow', 'Official', 'PrimeLendRow', '09000000000', '@gmail.com', '$2y$10$L131Lab0ZIH3a1Z8YGkejODdN9kv8S4edddTyLgv./Z8gi1jLBMEe', '2024-12-20 09:33:08', '2024-12-20 09:33:08', 'Admin', '100', 'Verified'),
(2, '../pictures/profile_677cfb98617c38.11056330.jpg', NULL, NULL, 'Kent Ryan', 'Gonzales', 'Entice', 'adminkentryan', '09100000002', '@gmail.com', '$2y$10$yXVeG8RHd3VRir2u80B43eteu0zr4uE.Bf/5Sg1xf1YGBZ.6uQLim', '2024-12-20 15:25:34', '2024-12-20 15:25:34', 'Admin', '99', 'Verified'),
(3, NULL, '../pictures/primary_677b3a974b5a57.55029002.png', '../pictures/secondary_677b3a974b5ae7.31005244.png', 'Lourdes', 'Mahinay', 'Gonzales', 'ondit123', '09690755743', '@gmail.com', '$2y$10$DHTr34KPFYnNa9UVwn/FAuEN4THcnFLRkn4oRsaLP1iQUcM269DIS', '2024-12-30 08:44:15', '2024-12-30 08:48:27', 'User', '0', 'Verified'),
(4, NULL, '../pictures/primary_677ccd717ed156.18498783.png', '../pictures/secondary_677ccd717ed1f2.96208390.png', 'Jenard', 'M', 'Yap', 'jenard', '09185567669', '@gmail.com', '$2y$10$fq3Wo47BhJ40uSx0DjVmvOOqfeb2MuyCWjJh.yKpW.XiLBIv57nrG', '2024-12-30 08:53:10', '2024-12-30 09:00:50', 'User', '0', 'Verified'),
(5, NULL, '../pictures/primary_67838dd519bd16.77828435.png', '../pictures/secondary_67838dd519bdb6.77220708.png', 'Marly', 'G', 'Entice', 'marly', '09690755742', '@gmail.com', '$2y$10$VizBpEht5tT2Kwe0bC0tTOPmhcrctlI/Vdxkb9EkTVPC1ZSR4bXty', '2025-01-03 01:39:16', '2025-01-03 01:40:04', 'User', '0', 'Verified'),
(6, NULL, '../pictures/primary_67838e619edae1.37463392.png', '../pictures/secondary_67838e619eddd4.07354338.png', 'Rey', 'M', 'Gonzales', 'rey123', '09214086578', '@gmail.com', '$2y$10$s8a3j/13th1maEm3JFIvaev8tkhF3jfsfchOGQYSq6eBnVyxssui.', '2025-01-03 01:41:38', '2025-01-03 01:42:23', 'User', '0', 'Verified'),
(7, NULL, NULL, NULL, 'Kent Ryan', 'a', 'Entice', '1', '09100119667', '@gmail.com', '$2y$10$GRCteU93V30FIjirE.I0v.PHTgM7pmDvAHPIEGGz7wHsaSD9U8V4S', '2025-01-09 02:51:00', '2025-01-09 02:51:00', 'Pending', '0', 'Normal'),
(8, NULL, '../pictures/primary_6799fbe83c9929.24542620.png', '../pictures/secondary_6799fbe83c99c2.48439127.png', 'test', 'test', 'test', 'test', '09100000000', '@gmail.com', '$2y$10$/0zk5D6/uXqDhtni2MrZfuNHMwBV2wKqy0K/9WtfPzHyI1943iew.', '2025-01-09 21:28:05', '2025-01-09 23:33:15', 'Verifying', '0', 'Normal'),
(9, NULL, '../pictures/primary_67a1b74e1db782.09251080.jpg', '../pictures/secondary_67a1b74e1db810.70541333.jpg', 'Clint', 'Clay', 'Entice', 'clint', '09100000010', '@gmail.com', '$2y$10$JySb7R9WIszLllFeqSrHEujfuyrma5hffzJ.K/UEjtf5mc4RqU2m6', '2025-02-03 22:44:05', '2025-02-03 22:45:07', 'User', '0', 'Verified'),
(10, NULL, NULL, NULL, 'a', 'a', 'a', 'a', '09100119677', '@gmail.com', '$2y$10$NX53RyLJdo95Cw/XmHJYL.xmSebQ2Ws/0mM9qt982zcqB8tNR.oQK', '2025-02-17 18:23:19', '2025-02-17 18:23:19', 'Pending', '0', 'Normal'),
(11, NULL, NULL, NULL, 'aa', 'aa', 'aa', 'aa', '09100119633', '@gmail.com', '$2y$10$S6cKXXye7AJxBKSlF4yeHORl3dqlbZwsyBTYkxQWgHSkrl9JifnFa', '2025-02-17 18:23:35', '2025-02-17 18:23:35', 'Pending', '0', 'Normal'),
(12, NULL, NULL, NULL, 'Clint', 'Clay', 'Clentice', 'clayn', '09374378848', '@gmail.com', '$2y$10$KYK6NZ.5FBFaxxRkcxEyeO7elfvR9yMR1vmjj/GUa5guPM6GXol4u', '2025-03-13 22:52:38', '2025-03-13 22:52:38', 'Pending', '0', 'Normal'),
(13, NULL, NULL, NULL, 'Kent Ryan', 'Gonzaless', 'Entice', 'Kentr', '09000000076', '@gmail.com', '$2y$10$vzZ2Ap8rsscFIYzuYSycN.pfDodzYTC6kpqE0fST4JAZz23StXveO', '2025-04-01 00:14:18', '2025-04-01 00:14:18', 'Pending', '0', 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `fullname`, `mobile`, `balance`, `created_at`, `updated_at`, `users_id`) VALUES
(1, 'Prime LendRow Official', '09000000000', '5,050.00', '2024-12-20 09:33:08', '2025-01-04 22:44:42', 1),
(2, 'Kent Ryan Gonzales Entice', '09100000002', '2,400.00', '2024-12-20 15:25:34', '2025-03-13 05:01:49', 2),
(3, 'Lourdes Mahinay Gonzales', '09690755743', '10,200.00', '2024-12-30 08:44:15', '2025-01-05 02:04:59', 3),
(4, 'Jenard M Yap', '09185567669', '0.00', '2024-12-30 08:53:10', '2025-01-05 02:04:59', 4),
(5, 'Marly G Entice', '09690755742', '100.00', '2025-01-04 01:39:16', '2025-01-14 14:36:30', 5),
(6, 'Rey M Gonzales', '09214086578', '8,300.00', '2025-01-04 01:41:38', '2025-01-12 06:01:43', 6),
(7, 'Kent Ryan a Entice', '09100119667', '0.00', '2025-01-09 02:51:00', '2025-01-09 02:51:00', 7),
(8, 'test test test', '09100000000', '0.00', '2025-01-09 21:28:05', '2025-01-09 23:33:15', 8),
(9, 'Clint Clay Entice', '09100000010', '1,100.00', '2025-02-03 22:44:05', '2025-03-13 05:01:49', 9),
(10, 'a a a', '09100119677', '0.00', '2025-02-17 18:23:19', '2025-02-17 18:23:19', 10),
(11, 'aa aa aa', '09100119633', '0.00', '2025-02-17 18:23:35', '2025-02-17 18:23:35', 11),
(12, 'Clint Clay Clentice', '09374378848', '0.00', '2025-03-13 22:52:38', '2025-03-13 22:52:38', 12),
(13, 'Kent Ryan Gonzaless Entice', '09000000076', '0.00', '2025-04-01 00:14:18', '2025-04-01 00:14:18', 13);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `transfer_method` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `receiver_wallet_id` int(11) DEFAULT NULL,
  `sender_wallet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `sender`, `mobile`, `amount`, `receiver`, `transfer_method`, `created_at`, `receiver_wallet_id`, `sender_wallet_id`) VALUES
(1, 'Prime LendRow', '09000000000', '5,000.00', 'Prime LendRow Official', 'Added', '2024-12-21 08:23:16', 1, 1),
(2, 'Prime LendRow', '09000000000', '1,010.00', 'Prime LendRow Official', 'Refunded', '2024-12-21 09:20:54', 1, 1),
(3, 'Prime LendRow', '09000000000', '110.00', 'Prime LendRow Official', 'Refunded', '2024-12-21 09:32:07', 1, 1),
(4, 'Prime LendRow', '09690755743', '5,000.00', 'Lourdes Mahinay Gonzales', 'Added', '2024-12-30 09:14:06', 3, 1),
(5, 'Prime LendRow', '09690755743', '5,000.00', 'Lourdes Mahinay Gonzales', 'Added', '2024-12-30 09:18:11', 3, 1),
(6, 'Lourdes Mahinay Gonzales', '09690755743', '2,000.00', 'Lourdes Mahinay Gonzales', 'Lending', '2024-12-30 10:18:50', 3, 3),
(7, 'Prime LendRow Official', '09000000000', '500.00', 'Prime LendRow Official', 'Lending', '2024-12-30 11:02:51', 1, 1),
(8, 'Lourdes Mahinay Gonzales', '09185567669', '2,000.00', 'Jenard M Yap', 'Disbursed', '2024-12-30 11:17:25', 4, 3),
(9, 'Prime LendRow', '09100000002', '50.00', 'Kent Ryan Gonzales Entice', 'Added', '2025-01-04 22:43:20', 2, 1),
(10, 'Prime LendRow Official', '09100000002', '500.00', 'Kent Ryan Gonzales Entice', 'Disbursed', '2025-01-04 22:44:24', 2, 1),
(11, 'Kent Ryan Gonzales Entice', '09100000002', '550.00', 'Prime LendRow Official', 'Paid', '2025-01-04 22:44:42', 1, 2),
(12, 'Prime LendRow', '09214086578', '4,000.00', 'Rey M Gonzales', 'Added', '2025-01-05 01:54:47', 6, 1),
(13, 'Prime LendRow', '09214086578', '4,000.00', 'Rey M Gonzales', 'Added', '2025-01-05 01:59:33', 6, 1),
(14, 'Prime LendRow', '09185567669', '200.00', 'Jenard M Yap', 'Added', '2025-01-05 02:04:40', 4, 1),
(15, 'Jenard M Yap', '09185567669', '2,200.00', 'Lourdes Mahinay Gonzales', 'Paid', '2025-01-05 02:04:59', 3, 4),
(16, 'Prime LendRow', '09690755742', '5,000.00', 'Marly G Entice', 'Added', '2025-01-06 02:19:12', 5, 1),
(17, 'Prime LendRow', '09690755742', '3,000.00', 'Marly G Entice', 'Added', '2025-01-06 02:21:45', 5, 1),
(18, 'Marly G Entice', '09690755742', '8,000.00', 'Marly G Entice', 'Lending', '2025-01-08 02:23:44', 5, 5),
(19, 'Rey M Gonzales', '09214086578', '3,000.00', 'Rey M Gonzales', 'Lending', '2025-01-12 02:24:46', 6, 6),
(20, 'Rey M Gonzales', '09100000002', '3,000.00', 'Kent Ryan Gonzales Entice', 'Disbursed', '2025-01-12 02:28:05', 2, 6),
(21, 'Prime LendRow', '09100000002', '200.00', 'Kent Ryan Gonzales Entice', 'Added', '2025-01-12 05:54:56', 2, 1),
(22, 'Prime LendRow', '09100000002', '100.00', 'Kent Ryan Gonzales Entice', 'Added', '2025-01-12 05:55:29', 2, 1),
(23, 'Kent Ryan Gonzales Entice', '09100000002', '3,300.00', 'Rey M Gonzales', 'Paid', '2025-01-13 06:01:43', 6, 2),
(24, 'Prime LendRow', '09100000002', '2,000.00', 'Kent Ryan Gonzales Entice', 'Added', '2025-02-03 22:39:20', 2, 1),
(25, 'Kent Ryan Gonzales Entice', '09100000002', '2,000.00', 'Kent Ryan Gonzales Entice', 'Lending', '2025-02-03 22:40:11', 2, 2),
(26, 'Prime LendRow', '09100000010', '1,000.00', 'Clint Clay Entice', 'Added', '2025-02-03 22:46:00', 9, 1),
(27, 'Clint Clay Entice', '09100000010', '1,000.00', 'Clint Clay Entice', 'Lending', '2025-02-03 22:46:23', 9, 9),
(28, 'Clint Clay Entice', '09100000002', '1,000.00', 'Kent Ryan Gonzales Entice', 'Disbursed', '2025-02-03 22:50:19', 2, 9),
(29, 'Prime LendRow', '09100000002', '100.00', 'Kent Ryan Gonzales Entice', 'Added', '2025-02-03 22:52:26', 2, 1),
(30, 'Prime LendRow', '09690755742', '500.00', 'Marly G Entice', 'Added', '2025-01-14 14:31:45', 5, 1),
(31, 'Kent Ryan Gonzales Entice', '09690755742', '2,000.00', 'Marly G Entice', 'Disbursed', '2025-01-14 14:35:38', 5, 2),
(32, 'Marly G Entice', '09690755742', '1,200.00', 'Kent Ryan Gonzales Entice', 'Paid', '2025-01-14 14:36:25', 2, 5),
(33, 'Marly G Entice', '09690755742', '1,200.00', 'Kent Ryan Gonzales Entice', 'Paid', '2025-01-14 14:36:30', 2, 5),
(34, 'Kent Ryan Gonzales Entice', '09100000002', '1,100.00', 'Clint Clay Entice', 'Paid', '2025-03-13 05:01:49', 9, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_wallet`
--
ALTER TABLE `admin_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_wallet_transactions`
--
ALTER TABLE `admin_wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_wallet_id` (`admin_wallet_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lending_terms_id` (`lending_terms_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `cash_transactions`
--
ALTER TABLE `cash_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_id` (`wallet_id`);

--
-- Indexes for table `financial_details`
--
ALTER TABLE `financial_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lending_terms_id` (`lending_terms_id`),
  ADD KEY `applications_id` (`applications_id`),
  ADD KEY `lending_agreements_id` (`lending_agreements_id`);

--
-- Indexes for table `lending_agreement`
--
ALTER TABLE `lending_agreement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lending_terms_id` (`lending_terms_id`),
  ADD KEY `applications_id` (`applications_id`);

--
-- Indexes for table `lending_terms`
--
ALTER TABLE `lending_terms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver_wallet_id` (`receiver_wallet_id`),
  ADD KEY `sender_wallet_id` (`sender_wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_wallet`
--
ALTER TABLE `admin_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_wallet_transactions`
--
ALTER TABLE `admin_wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cash_transactions`
--
ALTER TABLE `cash_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `financial_details`
--
ALTER TABLE `financial_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lending_agreement`
--
ALTER TABLE `lending_agreement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lending_terms`
--
ALTER TABLE `lending_terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_wallet_transactions`
--
ALTER TABLE `admin_wallet_transactions`
  ADD CONSTRAINT `admin_wallet_transactions_ibfk_1` FOREIGN KEY (`admin_wallet_id`) REFERENCES `admin_wallet` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`lending_terms_id`) REFERENCES `lending_terms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cash_transactions`
--
ALTER TABLE `cash_transactions`
  ADD CONSTRAINT `cash_transactions_ibfk_1` FOREIGN KEY (`wallet_id`) REFERENCES `wallet` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `financial_details`
--
ALTER TABLE `financial_details`
  ADD CONSTRAINT `financial_details_ibfk_1` FOREIGN KEY (`lending_terms_id`) REFERENCES `lending_terms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `financial_details_ibfk_2` FOREIGN KEY (`applications_id`) REFERENCES `applications` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `financial_details_ibfk_3` FOREIGN KEY (`lending_agreements_id`) REFERENCES `lending_agreement` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lending_agreement`
--
ALTER TABLE `lending_agreement`
  ADD CONSTRAINT `lending_agreement_ibfk_1` FOREIGN KEY (`lending_terms_id`) REFERENCES `lending_terms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lending_agreement_ibfk_2` FOREIGN KEY (`applications_id`) REFERENCES `applications` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lending_terms`
--
ALTER TABLE `lending_terms`
  ADD CONSTRAINT `lending_terms_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_ibfk_1` FOREIGN KEY (`receiver_wallet_id`) REFERENCES `wallet` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `wallet_transactions_ibfk_2` FOREIGN KEY (`sender_wallet_id`) REFERENCES `wallet` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
