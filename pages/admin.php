

<table>
    <h1>Produits</h1>
    <form action="ModificationProduit.php">
    <input type="submit" value="Créer Produit" />
    </form
   <tr>
       <th>ID</th>
       <th>Nom Produit</th>
       <th>Courte Description</th>
       <th>Animaux</th>
       <th>Nombre Image</th>
       <th>Prix</th>
   </tr>
   
   <?php
     $tableauDonnees = recupDonneProduit();
     $nombreLignes = count($tableauDonnees);
     for($i=0 ; $i < $nombreLignes ; $i+=1 ){
          $Colonne = donneesColonne($i, $tableauDonnees);
          creerLigneTableau($Colonne);
     }
    
   ?>
   </a>
</table>

<?php
function recupDonneProduit(){
 $bdd = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
	       
        $req1 = $bdd->prepare("SELECT id_produit, nom_produit, description, description_rapide, prix_tonne FROM produit ");
        
        $req1->execute();
        //var_dump($reqtest);
        $tableauDonnees = array();
        $i = 0 ; 
	while ($back = $req1->fetch()) {
             $tableauDonnees[$i] = $back ; 
             $i = $i + 1 ;
	} 
    return($tableauDonnees) ; 
}

function donneesColonne($ligne, $TableauDonnes){
    return($TableauDonnes[$ligne]) ; 
}

function creerLigneTableau($donneesColonne){
    //URL de la page modification produit
    $URL = "ModificationProduit.php";
    $Colonne = array();
    //On fait le même tableau que $donnesColonne mais on remplace la case
    //avec le nom par le nom avec URL
    for($i=0 ; $i <5 ; $i+=1){
        if($i == 1){
            $id = $donneesColonne["id_produit"];
            $nom = $donneesColonne["nom_produit"];
            $Colonne[$i] = "<a href=$URL?ID=$id > $nom </a>" ; 
        }
        else {
            $Colonne[$i] = $donneesColonne[$i] ; 
        }
    }
     
    echo"<div>";
    echo"<tr>";

    for($i = 0 ; $i<count($Colonne) ; $i+=1)
    {
            ajoutCellule($Colonne[$i]);
    }

    echo"</tr>";
    echo"</div>";
    echo"</a>" ; 
}

function ajoutCellule($contenue)
{
    echo"<td>";
    echo$contenue ;
    echo"</td>"; 
}
