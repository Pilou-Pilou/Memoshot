-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 14 Novembre 2012 à 07:28
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `Identifiant` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  PRIMARY KEY (`Identifiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`Identifiant`, `mdp`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE IF NOT EXISTS `batiment` (
  `code` varchar(8) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `definition` text NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `batiment`
--

INSERT INTO `batiment` (`code`, `definition`) VALUES
('BAT-A', 'BATIMENT A CAL'),
('BAT-B', 'BATIMENT B CAL'),
('BAT-C', 'BATIMENT C CAL'),
('BAT-IUFC', 'INSTITUT UNIVERSITAIRE DE LA FACE ET DU COU');

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

CREATE TABLE IF NOT EXISTS `fonction` (
  `code` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `definition` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`code`, `definition`) VALUES
('F-ADJ-DRH', 'ADJOINT(E) DRH'),
('F-ADMINISTRATEUR-IUFC', 'ADMINISTRATEUR IUFC'),
('F-AIDE-SECRET', 'AIDE SECRETAIRE'),
('F-ARC', 'ANATOMO-CYTOPATHOLOGISTE'),
('F-ARC-INVESTIGATEUR', 'ANESTHESISTE-REANIMATEUR'),
('F-ARC-PROMOTEUR', 'ARC INVESTIGATEUR'),
('F-ASS-ADMINISTRATEUR-IUFC', 'ARC PROMOTEUR'),
('F-ASS-CM', 'ASSISTANT(E) ADMINISTRATEUR IUFC'),
('F-ASS-COM', 'ASSISTANT(E) CM'),
('F-ASS-DG', 'ASSISTANT(E) DE COMMUNICATION'),
('F-ASS-DIR', 'ASSISTANT(E) DE DIRECTION'),
('F-ASS-GEST', 'ASSISTANT(E) DE GESTION'),
('F-ASS-MED', 'ASSISTANT(E) DU DIRECTEUR GENERAL'),
('F-ASS-SOC', 'ASSISTANT(E) MEDICALE'),
('F-BIO-STATS', 'ASSISTANT(E) SOCIAL(E)'),
('F-BIOLOGISTE', 'ATTACHE(E) DE RECHERCHE CLINIQUE'),
('F-BRANCARDIER', 'BIOLOGISTE'),
('F-CADRE-ADMIN', 'BIO-STATISTICIEN(NE)'),
('F-CADRE-HYG', 'BRANCARDIER'),
('F-CADRE-MT', 'CADRE ADMINISTRATIF'),
('F-CADRE-REF', 'CADRE DE SANTE'),
('F-CADRE-SANTE', 'CADRE DE SANTE NUIT'),
('F-CADRE-SANTE-NUIT', 'CADRE DE SANTE TRANSVERSAL'),
('F-CADRE-SANTE-TRANSVERSAL', 'CADRE HYGIENISTE'),
('F-CCA', 'CADRE MEDICO-TECHNIQUE'),
('F-CHEF-BLOC', 'CADRE REFERENT'),
('F-CHEF-CLINI', 'CHARGE DE FORMATION'),
('F-CHEF-COMPT', 'CHEF COMPTABLE'),
('F-CHEF-EQUIP', 'CHEF DE BLOC'),
('F-CHEF-POLE-CHIR', 'CHEF DE CLINIQUE'),
('F-CHEF-POLE-IMAGERIE', 'CHEF DE CLINIQUE ASSISTANT'),
('F-CHEF-POLE-LABO', 'CHEF D''EQUIPE'),
('F-CHEF-POLE-MED', 'CHEF DU POLE CHIRURGIE'),
('F-CHEF-POLE-PHARMA', 'CHEF DU POLE IMAGERIE'),
('F-CHEF-POLE-RTH', 'CHEF DU POLE LABORATOIRES'),
('F-CHG-FORMAT', 'CHEF DU POLE MEDECINE'),
('F-COMPT', 'CHEF DU POLE PHARMACIE'),
('F-CONTROL-GEST', 'CHEF DU POLE RADIOTHERAPIE'),
('F-CORR-ANESTHESIOVIGILANC', 'CHIRURGIEN'),
('F-CORR-BIOVIGILANCE', 'COMPTABLE'),
('F-CORR-COSMETOVIGILANCE', 'CONTROLEUR DE GESTION'),
('F-CORR-HEMOVIGILANCE', 'CORRESPONDANT ANESTHESIOVIGILANCE'),
('F-CORR-IDENTITOVIGILANCE', 'CORRESPONDANT BIOVIGILANCE'),
('F-CORR-INFECTIOVIGILANCE', 'CORRESPONDANT COSMETOVIGILANCE'),
('F-CORR-MATERIOVIGILANCE', 'CORRESPONDANT HEMOVIGILANCE'),
('F-CORR-PHARMACOVIGILANCE', 'CORRESPONDANT IDENTITOVIGILANCE'),
('F-CORR-RADIOPROTECTION', 'CORRESPONDANT INFECTIOVIGILANCE'),
('F-CORR-REACTOVIGILANCE', 'CORRESPONDANT MATERIOVIGILANCE'),
('F-DATA-MANAGER', 'CORRESPONDANT PHARMACOVIGILANCE'),
('F-DERMO', 'CORRESPONDANT REACTOVIGILANCE'),
('F-DG', 'CORRESPONDANT VIGILANCE RADIOPROTECTION'),
('F-DGA', 'DATA-MANAGER'),
('F-DIET', 'DENTISTE'),
('F-DIR-APREMAS', 'DERMOGRAPHE'),
('F-DIR-CNRS', 'DIETETICIENNE'),
('F-DIR-INFO', 'DIRECTEUR APREMAS'),
('F-DIR-INFO-ADJ', 'DIRECTEUR DE LA RECHERCHE'),
('F-DIR-RECHERCHE', 'DIRECTEUR DE RECHERCHE CNRS'),
('F-DIR-SERV ECO', 'DIRECTEUR DES RESSOURCES HUMAINES'),
('F-DIR-SOINS', 'DIRECTEUR DES SOINS'),
('F-DOSIMETRISTE', 'DIRECTEUR GENERAL'),
('F-DR-ANAPAT', 'DIRECTEUR GENERAL ADJOINT'),
('F-DR-CHIR', 'DIRECTEUR INFORMATIQUE'),
('F-DR-DENT', 'DIRECTEUR INFORMATIQUE ADJOINT'),
('F-DR-ECHO', 'DIRECTEUR SERVICES ECONOMIQUES'),
('F-DR-MAR', 'DOSIMETRISTE'),
('F-DR-MED-NUCL', 'ECHOGRAPHE (DR)'),
('F-DR-ONCO', 'ELECTRONICIEN'),
('F-DR-RADIO', 'ESTHETICIENNE'),
('F-DR-RTH', 'GERANT SOCIETE DE RESTAURATION'),
('F-DRH', 'GESTIONNAIRE CNRS'),
('F-ELECTRONI', 'GESTIONNAIRE TECHNIQUE'),
('F-ESTHETI', 'GOUVERNANTE'),
('F-GERANT-RESTAURATION', 'IDE HYGIENISTE'),
('F-GEST-CNRS', 'INFIRMIERE D''ANNONCE ET DE COORDINATION HEMATOLOGIE'),
('F-GEST-TECHN', 'INFIRMIERE D''ANNONCE ET DE COORDINATION NEUROLOGIE'),
('F-GOUVERNANTE', 'INFIRMIERE D''ANNONCE ET DE COORDINATION ORL '),
('F-IDE-HEMATO', 'INFIRMIERE D''ANNONCE ET DE COORDINATION SEIN'),
('F-IDE-HYGI', 'INFIRMIERE DE NUTRITION'),
('F-IDE-NEURO', 'INGENIEUR '),
('F-IDE-NUT', 'KINESITHERAPEUTE'),
('F-IDE-ORL', 'LINGERE'),
('F-IDE-SEIN', 'MAGASINIER'),
('F-INGENIEUR', 'MANIPULATEUR'),
('F-KINE', 'MANIPULATEUR PRINCIPAL'),
('F-LINGERE', 'MECANICIEN'),
('F-MAGASINIER', 'MEDECIN'),
('F-MANIP', 'MEDECIN 3C'),
('F-MANIP-PRINC', 'MEDECIN DU TRAVAIL'),
('F-MECANO', 'MEDECIN NUCLEAIRE'),
('F-MED-3C', 'NEURO-PSYCHOLOGUE'),
('F-MED-TRAV', 'ONCOLOGUE'),
('F-MEDECIN', 'PERSONNE COMPETENTE EN RADIOPROTECTION'),
('F-NEURO-PSYCHO', 'PHARMACIEN'),
('F-PCR', 'PHYSICIEN'),
('F-PDT-APREMAS', 'PRATICIEN HYGIENISTE'),
('F-PDT-CM', 'PRELEVEUSE'),
('F-PDT-CONS-BLOC', 'PREPARATEUR URC'),
('F-PDT-CONS-IUFC', 'PREPARATEUR PUI'),
('F-PHIEN', 'PRESIDENT APREMAS'),
('F-PHYSICIEN', 'PRESIDENT CM'),
('F-PRAT-HYGI', 'PRESIDENT DU CONSEIL DE BLOC'),
('F-PREP-PUI', 'PRESIDENT DU CONSEIL DE L''IUFC'),
('F-PREP-URC', 'PSYCHIATRE'),
('F-PREVEL', 'PSYCHOLOGUE'),
('F-PSYCHIATRE', 'QUALITICIEN'),
('F-PSYCHO', 'RADIOLOGUE'),
('F-QUALITICIEN', 'RADIOPHARMACIEN'),
('F-RADIOPHIEN', 'RADIOTHERAPEUTE'),
('F-RDV-MEDNUCL', 'RDV MEDECINE NUCLEAIRE'),
('F-RDV-RADIO', 'RDV RADIO'),
('F-RESP-ACC-RECEP-FACTU', 'RESPONSABLE ACCUEIL-RECEPTION-FACTURATION'),
('F-RESP-COM', 'RESPONSABLE ASSURANCE QUALITE RIQUES'),
('F-RESP-DISSPO', 'RESPONSABLE COMMUNICATION '),
('F-RESP-ENTRETIEN', 'RESPONSABLE DISSPO'),
('F-RESP-FORMATION', 'RESPONSABLE ENTRETIEN GSF'),
('F-RESP-NETTOYAGE', 'RESPONSABLE FORMATION'),
('F-RESP-PLAINTES-PATIENTS', 'RESPONSABLE NETTOYAGE LOCAUX'),
('F-RESP-QUAL', 'RESPONSABLE RISQUES ENVIRONNEMENTAUX ET ECOLOGIE'),
('F-RESP-RISQ-ACH-SECU-HYGI', 'RESPONSABLE RISQUES FINANCIERS/JURIDIQUES ET CONTENTIEUX'),
('F-RESP-RISQ-ENV', 'RESPONSABLE RISQUES GESTION PLAINTE DES PATIENTS'),
('F-RESP-RISQ-FINJUR', 'RESPONSABLE RISQUES INSTITUTIONNELS'),
('F-RESP-RISQ-INTITUT', 'RESPONSABLE RISQUES NON-RESPECT PROCEDURES D''ACHAT, SECURITE DES BIENS ET DES PERSONNES, LINGE, ALIMENTATION, HYGIENE DES LOCAUX, TRANSPORTS EXTERNES'),
('F-RESP-RISQ-PRO', 'RESPONSABLE RISQUES PROFESSIONNELS'),
('F-RESP-RISQ-SOC', 'RESPONSABLE RISQUES SOCIAUX'),
('F-RESP-SECRET-MED', 'RESPONSABLE SECRETARIAT MEDICAL'),
('F-RESP-SERV-TECH', 'RESPONSABLE SERVICES TECHNIQUES'),
('F-RESP-UNITE', 'RESPONSABLE UNITE '),
('F-SECR-RCP', 'SECRETAIRE'),
('F-SECRET-ADJ-CHSCT', 'SECRETAIRE ADJOINT CHSCT'),
('F-SECRET-CE', 'SECRETAIRE CE ELU'),
('F-SECRET-CHSCT', 'SECRETAIRE CHSCT'),
('F-SECRET-CNRS', 'SECRETAIRE CNRS'),
('F-SECRET-CRUQPC', 'SECRETAIRE GENERAL ADJOINT'),
('F-SECRET-ELU-CE', 'SECRETAIRE RCP'),
('F-SECRET-MEDTRAV', 'SECRETARIAT CE'),
('F-SECRETAIRE', 'SECRETARIAT CRUQPC'),
('F-SGA', 'SECRETARIAT MEDECINE DU TRAVAIL '),
('F-SUPERV-BLOC', 'SUPERVISEUR BLOC'),
('F-SUPP-CORR-ANESTHESIOVIG', 'SUPPLEANT CHEF DE POLE CHIRURGIE'),
('F-SUPP-CORR-BIOVIGILANCE', 'SUPPLEANT CHEF DE POLE IMAGERIE'),
('F-SUPP-CORR-COSMETOVIGILA', 'SUPPLEANT CHEF DE POLE LABORATOIRES'),
('F-SUPP-CORR-HEMOVIGILANCE', 'SUPPLEANT CHEF DE POLE MEDECINE'),
('F-SUPP-CORR-IDENTITOVIGIL', 'SUPPLEANT CHEF DE POLE RADIOTHERAPIE'),
('F-SUPP-CORR-INFECTIOVIGIL', 'SUPPLEANT CHEF POLE PHARMACIE'),
('F-SUPP-CORR-MATERIOVIGILA', 'SUPPLEANT CORRESPONDANT ANESTHESIOVIGILANCE'),
('F-SUPP-CORR-REACTOVIGILAN', 'SUPPLEANT CORRESPONDANT BIOVIGILANCE'),
('F-SUPPL-CHEF-PHARMA', 'SUPPLEANT CORRESPONDANT COSMETOVIGILANCE'),
('F-SUPPL-CHEF-POLE-CHIR', 'SUPPLEANT CORRESPONDANT HEMOVIGILANCE'),
('F-SUPPL-CHEF-POLE-IMAGERI', 'SUPPLEANT CORRESPONDANT IDENTITOVIGILANCE'),
('F-SUPPL-CHEF-POLE-LABO', 'SUPPLEANT CORRESPONDANT INFECTIOVIGILANCE'),
('F-SUPPL-CHEF-POLE-MED', 'SUPPLEANT CORRESPONDANT MATERIOVIGILANCE'),
('F-SUPPL-CHEF-POLE-RTH', 'SUPPLEANT CORRESPONDANT PHARMACOVIGILANCE'),
('F-SUPPL-CORR-PHARMACOVIGI', 'SUPPLEANT CORRESPONDANT REACTOVIGILANCE'),
('F-TECHN-DIM', 'TECHNICIEN(NE) PRINCIPAL( E )'),
('F-TECHN-PRINC', 'TECHNICIENNE INFORMATION MEDICALE'),
('F-TECHN-PRINC-DIM', 'TECHNICIENNE INFORMATION MEDICALE PRINCIPALE'),
('F-TRESORIER', 'TRESORIER'),
('F-VAGUEMESTRE', 'VAGUEMESTRE'),
('F-VPDT-CM', 'VICE-PRESIDENT CM'),
('F-VPDT-CONS-IUFC', 'VICE-PRESIDENT DU CONSEIL DE L''IUFC'),
('SUPPL-RESP-DISSPO', 'SUPPLEANT RESPONSABLE DISSPO'),
('code', 'description');

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `identifiant` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `civilite` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nom` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prenom` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `numFix` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `numPort` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `numFax` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `photo` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp` varchar(15) NOT NULL,
  PRIMARY KEY (`identifiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel`
--

INSERT INTO `personnel` (`identifiant`, `civilite`, `nom`, `prenom`, `numFix`, `numPort`, `numFax`, `email`, `url`, `photo`, `mdp`) VALUES
('pa105532', 'M', 'PINERO', 'Alexandre', '0493550000', '0636360000', '0493550000', 'alexandre.pinero@gmail.com', '', '', 'passe'),
('pm105532', 'M', 'PINERO', 'Mat', '', '', '', '', '', '', 'passe');

-- --------------------------------------------------------

--
-- Structure de la table `personnel_batiment`
--

CREATE TABLE IF NOT EXISTS `personnel_batiment` (
  `Identifiant` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `code` varchar(8) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Identifiant`,`code`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel_batiment`
--

INSERT INTO `personnel_batiment` (`Identifiant`, `code`) VALUES
('pa105532', 'BAT-A'),
('pm105532', 'BAT-B');

-- --------------------------------------------------------

--
-- Structure de la table `personnel_fonction`
--

CREATE TABLE IF NOT EXISTS `personnel_fonction` (
  `Identifiant` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Code` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Identifiant`,`Code`),
  KEY `Code` (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel_fonction`
--

INSERT INTO `personnel_fonction` (`Identifiant`, `Code`) VALUES
('pa105532', 'F-ADJ-DRH');

-- --------------------------------------------------------

--
-- Structure de la table `personnel_pole`
--

CREATE TABLE IF NOT EXISTS `personnel_pole` (
  `Identifiant` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `code` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Identifiant`,`code`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel_pole`
--

INSERT INTO `personnel_pole` (`Identifiant`, `code`) VALUES
('pa105532', 'POLE-CHIR');

-- --------------------------------------------------------

--
-- Structure de la table `personnel_unite`
--

CREATE TABLE IF NOT EXISTS `personnel_unite` (
  `Identifiant` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `code` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Identifiant`,`code`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnel_unite`
--

INSERT INTO `personnel_unite` (`Identifiant`, `code`) VALUES
('pa105532', 'U-ACC-REC-CAL');

-- --------------------------------------------------------

--
-- Structure de la table `pole`
--

CREATE TABLE IF NOT EXISTS `pole` (
  `code` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `definition` text NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pole`
--

INSERT INTO `pole` (`code`, `definition`) VALUES
('POLE-CHIR', 'POLE CHIRURGIE'),
('POLE-DIM', 'DEPARTEMENT D''INFORMATION MEDICALE'),
('POLE-DRC', 'DIRECTION DE LA RECHERCHE CLINIQUE'),
('POLE-IMAGERIE', 'POLE IMAGERIE'),
('POLE-LABO', 'POLE LABORATOIRE'),
('POLE-MED', 'POLE MEDICAL'),
('POLE-PHARMA', 'POLE PHARMACIE'),
('POLE-RTH', 'POLE RADIOTHERAPIE');

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

CREATE TABLE IF NOT EXISTS `unite` (
  `code` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `definition` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `unite`
--

INSERT INTO `unite` (`code`, `definition`) VALUES
('U-ACC-REC-CAL', 'ACCUEIL-RECEPTION CAL'),
('U-ACC-REC-IUFC', 'ACCUEIL IUFC'),
('U-ADMIN-IUFC', 'ADMINISTRATION IUFC'),
('U-ADMISS-IUFC', 'ADMISSIONS IUFC'),
('U-AFF-FIN-BUD', 'AFFAIRES FINANCIERES ET BUDGETAIRES'),
('U-ANAPAT', 'ANATOMIE ET CYTOLOGIE PATHOLOGIQUES'),
('U-ARCHIVES', 'ARCHIVES MEDICALES'),
('U-ATELIER', 'ATELIER'),
('U-BIBLIOCE', 'BIBLIOTHEQUE DU CE'),
('U-BIBLIOMED', 'BIBLIOTHEQUE MEDICALE'),
('U-BIO', 'BIOLOGIE'),
('U-BIOMED', 'BIOMEDICAL'),
('U-BLOC-OP', 'BLOC OPERATOIRE'),
('U-BRANCARD-CAL', 'BRANCARDAGE CAL'),
('U-BRANCARD-IUFC', 'BRANCARDAGE IUFC'),
('U-BUR-PERS', 'BUREAU DU PERSONNEL'),
('U-CE', 'COMITE D''ENTREPRISE'),
('U-CELIGUE06', 'COMITE DEPARTEMENTAL DE LA LIGUE'),
('U-CHSCT', 'COMITE D''HYGIENE, SECURITE ET DES CONDITIONS DE TRAVAIL'),
('U-CLIN', 'CLIN'),
('U-CLINI-SEIN', 'CLINIQUE DU SEIN'),
('U-CME', 'CME'),
('U-CNRS', 'CNRS'),
('U-COM', 'COMMUNICATION'),
('U-CONSULT-ANN', 'CONSULTATIONS D''ANNONCE'),
('U-CONSULT-CAL', 'CONSULTATIONS CAL'),
('U-CONSULT-IUFC', 'CONSULTATIONS IUFC'),
('U-COURRIER', 'LOCAL COURRIER'),
('U-CUISINE', 'CUISINE'),
('U-CYCLO', 'MEDICYC-CYCLOTRON'),
('U-DERMO', 'DERMOGRAPHIE ET CABINE D''ESTHETIQUE'),
('U-DG', 'DIRECTION GENERALE'),
('U-DIR-SOINS', 'DIRECTION DES SOINS '),
('U-DISSPO-CAL', 'DISSPO CAL'),
('U-DISSPO-IUFC', 'DISSPO IUFC'),
('U-DRH', 'DIRECTION DES RESSOURCES HUMAINES'),
('U-DRIS', 'DRIS'),
('U-EXPLO-FONC', 'EXPLORATIONS FONCTIONNELLES COCHLEOVESTIBULAIRES'),
('U-FORMATION', 'FORMATION PROFESSIONNELLE'),
('U-GEST-RISQ-VIGI', 'GESTION DES RISQUES ET VIGILANCES'),
('U-HDJ2', 'HOPITAL DE JOUR 2'),
('U-HDJ3', 'HOPITAL DE JOUR 3'),
('U-HEMOVIG', 'HEMOVIGILANCE'),
('U-HOSPA3', 'HOPITAL DE SEMAINE MEDECINE ET INTERVENTIONNEL'),
('U-HOSPA4', 'HOSPITALISATION CONVENTIONNELLE CHIRURGIE A4'),
('U-HOSPB3', 'HOSPITALISATION CONVENTIONNELLE MEDECINE B3'),
('U-HOSPB4', 'HOSPITALISATION CONVENTIONNELLE MEDECINE B4'),
('U-HYGIENE', 'HYGIENE'),
('U-INFO', 'INFORMATIQUE'),
('U-INFO-CHU', 'INFORMATIQUE CHU'),
('U-INTERNE-GARDE-IUFC', 'INTERNE DE GARDE IUFC'),
('U-KINE', 'REEDUCATION FONCTIONNELLE'),
('U-LINGERIE', 'LINGERIE'),
('U-LPCE', 'LABORATOIRE DE PATHOLOGIE CLINIQUE ET EXPERIMENTALE CHU'),
('U-M-BIOMED-IUFC', 'MAINTENANCE BIOMEDICALE IUFC'),
('U-MED-NUCL', 'MEDECINE NUCLEAIRE'),
('U-MED-TRAV', 'MEDECINE DU TRAVAIL'),
('U-NETTOY', 'ENTRETIEN NETTOYAGE'),
('U-PC-CHIR', 'PC CHIRURGICAL'),
('U-PC-MED', 'PC MEDICAL'),
('U-PC-MED-IUFC', 'PC MEDICAL IUFC'),
('U-PHYSIQUE', 'PHYSIQUE'),
('U-QUALITE-RISQUES', 'GESTION DE LA QUALITE ET DES RISQUES'),
('U-RADIO', 'RADIOLOGIE'),
('U-RADIOPHIE', 'RADIOPHARMACIE'),
('U-RDV-CAL', 'RDV CAL'),
('U-RDV-IUFC', 'RDV IUFC'),
('U-REUNIONS-CAL', 'SALLES DE REUNIONS CAL'),
('U-REUNIONS-IUFC', 'SALLES DE REUNIONS IUFC'),
('U-RTH-CURIE', 'RADIOTHERAPIE-CURIETHERAPIE'),
('U-SECRET-CS-CHU', 'SECRETARIAT DES CONSULTATIONS CHU'),
('U-SECRET-DIR', 'SECRETARIAT DE DIRECTION'),
('U-SECRET-PROGCHIR-CAL', 'SECRETARIAT PROGRAMMATION CHIRURGIE CAL'),
('U-SECRET-PROGCHIR-CHU', 'SECRETARIAT PROGRAMMATION CHIRURGIE CHU'),
('U-SECRET-SCIENTI', 'SECRETARIAT SCIENTIFIQUE'),
('U-SECRET-UNIV-IUFC', 'SECRETARIAT UNIVERSITAIRE IUFC'),
('U-SECURITE', 'SECURITE'),
('U-SERV-TECH', 'SERVICES TECHNIQUES '),
('U-SEXT-CAL', 'SOINS EXTERNES CAL'),
('U-SEXT-IUFC', 'SOINS EXTERNES IUFC'),
('U-SNACK', 'SNACK'),
('U-SOCIAL-CAL', 'SERVICE SOCIAL CAL'),
('U-SOCIAL-IUFC', 'SERVICE SOCIAL IUFC'),
('U-SOINS-SUPPORT', 'SOINS DE SUPPORT'),
('U-STANDARD-CAL', 'STANDARD CAL'),
('U-STANDARD-IUFC', 'STANDARD IUFC'),
('U-STERILISATION', 'STERILISATION'),
('U-SYNDICS', 'SYNDICATS'),
('U-UCA', 'UNITE DE CHIRURGIE AMBULATOIRE'),
('U-UEB', 'UNITE DE SURVEILLANCE CONTINUE'),
('U-UH-CHIR-CAL', 'UNITE D''HOSPITALISATION COMPLETE ORL - CHIR MAXILLO-FACIALE'),
('U-UH-CHIR-CER', 'UNITE D''HOSPITALISATION DE CHIRURGIE CERVICO-FACIALE CANCEROLOGIE'),
('U-UHC-ORL-CHU', 'UNITE D''EPIDEMIOLOGIE ET BIOSTATISTIQUE'),
('U-URC', 'URC'),
('U-USC', 'UNITE DE RECHERCHE CLINIQUE'),
('code', 'designation');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `personnel_batiment`
--
ALTER TABLE `personnel_batiment`
  ADD CONSTRAINT `personnel_batiment_ibfk_3` FOREIGN KEY (`Identifiant`) REFERENCES `personnel` (`identifiant`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `personnel_batiment_ibfk_5` FOREIGN KEY (`code`) REFERENCES `batiment` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `personnel_fonction`
--
ALTER TABLE `personnel_fonction`
  ADD CONSTRAINT `personnel_fonction_ibfk_1` FOREIGN KEY (`Identifiant`) REFERENCES `personnel` (`identifiant`),
  ADD CONSTRAINT `personnel_fonction_ibfk_2` FOREIGN KEY (`Code`) REFERENCES `fonction` (`code`);

--
-- Contraintes pour la table `personnel_pole`
--
ALTER TABLE `personnel_pole`
  ADD CONSTRAINT `personnel_pole_ibfk_1` FOREIGN KEY (`Identifiant`) REFERENCES `personnel` (`identifiant`),
  ADD CONSTRAINT `personnel_pole_ibfk_2` FOREIGN KEY (`code`) REFERENCES `pole` (`code`);

--
-- Contraintes pour la table `personnel_unite`
--
ALTER TABLE `personnel_unite`
  ADD CONSTRAINT `personnel_unite_ibfk_1` FOREIGN KEY (`Identifiant`) REFERENCES `personnel` (`identifiant`),
  ADD CONSTRAINT `personnel_unite_ibfk_2` FOREIGN KEY (`code`) REFERENCES `unite` (`code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
