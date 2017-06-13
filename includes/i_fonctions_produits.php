<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function creer_section_article($une_liste) {

    $max = count($une_liste);
        for($i = 0;$i < $max; $i++) {
            creer_division_article($une_liste[$i],$i);
        }
    }

function creer_division_article($produit,$indice) {

    $infos = $produit->infos();
    if ($indice%2 == 1)
    {
    echo "<div class=\"div_produit\" onclick=\"alert('clic');\">
        
            <div class=\"div_image_produit\">
                <img class=\"image_produit\" src=\"../images/loader.gif\" alt=\"Image représentant l'article\">
             </div>
             
             <div class=\"div_nom_produit\">
                <p class=\"nom_produit\">" . $infos['nom_produit'] . "</p>
             </div>
            
             <div class=\"div_description_produit\">
                <p class=\"description_produit\">
                    " . $infos['description_rapide'] . "
                </p>
             </div>
          </div>";
    }else {
        echo "<div class=\"div_produit\" onclick=\"alert('clic');\">
        
            <div class=\"div_image_produit\">
                <img class=\"image_produit\" src=\"../images/loader2.gif\" alt=\"Image représentant l'article\">
             </div>
             
             <div class=\"div_nom_produit\">
                <p class=\"nom_produit\">" . $infos['nom_produit'] . "</p>
             </div>
            
             <div class=\"div_description_produit\">
                <p class=\"description_produit\">
                    " . $infos['description_rapide'] . "
                </p>
             </div>
          </div>";
    }
}

?>
