<!--
/**********************************************************************************
* UNIVERSITE NICE SOPHIA ANTIPOLIS
* PROJET DE WEB MAI 2013: PHP
* AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
* Th�me:permet la recherche d'un membre du personnel dans la basse de donn�e, elle cr�er un liens vers la fiche
* d�taill� de la personne s�lection�e.
*/
-->

<head>
    <!-- CSS -->
    <link rel="stylesheet" href="../style/bootstrap.css"/>

    <!-- Pr�-requis pour PHP -->
    <?php
    session_start();
    if ($_SESSION['admin'] == false)
        echo "<title>Bienvenue " . $_SESSION['civilite'] . ". " . $_SESSION['nom'] . "</title>";
    else
        echo "<title>Bienvenue Administrateur</title>";

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
    $objPHPExcel3 = $objReader->load("../BASE_CODAGE_UNITE_SQL.xlsx");

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

    $nom = $_GET['nom'];
    $fonction = $_GET['fonction'];
    $unite = $_GET['unite'];
    $pole = $_GET['pole'];
    $bat = $_GET['batiment'];
    ?>

    <!-- Script d'actualisation -->
    <script type="text/javascript">
        function refresh() {
            var nom = document.getElementById('nom').value;
            var fonction = document.getElementById('fonction').value;
            var unite = document.getElementById('unite').value;
            var pole = document.getElementById('pole').value;
            var bat = document.getElementById('bat').value;

            window.location = 'rechercher.php?nom=' + nom + '&fonction=' + fonction + '&unite=' + unite + '&pole=' + pole + '&batiment=' + bat;
        }
    </script>
</head>
<body>

<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container">

            <h3 style="margin-left:0px;" align="center">Rechercher une personne</h3>

        </div>
    </div>
</div>

<!-- Formulaire de recherche -->
<div class=" ">
    <form name="rechercher">
        <table align="center">
            <tr>
                <td>Nom :</td>
                <td><input type="text" size="25" name="nom" onChange="refresh()" value="Par exemple MOLINENGO"
                           onClick="nom.value='';"/></td>
            </tr>
            <tr>
                <td>Batiment :</td>
                <td>
                    <select name="batiment" style="max-width:250px;" onChange="refresh()">
                        <option value="">Tous</option>
                        <option value="BAT-A">BATIMENT A</option>
                        <option value="BAT-B">BATIMENT B</option>
                        <option value="BAT-C">BATIMENT C</option>
                        <option value="BAT-IUFC">INSTITUT UNIVERSITAIRE DE LA FACE ET DU COU</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Fonction :</td>
                <td>
                    <select name="fonction" style="max-width:250px;" onChange="refresh()">
                        <option value="">Tous</option>
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
            <tr>
                <td>Pole :</td>
                <td>
                    <select name="pole" style="max-width:250px;" onChange="refresh()">
                        <option value="">Tous</option>
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
            <tr>
                <td>Unit&eacute; :</td>
                <td>
                    <select name="unite" style="max-width:250px;" onChange="refresh()">
                        <option value="">Tous</option>
                        <?php
                        for ($i = 2; $i < 200; $i++) {
                            $name = $objPHPExcel3->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
                            $text = $objPHPExcel3->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue();
                            if ($name != "")
                                echo "<option value=\"" . $name . "\">" . $text . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" class="btn btn-primary" value="Rechercher" onclick="refresh()"/ ></td>
                <td><input type="reset" class=" btn btn-inverse" value="Annuler"/></td>
            </tr>
        </table>
    </form>
</div>

<!-- recherche de resultat -->
<?php
// Sauvegarde des �l�ments de recherche
$nom = mysql_real_escape_string($_GET['nom']);
$fonction = $_GET['fonction'];
$bat = $_GET['batiment'];
$pole = $_GET['pole'];
$unite = $_GET['unite'];

$nom = strtoupper($nom);

// Pr�-requis pour la requete
$Query = '';

if (!empty($nom) && $nom != '*')
    $Query .= "p.nom like '{$nom}%'";
if (!empty($bat))
    $Query .= ((!empty($Query)) ? ' AND ' : '') . "pb.code = '$bat' AND pb.identifiant = p.identifiant";
if (!empty($fonction))
    $Query .= ((!empty($Query)) ? ' AND ' : '') . "pf.code = '$fonction' AND pf.identifiant = p.identifiant";
if (!empty($pole))
    $Query .= ((!empty($Query)) ? ' AND ' : '') . "po.code = '$pole' AND po.identifiant = p.identifiant";
if (!empty($unite))
    $Query .= ((!empty($Query)) ? ' AND ' : '') . "pu.code = '$unite' AND pu.identifiant = p.identifiant";

if ($nom == '*' && empty($Query)) {
    $Query = 'All';
    $req = "SELECT p.nom, p.civilite, p.prenom, p.identifiant
			FROM personnel p, personnel_unite pu, personnel_batiment pb, personnel_pole po,  personnel_fonction pf
			GROUP BY p.nom, p.prenom
			ORDER BY p.nom , p.prenom";
} else { // Emission de la requette/*
    $req = "SELECT p.nom, p.civilite, p.prenom, p.identifiant
		FROM personnel p, personnel_unite pu, personnel_batiment pb, personnel_pole po,  personnel_fonction pf
		WHERE $Query
		GROUP BY p.nom, p.prenom
		ORDER BY p.nom , p.prenom";
}
?>

<!-- affichage du resultat-->
<?php
if (!empty($Query)) {
    // Execution de la requete
    $req = mysql_query($req) or die ("La requete ne s'est pas Ex&eacutecut&eacute: " . mysql_error());
}
// Si il y a aucun r�sultat ou que la requette est vide
if (empty($Query) || mysql_num_rows($req) == 0)
    echo '<center>Aucun r&eacutesultat trouv&eacute</center>';
else {
    echo '<table name="resultat" align="center">
				<tr>
					<th width="' . (($_SESSION['admin'] == true) ? '5%' : '5%') . '">Civilit&eacute</th>
					<th width="' . (($_SESSION['admin'] == true) ? '20%' : '25%') . '">NOM Prenom</th>
					<th width="' . (($_SESSION['admin'] == true) ? '25%' : '25%') . '">Unit&eacute</th>
					<th width="' . (($_SESSION['admin'] == true) ? '35%' : '45%') . '">Fonction</th>';
    if ($_SESSION['admin'] == true)
        echo '<th>Modifier</th><th>Supprimer</th>';

    echo '</tr>';

    while ($row = mysql_fetch_assoc($req)) {
        echo '<tr>
				<td align="center">' . $row['civilite'] . '</td>
				<td align="center"><a href="affiche.php?nom=' . $row['nom'] . '&prenom=' . $row['prenom'] . '">' . $row['nom'] . ' ' . $row['prenom'] . '</a></td>
				<td align="center">';

        // Affiche la premiere unit� dans lequel l'employ� trouv� est affect�
        if (!empty($unite)) {
            $requ = "SELECT definition FROM unite WHERE code = '$unite'";
            $requ = mysql_query($requ) or die("Erreur sur la requete !");
            while ($rowu = mysql_fetch_array($requ)) {
                echo $rowu['definition'];
            }
        } else {
            $requ = "SELECT definition FROM unite INNER JOIN personnel_unite ON personnel_unite.code = unite.code WHERE Identifiant = '" . $row['identifiant'] . "' LIMIT 0 , 1";
            $requ = mysql_query($requ) or die("Erreur sur la requete !");
            while ($rowu = mysql_fetch_array($requ)) {
                echo $rowu['definition'];
            }
        }
        echo '</td>
				<td align="center">';

        // Affiche la premiere fonction dans lequel l'employ� trouv� est affect�
        if (!empty($fonction)) {
            $requ = "SELECT definition FROM fonction WHERE code = '$fonction'";
            $requ = mysql_query($requ) or die("Erreur sur la requete !");
            while ($rowu = mysql_fetch_array($requ)) {
                echo $rowu['definition'];
            }
        } else {
            $requ = "SELECT definition FROM fonction INNER JOIN personnel_fonction ON personnel_fonction.Code = fonction.code WHERE Identifiant = '" . $row['identifiant'] . "' LIMIT 0 , 1";
            $requ = mysql_query($requ) or die("Erreur sur la requete !");
            while ($rowu = mysql_fetch_array($requ)) {
                echo $rowu['definition'];
            }
        }
        echo '</td>';

        // Verification Administrateur
        if ($_SESSION['admin'] == true) {
            echo '<td align="center"><input type="button" value="Modifier"class="btn btn-warning" onClick="javascript:location.href=\'formulaire_modif.php?prenom=' . $row['prenom'] . '&nom=' . $row['nom'] . '&fonction=' . $fonction . '&unite=' . $unite . '&pole=' . $pole . '&batiment=' . $bat . '\'"/></td>';
            echo '<td><input type="button" value="Supprimer" class="btn btn-danger" onClick="javascript:location.href=\'supprPersonnel.php?prenom=' . $row['prenom'] . '&nom=' . $row['nom'] . '&fonction=' . $fonction . '&unite=' . $unite . '&pole=' . $pole . '&batiment=' . $bat . '\'"/></td>';
        }

        echo '</tr>';
    }
}
?>
</table>

<!-- Bouton "Ajouter" -->
<?php
if ($_SESSION['admin'] == true)
    echo '<center><form name="Ajouter" align="center" method="post" action="formulaire_ajout.php">
		<input type="submit" value="Ajouter" class="btn btn-success"/>
		</form></center>';
?>
<h4 align='center'> Pour voir la liste des employ&eacute;s d'un batiment,d'une fonction,d'un pole,d'une
    unit&eacute </br> ou encore du centre hospitalier:</br> Mettez un '*' a la place du Nom.</h4>

<h3 class="deconnect"><a href="fermer_session.php">D&eacuteconnecter</a></h3>
</body>