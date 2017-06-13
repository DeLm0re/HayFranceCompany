<?php

//    var_dump($user->donneInfos());
    $nom = $user->donneInfos()['nom'];
    $prenom = $user->donneInfos()['prenom'];
    $civ = $user->donneInfos()['civilite'];
    $email = $user->donneInfos()['email'];
    $ville =  $user->donneInfos()['ville'];
    $adresse  = $user->donneInfos()['adresse'];
    $departement = $user->donneInfos()['departement'];
    
    var_dump($nom);
    var_dump($prenom);
    var_dump($civ);
    var_dump($email);
    var_dump($ville);
    var_dump($adresse);
    var_dump($departement);
?> 

<fieldset id="affichage du compte">
    <form>
        <p>Votre compte<p> 
            <!-- affichage du compte client -->
            
            
          
    
</fieldset>


