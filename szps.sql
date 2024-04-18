-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Kwi 2024, 08:44
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `szps`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`event_id`, `name`, `description`, `date`, `time`) VALUES
(1, 'TEST ', 'fdsf sd fsd fsd sd fsd dsfsdf fsd', '2024-04-19', '08:20:00'),
(2, 'TEST2 ', 'tretretrertrtr', '2024-04-29', '15:05:00'),
(3, 'TEST3 ', 'bvcbcvb cvbc vb cc ', '2024-04-24', '13:20:00'),
(4, 'TEST4 ', 'jhgjh jgh gh g gfhf ghgfh fgh', '2024-04-26', '08:50:00'),
(5, 'TEST5', 'uytuyt uyt tuy tu yt uty ut ty  yt', '2024-04-23', '20:40:00'),
(6, 'green', 'WHAT is YOUR problem GREEEEN!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', '2024-04-16', '12:01:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user-event`
--

CREATE TABLE `user-event` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `user-event`
--

INSERT INTO `user-event` (`id`, `user_id`, `event_id`) VALUES
(1, 3, 1),
(2, 3, 5),
(3, 2, 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` varchar(32) NOT NULL,
  `permission` varchar(3) NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `permission`, `join_date`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'adm', '2024-03-25'),
(2, 'worker', 'b61822e8357dcaff77eaaccf348d9134', 'wrk', '2024-04-04'),
(3, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'usr', '2024-04-08');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indeksy dla tabeli `user-event`
--
ALTER TABLE `user-event`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `login` (`login`) USING HASH;

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `user-event`
--
ALTER TABLE `user-event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
