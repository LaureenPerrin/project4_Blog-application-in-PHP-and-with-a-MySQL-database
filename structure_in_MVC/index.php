<?php
require('Controller/ControllerFrontend.php');

try {
    $route = new ControllerFrontend();
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listEpisodes') {
            $route->listEpisodes();
        } elseif ($_GET['action'] == 'detailsEpisode') {
            $route->detailsEpisode();
        } elseif ($_GET['action'] == 'addComment') {
            $route->addComment($_GET['idEpisode'], $_POST['author'], $_POST['content']);
        } elseif ($_GET['action'] == 'getWriterContact') {
            $route->getWriterContact();
        }
    } else {
        $route->listEpisodes();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
