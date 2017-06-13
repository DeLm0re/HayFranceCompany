<?php include_once '../objet/session_objet.php'; 
      include_once '../objet/administration/o_admin.php';
      $admin = new Admin($bdd) ; 
      demarreSession($admin);
?>

<?php 

if( !isset($_POST['titre'])) {?>
<html>
	<head>
		<meta charset="utf-8" />
                <link href="../css/editeurDeTexte.css" rel="stylesheet" type="text/css"/>
                <script src="../js/oXHR.js" type="text/javascript"></script>
                <script src="../js/editeurDeTexte.js" type="text/javascript"></script>
                <script src="../js/charge_produit.js" type="text/javascript"></script>
		<title>Mon éditeur WYSIWYG</title>
	</head>
        <body
        <?php  if(isset($_GET['ID'])){
                        $id_produit = $_GET['ID'];
                        echo"onload=\"request('$id_produit');\" " ;
                     }
               ?>
          >
            <?php 
                    if( isset($_GET['ID']) ){
                        $id_produit = $_GET['ID'];
                        echo"<form method=\"post\" action=\"ModificationProduit.php?ID=$id_produit \">" ;
                        echo"<h1>Modifier l'article </h1>" ; 
                    }else if(!isset ($_GET['ID'])){
                        echo"<form method=\"post\" action=\"ModificationProduit.php \">" ;
                        echo"<h1>Créer l'article </h1>" ; 
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
            <textarea id="courteDesc" name="courteDesc"></textarea>
            <!-- </fieldset>
            <!-- Zone Prix --> 
            <fieldset>
            <label for="prix">Prix</label><br>
            <input type="number" name="prix" id="prix" /><br>
            </fieldset>
            
           
            <!-- Zone check box --> 
            <fieldset>
                <legend>Pour quelle animal ?</legend>
            <?php creerCheckBoxAnimal() ?>
            </fieldset>
            <input type="submit" value="Valider" />
            </form>
           
            
	</body>
        
</html>


<?php 
}else {
    if ((isset($_POST['titre']) == TRUE)) {
        $titre = $_POST['titre'];
    }

    if ((isset($_POST['texte']) == TRUE)) {
        $texte = $_POST['texte'];
        //$textBDD = htmlentities($texte) ; 
    }

    if ((isset($_POST['courteDesc']) == TRUE)) {
        $courteDesc = $_POST['courteDesc'];
    }

    if ((isset($_POST['prix']) == TRUE)) {
        $prix = $_POST['prix'];
    }

    //Déclaration du tableau 
    $animal = [];
    //Recupère la liste de tous les animaux
    $tabAnimaux = recupListeAnimaux() ;
    var_dump($tabAnimaux) ;
    $chevre =  $_POST["chevre"] ;
    echo" <br>  chèvre : $chevre <br>" ; 
    //Pour chaque animal on test si sa valeur en _POST existe càd qu'il a été coché 
    
    foreach($tabAnimaux as $valueAnimal){
        echo"value animal : $valueAnimal <br>" ; 
        if ( isset($_POST[$valueAnimal] ))
        {
            $laValeur = $_POST[$valueAnimal] ; 
        echo"entrer dans if du  foreach tableau animal, $laValeur <br>" ; 
        //$animal est le tableau des animaux cochés 
        $animal["$valueAnimal"] = $valueAnimal;
        }
    }
    
    echo"<br> vardump animal";
    var_dump($animal) ; 
    
    echo"<br> getIdAnimal : "; 
    echo getIdAnimal($animal['chevre']) ; 
    echo"<br>" ; 

     $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');

     if( !isset($_GET['ID'])){
          echo"if ID est PAS set";
          var_dump($animal);
        $stmt = $dbh->prepare('INSERT INTO produit(id_produit,nom_produit,description,description_rapide,prix_tonne) VALUES(?,?,?,?,?)');
               $stmt->bindValue(1, null);
               settype($titre, "string");
               $stmt->bindParam(2, $titre, PDO::PARAM_STR);
               $stmt->bindParam(3, $texte, PDO::PARAM_STR);
               $stmt->bindParam(4, $courteDesc, PDO::PARAM_STR);
               $stmt->bindParam(5, $prix, PDO::PARAM_INT); 
          $stmt->execute();

          foreach($animal as $valueAnimal )
          {
           $id_produit = getIdAnimal($valueAnimal) ; 
           $stmt = $dbh->prepare('INSERT INTO animal_produit(id_produit,id_animal) VALUES(?,?)');
           $stmt->bindValue(1, null);
           $stmt->bindParam(2, $id_animal, PDO::PARAM_STR);
           $stmt->execute();
          }

     }
     else if (isset($_GET['ID'])){
         echo"if ID est set";
        $id_produit = $_GET['ID'] ; 
        $stmt = $dbh->prepare('UPDATE produit SET nom_produit= :nom, description= :desc, description_rapide= :descRap, prix_tonne= :prix WHERE id_produit=' . $id_produit . '');
        $stmt->bindParam(':nom', $titre);
        $stmt->bindParam(':desc', $texte);
        $stmt->bindParam(':descRap', $courteDesc);
        $stmt->bindParam(':prix', $prix); 
        $stmt->execute();
    
        //On supprime tous les id pour les refaires après
        $stmt2 = $dbh->prepare("DELETE FROM `animal_produit`WHERE `id_produit` = $id_produit ");
        $stmt2 ->execute() ; 
        
         foreach( $animal as $valueAnimal) 
          {
             echo"<br> for isset valeur animal $valueAnimal <br>";
             $id_animal = getIdAnimal($valueAnimal) ; 
             echo"<br> for isset idAnimal $id_animal " ; 
           $stmt = $dbh->prepare('INSERT INTO animal_produit(id_produit,id_animal) VALUES(?,?)');
           $stmt->bindValue(1, $id_produit);          
           $stmt->bindParam(2, $id_animal, PDO::PARAM_STR);
           $stmt->execute();
          }
     
     }
   

}

 

function creerCheckBoxAnimal(){
 $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
  
    foreach ($dbh->query('SELECT animal FROM animal') as $row) {
        $valueAnimal = $row['animal'];
        
     if(isset($_GET['ID'])){
      $id_produit = $_GET['ID'];
      $animalChecked = getAnimal($id_produit);
      checkedCheckBox($animalChecked, $valueAnimal);  
      }
     else {
         echo"<input type=\"checkbox\" name=\"$valueAnimal\" id=\"$valueAnimal\" /> <label for=\"$valueAnimal\">$valueAnimal</label><br />" ;
     }   
    }  
    return($row) ; 
}
    
function recupListeAnimaux(){
    $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
    $tableauAnimal = [] ; 
    foreach ($dbh->query('SELECT animal FROM animal') as $row) {
        $valueAnimal = $row['animal'] ; 
        $tableauAnimal["$valueAnimal"]  = $valueAnimal; 
    }  
    return($tableauAnimal) ; 
}

function getIdAnimal($animal){
    $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
    foreach ($dbh->query("SELECT id_animal FROM animal WHERE animal = '$animal' ") as $row) {
        $id_animal = $row['id_animal'] ; 
    }  
    return($id_animal) ; 
}

function getAnimal($id_produit){
    $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
    
    foreach ($dbh->query("SELECT animal FROM animal INNER JOIN animal_produit ON animal_produit.id_animal = animal_produit.id_animal WHERE id_produit ='$id_produit' ") as $row) {
        $animal['animal'] = $row['animal'] ; 
    }  
    return($animal) ; 
}

function checkedCheckBox( $tabAnimalChecked, $valueAnimal){
          foreach($tabAnimalChecked as $valueAnimalChecked){
            if($valueAnimal == $valueAnimalChecked){
                echo"<input type=\"checkbox\" name=\"$valueAnimal\" id=\"$valueAnimal\" checked=\"checked\"/> <label for=\"$valueAnimal\">$valueAnimal</label><br />" ;
            }
            else{
                echo"<input type=\"checkbox\" name=\"$valueAnimal\" id=\"$valueAnimal\" /> <label for=\"$valueAnimal\">$valueAnimal</label><br />" ;
            }
        }
}


//ajoute produit
//ajoute image-produit
//ajoute animal-produit
//modifie produit (sans image ni animal)
//supprime produit (supprime aussi les relation animal-produit et image-produit
