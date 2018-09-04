<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h2>Liste des épisodes</h2>
<?php
while ($data = $episodes->fetch()) {
    ?>
<div class="episodes">
    <h3>
        <em>
            <?= htmlspecialchars($data['title']) ?>
        </em>
    </h3>

    <p>
        <?php
        $extract = substr(nl2br(htmlspecialchars($data['content'])), 0, 500);
    $space = strrpos($extract, ' ');
    echo substr($extract, 0, $space) . '...'; ?>
        <br />

    </p>
    <em>
        <a href="index.php?action=updateEpisodeView&amp;idEpisode=<?= $data['idEpisode'] ?>">Mettre
            à jour</a>
    </em>



</div>
<?php
}

$episodes->closeCursor();
?>
<em>
    <a href="index.php?action=adminFormToAddEpisode">Ajouter un épisode</a>
</em>
<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('template_backend.php');
