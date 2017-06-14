<?php
/*
  include_once '../objet/session_objet.php';
    $user = new Utilisateur($bdd);
    demarreSession($user);
    $info = $user->donneInfos();
    $departement = intval($info['departement']);
    $prix_transport = new PrixTransport($bdd,$departement);
    $prix_transport->infos(); 
  //  var_dump($user);
  */  
?>



<fieldset id="formulaire_produit">
    <form>
        <p>ajouter votre produit au panier<p> 
            
        
      
        <span id="erreur_nbr_pallette" class="erreur"></span>
        <p>Nombre de palette : <input id="nbr_pallette" type="number"  min="1" max="8"  onchange="request(readData,'nbr_pallette');"></p>
        <span id="ok_nbr_pallette" style="display: none;"><img src="../images/ok.png"/></span>
        <span id="ko_nbr_pallette" style="display: none;"><img src="../images/ko.png"/></span>
          
        
        <p> balle CHC : <input id="Format22" type="radio" name="Format" value="22" checked="true">
        <label for="Format22">22kg</label>
        <input id="Format32" type="radio" name="Format" value="32"><label for="Format32">32kg</label>
        </p>
        
        
        
        
        <span id="loader" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span>
    </form>
    <input id="button" type="button" value="ajouter au panier " onclick="request2(readData);">
</fieldset>

