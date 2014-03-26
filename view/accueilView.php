<?php
session_start();
require_once('../Modele/testSessionModele.php');
require_once('../Modele/cryptModele.php');

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
<body style="background-color: #43A1CF ">

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div style="height: 10%">
    <?php
    require_once('../header.php');
    ?>
</div>

<div id="separation"></div>
<div id="colonnegauche"><h1 align="center"><b>Mes amis</b></h1>
    <?php
    $connexions = new ConnexionBD();
    $connexions->connexion();
    $req1 = mysql_query('SELECT id_amis_1 as id_amis,pseudo,photo_profil FROM amis am join users us on am.id_amis_1=us.id  where id_amis_2=' . $_SESSION['id'] . ' and status_amitier=1 union SELECT id_amis_2 as id_amis,pseudo,photo_profil FROM amis am join users us on am.id_amis_2=us.id where id_amis_1=' . $_SESSION['id'] . ' and status_amitier=1')
    or die ("Impossible de se connecté à la table album" . mysql_error());
    while ($valeur = mysql_fetch_assoc($req1)) {
        echo '&nbsp<a href="../view/visualisationCompteView.php?id=' . $valeur['id_amis'] . '"><img style="margn-left: 200px;height;50px;width: 50px;" src="' . $valeur['photo_profil'] . '"></a>&nbsp&nbsp<a href="../view/visualisationCompteView.php?id=' . $valeur['id_amis'] . '"><b>' . $valeur['pseudo'] . '</a></b>';
        echo '<br>';
        echo '<br>';
    }
    ?>


</div>
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
        if (isset($_GET['rechercher'])) {
            $scryp = new cryptModele();
            // On le décrypte
            $message_decrypte = mcrypt_decrypt(MCRYPT_3DES, $_SESSION['key'], $_GET['rechercher'], MCRYPT_MODE_NOFB, $_SESSION['iv']);
            $recherche = $message_decrypte;
            if ($recherche != '') {
                $req1 = 'SELECT * FROM album al join users us on us.id=al.id_utilisateur where upper(al.tag1) like upper("%' . $recherche . '%") or upper(al.tag2) like upper("%' . $recherche . '%") or upper(al.tag3) like upper("%' . $recherche . '%") or upper(al.tag4) like upper("%' . $recherche . '%") or upper(al.tag5) like upper("%' . $recherche . '%")';
                $req2 = mysql_query($req1)
                or die ("Impossible de se connecté à la table album" . mysql_error());
                if (mysql_num_rows($req2) == 0) {
                    $req2 = mysql_query('SELECT * FROM album al join users us on us.id=al.id_utilisateur where al.id_utilisateur in
                                (
                                select id_amis_1 from amis where id_amis_2=' . $_SESSION['id'] . ' and status_amitier=1
                                union
                                select id_amis_2 from amis where id_amis_1=' . $_SESSION['id'] . ' and status_amitier=1
                                union
                                select id from users where id=' . $_SESSION['id'] . '
                                ) order by al.date desc')
                    or die ("Impossible de se connecté à la table album" . mysql_error());
                }
            } else {
                $req2 = mysql_query('SELECT * FROM album al join users us on us.id=al.id_utilisateur where al.id_utilisateur in
                                (
                                select id_amis_1 from amis where id_amis_2=' . $_SESSION['id'] . ' and status_amitier=1
                                union
                                select id_amis_2 from amis where id_amis_1=' . $_SESSION['id'] . ' and status_amitier=1
                                union
                                select id from users where id=' . $_SESSION['id'] . '
                                ) order by al.date desc')
                or die ("Impossible de se connecté à la table album" . mysql_error());
            }
        } else {
            $req2 = mysql_query('SELECT * FROM album al join users us on us.id=al.id_utilisateur where al.id_utilisateur in
                                (
                                select id_amis_1 from amis where id_amis_2=' . $_SESSION['id'] . ' and status_amitier=1
                                union
                                select id_amis_2 from amis where id_amis_1=' . $_SESSION['id'] . ' and status_amitier=1
                                union
                                select id from users where id=' . $_SESSION['id'] . '
                                ) order by al.date desc')
            or die ("Impossible de se connecté à la table album" . mysql_error());
        }
        while ($valeur = mysql_fetch_assoc($req2)) {
            $date_explosee = explode("-", $valeur['date']);
            $annee = $date_explosee[0];
            $mois = $date_explosee[1];
            $date_explosee = explode(" ", $date_explosee[2]);
            $jour = $date_explosee[0];
            $date_explosee = explode(":", $date_explosee[1]);
            $heure = $date_explosee[0];
            $minute = $date_explosee[1];
            $req3 = mysql_query('SELECT * FROM commentaires co join users us on us.id=co.id_auteur where id_publication=' . $valeur['id_publication'] . ' order by date');

            echo '<tr>
                <td>
                    <div class="poster">
                        <p><a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '"><img style="margn-left: 200px;height;50px;width: 50px;" src="' . $valeur['photo_profil'] . '"></a>&nbsp&nbsp<a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '"><b>' . $valeur['pseudo'] . '</b></a> à ajouté cette publication le
                        ' . $jour . ' ' . $moisText[$mois - 1] . ' ' . $annee . ' à ' . $heure . 'H' . $minute . '<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $valeur['message'] . '
                         Avec @' . $valeur['tag1'];

            if ($valeur['tag2'] != '')
                echo ', @' . $valeur['tag2'];
            if ($valeur['tag3'] != '')
                echo ', @' . $valeur['tag3'];
            if ($valeur['tag4'] != '')
                echo ', @' . $valeur['tag4'];
            if ($valeur['tag5'] != '')
                echo ', @' . $valeur['tag5'];


            $photo_explosee = explode("/", $valeur['photo']);

            $image = $photo_explosee[2];

            $lien = "http://www.facebook.com/plugins/like.php?href=http://205.236.12.51/projet/h2014/equipe3/upload/" . $image . "&layout=button_count&show_faces=false&width=100&action=like&font&colorscheme=light&height=21";

            echo '</p>

                        <br><p align="center"><img style="margin-left:20px;margin-top:20px;margin-bottom:20px;margin-right:20px;width:500px;height 50px;" src="' . $valeur['photo'] . '"></p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                      <iframe src=' . $lien . ' scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe><p></p>';

            while ($val = mysql_fetch_assoc($req3)) {
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
<div id="colonnedroite">
    <h2 style="font-size:150%;" align="center"><b>Publication Mise en Avant</b></h2>
    <?php  $req2 = mysql_query('(SELECT * FROM album al join users us on us.id=al.id_utilisateur where al.id_utilisateur in
                                (
                                select id_utilisateur from ordre_utilisateur where position=1
                                ) limit 1)
                                union
                                (SELECT * FROM album al join users us on us.id=al.id_utilisateur where al.id_utilisateur in
                                (
                                select id_utilisateur from ordre_utilisateur where position=2
                                ) limit 1)
                                union
                                (SELECT * FROM album al join users us on us.id=al.id_utilisateur where al.id_utilisateur in
                                (
                                select id_utilisateur from ordre_utilisateur where position=3
                                )limit 1)

                                ')
    or die ("Impossible de se connecté à la table album" . mysql_error());
    mysql_query('update ordre_utilisateur SET position=position+3');
    mysql_query('UPDATE ordre_utilisateur SET position=3 WHERE position=(SELECT * FROM  (SELECT max(position) FROM ordre_utilisateur ) AS tmp)');
    mysql_query('UPDATE ordre_utilisateur SET position=2 WHERE position=(SELECT * FROM  (SELECT max(position) FROM ordre_utilisateur ) AS tmp)');
    mysql_query('UPDATE ordre_utilisateur SET position=1 WHERE position=(SELECT * FROM  (SELECT max(position) FROM ordre_utilisateur ) AS tmp)');
    mysql_query('update users set abonnement=0 where abonnement in (select id_abonnement from abonnement where id_abonnement<>0 and DATEDIFF(CURDATE(),date_debut_abonnement)>30)');
    mysql_query('delete from abonnement where id_abonnement<>0 and DATEDIFF(CURDATE(),date_debut_abonnement)>30');
    mysql_query('delete from abonnement where id_abonnement <>0 and id_abonnement not in (select abonnement from users where abonnement )');
    mysql_query('update users set abonnement=0 where abonnement not in (select id_abonnement from abonnement)');
    mysql_query('delete from ordre_utilisateur where id_utilisateur in (select id from users where abonnement in (select id_abonnement from abonnement where id_abonnement<>0 and DATEDIFF(CURDATE(),date_debut_abonnement)>=30))');
    mysql_query('delete FROM ordre_utilisateur WHERE id_utilisateur is null or id_utilisateur in (select id from users where abonnement = 0)');


    while ($valeur = mysql_fetch_assoc($req2)) {
        $date_explosee = explode("-", $valeur['date']);
        $annee = $date_explosee[0];
        $mois = $date_explosee[1];
        $date_explosee = explode(" ", $date_explosee[2]);
        $jour = $date_explosee[0];
        $date_explosee = explode(":", $date_explosee[1]);
        $heure = $date_explosee[0];
        $minute = $date_explosee[1];
        echo '<p ><a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '"><img style="margn-left: 200px;height;50px;width: 50px;" src="' . $valeur['photo_profil'] . '"></a><p style=" font-size:60%; width: 10%; position:fixed;margin-left:70px;margin-top:-60px;"><a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '"><b>' . $valeur['pseudo'] . '</a></b> à ajouté cette <br>publication le
                        ' . $jour . ' ' . $moisText[$mois - 1] . ' ' . $annee . ' à ' . $heure . 'H' . $minute . '</p><p style="font-size:80%" align="center">' . $valeur['message'] . '</p></p>';
        echo '<p align="center"><img style="height:120px;width:120px;z-index:10000" src="' . $valeur['photo'] . '"><p><br>';
    }
    ?>
</div>
</body>
</html>

<script language="javascript" src="../js/accueil.js"></script>


