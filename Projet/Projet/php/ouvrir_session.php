<!--
/**********************************************************************************
* UNIVERSITE NICE SOPHIA ANTIPOLIS
* PROJET DE WEB MAI 2013: PHP
* AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
* Theme : gestion d'ouverture de session et de connection
*/
-->
<head>
    <title>ouvrir session</title>
<?php
session_start();
$ini_array = parse_ini_file("../config/login_db.ini");
$user = $ini_array["user"];
$pass = $ini_array["pass"];
$host = $ini_array["host"];
$base = $ini_array ["base"];

// recuperation des données du formaulaire
$idUser = htmlspecialchars($_POST['idUser'], ENT_QUOTES);
$mdp = htmlspecialchars($_POST['mdp'], ENT_QUOTES);

// Connexion a phpmyadmin
if ($pass == "")
    $bdd = mysql_connect($host, $user) or die('Impossible de se connecter: ' . mysql_error());
else
    $bdd = mysql_connect($host, $user, $pass) or die('Impossible de se connecter: ' . mysql_error());
// Connection � la base de donn�e
mysql_select_db($base, $bdd) or die('Impossible de se connecter: ' . mysql_error());
// Recherche de l'utilisateur dans la base
$req = mysql_query('SELECT * FROM `personnel` WHERE Identifiant =\'' . $idUser . '\' AND mdp =\'' . $mdp . '\'')
or die ("Impossible de se connect&eacute; &agrave; la table 'personnel'" . mysql_error());
$req2 = mysql_query('SELECT * FROM `administrateur` WHERE Identifiant =\'' . $idUser . '\' AND mdp =\'' . $mdp . '\'')
or die ("Impossible de se connect&eacute; &agrave; la table 'administrateur'");


$row = mysql_fetch_array($req);
$row2 = mysql_fetch_array($req2);

if (mysql_num_rows($req) == 1) {
    $_SESSION['admin'] = false;
    $_SESSION['civilite'] = $row['civilite'];
    $_SESSION['nom'] = $row['nom'];
    $_SESSION['prenom'] = $row['prenom'];
    $_SESSION['numFix'] = $row['numFix'];
    $_SESSION['numPort'] = $row['numPort'];
    $_SESSION['numFax'] = $row['numFax'];
    $_SESSION['eamil'] = $row['email'];
    $_SESSION['url'] = $row['url'];
    $_SESSION['photo'] = $row['photo'];
    header('Location: rechercher.php?nom=&fonction=&unite=&pole=&batiment=');
} elseif (mysql_num_rows($req2) == 1) {
    $_SESSION['admin'] = true;
    header('Location: rechercher.php?nom=&fonction=&unite=&pole=&batiment=');

} else
    header('Location: index.php');

mysql_close($bdd);
?>