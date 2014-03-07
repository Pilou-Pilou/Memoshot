<?php

class cryptModele
{

    public $cle_taille;
    public $iv_taille;
    public $iv;
    public $cle;

    function __construct()
    {
        // On calcule la taille de la clé pour l'algo triple des
        $this->cle_taille = mcrypt_module_get_algo_key_size(MCRYPT_3DES);
        // On calcule la taille du vecteur d'initialisation pour l'algo triple des et pour le mode NOFB
        $this->iv_taille = mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_NOFB);
        //On fabrique le vecteur d'initialisation, la constante MCRYPT_RAND permet d'initialiser un vecteur aléatoire
        $this->iv = mcrypt_create_iv($this->iv_taille, MCRYPT_RAND);
        $cle = "Ceci est une clé censé crypter un message mais à mon avis elle est beaucoup trop longue";
        // On retaille la clé pour qu'elle ne soit pas trop longue
        $this->cle = substr($this->cle, 0, $this->cle_taille);
    }


}

?>