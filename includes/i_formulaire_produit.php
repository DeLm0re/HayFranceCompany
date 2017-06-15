<?php
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);
$info = $user->donneInfos();
$departement = intval($info['departement']);


$produit = new Produit($bdd, $id);
$infos = $produit->infos();
$id = $_GET['id_produit'];
//var_dump($infos); 

?>

<form class="formulaire_produit" >

    <span> Format des balles CHC : <input id="Format22" type="radio" name="Format" value="22" checked="true">
        <label for="Format22">22 kg</label>
        <input id="Format32" type="radio" name="Format" value="32"><label for="Format32">32 kg</label>
    </span><br>
    
    <!-- passage de l'id du produit en mode shlag !! a changé immediatement -->
    <span> <input type="number" id="id_produit" value="<?php echo $id  ;?>" style="display: none;"  onchange="request(readData, 'id_produit');"> </span>
    <!-- ***************************************************************************************************-->
    
    <span id="erreur_nbr_pallette" class="erreur" ></span><br>
    <span> Nombre de pallette : <input id="nbr_pallette" type="number" min="1" max="8"  onchange="request(readData, 'nbr_pallette');"></span><br>
    <span id="ok_nbr_pallette" style="display: none;"><img src="../images/ok.png"/></span>
    <span id="ko_nbr_pallette" style="display: none;"><img src="../images/ko.png"/></span>

    
    <span id="loader" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span><br>
    <input id="button" type="button" value="Ajouter ce produit à mon panier" onclick="request2(readData);"><br>
    
     <span id="confirmation commande" class="erreur" ></span><br>
     <span id="erreur_commande" class="erreur" ></span><br>
     <span id="erreur_connecter" class="erreur" ></span>
</form>



