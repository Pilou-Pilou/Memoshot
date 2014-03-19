<?php
session_start();
require_once('../Modele/testSessionModele.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>MemoShot - <?php echo $_SESSION['pseudo_util']; ?></title>
    <link href="../css/bootstrapbis.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
</head>
<body style="background-color: #43A1CF ">
<div style="height: 10%">
    <?php
    require_once('../header.php');
    ?>
</div>


<div id="colonnemilieu">
    <table style="width: 100%;">
        <tr>
            <td>
                <div id="abo1" align="center" class="poster">&nbsp<h3>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        &nbsp Abonnement Existant &nbsp
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span></h3><br>

                    <p>Vous avez déjà souscrit pour ce mois ci à un abonnement veuillez revenir le mois prochain.</p>
                </div>
            </td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
    </table>
</div>


</body>
