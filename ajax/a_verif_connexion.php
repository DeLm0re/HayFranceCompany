<?php
    //inclusion de la session et des objets
    include_once '../objet/session_objet.php';


/* ---------------------------------------------------------------------------------- */
// verification du champ de mail
if (($_GET['champ'] == 'email')) {
    if ((preg_match("/^[-+.\w]{1,64}@[-.\w]{1,15}\.[-.\w]{2,6}$/i", trim($_GET['contenu'])) == 0) || ((strlen($_GET['contenu'])) > 100)) {
        echo "KO";
    } else {
        echo "OK";
    }
}

/* ---------------------------------------------------------------------------------- */
// verification du champ de mot de passe 
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
    if ((isset($_GET['email']) AND empty($_GET['email']) ) || ((strlen($_GET['email'])) > 100)) {
        echo "erreur_email";
    }else if (( isset($_GET['mdp']) AND empty($_GET['mdp']) ) || ((strlen($_GET['mdp'])) > 50)) {
        echo "erreur_mdp";
    }    
    else{
        var_dump($_GET['email']);
        $user->connecte($_GET['email'], $_GET['mdp']);
        
    }
}