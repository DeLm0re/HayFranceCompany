<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function creer_section_article($une_liste,$id_select) {

    $max = count($une_liste);
        for($i = 0;$i < $max; $i++) {
            if ($id_select == null || $une_liste[$i]->appartientCategorie($id_select) === true)
            {
                creer_division_article($une_liste[$i]);
            }
    }
}

function creer_division_article($produit) {
    $infos = $produit->infos();
    //$url = $produit->getUrlImages();
    $alt = $produit->getNomImages();
    echo "<div class=\"div_produit\" onclick=\"window.location.href='../pages/un_produit.php?id_produit=".$infos['id_produit']."'\">
            <div class=\"div_image_produit\">
                <img class=\"image_produit\" src=\"../images/foin1.png\" alt=".$alt[0].">
             </div><div class=\"div_nom_produit\"><p class=\"nom_produit\">" . $infos['nom_produit'] . "</p>
             </div><div class=\"div_description_produit\">
                <p class=\"description_produit\">
                    " . $infos['description_rapide'] . "
                </p></div></div>";
    }
?>
