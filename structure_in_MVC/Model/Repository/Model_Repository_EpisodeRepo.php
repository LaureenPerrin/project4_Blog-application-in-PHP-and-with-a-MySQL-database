<?php
namespace projet4\model\repository;

use projet4\model\repository\EpisodeManager;

require_once("model/repository/Model_Repository_EpisodeManager.php");

class EpisodeRepo extends EpisodeManager
{
    //Créer des épisodes :
    public function createEpisodes($title, $content)
    {
        $createEpisodes = $this->createItemByDataPost($title, $content);
        return $createEpisodes;
    }

    //Récupèrer tous les épisodes du blog :
    public function readEpisodes()
    {
        $readEpisodes = $this->readItems();
        return $readEpisodes;
    }
    
    //Récupèrer un épisodes du blog en fonction de son id :
    public function readEpisode($idEpisode)
    {
        $readEpisode = $this->readById($idEpisode);
        return $readEpisode;
    }
    
    //Modifier un épisodes du blog en fonction de son id :
    public function updateEpisode($title, $content, $idEpisode)
    {
        $updateEpisode = $this->updateItemByDataPost($title, $content, $idEpisode);
        return $updateEpisode;
    }
    
    //Supprimer un épisodes du blog en fonction de son id :
    public function deleteEpisode($idEpisode)
    {
        $delateEpisode = $this->deleteItemById($idEpisode);
        return $delateEpisode;
    }
}
