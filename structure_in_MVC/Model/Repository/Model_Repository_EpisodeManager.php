<?php

namespace projet4\Model\Repository;

use projet4\Model\Repository\Manager;
use projet4\Model\Interfaces\Creatable;
use projet4\Model\Interfaces\Readable;
use projet4\Model\Interfaces\Updatable;
use projet4\Model\Interfaces\Deletable;

require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interfaces/Model_Interface_Creatable.php");
require_once("Model/Interfaces/Model_Interface_Readable.php");
require_once("Model/Interfaces/Model_Interface_Updatable.php");
require_once("Model/Interfaces/Model_Interface_Delatable.php");

 abstract class EpisodeManager extends Manager implements Creatable, Readable, Deletable, Updatable
 {
     /*fonctions pour interface creatable----*/
     public function createItemsByIds($idEpisode, $author, $content)
     {
     }

     public function createItemByDataPost($title, $content)
     {
         $db = $this->dbConnect();
         $episodes = $db->prepare('INSERT INTO episodes(title, content, episodeDate) VALUES(?, ?, NOW())');
         $affectedLines = $episodes->execute(array($title, $content));
   
         return $affectedLines;
     }

     /*fonctions pour interface readable----*/
     public function readItems()
     {
         $db = $this->dbConnect();
         $req = $db->query('SELECT idEpisode, title, content, DATE_FORMAT(episodeDate, \'%d/%m/%Y à  %Hh%imin\') AS episodeDate_fr FROM episodes ORDER BY idEpisode');
         return $req;
     }

     public function readItemsById($idItem)
     {
     }
     
     public function readById($idEpisode)
     {
         $db = $this->dbConnect();
         $req = $db->prepare('SELECT idEpisode, title, content, DATE_FORMAT(episodeDate, \'%d/%m/%Y à %Hh%imin\') AS episodeDate_fr FROM episodes WHERE idEpisode = ?');
         $req->execute(array($idEpisode));
         $episode = $req->fetch();

         return $episode;
     }
     
     /*fonctions pour interface updatable----*/
     public function updateItemByIds($content, $idEpisode)
     {
         $db = $this->dbConnect();
         $req = $db->prepare("UPDATE `episodes` SET `content` = :valuecontent WHERE `idEpisode` = :valueid");
         $req->bindParam(':valuecontent', $content);
         $req->bindParam(':valueid', $idEpisode);
         $req->execute();
         return $req;
     }

     public function updateItemById($idItem)
     {
     }

     public function updateItemByDataGet($idItem)
     {
     }

     /*fonctions pour interface delatable----*/
     public function deleteItemByIds($idItemSecondary, $idMainItem)
     {
     }
 
     public function deleteItemById($idEpisode)
     {
         $db = $this->dbConnect();
         $deleteEpisode = $db->prepare('DELETE FROM episodes WHERE idEpisode = ?');
         $deleteEpisode->execute(array($idEpisode));
    
         return $deleteEpisode;
     }
     
     public function deleteItemsById($idMainItem)
     {
     }
 }
