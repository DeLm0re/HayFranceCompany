<?php

include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

$id = $_GET['id'];

$produit_prix = new Produit($bdd, $id);
$infos_prix = $produit_prix->infos();
$prix_tonne = intval($produit_prix->infos()['prix_tonne']);

$coef = $_GET['coef'];

$prix_sans_transport = ($coef * $prix_tonne);

$nbr = intval($_GET['nbr']);

if (empty($user->donneInfos()) === true) {
    $dpt = intval($_SESSION['nb_departement']);
} else {
    $dpt = intval($user->donneInfos()['departement']);
}

$prix_transport = null;

try {
    $dbh = new PDO('mysql:host=localhost;dbname=hayfrance;charset=utf8', 'root', '');
    foreach ($dbh->query('SELECT prix'.$nbr.' FROM prix_transport WHERE id_prix_transport='.$dpt.'') as $row) {
        $result = $row['prix'.$nbr];
        $prix_transport = floatval($result);
    }
} catch (PDOExeption $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$prix_final = ($prix_sans_transport + $prix_transport);

echo($prix_final);
?>

