<?php

require('Controller/ControllerFrontend.php');
require('Controller/ControllerBackend.php');

try {
   
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
        } elseif ($_GET['action'] == 'reportedComment') {
            $routeFrontend->reportedComment($_GET['idEpisode'], $_GET['idComment']);

           
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
            $routeBackend->addEpisode(strip_tags($_POST['title']), strip_tags($_POST['content']));
        } elseif ($_GET['action'] == 'deleteComment') {
            $routeBackend->deleteComment($_GET['idComment'], $_GET['idEpisode']);
        } elseif ($_GET['action'] == 'deleteEpisode') {
            $routeBackend->deleteEpisode($_GET['idEpisode']);
        } elseif ($_GET['action'] == 'updateEpisode') {
            $routeBackend->updateEpisode($_POST['content'], $_GET['idEpisode']);
        } elseif ($_GET['action'] == 'reportedCommentsView') {
            $routeBackend->reportedCommentsView();
        } elseif ($_GET['action'] == 'moderatedComment') {
            $routeBackend->moderatedComment($_GET['idComment']);
        } elseif ($_GET['action'] == 'publishedComments') {
            $routeBackend->publishedComments($_GET['idComment']);
        }
    } else {
        $routeFrontend->listEpisodes();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
