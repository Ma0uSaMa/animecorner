-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 04:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anime_corner`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`id`, `name`, `username`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Sayonara', 'admin', '$2y$10$nTTh3UhgWIH64bN8053/reCNRofROd3Mqv5NVu7TCr/TdVlWbl.iu', 'super admin', 'active', '2023-06-01 10:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `anime_details_insert`
--

CREATE TABLE `anime_details_insert` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `aired_date` date NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anime_details_insert`
--

INSERT INTO `anime_details_insert` (`id`, `title`, `description`, `aired_date`, `photo`) VALUES
(3, 'sadadsafasf', 'sadfghgjhkfyasmgngvxbzfdb', '2023-07-20', 'images/anime_photos/3_SHANKS.jpeg'),
(4, 'sadddddddddddddddddddddd', 'saddddddddddddddddddddddddddddddddddddd', '2023-07-14', 'images/anime_photos/4_SHANKS.jpeg'),
(5, 'asdddddddddddd', 'asddddddddddddddddddddddd', '2023-07-12', 'images/anime_photos/5_SHANKS.jpeg'),
(6, 'sadadsadcas', 'asfcEAWf awtvfatvtf', '2023-07-21', 'images/anime_photos/6_SHANKS.jpeg'),
(7, 'asdasd', 'dasdsadasdasd', '2023-07-14', 'images/anime_photos/7_SHANKS.jpeg'),
(8, 'sadsadsavcsda', 'sacfcccccccccccccccccccccccccccc', '2023-07-12', 'images/anime_photos/8_SHANKS.jpeg'),
(9, 'sadsadsavcsda', 'sacfcccccccccccccccccccccccccccc', '2023-07-12', 'images/anime_photos/9_7_SHANKS.jpeg'),
(10, 'sadsadsavcsda', 'sacfcccccccccccccccccccccccccccc', '2023-07-12', 'images/anime_photos/10_SHANKS.jpeg'),
(11, 'asdadas', 'dsadddddddddddd', '2023-07-06', 'images/anime_photos/11_SHANKS.jpeg'),
(12, 'sadsa', 'adsdasd', '2023-07-05', 'images/anime_photos/12_SHANKS.jpeg'),
(13, 'sadsa', 'adsdasd', '2023-07-05', 'images/anime_photos/13_SHANKS.jpeg'),
(14, 'saS', 'SDASAD', '2023-07-19', 'images/anime_photos/14_SHANKS.jpeg'),
(15, 'SDADAD', 'SADASDSAFCASCAS', '2023-07-21', 'images/anime_photos/15_SHANKS.jpeg'),
(20, 'bvQEDCEXAFA', 'ASCDWEAFSAVS', '2023-07-12', 'images/anime_photos/64ba8e989a08e_11_SHANKS.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users_credentials`
--

CREATE TABLE `users_credentials` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `roles` varchar(255) DEFAULT 'normie',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_credentials`
--

INSERT INTO `users_credentials` (`id`, `firstname`, `lastname`, `email`, `password`, `dob`, `gender`, `roles`, `created_at`) VALUES
(11, 'Saroj', 'Rai', 'dsad@gmail.com', '$2y$10$okwAUYVXX869q66D3JL0j.JRGvyJLzp5zvXfztw1AfkeQJiVc1mEW', '2006-11-04', 'male', 'normie', '2023-07-01 07:15:02'),
(12, 'Saroj', 'Rai', 'dsad1234556@gmail.com', '$2y$10$soS6n8IzsoL6OAiPHMqJNuHaU9.bZl/lvPmhtgCgmcxlxXHhpSd9i', '2007-11-17', 'male', 'normie', '2023-07-01 08:54:27'),
(13, 'ayaka', 'kamisaito', 'kami@gmail.com', '$2y$10$6aEb4MmFb9BVgGY/X.eMlO3aXP2L07475CYwf6EX/qYSxv8mNIori', '2008-03-17', 'male', 'normie', '2023-07-14 10:31:54'),
(14, 'abc', 'xyz', 'admin@admin.com', '$2y$10$8G6CBO7f5qF429WTLyBLNOP3vhHgVvAT8oUsnWuDMmsFNAEWwuCSS', '2009-02-18', 'female', 'normie', '2023-07-24 14:34:24'),
(15, 'abc', 'xyz', 'admin12@admin.com', '$2y$10$DLTeKbNSGsQtEm6Wiseg0.Jv6oWXvjMjSnv7P08n.mrqA26tX9kWO', '2009-02-18', 'female', 'normie', '2023-07-24 15:01:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anime_details_insert`
--
ALTER TABLE `anime_details_insert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_credentials`
--
ALTER TABLE `users_credentials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `anime_details_insert`
--
ALTER TABLE `anime_details_insert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users_credentials`
--
ALTER TABLE `users_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
