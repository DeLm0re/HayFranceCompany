<?php
    //inclusion de la session et des objets
    include_once '../objet/session_objet.php';
    $user = new Utilisateur($bdd);
    demarreSession($user);
    
    if (empty($user->donneInfos()['departement']))  
    {
        header('location:inscription_connexion.php');
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui"/>
            <link href="../css/i_inscription_connexion.css" rel="stylesheet" type="text/css"/>
    </head>
 
    <body>
        <div class="page">
	<div class="bloc-principal">
           
        <?php       
            include '../includes/i_affichage_compte.php';
            /*inclusion du formulaire de modification du compte*/
            include '../includes/i_modifie_compte.php';     
        ?>
          
        </div><!-- fin bloc-principal -->
	<?php
            include '../includes/i_footer.php';
        ?>
        </div><!-- fin page -->
        
        <!-- SCRIPTS POUR L'AJAX -->
        <script src="../js/a_modifie_compte.js" type="text/javascript"></script>
        <script src="../js/oXHR.js" type="text/javascript"></script>
        <div class="clear"></div>
    </body>
</html>