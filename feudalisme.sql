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


-- Export de la structure de la base pour feudalism
CREATE DATABASE IF NOT EXISTS `feudalism` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `feudalism`;

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
  `joueurId` int(11) DEFAULT NULL,
  PRIMARY KEY (`carteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.carte : ~0 rows (environ)
DELETE FROM `carte`;
/*!40000 ALTER TABLE `carte` DISABLE KEYS */;
/*!40000 ALTER TABLE `carte` ENABLE KEYS */;

-- Export de la structure de la table feudalism. construction
CREATE TABLE IF NOT EXISTS `construction` (
  `constructionId` int(11) NOT NULL AUTO_INCREMENT,
  `batiment` varchar(50) DEFAULT NULL,
  `temps` varchar(50) DEFAULT NULL,
  `tempsDeb` varchar(50) DEFAULT NULL,
  `villageId` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`constructionId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.construction : ~0 rows (environ)
DELETE FROM `construction`;
/*!40000 ALTER TABLE `construction` DISABLE KEYS */;
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
  `mail` varchar(50) DEFAULT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `pass` text,
  `or` int(11) DEFAULT '0',
  PRIMARY KEY (`joueurId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.joueur : ~1 rows (environ)
DELETE FROM `joueur`;
/*!40000 ALTER TABLE `joueur` DISABLE KEYS */;
INSERT INTO `joueur` (`joueurId`, `mail`, `pseudo`, `pass`, `or`) VALUES
	(1, 'test', 'test', 'test', 0);
/*!40000 ALTER TABLE `joueur` ENABLE KEYS */;

-- Export de la structure de la table feudalism. village
CREATE TABLE IF NOT EXISTS `village` (
  `villageId` int(11) NOT NULL AUTO_INCREMENT,
  `joueurId` int(11) NOT NULL DEFAULT '0',
  `nom` varchar(50) DEFAULT NULL,
  `habitant` int(11) DEFAULT NULL,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table feudalism.village : ~0 rows (environ)
DELETE FROM `village`;
/*!40000 ALTER TABLE `village` DISABLE KEYS */;
INSERT INTO `village` (`villageId`, `joueurId`, `nom`, `habitant`, `x`, `y`, `chateau`, `caserne`, `ferme`, `mine`, `scierie`, `carriere`, `metal`, `bois`, `pierre`, `dernMaj`) VALUES
	(1, 1, 'village test', 500, 5, 5, 1, 1, 1, 20, 2, 1, 6072.94, 60.347, 46.4212, 1487082677);
/*!40000 ALTER TABLE `village` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
