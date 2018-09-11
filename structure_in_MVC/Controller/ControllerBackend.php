<?php

if (!isset($_SESSION['admin'])) {
    session_start();
}
  
use \projet4\Model\Repository\EpisodeRepo;
use \projet4\Model\Repository\AdminRepo;
use \projet4\Model\Repository\CommentRepo;
use \projet4\Services\PasswordVerificationService;
use \projet4\Services\CheckSessionLoginService;

// Chargement des classes :
require_once("Model/Repository/Model_Repository_EpisodeManager.php");
require_once("Model/Repository/Model_Repository_EpisodeRepo.php");
require_once("Model/Repository/Model_Repository_CommentManager.php");
require_once("Model/Repository/Model_Repository_CommentRepo.php");
require_once("Model/Repository/Model_Repository_AdminManager.php");
require_once("Model/Repository/Model_Repository_AdminRepo.php");
require_once("Services/Services_PasswordVerificationService.php");
require_once("Services/Services_CheckSessionLoginService.php");

class ControllerBackend
{
    private $_episode;
    private $_comment;
    private $_admin;

    public function __construct()
    {
        $this->_episode = new EpisodeRepo();
        $this->_comment = new CommentRepo();
        $this->_admin = new AdminRepo();
    }

    //Afficher le formulaire de connexion de l'espace administrateur :
    public function formConnectionAdmin()
    {
        require('view/backend/connectionAdminView.php');
    }

    //Se connecter à l'espace administrateur :
    public function connectionAdmin()
    {
        $admin = $this->_admin->readAdmin();
        //Récupérer les données de l'admin :
        $dataBaseAdmin = $admin->fetch();
        if (isset($_POST) and isset($_POST['pseudo']) and isset($_POST['password']) and !empty(htmlspecialchars($_POST['pseudo'])) and !empty(htmlspecialchars($_POST['password']))) {
            //Créer des variable de session quand celle-ci est activée :
            $_SESSION['admin'] = $dataBaseAdmin['pseudo'];
            $_SESSION['idSession'] = '1';
            //Appeller les fonctions statiques des middlewares pour accéder au backend :
            $isIdSessionCorrect = CheckSessionLoginService::IdSessionVerification($_SESSION['idSession'], $dataBaseAdmin['idSession']);
            $isCorrectPassword = PasswordVerificationService::isPasswordCorrect($_POST['password'], $dataBaseAdmin['password']);
            $isCorrectPseudo = PasswordVerificationService::isPseudoCorrect($_POST['pseudo'], $dataBaseAdmin['pseudo']);
            if ($isIdSessionCorrect) {
                if ($isCorrectPseudo and $isCorrectPassword) {
                    header('Location: index.php?action=listEpisodesAdmin');
                } else {
                    $error = "Identifiants incorrects !" ;
                }
            } else {
                $error = "Impossible de se connecter à l'espace adminitrateur !";
            }
        } else {
            $error = "Veuillez remplir tous les champs s'il vous plaît !";
        }
        require('view/backend/connectionAdminView.php');
    }

    //Afficher la liste des épisodes :
    public function listEpisodesAdmin()
    {
        //Récupèrer tous les derniers épisodes du blog :
        $episodes = $this->_episode->readEpisodes();
        require('View/backend/listEpisodesAdminView.php');
    }

    //Se déconnecter de l'espace administrateur :
    public function logoutAdmin()
    {
        $_SESSION = array();
        session_destroy();
        $error = "vous êtes maintenant déconnecté.";
        require('view/backend/connectionAdminView.php');
    }
    
    //Afficher la vue pour modifier ou supprimer un épisode :
    public function updateEpisodeView()
    { 
        if (isset($_GET['idEpisode']) && $_GET['idEpisode'] > 0) {
            //Récupèrer un épisode précis en fonction de son id :
            $detailsEpisode = $this->_episode->readEpisode($_GET['idEpisode']);
            //Récupèrer les commentaires associés à un ID d'épisode :
            $comments = $this->_comment->readComments($_GET['idEpisode']);
            require('view/backend/updateEpisodesView.php');
        } else {
            throw new Exception('Aucun identifiant d\'épisode envoyé');
        }
 
    }
    
    //Afficher le formulaire pour ajouter un épisode :
    public function adminFormToAddEpisode()
    {
        require('view/backend/addEpisodesView.php');
    }
    
    //Ajouter un épisode :
    public function addEpisode($title, $content)
    {
        if (isset($_SESSION) and isset($_SESSION['idSession']) and $_SESSION['idSession'] == $dataBaseAdmin['idSession']) {
            if (isset($_POST) and !empty(htmlspecialchars($_POST['title'])) and !empty(htmlspecialchars($_POST['content']))) {
                if (strlen($_POST['title']) <= 100) {
                    //Insérer un épisode :
                    $insertEpisode = $this->_episode->createEpisodes($title, $content);
                    header('Location: index.php?action=listEpisodesAdmin');
                } else {
                    throw new Exception('Titre ou contenu de l\'épisode incorrects.');
                }
            } else {
                throw new Exception('Veuillez remplir tous les champs s\'il vous plaît !');
            }
        } else {
            throw new Exception('Vous n\'avez pas les droits suffisants pour accéder à cette page');
        }
    }

    public function deleteComment($idComment, $idEpisode)
    {
        if (isset($_GET['idEpisode'])) {
            if ($_GET['idEpisode'] > 0) {
                if (isset($_GET['idComment']) and $_GET['idComment'] > 0) {
                    $comments = $this->_comment->deleteComment($idComment, $idEpisode);
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

    public function deleteEpisode($idEpisode)
    {
        if (isset($_GET['idEpisode'])) {
            if ($_GET['idEpisode'] > 0) {
                $detailsEpisode = $this->_episode->deleteEpisode($idEpisode);
                $comments = $this->_comment->deleteComments($idEpisode);
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
    
    //Afficher les commentaires signalés :
    public function reportedCommentsView()
    {
        //Récupèrer les commentaires signalés :
        $comments = $this->_comment->readReportedComment();
        require('view/backend/reportedCommentsView.php');
    }
    
    //Modérer les commentaires :
    public function moderatedComment($idComment)
    {
        $admin = $this->_admin->readAdmin();
        $dataBaseAdmin = $admin->fetch();
        //Si une session est bien active :
        if (session_status() === PHP_SESSION_ACTIVE) {
            //if (session_id() == $dataBaseAdmin['idSession']) {
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
            /*} else {
                throw new Exception('Vous n\'avez pas les droits suffisants !');
            }*/
        } else {
            throw new Exception('Aucune session d\'activée !');
        }
    }
    
    //Publier les commentaires :
    public function publishedComments($idComment)
    {
        $admin = $this->_admin->readAdmin();
        $dataBaseAdmin = $admin->fetch();
        if (session_status() === PHP_SESSION_ACTIVE) {
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
            throw new Exception('Aucune session d\'activée !');
        }
    }
}
