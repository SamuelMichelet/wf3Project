-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 05 nov. 2018 à 14:10
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `users`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` char(60) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `ip`, `date`, `name`, `firstname`) VALUES
(4, 'olivier@gmail.com', '$2y$10$6ItuAEZpJL3fczyrPeeuzeLz980RgD6Uqcd6fJ8w4xUEloQ6FxvvS', '::1', '2018-11-05', 'olivier', 'collin'),
(5, 'florent@gmail.com', '$2y$10$gRT2oE6WZsPtsDOLjMExluWIs/29eUwLch80O4XS/1Aid/cI3muCq', '::1', '2018-02-02', 'florent', 'florent'),
(6, 'ananas@gmail.com', '$2y$10$Io0pBrJ.DqYy.VzQwHpdCeClFK3.DfRlBLgX/55pHleHPAuRfuH3S', '::1', '1980-10-10', 'ananas', 'taieb');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
