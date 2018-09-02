<?php

namespace projet4\Model\Entity;

class Admin
{
    private $_idAdmin;
    private $_pseudo;
    private $_password;

    public function __construct()
    {
        $this->hydrate();
    }

    public function hydrate()
    {
    }

    public function PasswordVerification($passMembre, $passHash)
    {
        return password_verify($passMembre, $passHash);
    }

    //fonctions getters
    public function getIdAdmin()
    {
        return $this->_idAdmin;
    }

    public function getPseudo()
    {
        return $this->_pseudo;
    }

    public function getPassword()
    {
        return $this->_password;
    }
}
