<?php $title = 'Épisode détaillé'; ?>

<?php ob_start(); ?>

<div class="episodes">
    <div>
        <h3>
            <em>le
                <?= $detailsEpisode['episodeDate_fr'] ?>
            </em>
            <?= htmlspecialchars($detailsEpisode['title']) ?>
        </h3>

    </div>
    <p>
        <?= nl2br(htmlspecialchars($detailsEpisode['content'])) ?>
        <br />
    </p>

</div>

<div class="episodes">
    <h3>Commentaires</h3>

    <?php
while ($comment = $comments->fetch()) {
    ?>
    <p>
        <strong>
            <?= htmlspecialchars($comment['author']) ?>
        </strong> le
        <?= $comment['addDate_fr'] ?>
        <br>
    </p>

    <p>
        <?= nl2br(htmlspecialchars($comment['content'])) ?>
    </p>

    <a href="index.php?action=editViewComment&amp;id=<?= $comment['idComment'] ?>">Signaler</a>

    <?php
}
?>


</div>



<div class="episodes">

    <h3>Ajouter un commentaire</h3>
    <form action="index.php?action=addComment&amp;id=<?= $detailsEpisode['idEpisode'] ?>"
        method="post">
        <div>
            <label for="author">Auteur :</label>
            <br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="content">Commentaire :</label>
            <br />
            <textarea id="content" name="content"></textarea>
        </div>
        <div>
            <input type="submit" value="Ajouter" />
        </div>
    </form>

</div>


<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('template_frontend.php');
