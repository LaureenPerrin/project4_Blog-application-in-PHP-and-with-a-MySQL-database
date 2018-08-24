<?php

// Chargement des classes
require_once('Model/Entity/Model_Entity_Episode.php');
require_once("Model/Repository/Model_Repository_EpisodeManager.php");
require_once("Model/Repository/Model_Repository_EpisodeRepo.php");
require_once("Model/Repository/Model_Repository_CommentManager.php");
require_once("Model/Repository/Model_Repository_CommentRepo.php");

function listEpisodes()//affiche la liste des épisodes :
{
    //intanciation objet $episode :
    $episode = new \projet4\Blog\Model\EpisodeRepo();
    //instanciation objet $episode pour l'utiliser dans p1_listEpisodesView :
    $episodes = $episode->readEpisodes();//récupère tous les derniers épisodes du blog :
    
    require('view/frontend/p1_listEpisodesView.php');
}

function detailsEpisode()//affiche un épisode en détail :
{
    //intanciation objet $episode:
    $episode = new \projet4\Blog\Model\EpisodeRepo();
    //intanciation objet $comment :
    $comment = new \projet4\Blog\Model\CommentRepo();

    //instanciation des objets $detailsEpisode et $comments pour les utiliser dans listEpisodeView :
    $detailsEpisode = $episode->readEpisode($_GET['idEpisode']);//récupère un épisode précis en fonction de son id :
    $comments = $comment->readComments($_GET['idEpisode']);//récupère les commentaires associés à un ID de post.

    require('view/frontend/p2_detailsEpisodeView.php');
}

function addComment($idEpisode, $author, $content)//ajoute un commmmentaire à un épisode et reste affiché sur la page actuelle :
{
    //intanciation objet $comment :
    $comment = new \projet4\Blog\Model\CommentRepo();
    
    //intanciation objet $affectedLines :
    $affectedLines = $comment->createComments($idEpisode, $author, $content);//insérer un commentaire :

    //si l'objet est false alors on lève un exception :
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        //sinon on redirige vers le début de cette action :
        header('Location: index.php?action=detailsEpisode&idEpisode=' . $idEpisode);
    }
}
