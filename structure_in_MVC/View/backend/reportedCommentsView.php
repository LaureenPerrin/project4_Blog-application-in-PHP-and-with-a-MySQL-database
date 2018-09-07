<?php $title = 'Commentaires signalés'; ?>

<?php ob_start(); ?>

<div id="p2comment" class="container-fluid">

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

        <a href="index.php?action=editViewComment&amp;id=<?= $comment['idComment'] ?>">Signaler</a>

        <?php
        }
        ?>


    </div>

</div>

<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('template_backend.php');
