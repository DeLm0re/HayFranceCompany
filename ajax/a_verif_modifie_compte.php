<?php

//inclusion de la session et des objets
include_once '../objet/session_objet.php';


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

/* Si on effectue l'ajax sur un champ(input) d'id 'ville'/'adresse' on rentre dans le if */
if (($_GET['champ'] == 'ville') || ($_GET['champ'] == 'adresse')) {
    if (isset($_GET['champ']) AND empty($_GET['contenu'])){
        echo "KO";
    } else {
        echo "OK";
    }
}
/* ---------------------------------------------------------------------------------- */

/* Si on effectue l'ajax sur un champ(input) d'id 'dpt' on rentre dans le if */
if ($_GET['champ'] == 'dpt') {
    if ( (isset($_GET['champ']) AND empty($_GET['contenu'])) || ($_GET['contenu'] == 20) ){
        echo "KO";
    } else {
        echo "OK";
    }
}
/* ---------------------------------------------------------------------------------- */

/* Si on valide le formulaire une série de test est effectuée */
if (($_GET['champ'] == 'button')) {
    
   
    if ((isset($_GET['email']) AND empty($_GET['email']) ) || ((strlen($_GET['email'])) > 100)) {
        /**ENVOIE MAIL*/
        echo "erreur_email";
    } else if (( isset($_GET['mdp']) AND empty($_GET['mdp']) ) || ((strlen($_GET['mdp'])) > 50)) {
        echo "erreur_mdp";
    } else if ($_GET['mdp'] != $_GET['cmdp']) {                                                             
        echo "erreur_cmdp";
    } else if (( isset($_GET['ville']) AND empty($_GET['ville']) ) || ((strlen($_GET['ville'])) > 100)) {
        echo "erreur_ville";
    } else if (( isset($_GET['adresse']) AND empty($_GET['adresse']) ) || ((strlen($_GET['adresse'])) > 500)) {
        echo "erreur_adresse";
    } else if (( isset($_GET['dpt']) AND empty($_GET['dpt']) ) || ((strlen($_GET['dpt'])) > 2) || $_GET['dpt'] == 20)  {
        echo "erreur_dpt";
    }else{
       
        // a ajouter le compte Utilisateur 
        
    }
}