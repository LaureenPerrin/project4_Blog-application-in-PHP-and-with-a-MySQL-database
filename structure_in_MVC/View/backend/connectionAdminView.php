<?php $title = 'Espace administrateur'; ?>

<?php ob_start(); ?>

<h1 class="titleConnectAdmin">Espace administrateur</h1>
<?php 
 if (isset($error)) {
     echo '<div class="error">' . $error . '</div>';
 }
     ?>
<div class="connection">

    <form class="formConnectionAdmin" action="index.php?action=connectionAdmin" method="post">

        <div id="pseudoAdmin" class="addComment">
            <label for="pseudo">Identifiant :</label>
            <br />
            <input type="text" id="pseudo" name="pseudo" />
        </div>
        <div id="passwordAdmin" class="addComment">
            <label for="password">Mot de passe :</label>
            <br />
            <input type="password" id="password" name="password" />
        </div>
        <div id="buttonConnectionAdmin">
            <input type="submit" value="Connexion" />
        </div>
    </form>

</div>


<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('view/frontend/template_frontend.php');
