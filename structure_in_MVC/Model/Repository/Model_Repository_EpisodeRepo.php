<?php

namespace projet4\Blog\Model;

//lien pour la class Episode dont hérite la class EpisodeRepo :
require_once("Model/Repository/Model_Repository_EpisodeManager.php");

class EpisodeRepo extends EpisodeManager
{
    public function readEpisodes()//récupère tous épisodes du blog :
    {
        $readEpisodes = $this->readItems();
        return $readEpisodes;
    }

    public function readEpisode($Id)//récupère tous épisodes du blog :
    {
        $readEpisode = $this->readById($Id);
        return $readEpisode;
    }
}
