<!--
/**********************************************************************************
* UNIVERSITE NICE SOPHIA ANTIPOLIS
* PROJET DE WEB MAI 2013: PHP
* AUTEUR : STEVEN GUERY JACQUEMET CORENTIN MOLINENGO MATHIEU
* Thème : gestion de deconnexion du personnel
*/
-->

<head>
    <title>fermer session</title>
<?php
session_start();
session_destroy();
header('Location: ../index.html');
?>