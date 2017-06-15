
var nbr_balle_pallette_22 = 36;
var nbr_balle_pallette_32 = 24;
var Format22kg = 22;
var Format32kg = 32;
var tonne = 1000;

window.addEventListener("load", function () {
// Déclaration de l'index de parcours
    var i;
// tabInputs est une collection de <input>
    var tabInputs = window.document.querySelectorAll("input[type='number']");
// Parcours de tabInputs en s'appuyant sur le nombre de <input>
    for (i = 0; i < tabInputs.length; i++) {
// Ajout d'un Listener sur tous les <input> sur l'évènement onkeyup
        tabInputs[i].addEventListener("keyup", function () {
            //alert("keyup"); 
            calculPrixHorsTransport();
        }, false);
// Ajout d'un Listener sur tous les <input> sur l'évènement onchange
        tabInputs[i].addEventListener("change", function () {
            //alert("change avec tabs input");
            calculPrixHorsTransport();
        }, false);
    }
    window.document.querySelector("#nbr_pallette").addEventListener("change", function () {
        //alert("change");
        window.document.querySelector("#nbr_pallette").value =
                parseInt(window.document.querySelector("#nbr_pallette").value);
        calculPrixHorsTransport();
    }, false);
    window.document.querySelector("#button").addEventListener("click", function () {
        //alert("button");
        calculPrixHorsTransport();
    }, false);
}, false);



function calculPrixHorsTransport() {
    //  alert("on est entré dans la fonction");

    var Format_choisit;
    var Prix_produit = encodeURIComponent(document.getElementById("prix_produit").value);
    var nbr_pallette_choisit = encodeURIComponent(document.getElementById("nbr_pallette").value);
   
    var Prix_hors_transport;

    if (document.getElementById("Format32").checked === true) {
        Format_choisit = encodeURIComponent(document.getElementById("Format32").value);
    } else {
        Format_choisit = encodeURIComponent(document.getElementById("Format22").value);
    }

//alert("format:"+Format_choisit);
//alert("prix:"+Prix_produit);
//alert("nbr_pallette:"+nbr_pallette_choisit);

   // Prix_hors_transport = calculPrix(Format_choisit, nbr_pallette_choisit, Prix_produit);

    if  ((nbr_pallette_choisit < 9) && (nbr_pallette_choisit > 0))
    {
        Prix_hors_transport = calculPrix(Format_choisit, nbr_pallette_choisit, Prix_produit);
        document.getElementById("prix_produit_par_JS").innerHTML = "Vortre prix transport est " + Prix_hors_transport + " €";
    }else if (typeof nbr_pallette_choisit != "undefined")
   {
      
        Prix_hors_transport =0 ;
        document.getElementById("prix_produit_par_JS").innerHTML = "Vortre prix hors transport est " + Prix_hors_transport + " €";
   }
    else  {
         Prix_hors_transport =0 ;
        document.getElementById("prix_produit_par_JS").innerHTML = "Vortre prix hors transport est  " + Prix_hors_transport + " €";
    }

}



function calculPrix(format, nbr_pallette, prix)
{
    // alert("on passe par là") ;
    var format_calcul = parseInt(format);
    var nbr_pallette_calcul = parseInt(nbr_pallette);
    var prix_calcul = parseFloat(prix);

    // alert("prix:"+prix_calcul);

    var calcul_inter;
    var calcul_final;

    if (format_calcul === Format22kg) {

        calcul_inter = Format22kg * nbr_balle_pallette_22 * nbr_pallette_calcul;

        calcul_inter = calcul_inter / tonne;

        calcul_final = calcul_inter * prix_calcul;

        return calcul_final.toFixed(2);

    }
    if (format_calcul === Format32kg) {

        calcul_inter = Format32kg * nbr_balle_pallette_32 * nbr_pallette_calcul;
        calcul_inter = (calcul_inter / tonne);
        calcul_final = calcul_inter * prix;

        return calcul_final.toFixed(2);

    }




}