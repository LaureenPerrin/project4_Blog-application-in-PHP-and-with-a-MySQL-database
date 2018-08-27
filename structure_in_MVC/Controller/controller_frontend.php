<?php

// Chargement des classes
require_once('Model/Entity/Model_Entity_Episode.php');
require_once("Model/Repository/Model_Repository_EpisodeManager.php");
require_once("Model/Repository/Model_Repository_EpisodeRepo.php");
require_once("Model/Repository/Model_Repository_CommentManager.php");
require_once("Model/Repository/Model_Repository_CommentRepo.php");

function listEpisodes()//affiche la liste des épisodes :
{
    $episode = new \projet4\Blog\Model\EpisodeRepo();
    
    $episodes = $episode->readEpisodes();//récupère tous les derniers épisodes du blog :
    
    require('view/frontend/p1_listEpisodesView.php');
}

function detailsEpisode()//affiche un épisode en détail avec ses commentaires :
{
    $episode = new \projet4\Blog\Model\EpisodeRepo();
    
    $comment = new \projet4\Blog\Model\CommentRepo();

    $detailsEpisode = $episode->readEpisode($_GET['idEpisode']);//récupère un épisode précis en fonction de son id :
    $comments = $comment->readComments($_GET['idEpisode']);//récupère les commentaires associés à un ID d'épisode :

    require('view/frontend/p2_detailsEpisodeView.php');
}

function addComment($idEpisode, $author, $content)//ajoute un commmmentaire à un épisode et reste affiché sur la page actuelle :
{
    $comment = new \projet4\Blog\Model\CommentRepo();
    
    //est ce vraiment utile :
    $insertComment = $comment->createComments($idEpisode, $author, $content);//insérer un commentaire :

    if ($insertComment === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        //sinon on redirige vers le début de cette action :
        header('Location: index.php?action=detailsEpisode&idEpisode=' . $idEpisode);
    }
}


function getWriterContact()
{
    require('view/frontend/p3_contactView.php');
}
