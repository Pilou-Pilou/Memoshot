<?php

if (!isset($_SESSION['id'])) {
    header('Location: ../');
    $_SESSION['erreur'] = 3;
}