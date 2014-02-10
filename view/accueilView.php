<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 07/02/14
 * Time: 09:48
 */

session_start();
echo "Bonjour, vous êtes bien connecté " . $_SESSION['pseudo'];