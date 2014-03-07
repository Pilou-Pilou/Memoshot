<?php

session_start();
require_once('../Modele/testSessionModele.php');

if (isset($_GET['id']))
    $_SESSION['profile'] = $_GET['id'];
else
    $_SESSION['profile'] = $_SESSION['id'];


require_once('../Config/ConnexionBD.php');
$connexions = new ConnexionBD();
$connexions->connexion();
// recuperartion des informations concernat le profil de la personne
$req = mysql_query('SELECT * FROM users us join abonnement abo on abo.id_abonnement=us.abonnement WHERE id =\'' . $_SESSION['profile'] . '\'')
or die ("Impossible de se connecté à la table users" . mysql_error());
$row = mysql_fetch_array($req);
$_SESSION['pseudo'] = $row['pseudo'];
$_SESSION['nom'] = $row['nom'];
$_SESSION['prenom'] = $row['prenom'];
$image = $row['photo_profil'];
if ($image == '')
    $image = '../images/default.gif';
if ($row['sexe'] == 'M')
    $_SESSION['sexe'] = 'Masculin';
else
    $_SESSION['sexe'] = 'Féminin';
$_SESSION['mail'] = $row['mail'];
switch ($row['type_abonnement']) {
    case 0:
        $_SESSION['abonnement'] = ' Classique (Gratuit)';
        break;
    case 1:
        $_SESSION['abonnement'] = ' Premiun Gold';
        break;
    case 2:
        $_SESSION['abonnement'] = ' Premium Silver';
        break;
    case 3:
        $_SESSION['abonnement'] = ' Premiun Bronze';
        break;
}
$_SESSION['naissance'] = $row['naissance'];
$date_explosee = explode("-", $_SESSION['naissance']);
$annee = $date_explosee[0];
$mois = $date_explosee[1];
$jour = $date_explosee[2];
$moisText = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$mois = $moisText[$mois - 1];

// on regarde si on a une action à faire
if (isset($_POST['Suppr']) || isset($_POST['Annuler'])) {
    $req = mysql_query('DELETE FROM amis WHERE id_amis_2 =\'' . $_SESSION['id'] . '\' and id_amis_1 =\'' . $_SESSION['profile'] . '\' or id_amis_1 =\'' . $_SESSION['id'] . '\' and id_amis_2 =\'' . $_SESSION['profile'] . '\'')
    or die ("Impossible de se connecté à la table users" . mysql_error());
}

if (isset($_POST['Ajout'])) {
    mysql_query('INSERT INTO amis(id_amis_1,id_amis_2) VALUES (\'' . $_SESSION['id'] . '\',\'' . $_SESSION['profile'] . '\')');
}

if (isset($_POST['Accepter'])) {
    mysql_query('UPDATE amis set status_amitier=1 where id_amis_2=\'' . $_SESSION['id'] . '\' and id_amis_1=\'' . $_SESSION['profile'] . '\'');
}


// recuperations des informations pour savoir quelle bouton afficher
$bouton = 'ajout';
if ($_SESSION['id'] != $_SESSION['profile']) {
    $req = mysql_query('SELECT * FROM amis WHERE id_amis_2 =\'' . $_SESSION['id'] . '\' and id_amis_1 =\'' . $_SESSION['profile'] . '\' or id_amis_1 =\'' . $_SESSION['id'] . '\' and id_amis_2 =\'' . $_SESSION['profile'] . '\'')
    or die ("Impossible de se connecté à la table users" . mysql_error());
    if (mysql_num_rows($req) == 1) {
        $req = mysql_query('SELECT * FROM amis WHERE (id_amis_2 =\'' . $_SESSION['id'] . '\' and id_amis_1 =\'' . $_SESSION['profile'] . '\' and  status_amitier=0)')
        or die ("Impossible de se connecté à la table users" . mysql_error());
        if (mysql_num_rows($req) == 1) {
            $bouton = 'attente1';
        } else {
            $req = mysql_query('SELECT * FROM amis WHERE (id_amis_1 =\'' . $_SESSION['id'] . '\' and id_amis_2 =\'' . $_SESSION['profile'] . '\' and  status_amitier=0)')
            or die ("Impossible de se connecté à la table users" . mysql_error());
            if (mysql_num_rows($req) == 1) {
                $bouton = 'attente2';
            } else {
                $bouton = 'supprimer';
            }
        }
    }


}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>MemoShot - <?php echo $_SESSION['pseudo']; ?></title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body style="background-color: #43A1CF ">
<div style="height: 10%">
    <?php
    require_once('../header.php');
    ?>
</div>

<div style="margin-top:8%;background-color: #43A1CF " class="container">

    <div class="content">
        <p>&nbsp;      </p>


        <div align="center">
            <div align="center" class="roundedImageShadow"><img style="height: 120px;width: 120px;"
                                                                src="<?php echo $image; ?>" alt="1"/></div>
            <br>

            <h1 align="center"><?php echo $_SESSION['pseudo']; ?></h1>

            <p align="center">&nbsp;</p>

            <p align="center">Nom : <?php echo $_SESSION['nom']; ?></p>

            <p align="center">Pénom : <?php echo $_SESSION['prenom']; ?></p>

            <p align="center">Sexe : <?php echo $_SESSION['sexe']; ?></p>

            <p align="center">Née le <?php echo $jour . ' ' . $mois . ' ' . $annee ?></p>

            <p align="center">Mail : <?php echo $_SESSION['mail']; ?></p>

            <p align="center">Abonnement : <?php echo $_SESSION['abonnement']; ?></p></div>


        <p align="center">&nbsp;</p>

        <form method="post" action=""><p align="center">
                <?php  if ($_SESSION['id'] == $_SESSION['profile']) {
                    echo '<input onclick="location.href=\'../view/modificationCompteView.php\'" class="btn btn-warning" type="button" name="Modif" id="Modif" value="Modifier" />';
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input onclick="location.href=\'../view/albumView.php\'" class="btn btn-primary" type="button" name="album" id="album" value="Album Photo" />';
                } else {
                    if ($bouton == 'supprimer') {
                        echo '<input class="btn btn-danger" type="submit" name="Suppr" id="Suppr" value="Supprimer" />';
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input onclick="location.href=\'../view/albumView.php\'" class="btn btn-primary" type="button" name="album" id="album" value="Album Photo" />';
                    } else
                        if ($bouton == 'attente1') {
                            echo '<input class="btn btn-success" type="submit" name="Accepter" id="Accepter" value="Accepter l\'invitation " />';
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="btn btn-default" type="submit" name="Annuler" id="Annuler" value="Annuler Demande d\'ajout... " />';
                        } else {
                            if ($bouton == 'attente2') {
                                echo '<input class="btn btn-default" type="submit" name="Annuler" id="Annuler" value="Annuler Demande d\'ajout... " />';
                            } else {
                                echo '<input class="btn btn-success" type="submit" name="Ajout" id="Ajout" value="Ajouter" />';
                            }
                        }
                }
                ?>
            </p></form>

        <p align="center">&nbsp;</p>
    </div>
    <div class="footer">
        <!-- end .footer -->
    </div>
    <!-- end .container --></div>
</body>
</html>