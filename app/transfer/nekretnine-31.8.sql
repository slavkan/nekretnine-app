-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 03:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nekretnine`
--

-- --------------------------------------------------------

--
-- Table structure for table `nekretnina`
--

CREATE TABLE `nekretnina` (
  `id` int(11) NOT NULL,
  `naziv` varchar(150) NOT NULL,
  `lokacija_zupanija` varchar(100) NOT NULL,
  `lokacija_grad` varchar(100) NOT NULL,
  `adresa` varchar(100) DEFAULT NULL,
  `spat` int(11) DEFAULT NULL,
  `broj_soba` varchar(50) NOT NULL,
  `broj_kvadrata` int(11) NOT NULL,
  `stanje` varchar(50) NOT NULL,
  `opis` varchar(1000) DEFAULT NULL,
  `slika_url1` text DEFAULT NULL,
  `slika_url2` text DEFAULT NULL,
  `slika_url3` text DEFAULT NULL,
  `slika_url4` text DEFAULT NULL,
  `slika_url5` text DEFAULT NULL,
  `slika_url6` text DEFAULT NULL,
  `slika_url7` text DEFAULT NULL,
  `slika_url8` text DEFAULT NULL,
  `slika_url9` text DEFAULT NULL,
  `slika_url10` text DEFAULT NULL,
  `prodano` varchar(10) DEFAULT NULL,
  `vlasnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obilazak`
--

CREATE TABLE `obilazak` (
  `id` int(11) NOT NULL,
  `nekretnina_id` int(11) NOT NULL,
  `vlasnik_id` int(11) NOT NULL,
  `kupac_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  `stanje_vlasnik` varchar(30) DEFAULT NULL,
  `stanje_kupac` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poruka_za_kupovinu`
--

CREATE TABLE `poruka_za_kupovinu` (
  `id` int(11) NOT NULL,
  `razgovor_id` int(11) NOT NULL,
  `posiljatelj_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  `poruka` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `razgovor_za_kupovinu`
--

CREATE TABLE `razgovor_za_kupovinu` (
  `id` int(11) NOT NULL,
  `nekretnina_id` int(11) NOT NULL,
  `vlasnik_id` int(11) NOT NULL,
  `kupac_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(70) NOT NULL,
  `pass` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `puno_ime` varchar(70) NOT NULL,
  `zupanija` varchar(100) NOT NULL,
  `grad` varchar(70) NOT NULL,
  `telefon` varchar(50) DEFAULT NULL,
  `isAdmin` int(11) DEFAULT NULL,
  `isAgency` int(11) DEFAULT NULL,
  `isUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `korisnicko_ime`, `pass`, `email`, `puno_ime`, `zupanija`, `grad`, `telefon`, `isAdmin`, `isAgency`, `isUser`) VALUES
(1, 'agencijaRamljak', '202cb962ac59075b964b07152d234b70', 'ramljak1004@gmail.com', 'Agencija Ramljak', 'Hercegbosanska županija', 'Drvar', '063-961-329', 1, 1, 0),
(2, 'agencijaBakula', '202cb962ac59075b964b07152d234b70', 'jbakula@gmail.com', 'Agencija Bakula \"Posušje\"', 'Zapadnohercegovačka županija', 'Posušje', NULL, 0, 1, 1),
(5, 'agencijaTomas', '202cb962ac59075b964b07152d234b70', 'tomas@gmail.com', 'Agencija Tomas', 'Zapadnohercegovačka županija', 'Grude', '063-444-555', 0, 0, 1),
(6, 'agencijaVTZ', '202cb962ac59075b964b07152d234b70', 'vinkotino@gmail.com', 'Agencija \"VTZ\"', 'Zapadnohercegovačka županija', 'Posušje', '063-655-655', 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nekretnina_user_fk` (`vlasnik_id`);

--
-- Indexes for table `obilazak`
--
ALTER TABLE `obilazak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obilazak_nekretnina_fk` (`nekretnina_id`),
  ADD KEY `obilazak_vlasnik_fk` (`vlasnik_id`),
  ADD KEY `obilazak_kupac_fk` (`kupac_id`);

--
-- Indexes for table `poruka_za_kupovinu`
--
ALTER TABLE `poruka_za_kupovinu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poruka_user_fk` (`posiljatelj_id`),
  ADD KEY `poruka_razgovor_fk` (`razgovor_id`);

--
-- Indexes for table `razgovor_za_kupovinu`
--
ALTER TABLE `razgovor_za_kupovinu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `razgovor_nekretnina_fk` (`nekretnina_id`),
  ADD KEY `razgovor_vlasnik_fk` (`vlasnik_id`),
  ADD KEY `razgovor_kupac_fk` (`kupac_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nekretnina`
--
ALTER TABLE `nekretnina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obilazak`
--
ALTER TABLE `obilazak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poruka_za_kupovinu`
--
ALTER TABLE `poruka_za_kupovinu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `razgovor_za_kupovinu`
--
ALTER TABLE `razgovor_za_kupovinu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD CONSTRAINT `nekretnina_user_fk` FOREIGN KEY (`vlasnik_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `obilazak`
--
ALTER TABLE `obilazak`
  ADD CONSTRAINT `obilazak_kupac_fk` FOREIGN KEY (`kupac_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `obilazak_nekretnina_fk` FOREIGN KEY (`nekretnina_id`) REFERENCES `nekretnina` (`id`),
  ADD CONSTRAINT `obilazak_vlasnik_fk` FOREIGN KEY (`vlasnik_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `poruka_za_kupovinu`
--
ALTER TABLE `poruka_za_kupovinu`
  ADD CONSTRAINT `poruka_razgovor_fk` FOREIGN KEY (`razgovor_id`) REFERENCES `razgovor_za_kupovinu` (`id`),
  ADD CONSTRAINT `poruka_user_fk` FOREIGN KEY (`posiljatelj_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `razgovor_za_kupovinu`
--
ALTER TABLE `razgovor_za_kupovinu`
  ADD CONSTRAINT `razgovor_kupac_fk` FOREIGN KEY (`kupac_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `razgovor_nekretnina_fk` FOREIGN KEY (`nekretnina_id`) REFERENCES `nekretnina` (`id`),
  ADD CONSTRAINT `razgovor_vlasnik_fk` FOREIGN KEY (`vlasnik_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
