<?php

use \projet4\Model\Repository\EpisodeRepo;
use \projet4\Model\Repository\CommentRepo;

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
        $this->_episode = new EpisodeRepo();
        $this->_comment = new CommentRepo();
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
            throw new Exception('Aucun identifiant d\'épisode envoyé');
        }
    }

    public function addComment($idEpisode, $author, $content)//ajoute un commmmentaire à un épisode et reste affiché sur la page actuelle :
    {
        if (isset($idEpisode) && $idEpisode > 0) {
            if (!empty($_POST['author']) && !empty($_POST['content'])) {
                $affectedLines = $this->_comment->createComments($idEpisode, $author, $content);//insérer un commentaire :
                //si l'objet est false alors on lève un exception :
                if ($affectedLines === false) {
                    throw new Exception('Impossible d\'ajouter le commentaire !');
                } else {
                    header('Location: index.php?action=detailsEpisode&idEpisode=' . $idEpisode);
                }
            }
        } else {
            // Autre exception
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
    }

    public function getWriterContact()//Contacter l'écrivain :
    {
        require('view/frontend/contactView.php');
    }

    public function reportedComment($idComment)//Signaler un commentaire :
    {
        if (isset($idComment) && $idComment > 0) {
            var_dump($idComment);
            $reportedComment = $this->_comment->isReportedComment($idComment);
            if ($reportedComment === false) {
                throw new Exception('Impossible de signaler le commentaire!');
            } else {
                header('Location: index.php?action=listEpisodes');
            }
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }
    }
}
