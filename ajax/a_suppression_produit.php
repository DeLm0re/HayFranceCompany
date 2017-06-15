<?php
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

$id_du_produit = $_GET['id'];

$produit = new Produit($bdd, $id_du_produit);
$user->retireProduitPanier($produit);
        
echo("suppression");

?>
