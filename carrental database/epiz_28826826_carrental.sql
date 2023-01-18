-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: sql207.epizy.com
-- Timp de generare: iul. 12, 2021 la 02:57 AM
-- Versiune server: 5.6.48-88.0
-- Versiune PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `epiz_28826826_carrental`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `autovehicule`
--

CREATE TABLE `autovehicule` (
  `id` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_locatie` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `id_motor` int(11) NOT NULL,
  `id_transmisie` int(11) NOT NULL,
  `id_combustibil` int(11) NOT NULL,
  `imagine` varchar(255) NOT NULL,
  `descriere` mediumtext NOT NULL,
  `pret` int(5) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `rented` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `autovehicule`
--

INSERT INTO `autovehicule` (`id`, `id_categorie`, `id_locatie`, `id_marca`, `id_model`, `id_motor`, `id_transmisie`, `id_combustibil`, `imagine`, `descriere`, `pret`, `status`, `rented`) VALUES
(3, 2, 2, 1, 1, 1, 3, 2, 'imagini_masini/audi.jpeg', '•	 An fabricatie: 2016<br>•	Putere: 313 CP<br>•	Cutie de viteze: automata<br>•	Interior: Piele<br>•	Consum mixt: 4,5 l/100km<br>•	Consum extraurban: 4 l/100km<br>•	Consum urban: 5,3 l/100km<br>•	Bluetooth<br>•	Pilot automat<br>•	Senzori parcare fata-spate<br>•	 Navigatie GPS', 300, 1, 0),
(4, 1, 1, 4, 2, 2, 1, 2, 'imagini_masini/Mercedes Sprinter.jpeg', '•	 An fabricatie: 2008<br>•	Putere: 143cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa', 100, 1, 0),
(5, 5, 3, 4, 3, 3, 2, 1, 'imagini_masini/Mercedes C Class.jpeg', '•	 An fabricatie: 2010<br>•	Putere: 204cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Consum mixt:7.5l/100km<br>•	Consum extraurban: 5.9l/100km<br>•	Consum urban: 10.3l/100km<br>•	Pilot automat<br>•	Senzori parcare spate<br>•	 ', 150, 1, 0),
(6, 3, 2, 4, 4, 1, 3, 2, 'imagini_masini/Mercedes S Class.jpeg', '•	 An fabricatie: 2016<br>•	Putere: 286cp<br>•	Cutie de viteze: automata<br>•	Interior: piele<br>•	Consum mixt: 6.2 l/100km<br>•	Consum extraurban: 5 l/100km<br>•	Consum urban: 8.2 l/100km<br><br>•	Bluetooth<br>•	Pilot automat<br>•	Senzori parcare fata-spate<br>•	 Navigatie GPS•	 Trapa', 500, 1, 0),
(31, 6, 2, 3, 8, 1, 3, 2, 'imagini_masini/dIPQMTQrAA.jpeg', '•	 An fabricatie: 2014<br>•	Putere: 265cp<br>•	Cutie de viteze: automata<br>•	Interior: piele<br>•	Consum mixt: 7.2l/100km<br>•	Consum extraurban:10.5l/100km<br>•	Consum urban: 6.2l/100km<br>•	Bluetooth<br>•	Pilot automat<br>•	Senzori parcare fata-spate<br>•	 Navigatie GPS', 350, 1, 0),
(32, 6, 1, 7, 10, 5, 3, 1, 'imagini_masini/Ty1cotT02o.jpeg', '•	 An fabricatie: 2011<br>•	Putere:c110cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Consum mixt: 6.4l/100km<br>•	Consum extraurban: 5.1l/100km<br>•	Consum urban: 7.8l/100km<br>', 100, 1, 0),
(33, 3, 3, 3, 15, 3, 2, 2, 'imagini_masini/ZZQVOIDByt.jpeg', '•	 An fabricatie: 2011<br>•	Putere: 184cp<br>•	Cutie de viteze: automata<br>•	Interior: piele<br>•	Consum mixt: 6.2l/100km<br>•	Consum extraurban: 5.1l/100km<br>•	Consum urban: 7.5l/100km<br>•	Bluetooth<br>•	Pilot automat<br>•	Senzori parcare fata-spate<br>•	 Navigatie GPS', 200, 1, 0),
(34, 4, 3, 8, 14, 6, 1, 1, 'imagini_masini/43ccHYF02u.jpeg', '•	 An fabricatie: 2012<br>•	Putere: 75cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Consum mixt: 4.8l/100km<br>•	Consum extraurban: 4.1l/100km<br>•	Consum urban: 6.4l/100km<br>', 75, 1, 0),
(35, 2, 2, 8, 13, 3, 1, 2, 'imagini_masini/V9N7UPip4B.jpeg', '•	 An fabricatie: 2008<br>•	Putere: 140cp<br>•	Cutie de viteze: manuala<br>•	Interior: piele<br>•	Consum mixt: 5.8l/100km<br>•	Consum extraurban: 4.8l/100km<br>•	Consum urban: 7.1l/100km<br><br>•	Senzori parcare fata-spate<br>', 125, 1, 0),
(36, 1, 3, 4, 16, 3, 1, 2, 'imagini_masini/HoK5AAehSV.jpeg', '•	 An fabricatie: 2013<br>•	Putere: 170cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Consum mixt: 6l/100km<br>•	Consum extraurban: 4.9l/100km<br>•	Consum urban: 7.4l/100km<br>•	8 locuri', 150, 1, 1),
(37, 2, 1, 1, 12, 3, 1, 2, 'imagini_masini/mb4kti800M.jpeg', '•	 An fabricatie: 2007<br>•	Putere: 143cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Consum mixt: 5l/100km<br>•	Consum extraurban: 4.6l/100km<br>•	Consum urban: 7l/100km<br>•	Senzori parcare fata-spate<br>•	 Navigatie GPS', 100, 1, 0),
(38, 1, 3, 8, 17, 3, 3, 2, 'imagini_masini/3nNqkIiklN.jpeg', '•	 An fabricatie:2012<br>•	Putere:170cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Bluetooth<br>•	Pilot automat<br>', 125, 1, 0),
(39, 4, 3, 5, 6, 3, 1, 2, 'imagini_masini/BRsERoWsIi.jpg', '•	 An fabricatie: 2016<br>•	Putere: 120cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Consum mixt: 4.5l/100km<br>•	Consum extraurban: 4l/100km<br>•	Consum urban: 5.8l/100km<br>•	Bluetooth<br>•	Pilot automat<br>•	 Navigatie GPS', 150, 1, 0),
(40, 3, 2, 5, 7, 7, 1, 1, 'imagini_masini/dyYCdRRACp.jpg', '•	 An fabricatie:2008•	Putere: 208cp•	Cutie de viteze: automata•	Interior: piele<br>•	Bluetooth<br>•	Pilot automat<br>•	Senzori parcare fata-spate', 100, 1, 0),
(41, 2, 2, 3, 18, 3, 2, 2, 'imagini_masini/gDEw9lmWyE.jpeg', '•	 An fabricatie: 2013<br>•	Putere: 184cp<br>•	Cutie de viteze: manuala<br>•	Interior: piele<br>•	Consum mixt:5.6l/100km<br>•	Consum extraurban: 4.9l/100km<br>•	Consum urban: 7.8l/100km<br>•	Pilot automat<br>•	Senzori parcare spate', 150, 1, 0),
(42, 6, 1, 2, 5, 3, 3, 2, 'imagini_masini/29jb2YG8ws.jpeg', '•	 An fabricatie: 2012<br>•	Putere: 163cp<br>•	Cutie de viteze: automata<br>•	Interior: piele<br>•	Consum mixt:6l/100km<br>•	Consum extraurban: 5.4l/100km<br>•	Consum urban: 8l/100km<br>•	Pilot automat<br>•	 Navigatie GPS', 250, 1, 0),
(43, 4, 2, 6, 19, 6, 1, 1, 'imagini_masini/BoHLriUFsJ.jpg', '•	 An fabricatie: 2012<br>•	Putere: 75cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Consum mixt:5l/100km<br>•	Consum extraurban: 4.2l/100km<br>•	Consum urban: 6.1l/100km', 100, 1, 0),
(44, 1, 1, 4, 2, 2, 3, 2, 'imagini_masini/xlM9t9EvQV.jpg', '•	 An fabricatie: 2016<br>•	Putere: 170cp<br>•	Cutie de viteze: automata<br>•	Interior: piele<br>•	Pilot automat<br>•	 Navigatie GPS', 200, 1, 0),
(45, 3, 2, 1, 1, 3, 1, 2, 'imagini_masini/aFanJBOK8F.jpg', '•	 An fabricatie: 2016<br>•	Putere: 190cp<br>•	Cutie de viteze: automata<br>•	Interior: alcantare<br>•	Consum mixt:5.4l/100km<br>•	Consum extraurban: 4.4l/100km<br>•	Consum urban: 6.4l/100km<br>•	Pilot automat<br>•	 Navigatie GPS<br>•	Bluetooth<br>•	Trapa', 250, 1, 0),
(46, 6, 3, 1, 20, 3, 3, 2, 'imagini_masini/gXBKOXshto.jpg', '•	 An fabricatie: 2014<br>•	Putere: 177cp<br>•	Cutie de viteze: automata<br>•	Interior: piele<br>•	Consum mixt:7.5l/100km<br>•	Consum extraurban: 6l/100km<br>•	Consum urban: 10.1l/100km<br>•	Pilot automat<br>•	 Navigatie GPS', 350, 1, 0),
(47, 6, 1, 5, 21, 1, 3, 2, 'imagini_masini/O16NyXWDA1.jpg', '•	 An fabricatie: 2018<br>•	Putere: 251cp<br>•	Cutie de viteze: automata<br>•	Interior: piele<br>•	Consum mixt:6l/100km<br>•	Consum extraurban: 5.4l/100km<br>•	Consum urban: 8l/100km<br>•	Pilot automat<br>•	 Navigatie GPS<br>•	Trapa', 450, 1, 0),
(48, 6, 1, 3, 8, 1, 3, 2, 'imagini_masini/xaBBv6zSeI.jpg', '•	 An fabricatie: 2016<br>•	Putere: 381cp<br>•	Cutie de viteze: automata<br>•	Interior: piele<br>•	Consum mixt:8l/100km<br>•	Consum extraurban: 6.4l/100km<br>•	Consum urban: 11l/100km<br>•	Pilot automat<br>•	 Navigatie GPS<br>•	Bluetooth', 550, 1, 0),
(49, 6, 2, 3, 22, 3, 3, 2, 'imagini_masini/YriADNZ3tQ.jpg', '•	 An fabricatie: 2010<br>•	Putere: 177cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Consum mixt:6.8l/100km<br>•	Consum extraurban: 5.9l/100km<br>•	Consum urban: 9.7l/100km<br>•	Pilot automat', 150, 1, 0),
(50, 5, 3, 4, 23, 8, 2, 2, 'imagini_masini/Kku1Ey7cm7.jpg', '•	 An fabricatie: 2010<br>•	Putere: 170cp<br>•	Cutie de viteze: automata<br>•	Interior: stofa<br>•	Consum mixt:6.5l/100km<br>•	Consum extraurban: 5.4l/100km<br>•	Consum urban: 8.5l/100km', 100, 1, 0),
(51, 2, 2, 8, 24, 6, 1, 1, 'imagini_masini/tCxJhW6wDD.jpg', '•	 An fabricatie: 2013<br>•	Putere: 105cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa<br>•	Consum mixt:6l/100km<br>•	Consum extraurban: 5.4l/100km<br>•	Consum urban: 8l/100km<br>•	Bluetooth', 175, 1, 0),
(52, 5, 1, 1, 25, 3, 1, 1, 'imagini_masini/AG9RsbP0gb.jpg', '•	 An fabricatie: 2011<br>•	Putere: 190cp<br>•	Cutie de viteze: automata<br>•	Interior: piele<br>•	Consum mixt:6.6l/100km<br>•	Consum extraurban: 5.8l/100km<br>•	Consum urban: 11l/100km<br>•	Pilot automat<br>•	 Navigatie GPS', 200, 1, 0),
(53, 4, 3, 1, 26, 6, 1, 1, 'imagini_masini/eIyEQHc2Pe.jpg', '•	 An fabricatie: 2001<br>•	Putere: 65cp<br>•	Cutie de viteze: manuala<br>•	Interior: stofa', 50, 1, 1),
(54, 5, 2, 5, 27, 3, 1, 2, 'imagini_masini/xLNaxRfqf3.jpg', 'Putere: 190 CP', 150, 1, 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `categorii_autovehicule`
--

CREATE TABLE `categorii_autovehicule` (
  `id_categorie` int(11) NOT NULL,
  `nume` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `categorii_autovehicule`
--

INSERT INTO `categorii_autovehicule` (`id_categorie`, `nume`) VALUES
(1, 'Transport'),
(2, 'Break'),
(3, 'Limuzina'),
(4, 'Hatchback'),
(5, 'Sedan'),
(6, 'Suv');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `combustibili`
--

CREATE TABLE `combustibili` (
  `id_combustibil` int(11) NOT NULL,
  `nume_combustibil` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `combustibili`
--

INSERT INTO `combustibili` (`id_combustibil`, `nume_combustibil`) VALUES
(1, 'Benzina'),
(2, 'Diesel'),
(3, 'Benzina + GPL');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `inchirieri`
--

CREATE TABLE `inchirieri` (
  `id_inchirieri` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_car` int(11) NOT NULL,
  `id_locatie` int(11) NOT NULL,
  `startdate` varchar(16) NOT NULL,
  `enddate` varchar(16) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `inchirieri`
--

INSERT INTO `inchirieri` (`id_inchirieri`, `id_user`, `id_car`, `id_locatie`, `startdate`, `enddate`, `status`) VALUES
(15, 2, 6, 2, '1623974400', '1624406400', 'finished'),
(16, 2, 4, 1, '1624060800', '1624233600', 'finished'),
(24, 29, 36, 3, '1624665600', '1655683200', 'active'),
(25, 29, 37, 1, '1624147200', '1624752000', 'finished'),
(26, 29, 40, 2, '1648771200', '1687132800', 'pending'),
(27, 29, 6, 2, '1634774400', '1658188800', 'pending'),
(28, 29, 39, 3, '1655251200', '1660867200', 'pending'),
(29, 30, 37, 1, '1626307200', '1626912000', 'pending'),
(30, 30, 4, 1, '1640995200', '1642377600', 'pending'),
(31, 30, 34, 3, '1631664000', '1633132800', 'pending'),
(32, 30, 42, 1, '1636761600', '1636934400', 'pending'),
(33, 30, 41, 2, '1624233600', '1624320000', 'finished'),
(34, 30, 38, 3, '1639008000', '1639526400', 'pending'),
(35, 31, 4, 1, '1631664000', '1632441600', 'pending'),
(36, 31, 3, 2, '1642636800', '1643328000', 'pending'),
(37, 31, 33, 3, '1635811200', '1636588800', 'pending'),
(38, 31, 31, 2, '1655251200', '1656201600', 'pending'),
(39, 31, 5, 3, '1629417600', '1630368000', 'pending'),
(40, 31, 38, 3, '1649030400', '1649635200', 'pending'),
(41, 32, 41, 2, '1625443200', '1625961600', 'finished'),
(42, 32, 3, 2, '1627084800', '1627516800', 'pending'),
(43, 32, 6, 2, '1627862400', '1628553600', 'pending'),
(44, 32, 33, 3, '1627862400', '1628553600', 'pending'),
(45, 32, 31, 2, '1629158400', '1630368000', 'pending'),
(46, 32, 48, 1, '1633478400', '1634860800', 'pending'),
(47, 32, 4, 1, '1644364800', '1645142400', 'pending'),
(48, 2, 53, 3, '1624060800', '1630108800', 'active'),
(49, 33, 46, 3, '1624060800', '1625270400', 'finished'),
(50, 33, 48, 1, '1624147200', '1624406400', 'finished'),
(51, 33, 47, 1, '1625529600', '1625875200', 'finished'),
(52, 33, 50, 3, '1626739200', '1626998400', 'pending'),
(53, 33, 6, 2, '1629417600', '1630627200', 'pending'),
(54, 20, 53, 3, '1646870400', '1647561600', 'pending'),
(55, 14, 35, 2, '1625702400', '1625961600', 'finished'),
(56, 20, 51, 2, '1632096000', '1632441600', 'pending'),
(57, 14, 37, 1, '1629676800', '1629849600', 'pending'),
(58, 14, 40, 2, '1625616000', '1625961600', 'finished'),
(59, 20, 44, 1, '1641859200', '1642550400', 'pending'),
(60, 14, 39, 3, '1626048000', '1626998400', 'active'),
(61, 14, 53, 3, '1636934400', '1637884800', 'pending'),
(62, 20, 43, 2, '1654819200', '1655251200', 'pending'),
(63, 14, 52, 1, '1626739200', '1627084800', 'pending'),
(64, 20, 32, 1, '1635984000', '1636156800', 'pending'),
(65, 19, 4, 1, '1645747200', '1645920000', 'pending'),
(66, 19, 34, 3, '1624665600', '1624752000', 'finished'),
(67, 10, 49, 2, '1624060800', '1624320000', 'finished'),
(68, 19, 50, 3, '1658361600', '1658534400', 'pending'),
(69, 10, 48, 1, '1629417600', '1629936000', 'pending'),
(70, 19, 42, 1, '1648598400', '1649030400', 'pending'),
(71, 10, 47, 1, '1626912000', '1627516800', 'pending'),
(72, 10, 34, 3, '1626912000', '1627257600', 'pending'),
(73, 19, 46, 3, '1647388800', '1647648000', 'pending'),
(74, 10, 5, 3, '1627776000', '1628121600', 'pending'),
(75, 10, 50, 3, '1629072000', '1629417600', 'pending'),
(76, 10, 39, 3, '1627603200', '1627948800', 'pending'),
(77, 18, 39, 3, '1624147200', '1624406400', 'finished'),
(78, 18, 39, 3, '1632960000', '1633478400', 'pending'),
(79, 18, 39, 3, '1642550400', '1642896000', 'pending'),
(80, 11, 3, 2, '1629244800', '1629504000', 'pending'),
(81, 18, 47, 1, '1625011200', '1625184000', 'finished'),
(82, 18, 53, 3, '1648080000', '1648339200', 'pending'),
(83, 11, 34, 3, '1625788800', '1626134400', 'active'),
(84, 17, 4, 1, '1629417600', '1629590400', 'pending'),
(85, 11, 31, 2, '1624233600', '1624665600', 'finished'),
(86, 17, 44, 1, '1633737600', '1633996800', 'pending'),
(87, 17, 38, 3, '1638576000', '1638748800', 'pending'),
(88, 11, 42, 1, '1626739200', '1627171200', 'pending'),
(89, 11, 42, 1, '1624233600', '1624579200', 'finished'),
(90, 11, 46, 3, '1627344000', '1627689600', 'pending'),
(91, 17, 38, 3, '1643932800', '1644192000', 'pending'),
(92, 11, 32, 1, '1625443200', '1625702400', 'finished'),
(93, 11, 48, 1, '1625097600', '1625788800', 'finished'),
(94, 16, 31, 2, '1637280000', '1637452800', 'pending'),
(95, 16, 35, 2, '1645574400', '1645747200', 'pending'),
(96, 11, 43, 2, '1626825600', '1627257600', 'pending'),
(97, 16, 33, 3, '1647302400', '1647648000', 'pending'),
(98, 16, 41, 2, '1653350400', '1653609600', 'pending'),
(99, 16, 49, 2, '1639008000', '1639353600', 'pending'),
(100, 1, 4, 1, '1656633600', '1658188800', 'pending'),
(101, 8, 52, 1, '1626134400', '1626480000', 'pending'),
(102, 34, 43, 2, '1626220800', '1626652800', 'pending');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `locatii`
--

CREATE TABLE `locatii` (
  `id_locatie` int(11) NOT NULL,
  `adresa` varchar(32) NOT NULL,
  `oras` varchar(32) NOT NULL,
  `judet` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `locatii`
--

INSERT INTO `locatii` (`id_locatie`, `adresa`, `oras`, `judet`) VALUES
(1, 'bd. Bucuresti nr.22', 'Baia Mare', 'Maramures'),
(2, 'bd. Muncii nr.125', 'Cluj-Napoca', 'Cluj'),
(3, 'bd. Traian nr.130', 'Timisoara', 'Timis');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `marci`
--

CREATE TABLE `marci` (
  `id_marca` int(11) NOT NULL,
  `nume_marca` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `marci`
--

INSERT INTO `marci` (`id_marca`, `nume_marca`) VALUES
(1, 'Audi'),
(2, 'JEEP'),
(3, 'BMW'),
(4, 'Mercedes-Benz'),
(5, 'Volvo'),
(6, 'Opel'),
(7, 'Dacia'),
(8, 'Volkswagen');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `modele`
--

CREATE TABLE `modele` (
  `id_model` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `nume_model` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `modele`
--

INSERT INTO `modele` (`id_model`, `id_marca`, `nume_model`) VALUES
(1, 1, 'A6'),
(2, 4, 'Sprinter'),
(3, 4, 'C Class'),
(4, 4, 'S Class'),
(5, 2, 'Compass'),
(6, 5, 'V40'),
(7, 5, 'S80'),
(8, 3, 'X5'),
(9, 2, '1112'),
(10, 7, 'Duster'),
(11, 7, 'Logan'),
(12, 1, 'A4'),
(13, 8, 'Passat'),
(14, 8, 'Polo'),
(15, 3, 'Seria 5'),
(16, 4, 'Vito'),
(17, 8, 'Crafter'),
(18, 3, 'Seria 3'),
(19, 6, 'Corsa'),
(20, 1, 'Q5'),
(21, 5, 'XC90'),
(22, 3, 'X3'),
(23, 4, 'E Class'),
(24, 8, 'Golf VII'),
(25, 1, 'A5'),
(26, 1, 'A2'),
(27, 5, 'S60');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `motoare`
--

CREATE TABLE `motoare` (
  `id_motor` int(11) NOT NULL,
  `capacitate` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `motoare`
--

INSERT INTO `motoare` (`id_motor`, `capacitate`) VALUES
(1, 3000),
(2, 2500),
(3, 2000),
(4, 1900),
(5, 1500),
(6, 1400),
(7, 2400),
(8, 2200),
(9, 1600);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `transmisii`
--

CREATE TABLE `transmisii` (
  `id_transmisie` int(11) NOT NULL,
  `nume_transmisie` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `transmisii`
--

INSERT INTO `transmisii` (`id_transmisie`, `nume_transmisie`) VALUES
(1, 'Fata'),
(2, 'Spate'),
(3, '4x4');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id_user` int(11) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `CNP` varchar(13) NOT NULL,
  `data_nasterii` varchar(16) NOT NULL,
  `address` varchar(255) NOT NULL,
  `firstissued` varchar(16) NOT NULL,
  `issued` varchar(16) NOT NULL,
  `expires` varchar(16) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `utilizatori`
--

INSERT INTO `utilizatori` (`id_user`, `role`, `username`, `password`, `fullname`, `CNP`, `data_nasterii`, `address`, `firstissued`, `issued`, `expires`, `status`) VALUES
(1, 'admin', 'leon', '5c443b2003676fa5e8966030ce3a86ea', 'Leon Butean', '1990312245029', '', '', '0000-00-00', '', '', 1),
(2, 'user', 'test', '098f6bcd4621d373cade4e832627b4f6', 'Alex John', '1930202156598', '', 'str. Decebal, Craiova, Dolj', '645840000', '1277337600', '1687392000', 1),
(8, 'user', 'popion', 'e5d5b5637674415c7c973f91357e042b', 'Pop ion', '2690202141526', '-28771200', 'George Enescu nr.8, Baia Mare, Maramures', '645840000', '1277337600', '1687392000', 1),
(14, 'user', 'bendeacmihai', '46c17d023bf8ce320c5d4767462961c7', 'Bendeac Mihai', '1860708234354', '521164800', 'str.Granicerilor, Baia Mare, Maramures', '1037232000', '1037232000', '1668384000', 1),
(10, 'user', 'costincatalin', 'b03b2d1687107d3bd8e163ff334d5448', 'Costin Catalin', '1980628245031', '898992000', 'str. Oituz, Baia Mare, Maramures', '1503100800', '1503100800', '1818633600', 1),
(11, 'user', 'popdan', 'cfd32c5e7835a6e8b4305af9fc020b48', 'Pop Dan', '1920804234356', '712886400', 'str Principala, Valea Chioarului', '1463011200', '1463011200', '1778544000', 1),
(12, 'user', 'tomaalexandru', '2c48f37b3ed0b3c2eced4d9f205ec6c1', 'Toma Alexandru', '1842305125412', '454118400', 'str. Victoriei, Bucuresti, Ilfov', '637200000', '1268352000', '1741737600', 1),
(13, 'user', 'bordeacatalin', 'db3b478eec426a9a27ec93675aedf0a0', 'Bordea Catalin', '1830412345412', '418953600', 'bld uniri, Bucuresti, Ilfov', '1050796800', '1366416000', '1681948800', 1),
(15, 'user', 'matachedelia', '4dbb5503be04b4c2aeed86e77e22d185', 'Matache Delia', '2820201232567', '381369600', 'str.Orhideei, Baia Mare, Maramures', '1051401600', '1051401600', '1682553600', 1),
(16, 'user', 'ionstefancatalin', '2874c4b5c511a281795b3781b3e0f3e4', 'Ion Stefan Catalin', '1770603435421', '234144000', 'str. Vasile Alecsandri, Baia Mare, Ilfov', '855360000', '1170892800', '1802044800', 1),
(17, 'user', 'copotserban', 'c3cfa8017b55e1526841e6f045729a25', 'Copot Serban', '1800323542131', '322617600', 'str. Dragos Voda, Baia Mare, Maramures', '1085356800', '1085356800', '1745366400', 1),
(18, 'user', 'badeadan', '3305330e721097a02a9fa1c547f62339', 'Badea Dan', '1761212213242', '219196800', 'str. George Cosbuc, Cluj Napoca, Cluj', '858297600', '1173830400', '1804982400', 1),
(19, 'user', 'munteanucristian', 'fe4b491155da82d738e93b57d16fe663', 'Munteanu Cristian', '1980729245031', '901670400', 'str. 1 decembrie,Timisoara, Timis', '1473724800', '1473724800', '1883952000', 1),
(20, 'user', 'ibackacabral', 'a4d64cdb3137e8e8a07b06d2624f4dae', 'Ibacka Cabral', '1730522245031', '106876800', 'str. Retezat, Timisoara, Timis', '735523200', '1366675200', '1682208000', 1),
(21, 'user', 'tanasegeorge', '99979f15078f2500b919ba1e1c7d4801', 'Tanase George', '1910505245031', '673401600', 'str.Rozelor, Piatra Neamt, Neamt', '1309910400', '1307404800', '1654560000', 1),
(22, 'user', 'parcalabsorin', '44ef674de8dc21f82cf8220a3e7af9a6', 'Parcalab Sorin', '1751210234930', '187401600', 'str. Decebal, Craiova, Dolj', '818726400', '1134345600', '1765497600', 1),
(23, 'user', 'lobontgeorgiana', '8c67b5e324ac21366659092ee1404ca1', 'Lobont Georgiana', '1860304224829', '510278400', 'str.Dorobantilor,Oradea,Bihor', '1163376000', '1163376000', '1794528000', 1),
(24, 'user', 'buzdugandaniel', '4e64fc28659d29d96b4730b820f937e9', 'Buzdugan Daniel', '1741212214321', '156038400', 'str. Bazelor, Suceava, Suceava', '784512000', '1100131200', '1699660800', 1),
(25, 'user', 'panaitionut', 'fefd2bee2774491c284d9460e4951dd4', 'Panait Ionut', '1680323324311', '-56073600', 'str.Albinii, Iasi,Iasi', '587001600', '1218153600', '1849305600', 1),
(26, 'user', 'popasilviu', 'a4a5e2e71026b96ba0c56ffb7eca3797', 'Popa Silviu', '1831010245221', '434592000', 'str.Rahovei, Ploiesti, Prahova', '1044144000', '1044144000', '1675296000', 1),
(27, 'user', 'ciobanusergiu', '0686d39f67eab252278ed4049fd7b1a3', 'Ciobanu Sergiu', '1911231324322', '694137600', 'str. Marasti, Deva, Hunedoara', '1312675200', '1312675200', '1751932800', 1),
(28, 'user', 'roscaalexandru', '6396ffedbe807a51304983ac004b6f47', 'Rosca Alexandru', '1730413242531', '103507200', 'str. Somesului, Somcuta Mare, Maramures', '731203200', '1046736000', '1677888000', 1),
(29, 'user', 'Msergiu', '095b2626c9b6bad0eb89019ea6091bd9', 'Sergiu Muntean', '1231231231231', '1202860800', 'Cluj 123 Cluj-napoc 1', '1499212800', '1622764800', '1689724800', 1),
(30, 'user', 'RotariuCristian', 'fcc8c0a57ab902388613f2782eae3dd6', 'Rotariu  Cristian', '1670402240032', '-86832000', 'str Podinei, Baia Mare, Maramures', '997228800', '1313107200', '1628726400', 1),
(31, 'user', 'ovidiua', '3f30e1a299b417a0052b0a0e9085dcf6', 'Ardelean Ovidiu', '1980308221567', '888883200', 'strada infratirii , carei , satu mare', '1460419200', '1460419200', '1775952000', 1),
(32, 'user', 'Handru99', 'dadf22ec8ad48cd9d1ab80bed4dc6b16', 'Handru Sergiu', '1990531125786', '928108800', 'principala nr 13 Gilau Cluj', '1510963200', '1510963200', '1700265600', 1),
(33, 'user', 'adipascaru', '827ccb0eea8a706c4c34a16891f84e7b', 'Pascaru Adi', '1981117330245', '911260800', 'Strada Aurel Vlaicu , Cluj-Napoca, Cluj', '1481500800', '1481500800', '1789171200', 1),
(34, 'user', 'popbogdan', '59a31bf843bfac0339f108a964172ce6', 'Pop Bogdan', '1890202221133', '602380800', 'strada Somesului nr.8, Somcuta Mare, Maramures', '961027200', '1434499200', '1750291200', 1);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `autovehicule`
--
ALTER TABLE `autovehicule`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `categorii_autovehicule`
--
ALTER TABLE `categorii_autovehicule`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Indexuri pentru tabele `combustibili`
--
ALTER TABLE `combustibili`
  ADD PRIMARY KEY (`id_combustibil`);

--
-- Indexuri pentru tabele `inchirieri`
--
ALTER TABLE `inchirieri`
  ADD PRIMARY KEY (`id_inchirieri`);

--
-- Indexuri pentru tabele `locatii`
--
ALTER TABLE `locatii`
  ADD PRIMARY KEY (`id_locatie`);

--
-- Indexuri pentru tabele `marci`
--
ALTER TABLE `marci`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indexuri pentru tabele `modele`
--
ALTER TABLE `modele`
  ADD PRIMARY KEY (`id_model`);

--
-- Indexuri pentru tabele `motoare`
--
ALTER TABLE `motoare`
  ADD PRIMARY KEY (`id_motor`);

--
-- Indexuri pentru tabele `transmisii`
--
ALTER TABLE `transmisii`
  ADD PRIMARY KEY (`id_transmisie`);

--
-- Indexuri pentru tabele `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `autovehicule`
--
ALTER TABLE `autovehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pentru tabele `categorii_autovehicule`
--
ALTER TABLE `categorii_autovehicule`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `combustibili`
--
ALTER TABLE `combustibili`
  MODIFY `id_combustibil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `inchirieri`
--
ALTER TABLE `inchirieri`
  MODIFY `id_inchirieri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT pentru tabele `locatii`
--
ALTER TABLE `locatii`
  MODIFY `id_locatie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pentru tabele `marci`
--
ALTER TABLE `marci`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `modele`
--
ALTER TABLE `modele`
  MODIFY `id_model` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pentru tabele `motoare`
--
ALTER TABLE `motoare`
  MODIFY `id_motor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pentru tabele `transmisii`
--
ALTER TABLE `transmisii`
  MODIFY `id_transmisie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
