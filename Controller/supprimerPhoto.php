<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 14-03-14
 * Time: 10:34
 */
session_start();
require_once('../Config/ConnexionBD.php');

$connexions = new ConnexionBD();
$connexions->connexion();
$req="DELETE FROM album WHERE id_publication=".$_GET['id'].";";
$result = mysql_query($req)
or die ("Impossible de se connecté à la table album" . mysql_error());
if (isset($_POST['Profil']))
    mysql_query('UPDATE users set photo_profil="' . $photo . '" where id="' . $_SESSION['id'] . '"')
    or die ("Impossible de se connecté à la table album" . mysql_error());


include("../view/albumView.php");