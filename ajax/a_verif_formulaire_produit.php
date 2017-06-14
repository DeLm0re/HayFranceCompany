<?php
    //inclusion de la session et des objets
     $user = new Utilisateur($bdd);
    demarreSession($user);
    $info = $user->donneInfos();
    $departement = intval($info['departement']);
    $prix = new PrixTransport($bdd,$departement);
  $prix_transport =   $prix->infos(); 
  //  var_dump($user);
  
  function trouve_prix_tansport( $nombre_pallette , $prix_du_transport){
      
      $id_transport = "p"+ strval($nombre_pallette) ;
      
      $prix_transport_coorespondant = $prix_du_transport[$id_transport] ;
      
      return  $prix_transport_coorespondant;
  }
  

/* ---------------------------------------------------------------------------------- */
// verification du champ de mail
if (($_GET['nbr_pallette'] >= 8)&&($_GET['nbr_pallette'] <= 0)){
   
        echo "KO";
   
}else {
        echo "OK";
    }

/* ---------------------------------------------------------------------------------- */
// verification du champ de mot de passe 
if ($_GET['Format'] == 22)  {
    
    $prix_produit = $_GET['id_produit'] ; 
    $prix_transport_calcul =  trouve_prix_tansport( $_GET['nbr_pallette'] , $prix_transport) ; 
   
        echo "OK";
    } else {
         echo "KO";
}
if ($_GET['Format'] == 32)  {
   
    
        echo "OK";
    } else {
        echo "KO";
        
    
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

