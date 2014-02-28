<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>MemoShot - Login -</title>

    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="./css/bootstrap.css"/>
    <?php
    session_start();

    $action = 0;

    if (isset($_SESSION['erreur'])) {
        switch ($_SESSION['erreur']) {
            case -1 :
                $action = 1;
                break;
            case 1 :
                $action = 2;
                break;
            case 2 :
                $action = 3;
                break;
            case 3 :
                $action = 4;
                break;
        }
    }

    ?>
</head>

<body>

<div class="container">
    <div class="header"><img src="./images/logo.png" alt="Insérer le logo ici" name="Insert_logo"
                             width="779" height="211" align="middle" id="Insert_logo"
                             style="background: #43A1CF; display:block;"/>
        <!-- end .header --></div>
    <div class="contentoutside">
        <div class="content"><h1 align="center">Login</h1><br>

            <?php

            if ($action == 2)
                echo "<p align=\"center\" style=\"color: red; font-style: italic\" >Votre identifiant n'existe pas ou il y a une erreur dans votre identifiant et/ou mot de passe </p>";
            else {
                if ($action == 1)
                    echo "<p align=\"center\" style=\"color: red; font-style: italic\" >Vous venez de vous inscrire pour finaliser l'inscription validez le mail de confirmation dans les 24 heures </p>";
                else {
                    if ($action == 3)
                        echo "<p align=\"center\" style=\"color: red; font-style: italic\" >Votre compte n'est pas encore valider !  Cliquez sur le lien contenu dans le mail de confirmation </p>";
                    else {
                        if ($action == 4)
                            echo "<p align=\"center\" style=\"color: red; font-style: italic\" >Veuillez rentrer les informations de connexion pour vous connecter</p>";
                    }
                }
            }

            ?>


            <form id="form1" name="form1" method="post" action="./Controller/loginController.php">
                <div align="center">
                    <p align="center" style="width:300px">
                        <?php  if ($action != 2)
                            echo "<input  class=\"form-control\" autocomplete=\"off\" name=\"pseudo\" type=\"text\" id=\"pseudo\" placeholder=\"pseudo\" size=\"18\" maxlength=\"18\" />";
                        else
                            echo "<div class=\"form-group has-error has-feedback\" autocomplete=\"off\" style=\"width:300px\"><input  class=\"form-control\" name=\"pseudo\" type=\"text\" id=\"pseudo\" placeholder=\"pseudo\" size=\"18\" maxlength=\"18\" /></div>";
                        ?>
                    </p>
                    &nbsp;<p align="center" style="width:300px">
                    <?php  if ($action != 2)
                        echo "<input  class=\"form-control\" name=\"password1\" autocomplete=\"off\" type=\"password\" id=\"password\" placeholder=\"password\" size=\"18\" maxlength=\"18\" />";
                    else
                        echo "<div class=\"form-group has-error has-feedback\" autocomplete=\"off\" style=\"width:300px\"><input  class=\"form-control\" name=\"password1\" type=\"password\" id=\"password\" placeholder=\"password\" size=\"18\" maxlength=\"18\" /></div>";
                    ?></div>
                </p>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p align="center">
                    <input class="btn btn-primary" type="button" name="CreerCompte" id="CreerCompte"
                           value="Creer un Compte" onClick="location.href='view/creationCompteView.php'"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="btn btn-primary" name="Connexion" id="Connexion" type="submit" value="Valider"/>
                </p>

                <p>&nbsp;</p>
                <!-- end .content -->
            </form>
        </div>
    </div>
    <!-- end .container --></div>
<div class="footer">
    <p align="center">Projet E-Commerce Julien Sergent et Mathieu Molinengo</p>
    <!-- end .footer --></div>

</body>
</html>
<?php

session_destroy();
