<?php
/**********************************************************************************
 * UNIVERSITE NICE SOPHIA ANTIPOLIS
 * PROJET DE WEB MAI 2013: PHP
 * AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
 * Th�me : formulaire d'inscription d'un nouveau employ�
 */
?>
<head>
    <link rel="stylesheet" href="../style/bootstrap.css"/>
    <title>Formulaire d'ajout</title>
    <?php
    // Chargement de la librairie
    include 'PHPExcel/Classes/PHPExcel.php';

    // Instanciation de la class permettant la lecture du fichier excel
    $data = new PHPExcel();

    // Cr�ation de l'objet Reader pour un fichier Excel 2007
    $objReader = new PHPExcel_Reader_Excel2007();
    // Permet de ne r�cup�rer que les valeurs des cellules sans les propri�t�s de style
    $objReader->setReadDataOnly(true);
    // Lecture du fichier.
    $objPHPExcel = $objReader->load("../BASE_CODAGE_FONCTION_SQL.xlsx");
    $objPHPExcel2 = $objReader->load("../BASE_CODAGE_DEPARTEMENT.xlsx");
    ?>
</head>
<body>
<h1 align="center">Ajouter un membre du personnel</h1>

<div class="container" style="border:1px solid black; width:70%; padding-left:20px;">
    <form method="post" action="trait_form.php" enctype="multipart/form-data">
        <table align="center">
            <h3>Informations Personnelles :</h3>
            <tr>
                <td>Login :</td>
                <td><input type="text" size="25" name="identifiant"></td>
            </tr>
            <tr>
                <td>Mot de Passe :</td>
                <td><input type="password" size="25" name="mdp"></td>
            </tr>
            <tr>
                <td>Civilit&eacute :</td>
                <td><select style="max-width:250px;" name="civilite">
                        <option name="Dr" value="Dr">Dr</option>
                        <option name="Mademoiselle" value="Mlle">Mlle</option>
                        <option name="Madame" value="Mme">Mme</option>
                        <option name="Monsieur" value="M">M</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td><input type="text" size="25" name="nom"></td>
            </tr>
            <tr>
                <td>Pr&eacute;nom :</td>
                <td><input type="text" size="25" name="prenom"></td>
            </tr>
            <tr>
                <td>Num&eacute;ro Fixe :</td>
                <td><input type="text" size="25" name="numFix"></td>
            </tr>
            <tr>
                <td>Num&eacute;ro Portable :</td>
                <td><input type="text" size="25" name="numPort"></td>
            </tr>
            <tr>
                <td>Num&eacute;ro Fax :</td>
                <td><input type="text" size="25" name="numFax"></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="text" size="25" name="email"></td>
            </tr>
            <tr>
                <td>Url :</td>
                <td><input type="text" size="25" name="url"></td>
            </tr>
            <tr>
                <td>Photo :</td>
                <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                    <input type="file" name="photo"></td>
                <td><p style="color: red; font-style: italic">8 Mo maximum!</p></td>
            </tr>
        </table>
        <table align="center">
            <h3>Batiment :</h3>
            <tr>
                <td>
                    <select name="bat" style="max-width:300px;">
                        <option value="BAT-A">BATIMENT A</option>
                        <option value="BAT-B">BATIMENT B</option>
                        <option value="BAT-C">BATIMENT C</option>
                        <option value="BAT-IUFC">INSTITUT UNIVERSITAIRE DE LA FACE ET DU COU</option>
                    </select>
                </td>
            </tr>
        </table>
        <table align="center">
            <h3>Fonction :</h3>
            <tr>
                <td>
                    <select name="fonction" style="max-width:300px;">
                        <?php
                        for ($i = 2; $i < 200; $i++) {
                            $name = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
                            $text = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue();
                            if ($name != "")
                                echo "<option value=\"" . $name . "\">" . $text . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <table align="center">
            <h3>Pole :</h3>
            <tr>
                <td>
                    <select name="pole" style="max-width:300px;">
                        <?php
                        for ($i = 2; $i < 200; $i++) {
                            $text = $objPHPExcel2->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
                            $name = $objPHPExcel2->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue();
                            if ($name != "")
                                echo "<option value=\"" . $name . "\">" . $text . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <h3>Unit&eacute; :</h3>

        <div style="width: 500px; height: 200px; overflow:auto;border: 1px solid black; margin: auto;">
            <?php
            $objPHPExcel = $objReader->load("../BASE_CODAGE_UNITE_SQL.xlsx");

            for ($i = 2; $i < 200; $i++) {
                $name = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
                $text = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue();
                if ($name != "")
                    echo "<input type=\"checkbox\" name=\"unit[]\" value=\"$name\"/>" . $text . "</br>";
            }
            ?>
        </div>
        <center>
            <input type="submit" class="btn btn-primary" value="Valider" style="margin-top:15px;"/>
            <input type="button" class="btn btn-inverse " value="Retour" style="margin-top:15px;"
                   OnClick="javascript: location.href='rechercher.php?nom=&fonction=&unite=&pole=&batiment='"/></center>
    </form>
</div>
</body>