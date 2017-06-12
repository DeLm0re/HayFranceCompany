


function request_connexion(callback,champ) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText,champ);
        }
    };

    var contenu = encodeURIComponent(document.getElementById(champ).value);

    xhr.open("GET", "../ajax/a_verif_connexion.php?contenu="+contenu+"&champ="+champ, true);
    xhr.send(null);
}

function request2_connexion(callback) {
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
  
      alert("on est passé par là") ;
    xhr.open("GET", "../ajax/a_verif_connexion.php?champ="+champ+"&email="+email+"&mdp="+mdp+"", true);
    xhr.send(null);
}

function readData_connexion(data,champ)
{
    if (data === "OK")
    {
        alert("on est passé par Ok") ;
        document.getElementById("ok_"+champ).style.display = "inherit";
        document.getElementById("ko_"+champ).style.display = "none";
    }
    if (data === "KO")
    {
        alert("on est passé par KO") ;
        document.getElementById("ok_"+champ).style.display = "none";
        document.getElementById("ko_"+champ).style.display = "inherit";
    }
    
    if (champ === 'button')
    {
        //On vide les spans d'erreur qui se sont remplis pour l'erreur précedente
            alert("on est passé par button") ;
            vide_span_erreur_connexion('email');
            vide_span_erreur_connexion('mdp');
       
        
        //On affiche l'erreur au dessus du champ la contenant
        if (data === "erreur_email")
            document.getElementById("erreur_email").innerHTML = "Veuillez saisir un email valide";
        if (data === "erreur_mdp")
            document.getElementById("erreur_mdp").innerHTML = "Votre mot de passe ne peut contenir que des lettres et des chiffres\n et ne doit pas dépasser 50 caractères";
    }
}


function vide_span_erreur_connexion(idspan){
    document.getElementById("erreur_"+idspan).innerHTML = "";
}