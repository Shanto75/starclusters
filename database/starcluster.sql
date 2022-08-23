-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2022 at 09:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starcluster`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '123'),
(9, 'admin2', 'admin2@admin.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `details`, `date`) VALUES
(1, 'Concrete', 'Concrete mix is a common building material that includes crushed stone, gravel, and sand, typically bound together with Portland cement.', '2022-07-05 18:36:34'),
(2, 'Ceramics', 'Made from a mixture of minerals and fired at extremely high temperatures, ceramics are durable, fire resistant, and water resistant building materials.', '2022-07-16 10:59:07'),
(3, 'Stone', 'A durable, heavy natural building material with a high compressive strength, stone is typically prepared by a stonemason when used as the primary building material for a structure. ', '2022-07-02 16:58:16'),
(4, 'Good quality bricks', 'Good quality bricks should be well burnt, as well as having a uniform color.', '2022-07-16 10:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `cover`
--

CREATE TABLE `cover` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cover`
--

INSERT INTO `cover` (`id`, `title`, `details`) VALUES
(1, 'Best Quality Concrete', 'Concrete mix is a common building material that includes crushed stone, gravel, and sand, typically bound together with Portland cement.'),
(2, 'Best Quality Ceramics', 'Made from a mixture of minerals and fired at extremely high temperatures, ceramics are durable, fire-resistant, and water-resistant building materials.'),
(3, 'Best Quality Steel', 'Steel is a metal alloy made mostly of iron with a small percentage of carbon. Its high strength-to-weight ratio makes structural steel an ideal choice for the framework of skyscrapers and other large structures like stadiums and bridges.'),
(6, 'Best Quality Stone', 'A durable, heavy natural building material with a high compressive strength, stone is typically prepared by a stonemason when used as the primary building material for a structure.');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `ans` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `ans`) VALUES
(2, 'Who can get a medical marijuana card?', 'Individuals with a qualifying medical condition and a recommendation for medical marijuana from an attending physician may apply for a medical marijuana card.'),
(7, 'DIABETES AND HYPERTENSION: WHAT IS THE RELATIONSHIP?', 'Over time, diabetes damages the small blood vessels in your body, causing the walls of the blood vessels to stiffen. This increases pressure, which leads to high blood pressure.” The combination of high blood pressure and type 2 diabetes can greatly increase your risk of having a heart attack or stroke.');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `email` varchar(25) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `about` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`email`, `phone`, `about`, `address`) VALUES
('info@starsluster.com', '017123123123', 'Interior design is the art and science of enhancing the interior of a building to achieve a healthier and more aesthetically pleasing environment for the people using the space. An interior designer is someone who plans, researches, coordinates, and manages such enhancement projects.', 'Uttara, Dhaka-1230');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `phone`, `message`) VALUES
(44, 'shanto', 'shanto@gmail.com', '0123456789', 'i need good quality cement'),
(45, 'pranto', 'pranto@gmail.com', '0123456789', 'i need good quality stone'),
(46, 'shanto', 'shanto@gmail.com', '01612622555', 'qwe');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `time`) VALUES
(1, 'Uttara housing', 'We have provided great materials for the uttara housing project.', 'june 2019 - july 2022'),
(2, 'Gulshan housing', 'We have provided great materials for the Gulshan housing project.', 'May 2020 - march 2022'),
(3, 'Nikunja Housing', 'We have provided great materials for the Nikunja housing project.', 'july 2018 - may 2021');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `title`, `description`) VALUES
(1, 'Best Concrete', 'Concrete mix is a common building material that includes crushed stone, gravel, and sand, typically bound together with Portland cement.'),
(2, 'Best Ceramics', 'Made from a mixture of minerals and fired at extremely high temperatures, ceramics are durable, fire-resistant, and water-resistant building materials.'),
(5, 'Best Quality Steel', 'Steel is a metal alloy made mostly of iron with a small percentage of carbon. Its high strength-to-weight ratio makes structural steel an ideal choice for the framework of skyscrapers and other large structures like stadiums and bridges.'),
(6, 'Best Quality Stone', 'A durable, heavy natural building material with a high compressive strength, stone is typically prepared by a stonemason when used as the primary building material for a structure. ');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `title`, `email`, `address`, `phone`, `about`) VALUES
(1, 'moniruzzaman', 'Concrete Specialist', 'moniruzzaman@gmail.com', 'dhaka,bangladesh', '1756487912', 'Moniruzzaman is a Concrete Specialist'),
(2, 'Shah Zaman', 'Ceramics Specialist', 'zaman@gmail.com', 'uttara, dhaka, bangladesh', '1756487912', 'Shah Zaman is a Ceramics Specialist'),
(3, 'Rafid pranto', 'Stone Specialist', 'pranto@gmail.com', 'Dhaka bangladesh', '01612622555', 'Rafid pranto is a Stone Specialist'),
(4, 'shanto', 'bricks Specialist', 'shanto@gmail.com', 'Nikunjo-2', '01612622555', 'shanto is a bricks Specialist'),
(8, 'Rakib', 'Ceramics Specialist', 'rakib@gmail.com', 'Nikunjo-2', '01612622555', 'rakib is a Ceramics Specialist'),
(9, 'Sabuj', 'Stone Specialist', 'Sabuj@gmail.com', 'dhaka', '0123456789', 'Sabuj is a Stone Specialist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cover`
--
ALTER TABLE `cover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cover`
--
ALTER TABLE `cover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
