<?php
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

$id_form = intval($_GET['id_produit']);
$produit_form = new Produit($bdd, $id_form);
$infos_form = $produit_form->infos();
$id_produit = $infos_form['id_produit'];

?>

<form id="formulaire" >

    <div class="div_champ">
        <span>Prix du produit : </span>
        <span style="color: #f74a00;">
            <?php
            echo $infos_form['prix_tonne'];
            ?>
        </span>
        <span> € par tonne</span><br>
    </div>

    <div class="div_champ">
        <span class="champ">Format des balles CHC :
            <input id="format_22" type="radio" name="format" value="22" checked="true" 
                        onchange="recalcul_prix_p_t(<?php echo $infos_form['id_produit']?>);">
            <label for="format_22">22 kg</label>
            <input id="format_32" type="radio" name="format" value="32" 
                        onchange="recalcul_prix_p_t(<?php echo $infos_form['id_produit']?>);">
            <label for="format_32">32 kg</label>
        </span><br>
    </div>

    <div id="div_champ_erreur_palette" style="display: none;">
        <span id="erreur_palette" class="champ_erreur" ></span><br>
    </div>
    <div class="div_champ">
        <span class="champ">Nombre de palette :
            <input id="input_palette" type="number" min="1" max="8" value="0" 
                   onchange="request_input(readData, 'input_palette');
                           recalcul_prix_p_t(<?php echo $infos_form['id_produit']?>);">
            <span id="ok_input_palette" style="display: none;"><img class="icon_preverif" src="../images/ok.png"/></span>
            <span id="ko_input_palette" style="display: none;"><img class="icon_preverif" src="../images/ko.png"/></span>
        </span><br>
    </div>

    <div class="div_champ">
        <span>Prix du produit + Coût du transport : </span>
        <span id="prix_p_t" style="color: #f74a00;">0</span>
        <span> €</span><br>
    </div>

    <div class="div_loader">
        <span id="loader" style="display: none;"><img id="img_loader" src="../images/loader.gif" alt="Chargement" /></span>
    </div>

    <div class="div_button">
        <?php
        echo "<input id=\"button\" type=\"button\" value=\"Ajouter ce produit dans mon panier\" 
                    onclick=\"request_button(readData," . $id_produit . ");\">";
        ?>
    </div>

    <div class="div_erreur_validation">
        <!-- requete effectuée, on affiche le span "vert" -->
        <span id="validation_commande" class="champ_validation" style="display: none;margin-top: 30px;"></span>
        <!-- si le produit est deja dans le panier -->
        <span id="erreur_commande" class="champ_erreur" style="display: none;margin-top: 30px;"></span>
        <!-- si on est pas connecté et on redirige -->
        <span id="erreur_connecte" class="champ_erreur" style="display: none;margin-top: 30px;"></span>
    </div>
</form>



