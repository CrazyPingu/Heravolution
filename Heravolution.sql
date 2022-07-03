-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Lug 02, 2022 alle 19:44
-- Versione del server: 10.5.15-MariaDB-0+deb11u1
-- Versione PHP: 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Heravolution`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `brand`
--

CREATE TABLE `brand` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `brand`
--

INSERT INTO `brand` (`name`) VALUES
('Dacia'),
('Lancia'),
('Mercedes'),
('Opel');

-- --------------------------------------------------------

--
-- Struttura della tabella `client`
--

CREATE TABLE `client` (
  `fiscalCode` varchar(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `client`
--

INSERT INTO `client` (`fiscalCode`, `name`, `surname`, `username`, `password`, `userType`) VALUES
('ZCCCST01S56A052F', 'Client', 'One', 'Client1', '$2y$10$GRp2yOzrcLIj1Vi/w01c7uFkT3Dfqd9svg1yl8Q/TcQYwGcDf0ovG', 'client'),
('ZCCCST01S56A052G', 'Client', 'Two', 'Client2', '$2y$10$YfKT8ggOhujQR/nVs0H0XOj8ouunmqiCsxmWnDMl8aVpcKOnOb/36', 'client'),
('ZCCCST01S56A052H', 'Driver', 'One', 'Driver1', '$2y$10$soMudqZ7D1.9uJOoa6i1.uTk/XMPEBgdM7IFREMdBEUT8Scn4cNJO', 'driver'),
('ZCCCST01S56A052L', 'Worker', 'One', 'Worker1', '$2y$10$ItoemH64U8Us2ukzHPb86.iDCVD4HK5np850tPlLOVOrciTYdI7sa', 'warehouse_worker'),
('ZCCCST01S56A052M', 'Worker', 'Two', 'Worker2', '$2y$10$0A5L1r1WT9vOlEhp2c0XV.mAfY6drbrk7DN6FrxNw2Ov.GymzLGxm', 'warehouse_worker');

-- --------------------------------------------------------

--
-- Struttura della tabella `container`
--

CREATE TABLE `container` (
  `IDProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `container`
--

INSERT INTO `container` (`IDProduct`) VALUES
(52),
(53),
(61),
(62),
(63),
(64),
(65);

-- --------------------------------------------------------

--
-- Struttura della tabella `driver`
--

CREATE TABLE `driver` (
  `fiscalCode` char(16) NOT NULL,
  `licensePlate` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `driver`
--

INSERT INTO `driver` (`fiscalCode`, `licensePlate`) VALUES
('ZCCCST01S56A052H', 'CC222DD');

-- --------------------------------------------------------

--
-- Struttura della tabella `driver_license`
--

CREATE TABLE `driver_license` (
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `driver_license`
--

INSERT INTO `driver_license` (`type`) VALUES
('B'),
('C'),
('C1');

-- --------------------------------------------------------

--
-- Struttura della tabella `drives`
--

CREATE TABLE `drives` (
  `IDDrives` int(11) NOT NULL,
  `date` date NOT NULL,
  `fiscalCode` varchar(16) NOT NULL,
  `licensePlate` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `drives`
--

INSERT INTO `drives` (`IDDrives`, `date`, `fiscalCode`, `licensePlate`) VALUES
(5, '2022-07-02', 'ZCCCST01S56A052H', 'CC222DD');

-- --------------------------------------------------------

--
-- Struttura della tabella `garbage`
--

CREATE TABLE `garbage` (
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `garbage`
--

INSERT INTO `garbage` (`type`) VALUES
('Battery'),
('Glass'),
('Organic'),
('Paper'),
('Plastic'),
('Undifferentiated');

-- --------------------------------------------------------

--
-- Struttura della tabella `order_of_product`
--

CREATE TABLE `order_of_product` (
  `IDOrderOfProduct` int(11) NOT NULL,
  `date` date NOT NULL,
  `weight` int(11) NOT NULL,
  `time` varchar(5) NOT NULL,
  `address` varchar(255) NOT NULL,
  `discountValue` int(3) DEFAULT NULL,
  `totalPrice` int(11) NOT NULL,
  `fiscalCode` varchar(16) NOT NULL,
  `licensePlate` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `order_of_product`
--

INSERT INTO `order_of_product` (`IDOrderOfProduct`, `date`, `weight`, `time`, `address`, `discountValue`, `totalPrice`, `fiscalCode`, `licensePlate`) VALUES
(20, '2022-07-02', 7, '18-26', 'z', 0, 6, 'ZCCCST01S56A052H', NULL),
(21, '2022-07-02', 8, '18-29', 'a', 0, 4, 'ZCCCST01S56A052H', NULL),
(22, '2022-07-02', 8, '19-05', 'a', 0, 8, 'ZCCCST01S56A052H', NULL),
(23, '2022-07-02', 10, '19-16', 'c', 10, 7, 'ZCCCST01S56A052H', NULL),
(24, '2022-07-02', 23, '19-23', 'b', 0, 16, 'ZCCCST01S56A052L', NULL),
(25, '2022-07-02', 10, '19-24', 'a', 10, 4, 'ZCCCST01S56A052H', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `owns`
--

CREATE TABLE `owns` (
  `IDOwns` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `fiscalCode` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `owns`
--

INSERT INTO `owns` (`IDOwns`, `type`, `fiscalCode`) VALUES
(5, 'C1', 'ZCCCST01S56A052H'),
(6, 'B', 'ZCCCST01S56A052H');

-- --------------------------------------------------------

--
-- Struttura della tabella `pick_up_garbage`
--

CREATE TABLE `pick_up_garbage` (
  `IDOrderGarbage` int(11) NOT NULL,
  `lIcensePlate` varchar(7) DEFAULT NULL,
  `fiscalCode` varchar(16) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(5) NOT NULL,
  `address` varchar(255) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `product`
--

CREATE TABLE `product` (
  `IDProduct` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `productType` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `garbageType` varchar(255) NOT NULL,
  `IDOrder` int(11) DEFAULT NULL,
  `IDWarehouse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `product`
--

INSERT INTO `product` (`IDProduct`, `price`, `productType`, `capacity`, `garbageType`, `IDOrder`, `IDWarehouse`) VALUES
(52, 4, 'container', 3, 'Battery', 20, 1),
(53, 4, 'container', 3, 'Battery', 22, 1),
(54, 2, 'trashbag', 4, 'Undifferentiated', 20, 1),
(55, 2, 'trashbag', 4, 'Undifferentiated', 21, 1),
(56, 2, 'trashbag', 4, 'Undifferentiated', 21, 1),
(57, 4, 'trashbag', 5, 'Glass', 22, 1),
(58, 4, 'trashbag', 5, 'Glass', 23, 1),
(59, 4, 'trashbag', 5, 'Glass', 23, 1),
(60, 4, 'trashbag', 5, 'Glass', NULL, 1),
(61, 5, 'container', 10, 'Organic', 25, 1),
(62, 5, 'container', 10, 'Organic', 24, 1),
(63, 5, 'container', 10, 'Organic', 24, 1),
(64, 5, 'container', 10, 'Organic', NULL, 1),
(65, 5, 'container', 10, 'Organic', NULL, 1),
(66, 6, 'trashbag', 3, 'Paper', 24, 1),
(67, 6, 'trashbag', 3, 'Paper', NULL, 1),
(68, 6, 'trashbag', 3, 'Paper', NULL, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `product_type`
--

CREATE TABLE `product_type` (
  `productType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `product_type`
--

INSERT INTO `product_type` (`productType`) VALUES
('container'),
('trashbag');

-- --------------------------------------------------------

--
-- Struttura della tabella `releaseLoad`
--

CREATE TABLE `releaseLoad` (
  `IDRelease` int(11) NOT NULL,
  `IDWasteDisposal` int(11) NOT NULL,
  `licensePlate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trashbag`
--

CREATE TABLE `trashbag` (
  `IDProduct` int(11) NOT NULL,
  `IDOrderGarbage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `trashbag`
--

INSERT INTO `trashbag` (`IDProduct`, `IDOrderGarbage`) VALUES
(54, NULL),
(55, NULL),
(56, NULL),
(57, NULL),
(58, NULL),
(59, NULL),
(60, NULL),
(66, NULL),
(67, NULL),
(68, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `vehicle`
--

CREATE TABLE `vehicle` (
  `licensePlate` varchar(7) NOT NULL,
  `loadCapacity` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL,
  `driverLicense` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `vehicle`
--

INSERT INTO `vehicle` (`licensePlate`, `loadCapacity`, `brandName`, `driverLicense`) VALUES
('AA111BB', 25, 'Dacia', 'B'),
('CC222DD', 15, 'Mercedes', 'C1'),
('EE333FF', 30, 'Opel', 'C'),
('GG444HH', 10, 'Lancia', 'B');

-- --------------------------------------------------------

--
-- Struttura della tabella `warehouse`
--

CREATE TABLE `warehouse` (
  `IDWarehouse` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `warehouse`
--

INSERT INTO `warehouse` (`IDWarehouse`, `address`) VALUES
(1, 'Shaftesbury Avenue 7'),
(2, 'Carnaby Street 14'),
(3, 'Abbey Road 80');

-- --------------------------------------------------------

--
-- Struttura della tabella `warehouse_worker`
--

CREATE TABLE `warehouse_worker` (
  `fiscalCode` varchar(16) NOT NULL,
  `IDWarehouse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `warehouse_worker`
--

INSERT INTO `warehouse_worker` (`fiscalCode`, `IDWarehouse`) VALUES
('ZCCCST01S56A052L', 1),
('ZCCCST01S56A052M', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `waste_disposal`
--

CREATE TABLE `waste_disposal` (
  `IDWasteDisposal` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `typeGarbage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `waste_disposal`
--

INSERT INTO `waste_disposal` (`IDWasteDisposal`, `address`, `typeGarbage`) VALUES
(1, 'Oxford Street 10', 'Battery'),
(2, 'Abbey Road 22', 'Glass'),
(3, 'Royal Mile 16', 'Organic'),
(4, 'Princes Street 12', 'Paper'),
(5, 'Brick Lane 9', 'Plastic'),
(6, 'Carnaby Street 78', 'Undifferentiated');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`name`);

--
-- Indici per le tabelle `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`fiscalCode`);

--
-- Indici per le tabelle `container`
--
ALTER TABLE `container`
  ADD KEY `IDContainer` (`IDProduct`);

--
-- Indici per le tabelle `driver`
--
ALTER TABLE `driver`
  ADD KEY `fiscalCode` (`fiscalCode`),
  ADD KEY `licensePlate` (`licensePlate`);

--
-- Indici per le tabelle `driver_license`
--
ALTER TABLE `driver_license`
  ADD PRIMARY KEY (`type`);

--
-- Indici per le tabelle `drives`
--
ALTER TABLE `drives`
  ADD PRIMARY KEY (`IDDrives`) USING BTREE,
  ADD KEY `fiscalCode` (`fiscalCode`),
  ADD KEY `licensePlate` (`licensePlate`);

--
-- Indici per le tabelle `garbage`
--
ALTER TABLE `garbage`
  ADD PRIMARY KEY (`type`);

--
-- Indici per le tabelle `order_of_product`
--
ALTER TABLE `order_of_product`
  ADD PRIMARY KEY (`IDOrderOfProduct`),
  ADD KEY `FiscalCode` (`fiscalCode`),
  ADD KEY `LicensePlate` (`licensePlate`);

--
-- Indici per le tabelle `owns`
--
ALTER TABLE `owns`
  ADD PRIMARY KEY (`IDOwns`) USING BTREE,
  ADD KEY `Type` (`type`),
  ADD KEY `fiscalCode` (`fiscalCode`);

--
-- Indici per le tabelle `pick_up_garbage`
--
ALTER TABLE `pick_up_garbage`
  ADD PRIMARY KEY (`IDOrderGarbage`),
  ADD KEY `LIcensePlate` (`lIcensePlate`),
  ADD KEY `FiscalCode` (`fiscalCode`);

--
-- Indici per le tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`IDProduct`),
  ADD KEY `type` (`garbageType`),
  ADD KEY `IDOrder` (`IDOrder`),
  ADD KEY `IDWarehouse` (`IDWarehouse`),
  ADD KEY `productType` (`productType`);

--
-- Indici per le tabelle `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`productType`);

--
-- Indici per le tabelle `releaseLoad`
--
ALTER TABLE `releaseLoad`
  ADD PRIMARY KEY (`IDRelease`) USING BTREE,
  ADD KEY `LicensePlate` (`licensePlate`),
  ADD KEY `IDWasteDisposal` (`IDWasteDisposal`);

--
-- Indici per le tabelle `trashbag`
--
ALTER TABLE `trashbag`
  ADD UNIQUE KEY `IDTrashbag` (`IDProduct`),
  ADD KEY `IDOrderGarbage` (`IDOrderGarbage`);

--
-- Indici per le tabelle `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`licensePlate`),
  ADD KEY `IDBrand` (`brandName`),
  ADD KEY `Type` (`driverLicense`);

--
-- Indici per le tabelle `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`IDWarehouse`);

--
-- Indici per le tabelle `warehouse_worker`
--
ALTER TABLE `warehouse_worker`
  ADD KEY `IDWarehouse` (`IDWarehouse`),
  ADD KEY `fiscalCode` (`fiscalCode`);

--
-- Indici per le tabelle `waste_disposal`
--
ALTER TABLE `waste_disposal`
  ADD PRIMARY KEY (`IDWasteDisposal`),
  ADD KEY `TypeGarbage` (`typeGarbage`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `drives`
--
ALTER TABLE `drives`
  MODIFY `IDDrives` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `order_of_product`
--
ALTER TABLE `order_of_product`
  MODIFY `IDOrderOfProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT per la tabella `owns`
--
ALTER TABLE `owns`
  MODIFY `IDOwns` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `pick_up_garbage`
--
ALTER TABLE `pick_up_garbage`
  MODIFY `IDOrderGarbage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `product`
--
ALTER TABLE `product`
  MODIFY `IDProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT per la tabella `releaseLoad`
--
ALTER TABLE `releaseLoad`
  MODIFY `IDRelease` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `IDWarehouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `waste_disposal`
--
ALTER TABLE `waste_disposal`
  MODIFY `IDWasteDisposal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `container`
--
ALTER TABLE `container`
  ADD CONSTRAINT `container_ibfk_1` FOREIGN KEY (`IDProduct`) REFERENCES `product` (`IDProduct`);

--
-- Limiti per la tabella `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`licensePlate`) REFERENCES `vehicle` (`licensePlate`),
  ADD CONSTRAINT `driver_ibfk_2` FOREIGN KEY (`fiscalCode`) REFERENCES `client` (`fiscalCode`);

--
-- Limiti per la tabella `drives`
--
ALTER TABLE `drives`
  ADD CONSTRAINT `drives_ibfk_2` FOREIGN KEY (`fiscalCode`) REFERENCES `driver` (`fiscalCode`),
  ADD CONSTRAINT `drives_ibfk_3` FOREIGN KEY (`licensePlate`) REFERENCES `vehicle` (`licensePlate`);

--
-- Limiti per la tabella `order_of_product`
--
ALTER TABLE `order_of_product`
  ADD CONSTRAINT `order_of_product_ibfk_2` FOREIGN KEY (`fiscalCode`) REFERENCES `client` (`fiscalCode`),
  ADD CONSTRAINT `order_of_product_ibfk_3` FOREIGN KEY (`licensePlate`) REFERENCES `vehicle` (`licensePlate`);

--
-- Limiti per la tabella `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`type`) REFERENCES `driver_license` (`type`),
  ADD CONSTRAINT `owns_ibfk_3` FOREIGN KEY (`fiscalCode`) REFERENCES `driver` (`fiscalCode`);

--
-- Limiti per la tabella `pick_up_garbage`
--
ALTER TABLE `pick_up_garbage`
  ADD CONSTRAINT `pick_up_garbage_ibfk_1` FOREIGN KEY (`lIcensePlate`) REFERENCES `vehicle` (`licensePlate`),
  ADD CONSTRAINT `pick_up_garbage_ibfk_2` FOREIGN KEY (`fiscalCode`) REFERENCES `client` (`fiscalCode`);

--
-- Limiti per la tabella `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`garbageType`) REFERENCES `garbage` (`type`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`IDOrder`) REFERENCES `order_of_product` (`IDOrderOfProduct`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`IDWarehouse`) REFERENCES `warehouse` (`IDWarehouse`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`productType`) REFERENCES `product_type` (`productType`);

--
-- Limiti per la tabella `releaseLoad`
--
ALTER TABLE `releaseLoad`
  ADD CONSTRAINT `releaseLoad_ibfk_1` FOREIGN KEY (`licensePlate`) REFERENCES `vehicle` (`licensePlate`),
  ADD CONSTRAINT `releaseLoad_ibfk_2` FOREIGN KEY (`IDWasteDisposal`) REFERENCES `waste_disposal` (`IDWasteDisposal`);

--
-- Limiti per la tabella `trashbag`
--
ALTER TABLE `trashbag`
  ADD CONSTRAINT `trashbag_ibfk_2` FOREIGN KEY (`IDOrderGarbage`) REFERENCES `pick_up_garbage` (`IDOrderGarbage`),
  ADD CONSTRAINT `trashbag_ibfk_3` FOREIGN KEY (`IDProduct`) REFERENCES `product` (`IDProduct`);

--
-- Limiti per la tabella `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_2` FOREIGN KEY (`driverLicense`) REFERENCES `driver_license` (`type`),
  ADD CONSTRAINT `vehicle_ibfk_3` FOREIGN KEY (`brandName`) REFERENCES `brand` (`name`);

--
-- Limiti per la tabella `warehouse_worker`
--
ALTER TABLE `warehouse_worker`
  ADD CONSTRAINT `warehouse_worker_ibfk_1` FOREIGN KEY (`IDWarehouse`) REFERENCES `warehouse` (`IDWarehouse`),
  ADD CONSTRAINT `warehouse_worker_ibfk_2` FOREIGN KEY (`fiscalCode`) REFERENCES `client` (`fiscalCode`);

--
-- Limiti per la tabella `waste_disposal`
--
ALTER TABLE `waste_disposal`
  ADD CONSTRAINT `waste_disposal_ibfk_1` FOREIGN KEY (`typeGarbage`) REFERENCES `garbage` (`type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
