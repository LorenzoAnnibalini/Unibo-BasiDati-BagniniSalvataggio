-- phpMyAdmin SQL Dump
-- version 5.2.0
--
-- Host: localhost
-- Versione del server: 8.0.30
-- Versione PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `my_salvataggio`
--


-- --------------------------------------------------------

-- Creazione database

drop database if exists my_salvataggio;

create database if not exists my_salvataggio;
use my_salvataggio;

-- --------------------------------------------------------

--
-- Struttura della tabella `ATTREZZATURA`
--

CREATE TABLE `ATTREZZATURA` (
  `Id` int NOT NULL,
  `Nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `ATTREZZATURA`
--

INSERT INTO `ATTREZZATURA` (`Id`, `Nome`) VALUES
(1, 'Kit Medico'),
(2, 'Maglia'),
(1, 'Pantaloncino'),
(1, 'Radio');

-- --------------------------------------------------------

--
-- Struttura della tabella `CONTIENE`
--

CREATE TABLE `CONTIENE` (
  `IdMagazzino` int DEFAULT NULL,
  `Nome` varchar(50) NOT NULL,
  `IdAttrezzatura` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `CONTIENE`
--

INSERT INTO `CONTIENE` (`IdMagazzino`, `Nome`, `IdAttrezzatura`) VALUES
(1, 'Pantaloncino', 1),
(1, 'Radio', 1),
(1, 'Maglia', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `DIPENDENTE`
--

CREATE TABLE `DIPENDENTE` (
  `Nome` text,
  `Cognome` text,
  `CodiceFiscale` varchar(30) NOT NULL,
  `Brevetto` varchar(15) DEFAULT NULL,
  `DataNascita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `DIPENDENTE`
--

INSERT INTO `DIPENDENTE` (`Nome`, `Cognome`, `CodiceFiscale`, `Brevetto`, `DataNascita`) VALUES
('aaaa', 'aaaa', 'aaaa', 'aaaa', '2024-12-03'),
('bbbb', 'bbbb', 'bbbb', 'bbbb', '2024-12-03'),
('cccc', 'cccc', 'cccc', 'cccc', '2024-12-03');

-- --------------------------------------------------------

--
-- Struttura della tabella `EFFETTUA`
--

CREATE TABLE `EFFETTUA` (
  `IdIntervento` int NOT NULL,
  `CodiceFiscale` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `EFFETTUA`
--

INSERT INTO `EFFETTUA` (`IdIntervento`, `CodiceFiscale`) VALUES
(1, 'aaaa'),
(2, 'aaaa'),
(1, 'bbbb');

-- --------------------------------------------------------

--
-- Struttura della tabella `INTERVENTO`
--

CREATE TABLE `INTERVENTO` (
  `Id` int NOT NULL,
  `Anno` int DEFAULT NULL,
  `Luogo` varchar(50) DEFAULT NULL,
  `Descrizione` varchar(100) DEFAULT NULL,
  `Risultato` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `INTERVENTO`
--

INSERT INTO `INTERVENTO` (`Id`, `Anno`, `Luogo`, `Descrizione`, `Risultato`) VALUES
(1, 2024, 'Bagno 1', 'Malore in acqua altezza palo limite acque sicure, aspirato e ventilato con ossigeno. Elisoccorso.', 'vivo'),
(2, 2022, 'Bagni 2', 'Malore in acqua, a qualche metro da riva.', 'mortomare');

-- --------------------------------------------------------

--
-- Struttura della tabella `LAVORA`
--

CREATE TABLE `LAVORA` (
  `IdTorretta` int NOT NULL,
  `Ora` varchar(5) NOT NULL,
  `Giorno` varchar(50) NOT NULL,
  `CodiceFiscale` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `LAVORA`
--

INSERT INTO `LAVORA` (`IdTorretta`, `Ora`, `Giorno`, `CodiceFiscale`) VALUES
(1, '10:00', 'Lunedì', 'aaaa'),
(1, '11:00', 'Lunedì', 'bbbb');

-- --------------------------------------------------------

--
-- Struttura della tabella `MAGAZZINO`
--

CREATE TABLE `MAGAZZINO` (
  `Id` int NOT NULL,
  `Descrizione` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `MAGAZZINO`
--

INSERT INTO `MAGAZZINO` (`Id`, `Descrizione`) VALUES
(1, 'magazzino');

-- --------------------------------------------------------

--
-- Struttura della tabella `MEZZIDISOCCORSO`
--

CREATE TABLE `MEZZIDISOCCORSO` (
  `Id` int NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Salvagente` tinyint(1) DEFAULT NULL,
  `Ancorotto` tinyint(1) DEFAULT NULL,
  `Remi` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `MEZZIDISOCCORSO`
--

INSERT INTO `MEZZIDISOCCORSO` (`Id`, `Nome`, `Salvagente`, `Ancorotto`, `Remi`) VALUES
(1, 'Moscone', 1, 1, 1),
(1, 'RescueBoard', 0, 0, 0),
(2, 'Moscone', 0, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `ORARIO`
--

CREATE TABLE `ORARIO` (
  `Ora` varchar(5) NOT NULL,
  `Giorno` varchar(50) NOT NULL,
  `IdTorretta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `ORARIO`
--

INSERT INTO `ORARIO` (`Ora`, `Giorno`, `IdTorretta`) VALUES
('10:00', 'Lunedì', 1),
('11:00', 'Lunedì', 1),
('12:00', 'Lunedì', 1),
('13:00', 'Lunedì', 1),
('10:00', 'Lunedì', 2),
('11:00', 'Lunedì', 2),
('12:00', 'Lunedì', 2),
('13:00', 'Lunedì', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `POSSIEDE`
--

CREATE TABLE `POSSIEDE` (
  `IdTorretta` int DEFAULT NULL,
  `Nome` varchar(50) NOT NULL,
  `IdAttrezzatura` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `POSSIEDE`
--

INSERT INTO `POSSIEDE` (`IdTorretta`, `Nome`, `IdAttrezzatura`) VALUES
(1, 'Kit Medico', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `TIPOLOGIA`
--

CREATE TABLE `TIPOLOGIA` (
  `Nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `TIPOLOGIA`
--

INSERT INTO `TIPOLOGIA` (`Nome`) VALUES
('Kit Medico'),
('Maglia'),
('Pantaloncino'),
('Radio');

-- --------------------------------------------------------

--
-- Struttura della tabella `TORRETTA`
--

CREATE TABLE `TORRETTA` (
  `Id` int NOT NULL,
  `Descrizione` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `TORRETTA`
--

INSERT INTO `TORRETTA` (`Id`, `Descrizione`) VALUES
(1, 'Bagni 2'),
(2, 'Bagni 6');

-- --------------------------------------------------------

--
-- Struttura della tabella `USA`
--

CREATE TABLE `USA` (
  `IdAttrezzatura` int NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `CodiceFiscale` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `USA`
--

INSERT INTO `USA` (`IdAttrezzatura`, `Nome`, `CodiceFiscale`) VALUES
(1, 'Pantaloncino', 'aaaa'),
(2, 'Maglia', 'aaaa'),
(1, 'Radio', 'bbbb');

-- --------------------------------------------------------

--
-- Struttura della tabella `USERS`
--

CREATE TABLE `USERS` (
  `ID` int NOT NULL,
  `Username` text,
  `Password` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `USERS`
--

INSERT INTO `USERS` (`ID`, `Username`, `Password`) VALUES
(1, 'test', 'test');

-- --------------------------------------------------------

--
-- Struttura della tabella `UTILIZZO`
--

CREATE TABLE `UTILIZZO` (
  `IdTorretta` int DEFAULT NULL,
  `IdMezzoDiSoccorso` int NOT NULL,
  `Nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `UTILIZZO`
--

INSERT INTO `UTILIZZO` (`IdTorretta`, `IdMezzoDiSoccorso`, `Nome`) VALUES
(1, 1, 'Moscone'),
(1, 1, 'RescueBoard'),
(2, 2, 'Moscone');

-- --------------------------------------------------------

-- Indici per le tabelle

-- --------------------------------------------------------

--
-- Indici per le tabelle `ATTREZZATURA`
--
ALTER TABLE `ATTREZZATURA`
  ADD PRIMARY KEY (`Id`,`Nome`),
  ADD KEY `Nome` (`Nome`);

--
-- Indici per le tabelle `CONTIENE`
--
ALTER TABLE `CONTIENE`
  ADD PRIMARY KEY (`IdAttrezzatura`,`Nome`),
  ADD KEY `IdMagazzino` (`IdMagazzino`);

--
-- Indici per le tabelle `DIPENDENTE`
--
ALTER TABLE `DIPENDENTE`
  ADD PRIMARY KEY (`CodiceFiscale`);

--
-- Indici per le tabelle `EFFETTUA`
--
ALTER TABLE `EFFETTUA`
  ADD PRIMARY KEY (`IdIntervento`,`CodiceFiscale`),
  ADD KEY `CodiceFiscale` (`CodiceFiscale`);

--
-- Indici per le tabelle `INTERVENTO`
--
ALTER TABLE `INTERVENTO`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `LAVORA`
--
ALTER TABLE `LAVORA`
  ADD PRIMARY KEY (`IdTorretta`,`Ora`,`Giorno`),
  ADD KEY `CodiceFiscale` (`CodiceFiscale`);

--
-- Indici per le tabelle `MAGAZZINO`
--
ALTER TABLE `MAGAZZINO`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `MEZZIDISOCCORSO`
--
ALTER TABLE `MEZZIDISOCCORSO`
  ADD PRIMARY KEY (`Id`,`Nome`);

--
-- Indici per le tabelle `ORARIO`
--
ALTER TABLE `ORARIO`
  ADD PRIMARY KEY (`Ora`,`Giorno`,`IdTorretta`),
  ADD KEY `IdTorretta` (`IdTorretta`);

--
-- Indici per le tabelle `POSSIEDE`
--
ALTER TABLE `POSSIEDE`
  ADD PRIMARY KEY (`IdAttrezzatura`,`Nome`),
  ADD KEY `IdTorretta` (`IdTorretta`);

--
-- Indici per le tabelle `TIPOLOGIA`
--
ALTER TABLE `TIPOLOGIA`
  ADD PRIMARY KEY (`Nome`);

--
-- Indici per le tabelle `TORRETTA`
--
ALTER TABLE `TORRETTA`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `USA`
--
ALTER TABLE `USA`
  ADD PRIMARY KEY (`IdAttrezzatura`,`Nome`),
  ADD KEY `CodiceFiscale` (`CodiceFiscale`);

--
-- Indici per le tabelle `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `UTILIZZO`
--
ALTER TABLE `UTILIZZO`
  ADD PRIMARY KEY (`Nome`,`IdMezzoDiSoccorso`),
  ADD KEY `IdMezzoDiSoccorso` (`IdMezzoDiSoccorso`,`Nome`),
  ADD KEY `IdTorretta` (`IdTorretta`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ATTREZZATURA`
--
ALTER TABLE `ATTREZZATURA`
  ADD CONSTRAINT `ATTREZZATURA_ibfk_1` FOREIGN KEY (`Nome`) REFERENCES `TIPOLOGIA` (`Nome`) ON DELETE CASCADE;

--
-- Limiti per la tabella `CONTIENE`
--
ALTER TABLE `CONTIENE`
  ADD CONSTRAINT `CONTIENE_ibfk_1` FOREIGN KEY (`IdAttrezzatura`,`Nome`) REFERENCES `ATTREZZATURA` (`Id`, `Nome`) ON DELETE CASCADE,
  ADD CONSTRAINT `CONTIENE_ibfk_2` FOREIGN KEY (`IdMagazzino`) REFERENCES `MAGAZZINO` (`Id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `EFFETTUA`
--
ALTER TABLE `EFFETTUA`
  ADD CONSTRAINT `EFFETTUA_ibfk_1` FOREIGN KEY (`IdIntervento`) REFERENCES `INTERVENTO` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `EFFETTUA_ibfk_2` FOREIGN KEY (`CodiceFiscale`) REFERENCES `DIPENDENTE` (`CodiceFiscale`) ON DELETE CASCADE;

--
-- Limiti per la tabella `LAVORA`
--
ALTER TABLE `LAVORA`
  ADD CONSTRAINT `LAVORA_ibfk_1` FOREIGN KEY (`IdTorretta`,`Ora`,`Giorno`) REFERENCES `ORARIO` (`IdTorretta`, `Ora`, `Giorno`) ON DELETE CASCADE,
  ADD CONSTRAINT `LAVORA_ibfk_2` FOREIGN KEY (`CodiceFiscale`) REFERENCES `DIPENDENTE` (`CodiceFiscale`) ON DELETE CASCADE;

--
-- Limiti per la tabella `ORARIO`
--
ALTER TABLE `ORARIO`
  ADD CONSTRAINT `ORARIO_ibfk_1` FOREIGN KEY (`IdTorretta`) REFERENCES `TORRETTA` (`Id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `POSSIEDE`
--
ALTER TABLE `POSSIEDE`
  ADD CONSTRAINT `POSSIEDE_ibfk_1` FOREIGN KEY (`IdAttrezzatura`,`Nome`) REFERENCES `ATTREZZATURA` (`Id`, `Nome`) ON DELETE CASCADE,
  ADD CONSTRAINT `POSSIEDE_ibfk_2` FOREIGN KEY (`IdTorretta`) REFERENCES `TORRETTA` (`Id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `USA`
--
ALTER TABLE `USA`
  ADD CONSTRAINT `USA_ibfk_1` FOREIGN KEY (`IdAttrezzatura`,`Nome`) REFERENCES `ATTREZZATURA` (`Id`, `Nome`) ON DELETE CASCADE,
  ADD CONSTRAINT `USA_ibfk_2` FOREIGN KEY (`CodiceFiscale`) REFERENCES `DIPENDENTE` (`CodiceFiscale`) ON DELETE CASCADE;

--
-- Limiti per la tabella `UTILIZZO`
--
ALTER TABLE `UTILIZZO`
  ADD CONSTRAINT `UTILIZZO_ibfk_1` FOREIGN KEY (`IdMezzoDiSoccorso`,`Nome`) REFERENCES `MEZZIDISOCCORSO` (`Id`, `Nome`) ON DELETE CASCADE,
  ADD CONSTRAINT `UTILIZZO_ibfk_2` FOREIGN KEY (`IdTorretta`) REFERENCES `TORRETTA` (`Id`) ON DELETE CASCADE;
COMMIT;

