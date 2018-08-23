<?php
//gestionnaire des commentaires d'épisodes :
namespace projet4\Blog\Model;

//lien pour la class Manager dont hÃ©rite la class CommentManager :
require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interface/Model_Interface_Readable.php");


//pour gÃ©rer les commentaires :
 abstract class CommentManager extends Manager implements Readable
 {
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
         $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
         $req->execute(array($idComment));
         $comment = $req->fetch();
 
         return $comment;
     }
 }
