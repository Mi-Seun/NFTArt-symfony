-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 15 oct. 2023 à 12:39
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `nft_back_v4`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_cat` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name_cat`) VALUES
(1, 'category1'),
(2, 'category2'),
(3, 'category3');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231014181336', '2023-10-15 10:40:42', 169);

-- --------------------------------------------------------

--
-- Structure de la table `eth`
--

DROP TABLE IF EXISTS `eth`;
CREATE TABLE IF NOT EXISTS `eth` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_eth` datetime NOT NULL,
  `value_eth` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nft`
--

DROP TABLE IF EXISTS `nft`;
CREATE TABLE IF NOT EXISTS `nft` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_nft` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `priceeth` int NOT NULL,
  `pathurl` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `nft`
--

INSERT INTO `nft` (`id`, `name_nft`, `priceeth`, `pathurl`, `description`) VALUES
(1, 'NFT-1', 500, 'image-2-652bcb8d0986b.webp', 'ddfdf'),
(2, 'NFT-2', 430, 'image-10-652bcbd1438aa.jpg', 'aaaaaaaaaa'),
(3, 'NFT-3', 5, 'image-8-652bcbf52f400.jpg', 'bbbbbbbbbbbbb');

-- --------------------------------------------------------

--
-- Structure de la table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name_sc` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DDCA44812469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `name_sc`) VALUES
(1, 1, 'sc1.1'),
(2, 1, 'sc1.2'),
(3, 2, 'sc2.1');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb3_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ismale` tinyint(1) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `datebirth` datetime NOT NULL,
  `adnum` int NOT NULL,
  `adstreet` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adcity` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adpostalcode` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `ismale`, `firstname`, `lastname`, `datebirth`, `adnum`, `adstreet`, `adcity`, `adpostalcode`) VALUES
(1, 'misun@jang.com', '[\"ROLE_SUPER_ADMIN\"]', '$2y$13$bEGjodxFxaS8nXfFP03pR.wrEGYHovAJ4wBCiCpwDz6YPau39Ha0m', 0, 'Mi-Sun', 'JANG', '2020-01-01 00:00:00', 3, 'Rue René', 'Lyon', '69001'),
(2, 'user1@com', '[]', '123456', 1, 'A', 'aa', '1930-01-01 00:00:00', 1, 'aa', 'aa', 'aa'),
(3, 'user2@com', '[]', '123456', 0, 'BBBB', 'BBB', '1930-01-01 00:00:00', 3, 'BBB', 'BB', 'BBB'),
(4, 'user3@com', '[]', '123456', 1, 'CCCCC', 'CCCC', '1930-01-01 00:00:00', 6, 'CCC', 'CC', 'CCC');

-- --------------------------------------------------------

--
-- Structure de la table `user_nft`
--

DROP TABLE IF EXISTS `user_nft`;
CREATE TABLE IF NOT EXISTS `user_nft` (
  `user_id` int NOT NULL,
  `nft_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`nft_id`),
  KEY `IDX_32D127B7A76ED395` (`user_id`),
  KEY `IDX_32D127B7E813668D` (`nft_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `user_nft`
--

INSERT INTO `user_nft` (`user_id`, `nft_id`) VALUES
(2, 1),
(3, 1),
(3, 2),
(4, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `FK_DDCA44812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `user_nft`
--
ALTER TABLE `user_nft`
  ADD CONSTRAINT `FK_32D127B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_32D127B7E813668D` FOREIGN KEY (`nft_id`) REFERENCES `nft` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
