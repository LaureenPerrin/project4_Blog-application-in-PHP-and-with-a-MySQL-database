<?php $title = 'Mise à jour épisode'; ?>

<?php ob_start(); ?>

<div id="updateEpisode" class="episodes">
    <h3>Mise à jour de l'épisode</h3>
    <form action="index.php?action=updateEpisode&amp;idEpisode=<?= $detailsEpisode['idEpisode'] ?>"
        method="post">
        <div class="addComment">
            <label id="updateTitleEpisode" for="title">Titre de l'épisode :</label>
            <br />
            <textarea id="titleEpisode" name="title"><?= $detailsEpisode['title'] ?></textarea>
        </div>
        <div class="addComment">
            <label id="updateContentEpisode" for="content">Contenu de l'épisode :</label>
            <br />
            <textarea id="contentEpisode" name="content"><?= $detailsEpisode['content'] ?></textarea>
        </div>
        <div class="buttonUpdateEpisode">
            <input type="submit" value="Modifier" />
        </div>
        <div>
            <a id="delateEpisodeButton" href="index.php?action=deleteEpisode&amp;idEpisode=<?= $detailsEpisode['idEpisode'] ?>"><input
                    type="button" value="Supprimer" /></a>
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
        <?php
        if ($comment['isReported'] === '1' and $comment['isModerate'] === '1') {
            echo '<p class="moderateCommentMessage">Ce commentaire est modéré.</p>';
        } ?>

        <a href="index.php?action=deleteComment&amp;idComment=<?= $comment['idComment'] ?>&amp;idEpisode=<?= $detailsEpisode['idEpisode'] ?>">Supprimer</a>

        <?php
        }
        ?>


    </div>
</div>
<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('template_backend.php');
