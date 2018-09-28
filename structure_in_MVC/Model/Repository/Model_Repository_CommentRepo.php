<?php
namespace projet4\model\repository;

use projet4\model\repository\CommentManager;

require_once("model/repository/Model_Repository_CommentManager.php");

class CommentRepo extends CommentManager
{
    //Créer des commentaires en fonction d'un épisode :
    public function createComments($idEpisode, $author, $content)
    {
        $createComments = $this->createItemsByIds($idEpisode, $author, $content);
        return $createComments;
    }
    
    //Récupérer les commentaires signalés :
    public function readReportedComment()
    {
        $readReportedComment = $this->readItems();
        return $readReportedComment;
    }
    
    //Récupèrer tous les commentaires d'un épisode :
    public function readComments($idEpisode)
    {
        $readComments = $this->readItemsById($idEpisode);
        return $readComments;
    }
    
    //Récupèrer un commentaire en fonction de son id :
    public function readComment($idComment)
    {
        $readComment = $this->readById($idComment);
        return $readComment;
    }
    
    //Signaler les commentaires :
    public function isReportedComment($idEpisode, $idComment)
    {
        $reportedComment = $this->updateItemByIds($idEpisode, $idComment);
        return $reportedComment;
    }
    
    //Modérer les commentaires signalés par les lecteurs :
    public function isModerateComment($idComment)
    {
        $moderateComment = $this->updateItemById($idComment);
        return $moderateComment;
    }

    //Publier les commentaires modérés :
    public function isPublishedComment($idComment)
    {
        $publishedComment = $this->updateItemByDataGet($idComment);
        return $publishedComment;
    }
    
    //Supprimer un commentaire :
    public function deleteComment($idComment, $idEpisode)
    {
        $deleteComment = $this->deleteItemByIds($idComment, $idEpisode);
        return $deleteComment;
    }
}
