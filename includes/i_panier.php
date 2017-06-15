<?php
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);
?>

<!-- div class="div_ensemble_panier" -->

<div class="div_titre_panier">
    <span class="titre_panier">Votre panier</span><br>
</div>

<div class="div_panier">
    <div class="div_produit_panier">
        <?php
            $liste = $user->donneContenuPanier();
            $max = count($liste);
            for($i = 0; $i < $max; $i++){
                $produit = $liste[$i];
                $info = $produit->infos();
                $nbr = $user->donneQuantiteProduit($produit);
                $prix = $user->donnePrixProduit($produit);
                
                echo ("<div class=\"produit_panier\">
                <div class=\"element_produit_panier\">
                <img class=\"image_produit_panier\" src=\"../images/foin1.png\">
                </div>
                <div class=\"element_produit_panier\" style=\"margin-left: 35px;width : 100px;\">
                <p class=\"nom_produit_panier\">".$info['nom_produit']."</p>
                </div>
                <div class=\"element_produit_panier\" style=\"margin: 58px 0 0 45px;\">
                <span class=\"span_select_produit_panier\">Nombre de palettes : </span>
                <input id=\"select_p\" class=\"select_produit_panier\" type=\"number\" min=\"1\" max=\"8\" 
                    value=\"".$nbr."\" "
                        . 'onchange="modifie_palette_produit('.$info['id_produit'].');" >'."
                </div>
                <div class=\"element_produit_panier\" style=\"margin: 58px 0 0 40px;\">
                <span class=\"span_prix_produit_panier\">Prix : </span>
                <span class=\"prix_produit_panier\">".$prix."</span><span class=\"span_prix_produit_panier\"> €</span>
                </div>
                <div class=\"element_produit_panier\" style=\"margin-top: 40px;float: right;\">
                <p class=\"supp_produit_panier\" onclick=\"suppression_produit(".$info['id_produit'].");\">&#10060;</p>
                </div>
                </div>");
            }
        ?>
    </div>
    <div class="div_prix_panier">
        <div class="prix_panier">
            <span class="span_prix_panier">Prix total du panier : </span>
            <span class="prix_panier">
                <?php
                    echo($user->donneTotalPanier());
                ?>
            </span><span class="span_prix_produit_panier"> €</span>
        </div>
    </div>
</div>

<div class="div_button_panier">
    <input class="button_panier" type="button" onclick="#" value="Commander">
</div>

<!-- /div -->
