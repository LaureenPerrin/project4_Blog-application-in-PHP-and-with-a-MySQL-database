<?php

namespace projet4\Model\Repository;

use projet4\Model\Repository\EpisodeManager;

require_once("Model/Repository/Model_Repository_EpisodeManager.php");

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
    public function updateEpisode($content, $idEpisode)
    {
        $updateEpisode = $this->updateItemByIds($content, $idEpisode);
        return $updateEpisode;
    }
    
    //Supprimer un épisodes du blog en fonction de son id :
    public function delateEpisode($idEpisode)
    {
        $delateEpisode = $this->delateItemById($idEpisode);
        return $delateEpisode;
    }
}
