<?php
//gestionnaire de post de blog :
namespace projet4\Model\Entity;

class Episode
{
    private $_idEpisode;
    private $_title;
    private $_content;
    private $_episodeDate;

    public function __construct()
    {
        $this->hydrate();
    }
    
    public function hydrate()
    {
    }

    public function isValid()
    {
        return !(empty($this->_title) || empty($this->_content));
    }
    
    //fonctions getters
    public function getIdEpisode()
    {
        return $this->_idEpisode;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getEpisodeDate()
    {
        return new \DateTime($this->_episodeDate);
    }
    
    //fonctions setters
    public function setIdEpisode()
    {
        if (is_int($idEpisode) && $idEpisode >= 0) {
            $this->_idEpisode = $idEpisode;
        }
        return $this;
    }

    public function setTitle($title)
    {
        if (is_string($title) && strlen($title) <= 100) {
            $this->_title = $title;
        }
        return $this;
    }

    public function setContent($content)
    {
        $content = htmlspecialchars_decode($content);
        if (is_string($content)) {
            $this->_content = $content;
        }
        return $this;
    }

    public function setEpisodeDate($episodeDate)
    {
        $this->_episodeDate = $episodeDate;
        return $this;
    }
}
