<?php
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

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

/* Si on effectue l'ajax sur un champ(input) d'id 'ville' on rentre dans le if */
if (($_GET['champ'] == 'ville')) {
    if ((strlen($_GET['contenu']) > 100)){
        echo "KO";
    } else {
        echo "OK";
    }
}
/* ---------------------------------------------------------------------------------- */

/* Si on effectue l'ajax sur un champ(input) d'id 'ville' on rentre dans le if */
if (($_GET['champ'] == 'adresse')) {
    if ((strlen($_GET['contenu']) > 500)){
        echo "KO";
    } else {
        echo "OK";
    }
}
/* ---------------------------------------------------------------------------------- */

/* Si on effectue l'ajax sur un champ(input) d'id 'dpt' on rentre dans le if */
if (($_GET['champ'] == 'dpt')) {
    if ((strlen($_GET['contenu']) > 2) || ($_GET['contenu'] == 20)
            || (is_int($_GET['contenu'] == false))){
        echo "KO";
    } else {
        echo "OK";
    }
}
/* ---------------------------------------------------------------------------------- */

/* Si on valide le formulaire une série de test est effectuée */
if (($_GET['champ'] == 'button')) {
    
    if (( isset($_GET['prenom']) AND empty($_GET['prenom']) ) || ((strlen($_GET['prenom'])) > 50)
            || (preg_match('`^[a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+'
                    . '(?:[\ \-\'][a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+)*$`',$_GET['prenom']) == 0)) {
        echo "erreur_prenom";
        
    } else if (( isset($_GET['nom']) AND empty($_GET['nom']) ) || ((strlen($_GET['nom'])) > 50)
            || (preg_match('`^[a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+'
                    . '(?:[\ \-\'][a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+)*$`',$_GET['nom']) == 0)) {
        echo "erreur_nom";
        
    } else if ((isset($_GET['email']) AND empty($_GET['email']) ) || ((strlen($_GET['email'])) > 100) || 
            (preg_match("/^[-+.\w]{1,64}@[-.\w]{1,15}\.[-.\w]{2,6}$/i", trim($_GET['email'])) == 0)) {
        /**ENVOIE MAIL*/
        echo "erreur_email";
        
    } else if (( isset($_GET['mdp']) AND empty($_GET['mdp']) ) || ((strlen($_GET['mdp'])) > 50) ||
            (preg_match('`^[a-zA-Z0-9]*$`', trim($_GET['mdp'])) == 0)) {
        echo "erreur_mdp";
        
    } else if ($_GET['mdp'] != $_GET['cmdp']) {                                                             
        echo "erreur_cmdp";
        
    } else if (( isset($_GET['ville']) AND empty($_GET['ville']) ) || ((strlen($_GET['ville'])) > 100)) {
        echo "erreur_ville";
        
    } else if (( isset($_GET['adresse']) AND empty($_GET['adresse']) ) || ((strlen($_GET['adresse'])) > 500)) {
        echo "erreur_adresse";
        
    } else if (( isset($_GET['dpt']) AND empty($_GET['dpt']) ) ||((strlen($_GET['dpt'])) > 2) || ($_GET['dpt'] == 20) 
            || (is_int($_GET['dpt'] == false)))  {
        echo "erreur_dpt";
        
    }else{
        $user->inscrit($_GET['nom'],$_GET['prenom'],$_GET['civ'],$_GET['email'],
                $_GET['mdp'],$_GET['ville'],$_GET['adresse'],$_GET['dpt']);
        echo "inscription_valide";
    }
}