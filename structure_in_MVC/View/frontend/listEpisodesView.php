<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<img src="public/images/alaska2.jpg" alt="payasage alaska" />
<h1>Bonjour et bienvenue chers lecteurs!</h1>
<p>Grâce à mon blog vous pouvez découvrir, au fur et mesure de sa création, mon nouveau roman "Billet simple pour l'Alaska".
    Je publierais régulièrement mes épisodes et j'attends vos commentaires qui me permettront de réaliser le meilleur livre
    de ma carrière !</p>
<p class="authorName">Jean FORTEROCHE</p>

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
        <a href="index.php?action=detailsEpisode&amp;idEpisode=<?= $data['idEpisode'] ?>">Lire</a>
    </em>
</div>
<?php
}
$episodes->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<!--lien pour faire apparaitre variables $content et $title dans le template :-->
<?php require('template_frontend.php');
