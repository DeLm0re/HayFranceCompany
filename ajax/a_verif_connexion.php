<?php
    //inclusion de la session et des objets
    include_once '../objet/session_objet.php';
    $user = new Utilisateur($bdd);
    demarreSession($user);

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
/* Si on valide le formulaire une série de test est effectuée */

if (($_GET['champ_connexion'] == 'button_connexion')) {
    if ((isset($_GET['email_connexion']) AND empty($_GET['email_connexion']) ) || ((strlen($_GET['email_connexion'])) > 100)
            ||(preg_match("/^[-+.\w]{1,64}@[-.\w]{1,15}\.[-.\w]{2,6}$/i", trim($_GET['email_connexion'])) == 0)) {
        echo "erreur_connexion";
    }
    else if (isset($_GET['mdp_connexion']) AND empty($_GET['mdp_connexion']) ){
        echo "erreur_connexion";
    }
    else{
       $return =  $user->connecte($_GET['email_connexion'], $_GET['mdp_connexion']);
       if($return === TRUE)
       {
           echo "connexionR";
           unset($_SESSION['nom_departement']);
           unset($_SESSION['nb_departement']);
       }else{
            echo "connexionF";
       }
    }
}