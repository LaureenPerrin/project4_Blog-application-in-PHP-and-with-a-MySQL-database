<?php

Use \projet4\Model\Repository\EpisodeRepo;
use \projet4\Model\Repository\AdminRepo;
use \projet4\Model\Repository\CommentRepo;
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
    private $_episode;
    private $_comment;
    private $_admin;

    public function __construct()
    {
        $this->_episode = new EpisodeRepo();
        $this->_comment = new CommentRepo();
        $this->_admin = new AdminRepo();
    }

    public function formConnectionAdmin()
    {
        
        require('view/backend/connectionAdminView.php');
       /* 
        if (isset($_POST) and isset($_POST['pseudo']) and isset($_POST['password'])) {
            $routeBackend->connectionAdmin($_POST['pseudo'], $_POST['password']);
if (!empty(htmlspecialchars($_POST['pseudo']) AND !empty($_POST['password']))) {
            $passwordHash = password_hash($postPassword, PASSWORD_DEFAULT);
            $connectionAdmin = $this->_admin->readAdmin($postName, $postPassword);//$postName, $postPassword
            if ($connectionAdmin) {
                $_SESSION['admin'] = $_POST['pseudo'];
                header('Location: index.php?action=listEpisodesAdmin');
            } else {
                $error = 'Identifiants incorrects';
            }
        } else {
            $error = 'Veuillez remplir tous les champs !';
        }
    }
        if (isset($error)) {
             echo $error;
         } 
        require('view/backend/connectionAdminView.php');*/
    }

    /*public function listEpisodesAdmin()//affiche la liste des épisodes :
    {
        $episodes = $this->_episode->readEpisodes();//récupère tous les derniers épisodes du blog :
        require('view/backend/listEpisodesAdminView.php');
    }*/

}
