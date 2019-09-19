-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 19 sep. 2019 à 18:08
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfony-agence`
--

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190910080909', '2019-09-10 08:11:44'),
('20190910082401', '2019-09-10 08:24:11'),
('20190910092025', '2019-09-10 09:21:13'),
('20190910093722', '2019-09-10 09:37:30'),
('20190910094303', '2019-09-10 09:43:12'),
('20190911083329', '2019-09-11 08:33:40'),
('20190911123948', '2019-09-11 12:39:55'),
('20190912125512', '2019-09-12 12:55:20'),
('20190918120942', '2019-09-18 12:09:54'),
('20190918123342', '2019-09-18 12:33:48'),
('20190918123423', '2019-09-18 12:34:28');

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `surface` int(11) NOT NULL,
  `rooms` int(11) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `heat` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sold` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`id`, `title`, `description`, `surface`, `rooms`, `bedrooms`, `floor`, `price`, `heat`, `city`, `postal_code`, `sold`, `created_at`, `address`) VALUES
(16, 'Je suis un titre edité', 'Alias nemo vitae eum molestias tempora et. Qui distinctio architecto et vitae. Atque et aliquam delectus autem quisquam doloremque eaque.', 53, 10, 9, 5, 65419, 1, 'Clement-sur-Mer', '30552', 0, '2019-09-19 12:09:26', '37, avenue Alphonse Lacombe56698 Girard-les-Bains'),
(17, 'ipsam doloremque assumenda', 'Nulla dolorem blanditiis at suscipit praesentium. Quia eos laudantium eum incidunt sunt. Ea amet aliquam voluptatem placeat.', 138, 3, 7, 8, 561855, 1, 'Berthelot', '00931', 0, '2019-09-19 12:09:26', '42, rue de Chretien\n54 849 Gaillard'),
(18, 'rerum voluptas earum', 'Quia ullam voluptatem aperiam totam. Quos id officia neque nulla sint temporibus. Et tempore voluptatem adipisci ut et asperiores.', 74, 8, 4, 6, 77903, 0, 'DanielVille', '35898', 0, '2019-09-19 12:09:26', '97, chemin de Olivier\n89 256 Gilletboeuf'),
(19, 'quo corrupti sed', 'Hic rerum culpa incidunt et sit ut eligendi. Accusamus et occaecati vel. Illo quos eos quam molestias velit labore rem consequuntur.', 244, 4, 5, 9, 995171, 0, 'Hamel', '01 630', 0, '2019-09-19 12:09:26', 'rue Théophile Maillot\n96958 Carpentier'),
(20, 'et possimus qui', 'Neque harum eos eum sint. Molestiae totam velit odit tempore. Laboriosam rem quis atque ea.', 126, 6, 8, 2, 801910, 1, 'Morvan', '76404', 0, '2019-09-19 12:09:26', '11, chemin de Fernandez\n12 398 TanguyVille'),
(21, 'est sed exercitationem', 'Optio saepe iste nesciunt consequatur quasi voluptatem nesciunt. Ex accusantium doloremque recusandae. Totam saepe molestiae facere molestiae vitae dolorem.', 58, 2, 8, 6, 961076, 1, 'Carre-sur-Bouchet', '40022', 0, '2019-09-19 12:09:26', '70, avenue de Ribeiro\n71156 Perret'),
(22, 'quia et dolorum', 'Debitis doloremque ut dolorem perferendis consectetur voluptas minima. Enim iusto fugit officia id. Esse error est vel quam consequatur eos eius.', 215, 9, 3, 8, 562978, 1, 'Guichard', '57 350', 0, '2019-09-19 12:09:26', '2, avenue de Tessier\n52 262 Lainenec'),
(23, 'aperiam impedit modi', 'Laudantium optio perspiciatis asperiores similique quia maxime sit quaerat. Consectetur fugiat ipsum tempore nihil est asperiores quod. Praesentium inventore sed rerum minima veritatis iure labore quidem.', 219, 10, 9, 3, 538639, 0, 'Giraud-sur-Guibert', '77213', 0, '2019-09-19 12:09:26', '3, chemin Renaud\n54 149 MaillotBourg'),
(24, 'perspiciatis odio nam', 'Itaque id temporibus voluptates voluptas amet amet ea. Consequatur et odio voluptate sint quaerat consequatur labore. Odio tempora quia libero voluptatem et provident voluptatem.', 119, 5, 2, 4, 20319, 0, 'Guichardnec', '48287', 0, '2019-09-19 12:09:26', '10, rue Antoinette Dias\n16 670 Goncalves-sur-Mer'),
(25, 'temporibus eveniet perferendis', 'Modi facere animi laboriosam qui. Sit et soluta velit. Natus excepturi doloremque et mollitia aut.', 194, 9, 8, 5, 889695, 0, 'Leclerc-les-Bains', '68592', 0, '2019-09-19 12:09:26', 'avenue Brun\n46140 Fernandes-les-Bains'),
(26, 'ex dolor porro', 'Aperiam omnis et delectus nihil nihil corporis. Autem error dolores autem velit dicta. Vel hic excepturi ipsam hic sint fuga deserunt.', 294, 4, 5, 4, 705509, 1, 'Lebon-sur-Mendes', '83200', 0, '2019-09-19 12:09:26', '86, rue de Morvan\n94932 Pichon'),
(27, 'est incidunt rerum', 'Excepturi enim dolorem rem impedit nobis aliquid odio quia. Fugiat repellat aut illum et quod totam vel. Et ut alias est voluptas.', 237, 2, 6, 4, 772024, 0, 'Mendes', '41824', 0, '2019-09-19 12:09:26', 'rue Schneider\n76 441 Guillon-sur-Mer'),
(28, 'tempore corrupti voluptate', 'Quo deserunt perspiciatis et soluta blanditiis est ea quis. Quia tenetur sit voluptatem cupiditate. Qui enim commodi non illo laboriosam.', 109, 6, 1, 7, 270727, 1, 'Payet', '29 578', 0, '2019-09-19 12:09:26', '93, avenue de Marchal\n42 097 Joubertboeuf'),
(29, 'dolor ab et', 'Vel sit consequatur ducimus amet ex qui voluptatibus doloribus. Commodi veritatis exercitationem aut nisi quis repudiandae provident quis. Dolores aut sed harum fugiat aut id repellat pariatur.', 41, 2, 9, 10, 12594, 0, 'Neveudan', '72041', 0, '2019-09-19 12:09:26', '53, impasse Leger\n37900 Duval'),
(30, 'placeat molestias laboriosam', 'Facilis eligendi qui fugiat dicta saepe. Quasi est id beatae aspernatur ut dignissimos et. Pariatur error rerum dolor nobis ut consequuntur cupiditate.', 349, 5, 7, 3, 128964, 0, 'Martel', '92 930', 0, '2019-09-19 12:09:26', '25, chemin de Marchand\n83452 Brunel-sur-Collin'),
(31, 'repellat pariatur tenetur', 'Velit ab ipsa corrupti cumque ducimus dolore pariatur. Modi debitis et voluptates illum nobis. Nihil aut qui quasi deleniti quas.', 129, 10, 9, 5, 836445, 0, 'Delaunaydan', '09950', 0, '2019-09-19 12:09:26', '44, rue Margaud Dumas\n01010 Rochedan'),
(32, 'in nesciunt amet', 'Et alias a inventore veritatis. Id vero aliquid quod eligendi quidem sunt. Magnam qui sit quo aliquam.', 122, 2, 3, 3, 123673, 0, 'Pichon-la-Forêt', '77 555', 0, '2019-09-19 12:09:26', 'chemin Adrienne Rossi\n35 141 Gallet-la-Forêt'),
(33, 'voluptate porro quaerat', 'Laudantium sint adipisci occaecati illo. Non ab officiis repellendus recusandae. Similique voluptate quae maxime id tempore officiis autem.', 75, 2, 9, 6, 443822, 1, 'Denis', '23 729', 0, '2019-09-19 12:09:26', '6, place Jacques\n32 091 Le Gallboeuf'),
(34, 'repellendus et sed', 'Et reprehenderit omnis ut impedit. Qui veniam aliquam optio et reprehenderit voluptas dolores. Amet ab similique non qui.', 26, 5, 4, 9, 876595, 1, 'Brunel', '17910', 0, '2019-09-19 12:09:26', '5, boulevard Colin\n34 892 NavarroVille');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`) VALUES
(5, '1234', '$2y$13$Soml1.v8GjAghTeK8HGwbu1DG6JEcBePzpMDimskUemmdDlYlzEkO', '1234@1234.fr');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
