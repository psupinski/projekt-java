-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Lut 2022, 00:11
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `zoo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `godziny`
--

CREATE TABLE `godziny` (
  `id` int(11) NOT NULL,
  `godziny` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `godziny`
--

INSERT INTO `godziny` (`id`, `godziny`) VALUES
(1, '10:00-12:00'),
(2, '12:30-14:30'),
(3, '15:00-17:00'),
(4, '17:30-19:30');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pakiety`
--

CREATE TABLE `pakiety` (
  `id` int(6) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `opis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pakiety`
--

INSERT INTO `pakiety` (`id`, `nazwa`, `opis`) VALUES
(1, 'Zwierzęta Sawanny', 'Możliwość oglądania zwierząt sawanny takich jak zebry, lwy, gepardy, słonie i wiele innych'),
(2, 'Zwierzęta Arktyki', 'Zobacz zwierzęta żyjące w mroźnym klimacie, takie jak niedźwiedź polarny, pingwin, mors i wiele innych.'),
(3, 'Cały ogród zoologiczny', 'Możliwość obejrzenia całego ogrodu zoologicznego i wszystkich dostępnych zwierząt.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `psw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) NOT NULL,
  `stanowisko` varchar(255) DEFAULT NULL,
  `imie` varchar(255) DEFAULT NULL,
  `nazwisko` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `psw`, `email`, `stanowisko`, `imie`, `nazwisko`) VALUES
(1, 'kierownik', 'kieras', 'kierownik@zoo.pl', 'Kierownik', 'Jan', 'Kowalski'),
(2, 'admin', 'qwerty', 'admin@zoo.pl', 'Admin', 'Patryk', 'Supiński'),
(3, 'robkucz', 'qwerty', 'robkucz@zoo.pl', 'Przewodnik', 'Rob', 'Kucz'),
(4, 'wet', 'qwerty', 'weterynarz@zoo.pl', 'Weterynarz', 'Pan', 'Weterynarz'),
(5, 'karmiciel', 'qwerty', 'karmiciel@zoo.pl', 'Karmiciel', 'Marek', 'Mostowiak'),
(6, 'akot', 'akot', 'kot@zoo.pl', 'Przewodnik', 'Anna', 'Kot');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wycieczki`
--

CREATE TABLE `wycieczki` (
  `id` int(11) NOT NULL,
  `id_pakietu` int(6) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `dzien` date NOT NULL,
  `godzina` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wycieczki`
--

INSERT INTO `wycieczki` (`id`, `id_pakietu`, `ilosc`, `dzien`, `godzina`) VALUES
(49, 1, 15, '2022-02-03', '10:00-12:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `id` int(11) NOT NULL,
  `id_prac` int(11) NOT NULL,
  `zadanie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zadania`
--

INSERT INTO `zadania` (`id`, `id_prac`, `zadanie`) VALUES
(14, 5, 'nakarmic zwierzeta'),
(15, 2, 'dodaj pracownika\r\nPaweł Kora Weterynarz');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `godziny`
--
ALTER TABLE `godziny`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pakiety`
--
ALTER TABLE `pakiety`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wycieczki`
--
ALTER TABLE `wycieczki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pakietu` (`id_pakietu`);

--
-- Indeksy dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prac` (`id_prac`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `godziny`
--
ALTER TABLE `godziny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `pakiety`
--
ALTER TABLE `pakiety`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `wycieczki`
--
ALTER TABLE `wycieczki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT dla tabeli `zadania`
--
ALTER TABLE `zadania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `wycieczki`
--
ALTER TABLE `wycieczki`
  ADD CONSTRAINT `wycieczki_ibfk_1` FOREIGN KEY (`id_pakietu`) REFERENCES `pakiety` (`id`);

--
-- Ograniczenia dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD CONSTRAINT `zadania_ibfk_1` FOREIGN KEY (`id_prac`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
