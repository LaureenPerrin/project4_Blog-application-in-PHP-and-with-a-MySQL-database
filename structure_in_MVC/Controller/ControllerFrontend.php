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
    
    //Afficher la liste des épisodes :
    public function listEpisodes()
    {
        //Récupère tous les derniers épisodes du blog :
        $episodes = $this->_episode->readEpisodes();
        require('view/frontend/listEpisodesView.php');
    }
    
    //Afficher un épisode en détail avec ses commentaires :
    public function detailsEpisode()
    {
        if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) {
            //Récupère un épisode précis en fonction de son id :
            $detailsEpisode = $this->_episode->readEpisode($_GET['idEpisode']);
            //Récupère les commentaires associés à un ID d'épisode :
            $comments = $this->_comment->readComments($_GET['idEpisode']);
            require('view/frontend/detailsEpisodeView.php');
        } else {
            throw new Exception('Aucun identifiant d\'épisode envoyé');
        }
    }
    
    public function addComment($idEpisode, $author, $content)
    {
        if (isset($idEpisode) && $idEpisode > 0) {
            if (!empty($_POST['author']) && !empty($_POST['content'])) {
                //Insérer un commentaire :
                $affectedLines = $this->_comment->createComments($idEpisode, $author, $content);
                if ($affectedLines === false) {
                    throw new Exception('Impossible d\'ajouter le commentaire !');
                } else {
                    header('Location: index.php?action=detailsEpisode&idEpisode=' . $idEpisode);
                }
            }
        } else {
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
    }
    
    //Contacter l'écrivain :
    public function getWriterContact()
    {
        require('view/frontend/contactView.php');
    }
    
    //Signaler un commentaire :
    public function reportedComment($idEpisode, $idComment)
    {
        if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) {
            if (isset($idComment)) {
                $reportedComment = $this->_comment->isReportedComment($idEpisode, $idComment);
                if ($reportedComment === false) {
                    throw new Exception('Impossible de signaler le commentaire !');
                } else {
                    header('Location: index.php?action=detailsEpisode&idEpisode=' . $idEpisode);
                }
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } else {
            throw new Exception('Aucun identifiant d\'épisode envoyé');
        }
    }
}
