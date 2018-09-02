<?php
require('Controller/ControllerFrontend.php');
require('Controller/ControllerBackend.php');

try {
    $routeFrontend = new ControllerFrontend();
    $routeBackend = new ControllerBackend();
    
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listEpisodes') {
            $routeFrontend->listEpisodes();
        } elseif ($_GET['action'] == 'detailsEpisode') {
            $routeFrontend->detailsEpisode();
        } elseif ($_GET['action'] == 'addComment') {
            $routeFrontend->addComment($_GET['idEpisode'], $_POST['author'], $_POST['content']);
        } elseif ($_GET['action'] == 'getWriterContact') {
            $routeFrontend->getWriterContact();
       } elseif ($_GET['action'] == 'formConnectionAdmin') {
       $routeBackend->formConnectionAdmin();
       }
    } else {
        $routeFrontend->listEpisodes();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
