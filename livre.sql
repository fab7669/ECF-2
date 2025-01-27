-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 jan. 2025 à 12:39
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `livre`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `message`, `id_user`, `date`) VALUES
(1, 'une belle journée', 1, '2025-01-20 10:20:04'),
(2, 'une belle journée', 1, '2025-01-19 10:20:20'),
(3, 'une belle nuit pour aller se promener sous la lune !............', 2, '2025-01-06 10:20:27'),
(5, 'une belle après midi', 3, '2025-01-21 10:20:40'),
(6, 'une belle après midi', 3, '2025-01-21 10:20:44'),
(66, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500.', 7, '2025-01-23 07:11:44'),
(67, 'Une petite virée en moto prévue vendredi après midi avec des amis, ca fait du bien, c\'est cool !', 7, '2025-01-23 07:30:57'),
(71, 'c\'est une belle journée pour faire de la moto au soleil sous le vent !', 7, '2025-01-24 07:50:02'),
(72, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500', 7, '2025-01-24 08:40:50'),
(74, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression..', 2, '2025-01-24 12:09:24');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`) VALUES
(1, 'titi', 'titi@gmail.com', '$2y$10$drOMhwV835vW2v8FusBt0.1.cNpTRBbt7GvgwLfh7aOeY1C70a0Za'),
(2, 'tata', 'tata@gmail.com', '$2y$10$i9Gef5NyJ51qaay6HKIAJupRg3XuRJNxRcgf2BJJnr8t.UXr5aiGq'),
(3, 'godart', 'fabien7669@gmail.com', '$2y$10$POopICTv05nhrXBqB68X/uyn9KNdsvHOwgk2YftPxM41d8I9pPgJ6'),
(4, '[tata]', '[tata.gmail.com]', '[tata]'),
(5, 'toto', 'toto@gmail.com', '$2y$10$vlqRdYjtzMjeVY/PYKmByedMoHkFFJM0oaxs2tGg.XchQa1GaNkOy'),
(6, 'Valentin', 'valentingillot@gmail.com', '$2y$10$w2zBUFkAFAXTrk1oESti1.M792K75Zb3VlnyFJCbVDjq/soCrYLzG'),
(7, 'fabien', 'fabienetbarbara@cegetel.net', '$2y$10$A1ZnU2vGP5f5zC3y8Zr9..rn0cx4jNhif/iM54Gw/LDWoWTMgDJiG'),
(8, 'godart', 'godart@gmail.com', '$2y$10$A75CtteIJ/nTTn2dH2vXZeYKYtRMnDlMnKuY0XFIYX3tuZ2dYuiBO'),
(9, 'ducon', 'ffqf@gmail.com', '$2y$10$w5fjRvtJa1YH6lWCJu18SeUX9lUhBAI0AqKWgBgTGmsaBxP4dLHP.'),
(10, 'essai', 'ducon@d.com', '$2y$10$hDt54e5PsgB8FkD4.HPQ5OBAGO855h5JAGHpkQ/K6IzQgqLsSO9o.');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
