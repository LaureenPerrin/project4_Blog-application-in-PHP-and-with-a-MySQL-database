<?php

namespace projet4\Model\Entity;

class Comment
{
    private $_idComment;
    private $_idEpisode;
    private $_author;
    private $_content;
    private $_addDate;

    public function __construct($value = array())
    {
        if (!empty($value)) {
            $this->hydrate($value);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $attribut => $value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }
    
    //fonctions getters
    public function getIdComment()
    {
        return $this->_idComment;
    }

    public function getIdEpisode()
    {
        return $this->_idEpisode;
    }

    public function getAuthor()
    {
        return $this->_author;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getAddDate()
    {
        return new \DateTime($this->_addDate);
    }

    
    
    //fonctions setters
    public function setIdComment($idComment)
    {
        if (is_int($idComment) && $idComment >= 0) {
            $this->_idComment = $idComment;
        }
        return $this;
    }

    public function setIdEpisode($idEpisode)
    {
        if (is_int($idEpisode) && $idEpisode >= 0) {
            $this->_idEpisode = $idEpisode;
        }
        return $this;
    }

    public function setAuthor($author)
    {
        if (is_string($author) && strlen($author) <= 70) {
            $this->_author = $author;
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

    public function setAddDate($addDate)
    {
        $this->_addDate = $addDate;
        return $this;
    }
}
