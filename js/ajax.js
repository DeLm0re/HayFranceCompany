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
            if (champ === 'button')
                document.getElementById("loader").style.display = "none";
        }
        else if (xhr.readyState < 4)
        {
            if (champ === 'button')
                document.getElementById("loader").style.display = "inherit";
        }
    };

    var contenu = encodeURIComponent(document.getElementById(champ).value);

    xhr.open("GET", "../ajax/a_verif_inscription.php?contenu="+contenu+"&champ="+champ, true);
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
    if (data === "load")
    {
        /*à voir*/
        alert("fini");
    }
}
