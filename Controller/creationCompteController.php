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
    if (estVide($_POST['pseudo']) && estVide($_POST['password']) && estVide($_POST['passwordVerif']) && estVide($_POST['nom']) && estVide($_POST['prenom']) && estVide($_POST['naissance']) && estVide($_POST['mail']))
        $_SESSION['erreur'] = ' Veuillez bien complétez tous les champs' . '<br>';

    // verifier si les mot de passe sont bon
    if ($_POST['password'] != $_POST['passwordVerif'])
        $_SESSION['erreur'] = $_SESSION['erreur'] . ' Veuillez tapez le même mot de passe' . '<br>';

    // on verifie que l'adresse mail est valide
    if (!estMail($_POST['mail']))
        $_SESSION['erreur'] = $_SESSION['erreur'] . ' Veuillez rentrez une adresse mail valide ' . '<br>';


    // on verifie la date de naissance soit conforme
    if (!valideDate($_POST['naissance']))
        $_SESSION['erreur'] = $_SESSION['erreur'] . ' Veuillez rentrez une date de naissance valide' . '<br>';

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

    if ($_FILES['photo']['tmp_name'] != '') {
        // on test l'image
        if (!imageValide($_FILES['photo']['tmp_name'], $_FILES['photo']['name']))
            $_SESSION['erreur'] = $_SESSION['erreur'] . ' Votre photo que vous avez choisi n\'est pas valide  Vous devez uploader un fichier de type png, gif, jpg, jpeg et de taille maximun 2 Mo' . '<br>';
    }

    echo '<form method="post" name="donnee" action="../view/creationCompteView.php">
                <input type="hidden" name="pseudo" value="' . $_POST['pseudo'] . '">
                <input type="hidden" name="nom" value="' . $_POST['nom'] . '">
                <input type="hidden" name="prenom" value="' . $_POST['prenom'] . '">
                <input type="hidden" name="mail" value="' . $_POST['mail'] . '">
                <input type="hidden" name="naissance" value="' . $_POST['naissance'] . '">
                <input type="hidden" name="sexe" value="' . $_POST['sexe'] . '">
          </form>';

    $cheminPhoto = '';

    if ($_SESSION['erreur'] == '') {
        $_SESSION['erreur'] = -1;
        if (isset($_FILES['photo']['tmp_name']))
            $cheminPhoto = envoiImage($_FILES['photo']['tmp_name'], $_FILES['photo']['name']);
        $id = insertionDonnees($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['password'], $_POST['naissance'], $_POST['mail'], $_POST['sexe'], $cheminPhoto);
        mailEnvoi($_POST['mail'], $id);
        header('Location: ../');
    } else
        echo '<SCRIPT type="text/javascript">donnee.submit();</SCRIPT>';

} else {
    header('Location: ../view/creationCompteView.php');
}

// function qui envoi le mail pour la confirmation d'inscription
function mailEnvoi($mail, $id)
{


    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
    {
        $passage_ligne = "\r\n";
    } else {
        $passage_ligne = "\n";
    }
//=====Déclaration du messages au format HTML.
    $message_html = '<h1 style="text-align: center;"><span style="font-family:comic sans ms,cursive">Inscription Memoshot</span></h1>



                        <pre>
                        &nbsp;</pre>

                        <p style="text-align: center;"><span style="font-family:courier new,courier,monospace">F&eacute;licitation vous venez de vous inscrire sur notre site memoshot.<br />
                        Pour finaliser cette inscription cliquez sur le lien ci dessous :</span></p>

                        <p style="text-align: center;"><a href="http://205.236.12.51/projet/h2014/equipe3/view/validationCompteView?id=' . $id . '">Valider votre inscription</a><br />
                        <img src="http://205.236.12.51/projet/h2014/equipe3/images/logo.png" /></p>

                        <p style="text-align: center;">Pour tout renseignement contacter l&#39;&eacute;quipe de memoshot à l&#39;adresse suivante :</p>

                        <p style="text-align: center;"><a href="mailto:memoshot.memoshot@gmail.com">memoshot.memoshot@gmail.com</a></p>';
//==========

//=====Création de la boundary
    $boundary = "-----=" . md5(rand());
//==========

//=====Définition du sujet.
    $sujet = "Validation Inscription Memoshot !";
//=========

//=====Création du header de l'e-mail.
    $header = "From: \"Memoshot\"<memoshot.memoshot@gmail.com>" . $passage_ligne;
    $header .= "Reply-to: \"Memoshot\" <memoshot.memoshot@gmail.com>" . $passage_ligne;
    $header .= "MIME-Version: 1.0" . $passage_ligne;
    $header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
//==========

    $message = $passage_ligne . "--" . $boundary . $passage_ligne;
//=====Ajout du message au format HTML
    $message .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;
    $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
    $message .= $passage_ligne . $message_html . $passage_ligne;
//==========
    $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
    $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
//==========

//=====Envoi de l'e-mail.
    mail($mail, $sujet, $message, $header);
//==========

}

// function qui insert une personne dans la base
function  insertionDonnees($pseudo, $nom, $prenom, $password, $naissance, $mail, $sexe, $photo)
{
    $connexions = new ConnexionBD();
    $connexions->connexion();
    mysql_query('INSERT INTO users (pseudo,nom,prenom,password,mail,naissance,sexe,photo) VALUES (\'' . $pseudo . '\',\'' . $nom . '\',\'' . $prenom . '\',SHA1(\'' . $password . '\'),\'' . $mail . '\',STR_TO_DATE(\'' . $naissance . '\',\'%d/%m/%Y\'),\'' . $sexe . '\',\'' . $photo . '\')')
    or die ("Impossible de se connecté à la table users" . mysql_error());
    $id = mysql_insert_id();
    return $id;
}

// function qui regarde si le pseudo est déjà prix
function speudoUtilisé($pseudo)
{
    $connexions = new ConnexionBD();
    $connexions->connexion();
    $req = mysql_query('SELECT * FROM users WHERE pseudo =\'' . $pseudo . '\'')
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
    $req = mysql_query('SELECT * FROM `users` WHERE mail =\'' . $mail . '\'')
    or die ("Impossible de se connecté à la table users" . mysql_error());
    if (mysql_num_rows($req) != 0)
        return true;
    else
        return false;
}

// fonction qui test si la date de naissance est valide
function valideDate($date)
{
    $date_explosee = explode("/", $date);

    if (checkdate($date_explosee[1], $date_explosee[0], $date_explosee[2])) {
        $date_explosee_jour = explode("-", date("Y-m-d"));
        if ($date_explosee[2] < $date_explosee_jour[0])
            return true;
        else
            return false;
    } else
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

// fonction qui dit si l'image peut etre envoyer
function imageValide($photosize, $photoname)
{

    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($photoname, '.');
    //Début des vérifications de sécurité...
    if (!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau
        return false;
    }

    $taille_maxi = 2000000;
    $taille = filesize($photosize);
    if ($taille > $taille_maxi) {
        return false;
    }

    return true;
}

// fonction qui envoi l'image sur le serveur
function envoiImage($photosize, $photoname)
{
    $dossier = '../upload/';
    $extension = strrchr($photoname, '.');

    $char = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $fichier = str_shuffle($char);
    $fichier = substr($fichier, 0, 10);

    if (move_uploaded_file($photosize, $dossier . $fichier . $extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        return $dossier . $fichier . $extension;
    else
        return '';
}
