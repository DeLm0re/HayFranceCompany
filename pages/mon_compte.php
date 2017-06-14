<?php
    //inclusion de la session et des objets
    include_once '../objet/session_objet.php';
    $user = new Utilisateur($bdd);
    demarreSession($user);
    
    if (empty($user->donneInfos()))  
    {
        header('Location: tout_produit.php');
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui"/>
            <link href="../css/i_inscription.css" rel="stylesheet" type="text/css"/>
    </head>
 
      <body>
           
          <?php       
             include '../includes/i_affichage_compte.php';
            /*inclusion du formulaire de modification du compte*/
            include '../includes/i_modifie_compte.php';
             
            ?>
          
          <!-- SCRIPTS POUR L'AJAX -->
        <script src="../js/a_modifie_compte.js" type="text/javascript"></script>
        <script src="../js/oXHR.js" type="text/javascript"></script>
    </body>
    <?php
        //include '../includes/i_footer.php'
    ?>
</html>