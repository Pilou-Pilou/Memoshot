<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07/02/14
 * Time: 09:48
 */

session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>MemoShot - <?php echo $_SESSION['pseudo']; ?></title>
    <link href="../css/bootstrapbis.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>


<body style="background-color: #d4d4d4 ">
<div style="height: 10%">
    <?php
    require_once('../header.php');
    ?>
</div>

<div id="separation"></div>
<div id="colonnegauche"> Informations</div>
<div id="colonnemilieu">
    <img style="width:100%;" src="../images/logo.png"><br>

    <p style="margin-left: 70px;">
        Laisser un Commentaire : <input type="text" placeholder=" Votre Commentaire... ">
    </p>

</div>
<div id="colonnedroite"> Informations</div>

</body>
</html>