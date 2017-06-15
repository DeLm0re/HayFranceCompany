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
        <div class="produit_panier">
            <div class="element_produit_panier">
                <img class="image_produit_panier" src="../images/foin1.png">
            </div>
            <div class="element_produit_panier" style="margin-left: 35px;">
                <p class="nom_produit_panier">Foin de Crau</p>
            </div>
            <div class="element_produit_panier" style="margin: 58px 0 0 45px;">
                <span class="span_select_produit_panier">Nombre de palettes : </span>
                <input class="select_produit_panier" type="number" min="1" max="8" value="5" >
            </div>
            <div class="element_produit_panier" style="margin: 58px 0 0 40px;">
                <span class="span_prix_produit_panier">Prix : </span>
                <span class="prix_produit_panier">500</span><span class="span_prix_produit_panier"> €</span>
            </div>
            <div class="element_produit_panier" style="margin-top: 40px;float: right;">
                <p class="supp_produit_panier">&#10060;</p>
            </div>
        </div>
        <div class="produit_panier">
            <div class="element_produit_panier">
                <img class="image_produit_panier" src="../images/foin2.png">
            </div>
            <div class="element_produit_panier">
                <p class="nom_produit_panier">Timothy</p>
            </div>
        </div>
        <div class="produit_panier">
            <div class="element_produit_panier">
                <img class="image_produit_panier" src="../images/foin1.png">
            </div>
            <div class="element_produit_panier">
                <p class="nom_produit_panier">Foin de Longchamp</p>
            </div>
        </div>
        <div class="produit_panier">
            <div class="element_produit_panier">
                <img class="image_produit_panier" src="../images/foin2.png">
            </div>
            <div class="element_produit_panier">
                <p class="nom_produit_panier">Luzerne</p>
            </div>
        </div>
    </div>
    <div class="div_prix_panier">
        <div class="prix_panier">
            <span class="span_prix_panier">Prix total du panier : </span>
            <span class="prix_panier">500</span><span class="span_prix_produit_panier"> €</span>
        </div>
    </div>
</div>

<div class="div_button_panier">
    <input class="button_panier" type="button" onclick="#" value="Commander">
</div>

<!-- /div -->




