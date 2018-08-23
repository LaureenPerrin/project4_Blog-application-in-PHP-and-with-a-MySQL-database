<?php

// Chargement des classes
require_once('Model/Entity/Model_Entity_Episode.php');
require_once("Model/Repository/Model_Repository_EpisodeManager.php");
require_once("Model/Repository/Model_Repository_EpisodeRepo.php");
require_once("Model/Repository/Model_Repository_CommentManager.php");
require_once("Model/Repository/Model_Repository_CommentRepo.php");

function listEpisodes()//affiche la liste des posts :
{
    //intanciation objet $postManager :
    $episode = new \projet4\Blog\Model\EpisodeRepo();
    //instanciation objet $episode pour l'utiliser dans p1_listEpisodesView :
    $episodes = $episode->readEpisodes();//récupère tous les derniers épisodes du blog :
    
    require('view/frontend/p1_listEpisodesView.php');
}

function detailsEpisode()
{
    //intanciation objet $postManager :
    $episode = new \projet4\Blog\Model\EpisodeRepo();
    //intanciation objet $commentManager :
    $comment = new \projet4\Blog\Model\CommentRepo();

    //instanciation des objets $post et $comment pour les utiliser dans postView :
    $detailsEpisode = $episode->readEpisode($_GET['idEpisode']);//récupère un épisode précis en fonction de son id :
    $comments = $comment->readComments($_GET['idEpisode']);//récupère les commentaires associés à un ID de post.

    require('view/frontend/p2_detailsEpisodeView.php');
}
