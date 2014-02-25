<?php

session_start();

$erreur = '';
$pseudo = '';
$nom = '';
$prenom = '';
$mail = '';
$naissance = '';
$sexe = '';
if (isset($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $naissance = $_POST['naissance'];
    $sexe = $_POST['sexe'];
}
if (isset($_SESSION['erreur']))
    $erreur = $_SESSION['erreur'];
else
    $erreur = '';



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>MemoShot - Login</title>

    <script src="../Controller/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="../Controller/SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
    <script src="../Controller/SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../css/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css"/>
    <link href="../css/SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css"/>
    <link href="../css/SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css"/>
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
            <h1 align="center">Création d'un compte</h1><br>

            <form action="../Controller/creationCompteController.php" method="post" enctype="multipart/form-data">
                <table width="599" border="0">
                    <tr>
                        <th width="294" scope="row">
                            <div align="center"><label for="pseudo2">Pseudo</label></div>
                        </th>
                        <td width="295">
                            <span id="sprytextfield3">
                                <input type="text" name="pseudo" autocomplete="off" id="pseudo2" placeholder="Pseudo"
                                       value="<?php echo $pseudo; ?>"/>
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
                                <input type="password" autocomplete="off" name="password" id="nom2"
                                       placeholder="Mot de Passe">
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
                                <input type="password" autocomplete="off" name="passwordVerif" id="passwordVerif3"
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
                                <input type="text" autocomplete="off" name="nom" id="nom3" placeholder="Nom"
                                       value="<?php echo $nom; ?>"/>
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
                                <input type="text" autocomplete="off" name="prenom" id="prenom" placeholder="Prenom"
                                       value="<?php echo $prenom; ?>"/>
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
                                <input type="text" autocomplete="off" name="naissance" id="naissance"
                                       placeholder="Naissance"
                                       value="<?php echo $naissance; ?>"/>
                                <span class="textfieldRequiredMsg">Non complété</span>
                                <span class="textfieldInvalidFormatMsg">JJ/MM/AAAA.</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div align="center"><label for="mail">Mail</label></div>
                        </th>
                        <td>
                            <span id="sprytextfield2">
                                <input type="text" autocomplete="off" name="mail" id="mail" placeholder="Mail"
                                       value="<?php echo $mail; ?>"/>
                                <span class="textfieldRequiredMsg">Non complété</span>
                                <span class="textfieldInvalidFormatMsg">Try Again...</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th height="28" scope="row">
                            <div align="center"><label for="photo">Photo de profil</label></div>
                        </th>
                        <td>
                            <input type="file" name="photo" id="photo" ">
                        </td>
                    </tr>
                </table>
                <br>


                <input class="btn btn-success" type="submit" value="Sauvegarder"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="btn btn-primary" type="button" name="retour" id="retour" value="Retour"
                       onclick="location.href='../'"/>


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

    sexe =<?php echo json_encode($sexe) ?>;

    if (sexe == 'F')
        document.getElementById('Sexe_0').checked = 'true';
    if (sexe == 'M')
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

