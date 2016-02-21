-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Vært: mysql06.cliche.dk
-- Genereringstid: 21. 02 2016 kl. 21:17:46
-- Serverversion: 5.5.41
-- PHP-version: 5.5.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aogj_com`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `treasures`
--

CREATE TABLE `treasures` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `hint` varchar(2000) DEFAULT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accuracy` int(11) NOT NULL,
  `imageUrl` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `treasures`
--

INSERT INTO `treasures` (`id`, `name`, `hint`, `lat`, `lon`, `timestamp`, `accuracy`, `imageUrl`) VALUES
(47, 'tester123', 'use youre imagination 2', 57.0707726, 10.1113093, '2016-02-21 20:00:59', 25, '56ca174b2d4d6'),
(46, 'Mobil igen', 'use youre imagination', 57.07065604632447, 10.111230611810564, '2015-12-30 08:40:15', 5, '5683985a4f5a8'),
(45, 'test', 'use youre imagination', 57.070744, 10.111334, '2015-12-30 08:39:12', 25, '56839825a5b6c'),
(44, 'Mobi', 'use youre imagination', 57.07061438826571, 10.111287692571162, '2015-12-30 08:30:18', 5, NULL);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `treasures`
--
ALTER TABLE `treasures`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `treasures`
--
ALTER TABLE `treasures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
