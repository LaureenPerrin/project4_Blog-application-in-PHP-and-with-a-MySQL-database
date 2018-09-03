<?php
namespace projet4\Model\Repository;

use projet4\Model\Repository\Manager;
use projet4\Model\Interfaces\Readable;
use projet4\Model\Interfaces\Creatable;

require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interfaces/Model_Interface_Readable.php");
require_once("Model/Interfaces/Model_Interface_Creatable.php");

 abstract class CommentManager extends Manager implements Readable, Creatable
 {
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

     /*fonctions pour interface creatable----*/
     public function createItemsByIds($idEpisode, $author, $content)
     {
         $db = $this->dbConnect();
         $comments = $db->prepare('INSERT INTO comments(idEpisode, author, content, addDate) VALUES(?, ?, ?, NOW())');
         $affectedLines = $comments->execute(array($idEpisode, $author, $content));
  
         return $affectedLines;
     }
 }
