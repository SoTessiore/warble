-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 juin 2020 à 22:29
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `warble`
--

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `follow_id` int(11) NOT NULL,
  `follow_following_id` int(11) DEFAULT NULL,
  `follow_follower_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`follow_id`, `follow_following_id`, `follow_follower_id`) VALUES
(36, 5, 6),
(39, 7, 5),
(40, 7, 6),
(41, 6, 5),
(42, 6, 7),
(44, 6, 8),
(45, 5, 8);

-- --------------------------------------------------------

--
-- Structure de la table `retweet`
--

CREATE TABLE `retweet` (
  `retweet_id` int(11) NOT NULL,
  `retweet_tweet_id` int(11) DEFAULT NULL,
  `retweet_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `retweet`
--

INSERT INTO `retweet` (`retweet_id`, `retweet_tweet_id`, `retweet_user_id`) VALUES
(24, 35, 7),
(32, 43, 5),
(46, 57, 5);

-- --------------------------------------------------------

--
-- Structure de la table `tlike`
--

CREATE TABLE `tlike` (
  `tlike_id` int(11) NOT NULL,
  `tlike_tweet_id` int(11) DEFAULT NULL,
  `tlike_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tlike`
--

INSERT INTO `tlike` (`tlike_id`, `tlike_tweet_id`, `tlike_user_id`) VALUES
(28, 35, 7),
(30, 34, 7),
(31, 33, 7),
(32, 12, 7),
(34, 36, 8),
(39, 34, 6),
(42, 15, 5),
(47, 43, 5),
(48, 46, 6),
(67, 57, 5);

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `tweet_id` int(11) NOT NULL,
  `tweet_content` varchar(140) NOT NULL,
  `tweet_date` datetime(6) NOT NULL,
  `tweet_user_id` int(11) NOT NULL,
  `retweet_count` int(11) NOT NULL DEFAULT 0,
  `tlike_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tweet`
--

INSERT INTO `tweet` (`tweet_id`, `tweet_content`, `tweet_date`, `tweet_user_id`, `retweet_count`, `tlike_count`) VALUES
(12, 'Premier tweet', '2020-06-12 19:33:30.000000', 5, 1, 2),
(15, 'Bonjour à tous, je suis Michel Drucker !', '2020-06-12 22:02:26.000000', 6, 0, 2),
(33, 'Je n\'aime pas beaucoup les eleves', '2020-06-17 15:09:24.000000', 7, 0, 1),
(34, 'SORTEZ DES CONVENTIONS', '2020-06-17 15:10:04.000000', 7, 0, 2),
(35, 'Mais pas trop sinon je suis perdu', '2020-06-17 15:10:18.000000', 7, 1, 1),
(36, 'premier tweet de roro', '2020-06-17 17:13:53.000000', 8, 0, 1),
(37, 'j\'ai envie d\'un kebab\r\n', '2020-06-17 17:14:11.000000', 8, 0, 0),
(38, 'je reviens je vais gouter', '2020-06-17 17:14:22.000000', 8, 0, 0),
(43, 'Salut à tous!', '2020-06-18 14:37:44.000000', 5, 1, 1),
(46, 'j\'ai fait le level design du ptut :)', '2020-06-18 18:28:19.000000', 8, 0, 1),
(48, 'problème de fil d\'actualités réglé !', '2020-06-18 19:59:51.000000', 5, 0, 0),
(57, 'j\'en ai un peu marre', '2020-06-18 21:43:52.000000', 5, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_bio` text NOT NULL,
  `user_mail` varchar(100) NOT NULL,
  `user_born` date NOT NULL,
  `user_pseudo` varchar(15) NOT NULL,
  `following_count` int(11) NOT NULL DEFAULT 0,
  `follower_count` int(11) NOT NULL DEFAULT 0,
  `user_avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_bio`, `user_mail`, `user_born`, `user_pseudo`, `following_count`, `follower_count`, `user_avatar`) VALUES
(5, 'So', '03a7dda55ead4645651feefa4c3c772fed598333', 'Mamamia salut les amis', 'soso.tessiore@gmail.com', '2002-02-12', 'so_tessiore', 2, 2, '5.png'),
(6, 'Jean Jacques Goldman', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Je suis le vrai Michel Drucker', 'micheldrucker@gmail.com', '1881-02-16', 'michel_drucker', 2, 3, '6.png'),
(7, 'Isabelle', '4303f7fbc75763e3133bf7714fc90f02260848b5', 'Voici mon numéro si besoin: 118 218', 'isabelle@gmail.com', '1930-01-01', 'Isa_La_Best', 1, 2, ''),
(8, 'Ronan', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', 'roro@gmail.com', '2011-06-07', 'Roro', 2, 0, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `follow_following_id` (`follow_following_id`),
  ADD KEY `follow_follower_id` (`follow_follower_id`);

--
-- Index pour la table `retweet`
--
ALTER TABLE `retweet`
  ADD PRIMARY KEY (`retweet_id`),
  ADD KEY `retweet_tweet_id` (`retweet_tweet_id`),
  ADD KEY `retweet_user_id` (`retweet_user_id`);

--
-- Index pour la table `tlike`
--
ALTER TABLE `tlike`
  ADD PRIMARY KEY (`tlike_id`),
  ADD KEY `tlike_tweet_id` (`tlike_tweet_id`),
  ADD KEY `tlike_user_id` (`tlike_user_id`);

--
-- Index pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`tweet_id`),
  ADD KEY `tweet_user_id` (`tweet_user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `retweet`
--
ALTER TABLE `retweet`
  MODIFY `retweet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `tlike`
--
ALTER TABLE `tlike`
  MODIFY `tlike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `tweet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`follow_following_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`follow_follower_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `retweet`
--
ALTER TABLE `retweet`
  ADD CONSTRAINT `retweet_ibfk_1` FOREIGN KEY (`retweet_tweet_id`) REFERENCES `tweet` (`tweet_id`),
  ADD CONSTRAINT `retweet_ibfk_2` FOREIGN KEY (`retweet_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `tlike`
--
ALTER TABLE `tlike`
  ADD CONSTRAINT `tlike_ibfk_1` FOREIGN KEY (`tlike_tweet_id`) REFERENCES `tweet` (`tweet_id`),
  ADD CONSTRAINT `tlike_ibfk_2` FOREIGN KEY (`tlike_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`tweet_user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
