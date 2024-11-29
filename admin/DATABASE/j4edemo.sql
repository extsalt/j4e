-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2021 at 10:03 PM
-- Server version: 5.7.35
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `view360_j4edemo`
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
(98, '', 'Warning', 'signin-failed', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\",\"username\":\"superadmin\"}', '', '2021-05-04 23:14:17'),
(99, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-04 23:14:24'),
(100, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-05 22:25:44'),
(101, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-06 03:35:20'),
(102, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-06 22:43:38'),
(104, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 01:46:27'),
(106, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 02:03:30'),
(109, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 02:36:24'),
(113, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 06:15:07'),
(114, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"::1\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-07 23:55:35'),
(115, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.66.11\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 8.1\"}', '', '2021-05-10 12:09:37'),
(116, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"45.252.73.89\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.93\",\"platform\":\"Windows 10\"}', '', '2021-05-10 12:17:08'),
(117, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.13.35\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-17 20:47:38'),
(118, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.114.99\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-17 21:09:51'),
(119, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.13.35\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-17 22:54:52'),
(120, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"45.252.73.82\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-18 12:41:15'),
(121, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.115.104\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-19 21:30:06'),
(122, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"106.79.208.121\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 7\"}', '', '2021-05-20 13:07:08'),
(123, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.69.160\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-20 13:07:41'),
(124, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.69.160\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-20 16:17:59'),
(125, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.97.34\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-22 08:18:16'),
(126, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.97.34\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-22 09:45:23'),
(127, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.96.67\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-22 20:54:45'),
(128, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"45.252.73.83\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-26 17:27:45'),
(129, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.187.46\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"90.0.4430.212\",\"platform\":\"Windows 10\"}', '', '2021-05-28 01:24:10'),
(130, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"54.86.50.139\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\"}', '', '2021-05-28 01:47:46'),
(131, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"54.86.50.139\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\"}', '', '2021-05-28 01:50:56'),
(132, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.221.147\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\"}', '', '2021-06-12 19:17:42'),
(133, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.221.147\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\"}', '', '2021-06-12 19:24:59'),
(134, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.221.147\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\"}', '', '2021-06-12 19:25:23'),
(135, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.221.147\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\"}', '', '2021-06-12 19:25:57'),
(136, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.221.147\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\"}', '', '2021-06-12 19:26:16'),
(137, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 'Information', 'signin-success', '{\"ip\":\"157.40.221.147\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\"}', '', '2021-06-12 19:37:51'),
(138, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.200.111\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-12 22:18:10'),
(139, '2WaT0sB7Odc2f40837b443ef6a220af573de4b8eeGfmrz9I8g', 'Information', 'update-user-setting', '{\"ip\":\"157.40.200.111\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-12 22:22:05'),
(140, '2WaT0sB7Odc2f40837b443ef6a220af573de4b8eeGfmrz9I8g', 'Information', 'update-user-profile', '{\"ip\":\"157.40.200.111\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-12 22:22:16'),
(141, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.200.111\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-12 22:40:03'),
(142, '5jRzJw6LO637a2aad358c482cc2bd5a646c2df8e2qNFgIDluc', 'Information', 'signup-success', '{\"ip\":\"157.40.200.111\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"email_address\":\"patrapankaj36@gmail.com\",\"user_status\":1}', '', '2021-06-13 01:01:21'),
(143, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.200.111\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\"}', '', '2021-06-13 01:05:30'),
(144, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.202.251\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-13 11:43:11'),
(145, '5jRzJw6LO637a2aad358c482cc2bd5a646c2df8e2qNFgIDluc', 'Information', 'signin-success', '{\"ip\":\"157.40.202.251\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-13 12:32:20'),
(146, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.202.251\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-13 12:37:58'),
(147, '5jRzJw6LO637a2aad358c482cc2bd5a646c2df8e2qNFgIDluc', 'Information', 'signin-success', '{\"ip\":\"157.40.202.251\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-13 12:39:55'),
(148, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.202.251\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-13 12:40:00'),
(149, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.187.254\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-13 19:13:14'),
(150, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"45.252.73.93\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.77\",\"platform\":\"Windows 10\"}', '', '2021-06-13 19:33:16'),
(151, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.187.254\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-14 01:52:05'),
(152, 'Pn93HhwVT6e37669e8011a5ee4f563d126b980665XSuiChqQ0', 'Information', 'signup-success', '{\"ip\":\"117.247.64.123\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"email_address\":\"pankaj.ssconline@gmail.com\",\"user_status\":1}', '', '2021-06-14 12:03:44'),
(153, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"117.247.64.123\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-14 12:47:39'),
(154, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.191.67\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-14 20:04:02'),
(155, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'update-user-profile', '{\"ip\":\"157.40.191.67\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-15 00:48:02'),
(156, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'update-user-profile', '{\"ip\":\"157.40.191.67\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-15 01:12:43'),
(157, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.183.9\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.101\",\"platform\":\"Windows 10\"}', '', '2021-06-15 22:03:52'),
(158, 'SP0nJjd7b3a7bb9d1952068735c6fe059412baac32Pid3yAp8', 'Information', 'signup-success', '{\"ip\":\"157.40.183.9\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9933665936\",\"user_status\":1}', '', '2021-06-16 01:34:44'),
(159, 'QJArpZSfN4605b3734bc45ebec0423d28a8a84f21piPQRJbEn', 'Information', 'signup-success', '{\"ip\":\"157.40.183.9\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9933665936\",\"user_status\":1}', '', '2021-06-16 01:35:58'),
(160, '5EmTZyfAocc13192bc6e669caca4502a0e9a0971by0OVTLKIY', 'Information', 'signup-success', '{\"ip\":\"157.40.183.9\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9933665936\",\"user_status\":1}', '', '2021-06-16 01:36:14'),
(161, 'OY3Eubkhie3768b1099a53fe1a03fe7f71cee734e57u3FIvcW', 'Information', 'signup-success', '{\"ip\":\"157.40.183.9\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9933665936\",\"user_status\":1}', '', '2021-06-16 01:37:22'),
(162, 'qIhH8u4Wa27fc17f5153f5e080d405ebfab3dce71OUKveRGLS', 'Information', 'signup-success', '{\"ip\":\"157.40.183.9\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9933661212\",\"user_status\":1}', '', '2021-06-16 01:39:40'),
(163, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.171.137\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.106\",\"platform\":\"Windows 10\"}', '', '2021-06-17 20:50:00'),
(164, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.75.6\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.106\",\"platform\":\"Windows 10\"}', '', '2021-06-19 01:19:10'),
(165, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.148.170\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.106\",\"platform\":\"Windows 10\"}', '', '2021-06-20 22:24:27'),
(166, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.148.170\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.106\",\"platform\":\"Windows 10\"}', '', '2021-06-21 01:18:28'),
(167, 'QVq8ktMKG1b0c4c6292b48dbe1430443568ee78a4FwMTYUHth', 'Information', 'signup-success', '{\"ip\":\"103.240.204.20\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"7600782146\",\"user_status\":1}', '', '2021-06-22 15:43:27'),
(168, 'PuCM4tZIJ844477212b07cb5b129f94beaab6d673Th0yklxdj', 'Information', 'signup-success', '{\"ip\":\"110.227.239.44\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"7600782147\",\"user_status\":1}', '', '2021-06-22 23:50:10'),
(169, 'MoCRvldOAaa370ffcaf27c42b7bb91e4f4dffda1djc8QG5PtX', 'Information', 'signup-success', '{\"ip\":\"150.129.200.35\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9909999099\",\"user_status\":1}', '', '2021-06-23 00:31:16'),
(170, 'oE8YqwcZLbc7f4b3c21b0c6c1b875afff0f7493f5dQYUwhNDf', 'Information', 'signup-success', '{\"ip\":\"45.252.73.91\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"7350123885\",\"user_status\":1}', '', '2021-06-23 21:07:48'),
(171, 'P8m2JfYXx0db1b88ee5a71b291ab1bd9509d06572qRL7ThbN6', 'Information', 'signup-success', '{\"ip\":\"157.40.135.60\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9933661211\",\"user_status\":1}', '', '2021-06-23 21:08:18'),
(172, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.135.60\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.114\",\"platform\":\"Windows 10\"}', '', '2021-06-24 00:26:41'),
(173, 'pHMYVOyI8c03875d6e8908300070fb0201b92c192l5RFAQjLY', 'Information', 'signup-success', '{\"ip\":\"103.92.115.101\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9021930571\",\"user_status\":1}', '', '2021-06-25 00:10:47'),
(174, 'kQOVNaIdSebd3778a22cf68229e795b8920dca2405s6pTLS1l', 'Information', 'signup-success', '{\"ip\":\"110.227.239.44\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"7600782149\",\"user_status\":1}', '', '2021-06-29 04:31:17'),
(175, 'ELB0DIvzy9d8cd233938cf0a1cbc84a4ca7fc93c16cFSjVECA', 'Information', 'signup-success', '{\"ip\":\"106.220.180.27\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9890607998\",\"user_status\":1}', '', '2021-06-29 12:24:43'),
(176, 'Qje1DhgJEaf49de5bdd0535ac26697aeebcf59e2fMYEycrgKJ', 'Information', 'signup-success', '{\"ip\":\"45.252.73.91\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"7350123885\",\"user_status\":1}', '', '2021-06-29 14:46:02'),
(177, 'IACRxzBT7041d10575a84fa8174acf27d10eab02cnO2NGL0t3', 'Information', 'signup-success', '{\"ip\":\"106.220.180.27\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"2262336663\",\"user_status\":1}', '', '2021-06-29 18:12:27'),
(178, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.139.180\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.114\",\"platform\":\"Windows 10\"}', '', '2021-06-29 20:41:58'),
(179, 'elFghOY1Pfcc288d4e81af23eab0383f59d1fe00dA6NIBFU5v', 'Information', 'signup-success', '{\"ip\":\"45.252.73.91\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9270058385\",\"user_status\":1}', '', '2021-06-30 13:58:04'),
(180, 'sHlhXV3TO8cd3bcc52cd36215b2857e91147f1ba3v46nM7akS', 'Information', 'signup-success', '{\"ip\":\"45.252.73.91\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"8999896764\",\"user_status\":1}', '', '2021-06-30 13:59:54'),
(181, 'sh1UtxcrX226c618954dbda26c5625327e21dabbbBpXOqYeVK', 'Information', 'signup-success', '{\"ip\":\"54.86.50.139\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9898989898\",\"user_status\":1}', '', '2021-06-30 14:07:40'),
(182, 'sbSAPd6rz66890d6f3284dca66f61ca1fe1f6a3f7M8d30aHs6', 'Information', 'signup-success', '{\"ip\":\"106.195.11.173\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9890607988\",\"user_status\":1}', '', '2021-06-30 16:40:30'),
(183, 'gb2o6nANX14bd44269d9945c2e489d78add57a9ecj1U7258Rv', 'Information', 'signup-success', '{\"ip\":\"106.195.11.173\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9945666668\",\"user_status\":1}', '', '2021-06-30 16:52:21'),
(184, 'tzNR6HYFa155098001ec0fdeedd4dc3010f1c784eUGhWex1Eu', 'Information', 'signup-success', '{\"ip\":\"106.195.11.173\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9890607999\",\"user_status\":1}', '', '2021-06-30 17:30:18'),
(185, 'NUnFbAL3059401bad81fe7a5ffc44f61678ccb019Apb63IxV8', 'Information', 'signup-success', '{\"ip\":\"182.70.69.45\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9850325204\",\"user_status\":1}', '', '2021-06-30 18:26:44');
INSERT INTO `activity` (`id`, `user_ids`, `level`, `event`, `detail`, `debug_detail`, `created_time`) VALUES
(186, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"45.252.73.91\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.114\",\"platform\":\"Windows 10\"}', '', '2021-06-30 22:35:25'),
(187, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.157.100\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.114\",\"platform\":\"Windows 10\"}', '', '2021-06-30 22:53:14'),
(188, 'zfVeaKqsh6774e1439fcbd72770063df302d64a29IO9mdJuFa', 'Information', 'signup-success', '{\"ip\":\"150.129.200.43\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"7984862327\",\"user_status\":1}', '', '2021-07-02 17:27:38'),
(189, '3muJiM8rH4664d1e464248c793713ff03a8d9348fz94V1al0c', 'Information', 'signup-success', '{\"ip\":\"150.129.200.43\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9988552255\",\"user_status\":1}', '', '2021-07-02 17:28:07'),
(190, 'EDwnxc8SM0570f7b8b95d52f671d76a22213efb27v7NzPTEBZ', 'Information', 'signup-success', '{\"ip\":\"45.252.73.91\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9899998999\",\"user_status\":1}', '', '2021-07-02 21:12:00'),
(191, 't3jVpIKDN80ec58e6b7037db22df982805169ba4aLjm7d85yb', 'Information', 'signup-success', '{\"ip\":\"203.194.104.112\",\"is_mobile\":false,\"is_browser\":false,\"browser_name\":\"\",\"browser_version\":\"\",\"platform\":\"Unknown Platform\",\"mobile\":\"9673304412\",\"user_status\":1}', '', '2021-07-03 10:09:52'),
(192, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.142.39\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-05 21:26:00'),
(193, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.33.217.149\",\"is_mobile\":true,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.120\",\"platform\":\"Android\"}', '', '2021-07-07 17:12:59'),
(194, '', 'Warning', 'signin-failed', '{\"ip\":\"49.37.45.249\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\",\"username\":\"SUPERADMIN\"}', '', '2021-07-08 17:29:50'),
(195, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"49.37.45.249\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-08 17:30:01'),
(196, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.74.29\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-09 13:47:34'),
(197, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.33.4.153\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-09 15:54:07'),
(198, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.179.37\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-09 19:50:43'),
(199, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.89.19\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-10 11:16:01'),
(203, '9Z4CHa3mf5001b6b14835cc716333ef9cc3dd5e61dmnpN60H2', 'Information', 'signup-success', '{\"ip\":\"152.57.89.19\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\",\"email_address\":\"jadhav.aish@gmail.com\",\"user_status\":1}', '', '2021-07-10 12:26:37'),
(204, '9Z4CHa3mf5001b6b14835cc716333ef9cc3dd5e61dmnpN60H2', 'Information', 'update-user-profile', '{\"ip\":\"152.57.89.19\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-10 14:23:30'),
(205, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.43.252.174\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-12 10:49:48'),
(206, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.33.32.51\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-12 11:22:08'),
(207, '9Z4CHa3mf5001b6b14835cc716333ef9cc3dd5e61dmnpN60H2', 'Information', 'update-user-setting', '{\"ip\":\"157.33.32.51\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-12 12:56:23'),
(208, '9Z4CHa3mf5001b6b14835cc716333ef9cc3dd5e61dmnpN60H2', 'Information', 'update-user-setting', '{\"ip\":\"157.33.32.51\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-12 12:57:05'),
(209, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.33.43.195\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-13 19:11:33'),
(210, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.33.2.36\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-16 15:53:30'),
(211, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.33.48.217\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-19 11:27:40'),
(212, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.14.189\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.124\",\"platform\":\"Windows 10\"}', '', '2021-07-20 17:06:32'),
(213, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.26\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\",\"username\":\"applex@gmail.com\"}', '', '2021-07-23 12:27:28'),
(214, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.26\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\",\"username\":\"applexadmin@gmail.com\"}', '', '2021-07-23 12:27:46'),
(215, '', 'Warning', 'signin-failed', '{\"ip\":\"157.40.213.8\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-07-26 20:44:57'),
(216, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.213.8\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-26 20:45:12'),
(217, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.33.221.33\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.164\",\"platform\":\"Windows 10\"}', '', '2021-07-29 11:36:01'),
(218, 'z3QlePxK6b688e51e15965983bb892f812b5fe4d5p2DfHRxz3', 'Information', 'update-user-profile', '{\"ip\":\"157.33.221.33\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.164\",\"platform\":\"Windows 10\"}', '', '2021-07-29 11:40:13'),
(219, 'K8sPD4XZx3a5f4b4d6084487094d28dae2683034d2sogZiE7O', 'Information', 'update-user-profile', '{\"ip\":\"157.33.36.89\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.164\",\"platform\":\"Windows 10\"}', '', '2021-07-29 12:40:57'),
(220, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"152.57.42.15\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"91.0.4472.164\",\"platform\":\"Windows 10\"}', '', '2021-07-29 21:45:24'),
(221, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.33.78.244\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-30 11:21:15'),
(222, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.27\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\",\"username\":\"admin@admin.com\"}', '', '2021-07-30 17:22:05'),
(223, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.27\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\",\"username\":\"admin@admin.com\"}', '', '2021-07-30 17:22:12'),
(224, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.192.143\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-31 00:10:31'),
(225, 'izvTj6t0w151e4fcb8343965ffec76bb4de1322delLO2QpnCg', 'Information', 'signin-success', '{\"ip\":\"157.40.192.143\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-31 00:14:48'),
(226, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.192.143\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-31 00:15:04'),
(227, '5wG2BH4PW14d2e1547b4d8a3306f8e4ca72d01f27VPNXadzgx', 'Information', 'signup-success', '{\"ip\":\"157.40.192.143\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\",\"email_address\":\"pankaj.ssconline@gmail.com\",\"user_status\":1}', '', '2021-07-31 00:15:56'),
(228, '5wG2BH4PW14d2e1547b4d8a3306f8e4ca72d01f27VPNXadzgx', 'Information', 'signin-success', '{\"ip\":\"157.40.192.143\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-31 00:18:14'),
(229, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.192.143\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-31 00:19:12'),
(230, '5wG2BH4PW14d2e1547b4d8a3306f8e4ca72d01f27VPNXadzgx', 'Information', 'update-user-profile', '{\"ip\":\"157.40.192.143\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-31 00:44:25'),
(231, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"157.40.211.237\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-31 22:28:55'),
(232, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'update-password', '{\"ip\":\"157.40.211.237\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\"}', '', '2021-07-31 22:52:19'),
(233, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-08-03 18:45:46'),
(234, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-08-03 18:45:52'),
(235, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-08-03 18:45:57'),
(236, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-08-03 18:46:51'),
(237, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-08-03 18:46:58'),
(238, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-08-03 18:47:09'),
(239, '', 'Warning', 'signin-failed', '{\"ip\":\"116.75.168.76\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.107\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-08-03 18:47:38'),
(240, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-08-03 18:52:40'),
(241, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"superadmin\"}', '', '2021-08-03 18:53:31'),
(242, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"admin@admin.com\"}', '', '2021-08-03 18:53:47'),
(243, '', 'Warning', 'signin-failed', '{\"ip\":\"150.129.200.17\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\",\"username\":\"applexadmin\"}', '', '2021-08-03 19:09:28'),
(244, '5wG2BH4PW14d2e1547b4d8a3306f8e4ca72d01f27VPNXadzgx', 'Information', 'signin-success', '{\"ip\":\"150.129.200.63\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Windows 10\"}', '', '2021-08-04 11:40:00'),
(245, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'Information', 'signin-success', '{\"ip\":\"116.75.168.76\",\"is_mobile\":true,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"92.0.4515.131\",\"platform\":\"Android\"}', '', '2021-08-07 14:35:57');

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
(2, 'PY8HdSDlqf18eb192e34b018b82b600932577e084slbVFi2w4', 'backup_Partially_20210504132158_t0zKID.zip', 'Partially Download', 'Manual', '2021-05-04 07:51:58'),
(3, 'rWqvkmjcJ8662340fbb76dc4bcc10b4aa9d58ad49v7YxfqgIT', 'backup_Fully_20210613045719_YQlXu5.zip', 'Fully Download', 'Manual', '2021-06-13 11:57:19');

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
-- Table structure for table `buddies`
--

CREATE TABLE `buddies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buddy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buddies`
--

INSERT INTO `buddies` (`id`, `user_id`, `buddy_id`) VALUES
(1, 99, 98),
(2, 98, 99),
(9, 102, 74),
(10, 74, 102),
(11, 76, 72),
(12, 72, 76),
(13, 73, 72),
(14, 72, 73),
(15, 77, 72),
(16, 72, 77),
(17, 73, 74),
(18, 74, 73),
(19, 74, 77),
(20, 77, 74),
(21, 79, 73),
(22, 73, 79),
(23, 74, 81),
(24, 81, 74),
(25, 74, 82),
(26, 82, 74),
(27, 75, 82),
(28, 82, 75),
(29, 72, 82),
(30, 82, 72),
(31, 72, 74),
(32, 74, 72),
(33, 74, 83),
(34, 83, 74),
(35, 82, 81),
(36, 81, 82),
(37, 82, 80),
(38, 80, 82),
(39, 84, 74),
(40, 74, 84),
(41, 74, 98),
(42, 98, 74),
(43, 124, 82),
(44, 82, 124),
(45, 82, 122),
(46, 122, 82);

-- --------------------------------------------------------

--
-- Table structure for table `business_transaction`
--

CREATE TABLE `business_transaction` (
  `bns_trans_id` int(11) NOT NULL,
  `bns_trans_mode` varchar(10) NOT NULL,
  `bns_trans_type` varchar(10) NOT NULL,
  `bns_trans_ids` text NOT NULL,
  `bns_trans_touser` int(11) NOT NULL,
  `bns_trans_byuser` int(11) NOT NULL,
  `bns_trans_amount` float NOT NULL,
  `bns_trans_title` text NOT NULL,
  `bns_trans_remark` text NOT NULL,
  `bns_trans_date` varchar(30) NOT NULL,
  `bns_trans_status` enum('1','2') NOT NULL COMMENT '''1''=pendind,''2''=approved',
  `bns_trans_creatat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_transaction`
--

INSERT INTO `business_transaction` (`bns_trans_id`, `bns_trans_mode`, `bns_trans_type`, `bns_trans_ids`, `bns_trans_touser`, `bns_trans_byuser`, `bns_trans_amount`, `bns_trans_title`, `bns_trans_remark`, `bns_trans_date`, `bns_trans_status`, `bns_trans_creatat`) VALUES
(1, 'Offline', 'Received', '123456', 103, 98, 500, 'DEmo Payment', 'DEMO MSG', '07-08-2021', '2', '2021-08-07 03:19:45'),
(2, 'Offline', 'Received', '123456', 103, 98, 500, 'DEmo Payment', 'DEMO MSG', '07-08-2021', '2', '2021-08-07 03:29:38'),
(3, 'Offline', 'Given', '123456', 98, 103, 500, 'DEmo Payment', 'DEMO MSG', '07-08-2021', '1', '2021-08-07 03:47:32');

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
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `id` int(11) NOT NULL,
  `request_to` int(11) DEFAULT NULL,
  `request_from` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '''1''=''accept'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `connection`
--

INSERT INTO `connection` (`id`, `request_to`, `request_from`, `status`) VALUES
(21, 76, 72, 1),
(22, 73, 72, 1),
(23, 72, 77, 1),
(24, 73, 74, 1),
(25, 74, 77, 1),
(26, 79, 73, 1),
(28, 79, 77, 0),
(29, 79, 75, 0),
(30, 72, 79, 0),
(31, 74, 81, 1),
(32, 74, 82, 1),
(33, 66, 73, 0),
(35, 82, 75, 1),
(36, 72, 82, 1),
(37, 72, 74, 1),
(38, 74, 83, 1),
(40, 82, 81, 1),
(41, 82, 80, 1),
(42, 84, 75, 0),
(44, 84, 74, 1),
(46, 99, 98, 1),
(48, 74, 98, 1),
(49, 103, 85, 0),
(53, 102, 74, 1),
(55, 112, 112, 0),
(56, 82, 122, 1),
(57, 99, 125, 0),
(58, 82, 121, 0),
(59, 99, 1, 0),
(60, 99, 72, 0),
(61, 124, 82, 1),
(62, 99, 73, 0);

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
(10, 'Gold', 'GSO75uzUj942d4d35f988dbed0c7d7dcf2721200euPtwD501Q', 0),
(11, 'Silver', 'EfVXqJAj7a9c7dd3ff6662a51f049b507814d6c97x32fInT1a', 0),
(12, 'Benefits', 'hjBXQycnl3760b240a19ea4f3a76475476d922de3CqEhOw8yN', 0);

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
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gallery_type` int(11) DEFAULT NULL COMMENT '1-profile Gallery,2-Event Gallery',
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `gallery_type`, `user_id`, `status`, `doe`) VALUES
(1, '1623150543_agnibina25.jpg', 1, 72, 1, '2021-07-27 19:53:01'),
(2, '1623150543_agnibina26.jpg', 1, 72, 1, '2021-07-27 19:57:15'),
(3, 'businee.jpg', 1, 72, 1, '2021-07-28 07:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(1) NOT NULL,
  `user_id` int(1) DEFAULT NULL,
  `key` varchar(40) DEFAULT NULL,
  `level` int(2) DEFAULT NULL,
  `ignore_limits` int(2) DEFAULT NULL,
  `is_private_key` int(1) DEFAULT NULL,
  `ip_addresses` varchar(3) DEFAULT NULL,
  `date_created` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, '8cb2237d0679ca88db6464eac60da96345513964', 10, 10, 1, '::1', 0);

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
(61, 'Features', 'packages/managefeature', 58, '1', 'NxZI9f4Vsfba220bdf84fb04253100f3de0adbdf0znsKfVFtB'),
(62, 'User Ratings', 'admin/users_ratings', 5, '1', 'i5RQFeY4wce45f13feb0713ab5a60af90ce0663c5sieIuN0zL'),
(63, 'User Reviews', 'admin/user_reviews', 5, '1', 'oZHx2fJPF946603b782916496b16827dcc6721135bntSBJmNg'),
(64, 'Report', 'report', 0, '1', 'L8iGCbgUF69bffdd891760ae123be0acd355d5867FJ3jclmYd'),
(65, 'Requirement', 'admin/requirement', 5, '1', 'EBwvq9Wasaa5784b5052010e38379f5b1a1489b2flAz24gaCF'),
(66, 'Reward Points', 'admin/reward_point', 5, '1', '1d7GwK0bP8cbc9bea136ae59bc7b7914fde0b043e7dqzfeo4K'),
(67, 'Post', 'admin/post', 5, '1', 'RYwrK2FV7e1edbd5d4ec770c55e4dec0136b8f74dMQGViYTc2'),
(68, 'J4E Event', 'events', 0, '1', 'mhlDdcXkH72ea97f710b8bdd314b85624716c38c8spwTD6b2o'),
(69, 'My Diary', 'admin/mydiary', 5, '1', 'YloASxWw45a6deaddbc10e29dcd3576db78a59bafcZP0E74Qm'),
(70, 'Pending Responsibility', 'admin/pending_responsibility', 5, '1', 'GhouDX8sCe919451fe566829967a7169802bb00c4fs4z6CjtH'),
(71, 'Chat', 'chat', 0, '1', 'y3iGl7Xpue87606727ef69a93ce8b5b2642bb4f6aDeMxnwfZF');

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
(18, 5, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '1', '1', '1', '1'),
(19, 5, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(20, 5, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '1', '1', '1', '1'),
(21, 6, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(22, 6, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(23, 6, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(24, 6, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '1', '1', '1', '1'),
(31, 7, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(32, 7, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '1', '1', '1', '1'),
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
(527, 62, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(528, 1, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '1', '2', '2', '2'),
(529, 5, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(530, 6, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(531, 7, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(532, 8, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(533, 9, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(534, 10, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(535, 11, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(536, 12, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(537, 15, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(538, 16, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(539, 17, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(540, 18, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(541, 19, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(542, 20, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(543, 21, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(544, 22, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(545, 23, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(546, 24, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(547, 25, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(548, 26, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(549, 27, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(550, 28, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(551, 29, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(552, 30, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(553, 31, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(554, 32, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(555, 33, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(556, 34, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(557, 35, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(558, 36, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(559, 37, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(560, 38, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(561, 39, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(562, 40, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(563, 41, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(564, 42, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(565, 43, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(566, 44, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(567, 45, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(568, 46, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(569, 47, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(570, 48, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(571, 49, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(572, 50, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(573, 51, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(574, 52, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(575, 53, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(576, 58, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(577, 59, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(578, 61, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(579, 62, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(580, 62, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(581, 62, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(582, 62, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(583, 62, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(584, 62, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(585, 62, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(586, 62, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(587, 62, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(588, 63, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(589, 63, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(590, 63, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(591, 63, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(592, 63, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(593, 63, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(594, 63, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(595, 63, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(596, 63, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(597, 64, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(598, 64, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(599, 64, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(600, 64, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(601, 64, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(602, 64, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(603, 64, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(604, 64, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(605, 64, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(606, 65, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(607, 65, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(608, 65, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(609, 65, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(610, 65, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(611, 65, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(612, 65, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(613, 65, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(614, 65, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(615, 66, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(616, 66, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(617, 66, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(618, 66, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(619, 66, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(620, 66, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(621, 66, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(622, 66, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(623, 66, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(624, 67, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(625, 67, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(626, 67, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(627, 67, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(628, 67, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(629, 67, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(630, 67, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(631, 67, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(632, 67, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(633, 68, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(634, 68, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(635, 68, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(636, 68, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(637, 68, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(638, 68, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(639, 68, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(640, 68, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(641, 68, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(642, 69, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(643, 69, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(644, 69, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(645, 69, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(646, 69, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(647, 69, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(648, 69, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(649, 69, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(650, 69, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(651, 70, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(652, 70, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(653, 70, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(654, 70, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(655, 70, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(656, 70, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(657, 70, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(658, 70, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2');
INSERT INTO `module_permission` (`per_id`, `menu_id`, `role_id`, `view_per`, `create_per`, `edit_per`, `delete_per`) VALUES
(659, 70, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2'),
(660, 71, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(661, 71, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(662, 71, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(663, 71, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', '2', '2', '2', '2'),
(664, 71, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(665, 71, '9ixKCAQjf7fa5e7b4ddb067a108781ce982fe194e5RDcF4gHp', '2', '2', '2', '2'),
(666, 71, 'MAksjL6TEdb8e6081965e6b82571cf5bad7e4d4fbCiuJLmF0c', '2', '2', '2', '2'),
(667, 71, 'EwgMFSDVCdb6a751d0ceff8775879097a1568700aS4x5IT90L', '2', '2', '2', '2'),
(668, 71, '1VvJaMOndd928c1f90f78a33c834a4425992335f5AH80QjqJK', '2', '2', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `ids` varchar(50) NOT NULL,
  `by_user_ids` varchar(32) NOT NULL,
  `to_user_ids` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `is_read` tinyint(4) NOT NULL COMMENT '1 = read',
  `send_email` tinyint(4) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `read_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `ids`, `by_user_ids`, `to_user_ids`, `subject`, `body`, `is_read`, `send_email`, `created_time`, `read_time`) VALUES
(1, 'QJMG0Zz7O9d235f4eb5ea41213fecafaf06e294ebUnocgLuNa', '99', '125', 'New Connection Request', 'Lead Request', 0, NULL, '2021-08-05 05:31:28', '2021-08-05 05:31:28'),
(2, 'L8k3avytC043147ff970785f3005bc2dcde9def582ufSJQaB0', '82', '121', 'New Connection Request', 'Lead Request', 0, NULL, '2021-08-05 07:11:31', '2021-08-05 07:11:31'),
(3, 'h0WCyAZbUc90c7ffa09bb24eed3594b29fb4e11d2iUBaymh2z', '99', '1', 'New Connection Request', 'Lead Request', 0, NULL, '2021-08-05 12:21:20', '2021-08-05 12:21:20'),
(4, '7oMv93exP0ad33b88a5a215fe146bfc65a39b4313w3RGI9K1D', '99', '72', 'New Connection Request', 'Lead Request', 0, NULL, '2021-08-05 12:21:40', '2021-08-05 12:21:40'),
(5, '5Pb0ZGc4We3f59ceee4d56a3e7deb9a552c47e117dDM8HbXil', '124', '82', 'New Connection Request', 'Lead Request', 0, NULL, '2021-08-06 09:36:02', '2021-08-06 09:36:02'),
(6, 'JdScHfbVs726b2886c21ec47c9df2799c556c3bcbNcyKdI3qB', '82', '124', 'Connection Request Accepted', 'Lead Request', 0, NULL, '2021-08-06 13:24:30', '2021-08-06 13:24:30'),
(7, 'kcr6jNUKBd44e34b0374ba975bb46ace7f437a604gWclC5xNO', '122', '82', 'Connection Request Accepted', 'Lead Request', 0, NULL, '2021-08-07 10:00:30', '2021-08-07 10:00:30'),
(8, 'WLgK6EYMs24fddf082c38af2c2cf2c3b4df4e96fbGk1KX8AI6', '103', '98', 'Business Transaction Request', 'Transaction Request', 0, NULL, '2021-08-07 10:47:32', '2021-08-07 10:47:32'),
(9, 'aB6W3g8rn47aaeff7347033e7eb59647f34513e0cO5IH4U6wF', '99', '73', 'New Connection Request', 'Lead Request', 0, NULL, '2021-08-10 04:30:31', '2021-08-10 04:30:31');

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
  `pack_desc` longtext NOT NULL COMMENT 'benifits',
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
(1, 'Guest Member', '<p>TEST</p>', 0, 'Yearly', '10/12', '2021-07-08 10:31:03', '6', 'bZ6F9Wg7M82488b05a0387e135d20d845a3215eeai18WnxNZG'),
(9, 'Be A Member', '<p>Hello</p>', 35000, 'Yearly', '10', '2021-07-29 04:55:17', '12', 'd2PVszfmUdb8b2f9a8bc9fcfca3e73baf4441dbccpK8WrbxAB');

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

--
-- Dumping data for table `permission2`
--

INSERT INTO `permission2` (`id`, `ids`, `ids_role`, `ids_menu`, `view`, `create`, `edit`, `delete`) VALUES
(1, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '1', 1, 1, 1, 1),
(2, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '5', 1, 1, 1, 1),
(3, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '6', 1, 1, 1, 1),
(4, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '7', 1, 1, 1, 1),
(5, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '8', 1, 1, 1, 1),
(6, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '9', 1, 1, 1, 1),
(7, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '10', 1, 1, 1, 1),
(8, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '11', 2, 2, 2, 2),
(9, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '12', 2, 2, 2, 2),
(10, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '15', 2, 2, 2, 2),
(11, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '16', 2, 2, 2, 2),
(12, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '17', 1, 1, 1, 1),
(13, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '18', 1, 1, 1, 1),
(14, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '19', 1, 1, 1, 1),
(15, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '20', 1, 1, 1, 1),
(16, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '21', 1, 1, 1, 1),
(17, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '26', 1, 1, 1, 1),
(18, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '27', 1, 1, 1, 1),
(19, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '28', 1, 1, 1, 1),
(20, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '29', 1, 1, 1, 1),
(21, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '30', 1, 1, 1, 1),
(22, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '31', 1, 1, 1, 1),
(23, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '32', 1, 1, 1, 1),
(24, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '33', 1, 1, 1, 1),
(25, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '34', 1, 1, 1, 1),
(26, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '22', 1, 1, 1, 1),
(27, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '35', 1, 1, 1, 1),
(28, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '36', 1, 1, 1, 1),
(29, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '37', 1, 1, 1, 1),
(30, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '38', 1, 1, 1, 1),
(31, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '39', 1, 1, 1, 1),
(32, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '23', 1, 1, 1, 1),
(33, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '40', 1, 1, 1, 1),
(34, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '41', 1, 1, 1, 1),
(35, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '42', 1, 1, 1, 1),
(36, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '43', 1, 1, 1, 1),
(37, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '24', 1, 1, 1, 1),
(38, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '44', 1, 1, 1, 1),
(39, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '45', 1, 1, 1, 1),
(40, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '46', 1, 1, 1, 1),
(41, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '47', 1, 1, 1, 1),
(42, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '48', 1, 1, 1, 1),
(43, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '49', 1, 1, 1, 1),
(44, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '50', 1, 1, 1, 1),
(45, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '51', 1, 1, 1, 1),
(46, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '52', 1, 1, 1, 1),
(47, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '53', 1, 1, 1, 1),
(48, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '25', 1, 1, 1, 1),
(49, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '58', 2, 2, 2, 2),
(50, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '59', 1, 1, 1, 1),
(51, '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '61', 1, 1, 1, 1),
(52, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '1', 1, 1, 1, 1),
(53, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '5', 1, 1, 1, 1),
(54, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '6', 1, 1, 1, 1),
(55, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '7', 1, 1, 1, 1),
(56, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '8', 1, 1, 1, 1),
(57, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '9', 1, 1, 1, 1),
(58, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '10', 1, 1, 1, 1),
(59, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '11', 1, 1, 1, 1),
(60, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '12', 1, 1, 1, 1),
(61, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '15', 1, 1, 1, 1),
(62, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '16', 1, 1, 1, 1),
(63, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '17', 1, 1, 1, 1),
(64, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '18', 1, 1, 1, 1),
(65, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '19', 1, 1, 1, 1),
(66, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '20', 2, 2, 2, 2),
(67, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '21', 2, 2, 2, 2),
(68, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '26', 2, 2, 2, 2),
(69, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '27', 2, 2, 2, 2),
(70, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '28', 2, 2, 2, 2),
(71, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '29', 2, 2, 2, 2),
(72, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '30', 2, 2, 2, 2),
(73, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '31', 2, 2, 2, 2),
(74, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '32', 2, 2, 2, 2),
(75, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '33', 2, 2, 2, 2),
(76, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '34', 2, 2, 2, 2),
(77, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '22', 2, 2, 2, 2),
(78, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '35', 2, 2, 2, 2),
(79, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '36', 2, 2, 2, 2),
(80, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '37', 2, 2, 2, 2),
(81, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '38', 2, 2, 2, 2),
(82, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '39', 2, 2, 2, 2),
(83, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '23', 2, 2, 2, 2),
(84, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '40', 2, 2, 2, 2),
(85, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '41', 2, 2, 2, 2),
(86, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '42', 2, 2, 2, 2),
(87, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '43', 2, 2, 2, 2),
(88, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '24', 2, 2, 2, 2),
(89, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '44', 2, 2, 2, 2),
(90, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '45', 2, 2, 2, 2),
(91, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '46', 2, 2, 2, 2),
(92, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '47', 2, 2, 2, 2),
(93, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '48', 2, 2, 2, 2),
(94, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '49', 2, 2, 2, 2),
(95, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '50', 2, 2, 2, 2),
(96, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '51', 2, 2, 2, 2),
(97, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '52', 2, 2, 2, 2),
(98, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '53', 2, 2, 2, 2),
(99, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '25', 2, 2, 2, 2),
(100, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '58', 2, 2, 2, 2),
(101, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '59', 1, 1, 1, 1),
(102, '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '61', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `postcategory`
--

CREATE TABLE `postcategory` (
  `cat_id` int(11) NOT NULL,
  `cat_name` text NOT NULL,
  `cat_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postcategory`
--

INSERT INTO `postcategory` (`cat_id`, `cat_name`, `cat_icon`) VALUES
(1, 'Introduction', 'Introduction.png'),
(2, 'Achivement', 'Achivement.png'),
(3, 'New Product or Service', 'NewProductorService.png'),
(4, 'Requirement', 'Requirement.png');

-- --------------------------------------------------------

--
-- Table structure for table `postdetail`
--

CREATE TABLE `postdetail` (
  `post_id` int(11) NOT NULL,
  `post_userid` int(11) NOT NULL,
  `post_catid` int(11) NOT NULL,
  `post_description` longtext NOT NULL,
  `post_image` text NOT NULL,
  `post_date` varchar(20) NOT NULL,
  `post_time` varchar(20) NOT NULL,
  `post_creatat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postdetail`
--

INSERT INTO `postdetail` (`post_id`, `post_userid`, `post_catid`, `post_description`, `post_image`, `post_date`, `post_time`, `post_creatat`) VALUES
(1, 99, 2, 'DEMo Description', '3bee204139235b7759692f1a2211de0c.jpg', '08-07-2021', '11:43 PM', '2021-08-06 23:15:16'),
(2, 98, 2, 'DEMo Description 2', '4e211f7afaf7eaa574af9f070b98cfbc.jpg', '08-07-2021', '11:46 PM', '2021-08-06 23:16:45'),
(3, 82, 1, 'Demo Image', '94a951dcae29c07f2fb65438214e33fd.jpg', '09/08/2021', '17:26PM', '2021-08-09 04:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment` (
  `post_cmt_id` int(11) NOT NULL,
  `post_cmt_userid` int(11) NOT NULL,
  `post_cmt_postid` int(11) NOT NULL,
  `post_cmt_comment` longtext CHARACTER SET utf8 NOT NULL,
  `post_cmt_date` varchar(20) NOT NULL,
  `post_cmt_time` varchar(20) NOT NULL,
  `post_cmt_creatat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`post_cmt_id`, `post_cmt_userid`, `post_cmt_postid`, `post_cmt_comment`, `post_cmt_date`, `post_cmt_time`, `post_cmt_creatat`) VALUES
(2, 99, 1, 'DEmo Msg', '08-07-2021', '01:03 PM', '2021-08-07 00:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `post_like_dislike`
--

CREATE TABLE `post_like_dislike` (
  `post_like_dislike_id` int(11) NOT NULL,
  `post_like_dislike_userid` int(11) NOT NULL,
  `post_like_dislike_postid` int(11) NOT NULL,
  `post_like_dislike_creatat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_like_dislike`
--

INSERT INTO `post_like_dislike` (`post_like_dislike_id`, `post_like_dislike_userid`, `post_like_dislike_postid`, `post_like_dislike_creatat`) VALUES
(1, 99, 1, '2021-08-06 23:33:17'),
(3, 82, 1, '2021-08-09 03:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `ratings_reviews`
--

CREATE TABLE `ratings_reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  `ratings` int(11) DEFAULT NULL,
  `review_note` text,
  `review_date` varchar(20) NOT NULL,
  `review_time` varchar(20) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings_reviews`
--

INSERT INTO `ratings_reviews` (`id`, `user_id`, `reviewed_by`, `ratings`, `review_note`, `review_date`, `review_time`, `doe`, `status`) VALUES
(1, 72, 73, 5, 'Lorium Ipsum', '26-07-2021', '01:00 PM', '2021-08-05 08:11:08', 1),
(2, 72, 75, 2, 'Lorium Ipsum', '26-07-2021', '01:05 PM', '2021-08-05 08:11:14', 1),
(3, 74, 75, 4, 'excellent profile ', '05-08-2021', '01:10 PM', '2021-08-05 11:07:46', 1),
(4, 74, 73, 3, 'excellent profile ', '05-08-2021', '01:10 PM', '2021-08-05 11:08:55', 1),
(5, 73, 74, 4, '', '05 Aug 2021', '04:42 PM', '2021-08-07 09:26:50', 1),
(6, 76, 74, 2, 'good work ', '05 Aug 2021', '04:54 PM', '2021-08-05 11:25:11', 1),
(7, 77, 74, 3, 'Good work ', '05 Aug 2021', '05:27 PM', '2021-08-05 11:57:40', 1),
(8, 126, 74, 3, 'excellent works', '05 Aug 2021', '05:40 PM', '2021-08-05 12:10:25', 1),
(9, 81, 82, 4, '', '06 Aug 2021', '12:04 PM', '2021-08-09 06:05:36', 1),
(10, 82, 124, 5, 'very good', '06 Aug 2021', '03:06 PM', '2021-08-06 09:36:30', 1),
(11, 82, 81, 4, 'good\n\n\n\n', '06 Aug 2021', '03:20 PM', '2021-08-06 09:50:50', 1),
(12, 124, 82, 4, 'good', '06 Aug 2021', '03:58 PM', '2021-08-06 10:28:36', 1),
(13, 73, 72, 5, 'Experienced person with good support ', '07 Aug 2021', '12:45 PM', '2021-08-07 07:15:57', 1),
(14, 75, 74, 3, '', '07 Aug 2021', '02:56 PM', '2021-08-07 09:26:27', 1),
(15, 82, 122, 4, 'good\n', '07 Aug 2021', '03:41 PM', '2021-08-07 10:11:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recomendation`
--

CREATE TABLE `recomendation` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `recomend_by` int(11) NOT NULL,
  `recom_note` text NOT NULL,
  `requirement_id` int(11) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recomendation`
--

INSERT INTO `recomendation` (`id`, `userid`, `recomend_by`, `recom_note`, `requirement_id`, `doe`) VALUES
(3, 35, 35, 'Lorium Ipsum Dollar', 1, '2021-07-16 09:28:28'),
(13, 24, 35, 'Lorium Ipsum Dolar', 1, '2021-07-16 10:13:36'),
(14, 25, 35, 'Lorium Ipsum Dolar', 1, '2021-07-16 10:13:36'),
(15, 36, 35, 'Lorium Ipsum Dolar', 1, '2021-07-16 10:13:36'),
(16, 24, 35, 'Lorium Ipsum Dolar', 2, '2021-07-16 10:43:53'),
(17, 25, 35, 'Lorium Ipsum Dolar', 2, '2021-07-16 10:43:53'),
(18, 36, 35, 'Lorium Ipsum Dolar', 2, '2021-07-16 10:43:53'),
(19, 35, 35, 'Lorium Ipsum Dollar', 6, '2021-07-16 10:56:30'),
(20, 24, 35, 'Lorium Ipsum Dolar', 6, '2021-07-16 11:03:45'),
(21, 25, 35, 'Lorium Ipsum Dolar', 6, '2021-07-16 11:03:45'),
(22, 36, 35, 'Lorium Ipsum Dolar', 6, '2021-07-16 11:03:45'),
(23, 35, 35, 'thsie new requirement  abc 6y', 2, '2021-07-16 11:32:21'),
(24, 35, 35, 'hello  this new requirement  send', 2, '2021-07-16 11:33:10'),
(25, 37, 37, 'My self recommendation ', 1, '2021-07-16 16:07:54'),
(26, 72, 72, 'Self recommendation\n', 8, '2021-07-17 03:54:49'),
(27, 72, 74, 'neha recommend  by admin', 8, '2021-07-22 09:03:28'),
(28, 72, 77, 'jai shree ganesh', 8, '2021-07-22 09:03:33'),
(29, 77, 77, 'I can provide this service\n\n', 8, '2021-07-17 08:24:40'),
(30, 77, 74, 'this is new requirement  reccomnd list fhjj hjjhjj hhhh vbbb ghhh hhh hhh hhh', 8, '2021-07-17 10:26:40'),
(31, 73, 74, 'this is new requirement  reccomnd list fhjj hjjhjj hhhh vbbb ghhh hhh hhh hhh', 8, '2021-07-17 10:26:40'),
(32, 79, 73, 'Good profile for this requirement ', 10, '2021-07-20 13:42:37'),
(33, 79, 73, 'Good experience in such tasks\n', 8, '2021-07-20 13:57:39'),
(34, 72, 83, 'he is reliable person\n', 8, '2021-07-22 09:23:49'),
(35, 66, 66, 'sahdga\n', 8, '2021-07-22 05:52:27'),
(36, 66, 66, 'same as above\n', 8, '2021-07-22 05:53:22'),
(37, 74, 73, 'Test ', 9, '2021-07-22 06:09:44'),
(38, 79, 73, 'Test ', 9, '2021-07-22 06:09:44'),
(39, 72, 73, 'Test ', 9, '2021-07-22 06:09:44'),
(40, 73, 73, 'Test 2\n', 9, '2021-07-22 06:09:57'),
(41, 72, 72, 'Test 2 self', 9, '2021-07-22 06:17:01'),
(42, 76, 72, 'Test recommendation ', 8, '2021-07-22 06:29:38'),
(43, 82, 72, 'Test recommendation ', 8, '2021-07-22 06:29:38'),
(44, 82, 82, 'recommend \n', 8, '2021-07-22 10:08:50'),
(45, 75, 82, 'recommend ', 8, '2021-07-22 10:09:26'),
(46, 82, 82, 'recommendation', 8, '2021-07-22 10:17:44'),
(47, 82, 82, 're', 9, '2021-07-22 10:32:07'),
(48, 81, 82, 'recommend \n', 15, '2021-07-22 11:17:30'),
(49, 81, 82, 'hello\n', 8, '2021-07-22 11:18:33'),
(50, 77, 74, 'Check  recommended  person', 9, '2021-07-22 12:24:42'),
(51, 81, 74, 'Check  recommended  person', 9, '2021-07-22 12:24:42'),
(52, 77, 72, 'recommendation  name show', 13, '2021-07-22 12:38:56'),
(53, 77, 72, 'Test recommendation ', 13, '2021-07-22 12:39:56'),
(54, 74, 74, 'My self recommended ', 10, '2021-07-22 12:42:09'),
(55, 77, 74, 'Two time Recommendations ', 10, '2021-07-22 12:59:07'),
(56, 81, 74, 'Two time Recommendations ', 10, '2021-07-22 12:59:07'),
(57, 74, 74, 'Recommendation  my self', 8, '2021-07-22 13:02:49'),
(58, 73, 73, 'Test recommendation\n', 15, '2021-07-22 16:11:16'),
(59, 74, 73, 'New recommendation ', 9, '2021-07-22 16:12:06'),
(60, 79, 73, 'Good profile for requirement', 12, '2021-07-22 16:13:15'),
(61, 74, 73, 'Good profile for requirement', 12, '2021-07-22 16:13:15'),
(62, 72, 73, 'Good profile for requirement', 12, '2021-07-22 16:13:15'),
(63, 73, 73, 'Recommendation 1', 12, '2021-07-22 16:13:41'),
(64, 73, 72, 'Test\nRecommendations 2', 12, '2021-07-22 16:14:46'),
(65, 79, 73, 'Test all recommended ', 8, '2021-07-22 16:16:08'),
(66, 74, 73, 'Test all recommended ', 8, '2021-07-22 16:16:08'),
(67, 72, 73, 'Test all recommended ', 8, '2021-07-22 16:16:08'),
(68, 73, 73, 'Test ', 9, '2021-07-22 16:17:03'),
(69, 73, 73, 'Test self recommendation by Vishwanath\nTest self recommendation by Vishwanath\nTest self recommendation by VishwanathTest self recommendatio\n', 9, '2021-07-22 17:08:54'),
(70, 72, 77, 'jai ganesha\n', 18, '2021-07-22 17:27:01'),
(71, 77, 77, 'I can provide this service\n', 18, '2021-07-22 17:27:24'),
(72, 72, 77, 'he can do it', 19, '2021-07-22 17:28:01'),
(73, 74, 77, 'but\n', 20, '2021-07-22 17:36:32'),
(74, 73, 72, 'Lorium Ipsum Dolar', 19, '2021-07-22 17:46:34'),
(75, 72, 73, 'Lorium Ipsum Dolar', 19, '2021-07-22 17:46:57'),
(76, 73, 73, 'Test ', 16, '2021-07-22 18:24:29'),
(77, 72, 77, 'try his service\n\njai shree Ganesha\n\n', 18, '2021-07-23 05:18:20'),
(78, 74, 77, 'check it', 8, '2021-07-23 05:19:11'),
(79, 79, 73, '688', 18, '2021-07-23 05:20:38'),
(80, 82, 77, 'recommend \n', 19, '2021-07-31 12:24:01'),
(81, 81, 74, 'recommend ', 15, '2021-07-23 07:16:34'),
(82, 82, 74, 'recommend ', 15, '2021-07-23 07:16:34'),
(83, 72, 73, 'Recommendation 2', 13, '2021-07-23 07:19:36'),
(84, 74, 73, 'Recommendation 2', 13, '2021-07-23 07:19:36'),
(85, 79, 73, 'Recommendation 2', 13, '2021-07-23 07:19:36'),
(86, 72, 73, 'Recommendation by Vishwanath', 21, '2021-07-23 07:23:12'),
(87, 72, 72, 'Self recommendation by Rahul', 21, '2021-07-23 07:25:02'),
(88, 74, 77, 'try her service.', 21, '2021-07-23 07:36:44'),
(89, 74, 77, 'try', 15, '2021-07-23 09:06:13'),
(90, 72, 73, 'Test recommendation ', 22, '2021-07-24 08:48:32'),
(91, 72, 72, 'Self recommendation ', 22, '2021-07-24 08:49:11'),
(92, 74, 72, 'Recommendation to buddies ', 22, '2021-07-24 08:49:40'),
(93, 77, 72, 'Recommendation to buddies ', 22, '2021-07-24 08:49:40'),
(94, 76, 72, 'Recommendation to buddies ', 22, '2021-07-24 08:49:40'),
(95, 82, 72, 'Recommendation to buddies ', 22, '2021-07-24 08:49:40'),
(96, 72, 77, 'he is trust worthy\n', 13, '2021-07-24 09:00:25'),
(97, 77, 77, 'I can d', 13, '2021-07-24 09:01:08'),
(98, 72, 77, 'he can definitely deliver this service', 13, '2021-07-26 09:06:10'),
(99, 77, 77, 'I can do\n', 13, '2021-07-26 09:07:19'),
(100, 82, 82, 'test', 17, '2021-07-29 07:15:53'),
(101, 82, 82, 'test\n', 17, '2021-07-29 07:16:08'),
(102, 81, 82, 'test\n', 15, '2021-07-29 10:01:27'),
(103, 81, 82, 'recommend ', 25, '2021-07-29 10:53:23'),
(104, 80, 82, 'test', 25, '2021-07-29 10:53:55'),
(105, 80, 80, 'test\n', 25, '2021-07-29 10:57:56'),
(106, 82, 80, 'test', 25, '2021-07-29 10:58:11'),
(107, 82, 82, 'Lorium Ipsum Dollar', 26, '2021-08-03 05:11:24'),
(108, 81, 82, 'Lorium Ipsum Dollar', 26, '2021-08-03 05:27:07'),
(109, 99, 99, 'test\n', 17, '2021-08-04 08:06:40'),
(110, 72, 77, 'I recommend', 15, '2021-08-06 06:03:53'),
(111, 72, 77, 'I recommend', 26, '2021-08-06 06:04:28'),
(112, 74, 77, 'I recommend', 26, '2021-08-06 06:04:28'),
(113, 77, 77, 'it can be done by me\n', 26, '2021-08-06 06:04:52'),
(114, 77, 77, 'I am experienced in this\n', 26, '2021-08-06 06:06:29'),
(115, 84, 84, 'sandip forward', 18, '2021-08-07 04:25:45'),
(116, 74, 84, 'you need to be happy', 8, '2021-08-07 06:27:05'),
(117, 98, 99, 'testing', 27, '2021-08-10 04:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `functional_area_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` mediumtext NOT NULL,
  `thumbnil` varchar(255) NOT NULL,
  `created_date` varchar(255) NOT NULL,
  `created_time` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1=inprogress,2=closed',
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `user_id`, `functional_area_id`, `title`, `description`, `address`, `thumbnil`, `created_date`, `created_time`, `status`, `doe`) VALUES
(8, 73, 2, 'Application Development', 'Application development requires for Android and iOS ', '', 'a7472a16b66f3f8f0b7b9fad4289e767.png', '17 Jul 2021', '08:59 AM', 1, '2021-08-05 07:39:35'),
(9, 74, 2, 'Create new requirement ', 'abc', '', '5bdafe2b5dcb635e44993c7e85b03505.png', '17 Jul 2021', '11:58 AM', 2, '2021-08-09 05:14:31'),
(10, 77, 2, 'requirement', 'new requirements', '', 'f74a599dfef08c400e5563ba21a7ba0e.png', '17 Jul 2021', '01:04 PM', 1, '2021-08-05 07:39:44'),
(11, 77, 2, 'new requirements', 'I want to buy this asap', '', '0567946d1cafc21f46a3047f5e7eb2e3.png', '17 Jul 2021', '01:52 PM', 1, '2021-08-05 07:39:47'),
(12, 77, 2, 'app development', 'looking for app developer', '', '14a4268dea0e1c13e3264e9b349e9077.png', '20 Jul 2021', '07:35 PM', 1, '2021-08-05 07:39:50'),
(13, 74, 2, 'Check lead image uplod', 'check  uplod image ', '', '28ccfd722aa2e9f29eb495c0a566fa40.png', '22 Jul 2021', '03:03 PM', 1, '2021-08-05 07:40:35'),
(14, 74, 2, 'Mobile App Requirements ', 'New app Requirement  abc ', '', '3c0dcd925a54d18a0e618c729df0b44b.png', '22 Jul 2021', '03:15 PM', 1, '2021-08-05 07:40:32'),
(15, 82, 2, 'Applex group', 'abs', '', 'fe576dd044709e40f4b95f00176289d0.png', '22 Jul 2021', '03:59 PM', 1, '2021-08-05 07:40:29'),
(16, 74, 2, 'Check  Business  Requirements ', 'Abc Check New Requirement  Businesses ', '', '073518cee8461e3ab94512dc40fccfc6.png', '22 Jul 2021', '04:56 PM', 1, '2021-08-05 07:40:26'),
(17, 74, 2, 'New gallery2  image requiment', 'abc', '', '0496e1f7030e5a686489524ab661eaca.png', '22 Jul 2021', '04:57 PM', 1, '2021-08-05 07:40:22'),
(18, 72, 2, 'Hello World2', 'Lorium Ipsum Dollar', '', '8176805f4f150d3d6cea4af62ce4a11d.png', '14-07-2021', '17:58 PM', 1, '2021-08-05 07:40:19'),
(19, 72, 2, 'Create New Requirement', 'Lorium Ipsum Dollar', '', '5cabdbc8cbcff978cacd3439d233733e.png', '14-07-2021', '17:58 PM', 1, '2021-08-05 07:40:16'),
(20, 77, 2, 'I need to buy silk saree', 'requirement for saree.', '', '30186952906258eca30fffe1504b1afa.png', '22 Jul 2021', '11:05 PM', 1, '2021-08-05 07:40:13'),
(21, 73, 2, 'Graphics Design ', 'Graphics Design for August 2021', '', '815500205f7211c65a55e2eb30f4c301.png', '23 Jul 2021', '12:51 PM', 1, '2021-08-05 07:40:10'),
(22, 73, 2, 'Test Requirement', 'This is test requirement. ', '', 'b6249798419a626d46fca2ed6915307c.png', '24 Jul 2021', '02:18 PM', 1, '2021-08-05 07:40:06'),
(23, 77, 2, 'looking for cook', 'need in Hadapsar', '', 'edaaad349c3a54037657eee047e09c67.png', '24 Jul 2021', '02:29 PM', 1, '2021-08-05 07:40:03'),
(24, 77, 2, 'requirement for pest control', 'I  am looking for this service.', '', '588b8982595ea367751d89f1fcbbde5c.png', '26 Jul 2021', '02:34 PM', 1, '2021-08-05 07:40:01'),
(25, 82, 2, 'abcdef', 'aaaassssfffffgghhj', '', '2fbcf25cf64fbad98a18e06ffa406c2a.png', '29 Jul 2021', '03:21 PM', 1, '2021-08-05 07:39:57'),
(26, 82, 2, 'Lorium Dollar', 'Lorium Ipsum Dollar', '', '8ee5725088ee47cbbd4407dfed980840.jpg', '02/08/2021', '19:34', 1, '2021-08-05 07:39:55'),
(27, 99, 12, 'Create New Requirement', 'Lorium Ipsum Dollar', '', '97353e5003d93251d32023fee1394cf8.jpg', '14-07-2021', '17:58 PM', 1, '2021-08-05 07:41:55'),
(28, 98, 14, 'Create New Requirement', 'Lorium Ipsum Dollar', 'pune', '6b71fab5da387da05eefeabd31e34231.png', '14-07-2021', '17:58 PM', 1, '2021-08-06 07:49:09'),
(29, 74, 5, 'Developer  requires ', 'New requirement ', 'Pune ', 'edf404cf3a9a2e725f806e542a6df962.png', '06 Aug 2021', '01:25 PM', 1, '2021-08-06 07:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `requirements_status`
--

CREATE TABLE `requirements_status` (
  `req_status_id` int(11) NOT NULL,
  `req_status_title` text NOT NULL,
  `req_status_description` text,
  `req_status_category` int(11) NOT NULL COMMENT '1=Pending, 2=Inprogress, 3= close'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirements_status`
--

INSERT INTO `requirements_status` (`req_status_id`, `req_status_title`, `req_status_description`, `req_status_category`) VALUES
(1, 'Lead  / Requirement Shared', 'Status 1', 1),
(2, 'Recommend to the Member', 'status 2', 1),
(3, 'if it is an authentic lead or not', 'Status 3', 2),
(4, 'Followup on the lead', 'Status 4', 2),
(5, 'Deal closed business transaction not done', 'status 5', 2),
(6, 'Deliverables of requirement', 'status 6', 2),
(7, 'Deal closed with business transaction', 'status 7', 2),
(8, 'Product / Service delivered', 'status 8', 2),
(9, 'Payment Received', 'status 9', 2),
(10, 'Businss Transaction Complete', 'Status 10', 3),
(11, 'Business Cancelled', 'Status 11', 3);

-- --------------------------------------------------------

--
-- Table structure for table `requirements_user_status`
--

CREATE TABLE `requirements_user_status` (
  `req_user_status_id` int(11) NOT NULL,
  `req_user_status_userid` int(11) NOT NULL,
  `req_user_status_catid` int(11) NOT NULL,
  `req_user_status_reqid` int(11) NOT NULL,
  `req_user_status_statusid` int(11) NOT NULL,
  `req_user_status_msg` text,
  `req_user_status_desc` text,
  `req_user_status_date` varchar(20) NOT NULL,
  `req_user_status_day` varchar(10) NOT NULL,
  `req_user_status_time` varchar(10) NOT NULL,
  `req_user_status_amount` float DEFAULT NULL,
  `req_user_status_creatat` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirements_user_status`
--

INSERT INTO `requirements_user_status` (`req_user_status_id`, `req_user_status_userid`, `req_user_status_catid`, `req_user_status_reqid`, `req_user_status_statusid`, `req_user_status_msg`, `req_user_status_desc`, `req_user_status_date`, `req_user_status_day`, `req_user_status_time`, `req_user_status_amount`, `req_user_status_creatat`) VALUES
(1, 98, 0, 19, 1, 'test', '', '04 jul 2021', 'Mon', '13:59 pm', NULL, '2021-08-04 02:34:12'),
(2, 98, 0, 19, 2, 'test', '', '04 jul 2021', 'Mon', '14:59 pm', NULL, '2021-08-04 03:58:08'),
(3, 74, 1, 29, 1, 'test', '', '04 jul 2021', 'Mon', '14:59 pm', 0, '2021-08-06 23:30:13'),
(4, 74, 1, 9, 1, 'test', '', '04 jul 2021', 'Mon', '14:59 pm', 0, '2021-08-06 23:31:21'),
(5, 73, 1, 9, 1, 'test', '', '04 jul 2021', 'Mon', '14:59 pm', 0, '2021-08-06 23:32:49'),
(6, 73, 1, 9, 1, 'test', '', '04 jul 2021', 'Mon', '14:59 pm', 0, '2021-08-06 23:32:56'),
(7, 73, 1, 9, 1, 'test', '', '04 jul 2021', 'Mon', '14:59 pm', 0, '2021-08-06 23:33:04'),
(8, 98, 0, 19, 2, 'test', '', '04 jul 2021', 'Mon', '14:59 pm', 0, '2021-08-07 06:13:09'),
(9, 74, 2, 9, 3, 'in prosess', '', '07 Aug 2021', 'Mon', '06:54 PM', 0, '2021-08-07 06:24:15'),
(10, 74, 2, 9, 4, 'inpro', '', '07 Aug 2021', 'Mon', '06:54 PM', 0, '2021-08-07 06:24:28'),
(11, 74, 2, 9, 6, 'inpr', '', '07 Aug 2021', 'Mon', '06:54 PM', 0, '2021-08-07 06:24:37'),
(12, 74, 2, 9, 8, 'injprf', '', '07 Aug 2021', 'Mon', '06:54 PM', 0, '2021-08-07 06:24:49'),
(13, 74, 2, 9, 9, 'received ', '', '07 Aug 2021', 'Mon', '06:55 PM', 10000, '2021-08-07 06:25:27'),
(14, 74, 3, 9, 10, 'close', '', '07 Aug 2021', 'Mon', '06:59 PM', 0, '2021-08-07 06:29:59'),
(15, 74, 3, 9, 11, 'close', '', '07 Aug 2021', 'Mon', '07:00 PM', 0, '2021-08-07 06:30:07'),
(16, 74, 1, 0, 1, 'pending ', '', '07 Aug 2021', 'Mon', '07:03 PM', 0, '2021-08-07 06:33:02'),
(17, 74, 1, 21, 1, 'working  on', '', '07 Aug 2021', 'Mon', '07:10 PM', 0, '2021-08-07 06:40:07'),
(18, 74, 3, 9, 11, 'Done', '', '09 Aug 2021', 'Mon', '10:44 AM', 0, '2021-08-08 22:14:31'),
(21, 98, 1, 19, 2, 'test', '', '08 Aug  2021', 'Sun', '14:59 pm', 0, '2021-08-08 22:22:21'),
(22, 81, 2, 26, 4, 'hello', '', '09 Aug 2021', 'Mon', '06:59 PM', 0, '2021-08-09 06:30:00'),
(23, 99, 1, 27, 2, 'first phase', '', '10 Aug 2021', 'Tue', '10:02 am', 0, '2021-08-09 21:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `reward_point`
--

CREATE TABLE `reward_point` (
  `id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `description` text NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reward_point`
--

INSERT INTO `reward_point` (`id`, `activity`, `description`, `point`) VALUES
(1, 'Requirement Shared', 'TEST', 20),
(2, 'Leads Recommended', 'TEST', 10),
(3, 'Leads Received', 'TEST', 20),
(4, 'Business Shared', 'TEST', 20),
(5, 'Business Received', 'TEST', 10),
(6, 'Testimonial Shared', 'TEST', 10),
(7, 'Testimonial Received', 'TEST', 10),
(8, 'Total Number of Buddy Meet', 'TEST', 10),
(9, 'Guest Attended the Meet', 'TEST', 50),
(10, 'Guest Become Meet', 'TEST', 50),
(11, 'Total Number of Meets Attended', 'TEST', 50);

-- --------------------------------------------------------

--
-- Table structure for table `reward_user_point`
--

CREATE TABLE `reward_user_point` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rewardid` int(11) NOT NULL,
  `activity` text NOT NULL,
  `point` float NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `creatat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, 'Staff', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(4, 'OLgwIPeh21d532460e7f78698ac2c02461ae8bf71KWZNkxzmO', 1, 'Guest_User', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(5, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', 0, 'Client', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
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
(1, 'J4E', 'default', 0, 'Under Maintenance, Please try later.', 1, 'low', 1, '{\"title\":\"T&C Title\",\"body\":\"T&C Body\"}', 0, 0, 1, 1, 1, 0, 1, 'normal', 15, 0, '{\"version\":\"v2_1\",\"site_key\":\"\",\"secret_key\":\"\"}', '', '{\"google\":{\"enabled\":1,\"client_id\":\"1022683981938-m5inifp0n2nlbsianp0v0d2rrr82mchs.apps.googleusercontent.com\",\"client_secret\":\"n87ZtnSCdS0a8GZAyorSEaYu\"},\"facebook\":{\"enabled\":0,\"app_id\":\"\",\"app_secret\":\"\"},\"twitter\":{\"enabled\":0,\"consumer_key\":\"\",\"consumer_secret\":\"\"}}', 'disabled', '{\"host\":\"mail.applex360.co.in\",\"port\":\"465\",\"is_auth\":1,\"username\":\"info@applex360.co.in\",\"password\":\"info@2021\",\"crypto\":\"ssl\",\"from_email\":\"info@applex360.co.in\",\"from_name\":\"Applex Group\"}', 25, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '0', 0, '2021-06-13 11:57:19', '{\"enabled\":1,\"allow_remove\":0,\"cookie_message\":\"This website uses cookies to ensure you get the best experience on our website.\",\"cookie_policy_link_text\":\"Learn more\",\"cookie_policy_link\":\"https:\\/\\/applexinfotech.com\\/CyberBukit\\/generic\\/terms_conditions\"}', '{\"type\":\"sandbox\",\"feature\":\"both\",\"tax_rate\":0,\"stripe_one_time_enabled\":\"0\",\"stripe_recurring_enabled\":\"0\",\"stripe_publishable_key\":\"\",\"stripe_secret_key\":\"\",\"stripe_signing_secret\":\"\",\"paypal_one_time_enabled\":\"0\",\"paypal_recurring_enabled\":\"0\",\"paypal_client_id\":\"\",\"paypal_secret\":\"\",\"paypal_webhook_id\":\"\"}', '{\"enabled\":1,\"company_name\":\"\",\"company_number\":\"\",\"tax_number\":\"\",\"address_line_1\":\"\",\"address_line_2\":\"\",\"phone\":\"\"}', '{\"enabled\":1,\"guest_ticket\":0,\"rating\":1,\"allow_upload\":0,\"notify_agent_list\":\"\",\"notify_user\":0,\"close_rule\":\"3\"}', '{\"file_type\":\"jpg|jpeg|png|gif|svg|zip|rar|pdf|mp3|mp4|doc|docx|xls|xlsx|csv\",\"file_size\":\"102400\"}', '{\"enabled\":0,\"logo\":\"logo.png\",\"company_name\":\"Applex Group\",\"email_address\":\"support@applexgroup.com\",\"html_title\":\"Applex Group\",\"html_author\":\"Applex Group\",\"html_description\":\"\",\"html_keyword\":\"\",\"about_us\":\"\",\"pricing_enabled\":1,\"faq_enabled\":1,\"documentation_enabled\":1,\"blog_enabled\":1,\"subscriber_enabled\":1,\"social_facebook\":\"\",\"social_twitter\":\"\",\"social_linkedin\":\"\",\"social_github\":\"\",\"custom_css\":\"\",\"custom_javascript\":\"\"}', '{}', '{\"enabled\":0,\"commission_policy\":\"A\",\"commission_rate\":0, \"description\":\"\", \"stuff\":\"\"}', '', '', '1.7.2');

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
-- Table structure for table `tbl_functional_area`
--

CREATE TABLE `tbl_functional_area` (
  `functional_area_id` int(11) NOT NULL,
  `functional_area` varchar(500) NOT NULL,
  `create_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) NOT NULL DEFAULT '1' COMMENT 'Active = 1 || Inactive=0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_functional_area`
--

INSERT INTO `tbl_functional_area` (`functional_area_id`, `functional_area`, `create_date`, `modified_date`, `status`) VALUES
(2, 'TEMP', '2019-03-01 10:44:05', '2019-03-01 10:44:05', '1'),
(3, 'Architecture, Interior Design', '2019-03-01 12:32:08', '2019-03-01 12:32:08', '1'),
(4, 'Beauty / Fitness / Spa Services', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(5, 'CSR &amp; Sustainability', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(6, 'Defence Forces, Security Services', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(7, 'Design, Creative, User Experience', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(8, 'Engineering Design, R&amp;D', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(9, 'Executive Assistant, Front Office, Data Entry', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(10, 'Export, Import, Merchandising', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(11, 'Fashion Designing, Merchandising', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(12, 'Financial Services, Banking, Investments, Insurance', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(13, 'Hotels, Restaurants', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(14, 'HR, Recruitment, Administration, IR', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(15, 'IT Hardware, Technical Support, Telecom Engineering', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(16, 'IT Software - Client/Server Programming', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(17, 'IT Software - DBA, Datawarehousing', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(18, 'IT Software - eCommerce, Internet Technologies', '2019-03-01 12:32:09', '2019-03-01 12:32:09', '1'),
(19, 'IT Software - Embedded, EDA, VLSI, ASIC, Chip Design', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(20, 'IT Software - ERP, CRM', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(21, 'IT Software - Mainframe', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(22, 'IT Software - Middleware', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(23, 'IT Software - Mobile', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(24, 'IT Software - Network Administration, Security', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(25, 'IT Software - Other', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(26, 'IT Software - QA &amp; Testing', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(27, 'IT Software - System Programming', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(28, 'IT Software - Systems, EDP, MIS', '2019-03-01 12:32:10', '2019-03-01 12:32:10', '1'),
(29, 'IT Software - Telecom Software', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(30, 'Journalism, Editing, Content', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(31, 'Legal, Regulatory, Intellectual Property', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(32, 'Marketing, Advertising, MR, PR, Media Planning', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(33, 'Medical, Healthcare, R&amp;D, Pharmaceuticals, Biotechnology', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(34, 'Other', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(35, 'Packaging', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(36, 'Self Employed, Entrepreneur, Independent Consultant', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(37, 'Shipping', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(38, 'Site Engineering, Project Management', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(39, 'Strategy, Management Consulting, Corporate Planning', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(40, 'Supply Chain, Logistics, Purchase, Materials', '2019-03-01 12:32:11', '2019-03-01 12:32:11', '1'),
(41, 'Teaching, Education, Training, Counselling', '2019-03-01 12:32:12', '2019-03-01 12:32:12', '1'),
(42, 'Top Management', '2019-03-01 12:32:12', '2019-03-01 12:32:12', '1'),
(43, 'Travel, Tours, Ticketing, Airlines', '2019-03-01 12:32:12', '2019-03-01 12:32:12', '1'),
(44, 'TV, Films, Production, Broadcasting', '2019-03-01 12:32:12', '2019-03-01 12:32:12', '1');

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

--
-- Dumping data for table `throttling`
--

INSERT INTO `throttling` (`id`, `ip`, `user_tag`, `times`, `time`) VALUES
(53, '157.33.221.203', '', 1, '2021-08-10 11:52:55');

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

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `type`, `email`, `phone`, `token`, `reference`, `created_time`, `done`) VALUES
(1, 'reset_password', 'jatin.danger@applexinfotech.com', '', 'wE8hIOn9dbd2a5af1850c93152676302679186d33cw6YHaXJZ', '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', '2021-08-03 18:57:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL,
  `trans_userid` int(11) NOT NULL,
  `trans_paymentids` text NOT NULL,
  `trans_paymenttype` text NOT NULL,
  `trans_amount` float NOT NULL,
  `trans_datetime` varchar(30) NOT NULL,
  `trans_for` text NOT NULL,
  `trans_creatat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `trans_userid`, `trans_paymentids`, `trans_paymenttype`, `trans_amount`, `trans_datetime`, `trans_for`, `trans_creatat`) VALUES
(1, 14, '452123652', 'online', 100, '04-08-2021 4:55 PM', '', '2021-08-04 04:38:50'),
(2, 14, '452123652', 'online', 100, '04-08-2021 4:55 PM', '', '2021-08-04 04:41:00'),
(3, 14, '452123652', 'online', 100, '04-08-2021 4:55 PM', '', '2021-08-04 04:42:06'),
(4, 14, '452123652', 'online', 100, '04-08-2021 4:55 PM', '', '2021-08-04 04:42:40'),
(5, 14, '452123652', 'online', 100, '04-08-2021 4:55 PM', '', '2021-08-04 04:43:43'),
(6, 98, '452123652', 'online', 100, '04-08-2021 4:55 PM', '', '2021-08-04 04:44:10'),
(7, 98, '452123652', 'online', 100, '04-08-2021 4:55 PM', '', '2021-08-04 04:45:20'),
(10, 125, '102656693ac3ca6e0cda', 'online', 35000, '04-08-2021 05:47 PM', 'Membership Payment', '2021-08-04 05:17:33'),
(11, 126, '102656693ac3ca6e0cda789', 'online', 35000, '04-08-2021 06:28 PM', 'Upgrade Membership Payment', '2021-08-04 05:58:52'),
(12, 127, '102656693ac3ca6e0cda', 'online', 0, '04-08-2021 06:31 PM', 'Membership Payment', '2021-08-04 06:01:01'),
(13, 98, '74', '', 0, '', 'Membership Payment', '2021-08-04 06:08:18'),
(14, 98, '74', '', 0, '', 'Membership Payment', '2021-08-05 23:13:13'),
(15, 74, '102656693ac3ca6e0cda789', 'online', 0, '06-08-2021 11:46 AM', 'Upgrade Membership Payment', '2021-08-05 23:16:52'),
(16, 124, '102656693ac3ca6e0cda', 'online', 35000, '06-08-2021 12:52 PM', 'Membership Payment', '2021-08-06 00:22:45'),
(17, 98, '74', '', 0, '', 'Membership Payment', '2021-08-06 02:38:44'),
(18, 124, '102656693ac3ca6e0cda789', 'online', 35000, '06-08-2021 03:11 PM', 'Upgrade Membership Payment', '2021-08-06 02:41:01'),
(19, 124, '102656693ac3ca6e0cda789', 'online', 35000, '06-08-2021 03:11 PM', 'Upgrade Membership Payment', '2021-08-06 02:41:39'),
(20, 82, '102656693ac3ca6e0cda789', 'online', 35000, '06-08-2021 04:17 PM', 'Upgrade Membership Payment', '2021-08-06 03:47:41'),
(21, 72, '102656693ac3ca6e0cda789', 'online', 35000, '06-08-2021 05:02 PM', 'Upgrade Membership Payment', '2021-08-06 04:32:49'),
(22, 82, '102656693ac3ca6e0cda789', 'online', 35000, '06-08-2021 07:15 PM', 'Upgrade Membership Payment', '2021-08-06 06:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `turn_over`
--

CREATE TABLE `turn_over` (
  `turn_over_id` int(11) NOT NULL,
  `turn_over_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turn_over`
--

INSERT INTO `turn_over` (`turn_over_id`, `turn_over_value`) VALUES
(1, '> 10 Lakhs'),
(2, '> 10 Lakhs & < 50 Lakhs'),
(3, '> 50 Lakhs & < 1 Crore'),
(4, '> 1 Crore & < 50 Crore'),
(5, '> 50 Crore & < 50 Crore'),
(6, '> 100 Crore ');

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
  `signup_socialid` mediumtext,
  `prefix` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `blood_group` varchar(50) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `wmobile` varchar(15) DEFAULT NULL,
  `landline` varchar(50) DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `total_experience` varchar(255) DEFAULT NULL,
  `company_address` text,
  `company_contact` varchar(20) NOT NULL,
  `about_company` text,
  `business_entity` varchar(255) NOT NULL,
  `business_category` varchar(255) DEFAULT NULL,
  `business_experties` text NOT NULL,
  `business_type` varchar(255) NOT NULL,
  `working_from` varchar(255) NOT NULL,
  `no_of_employees` int(11) NOT NULL,
  `turn_over` varchar(255) NOT NULL,
  `target_audiance` varchar(255) NOT NULL,
  `company_profile` text NOT NULL,
  `company_ppt` text NOT NULL,
  `vcard_front` text NOT NULL,
  `vcard_back` text NOT NULL,
  `company_google` text,
  `company_facebook` text NOT NULL,
  `company_linkedin` text NOT NULL,
  `company_instagram` text NOT NULL,
  `company_twitter` text NOT NULL,
  `company_youtube` text NOT NULL,
  `company_skype` text NOT NULL,
  `avatar` text,
  `timezone` varchar(255) NOT NULL,
  `date_format` varchar(20) NOT NULL,
  `time_format` varchar(20) NOT NULL,
  `language` varchar(50) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `country` varchar(10) NOT NULL,
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
  `tax_number` varchar(50) NOT NULL,
  `otp` int(6) DEFAULT NULL,
  `otp_verified` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0-not verified,1-verified',
  `packages_id` tinyint(2) DEFAULT '1',
  `packages_startDate` int(11) DEFAULT NULL,
  `packages_endDate` int(11) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `referral_code` varchar(20) NOT NULL,
  `login_type` varchar(30) NOT NULL,
  `membership_type` enum('0','1','2') NOT NULL COMMENT '''0''=''undefined'',''1''=''guest'',''2''=''paid''',
  `device_type` varchar(20) DEFAULT NULL,
  `device_token` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `ids`, `username`, `password`, `api_key`, `balance`, `email_address`, `email_verified`, `email_address_pending`, `phone`, `phone_verified`, `phone_pending`, `oauth_google_identifier`, `oauth_facebook_identifier`, `oauth_twitter_identifier`, `signup_source`, `signup_socialid`, `prefix`, `first_name`, `middle_name`, `last_name`, `gender`, `dob`, `blood_group`, `designation`, `wmobile`, `landline`, `company`, `total_experience`, `company_address`, `company_contact`, `about_company`, `business_entity`, `business_category`, `business_experties`, `business_type`, `working_from`, `no_of_employees`, `turn_over`, `target_audiance`, `company_profile`, `company_ppt`, `vcard_front`, `vcard_back`, `company_google`, `company_facebook`, `company_linkedin`, `company_instagram`, `company_twitter`, `company_youtube`, `company_skype`, `avatar`, `timezone`, `date_format`, `time_format`, `language`, `currency`, `country`, `address_line_1`, `address_line_2`, `city`, `state`, `zip_code`, `role_ids`, `status`, `created_time`, `update_time`, `login_success_detail`, `online`, `online_time`, `new_notification`, `referral`, `affiliate_enabled`, `affiliate_code`, `affiliate_earning`, `affiliate_setting`, `company_number`, `tax_number`, `otp`, `otp_verified`, `packages_id`, `packages_startDate`, `packages_endDate`, `website`, `referral_code`, `login_type`, `membership_type`, `device_type`, `device_token`) VALUES
(1, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'superadmin', '$2y$12$C7CqeB92FgzuqMDwqKrCz.jSau2HFsC7CzUMh39YfGYy4BatmJWzW', 'pljhshumN66e81b818cbdfbki90e1190206e6cf7c97gassvv', '{\"usd\":0}', 'jatin.danger@applexinfotech.com', 1, '', '9933663838', 0, '', '', '', '', '', NULL, NULL, 'Super', NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk.jpeg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, NULL, '2021-06-15 01:12:43', '{\"time\":\"2021-08-07 07:35:57 UTC\",\"interface\":\"web\",\"ip_address\":\"116.75.168.76\",\"user_agent\":\"Chrome 92.0.4515.131\"}', 1, '2021-08-07 14:35:57', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 4374, 0, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(72, 'kcdaV1F9y9eb22d9ef86d8509eec5cd3dc3863f70PSyuFr279', '', '', 'iXZnRIGhV9eb22d9ef86d8509eec5cd3dc3863f703jvMF2c50', '{\"usd\":0}', 'rahul.patil@j4e.com', 0, '', '7350123885', 1, '', '', '', '', 'api', NULL, NULL, 'Rahul', 'Kedar', 'Patil', 'Male', '16/4/1975', NULL, 'Production Manager ', NULL, NULL, 'Fab Tech', '21 Years', 'Mumbai', '0909090000', 'test profile for production manager ', 'LLP', 'Manufacturer', 'Agriculture', 'Business to Consumer (B2C)', '6/8/2000', 500, '2', 'Any manufacturer ', 'http://google.com', 'http://google.com', '', '', 'google.com', 'facebook.com', 'linckedin.com', '', '', '', '', '132b9a34adffc431a849861ed5e6c474.png', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-17 09:56:45', '2021-07-17 09:56:45', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 6959, 1, 9, 1628208000, 1659744000, 'j4e.com', '', 'normal', '2', NULL, NULL),
(73, 'KSr2XDPbCdc0587d754ecab51212d5889d4de6635vje3ogdW9', '', '', '5fycjxOTadc0587d754ecab51212d5889d4de6635takmuj9Ho', '{\"usd\":0}', 'vivkulkarni@applex.com', 0, '', '9988998899', 1, '', '', '', '', 'api', NULL, NULL, 'Vishwanath', 'K', 'Kulkarni', 'Male', '19/10/1979', NULL, 'Founder', NULL, NULL, 'VK enterprises', '5 Years', 'Kolhapur', '9988998899', 'this is test profile of Founder', 'Properitiorship', '2', 'Agriculture', 'Business to Business (B2B)', '6/6/2016', 60, '1', 'IT & Software', 'http://google.com', 'http://google.com', '', '', 'google.com', 'facebook.com', 'linkedin.com', '', '', '', '', '780d17d434c046e3444e66b13e033b0d.png', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-17 10:11:43', '2021-07-17 10:11:43', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 3942, 1, 1, NULL, NULL, 'vkenterprises.com', '', 'normal', '1', NULL, NULL),
(74, 'rCSHOvm1d6dad45f81e06932d666d41cdd64a3c70uQVvUAcna', '', '', 'TpxjWX3Hc6dad45f81e06932d666d41cdd64a3c707bExaKR9k', '{\"usd\":0}', 'neha@gmail.com', 0, '', '9890607999', 1, '', '', '', '', 'api', NULL, NULL, 'Neha', 'M', 'Patil', 'Female', '18-02-2021', NULL, 'Android Developer', NULL, NULL, 'Applex tech', '5 YEARS', 'pune, india', '123456700', 'Applex  info abc', 'Partnership', '4', 'Services', 'Business to Consumer (B2C)', '16', 23, '3', '34', 'd3de299dde5e66f022789a76b0de954b.pdf', 'http://google.com', 'e79a4c4afe40712f0d2b6380e7dc2c3c.png', 'c50de7a7c1f92275e19cbb950942f1a6.png', 'https://google.com', 'http://example.com', 'http://example.com', '', '', '', '', '1851cf557acb94de2707d62bea8d2f10.png', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-17 11:23:31', '2021-07-17 11:23:31', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 2141, 1, 1, 1628208000, 1644105600, 'http://example.com', '', 'normal', '2', NULL, NULL),
(75, 'HiGPXNz0K5bddd7b29b980c2ae7fa7eb6eb1ff9a0L0AuHjep3', '', '', '9yAvHqNJi5bddd7b29b980c2ae7fa7eb6eb1ff9a002qj4TcNE', '{\"usd\":0}', 'abc@gmail.com', 0, '', '98007436277', 1, '', '', '', '', 'api', NULL, NULL, 'Nilima ', 'bharat', 'kolhe', 'Female', '18-02-2021', NULL, 'Android Developer', NULL, NULL, 'Applexinfotech', '5 YEARS', 'Kothud ,Pune', '9895268999', NULL, '', '5', '', '', '', 0, '', '', '', '', '', '830decdaa2fd3ab9befa35585d1d87dd.jpg', 'https://google.com', 'http://example.com', 'http://example.com', 'http://example.com', 'http://example.com', 'http://example.com', 'http://example.com', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-17 11:35:40', '2021-07-17 11:35:40', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 8026, 1, 1, NULL, NULL, 'http://example.com', '', 'normal', '1', NULL, NULL),
(76, 'B7xcTG4ia7a0ecbf96c54932142b2d2ced11ea35c6dISPNKal', '', '', 'kL0PyxYRs7a0ecbf96c54932142b2d2ced11ea35cI932canUd', '{\"usd\":0}', 'amruta@gmail.com', 0, '', '9922432050', 1, '', '', '', '', 'api', NULL, NULL, 'Amruta', 'm', 'shinde', NULL, NULL, NULL, 'developer ', NULL, NULL, 'applex ', NULL, 'pune', '5569666699', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-17 11:49:01', '2021-07-17 11:49:01', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 5774, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(77, 'EfB1KgjS96e0b88435e6bd6ab86ea957792aac440SC02JNm7P', '', '', 'byIe7uE0f6e0b88435e6bd6ab86ea957792aac440Nvepz4mVD', '{\"usd\":0}', 'vmethi19@gmail.com', 0, '', '9850325204', 1, '', '', '', '', 'api', NULL, NULL, 'jai', 'shree', 'ganesha', NULL, NULL, NULL, 'founder', NULL, NULL, 'J4E', NULL, 'Magarpatta city', '9850325204', 'jai ganesha', 'Partnership', NULL, 'Agriculture', 'Business to Business (B2B)', 'home', 0, '5', 'it employees', 'http://google.com', 'http://google.com', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-17 13:37:47', '2021-07-17 13:37:47', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 6278, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(78, '2a1KpWfUV214bda7ce4c75e0f7f62030306baa830gQBEy8OWw', '', '', 'nkejhwG8C214bda7ce4c75e0f7f62030306baa8303LnE24OMt', '{\"usd\":0}', '', 0, '', '9320275954', 1, '', '', '', '', 'api', NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-17 14:46:23', '2021-07-17 14:46:23', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 4309, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(79, 'H9o52GWKib1855b0badadd2913485dd13f7811708Pr7FVacN4', '', '', 'BfIWQT3FHb1855b0badadd2913485dd13f7811708rjVw4Y1sJ', '{\"usd\":0}', 'pandit.jadhav@applex.com', 0, '', '9977997799', 1, '', '', '', '', 'api', NULL, NULL, 'Pandit', 'M', 'Jadhav', NULL, NULL, NULL, 'Team Lead', NULL, NULL, 'Applex', NULL, 'Pune ', '9192700583', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-20 20:34:15', '2021-07-20 20:34:15', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 8401, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(80, 'z3QlePxK6b688e51e15965983bb892f812b5fe4d5p2DfHRxz3', '', '', 'Bn13Sphurb688e51e15965983bb892f812b5fe4d5jcFSXLYeq', '{\"usd\":0}', 'aishu@gmail.com', 1, '', '8626032080', 1, '', '', '', '', 'api', NULL, NULL, 'Aish', NULL, 'Jadhav', NULL, NULL, NULL, NULL, NULL, NULL, 'Applex Infotech', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-22 11:51:25', '2021-07-29 11:40:13', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 2994, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(81, 'IJ7QNBbOG75064e50049260b7466d5689cb3e6180j2dPlcAWg', '', '', 'i6SyqoedH75064e50049260b7466d5689cb3e6180et37HNnyh', '{\"usd\":0}', 'jadhavaish@gmail', 0, '', '9766617799', 1, '', '', '', '', 'api', NULL, NULL, 'aishwarya', 'madan', 'jadhav', NULL, NULL, NULL, 'test engineer', NULL, NULL, 'applexgroup', NULL, 'pune', '8626032080', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-22 12:11:12', '2021-07-22 12:11:12', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 7187, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(82, 'K8sPD4XZx3a5f4b4d6084487094d28dae2683034d2sogZiE7O', '', '', 'XMBbo6YGT3a5f4b4d6084487094d28dae2683034d9N7ArEzHo', '{\"usd\":0}', 'aishajadhav@gmail.com', 1, '', '8600635385', 1, '', '', '', '', 'api', NULL, NULL, 'Aisha', 'Madan', 'Jadhav', NULL, NULL, NULL, 'test engineer', NULL, NULL, 'Applex', NULL, 'pune', '8652085308', 'Applex Infotech', 'Private Ltd', NULL, 'Other', 'Business to Consumer (B2C)', '20', 27, '4', '31', 'http://google.com', 'http://google.com', '', '', NULL, '', '', '', '', '', '', 'e9434fd2ef1338c8481effdb6fa8fa99.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-22 12:38:56', '2021-07-29 12:40:57', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 8693, 1, 9, 1628208000, 1659744000, NULL, '', 'normal', '2', NULL, NULL),
(83, 'B5IbFH9JQ81b086a2de951d8bfa7d00ca24d342aaf8x1dMp6R', '', '', 'FPtUlnwMg81b086a2de951d8bfa7d00ca24d342aa8TIYWOLxk', '{\"usd\":0}', 'jatin.danger@applexinfotech.com', 0, '', '7984862327', 1, '', '', '', '', 'api', NULL, NULL, 'jatin', '', 'Dangar', NULL, NULL, NULL, 'Developer', NULL, NULL, 'Applex', NULL, '', '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-22 14:16:34', '2021-07-22 14:16:34', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 6609, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(84, 'KGW6whrsP5eb7ba406af383e6d9b160e336be5a935lgoiBkUf', '', '', '4uAaVnF5R5eb7ba406af383e6d9b160e336be5a93y3GcfgF7s', '{\"usd\":0}', 'vitthal.applex@gmail.com', 0, '', '9511241389', 1, '', '', '', '', 'api', NULL, NULL, 'Vitthal', 'H', ' Tale', 'Male', '5/5/2021', NULL, 'UX Designer', NULL, NULL, 'Applex Infotech', '5', 'pune', '', NULL, '', '10', '', '', '', 0, '', '', '', '', '42630.png', '42630.png', 'http://', 'http://', 'http://', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-23 16:59:00', '2021-07-23 16:59:00', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 4748, 1, 1, NULL, NULL, 'http://', '', 'normal', '1', NULL, NULL),
(85, 'rTlvN79A87271759f0b50764749826b2c62e2edf7yE0bucgQa', '', '', 'yroQkV2Nh7271759f0b50764749826b2c62e2edf7QW0ekHhyo', '{\"usd\":0}', 'abc@gmail.com', 0, '', '9800743627', 1, '', '', '', '', 'api', NULL, NULL, 'Kedar', '', 'Shinde', 'Male', '18/02/2021', NULL, 'Andriod Developer', NULL, NULL, 'Applexinfotech', '5 years', 'Kothrud, Pune', '7350123885', 'Lorium2', 'Lorium', '5', 'Lorium', 'abc', '12/06/2021', 0, 'Lorium', '', 'b901ab83c49804387beeaab10514a566.jpg', 'adbd383f68702317b19bd5d7a5ae8800.pdf', '1a0cabfaa2134fb428dc4553496f63c7.png', 'ab94c8a43c930b65747910abc96c272f.jpg', 'www.example', 'www.facebook.com', 'www.linkedin.com', 'www.instagram.com', 'www.twitter.com', 'www.youtube.com', 'www.skype.com', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-28 12:37:23', '2021-07-28 12:37:23', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 2326, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(88, 'BFoSadwJGe95c8a6a676d3de123be19febafbead8BvA87pUcC', '', '', 'uaXP0dKsve95c8a6a676d3de123be19febafbead8Z3oeBglMs', '{\"usd\":0}', '', 0, '', '9890607988', 1, '', '', '', '', 'api', NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-28 19:25:56', '2021-07-28 19:25:56', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 5770, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(94, '9TL4aZyJI0ef9287b824a2724cd8b97edba6507b4R4J23NemD', '', '', 'Dmhgn2B6P0ef9287b824a2724cd8b97edba6507b4rU2ED6F3p', '{\"usd\":0}', 'neha@gmail.com', 0, '', '9890607998', 1, '', '', '', '', 'api', NULL, NULL, 'neha ', '', 'patil', NULL, NULL, NULL, 'developer', NULL, NULL, 'Applex Infotech ', NULL, '', '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-29 16:53:46', '2021-07-29 16:53:46', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 4330, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(98, 'cuVyUt1hRa8a872b53969e11773b674efd8bef52cRlCTfQvJ7', '', '', 'clCtaEUe3a8a872b53969e11773b674efd8bef52chmtbHncC7', '{\"usd\":0}', 'testmail@gmail.com', 0, '', '123456789', 0, '', '', '', '', 'google', '12378787887', NULL, 'test', 'demo', 'd', NULL, NULL, NULL, 'demo', NULL, NULL, 'test', NULL, '', '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-07-29 18:58:10', '2021-07-29 18:58:10', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 9, 1628208000, 1659744000, NULL, '', 'social', '2', NULL, NULL),
(99, 'YmQgeBFrne668d291b92a62537fed2e0689e152d78xZ9JewYz', '', '', 'FDwPh2jcWe668d291b92a62537fed2e0689e152d7xuyvUoKBZ', '{\"usd\":0}', 'jatindangar1995@gmail.com', 0, '', '9824878764', 1, '', '', '', '', 'api', NULL, NULL, 'jatin', '', 'Danagr', NULL, NULL, NULL, 'developer', NULL, NULL, 'applex', NULL, '', '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-30 11:56:53', '2021-07-30 11:56:53', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 6733, 1, 1, NULL, NULL, NULL, '', 'normal', '1', 'Android', 'asjadajs74125'),
(100, 'wbONMXLZl2ab8d084c2cf10f464d04584b71f1b87UYJxGhqac', '', '', 'wAJkNz6ER2ab8d084c2cf10f464d04584b71f1b873v6khOjyo', '{\"usd\":0}', '', 0, '', '9922432049', 1, '', '', '', '', 'api', NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-30 13:52:47', '2021-07-30 13:52:47', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 2040, 1, 1, NULL, NULL, NULL, '', 'normal', '0', NULL, NULL),
(101, 'taWBiYVAcf14df5de82e5034d7fde534f5c8e9d65CF5kPJbK2', '', '', 'KeB4I9Zfhf14df5de82e5034d7fde534f5c8e9d65S5uKltj0X', '{\"usd\":0}', 'vedant@gmail.com', 0, '', '9890607996', 1, '', '', '', '', 'api', NULL, NULL, 'Vendant', 'p', 'Joshi', NULL, NULL, NULL, 'Designer', NULL, NULL, 'Applex ', NULL, 'pune', '2369856666', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-30 15:46:39', '2021-07-30 15:46:39', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 4735, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(102, 'uGLCiBzv47d326b829268569227006b097d682d10yWBbcqeZV', '', '', 'TQjb84s7l7d326b829268569227006b097d682d10YHqEzONRQ', '{\"usd\":0}', 'abcd@gmail.com', 0, '', '9890607995', 1, '', '', '', '', 'api', NULL, NULL, 'Niliesh', 'M', 'Joshi', NULL, NULL, NULL, 'Android Developer', NULL, NULL, 'Applex tech', NULL, 'mumbai, india', '123456700', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-30 15:55:29', '2021-07-30 15:55:29', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 6009, 1, 1, NULL, NULL, NULL, '123456', 'normal', '1', NULL, NULL),
(103, 'oVfbgrJTW370c48d2238e38826ca18ea1c72a5345kiIz1ahAY', '', '', 'dPIYpnsjv370c48d2238e38826ca18ea1c72a5345S23QIr4eA', '{\"usd\":0}', 'Arvin@gmail.com', 0, '', '8690607998', 1, '', '', '', '', 'api', NULL, NULL, 'Arvin', 'M ', 'jgtap', NULL, NULL, NULL, 'Developer ', NULL, NULL, 'Applex ', NULL, 'Pune', '6696366999', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-07-30 16:42:46', '2021-07-30 16:42:46', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 1978, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(104, 'izvTj6t0w151e4fcb8343965ffec76bb4de1322delLO2QpnCg', '', '', '48qyOsoHz151e4fcb8343965ffec76bb4de1322deD6ViA49GR', '{\"usd\":0}', 'neha@gmail.com', 0, '', '', 0, '', '', '', '', 'google', '123', NULL, 'neha', NULL, 'patil', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-07-30 18:14:31', '2021-07-30 18:14:31', '{\"time\":\"2021-07-30 17:14:48 UTC\",\"interface\":\"impersonate\",\"ip_address\":\"157.40.192.143\",\"user_agent\":\"Chrome 92.0.4515.107\"}', 0, '2021-07-31 00:15:04', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', 'social', '0', NULL, NULL),
(105, '5wG2BH4PW14d2e1547b4d8a3306f8e4ca72d01f27VPNXadzgx', 'Applex', '$2y$12$N/DWHky.x7Tj2sNUQ8PphOOtPLPlqm.eJtD79vy.uopjFGTKR8hHu', 'lJg1VWKtu14d2e1547b4d8a3306f8e4ca72d01f27ZhSBEeuNW', '{\"usd\":0}', 'applex@gmail.com', 1, '', '', 0, '', '', '', '', 'web', NULL, NULL, 'Super', NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, 'Aplex Global', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, '2021-07-31 00:15:56', '2021-07-31 00:44:25', '{\"time\":\"2021-08-04 04:40:00 UTC\",\"interface\":\"web\",\"ip_address\":\"150.129.200.63\",\"user_agent\":\"Chrome 92.0.4515.131\"}', 0, '2021-08-04 11:40:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '9999999999', '123456789', NULL, 0, 1, NULL, NULL, NULL, '', 'normal', '0', NULL, NULL),
(106, 'Fym25KjvS254bef4ffad8a633f7f8b1a59d6a37504aOVUItFf', '', '', 'cT5mPQj1X254bef4ffad8a633f7f8b1a59d6a3750R4Ocn15hJ', '{\"usd\":0}', 'nil.kolhe58@gmail.com', 0, '', '9890607952', 0, '', '', '', '', 'facebook', 'true', NULL, 'Nilima', 'Naresh', 'Kolhe', NULL, NULL, NULL, 'Developer ', NULL, NULL, 'Applex infotech ', NULL, 'pune', '5266699908', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-07-31 15:13:11', '2021-07-31 15:13:11', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', '', '1', NULL, NULL),
(107, 'fMU5W7KCze5ae9a365421fa93813293eaf7336043M3RPmBhkL', '', '', 'b2qsgKJdUe5ae9a365421fa93813293eaf7336043fx8orZVQF', '{\"usd\":0}', 'nil.kolhe1@gmail.com', 0, '', '9892607995', 0, '', '', '', '', 'google', '117278136174483689847', NULL, 'Nilima', 'nilesh', 'Kolhe', NULL, NULL, NULL, 'Developer ', NULL, NULL, 'Applex ', NULL, 'pune', '8566653366', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-07-31 18:30:33', '2021-07-31 18:30:33', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', '', '1', NULL, NULL),
(108, 'nKTSIi8XMb7cf93554aa997fafbe9ea4edcf6609aYfNHD5Sal', '', '', 'eq4Gsg2kUb7cf93554aa997fafbe9ea4edcf6609aTfwXSgJBR', '{\"usd\":0}', '', 0, '', '', 0, '', '', '', '', 'google', '12378787', NULL, 'aaa', NULL, 'xx', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-07-31 19:12:34', '2021-07-31 19:12:34', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', '', '0', NULL, NULL),
(109, '24EDqKryM950ca14ca920d86462dc41e6e2896e73IB7axRGV6', '', '', '4WLA0F3rS950ca14ca920d86462dc41e6e2896e73hkgAzZxID', '{\"usd\":0}', 'nillesh@gmail.com', 0, '', '', 0, '', '', '', '', 'google', '1234', NULL, 'neha', NULL, 'patil', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-08-02 12:51:04', '2021-08-02 12:51:04', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', 'social', '0', NULL, NULL),
(110, '763MP1WFV5896d24bbba60218fae69f53dd44501bPrYTaewZb', '', '', 'cDkXyxrmC5896d24bbba60218fae69f53dd44501boE6QLlryO', '{\"usd\":0}', 'nillesh@gmail.com', 0, '', '', 0, '', '', '', '', 'linkdin ', '12345', NULL, 'neha', NULL, 'patil', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-08-02 16:20:01', '2021-08-02 16:20:01', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', 'social', '0', NULL, NULL),
(111, '9gz4S1RKxcaa11dedca85a5341e5534dd3a059214p5El7MTYk', '', '', 'B7FxsncQOcaa11dedca85a5341e5534dd3a059214Q4nPXm38b', '{\"usd\":0}', 'nillesh@gmail.com', 0, '', '', 0, '', '', '', '', 'linkdin', '123456', NULL, 'neha', NULL, 'patil', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-08-02 16:21:27', '2021-08-02 16:21:27', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', 'social', '0', NULL, NULL),
(116, 'haMIYt4PS410e6f6a00ee44953412275f14a70faeIHCRNZ6JE', '', '', 'DBiVLPuov410e6f6a00ee44953412275f14a70faeaePO7c9Vm', '{\"usd\":0}', 'jatindangar1995@gmail.com', 0, '', '', 0, '', '', '', '', 'google', '12378787887', NULL, 'aaa', NULL, 'xx', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-08-02 18:23:54', '2021-08-02 18:23:54', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', 'social', '0', NULL, NULL),
(119, 'qP0bOQivj17466d68f2f223034c53259a106b88295Rkb9eytm', '', '', 'uWGbt28Zk17466d68f2f223034c53259a106b8829Ao8ip9Frc', '{\"usd\":0}', 'nil.kolhe2@gmail.com', 0, '', '9852699963', 0, '', '', '', '', 'facebook', 'true', NULL, 'Nilima', 'Ne', 'Kolhe', NULL, NULL, NULL, 'developer ', NULL, NULL, 'Applex ', NULL, 'pune', '853908558', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-08-02 19:42:21', '2021-08-02 19:42:21', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', 'social', '1', NULL, NULL),
(120, 'uTvS1YLg4ae9efb5c2facec668843d33339c56f243nK8HshYc', '', '', 'DKUIW1QZBae9efb5c2facec668843d33339c56f248YaO5wNxt', '{\"usd\":0}', 'nil.kolhe13@gmail.com', 0, '', '6523680966', 0, '', '', '', '', 'facebook', '604542826913606', NULL, 'Nilima', 'n', 'Kolhe', NULL, NULL, NULL, 'developer ', NULL, NULL, 'applex', NULL, 'pune', '8899985666', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-08-02 19:51:35', '2021-08-02 19:51:35', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', 'social', '1', NULL, NULL),
(121, 'g67dpyBYLcc7ac89ea76060bb2b82f33916eb8c2clWvS4tBLP', '', '', 'ZveKL3Fjqcc7ac89ea76060bb2b82f33916eb8c2c3s7ilkaxm', '{\"usd\":0}', 'nil.kolhe1@gmail.com', 0, '', '9890607998', 1, '', '', '', '', 'facebook', '604542826913606', NULL, 'Nilima', 'n', 'Kolhe', NULL, NULL, NULL, 'developer ', NULL, NULL, 'applex ', NULL, 'pune', '8666699988', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-08-02 20:13:35', '2021-08-02 20:13:35', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 4330, 1, 1, NULL, NULL, NULL, '', 'social', '1', NULL, NULL),
(122, 'dy8D4ZoA23525632688c749337a768350ea022bb6fEjxCHhbs', '', '', 'rqfk6ICld3525632688c749337a768350ea022bb6NnoeyZVrg', '{\"usd\":0}', 'jadhavaish15@gmail.com', 0, '', '7020906173', 1, '', '', '', '', 'api', NULL, NULL, 'Aishwr', 'M', 'Jadhav', NULL, NULL, NULL, 'Jr. Test Engineer', NULL, NULL, 'Applex Infotech', NULL, '', '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-08-03 12:58:10', '2021-08-03 12:58:10', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 2809, 1, 1, NULL, NULL, NULL, '', 'normal', '1', NULL, NULL),
(123, 'ZrMLSQnBJ4e03e1478c475f4bb134b638f6a996d87tbRydz4r', '', '', 'tv8zPB43j4e03e1478c475f4bb134b638f6a996d8uD0oTSadk', '{\"usd\":0}', '', 0, '', '9653655585', 1, '', '', '', '', 'api', NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-08-03 13:59:13', '2021-08-03 13:59:13', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 5786, 1, 1, NULL, NULL, NULL, '', 'normal', '0', NULL, NULL),
(124, '0Bz2ymUxd81928d984e9c299e679cbe5f34b689d9cy4pYZdmn', '', '', 'icu5B06Xn81928d984e9c299e679cbe5f34b689d9XFrsqpLed', '{\"usd\":0}', 'avdhutjadhav@gmail.com', 0, '', '8390235906', 1, '', '', '', '', 'api', NULL, NULL, 'Avdhut', 'A', 'Jadhav', NULL, NULL, NULL, 'Jr. Test Dngineer', NULL, NULL, 'Applex', NULL, 'Pune', '123456788', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-08-03 14:36:50', '2021-08-03 14:36:50', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 1541, 1, 9, 1628208000, 1659744000, NULL, '21', 'normal', '2', NULL, NULL),
(125, '1ZcMY8dpn22d78e01c20a6b2ceb86bb3c4ce61705lF2PhNyuM', '', '', 'acelvjAUp22d78e01c20a6b2ceb86bb3c4ce61705IUmzgpvkb', '{\"usd\":0}', 'ritesh@gmail.com', 0, '', '9890607993', 1, '', '', '', '', 'api', NULL, NULL, 'Ritesh', 'M', 'Jagtap', NULL, NULL, NULL, 'Developer ', NULL, NULL, 'Applexinfotech ', NULL, 'Pune', '2368666669', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-08-04 12:45:00', '2021-08-04 12:45:00', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 8527, 1, 9, 1628035200, 1659571200, NULL, '', 'normal', '2', NULL, NULL),
(126, 'K3i7IhHJC4c2d0ca2e37fa346eea70d82560cd7b9GWDhxH1lI', '', '', 'vrk0Xj1yc4c2d0ca2e37fa346eea70d82560cd7b9QuqHOCfxs', '{\"usd\":0}', 'asish@gmail.com', 0, '', '9890607994', 1, '', '', '', '', 'api', NULL, NULL, 'Aishwarya', 'sha', 'Rane', NULL, NULL, NULL, 'Developer ', NULL, NULL, 'Applex ', NULL, '', '5568855666', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-08-04 19:21:40', '2021-08-04 19:21:40', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 7600, 1, 9, 1628035200, 1659571200, NULL, '', 'normal', '1', NULL, NULL),
(127, '9erqhf8zib85a1160d2c8ddcfc38db76d3277492c5vcwtlGkX', '', '', 'HFywIPQ07b85a1160d2c8ddcfc38db76d3277492ctDw72AMgq', '{\"usd\":0}', 'rohan@gmail.com', 0, '', '9890602333', 1, '', '', '', '', 'api', NULL, NULL, 'Rohan', 'j', 'jagtap', NULL, NULL, NULL, 'Developer ', NULL, NULL, 'Applex ', NULL, '', '8889966666', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-08-04 19:59:42', '2021-08-04 19:59:42', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 7283, 1, 1, 1628035200, 1643932800, NULL, '', 'normal', '2', NULL, NULL),
(128, 'bcViZ8YIde792005e954cc9fb47d661330198212a6rF0K3NSI', '', '', 'ZPUVriA1ke792005e954cc9fb47d661330198212apZSgC2cYj', '{\"usd\":0}', '', 0, '', '9975471322', 1, '', '', '', '', 'api', NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-08-07 17:13:11', '2021-08-07 17:13:11', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 5167, 1, 1, NULL, NULL, NULL, '', 'normal', '0', NULL, NULL),
(129, 'VKFGW1m4y06318c839e0dfa22fafdf5978ef38646jx9aCM4n0', '', '', 'G8dg32M9l06318c839e0dfa22fafdf5978ef38646uaVFxR8SK', '{\"usd\":0}', 'adc@gmail.com', 0, '', '', 0, '', '', '', '', 'google', '123', NULL, 'aaa', NULL, 'jjj', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, '', NULL, '', '', '', 0, '', '', '', '', '', '', NULL, '', '', '', '', '', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', '', 'USD', '', '', '', '', '', '', '', 1, '2021-08-07 20:14:11', '2021-08-07 20:14:11', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '', 0, 0, 1, NULL, NULL, NULL, '', 'social', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_package_purchase`
--

CREATE TABLE `user_package_purchase` (
  `pur_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_startdate` varchar(20) NOT NULL,
  `plan_enddate` varchar(20) NOT NULL,
  `plan_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_package_purchase`
--

INSERT INTO `user_package_purchase` (`pur_id`, `user_id`, `plan_id`, `plan_startdate`, `plan_enddate`, `plan_status`) VALUES
(2, 14, 6, '15-06-2021', '14-06-2022', 'Inactive'),
(3, 14, 6, '15-06-2021', '14-06-2022', 'Inactive'),
(4, 98, 9, '2021-08-04', '2022-08-04', 'Active'),
(5, 126, 9, '2021-08-04', '2022-08-04', 'Active'),
(6, 74, 1, '2021-08-06', '2022-02-06', 'Active'),
(7, 124, 9, '2021-08-06', '2022-08-06', 'Inactive'),
(8, 124, 9, '2021-08-06', '2022-08-06', 'Active'),
(9, 82, 9, '2021-08-06', '2022-08-06', 'Inactive'),
(10, 72, 9, '2021-08-06', '2022-08-06', 'Active'),
(11, 82, 9, '2021-08-06', '2022-08-06', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_temp`
--

CREATE TABLE `user_temp` (
  `id` int(11) NOT NULL,
  `phone` varchar(21) NOT NULL,
  `phone_verified` tinyint(4) NOT NULL,
  `otp` int(6) DEFAULT NULL,
  `otp_verified` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0-not verified,1-verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_temp`
--

INSERT INTO `user_temp` (`id`, `phone`, `phone_verified`, `otp`, `otp_verified`) VALUES
(1, '7350123885', 1, 6959, 1),
(2, '9988998899', 1, 3942, 1),
(3, '9890607998', 1, 4330, 1),
(4, '9922432049', 1, 2040, 1),
(5, '9922432050', 1, 5774, 1),
(6, '9850325204', 1, 6278, 1),
(7, '9320275954', 1, 4309, 1),
(8, '9977997799', 1, 8401, 1),
(9, '8626032080', 1, 2994, 1),
(10, '9766617799', 1, 7187, 1),
(11, '8600635385', 1, 8693, 1),
(12, '7984862327', 1, 6609, 1),
(13, '9511241389', 1, 4748, 1),
(14, '8877887788', 1, 2326, 1),
(17, '9890607988', 1, 5770, 1),
(18, '9824878764', 1, 6733, 1),
(19, '98007436277', 0, 2161, 0),
(20, '9890607999', 0, 2141, 0),
(21, '9060799956', 0, 4783, 0),
(22, '9890607996', 1, 4735, 1),
(23, '9890607995', 1, 6009, 1),
(24, '8690607998', 1, 1978, 1),
(25, '8298906079', 0, 2901, 0),
(26, '8598906079', 0, 3793, 0),
(27, '7020906173', 1, 2809, 1),
(28, '9653655585', 1, 5786, 1),
(29, '8390235906', 1, 1541, 1),
(30, '9890607993', 1, 8527, 1),
(31, '9890607994', 1, 7600, 1),
(32, '9890602333', 1, 7283, 1),
(33, '9975471322', 1, 5167, 1);

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
-- Indexes for table `buddies`
--
ALTER TABLE `buddies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_transaction`
--
ALTER TABLE `business_transaction`
  ADD PRIMARY KEY (`bns_trans_id`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
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
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
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
-- Indexes for table `postcategory`
--
ALTER TABLE `postcategory`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `postdetail`
--
ALTER TABLE `postdetail`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`post_cmt_id`);

--
-- Indexes for table `post_like_dislike`
--
ALTER TABLE `post_like_dislike`
  ADD PRIMARY KEY (`post_like_dislike_id`);

--
-- Indexes for table `ratings_reviews`
--
ALTER TABLE `ratings_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recomendation`
--
ALTER TABLE `recomendation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirements_status`
--
ALTER TABLE `requirements_status`
  ADD PRIMARY KEY (`req_status_id`);

--
-- Indexes for table `requirements_user_status`
--
ALTER TABLE `requirements_user_status`
  ADD PRIMARY KEY (`req_user_status_id`);

--
-- Indexes for table `reward_point`
--
ALTER TABLE `reward_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_user_point`
--
ALTER TABLE `reward_user_point`
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
-- Indexes for table `tbl_functional_area`
--
ALTER TABLE `tbl_functional_area`
  ADD PRIMARY KEY (`functional_area_id`);

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
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `turn_over`
--
ALTER TABLE `turn_over`
  ADD PRIMARY KEY (`turn_over_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_package_purchase`
--
ALTER TABLE `user_package_purchase`
  ADD PRIMARY KEY (`pur_id`);

--
-- Indexes for table `user_temp`
--
ALTER TABLE `user_temp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `backup_log`
--
ALTER TABLE `backup_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buddies`
--
ALTER TABLE `buddies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `business_transaction`
--
ALTER TABLE `business_transaction`
  MODIFY `bns_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `connection`
--
ALTER TABLE `connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
  MODIFY `fet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `file_manager`
--
ALTER TABLE `file_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `module_permission`
--
ALTER TABLE `module_permission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `oauth_connector`
--
ALTER TABLE `oauth_connector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `postcategory`
--
ALTER TABLE `postcategory`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `postdetail`
--
ALTER TABLE `postdetail`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `post_cmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_like_dislike`
--
ALTER TABLE `post_like_dislike`
  MODIFY `post_like_dislike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ratings_reviews`
--
ALTER TABLE `ratings_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `recomendation`
--
ALTER TABLE `recomendation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `requirements_status`
--
ALTER TABLE `requirements_status`
  MODIFY `req_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `requirements_user_status`
--
ALTER TABLE `requirements_user_status`
  MODIFY `req_user_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reward_point`
--
ALTER TABLE `reward_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reward_user_point`
--
ALTER TABLE `reward_user_point`
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
-- AUTO_INCREMENT for table `tbl_functional_area`
--
ALTER TABLE `tbl_functional_area`
  MODIFY `functional_area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `throttling`
--
ALTER TABLE `throttling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `turn_over`
--
ALTER TABLE `turn_over`
  MODIFY `turn_over_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `user_package_purchase`
--
ALTER TABLE `user_package_purchase`
  MODIFY `pur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_temp`
--
ALTER TABLE `user_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
