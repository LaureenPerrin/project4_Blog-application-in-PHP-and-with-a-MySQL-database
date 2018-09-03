<?php

namespace projet4\Model\Repository;

use projet4\Model\Repository\Manager;
use projet4\Model\Interfaces\Readable;

require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interfaces/Model_Interface_Readable.php");

//pour gÃ©rer les épisodes :
 abstract class EpisodeManager extends Manager implements Readable
 {
     public function readItems()//récupère tous les épisodes :
     {
         $db = $this->dbConnect();
         $req = $db->query('SELECT idEpisode, title, content, DATE_FORMAT(episodeDate, \'%d/%m/%Y à  %Hh%imin\') AS episodeDate_fr FROM episodes ORDER BY episodeDate');
         return $req;
     }

     public function readItemsById($idItem)
     {
     }
     
     public function readById($idEpisode)//récupère un épisode précis en fonction de son id :
     {
         $db = $this->dbConnect();
         $req = $db->prepare('SELECT idEpisode, title, content, DATE_FORMAT(episodeDate, \'%d/%m/%Y à %Hh%imin\') AS episodeDate_fr FROM episodes WHERE idEpisode = ?');
         $req->execute(array($idEpisode));
         $episode = $req->fetch();

         return $episode;
     }
 }
