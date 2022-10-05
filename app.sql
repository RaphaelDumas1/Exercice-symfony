-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 05 oct. 2022 à 10:08
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app`
--

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decription` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `degat` int(11) DEFAULT NULL,
  `stun` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_94D4687FC54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id`, `type_id`, `nom`, `decription`, `degat`, `stun`) VALUES
(1, 1, 'Coup d\'épée', 'Le barbare frappe avec son epee.', 10, 0);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221003194103', '2022-10-03 19:41:26', 509);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

DROP TABLE IF EXISTS `personnage`;
CREATE TABLE IF NOT EXISTS `personnage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` longtext COLLATE utf8mb4_unicode_ci,
  `niveau` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `endurance` int(11) NOT NULL,
  `intelligence` int(11) NOT NULL,
  `agilite` int(11) NOT NULL,
  `vie` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6AEA486DC54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnage`
--

INSERT INTO `personnage` (`id`, `type_id`, `nom`, `date_naissance`, `description`, `avatar`, `niveau`, `experience`, `endurance`, `intelligence`, `agilite`, `vie`) VALUES
(1, 4, 'test', '2022-10-26', 'test', '', 2, 400, 40, 12, 34, 45),
(4, 1, 'test', '2017-01-01', 'test', NULL, 23, 23, 23, 23, 23, 23);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `endurance_defaut` int(11) NOT NULL,
  `agilite_defaut` int(11) NOT NULL,
  `intelligence_defaut` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `nom`, `description`, `endurance_defaut`, `agilite_defaut`, `intelligence_defaut`) VALUES
(1, 'Barbare', 'Un type solide qui fonce dans le tas sans réfléchir et se caractérise par sa force impressionnante.', 60, 40, 10),
(4, 'Mage', 'Un type intelligent et ruse qui se démarque par sa puissante magie.', 30, 30, 80);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `competence`
--
ALTER TABLE `competence`
  ADD CONSTRAINT `FK_94D4687FC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD CONSTRAINT `FK_6AEA486DC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
