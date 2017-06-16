function request_input(callback, champ) {

    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText, champ);
        }
    };

    var contenu = encodeURIComponent(document.getElementById(champ).value);

    xhr.open("GET", "../ajax/a_verif_formulaire_produit.php?contenu=" + contenu + "&champ=" + champ + "", true);
    xhr.send(null);
}

function request_button(callback, id_produit) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText, 'button');
            document.getElementById("loader").style.display = "none";
        }
        else if (xhr.readyState < 4)
        {
            document.getElementById("loader").style.display = "inherit";
        }
    };

    var champ = 'button';
    var nbr = encodeURIComponent(document.getElementById("input_palette").value);
    var id = encodeURIComponent(id_produit);
    var format = null;
    if (document.getElementById("format_22").checked === true) {
        format = encodeURIComponent(document.getElementById("format_22").value);
    }
    else {
        format = encodeURIComponent(document.getElementById("format_32").value);
    }

    xhr.open("GET", "../ajax/a_verif_formulaire_produit.php?champ=" + champ + "&nbr=" + nbr + "&format=" + format + "&id=" + id + "", true);
    xhr.send(null);
}

function readData(data, champ)
{
    //alert(data);
    if (data === "OK")
    {
        document.getElementById("ok_" + champ).style.display = "inherit";
        document.getElementById("ko_" + champ).style.display = "none";
    }
    if (data === "KO")
    {
        document.getElementById("ok_" + champ).style.display = "none";
        document.getElementById("ko_" + champ).style.display = "inherit";
    }

    if (champ === 'button')
    {
        //alert(data);

        //On affiche l'erreur au dessus du champ la contenant
        if (data === "non_co")
        {
            document.getElementById("erreur_commande").style.display = "none";
            document.getElementById("validation_commande").style.display = "none";
            document.getElementById("erreur_connecte").style.display = "inherit";
            document.getElementById("erreur_connecte").innerHTML = "Vous n'êtes pas connecté... Redirection";
            document.location.href = "../pages/inscription_connexion.php";
        }

        if (data === "erreur_input") {
            document.getElementById("div_champ_erreur_palette").style.display = "inherit";
            document.getElementById("erreur_palette").innerHTML = "Nombre de palette invalide";
        }

        //Requete effectuée
        if (data === "resultat_true") {
            document.getElementById("erreur_commande").style.display = "none";
            document.getElementById("erreur_connecte").style.display = "none";
            document.getElementById("validation_commande").style.display = "inherit";
            document.getElementById("validation_commande").innerHTML = 
                    "Ce produit a été ajouté à votre panier. <br>Vous pouvez continuer vos achats ou cliquer sur <br>Mon panier";
        }

        //Requete non effectuée
        if (data === "resultat_false") {
            document.getElementById("validation_commande").style.display = "none";
            document.getElementById("erreur_connecte").style.display = "none";
            document.getElementById("erreur_commande").style.display = "inherit";
            document.getElementById("erreur_commande").innerHTML = "Ce produit est déjà dans votre panier";
        }
    }
}

/*==========================================================================================================*/

function recalcul_prix_p_t(id_produit) {
    
    var xhr = getXMLHttpRequest();
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            readPrix(xhr.responseText);
            document.getElementById("loader").style.display = "none";
        }else if (xhr.readyState < 4)
        {
            document.getElementById("loader").style.display = "inherit";
        }
    };
    
    var id = encodeURIComponent(id_produit);
    
    var poids_kg = null;
    var poids_tonne = null;
    
    var nbr_balle = null;
    
    var nbr_palette = encodeURIComponent(document.getElementById("input_palette").value);
    
    var format = null;
    if (document.getElementById("format_22").checked === true) {
        format = encodeURIComponent(document.getElementById("format_22").value);
        nbr_balle = 36;
    }
    else {
        format = encodeURIComponent(document.getElementById("format_32").value);
        nbr_balle = 24;
    }
    
    poids_kg = (format * nbr_balle * nbr_palette);
    poids_tonne = (poids_kg/1000);
    
    if ((nbr_palette <= 8) && (nbr_palette > 0) && (nbr_palette !== "")){
        xhr.open("GET", "../ajax/a_prix_p_t.php?id="+id+"&coef="+poids_tonne+"&nbr="+nbr_palette+"", true);
        xhr.send(null);
    }
}

function readPrix(prix){
    
    document.getElementById("prix_p_t").innerHTML = prix;
    
}
