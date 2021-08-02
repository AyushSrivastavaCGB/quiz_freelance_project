-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2021 at 08:32 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE `Questions` (
  `id` int NOT NULL,
  `que` text NOT NULL,
  `ans` tinytext NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Questions`
--

INSERT INTO `Questions` (`id`, `que`, `ans`, `name`) VALUES
(9, 'Who is the prime minister of India <input type=\"text\" class=\"fill_in_holder\" id=\"answer\"> ?', 'Narendra Modi', 'exercise1'),
(10, '<input type=\"text\" class=\"fill_in_holder\" id=\"answer\"> is founder of C2M.', 'Ayush Srivastava', 'exercise1'),
(11, 'Founder of facebook is <input type=\"text\" class=\"fill_in_holder\" id=\"answer\">', 'Mark Zuckerberg', 'exercise2'),
(12, 'Founder of Tesla and paypal is <input type=\"text\" class=\"fill_in_holder\" id=\"answer\">', 'Elon Musk', 'exercise2'),
(13, '<input type=\"text\" class=\"fill_in_holder\" id=\"answer\"> is the CEO of Google.', 'Sunder Pichai', 'exercise2'),
(14, 'my name is <input type=\"text\" class=\"fill_in_holder\" id=\"answer\"> ?', 'ayush', 'exercise1'),
(15, 'demo question <input type=\"text\" class=\"fill_in_holder\" id=\"answer\">', 'ans', 'exercise2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
