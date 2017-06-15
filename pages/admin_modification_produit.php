<?php
include_once '../objet/session_objet.php';
include_once '../objet/administration/o_admin.php';
$admin = new Admin($bdd);
demarreSession($admin);
$URL ='admin_modification_produit.php' ; 

if (isset($_GET['ID'])) {
    $id_produit = $_GET['ID'];
    $produit = new Produit($bdd, $id_produit);
}
if (!isset($_GET['ID'])) {
    $produit = null;
    //echo'var_dump $produit';
    //var_dump($produit);
}
?>

<?php if (!isset($_POST['titre'])) { ?>
    <html>
        <head>
            <meta charset="utf-8" />
            <link href="../css/editeur_de_texte.css" rel="stylesheet" type="text/css"/>
             <script src="../js/oXHR.js" type="text/javascript"></script>
            <script src="../js/editeur_de_texte.js" type="text/javascript"></script>
            <script src="../js/charge_produit.js" type="text/javascript"></script>
            <title>Mon éditeur WYSIWYG</title>
        </head>
        <body onload="request(<?php$id_produit?>);" >
            <?php
            if (isset($id_produit)) {
                echo"<form method=\"post\" action=\"$URL?ID=$id_produit \">";
                echo"<h1>Modifier l'article </h1>";
            } else if (!isset($id_produit)) {
                echo"<form method=\"post\" action=\"$URL\">";
                echo"<h1>Créer l'article </h1>";
            }
            ?>

            <span id="loader" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span>
            <label for="titre"></label>
            <input type="text" name="titre" id="titre" placeholder="Nom article" size="30" /><br>
            <!-- Barre d'option de text -->
            <input type="button" value="G" style="font-weight: bold;" onclick="commande('bold');" />
            <input type="button" value="I" style="font-style: italic;" onclick="commande('italic');" />
            <input type="button" value="S" style="text-decoration: underline;" onclick="commande('underline');" />
            <input type="button" value="Lien" onclick="commande('createLink');" >
            <input type="button" value="Couleur" onclick="commande('forecolor');" >
            <input type="button" value="Gauche" onclick="commande('justifyleft');" >
            <input type="button" value="Centrer" onclick="commande('justifycenter');" >
            <input type="button" value="Droite" onclick="commande('justifyright');" >
            <input type="button" value="Puce" onclick="commande('insertunorderedlist');" >
            <!-- Zone de texte --> 
            <div id="editeur" contentEditable></div>
            <input type="button" onclick="resultat();" value="Obtenir le HTML" ><br />
            <textarea id="resuEditeur" name="texte"></textarea>
            <label for="courteDesc">Description Rapide</label> 
            <textarea id="courteDesc" name="courteDesc"></textarea><br>
            <!-- </fieldset>
            <!-- Zone Prix --> 
            
            <fieldset>
                <label for="prix">Prix</label><br>
                <input type="number" name="prix" id="prix" /><br>
            </fieldset>


            <!-- Zone check box --> 
            <fieldset>
                <legend>Pour quelle animal ?</legend>
                <?php
                $listeNomAnimal = $admin->donneListeAnimal();
                //echo'var_dump $listeNomAnimal';
                //var_dump($listeNomAnimal);
                $listeIdAnimal = $admin->donneListeIdAnimal();
                //echo'var_dunmp $listeNomAnimal';
                //var_dump($listeIdAnimal);
                creerCheckBoxAnimal($listeIdAnimal, $listeNomAnimal, $produit);
                ?>
            </fieldset>
            <input type="submit" value="Valider" />
        </form>


    </body>

    </html>


    <?php
} else {
    //On récupère la valeur du titre du formulaire
    if ((isset($_POST['titre']) == TRUE)) {
        $titre = $_POST['titre'];
    }
    //On récupère la valeur du texte du formulaire
    if ((isset($_POST['texte']) == TRUE)) {
        $texte = $_POST['texte'];
        //$textBDD = htmlentities($texte) ; 
    }
    //On récupère la valeur de la description rapide du formulaire
    if ((isset($_POST['courteDesc']) == TRUE)) {
        $courteDesc = $_POST['courteDesc'];
    }
    //On récupère la valeur du prix du formulaire
    if ((isset($_POST['prix']) == TRUE)) {
        $prix = $_POST['prix'];
    }
    //On créer un tableau qui devra récupérer la liste des animaux qu'on a checké dans le formulaire
    $tabIdAnimalChecked = [];
    
    //Recupère la liste de tous les animaux
    $tabIdAnimaux = $admin->donneListeIdAnimal() ; 
    echo"var_dump tabAnimaux";
    var_dump($tabIdAnimaux);
    //Pour chaque animal on test si sa valeur en _POST existe càd qu'il a été coché 
    //On créer un tableau d'animaux qui ont été cochés $animalChecked
   
    foreach ($tabIdAnimaux as $valueIdAnimal) {
        echo"value animal : $valueIdAnimal <br>";
        if (isset($_POST[$valueIdAnimal])) {
            $laValeur = $_POST[$valueIdAnimal] ; 
            echo"entrer dans if du  foreach tableau animal, $laValeur <br>";
            //$animal est le tableau des animaux cochés 
            $tabIdAnimalChecked[$valueIdAnimal] = $valueIdAnimal;
        }
    }
    echo"var_dump animalChecked :";
    var_dump($tabIdAnimalChecked);


    // $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
    //S'il n'y a pas d'ID de setté sur la page
    if (!isset($_GET['ID'])) {
        echo"if ID est PAS set";

        //On entre toutes les valeurs de produit 
        $admin->ajouteProduit($titre, $texte, $courteDesc, $prix);
        /* $stmt = $dbh->prepare('INSERT INTO produit(id_produit,nom_produit,description,description_rapide,prix_tonne) VALUES(?,?,?,?,?)');
          $stmt->bindValue(1, null);
          settype($titre, "string");
          $stmt->bindParam(2, $titre, PDO::PARAM_STR);
          $stmt->bindParam(3, $texte, PDO::PARAM_STR);
          $stmt->bindParam(4, $courteDesc, PDO::PARAM_STR);
          $stmt->bindParam(5, $prix, PDO::PARAM_INT);
          $stmt->execute();
         */
        
        //Récupérer l'id_produit du produit que l'on vient de rentrer 
        $listeObjProduit = $admin->consulteListeProduit() ; 
        $maxListeObjProduit = count($listeObjProduit) ; 
        $unProduit =  $listeObjProduit[$maxListeObjProduit-1] ; 
        $infos = $unProduit->infos() ; 
        $id_produit = $infos['id_produit'];
        
        //Pour chaque animal coché 
        //On insert dans la BDD l'animal et son produit correspondant
        foreach ($tabIdAnimalChecked as $valueIdAnimal) {
            $admin->ajouteAnimalProduit($id_produit, $valueIdAnimal)  ; 
            //$id_produit = getIdAnimal($valueAnimal) ; 
            /*$id_animal = $admin->donneListeIdAnimal();
            $id_animal["$value"];
            $stmt = $dbh->prepare('INSERT INTO animal_produit(id_produit,id_animal) VALUES(?,?)');
            $stmt->bindValue(1, null);
            $stmt->bindParam(2, $id_animal, PDO::PARAM_STR);
            $stmt->execute();
             * 
             */
        }
    } else if (isset($_GET['ID'])) {
        echo"if ID est set";

        $admin->modifieProduit($produit, $titre, $texte, $courteDesc, $prix);
        /*
          $stmt = $dbh->prepare('UPDATE produit SET nom_produit= :nom, description= :desc, description_rapide= :descRap, prix_tonne= :prix WHERE id_produit=' . $id_produit . '');
          $stmt->bindParam(':nom', $titre);
          $stmt->bindParam(':desc', $texte);
          $stmt->bindParam(':descRap', $courteDesc);
          $stmt->bindParam(':prix', $prix);
          $stmt->execute();
         */
        //$produit->appartientCategorie($animal) ; 
        $admin->supprimeAnimalProduit($id_produit);
        //On supprime tous les id pour les refaires après
        // $stmt2 = $dbh->prepare("DELETE FROM `animal_produit`WHERE `id_produit` = $id_produit ");
        //$stmt2 ->execute() ; 

        foreach ($tabIdAnimalChecked as $valueIdAnimal) {
            $admin->ajouteAnimalProduit($id_produit, $valueIdAnimal)  ;
            /* $stmt = $dbh->prepare('INSERT INTO animal_produit(id_produit,id_animal) VALUES(?,?)');
              $stmt->bindValue(1, $id_produit);
              $stmt->bindParam(2, $id_animal, PDO::PARAM_STR);
              $stmt->execute();

             */
        }
    }
}

function creerCheckBoxAnimal($listeIdAnimal, $listeNomAnimal, $ObjProduit) {
    //$dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
    //tableau de nom d'animal
    //foreach ($dbh->query('SELECT animal FROM animal') as $row) {
    //    $valueAnimal = $row['animal'];
    //echo'Entrer dans creerCheckBoxAnimal <br>';
    //echo'var_dump $listeIdAnimal ';
    //var_dump($listeIdAnimal);
    //echo'var_dump $listeNomAnimal ';
    //var_dump($listeNomAnimal);
    //echo'var_dump $ObjetProduit';
    //var_dump($ObjProduit);

    $max = count($listeIdAnimal);
    for ($i = 0; $i < $max; $i+=1) {
       
       // echo'var_dump isset Get ID';
      //var_dump(isset($_GET['ID']));

        if (isset($_GET['ID'])) {
            $BoolAppartientCategorie = $ObjProduit->appartientCategorie($listeIdAnimal[$i]);
            //echo'$Bool Machin';
            //var_dump($BoolAppartientCategorie);
            if ($BoolAppartientCategorie == TRUE) {
                echo"<input type=\"checkbox\" name=\"$listeIdAnimal[$i]\" id=\"$listeNomAnimal[$i]\" checked=\"checked\"/> <label for=\"$listeIdAnimal[$i]\">$listeNomAnimal[$i]</label><br />" ; 
            }
            else{
                echo"<input type=\"checkbox\" name=\"$listeIdAnimal[$i]\" id=\"$listeNomAnimal[$i]\" /> <label for=\"$listeIdAnimal[$i]\">$listeNomAnimal[$i]</label><br />";
            }
        }
        //!isset($_GET['ID']) || 
        else {
            echo"<input type=\"checkbox\" name=\"$listeIdAnimal[$i]\" id=\"$listeNomAnimal[$i]\" /> <label for=\"$listeIdAnimal[$i]\">$listeNomAnimal[$i]</label><br />";
        }
    }
    // return($row) ; 
}

//$listeAnimaux = $admin->donneListeAnimal() ;
/*function recupListeAnimaux(){
    $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
    $tableauAnimal = [] ; 
    foreach ($dbh->query('SELECT animal FROM animal') as $row) {
        $valueAnimal = $row['animal'] ; 
        $tableauAnimal["$valueAnimal"]  = $valueAnimal; 
    }  
    return($tableauAnimal) ; 
}
*/

//$listeAnimaux = $admin->donneListeIdAnimal()
/*function getIdAnimal($animal, $listeIdAnimal){
   // $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
   
    foreach ($listeIdAnimal as value'$animal' ") as $row) {
        $id_animal = $row['id_animal'] ; 
    }  
    return($id_animal) ; 
}
*/

//$produit->getCategories() ; 
/*function getAnimal($id_produit){
    $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
    
    foreach ($dbh->query("SELECT animal FROM animal INNER JOIN animal_produit ON animal_produit.id_animal = animal_produit.id_animal WHERE id_produit ='$id_produit' ") as $row) {
        $animal['animal'] = $row['animal'] ; 
    }  
    return($animal) ; 
}
*/
/*
function checkedCheckBox($ObjProduit, $tabAnimalChecked){
    //$tabAnimalChecked, $valueAnimal
          foreach($tabAnimalChecked as $valueAnimalChecked){
            if($valueAnimal == $valueAnimalChecked){
                echo"<input type=\"checkbox\" name=\"$valueAnimal\" id=\"$valueAnimal\" checked=\"checked\"/> <label for=\"$valueAnimal\">$valueAnimal</label><br />" ;
            }
            else{
                echo"<input type=\"checkbox\" name=\"$valueAnimal\" id=\"$valueAnimal\" /> <label for=\"$valueAnimal\">$valueAnimal</label><br />" ;
            }
        }
          
    
  $ObjProduit->appartientCategorie($animal) ; 
}
*/

//ajoute produit
//ajoute image-produit
//ajoute animal-produit
//modifie produit (sans image ni animal)
//supprime produit (supprime aussi les relation animal-produit et image-produit
