<?php
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);
    
function creer_navbar_options_produits($liste_nom) {

        foreach($liste_nom as $un_produit){
            
            $info = $un_produit->infos();
            
            echo "<li class=\"li_contenu_dropdown\"><i class=\"fleche_contenu_dropdown\">&#9658;</i>"
            . "<a class=\"a_contenu_dropdown\" href=\"../pages/un_produit\">" . strtoupper($info['nom_produit']) 
            . "</a></li>";
        }
    }
?>

<link href="../css/i_navbar.css" rel="stylesheet" type="text/css"/>

<nav class="navbar">
    <div class="div_navbar">
        <ul class="ul_navbar">
            <div class="div_dropdown">
                <button class="button_dropdown">TOUS LES PRODUITS<i class="fleche_dropdown_produits">&#9660;</i></button>
                <div class="contenu_dropdown">
                    <?php
                        $liste = $user->consulteListeProduit();
                        creer_navbar_options_produits($liste);
                    ?>
                </div>
            </div>
            <div class='div_dropdown'>
                <button class="button_dropdown">TYPES D'ELEVAGES<i class="fleche_dropdown_produits">&#9660;</i></button>
                <div class="contenu_dropdown">
                    <?php
                    ?>
                </div>
            </div>
            <div class="div_dropdown">
                <button class="button_dropdown">MON COMPTE</button>
            </div>
            <div class="div_dropdown">
                <button class="button_dropdown">MON PANIER</button>
            </div>
        </ul>
    </div>
</nav>
