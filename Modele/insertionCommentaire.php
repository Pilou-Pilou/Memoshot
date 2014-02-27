<?php
session_start();
require_once('../Config/ConnexionsBD.php');
// --- Récupération des paramètres POST
$commentaire = $_POST["commentaire"];
$publication = $_POST["publication"];

$connexions = new ConnexionsBD();
$connexions->connexions();
mysql_query('INSERT INTO commentaires(id_publication,id_auteur,commentaire) VALUES (' . $publication . ',' . $_SESSION['id'] . ',\'' . $commentaire . '\')')
or die (mysql_error() . "Impossible de se connecter à la table commentaires");