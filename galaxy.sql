-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2025 at 06:45 AM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galaxy`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_cities`
--

DROP TABLE IF EXISTS `area_cities`;
CREATE TABLE IF NOT EXISTS `area_cities` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_state_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `area_cities_area_state_id_foreign` (`area_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `area_states`
--

DROP TABLE IF EXISTS `area_states`;
CREATE TABLE IF NOT EXISTS `area_states` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `area_zones`
--

DROP TABLE IF EXISTS `area_zones`;
CREATE TABLE IF NOT EXISTS `area_zones` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_city_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `area_zones_area_city_id_foreign` (`area_city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calenders`
--

DROP TABLE IF EXISTS `calenders`;
CREATE TABLE IF NOT EXISTS `calenders` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` int NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `registerer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calenders_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dls_dlrs`
--

DROP TABLE IF EXISTS `dls_dlrs`;
CREATE TABLE IF NOT EXISTS `dls_dlrs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `security` int NOT NULL,
  `letter_priority` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dls_dlrs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dls_dlr_attachments`
--

DROP TABLE IF EXISTS `dls_dlr_attachments`;
CREATE TABLE IF NOT EXISTS `dls_dlr_attachments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `dls_dlr_id` int UNSIGNED NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dls_dlr_attachments_dls_dlr_id_foreign` (`dls_dlr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dls_dlr_contexts`
--

DROP TABLE IF EXISTS `dls_dlr_contexts`;
CREATE TABLE IF NOT EXISTS `dls_dlr_contexts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `dls_dlr_id` int UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dls_dlr_contexts_dls_dlr_id_foreign` (`dls_dlr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dls_dlr_documents`
--

DROP TABLE IF EXISTS `dls_dlr_documents`;
CREATE TABLE IF NOT EXISTS `dls_dlr_documents` (
  `dls_dlr_id` int UNSIGNED NOT NULL,
  `document_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`document_id`,`dls_dlr_id`),
  KEY `dls_dlr_documents_dls_dlr_id_foreign` (`dls_dlr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dls_dlr_receivers`
--

DROP TABLE IF EXISTS `dls_dlr_receivers`;
CREATE TABLE IF NOT EXISTS `dls_dlr_receivers` (
  `dls_dlr_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`dls_dlr_id`),
  KEY `dls_dlr_receivers_dls_dlr_id_foreign` (`dls_dlr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dls_dlr_referrals`
--

DROP TABLE IF EXISTS `dls_dlr_referrals`;
CREATE TABLE IF NOT EXISTS `dls_dlr_referrals` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `dls_dlr_id` int UNSIGNED NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dls_dlr_referrals_user_id_foreign` (`user_id`),
  KEY `dls_dlr_referrals_dls_dlr_id_foreign` (`dls_dlr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dls_dlr_referral_receivers`
--

DROP TABLE IF EXISTS `dls_dlr_referral_receivers`;
CREATE TABLE IF NOT EXISTS `dls_dlr_referral_receivers` (
  `dls_dlr_referral_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`dls_dlr_referral_id`),
  KEY `dls_dlr_referral_receivers_dls_dlr_referral_id_foreign` (`dls_dlr_referral_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dls_dlr_summaries`
--

DROP TABLE IF EXISTS `dls_dlr_summaries`;
CREATE TABLE IF NOT EXISTS `dls_dlr_summaries` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `dls_dlr_id` int UNSIGNED NOT NULL,
  `hint` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dls_dlr_summaries_dls_dlr_id_foreign` (`dls_dlr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_attachments`
--

DROP TABLE IF EXISTS `document_attachments`;
CREATE TABLE IF NOT EXISTS `document_attachments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_attachments_document_id_foreign` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elrs`
--

DROP TABLE IF EXISTS `elrs`;
CREATE TABLE IF NOT EXISTS `elrs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_entry` datetime NOT NULL,
  `date_of_letter` datetime NOT NULL,
  `security` int NOT NULL,
  `type_of_letter` int NOT NULL,
  `letter_priority` int NOT NULL,
  `number_of_letter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registrar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_attachments`
--

DROP TABLE IF EXISTS `elr_attachments`;
CREATE TABLE IF NOT EXISTS `elr_attachments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `elr_id` int UNSIGNED NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `elr_attachments_elr_id_foreign` (`elr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_contexts`
--

DROP TABLE IF EXISTS `elr_contexts`;
CREATE TABLE IF NOT EXISTS `elr_contexts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `elr_id` int UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `elr_contexts_elr_id_foreign` (`elr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_documents`
--

DROP TABLE IF EXISTS `elr_documents`;
CREATE TABLE IF NOT EXISTS `elr_documents` (
  `elr_id` int UNSIGNED NOT NULL,
  `document_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`document_id`,`elr_id`),
  KEY `elr_documents_elr_id_foreign` (`elr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_receivers`
--

DROP TABLE IF EXISTS `elr_receivers`;
CREATE TABLE IF NOT EXISTS `elr_receivers` (
  `elr_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`elr_id`),
  KEY `elr_receivers_elr_id_foreign` (`elr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_referrals`
--

DROP TABLE IF EXISTS `elr_referrals`;
CREATE TABLE IF NOT EXISTS `elr_referrals` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `elr_id` int UNSIGNED NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `elr_referrals_user_id_foreign` (`user_id`),
  KEY `elr_referrals_elr_id_foreign` (`elr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_referral_receivers`
--

DROP TABLE IF EXISTS `elr_referral_receivers`;
CREATE TABLE IF NOT EXISTS `elr_referral_receivers` (
  `elr_referral_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`elr_referral_id`),
  KEY `elr_referral_receivers_elr_referral_id_foreign` (`elr_referral_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elr_summaries`
--

DROP TABLE IF EXISTS `elr_summaries`;
CREATE TABLE IF NOT EXISTS `elr_summaries` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `elr_id` int UNSIGNED NOT NULL,
  `hint` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `elr_summaries_elr_id_foreign` (`elr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `els`
--

DROP TABLE IF EXISTS `els`;
CREATE TABLE IF NOT EXISTS `els` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `receiver` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_letter` datetime NOT NULL,
  `security` int NOT NULL,
  `type_of_letter` int NOT NULL,
  `letter_priority` int NOT NULL,
  `indicator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registrar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `els_attachments`
--

DROP TABLE IF EXISTS `els_attachments`;
CREATE TABLE IF NOT EXISTS `els_attachments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `els_id` int UNSIGNED NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `els_attachments_els_id_foreign` (`els_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `els_contexts`
--

DROP TABLE IF EXISTS `els_contexts`;
CREATE TABLE IF NOT EXISTS `els_contexts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `els_id` int UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `els_contexts_els_id_foreign` (`els_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `els_documents`
--

DROP TABLE IF EXISTS `els_documents`;
CREATE TABLE IF NOT EXISTS `els_documents` (
  `els_id` int UNSIGNED NOT NULL,
  `document_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`document_id`,`els_id`),
  KEY `els_documents_els_id_foreign` (`els_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `els_senders`
--

DROP TABLE IF EXISTS `els_senders`;
CREATE TABLE IF NOT EXISTS `els_senders` (
  `els_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`els_id`),
  KEY `els_senders_els_id_foreign` (`els_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `els_summaries`
--

DROP TABLE IF EXISTS `els_summaries`;
CREATE TABLE IF NOT EXISTS `els_summaries` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `els_id` int UNSIGNED NOT NULL,
  `hint` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `els_summaries_els_id_foreign` (`els_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fls_flrs`
--

DROP TABLE IF EXISTS `fls_flrs`;
CREATE TABLE IF NOT EXISTS `fls_flrs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fls_flrs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fls_flr_attachments`
--

DROP TABLE IF EXISTS `fls_flr_attachments`;
CREATE TABLE IF NOT EXISTS `fls_flr_attachments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fls_flr_id` int UNSIGNED NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fls_flr_attachments_fls_flr_id_foreign` (`fls_flr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fls_flr_receivers`
--

DROP TABLE IF EXISTS `fls_flr_receivers`;
CREATE TABLE IF NOT EXISTS `fls_flr_receivers` (
  `fls_flr_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`fls_flr_id`),
  KEY `fls_flr_receivers_fls_flr_id_foreign` (`fls_flr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fls_flr_senders`
--

DROP TABLE IF EXISTS `fls_flr_senders`;
CREATE TABLE IF NOT EXISTS `fls_flr_senders` (
  `fls_flr_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`fls_flr_id`),
  KEY `fls_flr_senders_fls_flr_id_foreign` (`fls_flr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ils_ilrs`
--

DROP TABLE IF EXISTS `ils_ilrs`;
CREATE TABLE IF NOT EXISTS `ils_ilrs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `security` int NOT NULL,
  `letter_priority` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ils_ilrs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ils_ilr_attachments`
--

DROP TABLE IF EXISTS `ils_ilr_attachments`;
CREATE TABLE IF NOT EXISTS `ils_ilr_attachments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ils_ilr_id` int UNSIGNED NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ils_ilr_attachments_ils_ilr_id_foreign` (`ils_ilr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ils_ilr_contexts`
--

DROP TABLE IF EXISTS `ils_ilr_contexts`;
CREATE TABLE IF NOT EXISTS `ils_ilr_contexts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ils_ilr_id` int UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ils_ilr_contexts_ils_ilr_id_foreign` (`ils_ilr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ils_ilr_documents`
--

DROP TABLE IF EXISTS `ils_ilr_documents`;
CREATE TABLE IF NOT EXISTS `ils_ilr_documents` (
  `ils_ilr_id` int UNSIGNED NOT NULL,
  `document_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`document_id`,`ils_ilr_id`),
  KEY `ils_ilr_documents_ils_ilr_id_foreign` (`ils_ilr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ils_ilr_receivers`
--

DROP TABLE IF EXISTS `ils_ilr_receivers`;
CREATE TABLE IF NOT EXISTS `ils_ilr_receivers` (
  `ils_ilr_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`ils_ilr_id`),
  KEY `ils_ilr_receivers_ils_ilr_id_foreign` (`ils_ilr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ils_ilr_referrals`
--

DROP TABLE IF EXISTS `ils_ilr_referrals`;
CREATE TABLE IF NOT EXISTS `ils_ilr_referrals` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `ils_ilr_id` int UNSIGNED NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ils_ilr_referrals_user_id_foreign` (`user_id`),
  KEY `ils_ilr_referrals_ils_ilr_id_foreign` (`ils_ilr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ils_ilr_referral_receivers`
--

DROP TABLE IF EXISTS `ils_ilr_referral_receivers`;
CREATE TABLE IF NOT EXISTS `ils_ilr_referral_receivers` (
  `ils_ilr_referral_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`ils_ilr_referral_id`),
  KEY `ils_ilr_referral_receivers_ils_ilr_referral_id_foreign` (`ils_ilr_referral_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ils_ilr_summaries`
--

DROP TABLE IF EXISTS `ils_ilr_summaries`;
CREATE TABLE IF NOT EXISTS `ils_ilr_summaries` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ils_ilr_id` int UNSIGNED NOT NULL,
  `hint` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ils_ilr_summaries_ils_ilr_id_foreign` (`ils_ilr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_classifications`
--

DROP TABLE IF EXISTS `job_classifications`;
CREATE TABLE IF NOT EXISTS `job_classifications` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_hierarchicals`
--

DROP TABLE IF EXISTS `job_hierarchicals`;
CREATE TABLE IF NOT EXISTS `job_hierarchicals` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `rank` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_positions`
--

DROP TABLE IF EXISTS `job_positions`;
CREATE TABLE IF NOT EXISTS `job_positions` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_hierarchical_id` int UNSIGNED NOT NULL,
  `job_classification_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_positions_job_hierarchical_id_foreign` (`job_hierarchical_id`),
  KEY `job_positions_job_classification_id_foreign` (`job_classification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_rulings`
--

DROP TABLE IF EXISTS `job_rulings`;
CREATE TABLE IF NOT EXISTS `job_rulings` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_rulings_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_ruling_positions`
--

DROP TABLE IF EXISTS `job_ruling_positions`;
CREATE TABLE IF NOT EXISTS `job_ruling_positions` (
  `user_id` int UNSIGNED NOT NULL,
  `job_position_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`job_position_id`),
  KEY `job_ruling_positions_job_position_id_foreign` (`job_position_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_ruling_shifts`
--

DROP TABLE IF EXISTS `job_ruling_shifts`;
CREATE TABLE IF NOT EXISTS `job_ruling_shifts` (
  `user_id` int UNSIGNED NOT NULL,
  `job_shift_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`job_shift_id`),
  KEY `job_ruling_shifts_job_shift_id_foreign` (`job_shift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_shifts`
--

DROP TABLE IF EXISTS `job_shifts`;
CREATE TABLE IF NOT EXISTS `job_shifts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '00_00_00_0000000_create_users_table', 1),
(2, '00_00_00_0000001_create_password_resets_table', 1),
(3, '00_00_00_0000002_create_smsirlaravel_log_table', 1),
(4, '00_00_00_0000003_create_user_infos_table', 1),
(5, '00_00_00_0000004_create_permissions_table', 1),
(6, '00_00_00_0000005_create_user_permissions_table', 1),
(7, '00_00_00_0000006_create_notifications_table', 1),
(8, '00_00_00_0000007_create_calenders_table', 1),
(9, '00_00_01_00000010_create_documents_table', 1),
(10, '00_00_01_00000011_create_document_attachments_table', 1),
(11, '00_00_01_00000012_create_els_table', 1),
(12, '00_00_01_00000013_create_els_attachments_table', 1),
(13, '00_00_01_00000014_create_els_contexts_table', 1),
(14, '00_00_01_00000015_create_els_documents_table', 1),
(15, '00_00_01_00000016_create_els_summaries_table', 1),
(16, '00_00_01_00000017_create_els_senders_table', 1),
(17, '00_00_01_00000018_create_elrs_table', 1),
(18, '00_00_01_00000019_create_elr_attachments_table', 1),
(19, '00_00_01_0000001_create_job_classifications_table', 1),
(20, '00_00_01_00000020_create_elr_contexts_table', 1),
(21, '00_00_01_00000021_create_elr_receivers_table', 1),
(22, '00_00_01_00000022_create_elr_summaries_table', 1),
(23, '00_00_01_00000023_create_elr_documents_table', 1),
(24, '00_00_01_00000024_create_elr_referrals_table', 1),
(25, '00_00_01_00000025_create_elr_referral_receivers_table', 1),
(26, '00_00_01_00000026_create_ils_ilrs_table', 1),
(27, '00_00_01_00000027_create_ils_ilr_attachments_table', 1),
(28, '00_00_01_00000028_create_ils_ilr_contexts_table', 1),
(29, '00_00_01_00000029_create_ils_ilr_documents_table', 1),
(30, '00_00_01_0000002_create_job_hierarchicals_table', 1),
(31, '00_00_01_00000030_create_ils_ilr_receivers_table', 1),
(32, '00_00_01_00000031_create_ils_ilr_summaries_table', 1),
(33, '00_00_01_00000032_create_ils_ilr_referrals_table', 1),
(34, '00_00_01_00000033_create_ils_ilr_referral_receivers_table', 1),
(35, '00_00_01_00000034_create_dls_dlrs_table', 1),
(36, '00_00_01_00000035_create_dls_dlr_attachments_table', 1),
(37, '00_00_01_00000036_create_dls_dlr_contexts_table', 1),
(38, '00_00_01_00000037_create_dls_dlr_documents_table', 1),
(39, '00_00_01_00000038_create_dls_dlr_receivers_table', 1),
(40, '00_00_01_00000039_create_dls_dlr_referrals_table', 1),
(41, '00_00_01_0000003_create_job_positions_table', 1),
(42, '00_00_01_00000040_create_dls_dlr_referral_receivers_table', 1),
(43, '00_00_01_00000041_create_dls_dlr_summaries_table', 1),
(44, '00_00_01_00000042_create_mls_mlrs_table', 1),
(45, '00_00_01_00000043_create_mls_mlr_receivers_table', 1),
(46, '00_00_01_00000044_create_fls_flrs_table', 1),
(47, '00_00_01_00000045_create_fls_flr_attachments_table', 1),
(48, '00_00_01_00000046_create_fls_flr_receivers_table', 1),
(49, '00_00_01_00000047_create_fls_flr_senders_table', 1),
(50, '00_00_01_0000004_create_job_shifts_table', 1),
(51, '00_00_01_0000005_create_job_rulings_table', 1),
(52, '00_00_01_0000006_create_job_ruling_positions_table', 1),
(53, '00_00_01_0000007_create_job_ruling_shifts_table', 1),
(54, '00_00_01_0000008_create_secretaries_table', 1),
(55, '00_00_01_0000009_create_secretary_ports_table', 1),
(56, '00_00_02_00000001_create_area_states_table', 1),
(57, '00_00_02_00000002_create_area_cities_table', 1),
(58, '00_00_02_00000003_create_area_zones_table', 1),
(59, '00_00_02_00000004_create_page_languages_table', 1),
(60, '00_00_02_00000005_create_page_templates_table', 1),
(61, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(62, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(63, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(64, '2016_06_01_000004_create_oauth_clients_table', 1),
(65, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mls_mlrs`
--

DROP TABLE IF EXISTS `mls_mlrs`;
CREATE TABLE IF NOT EXISTS `mls_mlrs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `context` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mls_mlrs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mls_mlr_receivers`
--

DROP TABLE IF EXISTS `mls_mlr_receivers`;
CREATE TABLE IF NOT EXISTS `mls_mlr_receivers` (
  `mls_mlr_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`mls_mlr_id`),
  KEY `mls_mlr_receivers_mls_mlr_id_foreign` (`mls_mlr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispatch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `client_id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `client_id` int UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Vira Personal Access Client', 'fKK5Bw8Bap8xpvGSc1ztK7WQSmecYRm4zwIF7hbO', 'http://localhost', 1, 0, 0, '2020-01-01 13:05:05', '2020-01-01 13:05:05'),
(2, NULL, 'Vira Password Grant Client', 'be9k9dzqKPspEVdd6wbseUwAERnd7ePXfM7rlpKj', 'http://localhost', 0, 1, 0, '2020-01-01 13:05:05', '2020-01-01 13:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_languages`
--

DROP TABLE IF EXISTS `page_languages`;
CREATE TABLE IF NOT EXISTS `page_languages` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_languages`
--

INSERT INTO `page_languages` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'English', NULL, NULL),
(2, 'Farsi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_templates`
--

DROP TABLE IF EXISTS `page_templates`;
CREATE TABLE IF NOT EXISTS `page_templates` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_templates`
--

INSERT INTO `page_templates` (`id`, `name`, `route`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'Home', NULL, NULL),
(2, 'Product', 'Product', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', '2020-01-01 13:05:05', '2020-01-01 13:05:05'),
(2, 'secretariat', '2020-01-01 13:05:05', '2020-01-01 13:05:05'),
(3, 'employee', '2020-01-01 13:05:05', '2020-01-01 13:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `secretaries`
--

DROP TABLE IF EXISTS `secretaries`;
CREATE TABLE IF NOT EXISTS `secretaries` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secretary_ports`
--

DROP TABLE IF EXISTS `secretary_ports`;
CREATE TABLE IF NOT EXISTS `secretary_ports` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `indicator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secretary_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `secretary_ports_secretary_id_foreign` (`secretary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smsirlaravel_logs`
--

DROP TABLE IF EXISTS `smsirlaravel_logs`;
CREATE TABLE IF NOT EXISTS `smsirlaravel_logs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `from` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `response` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, '$2y$10$PaCKCPvZJG5lYLlqttLVleIwx2UPmXBMuB7IcEXhEkhlYEApKCsSW', NULL, '2020-01-01 13:05:05', '2020-01-01 13:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

DROP TABLE IF EXISTS `user_infos`;
CREATE TABLE IF NOT EXISTS `user_infos` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `sex` tinyint(1) DEFAULT NULL,
  `degree` int DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/img/adminpanel/client/profile.png',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonenumber` bigint UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_infos_phonenumber_unique` (`phonenumber`),
  KEY `user_infos_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `name`, `family`, `birthday`, `address`, `sex`, `degree`, `signature`, `photo`, `email`, `phonenumber`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'مدیر', 'سامانه', '2020-01-01 05:05:05', NULL, NULL, NULL, NULL, '/img/adminpanel/client/profile.png', NULL, NULL, 1, '2020-01-01 13:05:05', '2020-01-01 13:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE IF NOT EXISTS `user_permissions` (
  `user_id` int UNSIGNED NOT NULL,
  `permission_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `user_permissions_permission_id_foreign` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`user_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area_cities`
--
ALTER TABLE `area_cities`
  ADD CONSTRAINT `area_cities_area_state_id_foreign` FOREIGN KEY (`area_state_id`) REFERENCES `area_states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `area_zones`
--
ALTER TABLE `area_zones`
  ADD CONSTRAINT `area_zones_area_city_id_foreign` FOREIGN KEY (`area_city_id`) REFERENCES `area_cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `calenders`
--
ALTER TABLE `calenders`
  ADD CONSTRAINT `calenders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dls_dlrs`
--
ALTER TABLE `dls_dlrs`
  ADD CONSTRAINT `dls_dlrs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dls_dlr_attachments`
--
ALTER TABLE `dls_dlr_attachments`
  ADD CONSTRAINT `dls_dlr_attachments_dls_dlr_id_foreign` FOREIGN KEY (`dls_dlr_id`) REFERENCES `dls_dlrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dls_dlr_contexts`
--
ALTER TABLE `dls_dlr_contexts`
  ADD CONSTRAINT `dls_dlr_contexts_dls_dlr_id_foreign` FOREIGN KEY (`dls_dlr_id`) REFERENCES `dls_dlrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dls_dlr_documents`
--
ALTER TABLE `dls_dlr_documents`
  ADD CONSTRAINT `dls_dlr_documents_dls_dlr_id_foreign` FOREIGN KEY (`dls_dlr_id`) REFERENCES `dls_dlrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dls_dlr_documents_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dls_dlr_receivers`
--
ALTER TABLE `dls_dlr_receivers`
  ADD CONSTRAINT `dls_dlr_receivers_dls_dlr_id_foreign` FOREIGN KEY (`dls_dlr_id`) REFERENCES `dls_dlrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dls_dlr_receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dls_dlr_referrals`
--
ALTER TABLE `dls_dlr_referrals`
  ADD CONSTRAINT `dls_dlr_referrals_dls_dlr_id_foreign` FOREIGN KEY (`dls_dlr_id`) REFERENCES `dls_dlrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dls_dlr_referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dls_dlr_referral_receivers`
--
ALTER TABLE `dls_dlr_referral_receivers`
  ADD CONSTRAINT `dls_dlr_referral_receivers_dls_dlr_referral_id_foreign` FOREIGN KEY (`dls_dlr_referral_id`) REFERENCES `dls_dlr_referrals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dls_dlr_referral_receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dls_dlr_summaries`
--
ALTER TABLE `dls_dlr_summaries`
  ADD CONSTRAINT `dls_dlr_summaries_dls_dlr_id_foreign` FOREIGN KEY (`dls_dlr_id`) REFERENCES `dls_dlrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_attachments`
--
ALTER TABLE `document_attachments`
  ADD CONSTRAINT `document_attachments_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elr_attachments`
--
ALTER TABLE `elr_attachments`
  ADD CONSTRAINT `elr_attachments_elr_id_foreign` FOREIGN KEY (`elr_id`) REFERENCES `elrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elr_contexts`
--
ALTER TABLE `elr_contexts`
  ADD CONSTRAINT `elr_contexts_elr_id_foreign` FOREIGN KEY (`elr_id`) REFERENCES `elrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elr_documents`
--
ALTER TABLE `elr_documents`
  ADD CONSTRAINT `elr_documents_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `elr_documents_elr_id_foreign` FOREIGN KEY (`elr_id`) REFERENCES `elrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elr_receivers`
--
ALTER TABLE `elr_receivers`
  ADD CONSTRAINT `elr_receivers_elr_id_foreign` FOREIGN KEY (`elr_id`) REFERENCES `elrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `elr_receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elr_referrals`
--
ALTER TABLE `elr_referrals`
  ADD CONSTRAINT `elr_referrals_elr_id_foreign` FOREIGN KEY (`elr_id`) REFERENCES `elrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `elr_referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elr_referral_receivers`
--
ALTER TABLE `elr_referral_receivers`
  ADD CONSTRAINT `elr_referral_receivers_elr_referral_id_foreign` FOREIGN KEY (`elr_referral_id`) REFERENCES `elr_referrals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `elr_referral_receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elr_summaries`
--
ALTER TABLE `elr_summaries`
  ADD CONSTRAINT `elr_summaries_elr_id_foreign` FOREIGN KEY (`elr_id`) REFERENCES `elrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `els_attachments`
--
ALTER TABLE `els_attachments`
  ADD CONSTRAINT `els_attachments_els_id_foreign` FOREIGN KEY (`els_id`) REFERENCES `els` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `els_contexts`
--
ALTER TABLE `els_contexts`
  ADD CONSTRAINT `els_contexts_els_id_foreign` FOREIGN KEY (`els_id`) REFERENCES `els` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `els_documents`
--
ALTER TABLE `els_documents`
  ADD CONSTRAINT `els_documents_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `els_documents_els_id_foreign` FOREIGN KEY (`els_id`) REFERENCES `els` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `els_senders`
--
ALTER TABLE `els_senders`
  ADD CONSTRAINT `els_senders_els_id_foreign` FOREIGN KEY (`els_id`) REFERENCES `els` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `els_senders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `els_summaries`
--
ALTER TABLE `els_summaries`
  ADD CONSTRAINT `els_summaries_els_id_foreign` FOREIGN KEY (`els_id`) REFERENCES `els` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fls_flrs`
--
ALTER TABLE `fls_flrs`
  ADD CONSTRAINT `fls_flrs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fls_flr_attachments`
--
ALTER TABLE `fls_flr_attachments`
  ADD CONSTRAINT `fls_flr_attachments_fls_flr_id_foreign` FOREIGN KEY (`fls_flr_id`) REFERENCES `fls_flrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fls_flr_receivers`
--
ALTER TABLE `fls_flr_receivers`
  ADD CONSTRAINT `fls_flr_receivers_fls_flr_id_foreign` FOREIGN KEY (`fls_flr_id`) REFERENCES `fls_flrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fls_flr_receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fls_flr_senders`
--
ALTER TABLE `fls_flr_senders`
  ADD CONSTRAINT `fls_flr_senders_fls_flr_id_foreign` FOREIGN KEY (`fls_flr_id`) REFERENCES `fls_flrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fls_flr_senders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ils_ilrs`
--
ALTER TABLE `ils_ilrs`
  ADD CONSTRAINT `ils_ilrs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ils_ilr_attachments`
--
ALTER TABLE `ils_ilr_attachments`
  ADD CONSTRAINT `ils_ilr_attachments_ils_ilr_id_foreign` FOREIGN KEY (`ils_ilr_id`) REFERENCES `ils_ilrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ils_ilr_contexts`
--
ALTER TABLE `ils_ilr_contexts`
  ADD CONSTRAINT `ils_ilr_contexts_ils_ilr_id_foreign` FOREIGN KEY (`ils_ilr_id`) REFERENCES `ils_ilrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ils_ilr_documents`
--
ALTER TABLE `ils_ilr_documents`
  ADD CONSTRAINT `ils_ilr_documents_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ils_ilr_documents_ils_ilr_id_foreign` FOREIGN KEY (`ils_ilr_id`) REFERENCES `ils_ilrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ils_ilr_receivers`
--
ALTER TABLE `ils_ilr_receivers`
  ADD CONSTRAINT `ils_ilr_receivers_ils_ilr_id_foreign` FOREIGN KEY (`ils_ilr_id`) REFERENCES `ils_ilrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ils_ilr_receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ils_ilr_referrals`
--
ALTER TABLE `ils_ilr_referrals`
  ADD CONSTRAINT `ils_ilr_referrals_ils_ilr_id_foreign` FOREIGN KEY (`ils_ilr_id`) REFERENCES `ils_ilrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ils_ilr_referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ils_ilr_referral_receivers`
--
ALTER TABLE `ils_ilr_referral_receivers`
  ADD CONSTRAINT `ils_ilr_referral_receivers_ils_ilr_referral_id_foreign` FOREIGN KEY (`ils_ilr_referral_id`) REFERENCES `ils_ilr_referrals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ils_ilr_referral_receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ils_ilr_summaries`
--
ALTER TABLE `ils_ilr_summaries`
  ADD CONSTRAINT `ils_ilr_summaries_ils_ilr_id_foreign` FOREIGN KEY (`ils_ilr_id`) REFERENCES `ils_ilrs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_positions`
--
ALTER TABLE `job_positions`
  ADD CONSTRAINT `job_positions_job_classification_id_foreign` FOREIGN KEY (`job_classification_id`) REFERENCES `job_classifications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_positions_job_hierarchical_id_foreign` FOREIGN KEY (`job_hierarchical_id`) REFERENCES `job_hierarchicals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_rulings`
--
ALTER TABLE `job_rulings`
  ADD CONSTRAINT `job_rulings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_ruling_positions`
--
ALTER TABLE `job_ruling_positions`
  ADD CONSTRAINT `job_ruling_positions_job_position_id_foreign` FOREIGN KEY (`job_position_id`) REFERENCES `job_positions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_ruling_positions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_ruling_shifts`
--
ALTER TABLE `job_ruling_shifts`
  ADD CONSTRAINT `job_ruling_shifts_job_shift_id_foreign` FOREIGN KEY (`job_shift_id`) REFERENCES `job_shifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_ruling_shifts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mls_mlrs`
--
ALTER TABLE `mls_mlrs`
  ADD CONSTRAINT `mls_mlrs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mls_mlr_receivers`
--
ALTER TABLE `mls_mlr_receivers`
  ADD CONSTRAINT `mls_mlr_receivers_mls_mlr_id_foreign` FOREIGN KEY (`mls_mlr_id`) REFERENCES `mls_mlrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mls_mlr_receivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `secretary_ports`
--
ALTER TABLE `secretary_ports`
  ADD CONSTRAINT `secretary_ports_secretary_id_foreign` FOREIGN KEY (`secretary_id`) REFERENCES `secretaries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD CONSTRAINT `user_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `user_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
