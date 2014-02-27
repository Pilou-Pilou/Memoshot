<?php
/**
 * Created by PhpStorm.
 * User: Rulio
 * Date: 23/02/14
 * Time: 03:14
 */

require_once('../Config/ConnexionsBD.php');
// --- Récupération des paramètres POST
$commentaire = $_POST["commentaire"];

$connexions = new ConnexionsBD();
$connexions->connexions();
mysql_query('DELETE FROM commentaires where id_commentaires=\'' . $commentaire . '\'')
or die (mysql_error() . "Impossible de se connecter à la table commentaires");