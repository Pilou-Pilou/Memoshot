<?php
/**
 * Created by PhpStorm.
 * User: Rulio
 * Date: 13/02/14
 * Time: 23:36
 */
session_start();
require_once('../Config/ConnexionsBD.php');


$_SESSION['erreur'] = '';
if (isset($_POST['pseudo'])) {

    // on à verifier que tous les champs n'etait pas vide on va maintenant
    if (estVide($_POST['pseudo']) && estVide($_POST['password']) && estVide($_POST['passwordVerif']) && estVide($_POST['nom']) && estVide($_POST['prenom']) && estVide($_POST['mail']))
        $_SESSION['erreur'] = ' Veuillez bien complétez tous les champs' . '<br>';

    // verifier si les mot de passe sont bon
    if ($_POST['password'] != $_POST['passwordVerif'])
        $_SESSION['erreur'] = $_SESSION['erreur'] . ' Veuillez tapez le même mot de passe' . '<br>';

    // on verifie que l'adresse mail est valide
    if (!estMail($_POST['mail']))
        $_SESSION['erreur'] = $_SESSION['erreur'] . ' Veuillez rentrez une adresse mail valide ' . '<br>';

    // on verifie que le speudo n'est pas utiliser
    if (speudoUtilisé($_POST['pseudo'])) {
        $_SESSION['erreur'] = $_SESSION['erreur'] . ' Veuillez choisir un autre pseudo celui-ci est deja utilisée' . '<br>';
        $_POST['pseudo'] = '';
    }


    // on verifie que le mail n'est pas utiliser
    if (mailUtilisé($_POST['mail'])) {
        $_SESSION['erreur'] = $_SESSION['erreur'] . ' Veuillez choisir une autre adresse mail celle-ci est déjà utilisée' . '<br>';
        $_POST['mail'] = '';
    }


    echo '<form method="post" name="donnee" action="../view/modificationCompteView.php">
                <input type="hidden" name="pseudo" value="' . $_POST['pseudo'] . '">
                <input type="hidden" name="nom" value="' . $_POST['nom'] . '">
                <input type="hidden" name="prenom" value="' . $_POST['prenom'] . '">
                <input type="hidden" name="mail" value="' . $_POST['mail'] . '">
                <input type="hidden" name="sexe" value="' . $_POST['sexe'] . '">
          </form>';


    if ($_SESSION['erreur'] == '') {
        $_SESSION['erreur'] = -1;
        miseajourDonnees($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['password'], $_POST['mail'], $_POST['sexe']);
        header('Location: ../view/visualisationCompteView.php');
    } else
        echo '<SCRIPT type="text/javascript">donnee.submit();</SCRIPT>';

} else {
    header('Location: ../view/modificationCompteView.php');
}


// function qui insert une personne dans la base
function  miseajourDonnees($pseudo, $nom, $prenom, $password, $mail, $sexe)
{
    $connexions = new ConnexionBD();
    $connexions->connexion();
    mysql_query('UPDATE users set pseudo=\'' . $pseudo . '\',nom=\'' . $nom . '\',prenom=\'' . $prenom . '\',password=SHA1(\'' . $password . '\'),mail=\'' . $mail . '\',sexe=\'' . $sexe . '\' where id=\'' . $_SESSION['id'] . '\' ')
    or die ("Impossible de se connecté à la table users" . mysql_error());
}

// function qui regarde si le pseudo est déjà prix
function speudoUtilisé($pseudo)
{
    $conexions = new ConnexionBD();
    $conexions->connexion();
    $req = mysql_query('SELECT * FROM users WHERE pseudo =\'' . $pseudo . '\' and id !=\'' . $_SESSION['id'] . '\'')
    or die ("Impossible de se connecté à la table users" . mysql_error());
    if (mysql_num_rows($req) != 0)
        return true;
    else
        return false;
}

// function qui regarde si l adresse mal est deja utilisée
function mailUtilisé($mail)
{
    $connexions = new ConnexionBD();
    $connexions->connexion();
    $req = mysql_query('SELECT * FROM `users` WHERE mail =\'' . $mail . '\' and id !=\'' . $_SESSION['id'] . '\'')
    or die ("Impossible de se connecté à la table users" . mysql_error());
    if (mysql_num_rows($req) != 0)
        return true;
    else
        return false;
}


// fonction qui test si l'adresse mail est conforme
function estMail($mail)
{
    $Syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{1,6}$#';
    if (preg_match($Syntaxe, $mail))
        return true;
    else
        return false;

}

// function qui indique si un champ est vide ou pas
function estVide($valeur)
{
    if ($valeur == '')
        return true;
    else
        return false;
}


