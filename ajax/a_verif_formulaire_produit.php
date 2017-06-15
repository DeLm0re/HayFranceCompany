<?php

//inclusion de la session et des objets
include_once '../objet/session_objet.php';
// recuperation de l'id departement de l'utilisateur
$user = new Utilisateur($bdd);
demarreSession($user);

$produit = new Produit($bdd, $_GET['id_produit']);


/* ---------------------------------------------------------------------------------- */
//verifie
if ($_GET['champ'] == "nbr_pallette") {
    if ((($_GET['contenu']) > 8) || (($_GET['contenu']) <= 0)) {

        echo "KO";
    } else {
        echo "OK";
    }
}

/* Si on valide le formulaire une série de test est effectuée */

if (($_GET['champ'] == 'button')) {

    if (empty($user->donneInfos())) {
        echo "NonCo";
    } else if ((isset($_GET['nbr_pallette']) AND empty($_GET['nbr_pallette']) ) || ($_GET['nbr_pallette'] >= 8) || ($_GET['nbr_pallette'] <= 0)) {
        echo "erreur_nbr_pallette";
    } else if (( isset($_GET['Format']) AND empty($_GET['Format']))) {
        echo "erreur_Format";
    } else {

        $resultat = $user->ajouteProduitPanier($produit, $_GET['Format'], $_GET['nbr_pallette']);
        
        if ($resultat == TRUE) {
            echo "ajoutT";
        } else  {
            echo "ajoutF";
        }
    }
}

