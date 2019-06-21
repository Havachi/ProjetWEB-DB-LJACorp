-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           8.0.16 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Export de la structure de la base pour snows
CREATE DATABASE IF NOT EXISTS `snows` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `snows`;

-- Export de la structure de la table snows. locations
CREATE TABLE IF NOT EXISTS `locations` (
  `IDLoc` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_IDUser` int(10) unsigned NOT NULL,
  `DateLocStart` date DEFAULT NULL,
  `DateLocEnd` date DEFAULT NULL,
  `LocStatus` smallint(2) DEFAULT NULL,
  PRIMARY KEY (`IDLoc`),
  KEY `FK_IDUser` (`FK_IDUser`),
  CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`FK_IDUser`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table snows.locations : ~0 rows (environ)
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` (`IDLoc`, `FK_IDUser`, `DateLocStart`, `DateLocEnd`, `LocStatus`) VALUES
	(1, 3, '2019-06-17', '2019-06-17', 1);
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;

-- Export de la structure de la table snows. orderedsnow
CREATE TABLE IF NOT EXISTS `orderedsnow` (
  `IDOrder` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_IDLoc` int(10) unsigned NOT NULL,
  `FK_IDSnow` int(11) NOT NULL,
  `DateOrderEnd` date DEFAULT NULL,
  `QtyOrder` smallint(6) DEFAULT NULL,
  `NbDOrder` smallint(6) DEFAULT NULL,
  `OrderStatus` smallint(2) DEFAULT NULL,
  PRIMARY KEY (`IDOrder`),
  KEY `FK_IDLoc` (`FK_IDLoc`),
  KEY `FK_IDSnow` (`FK_IDSnow`),
  CONSTRAINT `orderedsnow_ibfk_1` FOREIGN KEY (`FK_IDLoc`) REFERENCES `locations` (`IDLoc`),
  CONSTRAINT `orderedsnow_ibfk_2` FOREIGN KEY (`FK_IDSnow`) REFERENCES `snows` (`snowID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Export de données de la table snows.orderedsnow : ~0 rows (environ)
/*!40000 ALTER TABLE `orderedsnow` DISABLE KEYS */;
INSERT INTO `orderedsnow` (`IDOrder`, `FK_IDLoc`, `FK_IDSnow`, `DateOrderEnd`, `QtyOrder`, `NbDOrder`, `OrderStatus`) VALUES
	(1, 1, 1, '2019-06-17', 1, 1, 0),
	(2, 1, 2, '2019-06-17', 1, 1, 1),
	(3, 1, 3, '2019-06-17', 1, 1, 1);
/*!40000 ALTER TABLE `orderedsnow` ENABLE KEYS */;

-- Export de la structure de la table snows. snows
CREATE TABLE IF NOT EXISTS `snows` (
  `snowID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `model` varchar(30) NOT NULL,
  `snowLength` int(4) unsigned NOT NULL,
  `qtyAvailable` smallint(6) NOT NULL DEFAULT '0',
  `description` varchar(200) NOT NULL DEFAULT '0',
  `dailyPrice` float unsigned NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `active` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`snowID`),
  UNIQUE KEY `snow_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Export de données de la table snows.snows : ~9 rows (environ)
/*!40000 ALTER TABLE `snows` DISABLE KEYS */;
INSERT INTO `snows` (`snowID`, `code`, `brand`, `model`, `snowLength`, `qtyAvailable`, `description`, `dailyPrice`, `photo`, `active`) VALUES
	(1, 'B101', 'Burton', 'Custom', 160, 22, 'La board la plus fiable de tous les temps, la solution snowboard pour tous les terrains. (Homme)', 29, 'view/content/images/B101_small.jpg', 1),
	(2, 'B126', 'Burton', 'Free Thinker', 165, 2, 'Élargissez votre vision grâce son interprétation du ride tout terrain dynamique sur la poudreuse. (Homme)', 45, 'view/content/images/B126_small.jpg', 1),
	(3, 'B327', 'Burton', 'Day Trader', 155, 6, 'Flottabilité sans effort et un contrôle qui renforce la confiance en soi. (Femme)', 25, 'view/content/images/B327_small.jpg', 0),
	(4, 'K266', 'K2', 'Wildheart', 152, 2, 'Keeping in versatile style (Femme)', 29, 'view/content/images/K266_small.jpg', 1),
	(5, 'N100', 'Nidecker', 'Tracer', 164, 11, 'Une expérience de carve hors du commun. Idéal pour carver comme jamais (Homme et femme)', 39, 'view/content/images/N100_small.jpg', 1),
	(6, 'N754', 'Nidecker', 'Ultralight', 166, 26, 'A la pointe de la technologie. Idéal pour le freeride sur les faces engagées (Homme et femme)', 59, 'view/content/images/N754_small.jpg', 1),
	(7, 'P067', 'Prior', 'Brandwine 153', 154, 9, 'High performance, directional Freeride board, draws a smooth, stable and fast line through all snow conditions. (Femme)', 49, 'view/content/images/P067_small.jpg', 1),
	(8, 'P165', 'Prior', 'BC Split 161', 169, 1, 'Sa forme directionnelle Freeride offre une ride plutôt douce et stable dans une variété de conditions', 35, 'view/content/images/P165_small.jpg', 1),
	(9, 'K409', 'K2', 'Lime Lite', 149, 15, 'Best For Freestyle Evolution with a Focus on Fun (Femme)', 55, 'view/content/images/K409_small.jpg', 1);
/*!40000 ALTER TABLE `snows` ENABLE KEYS */;

-- Export de la structure de la table snows. users
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userEmailAddress` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `userHashPsw` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `userType` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userEmailAddress` (`userEmailAddress`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table snows.users : ~0 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`userID`, `userEmailAddress`, `userHashPsw`, `userType`) VALUES
	(3, 'user@user.ch', '$2y$10$fkZm/UIpNV4t51CLCno8JO0tBQaT.UXXlooJakkSnUM2P72YR0vae', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
