<?php
/**
 * Created by PhpStorm.
 * User: Rulio
 * Date: 21/02/14
 * Time: 17:02
 */

session_start();
require_once('../Modele/testSessionModele.php');
require_once('../Config/ConnexionsBD.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>MemoShot - <?php echo $_SESSION['pseudo_util']; ?></title>
    <link href="../css/bootstrapbis.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body style="background-color: #43A1CF ">
<div style="height: 10%">
    <?php
    require_once('../header.php');
    ?>
</div>

<div class="container" style="margin-bottom:2%;margin-top:8%;background-color: #43A1CF ">

    <div class="content">
        <h1 align="center">Album Photo de <?php echo $_SESSION['pseudo_util']; ?></h1>

        <p>&nbsp;</p>

        <p>&nbsp;</p>

        <div class="polaroid-images">
            <?php
            $compteur = 1;
            $connexions = new ConnexionsBD();
            $connexions->connexions();
            $req = mysql_query('SELECT * FROM album  where id_utilisateur=\'' . $_SESSION['id'] . '\'')
            or die ("Impossible de se connecté à la table album" . mysql_error());
            while ($valeur = mysql_fetch_assoc($req)) {
                $image = $valeur['photo'];
                $nom = $valeur['nom'];
                echo '<a href="" title="' . $nom . '"><img height="200" src="' . $image . '" alt="Cave" title="Cave"/></a>';
                $compteur++;
            }
            ?>
        </div>

        <?php

        for ($i = 0; $i < 4.5 * $compteur; $i++) {
            echo '<p>&nbsp;</p>';
        }
        ?>


    </div>
    <div class="footer">
        <!-- end .footer -->
    </div>
    <!-- end .container --></div>
</body>
</html>



