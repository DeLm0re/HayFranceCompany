<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//inclusion de la session et des objets
include_once '../objet/session_objet.php';
$user = new Utilisateur($bdd);
demarreSession($user);

$user->deconnecte();

?>
