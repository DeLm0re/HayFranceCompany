<?php
include_once '../objet/session_objet.php';
include_once '../objet/administration/o_admin.php';
$admin = new Admin($bdd);
demarreSession($admin);

$id_produit = (isset($_GET["variable1"])) ? $_GET["variable1"] : NULL;
$produit = new Produit($bdd, $id_produit) ; 
$admin->supprimeProduit($produit) ;
echo"fini" ;
