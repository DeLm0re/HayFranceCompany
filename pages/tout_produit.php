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
        <link href="../css/tout_produit.css" rel="stylesheet" type="text/css"/>
        <link href="../css/overlay.css" rel="stylesheet" type="text/css"/>
        <link href="../css/carte_overlay.css" rel="stylesheet" type="text/css"/>
    </head>


    <body>
        <div class="page">
	<div class="bloc-principal">
        <?php       
            /*inclusion de l'overlay*/
            include '../includes/i_overlay.php';
            
            /*inclusion de la navbar */
            include '../includes/i_navbar.php';
        ?>
       
        <div class="ensemble_produit">
            <p class="titre_ensemble_produit">
                TOUS NOS PRODUITS
            </p>
            <div class="tous_les_produits">
        <?php           
            /*inclusion de la fonction creer_section_article*/
            include '../includes/i_fonctions_produits.php';
        
            /*je recupére tous les articles */
            $listeProduits = $user -> consulteListeProduit();
            
            /*si on a choisi un animal en particulier */
            if (isset($_GET['id_animal']) === true){
                $id_animal = $_GET['id_animal'];
            }else{
                $id_animal = null;
            }
            
            /* et j'affiche en fonction de l'animal */
            creer_section_article($listeProduits,$id_animal);
        ?>
            </div>
        </div>
        
        <!-- SCRIPTS POUR L'AJAX -->
        <script src="../js/a_inscription.js" type="text/javascript"></script>
        <script src="../js/a_connexion.js" type="text/javascript"></script>
        <script src="../js/oXHR.js" type="text/javascript"></script>

        <!-- SCRIPTS POUR L'overlay -->
        <script src="../js/overlay.js" type="text/javascript"></script>
        <script src="../js/polyfill.js" type="text/javascript"></script>
            
        <div class="clear"></div>
        </div><!-- fin bloc-principal -->
            <?php
                include '../includes/i_footer.php';
            ?>
        </div><!-- fin page -->
    </body>
</html>
