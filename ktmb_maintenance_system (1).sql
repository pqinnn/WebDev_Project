-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 01:58 PM
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
-- Database: `ktmb_maintenance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `priority` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `related_issue` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `reported_by` varchar(255) NOT NULL,
  `reported_date` datetime NOT NULL,
  `status` enum('Pending','In Progress','Resolved') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `title`, `description`, `priority`, `category`, `related_issue`, `file_path`, `reported_by`, `reported_date`, `status`) VALUES
(1, 'Broken Track', 'Track is damaged near station A', 'High', 'Mechanical', NULL, NULL, 'staff_user', '2025-01-01 10:00:00', 'Pending'),
(2, 'Electrical Failure', 'Power outage in control room', 'Medium', 'Electrical', NULL, NULL, 'staff_user', '2025-01-02 14:30:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `priority_level` enum('High','Medium','Low') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_name`, `priority_level`, `start_date`, `end_date`, `created_at`) VALUES
(4, 'Test New', 'High', '2025-01-07', '2025-01-08', '2025-01-05 08:34:36'),
(5, 'Test 2', 'Low', '2025-01-05', '2025-01-05', '2025-01-05 09:49:59'),
(6, 'Test 3', 'Medium', '2025-01-06', '2025-01-06', '2025-01-05 09:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idnumber` varchar(20) NOT NULL,
  `role` enum('admin','staff') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `idnumber`, `role`, `password`, `created_at`, `reset_token`, `reset_token_expiry`, `otp`) VALUES
(1, 'Admin KTMB', 'admin@ktmb.com', 'A123456', 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', '2025-01-04 06:58:24', NULL, NULL, NULL),
(2, 'Aqmar Hazim', 'aqmar@ktmb.com', 'S220234', 'staff', '10176e7b7b24d317acfcf8d2064cfd2f24e154f7b5a96603077d5ef813d6a6b6', '2025-01-04 06:58:50', NULL, NULL, NULL),
(21, 'aqmar', 'mar.hazem03@gmail.com', 'ai220234', 'admin', '$2y$10$IJTqXWLAjAsF59bw3b3m6eY7inQiRoJT0XaQE1eoBBiAC9O.JWFJK', '2025-01-05 10:18:57', NULL, NULL, NULL),
(23, 'OOI', 'chatgptuse0705@gmail.com', 'AI22026A', 'admin', '$2y$10$mPtGyxlHdUKpGQnsA2lKaOy.9081tvAQu3jEUAZW7qp8y.aujomGi', '2025-01-06 10:21:42', NULL, NULL, '932895'),
(25, 'TRY', 'pohqinn@gmail.com', 'AI220264', 'admin', '$2y$10$buYujvq0hdeXtaGIqDJKY.C0MwGytg3jVD8vTKQ6lABifGmZ6CDzm', '2025-01-06 12:11:18', NULL, NULL, '581340');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_issue` (`related_issue`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_ibfk_1` FOREIGN KEY (`related_issue`) REFERENCES `issues` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
