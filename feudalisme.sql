-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.17-log - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la table feudalism. armee
CREATE TABLE IF NOT EXISTS `armee` (
  `armeId` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `heroId` int(11) DEFAULT NULL,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  PRIMARY KEY (`armeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.armee : ~0 rows (environ)
DELETE FROM `armee`;
/*!40000 ALTER TABLE `armee` DISABLE KEYS */;
/*!40000 ALTER TABLE `armee` ENABLE KEYS */;

-- Export de la structure de la table feudalism. carte
CREATE TABLE IF NOT EXISTS `carte` (
  `carteId` int(11) NOT NULL AUTO_INCREMENT,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `villageId` int(11) DEFAULT NULL,
  PRIMARY KEY (`carteId`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.carte : ~100 rows (environ)
DELETE FROM `carte`;
/*!40000 ALTER TABLE `carte` DISABLE KEYS */;
INSERT INTO `carte` (`carteId`, `x`, `y`, `type`, `villageId`) VALUES
	(1, 1, 1, 'plaine', NULL),
	(2, 2, 1, 'plaine', NULL),
	(3, 3, 1, 'plaine', NULL),
	(4, 4, 1, 'montagne', NULL),
	(5, 5, 1, 'plaine', NULL),
	(6, 6, 1, 'plaine', NULL),
	(7, 7, 1, 'plaine', 3),
	(8, 8, 1, 'plaine', NULL),
	(9, 9, 1, 'plaine', NULL),
	(10, 10, 1, 'montagne', NULL),
	(11, 1, 2, 'plaine', NULL),
	(12, 2, 2, 'foret', NULL),
	(13, 3, 2, 'foret', NULL),
	(14, 4, 2, 'montagne', NULL),
	(15, 5, 2, 'plaine', 4),
	(16, 6, 2, 'plaine', 2),
	(17, 7, 2, 'plaine', NULL),
	(18, 8, 2, 'plaine', NULL),
	(19, 9, 2, 'montagne', NULL),
	(20, 10, 2, 'plaine', NULL),
	(21, 1, 3, 'plaine', NULL),
	(22, 2, 3, 'foret', NULL),
	(23, 3, 3, 'plaine', NULL),
	(24, 4, 3, 'plaine', NULL),
	(25, 5, 3, 'plaine', NULL),
	(26, 6, 3, 'plaine', NULL),
	(27, 7, 3, 'montagne', NULL),
	(28, 8, 3, 'plaine', NULL),
	(29, 9, 3, 'montagne', NULL),
	(30, 10, 3, 'plaine', NULL),
	(31, 1, 4, 'plaine', NULL),
	(32, 2, 4, 'plaine', 5),
	(33, 3, 4, 'plaine', NULL),
	(34, 4, 4, 'plaine', NULL),
	(35, 5, 4, 'foret', NULL),
	(36, 6, 4, 'foret', NULL),
	(37, 7, 4, 'foret', NULL),
	(38, 8, 4, 'plaine', NULL),
	(39, 9, 4, 'plaine', NULL),
	(40, 10, 4, 'plaine', NULL),
	(41, 1, 5, 'plaine', NULL),
	(42, 2, 5, 'plaine', NULL),
	(43, 3, 5, 'plaine', NULL),
	(44, 4, 5, 'plaine', NULL),
	(45, 5, 5, 'plaine', NULL),
	(46, 6, 5, 'plaine', NULL),
	(47, 7, 5, 'plaine', NULL),
	(48, 8, 5, 'plaine', NULL),
	(49, 9, 5, 'plaine', NULL),
	(50, 10, 5, 'foret', NULL),
	(51, 1, 6, 'plaine', NULL),
	(52, 2, 6, 'montagne', NULL),
	(53, 3, 6, 'plaine', NULL),
	(54, 4, 6, 'montagne', NULL),
	(55, 5, 6, 'plaine', NULL),
	(56, 6, 6, 'plaine', NULL),
	(57, 7, 6, 'plaine', NULL),
	(58, 8, 6, 'plaine', NULL),
	(59, 9, 6, 'plaine', NULL),
	(60, 10, 6, 'plaine', NULL),
	(61, 1, 7, 'plaine', NULL),
	(62, 2, 7, 'plaine', NULL),
	(63, 3, 7, 'plaine', NULL),
	(64, 4, 7, 'plaine', NULL),
	(65, 5, 7, 'plaine', NULL),
	(66, 6, 7, 'plaine', NULL),
	(67, 7, 7, 'montagne', NULL),
	(68, 8, 7, 'plaine', NULL),
	(69, 9, 7, 'montagne', NULL),
	(70, 10, 7, 'plaine', NULL),
	(71, 1, 8, 'foret', NULL),
	(72, 2, 8, 'plaine', NULL),
	(73, 3, 8, 'montagne', NULL),
	(74, 4, 8, 'plaine', NULL),
	(75, 5, 8, 'foret', NULL),
	(76, 6, 8, 'plaine', NULL),
	(77, 7, 8, 'montagne', NULL),
	(78, 8, 8, 'plaine', NULL),
	(79, 9, 8, 'plaine', NULL),
	(80, 10, 8, 'plaine', NULL),
	(81, 1, 9, 'plaine', NULL),
	(82, 2, 9, 'plaine', NULL),
	(83, 3, 9, 'montagne', NULL),
	(84, 4, 9, 'plaine', NULL),
	(85, 5, 9, 'foret', NULL),
	(86, 6, 9, 'plaine', NULL),
	(87, 7, 9, 'montagne', NULL),
	(88, 8, 9, 'plaine', NULL),
	(89, 9, 9, 'foret', NULL),
	(90, 10, 9, 'plaine', NULL),
	(91, 1, 10, 'plaine', NULL),
	(92, 2, 10, 'plaine', NULL),
	(93, 3, 10, 'plaine', NULL),
	(94, 4, 10, 'plaine', NULL),
	(95, 5, 10, 'plaine', NULL),
	(96, 6, 10, 'plaine', NULL),
	(97, 7, 10, 'plaine', NULL),
	(98, 8, 10, 'plaine', NULL),
	(99, 9, 10, 'plaine', NULL),
	(100, 10, 10, 'plaine', NULL);
/*!40000 ALTER TABLE `carte` ENABLE KEYS */;

-- Export de la structure de la table feudalism. construction
CREATE TABLE IF NOT EXISTS `construction` (
  `constructionId` int(11) NOT NULL AUTO_INCREMENT,
  `batiment` varchar(50) DEFAULT NULL,
  `temps` int(11) DEFAULT NULL,
  `tempsDeb` int(11) DEFAULT NULL,
  `villageId` int(11) DEFAULT NULL,
  PRIMARY KEY (`constructionId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.construction : ~0 rows (environ)
DELETE FROM `construction`;
/*!40000 ALTER TABLE `construction` DISABLE KEYS */;
INSERT INTO `construction` (`constructionId`, `batiment`, `temps`, `tempsDeb`, `villageId`) VALUES
	(10, 'Scierie', 100, 1488374932, 5);
/*!40000 ALTER TABLE `construction` ENABLE KEYS */;

-- Export de la structure de la table feudalism. hero
CREATE TABLE IF NOT EXISTS `hero` (
  `heroId` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `joueurId` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`heroId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.hero : ~0 rows (environ)
DELETE FROM `hero`;
/*!40000 ALTER TABLE `hero` DISABLE KEYS */;
/*!40000 ALTER TABLE `hero` ENABLE KEYS */;

-- Export de la structure de la table feudalism. joueur
CREATE TABLE IF NOT EXISTS `joueur` (
  `joueurId` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `pass` text NOT NULL,
  `or` int(11) DEFAULT '0',
  PRIMARY KEY (`joueurId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.joueur : ~2 rows (environ)
DELETE FROM `joueur`;
/*!40000 ALTER TABLE `joueur` DISABLE KEYS */;
INSERT INTO `joueur` (`joueurId`, `mail`, `pseudo`, `pass`, `or`) VALUES
	(9, 'yolo@yolo.com', 'yolo', 'yolo', 0),
	(10, 'test@mail.com', 'test', 'test', 500),
	(11, 'skyli7h@gmail.com', 'SkyLi7h', '19Nino552886!', 0),
	(12, 'lastimperium@lastimperium.com', 'lastimperium', 'lastimperium', 0);
/*!40000 ALTER TABLE `joueur` ENABLE KEYS */;

-- Export de la structure de la table feudalism. village
CREATE TABLE IF NOT EXISTS `village` (
  `villageId` int(11) NOT NULL AUTO_INCREMENT,
  `joueurId` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(50) DEFAULT NULL,
  `habitant` int(11) DEFAULT NULL,
  `chateau` int(11) DEFAULT NULL,
  `caserne` int(11) DEFAULT NULL,
  `ferme` int(11) DEFAULT NULL,
  `mine` int(11) DEFAULT NULL,
  `scierie` int(11) DEFAULT NULL,
  `carriere` int(11) DEFAULT NULL,
  `metal` float DEFAULT NULL,
  `bois` float DEFAULT NULL,
  `pierre` float DEFAULT NULL,
  `dernMaj` int(11) DEFAULT NULL,
  PRIMARY KEY (`villageId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.village : ~3 rows (environ)
DELETE FROM `village`;
/*!40000 ALTER TABLE `village` DISABLE KEYS */;
INSERT INTO `village` (`villageId`, `joueurId`, `nom`, `habitant`, `chateau`, `caserne`, `ferme`, `mine`, `scierie`, `carriere`, `metal`, `bois`, `pierre`, `dernMaj`) VALUES
	(2, 9, 'Village de yolo', 100, 1, 0, 1, 1, 1, 1, 565.596, 565.596, 565.596, 1488195457),
	(3, 10, 'Village de test', 100, 1, 0, 1, 8, 10, 10, 14335.8, 21620.9, 15973.8, 1488375401),
	(4, 11, 'Village de SkyLi7h', 100, 1, 0, 1, 2, 4, 4, 76.313, 173.032, 345.236, 1488295277),
	(5, 12, 'Village de lastimperium', 100, 1, 0, 1, 1, 2, 1, 125.919, 19.42, 130.711, 1488374939);
/*!40000 ALTER TABLE `village` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
