-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 23 nov. 2021 à 17:13
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `manga`
--

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

CREATE TABLE `manga` (
  `id` tinyint(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(60) NOT NULL,
  `description` varchar(6000) NOT NULL,
  `publish_date` date NOT NULL,
  `cover` varchar(255) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `promote` tinyint(1) NOT NULL,
  `category` varchar(35) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`id`, `title`, `author`, `description`, `publish_date`, `cover`, `price`, `promote`, `category`, `stock`) VALUES
(2, 'One Piece', 'Eiichirō Oda', 'L\'histoire suit les aventures de Monkey D. Luffy, un garçon dont le corps a acquis les propriétés du caoutchouc après avoir mangé par inadvertance un fruit du démon.', '2021-11-23', 'https://photos.tf1.fr/350/466/vignette-portrait-one-piece-4539bb-7f7f7a-0@1x.webp', '7.85', 1, 'shonen', 10);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(1, 'admin', 'Admin31#', 'admin@admin.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `manga`
--
ALTER TABLE `manga`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
