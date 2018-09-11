<?php
namespace projet4\Model\Repository;

use projet4\Model\Repository\Manager;
use projet4\Model\Interfaces\Creatable;
use projet4\Model\Interfaces\Readable;
use projet4\Model\Interfaces\Deletable;

require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interfaces/Model_Interface_Creatable.php");
require_once("Model/Interfaces/Model_Interface_Readable.php");
require_once("Model/Interfaces/Model_Interface_Deletable.php");

 abstract class CommentManager extends Manager implements Creatable, Readable, Deletable
 {
     /*fonctions pour interface creatable----*/
     public function createItemsByIds($idEpisode, $author, $content)
     {
         $db = $this->dbConnect();
         
         $sql = $db->prepare("INSERT INTO comments(`idEpisode`, `author`, `content`, `addDate`, `isReported`, `isModerate`) VALUES (:idEpisode, :author, :content, NOW(), '0', '0')");
         $sql->bindParam(':idEpisode', $idEpisode, \PDO::PARAM_INT);
         $sql->bindParam(':author', $author, \PDO::PARAM_STR);
         $sql->bindParam(':content', $content, \PDO::PARAM_STR);
         $sql->execute();
         return $sql;
     }

     public function createItemByDataPost($titleItem, $contentItem)
     {
     }
        
     /*fonctions pour interface readable----*/
     public function readItems()
     {
         $db = $this->dbConnect();
         $comments = $db->prepare('SELECT idComment, idEpisode, author, content, DATE_FORMAT(addDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addDate_fr, isReported, isModerate FROM comments WHERE isReported = ?  ORDER BY addDate DESC');
         $comments->execute(array('1'));

         return $comments;
     }
   
     public function readItemsById($idEpisode)//pour lire tous les commentaires d'un épisode en fonction de son id :
     {
         $db = $this->dbConnect();
         $comments = $db->prepare('SELECT idComment, idEpisode, author, content, DATE_FORMAT(addDate, \'%d/%m/%Y à %Hh%imin%ss\') AS addDate_fr, isReported, isModerate FROM comments WHERE idEpisode = ? ORDER BY addDate DESC');
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

     /*fonctions pour interface updatable----*/
     public function updateItemByIds($idEpisode, $idComment)
     {
         var_dump($idEpisode);
         $db = $this->dbConnect();
         $req = $db->prepare("UPDATE `comments` SET `isReported` = '1' WHERE `idComment` = :valueid AND `idEpisode` = :valueidEpisode");
         $req->bindParam(':valueid', $idComment);
         $req->bindParam(':valueidEpisode', $idEpisode);
         $req->execute();
         
         return $req;
     }
 
     public function updateItemById($idComment)
     {
         $db = $this->dbConnect();
         $req = $db->prepare("UPDATE `comments` SET `isModerate` = '1' WHERE `idComment` = :valueid");
         $req->bindParam(':valueid', $idComment);
         $req->execute();
         return $req;
     }

     public function updateItemByDataGet($idComment)
     {
         $db = $this->dbConnect();
         $req = $db->prepare("UPDATE `comments` SET isReported = '0', isModerate = '0' WHERE `idComment` = :valueid");
         $req->bindParam(':valueid', $idComment);
         $req->execute();
         return $req;
     }

     /*fonctions pour interface delatable----*/
     public function deleteItemByIds($idComment, $idEpisode)
     {
         $db = $this->dbConnect();
         $deleteComment = $db->prepare('DELETE FROM comments WHERE idComment = ? AND idEpisode = ?');
         $deleteComment->execute(array($idComment, $idEpisode));
    
         return $deleteComment;
     }

     public function deleteItemById($idMainItem)
     {
     }

     public function deleteItemsById($idEpisode)
     {
         $db = $this->dbConnect();
         $deleteComments = $db->prepare('DELETE FROM comments WHERE idEpisode = ?');
         $deleteComments->execute(array($idEpisode));
     
         return $deleteComments;
     }
 }
