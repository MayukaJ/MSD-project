-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2017 at 04:57 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donatelk`
--

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `user_id` varchar(20) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`user_id`, `rating`) VALUES
('aba0000000', 0),
('aba9999', 0),
('c11', 0),
('rash111', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(15) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` mediumtext NOT NULL,
  `photo_path` varchar(50) NOT NULL,
  `donor_id` varchar(20) NOT NULL,
  `requester_id` varchar(6) DEFAULT NULL,
  `category` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_submitted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `title`, `description`, `photo_path`, `donor_id`, `requester_id`, `category`, `status`, `date_submitted`) VALUES
(1, 'A', 'aa', '', 'rash111', 'aba008', 'clothes', 'confirmed ', '0000-00-00 00:00:00'),
(2, 'NEW ITEM', 'aa', '', 'aba123', '', 'clothes', 'sent', '0000-00-00 00:00:00'),
(4, 'A', 'aa', '', 'rash111', '', 'clothes', 'advertised', '2017-12-19 08:14:56'),
(5, 'NEW ITEM', 'aa', 'item_images/5.jpg', 'aba123', '', 'clothes', 'sent', '2017-12-19 08:25:35'),
(6, 'A', 'aa', 'item_images/6.jpg', 'aba123', 'aba008', 'clothes', 'advertised', '2017-12-19 08:30:00'),
(7, 'A', 'aa', '', 'aba123', NULL, 'clothes', 'advertised', '2017-12-19 08:35:29'),
(8, 'Food Sugar', 'Tasty food for you', '', 'aba123', NULL, 'Food', 'advertised', '2017-12-19 09:02:42'),
(9, 'GAPTshirts', 'Brand new t shirts for u', '', 'aba123', NULL, 'clothes', 'advertised', '2017-12-19 09:09:25'),
(10, 'A', 'aa', '', 'aba123', NULL, 'clothes', 'advertised', '2017-12-19 08:29:03'),
(11, 'GAPTshirts', 'Brand new t shirts for u', '', 'aba123', NULL, 'clothes', 'advertised', '2017-12-19 09:12:34'),
(12, 'A', 'aa', 'item_images/12.jpg', 'aba123', NULL, 'clothes', 'advertised', '2017-12-19 14:27:10'),
(13, 'A', 'aa', 'item_images/13.jpg', 'aba123', NULL, 'clothes', 'advertised', '2017-12-19 14:27:45'),
(14, 'Sc', 'dvzsv', 'item_images/14.jpg', 'aba123', NULL, 'clothes', 'advertised', '2017-12-19 16:50:02'),
(15, 'Asfb', 'vsfdbsdfzb', 'item_images/15.jpg', 'aba123', NULL, 'shoes', 'advertised', '2017-12-20 05:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` varchar(15) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `item_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `user_id`, `item_id`) VALUES
('1', 'aba008', 6),
('5', 'aba008', 1),
('7', 'aba008', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL,
  `pwd` varchar(65) NOT NULL,
  `status` char(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` char(1) NOT NULL,
  `nic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pwd`, `status`, `date_created`, `name`, `address`, `phone`, `email`, `type`, `nic`) VALUES
('aaaaaa', '$2y$10$uPp', 'a', '2017-12-23 15:08:44', 'aaaaaa', 'A3(a), University Quarters,, Upper Hanthana', '758203376', 'abarajithan07@gmail.com', 'R', '11'),
('aba0000000', '$2y$10$UDONloRuLAwNBN58Mrm5SONdu2XaxavZPOdD5UTnx0dUzAftg/9BC', 'a', '2017-12-23 23:58:21', 'Abarajithan Gnaneswr', 'A3(a), University Quarters,, Upper Hanthana', '758203376', 'abarajithan07@gmail.com', 'D', '11111111111'),
('aba007', '$2y$10$B6z', 'a', '2017-12-23 19:26:54', 'Aba', 'A3(a), University Quarters,, Upper Hanthana', '758203376', 'abarajithan07@gmail.com', 'R', '11'),
('aba008', '$2y$10$ZxLtuzfURjPFZ9gfQaQuMuXmRxkL3fPz2ujFqbqogEHTtLugajVgy', 'r', '2017-12-24 02:30:32', 'Abarajithan Gnaneswr', 'A3(a), University Quarters,, Upper Hanthana', '758203376', 'abarajithan07@gmail.com', 'R', '11'),
('aba222', '$2y$10$lKM', 'a', '2017-12-23 18:28:28', 'Abarajithan Gnaneswr', 'A3(a), University Quarters,, Upper Hanthana', '758203376', 'abarajithan07@gmail.com', 'R', '11'),
('aba9999', '$2y$10$a4xe3KekZ76OFUXCB99DXeprE4.6KZ7bWmVPLzYow1MpdxT2Zj/Ya', 'a', '2017-12-23 23:52:21', 'Abarajithan Gnaneswr', 'A3(a), University Quarters,, Upper Hanthana', '758203376', 'abarajithan07@gmail.com', 'D', '11'),
('aba_admin', '$2y$10$qDDIkGLRUsrXOD1f4YEpj.V2FwT13fGjFZAe84tigcRZnb76mHVg.', 'a', '2017-12-24 03:04:36', 'Abarajithan Admin', 'aa', '011', 'a@a.cm', 'A', '11'),
('abc123', '$2y$10$JaU', 'w', '2017-12-23 19:20:06', 'scsa', 'A3(a), University Quarters,, Upper Hanthana', '758203376', 'abarajithan07@gmail.com', 'R', '11'),
('bbbbbb', '$2y$10$/.2', 'r', '2017-12-23 19:17:39', 'bbbbbbbbbbbb', 'A3(a), University Quarters,, Upper Hanthana', '758203376', 'abarajithan07@gmail.com', 'R', '11'),
('c11', '$2y$10$HPsXCy9SdmJSLNACOitIe.yd3s8XIqKMpElMAxi0IMlpek/dokHzy', 'a', '2017-12-24 00:01:37', 'chinthana', 'cc', '11', 'c@c.l', 'D', '11'),
('rash111', '$2y$10$iDlbm6ALZa5fbDXzvwunOuvw91BecGWmnzEDZAIKRMbkuga0nFiPm', 'a', '2017-12-24 00:05:49', 'rashmin', 'aa', '11', 'r@r.c', 'D', '11');

-- --------------------------------------------------------

--
-- Table structure for table `user_requester`
--

CREATE TABLE `user_requester` (
  `user_id` varchar(10) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `occupation` varchar(20) NOT NULL,
  `place of work` varchar(30) NOT NULL,
  `salary` varchar(10) NOT NULL,
  `proofdoc` varchar(60) NOT NULL,
  `summary` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_requester`
--

INSERT INTO `user_requester` (`user_id`, `age`, `occupation`, `place of work`, `salary`, `proofdoc`, `summary`) VALUES
('aaaaaa', 12, 'aaaaaaa', 'aaa', '111', 'item_images/aaaaaaaaaa.JPG', 'aaaaa'),
('aba007', 11, 'aa', 'aaa', '10', 'user_proofdocs/aba007.JPG', 'aaaaaaaa'),
('aba008', 11, '11', '11', '11', 'user_proofdocs/aba008.JPG', 'aaa'),
('aba222', 11, 'aaa', 'aaa', '11', 'user_proofdocs/aba222.JPG', 'aaa'),
('abc123', 22, 'aa', 'aa', '12', 'item_images/abc123.txt', 'fbxdf'),
('bbbbbb', 11, 'aa', 'aa', '11', 'item_images/bbbbbbbbbbbbbbbbbbb.JPG', 'aaa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_requester`
--
ALTER TABLE `user_requester`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
