<?php

namespace projet4\Blog\Model;

require_once("Model/Repository/Model_Repository_EpisodeManager.php");

class EpisodeRepo extends EpisodeManager
{
    public function readEpisodes()//récupère tous les épisodes du blog :
    {
        $readEpisodes = $this->readItems();
        return $readEpisodes;
    }

    public function readEpisode($idEpisode)//récupère un épisodes du blog en fonction de son id:
    {
        $readEpisode = $this->readById($idEpisode);
        return $readEpisode;
    }
}
