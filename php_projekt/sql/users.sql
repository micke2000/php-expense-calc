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
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `date`) VALUES
(4, 'test1', '$2y$10$10ZaqjMybclTppYBCF49ouKmqMXwzgBGm', 'mo34df@gmail.com', '2021-12-29'),
(5, 'test2', '$2y$10$u/225LUAFiyy2IohBihp8.8JdsyzEz3i9', 'mo34df@gmail.com', '2021-12-29'),
(6, 'test3', '$2y$10$QhjQHKwON4VogjN4AGdsDORI2imTszyfb', 'mo34df@gmail.com', '2021-12-29'),
(7, 'test4', '$2y$10$G99FSXXJ4OAGcJvkKMFCyOGPan0XReTNm', 'mo34df@gmail.com', '2021-12-29'),
(8, 'tt', '$2y$10$k4srndufDL9vB/LYMYlDQuVZqIlnKxLQh', 'mo34df@gmail.com', '2022-01-01'),
(9, 'tt2', '$2y$10$WJsBVYqwqaFie53eQFswLenrHCIhBFL2KKJq6aA4TI7pbfgaCC3Jy', 'mo34df@gmail.com', '2022-01-01'),
(10, 'tt3', '$2y$10$noRNkviEqkLQSij1CQT0OeRZumAy70OWQDEc5KCj1vgh5bOL/NnJC', 'morwin.org@gmail.com', '2022-01-03'),
(11, 'nowyUser', '$2y$10$i1vcNP6hybGw//CLt9seRO9v9G99tDrf6bwS4wDxJ1xBVcYXLb.kq', 'morwin.org@gmail.com', '2022-01-07');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
