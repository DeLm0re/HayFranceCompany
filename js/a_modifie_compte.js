/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function request(callback,champ) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText,champ);
        }
    };

    var contenu = encodeURIComponent(document.getElementById(champ).value);

    xhr.open("GET", "../ajax/a_verif_inscription.php?contenu="+contenu+"&champ="+champ, true);
    xhr.send(null);
}

function request2(callback) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText,'button');
            document.getElementById("loader").style.display = "none";
        }
        else if (xhr.readyState < 4)
        {
            document.getElementById("loader").style.display = "inherit";
        }
    };

    var champ = 'button';
    var email = encodeURIComponent(document.getElementById("email").value);
    var mdp = encodeURIComponent(document.getElementById("mdp").value);
    var cmdp = encodeURIComponent(document.getElementById("cmdp").value);
    var ville = encodeURIComponent(document.getElementById("ville").value);
    var adresse = encodeURIComponent(document.getElementById("adresse").value);
    var dpt = encodeURIComponent(document.getElementById("dpt").value);
  
    xhr.open("GET", "../ajax/a_verif_modifie_compte.php?champ="+champ+"&email="+email+"&mdp="+mdp+"&cmdp="+cmdp+
                "&ville="+ville+"&adresse="+adresse+"&dpt="+dpt+"", true);
    xhr.send(null);
}

function readData(data,champ)
{
    if (data === "OK")
    {
        document.getElementById("ok_"+champ).style.display = "inherit";
        document.getElementById("ko_"+champ).style.display = "none";
    }
    if (data === "KO")
    {
        document.getElementById("ok_"+champ).style.display = "none";
        document.getElementById("ko_"+champ).style.display = "inherit";
    }
    if (champ === 'button')
    {
        //On vide les spans d'erreur qui se sont remplis pour l'erreur précedente
            vide_span_erreur('email');
            vide_span_erreur('mdp');
            vide_span_erreur('cmdp');
        
        //On affiche l'erreur au dessus du champ la contenant
        alert(data); 
         if (data === "connexionR")
        {
            alert("modification faite ! "); 
        } if (data === "connexionF")
        {
            alert("erreur modification"); 
        }
        if (data === "erreur_email")
            document.getElementById("erreur_email").innerHTML = "Veuillez saisir un email valide";
        if (data === "erreur_mdp")
            document.getElementById("erreur_mdp").innerHTML = "Votre mot de passe ne peut contenir que des lettres et des chiffres\n et ne doit pas dépasser 50 caractères";
        if (data === "erreur_cmdp")
            document.getElementById("erreur_cmdp").innerHTML = "Votre mot de passe et sa confirmation ne sont pas identiques";
        if (data === "erreur_ville")
            document.getElementById("erreur_ville").innerHTML = "Votre ville n'existe pas";
        if (data === "erreur_adresse")
            document.getElementById("erreur_adresse").innerHTML = "Votre adresse est invalide";
        if (data === "erreur_dpt")
            document.getElementById("erreur_adresse").innerHTML = "Numéro de département incorrect ou non désservi";
    }
}

function vide_span_erreur(idspan){
    document.getElementById("erreur_"+idspan).innerHTML = "";
}