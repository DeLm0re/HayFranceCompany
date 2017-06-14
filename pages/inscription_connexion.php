<?php
    //inclusion de la session et des objets
    include_once '../objet/session_objet.php';
    $user = new Utilisateur($bdd);
    demarreSession($user);
?>
<html>
    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui"/>
            <link href="../css/index.css" rel="stylesheet" type="text/css"/>
           
    </head>
 
    <body>
        <div class="page">
	<div class="bloc-principal">
           
        <?php       
            /*inclusion du formulaire de connexion*/
            include '../includes/i_connexion.php';
            
            include '../includes/i_inscription.php';    
        ?>
          
        <!-- SCRIPTS POUR L'AJAX -->
        <script src="../js/a_connexion.js" type="text/javascript"></script>
        <script src="../js/a_inscription.js" type="text/javascript"></script> 
        <script src="../js/oXHR.js" type="text/javascript"></script>
    
        <div class="clear"></div>
	</div><!-- fin bloc-principal -->
	<?php
            include '../includes/i_footer.php';
        ?>
        </div><!-- fin page -->
    </body>
</html>