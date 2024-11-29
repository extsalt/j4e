-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2021 at 12:14 AM
-- Server version: 5.7.34
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `view360_j4e`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `level` varchar(11) NOT NULL,
  `event` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `debug_detail` text NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `user_ids`, `level`, `event`, `detail`, `debug_detail`, `created_time`) VALUES
(1, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 07:45:59'),
(2, 'wQydA7LtYebb17a88dd3a11f27ee907b91083d2287ACvYSJZj', 'Information', 'signup-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"applex@gmail.com\",\"user_status\":1}', '', '2021-04-07 20:57:28'),
(3, 'wQydA7LtYebb17a88dd3a11f27ee907b91083d2287ACvYSJZj', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 20:57:56'),
(4, 'wQydA7LtYebb17a88dd3a11f27ee907b91083d2287ACvYSJZj', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 20:58:37'),
(5, 'wQydA7LtYebb17a88dd3a11f27ee907b91083d2287ACvYSJZj', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 20:59:42'),
(6, '', 'Warning', 'signin-failed', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"admin\"}', '', '2021-04-07 21:00:32'),
(7, 'gOE4pSQFr17998d6bff925bf5230d6ea0faedd38cdAUtEkGLf', 'Information', 'signup-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"applexadmin@gmail.com\",\"user_status\":1}', '', '2021-04-07 21:01:16'),
(8, 'gOE4pSQFr17998d6bff925bf5230d6ea0faedd38cdAUtEkGLf', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:01:24'),
(9, '', 'Warning', 'signin-failed', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"applexadmin1@gmail.com\"}', '', '2021-04-07 21:08:44'),
(10, 'gOE4pSQFr17998d6bff925bf5230d6ea0faedd38cdAUtEkGLf', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:08:51'),
(11, 'YGS7K8ItR05c21bbee14c3758ca8657f5899cefe6PR9vnNUK8', 'Information', 'signup-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"demoaccount@gmail.com\",\"user_status\":1}', '', '2021-04-07 21:29:22'),
(12, 'gOE4pSQFr17998d6bff925bf5230d6ea0faedd38cdAUtEkGLf', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:31:09'),
(13, 'gOE4pSQFr17998d6bff925bf5230d6ea0faedd38cdAUtEkGLf', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:34:10'),
(14, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signup-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"applexadmin@gmail.com\",\"user_status\":1}', '', '2021-04-07 21:36:03'),
(15, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:36:16'),
(16, '2WaT0sB7Odc2f40837b443ef6a220af573de4b8eeGfmrz9I8g', 'Information', 'signup-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"applexuser@gmail.com\",\"user_status\":1}', '', '2021-04-07 21:37:44'),
(17, '2WaT0sB7Odc2f40837b443ef6a220af573de4b8eeGfmrz9I8g', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:37:55'),
(18, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:39:52'),
(19, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signup-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"applex@gmail.com\",\"user_status\":1}', '', '2021-04-07 21:41:51'),
(20, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:42:04'),
(21, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:43:38'),
(22, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:46:24'),
(23, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 21:56:06'),
(24, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:00:05'),
(25, '', 'Warning', 'signin-failed', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"applex@gmail.com\"}', '', '2021-04-07 22:01:02'),
(26, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:01:49'),
(27, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:03:58'),
(28, '9WQCpcHkB118d92bef62d45e2a279edc1e7eadba7C1nxFt4rW', 'Information', 'signup-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"demosuperadmin@gmail.com\",\"user_status\":1}', '', '2021-04-07 22:06:08'),
(29, '9WQCpcHkB118d92bef62d45e2a279edc1e7eadba7C1nxFt4rW', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:06:22'),
(30, '9WQCpcHkB118d92bef62d45e2a279edc1e7eadba7C1nxFt4rW', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:08:53'),
(31, '9WQCpcHkB118d92bef62d45e2a279edc1e7eadba7C1nxFt4rW', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:11:23'),
(32, '9WQCpcHkB118d92bef62d45e2a279edc1e7eadba7C1nxFt4rW', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:16:23'),
(33, '9WQCpcHkB118d92bef62d45e2a279edc1e7eadba7C1nxFt4rW', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:16:38'),
(34, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:20:00'),
(35, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:20:45'),
(36, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.35.220\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-07 22:22:49'),
(37, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"42.108.225.48\",\"is_mobile\":true,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.105\",\"platform\":\"Android\"}', '', '2021-04-07 22:53:27'),
(38, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"45.252.73.80\",\"is_mobile\":true,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.105\",\"platform\":\"Android\"}', '', '2021-04-08 00:15:08'),
(39, '2WaT0sB7Odc2f40837b443ef6a220af573de4b8eeGfmrz9I8g', 'Information', 'signin-success', '{\"ip\":\"45.252.73.80\",\"is_mobile\":true,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.105\",\"platform\":\"Android\"}', '', '2021-04-08 00:18:03'),
(40, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"45.252.73.80\",\"is_mobile\":true,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.105\",\"platform\":\"Android\"}', '', '2021-04-08 00:18:51'),
(41, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"116.75.168.76\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 13:17:20'),
(42, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"1.186.196.113\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 7\"}', '', '2021-04-08 15:07:20'),
(43, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"116.75.168.76\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 15:12:15'),
(44, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"116.75.168.76\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 15:12:43'),
(45, '', 'Warning', 'signin-failed', '{\"ip\":\"116.75.168.76\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"applexadmin@gmail.com\"}', '', '2021-04-08 15:15:20'),
(46, '', 'Warning', 'signin-failed', '{\"ip\":\"116.75.168.76\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"applexadmin@gmail.com\"}', '', '2021-04-08 15:15:27'),
(47, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"116.75.168.76\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 15:15:38'),
(48, '', 'Warning', 'signin-failed', '{\"ip\":\"49.34.42.171\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"applex@admin.com\"}', '', '2021-04-08 16:37:03'),
(49, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.42.171\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 16:37:28'),
(50, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"114.31.188.74\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 19:08:46'),
(51, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"114.31.188.74\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 19:09:26'),
(52, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"114.31.188.74\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 19:09:48'),
(53, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"114.31.188.74\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 19:22:16'),
(54, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"114.31.188.74\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-08 19:31:15'),
(55, '', 'Warning', 'signin-failed', '{\"ip\":\"49.34.53.182\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"applex@gmail.com\"}', '', '2021-04-09 10:28:37'),
(56, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"49.34.53.182\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-09 10:28:44'),
(57, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"157.32.69.181\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-09 16:28:23'),
(58, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"157.32.69.181\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-09 17:31:12'),
(59, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.69.181\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-09 17:32:45'),
(60, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.86.175\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-10 11:00:59'),
(61, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.66.248\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-11 16:50:24'),
(62, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"45.252.73.80\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-11 22:37:11'),
(63, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.70.167\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-12 11:33:22'),
(64, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.76.39\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-12 18:30:58'),
(65, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.68.58\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-13 12:03:33'),
(66, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.68.58\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-13 16:54:04'),
(67, 'VfBaM6ZOTba36bb8c9db5630d2b3db7bead0cde33kdJaPMHA6', 'Information', 'signup-success', '{\"ip\":\"157.32.68.58\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"q@gmail.com\",\"user_status\":1}', '', '2021-04-13 19:24:25'),
(68, 'TOgBpNEyz97da8025f6e437bf7b84feb145d63ac7qHXEeGZzp', 'Information', 'signup-success', '{\"ip\":\"157.32.68.58\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"test@gmail.com\",\"user_status\":1}', '', '2021-04-13 19:26:22'),
(69, 'ZX76OEhQ9acd3ebff02335deac2556ae54ed62643teIaRUcxN', 'Information', 'signup-success', '{\"ip\":\"157.32.68.58\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"email_address\":\"test2@gmail.com\",\"user_status\":1}', '', '2021-04-13 19:30:25'),
(70, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-14 11:16:32'),
(71, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-14 13:10:34'),
(72, '', 'Warning', 'signin-failed', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"test Company\"}', '', '2021-04-14 13:17:22'),
(73, 'TOgBpNEyz97da8025f6e437bf7b84feb145d63ac7qHXEeGZzp', 'Information', 'signin-success', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-14 13:17:47'),
(74, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-14 13:58:30'),
(75, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-14 15:22:52'),
(76, '', 'Warning', 'signin-failed', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"applex@gmail.com\"}', '', '2021-04-14 20:34:16'),
(77, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-14 20:34:23'),
(78, '', 'Warning', 'signin-failed', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\",\"username\":\"test@gmail.com\"}', '', '2021-04-14 20:37:00'),
(79, 'TOgBpNEyz97da8025f6e437bf7b84feb145d63ac7qHXEeGZzp', 'Information', 'signin-success', '{\"ip\":\"157.32.68.162\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-14 20:37:09'),
(80, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.76.214\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.114\",\"platform\":\"Windows 10\"}', '', '2021-04-15 09:25:03'),
(81, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.70.49\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.128\",\"platform\":\"Windows 10\"}', '', '2021-04-15 21:39:40'),
(82, '', 'Warning', 'signin-failed', '{\"ip\":\"157.32.70.49\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.128\",\"platform\":\"Windows 10\",\"username\":\"applex@gmail.com\"}', '', '2021-04-15 21:41:31'),
(83, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.70.49\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.128\",\"platform\":\"Windows 10\"}', '', '2021-04-15 21:41:42'),
(84, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.72.180\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.128\",\"platform\":\"Windows 10\"}', '', '2021-04-16 09:57:25'),
(85, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', 'Information', 'signin-success', '{\"ip\":\"157.32.114.68\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.128\",\"platform\":\"Windows 10\"}', '', '2021-04-16 21:44:26'),
(86, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.114.68\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.128\",\"platform\":\"Windows 10\"}', '', '2021-04-16 21:47:44'),
(87, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.114.68\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.128\",\"platform\":\"Windows 10\"}', '', '2021-04-16 21:53:54'),
(88, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.23.139\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.128\",\"platform\":\"Windows 10\"}', '', '2021-04-17 14:31:10'),
(89, '', 'Warning', 'signin-failed', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\",\"username\":\"superadmin\"}', '', '2021-05-04 06:36:49'),
(90, '', 'Warning', 'signin-failed', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\",\"username\":\"superadmin\"}', '', '2021-05-04 06:37:00'),
(91, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-04 06:37:10'),
(92, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-04 22:54:26'),
(93, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'signup-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\",\"email_address\":\"shyam@gmail.com\",\"user_status\":1}', '', '2021-05-04 23:07:36'),
(94, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'update-user-setting', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-04 23:09:23'),
(95, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'update-user-profile', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-04 23:09:46'),
(96, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'update-user-setting', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-04 23:12:57'),
(97, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-04 23:13:35'),
(98, '', 'Warning', 'signin-failed', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\",\"username\":\"superadmin\"}', '', '2021-05-04 23:14:17'),
(99, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-04 23:14:24'),
(100, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-05 22:25:44'),
(101, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-06 03:35:20'),
(102, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-06 22:43:38'),
(103, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 01:46:00'),
(104, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 01:46:27'),
(105, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 01:47:52'),
(106, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 02:03:30'),
(107, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 02:04:28'),
(108, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 02:35:00'),
(109, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 02:36:24'),
(110, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'update-user-setting', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 02:37:50'),
(111, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 02:38:17'),
(112, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 02:39:32'),
(113, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 06:15:07'),
(114, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 23:55:35'),
(115, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.66.11\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-10 12:09:37'),
(116, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"45.252.73.89\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 10\"}', '', '2021-05-10 12:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `backup_log`
--

CREATE TABLE `backup_log` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `options` varchar(50) NOT NULL,
  `created_method` varchar(8) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backup_log`
--

INSERT INTO `backup_log` (`id`, `ids`, `file_path`, `options`, `created_method`, `created_time`) VALUES
(1, '6vqXtSCF537bc130e9d181767f4def3751f30764aYKlmaj8Zs', 'C:\\xampp1\\htdocs\\j4u\\backup\\backup_Fully_20210504132107_t28fmR.zip', 'Fully, Save', 'Manual', '2021-05-04 07:51:08'),
(2, 'PY8HdSDlqf18eb192e34b018b82b600932577e084slbVFi2w4', 'backup_Partially_20210504132158_t0zKID.zip', 'Partially Download', 'Manual', '2021-05-04 07:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `author` varchar(255) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `slug` varchar(512) NOT NULL,
  `cover_photo` varchar(255) NOT NULL,
  `catalog` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `keyword` varchar(1024) NOT NULL,
  `body` text NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `read_times` int(11) NOT NULL,
  `comments` text NOT NULL,
  `enabled` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `catalog` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `read_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `documentation`
--

CREATE TABLE `documentation` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `slug` varchar(512) NOT NULL,
  `catalog` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `keyword` varchar(1024) NOT NULL,
  `body` text NOT NULL,
  `attachment` text NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `ids` varchar(50) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `built_in` tinyint(4) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `ids`, `purpose`, `built_in`, `subject`, `body`) VALUES
(1, '68KCh0tH40689a5a3d773c0e66c9ebf17fa1ddfd2M5czj3tVX', 'signup_activation', 1, 'Activate your account', '<p>Hello {{first_name}}!</p><p>Thank you for joining CyberBukit Membership!</p><p>Please click the following URL to activate your account:<br>{{verification_url}}<br></p><p>If clicking the URL above doesn\'t work, copy and paste the URL into a browser window.</p><p>CyberBukit Membership Support<br>https://membership.demo.cyberbukit.com</p>'),
(2, 'Sm1M50EX7c92c02f0db2d4d0b57958b7a5897ac4e6Lm2nECNP', 'reset_password', 1, 'Password reset', '<p>Hello!</p><p>We\'ve generated a URL to reset your password. If you did not request to reset your password or if you\'ve changed your mind, simply ignore this email and nothing will happen.</p><p>You can reset your password by clicking the following URL:<br>{{verification_url}}</p><p>If clicking the URL above does not work, copy and paste the URL into a browser window. The URL will only be valid for a limited time and will expire.</p><p>Thank you,</p><p>CyberBukit Membership Support<br>https://membership.demo.cyberbukit.com</p>'),
(3, 'y4Y8hpRW1f21144be085fec47b9380fca78dbdb885xvEcLYdP', 'change_email', 1, 'Verify your email address', '<p>Hello!</p><p>We\'ve generated a URL to change your email address. If you did not request to change your email address or if you\'ve changed your mind, simply ignore this email and nothing will happen.</p><p>You can change your email address by clicking the following URL:<br>{{verification_url}}</p><p>If clicking the URL above does not work, copy and paste the URL into a browser window. The URL will only be valid for a limited time and will expire.</p><p>Thank you,</p><p>CyberBukit Membership Support<br>https://membership.demo.cyberbukit.com</p>'),
(4, 'jSwbWZdAeef79225efbec3e064b048f20eaa7bb9cwnYX4SWrG', 'notify_email', 1, 'Your account has been created', '<p>Hello {{first_name}}!</p><p>Welcome to CyberBukit Membership!</p><p>Your CyberBukit Membership account has been created successfully!</p><p>Here is your signin credential:<br>Email Address: {{email_address}}<br>Password: {{password}}<br>Signin URL: {{base_url}}<br>Please sign in and change your password. If you have any questions please feel free to contact us.</p><p>CyberBukit Membership Support<br>https://membership.demo.cyberbukit.com</p>'),
(5, 'nIQMARFoda2cade675a5876feb1bb77ad4db0086aH6MghaBPL', 'invite_email', 1, 'Signup Invitation', '<p>Hello!</p><p>The administrator of CyberBukit Membership has sent you this email to invite you to sign up as our member.</p><p>Please click the following URL to activate your account:<br>{{verification_url}}</p><p>If clicking the URL above doesn\'t work, copy and paste the URL into a browser window.</p><p>CyberBukit Membership Support<br>https://membership.demo.cyberbukit.com</p>'),
(6, 'pW5oGbDQHf7ecf4013f762df420bffe8011b18616mDIwCxvMA', '2FA_email', 1, 'Two Factor Authentication', '<p>Your CyberBukit Membership verification code is {{code}}</p>'),
(7, 'tzqM8x3p7174d8c2d251203aaeeaa85fe4d6ad8338BhC0Oq5W', 'ticket_notify_agent', 1, 'A new ticket raised', '<p>A new ticket raised or updated. Please sign in and check.</p>'),
(8, '8HKUnZ5F24a9ce26849ee64dcba7aaa2187950d40vHQYtzcsK', 'ticket_notify_user', 1, 'Your ticket has been replied', '<p>Dear customer,</p><p>You ticket has been replied by our agent(s). Please sign in and check.</p><p>CyberBukit Membership Support</p><p>https://membership.demo.cyberbukit.com</p>'),
(9, '5DQa8U2Ig7810ecd10382727e3c8f9be866362547OaCI8ki3t', 'pay_success', 1, 'We have received your payment', '<p>Dear customer,</p><p>We have received your payment for {{purchase_item}}, The amount is {{purchase_price}}.</p><p>Thanks for your payment.</p><p>CyberBukit Membership Support</p><p>https://membership.demo.cyberbukit.com</p>');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `catalog` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `fet_id` int(11) NOT NULL,
  `fet_name` text CHARACTER SET utf8 NOT NULL,
  `ids` char(50) NOT NULL,
  `feature_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`fet_id`, `fet_name`, `ids`, `feature_order`) VALUES
(2, 'Test Features 1', 'HCUhdKZlMa18ab9c2aa38e2923a089825076a4f2evrHW3CaqW', 2),
(4, 'abc', 'HCUhdKZlMa18ab9c2aa38e2923a089825076a4f2evrHW3CaqG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `file_manager`
--

CREATE TABLE `file_manager` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `temporary_ids` varchar(50) NOT NULL,
  `catalog` varchar(50) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `file_ext` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `trash` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` text NOT NULL,
  `menu_link` mediumtext NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_status` enum('1','2') NOT NULL COMMENT '''1''=''Active'', ''2''=''Inactive''',
  `ids` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_link`, `menu_parent`, `menu_status`, `ids`) VALUES
(1, 'Masters', '#', 0, '1', ''),
(5, 'Manage User ', '#', 0, '1', ''),
(6, 'User List', 'admin/list_user', 5, '1', ''),
(7, 'User Setting', '#', 0, '1', ''),
(8, 'My Profile', 'user/my_profile', 7, '1', ''),
(9, 'Change Password', 'user/change_password', 7, '1', ''),
(10, 'Support Ticket', 'user/ticket', 7, '1', ''),
(11, 'My Finance', '#', 7, '1', ''),
(12, 'Pay Now', 'user/pay_now', 11, '1', ''),
(15, 'My Subscription', 'user/pay_subscription_list', 11, '1', ''),
(16, 'Payment List', 'user/pay_list', 11, '1', ''),
(17, 'Tool', '#', 7, '1', ''),
(18, 'My Notification', 'user/my_notification', 17, '1', ''),
(19, 'My Activity Log', 'user/my_activity_log', 17, '1', ''),
(20, 'Admin Panel Setting', '#', 0, '1', ''),
(21, 'Global Settings', '#', 20, '1', ''),
(22, 'Support', '#', 20, '1', ''),
(23, 'Finance', '#', 20, '1', ''),
(24, 'Admin Tools', '#', 20, '1', ''),
(25, 'Add ons', '#', 20, '1', ''),
(26, 'General Setting', 'admin/general_setting', 21, '1', ''),
(27, 'Front End Setting', 'admin/front_setting', 21, '1', ''),
(28, 'Auth Integration', 'admin/auth_integration', 21, '1', ''),
(29, 'Roles', 'admin/role', 21, '1', ''),
(30, 'Permission', 'admin/permission', 21, '1', ''),
(31, 'SMTP Setting', 'admin/smtp_setting', 21, '1', ''),
(32, 'Email Template', 'admin/email_template', 21, '1', ''),
(33, 'Category Management', 'admin/catalog', 21, '1', ''),
(34, 'Miscellaneous', 'admin/miscellaneous', 21, '1', ''),
(35, 'Support Ticket', 'admin/ticket_list', 22, '1', ''),
(36, 'Contact Form', 'admin/contact_form_list', 22, '1', ''),
(37, 'FAQ', 'admin/faq_list', 22, '1', ''),
(38, 'Documentation', 'admin/documentation_list', 22, '1', ''),
(39, 'Support Testing', 'admin/support_setting', 22, '1', ''),
(40, 'List Payment', 'admin/payment_list', 23, '1', ''),
(41, 'List Subscription', 'admin/payment_subscription_list', 23, '1', ''),
(42, 'Payment Item', 'admin/payment_item_list', 23, '1', ''),
(43, 'Payment Setting', 'admin/payment_setting', 23, '1', ''),
(44, 'Notification', 'admin/list_notification', 24, '1', ''),
(45, 'Subscriber', 'admin/subscriber', 24, '1', ''),
(46, 'Blog Manager', 'admin/blog', 24, '1', ''),
(47, 'File Manager', 'files/file_manager', 24, '1', ''),
(48, 'Who is Online?', 'admin/list_online', 24, '1', ''),
(49, 'User Activity Log', 'admin/users_activity_log', 24, '1', ''),
(50, 'Database Backup', 'admin/database_backup', 24, '1', ''),
(51, 'Usage Example', 'admin/usage_example', 24, '1', ''),
(52, 'Upgrade Software', 'admin/upgrade_software', 24, '1', ''),
(53, 'Software Licence', 'admin/software_license', 24, '1', ''),
(58, 'Manage Membership', '#', 0, '1', 'LIzjQGJiW85118f3b9bb65ad0cd7e992cf639653f9QR45SyDz'),
(59, 'Membership', 'packages/managepackage', 58, '1', 'dO0XI86bj07fa350420d55d8101599e371ca21bffEg9qK8yuh'),
(61, 'Features', 'packages/managefeature', 58, '1', 'NxZI9f4Vsfba220bdf84fb04253100f3de0adbdf0znsKfVFtB');

-- --------------------------------------------------------

--
-- Table structure for table `module_permission`
--

CREATE TABLE `module_permission` (
  `per_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `role_id` longtext NOT NULL,
  `view_per` enum('1','2') NOT NULL COMMENT '''1''=''yes'',''2''=''no''',
  `create_per` enum('1','2') NOT NULL DEFAULT '2',
  `edit_per` enum('1','2') NOT NULL,
  `delete_per` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_permission`
--

INSERT INTO `module_permission` (`per_id`, `menu_id`, `role_id`, `view_per`, `create_per`, `edit_per`, `delete_per`) VALUES
(1, 1, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(2, 1, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '1', '1', '1', '1'),
(3, 1, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '1', '1', '1', '1'),
(4, 1, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '1', '2', '2', '2'),
(5, 2, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(6, 2, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(7, 2, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(8, 2, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '1', '2', '2', '2'),
(9, 3, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(10, 3, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '1', '1', '2', '2'),
(11, 3, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(12, 3, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '1', '2', '2', '2'),
(13, 4, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(14, 4, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(15, 4, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(16, 4, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '1', '2', '2', '2'),
(17, 5, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(18, 5, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(19, 5, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(20, 5, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '1', '1', '1', '1'),
(21, 6, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(22, 6, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(23, 6, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(24, 6, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '1', '1', '1', '1'),
(31, 7, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(32, 7, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(33, 7, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(34, 7, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(36, 8, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(37, 8, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(38, 8, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(39, 8, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(41, 9, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(42, 9, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(43, 9, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(44, 9, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(46, 10, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(47, 10, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(48, 10, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(49, 10, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(51, 11, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(52, 11, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(53, 11, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(54, 11, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(56, 12, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(57, 12, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(58, 12, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(59, 12, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(61, 13, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(62, 13, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(63, 13, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(64, 13, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(66, 14, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(67, 14, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(68, 14, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(69, 14, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(71, 15, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(72, 15, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(73, 15, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(74, 15, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(76, 16, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(77, 16, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(78, 16, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(79, 16, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(81, 17, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(82, 17, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(83, 17, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(84, 17, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(86, 18, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(87, 18, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(88, 18, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(89, 18, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(91, 19, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(92, 19, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(93, 19, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(94, 19, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(96, 20, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(97, 20, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(98, 20, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(99, 20, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(101, 21, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(102, 21, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(103, 21, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(104, 21, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(106, 22, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(107, 22, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(108, 22, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(109, 22, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(111, 23, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(112, 23, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(113, 23, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(114, 23, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(116, 24, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(117, 24, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(118, 24, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(119, 24, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(121, 25, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(122, 25, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(123, 25, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(124, 25, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(126, 26, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(127, 26, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(128, 26, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(129, 26, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(131, 27, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(132, 27, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(133, 27, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(134, 27, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(136, 28, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(137, 28, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(138, 28, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(139, 28, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(141, 29, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(142, 29, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(143, 29, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(144, 29, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(146, 30, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(147, 30, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(148, 30, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(149, 30, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(151, 31, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(152, 31, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(153, 31, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(154, 31, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(156, 32, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(157, 32, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(158, 32, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(159, 32, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(161, 33, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(162, 33, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(163, 33, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(164, 33, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(166, 34, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(167, 34, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(168, 34, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(169, 34, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(171, 35, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(172, 35, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(173, 35, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(174, 35, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(176, 36, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(177, 36, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(178, 36, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(179, 36, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(181, 37, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(182, 37, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(183, 37, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(184, 37, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(186, 38, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(187, 38, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(188, 38, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(189, 38, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(191, 39, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(192, 39, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(193, 39, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(194, 39, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(196, 40, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(197, 40, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(198, 40, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(199, 40, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(201, 41, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(202, 41, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(203, 41, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(204, 41, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(206, 42, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(207, 42, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(208, 42, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(209, 42, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(211, 43, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(212, 43, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(213, 43, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(214, 43, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(216, 44, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(217, 44, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(218, 44, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(219, 44, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(221, 45, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(222, 45, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(223, 45, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(224, 45, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(226, 46, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(227, 46, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(228, 46, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(229, 46, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(231, 47, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(232, 47, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(233, 47, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(234, 47, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(236, 48, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(237, 48, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(238, 48, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(239, 48, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(241, 49, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(242, 49, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(243, 49, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(244, 49, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(246, 50, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(247, 50, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(248, 50, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(249, 50, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(251, 51, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(252, 51, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(253, 51, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(254, 51, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(256, 52, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(257, 52, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(258, 52, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(259, 52, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(261, 53, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(262, 53, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(263, 53, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(264, 53, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(266, 54, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(267, 54, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(268, 54, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(269, 54, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(271, 55, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(272, 55, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(273, 55, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(274, 55, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(276, 56, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(277, 56, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(278, 56, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(279, 56, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(281, 1, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '1', '1', '1', '1'),
(282, 5, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '1', '1', '1', '1'),
(283, 6, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '1', '1', '1', '1'),
(284, 7, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '1', '1', '1', '1'),
(285, 8, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '1', '1', '1', '1'),
(286, 9, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '1', '1', '1', '1'),
(287, 10, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '1', '1', '1', '1'),
(288, 11, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(289, 12, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(290, 15, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(291, 16, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(292, 17, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(293, 18, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(294, 19, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(295, 20, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(296, 21, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(297, 22, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(298, 23, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(299, 24, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(300, 25, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(301, 26, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(302, 27, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(303, 28, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(304, 29, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(305, 30, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(306, 31, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(307, 32, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(308, 33, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(309, 34, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(310, 35, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(311, 36, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(312, 37, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(313, 38, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(314, 39, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(315, 40, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(316, 41, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(317, 42, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(318, 43, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(319, 44, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(320, 45, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(321, 46, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(322, 47, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(323, 48, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(324, 49, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(325, 50, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(326, 51, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(327, 52, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(328, 53, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(329, 54, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(330, 55, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(331, 56, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(332, 1, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '1', '2', '2', '2'),
(333, 5, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(334, 6, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(335, 7, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(336, 8, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(337, 9, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(338, 10, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(339, 11, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(340, 12, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(341, 15, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(342, 16, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(343, 17, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(344, 18, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(345, 19, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(346, 20, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(347, 21, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(348, 22, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(349, 23, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(350, 24, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(351, 25, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(352, 26, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(353, 27, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(354, 28, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(355, 29, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(356, 30, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(357, 31, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(358, 32, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(359, 33, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(360, 34, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(361, 35, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(362, 36, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(363, 37, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(364, 38, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(365, 39, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(366, 40, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(367, 41, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(368, 42, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(369, 43, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(370, 44, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(371, 45, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(372, 46, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(373, 47, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(374, 48, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(375, 49, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(376, 50, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(377, 51, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(378, 52, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(379, 53, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(380, 54, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(381, 55, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(382, 56, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(383, 1, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '1', '2', '2', '2'),
(384, 5, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(385, 6, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(386, 7, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(387, 8, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(388, 9, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(389, 10, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(390, 11, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(391, 12, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(392, 15, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(393, 16, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(394, 17, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(395, 18, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(396, 19, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(397, 20, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(398, 21, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(399, 22, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(400, 23, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(401, 24, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(402, 25, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(403, 26, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(404, 27, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(405, 28, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(406, 29, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(407, 30, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(408, 31, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(409, 32, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(410, 33, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(411, 34, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(412, 35, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(413, 36, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(414, 37, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(415, 38, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(416, 39, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(417, 40, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(418, 41, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(419, 42, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(420, 43, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(421, 44, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(422, 45, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(423, 46, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(424, 47, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(425, 48, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(426, 49, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(427, 50, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(428, 51, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(429, 52, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(430, 53, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(431, 54, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(432, 55, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(433, 56, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(434, 57, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(435, 57, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(436, 57, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(437, 57, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(438, 57, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(439, 57, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(440, 57, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(441, 58, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(442, 58, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(443, 58, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(444, 58, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(445, 58, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(446, 58, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(447, 58, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(448, 59, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(449, 59, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(450, 59, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(451, 59, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(452, 59, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(453, 59, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(454, 59, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(455, 60, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(456, 60, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(457, 60, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(458, 60, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(459, 60, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(460, 60, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(461, 60, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(462, 61, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(463, 61, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(464, 61, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(465, 61, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(466, 61, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(467, 61, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(468, 61, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(469, 62, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(470, 62, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(471, 62, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(472, 62, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(473, 62, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(474, 62, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(475, 62, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(476, 1, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '1', '2', '2', '2'),
(477, 5, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(478, 6, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(479, 7, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(480, 8, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(481, 9, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(482, 10, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(483, 11, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(484, 12, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(485, 15, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(486, 16, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(487, 17, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(488, 18, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(489, 19, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(490, 20, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(491, 21, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(492, 22, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(493, 23, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(494, 24, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(495, 25, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(496, 26, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(497, 27, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(498, 28, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(499, 29, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(500, 30, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(501, 31, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(502, 32, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(503, 33, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(504, 34, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(505, 35, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(506, 36, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(507, 37, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(508, 38, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(509, 39, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(510, 40, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(511, 41, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(512, 42, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(513, 43, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(514, 44, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(515, 45, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(516, 46, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(517, 47, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(518, 48, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(519, 49, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(520, 50, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(521, 51, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(522, 52, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(523, 53, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(524, 58, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(525, 59, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(526, 61, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(527, 62, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `ids` varchar(50) NOT NULL,
  `from_user_ids` varchar(32) NOT NULL,
  `to_user_ids` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `is_read` tinyint(4) NOT NULL,
  `send_email` tinyint(4) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `read_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_connector`
--

CREATE TABLE `oauth_connector` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `purpose` char(6) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `pack_id` int(11) NOT NULL,
  `pack_name` text NOT NULL,
  `pack_desc` longtext NOT NULL,
  `pack_price` float NOT NULL,
  `pack_for` varchar(30) NOT NULL,
  `pack_fet` mediumtext,
  `pack_creatat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pack_duration` varchar(1000) NOT NULL,
  `ids` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`pack_id`, `pack_name`, `pack_desc`, `pack_price`, `pack_for`, `pack_fet`, `pack_creatat`, `pack_duration`, `ids`) VALUES
(6, 'Gold55', '<p>welcome</p>', 20, 'Yearly', '2/3', '2021-05-08 06:53:07', '4', 'Aqlameb4W226aee051bf5222e41b2c1a498ce30211ftm74e9T');

-- --------------------------------------------------------

--
-- Table structure for table `payment_item`
--

CREATE TABLE `payment_item` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `type` varchar(50) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` text NOT NULL,
  `item_currency` char(3) NOT NULL,
  `item_price` double NOT NULL,
  `recurring_interval` varchar(5) NOT NULL,
  `recurring_interval_count` int(11) NOT NULL,
  `stuff_setting` text NOT NULL,
  `purchase_limit` tinyint(4) NOT NULL,
  `access_condition` text NOT NULL,
  `trash` tinyint(4) NOT NULL,
  `auto_renew` tinyint(4) NOT NULL,
  `access_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_log`
--

CREATE TABLE `payment_log` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `gateway` varchar(50) NOT NULL,
  `currency` char(3) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  `gateway_identifier` varchar(255) NOT NULL,
  `gateway_event_id` varchar(255) NOT NULL,
  `item_ids` char(50) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `redirect_status` varchar(50) NOT NULL,
  `callback_status` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `callback_time` timestamp NULL DEFAULT NULL,
  `visible_for_user` tinyint(4) NOT NULL,
  `generate_invoice` tinyint(4) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `coupon` varchar(50) NOT NULL,
  `coupon_discount` double NOT NULL,
  `tax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_purchased`
--

CREATE TABLE `payment_purchased` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `payment_ids` char(50) NOT NULL,
  `item_type` varchar(12) NOT NULL,
  `item_ids` char(50) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `description` varchar(1024) NOT NULL,
  `stuff` text NOT NULL,
  `used_up` tinyint(4) NOT NULL,
  `auto_renew` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_subscription`
--

CREATE TABLE `payment_subscription` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `item_ids` char(50) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `payment_gateway` varchar(50) NOT NULL,
  `gateway_identifier` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `description` varchar(1024) NOT NULL,
  `stuff` text NOT NULL,
  `used_up` tinyint(4) NOT NULL,
  `auto_renew` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `built_in` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `ids`, `built_in`, `name`) VALUES
(1, 'clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r', 1, 'User_Management'),
(2, 'GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w', 1, 'Roles_And_Permissions'),
(3, 'qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b', 1, 'Global_Settings'),
(4, 'PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu', 1, 'Admin_Tools'),
(5, 'xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb', 1, 'Database_Backup'),
(6, 'g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT', 1, 'Payment_Management'),
(7, 'VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm', 1, 'Support_Management'),
(8, '4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS', 0, 'Site_Setting12');

-- --------------------------------------------------------

--
-- Table structure for table `permission2`
--

CREATE TABLE `permission2` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `ids_role` char(50) NOT NULL,
  `ids_menu` char(50) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `create` int(11) NOT NULL DEFAULT '0',
  `edit` int(11) NOT NULL DEFAULT '0',
  `delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `built_in` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permission` text NOT NULL,
  `status` enum('1','2') NOT NULL COMMENT '''1''=''YES'',''2''=''NO'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `ids`, `built_in`, `name`, `permission`, `status`) VALUES
(1, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, 'Super_Admin', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":true,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":true,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":true,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":true,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":true,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":true,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":true,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":true}', '1'),
(2, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', 1, 'Admin', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(3, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, 'User', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(10, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', 0, 'Company', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(12, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', 0, 'L1_Staff', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(13, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', 0, 'l2_staff', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(14, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', 0, 'staff_member', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(15, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', 0, 'abc', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1');

-- --------------------------------------------------------

--
-- Table structure for table `script_addons`
--

CREATE TABLE `script_addons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `version` varchar(50) NOT NULL,
  `license_code` varchar(255) NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `script_license`
--

CREATE TABLE `script_license` (
  `SETTING_ID` tinyint(1) NOT NULL,
  `ROOT_URL` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CLIENT_EMAIL` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LICENSE_CODE` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LCD` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LRD` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `INSTALLATION_KEY` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `INSTALLATION_HASH` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `script_license`
--

INSERT INTO `script_license` (`SETTING_ID`, `ROOT_URL`, `CLIENT_EMAIL`, `LICENSE_CODE`, `LCD`, `LRD`, `INSTALLATION_KEY`, `INSTALLATION_HASH`) VALUES
(1, 'http://localhost/CYBER/script', '', 'eaa45a32-dc10-4226-a283-99dd1bf098f3', 'WEtKODVpcTU4ZXM3eUlWYXBjMUNGZz09Ojol0QlIfWK5jSlfF2hzxmu2', 'TVJ4WjI5bG4zNVBuOTQ3YnNwOHVCQT09Ojp8weoNf1B0C/DmxxxiowOH', 'S280cHlIdVNERUpjcXgwc0NFV2owTEUyVit1WmJjTE11dmtJWHR6TlFyY3ZKRkZIYUdCSS85ckVMSUZ1YW9YMmhCWnRDdE5OM2FDMVl3WGVoMUcxbFE9PTo6V/TZK6jXJoSAXHaxgS3wTw==', '9ba171051070a02188f7f5149b06313758b99349dd71768ef906dcceaadd66e5');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `expired_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `sys_name` varchar(50) NOT NULL,
  `theme` varchar(50) NOT NULL,
  `maintenance_mode` tinyint(4) NOT NULL,
  `maintenance_message` varchar(255) NOT NULL,
  `signup_enabled` tinyint(4) NOT NULL,
  `psr` varchar(6) DEFAULT NULL,
  `tc_show` tinyint(4) NOT NULL,
  `terms_conditions` text NOT NULL,
  `email_verification_required` tinyint(4) NOT NULL,
  `signin_before_verified` tinyint(4) NOT NULL,
  `remember` tinyint(4) NOT NULL,
  `forget_enabled` tinyint(4) NOT NULL,
  `api_enabled` tinyint(4) NOT NULL,
  `html_purify` tinyint(4) NOT NULL,
  `xss_clean` tinyint(4) NOT NULL,
  `throttling_policy` varchar(6) NOT NULL,
  `throttling_unlock_time` tinyint(4) NOT NULL,
  `recaptcha_enabled` tinyint(4) NOT NULL,
  `recaptcha_detail` varchar(255) NOT NULL,
  `google_analytics_id` varchar(50) NOT NULL,
  `oauth_setting` text NOT NULL,
  `two_factor_authentication` varchar(50) NOT NULL,
  `smtp_setting` text NOT NULL,
  `page_size` tinyint(4) NOT NULL,
  `default_role` char(50) NOT NULL,
  `default_package` varchar(50) NOT NULL,
  `debug_level` tinyint(4) NOT NULL,
  `last_backup_time` timestamp NULL DEFAULT NULL,
  `gdpr` text NOT NULL,
  `payment_setting` text NOT NULL,
  `invoice_setting` text NOT NULL,
  `ticket_setting` text NOT NULL,
  `file_setting` text NOT NULL,
  `front_setting` text NOT NULL,
  `enabled_addons` text NOT NULL,
  `affiliate_setting` varchar(1024) NOT NULL,
  `dashboard_custom_css` varchar(255) NOT NULL,
  `dashboard_custom_javascript` varchar(255) NOT NULL,
  `version` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `sys_name`, `theme`, `maintenance_mode`, `maintenance_message`, `signup_enabled`, `psr`, `tc_show`, `terms_conditions`, `email_verification_required`, `signin_before_verified`, `remember`, `forget_enabled`, `api_enabled`, `html_purify`, `xss_clean`, `throttling_policy`, `throttling_unlock_time`, `recaptcha_enabled`, `recaptcha_detail`, `google_analytics_id`, `oauth_setting`, `two_factor_authentication`, `smtp_setting`, `page_size`, `default_role`, `default_package`, `debug_level`, `last_backup_time`, `gdpr`, `payment_setting`, `invoice_setting`, `ticket_setting`, `file_setting`, `front_setting`, `enabled_addons`, `affiliate_setting`, `dashboard_custom_css`, `dashboard_custom_javascript`, `version`) VALUES
(1, 'J4E', 'default', 0, 'Under Maintenance, Please try later.', 1, 'low', 1, '{\"title\":\"T&C Title\",\"body\":\"T&C Body\"}', 0, 0, 1, 1, 0, 0, 1, 'normal', 15, 0, '{\"version\":\"v2_1\",\"site_key\":\"\",\"secret_key\":\"\"}', '', '{\"google\":{\"enabled\":0,\"client_id\":\"\",\"client_secret\":\"\"},\"facebook\":{\"enabled\":0,\"app_id\":\"\",\"app_secret\":\"\"},\"twitter\":{\"enabled\":0,\"consumer_key\":\"\",\"consumer_secret\":\"\"}}', 'disabled', '{\"host\":\"\",\"port\":\"\",\"is_auth\":1,\"username\":\"\",\"password\":\"\",\"crypto\":\"none\",\"from_email\":\"\",\"from_name\":\"\"}', 25, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '0', 0, '2021-05-04 07:51:58', '{\"enabled\":1,\"allow_remove\":0,\"cookie_message\":\"This website uses cookies to ensure you get the best experience on our website.\",\"cookie_policy_link_text\":\"Learn more\",\"cookie_policy_link\":\"https:\\/\\/applexinfotech.com\\/CyberBukit\\/generic\\/terms_conditions\"}', '{\"type\":\"sandbox\",\"feature\":\"both\",\"tax_rate\":0,\"stripe_one_time_enabled\":\"0\",\"stripe_recurring_enabled\":\"0\",\"stripe_publishable_key\":\"\",\"stripe_secret_key\":\"\",\"stripe_signing_secret\":\"\",\"paypal_one_time_enabled\":\"0\",\"paypal_recurring_enabled\":\"0\",\"paypal_client_id\":\"\",\"paypal_secret\":\"\",\"paypal_webhook_id\":\"\"}', '{\"enabled\":1,\"company_name\":\"\",\"company_number\":\"\",\"tax_number\":\"\",\"address_line_1\":\"\",\"address_line_2\":\"\",\"phone\":\"\"}', '{\"enabled\":1,\"guest_ticket\":0,\"rating\":1,\"allow_upload\":0,\"notify_agent_list\":\"\",\"notify_user\":0,\"close_rule\":\"3\"}', '{\"file_type\":\"jpg|jpeg|png|gif|svg|zip|rar|pdf|mp3|mp4|doc|docx|xls|xlsx|csv\",\"file_size\":\"102400\"}', '{\"enabled\":0,\"logo\":\"logo.png\",\"company_name\":\"Applex Group\",\"email_address\":\"support@applexgroup.com\",\"html_title\":\"Applex Group\",\"html_author\":\"Applex Group\",\"html_description\":\"\",\"html_keyword\":\"\",\"about_us\":\"\",\"pricing_enabled\":1,\"faq_enabled\":1,\"documentation_enabled\":1,\"blog_enabled\":1,\"subscriber_enabled\":1,\"social_facebook\":\"\",\"social_twitter\":\"\",\"social_linkedin\":\"\",\"social_github\":\"\",\"custom_css\":\"\",\"custom_javascript\":\"\"}', '{}', '{\"enabled\":0,\"commission_policy\":\"A\",\"commission_rate\":0, \"description\":\"\", \"stuff\":\"\"}', '', '', '1.7.2');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `type`, `value`) VALUES
(1, 'signup_last_six_days', '{\"2020-11-25\":0,\"2020-11-26\":0,\"2020-11-27\":0,\"2020-11-29\":0,\"2020-11-29\":0,\"2020-11-30\":0}');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `from_ip` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `throttling`
--

CREATE TABLE `throttling` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `user_tag` varchar(50) NOT NULL,
  `times` tinyint(4) NOT NULL,
  `time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `ids_father` varchar(50) NOT NULL,
  `source` varchar(10) NOT NULL,
  `user_ids` char(50) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `main_status` tinyint(4) NOT NULL,
  `read_status` tinyint(6) NOT NULL,
  `catalog` varchar(50) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `associated_files` text NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(21) NOT NULL,
  `token` char(50) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `done` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `ids` char(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `api_key` char(50) NOT NULL,
  `balance` text NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `email_verified` tinyint(4) NOT NULL,
  `email_address_pending` varchar(50) NOT NULL,
  `phone` varchar(21) NOT NULL,
  `phone_verified` tinyint(4) NOT NULL,
  `phone_pending` varchar(21) NOT NULL,
  `oauth_google_identifier` varchar(50) NOT NULL,
  `oauth_facebook_identifier` varchar(50) NOT NULL,
  `oauth_twitter_identifier` varchar(50) NOT NULL,
  `signup_source` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company` varchar(255) NOT NULL,
  `avatar` varchar(54) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `date_format` varchar(20) NOT NULL,
  `time_format` varchar(20) NOT NULL,
  `language` varchar(50) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `country` varchar(2) NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `role_ids` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `login_success_detail` text,
  `online` tinyint(4) NOT NULL,
  `online_time` timestamp NULL DEFAULT NULL,
  `new_notification` tinyint(4) NOT NULL,
  `referral` varchar(255) NOT NULL,
  `affiliate_enabled` tinyint(1) NOT NULL,
  `affiliate_code` varchar(50) NOT NULL,
  `affiliate_earning` varchar(1024) NOT NULL,
  `affiliate_setting` varchar(1024) NOT NULL,
  `company_number` varchar(50) NOT NULL,
  `tax_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `ids`, `username`, `password`, `api_key`, `balance`, `email_address`, `email_verified`, `email_address_pending`, `phone`, `phone_verified`, `phone_pending`, `oauth_google_identifier`, `oauth_facebook_identifier`, `oauth_twitter_identifier`, `signup_source`, `first_name`, `last_name`, `company`, `avatar`, `timezone`, `date_format`, `time_format`, `language`, `currency`, `country`, `address_line_1`, `address_line_2`, `city`, `state`, `zip_code`, `role_ids`, `status`, `created_time`, `update_time`, `login_success_detail`, `online`, `online_time`, `new_notification`, `referral`, `affiliate_enabled`, `affiliate_code`, `affiliate_earning`, `affiliate_setting`, `company_number`, `tax_number`) VALUES
(1, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'superadmin', '$2y$12$C7CqeB92FgzuqMDwqKrCz.jSau2HFsC7CzUMh39YfGYy4BatmJWzW', 'pljhshumN66e81b818cbdfbki90e1190206e6cf7c97gassvv', '{\"usd\":0}', 'admin@admin.com', 1, '', '', 0, '', '', '', '', '', 'Super', 'Admin', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, NULL, NULL, '{\"time\":\"2021-05-10 05:17:08 UTC\",\"interface\":\"web\",\"ip_address\":\"45.252.73.89\",\"user_agent\":\"Chrome 90.0.4430.93\"}', 1, '2021-05-10 12:56:21', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(7, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', '', '$2y$12$cFGnCnihrIVTkRhLsLrYpegaUPEHrZ2rdGER4KFFTbt21i.pa7Ca2', 'nIEXWQcG14400e66baa44ff6a292abc0aab9f81e27UIruKtJO', '{\"usd\":0}', 'applexadmin@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'Applex', 'Admin', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', 1, '2021-04-07 21:36:03', '2021-04-07 21:36:03', '{\"time\":\"2021-04-16 14:44:26 UTC\",\"interface\":\"web\",\"ip_address\":\"157.32.114.68\",\"user_agent\":\"Chrome 89.0.4389.128\"}', 1, '2021-04-16 22:12:19', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(8, '2WaT0sB7Odc2f40837b443ef6a220af573de4b8eeGfmrz9I8g', '', '$2y$12$G33QhCqEr93PGQ3VeyYHOuiodUCd7rJMy9rj1p6yRwhOx69pvzwuq', 'WsAhiJ8kZ5da102c56a122f1e8af72151dde23b2ag26jRF4lN', '{\"usd\":0}', 'applexuser@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'applex', 'user', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-04-07 21:37:44', '2021-04-07 21:37:44', '{\"time\":\"2021-04-07 17:18:03 UTC\",\"interface\":\"web\",\"ip_address\":\"45.252.73.80\",\"user_agent\":\"Chrome 89.0.4389.105\"}', 0, '2021-04-08 00:18:03', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(9, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', '', '$2y$12$N/DWHky.x7Tj2sNUQ8PphOOtPLPlqm.eJtD79vy.uopjFGTKR8hHu', 'AwghqMjbU759d7d500a8193cf99379541111ea239j719BADXu', '{\"usd\":0}', 'applex@gmail.com', 1, '', '', 0, '', '', '', '', '', 'Applex', 'Super Admin', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, '2021-04-07 21:41:51', '2021-04-07 21:41:51', '{\"time\":\"2021-04-17 07:31:10 UTC\",\"interface\":\"web\",\"ip_address\":\"157.32.23.139\",\"user_agent\":\"Chrome 89.0.4389.128\"}', 1, '2021-04-17 14:31:34', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(10, '9WQCpcHkB118d92bef62d45e2a279edc1e7eadba7C1nxFt4rW', 'demo', '$2y$12$QRD6ZmF7eLR..cOUljUim.YEf/cCFxF9c3FH4v1Ju9Hhvol8IZ6W.', 'D1LOjZxoY118d92bef62d45e2a279edc1e7eadba7nBbe39AvF', '{\"usd\":0}', 'demosuperadmin@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'demo', 'superadmin', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, '2021-04-07 22:06:08', '2021-04-07 22:06:08', '{\"time\":\"2021-04-07 15:16:38 UTC\",\"interface\":\"web\",\"ip_address\":\"49.34.35.220\",\"user_agent\":\"Chrome 89.0.4389.114\"}', 0, '2021-04-07 22:16:39', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(12, 'TOgBpNEyz97da8025f6e437bf7b84feb145d63ac7qHXEeGZzp', 'company', '$2y$12$uof.Fx0o/lUOzo1K/E7rDe7dFCwCgHILjLIMwuCVi2exaHdtyP5cO', 'O0ZCzUNdV97da8025f6e437bf7b84feb145d63ac7GIzYVx0Ut', '{\"usd\":0}', 'test@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'test Company', '', '4', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', 1, '2021-04-13 19:26:22', '2021-04-13 19:26:22', '{\"time\":\"2021-04-14 13:37:09 UTC\",\"interface\":\"web\",\"ip_address\":\"157.32.68.162\",\"user_agent\":\"Chrome 89.0.4389.114\"}', 1, '2021-04-14 20:37:09', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(13, 'ZX76OEhQ9acd3ebff02335deac2556ae54ed62643teIaRUcxN', 'company', '$2y$12$qfTBa/yzn.KM1TWYic1e8eNd1rWYA.oK/9sCt2fk1t98s0CWs9Vs2', 'X4ODpRUZV920a6efdb07156d03afb96f5c05228ff5zmEPvkAK', '{\"usd\":0}', 'test2@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'test Company 2', '', '5', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', 1, '2021-04-13 19:30:25', '2021-04-13 19:30:25', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(14, '4G7gum6V3b162b26f13ff091ec4962d924e921cb9gEamyTsbY', '', '$2y$12$eFzhhiCSocoqw0.f6Ny/Oem3Q4sfxL3oh7ooXegA/Fjhf5vISEzoi', 'n6CgJkcSv7daeeca002e75da3d5781c7dd3d830dc4GJns7HXq', '{\"usd\":0}', 'shyam@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'shaym', 'waykule', 'Applex', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', 1, '2021-05-04 23:07:36', '2021-05-07 02:37:50', '{\"time\":\"2021-05-07 08:09:31 UTC\",\"interface\":\"web\",\"ip_address\":\"::1\",\"user_agent\":\"Chrome 90.0.4430.93\"}', 0, '2021-05-07 06:14:45', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup_log`
--
ALTER TABLE `backup_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentation`
--
ALTER TABLE `documentation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`fet_id`);

--
-- Indexes for table `file_manager`
--
ALTER TABLE `file_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `module_permission`
--
ALTER TABLE `module_permission`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_connector`
--
ALTER TABLE `oauth_connector`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`pack_id`);

--
-- Indexes for table `payment_item`
--
ALTER TABLE `payment_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_log`
--
ALTER TABLE `payment_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_purchased`
--
ALTER TABLE `payment_purchased`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_subscription`
--
ALTER TABLE `payment_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission2`
--
ALTER TABLE `permission2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `script_addons`
--
ALTER TABLE `script_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `script_license`
--
ALTER TABLE `script_license`
  ADD PRIMARY KEY (`SETTING_ID`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `throttling`
--
ALTER TABLE `throttling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `backup_log`
--
ALTER TABLE `backup_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documentation`
--
ALTER TABLE `documentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `fet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `file_manager`
--
ALTER TABLE `file_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `module_permission`
--
ALTER TABLE `module_permission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=528;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_connector`
--
ALTER TABLE `oauth_connector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_item`
--
ALTER TABLE `payment_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_log`
--
ALTER TABLE `payment_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_purchased`
--
ALTER TABLE `payment_purchased`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_subscription`
--
ALTER TABLE `payment_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permission2`
--
ALTER TABLE `permission2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `script_addons`
--
ALTER TABLE `script_addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `script_license`
--
ALTER TABLE `script_license`
  MODIFY `SETTING_ID` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `throttling`
--
ALTER TABLE `throttling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
