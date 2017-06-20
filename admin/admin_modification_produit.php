<link href="../css/admin_modification.css" rel="stylesheet" type="text/css"/>
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
            <title>Créer/Modifier Produit</title>
        </head>
        <body <?php 
        
        if(isset($_GET['ID'])){
                  $id_produit = $_GET['ID'] ; 
                    echo"onload=request($id_produit)";
                    } 
                ?> 
            >
            <div class="div_dessus_navbar">
            <div onclick="window.document.location.href='admin.php'" class="div_logo_navbar">
                <img class="logo_navbar"  src="../images/hayfrancecompany_navbar.png" alt="Logo hayfrancecompany"/>
            </div> 
            </div>
            <div class="ensemble_produit">
            <?php
            if (isset($id_produit)) {
                echo"<form method=\"post\" action=\"$URL?ID=$id_produit \">";
                echo"<h1 class='titre_ensemble_produit'>Modifier l'article </h1>";
            } else if (!isset($id_produit)) {
                echo"<form method=\"post\" action=\"$URL\">";
                echo"<h1 class='titre_ensemble_produit'>Créer l'article </h1>";
            }
            ?>

            <span id="loader" style="display: none;"><img id="img_loader" style="width: 10%;" src="../images/loader.gif" alt="Chargement" /></span>
            <div id="centre">
            <label for="titre"></label><br>
            <input type="text" name="titre" id="titre" placeholder="Nom article" size="30" /><br>
            <!--Barre d'option de text -->
            <!--A ajouter plus tard
            <input type="button" value="G" style="font-weight: bold;" onclick="commande('bold');" />
            <input type="button" value="I" style="font-style: italic;" onclick="commande('italic');" />
            <input type="button" value="S" style="text-decoration: underline;" onclick="commande('underline');" />
            <input type="button" value="Lien" onclick="commande('createLink');" >
            <input type="button" value="Couleur" onclick="commande('forecolor');" >
            <input type="button" value="Gauche" onclick="commande('justifyleft');" >
            <input type="button" value="Centrer" onclick="commande('justifycenter');" >
            <input type="button" value="Droite" onclick="commande('justifyright');" >
            <input type="button" value="Puce" onclick="commande('insertunorderedlist');" >
            <div id="editeur" contentEditable></div>
            <input type="button" onclick="resultat();" value="Obtenir le HTML" ><br /> -->
            <label for="resuEditeur">Description Produit</label> <br>
            <textarea id="resuEditeur" name="texte"></textarea><br>
            <label for="courteDesc">Description Rapide</label> <br>
            <textarea id="courteDesc" name="courteDesc"></textarea><br>
            <!-- </fieldset>
            <!-- Zone Prix --> 
            
           
            <label for="prix">Prix</label><br>
            <input type="number" name="prix" id="prix" /><br>
           


            <!-- Zone check box --> 
            <div id='checkbox'>
            <fieldset>
                <legend>Pour quel animal ?</legend>
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
                <input type='button' value='Ajouter Image' onclick='afficheListeImages()'>
            <fieldset display='none'>
                <div id="listeImages" >
                <?php
                $listeURLImage = $admin->donneListeUrlImage();
                //echo'var_dump $listeImage';
                //var_dump($listeURLImage);
                $listeIdImage = $admin->donneListeIdImage();
                //echo'var_dump $listeIdImage';
                //var_dump($listeIdImage);
                $listeNomImage = $admin->donneListeNomImage();
                //echo'var_dump $listeNomImage';
                //var_dump($listeNomImage);
                creerCheckBoxImage($listeIdImage, $listeURLImage, $listeNomImage, $produit);
                ?>
                </div>
                </div>
            <input type="submit" value="Valider" width="100%"/>
            </div>
            </div>
                <script>document.getElementById("listeImages").style.display = "none" ; </script>
            </fieldset>
            </div>
          
        </form>
                <script>
                    function afficheListeImages() {
                        if((document.getElementById("listeImages").style.display) === "none"){
                            (document.getElementById("listeImages").style.display) = "inline";
                        }
                        else{
                            (document.getElementById("listeImages").style.display) = "none";
                        }
                    }                   
                </script>
                
    </body>

    </html>


    <?php
} else {
    echo'var_dunp $_POST' ; 
    var_dump($_POST) ; 
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
    $tabIdImageChecked = [] ; 
    
    //Recupère la liste de tous les animaux
    $tabIdAnimaux = $admin->donneListeIdAnimal() ; 
    $tabNomAnimaux = $admin->donneListeAnimal() ; 
    echo"var_dump tabAnimaux";
    var_dump($tabIdAnimaux);
    //Pour chaque animal on test si sa valeur en _POST existe càd qu'il a été coché 
    //On créer un tableau d'animaux qui ont été cochés $animalChecked
    
    $maxTabIdAnimaux = count($tabIdAnimaux) ;
    for($i=0 ; $i < $maxTabIdAnimaux ; $i+=1){
        if (isset($_POST[$tabNomAnimaux[$i]])) {
            $tabIdAnimalChecked[] = $tabIdAnimaux[$i];
        }
    }
    echo"var_dump animalChecked :";
    var_dump($tabIdAnimalChecked);
    
   
    //Recupère la liste de tous les images
    $tabIdImage = $admin->donneListeIdImage() ;
    $tabNomImage = $admin->donneListeNomImage();
    echo"var_dump tabIdImage";
    var_dump($tabIdImage);
    echo"var_dump tabNomImage";
    //Pour chaque image on test si sa valeur en _POST existe càd qu'il a été coché 
    //On créer un tableau d'image qui ont été cochés $imageChecked
   
    $maxTabIdImage = count($tabIdImage) ;
    for($i=0 ; $i < $maxTabIdImage ; $i+=1){
        if (isset($_POST[$tabIdAnimaux[$i]])) {
            $tabIdImageChecked[] = $tabIdImage[$i];
        }
    }
    echo"var_dump imageChecked :";
    var_dump($tabIdImageChecked);
    
    




    //S'il n'y a pas d'ID de setté sur la page
    if (!isset($_GET['ID'])) {
        echo"if ID est PAS set";

        //On entre toutes les valeurs de produit 
        $admin->ajouteProduit($titre, $texte, $courteDesc, $prix);

        
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
        }
        
        foreach ($tabIdImageChecked as $valueIdImage) {
            $admin->ajouteImageProduit($id_produit, $valueIdImage)  ; 
        }
        
    } else if (isset($_GET['ID'])) {
      
        
        $admin->modifieProduit($produit, $titre, $texte, $courteDesc, $prix);
    
        //On supprime tous les id pour les refaires après
        $admin->supprimeAnimalProduit($id_produit);
       
        foreach ($tabIdAnimalChecked as $valueIdAnimal) {
            $admin->ajouteAnimalProduit($id_produit, $valueIdAnimal)  ;
        }
                
        $admin->supprimeImageProduit($id_produit) ;
        
        foreach ($tabIdImageChecked as $valueIdImage) {
            $admin->ajouteImageProduit($id_produit, $valueIdImage)  ;
        }
    }
  header("Location: admin.php");
}

function creerCheckBoxImage($listeIdImage, $listeUrlImage, $listeNomImage, $ObjProduit) {
    $max = count($listeIdImage);
    for ($i = 0; $i < $max; $i+=1) {
     if (isset($_GET['ID'])) {
            $BoolAppartientCategorie = $ObjProduit->appartientImage($listeIdImage[$i]);
            echo'$Bool Machin';
            var_dump($BoolAppartientCategorie);
            echo'vardump getImage';
            var_dump($ObjProduit->getImages()) ; 
            if ($BoolAppartientCategorie == TRUE) {                                                                         
                echo"<input type=\"checkbox\" name=\"$listeNomImage[$i]\" id=\"$listeNomImage[$i]\" checked /> <label for=\"$listeNomImage[$i]\"><img src=\"$listeUrlImage[$i]\"  maxwidth=\"100\"  maxheight=\"100\" /> </label>" ; 
            }
            else{
                echo"<input type=\"checkbox\" name=\"$listeNomImage[$i]\" id=\"$listeNomImage[$i]\" /> <label for=\"$listeNomImage[$i]\"><img src=\"$listeUrlImage[$i]\"  maxwidth=\"100\"  height=\"100\" /></label>";
            }
        } 
        else {
          echo"<input type=\"checkbox\" name=\"$listeNomImage[$i]\" id=\"$listeNomImage[$i]\" /> <label for=\"$listeNomImage[$i]\"><img src=\"$listeUrlImage[$i]\"  maxwidth=\"100\"  height=\"100\" /></label>";
        }
    }
}

function creerCheckBoxAnimal($listeIdAnimal, $listeNomAnimal, $ObjProduit) {

    $max = count($listeIdAnimal);
    for ($i = 0; $i < $max; $i+=1) {
       
       // echo'var_dump isset Get ID';
      //var_dump(isset($_GET['ID']));

        if (isset($_GET['ID'])) {
            $BoolAppartientCategorie = $ObjProduit->appartientCategorie($listeIdAnimal[$i]);
            //echo'$Bool Machin';
            //var_dump($BoolAppartientCategorie);
            if ($BoolAppartientCategorie == TRUE) {
                echo"<input type=\"checkbox\" name=\"$listeNomAnimal[$i]\" id=\"$listeNomAnimal[$i]\"  checked/> <label for=\"$listeIdAnimal[$i]\">$listeNomAnimal[$i]</label>" ; 
            }
            else{
                echo"<input type=\"checkbox\" name=\"$listeNomAnimal[$i]\" id=\"$listeNomAnimal[$i]\" /> <label for=\"$listeIdAnimal[$i]\">$listeNomAnimal[$i]</label>";
            }
        }
       
        else {
            echo"<input type=\"checkbox\" name=\"$listeNomAnimal[$i]\" id=\"$listeNomAnimal[$i]\" /> <label for=\"$listeIdAnimal[$i]\">$listeNomAnimal[$i]</label>";
        }
    }
     
}

