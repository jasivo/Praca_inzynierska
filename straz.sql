-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Sty 2023, 04:56
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `straz`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprzet`
--

CREATE TABLE `sprzet` (
  `id` int(11) NOT NULL,
  `rodzaj` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `producent` text CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `model` text CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `nr_seryjny` text CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `koniec_przegladu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `sprzet`
--

INSERT INTO `sprzet` (`id`, `rodzaj`, `producent`, `model`, `nr_seryjny`, `koniec_przegladu`) VALUES
(1, 'Nożyce hydrauliczne', 'LUKAS', 'S 700 E', 'LUK2020S700EAV13786', '2024-05-06'),
(2, 'Detektor wielogazowy', 'MSA', 'Altair 4XR', 'MSAA4XR2019ASTW0783', '2023-01-29'),
(4, 'Aparat ochrony dróg oddechowych', 'Fenzy', 'Aeris', 'ARS2007M672185', '2026-07-24'),
(5, 'Piła spalinowa', 'Stihl', 'MS 271', 'MS271STH2013M00827', '2023-03-09');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `strazacy`
--

CREATE TABLE `strazacy` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `koniec_badan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `strazacy`
--

INSERT INTO `strazacy` (`id`, `imie`, `nazwisko`, `koniec_badan`) VALUES
(1, 'Marcin', 'Kowalski', '2026-03-30'),
(2, 'Janusz', 'Nowak', '2026-03-30'),
(3, 'Marcin', 'Włodarczyk', '2026-03-30'),
(4, 'Michał', 'Nowacki', '2026-03-30'),
(6, 'Mariusz', 'Sienkiewicz', '2023-02-25'),
(10, 'Tomasz', 'Baran', '2025-06-05');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyjazdy`
--

CREATE TABLE `wyjazdy` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `godz_wyjazdu` time NOT NULL,
  `godz_powrotu` time NOT NULL,
  `miejsce` text NOT NULL,
  `rodzaj` text NOT NULL,
  `strazak1` text NOT NULL,
  `strazak2` text NOT NULL,
  `strazak3` text NOT NULL,
  `strazak4` text NOT NULL,
  `strazak5` text NOT NULL,
  `strazak6` text NOT NULL,
  `auto` text NOT NULL,
  `dysponent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wyjazdy`
--

INSERT INTO `wyjazdy` (`id`, `data`, `godz_wyjazdu`, `godz_powrotu`, `miejsce`, `rodzaj`, `strazak1`, `strazak2`, `strazak3`, `strazak4`, `strazak5`, `strazak6`, `auto`, `dysponent`) VALUES
(1, '2020-11-09', '14:31:00', '17:38:00', 'Wrocław', 'pożar budynku', 'Mariusz Sienkiewicz', 'Marcin Włodarczyk', '', '', '', '', 'Ford', 'PSP'),
(2, '2022-11-21', '10:01:00', '13:55:00', 'Poznań', 'Udzielenie KPP', 'Marcin Kowalski', 'Michał Nowacki', 'Janusz Nowak', 'Marcin Włodarczyk', '', '', 'Star M69', 'PSP'),
(3, '2022-11-21', '10:08:00', '11:45:00', 'Warszawa', 'Udzielenie KPP', 'Janusz Nowak', 'Michał Nowacki', 'Marcin Kowalski', '', '', '', 'Ford', ''),
(4, '2022-11-22', '10:00:00', '09:05:00', 'Kraków', 'Wypadek komunikacyjny', 'Michał Nowacki', 'Marcin Kowalski', 'Janusz Nowak', '', '', '', 'Star M69', 'PSP'),
(5, '2022-11-22', '14:33:00', '15:33:00', 'Wrocław', 'Pożar budynku', 'Jan Kowalski', 'Jan Nowak', '', '', '', '', 'Ford', ''),
(6, '2022-12-11', '07:12:00', '12:54:00', 'Warszawa', 'Pożar budynku', 'Jan Kowalski', 'Michał Kowalski', '', '', '', '', 'Iveco', ''),
(7, '2022-12-12', '13:14:00', '15:00:00', 'Wrocław', 'Wypadek samochodowy', 'Jan Kowalski', 'Piotr Kowalski', '', '', '', '', 'Ford', ''),
(8, '2023-01-12', '09:22:00', '11:03:00', 'Poznań', 'Pożar budynku', 'Marcin Kowalski', 'Mariusz Sienkiewicz', 'Michał Nowacki', '', '', '', 'Ford', 'PSP'),
(9, '2023-01-13', '02:55:00', '05:58:00', 'Bydgoszcz', 'Miejscowe zagrożenie', 'Tomasz Baran', 'Marcin Kowalski', 'Michał Nowacki', 'Janusz Nowak', 'Mariusz Sienkiewicz', 'Marcin Włodarczyk', 'Star M69', 'PSP');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `sprzet`
--
ALTER TABLE `sprzet`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `strazacy`
--
ALTER TABLE `strazacy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wyjazdy`
--
ALTER TABLE `wyjazdy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `sprzet`
--
ALTER TABLE `sprzet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `strazacy`
--
ALTER TABLE `strazacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `wyjazdy`
--
ALTER TABLE `wyjazdy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
