-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Mai 2020 um 00:40
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `musicplayer`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `album`
--

CREATE TABLE `album` (
  `AlbumID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `ReleaseYear` int(10) UNSIGNED NOT NULL,
  `CoverAddress` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `album`
--

INSERT INTO `album` (`AlbumID`, `Title`, `ReleaseYear`, `CoverAddress`) VALUES
(1, 'Yandhi', 2019, '/Data/Pictures/Covers/yandhi.jpg'),
(3, 'KIDS SEE GHOSTS', 2018, '/Data/Pictures/Covers/kidsseeghosts.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `album_artist`
--

CREATE TABLE `album_artist` (
  `AlbumID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `album_artist`
--

INSERT INTO `album_artist` (`AlbumID`, `ArtistID`) VALUES
(1, 1),
(3, 1),
(3, 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artist`
--

CREATE TABLE `artist` (
  `ArtistID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `PictureAddress` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `artist`
--

INSERT INTO `artist` (`ArtistID`, `Name`, `PictureAddress`) VALUES
(1, 'Kanye West', '/Data/Pictures/Artists/kanyewest.jpg'),
(2, 'Migos', '/Data/Pictures/Artists/migos.jpg'),
(3, 'Teyana Taylor', '/Data/Pictures/Artists/teyanataylor.jpg'),
(4, 'Ty Dolla Sign', '/Data/Pictures/Artists/tydollasign.jpg'),
(15, 'Kid Cudi', '/Data/Pictures/Artists/kidcudi.jpg'),
(24, 'Pusha T', '/Data/Pictures/Artists/pushat.jpg'),
(25, 'Louis Prima', '/Data/Pictures/Artists/louisprima.jpg'),
(26, 'Yasiin Bey', '/Data/Pictures/Artists/yasiinbey.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `song`
--

CREATE TABLE `song` (
  `SongID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `FileAddress` varchar(200) NOT NULL,
  `AlbumID` int(11) NOT NULL,
  `Position` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `song`
--

INSERT INTO `song` (`SongID`, `Title`, `FileAddress`, `AlbumID`, `Position`) VALUES
(1, 'Alien', '/Data/Audio/Yandhi/Alien.mp3', 1, 7),
(2, 'Are Dreams Real', '/Data/Audio/Yandhi/AreDreamsReal.mp3', 1, 15),
(3, 'CashToBurn', '/Data/Audio/Yandhi/CashToBurn.mp3', 1, 16),
(4, 'Chakras', '/Data/Audio/Yandhi/Chakras.mp3', 1, 12),
(5, 'City In The Sky', '/Data/Audio/Yandhi/CityInTheSky.mp3', 1, 8),
(6, 'Godzilla', '/Data/Audio/Yandhi/Godzilla.mp3', 1, 6),
(7, 'Hurricane', '/Data/Audio/Yandhi/Hurricane.mp3', 1, 5),
(8, 'I Love It', '/Data/Audio/Yandhi/ILoveIt.mp3', 1, 4),
(9, 'Last Name', '/Data/Audio/Yandhi/LastName.mp3', 1, 11),
(10, 'Laws Of Attraction', '/Data/Audio/Yandhi/LawsOfAttraction.mp3', 1, 13),
(11, 'New Body', '/Data/Audio/Yandhi/NewBody.mp3', 1, 3),
(12, 'Selah', '/Data/Audio/Yandhi/Selah.mp3', 1, 1),
(13, 'Spread Your Wings', '/Data/Audio/Yandhi/SpreadYourWings.mp3', 1, 14),
(14, 'The Garden', '/Data/Audio/Yandhi/TheGarden.mp3', 1, 9),
(15, 'The Storm', '/Data/Audio/Yandhi/TheStorm.mp3', 1, 2),
(16, 'We Got Love', '/Data/Audio/Yandhi/WeGotLove.mp3', 1, 10),
(17, 'Feel The Love', '/Data/Audio/KidsSeeGhosts/FeelTheLove.mp3', 3, 1),
(18, 'Fire', '/Data/Audio/KidsSeeGhosts/Fire.mp3', 3, 2),
(19, '4th Dimension', '/Data/Audio/KidsSeeGhosts/4thDimension.mp3', 3, 3),
(20, 'Freeee (Ghost Town Pt. 2)', '/Data/Audio/KidsSeeGhosts/Freeee.mp3', 3, 4),
(21, 'Reborn', '/Data/Audio/KidsSeeGhosts/Reborn.mp3', 3, 5),
(22, 'Kids See Ghosts', '/Data/Audio/KidsSeeGhosts/KidsSeeGhosts.mp3', 3, 6),
(23, 'Cudi Montage', '/Data/Audio/KidsSeeGhosts/CudiMontage.mp3', 3, 7);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `song_artist`
--

CREATE TABLE `song_artist` (
  `SongID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `IsFeature` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `song_artist`
--

INSERT INTO `song_artist` (`SongID`, `ArtistID`, `IsFeature`) VALUES
(1, 1, 0),
(1, 2, 1),
(1, 15, 1),
(2, 1, 0),
(3, 1, 0),
(4, 1, 0),
(5, 1, 0),
(5, 4, 1),
(5, 15, 1),
(6, 1, 0),
(7, 1, 0),
(7, 4, 1),
(8, 1, 0),
(9, 1, 0),
(10, 1, 0),
(11, 1, 0),
(11, 4, 1),
(12, 1, 0),
(13, 1, 0),
(14, 1, 0),
(14, 3, 1),
(14, 4, 1),
(15, 1, 0),
(15, 4, 1),
(15, 15, 1),
(16, 1, 0),
(16, 3, 1),
(17, 1, 0),
(17, 15, 0),
(17, 24, 1),
(18, 1, 0),
(18, 15, 0),
(19, 1, 0),
(19, 15, 0),
(19, 25, 1),
(20, 1, 0),
(20, 15, 0),
(21, 1, 0),
(21, 15, 0),
(22, 1, 0),
(22, 15, 0),
(22, 26, 1),
(23, 1, 0),
(23, 15, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`Username`, `PasswordHash`) VALUES
('admin', '$2y$10$eLtoeIk4Pme1kMIrakFvGeHG7UwIHPYWfaxWQHjFjBUg2azruyoqO');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`AlbumID`);

--
-- Indizes für die Tabelle `album_artist`
--
ALTER TABLE `album_artist`
  ADD PRIMARY KEY (`AlbumID`,`ArtistID`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- Indizes für die Tabelle `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`ArtistID`);

--
-- Indizes für die Tabelle `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`SongID`),
  ADD KEY `AlbumID` (`AlbumID`);

--
-- Indizes für die Tabelle `song_artist`
--
ALTER TABLE `song_artist`
  ADD PRIMARY KEY (`SongID`,`ArtistID`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `album`
--
ALTER TABLE `album`
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `artist`
--
ALTER TABLE `artist`
  MODIFY `ArtistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `song`
--
ALTER TABLE `song`
  MODIFY `SongID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `album_artist`
--
ALTER TABLE `album_artist`
  ADD CONSTRAINT `album_artist_ibfk_1` FOREIGN KEY (`AlbumID`) REFERENCES `album` (`AlbumID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `album_artist_ibfk_2` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`AlbumID`) REFERENCES `album` (`AlbumID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `song_artist`
--
ALTER TABLE `song_artist`
  ADD CONSTRAINT `song_artist_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `song_artist_ibfk_2` FOREIGN KEY (`SongID`) REFERENCES `song` (`SongID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
