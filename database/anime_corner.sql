-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2023 at 04:13 PM
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
(20, 'bvQEDCEXAFA', 'ASCDWEAFSAVS', '2023-07-12', 'images/anime_photos/64ba8e989a08e_11_SHANKS.jpeg'),
(21, 'One Piece', '\"One Piece\" follows the adventures of Monkey D. Luffy, a young boy who sets out to become the Pirate King. Inspired by his childhood idol, the legendary pirate Gol D. Roger, Luffy embarks on a journey to find the ultimate treasure known as the \"One Piece,\" which is said to be located at the end of the Grand Line, a treacherous and mysterious sea route.', '1999-10-20', 'images/anime_photos/64c27ff0c4bee_One Piece.png'),
(22, 'Naruto', 'Naruto is an energetic and mischievous kid who dreams of becoming the strongest ninja and earning the title of Hokage, the leader of the Hidden Leaf Village. However, Naruto carries a burden as a child—he is the host of the Nine-Tails Fox, a malevolent and powerful creature that attacked Konoha years ago. Many villagers resent Naruto and see him as a menace due to the beast within him.', '2003-10-03', 'images/anime_photos/64c288e84b859_naruto.png'),
(23, 'Bleach', 'The encounter that changes Ichigo\'s life forever occurs when he stumbles upon a mysterious girl named Rukia Kuchiki, who is a Soul Reaper. While battling an evil spirit known as a Hollow, Rukia is injured, and to save his family and friends, Ichigo accepts her offer to transfer her powers temporarily.', '2004-10-05', 'images/anime_photos/64c28ad07790a_bleach.png'),
(24, 'cxcasca', 'ascdascasc', '2023-07-13', 'images/anime_photos/64c28e9768aaf_SHANKS.jpeg');

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
(15, 'abc', 'xyz', 'admin12@admin.com', '$2y$10$DLTeKbNSGsQtEm6Wiseg0.Jv6oWXvjMjSnv7P08n.mrqA26tX9kWO', '2009-02-18', 'female', 'normie', '2023-07-24 15:01:07'),
(16, 'abc', 'xyz', 'admin124324124@admin.com', '$2y$10$4sLcg5z3vLTc2b8INSBwoOMGfgS1N2v4yzHNxt8FlEC3m2yxDlqLO', '2008-01-16', 'male', 'normie', '2023-08-11 08:24:37'),
(17, 'abc', 'xyz', 'adminffsdsa231@admin.com', '$2y$10$sb5XwA9O78R0Y1TgUkhYyeAvAKeUqiGLjhF1tLnJkvEdPv5n1bl3u', '2007-03-18', 'male', 'normie', '2023-08-11 12:10:44'),
(18, 'abc', 'xyz', 'admin21313@admin.com', '$2y$10$VuorxZqWJF4ZWJrfm97EbuATLhfemOjxSlrWboEIqC137yvnaf0X6', '2007-02-17', 'male', 'normie', '2023-08-11 12:16:37'),
(19, 'abc', 'xyz', 'admin21e12ed1@admin.com', '$2y$10$OMoRSfSGEZnvcDY32tBZeO64EzYNtnw6lpNESpR.sKfvd.nTVWLU6', '2006-03-16', 'male', 'normie', '2023-08-11 12:20:48'),
(20, 'abc', 'xyz', 'admissss@admin.com', '$2y$10$xevBS91Ea5wc0cZWigaooeOiqJTJoXORButDdjF.FwTe6WxmpIerC', '2006-02-17', 'male', 'normie', '2023-08-12 08:29:38'),
(21, 'abc', 'xyz', 'admissssss@admin.com', '$2y$10$UepuY8tgOoQ2EJuqBroUgeB0359MUUQ6F6qoaCdDxzZi3D5k3xiRy', '2006-02-17', 'male', 'normie', '2023-08-12 08:29:42'),
(22, 'abc', 'xyz', 'admissssssss@admin.com', '$2y$10$SvEVPOhGRDDgBIjgAfTAr.wu8MPCsWd.1WlEkVG1qKzbjdCd1MIqa', '2006-02-17', 'male', 'normie', '2023-08-12 08:29:48'),
(23, 'abc', 'xyz', 'adminasd@admin.com', '$2y$10$Pba3dWECBu9IHgvkgKbwhO4k5/OScX.WjJ4hA9ctF.CYYUSWOB2Iy', '2006-02-17', 'male', 'normie', '2023-08-12 08:33:14'),
(24, 'abc', 'xyz', 'adminasasd@admin.com', '$2y$10$erw3Zb82.eA7X.H9Z9ZgeOlAuElMh4G.TnnVaBeDgYUqthmrRCGR6', '2006-02-17', 'male', 'normie', '2023-08-12 08:33:19'),
(25, 'abc', 'xyz', 'adminasasasd@admin.com', '$2y$10$ve2rSDG7HUu7gpxz9oJQn.4TtYfLw8Oliduqyk8sudG8QfCriA616', '2006-02-17', 'male', 'normie', '2023-08-12 08:33:25'),
(26, 'abc', 'xyz', 'adminsadasd@admin.com', '$2y$10$jn3U2554Y0Jhe0EMikWvuO97LGdCoMtXYPKBT5V4KlrD8Q.iPc4E2', '2006-05-17', 'male', 'normie', '2023-08-12 14:02:11'),
(27, 'abc', 'xyz', 'admdsadinsadasd@admin.com', '$2y$10$Tylvz1C1QFWiXX4o7jQHceTobaStODcUit/Zi3NJ6aevLUOvzfTYG', '2006-05-17', 'male', 'normie', '2023-08-12 14:02:16'),
(28, 'abc', 'xyz', 'adminss@admin.com', '$2y$10$SZ4T/6sZsXbGnIM9UY2.aOHXY2zWvjZxY.39Mfw6dPUJSFxQX2Jsu', '2006-03-17', 'male', 'normie', '2023-08-12 14:03:57'),
(29, 'abc', 'xyz', 'admin1243256@admin.com', '$2y$10$lxAHacyx9pEVUre3AEjd4.68o0SBWX4vpc7YKmdp0FqLyUuAAkjSa', '2007-02-18', 'male', 'normie', '2023-08-12 14:07:48'),
(30, 'abc', 'xyz', 'admindsavewvv@admin.com', '$2y$10$nGfFDkDwHjdZpVij1xRxyujPsciAaffJGTroqZoBNqmjw7fNeAmMu', '2006-03-19', 'male', 'normie', '2023-08-12 14:10:04'),
(31, 'abc', 'xyz', 'adminsdaasd@admin.com', '$2y$10$KsnBVK2J2nMa5fdauv2RDusnpbAtZGMNlsGjD6SKLLA8Z93rozlkG', '2006-02-18', 'male', 'normie', '2023-08-12 14:13:03'),
(32, 'abc', 'xyz', 'adminsdaasadascsd@admin.com', '$2y$10$VX76NiV0GXX68FEiN0OWSOoqa1WusPMo.fH6ZfsRSrpuReYennGX6', '2006-02-18', 'male', 'normie', '2023-08-12 14:13:11'),
(33, 'abc', 'xyz', 'admindawda@admin.com', '$2y$10$axKgrcDsWYbuukwDofTHx.Sptm4Jz/YZuCmf7fcEtKA.yvT7vcmVK', '2006-03-18', 'female', 'normie', '2023-08-12 14:13:54'),
(34, 'abc', 'xyz', 'adminsadasdwqdacc@admin.com', '$2y$10$rSVgYyJF5fVV2yhcN.mqF.5gcvXVljh4zG3zVBOleXx4zF7bpxbuK', '2006-03-18', 'male', 'normie', '2023-08-12 14:16:55'),
(35, 'abc', 'xyz', 'admindsadcsa@admin.com', '$2y$10$hhszDUMitImQ.34VKRBL6eiUwEd51xS5GbaIbWdsnMDN7zKgxX6sa', '2006-03-16', 'male', 'normie', '2023-08-12 14:17:44'),
(36, 'abc', 'xyz', 'adminasdasd@admin.com', '$2y$10$i25ofmbIWp21z6PXU3/L/.tLJ4xuKbIM10Qi5u1mwmFmiGENufBwS', '2008-03-16', 'male', 'normie', '2023-08-12 14:18:31'),
(37, 'abc', 'xyz', 'adminsdadasd@admin.com', '$2y$10$TVRW/SA6sXk7DjQ5DNAkBOlDf//rcYpLX7nKlLS3DUTu1//u8KPPu', '2005-03-17', 'male', 'normie', '2023-08-12 14:21:46'),
(38, 'abc', 'xyz', 'adminsqwsw@admin.com', '$2y$10$AUv/ioGcwc0D9oBAAruDDuXAU3BqP54uMCjs70ibNw3qjczz2Vw4K', '2006-04-16', 'male', 'normie', '2023-08-12 14:25:09'),
(39, 'abc', 'xyz', 'adminsqwasdsasw@admin.com', '$2y$10$uYVT0Wxg3asCTpvju/n.M..qYtX6md31PCanfp.lwUKSCr4wHIA.m', '2006-04-16', 'male', 'normie', '2023-08-12 14:25:29'),
(40, 'abc', 'xyz', 'adminsqwasdsadsasw@admin.com', '$2y$10$sJZYyueM4NDBoFzrulkVFOvypcB2k4flRFl94ofRuC3XmMdj0SIMm', '2006-04-16', 'male', 'normie', '2023-08-12 14:25:38'),
(41, 'abc', 'xyz', 'admiaD3qf12cqcn@admin.com', '$2y$10$fmNmAQzWlNIHmWZRCaGZBeasRtuTBbdHw4MSounSfO0jqUpDE5x9G', '2005-01-18', 'male', 'normie', '2023-08-12 14:28:33'),
(42, 'abc', 'xyz', 'admiaD3qf12csdaqcn@admin.com', '$2y$10$6lnj08iXBQQSs1d4VDcfPOTXsFG8xn9EeaqgSvY0/1XV3c.vu2VN.', '2005-01-18', 'male', 'normie', '2023-08-12 14:28:57'),
(43, 'abc', 'xyz', 'admiaD3qf12csdasdadaqcn@admin.com', '$2y$10$boB3w8ORD7HUBGmjltVNdudXRF1yMZYfg87tn0kQUoaxPqsmgfaHq', '2005-01-18', 'male', 'normie', '2023-08-12 14:29:02'),
(44, 'abc', 'xyz', 'admiaD3qf12adsdacsdasdadaqcn@admin.com', '$2y$10$b0lVGVKFiTH1e0Qw3Cm6zO5bcqLl1wpIfeX.nSQHHJoEX4hs2b/RG', '2005-01-18', 'male', 'normie', '2023-08-12 14:29:05'),
(45, 'abc', 'xyz', 'admiaD3qf12asdadadsdacsdasdadaqcn@admin.com', '$2y$10$PJHIKONC46UJp1xFRWyRMuaeztCEORMr5q.zUtpx6f/lJe30xdnhi', '2005-01-18', 'male', 'normie', '2023-08-12 14:29:09'),
(46, 'abc', 'xyz', 'adminasdqwd@admin.com', '$2y$10$gIdrtdomdJIk5fqFKFJRvOQjrcd5a3FF6T.k1/CShhIJHHk3oAtJG', '2006-02-16', 'male', 'normie', '2023-08-12 14:31:09'),
(47, 'abc', 'acsc', 'admincAwcac@admin.com', '$2y$10$TtqfTV6FTr/Px4TxjXS.r.NtnAkO8xExgts3hB6PQ5h3SAZA0DQxW', '2005-02-19', 'male', 'normie', '2023-08-12 14:34:18'),
(48, 'abc', 'acsc', 'admincAwcaascacc@admin.com', '$2y$10$sq4TljL9Ufy2q1o1nGkquuMVLWi23oOPXIvV4EJOfhGY.aVKYe.ZK', '2005-02-19', 'male', 'normie', '2023-08-12 14:34:31'),
(49, 'abc', 'acsc', 'admincAwcaasaddscacc@admin.com', '$2y$10$/PYvsrXQCqAazKsy2aQZFebkcVcT6KgTqwGRrA029rqf5mGw3a2ua', '2005-02-19', 'male', 'normie', '2023-08-12 14:39:31'),
(50, 'abc', 'acsc', 'admincAwcsadasdaasaddscacc@admin.com', '$2y$10$R6mfv2RhcM/NcY2dI5XbqOP5i0WgthJ7Jp5N7n7Yi5Oz126aqUZge', '2005-02-19', 'male', 'normie', '2023-08-12 14:39:37'),
(51, 'abc', 'xyz', 'adminsaS@admin.com', '$2y$10$GBcX3YnGiOWNojyNImLzWuvisWjWJZrZ5VeJL5WgR/asnhh089xV.', '2005-03-18', 'male', 'normie', '2023-08-12 14:41:37'),
(52, 'abc', 'xyz', 'adminsaSDASS@admin.com', '$2y$10$UdHbve3kbtDCS4rmJ4HTAeE3DNIJNyn1EH5cykDYdfK0F7h2tqSCm', '2005-03-18', 'male', 'normie', '2023-08-12 14:42:11'),
(53, 'abc', 'xyz', 'adminNGFYTJFHJ@admin.com', '$2y$10$dCL.pRsxMAh3Rdz2k12a.uMzGcwJOph5hxxYOyoZ6h8xYoJj7EYy2', '2005-03-17', 'male', 'normie', '2023-08-12 15:22:02'),
(54, 'abc', 'xyz', 'admin123453546Y5465@admin.com', '$2y$10$a4R1.qkEa68zOEqs3l2Qru8UREmOX0Ptn7le5tA8KbaM7EK1803s6', '2007-02-19', 'male', 'normie', '2023-08-12 15:22:54'),
(55, 'abc', 'xyz', 'adminsadcqwVAS@admin.com', '$2y$10$mDZpKsFODTGuJO/Y8BW7PO3jG6WxW7PDK8H9xlFjnmPEWIny28uM2', '2005-03-17', 'male', 'normie', '2023-08-12 15:27:34'),
(56, 'abc', 'xyz', 'adminsadcqwVSADDADAS@admin.com', '$2y$10$Y/42AHLTq777wot9202p8e4FENBc8JwNN3p/Bfly4IO3pCGeBHEeS', '2005-03-17', 'male', 'normie', '2023-08-12 15:27:44'),
(57, 'abc', 'xyz', 'adminsadSDADAcqwVSADDADAS@admin.com', '$2y$10$0YIiFT1EwC.Cl1K.KWYgBOcSetty2pq16S0fvEM1F2PpbnEKJDHOG', '2005-03-17', 'male', 'normie', '2023-08-12 15:27:48'),
(58, 'asdsa', 'dasdada', 'admidasdasdadacqwcn@admin.com', '$2y$10$Vj/qNnOE5CbuXrZpoJc01.oks3kcGGuvRV/5bh9jjDdDfkHQ7r8DK', '2005-02-16', 'male', 'normie', '2023-08-12 15:30:07'),
(59, 'abc', 'xyz', 'admindsasdcqewqda@admin.com', '$2y$10$6JQqoAjxIyAW4U321pFj6e8WzlckSVYooqEyULfO0zHM62VLs3Iai', '2006-02-18', 'male', 'normie', '2023-08-12 15:33:10'),
(60, 'abc', 'xyz', 'admindsasdczcxczqewqda@admin.com', '$2y$10$Vt4mbxXBAXGbyveNrjmmRur2acFPArz5kXrSRACoPM87rCAa0Y2yK', '2006-02-18', 'male', 'normie', '2023-08-12 15:33:21'),
(61, 'abc', 'xyz', 'admisadc12231edascxn@admin.com', '$2y$10$H8jgcJ8eXL9JjjV2NiuH5Opr/FxR/FTpzImcsSQOhd6DEk0qZO8xa', '2006-04-18', 'male', 'normie', '2023-08-12 15:34:30'),
(62, 'abc', 'xyz', 'adminzcxxz@admin.com', '$2y$10$fZ5xAuZCR7RA0NcMKm1q2uQKMKSKoQ9z4vQGYZW4kyHt.InkzCVIS', '2006-01-18', 'male', 'normie', '2023-08-12 15:37:16'),
(63, 'abc', 'xyz', 'adminxsadx@admin.com', '$2y$10$IgsIrneTW07AwySqr6sOY.up6PbugA5PqopL1GQuQg7ng/96J0dcS', '2006-03-18', 'male', 'normie', '2023-08-12 15:38:44'),
(64, 'abc', 'xyz', 'admin12331fasfa2112e2f@admin.com', '$2y$10$aC98N9s1XxjFDE9PjBLoHOG4Bc4THPmSmLd7FcfF56P.JDPzQvi2W', '2005-01-19', 'male', 'normie', '2023-08-12 15:42:03'),
(65, 'abc', 'xyz', 'admins21ED1Ca23Q2@admin.com', '$2y$10$z8ZQyavP3cSJuOpa8RbE/.YSbQi2.WVPjGucwWaFbwj4PhTnoIhg.', '2005-02-18', 'male', 'normie', '2023-08-12 15:45:23'),
(66, 'abc', 'xyz', 'admindsadqwfcqwdq@admin.com', '$2y$10$DxKIJducmrXfXr45YAeeT.9Skm7CzJGpKyStb4ArL1EOghasJYrEe', '2006-02-18', 'male', 'normie', '2023-08-15 16:19:23');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users_credentials`
--
ALTER TABLE `users_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
