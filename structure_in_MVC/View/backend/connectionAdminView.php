<?php $title = 'Espace administrateur'; ?>

<?php ob_start(); ?>

<h1 class="titleConnectAdmin">Espace administrateur</h1>

<div class="connection">


    <form class="formConnectionAdmin" action="index.php?action=connectionAdmin" method="post">

        <div class="addComment">
            <label for="pseudo">Identifiant :</label>
            <br />
            <input type="text" id="pseudo" name="pseudo" />
        </div>
        <div class="addComment">
            <label for="password">Mot de passe :</label>
            <br />
            <input type="password" id="password" name="password" />
        </div>
        <div>
            <input type="submit" value="Connexion" />
        </div>
    </form>

</div>


<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('View/frontend/template_frontend.php');
