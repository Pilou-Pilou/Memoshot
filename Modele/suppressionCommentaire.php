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

$conexions = new ConexionsBD();
$conexions->conexions();
mysql_query('DELETE FROM commentaires where id_commentaires=\'' . $commentaire . '\'')
or die (mysql_error() . "Impossible de se connecté à la table commentaires");