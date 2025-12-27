-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2025 at 12:06 PM
-- Server version: 8.0.44
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexusflow_wms`
--

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE `billings` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `customer_uid_id` int NOT NULL,
  `company_id` int NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `generated_by` int NOT NULL,
  `generated_date` datetime NOT NULL,
  `extra_charges` int NOT NULL DEFAULT '0',
  `discount` int NOT NULL DEFAULT '0',
  `gate_fee` int NOT NULL DEFAULT '0',
  `note` longtext,
  `invoice_generated` int NOT NULL DEFAULT '0',
  `invoice_generated_by` int NOT NULL DEFAULT '0',
  `invoice_generated_date` datetime DEFAULT NULL,
  `is_paid` int NOT NULL DEFAULT '0',
  `paid_date` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`id`, `customer_id`, `customer_uid_id`, `company_id`, `invoice_number`, `date_from`, `date_to`, `generated_by`, `generated_date`, `extra_charges`, `discount`, `gate_fee`, `note`, `invoice_generated`, `invoice_generated_by`, `invoice_generated_date`, `is_paid`, `paid_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'AGWM-SIV-17671/2025', '2025-12-14', '2025-12-16', 2, '2025-12-17 14:28:54', 0, 0, 0, NULL, 1, 2, '2025-12-22 16:57:49', 0, NULL, '2025-12-17 10:28:54', '2025-12-22 12:57:49'),
(2, 2, 2, 1, 'AGWM-SIV-17672/2025', '2025-12-14', '2025-12-17', 2, '2025-12-17 14:29:23', 10, 0, 0, 'Charging 10 AED extra for Wrong Waste.', 1, 2, '2025-12-18 12:52:03', 0, NULL, '2025-12-17 10:29:24', '2025-12-18 08:52:03'),
(3, 1, 1, 1, 'AGWM-SIV-17673/2025', '2025-12-14', '2025-12-16', 2, '2025-12-18 12:45:55', 0, 0, 0, NULL, 1, 2, '2025-12-18 12:52:02', 1, '2025-12-18 12:58:00', '2025-12-18 08:45:55', '2025-12-18 08:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `billing_details`
--

CREATE TABLE `billing_details` (
  `id` int NOT NULL,
  `billing_id` int NOT NULL,
  `collection_id` int NOT NULL,
  `driver_id` int NOT NULL,
  `helper_ids` longtext NOT NULL,
  `total_price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `billing_details`
--

INSERT INTO `billing_details` (`id`, `billing_id`, `collection_id`, `driver_id`, `helper_ids`, `total_price`) VALUES
(1, 1, 1, 4, '3,5', 55),
(2, 1, 3, 4, '3,5', 75),
(3, 1, 5, 4, '3,5', 55),
(4, 2, 2, 4, '3,5', 40),
(5, 2, 4, 4, '3,5', 40),
(6, 2, 6, 4, '3,5', 40),
(7, 2, 7, 4, '3,5', 40),
(8, 3, 1, 4, '3,5', 55),
(9, 3, 3, 4, '3,5', 75),
(10, 3, 5, 4, '3,5', 55);

-- --------------------------------------------------------

--
-- Table structure for table `billing_detail_skips`
--

CREATE TABLE `billing_detail_skips` (
  `id` int NOT NULL,
  `billing_detail_id` int NOT NULL,
  `waste_type` int NOT NULL,
  `skip_size` varchar(255) NOT NULL,
  `skip_price` varchar(255) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `billing_detail_skips`
--

INSERT INTO `billing_detail_skips` (`id`, `billing_detail_id`, `waste_type`, `skip_size`, `skip_price`, `quantity`) VALUES
(1, 1, 3, '5 CBM', '20', 1),
(2, 1, 1, '10 CBM General Waste / ton', '35', 1),
(3, 2, 3, '5 CBM', '20', 2),
(4, 2, 1, '10 CBM General Waste / ton', '35', 1),
(5, 3, 3, '5 CBM', '20', 1),
(6, 3, 1, '10 CBM General Waste / ton', '35', 1),
(7, 4, 1, '10 CBM General Waste / ton', '40', 1),
(8, 5, 1, '10 CBM General Waste / ton', '40', 1),
(9, 6, 1, '10 CBM General Waste / ton', '40', 1),
(10, 7, 1, '10 CBM General Waste / ton', '40', 1),
(11, 8, 3, '5 CBM', '20', 1),
(12, 8, 1, '10 CBM General Waste / ton', '35', 1),
(13, 9, 3, '5 CBM', '20', 2),
(14, 9, 1, '10 CBM General Waste / ton', '35', 1),
(15, 10, 3, '5 CBM', '20', 1),
(16, 10, 1, '10 CBM General Waste / ton', '35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `billing_municipalities`
--

CREATE TABLE `billing_municipalities` (
  `id` int NOT NULL,
  `billing_id` int NOT NULL,
  `skip_size` varchar(255) NOT NULL,
  `waste_type` int NOT NULL,
  `quantity` varchar(255) NOT NULL DEFAULT '0',
  `price` varchar(255) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `billing_municipalities`
--

INSERT INTO `billing_municipalities` (`id`, `billing_id`, `skip_size`, `waste_type`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '5 CBM', 3, '4', '45', '2025-12-17 10:28:55', '2025-12-17 10:28:55'),
(2, 1, '10 CBM General Waste / ton', 1, '3', '115', '2025-12-17 10:28:56', '2025-12-17 10:28:56'),
(3, 2, '10 CBM General Waste / ton', 1, '4', '115', '2025-12-17 10:29:25', '2025-12-17 10:29:25'),
(4, 3, '5 CBM', 3, '1', '45', '2025-12-18 08:45:55', '2025-12-18 08:45:55'),
(5, 3, '10 CBM General Waste / ton', 1, '3', '115', '2025-12-18 08:45:55', '2025-12-18 08:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `customer_uid_id` int NOT NULL,
  `driver_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `helper_ids` longtext NOT NULL,
  `before_image_guid` longtext NOT NULL,
  `after_image_guid` longtext,
  `status` int NOT NULL DEFAULT '0' COMMENT '1 = collected , 2 = access blocked , 3 = No Waste , 4 = Excess Waste , 5 = Wrong Waste',
  `time_wasted` int NOT NULL DEFAULT '0' COMMENT '0 = No , 1 = Yes',
  `signature_guid` longtext,
  `signatory_name` varchar(255) DEFAULT NULL,
  `pickup_date` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `company_id`, `customer_id`, `customer_uid_id`, `driver_id`, `vehicle_id`, `helper_ids`, `before_image_guid`, `after_image_guid`, `status`, `time_wasted`, `signature_guid`, `signatory_name`, `pickup_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 4, 1, '3,5', '/images/collection_before_pick/before.png', '/images/collection_after_pick/after.jpg', 1, 0, '/images/customer_signature/2025-12-17 07:19:59-signature.png', 'Guard', '2025-12-14 11:25:31', '2025-12-14 07:19:31', '2025-12-17 07:19:59'),
(2, 1, 2, 2, 4, 1, '3,5', '/images/collection_before_pick/before.png', '/images/collection_after_pick/after.jpg', 1, 0, NULL, NULL, '2025-12-14 11:23:24', '2025-12-14 07:23:05', '2025-12-17 07:23:23'),
(3, 1, 1, 1, 4, 1, '3,5', '/images/collection_before_pick/before.png', '/images/collection_after_pick/after.jpg', 4, 0, '/images/customer_signature/2025-12-17 07:19:59-signature.png', 'Guard', '2025-12-15 11:19:59', '2025-12-15 07:11:31', '2025-12-17 07:19:59'),
(4, 1, 2, 2, 4, 1, '3,5', '/images/collection_before_pick/before.png', '/images/collection_after_pick/after.jpg', 5, 0, NULL, NULL, '2025-12-15 11:23:24', '2025-12-15 07:23:05', '2025-12-17 07:23:23'),
(5, 1, 1, 1, 4, 1, '3,5', '/images/collection_before_pick/before.png', '/images/collection_after_pick/after.jpg', 1, 0, '/images/customer_signature/2025-12-17 07:19:59-signature.png', 'Guard', '2025-12-16 11:19:59', '2025-12-16 07:05:31', '2025-12-17 07:19:59'),
(6, 1, 2, 2, 4, 1, '3,5', '/images/collection_before_pick/before.png', '/images/collection_after_pick/after.jpg', 1, 0, NULL, NULL, '2025-12-16 11:23:24', '2025-12-16 07:23:05', '2025-12-17 07:23:23'),
(7, 1, 2, 2, 4, 1, '3,5', '/images/collection_before_pick/before.png', '/images/collection_after_pick/after.jpg', 1, 0, NULL, NULL, '2025-12-17 11:23:24', '2025-12-17 07:23:05', '2025-12-17 07:23:23'),
(8, 1, 1, 1, 4, 1, '3,5', '/images/collection_before_pick/2025-12-18 09:22:24-image.png', '/images/collection_after_pick/2025-12-18 09:22:37-image.png', 4, 0, '/images/customer_signature/2025-12-18 09:23:29-signature.png', 'Guard', '2025-12-18 13:23:29', '2025-12-18 09:21:23', '2025-12-18 09:23:29'),
(9, 1, 1, 1, 6, 1, '3,5', '/images/collection_before_pick/2025-12-18 09:27:09-image.png', '/images/collection_after_pick/2025-12-18 09:27:41-image.png', 1, 0, '/images/customer_signature/2025-12-18 09:28:00-signature.png', 'Usama', '2025-12-18 13:28:00', '2025-12-18 09:27:09', '2025-12-18 09:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `collection_skips`
--

CREATE TABLE `collection_skips` (
  `id` int NOT NULL,
  `collection_id` int NOT NULL,
  `waste_type` int NOT NULL,
  `skip_size` varchar(255) NOT NULL,
  `skip_price` varchar(255) NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `municipality_fee` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `collection_skips`
--

INSERT INTO `collection_skips` (`id`, `collection_id`, `waste_type`, `skip_size`, `skip_price`, `quantity`, `municipality_fee`) VALUES
(1, 1, 3, '5 CBM', '20', 1, '45'),
(2, 1, 1, '10 CBM General Waste / ton', '35', 1, '115'),
(4, 2, 1, '10 CBM General Waste / ton', '40', 1, '115'),
(5, 3, 3, '5 CBM', '20', 2, '45'),
(6, 3, 1, '10 CBM General Waste / ton', '35', 1, '115'),
(7, 4, 1, '10 CBM General Waste / ton', '40', 1, '115'),
(8, 5, 3, '5 CBM', '20', 1, '45'),
(9, 5, 1, '10 CBM General Waste / ton', '35', 1, '115'),
(10, 6, 1, '10 CBM General Waste / ton', '40', 1, '115'),
(11, 7, 1, '10 CBM General Waste / ton', '40', 1, '115'),
(14, 8, 3, '5 CBM', '20', 1, '45'),
(15, 8, 1, '10 CBM General Waste / ton', '35', 2, '115'),
(16, 9, 3, '5 CBM', '20', 1, '45'),
(17, 9, 1, '10 CBM General Waste / ton', '35', 1, '115');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` longtext NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_number` varchar(255) NOT NULL,
  `logo_guid` longtext,
  `stamp_image_guid` longtext,
  `invoice_contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `invoice_phone_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tax_registration_number` varchar(255) DEFAULT NULL,
  `invoice_due_period` int NOT NULL DEFAULT '0',
  `invoice_number_format` varchar(255) DEFAULT NULL,
  `invoice_last_increment_number` int DEFAULT '0',
  `terms_n_conditions` longtext,
  `time_format` int NOT NULL DEFAULT '1' COMMENT ' 1 = 24 , 2 = 12',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` int NOT NULL DEFAULT '0',
  `deleted_by` int NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_address`, `contact_person_name`, `contact_person_number`, `logo_guid`, `stamp_image_guid`, `invoice_contact_person`, `invoice_phone_no`, `tax_registration_number`, `invoice_due_period`, `invoice_number_format`, `invoice_last_increment_number`, `terms_n_conditions`, `time_format`, `created_at`, `updated_at`, `is_deleted`, `deleted_by`, `deleted_at`) VALUES
(1, 'AGFM', 'Garhoud', 'John', '97141234567', '/images/company_logo/AGFM logo.png', '/images/stamp_image/stamp.png', 'Mr Zayed', '971509555373', '100514174000003', 7, 'AGWM-SIV-{i}/{y}', 17673, '<ol><li>Services once provided, has to be paid for.</li><li>Any discrepancies in the invoice, should be notified to us within 7 days from the date of receipt, else it will be considered as correct.</li><li>Payment can be made either by an \"Account Payee\" cheque or remitted to below the mentioned bank account.</li></ol><h3>BANK DETAILS</h3><p><strong>Account Name:</strong> ARABIAN GREEN WASTE MANAGEMENT LLC</p><p><strong>Account No:</strong> 100012249115</p><p><strong>Bank Name:</strong> COMMERCIAL BANK INTERNATIONAL, DUBAI</p><p><strong>IBAN:</strong> AE110200000100012249115</p><p><strong>Swift Code:</strong> CLBIAEAD</p>', 1, '2025-11-05 10:27:09', '2025-12-22 09:14:12', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_skip_settings`
--

CREATE TABLE `company_skip_settings` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `skip_size` varchar(255) NOT NULL,
  `skip_price` varchar(255) NOT NULL,
  `municipality_fee` int NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_skip_settings`
--

INSERT INTO `company_skip_settings` (`id`, `company_id`, `skip_size`, `skip_price`, `municipality_fee`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, '240 L', '10', 40, 0, '2025-11-05 11:07:50', '2025-11-27 06:23:50'),
(2, 1, '1.1 CBM', '12', 40, 0, '2025-11-05 12:29:38', '2025-11-27 06:23:54'),
(3, 1, '2.5 CBM', '15', 45, 0, '2025-11-05 12:29:51', '2025-11-05 12:29:51'),
(4, 1, '5 CBM', '20', 45, 0, '2025-11-05 12:29:56', '2025-11-05 12:29:56'),
(5, 1, '5.5', '25', 55, 0, '2025-11-26 08:35:03', '2025-12-12 12:24:16'),
(7, 1, '180L', '8', 20, 1, '2025-12-12 12:25:31', '2025-12-12 12:25:52'),
(8, 1, '10 CBM General Waste / ton', '1', 115, 0, '2025-12-12 12:32:12', '2025-12-12 12:32:12'),
(9, 1, '10 CBM Construction Waste / ton', '1', 25, 0, '2025-12-12 12:34:46', '2025-12-12 12:34:46'),
(10, 1, '20 CBM General Waste / ton', '1', 115, 0, '2025-12-12 12:35:14', '2025-12-12 12:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `tax_registration_number` varchar(255) DEFAULT NULL,
  `company_id` int NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `po_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `billing_model` int NOT NULL COMMENT '1 = Contract , 2 = Per Pick',
  `schedule` int NOT NULL,
  `skip_provided` int NOT NULL DEFAULT '0' COMMENT '1 = Owned, 2 = Provided',
  `gate_fee` int NOT NULL DEFAULT '0',
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `company_name`, `tax_registration_number`, `company_id`, `client_id`, `phone_no`, `email`, `mobile_no`, `address`, `po_number`, `billing_model`, `schedule`, `skip_provided`, `gate_fee`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Company A', NULL, 1, 'C-AGFM-01', '9711234567', 'companya@nexusflow.me', NULL, 'Garhoud, Dubai', NULL, 1, 1, 1, 0, 0, '2025-12-17 06:46:46', '2025-12-22 09:13:08'),
(2, 'Company B', NULL, 1, 'C-AGFM-02', '9711234567', 'companyb@nexusflow.me', NULL, 'Garhoud, Dubai', NULL, 1, 1, 1, 0, 0, '2025-12-17 06:48:08', '2025-12-17 06:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `customer_skips`
--

CREATE TABLE `customer_skips` (
  `id` int NOT NULL,
  `customer_uid_id` int NOT NULL,
  `waste_type` int NOT NULL,
  `skip_size` varchar(255) NOT NULL,
  `skip_price` varchar(255) NOT NULL,
  `municipality_fee` varchar(255) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_skips`
--

INSERT INTO `customer_skips` (`id`, `customer_uid_id`, `waste_type`, `skip_size`, `skip_price`, `municipality_fee`, `created_at`, `updated_at`) VALUES
(3, 2, 1, '10 CBM General Waste / ton', '40', '115', '2025-12-17 06:48:08', '2025-12-17 06:48:08'),
(26, 1, 3, '5 CBM', '20', '45', '2025-12-22 09:13:08', '2025-12-22 09:13:08'),
(27, 1, 1, '10 CBM General Waste / ton', '35', '35', '2025-12-22 09:13:08', '2025-12-22 09:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `customer_uids`
--

CREATE TABLE `customer_uids` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `tag_uid` varchar(150) NOT NULL,
  `skip_location` varchar(255) NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_uids`
--

INSERT INTO `customer_uids` (`id`, `customer_id`, `location_name`, `tag_uid`, `skip_location`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tower 1', 'E002230508BD0072', 'Garhoud Tower 1', 0, '2025-12-22 07:55:05', '2025-12-22 08:54:09'),
(2, 2, '', 'E00223094CDA8395', 'Al Fattan Plaza', 0, '2025-12-17 06:48:08', '2025-12-17 06:48:08'),
(6, 1, 'fsafdfds', '12345', 'fgfdgf', 1, '2025-12-22 08:25:06', '2025-12-22 09:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `dump_histories`
--

CREATE TABLE `dump_histories` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `driver_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `helper_ids` longtext NOT NULL,
  `weight_meter_image_guid` longtext NOT NULL,
  `weight` int NOT NULL,
  `charges` int NOT NULL,
  `dump_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dump_histories`
--

INSERT INTO `dump_histories` (`id`, `company_id`, `driver_id`, `vehicle_id`, `helper_ids`, `weight_meter_image_guid`, `weight`, `charges`, `dump_date`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, '3,4', '', 10000, 2500, '2025-12-18 17:28:00', '2025-12-23 06:42:10', '2025-12-23 06:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_histories`
--

CREATE TABLE `job_histories` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `driver_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `helper_ids` longtext NOT NULL,
  `job_start_time` datetime NOT NULL,
  `job_start_by` int NOT NULL,
  `job_end_time` datetime DEFAULT NULL,
  `job_end_by` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_histories`
--

INSERT INTO `job_histories` (`id`, `company_id`, `driver_id`, `vehicle_id`, `helper_ids`, `job_start_time`, `job_start_by`, `job_end_time`, `job_end_by`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, '3,5', '2025-12-17 10:58:42', 3, '2025-12-17 11:33:53', 3, '2025-12-17 06:58:42', '2025-12-17 07:33:53'),
(2, 1, 4, 1, '3,5', '2025-12-18 11:36:06', 4, '2025-12-18 11:36:20', 4, '2025-12-18 07:36:06', '2025-12-18 07:36:20'),
(3, 1, 4, 1, '3,5', '2025-12-18 13:20:42', 3, '2025-12-18 13:23:41', 3, '2025-12-18 09:20:42', '2025-12-18 09:23:41'),
(4, 1, 6, 1, '3,5', '2025-12-18 13:26:04', 3, '2025-12-18 13:28:09', 3, '2025-12-18 09:26:04', '2025-12-18 09:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `before` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `after` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `company_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `action`, `model`, `before`, `after`, `user_id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'created', 'Company', NULL, '{\"company_name\":\"Electro 7\",\"company_address\":\"Garhoud\",\"contact_person_name\":\"John\",\"contact_person_number\":\"97141234567\",\"updated_at\":\"2025-11-05 10:27:09\",\"created_at\":\"2025-11-05 10:27:09\",\"id\":1}', 1, 1, '2025-11-05 10:27:09', '2025-11-05 10:27:09'),
(2, 'created', 'User', NULL, '{\"name\":\"Electro 7\",\"email\":\"e7@nexusflow.me\",\"password\":\"$2y$12$GqX0J9h2PubAm9b.OgH5CuvyYxh.CyGkwMuuc\\/g4wX\\/WOOrZgb1dq\",\"is_company\":1,\"company_id\":1,\"updated_at\":\"2025-11-05 10:27:09\",\"created_at\":\"2025-11-05 10:27:09\",\"id\":2}', 1, 1, '2025-11-05 10:27:09', '2025-11-05 10:27:09'),
(3, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"240 L\",\"skip_price\":\"8\",\"company_id\":\"1\",\"updated_at\":\"2025-11-05 11:07:50\",\"created_at\":\"2025-11-05 11:07:50\",\"id\":1}', 2, 1, '2025-11-05 11:07:50', '2025-11-05 11:07:50'),
(4, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"1.1 CBM\",\"skip_price\":\"12\",\"company_id\":\"1\",\"updated_at\":\"2025-11-05 12:29:38\",\"created_at\":\"2025-11-05 12:29:38\",\"id\":2}', 2, 1, '2025-11-05 12:29:38', '2025-11-05 12:29:38'),
(5, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"2.5 CBM\",\"skip_price\":\"15\",\"company_id\":\"1\",\"updated_at\":\"2025-11-05 12:29:51\",\"created_at\":\"2025-11-05 12:29:51\",\"id\":3}', 2, 1, '2025-11-05 12:29:51', '2025-11-05 12:29:51'),
(6, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"5 CBM\",\"skip_price\":\"20\",\"company_id\":\"1\",\"updated_at\":\"2025-11-05 12:29:56\",\"created_at\":\"2025-11-05 12:29:56\",\"id\":4}', 2, 1, '2025-11-05 12:29:56', '2025-11-05 12:29:56'),
(7, 'created', 'Customer', NULL, '{\"company_id\":1,\"client_id\":\"GA125\",\"address\":\"Garhoud Dubai\",\"skip_location\":\"Basement East Exit\",\"billing_model\":\"1\",\"schedule\":\"1\",\"waste_type\":\"1\",\"municipalty_fee\":\"45\",\"updated_at\":\"2025-11-06 11:49:11\",\"created_at\":\"2025-11-06 11:49:11\",\"id\":1}', 2, 1, '2025-11-06 11:49:11', '2025-11-06 11:49:11'),
(8, 'created', 'User', NULL, '{\"name\":\"Helper Subesh\",\"email\":\"subesh@nexusflow.me\",\"password\":\"$2y$12$Zbj0zcPzTNTXIf3wnR170efM6WR6QJhQQgxhJfrlD5GeABlEaxzaK\",\"company_id\":1,\"updated_at\":\"2025-11-07 07:00:49\",\"created_at\":\"2025-11-07 07:00:49\",\"id\":3}', 2, 1, '2025-11-07 07:00:49', '2025-11-07 07:00:49'),
(9, 'updated', 'User', '{\"id\":3,\"name\":\"Helper Subesh\",\"email\":\"subesh@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$Zbj0zcPzTNTXIf3wnR170efM6WR6QJhQQgxhJfrlD5GeABlEaxzaK\",\"remember_token\":null,\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:00:49\",\"updated_at\":\"2025-11-07 07:19:47\"}', '{\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"updated_at\":\"2025-11-07 07:19:47\"}', 2, 1, '2025-11-07 07:19:47', '2025-11-07 07:19:47'),
(10, 'deleted', 'User', '{\"id\":3,\"name\":\"Helper Subesh\",\"email\":\"subesh@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$Zbj0zcPzTNTXIf3wnR170efM6WR6QJhQQgxhJfrlD5GeABlEaxzaK\",\"remember_token\":null,\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"is_company\":0,\"company_id\":1,\"is_deleted\":1,\"created_at\":\"2025-11-07 07:00:49\",\"updated_at\":\"2025-11-07 07:23:08\"}', '{\"is_deleted\":1,\"updated_at\":\"2025-11-07 07:23:08\"}', 2, 1, '2025-11-07 07:23:08', '2025-11-07 07:23:08'),
(11, 'created', 'User', NULL, '{\"name\":\"Driver Rakesh\",\"email\":\"rakesh@nexusflow.me\",\"password\":\"$2y$12$P2MHarDIBwF2Uj5twh67buTJ48OFGyrle.aOWf5kkOfvWdEHO7N9a\",\"company_id\":1,\"updated_at\":\"2025-11-07 07:30:40\",\"created_at\":\"2025-11-07 07:30:40\",\"id\":4}', 2, 1, '2025-11-07 07:30:40', '2025-11-07 07:30:40'),
(12, 'created', 'Vehicle', NULL, '{\"plate_no\":\"AEZ 60511\",\"driver_id\":\"4\",\"vehicle_type\":\"2\",\"contract_type\":\"1\",\"company_id\":1,\"updated_at\":\"2025-11-07 08:01:37\",\"created_at\":\"2025-11-07 08:01:37\",\"id\":1}', 2, 1, '2025-11-07 08:01:37', '2025-11-07 08:01:37'),
(13, 'updated', 'Vehicle', '{\"id\":1,\"company_id\":1,\"driver_id\":\"4\",\"plate_no\":\"AEZ 60512\",\"vehicle_type\":\"2\",\"contract_type\":\"1\",\"is_deleted\":0,\"created_at\":\"2025-11-07 08:01:37\",\"updated_at\":\"2025-11-07 08:07:53\"}', '{\"plate_no\":\"AEZ 60512\",\"updated_at\":\"2025-11-07 08:07:53\"}', 2, 1, '2025-11-07 08:07:53', '2025-11-07 08:07:53'),
(14, 'updated', 'Vehicle', '{\"id\":1,\"company_id\":1,\"driver_id\":\"4\",\"plate_no\":\"AEZ 60512\",\"vehicle_type\":\"2\",\"contract_type\":\"2\",\"is_deleted\":0,\"created_at\":\"2025-11-07 08:01:37\",\"updated_at\":\"2025-11-07 08:08:05\"}', '{\"contract_type\":\"2\",\"updated_at\":\"2025-11-07 08:08:05\"}', 2, 1, '2025-11-07 08:08:05', '2025-11-07 08:08:05'),
(15, 'deleted', 'Vehicle', '{\"id\":1,\"company_id\":1,\"driver_id\":4,\"plate_no\":\"AEZ 60512\",\"vehicle_type\":2,\"contract_type\":2,\"is_deleted\":1,\"created_at\":\"2025-11-07 08:01:37\",\"updated_at\":\"2025-11-07 08:08:36\"}', '{\"is_deleted\":1,\"updated_at\":\"2025-11-07 08:08:36\"}', 2, 1, '2025-11-07 08:08:36', '2025-11-07 08:08:36'),
(16, 'deleted', 'Vehicle', '{\"id\":1,\"company_id\":1,\"driver_id\":4,\"plate_no\":\"AEZ 60512\",\"vehicle_type\":2,\"contract_type\":2,\"is_deleted\":1,\"created_at\":\"2025-11-07 08:01:37\",\"updated_at\":\"2025-11-07 08:09:16\"}', '{\"is_deleted\":1,\"updated_at\":\"2025-11-07 08:09:16\"}', 2, 1, '2025-11-07 08:09:16', '2025-11-07 08:09:16'),
(17, 'created', 'User', NULL, '{\"name\":\"Mukesh Helper\",\"email\":\"mukesh@nexusflow.me\",\"password\":\"$2y$12$JLOw7SyxjIWh4j2kXEq7\\/OHz2BblebLegs4dhDLTM3rMm8Jvqep5O\",\"company_id\":1,\"updated_at\":\"2025-11-12 06:53:22\",\"created_at\":\"2025-11-12 06:53:22\",\"id\":5}', 2, 1, '2025-11-12 06:53:22', '2025-11-12 06:53:22'),
(18, 'created', 'User', NULL, '{\"name\":\"Subhan Driver\",\"email\":\"Subhan@nexusflow.me\",\"password\":\"$2y$12$0B39iXXpnu2iBgJXxF\\/3fumu.RvG7ovblBSPXSuUbTID3bznl7DYC\",\"company_id\":1,\"updated_at\":\"2025-11-12 07:30:03\",\"created_at\":\"2025-11-12 07:30:03\",\"id\":6}', 2, 1, '2025-11-12 07:30:03', '2025-11-12 07:30:03'),
(19, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:29:27\",\"updated_at\":\"2025-11-13 06:29:26\",\"created_at\":\"2025-11-13 06:29:26\",\"id\":1}', 0, 0, '2025-11-13 06:29:26', '2025-11-13 06:29:26'),
(20, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:30:31\",\"updated_at\":\"2025-11-13 06:30:30\",\"created_at\":\"2025-11-13 06:30:30\",\"id\":2}', 0, 0, '2025-11-13 06:30:30', '2025-11-13 06:30:30'),
(21, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:30:42\",\"updated_at\":\"2025-11-13 06:30:40\",\"created_at\":\"2025-11-13 06:30:40\",\"id\":3}', 0, 0, '2025-11-13 06:30:40', '2025-11-13 06:30:40'),
(22, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:31:04\",\"updated_at\":\"2025-11-13 06:31:05\",\"created_at\":\"2025-11-13 06:31:05\",\"id\":4}', 0, 0, '2025-11-13 06:31:05', '2025-11-13 06:31:05'),
(23, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:31:24\",\"updated_at\":\"2025-11-13 06:31:23\",\"created_at\":\"2025-11-13 06:31:23\",\"id\":5}', 0, 0, '2025-11-13 06:31:23', '2025-11-13 06:31:23'),
(24, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:31:33\",\"updated_at\":\"2025-11-13 06:31:31\",\"created_at\":\"2025-11-13 06:31:31\",\"id\":6}', 0, 0, '2025-11-13 06:31:31', '2025-11-13 06:31:31'),
(25, 'created', 'JobHistory', NULL, '{\"company_id\":\"1\",\"driver_id\":\"4\",\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:25:00\",\"updated_at\":\"2025-11-13 06:32:25\",\"created_at\":\"2025-11-13 06:32:25\",\"id\":7}', 0, 0, '2025-11-13 06:32:25', '2025-11-13 06:32:25'),
(26, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:32:43\",\"updated_at\":\"2025-11-13 06:32:42\",\"created_at\":\"2025-11-13 06:32:42\",\"id\":8}', 0, 0, '2025-11-13 06:32:42', '2025-11-13 06:32:42'),
(27, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:33:00\",\"updated_at\":\"2025-11-13 06:32:58\",\"created_at\":\"2025-11-13 06:32:58\",\"id\":9}', 0, 0, '2025-11-13 06:32:58', '2025-11-13 06:32:58'),
(28, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:33:35\",\"updated_at\":\"2025-11-13 06:33:33\",\"created_at\":\"2025-11-13 06:33:33\",\"id\":10}', 0, 0, '2025-11-13 06:33:33', '2025-11-13 06:33:33'),
(29, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:34:51\",\"updated_at\":\"2025-11-13 06:34:49\",\"created_at\":\"2025-11-13 06:34:49\",\"id\":11}', 0, 0, '2025-11-13 06:34:49', '2025-11-13 06:34:49'),
(30, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:34:58\",\"updated_at\":\"2025-11-13 06:34:56\",\"created_at\":\"2025-11-13 06:34:56\",\"id\":12}', 0, 0, '2025-11-13 06:34:56', '2025-11-13 06:34:56'),
(31, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:39:21\",\"updated_at\":\"2025-11-13 06:39:20\",\"created_at\":\"2025-11-13 06:39:20\",\"id\":13}', 0, 0, '2025-11-13 06:39:20', '2025-11-13 06:39:20'),
(32, 'created', 'JobHistory', NULL, '{\"company_id\":\"1\",\"driver_id\":\"4\",\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:25:00\",\"updated_at\":\"2025-11-13 06:39:29\",\"created_at\":\"2025-11-13 06:39:29\",\"id\":14}', 0, 0, '2025-11-13 06:39:29', '2025-11-13 06:39:29'),
(33, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:40:32\",\"updated_at\":\"2025-11-13 06:40:30\",\"created_at\":\"2025-11-13 06:40:30\",\"id\":15}', 0, 0, '2025-11-13 06:40:30', '2025-11-13 06:40:30'),
(34, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 10:44:49\",\"updated_at\":\"2025-11-13 06:44:47\",\"created_at\":\"2025-11-13 06:44:47\",\"id\":1}', 0, 0, '2025-11-13 06:44:47', '2025-11-13 06:44:47'),
(35, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_time\":\"2025-11-13 11:24:28\",\"updated_at\":\"2025-11-13 07:24:26\",\"created_at\":\"2025-11-13 07:24:26\",\"id\":2}', 0, 0, '2025-11-13 07:24:26', '2025-11-13 07:24:26'),
(36, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-13 11:43:11\",\"updated_at\":\"2025-11-13 07:43:10\",\"created_at\":\"2025-11-13 07:43:10\",\"id\":1}', 0, 0, '2025-11-13 07:43:10', '2025-11-13 07:43:10'),
(37, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3\",\"job_start_by\":3,\"job_start_time\":\"2025-11-13 11:44:28\",\"updated_at\":\"2025-11-13 07:44:26\",\"created_at\":\"2025-11-13 07:44:26\",\"id\":2}', 0, 0, '2025-11-13 07:44:26', '2025-11-13 07:44:26'),
(38, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-13 11:54:24\",\"updated_at\":\"2025-11-13 07:54:22\",\"created_at\":\"2025-11-13 07:54:22\",\"id\":1}', 0, 0, '2025-11-13 07:54:22', '2025-11-13 07:54:22'),
(39, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 11:53:41-image.png\",\"updated_at\":\"2025-11-14 11:53:41\",\"created_at\":\"2025-11-14 11:53:41\",\"id\":1}', 0, 0, '2025-11-14 11:53:41', '2025-11-14 11:53:41'),
(40, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 11:57:17-image.png\",\"updated_at\":\"2025-11-14 11:57:17\",\"created_at\":\"2025-11-14 11:57:17\",\"id\":1}', 0, 0, '2025-11-14 11:57:17', '2025-11-14 11:57:17'),
(41, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 11:57:56-image.png\",\"updated_at\":\"2025-11-14 11:57:56\",\"created_at\":\"2025-11-14 11:57:56\",\"id\":2}', 0, 0, '2025-11-14 11:57:56', '2025-11-14 11:57:56'),
(42, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 11:58:54-image.png\",\"updated_at\":\"2025-11-14 11:58:54\",\"created_at\":\"2025-11-14 11:58:54\",\"id\":1}', 0, 0, '2025-11-14 11:58:54', '2025-11-14 11:58:54'),
(43, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 11:59:47-image.png\",\"updated_at\":\"2025-11-14 11:59:47\",\"created_at\":\"2025-11-14 11:59:47\",\"id\":2}', 0, 0, '2025-11-14 11:59:47', '2025-11-14 11:59:47'),
(44, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 12:01:33-facility.png\",\"updated_at\":\"2025-11-14 12:01:33\",\"created_at\":\"2025-11-14 12:01:33\",\"id\":3}', 0, 0, '2025-11-14 12:01:33', '2025-11-14 12:01:33'),
(45, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 12:04:04-facility.png\",\"updated_at\":\"2025-11-14 12:04:04\",\"created_at\":\"2025-11-14 12:04:04\",\"id\":4}', 0, 0, '2025-11-14 12:04:04', '2025-11-14 12:04:04'),
(46, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 12:11:19-facility.png\",\"updated_at\":\"2025-11-14 12:11:19\",\"created_at\":\"2025-11-14 12:11:19\",\"id\":1}', 0, 0, '2025-11-14 12:11:19', '2025-11-14 12:11:19'),
(47, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 12:11:39-image.png\",\"updated_at\":\"2025-11-14 12:11:39\",\"created_at\":\"2025-11-14 12:11:39\",\"id\":1}', 0, 0, '2025-11-14 12:11:39', '2025-11-14 12:11:39'),
(48, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 12:17:29-image.png\",\"updated_at\":\"2025-11-14 12:17:29\",\"created_at\":\"2025-11-14 12:17:29\",\"id\":1}', 0, 0, '2025-11-14 12:17:29', '2025-11-14 12:17:29'),
(49, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 12:39:26-image.png\",\"updated_at\":\"2025-11-14 12:39:26\",\"created_at\":\"2025-11-14 12:39:26\",\"id\":1}', 0, 0, '2025-11-14 12:39:26', '2025-11-14 12:39:26'),
(50, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 12:44:18-image.png\",\"updated_at\":\"2025-11-14 12:44:18\",\"created_at\":\"2025-11-14 12:44:18\",\"id\":1}', 0, 0, '2025-11-14 12:44:18', '2025-11-14 12:44:18'),
(51, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 12:45:03-image.png\",\"updated_at\":\"2025-11-14 12:45:03\",\"created_at\":\"2025-11-14 12:45:03\",\"id\":1}', 0, 0, '2025-11-14 12:45:03', '2025-11-14 12:45:03'),
(52, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-14 13:01:51-image.png\",\"updated_at\":\"2025-11-14 13:01:51\",\"created_at\":\"2025-11-14 13:01:51\",\"id\":1}', 0, 0, '2025-11-14 13:01:51', '2025-11-14 13:01:51'),
(53, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-15 06:39:17-image.png\",\"updated_at\":\"2025-11-15 06:39:17\",\"created_at\":\"2025-11-15 06:39:17\",\"id\":1}', 0, 0, '2025-11-15 06:39:17', '2025-11-15 06:39:17'),
(54, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-15 06:40:30-image.png\",\"updated_at\":\"2025-11-15 06:40:30\",\"created_at\":\"2025-11-15 06:40:30\",\"id\":1}', 0, 0, '2025-11-15 06:40:30', '2025-11-15 06:40:30'),
(55, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-15 06:45:31-image.png\",\"updated_at\":\"2025-11-15 06:45:31\",\"created_at\":\"2025-11-15 06:45:31\",\"id\":1}', 0, 0, '2025-11-15 06:45:31', '2025-11-15 06:45:31'),
(56, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-15 06:49:37-image.png\",\"updated_at\":\"2025-11-15 06:49:37\",\"created_at\":\"2025-11-15 06:49:37\",\"id\":2}', 0, 0, '2025-11-15 06:49:37', '2025-11-15 06:49:37'),
(57, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-15 06:50:02-image.png\",\"updated_at\":\"2025-11-15 06:50:02\",\"created_at\":\"2025-11-15 06:50:02\",\"id\":3}', 0, 0, '2025-11-15 06:50:02', '2025-11-15 06:50:02'),
(58, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-17 10:52:31\",\"updated_at\":\"2025-11-17 06:52:27\",\"created_at\":\"2025-11-17 06:52:27\",\"id\":2}', 0, 0, '2025-11-17 06:52:27', '2025-11-17 06:52:27'),
(59, 'created', 'DumpHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"helper_ids\":\"3,5\",\"vehicle_id\":1,\"weight\":\"1000\",\"charges\":\"45\",\"weight_meter_image_guid\":\"\\/images\\/trash_dump\\/2025-11-17 06:52:41-Rectangle-6.png\",\"updated_at\":\"2025-11-17 06:52:41\",\"created_at\":\"2025-11-17 06:52:41\",\"id\":1}', 0, 0, '2025-11-17 06:52:41', '2025-11-17 06:52:41'),
(60, 'created', 'DumpHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"helper_ids\":\"3,5\",\"vehicle_id\":1,\"weight\":\"1000\",\"charges\":\"45\",\"dump_date\":\"2025-11-17 11:04:41\",\"weight_meter_image_guid\":\"\\/images\\/trash_dump\\/2025-11-17 07:04:37-image.png\",\"updated_at\":\"2025-11-17 07:04:37\",\"created_at\":\"2025-11-17 07:04:37\",\"id\":1}', 0, 0, '2025-11-17 07:04:37', '2025-11-17 07:04:37'),
(61, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-17 11:06:28\",\"updated_at\":\"2025-11-17 07:06:23\",\"created_at\":\"2025-11-17 07:06:23\",\"id\":1}', 0, 0, '2025-11-17 07:06:23', '2025-11-17 07:06:23'),
(62, 'created', 'DumpHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"helper_ids\":\"3,5\",\"vehicle_id\":1,\"weight\":\"1000\",\"charges\":\"45\",\"dump_date\":\"2025-11-17 11:06:37\",\"weight_meter_image_guid\":\"\\/images\\/trash_dump\\/2025-11-17 07:06:33-image.png\",\"updated_at\":\"2025-11-17 07:06:33\",\"created_at\":\"2025-11-17 07:06:33\",\"id\":1}', 0, 0, '2025-11-17 07:06:33', '2025-11-17 07:06:33'),
(63, 'created', 'Customer', NULL, '{\"company_id\":1,\"client_id\":\"CR3-152\",\"tag_uid\":\"1598753\",\"address\":\"Silicon Oasis\",\"skip_location\":\"Basement Exit 1\",\"billing_model\":\"1\",\"schedule\":\"1\",\"waste_type\":\"1\",\"municipalty_fee\":\"45\",\"updated_at\":\"2025-11-18 05:10:37\",\"created_at\":\"2025-11-18 05:10:37\",\"id\":2}', 2, 1, '2025-11-18 05:10:37', '2025-11-18 05:10:37'),
(64, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3\",\"job_start_by\":3,\"job_start_time\":\"2025-11-18 09:15:45\",\"updated_at\":\"2025-11-18 05:15:43\",\"created_at\":\"2025-11-18 05:15:43\",\"id\":2}', 0, 0, '2025-11-18 05:15:43', '2025-11-18 05:15:43'),
(65, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"2\",\"driver_id\":4,\"helper_ids\":\"3\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-18 05:15:55-image.png\",\"updated_at\":\"2025-11-18 05:15:55\",\"created_at\":\"2025-11-18 05:15:55\",\"id\":4}', 0, 0, '2025-11-18 05:15:55', '2025-11-18 05:15:55'),
(66, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 11:08:31\",\"municipality_fee\":\"40\",\"total_bill\":\"96\",\"note\":null,\"updated_at\":\"2025-11-18 11:08:31\",\"created_at\":\"2025-11-18 11:08:31\",\"id\":1}', 2, 1, '2025-11-18 11:08:31', '2025-11-18 11:08:31'),
(67, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 11:08:57\",\"municipality_fee\":\"40\",\"total_bill\":\"96\",\"note\":null,\"updated_at\":\"2025-11-18 11:08:57\",\"created_at\":\"2025-11-18 11:08:57\",\"id\":2}', 2, 1, '2025-11-18 11:08:57', '2025-11-18 11:08:57'),
(68, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 11:10:12\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":null,\"updated_at\":\"2025-11-18 11:10:12\",\"created_at\":\"2025-11-18 11:10:12\",\"id\":1}', 2, 1, '2025-11-18 11:10:12', '2025-11-18 11:10:12'),
(69, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 11:11:52\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":null,\"updated_at\":\"2025-11-18 11:11:52\",\"created_at\":\"2025-11-18 11:11:52\",\"id\":1}', 2, 1, '2025-11-18 11:11:52', '2025-11-18 11:11:52'),
(70, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 11:12:48\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":null,\"updated_at\":\"2025-11-18 11:12:48\",\"created_at\":\"2025-11-18 11:12:48\",\"id\":1}', 2, 1, '2025-11-18 11:12:48', '2025-11-18 11:12:48'),
(71, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 11:14:00\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":null,\"updated_at\":\"2025-11-18 11:14:00\",\"created_at\":\"2025-11-18 11:14:00\",\"id\":1}', 2, 1, '2025-11-18 11:14:00', '2025-11-18 11:14:00'),
(72, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 11:15:40\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":null,\"updated_at\":\"2025-11-18 11:15:40\",\"created_at\":\"2025-11-18 11:15:40\",\"id\":1}', 2, 1, '2025-11-18 11:15:40', '2025-11-18 11:15:40'),
(73, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 11:16:46\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":null,\"updated_at\":\"2025-11-18 11:16:46\",\"created_at\":\"2025-11-18 11:16:46\",\"id\":1}', 2, 1, '2025-11-18 11:16:46', '2025-11-18 11:16:46'),
(74, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 11:17:27\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":null,\"updated_at\":\"2025-11-18 11:17:27\",\"created_at\":\"2025-11-18 11:17:27\",\"id\":1}', 2, 1, '2025-11-18 11:17:27', '2025-11-18 11:17:27'),
(75, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 15:19:55\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":null,\"updated_at\":\"2025-11-18 11:19:55\",\"created_at\":\"2025-11-18 11:19:55\",\"id\":1}', 2, 1, '2025-11-18 11:19:55', '2025-11-18 11:19:55'),
(76, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"generated_by\":1,\"generated_date\":\"2025-11-18 15:20:56\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":\"extra 10 added for wrong waste\",\"updated_at\":\"2025-11-18 11:20:56\",\"created_at\":\"2025-11-18 11:20:56\",\"id\":1}', 2, 1, '2025-11-18 11:20:56', '2025-11-18 11:20:56'),
(77, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":1,\"generated_date\":\"2025-11-18 16:10:27\",\"municipality_fee\":\"40\",\"total_bill\":\"106\",\"note\":\"10 Extra for Wrong Waste\",\"updated_at\":\"2025-11-18 12:10:27\",\"created_at\":\"2025-11-18 12:10:27\",\"id\":1}', 2, 1, '2025-11-18 12:10:27', '2025-11-18 12:10:27'),
(78, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 10:17:35\",\"municipality_fee\":\"40\",\"extra_charges\":\"10\",\"discount\":\"5\",\"note\":\"Extra Charges due to Wrong Waste\",\"updated_at\":\"2025-11-19 06:17:35\",\"created_at\":\"2025-11-19 06:17:35\",\"id\":1}', 2, 1, '2025-11-19 06:17:35', '2025-11-19 06:17:35'),
(79, 'created', 'Billing', NULL, '{\"customer_id\":\"2\",\"company_id\":1,\"date_from\":\"2025-11-18\",\"date_to\":\"2025-11-18\",\"generated_by\":2,\"generated_date\":\"2025-11-19 10:51:45\",\"municipality_fee\":\"45\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-11-19 06:51:45\",\"created_at\":\"2025-11-19 06:51:45\",\"id\":2}', 2, 1, '2025-11-19 06:51:45', '2025-11-19 06:51:45'),
(80, 'created', 'User', NULL, '{\"name\":\"Dawood Finance Manager\",\"email\":\"dawood@nexusflow.me\",\"password\":\"$2y$12$0Sb2qqL4DgEoR0WmQP.1zOfpNMzwt1GUNLU72AX96ujBMWc5WzPtG\",\"company_id\":1,\"updated_at\":\"2025-11-19 07:17:02\",\"created_at\":\"2025-11-19 07:17:02\",\"id\":7}', 2, 1, '2025-11-19 07:17:02', '2025-11-19 07:17:02'),
(81, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":\"40\",\"extra_charges\":\"10\",\"discount\":\"5\",\"note\":\"Extra charge for wrong waste\",\"updated_at\":\"2025-11-19 08:56:51\",\"created_at\":\"2025-11-19 08:56:51\",\"id\":1}', 2, 1, '2025-11-19 08:56:51', '2025-11-19 08:56:51'),
(82, 'updated', 'Billing', '{\"id\":1,\"customer_id\":1,\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":40,\"extra_charges\":10,\"discount\":5,\"note\":\"Extra charge for wrong waste\",\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:24:22\",\"is_paid\":0,\"paid_date\":null,\"created_at\":\"2025-11-19 08:56:51\",\"updated_at\":\"2025-11-19 12:24:22\"}', '{\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:24:22\",\"updated_at\":\"2025-11-19 12:24:22\"}', 7, 1, '2025-11-19 12:24:22', '2025-11-19 12:24:22'),
(83, 'updated', 'Billing', '{\"id\":1,\"customer_id\":1,\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":40,\"extra_charges\":10,\"discount\":5,\"note\":\"Extra charge for wrong waste\",\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:24:54\",\"is_paid\":0,\"paid_date\":null,\"created_at\":\"2025-11-19 08:56:51\",\"updated_at\":\"2025-11-19 12:24:54\"}', '{\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:24:54\",\"updated_at\":\"2025-11-19 12:24:54\"}', 7, 1, '2025-11-19 12:24:54', '2025-11-19 12:24:54'),
(84, 'updated', 'Billing', '{\"id\":1,\"customer_id\":1,\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":40,\"extra_charges\":10,\"discount\":5,\"note\":\"Extra charge for wrong waste\",\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:25:14\",\"is_paid\":0,\"paid_date\":null,\"created_at\":\"2025-11-19 08:56:51\",\"updated_at\":\"2025-11-19 12:25:14\"}', '{\"invoice_generated_date\":\"2025-11-19 16:25:14\",\"updated_at\":\"2025-11-19 12:25:14\"}', 7, 1, '2025-11-19 12:25:14', '2025-11-19 12:25:14'),
(85, 'updated', 'Billing', '{\"id\":1,\"customer_id\":1,\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":40,\"extra_charges\":10,\"discount\":5,\"note\":\"Extra charge for wrong waste\",\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:29:23\",\"is_paid\":0,\"paid_date\":null,\"created_at\":\"2025-11-19 08:56:51\",\"updated_at\":\"2025-11-19 12:29:23\"}', '{\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:29:23\",\"updated_at\":\"2025-11-19 12:29:23\"}', 7, 1, '2025-11-19 12:29:23', '2025-11-19 12:29:23'),
(86, 'updated', 'Billing', '{\"id\":1,\"customer_id\":1,\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":40,\"extra_charges\":10,\"discount\":5,\"note\":\"Extra charge for wrong waste\",\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:29:29\",\"is_paid\":0,\"paid_date\":null,\"created_at\":\"2025-11-19 08:56:51\",\"updated_at\":\"2025-11-19 12:29:29\"}', '{\"invoice_generated_date\":\"2025-11-19 16:29:29\",\"updated_at\":\"2025-11-19 12:29:29\"}', 7, 1, '2025-11-19 12:29:29', '2025-11-19 12:29:29'),
(87, 'updated', 'Billing', '{\"id\":1,\"customer_id\":1,\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":40,\"extra_charges\":10,\"discount\":5,\"note\":\"Extra charge for wrong waste\",\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:33:31\",\"is_paid\":0,\"paid_date\":null,\"created_at\":\"2025-11-19 08:56:51\",\"updated_at\":\"2025-11-19 12:33:31\"}', '{\"invoice_generated_date\":\"2025-11-19 16:33:31\",\"updated_at\":\"2025-11-19 12:33:31\"}', 7, 1, '2025-11-19 12:33:31', '2025-11-19 12:33:31'),
(88, 'updated', 'Billing', '{\"id\":1,\"customer_id\":1,\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":40,\"extra_charges\":10,\"discount\":5,\"note\":\"Extra charge for wrong waste\",\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:33:47\",\"is_paid\":0,\"paid_date\":null,\"created_at\":\"2025-11-19 08:56:51\",\"updated_at\":\"2025-11-19 12:33:47\"}', '{\"invoice_generated_date\":\"2025-11-19 16:33:47\",\"updated_at\":\"2025-11-19 12:33:47\"}', 7, 1, '2025-11-19 12:33:47', '2025-11-19 12:33:47'),
(89, 'updated', 'Billing', '{\"id\":1,\"customer_id\":1,\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":40,\"extra_charges\":10,\"discount\":5,\"note\":\"Extra charge for wrong waste\",\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:34:48\",\"is_paid\":0,\"paid_date\":null,\"created_at\":\"2025-11-19 08:56:51\",\"updated_at\":\"2025-11-19 12:34:48\"}', '{\"invoice_generated_date\":\"2025-11-19 16:34:48\",\"updated_at\":\"2025-11-19 12:34:48\"}', 7, 1, '2025-11-19 12:34:48', '2025-11-19 12:34:48'),
(90, 'updated', 'Billing', '{\"id\":1,\"customer_id\":1,\"company_id\":1,\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":2,\"generated_date\":\"2025-11-19 12:56:51\",\"municipality_fee\":40,\"extra_charges\":10,\"discount\":5,\"note\":\"Extra charge for wrong waste\",\"invoice_generated\":1,\"invoice_generated_by\":7,\"invoice_generated_date\":\"2025-11-19 16:35:32\",\"is_paid\":0,\"paid_date\":null,\"created_at\":\"2025-11-19 08:56:51\",\"updated_at\":\"2025-11-19 12:35:32\"}', '{\"invoice_generated_date\":\"2025-11-19 16:35:32\",\"updated_at\":\"2025-11-19 12:35:32\"}', 7, 1, '2025-11-19 12:35:32', '2025-11-19 12:35:32'),
(91, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17647\\/2025\",\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":7,\"generated_date\":\"2025-11-20 15:33:48\",\"municipality_fee\":\"40\",\"extra_charges\":\"10\",\"discount\":0,\"note\":\"Extra Charge for wrong waste\",\"updated_at\":\"2025-11-20 11:33:48\",\"created_at\":\"2025-11-20 11:33:48\",\"id\":1}', 7, 1, '2025-11-20 11:33:48', '2025-11-20 11:33:48'),
(92, 'created', 'Billing', NULL, '{\"customer_id\":\"2\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17648\\/2025\",\"date_from\":\"2025-11-18\",\"date_to\":\"2025-11-18\",\"generated_by\":7,\"generated_date\":\"2025-11-20 16:55:57\",\"municipality_fee\":\"45\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-11-20 12:55:57\",\"created_at\":\"2025-11-20 12:55:57\",\"id\":2}', 7, 1, '2025-11-20 12:55:57', '2025-11-20 12:55:57'),
(93, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17647\\/2025\",\"date_from\":\"2025-11-13\",\"date_to\":\"2025-11-15\",\"generated_by\":7,\"generated_date\":\"2025-11-20 16:56:55\",\"municipality_fee\":\"40\",\"extra_charges\":\"10\",\"discount\":0,\"note\":\"Extra charge for wrong waste\",\"updated_at\":\"2025-11-20 12:56:55\",\"created_at\":\"2025-11-20 12:56:55\",\"id\":1}', 7, 1, '2025-11-20 12:56:55', '2025-11-20 12:56:55'),
(94, 'created', 'Billing', NULL, '{\"customer_id\":\"2\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17648\\/2025\",\"date_from\":\"2025-11-18\",\"date_to\":\"2025-11-18\",\"generated_by\":7,\"generated_date\":\"2025-11-20 16:57:12\",\"municipality_fee\":\"45\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-11-20 12:57:12\",\"created_at\":\"2025-11-20 12:57:12\",\"id\":2}', 7, 1, '2025-11-20 12:57:12', '2025-11-20 12:57:12'),
(95, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"5\",\"job_start_by\":5,\"job_start_time\":\"2025-11-24 09:37:50\",\"updated_at\":\"2025-11-24 05:37:51\",\"created_at\":\"2025-11-24 05:37:51\",\"id\":3}', 0, 0, '2025-11-24 05:37:51', '2025-11-24 05:37:51'),
(96, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"2\",\"driver_id\":4,\"helper_ids\":\"5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-24 05:39:19-image.png\",\"updated_at\":\"2025-11-24 05:39:19\",\"created_at\":\"2025-11-24 05:39:19\",\"id\":5}', 0, 0, '2025-11-24 05:39:19', '2025-11-24 05:39:19'),
(97, 'created', 'Billing', NULL, '{\"customer_id\":\"2\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17649\\/2025\",\"date_from\":\"2025-11-24\",\"date_to\":\"2025-11-24\",\"generated_by\":2,\"generated_date\":\"2025-11-24 09:48:46\",\"municipality_fee\":\"40\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-11-24 05:48:46\",\"created_at\":\"2025-11-24 05:48:46\",\"id\":3}', 2, 1, '2025-11-24 05:48:46', '2025-11-24 05:48:46'),
(98, 'created', 'Billing', NULL, '{\"customer_id\":\"2\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17650\\/2025\",\"date_from\":\"2025-11-24\",\"date_to\":\"2025-11-24\",\"generated_by\":2,\"generated_date\":\"2025-11-24 09:51:13\",\"municipality_fee\":\"45\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-11-24 05:51:13\",\"created_at\":\"2025-11-24 05:51:13\",\"id\":4}', 2, 1, '2025-11-24 05:51:13', '2025-11-24 05:51:13'),
(99, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"5\",\"job_start_by\":5,\"job_start_time\":\"2025-11-24 11:01:25\",\"updated_at\":\"2025-11-24 07:01:26\",\"created_at\":\"2025-11-24 07:01:26\",\"id\":4}', 0, 0, '2025-11-24 07:01:26', '2025-11-24 07:01:26'),
(100, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"2\",\"driver_id\":4,\"helper_ids\":\"5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-24 07:03:28-image.png\",\"updated_at\":\"2025-11-24 07:03:28\",\"created_at\":\"2025-11-24 07:03:28\",\"id\":6}', 0, 0, '2025-11-24 07:03:28', '2025-11-24 07:03:28'),
(101, 'created', 'Billing', NULL, '{\"customer_id\":\"2\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17651\\/2025\",\"date_from\":\"2025-11-23\",\"date_to\":\"2025-11-24\",\"generated_by\":2,\"generated_date\":\"2025-11-24 11:06:04\",\"municipality_fee\":\"45\",\"extra_charges\":\"10\",\"discount\":0,\"note\":\"Charge of wrong waste\",\"updated_at\":\"2025-11-24 07:06:04\",\"created_at\":\"2025-11-24 07:06:04\",\"id\":5}', 2, 1, '2025-11-24 07:06:04', '2025-11-24 07:06:04'),
(102, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3\",\"job_start_by\":3,\"job_start_time\":\"2025-11-24 11:19:01\",\"updated_at\":\"2025-11-24 07:18:58\",\"created_at\":\"2025-11-24 07:18:58\",\"id\":5}', 0, 0, '2025-11-24 07:18:58', '2025-11-24 07:18:58'),
(103, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"5,3\",\"job_start_by\":4,\"job_start_time\":\"2025-11-24 11:57:23\",\"updated_at\":\"2025-11-24 07:57:24\",\"created_at\":\"2025-11-24 07:57:24\",\"id\":6}', 0, 0, '2025-11-24 07:57:24', '2025-11-24 07:57:24'),
(104, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"2\",\"driver_id\":4,\"helper_ids\":\"5,3\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-24 07:58:48-image.png\",\"updated_at\":\"2025-11-24 07:58:48\",\"created_at\":\"2025-11-24 07:58:48\",\"id\":7}', 0, 0, '2025-11-24 07:58:48', '2025-11-24 07:58:48'),
(105, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"2\",\"driver_id\":4,\"helper_ids\":\"5,3\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-24 08:01:29-image.png\",\"updated_at\":\"2025-11-24 08:01:29\",\"created_at\":\"2025-11-24 08:01:29\",\"id\":8}', 0, 0, '2025-11-24 08:01:29', '2025-11-24 08:01:29'),
(106, 'created', 'Billing', NULL, '{\"customer_id\":\"2\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17652\\/2025\",\"date_from\":\"2025-11-23\",\"date_to\":\"2025-11-24\",\"generated_by\":2,\"generated_date\":\"2025-11-24 12:13:11\",\"municipality_fee\":\"45\",\"extra_charges\":\"15\",\"discount\":0,\"note\":\"Wrong waste\",\"updated_at\":\"2025-11-24 08:13:11\",\"created_at\":\"2025-11-24 08:13:11\",\"id\":6}', 2, 1, '2025-11-24 08:13:11', '2025-11-24 08:13:11'),
(107, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"2\",\"driver_id\":4,\"helper_ids\":\"5,3\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-24 08:32:52-image.png\",\"updated_at\":\"2025-11-24 08:32:52\",\"created_at\":\"2025-11-24 08:32:52\",\"id\":9}', 0, 0, '2025-11-24 08:32:52', '2025-11-24 08:32:52'),
(108, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"driver_id\":4,\"helper_ids\":\"5,3\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-25 09:38:47-image.png\",\"updated_at\":\"2025-11-25 09:38:47\",\"created_at\":\"2025-11-25 09:38:47\",\"id\":10}', 0, 0, '2025-11-25 09:38:47', '2025-11-25 09:38:47'),
(109, 'created', 'Customer', NULL, '{\"company_id\":1,\"company_name\":\"Al Wasl Park\",\"tax_registration_number\":null,\"client_id\":\"Wasl-1\",\"phone_no\":\"00971 50 2477403\",\"email\":\"Info@inetgcc.com\",\"tag_uid\":\"E00223011FE1945C\",\"address\":\"Al Wasl Park 1 , Jumeirah\",\"po_number\":null,\"skip_location\":\"Main Entrance\",\"billing_model\":\"1\",\"schedule\":\"1\",\"waste_type\":\"1\",\"municipality_fee\":\"25\",\"skip_provided\":\"1\",\"updated_at\":\"2025-11-26 07:25:51\",\"created_at\":\"2025-11-26 07:25:51\",\"id\":3}', 2, 1, '2025-11-26 07:25:51', '2025-11-26 07:25:51'),
(110, 'created', 'Vehicle', NULL, '{\"plate_no\":\"D11743\",\"driver_id\":\"6\",\"vehicle_type\":\"1\",\"contract_type\":\"1\",\"company_id\":1,\"updated_at\":\"2025-11-26 07:26:38\",\"created_at\":\"2025-11-26 07:26:38\",\"id\":2}', 2, 1, '2025-11-26 07:26:38', '2025-11-26 07:26:38'),
(111, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-26 11:31:00\",\"updated_at\":\"2025-11-26 07:31:03\",\"created_at\":\"2025-11-26 07:31:03\",\"id\":7}', 0, 0, '2025-11-26 07:31:03', '2025-11-26 07:31:03'),
(112, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":6,\"vehicle_id\":2,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-26 11:32:27\",\"updated_at\":\"2025-11-26 07:32:30\",\"created_at\":\"2025-11-26 07:32:30\",\"id\":8}', 0, 0, '2025-11-26 07:32:30', '2025-11-26 07:32:30'),
(113, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"3\",\"driver_id\":6,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-26 07:34:57-image.png\",\"updated_at\":\"2025-11-26 07:34:57\",\"created_at\":\"2025-11-26 07:34:57\",\"id\":11}', 0, 0, '2025-11-26 07:34:57', '2025-11-26 07:34:57'),
(114, 'created', 'Billing', NULL, '{\"customer_id\":\"3\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17653\\/2025\",\"date_from\":\"2025-11-26\",\"date_to\":\"2025-11-26\",\"generated_by\":2,\"generated_date\":\"2025-11-26 11:38:33\",\"municipality_fee\":\"25\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-11-26 07:38:33\",\"created_at\":\"2025-11-26 07:38:33\",\"id\":7}', 2, 1, '2025-11-26 07:38:33', '2025-11-26 07:38:33'),
(115, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"5.5\",\"skip_price\":\"25\",\"company_id\":\"1\",\"updated_at\":\"2025-11-26 08:35:03\",\"created_at\":\"2025-11-26 08:35:03\",\"id\":5}', 2, 1, '2025-11-26 08:35:03', '2025-11-26 08:35:03'),
(116, 'created', 'Customer', NULL, '{\"company_id\":1,\"company_name\":\"Al Otaiba BLDG\",\"tax_registration_number\":null,\"client_id\":\"OTB-001\",\"phone_no\":\"009712345678\",\"email\":\"test@test.com\",\"tag_uid\":\"E0022309BE92F682\",\"address\":\"Rigga Area\",\"po_number\":null,\"skip_location\":\"Block B\",\"billing_model\":\"1\",\"schedule\":\"2\",\"waste_type\":\"1\",\"municipality_fee\":\"250\",\"skip_provided\":\"1\",\"updated_at\":\"2025-11-26 08:38:43\",\"created_at\":\"2025-11-26 08:38:43\",\"id\":4}', 2, 1, '2025-11-26 08:38:43', '2025-11-26 08:38:43'),
(117, 'created', 'Vehicle', NULL, '{\"plate_no\":\"A1122\",\"driver_id\":\"4\",\"vehicle_type\":\"2\",\"contract_type\":\"1\",\"company_id\":1,\"updated_at\":\"2025-11-26 08:45:46\",\"created_at\":\"2025-11-26 08:45:46\",\"id\":3}', 2, 1, '2025-11-26 08:45:46', '2025-11-26 08:45:46'),
(118, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-26 12:49:05\",\"updated_at\":\"2025-11-26 08:49:08\",\"created_at\":\"2025-11-26 08:49:08\",\"id\":9}', 0, 0, '2025-11-26 08:49:08', '2025-11-26 08:49:08'),
(119, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"4\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-26 08:50:10-image.png\",\"updated_at\":\"2025-11-26 08:50:10\",\"created_at\":\"2025-11-26 08:50:10\",\"id\":12}', 0, 0, '2025-11-26 08:50:10', '2025-11-26 08:50:10'),
(120, 'created', 'Billing', NULL, '{\"customer_id\":\"4\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17654\\/2025\",\"date_from\":\"2025-11-26\",\"date_to\":\"2025-11-26\",\"generated_by\":2,\"generated_date\":\"2025-11-26 12:55:03\",\"municipality_fee\":\"250\",\"extra_charges\":0,\"discount\":0,\"note\":\"customer notification to be sent\",\"updated_at\":\"2025-11-26 08:55:03\",\"created_at\":\"2025-11-26 08:55:03\",\"id\":8}', 2, 1, '2025-11-26 08:55:03', '2025-11-26 08:55:03'),
(121, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"3\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-26 09:20:23-image.png\",\"updated_at\":\"2025-11-26 09:20:23\",\"created_at\":\"2025-11-26 09:20:23\",\"id\":13}', 0, 0, '2025-11-26 09:20:23', '2025-11-26 09:20:23'),
(122, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-27 10:07:55\",\"updated_at\":\"2025-11-27 06:07:55\",\"created_at\":\"2025-11-27 06:07:55\",\"id\":10}', 0, 0, '2025-11-27 06:07:55', '2025-11-27 06:07:55'),
(123, 'created', 'Customer', NULL, '{\"company_id\":1,\"company_name\":\"Dubai National Real Estate\",\"tax_registration_number\":null,\"client_id\":\"GA125\",\"phone_no\":\"971521234567\",\"email\":\"RE@nexusflow.com\",\"address\":\"Garhoud Dubai\",\"po_number\":null,\"billing_model\":\"1\",\"schedule\":\"1\",\"skip_provided\":\"1\",\"updated_at\":\"2025-11-27 11:50:51\",\"created_at\":\"2025-11-27 11:50:51\",\"id\":1}', 2, 1, '2025-11-27 11:50:51', '2025-11-27 11:50:51'),
(124, 'created', 'CustomerUid', NULL, '{\"customer_id\":1,\"tag_uid\":\"148412\",\"skip_location\":\"Basement exit 1\",\"updated_at\":\"2025-11-27 11:50:51\",\"created_at\":\"2025-11-27 11:50:51\",\"id\":1}', 2, 1, '2025-11-27 11:50:51', '2025-11-27 11:50:51'),
(125, 'created', 'Customer', NULL, '{\"company_id\":1,\"company_name\":\"Dubai National Real Estate\",\"tax_registration_number\":null,\"client_id\":\"GA125\",\"phone_no\":\"971521234567\",\"email\":\"RE@nexusflow.com\",\"address\":\"Garhoud Dubai\",\"po_number\":null,\"billing_model\":\"1\",\"schedule\":\"1\",\"skip_provided\":\"1\",\"updated_at\":\"2025-11-27 11:53:12\",\"created_at\":\"2025-11-27 11:53:12\",\"id\":2}', 2, 1, '2025-11-27 11:53:12', '2025-11-27 11:53:12'),
(126, 'created', 'CustomerUid', NULL, '{\"customer_id\":2,\"tag_uid\":\"148412\",\"skip_location\":\"Basement exit 1\",\"updated_at\":\"2025-11-27 11:53:12\",\"created_at\":\"2025-11-27 11:53:12\",\"id\":2}', 2, 1, '2025-11-27 11:53:12', '2025-11-27 11:53:12'),
(127, 'created', 'Customer', NULL, '{\"company_id\":1,\"company_name\":\"Dubai National Real Estate\",\"tax_registration_number\":null,\"client_id\":\"GA125\",\"phone_no\":\"971521234567\",\"email\":\"RE@nexusflow.com\",\"address\":\"Garhoud Dubai\",\"po_number\":null,\"billing_model\":\"1\",\"schedule\":\"1\",\"skip_provided\":\"1\",\"updated_at\":\"2025-11-27 11:54:32\",\"created_at\":\"2025-11-27 11:54:32\",\"id\":1}', 2, 1, '2025-11-27 11:54:32', '2025-11-27 11:54:32'),
(128, 'created', 'CustomerUid', NULL, '{\"customer_id\":1,\"tag_uid\":\"148412\",\"skip_location\":\"Basement exit 1\",\"updated_at\":\"2025-11-27 11:54:32\",\"created_at\":\"2025-11-27 11:54:32\",\"id\":1}', 2, 1, '2025-11-27 11:54:32', '2025-11-27 11:54:32'),
(129, 'created', 'CustomerUid', NULL, '{\"customer_id\":\"1\",\"tag_uid\":\"148412\",\"skip_location\":\"Basement exit 1\",\"updated_at\":\"2025-11-27 12:28:58\",\"created_at\":\"2025-11-27 12:28:58\",\"id\":2}', 2, 1, '2025-11-27 12:28:58', '2025-11-27 12:28:58'),
(130, 'created', 'CustomerUid', NULL, '{\"customer_id\":\"1\",\"tag_uid\":\"148412\",\"skip_location\":\"Basement exit 1\",\"updated_at\":\"2025-11-27 12:29:22\",\"created_at\":\"2025-11-27 12:29:22\",\"id\":3}', 2, 1, '2025-11-27 12:29:22', '2025-11-27 12:29:22'),
(131, 'created', 'CustomerUid', NULL, '{\"customer_id\":\"1\",\"tag_uid\":\"98754\",\"skip_location\":\"Marina\",\"updated_at\":\"2025-11-27 12:29:22\",\"created_at\":\"2025-11-27 12:29:22\",\"id\":4}', 2, 1, '2025-11-27 12:29:22', '2025-11-27 12:29:22');
INSERT INTO `logs` (`id`, `action`, `model`, `before`, `after`, `user_id`, `company_id`, `created_at`, `updated_at`) VALUES
(132, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-28 11:01:53\",\"updated_at\":\"2025-11-28 07:01:53\",\"created_at\":\"2025-11-28 07:01:53\",\"id\":1}', 0, 0, '2025-11-28 07:01:53', '2025-11-28 07:01:53'),
(133, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":2,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-28 11:02:47\",\"updated_at\":\"2025-11-28 07:02:46\",\"created_at\":\"2025-11-28 07:02:46\",\"id\":1}', 0, 0, '2025-11-28 07:02:46', '2025-11-28 07:02:46'),
(134, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-11-28 11:04:40\",\"updated_at\":\"2025-11-28 07:04:39\",\"created_at\":\"2025-11-28 07:04:39\",\"id\":1}', 0, 0, '2025-11-28 07:04:39', '2025-11-28 07:04:39'),
(135, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"customer_uid_id\":\"3\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-28 07:56:05-image.png\",\"updated_at\":\"2025-11-28 07:56:05\",\"created_at\":\"2025-11-28 07:56:05\",\"id\":1}', 0, 0, '2025-11-28 07:56:05', '2025-11-28 07:56:05'),
(136, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"customer_uid_id\":\"3\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-28 08:00:12-image.png\",\"updated_at\":\"2025-11-28 08:00:12\",\"created_at\":\"2025-11-28 08:00:12\",\"id\":1}', 0, 0, '2025-11-28 08:00:12', '2025-11-28 08:00:12'),
(137, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"customer_uid_id\":\"4\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-28 08:12:56-image.png\",\"updated_at\":\"2025-11-28 08:12:56\",\"created_at\":\"2025-11-28 08:12:56\",\"id\":2}', 0, 0, '2025-11-28 08:12:56', '2025-11-28 08:12:56'),
(138, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"customer_uid_id\":\"4\",\"driver_id\":4,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-11-28 08:13:41-image.png\",\"updated_at\":\"2025-11-28 08:13:41\",\"created_at\":\"2025-11-28 08:13:41\",\"id\":3}', 0, 0, '2025-11-28 08:13:41', '2025-11-28 08:13:41'),
(139, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17655\\/2025\",\"date_from\":\"2025-11-28\",\"date_to\":\"2025-11-28\",\"generated_by\":2,\"generated_date\":\"2025-11-28 13:08:07\",\"municipality_fee\":\"0\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-11-28 09:08:07\",\"created_at\":\"2025-11-28 09:08:07\",\"id\":1}', 2, 1, '2025-11-28 09:08:07', '2025-11-28 09:08:07'),
(140, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17656\\/2025\",\"date_from\":\"2025-11-27\",\"date_to\":\"2025-11-28\",\"generated_by\":2,\"generated_date\":\"2025-11-28 13:09:02\",\"municipality_fee\":\"0\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-11-28 09:09:02\",\"created_at\":\"2025-11-28 09:09:02\",\"id\":2}', 2, 1, '2025-11-28 09:09:02', '2025-11-28 09:09:02'),
(141, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17657\\/2025\",\"date_from\":\"2025-11-28\",\"date_to\":\"2025-11-28\",\"generated_by\":2,\"generated_date\":\"2025-12-03 10:36:57\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-03 06:36:57\",\"created_at\":\"2025-12-03 06:36:57\",\"id\":1}', 2, 1, '2025-12-03 06:36:57', '2025-12-03 06:36:57'),
(142, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"1\",\"price\":\"45\",\"updated_at\":\"2025-12-03 06:36:57\",\"created_at\":\"2025-12-03 06:36:57\",\"id\":1}', 2, 1, '2025-12-03 06:36:57', '2025-12-03 06:36:57'),
(143, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-03 06:36:57\",\"created_at\":\"2025-12-03 06:36:57\",\"id\":2}', 2, 1, '2025-12-03 06:36:57', '2025-12-03 06:36:57'),
(144, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17658\\/2025\",\"date_from\":\"2025-11-27\",\"date_to\":\"2025-11-28\",\"generated_by\":2,\"generated_date\":\"2025-12-03 10:37:27\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-03 06:37:27\",\"created_at\":\"2025-12-03 06:37:27\",\"id\":2}', 2, 1, '2025-12-03 06:37:27', '2025-12-03 06:37:27'),
(145, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":2,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"0\",\"price\":\"45\",\"updated_at\":\"2025-12-03 06:37:28\",\"created_at\":\"2025-12-03 06:37:28\",\"id\":3}', 2, 1, '2025-12-03 06:37:28', '2025-12-03 06:37:28'),
(146, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17659\\/2025\",\"date_from\":\"2025-11-28\",\"date_to\":\"2025-11-28\",\"generated_by\":2,\"generated_date\":\"2025-12-03 11:31:56\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-03 07:31:56\",\"created_at\":\"2025-12-03 07:31:56\",\"id\":1}', 2, 1, '2025-12-03 07:31:56', '2025-12-03 07:31:56'),
(147, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"0\",\"price\":\"45\",\"updated_at\":\"2025-12-03 07:31:56\",\"created_at\":\"2025-12-03 07:31:56\",\"id\":1}', 2, 1, '2025-12-03 07:31:56', '2025-12-03 07:31:56'),
(148, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-03 07:31:56\",\"created_at\":\"2025-12-03 07:31:56\",\"id\":2}', 2, 1, '2025-12-03 07:31:56', '2025-12-03 07:31:56'),
(149, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17660\\/2025\",\"date_from\":\"2025-11-27\",\"date_to\":\"2025-11-28\",\"generated_by\":2,\"generated_date\":\"2025-12-03 11:57:02\",\"extra_charges\":\"5\",\"discount\":\"10\",\"note\":null,\"updated_at\":\"2025-12-03 07:57:02\",\"created_at\":\"2025-12-03 07:57:02\",\"id\":2}', 2, 1, '2025-12-03 07:57:02', '2025-12-03 07:57:02'),
(150, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":2,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"2\",\"price\":\"45\",\"updated_at\":\"2025-12-03 07:57:02\",\"created_at\":\"2025-12-03 07:57:02\",\"id\":3}', 2, 1, '2025-12-03 07:57:02', '2025-12-03 07:57:02'),
(151, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"1\",\"price\":\"45\",\"updated_at\":\"2025-12-04 07:21:59\",\"created_at\":\"2025-12-04 07:21:59\",\"id\":4}', 2, 1, '2025-12-04 07:21:59', '2025-12-04 07:21:59'),
(152, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-04 07:21:59\",\"created_at\":\"2025-12-04 07:21:59\",\"id\":5}', 2, 1, '2025-12-04 07:21:59', '2025-12-04 07:21:59'),
(153, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"1\",\"price\":\"45\",\"updated_at\":\"2025-12-04 07:23:18\",\"created_at\":\"2025-12-04 07:23:18\",\"id\":6}', 2, 1, '2025-12-04 07:23:18', '2025-12-04 07:23:18'),
(154, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-04 07:23:18\",\"created_at\":\"2025-12-04 07:23:18\",\"id\":7}', 2, 1, '2025-12-04 07:23:18', '2025-12-04 07:23:18'),
(155, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"1\",\"price\":\"45\",\"updated_at\":\"2025-12-04 07:28:39\",\"created_at\":\"2025-12-04 07:28:39\",\"id\":8}', 2, 1, '2025-12-04 07:28:39', '2025-12-04 07:28:39'),
(156, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-04 07:28:39\",\"created_at\":\"2025-12-04 07:28:39\",\"id\":9}', 2, 1, '2025-12-04 07:28:39', '2025-12-04 07:28:39'),
(157, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17661\\/2025\",\"date_from\":\"2025-11-28\",\"date_to\":\"2025-11-28\",\"generated_by\":2,\"generated_date\":\"2025-12-04 12:30:44\",\"gate_fee\":\"10\",\"extra_charges\":0,\"discount\":\"10\",\"note\":null,\"updated_at\":\"2025-12-04 08:30:44\",\"created_at\":\"2025-12-04 08:30:44\",\"id\":1}', 2, 1, '2025-12-04 08:30:44', '2025-12-04 08:30:44'),
(158, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"0\",\"price\":\"45\",\"updated_at\":\"2025-12-04 08:30:44\",\"created_at\":\"2025-12-04 08:30:44\",\"id\":1}', 2, 1, '2025-12-04 08:30:44', '2025-12-04 08:30:44'),
(159, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-04 08:30:44\",\"created_at\":\"2025-12-04 08:30:44\",\"id\":2}', 2, 1, '2025-12-04 08:30:44', '2025-12-04 08:30:44'),
(160, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"0\",\"price\":\"45\",\"updated_at\":\"2025-12-04 08:31:29\",\"created_at\":\"2025-12-04 08:31:29\",\"id\":3}', 2, 1, '2025-12-04 08:31:29', '2025-12-04 08:31:29'),
(161, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-04 08:31:29\",\"created_at\":\"2025-12-04 08:31:29\",\"id\":4}', 2, 1, '2025-12-04 08:31:29', '2025-12-04 08:31:29'),
(162, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17662\\/2025\",\"date_from\":\"2025-11-27\",\"date_to\":\"2025-11-28\",\"generated_by\":2,\"generated_date\":\"2025-12-04 12:32:42\",\"gate_fee\":\"0\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-04 08:32:42\",\"created_at\":\"2025-12-04 08:32:42\",\"id\":2}', 2, 1, '2025-12-04 08:32:42', '2025-12-04 08:32:42'),
(163, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":2,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"2\",\"price\":\"45\",\"updated_at\":\"2025-12-04 08:32:42\",\"created_at\":\"2025-12-04 08:32:42\",\"id\":5}', 2, 1, '2025-12-04 08:32:42', '2025-12-04 08:32:42'),
(164, 'created', 'DumpHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"helper_ids\":\"3,5\",\"vehicle_id\":1,\"weight\":\"100000\",\"charges\":\"650\",\"dump_date\":\"2025-12-08 16:13:59\",\"weight_meter_image_guid\":\"\\/images\\/trash_dump\\/2025-12-08 12:14:01-image.png\",\"updated_at\":\"2025-12-08 12:14:01\",\"created_at\":\"2025-12-08 12:14:01\",\"id\":1}', 0, 0, '2025-12-08 12:14:01', '2025-12-08 12:14:01'),
(165, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":6,\"vehicle_id\":2,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-12-09 12:13:13\",\"updated_at\":\"2025-12-09 08:13:12\",\"created_at\":\"2025-12-09 08:13:12\",\"id\":3}', 0, 0, '2025-12-09 08:13:12', '2025-12-09 08:13:12'),
(166, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"customer_uid_id\":\"4\",\"driver_id\":6,\"vehicle_id\":2,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-12-09 08:13:31-image.png\",\"updated_at\":\"2025-12-09 08:13:31\",\"created_at\":\"2025-12-09 08:13:31\",\"id\":4}', 0, 0, '2025-12-09 08:13:31', '2025-12-09 08:13:31'),
(167, 'created', 'DumpHistory', NULL, '{\"company_id\":1,\"driver_id\":6,\"helper_ids\":\"3,5\",\"vehicle_id\":2,\"weight\":\"1000\",\"charges\":\"1150\",\"dump_date\":\"2025-12-09 12:14:45\",\"weight_meter_image_guid\":\"\\/images\\/trash_dump\\/2025-12-09 08:14:45-image.png\",\"updated_at\":\"2025-12-09 08:14:45\",\"created_at\":\"2025-12-09 08:14:45\",\"id\":3}', 0, 0, '2025-12-09 08:14:45', '2025-12-09 08:14:45'),
(168, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"customer_uid_id\":\"3\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17663\\/2025\",\"date_from\":\"2025-11-26\",\"date_to\":\"2025-11-26\",\"generated_by\":2,\"generated_date\":\"2025-12-10 10:13:24\",\"gate_fee\":\"10\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-10 06:13:24\",\"created_at\":\"2025-12-10 06:13:24\",\"id\":1}', 2, 1, '2025-12-10 06:13:24', '2025-12-10 06:13:24'),
(169, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"1\",\"price\":\"45\",\"updated_at\":\"2025-12-10 06:13:24\",\"created_at\":\"2025-12-10 06:13:24\",\"id\":1}', 2, 1, '2025-12-10 06:13:24', '2025-12-10 06:13:24'),
(170, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-10 06:13:24\",\"created_at\":\"2025-12-10 06:13:24\",\"id\":2}', 2, 1, '2025-12-10 06:13:24', '2025-12-10 06:13:24'),
(171, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"customer_uid_id\":\"4\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17664\\/2025\",\"date_from\":\"2025-11-27\",\"date_to\":\"2025-12-09\",\"generated_by\":2,\"generated_date\":\"2025-12-10 10:13:35\",\"gate_fee\":\"10\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-10 06:13:35\",\"created_at\":\"2025-12-10 06:13:35\",\"id\":2}', 2, 1, '2025-12-10 06:13:35', '2025-12-10 06:13:35'),
(172, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":2,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"3\",\"price\":\"45\",\"updated_at\":\"2025-12-10 06:13:35\",\"created_at\":\"2025-12-10 06:13:35\",\"id\":3}', 2, 1, '2025-12-10 06:13:35', '2025-12-10 06:13:35'),
(173, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"customer_uid_id\":\"3\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17665\\/2025\",\"date_from\":\"2025-11-26\",\"date_to\":\"2025-11-26\",\"generated_by\":2,\"generated_date\":\"2025-12-10 11:18:09\",\"gate_fee\":\"10\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-10 07:18:09\",\"created_at\":\"2025-12-10 07:18:09\",\"id\":1}', 2, 1, '2025-12-10 07:18:09', '2025-12-10 07:18:09'),
(174, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"1\",\"price\":\"45\",\"updated_at\":\"2025-12-10 07:18:09\",\"created_at\":\"2025-12-10 07:18:09\",\"id\":1}', 2, 1, '2025-12-10 07:18:09', '2025-12-10 07:18:09'),
(175, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-10 07:18:09\",\"created_at\":\"2025-12-10 07:18:09\",\"id\":2}', 2, 1, '2025-12-10 07:18:09', '2025-12-10 07:18:09'),
(176, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"customer_uid_id\":\"4\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17666\\/2025\",\"date_from\":\"2025-11-27\",\"date_to\":\"2025-12-09\",\"generated_by\":2,\"generated_date\":\"2025-12-10 11:18:14\",\"gate_fee\":\"10\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-10 07:18:14\",\"created_at\":\"2025-12-10 07:18:14\",\"id\":2}', 2, 1, '2025-12-10 07:18:14', '2025-12-10 07:18:14'),
(177, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":2,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"3\",\"price\":\"45\",\"updated_at\":\"2025-12-10 07:18:14\",\"created_at\":\"2025-12-10 07:18:14\",\"id\":3}', 2, 1, '2025-12-10 07:18:14', '2025-12-10 07:18:14'),
(178, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"1\",\"price\":\"45\",\"updated_at\":\"2025-12-10 11:28:56\",\"created_at\":\"2025-12-10 11:28:56\",\"id\":4}', 2, 1, '2025-12-10 11:28:56', '2025-12-10 11:28:56'),
(179, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":\"1\",\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-10 11:28:56\",\"created_at\":\"2025-12-10 11:28:56\",\"id\":5}', 2, 1, '2025-12-10 11:28:56', '2025-12-10 11:28:56'),
(180, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"180L\",\"skip_price\":\"8\",\"municipality_fee\":\"20\",\"company_id\":\"1\",\"updated_at\":\"2025-12-12 12:24:41\",\"created_at\":\"2025-12-12 12:24:41\",\"id\":6}', 2, 1, '2025-12-12 12:24:41', '2025-12-12 12:24:41'),
(181, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"180L\",\"skip_price\":\"8\",\"municipality_fee\":\"20\",\"company_id\":\"1\",\"updated_at\":\"2025-12-12 12:25:31\",\"created_at\":\"2025-12-12 12:25:31\",\"id\":7}', 2, 1, '2025-12-12 12:25:31', '2025-12-12 12:25:31'),
(182, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"10 CBM General Waste \\/ ton\",\"skip_price\":\"1\",\"municipality_fee\":\"115\",\"company_id\":\"1\",\"updated_at\":\"2025-12-12 12:32:12\",\"created_at\":\"2025-12-12 12:32:12\",\"id\":8}', 2, 1, '2025-12-12 12:32:12', '2025-12-12 12:32:12'),
(183, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"10 CBM Construction Waste \\/ ton\",\"skip_price\":\"1\",\"municipality_fee\":\"25\",\"company_id\":\"1\",\"updated_at\":\"2025-12-12 12:34:46\",\"created_at\":\"2025-12-12 12:34:46\",\"id\":9}', 2, 1, '2025-12-12 12:34:46', '2025-12-12 12:34:46'),
(184, 'created', 'CompanySkipSetting', NULL, '{\"skip_size\":\"20 CBM General Waste \\/ ton\",\"skip_price\":\"1\",\"municipality_fee\":\"115\",\"company_id\":\"1\",\"updated_at\":\"2025-12-12 12:35:14\",\"created_at\":\"2025-12-12 12:35:14\",\"id\":10}', 2, 1, '2025-12-12 12:35:14', '2025-12-12 12:35:14'),
(185, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"customer_uid_id\":\"3\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17667\\/2025\",\"date_from\":\"2025-11-26\",\"date_to\":\"2025-11-26\",\"generated_by\":2,\"generated_date\":\"2025-12-12 16:43:08\",\"gate_fee\":\"10\",\"extra_charges\":0,\"discount\":\"5\",\"note\":null,\"updated_at\":\"2025-12-12 12:43:08\",\"created_at\":\"2025-12-12 12:43:08\",\"id\":1}', 2, 1, '2025-12-12 12:43:08', '2025-12-12 12:43:08'),
(186, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"2\",\"price\":\"45\",\"updated_at\":\"2025-12-12 12:43:08\",\"created_at\":\"2025-12-12 12:43:08\",\"id\":1}', 2, 1, '2025-12-12 12:43:08', '2025-12-12 12:43:08'),
(187, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"50\",\"updated_at\":\"2025-12-12 12:43:08\",\"created_at\":\"2025-12-12 12:43:08\",\"id\":2}', 2, 1, '2025-12-12 12:43:08', '2025-12-12 12:43:08'),
(188, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"customer_uid_id\":\"4\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17668\\/2025\",\"date_from\":\"2025-11-27\",\"date_to\":\"2025-11-28\",\"generated_by\":2,\"generated_date\":\"2025-12-12 16:58:45\",\"gate_fee\":\"10\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-12 12:58:45\",\"created_at\":\"2025-12-12 12:58:45\",\"id\":2}', 2, 1, '2025-12-12 12:58:45', '2025-12-12 12:58:45'),
(189, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":2,\"skip_size\":\"2.5 CBM\",\"waste_type\":\"1\",\"quantity\":\"2\",\"price\":\"45\",\"updated_at\":\"2025-12-12 12:58:45\",\"created_at\":\"2025-12-12 12:58:45\",\"id\":3}', 2, 1, '2025-12-12 12:58:45', '2025-12-12 12:58:45'),
(190, 'updated', 'User', '{\"id\":3,\"name\":\"Helper Subesh\",\"email\":\"subesh@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$Zbj0zcPzTNTXIf3wnR170efM6WR6QJhQQgxhJfrlD5GeABlEaxzaK\",\"remember_token\":null,\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"working_shift\":\"1\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:00:49\",\"updated_at\":\"2025-12-13 07:23:21\"}', '{\"working_shift\":\"1\",\"updated_at\":\"2025-12-13 07:23:21\"}', 2, 1, '2025-12-13 07:23:21', '2025-12-13 07:23:21'),
(191, 'updated', 'User', '{\"id\":3,\"name\":\"Helper Subesh\",\"email\":\"subesh@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$Zbj0zcPzTNTXIf3wnR170efM6WR6QJhQQgxhJfrlD5GeABlEaxzaK\",\"remember_token\":null,\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"working_shift\":\"3\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:00:49\",\"updated_at\":\"2025-12-13 07:23:43\"}', '{\"working_shift\":\"3\",\"updated_at\":\"2025-12-13 07:23:43\"}', 2, 1, '2025-12-13 07:23:43', '2025-12-13 07:23:43'),
(192, 'updated', 'User', '{\"id\":3,\"name\":\"Helper Subesh\",\"email\":\"subesh@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$Zbj0zcPzTNTXIf3wnR170efM6WR6QJhQQgxhJfrlD5GeABlEaxzaK\",\"remember_token\":null,\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"working_shift\":\"1\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:00:49\",\"updated_at\":\"2025-12-13 07:23:48\"}', '{\"working_shift\":\"1\",\"updated_at\":\"2025-12-13 07:23:48\"}', 2, 1, '2025-12-13 07:23:48', '2025-12-13 07:23:48'),
(193, 'updated', 'User', '{\"id\":3,\"name\":\"Helper One\",\"email\":\"helper1@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$Zbj0zcPzTNTXIf3wnR170efM6WR6QJhQQgxhJfrlD5GeABlEaxzaK\",\"remember_token\":null,\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"working_shift\":\"1\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:00:49\",\"updated_at\":\"2025-12-17 06:34:02\"}', '{\"name\":\"Helper One\",\"email\":\"helper1@nexusflow.me\",\"updated_at\":\"2025-12-17 06:34:02\"}', 2, 1, '2025-12-17 06:34:04', '2025-12-17 06:34:04'),
(194, 'updated', 'User', '{\"id\":5,\"name\":\"Helper Two\",\"email\":\"helper2@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$JLOw7SyxjIWh4j2kXEq7\\/OHz2BblebLegs4dhDLTM3rMm8Jvqep5O\",\"remember_token\":null,\"image_name\":null,\"image_guid\":null,\"working_shift\":\"0\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-12 06:53:22\",\"updated_at\":\"2025-12-17 06:41:56\"}', '{\"name\":\"Helper Two\",\"email\":\"helper2@nexusflow.me\",\"updated_at\":\"2025-12-17 06:41:56\"}', 2, 1, '2025-12-17 06:41:56', '2025-12-17 06:41:56'),
(195, 'updated', 'User', '{\"id\":4,\"name\":\"Driver One\",\"email\":\"driver1@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$P2MHarDIBwF2Uj5twh67buTJ48OFGyrle.aOWf5kkOfvWdEHO7N9a\",\"remember_token\":null,\"image_name\":null,\"image_guid\":null,\"working_shift\":\"0\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:30:40\",\"updated_at\":\"2025-12-17 06:42:16\"}', '{\"name\":\"Driver One\",\"email\":\"driver1@nexusflow.me\",\"updated_at\":\"2025-12-17 06:42:16\"}', 2, 1, '2025-12-17 06:42:16', '2025-12-17 06:42:16'),
(196, 'updated', 'User', '{\"id\":3,\"name\":\"Helper One\",\"email\":\"helper1@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$.YZVl0bpbmgoVdRl67cajeFDd3icDdENv.ED3IHm\\/uo40JcT3Duke\",\"remember_token\":null,\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"working_shift\":\"1\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:00:49\",\"updated_at\":\"2025-12-17 06:42:31\"}', '{\"password\":\"$2y$12$.YZVl0bpbmgoVdRl67cajeFDd3icDdENv.ED3IHm\\/uo40JcT3Duke\",\"updated_at\":\"2025-12-17 06:42:31\"}', 2, 1, '2025-12-17 06:42:31', '2025-12-17 06:42:31'),
(197, 'updated', 'User', '{\"id\":4,\"name\":\"Driver One\",\"email\":\"driver1@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$WZuVd7Ts\\/f2fL9O\\/sf45w.8BrSPUIPrD4ggp9WKueMF2i8XDuwm9e\",\"remember_token\":null,\"image_name\":null,\"image_guid\":null,\"working_shift\":\"0\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:30:40\",\"updated_at\":\"2025-12-17 06:42:43\"}', '{\"password\":\"$2y$12$WZuVd7Ts\\/f2fL9O\\/sf45w.8BrSPUIPrD4ggp9WKueMF2i8XDuwm9e\",\"updated_at\":\"2025-12-17 06:42:43\"}', 2, 1, '2025-12-17 06:42:43', '2025-12-17 06:42:43'),
(198, 'updated', 'User', '{\"id\":5,\"name\":\"Helper Two\",\"email\":\"helper2@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$9vcqx3b4iTrj.j.esnR79.201c9icqYReQeskgM9KVM1AVUvBboPq\",\"remember_token\":null,\"image_name\":null,\"image_guid\":null,\"working_shift\":\"0\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-12 06:53:22\",\"updated_at\":\"2025-12-17 06:42:54\"}', '{\"password\":\"$2y$12$9vcqx3b4iTrj.j.esnR79.201c9icqYReQeskgM9KVM1AVUvBboPq\",\"updated_at\":\"2025-12-17 06:42:54\"}', 2, 1, '2025-12-17 06:42:54', '2025-12-17 06:42:54'),
(199, 'updated', 'User', '{\"id\":6,\"name\":\"Driver Two\",\"email\":\"driver2@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$49JuAhLV.f7okAbE4IBcNuVPWdB\\/TGcyhy4r1Nwa.aEh.S\\/d7ZNwO\",\"remember_token\":null,\"image_name\":null,\"image_guid\":null,\"working_shift\":\"0\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-12 07:30:03\",\"updated_at\":\"2025-12-17 06:43:12\"}', '{\"name\":\"Driver Two\",\"email\":\"driver2@nexusflow.me\",\"password\":\"$2y$12$49JuAhLV.f7okAbE4IBcNuVPWdB\\/TGcyhy4r1Nwa.aEh.S\\/d7ZNwO\",\"updated_at\":\"2025-12-17 06:43:12\"}', 2, 1, '2025-12-17 06:43:12', '2025-12-17 06:43:12'),
(200, 'created', 'Customer', NULL, '{\"company_id\":1,\"company_name\":\"Company A\",\"tax_registration_number\":null,\"client_id\":\"C-AGFM-01\",\"phone_no\":\"9711234567\",\"email\":\"companya@nexusflow.me\",\"address\":\"Garhoud, Dubai\",\"po_number\":null,\"billing_model\":\"1\",\"schedule\":\"1\",\"skip_provided\":\"1\",\"gate_fee\":0,\"updated_at\":\"2025-12-17 06:46:46\",\"created_at\":\"2025-12-17 06:46:46\",\"id\":1}', 2, 1, '2025-12-17 06:46:46', '2025-12-17 06:46:46'),
(201, 'created', 'CustomerUid', NULL, '{\"customer_id\":1,\"tag_uid\":\"E002230508BD0072\",\"skip_location\":\"Garhoud Tower 1\",\"updated_at\":\"2025-12-17 06:46:46\",\"created_at\":\"2025-12-17 06:46:46\",\"id\":1}', 2, 1, '2025-12-17 06:46:46', '2025-12-17 06:46:46'),
(202, 'created', 'Customer', NULL, '{\"company_id\":1,\"company_name\":\"Company B\",\"tax_registration_number\":null,\"client_id\":\"C-AGFM-02\",\"phone_no\":\"9711234567\",\"email\":\"companyb@nexusflow.me\",\"address\":\"Garhoud, Dubai\",\"po_number\":null,\"billing_model\":\"1\",\"schedule\":\"1\",\"skip_provided\":\"1\",\"gate_fee\":0,\"updated_at\":\"2025-12-17 06:48:08\",\"created_at\":\"2025-12-17 06:48:08\",\"id\":2}', 2, 1, '2025-12-17 06:48:08', '2025-12-17 06:48:08'),
(203, 'created', 'CustomerUid', NULL, '{\"customer_id\":2,\"tag_uid\":\"E00223094CDA8395\",\"skip_location\":\"Al Fattan Plaza\",\"updated_at\":\"2025-12-17 06:48:08\",\"created_at\":\"2025-12-17 06:48:08\",\"id\":2}', 2, 1, '2025-12-17 06:48:08', '2025-12-17 06:48:08'),
(204, 'created', 'Vehicle', NULL, '{\"plate_no\":\"DXB12345\",\"driver_id\":\"4\",\"vehicle_type\":\"1\",\"contract_type\":\"1\",\"company_id\":1,\"updated_at\":\"2025-12-17 06:48:36\",\"created_at\":\"2025-12-17 06:48:36\",\"id\":1}', 2, 1, '2025-12-17 06:48:36', '2025-12-17 06:48:36'),
(205, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-12-17 10:58:42\",\"updated_at\":\"2025-12-17 06:58:42\",\"created_at\":\"2025-12-17 06:58:42\",\"id\":1}', 0, 0, '2025-12-17 06:58:42', '2025-12-17 06:58:42'),
(206, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"customer_uid_id\":\"1\",\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-12-17 07:18:31-image.png\",\"updated_at\":\"2025-12-17 07:18:31\",\"created_at\":\"2025-12-17 07:18:31\",\"id\":1}', 0, 0, '2025-12-17 07:18:31', '2025-12-17 07:18:31'),
(207, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"customer_uid_id\":\"1\",\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-12-17 07:19:31-image.png\",\"updated_at\":\"2025-12-17 07:19:31\",\"created_at\":\"2025-12-17 07:19:31\",\"id\":1}', 0, 0, '2025-12-17 07:19:32', '2025-12-17 07:19:32'),
(208, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"2\",\"customer_uid_id\":\"2\",\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-12-17 07:23:05-image.png\",\"updated_at\":\"2025-12-17 07:23:05\",\"created_at\":\"2025-12-17 07:23:05\",\"id\":2}', 0, 0, '2025-12-17 07:23:05', '2025-12-17 07:23:05'),
(209, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"customer_uid_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17669\\/2025\",\"date_from\":\"2025-12-17\",\"date_to\":\"2025-12-17\",\"generated_by\":2,\"generated_date\":\"2025-12-17 11:23:48\",\"gate_fee\":\"0\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-17 07:23:48\",\"created_at\":\"2025-12-17 07:23:48\",\"id\":1}', 2, 1, '2025-12-17 07:23:49', '2025-12-17 07:23:49'),
(210, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"5 CBM\",\"waste_type\":\"3\",\"quantity\":\"0\",\"price\":\"45\",\"updated_at\":\"2025-12-17 07:23:49\",\"created_at\":\"2025-12-17 07:23:49\",\"id\":1}', 2, 1, '2025-12-17 07:23:49', '2025-12-17 07:23:49'),
(211, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"10 CBM General Waste \\/ ton\",\"waste_type\":\"1\",\"quantity\":\"1\",\"price\":\"115\",\"updated_at\":\"2025-12-17 07:23:50\",\"created_at\":\"2025-12-17 07:23:50\",\"id\":2}', 2, 1, '2025-12-17 07:23:50', '2025-12-17 07:23:50'),
(212, 'created', 'Billing', NULL, '{\"customer_id\":\"2\",\"customer_uid_id\":\"2\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17670\\/2025\",\"date_from\":\"2025-12-17\",\"date_to\":\"2025-12-17\",\"generated_by\":2,\"generated_date\":\"2025-12-17 11:25:53\",\"gate_fee\":\"0\",\"extra_charges\":\"10\",\"discount\":0,\"note\":\"10 AED extra charge for wrong waste\",\"updated_at\":\"2025-12-17 07:25:53\",\"created_at\":\"2025-12-17 07:25:53\",\"id\":2}', 2, 1, '2025-12-17 07:25:53', '2025-12-17 07:25:53'),
(213, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":2,\"skip_size\":\"10 CBM General Waste \\/ ton\",\"waste_type\":\"1\",\"quantity\":\"2\",\"price\":\"115\",\"updated_at\":\"2025-12-17 07:25:53\",\"created_at\":\"2025-12-17 07:25:53\",\"id\":3}', 2, 1, '2025-12-17 07:25:53', '2025-12-17 07:25:53'),
(214, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"customer_uid_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17671\\/2025\",\"date_from\":\"2025-12-14\",\"date_to\":\"2025-12-16\",\"generated_by\":2,\"generated_date\":\"2025-12-17 14:28:54\",\"gate_fee\":\"0\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-17 10:28:54\",\"created_at\":\"2025-12-17 10:28:54\",\"id\":1}', 2, 1, '2025-12-17 10:28:55', '2025-12-17 10:28:55'),
(215, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"5 CBM\",\"waste_type\":\"3\",\"quantity\":\"4\",\"price\":\"45\",\"updated_at\":\"2025-12-17 10:28:55\",\"created_at\":\"2025-12-17 10:28:55\",\"id\":1}', 2, 1, '2025-12-17 10:28:56', '2025-12-17 10:28:56'),
(216, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":1,\"skip_size\":\"10 CBM General Waste \\/ ton\",\"waste_type\":\"1\",\"quantity\":\"3\",\"price\":\"115\",\"updated_at\":\"2025-12-17 10:28:56\",\"created_at\":\"2025-12-17 10:28:56\",\"id\":2}', 2, 1, '2025-12-17 10:28:56', '2025-12-17 10:28:56'),
(217, 'created', 'Billing', NULL, '{\"customer_id\":\"2\",\"customer_uid_id\":\"2\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17672\\/2025\",\"date_from\":\"2025-12-14\",\"date_to\":\"2025-12-17\",\"generated_by\":2,\"generated_date\":\"2025-12-17 14:29:23\",\"gate_fee\":\"0\",\"extra_charges\":\"10\",\"discount\":0,\"note\":\"Charging 10 AED extra for Wrong Waste.\",\"updated_at\":\"2025-12-17 10:29:24\",\"created_at\":\"2025-12-17 10:29:24\",\"id\":2}', 2, 1, '2025-12-17 10:29:25', '2025-12-17 10:29:25'),
(218, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":2,\"skip_size\":\"10 CBM General Waste \\/ ton\",\"waste_type\":\"1\",\"quantity\":\"4\",\"price\":\"115\",\"updated_at\":\"2025-12-17 10:29:25\",\"created_at\":\"2025-12-17 10:29:25\",\"id\":3}', 2, 1, '2025-12-17 10:29:26', '2025-12-17 10:29:26'),
(219, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":4,\"job_start_time\":\"2025-12-18 11:36:06\",\"updated_at\":\"2025-12-18 07:36:06\",\"created_at\":\"2025-12-18 07:36:06\",\"id\":2}', 0, 0, '2025-12-18 07:36:06', '2025-12-18 07:36:06'),
(220, 'created', 'Billing', NULL, '{\"customer_id\":\"1\",\"customer_uid_id\":\"1\",\"company_id\":1,\"invoice_number\":\"AGWM-SIV-17673\\/2025\",\"date_from\":\"2025-12-14\",\"date_to\":\"2025-12-16\",\"generated_by\":2,\"generated_date\":\"2025-12-18 12:45:55\",\"gate_fee\":\"0\",\"extra_charges\":0,\"discount\":0,\"note\":null,\"updated_at\":\"2025-12-18 08:45:55\",\"created_at\":\"2025-12-18 08:45:55\",\"id\":3}', 2, 1, '2025-12-18 08:45:55', '2025-12-18 08:45:55'),
(221, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":3,\"skip_size\":\"5 CBM\",\"waste_type\":\"3\",\"quantity\":\"1\",\"price\":\"45\",\"updated_at\":\"2025-12-18 08:45:55\",\"created_at\":\"2025-12-18 08:45:55\",\"id\":4}', 2, 1, '2025-12-18 08:45:55', '2025-12-18 08:45:55'),
(222, 'created', 'BillingMunicipality', NULL, '{\"billing_id\":3,\"skip_size\":\"10 CBM General Waste \\/ ton\",\"waste_type\":\"1\",\"quantity\":\"3\",\"price\":\"115\",\"updated_at\":\"2025-12-18 08:45:55\",\"created_at\":\"2025-12-18 08:45:55\",\"id\":5}', 2, 1, '2025-12-18 08:45:55', '2025-12-18 08:45:55'),
(223, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-12-18 13:20:42\",\"updated_at\":\"2025-12-18 09:20:42\",\"created_at\":\"2025-12-18 09:20:42\",\"id\":3}', 0, 0, '2025-12-18 09:20:42', '2025-12-18 09:20:42'),
(224, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"customer_uid_id\":\"1\",\"driver_id\":4,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-12-18 09:21:23-image.png\",\"updated_at\":\"2025-12-18 09:21:23\",\"created_at\":\"2025-12-18 09:21:23\",\"id\":8}', 0, 0, '2025-12-18 09:21:23', '2025-12-18 09:21:23'),
(225, 'created', 'JobHistory', NULL, '{\"company_id\":1,\"driver_id\":6,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"job_start_by\":3,\"job_start_time\":\"2025-12-18 13:26:04\",\"updated_at\":\"2025-12-18 09:26:04\",\"created_at\":\"2025-12-18 09:26:04\",\"id\":4}', 0, 0, '2025-12-18 09:26:04', '2025-12-18 09:26:04'),
(226, 'created', 'Collection', NULL, '{\"company_id\":\"1\",\"customer_id\":\"1\",\"customer_uid_id\":\"1\",\"driver_id\":6,\"vehicle_id\":1,\"helper_ids\":\"3,5\",\"before_image_guid\":\"\\/images\\/collection_before_pick\\/2025-12-18 09:27:09-image.png\",\"updated_at\":\"2025-12-18 09:27:09\",\"created_at\":\"2025-12-18 09:27:09\",\"id\":9}', 0, 0, '2025-12-18 09:27:09', '2025-12-18 09:27:09'),
(227, 'created', 'CustomerUid', NULL, '{\"customer_id\":\"1\",\"tag_uid\":\"E002230508BD0072\",\"skip_location\":\"Garhoud Tower 1\",\"updated_at\":\"2025-12-22 07:28:42\",\"created_at\":\"2025-12-22 07:28:42\",\"id\":3}', 2, 1, '2025-12-22 07:28:42', '2025-12-22 07:28:42'),
(228, 'created', 'CustomerUid', NULL, '{\"customer_id\":\"1\",\"tag_uid\":\"E002230508BD0072\",\"skip_location\":\"Garhoud Tower 1\",\"updated_at\":\"2025-12-22 07:29:18\",\"created_at\":\"2025-12-22 07:29:18\",\"id\":4}', 2, 1, '2025-12-22 07:29:18', '2025-12-22 07:29:18'),
(229, 'updated', 'User', '{\"id\":3,\"name\":\"Helper One\",\"email\":\"helper1@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$.YZVl0bpbmgoVdRl67cajeFDd3icDdENv.ED3IHm\\/uo40JcT3Duke\",\"remember_token\":null,\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"working_shift\":\"1\",\"mobile_no\":\"0521234567\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:00:49\",\"updated_at\":\"2025-12-22 07:31:20\"}', '{\"mobile_no\":\"0521234567\",\"updated_at\":\"2025-12-22 07:31:20\"}', 2, 1, '2025-12-22 07:31:20', '2025-12-22 07:31:20'),
(230, 'created', 'CustomerUid', NULL, '{\"customer_id\":\"1\",\"tag_uid\":\"E002230508BD0072\",\"skip_location\":\"Garhoud Tower 1\",\"updated_at\":\"2025-12-22 07:55:05\",\"created_at\":\"2025-12-22 07:55:05\",\"id\":5}', 2, 1, '2025-12-22 07:55:05', '2025-12-22 07:55:05'),
(231, 'created', 'CustomerUid', NULL, '{\"customer_id\":\"1\",\"tag_uid\":\"12345\",\"skip_location\":\"fgfdgf\",\"updated_at\":\"2025-12-22 08:25:06\",\"created_at\":\"2025-12-22 08:25:06\",\"id\":6}', 2, 1, '2025-12-22 08:25:06', '2025-12-22 08:25:06'),
(232, 'updated', 'CustomerUid', '{\"id\":6,\"customer_id\":1,\"location_name\":\"fsafdfds\",\"tag_uid\":\"12345\",\"skip_location\":\"fgfdgf\",\"is_deleted\":0,\"created_at\":\"2025-12-22 08:25:06\",\"updated_at\":\"2025-12-22 08:57:20\"}', '{\"location_name\":\"fsafdfds\",\"updated_at\":\"2025-12-22 08:57:20\"}', 2, 1, '2025-12-22 08:57:20', '2025-12-22 08:57:20'),
(233, 'updated', 'User', '{\"id\":3,\"name\":\"subesh\",\"email\":\"helper1@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$.YZVl0bpbmgoVdRl67cajeFDd3icDdENv.ED3IHm\\/uo40JcT3Duke\",\"remember_token\":null,\"image_name\":\"2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"image_guid\":\"\\/images\\/employees\\/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png\",\"working_shift\":\"1\",\"mobile_no\":\"0521234567\",\"is_company\":0,\"company_id\":1,\"is_deleted\":0,\"created_at\":\"2025-11-07 07:00:49\",\"updated_at\":\"2025-12-23 10:49:45\"}', '{\"name\":\"subesh\",\"updated_at\":\"2025-12-23 10:49:45\"}', 2, 1, '2025-12-23 10:49:45', '2025-12-23 10:49:45'),
(234, 'created', 'Customer', NULL, '{\"company_id\":1,\"company_name\":\"Company C\",\"tax_registration_number\":null,\"client_id\":\"GA125\",\"phone_no\":\"9711234567\",\"email\":\"companyc@nexusflow.me\",\"mobile_no\":null,\"address\":\"Silicon\",\"po_number\":null,\"billing_model\":\"1\",\"schedule\":\"1\",\"skip_provided\":\"1\",\"gate_fee\":0,\"updated_at\":\"2025-12-23 10:53:34\",\"created_at\":\"2025-12-23 10:53:34\",\"id\":3}', 2, 1, '2025-12-23 10:53:34', '2025-12-23 10:53:34'),
(235, 'created', 'Customer', NULL, '{\"company_id\":1,\"company_name\":\"Company C\",\"tax_registration_number\":null,\"client_id\":\"GA125\",\"phone_no\":\"9711234567\",\"email\":\"companyc@nexusflow.me\",\"mobile_no\":null,\"address\":\"Silicon\",\"po_number\":null,\"billing_model\":\"1\",\"schedule\":\"1\",\"skip_provided\":\"1\",\"gate_fee\":0,\"updated_at\":\"2025-12-23 10:56:24\",\"created_at\":\"2025-12-23 10:56:24\",\"id\":4}', 2, 1, '2025-12-23 10:56:24', '2025-12-23 10:56:24'),
(236, 'created', 'CustomerUid', NULL, '{\"customer_id\":4,\"location_name\":\"Tower 1\",\"tag_uid\":\"12345\",\"skip_location\":\"basement\",\"updated_at\":\"2025-12-23 10:56:24\",\"created_at\":\"2025-12-23 10:56:24\",\"id\":7}', 2, 1, '2025-12-23 10:56:24', '2025-12-23 10:56:24'),
(237, 'updated', 'CustomerUid', '{\"id\":7,\"customer_id\":4,\"location_name\":\"Tower 3\",\"tag_uid\":\"12345\",\"skip_location\":\"basement\",\"is_deleted\":0,\"created_at\":\"2025-12-23 10:56:24\",\"updated_at\":\"2025-12-23 10:56:38\"}', '{\"location_name\":\"Tower 3\",\"updated_at\":\"2025-12-23 10:56:38\"}', 2, 1, '2025-12-23 10:56:38', '2025-12-23 10:56:38'),
(238, 'created', 'User', NULL, '{\"name\":\"Operation\",\"email\":\"operation@nexusflow.me\",\"mobile_no\":null,\"password\":\"$2y$12$MFTvnwfkicT8jSLb.KBmhO8qJeKkCsAmymxYhJQtezDB6QcIJf876\",\"working_shift\":\"1\",\"company_id\":1,\"updated_at\":\"2025-12-23 10:57:19\",\"created_at\":\"2025-12-23 10:57:19\",\"id\":8}', 2, 1, '2025-12-23 10:57:19', '2025-12-23 10:57:19'),
(239, 'deleted', 'User', '{\"id\":8,\"name\":\"Operation\",\"email\":\"operation@nexusflow.me\",\"email_verified_at\":null,\"password\":\"$2y$12$MFTvnwfkicT8jSLb.KBmhO8qJeKkCsAmymxYhJQtezDB6QcIJf876\",\"remember_token\":null,\"image_name\":null,\"image_guid\":null,\"working_shift\":1,\"mobile_no\":null,\"is_company\":0,\"company_id\":1,\"is_deleted\":1,\"created_at\":\"2025-12-23 10:57:19\",\"updated_at\":\"2025-12-23 10:57:27\"}', '{\"is_deleted\":1,\"updated_at\":\"2025-12-23 10:57:27\"}', 2, 1, '2025-12-23 10:57:27', '2025-12-23 10:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(6, 'App\\Models\\User', 7),
(6, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(2, 'role-create', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(3, 'role-edit', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(4, 'role-delete', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(5, 'user-list', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(6, 'user-create', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(7, 'user-edit', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(8, 'user-delete', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(9, 'company-list', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(10, 'company-create', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(11, 'company-edit', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(12, 'company-delete', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(13, 'invoice-setup', 'web', NULL, NULL),
(14, 'customer-list', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(15, 'customer-create', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(16, 'customer-edit', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(17, 'customer-delete', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(18, 'employee-list', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(19, 'employee-create', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(20, 'employee-edit', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(21, 'employee-delete', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(22, 'employee-profile', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(23, 'vehicle-list', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(24, 'vehicle-create', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(25, 'vehicle-edit', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(26, 'vehicle-delete', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(27, 'billing-list', 'web', '2024-02-21 12:05:20', '2024-02-21 12:05:20'),
(28, 'billing-create', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(29, 'billing-update', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(30, 'invoice-generate', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(31, 'invoice-paid', 'web', '2024-02-21 12:05:21', '2024-02-21 12:05:21'),
(32, 'reporting', 'web', NULL, NULL),
(33, 'skip-setup', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', NULL, NULL),
(2, 'Company', 'web', NULL, NULL),
(3, 'Admin', 'web', '2025-11-06 06:12:33', '2025-11-06 06:12:33'),
(4, 'Helper', 'web', '2025-11-07 06:57:31', '2025-11-07 06:57:31'),
(5, 'Driver', 'web', '2025-11-07 06:57:38', '2025-11-07 06:57:38'),
(6, 'Finance', 'web', '2025-11-19 07:15:53', '2025-11-19 07:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(22, 4),
(22, 5),
(27, 6),
(28, 6),
(30, 6),
(31, 6),
(32, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_guid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `working_shift` int NOT NULL DEFAULT '0',
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_company` int NOT NULL DEFAULT '0',
  `company_id` int NOT NULL DEFAULT '0',
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `image_name`, `image_guid`, `working_shift`, `mobile_no`, `is_company`, `company_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@electro7.com', NULL, '$2y$12$f02YfQqL56fg0kNRdwYsIuBBuic6CYaNxIZlKYffWI91IZWCQScaK', NULL, NULL, NULL, 0, NULL, 0, 0, 0, NULL, NULL),
(2, 'AGFM', 'agfm@nexusflow.me', NULL, '$2y$12$EWn1BWeRVhkzfeQCU80bFuZT5MPcslQPdyeDQ9gWcg49uAAYm4HWi', NULL, NULL, NULL, 0, NULL, 1, 1, 0, '2025-11-05 10:27:09', '2025-12-17 06:21:48'),
(3, 'subesh', 'helper1@nexusflow.me', NULL, '$2y$12$.YZVl0bpbmgoVdRl67cajeFDd3icDdENv.ED3IHm/uo40JcT3Duke', NULL, '2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png', '/images/employees/2025-11-07 07:19:47pakistani-men-wearing-shalwar-kameez-260nw-2277457761.png', 1, '0521234567', 0, 1, 0, '2025-11-07 07:00:49', '2025-12-23 10:49:45'),
(4, 'Driver One', 'driver1@nexusflow.me', NULL, '$2y$12$WZuVd7Ts/f2fL9O/sf45w.8BrSPUIPrD4ggp9WKueMF2i8XDuwm9e', NULL, NULL, NULL, 0, NULL, 0, 1, 0, '2025-11-07 07:30:40', '2025-12-17 06:42:43'),
(5, 'Helper Two', 'helper2@nexusflow.me', NULL, '$2y$12$9vcqx3b4iTrj.j.esnR79.201c9icqYReQeskgM9KVM1AVUvBboPq', NULL, NULL, NULL, 0, NULL, 0, 1, 0, '2025-11-12 06:53:22', '2025-12-17 06:42:54'),
(6, 'Driver Two', 'driver2@nexusflow.me', NULL, '$2y$12$49JuAhLV.f7okAbE4IBcNuVPWdB/TGcyhy4r1Nwa.aEh.S/d7ZNwO', NULL, NULL, NULL, 0, NULL, 0, 1, 0, '2025-11-12 07:30:03', '2025-12-17 06:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `driver_id` int NOT NULL,
  `plate_no` varchar(255) NOT NULL,
  `vehicle_type` int NOT NULL COMMENT '1 = Compactor, 2 = Hook Loader , 3 = Chain Loader',
  `contract_type` int NOT NULL COMMENT '1 = Owned , 2 = Contract',
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `company_id`, `driver_id`, `plate_no`, `vehicle_type`, `contract_type`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'DXB12345', 1, 1, 0, '2025-12-17 06:48:36', '2025-12-17 06:48:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_detail_skips`
--
ALTER TABLE `billing_detail_skips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_municipalities`
--
ALTER TABLE `billing_municipalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_skips`
--
ALTER TABLE `collection_skips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_skip_settings`
--
ALTER TABLE `company_skip_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_skips`
--
ALTER TABLE `customer_skips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_uids`
--
ALTER TABLE `customer_uids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dump_histories`
--
ALTER TABLE `dump_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `job_histories`
--
ALTER TABLE `job_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `billing_details`
--
ALTER TABLE `billing_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `billing_detail_skips`
--
ALTER TABLE `billing_detail_skips`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `billing_municipalities`
--
ALTER TABLE `billing_municipalities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `collection_skips`
--
ALTER TABLE `collection_skips`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_skip_settings`
--
ALTER TABLE `company_skip_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_skips`
--
ALTER TABLE `customer_skips`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customer_uids`
--
ALTER TABLE `customer_uids`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dump_histories`
--
ALTER TABLE `dump_histories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_histories`
--
ALTER TABLE `job_histories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
