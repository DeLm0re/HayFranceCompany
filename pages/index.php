<html>
    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui"/>
            <link href="../css/index.css" rel="stylesheet" type="text/css"/>
            <link href="../css/overlay.css" rel="stylesheet" type="text/css"/>
            <link href="../css/carte_overlay.css" rel="stylesheet" type="text/css"/>
    </head>
 
    <body>
        
        <?php
            /*inclusion de l'overlay*/
            include '../includes/i_overlay.php';
            
            /*inclusion du formulaire d'inscription*/
            include '../includes/i_inscription.php';
        ?>
        
        <span>Votre département : </span>
        <span id="mon_departement"></span></br>
        <a href="carte.php">carte</a>
        
        <!-- SCRIPTS POUR L'AJAX -->
        <script src="../js/ajax.js" type="text/javascript"></script>
        <script src="../js/oXHR.js" type="text/javascript"></script>

        <!-- SCRIPTS POUR L'overlay -->
        <script src="../js/overlay.js" type="text/javascript"></script>
        <script src="../js/polyfill.js" type="text/javascript"></script>
        
        

    </body>
    <?php
        //include '../includes/i_footer.php'
</html>