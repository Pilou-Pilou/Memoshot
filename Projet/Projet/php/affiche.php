<?php
/**********************************************************************************
 * UNIVERSITE NICE SOPHIA ANTIPOLIS
 * PROJET DE WEB MAI 2013: PHP
 * AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
 * Th�me : affichage de toutes les donn�es d'un employ�,
 */
?>
<head>
    <!-- CSS -->
    <link rel="stylesheet" href="../style/bootstrap.css"/>

    <!-- pr�-requis PHP -->
    <?php
    session_start();
    //recuperation de l'dentit� de la personne
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];

    $ini_array = parse_ini_file("../config/login_db.ini");
    $user = $ini_array["user"];
    $pass = $ini_array["pass"];
    $host = $ini_array["host"];
    $base = $ini_array ["base"];

    // Connexion a phpmyadmin
    if ($pass == "")
        $bdd = mysql_connect($host, $user) or die('Impossible de se connecter: ' . mysql_error());
    else
        $bdd = mysql_connect($host, $user, $pass) or die('Impossible de se connecter: ' . mysql_error());

    // Connection � la base de donn�e
    mysql_select_db($base, $bdd) or die('Impossible de se connecter: ' . mysql_error());

    $req1 = "SELECT * FROM personnel WHERE personnel.nom='" . $nom . "' AND personnel.prenom='" . $prenom . "'";
    $req1 = mysql_query($req1) or die ("La requete ne s'est pas executee: " . mysql_error());

    // Controle de validite de la requete comme on peut pas passer l'ID de la personne par l'URL pour des raisons de s�curit�
    // on v�rifie si le nombre de r�sultats est sup�rieur � 1
    if (mysql_num_rows($req1) != 1)
        header('Location: ../error.html');
    ?>
</head>
<body>
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <li class="active">
                    <h3 style="margin-left:0px;">Fiche du personnel</h3>
                </li>
            </ul>
        </div>
    </div>
</div>
<h4><a href="rechercher.php?nom=&batiment=&fonction=&pole=&unite=">Nouvelle Recherche</a></h4>
<?php
while ($row = mysql_fetch_assoc($req1)) {
    echo '<h1 align="center">' . $row['nom'] . ' ' . $row['prenom'] . '</h1>';

    // Affichage de la photo de la personne
    if ($row['photo'] != "")
        echo '<img align="right" width="200" height="200" class="img-rounded" style="margin-top:-95px; margin-right:5px;" src="../images/' . $row['photo'] . '">';
    else
        echo '<img align="right" width="200" height="200" class="img-rounded" style="margin-top:-95px; margin-right:5px;" src="../images/default.jpg">';

    // affichage de l'identit� de la personne
    echo "Adresse Mail : " . $row['email'] . " </br>Numero Domicile : " . $row['numFix'] . "</br>Numero Fax : " . $row['numFax'] . "</br>
		Numero Portable : " . $row['numPort'] . "</br>Site personnel : <a href=\"http://" . $row['url'] . "\">" . $row['url'] . "</a></br>";

    echo "Batiment :</br><pre>";

    $req2 = "SELECT definition FROM batiment INNER JOIN personnel_batiment ON personnel_batiment.code = batiment.code WHERE Identifiant = '" . $row['identifiant'] . "'";
    $req2 = mysql_query($req2) or die ("La requete 2 ne s'est pas executee: " . mysql_error());
    while ($row2 = mysql_fetch_assoc($req2))
        echo '	- ' . $row2['definition'] . '</br>';

    echo "</pre>Unit&eacutes :</br><pre>";

    $req2 = "SELECT definition FROM unite INNER JOIN personnel_unite ON personnel_unite.code = unite.code WHERE Identifiant = '" . $row['identifiant'] . "'";
    $req2 = mysql_query($req2) or die ("La requete 2 ne s'est pas executee: " . mysql_error());
    while ($row2 = mysql_fetch_assoc($req2))
        echo '	- ' . $row2['definition'] . '</br>';

    echo "</pre>Fonctions :</br><pre>";

    $req2 = "SELECT definition FROM fonction INNER JOIN personnel_fonction ON personnel_fonction.code = fonction.code WHERE Identifiant = '" . $row['identifiant'] . "'";
    $req2 = mysql_query($req2) or die ("La requete 2 ne s'est pas executee: " . mysql_error());
    while ($row2 = mysql_fetch_assoc($req2))
        echo '	- ' . $row2['definition'] . '</br>';

    echo "</pre>";
}
?>
<h3 class="deconnect"><a href="fermer_session.php">D&eacuteconnecter</a></h3>
</body>