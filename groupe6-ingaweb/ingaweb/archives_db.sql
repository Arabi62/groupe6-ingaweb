-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 06 juin 2024 à 22:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `archives_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

CREATE TABLE `enseignants` (
  `matricule_enseignant` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `date_naissance` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`matricule_enseignant`, `nom`, `prenom`, `date_naissance`, `created_at`) VALUES
('001e', 'Wohwe', 'Sambo Damien', '1986-02-02', '2024-05-30 20:04:29'),
('001ee', 'ens', 'ensg', '1989-06-13', '2024-06-05 11:19:04');

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `matricule_etudiant` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `date_naissance` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`matricule_etudiant`, `nom`, `prenom`, `date_naissance`, `created_at`) VALUES
('21a317fs', 'abdramane', 'bakhit abdramane', '2000-01-01', '2024-06-05 11:02:09'),
('21a392fs', 'arabi', 'mahamat saleh', '2000-04-21', '2024-05-30 20:05:51'),
('21a760fs', 'moubarack', 'youssouf ahmat', '2000-01-07', '2024-06-06 20:42:46'),
('21b145fs', 'ali', 'abakar ali', '2000-10-15', '2024-06-05 10:58:25');

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `code_matiere` varchar(10) NOT NULL,
  `nom_matiere` varchar(100) NOT NULL,
  `credit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`code_matiere`, `nom_matiere`, `credit`, `created_at`) VALUES
('inf322', 'ingaweb', 6, '2024-05-30 20:07:48'),
('inf336', 'ingenerie des application web', 6, '2024-06-05 11:10:53');

-- --------------------------------------------------------

--
-- Structure de la table `releves`
--

CREATE TABLE `releves` (
  `id_releve` int(11) NOT NULL,
  `matricule_etudiant` varchar(20) NOT NULL,
  `code_matiere` varchar(20) NOT NULL,
  `note` decimal(5,2) NOT NULL,
  `session` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  `departement` varchar(20) NOT NULL,
  `annee` int(11) NOT NULL,
  `matricule_enseignant` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `releves`
--

INSERT INTO `releves` (`id_releve`, `matricule_etudiant`, `code_matiere`, `note`, `session`, `semestre`, `departement`, `annee`, `matricule_enseignant`, `created_at`) VALUES
(2, '21a392fs', 'inf322', 17.50, 1, 1, 'math-info', 2024, '001e', '2024-05-30 20:09:28'),
(7, '21a317fs', 'inf336', 15.00, 1, 1, 'math-info', 2024, '001e', '2024-06-05 11:13:46'),
(16, '21a317fs', 'inf322', 15.00, 1, 1, 'math-info', 2024, '001ee', '2024-06-05 11:49:41'),
(17, '21a392fs', 'inf336', 14.00, 1, 1, 'math-info', 2024, '001ee', '2024-06-05 11:50:58');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `session` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`session`, `date_debut`, `date_fin`, `created_at`) VALUES
(1, '2024-06-10', '2024-06-13', '2024-05-30 07:29:58');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','enseignant','etudiant') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(13, 'enseignant', 'enseignant@gmail.com', '$2y$10$Q7BxWlzM.tq6lKewHcb0D.UAQ6JGET6AvPztRVpAQjgZGPEfBBfn2', 'enseignant', '2024-06-05 12:05:13'),
(14, 'etudiant', 'etudiant@gamil.com', '$2y$10$ThRTI7VOWMdqSaSlrdnu9.W42SxBxnFBH6dRgB0dqjLjWFpgr2g7G', 'etudiant', '2024-06-05 12:05:46'),
(16, 'admin', 'admin@gmail.com', '$2y$10$lrkekCCE2mZ2iCHHiPtmZex9plL2oa2fDc5NwI3ZKc3XIG5/z0qXC', 'admin', '2024-06-05 12:10:08');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`matricule_enseignant`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`matricule_etudiant`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`code_matiere`);

--
-- Index pour la table `releves`
--
ALTER TABLE `releves`
  ADD PRIMARY KEY (`id_releve`),
  ADD KEY `matricule_etudiant` (`matricule_etudiant`),
  ADD KEY `code_matiere` (`code_matiere`),
  ADD KEY `session` (`session`),
  ADD KEY `matricule_enseignant` (`matricule_enseignant`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `releves`
--
ALTER TABLE `releves`
  MODIFY `id_releve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `releves`
--
ALTER TABLE `releves`
  ADD CONSTRAINT `releves_ibfk_1` FOREIGN KEY (`matricule_etudiant`) REFERENCES `etudiants` (`matricule_etudiant`),
  ADD CONSTRAINT `releves_ibfk_2` FOREIGN KEY (`code_matiere`) REFERENCES `matieres` (`code_matiere`),
  ADD CONSTRAINT `releves_ibfk_3` FOREIGN KEY (`session`) REFERENCES `sessions` (`session`),
  ADD CONSTRAINT `releves_ibfk_4` FOREIGN KEY (`matricule_enseignant`) REFERENCES `enseignants` (`matricule_enseignant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
