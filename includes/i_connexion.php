<form id="formulaire">
    <div class="div_titre">
    </div>

    <div class="div_erreur_validation">
        <span id="erreur_connexion" class="champ_erreur" style="display: none;"></span>
        <span id="validation_connexion" class="champ_validation" style="display: none;"></span>
    </div>

    <div class="div_ensemble_champ">

        <div id="div_champ_erreur_email_connexion" style="display: none;">
            <span id="erreur_email_connexion" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ">Adresse mail : <input id="email_connexion" type="text" spellcheck="false" onchange="request_connexion(readData_connexion, 'email_connexion');">
                <span id="ok_email_connexion" style="display: none;"><img class="icon_preverif" src="../images/ok.png"/></span>
                <span id="ko_email_connexion" style="display: none;"><img class="icon_preverif" src="../images/ko.png"/></span>
            </span><br>
        </div>

        <div id="div_champ_erreur_mdp_connexion" style="display: none;">
            <span id="erreur_mdp_connexion" class="champ_erreur"></span><br>
        </div>
        <div class="div_champ">
            <span class="champ">Mot de passe : <input id="mdp_connexion" type="password" onchange="request_connexion(readData_connexion, 'mdp_connexion');">
                <span id="ok_mdp_connexion" style="display: none;"><img class="icon_preverif" src="../images/ok.png"/></span>
                <span id="ko_mdp_connexion" style="display: none;"><img class="icon_preverif" src="../images/ko.png"/></span>
            </span><br>
        </div>
    </div>

    <div class="div_loader_connexion">
        <span id="loader_connexion" style="display: none;"><img id="img_loader" src="../images/loader.gif" alt="Chargement" /></span>
    </div>

    <div class="div_button">
        <input id="button_connexion" type="button" value="Se connecter" onclick="request2_connexion(readData_connexion);">
    </div>
</form>

