-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2021 at 09:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bringmit`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `datum` date DEFAULT NULL,
  `uhrzeit` time DEFAULT NULL,
  `ort` text NOT NULL,
  `ideen` text NOT NULL,
  `beschreibung` text NOT NULL,
  `optionen_veg` tinyint(1) NOT NULL DEFAULT 0,
  `optionen_geschmack` tinyint(1) NOT NULL DEFAULT 0,
  `email` text NOT NULL,
  `zeit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `name`, `datum`, `uhrzeit`, `ort`, `ideen`, `beschreibung`, `optionen_veg`, `optionen_geschmack`, `email`, `zeit`) VALUES
(1, 'Familyessen', '2021-10-21', '10:38:23', 'Stuttgart, Schlossplatz', 'Salzstangen;Milchmäuse,Apfelschorle,Eis', 'Wir freuen uns, wenn ihr dabei seid - und ihr werdet bestimmt was cooles mitbringen', 1, 1, 'a@a.a', '2021-12-12 11:30:00'),
(2, 'Weihnachten im Schuhkarton', NULL, NULL, 'EFG Pforzheim', 'Zahnpasta, Duschgel, Stiffte', 'Wir packen Kartons für Kinder in Rumänien', 0, 0, 'b@b.b', '0021-10-29 19:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `mitbringsel`
--

CREATE TABLE `mitbringsel` (
  `id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `wer` text DEFAULT NULL,
  `was` text DEFAULT NULL,
  `wieviel` text DEFAULT NULL,
  `option_veg` int(11) NOT NULL DEFAULT 0,
  `option_geschmack` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mitbringsel`
--

INSERT INTO `mitbringsel` (`id`, `eventid`, `wer`, `was`, `wieviel`, `option_veg`, `option_geschmack`) VALUES
(2, 1, 'Beni', 'Gemüseauflauf', '', 1, 2),
(3, 1, 'Linda', 'Schokobonbons', '1 Tüte', 0, 1),
(7, 1, 'Lukas', 'Nutella', '1 Glas', 0, 1),
(15, 1, 'Rebecca', 'Milchmäuse', '2 Tüten', 0, 1),
(16, 1, 'Finn', 'Croissants', '', 1, 2),
(18, 1, 'Lukas', 'Schinkenweckle', '1 Blech', 0, 2),
(19, 1, 'Joscha', 'Gummibärchen', '3', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mitbringsel`
--
ALTER TABLE `mitbringsel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `mitbringsel`
--
ALTER TABLE `mitbringsel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
