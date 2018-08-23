<?php

namespace projet4\Blog\Model;

//lien pour la class Episode dont hérite la class EpisodeRepo :
require_once("Model/Repository/Model_Repository_CommentManager.php");

class CommentRepo extends CommentManager
{
    public function readComments($idEpisode)//récupère tous les commentaires d'un épisode :
    {
        $readComments = $this->readItems($idEpisode);
        return $readComments;
    }

    public function readComment($idComment)//récupère un commentaire en fonction de son id :
    {
        $readComment = $this->readById($idComment);
        return $readComment;
    }
}