-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 06:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `description` text NOT NULL,
  `section` varchar(12) NOT NULL,
  `type` varchar(12) NOT NULL,
  `image` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `name`, `description`, `section`, `type`, `image`) VALUES
(9, 'Shawshank', 'Best Movie ', 'movie', 'derama', 'uploads/Shawshank51285823464990453Castaway81510053068755730images1.jpg'),
(10, 'Friends', 'Best Serice', 'serice', 'comdey', 'uploads/Friends94922722300135945Friends30395760468761317images (1).jpg'),
(12, 'Vikings', 'Good serice', 'serice', 'action', 'uploads/Vikings50569098628039188WmFwZndlY3Zjdn.jpg'),
(13, 'Mad Max', 'good movie', 'movie', 'action', 'uploads/Mad Max81155410995605235WmFwZndlY3Zjdn.jpg'),
(14, 'Baaghi', 'good movie', 'movie', 'action', 'uploads/Baaghi8507891774242865images.jpg'),
(15, 'Mechanic', 'good movie', 'movie', 'action', 'uploads/Mechanic13416592278468169Cqy8QGbWcAAXPSr.jpg'),
(16, 'San Andreas', 'good movie', 'movie', 'action', 'uploads/San Andreas24559374206235639DHnejw7XkAAHpcw.jpg'),
(17, 'IP Man', 'good movie', 'movie', 'action', 'uploads/IP Man58989819546514076images (23).jpeg'),
(18, 'Extraction', 'good movie', 'movie', 'action', 'uploads/Extraction94737660328910643images.jpg'),
(19, 'Dead Lands', 'Best Serice', 'serice', 'action', 'uploads/Dead Lands22772089989320611Dead-Lands.jpg'),
(20, 'Kinghtfall', 'Good serice', 'serice', 'action', 'uploads/Kinghtfall75925964458404698images (1).jpg'),
(21, 'Last KingDom', 'Good serice', 'movie', 'action', 'uploads/Last KingDom74202952352522761images.jpg'),
(22, 'The Witcher', 'Good serice', 'movie', 'horror', 'uploads/The Witcher49898310629263459The-Witcher-s01.jpg'),
(23, 'Warcraft', 'Good serice', 'serice', 'action', 'uploads/Warcraft80197357965840467Warcraft_2016.jpg'),
(24, 'Hobbit', 'Good serice', 'serice', 'derama', 'uploads/Hobbit44526349792981579Hobbit_BOTFA_Intl_poster.jpg'),
(25, 'Zombies', 'Good serice', 'serice', 'horror', 'uploads/Zombies47823139549535904unnamed.jpg'),
(26, 'Harry Potter', 'Good serice', 'movie', 'horror', 'uploads/Harry Potter990100580684693594jcFc2Ni0i.jpg'),
(27, 'Chernobyl', 'Good serice', 'serice', 'derama', 'uploads/Chernobyl75074613685267623series.chernobyl.online.season.1.jpg'),
(28, 'The Originals', 'Good serice', 'serice', 'horror', 'uploads/The Originals22221550570256645LWo86ms.jpg'),
(29, 'Arrow', 'Good serice', 'serice', 'action', 'uploads/Arrow50472307046707550images.jpg'),
(30, 'Game Of Thrones', 'Good serice', 'serice', 'derama', 'uploads/Game Of Thrones28358801329941371images (1).jpg'),
(31, '30 minutes or l', 'Good serice', 'serice', 'comdey', 'uploads/30 minutes or less705680890776790230-minutes-or-less-movie-poster.jpg'),
(32, 'Game Night', 'A group of friends who meet regularly for game nights', 'movie', 'comdey', 'uploads/Game Night82470439305129739Best-Comedy-Movies-of-2018-1.jpg'),
(33, 'Termenator', 'good movie', 'movie', 'action', 'uploads/Termenator9797770700747020ed3c56e7e98916ed7eaba3c206beb632.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `f_name` varchar(11) NOT NULL,
  `l_name` varchar(11) NOT NULL,
  `user_name` varchar(12) NOT NULL,
  `password` text NOT NULL,
  `admin_s` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `f_name`, `l_name`, `user_name`, `password`, `admin_s`) VALUES
(1, 'mohamed', 'shehta', 'mohamed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
