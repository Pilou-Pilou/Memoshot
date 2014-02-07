<!--
/**********************************************************************************
* UNIVERSITE NICE SOPHIA ANTIPOLIS
* PROJET DE WEB MAI 2013: PHP
* AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
* Theme : permet la connexion du personnel.
*/
-->
<head>
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="../style/bootstrap.css"/>
    <?php
    session_start();

    //compteur
    if (!isset($_SESSION['compteur'])) {
        $_SESSION['compteur'] = 1;
    } else {
        $_SESSION['compteur']++;
    }
    // Si la session est déjà ouvert, c'est à dire que l'utilisateur est déjà connecté, redirection vers la page d'accueil
    if (isset($_SESSION['nom']))
        header('Location: rechercher.php');
    ?>
</head>
<body>
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <h3 style="margin-left:0px;" align="center">Connexion</h3>
        </div>
    </div>
</div>


<?php
if ($_SESSION['compteur'] > 1)
    echo "<p align=\"center\" style=\"color: red; font-style: italic\" >Votre identifiant n'existe pas ou il y a une erreur dans votre identifiant et/ou mot de passe </p>";
?>
<center>
    <form method="post" action="ouvrir_session.php">
	<pre align="center" style="width:600px; ">
		Identifiant	:<input name="idUser" type="text" size="15"/></br>
        Mot de passe	:<input name="mdp" type="password" size="15"/></br>
	</pre>
        <input class="btn btn-primary" type="submit" value="Valider"/>
        <input type="button" value="Annuler" class=" btn btn-inverse"
               onclick="javascript:location.href='fermer_session.php'"/>
    </form>
</center>
</body>
