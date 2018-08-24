<?php $title = 'Contact'; ?>

<?php ob_start(); ?>
<h3 id="titleContact">Contact</h3>

<p id="pContact">N'hésitez pas à m'écrire, c'est toujours un plaisir de discuter avec mes fans !</p>

<div id="envelopeRow" class="row">
    <i id="envelopeContact" class="fas fa-envelope"></i>
    <p id="adressContact">Jean Forteroche
        <br> 5 rue du roman d'aventure
        <br> XXXX Mountain</p>
</div>

<div id="mailRow" class="row">
    <i id="mailContact" class="fas fa-at"></i>
    <a id="linkContact" href="mailto:jean.forteroche@roman.fr">jean.forteroche@roman.fr</a>
</div>

<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('template_frontend.php');
