<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<fieldset id="formulaire_modification_compte">
    <form>
        <p>Compte modification<p> 
            
          
        <span id="erreur_email" class="erreur"></span>
        <p>nouvelle Adresse mail : <input id="email" type="text" spellcheck="false" onchange="request(readData,'email');"></p>
            <span id="ok_email" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_email" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_mdp" class="erreur"></span>
        <p>nouveau mot de passe : <input id="mdp" type="password" onchange="request(readData,'mdp');"></p>
            <span id="ok_mdp" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_mdp" style="display: none;"><img src="../images/ko.png"/></span>
            
              <span id="erreur_cmdp" class="erreur"></span>
        <p>Confirmation de votre nouveau  mot de passe : <input id="cmdp" type="password" onchange="request(readData,'cmdp');"></p>
            <span id="ok_cmdp" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_cmdp" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_ville" class="erreur"></span>
        <p>nouvelle ville : <input id="ville" type="text" onchange="request(readData,'ville');"></p>
            <span id="ok_ville" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_ville" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="erreur_adresse" class="erreur"></span>
        <p>nouvelle adresse : <textarea id="adresse" rows=3 cols=40 onchange="request(readData,'adresse');"></textarea></p>
            <span id="ok_adresse" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_adresse" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="erreur_dpt" class="erreur"></span>
        <p>nouveau numéro de département <input id="dpt" type="number"  min="1" max="95" onchange="request(readData,'dpt');"></p>
            <span id="ok_dpt" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_dpt" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="loader" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span>
    </form>
    <input id="button" type="button" value="Modifier" onclick="request2(readData);">
</fieldset>