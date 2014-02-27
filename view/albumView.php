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
$connexions = new ConnexionsBD();
$connexions->connexions();
$req = mysql_query('SELECT * FROM album  where id_utilisateur=\'' . $_SESSION['id'] . '\'')
or die ("Impossible de se connecté à la table album" . mysql_error());
while ($valeur = mysql_fetch_assoc($req)) {
    $image = $valeur['photo'];
    echo '<img src="' . $image . '"/>';
}
