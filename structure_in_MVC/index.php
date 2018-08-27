<?php
require('Controller/controller_frontend.php');

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listEpisodes') {
            listEpisodes();
        } elseif ($_GET['action'] == 'detailsEpisode') {
            if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) {
                detailsEpisode();
            } else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['content'])) {
                    addComment($_GET['idEpisode'], $_POST['author'], $_POST['content']);
                } else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                // Autre exception
                throw new Exception('Aucun identifiant d\'épisode envoyé');
            }
        } elseif ($_GET['action'] == 'getWriterContact') {
            getWriterContact();
        }
    } else {
        listEpisodes();
    }
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
