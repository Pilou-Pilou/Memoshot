<?php
/**
 * Created by PhpStorm.
 * User: Rulio
 * Date: 23/02/14
 * Time: 00:45
 */

session_start();
require_once('../Config/ConnexionsBD.php');
// --- Récupération des paramètres POST
$commentaire = $_POST["commentaire"];
$publication = $_POST["publication"];

$conexions = new ConexionsBD();
$conexions->conexions();
mysql_query('INSERT INTO commentaires(id_publication,id_auteur,commentaire) VALUES (' . $publication . ',' . $_SESSION['id'] . ',\'' . $commentaire . '\')')
or die (mysql_error() . "Impossible de se connecté à la table commentaires");