
function request_connexion(callback,champ) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText,champ);
        }
    };

    var contenu = encodeURIComponent(document.getElementById(champ).value);

    //alert(contenu);
    // alert(champ); 
    xhr.open("GET", "../ajax/a_verif_connexion.php?contenu="+contenu+"&champ_connexion="+champ, true);
    xhr.send(null);
}

function request2_connexion(callback) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
        {
            callback(xhr.responseText,'button_connexion');
            document.getElementById("loader_connexion").style.display = "none";
        }
        else if (xhr.readyState < 4)
        {
            document.getElementById("loader_connexion").style.display = "inherit";
        }
    };

    var champ = 'button_connexion';
    
    var email = encodeURIComponent(document.getElementById("email_connexion").value);
    var mdp = encodeURIComponent(document.getElementById("mdp_connexion").value);
  
    // alert("on est passé par verif_connexion.php") ;
    xhr.open("GET", "../ajax/a_verif_connexion.php?champ_connexion="+champ+"&email_connexion="+email+"&mdp_connexion="+mdp+"", true);
    xhr.send(null);
}

function readData_connexion(data,champ)
{
    if (data === "OK_connexion")
    {
     //   alert("on est passé par Ok") ;
        document.getElementById("ok_"+champ).style.display = "inherit";
        document.getElementById("ko_"+champ).style.display = "none";
    }
    if (data === "KO_connexion")
    {
       //alert("on est passé par KO") ;
        document.getElementById("ok_"+champ).style.display = "none";
        document.getElementById("ko_"+champ).style.display = "inherit";
    }
    
    if (champ === 'button_connexion')
    {
        //On vide les spans d'erreur qui se sont remplis pour l'erreur précedente
          // alert("on est passé par button") ;
          
            vide_span_erreur_connexion('email_connexion');
            vide_span_erreur_connexion('mdp_connexion');
       
        //On affiche l'erreur au dessus du champ la contenant
        
       // alert(data);
        if (data === "connexionR")
        {
           // alert("connecter!!"); 
            document.getElementById("loader_connexion").style.display = "none";
            document.getElementById("formulaire_connexion").style.display = "none";
            document.getElementById("validation_modification").innerHTML = "Connexion reussite";            
            document.location.href = "http://localhost/HayfranceCompany/pages/tout_produit.php";

        } if (data === "connexionF")
        {
            //alert("erreur de connection"); 
            document.getElementById("loader_connexion").style.display = "none";
            document.getElementById("erreur_connexion").innerHTML = "Aucun utilisateur trouvé ";
            
        }
        
        if (data === "erreur_email_connexion")
        {
   //           alert("on est passé par erreur mail") ;
            document.getElementById("erreur_email_connexion").innerHTML = "Veuillez saisir un email valide";
        }
        if (data === "erreur_mdp_connexion")
        { 
       // alert("on est passé par erreur mail") ;
            document.getElementById("erreur_mdp_connexion").innerHTML = "Votre mot de passe ne peut contenir que des lettres et des chiffres\n et ne doit pas dépasser 50 caractères";
        }
    }
   
}


function vide_span_erreur_connexion(idspan){
    document.getElementById("erreur_"+idspan).innerHTML = "";
   // alert(idspan); 
}
