<link href="../css/admin_modification.css" rel="stylesheet" type="text/css"/>
<?php
include_once '../objet/session_objet.php';
include_once '../objet/administration/o_admin.php';
$admin = new Admin($bdd);
demarreSession($admin);
$URL ='admin_modification_produit.php' ;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui"/>
    </head>


    <body>
        <div class="div_dessus_navbar">
            <div onclick="window.document.location.href='tout_produit.php'" class="div_logo_navbar">
                <img class="logo_navbar"  src="../images/hayfrancecompany_navbar.png" alt="Logo hayfrancecompany"/>
            </div> 
            </div>
       
        <div class="ensemble_produit">
        <table>
            <h1 class="titre_ensemble_produit">Produits</h1>
            <form action="admin_modification_produit.php">
            <input type="submit" value="Créer Produit" />
            </form>
            <form action="upload_image.php">
            <input type="submit" value="Ajout Image" />
            </form>
            <form action="admin_ajout_animal.php">
            <input type="submit" value="Ajout Animal" />
            </form>
           <tr>
               <th>ID</th>
               <th>Nom Animal</th>
           </tr>
             <?php
                    $tabIdAnimaux = $admin->donneListeIdAnimal();
                    $tabNomAnimaux = $admin->donneListeAnimal() ; 
                    $admin->ajouteAnimal($nom);
                ?>
                afficheTableauProduit($listeProduit);
           ?>
        </table>
        </div>
    </body>
</html>


<?php 
function afficheTableauAnimaux($liste)
{
    $max = count($liste);
    for($i = 0; $i < $max; $i++)
    {
        $produit = $liste[$i];
        $infos = $produit->infos();
        unset($infos['description']);
        
        //Récupère les infos du produit
        $infos2 = array_values($infos);
        //Ajoute le nombre d'images
        array_push($infos2, count($produit->getNomImages()));
        //Ajoute les catégories
        array_push($infos2, animauxToString($produit->getCategories()));
        //Affiche le tout
        afficheProduit($infos2);
    }
}