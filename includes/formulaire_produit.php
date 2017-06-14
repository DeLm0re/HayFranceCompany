<?php
  include_once '../objet/session_objet.php';
    $user = new Utilisateur($bdd);
    demarreSession($user);
    $info = $user->donneInfos();
    $departement = intval($info['departement']);
    $prix_transport = new PrixTransport($bdd,$departement);
    $prix_transport->infos(); 
  //  var_dump($user);
    var_dump($prix_transport->infos());
    
?>



<fieldset id="formulaire_produit">
    <form>
        <p>ajouter votre produit au panier<p> 
            
        
      
        <span id="erreur_nbr_pallette" class="erreur"></span>
        <p>Nombre de palette : <input id="nbr_pallette" type="number" name="nbr_pallette" min="0" max="8" spellcheck="false" onchange="request_connexion(readData_connexion,'enbr_pallette');"></p>
            <span id="ok_email_connexion" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_email_connexion" style="display: none;"><img src="../images/ko.png"/></span>
        
        <span id="erreur_Format" class="erreur"></span>
        <p>Format : <select id="Format"  onchange="request_connexion(readData_connexion,'Format');">
        <option value="22">CHC 22kg</option>
        <option value="32">CHC 32kg</option>
        </select>
        </p>
            <span id="ok_mdp_connexion" style="display: none;"><img src="../images/ok.png"/></span>
            <span id="ko_mdp_connexion" style="display: none;"><img src="../images/ko.png"/></span>
        
        
        
        <span id="loader_connexion" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span>
    </form>
    <input id="button_connexion" type="button" value="ajouter au panier " onclick="request2_connexion(readData_connexion);">
</fieldset>

