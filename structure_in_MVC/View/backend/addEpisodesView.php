<?php $title = 'Ajouter un épisode'; ?>
<?php ob_start(); ?>

<div id="formAddEpisode" class="episodes">
    <h3>Ajouter un épisode</h3>

    <form class="formAddComment" action="index.php?action=addEpisode" method="post">

        <div id="titleAddEpisode">
            <label for="title">Titre de l'épisode :</label>
            <br />
            <input type="text" id="title" name="title" />
        </div>
        <div class="addComment">
            <label class="contentAddEpisode" for="content">Contenu de l'épisode :</label>
            <br />
            <textarea class="textAddComment" id="myTextarea" name="content"></textarea>
        </div>
        <div id="publishedButton">
            <input type="submit" value="Publier" />
        </div>
    </form>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template_backend.php');
