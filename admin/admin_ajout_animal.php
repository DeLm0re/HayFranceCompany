<link href="../css/admin_modification.css" rel="stylesheet" type="text/css"/>
<?php
include_once '../objet/session_objet.php';
include_once '../objet/administration/o_admin.php';
$admin = new Admin($bdd);
demarreSession($admin);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui"/>
        <script src="../js/a_supprime_animal.js" type="text/javascript"></script>
        <script src="../js/oXHR.js" type="text/javascript"></script>
    </head>


    <body>
        <div class="div_dessus_navbar">
            <div onclick="window.document.location.href='admin.php'" class="div_logo_navbar">
                <img class="logo_navbar"  src="../images/hayfrancecompany_navbar.png" alt="Logo hayfrancecompany"/>
            </div> 
            </div>
       
        <div class="ensemble_produit">
        <table>
            <h1 class="titre_ensemble_produit">Ajout Animal</h1
             <div id="centre">
           
            
            <form  method='post' action="./admin_ajout_animal.php" enctype="multipart/form-data">
                <label for="nomAnimal"></label><br>
                <input type="text" name="nomAnimal" id="nomAnimal" placeholder="Nom nouvel animal" /><br>
                <input type="submit" value="Ajouter Animal" />
            </form>
                 
            <?php 
                        if ((isset($_POST['nomAnimal']) == TRUE)) {
                            $nom = $_POST['nomAnimal'] ; 
                            echo"nomAnimal : $nom <br>" ;
                            $coucou = $admin->ajouteAnimal($nom) ; 
                            echo"var coucou $coucou" ; 
                           // header('Location: '.$_SERVER['REQUEST_URI']);
                        }
            ?>
            
           <tr>
               <th>ID</th>
               <th>Nom Animal</th>
               <th></th>
           </tr>
             <?php
                    $tabIdAnimaux = $admin->donneListeIdAnimal();
                    $tabNomAnimaux = $admin->donneListeAnimal() ; 
                   // $admin->ajouteAnimal($nom);
                   afficheTableauAnimaux($tabIdAnimaux, $tabNomAnimaux);
                ?>
        </table>
        </div>
        </div>
    </body>
</html>




<?php 
function afficheTableauAnimaux($tabIdAnimaux, $tabNomAnimaux)
{
    $max = count($tabIdAnimaux);
    for($i = 0; $i < $max; $i++)
    {
        echo '<tr>';
            ajouteCellule($tabIdAnimaux[$i]); 
            ajouteCellule($tabNomAnimaux[$i]);
        echo"<td><input class=\"image_supp\" name=\"supp\"type='button' value='x' onclick='appelSupprimeAnimal($tabIdAnimaux[$i])'></td>";
        echo '</tr>';
    }
}

function ajouteCellule($cellule)
{
    echo "<td>$cellule</td>";
}