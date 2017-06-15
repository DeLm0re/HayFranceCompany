<?php
include_once '../objet/session_objet.php';
    
    $user = new Utilisateur($bdd);
    demarreSession($user);
    $info = $user->donneContenuPanier();
    
    var_dump($info);
    

         