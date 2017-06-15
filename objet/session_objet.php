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

function demarreSession(&$user)
{
    if(isset($_SESSION['email']) && !empty($_SESSION['email']) 
            || isset($_SESSION['password']) && !empty($_SESSION['password']))
    {
        $user->connecte(decrypte($_SESSION['email']), decrypte($_SESSION['password']));
    }
}

function encrypte($donnee) {
    $key = "Ad5drZE";
    $data = serialize($donnee);
    $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td,$key,$iv);
    $final = base64_encode(mcrypt_generic($td, '!'.$data));
    mcrypt_generic_deinit($td);
    return $final;
}
 
function decrypte($donnee) {
    $key = "Ad5drZE";
    $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td,$key,$iv);
    $data = mdecrypt_generic($td, base64_decode($donnee));
    mcrypt_generic_deinit($td);
 
    if (substr($data,0,1) != '!')
    {
        return false;
    }
 
    $final = substr($data,1,strlen($data)-1);
    return unserialize($final);
}