<?php
    //inclusion de la session et des objets
    include_once '../objet/session_objet.php';

/* ---------------------------------------------------------------------------------- */
// verification du champ de mail
if (($_GET['champ_connexion'] == 'email_connexion')) {
    if ((preg_match("/^[-+.\w]{1,64}@[-.\w]{1,15}\.[-.\w]{2,6}$/i", trim($_GET['contenu'])) == 0) || ((strlen($_GET['contenu'])) > 100)) {
        echo "KO_connexion";
    } else {
        echo "OK_connexion";
    }
}

/* ---------------------------------------------------------------------------------- */
// verification du champ de mot de passe 
if ($_GET['champ_connexion'] == 'mdp_connexion')  {
    if ((preg_match('`^[a-zA-Z0-9]*$`', trim($_GET['contenu'])) == 0) || (strlen($_GET['contenu'])) > 20) {
        echo "KO_connexion";
    } else {
        echo "OK_connexion";
    }
}

/* ---------------------------------------------------------------------------------- */
/* Si on valide le formulaire une série de test est effectuée */

if (($_GET['champ_connexion'] == 'button_connexion')) {
    if ((isset($_GET['email_connexion']) AND empty($_GET['email_connexion']) ) || ((strlen($_GET['email_connexion'])) > 100)) {
        echo "erreur_email_connexion";
    }else if (( isset($_GET['mdp_connexion']) AND empty($_GET['mdp_connexion']) ) || ((strlen($_GET['mdp_connexion'])) > 50)) {
        echo "erreur_mdp_connexion";
    }    
    else{
       
       $return =  $user->connecte($_GET['email_connexion'], $_GET['mdp_connexion']);
       if($return === TRUE)
       {
           echo "connexionR";
       }else{
            echo "connexionF";
       }
    }
}