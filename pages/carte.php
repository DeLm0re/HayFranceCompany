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
        <link href="../css/carte.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <?php
            /*inclusion de l'overlay*/
            include '../includes/i_carte.php';
        ?>

    <span>Votre département : </span>
    <span id="mon_departement"></span>

    <!-- SCRIPTS POUR la carte -->
    <script src="../js/carte.js" type="text/javascript"></script>
    <script src="../js/polyfill.js" type="text/javascript"></script>

    </body>

</html> 