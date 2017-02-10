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

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table feudalism. carte
CREATE TABLE IF NOT EXISTS `carte` (
  `carteId` int(11) NOT NULL AUTO_INCREMENT,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `joueurId` int(11) DEFAULT NULL,
  PRIMARY KEY (`carteId`)
) ENGINE=InnoDB AUTO_INCREMENT=401 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table feudalism. hero
CREATE TABLE IF NOT EXISTS `hero` (
  `heroId` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `joueurId` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`heroId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table feudalism. joueur
CREATE TABLE IF NOT EXISTS `joueur` (
  `joueurId` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) DEFAULT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`joueurId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
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
  PRIMARY KEY (`villageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
