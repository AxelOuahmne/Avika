-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 11 avr. 2022 à 17:52
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `styliste`
--
CREATE DATABASE IF NOT EXISTS `styliste` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `styliste`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(250) NOT NULL,
  `Classement` int(11) NOT NULL,
  `pere` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`ID`, `Nom`, `Classement`, `pere`) VALUES
(1, 'Femmes', 1, 0),
(2, 'Robes d\'été', 0, 1),
(3, 'Robes hiver', 0, 1),
(4, 'Robe soirée ', 0, 1),
(5, 'Enfants', 2, 0),
(6, 'Accessoires', 5, 0),
(7, 'Parfums', 4, 0),
(8, 'Mariage', 3, 0),
(9, 'Bijoux mariage', 0, 8),
(10, 'Robes d\'été fille', 0, 5),
(11, 'Robes hiver fille', 0, 5),
(12, 'Robes Fête filles', 0, 5),
(13, 'Sacs', 0, 6),
(14, 'Bijoux', 0, 6),
(15, 'Accessoires filles', 0, 6),
(16, 'Parfum blanc', 0, 7),
(17, 'Parfum royal', 0, 7),
(18, 'Robe Mriage', 0, 8);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `Commentaire_Id` int(11) NOT NULL,
  `Commentaire` text NOT NULL,
  `Satut` tinyint(4) NOT NULL,
  `Commentaire_Date` datetime NOT NULL,
  `Commentaire_Produit` int(11) NOT NULL,
  `Commentaire_Utilesateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`Commentaire_Id`, `Commentaire`, `Satut`, `Commentaire_Date`, `Commentaire_Produit`, `Commentaire_Utilesateur`) VALUES
(60, 'trop belle', 1, '2022-04-09 12:41:04', 56, 21),
(61, 'trop belle', 0, '2022-04-09 12:41:52', 56, 21),
(62, 'trop belle', 0, '2022-04-09 12:53:08', 56, 21),
(63, 'salam si mostapha', 1, '2022-04-09 13:44:48', 45, 21),
(64, 'salam si mostapha', 0, '2022-04-09 13:45:03', 45, 21),
(65, 'salam si mostapha', 0, '2022-04-09 13:45:38', 45, 21),
(66, 'salam si mostapha', 0, '2022-04-09 13:46:31', 45, 21),
(67, 'salam si mostapha', 0, '2022-04-09 13:48:39', 45, 21),
(68, 'salam si mostapha', 0, '2022-04-09 13:48:51', 45, 21),
(69, 'salam si mostapha', 0, '2022-04-09 13:49:36', 45, 21),
(70, 'salam si mostapha', 0, '2022-04-09 13:49:56', 45, 21),
(71, 'salam si mostapha', 0, '2022-04-09 13:50:44', 45, 21),
(72, 'salam si mostapha', 0, '2022-04-09 13:51:11', 45, 21),
(73, 'salam si mostapha', 0, '2022-04-09 13:51:44', 45, 21),
(74, 'salam si mostapha', 0, '2022-04-09 13:52:18', 45, 21),
(75, 'salam si mostapha', 0, '2022-04-09 13:52:39', 45, 21),
(76, 'salam si mostapha', 0, '2022-04-09 13:52:57', 45, 21),
(77, 'salam si mostapha', 0, '2022-04-09 13:53:40', 45, 21),
(78, 'salam si mostapha', 0, '2022-04-09 13:55:29', 45, 21),
(79, 'salam si mostapha', 0, '2022-04-09 13:56:27', 45, 21),
(80, 'salam si mostapha', 0, '2022-04-09 13:56:48', 45, 21),
(81, 'salam si mostapha', 0, '2022-04-09 13:57:06', 45, 21),
(82, 'salam si mostapha', 0, '2022-04-09 13:57:29', 45, 21),
(83, 'salam si mostapha', 0, '2022-04-09 13:57:45', 45, 21),
(84, 'salam si mostapha', 0, '2022-04-09 13:58:29', 45, 21),
(85, 'salam si mostapha', 0, '2022-04-09 13:58:58', 45, 21),
(86, 'salam si mostapha', 0, '2022-04-09 13:59:13', 45, 21),
(87, 'salam si mostapha', 0, '2022-04-09 13:59:34', 45, 21),
(88, 'salam si mostapha', 0, '2022-04-09 13:59:48', 45, 21),
(89, 'salam si mostapha', 0, '2022-04-09 14:00:04', 45, 21),
(90, 'salam si mostapha', 0, '2022-04-09 14:00:45', 45, 21),
(91, 'salam si mostapha', 0, '2022-04-09 14:01:18', 45, 21),
(92, 'salam si mostapha', 0, '2022-04-09 14:01:29', 45, 21),
(93, 'salam si mostapha', 0, '2022-04-09 14:02:26', 45, 21),
(94, 'salam si mostapha', 0, '2022-04-09 14:02:43', 45, 21),
(95, 'salam si mostapha', 0, '2022-04-09 14:03:47', 45, 21),
(96, 'salam si mostapha', 0, '2022-04-09 14:04:07', 45, 21),
(97, 'salam si mostapha', 0, '2022-04-09 14:04:37', 45, 21),
(98, 'salam si mostapha', 0, '2022-04-09 14:04:58', 45, 21),
(99, 'salam si mostapha', 0, '2022-04-09 14:05:08', 45, 21),
(100, 'salam si mostapha', 0, '2022-04-09 14:05:24', 45, 21),
(101, 'salam si mostapha', 0, '2022-04-09 14:05:42', 45, 21),
(102, 'salam si mostapha', 0, '2022-04-09 14:06:08', 45, 21),
(103, 'salam si mostapha', 0, '2022-04-09 14:06:11', 45, 21),
(104, 'salam si mostapha', 0, '2022-04-09 14:06:20', 45, 21),
(105, 'salam si mostapha', 0, '2022-04-09 14:07:18', 45, 21),
(106, 'salam si mostapha', 0, '2022-04-09 14:07:41', 45, 21),
(107, 'salam si mostapha', 0, '2022-04-09 14:08:33', 45, 21),
(108, 'salam si mostapha', 1, '2022-04-09 14:09:17', 45, 21),
(109, 'salam si mostapha', 0, '2022-04-09 14:10:02', 45, 21),
(110, 'salam si mostapha', 0, '2022-04-09 14:10:44', 45, 21),
(111, 'salam si mostapha', 0, '2022-04-09 14:10:53', 45, 21),
(113, 'couc', 0, '2022-04-09 14:11:21', 45, 21),
(114, 'couc', 0, '2022-04-09 14:11:47', 45, 21),
(115, 'couc', 0, '2022-04-09 14:12:15', 45, 21),
(116, 'couc', 0, '2022-04-09 14:12:27', 45, 21),
(117, 'couc', 0, '2022-04-09 14:12:49', 45, 21),
(118, 'couc', 0, '2022-04-09 14:13:20', 45, 21),
(120, 'couc vvvv', 1, '2022-04-09 14:13:48', 45, 21),
(123, 'tre belle', 1, '2022-04-11 11:01:45', 10, 7);

-- --------------------------------------------------------

--
-- Structure de la table `contacter`
--

CREATE TABLE `contacter` (
  `ID_message` int(11) NOT NULL,
  `Message` text NOT NULL,
  `Tele` varchar(255) NOT NULL,
  `Date` datetime NOT NULL,
  `ID_Client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `Id_produit` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Pays_Production` varchar(255) NOT NULL,
  `Prix` int(11) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Solde` int(11) NOT NULL DEFAULT 0,
  `Taille` varchar(255) NOT NULL,
  `Categories_ID` int(11) NOT NULL,
  `Admin_ID` int(11) NOT NULL,
  `Date_production` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`Id_produit`, `Nom`, `Description`, `Image`, `Pays_Production`, `Prix`, `Stock`, `Solde`, `Taille`, `Categories_ID`, `Admin_ID`, `Date_production`) VALUES
(3, 'Robe d\'été pour les femmes', 'Robe dont le corsage rappelle la chemise d’homme, qui comporte généralement une ceinture et un boutonnage sur toute la longueur de devant.', '70156_3-ete.png', 'France', 2800, 5, 1, 'M', 2, 7, '2022-04-04 20:32:13'),
(5, 'Robe été', 'Robe dont le corsage rappelle la chemise d’homme, qui comporte généralement une ceinture et un boutonnage sur toute la longueur de devant.', '24686_5-ete.png', 'France', 1290, 14, 1, 'M', 2, 7, '2022-04-04 20:36:19'),
(7, 'Robe hiver pour  les femmes', 'Robe dont le corsage rappelle la chemise d’homme, qui comporte généralement une ceinture et un boutonnage sur toute la longueur de devant.', '59258_1-hiver.png', 'France', 2600, 26, 1, ' L', 3, 7, '2022-04-04 20:38:55'),
(8, 'Robe hiver', 'Robe dont le corsage rappelle la chemise d’homme, qui comporte généralement une ceinture et un boutonnage sur toute la longueur de devant.', '41884_2-hiver.png', 'Maroc', 1230, 6, 0, 'S', 3, 7, '2022-04-04 20:40:04'),
(9, 'Robe hiver', 'Robe dont le corsage rappelle la chemise d’homme, qui comporte généralement une ceinture et un boutonnage sur toute la longueur de devant.', '65288_3-hiver.png', 'France', 360, 10, 0, 'XL', 3, 7, '2022-04-04 20:41:05'),
(10, 'Robe hiver', 'Robe dont le corsage rappelle la chemise d’homme, qui comporte généralement une ceinture et un boutonnage sur toute la longueur de devant.', '7698_5-hiver.png', 'USA', 1700, 20, 0, 'M', 3, 7, '2022-04-04 20:42:00'),
(11, 'Robe hiver', 'Robe dont le corsage rappelle la chemise d’homme, qui comporte généralement une ceinture et un boutonnage sur toute la longueur de devant.', '14380_6-hiver.png', 'France', 1600, 12, 0, 'M', 3, 7, '2022-04-04 20:43:21'),
(12, 'Robe hiver ', 'Robe dont le corsage rappelle la chemise d’homme, qui comporte généralement une ceinture et un boutonnage sur toute la longueur de devant.', '93467_4-hiver.png', 'Maroc', 137, 23, 0, 'S', 3, 7, '2022-04-04 20:45:07'),
(13, 'Robes fille Volants Mignon Floral ', 'Une robe avec un super style ! Tous ses détails feront d\'elle une vraie princesse !\r\n\r\n- Robe volanté\r\n- Taille smockée\r\n- Col V avec ouverture à boutons\r\n- Manches courtes avec volants\r\n- Ouverture dos, goutte d\'eau\r\n- Base évasée\r\n- Contient du lin\r\n- En coton et en viscose ', '94147_1-hiver-f.png', 'France', 690, 10, 0, 'S', 11, 7, '2022-04-04 20:51:09'),
(16, 'Robe hiver', 'Une robe avec un super style ! Tous ses détails feront d\'elle une vraie princesse !\r\n\r\n- Robe volanté\r\n- Taille smockée\r\n- Col V avec ouverture à boutons\r\n- Manches courtes avec volants\r\n- Ouverture dos, goutte d\'eau\r\n- Base évasée\r\n- Contient du lin\r\n- En coton et en viscose ', '74465_3-hiver-f.png', 'France', 1290, 12, 0, 'S', 11, 7, '2022-04-04 20:57:30'),
(18, 'Robe hiver', 'Une robe avec un super style ! Tous ses détails feront d\'elle une vraie princesse !\r\n\r\n- Robe volanté\r\n- Taille smockée\r\n- Col V avec ouverture à boutons\r\n- Manches courtes avec volants\r\n- Ouverture dos, goutte d\'eau\r\n- Base évasée\r\n- Contient du lin\r\n- En coton et en viscose ', '82463_4-hiver-f.png', 'France', 256, 45, 0, 'XS', 11, 7, '2022-04-04 21:03:31'),
(20, 'Robe d\'été ', 'Une robe avec un super style ! Tous ses détails feront d\'elle une vraie princesse !\r\n\r\n- Robe volanté\r\n- Taille smockée\r\n- Col V avec ouverture à boutons\r\n- Manches courtes avec volants\r\n- Ouverture dos, goutte d\'eau\r\n- Base évasée\r\n- Contient du lin\r\n- En coton et en viscose\r\n- Imprimé fleuri all over avec fibres métallisées', '52181_1-fille-ete.png', 'France', 670, 12, 0, 'XS', 10, 7, '2022-04-04 21:33:12'),
(25, 'Robe été fille', 'Une robe avec un super style ! Tous ses détails feront d\'elle une vraie princesse !\r\n\r\n- Robe volanté\r\n- Taille smockée\r\n- Col V avec ouverture à boutons\r\n- Manches courtes avec volants\r\n- Ouverture dos, goutte d\'eau\r\n- Base évasée\r\n- Contient du lin\r\n- En coton et en viscose\r\n- Imprimé fleuri all over avec fibres métallisées', '75281_2-fille-ete.png', 'France', 1200, 17, 0, 'XS', 11, 7, '2022-04-04 21:53:27'),
(26, 'Robe été fille', 'Une robe avec un super style ! Tous ses détails feront d\'elle une vraie princesse !\r\n\r\n- Robe volanté\r\n- Taille smockée\r\n- Col V avec ouverture à boutons\r\n- Manches courtes avec volants\r\n- Ouverture dos, goutte d\'eau\r\n- Base évasée\r\n- Contient du lin\r\n- En coton et en viscose\r\n- Imprimé fleuri all over avec fibres métallisées', '76075_6-fille-ete.png', 'France', 690, 34, 0, 'L', 10, 7, '2022-04-04 21:55:09'),
(29, 'robe mariage', 'Robe de mariage sirène contrastant à broderie à tulle sans voile ', '14196_3-mariage.png', 'France', 4500, 45, 0, 'L', 18, 7, '2022-04-04 22:00:09'),
(32, 'robe mariage', 'Robe de mariage sirène contrastant à broderie à tulle sans voile ', '91041_6-mariage.png', 'France', 4500, 23, 0, 'L', 18, 7, '2022-04-04 22:03:10'),
(33, 'robe mariage', 'Robe de mariage sirène contrastant à broderie à tulle sans voile ', '22710_7-mariage.png', 'France', 1700, 23, 0, 'S', 18, 7, '2022-04-04 22:04:17'),
(34, '', 'Robe de mariage sirène contrastant à broderie à tulle sans voile ', '94092_8-mariage.png', 'France', 5670, 5, 1, ' ', 18, 7, '2022-04-04 22:05:03'),
(40, 'Parfum royal', '\r\nElie Saab\r\nLe Parfum Royal\r\nEau de Parfum\r\nEn stock\r\n60,43 €\r\n\r\n    Livraison Standard Offerte*  jeu. 07/04 - dim. 10/04\r\n    Emballage Cadeau Offert *.\r\n\r\nSkip to the end of the images gallery\r\nSkip to the beginning of the images gallery\r\nDescription\r\nLa royauté a une nouvelle fragrance : Le Parfum Royal.\r\nAudacieux, puissant et féminin, ce chypre floral ambré réinvente une nouvelle fois la signature olfactive Fleur d\'Oranger et Patchouli de la Maison. Une fragrance qui met à l\'honneur toutes les femmes en révélant leurs force, pouvoir et aura.\r\nCouronnée de Mandarine accompagnée d\'un accord lumineux, la fragrance révèle un coeur noble de Rose et de Néroli pour déroulée enfin sa majestueuse traine de Patchouli, Santal, Ambre et Vanille.', '42870_7.png', 'France', 690, 47, 0, '', 17, 7, '2022-04-04 22:31:21'),
(41, 'Parfum blanc', '\r\nElie Saab\r\nLe Parfum Royal\r\nEau de Parfum\r\nEn stock\r\n60,43 €\r\n\r\n    Livraison Standard Offerte*  jeu. 07/04 - dim. 10/04\r\n    Emballage Cadeau Offert *.\r\n\r\nSkip to the end of the images gallery\r\nSkip to the beginning of the images gallery\r\nDescription\r\nLa royauté a une nouvelle fragrance : Le Parfum Royal.\r\nAudacieux, puissant et féminin, ce chypre floral ambré réinvente une nouvelle fois la signature olfactive Fleur d\'Oranger et Patchouli de la Maison. Une fragrance qui met à l\'honneur toutes les femmes en révélant leurs force, pouvoir et aura.\r\nCouronnée de Mandarine accompagnée d\'un accord lumineux, la fragrance révèle un coeur noble de Rose et de Néroli pour déroulée enfin sa majestueuse traine de Patchouli, Santal, Ambre et Vanille.', '40523_Un-Jardin-sur-la-Lagune---Eau-de-toilette.png', 'France', 258, 14, 0, '', 16, 7, '2022-04-04 22:32:29'),
(43, 'Parfum royal', '\r\nElie Saab\r\nLe Parfum Royal\r\nEau de Parfum\r\nEn stock\r\n60,43 €\r\n\r\n    Livraison Standard Offerte*  jeu. 07/04 - dim. 10/04\r\n    Emballage Cadeau Offert *.\r\n\r\nSkip to the end of the images gallery\r\nSkip to the beginning of the images gallery\r\nDescription\r\nLa royauté a une nouvelle fragrance : Le Parfum Royal.\r\nAudacieux, puissant et féminin, ce chypre floral ambré réinvente une nouvelle fois la signature olfactive Fleur d\'Oranger et Patchouli de la Maison. Une fragrance qui met à l\'honneur toutes les femmes en révélant leurs force, pouvoir et aura.\r\nCouronnée de Mandarine accompagnée d\'un accord lumineux, la fragrance révèle un coeur noble de Rose et de Néroli pour déroulée enfin sa majestueuse traine de Patchouli, Santal, Ambre et Vanille.', '34241_Parfum--Femme-Mon-Guerlain-Eau-de-Parfum-Intense-100-ml.png', 'France', 120, 45, 0, '', 17, 7, '2022-04-04 22:34:13'),
(44, 'Parfum royal', '\r\nElie Saab\r\nLe Parfum Royal\r\nEau de Parfum\r\nEn stock\r\n60,43 €\r\n\r\n    Livraison Standard Offerte*  jeu. 07/04 - dim. 10/04\r\n    Emballage Cadeau Offert *.\r\n\r\nSkip to the end of the images gallery\r\nSkip to the beginning of the images gallery\r\nDescription\r\nLa royauté a une nouvelle fragrance : Le Parfum Royal.\r\nAudacieux, puissant et féminin, ce chypre floral ambré réinvente une nouvelle fois la signature olfactive Fleur d\'Oranger et Patchouli de la Maison. Une fragrance qui met à l\'honneur toutes les femmes en révélant leurs force, pouvoir et aura.\r\nCouronnée de Mandarine accompagnée d\'un accord lumineux, la fragrance révèle un coeur noble de Rose et de Néroli pour déroulée enfin sa majestueuse traine de Patchouli, Santal, Ambre et Vanille.', '44479_2.png', 'France', 230, 23, 0, '', 17, 7, '2022-04-04 22:35:43'),
(45, 'Robe de cérémonie fille', 'Cette robe pour fillettes en col rond possède un corsage sans manches en dentelle, une jupe en tulle avec une doublure satinée qui arrive au genou et une ceinture détachable en satin. Elle convient parfaitement aux célébrations pour les filles adorables.', '39207_2120.png', 'France', 980, 20, 0, ' S M ', 5, 7, '2022-04-04 22:44:06'),
(48, 'robe d\'évènement', 'Cette robe pour fillettes en col rond possède un corsage sans manches en dentelle, une jupe en tulle avec une doublure satinée qui arrive au genou et une ceinture détachable en satin. Elle convient parfaitement aux célébrations pour les filles adorables.', '32038_fetes-6.png', 'France', 1200, 12, 0, '', 12, 7, '2022-04-04 22:50:37'),
(51, 'Bijoux  de mariage', 'Une couronne de pétales volants forme les boucles d’oreilles Lily : un design naturel qui ne passe pas inaperçu ; elles sont délicatement polies et plaqué en or 18 ct, appartenant à une collection inspirée par la résistance et la délicatesse des plantes. En tant qu’ode au renouvellement, Blossom est la promesse d’un tout nouveau départ.', '26018_545.png', 'France', 100, 16, 0, '', 9, 7, '2022-04-04 23:27:11'),
(53, 'Bijoux mariage', 'Une couronne de pétales volants forme les boucles d’oreilles Lily : un design naturel qui ne passe pas inaperçu ; elles sont délicatement polies et plaqué en or 18 ct, appartenant à une collection inspirée par la résistance et la délicatesse des plantes. En tant qu’ode au renouvellement, Blossom est la promesse d’un tout nouveau départ.', '11862_h,jfy.png', 'USA', 90, 10, 0, '', 9, 7, '2022-04-04 23:29:56'),
(56, 'Bijoux  de mariage', 'Une couronne de pétales volants forme les boucles d’oreilles Lily : un design naturel qui ne passe pas inaperçu ; elles sont délicatement polies et plaqué en or 18 ct, appartenant à une collection inspirée par la résistance et la délicatesse des plantes. En tant qu’ode au renouvellement, Blossom est la promesse d’un tout nouveau départ.', '64697_m2.png', 'Maroc', 190, 10, 1, '', 9, 7, '2022-04-04 23:39:07'),
(57, 'Accessoires fille', '\r\n\r\nPour les jours de fête comme pour mettre de la fantaisie dans les tenues de tous les jours, ce joli headband est parfait ! Il sera la touche finale brillante pour une tenue pétillante...\r\n\r\n    Headband tressé\r\n    Rehaussé de 3 petits cœurs recouverts de sequins\r\n    Elastique inséré pour un maintien parfait \r\n\r\n', '49441_b-fille-3.png', 'France', 90, 20, 0, '', 15, 7, '2022-04-04 23:45:15'),
(58, 'Accessoires fille', '\r\n\r\nPour les jours de fête comme pour mettre de la fantaisie dans les tenues de tous les jours, ce joli headband est parfait ! Il sera la touche finale brillante pour une tenue pétillante...\r\n\r\n    Headband tressé\r\n    Rehaussé de 3 petits cœurs recouverts de sequins\r\n    Elastique inséré pour un maintien parfait \r\n\r\n', '82049_b-fille-6.png', 'France', 75, 15, 1, '', 15, 7, '2022-04-04 23:46:13'),
(59, 'Accessoires fille', '\r\n\r\nPour les jours de fête comme pour mettre de la fantaisie dans les tenues de tous les jours, ce joli headband est parfait ! Il sera la touche finale brillante pour une tenue pétillante...\r\n\r\n    Headband tressé\r\n    Rehaussé de 3 petits cœurs recouverts de sequins\r\n    Elastique inséré pour un maintien parfait \r\n\r\n', '4347_b-fille-7.png', 'France', 150, 10, 0, '', 15, 7, '2022-04-04 23:47:06'),
(61, 'Accessoire', 'Pour les jours de fête comme pour mettre de la fantaisie dans les tenues de tous les jours, ce joli headband est parfait ! Il sera la touche finale brillante pour une tenue pétillante...\r\n\r\n    Headband tressé\r\n    Rehaussé de 3 petits cœurs recouverts de sequins\r\n    Elastique inséré pour un maintien parfait \r\n\r\n', '34046_b-filles-5.png', 'France', 89, 32, 0, '  ', 15, 7, '2022-04-04 23:50:10'),
(64, 'Accessoires fille', 'Pour les jours de fête comme pour mettre de la fantaisie dans les tenues de tous les jours, ce joli headband est parfait ! Il sera la touche finale brillante pour une tenue pétillante...\r\n\r\n    Headband tressé\r\n    Rehaussé de 3 petits cœurs recouverts de sequins\r\n    Elastique inséré pour un maintien parfait \r\n\r\n', '43537_bijoux-fille-1.png', 'France', 100, 5, 0, '', 15, 7, '2022-04-04 23:52:56'),
(81, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '67502_76054__1_1080x.png', 'france', 1500, 10, 0, 'M', 4, 7, '2022-04-11 16:45:39'),
(82, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '50791_76099__1_24cca98c-b9e8-4b62-bfab-c4ac6dedb7d6_1080x.png', 'france', 1000, 12, 0, 'unique', 4, 7, '2022-04-11 16:46:21'),
(83, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '18992_76101__1_1080x.png', 'france', 100, 20, 1, 'unique', 4, 7, '2022-04-11 16:48:21'),
(84, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '26388_76108__1_76529c42-9ffb-4038-9603-1f1bc16d14d4_1080x.png', 'france', 1600, 20, 0, 's', 4, 21, '2022-04-11 16:49:25'),
(85, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '90320_AotClothes.png', 'france', 1600, 18, 0, 'unique', 4, 7, '2022-04-11 16:50:18'),
(86, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '75792_Edward-Arsouni.png', 'france', 2600, 10, 0, 'M', 4, 7, '2022-04-11 16:51:09'),
(87, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '24869_jkhkb.png', 'france', 1200, 20, 0, 'unique', 4, 21, '2022-04-11 16:52:25'),
(88, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '69352_kjhnj.png', 'france', 2297, 10, 0, 'unique', 4, 7, '2022-04-11 16:53:00'),
(89, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '766_Menelwena-(1).png', 'france', 1500, 10, 0, 'unique', 4, 7, '2022-04-11 16:53:36'),
(90, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '39323_Miss-Grand-International-2021.png', 'france', 2498, 15, 0, 'M', 4, 7, '2022-04-11 16:54:12'),
(91, 'sac', 'Sac à main Balenciaga\r\n- Mélange de maille et de similicuir\r\n- Bas curviligne\r\n- Poignée sur le dessus\r\n- Bandoulière ajustable et amovible\r\n- Design façon empeigne de baskets\r\n- Lacets noués sur le dessus et les côtés\r\n- Fermoir aimanté clouté\r\n- Logo B sur le devant\r\n- Logo Balenciaga Upside Down brodé sur le côté\r\n- Poche arrière\r\n\r\nDimensions : H 33 x L 30,4 x P 11,9 cm', '75272_5bc2134bf109f5bc213364f3e4_3172facow.png', 'france', 1500, 20, 0, '', 13, 7, '2022-04-11 16:57:08'),
(92, 'sac', 'Sac à main Balenciaga\r\n- Mélange de maille et de similicuir\r\n- Bas curviligne\r\n- Poignée sur le dessus\r\n- Bandoulière ajustable et amovible\r\n- Design façon empeigne de baskets\r\n- Lacets noués sur le dessus et les côtés\r\n- Fermoir aimanté clouté\r\n- Logo B sur le devant\r\n- Logo Balenciaga Upside Down brodé sur le côté\r\n- Poche arrière\r\n\r\nDimensions : H 33 x L 30,4 x P 11,9 cm', '49249_1093148_w800h800cx398cy398.png', 'france', 150, 10, 0, '', 13, 21, '2022-04-11 16:57:42'),
(93, 'sac', 'Sac à main Balenciaga\r\n- Mélange de maille et de similicuir\r\n- Bas curviligne\r\n- Poignée sur le dessus\r\n- Bandoulière ajustable et amovible\r\n- Design façon empeigne de baskets\r\n- Lacets noués sur le dessus et les côtés\r\n- Fermoir aimanté clouté\r\n- Logo B sur le devant\r\n- Logo Balenciaga Upside Down brodé sur le côté\r\n- Poche arrière\r\n\r\nDimensions : H 33 x L 30,4 x P 11,9 cm', '40388_sac 1.png', 'france', 250, 10, 0, '', 13, 7, '2022-04-11 16:58:52'),
(94, 'sac', 'Sac à main Balenciaga\r\n- Mélange de maille et de similicuir\r\n- Bas curviligne\r\n- Poignée sur le dessus\r\n- Bandoulière ajustable et amovible\r\n- Design façon empeigne de baskets\r\n- Lacets noués sur le dessus et les côtés\r\n- Fermoir aimanté clouté\r\n- Logo B sur le devant\r\n- Logo Balenciaga Upside Down brodé sur le côté\r\n- Poche arrière\r\n\r\nDimensions : H 33 x L 30,4 x P 11,9 cm', '99938_sac-2.png', 'france', 250, 25, 0, '', 13, 21, '2022-04-11 16:59:38'),
(95, 'sac', 'Sac à main Balenciaga\r\n- Mélange de maille et de similicuir\r\n- Bas curviligne\r\n- Poignée sur le dessus\r\n- Bandoulière ajustable et amovible\r\n- Design façon empeigne de baskets\r\n- Lacets noués sur le dessus et les côtés\r\n- Fermoir aimanté clouté\r\n- Logo B sur le devant\r\n- Logo Balenciaga Upside Down brodé sur le côté\r\n- Poche arrière\r\n\r\nDimensions : H 33 x L 30,4 x P 11,9 cm', '88418_sac-3.png', 'france', 300, 12, 0, '', 13, 7, '2022-04-11 17:00:22'),
(96, 'sac', 'Sac à main Balenciaga\r\n- Mélange de maille et de similicuir\r\n- Bas curviligne\r\n- Poignée sur le dessus\r\n- Bandoulière ajustable et amovible\r\n- Design façon empeigne de baskets\r\n- Lacets noués sur le dessus et les côtés\r\n- Fermoir aimanté clouté\r\n- Logo B sur le devant\r\n- Logo Balenciaga Upside Down brodé sur le côté\r\n- Poche arrière\r\n\r\nDimensions : H 33 x L 30,4 x P 11,9 cm', '19000_sac-a-main-eden-taupe-loxwood.png', 'france', 600, 10, 0, '', 13, 21, '2022-04-11 17:00:51'),
(97, 'prfum', 'variation de N°5, le parfum mythique de ÉMILIE OUAHMANE, fut composé en 1922. Délicatement travaillé, son accord se révèle tendre, suave et poudré, comme un absolu de féminité.', '96630_Le-Parfum-30-ml-Eau-de-parfum-Elie-Saab-pas-cher,-comparez-les-prix.png', 'france', 250, 10, 0, '', 7, 21, '2022-04-11 17:04:40'),
(98, 'prfum', 'variation de N°5, le parfum mythique de ÉMILIE OUAHMANE, fut composé en 1922. Délicatement travaillé, son accord se révèle tendre, suave et poudré, comme un absolu de féminité.', '36300_Olympéa---Eau-de-Parfum.png', 'france', 120, 10, 0, '', 7, 7, '2022-04-11 17:05:33'),
(99, 'prfum', 'variation de N°5, le parfum mythique de ÉMILIE OUAHMANE, fut composé en 1922. Délicatement travaillé, son accord se révèle tendre, suave et poudré, comme un absolu de féminité.', '34647_3.png', 'france', 200, 10, 0, '', 7, 7, '2022-04-11 17:06:13'),
(100, 'prfum', 'variation de N°5, le parfum mythique de ÉMILIE OUAHMANE, fut composé en 1922. Délicatement travaillé, son accord se révèle tendre, suave et poudré, comme un absolu de féminité.', '28960_7.png', 'france', 230, 9, 1, '', 16, 7, '2022-04-11 17:06:48'),
(101, 'prfum', 'variation de N°5, le parfum mythique de ÉMILIE OUAHMANE, fut composé en 1922. Délicatement travaillé, son accord se révèle tendre, suave et poudré, comme un absolu de féminité.', '36638_5.png', 'france', 230, 23, 0, '', 16, 7, '2022-04-11 17:08:10'),
(102, 'prfum', 'variation de N°5, le parfum mythique de ÉMILIE OUAHMANE, fut composé en 1922. Délicatement travaillé, son accord se révèle tendre, suave et poudré, comme un absolu de féminité.', '36537_21.png', 'france', 120, 10, 0, '', 16, 7, '2022-04-11 17:10:00'),
(103, 'accessoires', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '94726_5d5b771f185a3jpg.png', 'france', 120, 10, 0, ' ', 14, 7, '2022-04-11 17:11:58'),
(104, 'accessoires', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '72556_5d6899fa9ce91jpg_1.png', 'france', 200, 10, 0, ' ', 14, 7, '2022-04-11 17:12:49'),
(105, 'bijoux', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '3276_bij-4.png', 'france', 50, 10, 0, '', 14, 7, '2022-04-11 17:14:43'),
(106, 'bijoux', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '28151_bij-3.png', 'france', 100, 10, 0, '', 14, 7, '2022-04-11 17:15:23'),
(107, 'bijoux', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '44179_bij-5.png', 'france', 150, 10, 1, '', 14, 21, '2022-04-11 17:16:07'),
(108, 'bijoux', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '41774_bij-6.png', 'france', 120, 18, 0, '', 14, 7, '2022-04-11 17:16:59'),
(110, 'accessoires', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '89230_bij-8.png', 'france', 100, 25, 0, '', 6, 7, '2022-04-11 17:18:57'),
(111, 'accessoires', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '1505_bij-9.png', 'france', 200, 20, 0, '', 6, 7, '2022-04-11 17:19:34'),
(112, 'accessoires', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '80674_bij-11.png', 'france', 300, 10, 0, '', 6, 21, '2022-04-11 17:20:27'),
(114, 'accessoires', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '42921_bij-10.png', 'france', 250, 25, 0, '', 6, 7, '2022-04-11 17:22:08'),
(115, 'accessoires', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '19993_bij-15.png', 'france', 150, 25, 0, '', 6, 21, '2022-04-11 17:22:45'),
(116, 'accessoires', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '13417_bij-14.png', 'france', 150, 10, 0, '', 6, 7, '2022-04-11 17:24:11'),
(117, 'accessoires filles', 'NOUVELLE COLLECTION LOVELY 2022 Craquez pour le cœur ex-voto décliné sur l\'ensemble des bijoux fantaisies de la collection Lovely, qui, associé au métal doré ou strassé en fait une ligne de bijoux étincelante ! Optez pour ces bijoux aux petits cœurs doux qui feront le cadeau idéal pour fêter la Saint Valentin ou célébrer l\'amour ! Tous nos bijoux fantaisie de la collection Kimberose sont façonnés à la main et imaginés par Manuelle la créatrice française de ÉMILIE OUAHMANE', '24119_bij-10.png', 'france', 250, 20, 0, '', 15, 7, '2022-04-11 17:25:07'),
(118, 'robe', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '62621_Miss-Grand-International-2021.png', 'france', 1500, 10, 0, 'unique', 1, 7, '2022-04-11 17:28:17'),
(119, 'accessoires', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '88245_76108__1_76529c42-9ffb-4038-9603-1f1bc16d14d4_1080x.png', 'france', 2500, 12, 0, 'unique', 1, 21, '2022-04-11 17:29:24'),
(120, 'robe', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '65991_1-ete.png', 'france', 125, 25, 0, 'M', 1, 7, '2022-04-11 17:33:22'),
(121, 'robe', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '81296_2-ete.png', 'france', 2500, 250, 0, 'M', 1, 7, '2022-04-11 17:34:16'),
(122, 'robe', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '32803_1-hiver.png', 'france', 2500, 12, 0, 'S M', 1, 7, '2022-04-11 17:34:56'),
(123, 'accessoires', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '27673_m3.png', 'france', 250, 15, 0, '', 1, 7, '2022-04-11 17:35:48'),
(124, 'accessoires', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '40233_m4.png', 'france', 250, 10, 0, '', 1, 7, '2022-04-11 17:36:26'),
(125, 'accessoires', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '52595_m4.png', 'france', 150, 21, 0, 'M', 8, 7, '2022-04-11 17:37:39'),
(126, 'accessoires', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '54506_m5.png', 'france', 250, 10, 0, '', 9, 21, '2022-04-11 17:38:34'),
(127, 'robe soiré', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '14597_1-fille-ete.png', 'france', 250, 12, 0, 'S', 12, 7, '2022-04-11 17:40:18'),
(128, 'robe soirée', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '7505_3-ete.png', 'france', 250, 10, 0, 'M', 2, 7, '2022-04-11 17:42:10'),
(129, 'robe', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '43204_6-fille-ete.png', 'france', 120, 10, 0, '', 5, 21, '2022-04-11 17:43:09'),
(130, 'robe', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '9507_4ete.png', 'france', 1250, 2, 0, '', 8, 7, '2022-04-11 17:44:20'),
(131, 'robe', 'LA DESCRIPTION Robe en coton blanc avec détails de volants en broderie anglaise, ornée d\'une breloque logo en métal. CARACTÉRISTIQUES • Coton • Broderie anglaise • Détails de volants • Charme logo doré MATÉRIEL 100% Coton INSTRUCTIONS D\'ENTRETIEN • Lavage doux à 30° • Ne pas blanchir • Ne pas sécher au sèche-linge • Repasser à basse température • Nettoyage à sec CODE PRODUIT 3Q1071P004101', '3437_1-mariage.png', 'france', 2500, 20, 0, 's', 8, 21, '2022-04-11 17:45:21');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `Id_utilisateur` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Avatar` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0,
  `Statut` int(11) NOT NULL DEFAULT 0,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Id_utilisateur`, `Nom`, `Prenom`, `Avatar`, `Email`, `Mdp`, `GroupID`, `Statut`, `Date`) VALUES
(7, 'Emilie', 'Ouahmane', '15322_WhatsApp Image 2022-04-02 at 22.02.51(1).jpeg', 'emilie@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, '2022-04-04'),
(20, 'adam', 'aadmi', '91065_24598_vector.png', 'adam@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, 1, '2022-04-08'),
(21, 'Ouahamne', 'mostapha', '12898_617_WhatsApp Image 2022-04-02 at 22.02.51.jpeg', 'ouhman.mostapha@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, '2022-04-08'),
(25, 'papa', 'papa', '61037_136016443_14855049720921n.png', 'papa@gmail.com', 'ce6cfda307ce7dfaf9dc26cead83bddad75db5a2', 0, 1, '2022-04-10'),
(26, 'colombbus', 'bachir', '19690_h3.png', 'sa@gmail.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 0, 1, '2022-04-11');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nom` (`Nom`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`Commentaire_Id`),
  ADD KEY `prduit_comments` (`Commentaire_Produit`),
  ADD KEY `comments_Categories` (`Commentaire_Utilesateur`);

--
-- Index pour la table `contacter`
--
ALTER TABLE `contacter`
  ADD PRIMARY KEY (`ID_message`),
  ADD KEY `ID_Client` (`ID_Client`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`Id_produit`),
  ADD KEY `Vendeur` (`Admin_ID`),
  ADD KEY `vent_Categories` (`Categories_ID`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`Id_utilisateur`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `Commentaire_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT pour la table `contacter`
--
ALTER TABLE `contacter`
  MODIFY `ID_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `Id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `Id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `comments_Categories` FOREIGN KEY (`Commentaire_Utilesateur`) REFERENCES `utilisateurs` (`Id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prduit_comments` FOREIGN KEY (`Commentaire_Produit`) REFERENCES `produits` (`Id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contacter`
--
ALTER TABLE `contacter`
  ADD CONSTRAINT `contacter_ibfk_1` FOREIGN KEY (`ID_Client`) REFERENCES `utilisateurs` (`Id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `Categories` FOREIGN KEY (`Categories_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Vendeur` FOREIGN KEY (`Admin_ID`) REFERENCES `utilisateurs` (`Id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
