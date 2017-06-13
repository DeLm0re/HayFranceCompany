<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function creer_section_article($une_liste) {

    if (is_array($une_liste)) {
        foreach ($une_liste as $produit) {
            creer_division_article($produit);
        }
    }
}

function creer_division_article($produit) {

    $infos = $produit->infos();

    echo "<div class=\"div_produit\" onclick=\"alert('clic');\">
             <div class=\"div_nom_produit\">
                <p class=\"nom_produit\">" . $infos['nom_produit'] . "</p>
             </div>
            
             <div class=\"div_image_produit\">
                <img class=\"image_produit\" src=\"../images/ok.png\" alt=\"Image représentant l'article\">
             </div>
            
             <div class=\"div_description_produit\">
                <p class=\"description_produit\">
                    " . $infos['description_rapide'] . "
                </p>
             </div>
          </div>";
}

?>
