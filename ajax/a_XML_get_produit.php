<?php //session_start() ;
header("Content-Type: text/xml");

include_once '../objet/session_objet.php';
include_once '../objet/administration/o_admin.php';

$id_produit = (isset($_GET["variable1"])) ? $_GET["variable1"] : NULL;
$produit = new Produit($bdd, $id_produit) ; 
$back = $produit->infos();

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
/*
$bdd = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
	       
        $req1 = $bdd->prepare("SELECT id_produit, nom_produit, description, description_rapide, prix_tonne FROM produit WHERE id_produit = $id_produit ");
        
        $req1->execute();
        //var_dump($reqtest);
*/
echo "<list>";
	//while ($back = $req1->fetch()) {
		echo "<itemProduit id_produit=\"" . $back["id_produit"] . "\" nom_produit=\"" . $back["nom_produit"] . "\" description=\"" . stripcslashes($back["description"]) . "\" description_rapide=\"" . $back["description_rapide"] . "\" prix_tonne=\"" . $back["prix_tonne"] ."\" />";
	//}
echo "</list>";

?>



























