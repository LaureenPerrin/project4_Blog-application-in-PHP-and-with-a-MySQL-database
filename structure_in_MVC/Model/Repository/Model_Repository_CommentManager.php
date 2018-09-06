<?php
namespace projet4\Model\Repository;

use projet4\Model\Repository\Manager;
use projet4\Model\Interfaces\Creatable;
use projet4\Model\Interfaces\Readable;
use projet4\Model\Interfaces\Delatable;

require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interfaces/Model_Interface_Creatable.php");
require_once("Model/Interfaces/Model_Interface_Readable.php");
require_once("Model/Interfaces/Model_Interface_Delatable.php");

 abstract class CommentManager extends Manager implements Creatable, Readable, Delatable
 {
     /*fonctions pour interface creatable----*/
     public function createItemsByIds($idEpisode, $author, $content)
     {
         $db = $this->dbConnect();
         $comments = $db->prepare('INSERT INTO comments(idEpisode, author, content, addDate) VALUES(?, ?, ?, NOW())');
         $affectedLines = $comments->execute(array($idEpisode, $author, $content));
     
         return $affectedLines;
     }

     public function createItemByDataPost($titleItem, $contentItem)
     {
     }
        
     /*fonctions pour interface readable----*/
     public function readItems()
     {
     }
   
     public function readItemsById($idEpisode)//pour lire tous les commentaires d'un épisode en fonction de son id :
     {
         $db = $this->dbConnect();
         $comments = $db->prepare('SELECT idComment, idEpisode, author, content, DATE_FORMAT(addDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addDate_fr FROM comments WHERE idEpisode = ? ORDER BY addDate DESC');
         $comments->execute(array($idEpisode));

         return $comments;
     }
     
     public function readById($idComment)//récupère un commentaire précis en fonction de son id :
     {
         $db = $this->dbConnect();
         $req = $db->prepare('SELECT idComment, author, content, DATE_FORMAT(addDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addDate_fr FROM comments WHERE idComment = ?');
         $req->execute(array($idComment));
         $comment = $req->fetch();
 
         return $comment;
     }

     /*fonctions pour interface delatable----*/
     public function delateItemByIds($idComment, $idEpisode)
     {
         $db = $this->dbConnect();
         $delateComment = $db->prepare('DELETE FROM comments WHERE idComment = ? AND idEpisode = ?');
         $delateComment->execute(array($idComment, $idEpisode));
    
         return $delateComment;
     }

     public function delateItemById($idMainItem)
     {
     }

     public function delateItemsById($idEpisode)
     {
         $db = $this->dbConnect();
         $delateComments = $db->prepare('DELETE FROM comments WHERE idEpisode = ?');
         $delateComments->execute(array($idEpisode));
     
         return $delateComments;
     }
 }
