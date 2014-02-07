<?php
/**********************************************************************************
 * UNIVERSITE NICE SOPHIA ANTIPOLIS
 * PROJET DE WEB MAI 2013: PHP
 * AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
 * Thème : formulaire de modification d'un nouvelle employé envoyé par formulaire.php
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
define('MAX_SIZE', 800000); // Taille max en octets du fichier
define('WIDTH_MAX', 5000); // Largeur max de l'image en pixels
define('HEIGHT_MAX', 3000); // Hauteur max de l'image en pixels

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
                        $nomImage = $prenom . '.' . $extension;

                        if (file_exists("../images/" . $nomImage)) {
                            chmod("../images/" . $nomImage, 0777);
                            unlink("../images/" . $nomImage);
                        }


                        // Si c'est OK, on teste l'upload
                        if (move_uploaded_file($_FILES['photo']['tmp_name'], TARGET . $nomImage)) {
                            $message = 'Upload réussi !';
                            $verif = true;
                            $uploadphoto = true;
                        } else {
                            // Sinon on affiche une erreur systeme
                            $message = 'Probleme lors de l\'upload ! C\'est surement du aux droits administrateur!';
                        }
                    } else {
                        $message = 'Une erreur interne a empeche l\'upload de l\'image';
                    }
                } else {
                    // Sinon erreur sur les dimensions et taille de l'image
                    $message = 'Erreur dans les dimensions de l\'image !';
                }
            } else {
                // Sinon erreur sur le type de l'image
                $message = 'Le fichier a uploader n\'est pas une image ou sa taille depasse 8Mo';
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
    if ($uploadphoto == true) {
        // Connexion a phpmyadmin
        if ($pass == "")
            $bdd = mysql_connect($host, $user) or die('Impossible de se connecter: ' . mysql_error());
        else
            $bdd = mysql_connect($host, $user, $pass) or die('Impossible de se connecter: ' . mysql_error());

        // Connection à la base de donnée
        mysql_select_db($base, $bdd) or die('Impossible de se connecter: ' . mysql_error());

        shell_exec("chmod 777 /home/mathieu/web/projet_Progweb/Projet/images/" . $nomImage);

        $nom = strtoupper($nom);

        $req1 = "UPDATE `personnel`
		SET civilite='$civilite', nom='$nom', prenom='$prenom', numFix='$numFix', numPort='$numPort', numFax='$numFax', email='$email', url='$url', photo='$nomImage', mdp='$mdp'
			WHERE Identifiant='$identifiant'";

        $req4 = "UPDATE `personnel_fonction`
			SET `code`='$fonction'
			WHERE Identifiant='$identifiant'";
        $req5 = "UPDATE `personnel_pole`
			SET `code`='$pole'
			WHERE Identifiant='$identifiant'";
        $req2 = "UPDATE `personnel_batiment`
			SET `code`='$bat'
			WHERE Identifiant='$identifiant'";
        // Emission des requetes
        mysql_query($req1)
        or die ("Impossible de se connecter; &agrave; la table 'personnel'" . mysql_error());
        mysql_query($req2)
        or die ("Impossible de se connecter; &agrave; la table 'personnel_batiment'");
        mysql_query($req4)
        or die ("Impossible de se connecter; &agrave; la table 'personnel_fonction'");
        mysql_query($req5)
        or die ("Impossible de se connecter; &agrave; la table 'personnel_pole'");

        // $reqd = "DELETE FROM personnel_unite WHERE Identifiant = '$identifiant'";
        // mysql_query($reqd)
        // or die ("Impossible d'executer correctement la requette");

        // foreach($unit as $value)
        // {
        // $req3 = "INSERT INTO `personnel_unite`(`Identifiant`, `code`)
        // VALUES ('$identifiant','$value')";
        // mysql_query($req3)
        // or die ("Impossible de se connect&eacute; &agrave; la table 'personnel_unite'" . mysql_error());
        // }
        echo "La modification a ete realisee.";
        mysql_close($bdd);
    } else { // Connexion a phpmyadmin
        if ($pass == "")
            $bdd = mysql_connect($host, $user) or die('Impossible de se connecter: ' . mysql_error());
        else
            $bdd = mysql_connect($host, $user, $pass) or die('Impossible de se connecter: ' . mysql_error());

        // Connection à la base de donnée
        mysql_select_db($base, $bdd) or die('Impossible de se connecter: ' . mysql_error());


        $nom = strtoupper($nom);

        $req1 = "UPDATE `personnel`
			SET civilite='$civilite', nom='$nom', prenom='$prenom', numFix='$numFix', numPort='$numPort', numFax='$numFax', email='$email', url='$url', mdp='$mdp'
				WHERE Identifiant='$identifiant'";
        $req2 = "UPDATE `personnel_batiment`
				SET `code`='$bat'
				WHERE Identifiant='$identifiant'";
        $req4 = "UPDATE `personnel_fonction`
				SET `code`='$fonction'
				WHERE Identifiant='$identifiant'";
        $req5 = "UPDATE `personnel_pole`
				SET `code`='$pole'
				WHERE Identifiant='$identifiant'";

        // Emission des requetes
        mysql_query($req1)
        or die ("Impossible de se connecter; &agrave; la table 'personnel'" . mysql_error());
        mysql_query($req2)
        or die ("Impossible de se connecter; &agrave; la table 'personnel_batiment'" . mysql_error());
        mysql_query($req4)
        or die ("Impossible de se connecter; &agrave; la table 'personnel_fonction'");
        mysql_query($req5)
        or die ("Impossible de se connecter; &agrave; la table 'personnel_pole'");

        // $reqd = "DELETE FROM personnel_unite WHERE Identifiant = '$identifiant'";
        // mysql_query($reqd)
        // or die ("Impossible d'executer correctement la requette");

        // foreach($unit as $value)
        // {
        // $req3 = "INSERT INTO `personnel_unite`(`Identifiant`, `code`)
        // VALUES ('$identifiant','$value')";
        // mysql_query($req3)
        // or die ("Impossible de se connect&eacute; &agrave; la table 'personnel_unite'" . mysql_error());
        // }
        echo "La modification a ete realisee.";
        mysql_close($bdd);
    }
} else
    echo $message;
?>

<input type="button" onClick="javascript:window.history.go(-2)" value="Retour"/>

   
