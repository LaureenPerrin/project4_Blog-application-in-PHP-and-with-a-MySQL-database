<?php
require('Controller/ControllerFrontend.php');
require('Controller/ControllerBackend.php');



try {
    session_id('1');
    session_start();
    $routeFrontend = new ControllerFrontend();
    $routeBackend = new ControllerBackend();
    
    if (isset($_GET['action'])) {
        /*-----partie frontend----*/
        if ($_GET['action'] == 'listEpisodes') {
            $routeFrontend->listEpisodes();
        } elseif ($_GET['action'] == 'detailsEpisode') {
            $routeFrontend->detailsEpisode();
        } elseif ($_GET['action'] == 'addComment') {
            $routeFrontend->addComment($_GET['idEpisode'], $_POST['author'], $_POST['content']);
        } elseif ($_GET['action'] == 'getWriterContact') {
            $routeFrontend->getWriterContact();
        /*-----partie backend----*/
        } elseif ($_GET['action'] == 'formConnectionAdmin') {
            $routeBackend->formConnectionAdmin();
        } elseif ($_GET['action'] == 'connectionAdmin') {
            $routeBackend->connectionAdmin();
        } elseif ($_GET['action'] == 'listEpisodesAdmin') {
            $routeBackend->listEpisodesAdmin();
        } elseif ($_GET['action'] == 'logoutAdmin') {
            $routeBackend->logoutAdmin();
        } elseif ($_GET['action'] == 'updateEpisodeView') {
            $routeBackend->updateEpisodeView();
        } elseif ($_GET['action'] == 'adminFormToAddEpisode') {
            $routeBackend->adminFormToAddEpisode();
        } elseif ($_GET['action'] == 'addEpisode') {
            $routeBackend->addEpisodes(strip_tags($_POST['title']), strip_tags($_POST['content']));
        }
    } else {
        $routeFrontend->listEpisodes();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
