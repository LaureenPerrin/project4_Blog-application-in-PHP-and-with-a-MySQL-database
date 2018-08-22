<?php
//gestionnaire d'épisode de blog :
namespace projet4\Blog\Model;

//lien pour la class Manager dont hÃ©rite la class PostManager :
require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interface/Model_Interface_Readable.php");


//pour gÃ©rer les épisodes :
 abstract class EpisodeManager extends Manager implements Readable
 {
     public function readItems()
     {
         $db = $this->dbConnect();
         $req = $db->query('SELECT idEpisode, title, content, DATE_FORMAT(episodeDate, \'%d/%m/%Y à  %Hh%imin%ss\') AS episodeDate_fr FROM episodes ORDER BY episodeDate');

         return $req;
     }
     
     public function readById($postId)//récupère un épsode précis en fonction de son id :
     {
         $db = $this->dbConnect();
         $req = $db->prepare('SELECT idEpisode, title, content, DATE_FORMAT(episodeDate, \'%d/%m/%Y à %Hh%imin%ss\') AS episodeDate_fr FROM episodes WHERE idEpisode = ?');
         $req->execute(array($postId));
         $episode = $req->fetch();

         return $episode;
     }
 }
