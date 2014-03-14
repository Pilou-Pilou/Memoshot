<?php
session_start();
echo '<ul class="nav navbar-nav navbar-right">';
require_once('../Config/ConnexionBD.php');
$connexions = new ConnexionBD();
$connexions->connexion();
$req = mysql_query('SELECT * FROM amis am join users us on am.id_amis_1=us.id WHERE id_amis_2 =\'' . $_SESSION['id'] . '\' AND status_amitier=0')
or die ("Impossible de se connecter à la table 'amis'" . mysql_error());
if (mysql_num_rows($req) == 0) {
    echo '<li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-globe"></span>&nbspNotifications <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a>&nbspAucune Notification ...</a></li>
                                    <li class="divider"></li>
                                </ul>
                            </li>';
} else {
    echo '<li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-globe"></span>&nbspNotifications <b class="caret"></b></a>
                                <ul class="dropdown-menu">';
    while ($valeur = mysql_fetch_assoc($req)) {
        echo '<li><a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '">' . $valeur['pseudo'] . ' vous a demander en amis </a></li>';
        echo '<li class="divider"></li>';
    }
    echo '</ul>
                            <div id="notification" class="notification">' . mysql_num_rows($req) . '</div></li>';
}
echo '<li><a href="../view/ajouterUnePhotoView.php"> <span
                class="glyphicon glyphicon-camera"></span>&nbspAjouter une photo</a></li>
    <li><a href="../view/fermer_session.php"> <span
                class="glyphicon glyphicon-log-out"></span>&nbspDéconnexions</a></li>
    <li><a href="../view/visualisationCompteView.php"> <span
                class="glyphicon glyphicon-user"></span>&nbspMon
            Compte (' . $_SESSION['pseudo_util'] . ')</a></li>
    <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown"><span
                class="glyphicon glyphicon-cog"></span>&nbspSettings <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="../view/modificationCompteView.php">Modification
                    Compte</a></li>
            <li class="divider"></li>
            <li><a href="../view/abonnementView.php">Abonnement</a></li>
        </ul>
    </li>
</ul>';