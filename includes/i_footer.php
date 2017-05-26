<?php
/**
  Crée le 17/05/17
  Auteur : Antoine Parant
  Nom de l'include : i_footer
  Rôle : include du footer général
 */
?>
    <link href="../css/i_footer.css" rel="stylesheet" type="text/css"/>
    
<footer>
        <div class="up_footer">
            <img class="logo_footer_hay" onclick="window.open('http://hayfrancecompany.com')" src="../images/LOGO-COULEUR-220X140-PX-footer.png" alt=""/>
            <img class="logo_footer_facebook" onclick="window.open('https://www.facebook.com/hayfrancecompany/')" src="../images/facebook.png" alt=""/>
            <div id="pages_redirection">
                <a class="up_footer_content" href="../pages/faq.php">FAQ</a>
                <a class="up_footer_content" href="../pages/mentions.php">Mentions Légales</a>
                <a class="up_footer_content" href="../pages/conditions.php">Conditions Générales</a>
                <a class="up_footer_content" href="http://hayfrancecompany.com/contact/" target="blank">Nous Contacter</a>
            </div>
        </div>
        <div class="down_footer">
            <span class="down_footer_content">© <?php echo date("Y") ?> Douliere Hay France Company SAS - Tous droits réservés </span>
        </div>
</footer>