<?php
    
include_once 'o_bdd.php';
include_once 'o_utilisateur.php';

function nouvelUtilisateur()
{
    $bdd = new BDD();
    return new Utilisateur($bdd);
}