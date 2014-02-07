<!--
/**********************************************************************************
* UNIVERSITE NICE SOPHIA ANTIPOLIS
* PROJET DE WEB MAI 2013: PHP
* AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
* Th�me : Gerer la suppression d'une personne grace au clique sur le bouton
*/
-->
<head>
    <title>Suprimer Personnel</title>
</head>
<body>
<?php
session_start();

$ini_array = parse_ini_file("../config/login_db.ini");
$user = $ini_array["user"];
$pass = $ini_array["pass"];
$host = $ini_array["host"];
$base = $ini_array ["base"];

$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$unite = $_GET['unite'];
$bat = $_GET['batiment'];
$pole = $_GET['pole'];
$fonction = $_GET['fonction'];

// Connexion a phpmyadmin
if ($pass == "")
    $bdd = mysql_connect($host, $user) or die('Impossible de se connecter: ' . mysql_error());
else
    $bdd = mysql_connect($host, $user, $pass) or die('Impossible de se connecter: ' . mysql_error());

// Connection � la base de donn�e
mysql_select_db($base, $bdd) or die('Impossible de se connecter: ' . mysql_error());

$req = "SELECT identifiant FROM personnel WHERE nom='$nom' AND prenom='$prenom'";

$req = mysql_query($req) or die ("La requete ne s'est pas Ex�cut�: " . mysql_error());

while ($row = mysql_fetch_assoc($req)) {
    $req1 = "DELETE FROM personnel_batiment WHERE Identifiant = '" . $row['identifiant'] . "'";
    $req2 = "DELETE FROM personnel_pole WHERE Identifiant = '" . $row['identifiant'] . "'";
    $req3 = "DELETE FROM personnel_fonction WHERE Identifiant = '" . $row['identifiant'] . "'";
    $req4 = "DELETE FROM personnel_unite WHERE Identifiant = '" . $row['identifiant'] . "'";
    $req5 = "DELETE FROM personnel WHERE identifiant = '" . $row['identifiant'] . "'";

    mysql_query($req1) or die ("La requete 1 ne s'est pas Ex�cut�: " . mysql_error());
    mysql_query($req2) or die ("La requete 2 ne s'est pas Ex�cut�: " . mysql_error());
    mysql_query($req3) or die ("La requete 3 ne s'est pas Ex�cut�: " . mysql_error());
    mysql_query($req4) or die ("La requete 4 ne s'est pas Ex�cut�: " . mysql_error());
    mysql_query($req5) or die ("La requete 5 ne s'est pas Ex�cut�: " . mysql_error());
}
mysql_close($bdd);
header('Location: rechercher.php?nom=' . $nom . '&fonction=' . $fonction . '&unite=' . $unite . '&pole=' . $pole . '&batiment=' . $batiment);

echo $nom . ' ' . $prenom . ' � bien �t� suprim� !';
?>
</body>