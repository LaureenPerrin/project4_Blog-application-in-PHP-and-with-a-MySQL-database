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


<div id="p2comment" class="container-fluid">

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
        <?php
        if ($comment['isModerate'] === '0') {
            ?>
        <p>
            <?= nl2br(htmlspecialchars($comment['content'])) ?>
        </p>

        <a href="index.php?action=reportedComment&amp;idEpisode=<?= $detailsEpisode['idEpisode'] ?>&amp;idComment=<?= $comment['idComment'] ?>">Signaler</a>
        <?php
        } elseif ($comment['isModerate'] === '1') {
            echo '<p class="moderateCommentMessage">Ce commentaire a été modéré.</p>';
        } ?>
        <?php
        }
        ?>


    </div>
    <div class="episodes">

        <h3>Ajouter un commentaire</h3>
        <form class="formAddComment" action="index.php?action=addComment&amp;idEpisode=<?= $detailsEpisode['idEpisode'] ?>"
            method="post">

            <div>
                <label for="author">Auteur :</label>
                <br />
                <input type="text" id="author" name="author" />
            </div>
            <div class="addComment">
                <label for="content">Commentaire :</label>
                <br />
                <textarea class="textAddComment" id="content" name="content"></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>

    </div>

</div>
<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('template_frontend.php');
