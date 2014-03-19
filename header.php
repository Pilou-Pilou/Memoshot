<?php
require_once('../Modele/cryptModele.php');
if (isset($_POST['recherche'])) {
    if ($_POST['recherche'] != '') {
        require_once('../Modele/cryptModele.php');
        $scryp = new cryptModele();
        $message_crypte = mcrypt_encrypt(MCRYPT_3DES, $scryp->cle, $_POST['recherche'], MCRYPT_MODE_NOFB, $scryp->iv);
        $_SESSION['key'] = $scryp->cle;
        $_SESSION['iv'] = $scryp->iv;
        header('Location: ../view/accueilView.php?rechercher=' . $message_crypte);
    } else {
        header('Location: ../view/accueilView.php');
    }
}
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="../js/bootstrap.js"></script>
    <?php require_once('../Config/ConnexionBD.php'); ?>
</head>

<body>
<nav style="z-index: 9999;position: fixed;width: 100%;" class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div><img style="margin-top:5px;height:40px" src="../images/MimageBanniere.png">&nbsp&nbsp&nbsp&nbsp</div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="../view/accueilView.php"> <span
                            class="glyphicon glyphicon-home"></span>&nbspHome</a></li>
            </ul>
            <form action="" method="post" class="navbar-form navbar-left" autocomplete="off">
                <div class="form-group">
                    <input type="text" name="recherche" id="recherche" class="form-control" placeholder="Search"
                           onkeyup="window.setTimeout('refreshList(pseudo);',1);">
                </div>
                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span>&nbspResearch
                </button>
            </form>
            <div id="notifications">
                <ul class="nav navbar-nav navbar-right">
                    <?php
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
                    ?>
                    <li><a href="../view/ajouterUnePhotoView.php"> <span
                                class="glyphicon glyphicon-camera"></span>&nbspAjouter une photo</a></li>
                    <li><a href="../view/fermer_session.php"> <span
                                class="glyphicon glyphicon-log-out"></span>&nbspDéconnexions</a></li>
                    <li><a href="../view/visualisationCompteView.php"> <span
                                class="glyphicon glyphicon-user"></span>&nbspMon
                            Compte (<?php echo $_SESSION['pseudo_util']; ?>)</a></li>
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
                </ul>
            </div>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->

</nav>
<div id="liste"
     style="border: 2px rgb(155, 160, 155) solid;position:fixed;width:172px;left:212px;top:42px;background-color:rgb(237, 234, 255);z-index: 100000; display: none">
</div>
</body>


<?php

$pseudo = array();
$divpseudo = array();
$htag = array();
$divhtag = array();
$i = 0;

$connexions = new ConnexionBD();
$connexions->connexion();
$req1 = mysql_query('SELECT id,pseudo,photo_profil FROM users')
or die ("Impossible de se connecté à la table album" . mysql_error());
while ($valeur = mysql_fetch_assoc($req1)) {
    $pseudo[$i] = $valeur['pseudo'];
    $divpseudo[$i] = '<div class="divpseudo" id="' . $i . '" onclick="location.href=\'../view/visualisationCompteView.php?id=' . $valeur['id'] . '\'" onmouseout="document.getElementById("' . $i . '").style.backgroundColor=\'rgb(237, 234, 255)\' "
                     onmouseover="document.getElementById("' . $i . '").style.backgroundColor=\'rgb(255, 186, 93)\' "><a>&nbsp&nbsp<a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '"><img style="margn-left: 200px;height;30px;width: 30px;" src=' . $valeur['photo_profil'] . '></a>&nbsp<a href="../view/visualisationCompteView.php?id=' . $valeur['id'] . '">' . $valeur['pseudo'] . '</a></div>';
    $i++;
}

$i = 0;
$req1 = mysql_query('SELECT tag1 as tag FROM album union SELECT tag2 as tag FROM album union SELECT tag3 as tag FROM album union SELECT tag4 as tag FROM album union SELECT tag5 as tag FROM album')
or die ("Impossible de se connecté à la table album" . mysql_error());
while ($valeur = mysql_fetch_assoc($req1)) {
    $htag[$i] = $valeur['tag'];
    $divhtag[$i] = '<div align="center" class="divpseudo" id="' . $valeur['tag'] . '" onmouseout="document.getElementById("' . $valeur['tag'] . '").style.backgroundColor=\'rgb(237, 234, 255)\' "
                     onmouseover="document.getElementById("' . $valeur['tag'] . '").style.backgroundColor=\'rgb(255, 186, 93)\' onclick="fillInput1(' . $i . ')">' . $valeur['tag'] . '</div>';
    $i++;
}



?>



<script>

    var selIndex = 0;
    var nbMatch = 0;
    var pseudo = new Array();
    var divpseudo = new Array();
    var htag = new Array();
    var divhtag = new Array();
    var content = '';
    var old = '';

    pseudo = <?php echo json_encode($pseudo) ?>;
    divpseudo = <?php echo json_encode($divpseudo) ?>;
    htag = <?php echo json_encode($htag) ?>;
    divhtag = <?php echo json_encode($divhtag) ?>;


    function refreshList(tab) {

        // si la valeur est différente de celle taper précedement on rentre dans la boucle
        if (document.getElementById('recherche').value != old) {


            old = document.getElementById('recherche').value;
            document.getElementById('liste').innerHTML = '';
            if (document.getElementById('recherche').value.length > 0) {

                nbMatch = 0;
                content = '<div align="center" style="border-top: 2px  rgb(155, 160, 155) solid;border-bottom: 2px  rgb(155, 160, 155) solid;background-color: greenyellow"><b>Personne</b></div>';
                for (var i = 0; i < tab.length; i++) {

                    // je prend dans la case i je met le meme nombre de caractyere entrer dans la zone texte en majuscule et je compare ces caractere a la zone texte
                    if (tab[i].slice(0, document.getElementById('recherche').value.length).toLowerCase() == document.getElementById('recherche').value.toLowerCase()) {
                        nbMatch++;
                        content += divpseudo[i];


                    }
                }
                content += '<div align="center" style="border-top: 2px  rgb(155, 160, 155) solid;border-bottom: 2px  rgb(155, 160, 155) solid;background-color: greenyellow"><b>Tag</b></div>';


                for (var i = 0; i < htag.length; i++) {

                    // je prend dans la case i je met le meme nombre de caractyere entrer dans la zone texte en majuscule et je compare ces caractere a la zone texte
                    if (htag[i].slice(0, document.getElementById('recherche').value.length).toLowerCase() == document.getElementById('recherche').value.toLowerCase()) {
                        nbMatch++;

                        content += divhtag[i];


                    }
                }


                if (nbMatch) {
                    document.getElementById('liste').innerHTML = content;
                    document.getElementById('liste').style.display = 'block';
                    selIndex = 0;
                }
                else
                    document.getElementById('liste').style.display = 'none';
            }
            else {
                document.getElementById('liste').style.display = 'none';
            }
        }
    }

    function fillInput1(i) {
        document.getElementById('recherche').value = htag[i];
        document.getElementById('liste').style.display = 'none';
        document.getElementById('recherche').focus();
    }

</script>
<script type="text/JavaScript" src="../js/prototype.js"></script>
<script language="javascript">


    setTimeout("auto_refresh()", 10000);
    function auto_refresh() {
        new Ajax.Updater('notifications', '../Modele/miseAJourNotification.php', {parameters: 'mode=auto_refresh', evalScripts: true, asynchronous: true})
        new Ajax.Updater('colonnedroite', '../Modele/miseAJourPub.php', {parameters: 'mode=auto_refresh', evalScripts: true, asynchronous: true})

        setTimeout("auto_refresh()", 10000);

        return true
    }


</script>