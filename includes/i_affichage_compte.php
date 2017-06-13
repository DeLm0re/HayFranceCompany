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

<fieldset id="affichage du compte">
    <form>
        <p class="titre">Votre compte <p> 
            <!-- affichage du compte client -->
            
            <div class="div_contenu">
                    <p class="p_contenu"> votre civilite : <?php echo$civ; ?>  </p>
                </div>
                
                <div class="div_contenu">
                    <p class="p_contenu"> votre nom : <?php echo$nom; ?>  </p>
                </div>
        
                <div class="div_contenu">
                    <p class="p_contenu"> votre prenom : <?php echo$prenom; ?>  </p>
                </div>
                
                <div class="div_contenu">
                    <p class="p_contenu"> votre email : <?php echo$email; ?>  </p>
                </div>
        
                <div class="div_contenu">
                    <p class="p_contenu"> votre ville : <?php echo$ville; ?>  </p>
                </div>
        
                <div class="div_contenu">
                    <p class="p_contenu"> votre adresse : <?php echo$adresse; ?>  </p>
                </div>
        
                 <div class="div_contenu">
                    <p class="p_contenu"> votre département : <?php echo$departement; ?>  </p>
                </div>
		
        
            
          
    
</fieldset>



