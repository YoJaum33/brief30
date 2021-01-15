-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 07 jan. 2021 à 09:05
-- Version du serveur :  8.0.22-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `micro-url`
--

-- --------------------------------------------------------

--
-- Structure de la table `assoc_mc_url`
--

CREATE TABLE `assoc_mc_url` (
  `id` int NOT NULL,
  `mc_id` int NOT NULL,
  `url_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mc`
--

CREATE TABLE `mc` (
  `id` int NOT NULL,
  `mc_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `mc`
--

INSERT INTO `mc` (`id`, `mc_id`) VALUES
(1, 'twitter'),
(2, 'reseau');

-- --------------------------------------------------------

--
-- Structure de la table `url`
--

CREATE TABLE `url` (
  `id` int NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `shortcut` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `url`
--

INSERT INTO `url` (`id`, `url`, `shortcut`, `datetime`, `description`) VALUES
(1, 'https://blog.journalduhacker.net/index.php?article303/fermeture-du-compte-twitter-du-journal-du-hacker', 'jdh-bye-twitter', '2021-01-07 08:52:33', 'le journal du hacker ferme son compte Twitter ');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `assoc_mc_url`
--
ALTER TABLE `assoc_mc_url`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mc_id` (`mc_id`),
  ADD KEY `url_id` (`url_id`);

--
-- Index pour la table `mc`
--
ALTER TABLE `mc`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `assoc_mc_url`
--
ALTER TABLE `assoc_mc_url`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `assoc_mc_url`
--
ALTER TABLE `assoc_mc_url`
  ADD CONSTRAINT `assoc_mc_url_ibfk_1` FOREIGN KEY (`url_id`) REFERENCES `url` (`id`),
  ADD CONSTRAINT `assoc_mc_url_ibfk_2` FOREIGN KEY (`mc_id`) REFERENCES `mc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
