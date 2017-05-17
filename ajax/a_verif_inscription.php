<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*Si on effectue l'ajax sur un champ(input) d'id 'nom'/'prenom' on rentre dans le if*/
if (($_GET['champ'] == 'nom') || ($_GET['champ'] == 'prenom') )
{
    if ((preg_match('`^[a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+'
                . '(?:[\ \-\'][a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+)*$`', trim($_GET['contenu'])) == 0)
        || ((strlen($_GET['contenu'])) > 50))
    {
        echo "KO";
    }
    else
    {
        echo "OK";
    }
}
/*----------------------------------------------------------------------------------*/

/*Si on effectue l'ajax sur un champ(input) d'id 'email' on rentre dans le if*/
if (($_GET['champ'] == 'email'))
{
    if ((preg_match("/^[-+.\w]{1,64}@[-.\w]{1,15}\.[-.\w]{2,6}$/i", trim($_GET['contenu'])) == 0)
            || ((strlen($_GET['contenu'])) > 100))
    {
        echo "KO";
    }
    else
    {
        echo "OK";
    }
}
/*----------------------------------------------------------------------------------*/

/*
 * if ((preg_match('`^[a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]{1,20}+'
            . '(?:[\_\-\.][a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]{1,20}+)+'
            . '(?:[\@][a-zA-ZÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]{1,10}+)+'
            . '(?:[\.][a-zA-Z]{1.4}+)*$`', trim($_GET['contenu'])) == 0))
 */

/*Si on effectue l'ajax sur un champ(input) d'id 'mdp'/'cmdp' on rentre dans le if*/
if ( ($_GET['champ'] == 'mdp') || ($_GET['champ'] == 'cmdp') )
{
    if ((preg_match('`^[a-zA-Z0-9]*$`', trim($_GET['contenu'])) == 0)
            ||  (strlen($_GET['contenu'])) > 20)
    {
        echo "KO";
    }
    else
    {
        echo "OK";
    }
}
/*----------------------------------------------------------------------------------*/

if (($_GET['champ']=='button'))
{
    sleep(3);
    echo"load";
}