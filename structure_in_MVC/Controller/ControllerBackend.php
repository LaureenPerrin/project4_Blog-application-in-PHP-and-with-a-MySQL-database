<?php

use \projet4\Model\Repository\EpisodeRepo;
use \projet4\Model\Repository\AdminRepo;
use \projet4\Model\Repository\CommentRepo;
use \projet4\Model\Entity\Admin;
use \projet4\Model\Entity\Episode;

// Chargement des classes :
require_once('Model/Entity/Model_Entity_Episode.php');
require_once('Model/Entity/Model_Entity_Admin.php');
require_once("Model/Repository/Model_Repository_EpisodeManager.php");
require_once("Model/Repository/Model_Repository_EpisodeRepo.php");
require_once("Model/Repository/Model_Repository_CommentManager.php");
require_once("Model/Repository/Model_Repository_CommentRepo.php");
require_once("Model/Repository/Model_Repository_AdminManager.php");
require_once("Model/Repository/Model_Repository_AdminRepo.php");

class ControllerBackend
{
    private $_episodeEntity;
    private $_episode;
    private $_comment;
    private $_admin;
    private $_adminEntity;

    public function __construct()
    {
        $this->_episode = new EpisodeRepo();
        $this->_comment = new CommentRepo();
        $this->_admin = new AdminRepo();
        $this->_adminEntity = new Admin();
        $this->_episodeEntity = new Episode();
    }

    public function formConnectionAdmin()//Affiche le formulaire de connexion à l'espace administrateur :
    {
        require('view/backend/connectionAdminView.php');
    }

    public function connectionAdmin()//Permet de se connecter à l'espace administrateur :
    {
        $admin = $this->_admin->readAdmin();
        $dataBaseAdmin = $admin->fetch();//récupére les données de l'admin
        if (isset($_POST) and !empty(htmlspecialchars($_POST['pseudo'])) and !empty(htmlspecialchars($_POST['password']))) {
            $isCorrectPassword = $this->_adminEntity->PasswordVerification($_POST['password'], $dataBaseAdmin['password']);
            if (($_POST['pseudo'] == $dataBaseAdmin['pseudo']) and $isCorrectPassword) {
                //Vérifie si l'id de la session créée est bien celui attribué à l'admin :
                if (session_id() == $dataBaseAdmin['idSession']) {
                    header('Location: index.php?action=listEpisodesAdmin');
                } else {
                    $error = "Vous n'avez pas les droits suffisants pour accéder à ces pages.";
                }
            } else {
                $error = "Identifiants incorrects !" ;
            }
        } else {
            $error = "Veuillez remplir tous les champs s'il vous plaît !";
        }
        require('view/backend/connectionAdminView.php');
    }

    public function listEpisodesAdmin()//affiche la liste des épisodes :
    {
        $episodes = $this->_episode->readEpisodes();//récupère tous les derniers épisodes du blog :
        require('View/backend/listEpisodesAdminView.php');
    }

    public function logoutAdmin()//Permet de se déconnecter de l'espace administrateur :
    {
        $_SESSION = array();
        session_destroy();
        $error = "vous êtes maintenant déconnecté.";
        require('view/backend/connectionAdminView.php');
    }

    public function updateEpisodeView()//Vue pour modifier ou supprimer un épisode :
    {
        if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) {
            $detailsEpisode = $this->_episode->readEpisode($_GET['idEpisode']);//récupère un épisode précis en fonction de son id :
            $comments = $this->_comment->readComments($_GET['idEpisode']);//récupère les commentaires associés à un ID d'épisode :
            require('view/backend/updateEpisodesView.php');
        } else {
            throw new Exception('Aucun identifiant d\'épisode envoyé');
        }
    }

    public function adminFormToAddEpisode()//Affiche le formulaire pour ajouter un épisode :
    {
        require('view/backend/addEpisodesView.php');
    }

    public function addEpisodes($title, $content)//Permet d'ajouter un épisode :
    {
        if (isset($_POST) and !empty(htmlspecialchars($_POST['title'])) and !empty(htmlspecialchars($_POST['content']))) {
            if (strlen($_POST['title']) <= 100) {
                $insertEpisode = $this->_episode->createEpisodes($title, $content);//insérer un épisode
                header('Location: index.php?action=listEpisodesAdmin');
            } else {
                throw new Exception('Titre ou contenu de l\'épisode incorrects.');
            }
        } else {
            throw new Exception('Veuillez remplir tous les champs s\'il vous plaît !');
        }
    }

    public function delateComment($idComment, $idEpisode)
    {
        if (isset($_GET['idEpisode'])) {
            if ($_GET['idEpisode'] > 0) {
                if (isset($_GET['idComment']) and $_GET['idComment'] > 0) {
                    $comments = $this->_comment->delateComment($idComment, $idEpisode);
                    header('Location: index.php?action=updateEpisodeView&idEpisode=' . $idEpisode);
                } else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
            } else {
                throw new Exception('Identifiant d\'épisode incorrect');
            }
        } else {
            throw new Exception('Aucun identifiant d\'épisode envoyé');
        }
    }

    public function delateEpisode($idEpisode)
    {
        if (isset($_GET['idEpisode'])) {
            if ($_GET['idEpisode'] > 0) {
                $detailsEpisode = $this->_episode->delateEpisode($idEpisode);
                $comments = $this->_comment->delateComments($idEpisode);
                header('Location: index.php?action=listEpisodesAdmin');
            } else {
                throw new Exception('Identifiant d\'épisode incorrect');
            }
        } else {
            throw new Exception('Aucun identifiant d\'épisode envoyé');
        }
        require('view/backend/updateEpisodesView.php');
    }

    public function updateEpisode($content, $idEpisode)
    {
        if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) {
            if (!empty($_POST['content'])) {
                $newEpisode = $this->_episode->updateEpisode($content, $idEpisode);
 
                if ($newEpisode === false) {
                    throw new Exception('Impossible de modifier l\'épisode !');
                } else {
                    header('Location: index.php?action=updateEpisodeView&idEpisode=' . $idEpisode);
                }
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } else {
            throw new Exception('Aucun identifiant de billet envoyÃ©');
        }
    }

    public function reportedCommentsView()//Vue des commentaires signalés :
    {
        $comments = $this->_comment->readReportedComment();//récupère les commentaires signalés :
        require('view/backend/reportedCommentsView.php');
    }

    public function moderatedComment($idComment)//Permet de modérer les commentaires :
    {
        $admin = $this->_admin->readAdmin();
        $dataBaseAdmin = $admin->fetch();
        if (session_status() === PHP_SESSION_ACTIVE) {//Si une session est bien active
            if (session_id() == $dataBaseAdmin['idSession']) {
                if (isset($idComment) and $idComment > 0) {
                    $moderateComment = $this->_comment->isModerateComment($idComment);
                    if ($moderateComment === false) {
                        throw new Exception('Impossible de modérer le commentaire !');
                    } else {
                        header('Location: index.php?action=reportedCommentsView');
                    }
                } else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
            } else {
                throw new Exception('Vous n\'avez pas les droits suffisants !');
            }
        } else {
            throw new Exception('Aucune session d\'activée !');
        }
    }

    public function publishedComments($idComment)//Permet de modérer les commentaires :
    {
        $admin = $this->_admin->readAdmin();
        $dataBaseAdmin = $admin->fetch();
        if (session_status() === PHP_SESSION_ACTIVE) {//Si une session est bien active
            if (session_id() == $dataBaseAdmin['idSession']) {
                if (isset($idComment) and $idComment > 0) {
                    $moderateComment = $this->_comment->isPublishedComment($idComment);
                    if ($moderateComment === false) {
                        throw new Exception('Impossible de publier le commentaire !');
                    } else {
                        header('Location: index.php?action=reportedCommentsView');
                    }
                } else {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
            } else {
                throw new Exception('Vous n\'avez pas les droits suffisants !');
            }
        } else {
            throw new Exception('Aucune session d\'activée !');
        }
    }
}
