<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/* ---------------------------------------------------------------------------------- */

if (($_GET['champ'] == 'email')) {
    if ((preg_match("/^[-+.\w]{1,64}@[-.\w]{1,15}\.[-.\w]{2,6}$/i", trim($_GET['contenu'])) == 0) || ((strlen($_GET['contenu'])) > 100)) {
        echo "KO";
    } else {
        echo "OK";
    }
}

/* ---------------------------------------------------------------------------------- */

if ($_GET['champ'] == 'mdp')  {
    if ((preg_match('`^[a-zA-Z0-9]*$`', trim($_GET['contenu'])) == 0) || (strlen($_GET['contenu'])) > 20) {
        echo "KO";
    } else {
        echo "OK";
    }
}

/* ---------------------------------------------------------------------------------- */

/* Si on valide le formulaire une série de test est effectuée */

if (($_GET['champ'] == 'button')) {
    /* varaible erreur pour savoir si on fait la requete */
    $erreur = false;

    if ((isset($_GET['email']) AND empty($_GET['email']) ) || ((strlen($_GET['email'])) > 100)) {
        /**ENVOIE MAIL*/
        echo "erreur_email";
        $erreur = true;
    }else if (( isset($_GET['mdp']) AND empty($_GET['mdp']) ) || ((strlen($_GET['mdp'])) > 50)) {
        echo "erreur_mdp";
        $erreur = true;
    }    
    if ($erreur != true){
        echo"np";/*faire requete*/
    }
}