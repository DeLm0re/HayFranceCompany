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
$adresse = $info['adresse'];
$departement = $info['departement'];
?> 

<form id="formulaire">
    <div class="div_titre">
        <span class="titre">Informations de votre compte</span> 
    </div>

    <div class="div_ensemble_champ">
        
        <div class="div_champ">
            <span class="champ"> Votre civilite : <?php echo$civ; ?></span><br>
        </div>

        <div class="div_champ">
            <span class="champ"> Votre nom : <?php echo$nom; ?>  </span><br>
        </div>

        <div class="div_champ">
            <span class="champ"> Votre prénom : <?php echo$prenom; ?>  </span><br>
        </div>

        <div class="div_champ">
            <span class="champ"> Votre email : <?php echo$email; ?>  </span><br>
        </div>

        <div class="div_champ">
            <span class="champ"> Votre ville : <?php echo$ville; ?>  </span><br>
        </div>

        <div class="div_champ">
            <span class="champ"> Votre adresse : <?php echo$adresse; ?>  </span><br>
        </div>

        <div class="div_champ">
            <span class="champ"> Votre département : <?php echo$departement; ?>  </span><br>
        </div> 
        
    </div>
</form>



