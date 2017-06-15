<?php
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

$_SESSION['nom_departement'] = $_GET['dep'];
$tmp = str_split($_SESSION['nom_departement']);
$max = count($tmp);
$_SESSION['nb_departement'] = $tmp[$max - 3] . $tmp[$max - 2];
