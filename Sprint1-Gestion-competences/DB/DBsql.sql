-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 oct. 2023 à 10:29
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arbercompetences`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `Id` int(11) NOT NULL,
  `Reference` varchar(100) NOT NULL,
  `Code` varchar(100) NOT NULL,
  `Nom` text NOT NULL,
  `Description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`Id`, `Reference`, `Code`, `Nom`, `Description`) VALUES
(1, 'C1', 'Maquette', 'Maquetter une application mobile', ' Cette compétence vous permettra de concevoir des maquettes d\'applications mobiles, aidant ainsi à visualiser et à planifier l\'interface utilisateur'),
(2, 'C2', 'Base Données', 'Manipuler une base de données - perfectionnement', ' Cette compétence vous permettra de maîtriser la manipulation avancée des bases de données, ce qui est essentiel pour stocker et gérer des informations'),
(3, 'C3', 'back-end', 'Développer la partie back-end d’une application web ou web mobile - perfectionnement', 'Cette compétence vous permettra de créer et de gérer la logique côté serveur d\'applications web et mobiles avancées'),
(4, 'C4', 'Gestion', 'Collaborer à la gestion d’un projet informatique et à l’organisation de l’environnement de développement - perfectionnement', 'Cette compétence vous préparera à jouer un rôle essentiel dans la gestion de projets informatiques et l\'optimisation de l\'environnement de développement'),
(5, 'C5', 'mobile Native', 'Développer une application mobile native, with Android and React Native', 'Cette compétence vous permettra de créer des applications mobiles performantes pour les plateformes Android et React Native'),
(6, 'C6', 'Tests', 'Préparer et exécuter les plans de tests d’une application', 'Cette compétence vous aidera à élaborer des stratégies de test efficaces pour garantir la qualité des applications'),
(7, 'C7', 'Deploiement', 'Préparer et exécuter le déploiement d’une application web et mobile - perfectionnement', 'Cette compétence vous permettra de maîtriser le processus de déploiement d\'applications web et mobiles avancées');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `competences`
--
ALTER TABLE `competences`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
