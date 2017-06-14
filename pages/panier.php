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
    </head>
    
    <body>
        
        <div class="page">
	<div class="bloc-principal">
            <header class="site-header">
                    <?php       
                        /*inclusion de la navbar */
                        include '../includes/i_navbar.php';
                    ?>
            </header>
            <main class="site-content">
                <div class="texte">
                <p>dftgdhgdjh</p>
                </div>
            </main><!-- contenu -->
            <div class="clear"></div>
	</div><!-- fin bloc-principal -->
	<?php
            include '../includes/i_footer.php';
        ?>
        </div><!-- fin page -->

       
    </body>
</html>

