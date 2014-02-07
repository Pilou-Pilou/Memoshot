<?php
/**********************************************************************************
 * UNIVERSITE NICE SOPHIA ANTIPOLIS
 * PROJET DE WEB MAI 2013: PHP
 * AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
 * Th�me : formulaire de modification du profil d'un employ�
 */
?>
<head>
    <link rel="stylesheet" href="../style/bootstrap.css"/>
    <title>Formulaire de modification</title>
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

    // Recherche de la personne
    // Connections
    $ini_array = parse_ini_file("../config/login_db.ini");
    $user = $ini_array["user"];
    $pass = $ini_array["pass"];
    $host = $ini_array["host"];
    $base = $ini_array ["base"];

    // Connexion a phpmyadmin
    if ($pass == "")
        $bdd = mysql_connect($host, $user) or die('Impossible de se connecter: ' . mysql_error());
    else
        $bdd = mysql_connect($host, $user, $pass) or die('Impossible de se connecter: ' . mysql_error());

    // Connection � la base de donn�e
    mysql_select_db($base, $bdd) or die('Impossible de se connecter: ' . mysql_error());

    $req = "SELECT * FROM personnel WHERE prenom = '" . $_GET['prenom'] . "' AND nom = '" . $_GET['nom'] . "'";
    $req = mysql_query($req) or die ("La requete ne s'est pas Ex�cut�: " . mysql_error());

    // Controle de validite de la requete comme on peut pas passer l'ID de la personne par l'URL pour des raisons de s�curit�
    // on v�rifie si le nombre de r�sultats est sup�rieur � 1
    if (mysql_num_rows($req) != 1)
        header('Location: ../error.html');

    $row = mysql_fetch_array($req)
    ?>
</head>
<body>

<h1 align="center">Modifier la fiche personnel d'un membre</h1>

<div class="container" style="border:1px solid black; width:70%; padding-left:20px;">
    <form method="post" action="trait_form_modif.php" enctype="multipart/form-data">
        <table align="center">
            <h3>Identification :</h3>
            <tr>
                <td>Login :</td>
                <td><input class="input-xlarge uneditable-input" name="identifiant"
                           value="<?php echo $row['identifiant']; ?>"></td>
            </tr>
            <tr>
                <td>Mot de Passe :</td>
                <td><input type="password" name="mdp" value="<?php echo $row['mdp']; ?>" <?php echo $row['mdp']; ?></td>
            </tr>
            <tr>
                <td>Civilit&eacute :</td>
                <td><select style="max-width:250px;" name="civilite">
                        <option name="Dr"
                                value="Dr" <?php if (strcmp("Dr", $row['civilite']) == 0) echo "selected=\"selected\""; ?>>
                            Dr
                        </option>
                        <option name="Mademoiselle"
                                value="Mlle" <?php if (strcmp("Mlle", $row['civilite']) == 0) echo "selected=\"selected\""; ?>>
                            Mlle
                        </option>
                        <option name="Madame"
                                value="Mme" <?php if (strcmp("Mme", $row['civilite']) == 0) echo "selected=\"selected\""; ?>>
                            Mme
                        </option>
                        <option name="Monsieur"
                                value="M" <?php if (strcmp("M", $row['civilite']) == 0) echo "selected=\"selected\""; ?>>
                            M
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td><input type="text" size="25" name="nom" value="<?php echo $row['nom']; ?>"/></td>
            </tr>
            <tr>
                <td>Prenom :</td>
                <td><input type="text" size="25" name="prenom" value="<?php echo $row['prenom']; ?>"/></td>
            </tr>
            <tr>
                <td>Num&eacute;ro Fixe :</td>
                <td><input type="text" size="25" name="numFix" value="<?php echo $row['numFix']; ?>"/></td>
            </tr>
            <tr>
                <td>Num&eacute;ro Portable :</td>
                <td><input type="text" size="25" name="numPort" value="<?php echo $row['numPort']; ?>"/></td>
            </tr>
            <tr>
                <td>Num&eacute;ro Fax :</td>
                <td><input type="text" size="25" name="numFax" value="<?php echo $row['numFax']; ?>"/></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="text" size="25" name="email" value="<?php echo $row['email']; ?>"/></td>
            </tr>
            <tr>
                <td>Url :</td>
                <td><input type="text" size="25" name="url" value="<?php echo $row['url']; ?>"/></td>
            </tr>
            <tr>
                <td>Photo :</td>
                <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                    <input type="file" name="photo"></td>
                <td><p style="color: red; font-style: italic">La taille ne doit pas exc&eacuteder 8 Mo</p></td>
            </tr>
        </table>
        <?php
        $req = "SELECT code FROM personnel_batiment WHERE Identifiant='" . $row['identifiant'] . "'";
        $req = mysql_query($req);
        $rowb = mysql_fetch_array($req);
        ?>
        <table align="center">
            <h3>Batiment :</h3>
            <tr>
                <td>
                    <select name="bat" style="max-width:300px;">
                        <option
                            value="BAT-A" <?php if (strcmp("BAT-A", $rowb['code']) == 0) echo "selected=\"selected\""; ?>>
                            BATIMENT A
                        </option>
                        <option
                            value="BAT-B" <?php if (strcmp("BAT-B", $rowb['code']) == 0) echo "selected=\"selected\""; ?>>
                            BATIMENT B
                        </option>
                        <option
                            value="BAT-C" <?php if (strcmp("BAT-C", $rowb['code']) == 0) echo "selected=\"selected\""; ?>>
                            BATIMENT C
                        </option>
                        <option
                            value="BAT-IUFC" <?php if (strcmp("BAT-IUFC", $rowb['code']) == 0) echo "selected=\"selected\""; ?>>
                            INSTITUT UNIVERSITAIRE DE LA FACE ET DU COU
                        </option>
                    </select>
                </td>
            </tr>
        </table>
        <?php
        // On cherche dans la table la fonction a laquel l'employ� est affect�e et on la selectionne par defaut
        $req = "SELECT code FROM personnel_fonction WHERE Identifiant='" . $row['identifiant'] . "'";
        $req = mysql_query($req);
        $rowf = mysql_fetch_array($req);
        ?>
        <table align="center">
            <h3>Fonction :</h3>
            <tr>
                <td>
                    <select name="fonction" style="max-width:300px;">
                        <?php
                        for ($i = 2; $i < 200; $i++) {
                            $name = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
                            $text = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue();
                            if ($name != "") {
                                echo "<option value=\"" . $name . "\"";
                                if (strcmp($name, $rowf['code']) == 0)
                                    echo "selected=\"selected\"";
                                echo ">" . $text . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <?php
        // On cherche dans la table le pole au laquel l'employ� est affect�e et on la selectionne par defaut
        $req = "SELECT code FROM personnel_pole WHERE Identifiant='" . $row['identifiant'] . "'";
        $req = mysql_query($req);
        $rowp = mysql_fetch_array($req);
        ?>
        <table align="center">
            <h3>Pole :</h3>
            <tr>
                <td>
                    <select name="pole" style="max-width:300px;">
                        <?php
                        for ($i = 2; $i < 200; $i++) {
                            $text = $objPHPExcel2->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
                            $name = $objPHPExcel2->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue();
                            if ($name != "") {
                                echo "<option value=\"" . $name . "\"";
                                if (strcmp($name, $rowp['code']) == 0)
                                    echo "selected=\"selected\"";
                                echo ">" . $text . "</option>";
                            }
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

            // On cherche dans la table le pole au laquel l'employ� est affect�e et on la selectionne par defaut
            $req = "SELECT code FROM personnel_unite WHERE Identifiant='" . $row['identifiant'] . "'";

            for ($i = 2; $i < 200; $i++) {
                $name = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
                $text = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue();

                if ($name != "") {
                    echo "<input type=\"checkbox\" name=\"unit[]\" value=\"$name\"";
                    $req1 = mysql_query($req);
                    while ($rowu = mysql_fetch_array($req1)) {
                        if (strcmp($name, $rowu['code']) == 0)
                            echo "checked=\"checked\"";
                    }
                    echo "/>" . $text . "</br>";
                }
            }
            ?>
        </div>
        <center><input type="submit" value="Valider" class="btn btn-primary" style="margin-top:15px;"/>
            <input type="button" class="btn btn-inverse" style="margin-top:15px;"
                   onClick="javascript:window.history.go(-1)" value="Retour"/></center>

    </form>
</div>
</body>