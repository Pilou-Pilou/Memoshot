<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07/02/14
 * Time: 08:30
 */

session_start();
require('../Config/ConnexionBD.php');
$connexions = new ConnexionBD();
$connexions->connexion();

// recuperation des données du formaulaire
$idUser = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
$mdp = htmlspecialchars($_POST['password1'], ENT_QUOTES);

// Recherche de l'utilisateur dans la base
$req = mysql_query('SELECT * FROM `users` WHERE pseudo =\'' . $idUser . '\' AND password =SHA1(\'' . $mdp . '\') and status="V"')
or die ("Impossible de se connecté à la table 'users'" . mysql_error());


$row2 = mysql_fetch_array($req2);
$row = mysql_fetch_array($req);

if (mysql_num_rows($req) == 1) {
    $_SESSION['pseudo_util'] = $row['pseudo'];
    $_SESSION['id'] = $row['id'];
    header('Location: ../view/accueilView.php');
} else {
    // Recherche de l'utilisateur dans la base
    $req = mysql_query('SELECT * FROM `users` WHERE pseudo =\'' . $idUser . '\' AND password  =SHA1(\'' . $mdp . '\') and status="A"')
    or die ("Impossible de se connecté à la table 'users'" . mysql_error());
    if (mysql_num_rows($req) == 1)
        $_SESSION['erreur'] = 2;
    else
        $_SESSION['erreur'] = 1;
    header('Location: ../index.php');
}

// fermeture de la connexions
$connexions->deconnexion();

