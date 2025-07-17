-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 10:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_with_token`
--

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(1000) NOT NULL,
  `expires_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `user_id`, `token`, `expires_at`) VALUES
(1, 7, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3NTI2ODY5MDksImV4cCI6MTc1Mjc3MzMwOSwic3ViIjo3fQ.SiCuoXcHvia1m-ptgztjY-NvA_o7HtbkzKwCRiK7isg', '2025-07-17'),
(2, 8, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3NTI2ODY5MjcsImV4cCI6MTc1Mjc3MzMyNywic3ViIjo4fQ.XfyEnWhftCtXnoHnlEN64UgH-YdgRATP68s75Gj2RD4', '2025-07-17'),
(3, 9, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3NTI2ODY5NDcsImV4cCI6MTc1Mjc3MzM0Nywic3ViIjo5fQ.mEXiBRqCrseGdsK5jGNjO9NJB_McbSTib-JaMTklD9A', '2025-07-17'),
(4, 13, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3NTI2ODczOTAsImV4cCI6MTc1Mjc3Mzc5MCwic3ViIjoxM30.SG7qivIPTIUT0tTtSdcJ6Ib0kM-i9uIN17GkmKDoj9E', '2025-07-17'),
(5, 14, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3NTI2ODc0MDAsImV4cCI6MTc1Mjc3MzgwMCwic3ViIjoxNH0.Cib6q1EucefYgJzR6sHAdNPOl6vTc_an3IsTLzvw6YY', '2025-07-17'),
(6, 15, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3NTI2ODc0MTgsImV4cCI6MTc1Mjc3MzgxOCwic3ViIjoxNX0.z6Q7A2x7QJExQgh86NaFfcgcJ8ct6pB7vRPoN_IbJwg', '2025-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `modified_by` varchar(255) NOT NULL,
  `modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'User 1', 'user1@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(2, 'User 1', 'user1@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(3, 'User 3', 'user3@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(4, 'User 2', 'user2@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(5, 'User 5', 'user5@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(6, 'User 7', 'user7@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(7, 'User 10', 'user10@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(8, 'User 10', 'user10@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(9, 'User 11', 'user11@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(10, 'User 12', 'user12@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(11, 'User 12', 'user12@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(12, 'User 12', 'user12@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(13, 'User 12', 'user12@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(14, 'User 13', 'user13@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00'),
(15, 'User 13', 'user13@gmail.com', '25d55ad283aa400af464c76d713c07ad', '58293', '2025-07-16', '', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
