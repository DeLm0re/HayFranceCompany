<?php
include_once '../objet/session_objet.php';
    
    $user = new Utilisateur($bdd);
    demarreSession($user);
    $info = $user->donneContenuPanier();
    $info_produits =$user->donneInfos();
    var_dump($info);
    var_dump($info_produits);

    $nom_produit =  $user->donneContenuPanier();   
    var_dump($nom_produit);