<?php
/**
 * Created by PhpStorm.
 * User: Rulio
 * Date: 21/02/14
 * Time: 14:53
 */
session_start();
require_once('../Config/ConnexionBD.php');
$_SESSION['erreur'] = '';
$nom = $_POST['nom'];
$message = $_POST['description'];
$tag1 = $_POST['ht1'];
$tag2 = $_POST['h2'];
$tag3 = $_POST['h3'];
$tag4 = $_POST['h4'];
$tag5 = $_POST['h5'];
if ($_FILES['photo']['tmp_name'] == '') {
    $_SESSION['erreur'] = $_SESSION['erreur'] . ' Votre devez choisir une photo<br> Vous devez uploader un fichier de type png, gif, jpg, jpeg et de taille maximun 2 Mo' . '<br>';
} else {
    if ($_FILES['photo']['tmp_name'] != '') {
        // on test l'image
        if (!imageValide($_FILES['photo']['tmp_name'], $_FILES['photo']['name']))
            $_SESSION['erreur'] = $_SESSION['erreur'] . ' Votre photo que vous avez choisi n\'est pas valide  Vous devez uploader un fichier de type png, gif, jpg, jpeg et de taille maximun 2 Mo' . '<br>';
    }
}

if ($_SESSION['erreur'] == '') {
    $_SESSION['erreur'] = -1;
    $cheminPhoto = envoiImage($_FILES['photo']['tmp_name'], $_FILES['photo']['name']);
    insertionPhoto($nom, $message, $tag1, $tag2, $tag3, $tag4, $tag5, $cheminPhoto);
}

header('Location: ../view/ajouterUnePhotoView.php');


function  insertionPhoto($nom, $message, $tag1, $tag2, $tag3, $tag4, $tag5, $photo)
{
    $connexions = new ConnexionBD();
    $connexions->connexion();
    mysql_query('INSERT INTO album (id_utilisateur,nom,message,tag1,tag2,tag3,tag4,tag5,photo) VALUES (\'' . $_SESSION['id'] . '\',"' . $nom . '","' . $message . '","' . $tag1 . '","' . $tag2 . '","' . $tag3 . '","' . $tag4 . '","' . $tag5 . '",\'' . $photo . '\')')
    or die ("Impossible de se connecté à la table album" . mysql_error());
    if (isset($_POST['Profil']))
        mysql_query('UPDATE users set photo_profil="' . $photo . '" where id="' . $_SESSION['id'] . '"')
        or die ("Impossible de se connecté à la table album" . mysql_error());
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
