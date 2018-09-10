<?php $title = 'Commentaires signalés'; ?>

<?php ob_start(); ?>

<div id="reportedComment" class="container-fluid">

    <div class="episodes">

        <h3>Commentaires signalés</h3>

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
        <a href="index.php?action=editViewComment&amp;idComment=<?= $comment['idComment'] ?>"><input
                type="button" value="Publier" /></a>
        <a href="index.php?action=moderatedComment&amp;idComment=<?= $comment['idComment'] ?>"><input
                type="button" value="Modérer" /></a>

        <?php
        }
        ?>


    </div>

</div>

<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('template_backend.php');
