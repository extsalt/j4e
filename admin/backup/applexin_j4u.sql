-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2021 at 02:36 AM
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
-- Database: `applexin_j4u`
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
(88, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', 'Information', 'signin-success', '{\"ip\":\"157.32.23.139\",\"is_mobile\":false,\"is_browser\":true,\"browser_name\":\"Chrome\",\"browser_version\":\"89.0.4389.128\",\"platform\":\"Windows 10\"}', '', '2021-04-17 14:31:10');

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
  `fet_name` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`fet_id`, `fet_name`) VALUES
(2, 'Test Features 1'),
(3, 'Test Features 2');

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
  `menu_status` enum('1','2') NOT NULL COMMENT '''1''=''Active'', ''2''=''Inactive'''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_link`, `menu_parent`, `menu_status`) VALUES
(1, 'Master', '#', 0, '1'),
(2, 'Package', 'packages', 1, '1'),
(3, 'Features', 'packages/managefeature', 1, '1');

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
(4, 1, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(5, 2, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(6, 2, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '2', '2', '2', '2'),
(7, 2, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(8, 2, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2'),
(9, 3, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', '2', '2', '2', '2'),
(10, 3, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', '1', '1', '2', '2'),
(11, 3, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '2', '2', '2', '2'),
(12, 3, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', '2', '2', '2', '2');

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
  `pack_creatat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`pack_id`, `pack_name`, `pack_desc`, `pack_price`, `pack_for`, `pack_fet`, `pack_creatat`) VALUES
(2, 'Test 2', '<p>demo</p>', 1000, 'Yearly', '2', '2021-04-15 15:24:54'),
(3, 'Test 3', '<p>Demo</p>', 10000, 'Yearly', '2/3', '2021-04-15 15:25:39');

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
(8, '4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS', 0, 'Site_Setting');

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
(1, 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, 'Super_Admin', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":true,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":true,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":true,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":true,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":true,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":true,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":true,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(2, 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', 1, 'Admin', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":true,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(3, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, 'User', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1'),
(10, 'rFUsJHPVd1a170055df69377345a9a3c9156b68adxhmbvPkBM', 0, 'Company', '{\"clS0yImZs6d5c5313f55ce8da264739388072f066KxvhYGN6r\":false,\"GPb9zsStof247c17218790606d68f5b35d717a11fL9gIMAB3w\":false,\"qVkzOmGWvfbffeb1362f77a7e4907c4a406cf7d8fJ6zlgRE4b\":false,\"PltnM3iOv30c602d36754ab238e35a90d59d77713xcXwaBnhu\":false,\"xUghnS8rX9057421bb62cc8e6800b720c0f4042beR9m7zZ3xb\":false,\"g8aI6bw5V6d930844f19fc137ac17260fe6b65043gQ9HKemkT\":false,\"VzamDpcvhb706e8635168dd315656a30654e13db9fqcjSnpsm\":false,\"4dLUmG1NVa3144395eeb438a0cd8194e4dccc0195PlzpDL8eS\":false}', '1');

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
(1, 'J4U', 'default', 0, 'Under Maintenance, Please try later.', 1, 'low', 1, '{\"title\":\"T&C Title\",\"body\":\"T&C Body\"}', 0, 0, 1, 1, 0, 0, 1, 'normal', 15, 0, '{\"version\":\"v2_1\",\"site_key\":\"\",\"secret_key\":\"\"}', '', '{\"google\":{\"enabled\":0,\"client_id\":\"\",\"client_secret\":\"\"},\"facebook\":{\"enabled\":0,\"app_id\":\"\",\"app_secret\":\"\"},\"twitter\":{\"enabled\":0,\"consumer_key\":\"\",\"consumer_secret\":\"\"}}', 'disabled', '{\"host\":\"\",\"port\":\"\",\"is_auth\":1,\"username\":\"\",\"password\":\"\",\"crypto\":\"none\",\"from_email\":\"\",\"from_name\":\"\"}', 25, 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', '0', 0, '1999-12-31 18:30:00', '{\"enabled\":1,\"allow_remove\":0,\"cookie_message\":\"This website uses cookies to ensure you get the best experience on our website.\",\"cookie_policy_link_text\":\"Learn more\",\"cookie_policy_link\":\"https:\\/\\/applexinfotech.com\\/CyberBukit\\/generic\\/terms_conditions\"}', '{\"type\":\"sandbox\",\"feature\":\"both\",\"tax_rate\":0,\"stripe_one_time_enabled\":\"0\",\"stripe_recurring_enabled\":\"0\",\"stripe_publishable_key\":\"\",\"stripe_secret_key\":\"\",\"stripe_signing_secret\":\"\",\"paypal_one_time_enabled\":\"0\",\"paypal_recurring_enabled\":\"0\",\"paypal_client_id\":\"\",\"paypal_secret\":\"\",\"paypal_webhook_id\":\"\"}', '{\"enabled\":1,\"company_name\":\"\",\"company_number\":\"\",\"tax_number\":\"\",\"address_line_1\":\"\",\"address_line_2\":\"\",\"phone\":\"\"}', '{\"enabled\":1,\"guest_ticket\":0,\"rating\":1,\"allow_upload\":0,\"notify_agent_list\":\"\",\"notify_user\":0,\"close_rule\":\"3\"}', '{\"file_type\":\"jpg|jpeg|png|gif|svg|zip|rar|pdf|mp3|mp4|doc|docx|xls|xlsx|csv\",\"file_size\":\"102400\"}', '{\"enabled\":0,\"logo\":\"logo.png\",\"company_name\":\"Applex Group\",\"email_address\":\"support@applexgroup.com\",\"html_title\":\"Applex Group\",\"html_author\":\"Applex Group\",\"html_description\":\"\",\"html_keyword\":\"\",\"about_us\":\"\",\"pricing_enabled\":1,\"faq_enabled\":1,\"documentation_enabled\":1,\"blog_enabled\":1,\"subscriber_enabled\":1,\"social_facebook\":\"\",\"social_twitter\":\"\",\"social_linkedin\":\"\",\"social_github\":\"\",\"custom_css\":\"\",\"custom_javascript\":\"\"}', '{}', '{\"enabled\":0,\"commission_policy\":\"A\",\"commission_rate\":0, \"description\":\"\", \"stuff\":\"\"}', '', '', '1.7.2');

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
(1, '0bWHjn9usb065a85cc223037e3b5dff82c4c08fba2XaMlC3Gk', 'superadmin', '$2y$12$C7CqeB92FgzuqMDwqKrCz.jSau2HFsC7CzUMh39YfGYy4BatmJWzW', 'pljhshumN66e81b818cbdfbki90e1190206e6cf7c97gassvv', '{\"usd\":0}', 'admin@admin.com', 1, '', '', 0, '', '', '', '', '', 'Super', 'Admin', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, NULL, NULL, NULL, 0, NULL, 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(7, 'sYqF2eQ8M4400e66baa44ff6a292abc0aab9f81e21T83lazBm', '', '$2y$12$cFGnCnihrIVTkRhLsLrYpegaUPEHrZ2rdGER4KFFTbt21i.pa7Ca2', 'nIEXWQcG14400e66baa44ff6a292abc0aab9f81e27UIruKtJO', '{\"usd\":0}', 'applexadmin@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'Applex', 'Admin', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', 1, '2021-04-07 21:36:03', '2021-04-07 21:36:03', '{\"time\":\"2021-04-16 14:44:26 UTC\",\"interface\":\"web\",\"ip_address\":\"157.32.114.68\",\"user_agent\":\"Chrome 89.0.4389.128\"}', 1, '2021-04-16 22:12:19', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(8, '2WaT0sB7Odc2f40837b443ef6a220af573de4b8eeGfmrz9I8g', '', '$2y$12$G33QhCqEr93PGQ3VeyYHOuiodUCd7rJMy9rj1p6yRwhOx69pvzwuq', 'WsAhiJ8kZ5da102c56a122f1e8af72151dde23b2ag26jRF4lN', '{\"usd\":0}', 'applexuser@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'applex', 'user', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F', 1, '2021-04-07 21:37:44', '2021-04-07 21:37:44', '{\"time\":\"2021-04-07 17:18:03 UTC\",\"interface\":\"web\",\"ip_address\":\"45.252.73.80\",\"user_agent\":\"Chrome 89.0.4389.105\"}', 0, '2021-04-08 00:18:03', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(9, '8G5WfA37x48b882088184c3702a6812864b2b0755fg1S5oKPZ', '', '$2y$12$N/DWHky.x7Tj2sNUQ8PphOOtPLPlqm.eJtD79vy.uopjFGTKR8hHu', 'AwghqMjbU759d7d500a8193cf99379541111ea239j719BADXu', '{\"usd\":0}', 'applex@gmail.com', 1, '', '', 0, '', '', '', '', '', 'Applex', 'Super Admin', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, '2021-04-07 21:41:51', '2021-04-07 21:41:51', '{\"time\":\"2021-04-17 07:31:10 UTC\",\"interface\":\"web\",\"ip_address\":\"157.32.23.139\",\"user_agent\":\"Chrome 89.0.4389.128\"}', 1, '2021-04-17 14:31:34', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(10, '9WQCpcHkB118d92bef62d45e2a279edc1e7eadba7C1nxFt4rW', 'demo', '$2y$12$QRD6ZmF7eLR..cOUljUim.YEf/cCFxF9c3FH4v1Ju9Hhvol8IZ6W.', 'D1LOjZxoY118d92bef62d45e2a279edc1e7eadba7nBbe39AvF', '{\"usd\":0}', 'demosuperadmin@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'demo', 'superadmin', '', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE', 1, '2021-04-07 22:06:08', '2021-04-07 22:06:08', '{\"time\":\"2021-04-07 15:16:38 UTC\",\"interface\":\"web\",\"ip_address\":\"49.34.35.220\",\"user_agent\":\"Chrome 89.0.4389.114\"}', 0, '2021-04-07 22:16:39', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(12, 'TOgBpNEyz97da8025f6e437bf7b84feb145d63ac7qHXEeGZzp', 'company', '$2y$12$uof.Fx0o/lUOzo1K/E7rDe7dFCwCgHILjLIMwuCVi2exaHdtyP5cO', 'O0ZCzUNdV97da8025f6e437bf7b84feb145d63ac7GIzYVx0Ut', '{\"usd\":0}', 'test@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'test Company', '', '4', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', 1, '2021-04-13 19:26:22', '2021-04-13 19:26:22', '{\"time\":\"2021-04-14 13:37:09 UTC\",\"interface\":\"web\",\"ip_address\":\"157.32.68.162\",\"user_agent\":\"Chrome 89.0.4389.114\"}', 1, '2021-04-14 20:37:09', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', ''),
(13, 'ZX76OEhQ9acd3ebff02335deac2556ae54ed62643teIaRUcxN', 'company', '$2y$12$qfTBa/yzn.KM1TWYic1e8eNd1rWYA.oK/9sCt2fk1t98s0CWs9Vs2', 'X4ODpRUZV920a6efdb07156d03afb96f5c05228ff5zmEPvkAK', '{\"usd\":0}', 'test2@gmail.com', 1, '', '', 0, '', '', '', '', 'web', 'test Company 2', '', '5', 'default.jpg', 'UTC', 'Y-m-d', 'H:i:s', 'English', 'USD', '', '', '', '', '', '', 'wIHxFXf2od10023bde3961e6fed9c560e13ac75f2sE03pBt7v', 1, '2021-04-13 19:30:25', '2021-04-13 19:30:25', '', 0, '0000-00-00 00:00:00', 0, '{\"src_from\":\"\",\"referral_code\":\"\"}', 0, '', '{}', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `backup_log`
--
ALTER TABLE `backup_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `fet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `file_manager`
--
ALTER TABLE `file_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `module_permission`
--
ALTER TABLE `module_permission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
