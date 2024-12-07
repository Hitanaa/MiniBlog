-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 13 nov. 2024 à 18:11
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `miniblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `commentid` bigint NOT NULL AUTO_INCREMENT,
  `comments` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `commentuser` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `commentdate` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`commentid`, `comments`, `commentuser`, `post_id`, `commentdate`) VALUES
(5, 'Incroyable, elle est trop belle ! J\'achète', 'exemple@gmail.com', '41', '13/11/24 - 17:09'),
(6, 'J\'adore cette nouveauté, merci d\'avoir partagé ça !', 'exemple@gmail.com', '40', '13/11/24 - 17:09'),
(7, 'J\'adore cette chaussure ', 'exemple@gmail.com', '39', '13/11/24 - 17:09'),
(8, 'Elle est trop moche', 'exemple2@gmail.com', '41', '13/11/24 - 17:12'),
(9, 'J\'aime pas du tout', 'exemple2@gmail.com', '40', '13/11/24 - 17:12'),
(10, 'Encore une chaussure moche.. déçu', 'exemple2@gmail.com', '38', '13/11/24 - 17:13');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `postid` bigint NOT NULL AUTO_INCREMENT,
  `posttitle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `postcontent` varchar(1500) COLLATE utf8mb4_general_ci NOT NULL,
  `postimage` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `postdate` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `postauthor` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `update_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`postid`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`postid`, `posttitle`, `postcontent`, `postimage`, `postdate`, `postauthor`, `update_date`) VALUES
(38, 'Air Max Plus TN Blanches', 'Revendiquez votre côté rebelle avec la Nike Air Max Plus, un modèle Air novateur qui offre une stabilité optimale et un amorti exceptionnel. Avec son mesh respirant, elle présente les lignes ondulées ainsi que les détails en TPU poli sur la pointe et les côtés du modèle d\'origine pour mettre en valeur votre style audacieux.', 'img_6734da5c9a3ee1.82628905.jpg', '13/11/24 - 16:57', 'admin@gmail.com', ''),
(39, 'Nike Air Force 1\'07', 'Le charme continue d\'opérer avec la Air Force 1 \'07. Cette silhouette emblématique du basket revisite ses éléments les plus célèbres : les matières épurées, les couleurs vives et juste ce qu\'il faut d\'éclat pour briller sur le terrain.', 'img_6734dab097e4d5.30727246.jpg', '13/11/24 - 16:58', 'admin@gmail.com', ''),
(40, 'Air Jordan 1 Low', 'Toujours stylée, toujours tendance. Fidèle à l\'histoire et à l\'héritage de Jordan, la Air Jordan 1 Low t\'offre un confort optimal tout au long de la journée. Choisis tes couleurs et démarque-toi grâce à sa silhouette emblématique conçue dans un mélange de matières haut de gamme et agrémentée d\'une unité Air encapsulée au talon.', 'img_6734daff871f87.20627729.jpg', '13/11/24 - 16:59', 'admin@gmail.com', ''),
(41, 'Nike Dunk Low Retro', 'La Dunk est historiquement la chaussure préférée des équipes universitaires. Le pack « Be True To Your School » rend hommage à cet héritage en faisant revivre la première campagne promotionnelle de cette icône. Les couleurs représentent les grandes universités, tandis que le cuir impeccable ajoute la touche d\'éclat parfaite pour illuminer ta voie vers la victoire. Alors, lace tes chaussures et laisse parler ta fierté. C\'est parti ?', 'img_6734db48bb1503.23245481.jpg', '13/11/24 - 17:00', 'admin@gmail.com', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usersid` int NOT NULL AUTO_INCREMENT,
  `useremail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `userpassword` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `userstatus` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `userpic` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`usersid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`usersid`, `useremail`, `username`, `userpassword`, `userstatus`, `userpic`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$m.4zMgT0DMhcu12OWbK23.A/5L9xe0ZFlONHj9zIkxabTFg9fsMza', 'admin', ''),
(22, 'exemple@gmail.com', 'exemple', '$2y$10$XBcseubaYRyms3LpDd8JjOEMnElSEXWlgaFTrMBQ2cDSgOv87OyEO', 'user', 'userpic_6734dcf440b48.jpg'),
(23, 'exemple2@gmail.com', 'exemple2', '$2y$10$pdFHf7rp/RUjjxSYtlgcReB6UpN00mJbmFqMxF7/RIbXK7/b.ogcK', 'user', 'userpic_6734ddfbaa120.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
