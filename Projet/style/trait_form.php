<?php
/**********************************************************************************
 * UNIVERSITE NICE SOPHIA ANTIPOLIS
 * PROJET DE WEB MAI 2013: PHP
 * AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
 * Th�me : formulaire d'inscription d'un nouvelle employ� envoy� par formulaire.php
 *
 *
 */

session_start();
// Parametres pour la connection a PHPmyAdmin
$ini_array = parse_ini_file("../config/login_db.ini");
$user = $ini_array["user"];
$pass = $ini_array["pass"];
$host = $ini_array["host"];
$base = $ini_array ["base"];

// Placer toutes les valeurs envoyer dans le formulaire dans des variables
foreach ($_POST as $key => &$value)
    ${$key} = $value;

/************************************************************
 * Definition des constantes / tableaux et variables
 *************************************************************/

// Constantes
define('TARGET', '../images/'); // Repertoire cible
define('MAX_SIZE', 8000000); // Taille max en octets du fichier
define('WIDTH_MAX', 5000); // Largeur max de l'image en pixels
define('HEIGHT_MAX', 3000); // Hauteur max de l'image en pixels
$degre = "1"; // Nombre de pages de retour

// Tableaux de donnees
$tabExt = array('jpg', 'gif', 'png', 'jpeg'); // Extensions autorisees
$infosImg = array();

// Variables
$extension = '';
$message = '';
$nomImage = '';
$verif = false;
$uploadphoto = false;

/************************************************************
 * Script d'upload
 *************************************************************/
if (!empty($_POST)) {
    // On verifie si le champ est rempli
    if (!empty($_FILES['photo']['name'])) {
        // Recuperation de l'extension du fichier
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

        // On verifie l'extension du fichier

        if (in_array(strtolower($extension), $tabExt)) {
            // On recupere les dimensions du fichier
            list($width, $height, $type, $attr) = getimagesize($_FILES['photo']['tmp_name']);

            // On verifie le type de l'image
            if ($type >= 1 && $type <= 14) {
                // On verifie les dimensions et taille de l'image
                if (($width <= WIDTH_MAX) && ($height <= HEIGHT_MAX) && (filesize($_FILES['photo']['tmp_name']) <= MAX_SIZE)) {
                    // Parcours du tableau d'erreurs
                    if (isset($_FILES['photo']['error'])
                        && UPLOAD_ERR_OK === $_FILES['photo']['error']
                    ) {
                        // On renomme le fichier
                        $nomImage = $identifiant . '.' . $extension;

                        // Si c'est OK, on teste l'upload
                        if (move_uploaded_file($_FILES['photo']['tmp_name'], TARGET . $nomImage)) {
                            $message = 'Upload reussi !';
                            $verif = true;
                            $uploadphoto = true;
                        } else {
                            // Sinon on affiche une erreur systeme
                            $message = 'Probleme lors de l\'upload ! C\'est surement du aux droits administrateur!';
                        }
                    } else {
                        $message = 'Une erreur interne a empech&eacute l\'upload de l\'image';
                    }
                } else {
                    // Sinon erreur sur les dimensions et taille de l'image
                    $message = 'Erreur dans les dimensions de l\'image !';
                }
            } else {
                // Sinon erreur sur le type de l'image
                $message = 'Le fichier a uploader n\'est pas une image ou l\'image est superieur a 8Mo';
            }
        } else {
            // Sinon on affiche une erreur pour l'extension
            $message = 'L\'extension du fichier est incorrecte !';
        }
    } else {
        //vous n'avez pas choisi de photo
        $verif = true;
    }

}
if ($verif == true) {
    shell_exec("chmod 777 /home/mathieu/web/projet_Progweb/Projet/images/" . $nomImage);
    // Connexion a phpmyadmin
    if ($pass == "")
        $bdd = mysql_connect($host, $user) or die('Impossible de se connecter: ' . mysql_error());
    else
        $bdd = mysql_connect($host, $user, $pass) or die('Impossible de se connecter: ' . mysql_error());

    // Connection � la base de donn�e
    mysql_select_db($base, $bdd) or die('Impossible de se connecter: ' . mysql_error());

    if ($uploadphoto == true)
        $photo = $nomImage;
    else
        $photo = "default.jpg";

    $req1 = "INSERT INTO `personnel`(`identifiant`, `civilite`, `nom`, `prenom`, `numFix`, `numPort`, `numFax`, `email`, `url`, `photo`, `mdp`)
			VALUES ('$identifiant', '$civilite', '" . strtoupper($nom) . "', '$prenom', '$numFix', '$numPort', '$numFax', '$email', '$url', '$photo', '$mdp')";
    $req2 = "INSERT INTO `personnel_batiment`(`Identifiant`, `code`)
			VALUES ('$identifiant','$bat')";
    $req4 = "INSERT INTO `personnel_fonction`(`Identifiant`, `code`)
			VALUES ('$identifiant','$fonction')";
    $req5 = "INSERT INTO `personnel_pole`(`Identifiant`, `code`)
			VALUES ('$identifiant','$pole')";

    // Emission des requetes
    mysql_query($req1)
    or die ("Impossible de se connect&eacute; &agrave; la table 'personnel'" . mysql_error());

    foreach ($unit as $value) {
        $req3 = "INSERT INTO `personnel_unite`(`Identifiant`, `code`)
			VALUES ('$identifiant','$value')";
        mysql_query($req3)
        or die ("Impossible de se connect&eacute; &agrave; la table 'personnel_unite'" . mysql_error());
    }


    mysql_query($req2)
    or die ("Impossible de se connect&eacute; &agrave; la table 'personnel_batiment'");
    mysql_query($req4)
    or die ("Impossible de se connect&eacute; &agrave; la table 'personnel_fonction'");
    mysql_query($req5)
    or die ("Impossible de se connect&eacute; &agrave; la table 'personnel_pole'");

    mysql_close($bdd);
    echo "La nouvelle personne a bien ete enregistree";
    $degre = "2";
} else
    echo $message;
?>

<input type="button" onClick="javascript:window.history.go(-<?php echo $degre; ?>)" value="Retour"/>

   
