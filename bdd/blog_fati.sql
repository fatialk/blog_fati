-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 31 oct. 2023 à 23:49
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.13
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Base de données : `blog_fati`
--
-- --------------------------------------------------------
--
-- Structure de la table `comment`
--
DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `approved` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`user_id`) USING BTREE,
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
-- Déchargement des données de la table `comment`
--
INSERT INTO `comment` (`id`, `user_id`, `post_id`, `description`, `created_at`, `updated_at`, `approved`) VALUES
(21, 18, 16, 'TEST', '2023-10-27 15:29:27', '2023-10-27 15:29:27', 1),
(26, 25, 20, 'test', '2023-10-31 23:29:44', '2023-10-31 23:29:44', 0);
-- --------------------------------------------------------
--
-- Structure de la table `contact`
--
DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
-- --------------------------------------------------------
--
-- Structure de la table `post`
--
DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `chapo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
-- Déchargement des données de la table `post`
--
INSERT INTO `post` (`id`, `user_id`, `title`, `chapo`, `description`, `created_at`, `updated_at`) VALUES
(16, 17, 'Mojo : le langage de programmation pour IA plus rapide que Python', 'Créé par l’entreprise Modular AI, cet outil suscite un vif intérêt chez les programmeurs en raison de ses nombreux atouts. Simplicité d’utilisation, polyvalence, belles capacités, Mojo a tout pour plaire !', 'Mojo est un langage de programmation développé par Modular IA, une entreprise d’infrastructure IA fondée par Chris Lattner. Il se présente comme une réponse aux besoins spécifiques des développeurs en matière d’intelligence artificielle, d’automatisation et de systèmes embarqués.\r\n\r\nGrâce à sa syntaxe simple et intuitive, Mojo permet aux programmeurs d’écrire du code avec rapidité et efficacité. Il assure en retour d’excellentes performances. Ces deux avantages font de ce langage un outil réellement compétitif pour le développement web.\r\n\r\nEn termes de vitesse d’exécution, Mojo surpasse Python. Ses créateurs affirment qu’il est 35 000 fois plus rapide. Cela s’explique par le fait qu’il associe la simplicité de ce langage à la performance de C/C+. De ce fait, Mojo est très complet et promet donc d’excellents résultats à l’utilisation. ', '2023-10-27', '2023-10-30'),
(19, 17, 'Le grand décollage des startups françaises dans la tech', 'Au cours de ces dernières années, les startups françaises ont acquis une grande réputation grâce à leur évolution fulgurante.', 'Le secteur de la tech en France a connu une croissance exponentielle au cours de la dernière décennie. En 2020, la France était classée 4è au rang européen et 14è au rang mondial en termes de capital-risque investi dans les startups.\r\n\r\nSelon le rapport annuel de France Digitale, le secteur de la tech en France a enregistré une croissance de 12 % en 2020, malgré la pandémie de Covid-19.\r\n\r\nHistoriquement, la France a été un pays reconnu pour son expertise dans des domaines tels que l’aéronautique, la pharmacie et l’automobile.\r\n\r\nCependant, la France a également produit plusieurs des plus grandes entreprises de la tech au monde, telles que Criteo, OVH Cloud et BlaBlaCar.\r\n\r\nCes entreprises ont joué un rôle important dans la création d’un écosystème florissant pour la tech en France.\r\n\r\nLes atouts de la France en matière de tech sont nombreux. Tout d’abord, elle possède une main-d’œuvre hautement qualifiée, grâce à un système éducatif de qualité et à une culture de l’innovation et de l’entrepreneuriat.\r\n\r\nDe plus, la France bénéficie d’un environnement réglementaire favorable à la création et au développement de startups, avec des incitations fiscales pour les investisseurs et les entrepreneurs.\r\n\r\nToutefois, il y a aussi des faiblesses à considérer. Tout d’abord, la France a traditionnellement été un marché difficile pour les startups, en raison de sa culture de la hiérarchie et de sa résistance au changement.', '2023-10-27', '2023-10-27'),
(20, 17, 'Quels sont liens entre le back end et le front end ?', 'Le front end et le back end désignent deux domaines spécifiques du développement web. Chacun d’eux possède des attributions qui lui sont propres.\r\n', 'Le développement front end et le développement back end sont tous deux des notions essentielles dans la construction d’un projet digital. Il n’en demeure pas moins que certaines différences fondamentales subsistent entre eux. En effet :\r\n\r\nLe développeur front end s’occupe du visuel, tandis que le développeur back end travaille en arrière-plan ;\r\nLe front end est la partie visible du site web, celle avec laquelle les utilisateurs interagissent. Il s’oppose par nature au back end qui est la partie du site ou de l’application que les utilisateurs ne peuvent pas voir :\r\nLes langages de programmation sont différents pour chaque spécialité. En front end, on utilise généralement le HTML, le CSS et le JavaScript, tandis qu’en back end, on utilise Python, C++, Java, ou PHP.\r\nCela dit, au-delà de ces différences, les actions du développeur front end et celles du développeur back end se complètent. L’un ne va pas sans l’autre.\r\n\r\nCes deux spécialistes codent dans une variété de langages informatiques. Il se servent aussi d’outils identiques, notamment les frameworks et les bibliothèques pour améliorer leur efficacité. Leur but est aussi le même : créer une application mobile ou un site web fonctionnel.', '2023-10-27', '2023-10-27');
-- --------------------------------------------------------
--
-- Structure de la table `user`
--
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` enum('admin','visitor','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `approved` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
-- Déchargement des données de la table `user`
--
INSERT INTO `user` (`id`, `role`, `name`, `email`, `password`, `approved`) VALUES
(17, 'user', 'kyn ', 'kiki@gmail.com', '6a1a46ca023d02adff34ff157cab7e18322534d256f57fa0ba2a4b047aff696e0889d93cbdec89c3e0b62143abe33c1f54295e30619a208431fea55d7abf9749', 1),
(18, 'user', 'soso', 'soso@gmail.com', '9ac5e9caff4458cc33f31702d1aa7502f3e45cf329aee3fafe6e344a4d9d6e3036a614e05f5b81fa3b9b1caba70fcd9c59328fc4d07a40dbe510d5abee93fdad', 0),
(25, 'user', 'rose', 'rose@gmail.com', '83211fc9dfe574ecd67f79327525a66f0197965f4432a2c761448004b7269881fbe50da6f3284a2db844d3aaa3c290b2db4e2a1eb022b920917bc582e0a8f302', 0);
--
-- Contraintes pour les tables déchargées
--
--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
