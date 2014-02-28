<?php

class ConnexionBD
{
    var $bdd;

    function connexion()
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

    function deconnexion()
    {
        mysql_close($this->bdd);
    }
}