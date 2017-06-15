<script type="text/javascript">
    function deconnexion(){
        var xhr = getXMLHttpRequest();
        xhr.open("POST", "../ajax/a_deconnexion.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(null);
    }
</script>


<?php
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

function creer_navbar_options_produits($liste_nom) {
    foreach ($liste_nom as $un_produit) {

        $info = $un_produit->infos();

        echo "<li class=\"li_contenu_dropdown\"><i class=\"fleche_contenu_dropdown\">&#9658;</i>"
        . "<a class=\"a_contenu_dropdown\" href=\"../pages/un_produit.php?id_produit=" . $info['id_produit'] . "\">" . strtoupper($info['nom_produit'])
        . "</a></li>";
    }
}

function creer_navbar_options_elevages($liste1, $liste2) {
    $max = count($liste1);

    for ($i = 0; $i < $max; $i++) {
        echo "<li class=\"li_contenu_dropdown\"><i class=\"fleche_contenu_dropdown\">&#9658;</i>"
        . "<a class=\"a_contenu_dropdown\" href=\"../pages/tout_produit.php?id_animal=" . $liste2[$i] . "\">" . strtoupper($liste1[$i])
        . "</a></li>";
    }
}
?>

<link href="../css/i_navbar.css" rel="stylesheet" type="text/css"/>

<nav class="navbar">
    <div class="div_navbar">
        <div class="div_dessus_navbar">
            <div class="div_logo_navbar">
                <img class="logo_navbar" src="../images/hayfrancecompany_navbar.png" alt="Logo hayfrancecompany"/>
            </div>
            <div class="div_info_navbar">
                <p class="bonjour_navbar">Bonjour <span class="span_bonjour_navbar" onclick="window.location.href = 'http://localhost/HayFranceCompany/pages/mon_compte.php'">
                        <?php
                        $infos = $user->donneInfos();
                        /* si l'utilisateur est connecté */
                        if (!empty($infos)) {
                            /* on recupére son nom et prenom */
                            $nom = $infos['nom'];
                            $prenom = $infos['prenom'];
                            echo($nom . ' ' . $prenom);
                        }
                        ?>
                    </span>
                </p>
                <div class="autre_navbar">
                    <span>Votre localisation : </span>
                    <span id="mon_departement">
                        <?php
                        /* si l'utilisateur est connecté */
                        if (!empty($infos)) {
                            /* on recupére son departement */
                            $departement = $infos['departement'];
                            $ville = $infos['ville'];
                            echo($ville . ' (' . $departement . ')');
                        }
                        else if(isset($_SESSION['nom_departement']))
                        {
                            $nom = $_SESSION['nom_departement'];
                            echo $nom;
                        }
                        else{
                            echo ' Inconnue';
                        }                            
                        ?>
                    </span>
                </div>
                <?php
                /* si l'utilisateur est connecté */
                if (!empty($infos)) {
                    /* on affiche "deconnexion" pour se deconnecter */
                    echo '<div class="div_deconnexion_navbar">
                                    <span class="deconnexion_navbar" onclick="deconnexion();window.location.reload(false);">Déconnexion</span>
                                  </div>';
                }
                ?>
            </div>
        </div>
        <div class="div_dessous_navbar">
            <div class="div_dropdown">
                <button class="button_dropdown" onclick="window.location.href = 'http://localhost/HayFranceCompany/pages/tout_produit.php'">TOUS LES PRODUITS<i class="fleche_dropdown_produits">&#9660;</i></button>
                <div class="contenu_dropdown">
                    <?php
                    $liste = $user->consulteListeProduit();
                    creer_navbar_options_produits($liste);
                    ?>
                </div>
            </div>
            <div class='div_dropdown'>
                <button class="button_dropdown">TYPES D'ELEVAGES<i class="fleche_dropdown_produits">&#9660;</i></button>
                <div class="contenu_dropdown">
                    <?php
                    $liste_nom_animal = $user->donneListeAnimal();
                    $liste_id_animal = $user->donneListeIdAnimal();
                    creer_navbar_options_elevages($liste_nom_animal, $liste_id_animal);
                    ?>
                </div>
            </div>
            <div class="div_dropdown">
                <button class="button_dropdown" onclick="window.location.href = 'http://localhost/HayFranceCompany/pages/mon_compte.php'">MON COMPTE</button>
            </div>
            <div class="div_dropdown">
                <button class="button_dropdown" onclick="window.location.href = 'http://localhost/HayFranceCompany/pages/panier.php'">MON PANIER</button>
            </div>
        </div>
    </div>
</nav>
