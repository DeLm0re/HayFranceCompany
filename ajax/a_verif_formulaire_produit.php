<?php

//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

/* ---------------------------------------------------------------------------------- */
//On effectue une preverif
if ($_GET['champ'] === 'input_palette') {
    if (((($_GET['contenu']) > 8) || (($_GET['contenu']) <= 0)) || (isset($_GET['contenu']) && empty($_GET['contenu']))) {
        echo "KO";
    } else {
        echo "OK";
    }
}

/* Si on valide le formulaire une série de test est effectuée */

if (($_GET['champ'] === 'button')) {

    $id = $_GET['id'];
    $format = $_GET['format'];
    $nbr = $_GET['nbr'];
    $produit = new Produit($bdd, $id);

    if (empty($user->donneInfos())) {
        echo "non_co";
    } else if ((isset($_GET['nbr']) AND empty($_GET['nbr']) ) || ($_GET['nbr'] > 8) || ($_GET['nbr'] <= 0)) {
        echo "erreur_input";
    } else {
        $resultat = $user->ajouteProduitPanier($produit, $format, $nbr);

        if ($resultat === true) {
            echo "resultat_true";
        } else {
            echo "resultat_false";
        }
    }
}
