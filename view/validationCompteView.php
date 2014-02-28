<?php

session_start();
require_once('../Modele/testSessionModele.php');
$_SESSION['id'] = $_GET['id'];
require_once('../Config/ConnexionsBD.php');
$connexions = new ConnexionBD();
$connexions->connexion();
mysql_query('UPDATE users set status="V" where id=\'' . $_SESSION['id'] . '\'')
or die ("Impossible de se connecté à la table users" . mysql_error());

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>MemoShot - Login</title>

    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div class="container">
    <div class="header">
        <img src="../images/logo.png" alt="Insérer le logo ici" name="Insert_logo" width="779" height="211"
             align="middle" id="Insert_logo" style="background: #43A1CF; display:block;"/>
    </div>
    <!-- end .header -->
    <div class="contentoutside">
        <div class="content" align="center">
            <h1 align="center">Félicitations !!!!</h1><br>

            <div>
                Vous voila complétement inscrit prêt à profiter des joie de Memoshot
            </div>
            <br>

            <form action="../view/accueilView.php" method="post">
                <input class="btn btn-success btn-lg" type="submit" value="Continuer"/>
            </form>
        </div>
    </div>
    <div class="footer">

    </div>
    <!-- end .footer -->

</div>
<!-- end .container -->

</body>
</html>

