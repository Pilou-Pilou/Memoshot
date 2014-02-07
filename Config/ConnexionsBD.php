<?php

/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07/02/14
 * Time: 10:34
 */
class ConexionsBD
{

    var $bdd;

    function conexions()
    {
        $ini_array = parse_ini_file("../Config/login_db.ini");
        $user = $ini_array["user"];
        $pass = $ini_array["pass"];
        $host = $ini_array["host"];
        $base = $ini_array ["base"];
        // Connexion a phpmyadmin
        $bdd = mysql_connect($host, $user, $pass) or die('Impossible de se connecter: ' . mysql_error());
        // Connection à la base de donnée
        mysql_select_db($base, $bdd) or die('Impossible de se connecter: ' . mysql_error());

    }

    function deconnexions()
    {
        mysql_close($bdd);
    }

}