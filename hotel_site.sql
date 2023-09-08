-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 08 sep. 2023 à 16:29
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hotel_site`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description_court` varchar(255) NOT NULL,
  `description_longue` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `prix_journalier` int(11) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id`, `titre`, `description_court`, `description_longue`, `image`, `prix_journalier`, `date_enregistrement`) VALUES
(1, 'Chambre Classic', 'Chambre Classic', 'Chambre d\'hôtel classique : Élégamment décorée, lit confortable, salle de bain privée, télévision, minibar, bureau, Wi-Fi, climatisation, service de chambre, une ambiance accueillante pour un séjour agréable et reposant.', '1694159837-pexels-castorly-stock-3682240-jpg', 200, '2023-09-05 13:30:00'),
(2, 'Chambre Confort', 'Chambre Confort', 'Chambre d\'hôtel gamme confort : Spacieuse, lit king-size, salle de bain en marbre, balcon privé, coin salon, minibar bien garni, télévision à écran plat, accès Wi-Fi rapide, vue panoramique, service attentionné 24h/24.', '1693985733-chambre-confort-jpg', 500, '2023-09-06 07:35:12'),
(3, 'Suite Confort', 'Suite', 'Suite Confort : Vaste espace, chambre séparée avec lit king-size, salon élégant, kitchenette équipée, salle de bain en marbre, balcon privé, équipements haut de gamme, vue panoramique, service de conciergerie dédié.', '1694165190-pexels-jonathan-borba-3144580-jpg', 1000, '2023-09-06 07:37:21');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `chambre_id` int(11) NOT NULL,
  `date_arrivee` date NOT NULL,
  `date_depart` date NOT NULL,
  `pix_total` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `telephone` varchar(80) NOT NULL,
  `email` varchar(180) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `chambre_id`, `date_arrivee`, `date_depart`, `pix_total`, `nom`, `prenom`, `telephone`, `email`, `date_enregistrement`) VALUES
(3, 3, '2023-09-11', '2023-09-16', 6000, 'BEN', 'Tarik', '1234567890', 'tarik@test.com', '2023-09-06 20:10:09'),
(4, 1, '2023-09-06', '2023-09-09', 200, 'ADMIN', 'Test', '1234567890', 'admin@test.com', '2023-09-06 20:15:04'),
(9, 1, '2023-09-08', '2023-09-08', 200, 'ss', 'ssss', '1233444555', 'sss@fff.com', '2023-09-08 07:32:02'),
(10, 2, '2023-09-08', '2023-09-08', 500, 'test', 'test2', '22334490000', 'test2@gmail.com', '2023-09-08 08:01:26'),
(11, 1, '2023-09-02', '2023-09-21', 4000, 'erreur', 'erreur', '1234567899', 'erreur@dd.com', '2023-09-08 08:02:29'),
(12, 2, '2023-09-10', '2023-09-12', 1500, 'cc', 'cc', '1223455', 'cc@cc', '2023-09-08 08:33:22'),
(13, 1, '2023-09-08', '2023-09-08', 200, 'classic', 'classic', '1234567890', 'classic@gmail.com', '2023-09-08 09:00:13'),
(14, 3, '2023-09-08', '2023-09-08', 1000, 'suite', 'suite', '122456789', 'suite@suite.com', '2023-09-08 09:06:31');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom_complet` varchar(255) NOT NULL,
  `email` varchar(180) NOT NULL,
  `message` longtext NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom_complet`, `email`, `message`, `date_enregistrement`) VALUES
(1, 'test admin', 'admin@test.com', 'test test test', '2023-09-07 12:33:18');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230905094650', '2023-09-05 09:47:02', 135),
('DoctrineMigrations\\Version20230905102457', '2023-09-05 10:25:18', 79),
('DoctrineMigrations\\Version20230905124551', '2023-09-05 12:45:59', 30),
('DoctrineMigrations\\Version20230906101728', '2023-09-06 10:17:39', 30),
('DoctrineMigrations\\Version20230907121054', '2023-09-07 12:11:03', 22);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `ordre` int(11) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `slider`
--

INSERT INTO `slider` (`id`, `image`, `ordre`, `date_enregistrement`) VALUES
(1, '1694164931-pexels-engin-akyurt-2725675-jpg', 1, '2023-09-05 14:34:10'),
(2, '1694164869-pexels-max-rahubovskiy-6782567-1-jpg', 2, '2023-09-05 14:34:27'),
(3, '1694165122-pexels-max-rahubovskiy-6238614-jpg', 3, '2023-09-05 14:34:46');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `civilite` varchar(20) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `nom`, `prenom`, `civilite`, `date_enregistrement`) VALUES
(1, 'admin@admin.com', '[\"ROLE_ADMIN\",\"ROLE_ADMIN\"]', '$2y$13$.qmMLcR2Eq6j2szEG0T7ueI8I8tR40fcpEB0c/biMkSUak7iCTbYS', 'admin', 'admin', 'admin', 'M.', '2023-09-05 13:05:09'),
(2, 'dd@dd.com', '{\"1\":\"ROLE_ADMIN\"}', '$2y$13$bskibo60nlYPRvFRnBZDQOF.J6nnMfxvqHixPFk.UAgFXz8YhiYbq', 'DD', 'dd', 'dd', 'Mme.', '2023-09-05 13:11:55');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67D9B177F54` (`chambre_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D9B177F54` FOREIGN KEY (`chambre_id`) REFERENCES `chambre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
