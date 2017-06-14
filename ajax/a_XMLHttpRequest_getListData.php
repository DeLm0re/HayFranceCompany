<?php  session_start() ;
header("Content-Type: text/xml");
 
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

$id_produit = (isset($_GET["variable1"])) ? $_GET["variable1"] : NULL;
$bdd = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
	       
        $req1 = $bdd->prepare("SELECT id_produit, nom_produit, description, description_rapide, prix_tonne FROM produit WHERE id_produit = $id_produit ");
        
        $req1->execute();
        //var_dump($reqtest);
echo "<list>";
	

	while ($back = $req1->fetch()) {
		echo "<itemProduit id_produit=\"" . $back["id_produit"] . "\" nom_produit=\"" . $back["nom_produit"] . "\" description=\"" . stripcslashes($back["description"]) . "\" description_rapide=\"" . $back["description_rapide"] . "\" prix_tonne=\"" . $back["prix_tonne"] ."\" />";
	}
echo "</list>";

?>



























