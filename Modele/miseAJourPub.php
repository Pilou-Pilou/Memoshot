<?php

session_start();
require_once('../Config/ConnexionBD.php');
$connexions = new ConnexionBD();
$connexions->connexion();
$moisText = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
echo '<h2 align="center"><b>Publication Mise en Avant</b></h2>';
$req2 = mysql_query('(SELECT * FROM album al join users us on us.id=al.id_utilisateur where al.id_utilisateur in
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
    echo '<p><a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '"><img style="margn-left: 200px;height;50px;width: 50px;" src="' . $valeur['photo_profil'] . '"></a>&nbsp&nbsp<p style="position:fixed;margin-left:75px;margin-top:-65px;"><a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '"><b>' . $valeur['pseudo'] . '</a></b> à ajouté cette <br>publication le
                        ' . $jour . ' ' . $moisText[$mois - 1] . ' ' . $annee . ' à ' . $heure . 'H' . $minute . '</p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $valeur['message'] . '</p>';
    echo '<p align="center"><img style="height:120px;width:120px;z-index:10000" src="' . $valeur['photo'] . '"><p><br>';
}
