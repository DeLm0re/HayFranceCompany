<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * 
 */

 $email = $user->donneInfos()['email'];
 $ville =  $user->donneInfos()['ville'];
 $adresse  = $user->donneInfos()['adresse'];
 $departement = $user->donneInfos()['departement'];
 
?>
  <span id="erreur_modification" class="erreur"></span>
<fieldset id="formulaire_modification_compte">
    <form>   
        <p>Compte modification<p>   
        
            <span id="erreur_modification" class="erreur"></span>
                 <span id="erreur_email" class="erreur"></span>
        <p>Nouvelle adresse mail : <input id="email" type="text" value="<?php  echo $email?>" spellcheck="false" onchange="request(readData,'email');"></p>
            <span id="ok_email" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_email" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_mdp" class="erreur"></span>
        <p>Nouveau mot de passe : <input id="mdp" type="password" onchange="request(readData,'mdp');"></p>
            <span id="ok_mdp" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_mdp" style="display: none;"><img src="../images/ko.png"/></span>
            
              <span id="erreur_cmdp" class="erreur"></span>
        <p>Confirmation de votre nouveau  mot de passe  : <input id="cmdp" type="password" onchange="request(readData,'cmdp');"></p>
            <span id="ok_cmdp" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_cmdp" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_ville" class="erreur"></span>
        <p>Nouvelle ville : <input id="ville" type="text" value="<?php  echo $ville?>" onchange="request(readData,'ville');"></p>
            <span id="ok_ville" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_ville" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="erreur_adresse" class="erreur"></span>
        <p>Nouvelle adresse : <textarea id="adresse" rows=3 cols=40  onchange="request(readData,'adresse');"><?php  echo $adresse ?></textarea></p>
            <span id="ok_adresse" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_adresse" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="erreur_dpt" class="erreur"></span>
        <p>Nouveau numéro de département <input id="dpt" type="number" value="<?php  echo $departement ?>"  min="1" max="95" onchange="request(readData,'dpt');"></p>
            <span id="ok_dpt" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_dpt" style="display: none;"><img src="../images/ko.png"/></span>
            
        <span id="loader" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span>
    </form>
    <input id="button" type="button" value="Modifier" onclick="request2(readData);">
   

</fieldset>