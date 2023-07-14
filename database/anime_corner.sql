-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 04:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(1, 'Sayonara', 'admin', '$2y$10$nTTh3UhgWIH64bN8053/reCNRofROd3Mqv5NVu7TCr/TdVlWbl.iu', 'admin', 'active', '2023-06-01 10:17:04');

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
(12, 'Saroj', 'Rai', 'dsad1234556@gmail.com', '$2y$10$soS6n8IzsoL6OAiPHMqJNuHaU9.bZl/lvPmhtgCgmcxlxXHhpSd9i', '2007-11-17', 'male', 'normie', '2023-07-01 08:54:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
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
-- AUTO_INCREMENT for table `users_credentials`
--
ALTER TABLE `users_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
