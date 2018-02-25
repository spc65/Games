-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2018 at 09:20 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hangman`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `friend1` int(11) DEFAULT NULL,
  `friend2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `friend1`, `friend2`) VALUES
(4, 6, 5),
(5, 5, 6),
(6, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int(11) NOT NULL,
  `challenger_id` int(11) DEFAULT NULL,
  `acceptor_id` int(11) DEFAULT NULL,
  `word` varchar(64) DEFAULT NULL,
  `num_mistakes` int(11) DEFAULT NULL,
  `letters_used` varchar(26) DEFAULT NULL,
  `over` int(11) DEFAULT NULL,
  `won` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `challenger_id`, `acceptor_id`, `word`, `num_mistakes`, `letters_used`, `over`, `won`) VALUES
(20, 6, 5, 'question', 0, 'QUESTION', 1, 1),
(21, 5, 6, 'firefox', 1, 'ECFIROX', 1, 1),
(22, NULL, 6, 'thumbscrew', 6, 'ABCDEFGHIJ', 1, 0),
(23, NULL, 6, 'vaporize', 0, 'A', 0, 0),
(24, NULL, 6, 'jumbo', 2, 'ABC', 0, 0),
(25, 6, 5, 'thinkpad', 0, 'TH', 0, 0),
(26, NULL, 5, 'subway', 6, 'ABCDEFGH', 1, 0),
(27, NULL, 5, 'kitsch', 0, '', 0, 0),
(28, NULL, 5, 'quixotic', 0, 'Q', 0, 0),
(29, NULL, 5, 'thumbscrew', 0, '', 0, 0),
(30, 5, 5, 'newword', 0, '', 0, 0),
(31, NULL, 5, 'schnapps', 5, 'ESTOAMDPCHN', 1, 1),
(32, 5, 5, 'vagina', 1, 'TAVGIN', 1, 1),
(33, 5, 5, 'matcha', 6, 'EAVNIOU', 1, 0),
(34, 5, 5, 'mangina', 6, 'EAVTSMNDO', 1, 0),
(35, 5, 5, 'geyser', 6, 'AENMGSOTI', 1, 0),
(36, 5, 5, 'michaelscott', 1, 'AIOUETSCMHL', 1, 1),
(37, 5, 5, 'postmalone', 2, 'AEIOUTPSNML', 1, 1),
(38, 5, 5, 'otayotay', 3, 'EATISOY', 1, 1),
(39, 5, 5, 'lilbitch', 6, 'AEITOUPS', 1, 0),
(40, 5, 5, 'mrmax', 6, 'IAESTOL', 1, 0),
(41, 5, 5, 'peridotite', 1, 'AEITPROD', 1, 1),
(42, 5, 5, 'dwightschrute', 4, 'AEOIUTSLRPDWGHC', 1, 1),
(43, 5, 5, 'snapintoaslimjim', 4, 'AEIOUFTSDPLNMJ', 1, 1),
(44, 5, 5, 'yourmom', 6, 'EUIAORFST', 1, 0),
(45, 5, 5, 'cheframsay', 6, 'OAEIUTSNMP', 1, 0),
(46, 5, 5, 'mtkilimanjaro', 3, 'IAEOULMRSTKNJ', 1, 1),
(47, 5, 5, 'youranus', 3, 'OUYRTPMNAS', 1, 1),
(48, 5, 5, 'tities', 3, 'EAOIUTS', 1, 1),
(49, 5, 5, 'hangman', 6, 'AEIOUTB', 1, 0),
(50, 5, 5, 'ericandreshow', 3, 'AEOIUSLPRCNDHW', 1, 1),
(51, 5, 5, 'guccigang', 6, 'AEIOUSBVM', 1, 0),
(52, 5, 5, 'tjmiller', 4, 'AIEOUSTMLRJ', 1, 1),
(53, 5, 5, 'piedpiper', 5, 'OAEIDRBNQP', 1, 1),
(54, 5, 5, 'homeostasis', 1, 'AIOUETMHS', 1, 1),
(55, 5, 5, 'kiwi', 5, 'AEINMPKW', 1, 1),
(56, 5, 5, 'rickandmorty', 4, 'AIOEUTSNMRCKZYD', 1, 1),
(57, 5, 5, 'piedviper', 3, 'OICEDRPLV', 1, 1),
(58, 5, 5, 'hiedviper', 6, 'AIOSTEDRPVLN', 1, 0),
(59, 5, 5, 'jimmytatro', 2, 'EIAOMJRYPT', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `game_table`
--

CREATE TABLE `game_table` (
  `game_id` int(11) NOT NULL,
  `challenger_id` int(11) DEFAULT NULL,
  `acceptor_id` int(11) DEFAULT NULL,
  `word` varchar(64) DEFAULT NULL,
  `num_mistakes` int(11) DEFAULT NULL,
  `letters_used` varchar(26) DEFAULT NULL,
  `over` int(11) DEFAULT NULL,
  `won` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hash`) VALUES
(5, 'Steven', '$2y$10$BXHt0ECB3Pv6SFgx95p4qOPF9Nf/B/o/sa8U0LZ1tb7ODj4nRoqH2'),
(6, 'Thomas', '$2y$10$06z8EF5oxLiJNgCafkB.S.4SHLLq6pyKXb5SV.o3p0g0fVqHDX4u.'),
(7, 'megaknight', '$2y$10$SLkXML199DVIywdNOAEkDuY3kwGeCjfcgpEH0ZG74dSeuH5zg/aHO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `game_table`
--
ALTER TABLE `game_table`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
