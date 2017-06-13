<?php
session_start();
    
include_once 'o_bdd.php';
include_once 'o_utilisateur.php';
if(!isset($_SESSION['email']))
{
    $_SESSION['email'] = NULL;
}
if(!isset($_SESSION['password']))
{
    $_SESSION['password'] = NULL;
}

$bdd = new BDD();
$user = new Utilisateur($bdd);
$user->connecte($_SESSION['email'], $_SESSION['password']);