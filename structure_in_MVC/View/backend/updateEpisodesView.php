<?php $title = 'Mise à jour épisode'; ?>

<?php ob_start(); ?>

<div id="updateEpisode" class="episodes">
    <h3>
        <em>le
            <?= $detailsEpisode['episodeDate_fr'] ?>
        </em>
        <?= htmlspecialchars($detailsEpisode['title']) ?>
    </h3>
    <form action="index.php?action=editComment&amp;id=<?= $detailsEpisode['idEpisode'] ?>"
        method="post">
        <div class="addComment">
            <textarea id="contentEpisode" name="content"><?= $detailsEpisode['content'] ?></textarea>
        </div>
        <div class="buttonUpdateEpisode">
            <input type="submit" value="Modifier" />
        </div>
    </form>
</div>

<div id="p3BackendComment" class="container-fluid">

    <div class="episodes">

        <h3>Commentaires</h3>

        <?php
        while ($comment = $comments->fetch()) {
            ?>
        <h4>
            <strong>
                <?= htmlspecialchars($comment['author']) ?>
            </strong> le
            <?= $comment['addDate_fr'] ?>
            <br>
        </h4>

        <p>
            <?= nl2br(htmlspecialchars($comment['content'])) ?>
        </p>

        <a href="index.php?action=editViewComment&amp;id=<?= $comment['idComment'] ?>">Supprimer</a>

        <?php
        }
        ?>


    </div>
</div>
<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('template_backend.php');
