<?php

namespace projet4\Model\Repository;

use projet4\Model\Repository\CommentManager;

require_once("Model/Repository/Model_Repository_CommentManager.php");

class CommentRepo extends CommentManager
{
    public function createComments($idEpisode, $author, $content)//créer des commentaires en fonction d'un épisode :
    {
        $createComments = $this->createItemsByIds($idEpisode, $author, $content);
        return $createComments;
    }

    public function readReportedComment()
    {
        $readReportedComment = $this->readItems();
        return $readReportedComment;
    }

    public function readComments($idEpisode)//récupère tous les commentaires d'un épisode :
    {
        $readComments = $this->readItemsById($idEpisode);
        return $readComments;
    }

    public function readComment($idComment)//récupère un commentaire en fonction de son id :
    {
        $readComment = $this->readById($idComment);
        return $readComment;
    }

    public function isReportedComment($idComment)
    {
        $reportedComment = $this->updateItemById($idComment);
        return $reportedComment;
    }

    public function delateComment($idComment, $idEpisode)
    {
        $delateComment = $this->delateItemByIds($idComment, $idEpisode);
        return $delateComment;
    }

    public function delateComments($idEpisode)
    {
        $delateComments = $this->delateItemsById($idEpisode);
        return $delateComments;
    }
}
