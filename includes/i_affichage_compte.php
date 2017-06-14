<?php
  //inclusion de la session et des objets
    include_once '../objet/session_objet.php';
    $user = new Utilisateur($bdd);
    demarreSession($user);
    $info = $user->donneInfos();
//    var_dump($user->donneInfos());
    $nom = $info['nom'];
    $prenom = $info['prenom'];
    $civ = $info['civilite'];
    $email = $info['email'];
    $ville = $info['ville'];
    $adresse  = $info['adresse'];
    $departement =$info['departement'];
    
?> 

<fieldset id="affichage_du_compte">
    <form>
        <p class="titre">Votre compte <p> 
            <!-- affichage du compte client -->
            
            <div class="div_contenu">
                    <p class="p_contenu"> Votre civilite : <?php echo$civ; ?>  </p>
                </div>
                
                <div class="div_contenu">
                    <p class="p_contenu"> Votre nom : <?php echo$nom; ?>  </p>
                </div>
        
                <div class="div_contenu">
                    <p class="p_contenu"> Votre prénom : <?php echo$prenom; ?>  </p>
                </div>
                
                <div class="div_contenu">
                    <p class="p_contenu"> Votre email : <?php echo$email; ?>  </p>
                </div>
        
                <div class="div_contenu">
                    <p class="p_contenu"> Votre ville : <?php echo$ville; ?>  </p>
                </div>
        
                <div class="div_contenu">
                    <p class="p_contenu"> Votre adresse : <?php echo$adresse; ?>  </p>
                </div>
        
                 <div class="div_contenu">
                    <p class="p_contenu"> Votre département : <?php echo$departement; ?>  </p>
                </div>    

</fieldset>



