-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Nov 2022 um 15:30
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cyanfox-poll`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `polls`
--

CREATE TABLE `polls` (
                         `id` int(11) NOT NULL,
                         `title` text NOT NULL,
                         `description` text NOT NULL,
                         `admin_id` text NOT NULL,
                         `withmax` text NOT NULL,
                         `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `poll_answers`
--

CREATE TABLE `poll_answers` (
                                `id` int(11) NOT NULL,
                                `poll_id` int(11) NOT NULL,
                                `title` text NOT NULL,
                                `max_votes` int(11) NOT NULL,
                                `voted_votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `poll_vote`
--

CREATE TABLE `poll_vote` (
                             `id` int(11) NOT NULL,
                             `poll_id` int(11) NOT NULL,
                             `vote` text NOT NULL,
                             `name` text NOT NULL,
                             `deleteKey` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `polls`
--
ALTER TABLE `polls`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `poll_answers`
--
ALTER TABLE `poll_answers`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `poll_vote`
--
ALTER TABLE `poll_vote`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `polls`
--
ALTER TABLE `polls`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT für Tabelle `poll_answers`
--
ALTER TABLE `poll_answers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT für Tabelle `poll_vote`
--
ALTER TABLE `poll_vote`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
