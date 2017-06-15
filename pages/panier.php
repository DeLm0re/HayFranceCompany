<?php
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

if (empty($user->donneInfos()['departement'])) {
    header('location:inscription_connexion.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui"/>
        <link href="../css/i_panier.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="page">

            <div class="bloc-principal">
                <?php
                /* inclusion de la navbar */
                include '../includes/i_navbar.php';
                ?>

                <div class="div_ensemble_panier">
                    <?php
                    include '../includes/i_panier.php';
                    ?>
                </div>

            <div class="clear"></div>
        </div><!-- fin bloc-principal -->

        <?php
        include '../includes/i_footer.php';
        ?>

    </div><!-- fin page -->
    <script src="../js/oXHR.js" type="text/javascript"></script>
    </body>
    
</html>