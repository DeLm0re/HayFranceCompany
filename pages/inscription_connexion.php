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
        <link href="../css/i_inscription_connexion.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>
        <div class="page">
            <div class="bloc-principal">
                <?php
                include '../includes/i_navbar.php';
                ?>
                <div class="div_inscription_connexion">
                    <div class="div_connexion">
                        <?php
                        /* inclusion du formulaire de connexion */
                        include '../includes/i_connexion.php';
                        ?>
                    </div>
                    <div class="div_inscription">
                        <?php
                        /* inclusion du formulaire d'inscription */
                        include '../includes/i_inscription.php';
                        ?>
                    </div>
                </div>

                <div class="clear"></div>
                
            </div><!-- fin bloc-principal -->
            <?php
            include '../includes/i_footer.php';
            ?>

            <!-- SCRIPTS POUR L'AJAX -->
            <script src="../js/a_connexion.js" type="text/javascript"></script>
            <script src="../js/a_inscription.js" type="text/javascript"></script> 
            <script src="../js/oXHR.js" type="text/javascript"></script>
            
        </div><!-- fin page -->
    </body>
</html>