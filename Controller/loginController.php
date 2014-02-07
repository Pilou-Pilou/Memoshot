<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07/02/14
 * Time: 08:30
 */

session_start();
require('../Config/ConnexionsBD.php');
$conexions = new ConexionsBD();
$conexions->conexions();

// recuperation des données du formaulaire
$idUser = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
$mdp = htmlspecialchars($_POST['password'], ENT_QUOTES);

// Recherche de l'utilisateur dans la base
$req = mysql_query('SELECT * FROM `users` WHERE pseudo =\'' . $idUser . '\' AND password =\'' . $mdp . '\'')
or die ("Impossible de se connecté à la table 'users'" . mysql_error());

$row = mysql_fetch_array($req);
$row2 = mysql_fetch_array($req2);

if (mysql_num_rows($req) == 1) {
    $_SESSION['pseudo'] = $row['pseudo'];
    header('Location: ../View/accueilView.php');
} else
    header('Location: ../index.php?compteur=$_SESSION[\'pseudo\']');

// fermeture de la connexions
$conexions->deconnexions();

