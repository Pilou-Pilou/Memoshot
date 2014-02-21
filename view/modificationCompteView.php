<?php

session_start();

$erreur = '';
$pseudo = '';
$nom = '';
$prenom = '';
$mail = '';
$sexe = '';

if (isset($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $sexe = $_POST['sexe'];
}
if (isset($_SESSION['erreur']))
    if ($_SESSION['erreur'] == -1)
        $erreur = '';
    else
        $erreur = $_SESSION['erreur'];
else
    $erreur = '';

$date_explosee = explode("-", $_SESSION['naissance']);
$jour = $date_explosee[2];
$mois = $date_explosee[1];
$annee = $date_explosee[0];
$moisText = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$mois = $moisText[$mois - 1];




?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>MemoShot - <?php echo $_SESSION['pseudo']; ?></title>

    <script src="../Controller/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="../Controller/SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
    <script src="../Controller/SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../css/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css"/>
    <link href="../css/SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css"/>
    <link href="../css/SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css"/>
</head>

<body style="background-color: #43A1CF ">
<div style="height: 10%">
    <?php
    require_once('../header.php');
    ?>
</div>
<div style="margin-top:8%;background-color: #43A1CF " class="container">

    <!-- end .header -->
    <div class="contentoutside">
        <div class="content" align="center">
            <h1 align="center">Modification du compte</h1><br>

            <form action="../Controller/modificationCompteController.php" method="post" enctype="multipart/form-data">
                <table width="599" border="0">
                    <tr>
                        <th width="294" scope="row">
                            <div align="center"><label for="pseudo2">Pseudo</label></div>
                        </th>
                        <td width="295">
                            <span id="sprytextfield3">
                                <input type="text" name="pseudo" id="pseudo2" placeholder="Pseudo"
                                       value="<?php echo $_SESSION['pseudo']; ?>"/>
                                <span class="textfieldRequiredMsg">Non complété</span>
                                <span class="textfieldInvalidFormatMsg">Non complété</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div align="center"><label for="nom2">Mot de passe</label></div>
                        </th>
                        <td>
                            <span id="sprytextfield4">
                                <input type="password" name="password" id="nom2" value='' placeholder="Mot de Passe"/>
                                <span class="textfieldRequiredMsg">Non complété</span>
                                <span class="textfieldInvalidFormatMsg">Non complété</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div align="center"><label for="passwordVerif3">Retapez le Mot de passe</label></div>
                        </th>
                        <td>
                            <span id="spryconfirm1">
                                <input type="password" name="passwordVerif" value='' id="passwordVerif3"
                                       placeholder="Mot de Passe"/>
                                <span class="confirmRequiredMsg">Non complété</span>
                                <span class="confirmInvalidMsg">Try Again...</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div align="center"><label for="nom3">Nom</label></div>
                        </th>
                        <td>
                            <span id="sprytextfield5">
                                <input type="text" name="nom" id="nom3" placeholder="Nom"
                                       value="<?php echo $_SESSION['nom']; ?>"/>
                                <span class="textfieldRequiredMsg">Non complété</span>
                                <span class="textfieldInvalidFormatMsg">Non complété</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div align="center"><label for="prenom">Prénom</label></div>
                        </th>
                        <td>
                            <span id="sprytextfield6">
                                <input type="text" name="prenom" id="prenom" placeholder="Prenom"
                                       value="<?php echo $_SESSION['prenom']; ?>"/>
                                <span class="textfieldRequiredMsg">Non complété</span>
                                <span class="textfieldInvalidFormatMsg">Format non valide.</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th height="54" scope="row">
                            <div align="center">Sexe</div>
                        </th>
                        <td>
                            <span id="spryradio1">
                                <label>
                                    <input type="radio" name="sexe" value="F" id="Sexe_0"/>
                                    F</label>
                                <label>
                                    <input type="radio" name="sexe" value="M" id="Sexe_1"/>
                                    M</label>
                                <span class="radioRequiredMsg">Non choisi</span><br/>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div align="center"><label for="naissance">Date de naissance</label></div>
                        </th>
                        <td>
                            <span id="sprytextfield1">
                                <?php echo $jour . ' ' . $mois . ' ' . $annee ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div align="center"><label for="mail">Mail</label></div>
                        </th>
                        <td>
                            <span id="sprytextfield2">
                                <input type="text" name="mail" id="mail" placeholder="Mail"
                                       value="<?php echo $_SESSION['mail'];; ?>"/>
                                <span class="textfieldRequiredMsg">Non complété</span>
                                <span class="textfieldInvalidFormatMsg">Try Again...</span>
                            </span>
                        </td>
                    </tr>
                </table>
                <br>


                <input class="btn btn-success" type="submit" value="Sauvegarder"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="btn btn-primary" type="button" name="retour" id="retour" value="Retour Profil"
                       onclick="location.href='../view/visualisationCompteView.php'"/>


                <p style="color: #ff0000">&nbsp;<br><?php if ($erreur != '') echo $erreur; ?></p>
                <!-- end .content -->
            </form>
        </div>
    </div>
    <div class="footer">

    </div>
    <!-- end .footer -->

</div>
<!-- end .container -->


<script type="text/javascript">

    sexe =<?php echo json_encode($_SESSION['sexe']) ?>;

    if (sexe == 'Féminin')
        document.getElementById('Sexe_0').checked = 'true';
    if (sexe == 'Masculin')
        document.getElementById('Sexe_1').checked = 'true';


    var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {validateOn: ["change"], format: "dd/mm/yyyy"});
    var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn: ["change"]});
    var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {validateOn: ["change"]});
    var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {validateOn: ["change"]});
    var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "nom2", {validateOn: ["change"]});
    var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "custom", {validateOn: ["change"]});
    var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "custom", {validateOn: ["change"]});
    var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1", {validateOn: ["change"]});
</script>
</body>
</html>

