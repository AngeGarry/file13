-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 13 avr. 2021 à 14:53
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `testing`
--

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `id_titre` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_administrateur` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `creation` datetime NOT NULL DEFAULT current_timestamp(),
  `maj` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `statut` enum('ouvert','ferme','resolu') NOT NULL DEFAULT 'ouvert',
  `priorite` enum('faible','moyen','eleve') DEFAULT NULL,
  `date_creation` date NOT NULL DEFAULT current_timestamp(),
  `date_resolu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`id`, `id_titre`, `id_utilisateur`, `id_administrateur`, `id_service`, `description`, `creation`, `maj`, `statut`, `priorite`, `date_creation`, `date_resolu`) VALUES
(1, 1, 2, 1, 4, 'Mon écran est noir, je ne peux rien voir', '2021-03-22 10:14:27', '2021-03-26 14:13:55', 'ouvert', 'faible', '2021-03-23', NULL),
(2, 4, 2, 1, 4, 'Le réseau est très lent', '2021-03-22 10:44:21', '2021-04-05 10:18:49', 'ouvert', 'moyen', '2021-03-23', NULL),
(3, 3, 2, 1, 4, 'Je ne sais pas', '2021-03-23 09:09:32', '2021-04-05 09:37:08', 'ferme', 'moyen', '2021-03-23', NULL),
(10, 1, 14, 1, 2, 'Mon ecran ne marche pas', '2021-03-30 09:53:30', '2021-04-05 10:19:38', 'ouvert', 'moyen', '2021-03-30', NULL),
(11, 1, 14, 1, 2, 'Autres', '2021-03-30 09:56:30', '2021-03-31 13:00:06', 'ouvert', 'eleve', '2021-03-30', NULL),
(12, 3, 12, 1, 4, 'Hello', '2021-04-01 10:13:15', '2021-04-01 10:56:25', 'ouvert', 'moyen', '0000-00-00', NULL),
(13, 3, 13, 1, 4, 'Hello', '2021-04-01 10:13:20', '2021-04-11 14:21:07', 'ouvert', 'eleve', '0000-00-00', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_titre` (`id_titre`,`id_utilisateur`,`id_administrateur`,`id_service`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
