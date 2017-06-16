<?php
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

$id_produit = $_GET['id'];
$nbr_palette = $_GET['nbr'];

$produit = new Produit($bdd, $id_produit);
$user->changeNbrPalette($produit, $nbr_palette);
        
echo("modification");

?>
