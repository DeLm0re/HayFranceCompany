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
        <link href="../css/un_produit.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="page">
	<div class="bloc-principal">


        <?php
        /* inclusion de la navbar */
        include '../includes/i_navbar.php';
        ?>

        <?php
        if (isset($_GET['id_produit']) === false) {
            header('location:http://localhost/HayFranceCompany/pages/tout_produit.php');
            exit();
        }

        $liste = $user->consulteListeProduit();
        $id = intval($_GET['id_produit']);
        $produit = new Produit($bdd, $id);
        $infos = $produit->infos();
        $alt = $produit->getNomImages();
        ?>
        <div class="div_produit">

            <div class="div_g_d_produit">

                <div class="div_gauche_produit">
                    <img class="image_produit" 
                    <?php
                    echo " src=\"../images/foin2.png\"";
                    echo " alt=\"" . $alt[0] . "\"";
                    ?>
                         />
                </div>

                <div class="div_droite_produit">
                    <div class="div_nom_produit">
                        <span class="nom_produit">
                            <?php
                            echo($infos['nom_produit']);
                            ?>
                        </span>
                    </div>
                    <div class="div_formulaire_produit">


                        <fieldset class="field_formulaire_produit">
                            <p>le formulairele formulairele formulairele formulairele formulaire
                                le formulairele formulairele formulairele formulairele formulaire
                                le formulairele formulairele formulairele formulairele formulaire
                                le formulairele formulairele formulairele formulairele formulaire</p>
                        </fieldset>

                    </div>
                </div>

            </div>
            
            <div class="contener_description_produit">
                <div class="div_description">
                    <span class="description">
                        Description
                    </span>
                </div>
                <div class="div_description_produit"
                    <p class="description_produit">
                        <?php
                            echo($infos['description']);
                        ?>
                    </p>
                </div>
            </div>
            
        </div>

        <div class="clear"></div>
	</div><!-- fin bloc-principal -->
	<?php
            include '../includes/i_footer.php';
        ?>
        </div><!-- fin page -->
    </body>
</html>
