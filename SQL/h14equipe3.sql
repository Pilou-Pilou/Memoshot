-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 14 Avril 2014 à 20:56
-- Version du serveur: 5.5.35
-- Version de PHP: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `h14equipe3`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE IF NOT EXISTS `abonnement` (
  `id_abonnement` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut_abonnement` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type_abonnement` int(11) NOT NULL,
  PRIMARY KEY (`id_abonnement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `abonnement`
--

INSERT INTO `abonnement` (`id_abonnement`, `date_debut_abonnement`, `type_abonnement`) VALUES
(0, '2014-03-06 22:37:47', 0),
(36, '2014-03-19 15:44:18', 1),
(37, '2014-03-27 19:33:54', 1),
(38, '2014-04-09 01:18:07', 1);

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_publication` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  `tag1` varchar(250) NOT NULL,
  `tag2` varchar(250) NOT NULL,
  `tag3` varchar(250) NOT NULL,
  `tag4` varchar(250) NOT NULL,
  `tag5` varchar(250) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_publication`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `album`
--

INSERT INTO `album` (`id_publication`, `id_utilisateur`, `nom`, `message`, `tag1`, `tag2`, `tag3`, `tag4`, `tag5`, `photo`, `date`) VALUES
(1, 47, 'soleil', 'chaud', 'ok', '', '', '', '', '../upload/vj8qzx59tc.jpg', '2014-02-28 18:38:42'),
(2, 47, 'oli', 'moi', 'prof', '', '', '', '', '../upload/y0z4o83cfq.jpg', '2014-02-28 18:39:22'),
(3, 47, 'visualizer', 'yeah', 'cool', '', '', '', '', '../upload/mbk3env2dz.png', '2014-02-28 18:42:57'),
(4, 48, 'Le Ciel sur la cote d Azur', 'Quel beau ciel de fin d''Ã©tÃ©', 'Sky', 'Ciel', 'Nuage', 'Cloud', '', '../upload/3nhtaf5u2k.png', '2014-03-04 13:50:11'),
(5, 48, 'Maison bleue des landes', 'lors d''un voyage entre ami', 'Plage', 'Ciel', 'Maison', 'Landes', '', '../upload/ht8kx0lua6.png', '2014-03-04 13:50:44'),
(6, 48, 'Corse', 'une petite terrasse de cafÃ© a Pigna en Corse', 'Ciel', 'Mer', 'Sky', 'Sea', 'Summer', '../upload/u5phd2cwl0.png', '2014-03-04 13:51:25'),
(7, 48, 'Montreal At Night', 'Montreal un soir d''hiver', 'Montreal', 'Night', 'Nuit', 'Hiver', '', '../upload/2lk87mieqt.png', '2014-03-04 13:52:18'),
(8, 48, 'Montreal At Night', 'Montreal un soir d''hiver', 'Montreal', 'Night', 'Nuit', 'Hiver', '', '../upload/im0vut7yw1.png', '2014-03-04 13:52:18'),
(9, 48, 'Tour de Shanghai', 'vue de la tour de Shanghai en construction', 'Chine', 'Shanghai', 'Cloud', 'Nuage', '', '../upload/250tv9ajgb.png', '2014-03-04 13:53:06'),
(10, 48, 'Popop', 'Ma photo de profil', 'Popop', '', '', '', '', '../upload/vd8r2ti51m.gif', '2014-03-04 13:54:19'),
(11, 48, 'Montreal du Mont Royal', 'Durant mon semestre d''Ã©change au Canada', 'Montreal ', 'Mont Royal', 'Canada', '', '', '../upload/uafoh2wiyn.jpg', '2014-03-04 13:55:42'),
(12, 48, 'Rue Ã  LÃ©vis', 'Voici ma rue Ã  LÃ©vis', 'LÃ©vis', 'Rue', 'Neige', 'Snow', '', '../upload/b9rpxs5d7l.jpg', '2014-03-04 13:56:19'),
(13, 48, 'Chateau Frontenac', 'Photo du Traversier du Chateau Frontenac', 'Frontenac', 'Quebec', 'Chateau ', 'Canada', '', '../upload/74h9k5ifv0.jpg', '2014-03-04 13:57:20'),
(14, 48, 'Camping entre Amis', 'Petit camping au Baou de Saint Jeannet', 'Camping', 'Amis', 'Friends', 'France', 'Saint Jeannet', '../upload/vst7kigbf3.jpg', '2014-03-04 13:58:11'),
(15, 48, 'Montagne aux USA', 'Voici des montagnes des USA', 'USA', 'Montagnes', 'ForÃªt', '', '', '../upload/glp4qtuwdj.jpg', '2014-03-04 13:59:24'),
(16, 53, 'Chat', 'Cute !', '@cute', '', '', '', '', '../upload/4jgklc1apx.jpg', '2014-03-07 16:46:19'),
(17, 53, 'Chat', 'Cute !', '@cute', '', '', '', '', '../upload/9h412yca0p.jpg', '2014-03-07 16:46:56'),
(18, 47, 'Ã‰lections', 'C''est la photo d''un votant', 'QuÃ©bec', 'Ã©lections', 'PQ', 'PLQ', 'CAQ', '../upload/843596fotg.jpg', '2014-03-18 01:50:46'),
(19, 46, 'Herbe', 'Herbe', 'Herbe', '', '', '', '', '../upload/zo4nulmt92.jpg', '2014-03-19 20:06:24'),
(21, 55, 'warner', 'warner', 'warner', '', '', '', '', '../upload/qwxm93rptk.jpg', '2014-03-27 19:31:34'),
(22, 55, 'Batman vs Superman', 'futur film', 'Batman', 'Superman', '', '', '', '../upload/ap96smvekf.jpg', '2014-03-27 19:32:07');

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE IF NOT EXISTS `amis` (
  `id_amis_1` int(11) NOT NULL,
  `id_amis_2` int(11) NOT NULL,
  `status_amitier` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_amis_1`,`id_amis_2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`id_amis_1`, `id_amis_2`, `status_amitier`) VALUES
(46, 47, 1),
(46, 51, 0),
(47, 55, 1),
(48, 47, 1),
(48, 50, 0),
(48, 52, 0),
(48, 53, 0),
(51, 48, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaires` int(11) NOT NULL AUTO_INCREMENT,
  `id_publication` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `commentaire` longtext CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaires`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaires`, `id_publication`, `id_auteur`, `commentaire`, `date`) VALUES
(1, 1, 48, 'pas top ...\n', '2014-03-04 14:00:07'),
(4, 3, 48, 'qu est ce que c est ?', '2014-03-04 15:31:44'),
(7, 3, 47, 'C''est GAE-Studio, une application sur laquelle je travaille chez ArcBees', '2014-03-04 18:00:29'),
(8, 4, 47, '*Like*', '2014-03-04 18:00:48'),
(9, 15, 47, 'Beau point de vue !', '2014-03-13 20:08:48'),
(11, 13, 47, 'On peut avoir une fonctionnalitÃ© like ?', '2014-03-13 20:09:43'),
(18, 13, 47, 'Suggestion d''ajout de prochaine fonctionnalitÃ© : un bouton *like*', '2014-03-16 03:36:10'),
(19, 15, 48, 'Merci !', '2014-03-18 00:59:11'),
(21, 22, 47, 'asdf', '2014-03-31 17:33:43');

-- --------------------------------------------------------

--
-- Structure de la table `ordre_utilisateur`
--

CREATE TABLE IF NOT EXISTS `ordre_utilisateur` (
  `id_ordre` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ordre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `ordre_utilisateur`
--

INSERT INTO `ordre_utilisateur` (`id_ordre`, `id_utilisateur`, `position`) VALUES
(14, 47, 3),
(16, 55, 2),
(17, 48, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Type_Abonnement`
--

CREATE TABLE IF NOT EXISTS `Type_Abonnement` (
  `id_type_abonnement` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_abonnement` varchar(250) NOT NULL,
  PRIMARY KEY (`id_type_abonnement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Type_Abonnement`
--

INSERT INTO `Type_Abonnement` (`id_type_abonnement`, `libelle_abonnement`) VALUES
(0, 'Classique (Gratuit)'),
(1, 'Premiun Gold'),
(2, 'Premiun Argent'),
(3, 'Premiun Bronze');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `naissance` date NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `photo_profil` varchar(250) NOT NULL DEFAULT '../images/default.png',
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `abonnement` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `nom`, `prenom`, `password`, `mail`, `naissance`, `sexe`, `photo_profil`, `status`, `abonnement`) VALUES
(46, 'Rulio-Pilou', 'Sergent', 'Julien', '8696c94f75aa15521346cc32b5489a967d197eb0', '21204933@etu.unicaen.fr', '1993-12-12', 'M', '../images/logoMini.png', 'V', 0),
(47, 'prof', 'Lafleur', 'Olivier', 'd9f02d46be016f1b301f7c02a4b9c4ebe0dde7ef', 'olivier.lafleur@cll.qc.ca', '1986-05-27', 'M', '../upload/y0z4o83cfq.jpg', 'V', 36),
(48, 'Moli', 'Molinengo', 'Mathieu', '109b5c7246f087aa4b5c89902eb386bc6b0d0258', 'mathieu.moli@hotmail.com', '1991-08-26', 'M', '../upload/vd8r2ti51m.gif', 'V', 38),
(50, 'JordanG', 'Gaga', 'Jordan', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'jordang12@hotmail.fr', '2013-04-15', 'M', '../images/default.png', 'V', 0),
(51, 'BenjaminBercy', 'BERCY', 'Benjamin', '065aab73157d58798a50b2c69b131b34edeb85fc', 'benjamin.bercy@orange.fr', '1993-12-17', 'M', '../images/default.png', 'V', 0),
(52, 'emilie317', 'Proteau', 'Emilie', 'f999b6de23f263c189f29eef6e710b82e0140a96', 'emilie317@hotmail.com', '1984-06-22', 'F', '../upload/q94mna613j.jpg', 'V', 0),
(53, 'sc', 'Sophie', 'C', 'dba2560f793a067752389814e0d51740ec6b76a7', 'bla@bla.bla', '1994-11-14', 'F', '../images/default.png', 'V', 0),
(54, 'matmat', 'Mat', 'Mat', '109b5c7246f087aa4b5c89902eb386bc6b0d0258', 'mmolinengo2@gmail.com', '1001-09-26', 'M', '../images/default.png', 'A', 0),
(55, 'Warner Bros', 'Warner', 'Bros', '109b5c7246f087aa4b5c89902eb386bc6b0d0258', 'warnerbros.marketingcanada@gmail.com', '1991-08-04', 'M', '../upload/qwxm93rptk.jpg', 'V', 37);

--
-- Déclencheurs `users`
--
DROP TRIGGER IF EXISTS `insertion`;
DELIMITER //
CREATE TRIGGER `insertion` AFTER UPDATE ON `users`
 FOR EACH ROW begin
   if  new.abonnement <>old.abonnement
   then
       update ordre_utilisateur set position=position+1;
        insert into ordre_utilisateur(id_utilisateur,position) values ( new.id,1);
  end if;
end
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
