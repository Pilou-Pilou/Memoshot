<?php

session_start();

require_once('../Modele/testSessionModele.php');

$erreur = '';

if (isset($_SESSION['erreur'])) {

    if ($_SESSION['erreur'] == -1)

        $erreur = '';

    else

        $erreur = $_SESSION['erreur'];

}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title>MemoShot - <?php echo $_SESSION['pseudo_util']; ?></title>

    <link href="../css/bootstrap.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">

    <script src="../Controller/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

    <link href="../css/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css"/>

</head>


<body style="background-color: #43A1CF ">

<div style="height: 10%">

    <?php

    require_once('../header.php');

    ?>

</div>


<div style="margin-top:10%;background-color: #43A1CF " class="container">

    <div class="content">

        <h1 align="center">Ajouter Une Photo </h1>


        <form id="form1" name="form1" method="post" action="../Controller/ajoutUnePhotoController.php"

              enctype="multipart/form-data">

            <p align="center"><input type="file" name="photo"/></p>


            <table width="600" border="0" align="center">

                <tr>

                    <th width="294" scope="row">

                        <div align="center"><label for="nom">Nom</label></div>

                    </th>

                    <td><span id="sprytextfield1">

<input type="text" name="nom" id="nom"/>

<span class="textfieldRequiredMsg">Non complété</span>

<span class="textfieldInvalidFormatMsg">Format non valide.</span>

</span>

                    </td>

                </tr>

                <tr>

                    <th width="294" scope="row">

                        <div align="center"><label for="description">Description</label></div>

                    </th>

                    <td><span id="sprytextfield3">

<input type="text" name="description" id="description"/>

<span class="textfieldRequiredMsg">Non complété</span>

</span>

                    </td>

                </tr>

                <tr>

                    <th width="294" scope="row">

                        <div align="center"><label for="ht1"> Hashtag 1</label></div>

                    </th>

                    <td width="295"><span id="sprytextfield2">

<input type="text" name="ht1" id="ht1"/>

<span class="textfieldRequiredMsg">Non complété</span>

<span class="textfieldInvalidFormatMsg">Format non valide.</span>

</span>

                    </td>

                </tr>

                <tr>

                    <th width="294" scope="row">

                        <div align="center"><label for="h2"> Hashtag 2</label></div>

                    </th>

                    <td>

                        <input type="text" name="h2" id="h2"/>

                    </td>

                </tr>

                <tr>

                    <th width="294" scope="row">

                        <div align="center"><label for="h3"> Hashtag 3</label></div>

                    </th>

                    <td>

                        <input type="text" name="h3" id="h3"/></td>

                </tr>

                <tr>

                    <th width="294" scope="row">

                        <div align="center"><label for="h4"> Hashtag 4</label></div>

                    </th>

                    <td>

                        <input type="text" name="h4" id="h4"/></td>

                </tr>

                <tr>

                    <th width="294" scope="row">

                        <div align="center"><label for="h5"> Hashtag 5</label></div>

                    </th>

                    <td>

                        <input type="text" name="h5" id="h5"/></td>

                </tr>

            </table>

            <p align="center"><br>

                <input type="checkbox" name="Profil" id="Profil"/>

                <label for="Profil">Ceci est ma photo de profil</label>

            </p>


            <p align="center">

                <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Ajouter à l'Album"/>

            </p>


            <p align="center" style="color: #ff0000">&nbsp;<br><?php if ($erreur != '') echo $erreur; ?></p>


            <!-- end .content -->

        </form>

    </div>

    <div class="footer">

        <!-- end .footer -->

    </div>

    <!-- end .container --></div>

<script type="text/javascript">

    var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {validateOn: ["change"]});

    var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {validateOn: ["change"]});

    var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn: ["change"]});

</script>

</body>

</html>

<?php

$_SESSION['erreur'] = '';

?>

