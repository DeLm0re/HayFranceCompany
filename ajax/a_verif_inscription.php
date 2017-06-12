<?php

//inclusion de la session et des objets
include_once '../objet/session_objet.php';

/* Si on effectue l'ajax sur un champ(input) d'id 'nom'/'prenom' on rentre dans le if */
if (($_GET['champ'] == 'nom') || ($_GET['champ'] == 'prenom')) {
    if ((preg_match('`^[a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+'
                    . '(?:[\ \-\'][a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+)*$`', trim($_GET['contenu'])) == 0) || ((strlen($_GET['contenu'])) > 50)) {
        echo "KO";
    } else {
        echo "OK";
    }
}
/* ---------------------------------------------------------------------------------- */

/* Si on effectue l'ajax sur un champ(input) d'id 'email' on rentre dans le if */
if (($_GET['champ'] == 'email')) {
    if ((preg_match("/^[-+.\w]{1,64}@[-.\w]{1,15}\.[-.\w]{2,6}$/i", trim($_GET['contenu'])) == 0) || ((strlen($_GET['contenu'])) > 100)) {
        echo "KO";
    } else {
        echo "OK";
    }
}
/* ---------------------------------------------------------------------------------- */

/* Si on effectue l'ajax sur un champ(input) d'id 'mdp'/'cmdp' on rentre dans le if */
if (($_GET['champ'] == 'mdp') || ($_GET['champ'] == 'cmdp')) {
    if ((preg_match('`^[a-zA-Z0-9]*$`', trim($_GET['contenu'])) == 0) || (strlen($_GET['contenu'])) > 50) {
        echo "KO";
    } else {
        echo "OK";
    }
}
/* ---------------------------------------------------------------------------------- */

/* Si on valide le formulaire une série de test est effectuée */
if (($_GET['champ'] == 'button')) {
    
    if (( isset($_GET['prenom']) AND empty($_GET['prenom']) ) || ((strlen($_GET['prenom'])) > 50)) {
        echo "erreur_prenom";
    } else if (( isset($_GET['nom']) AND empty($_GET['nom']) ) || ((strlen($_GET['nom'])) > 50)) {
        echo "erreur_nom";
    } else if ((isset($_GET['email']) AND empty($_GET['email']) ) || ((strlen($_GET['email'])) > 100)) {
        /**ENVOIE MAIL*/
        echo "erreur_email";
    } else if (( isset($_GET['mdp']) AND empty($_GET['mdp']) ) || ((strlen($_GET['mdp'])) > 50)) {
        echo "erreur_mdp";
    } else if ($_GET['mdp'] != $_GET['cmdp']) {                                                             
        echo "erreur_cmdp";
    }else{
    }
}