<?php

// Chargement des classes
require_once('Model/Entity/Model_Entity_Episode.php');
require_once("Model/Repository/Model_Repository_EpisodeManager.php");
require_once("Model/Repository/Model_Repository_EpisodeRepo.php");

function listEpisodes()//affiche la liste des posts :
{
    //intanciation objet $postManager :
    $episode = new \projet4\Blog\Model\EpisodeRepo();
    //instanciation objet $episode pour l'utiliser dans p1_listEpisodesView :
    $episodes = $episode->readEpisodes();//récupère tous les derniers épisodes du blog :
    
    require('view/frontend/p1_listEpisodesView.php');
}

function episode()
{
    //intanciation objet $postManager :
    $episodeManager = new \projet4\Blog\Model\EpisodeRepo();
    //intanciation objet $commentManager :
    //$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    //instanciation des objets $post et $comment pour les utiliser dans postView :
    $episode = $episodeManager->readEpisode($_GET['id']);//récupère un épisode précis en fonction de son id :
    //$comments = $commentManager->getComments($_GET['id']);//récupère les commentaires associés à un ID de post.

    require('view/frontend/episodeView.php');
}
