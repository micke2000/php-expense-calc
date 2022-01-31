-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Sty 2022, 12:55
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logged_in_users`
--

CREATE TABLE `logged_in_users` (
  `sessionId` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `logged_in_users`
--

INSERT INTO `logged_in_users` (`sessionId`, `userId`, `lastUpdate`) VALUES
('1gn9n0ti4fahacu21k7senabio', 11, '2022-01-07 14:05:42'),
('7l8p3glrl8tsjqr02nrlllm2t9', 10, '2022-01-03 17:47:34'),
('9l0rv407thseb536o6cjrjjgpd', 9, '2022-01-08 16:31:51'),
('ee70e540ubafvo2mo6n11lsqlf', 9, '2022-01-06 10:51:53'),
('hu4e70tvv8ktupc8u7e7ff0ui0', 9, '2022-01-07 12:18:18'),
('khp6fhpgp34vvqr1tcg89pi206', 9, '2022-01-05 13:04:44'),
('oge9ng401qvnohpnk24q47i2oa', 9, '2022-01-06 11:20:08'),
('rrff8qqr3qars8rjt7se2j59rh', 9, '2022-01-06 11:21:34'),
('tarq3mn3binu4gmhqc1f4jnl90', 9, '2022-01-06 13:50:39'),
('um7d6v9p4angsq6rsh4qedrbln', 9, '2022-01-07 12:27:55');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  ADD PRIMARY KEY (`sessionId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
