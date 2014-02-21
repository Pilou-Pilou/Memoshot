<?php

session_start();
$_SESSION['profile'] = 46;
require_once('../Config/ConnexionsBD.php');
$connexions = new ConexionsBD();
$connexions->conexions();

// recuperartion des informations concernat le profil de la personne
$req = mysql_query('SELECT * FROM users us join abonement abo on abo.id_abo=us.abonement WHERE id =\'' . $_SESSION['id'] . '\'')
or die ("Impossible de se connecté à la table users" . mysql_error());
$row = mysql_fetch_array($req);
$_SESSION['pseudo'] = $row['pseudo'];
$_SESSION['nom'] = $row['nom'];
$_SESSION['prenom'] = $row['prenom'];
$image = $row['photo'];
$image = '../images/profil.jpg';
if ($row['sexe'] == 'M')
    $_SESSION['sexe'] = 'Masculin';
else
    $_SESSION['sexe'] = 'Féminin';
$_SESSION['mail'] = $row['mail'];
$_SESSION['abonement'] = $row['type_abonement'];
$_SESSION['naissance'] = $row['naissance'];
$date_explosee = explode("-", $_SESSION['naissance']);
$jour = $date_explosee[2];
$mois = $date_explosee[1];
$annee = $date_explosee[0];
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


// recuperations des informations pour savoir quelle bouton afficher
$bouton = 'ajout';
if ($_SESSION['id'] != $_SESSION['profile']) {
    $req = mysql_query('SELECT * FROM amis WHERE id_amis_2 =\'' . $_SESSION['id'] . '\' and id_amis_1 =\'' . $_SESSION['profile'] . '\' or id_amis_1 =\'' . $_SESSION['id'] . '\' and id_amis_2 =\'' . $_SESSION['profile'] . '\'')
    or die ("Impossible de se connecté à la table users" . mysql_error());
    if (mysql_num_rows($req) == 1) {
        $req = mysql_query('SELECT * FROM amis WHERE (id_amis_2 =\'' . $_SESSION['id'] . '\' and id_amis_1 =\'' . $_SESSION['profile'] . '\') or (id_amis_1 =\'' . $_SESSION['id'] . '\' and id_amis_2 =\'' . $_SESSION['profile'] . '\') and  status_amitier=0')
        or die ("Impossible de se connecté à la table users" . mysql_error());
        if (mysql_num_rows($req) == 1) {
            $bouton = 'attente';
        } else {
            $bouton = 'supprimer';
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

            <p align="center">Abonement : <?php echo $_SESSION['abonement']; ?></p></div>
        <p align="center">&nbsp;</p>

        <p align="center">&nbsp;</p>

        <form method="post" action=""><p align="center">
                <?php  if ($_SESSION['id'] == $_SESSION['profile']) {
                    echo '<input onclick="location.href=\'../view/modificationCompteView.php\'" class="btn btn-warning" type="button" name="Modif" id="Modif" value="Modifier" />';
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="btn btn-primary" type="submit" name="ModifierCompte" id="ModifierCompte" value="Album Photo" />';
                } else {
                    if ($bouton == 'supprimer') {
                        echo '<input class="btn btn-danger" type="submit" name="Suppr" id="Suppr" value="Supprimer" />';
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="btn btn-primary" type="submit" name="ModifierCompte" id="ModifierCompte" value="Album Photo" />';
                    } else
                        if ($bouton == 'attente') {
                            echo '<input class="btn btn-default" type="submit" name="Annuler" id="Annuler" value="Annuler Demande d\'ajout... " />';
                        } else {
                            echo '<input class="btn btn-success" type="submit" name="Ajout" id="Ajout" value="Ajouter" />';
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