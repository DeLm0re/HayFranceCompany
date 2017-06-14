function request(callback,champ) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText,champ);
        }
    };

    var contenu = encodeURIComponent(document.getElementById(champ).value);

    xhr.open("GET", "../ajax/a_verif_formulaire_produit.php?contenu="+contenu+"&champ="+champ, true);
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
    var nbr_pallette = encodeURIComponent(document.getElementById("nbr_pallette").value);
    var Format = encodeURIComponent(document.getElementById("Format").value);
    
    xhr.open("GET", "../ajax/a_verif_formulaire_produit.php?champ="+champ+"&nbr_pallette="+nbr_pallette+"&Format="+Format+"", true);
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
            vide_span_erreur('nbr_pallette');
          
        
        //On affiche l'erreur au dessus du champ la contenant
        if (data === "nbr_pallette")
            document.getElementById("erreur_prenom").innerHTML = "le nombre de pallette est incorect ";
       
    }
}

function vide_span_erreur(idspan){
    document.getElementById("erreur_"+idspan).innerHTML = "";
}

