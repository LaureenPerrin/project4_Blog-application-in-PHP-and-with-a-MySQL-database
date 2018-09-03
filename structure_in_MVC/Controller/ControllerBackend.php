<?php

use \projet4\Model\Repository\EpisodeRepo;
use \projet4\Model\Repository\AdminRepo;
use \projet4\Model\Repository\CommentRepo;
use \projet4\Model\Entity\Admin;

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
    private $_adminEntity;

    public function __construct()
    {
        $this->_episode = new EpisodeRepo();
        $this->_comment = new CommentRepo();
        $this->_admin = new AdminRepo();
        $this->_adminEntity = new Admin();
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
}
