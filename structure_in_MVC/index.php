<?php
require('controller/frontend.php');

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listEpisodes') {
            listEpisodes();
        } elseif ($_GET['action'] == 'episode') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                episode();
            } else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    } else {
        listEpisodes();
    }
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
