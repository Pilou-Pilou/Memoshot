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
    <?php require_once('../Config/ConnexionBD.php'); ?>
</head>
<body style="background-color: #d1cece ">
<div style="height: 10%">
    <?php
    require_once('../header.php');
    ?>
</div>


<div id="colonnemilieu">
    <table style="width: 100%;">
        <tr>
            <td>
                <div id="abo1" style="cursor: pointer" class="poster"
                     onmouseout="document.getElementById('abo1').style.backgroundColor='rgb(237, 234, 255)' "
                     onmouseover="document.getElementById('abo1').style.backgroundColor='rgb(255, 186, 93)' ">&nbsp<h3>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        &nbsp Abonnement Premium Bronze</h3>

                    <p>Vos publications seront mises en avant une fois par mois</p>

                    <form action="../Controller/charge.php" method="post">
                        <input type="hidden" name="montant" value="50">

                        <p align="center"><br>
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="<?php echo $stripe['publishable_key']; ?>"
                                    data-description="Paiement :) "></script>
                        </p>
                    </form>
                </div>
            </td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td>
                <div style="cursor: pointer" id="abo2" class="poster"
                     onmouseout="document.getElementById('abo2').style.backgroundColor='rgb(237, 234, 255)' "
                     onmouseover="document.getElementById('abo2').style.backgroundColor='rgb(255, 186, 93)' ">&nbsp<h3>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        &nbsp Abonnement Premium Silver</h3>

                    <p>Vos publications seront mises en avant une fois par semaine</p>

                    <form action="../Controller/charge.php" method="post">
                        <input type="hidden" name="montant" value="75">

                        <p align="center"><br>
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="<?php echo $stripe['publishable_key']; ?>"
                                    data-description="Paiement :) "></script>

                        </p>
                    </form>
                </div>
            </td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td>
                <div id="abo3" style="cursor: pointer" class="poster" onclick=""
                     onmouseout="document.getElementById('abo3').style.backgroundColor='rgb(237, 234, 255)' "
                     onmouseover="document.getElementById('abo3').style.backgroundColor='rgb(255, 186, 93)' ">&nbsp<h3>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        &nbsp Abonnement Premium Gold</h3>

                    <p>Vos publications seront mises en avant une fois par jour</p>

                    <form action="../Controller/charge.php" method="post">
                        <input type="hidden" name="montant" value="100">

                        <p align="center"><br>
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="<?php echo $stripe['publishable_key']; ?>"
                                    data-description="Paiement :) "></script>
                    </form>
                    </p>
                </div>
            </td>
        </tr>
    </table>
</div>


</body>