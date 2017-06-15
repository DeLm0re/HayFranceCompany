<!--REMARQUES : 
 - spellcheck="false", permet d'indiquer au navigateur de ne pas appliquer une vérification orthographique dans les champs
 - checked="true", permet de cocher l'imput radio spécifié par défault (ici M.)
-->
<form id="formulaire">
    <div class="div_titre">
        <span class="titre">Inscription</span> 
    </div>

    <div class="div_ensemble_champ">
        
        <div class="div_champ">
            <span class="champ">Civilité : 
                <input id="civMr" type="radio" name="civilite" value="M." checked="true">
                <label for="M.">M.</label>
                <input id="civMm" type="radio" name="civilite" value="Mme.">
                <label for="Mme.">Mme.</label>
            </span><br>
        </div>
        
        <div id="div_champ_erreur_prenom" style="display: none;">
            <span id="erreur_prenom" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ">Prénom : <input id="prenom" type="text" spellcheck="false" onchange="request(readData, 'prenom');">
                <span id="ok_prenom" style="display: none;"><img class="icon_preverif" src="../images/ok.png" /></span>
                <span id="ko_prenom" style="display: none;"><img class="icon_preverif" src="../images/ko.png" /></span>
            </span><br>
        </div>
        
        <div id="div_champ_erreur_nom" style="display: none;">
            <span id="erreur_nom" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ">Nom : <input id="nom" type="text" spellcheck="false" onchange="request(readData, 'nom');">
                <span id="ok_nom" style="display: none;"><img class="icon_preverif" src="../images/ok.png" /></span>
                <span id="ko_nom" style="display: none;"><img class="icon_preverif" src="../images/ko.png" /></span>
            </span><br>
        </div>
        
        <div id="div_champ_erreur_email" style="display: none;">
            <span id="erreur_email" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ">Adresse mail : <input id="email" style="width: 250px;" type="text" spellcheck="false" onchange="request(readData, 'email');">
                <span id="ok_email" style="display: none;"><img class="icon_preverif" src="../images/ok.png" /></span>
                <span id="ko_email" style="display: none;"><img class="icon_preverif" src="../images/ko.png" /></span>
            </span><br>
        </div>
        
        <div id="div_champ_erreur_mdp" style="display: none;">
            <span id="erreur_mdp" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ">Mot de passe : <input id="mdp" type="password" onchange="request(readData, 'mdp');">
                <span id="ok_mdp" style="display: none;"><img class="icon_preverif" src="../images/ok.png" /></span>
                <span id="ko_mdp" style="display: none;"><img class="icon_preverif" src="../images/ko.png" /></span>
            </span><br>
        </div>
        
        <div id="div_champ_erreur_cmdp" style="display: none;">
            <span id="erreur_cmdp" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ">Confirmation de votre mot de passe : <input id="cmdp" type="password" onchange="request(readData, 'cmdp');">
                <span id="ok_cmdp" style="display: none;"><img class="icon_preverif" src="../images/ok.png" /></span>
                <span id="ko_cmdp" style="display: none;"><img class="icon_preverif" src="../images/ko.png" /></span>
            </span><br>
        </div>
        
        <div id="div_champ_erreur_ville" style="display: none;">
            <span id="erreur_ville" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ">Votre ville : <input id="ville" type="text" onchange="request(readData, 'ville');">
                <span id="ok_ville" style="display: none;"><img class="icon_preverif" src="../images/ok.png" /></span>
                <span id="ko_ville" style="display: none;"><img class="icon_preverif" src="../images/ko.png" /></span>
            </span><br>
        </div>
        
        <div id="div_champ_erreur_adresse" style="display: none;">
            <span id="erreur_adresse" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ" style="vertical-align: top;">Votre adresse : <textarea id="adresse" rows=3 cols=40 onchange="request(readData, 'adresse');"></textarea>
                <span id="ok_adresse" style="display: none;"><img class="icon_preverif" src="../images/ok.png" /></span>
                <span id="ko_adresse" style="display: none;"><img class="icon_preverif" src="../images/ko.png" /></span>
            </span><br>
        </div>
        
        <div id="div_champ_erreur_dpt" style="display: none;">
            <span id="erreur_dpt" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ">Votre numéro de département : <input id="dpt" type="number"  min="1" max="95" onchange="request(readData, 'dpt');">
                <span id="ok_dpt" style="display: none;"><img class="icon_preverif" src="../images/ok.png" /></span>
                <span id="ko_dpt" style="display: none;"><img class="icon_preverif" src="../images/ko.png" /></span>
            </span><br>
        </div>
        
    </div> <!-- fin div de class="div_ensemble_champ"-->

    <div class="div_loader">
        <span id="loader" style="display: none;"><img id="img_loader" src="../images/loader.gif" alt="Chargement" /></span>
    </div>

    <div class="div_button">
        <input id="button" type="button" value="S'inscrire" onclick="request2(readData);">
    </div>
</form>
