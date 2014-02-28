<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07/02/14
 * Time: 09:48
 */
session_start();
require_once('../Modele/testSessionModele.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>MemoShot - <?php echo $_SESSION['pseudo_util']; ?></title>
    <link href="../css/bootstrapbis.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
    <?php require_once('../Config/ConnexionBD.php'); ?>
</head>
<body style="background-color: #d1cece ">
<div style="height: 10%">
    <?php
    require_once('../header.php');
    ?>
</div>

<div id="separation"></div>
<div id="colonnegauche"><h1 align="center"><b>Mes amis</b></h1></div>
<div id="colonnemilieu">
    <table style="width: 100%;">
        <?php
        $moisText = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        $connexions = new ConnexionBD();
        $connexions->connexion();
        $req = mysql_query('SELECT * FROM  users where id=' . $_SESSION['id'])
        or die ("Impossible de se connecté à la table album" . mysql_error());
        $valeur = mysql_fetch_assoc($req);
        $photo_profil = $valeur['photo_profil'];
        $req1 = mysql_query('SELECT * FROM album al join users us on us.id=al.id_utilisateur')
        or die ("Impossible de se connecté à la table album" . mysql_error());
        while ($valeur = mysql_fetch_assoc($req1)) {
            $date_explosee = explode("-", $valeur['date']);
            $annee = $date_explosee[0];
            $mois = $date_explosee[1];
            $date_explosee = explode(" ", $date_explosee[2]);
            $jour = $date_explosee[0];
            $date_explosee = explode(":", $date_explosee[1]);
            $heure = $date_explosee[0];
            $minute = $date_explosee[1];
            $req2 = mysql_query('SELECT * FROM commentaires co join users us on us.id=co.id_auteur where id_publication=' . $valeur['id_publication'] . ' order by date');

            echo '<tr>
                <td>
                    <div class="poster">
                        <p><a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '"><img style="margn-left: 200px;height;50px;width: 50px;" src="' . $valeur['photo_profil'] . '"></a>&nbsp&nbsp<a href="' . dirname($_SERVER['PHP_SELF']) . '/visualisationCompteView.php?id=' . $valeur['id'] . '"><b>' . $valeur['pseudo'] . '</a></b> à ajouté cette publication le
                        ' . $jour . ' ' . $moisText[$mois - 1] . ' ' . $annee . ' à ' . $heure . 'H' . $minute . '<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $valeur['message'] . '
                         Avec @' . $valeur['tag1'] . '</p>

                        <br><p align="center"><img style="margin-left:20px;margin-top:20px;margin-bottom:20px;margin-right:20px;width:200px;height 100px;" src="' . $valeur['photo'] . '"></p>';

            while ($val = mysql_fetch_assoc($req2)) {
                $date_explosee = explode("-", $val['date']);
                $annee = $date_explosee[0];
                $mois = $date_explosee[1];
                $date_explosee = explode(" ", $date_explosee[2]);
                $jour = $date_explosee[0];
                $date_explosee = explode(":", $date_explosee[1]);
                $heure = $date_explosee[0];
                $minute = $date_explosee[1];
                echo '<div class="commentaires"><table style="height:100%;width:100%;">
                                    <tr>
                                        <td style="width:12%;">&nbsp&nbsp&nbsp&nbsp<a href="' . dirname($_SERVER['PHP_SELF']) . '/visualisationCompteView.php?id=' . $val['id'] . '"><img style="height;50px;width: 50px;" src="' . $val['photo_profil'] . '"/></a>&nbsp&nbsp&nbsp&nbsp</td>

                                        <td style="width:80%"><a href="' . dirname($_SERVER['PHP_SELF']) . '/visualisationCompteView.php?id=' . $val['id'] . '"><b>' . $val['pseudo'] . '</b></a>&nbsp&nbsp&nbsp&nbsp' . $val['commentaire'] . '</td>

                                        <td style="witdh:8%">';
                if ($val['pseudo'] == $_SESSION['pseudo_util']) echo '<a class="cancel"id="' . $val['id_commentaires'] . '" onclick="suppressionCommentaire(this.id);setTimeout(\'location.reload()\',500);"><span  class="glyphicon glyphicon-remove"></span></a>';
                echo '</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td style="font-size:75%">Le ' . $jour . ' ' . $moisText[$mois - 1] . ' ' . $annee . ' à ' . $heure . 'H' . $minute . '</td>
                                    </tr>
                                  </table></div>';
            }

            echo '<div class="commentaires">
                        <table><tr><td><br></td></tr>
                            <tr><td>
                                &nbsp&nbsp&nbsp&nbsp<img style="height;50px;width: 50px;" src="' . $photo_profil . '"/>&nbsp&nbsp&nbsp&nbsp
                                </td>
                                <td>

                                   <textarea  id="textarea' . $valeur['id_publication'] . '" onKeyUp="modifierTailleTextarea(\'textarea' . $valeur['id_publication'] . '\');" class="form-control" style="resize:none;" rows="1" cols="70" placeholder=" Laissez un commentaire ..."></textarea>
                                </td>
                                <td>
                                &nbsp&nbsp&nbsp&nbsp
                                </td>
                                <td>
                                    &nbsp&nbsp&nbsp&nbsp<input id="' . $valeur['id_publication'] . '"class="btn btn-primary btn-lg" style="margin-top:-18%;width: 100%;" type="button" value="Déposer" onclick="insertionCommentaire(this.id);setTimeout(\'location.reload()\',500);">
                                </td>
                            </tr>
                         </table></div>
                    <div>
                </td>
            </tr>
        <tr><td><br></td></tr>';
        }
        ?>
    </table>
</div>
<div id="colonnedroite"><h1 align="center"><b>Pub</b></h1></div

</body>
</html>

<script language="javascript" src="../js/accueil.js"></script>
