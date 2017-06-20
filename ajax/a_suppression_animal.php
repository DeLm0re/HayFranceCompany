<?php
include_once '../objet/session_objet.php';
include_once '../objet/administration/o_admin.php';
$admin = new Admin($bdd);
demarreSession($admin);

$id_animal = (isset($_GET["variable1"])) ? $_GET["variable1"] : NULL;
$admin->supprimeAnimal($id_animal) ;
echo"fini" ;