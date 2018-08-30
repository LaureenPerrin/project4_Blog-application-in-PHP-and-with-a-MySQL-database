<?php

// Chargement des classes :
require_once('Model/Entity/Model_Entity_Episode.php');
require_once("Model/Repository/Model_Repository_EpisodeManager.php");
require_once("Model/Repository/Model_Repository_EpisodeRepo.php");
require_once("Model/Repository/Model_Repository_CommentManager.php");
require_once("Model/Repository/Model_Repository_CommentRepo.php");

class ControllerFrontend
{
    private $_episode;
    private $_comment;

    public function __construct()
    {
        $this->_episode = new \projet4\Blog\Model\EpisodeRepo();
        $this->_comment = new \projet4\Blog\Model\CommentRepo();
    }

    public function listEpisodes()//affiche la liste des épisodes :
    {
        $episodes = $this->_episode->readEpisodes();//récupère tous les derniers épisodes du blog :
        require('view/frontend/listEpisodesView.php');
    }

    public function detailsEpisode()//affiche un épisode en détail avec ses commentaires :
    {
        if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) {
            $detailsEpisode = $this->_episode->readEpisode($_GET['idEpisode']);//récupère un épisode précis en fonction de son id :
            $comments = $this->_comment->readComments($_GET['idEpisode']);//récupère les commentaires associés à un ID d'épisode :
            require('view/frontend/detailsEpisodeView.php');
        } else {
            // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }

    public function addComment($idEpisode, $author, $content)//ajoute un commmmentaire à un épisode et reste affiché sur la page actuelle :
    {
        if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['content'])) {
                $insertComment = $this->_comment->createComments($idEpisode, $author, $content);//insérer un commentaire :
                header('Location: index.php?action=detailsEpisode&idEpisode=' . $idEpisode);
            } else {
                // Autre exception
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } else {
            // Autre exception
            throw new Exception('Aucun identifiant d\'épisode envoyé');
        }
    }

    public function getWriterContact()//Contacter l'écrivain :
    {
        require('view/frontend/contactView.php');
    }
}
