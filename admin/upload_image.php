<link href="../css/admin_modification.css" rel="stylesheet" type="text/css"/>
<?php
include_once '../objet/session_objet.php';
include_once '../objet/administration/o_admin.php';
$admin = new Admin($bdd);
demarreSession($admin);
?>

<body>
        <div class="div_dessus_navbar">
            <div onclick="window.document.location.href='admin.php'" class="div_logo_navbar">
                <img class="logo_navbar"  src="../images/hayfrancecompany_navbar.png" alt="Logo hayfrancecompany"/>
            </div> 
            </div>
        <div class="ensemble_produit">
            <h1 class="titre_ensemble_produit">Importer image</h1><br>
        <form method="post" action="upload_image.php" enctype="multipart/form-data">
             <label for="image">Image (JPG, PNG ou GIF | max. 1 Mo) :</label><br />
             <input type="file" name="image" id="image" /><br />
             <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
             <label for="titre">Titre du fichier (max. 50 caractères) :</label><br />
             <input type="text" name="titre" value="Titre du fichier" id="titre" /><br />
             <input type="submit" name="submit" value="Envoyer" />
        </form>


<?php

$dir = "../images";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}
$maxFiles = count($files) ; 
for($i = 0; $i < $maxFiles ; $i+=1){
    echo"<img src=\"../images/$files[$i]\"  maxwidth=\"100\"  height=\"100\" />" ; 
}
?>
        </div>
</body>

<?php
if ((isset($_POST['titre']) == TRUE)) {
        $titre = $_POST['titre'];
        $image  = $_FILES['image']['name'] ; 
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
        //1. strrchr renvoie l'extension avec le point (« . »)
        //2. substr(chaine,1) ignore le premier caractère de chaine.
        //3. strtolower met l'extension en minuscules.

        $extension_upload = strtolower(  substr(  strrchr($image, '.')  ,1)  );
        if ( in_array($extension_upload,$extensions_valides) ){
            echo "Extension correcte";
            $nomImage = $titre+$extension_upload ; 
            $URL = "../images/{$titre}.{$extension_upload}"; 
            $resultat = move_uploaded_file($_FILES['image']['tmp_name'],$URL);
            if ($resultat) 
            {
                echo "<br>Transfert réussi";
            }
            $admin->ajouteImage($titre, $URL);

        }  
        header('Location: '.$_SERVER['REQUEST_URI']);
}
    

/*
$_FILES['icone']['name']     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).

$_FILES['icone']['type']     //Le type du fichier. Par exemple, cela peut être « image/png ».

$_FILES['icone']['size']     //La taille du fichier en octets.

$_FILES['icone']['tmp_name'] //L'adresse vers le fichier uploadé dans le répertoire temporaire.

$_FILES['icone']['error']    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.
     * 
     */















