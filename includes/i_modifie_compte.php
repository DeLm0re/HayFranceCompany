<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * 
 */
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);
$info = $user->donneInfos();

$email = $info['email'];
$ville = $info['ville'];
$adresse = $info['adresse'];
$departement = $info['departement'];
?>

<div class="div_erreur_validation">
    <span id="erreur_modification" class="champ_erreur" style="display: none;"></span>
    <span id="validation_modification" class="champ_validation" style="display: none;"></span>
</div>
<form id="formulaire">   
    <div class="div_titre">
        <span class="titre">Modification de mes informations</span> 
    </div>
    <div class="div_ensemble_champ">

        <div id="div_champ_erreur_ville" style="display: none;">
            <span id="erreur_modification" class="erreur"></span>
            <span id="erreur_email" class="erreur"></span>
        </div>
        <div class="div_champ">
            <span class="champ">Nouvelle adresse mail : <input id="email" style="width: 250px;"type="text" value="<?php echo $email ?>" spellcheck="false" onchange="request(readData, 'email');">
                <span id="ok_email" style="display: none;"><img src="../images/ok.png"/></span>
                <span id="ko_email" style="display: none;"><img src="../images/ko.png"/></span>
            </span><br>
        </div>

        <div id="div_champ_erreur_ville" style="display: none;">
            <span id="erreur_mdp" class="erreur"></span>
        </div>
        <div class="div_champ">
            <span class="champ">Nouveau mot de passe : <input id="mdp" type="password" onchange="request(readData, 'mdp');">
                <span id="ok_mdp" style="display: none;"><img src="../images/ok.png"/></span>
                <span id="ko_mdp" style="display: none;"><img src="../images/ko.png"/></span>
            </span><br>
        </div>

        <div id="div_champ_erreur_ville" style="display: none;">
            <span id="erreur_cmdp" class="erreur"></span>
        </div>
        <div class="div_champ">
            <span class="champ">Confirmation de votre nouveau  mot de passe  : <input id="cmdp" type="password" onchange="request(readData, 'cmdp');">
                <span id="ok_cmdp" style="display: none;"><img src="../images/ok.png"/></span>
                <span id="ko_cmdp" style="display: none;"><img src="../images/ko.png"/></span>
            </span><br>
        </div>

        <div id="div_champ_erreur_ville" style="display: none;">
            <span id="erreur_ville" class="erreur"></span>
        </div>
        <div class="div_champ">
            <span class="champ">Nouvelle ville : <input id="ville" type="text" value="<?php echo $ville ?>" onchange="request(readData, 'ville');">
                <span id="ok_ville" style="display: none;"><img src="../images/ok.png"/></span>
                <span id="ko_ville" style="display: none;"><img src="../images/ko.png"/></span>
            </span><br>
        </div>

        <div id="div_champ_erreur_ville" style="display: none;">
            <span id="erreur_adresse" class="erreur"></span>
        </div>
        <div class="div_champ">
            <span class="champ">Nouvelle adresse : <textarea id="adresse" rows=3 cols=40  onchange="request(readData, 'adresse');"><?php echo $adresse ?></textarea>
                <span id="ok_adresse" style="display: none;"><img src="../images/ok.png"/></span>
                <span id="ko_adresse" style="display: none;"><img src="../images/ko.png"/></span>
            </span><br>
        </div>

        <div id="div_champ_erreur_ville" style="display: none;">
            <span id="erreur_dpt" class="erreur"></span>
        </div>
        <div class="div_champ">
            <span class="champ">Nouveau numéro de département <input id="dpt" type="number" value="<?php echo $departement ?>"  min="1" max="95" onchange="request(readData, 'dpt');">
                <span id="ok_dpt" style="display: none;"><img src="../images/ok.png"/></span>
                <span id="ko_dpt" style="display: none;"><img src="../images/ko.png"/></span>
            </span><br>
        </div>

    </div>

    <div class="div_loader">
        <span id="loader" style="display: none;"><img id="img_loader" src="../images/loader.gif" alt="Chargement" /></span>
    </div>

    <div class="div_button">
        <input id="button" type="button" value="Modifier" onclick="request2(readData);">
    </div>

</form>

