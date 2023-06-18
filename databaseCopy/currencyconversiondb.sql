-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Cze 2023, 16:29
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `currencyconversiondb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conversionlist`
--

CREATE TABLE `conversionlist` (
  `id` int(11) NOT NULL,
  `sourceCurrencyName` varchar(255) NOT NULL,
  `targetCurrencyName` varchar(255) NOT NULL,
  `sourceCurrencyValue` double NOT NULL,
  `targetCurrencyValue` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `conversionlist`
--

INSERT INTO `conversionlist` (`id`, `sourceCurrencyName`, `targetCurrencyName`, `sourceCurrencyValue`, `targetCurrencyValue`) VALUES
(1, 'pln Polski złoty', 'euro', 10, 2.24),
(2, 'dolar amerykański', 'dolar kanadyjski', 77, 101.8),
(3, 'forint (Węgry)', 'ringgit (Malezja)', 45, 0.61);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `currencylist`
--

CREATE TABLE `currencylist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `currencylist`
--

INSERT INTO `currencylist` (`id`, `name`, `value`) VALUES
(200, 'bat (Tajlandia)', 0.1176),
(201, 'dolar amerykański', 4.0715),
(202, 'dolar australijski', 2.8027),
(203, 'dolar Hongkongu', 0.5202),
(204, 'dolar kanadyjski', 3.0795),
(205, 'dolar nowozelandzki', 2.5397),
(206, 'dolar singapurski', 3.0455),
(207, 'euro', 4.4583),
(208, 'forint (Węgry)', 0.011914),
(209, 'frank szwajcarski', 4.57),
(210, 'funt szterling', 5.2095),
(211, 'hrywna (Ukraina)', 0.1102),
(212, 'jen (Japonia)', 0.028866),
(213, 'korona czeska', 0.1872),
(214, 'korona duńska', 0.5983),
(215, 'korona islandzka', 0.029861),
(216, 'korona norweska', 0.3879),
(217, 'korona szwedzka', 0.3836),
(218, 'lej rumuński', 0.8987),
(219, 'lew (Bułgaria)', 2.2795),
(220, 'lira turecka', 0.1721),
(221, 'nowy izraelski szekel', 1.1439),
(222, 'peso chilijskie', 0.005131),
(223, 'peso filipińskie', 0.0729),
(224, 'peso meksykańskie', 0.2375),
(225, 'rand (Republika Południowej Afryki)', 0.2242),
(226, 'real (Brazylia)', 0.8463),
(227, 'ringgit (Malezja)', 0.8823),
(228, 'rupia indonezyjska', 0.00027262),
(229, 'rupia indyjska', 0.049711),
(230, 'won południowokoreański', 0.003197),
(231, 'yuan renminbi (Chiny)', 0.5723),
(232, 'SDR (MFW)', 5.4997);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `conversionlist`
--
ALTER TABLE `conversionlist`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `currencylist`
--
ALTER TABLE `currencylist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `conversionlist`
--
ALTER TABLE `conversionlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `currencylist`
--
ALTER TABLE `currencylist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
