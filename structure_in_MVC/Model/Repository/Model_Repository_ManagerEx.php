<?php
namespace projet4\model\repository;

abstract class Manager
{
    //Se connecter à la bdd :
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blogjf;charset=utf8', '....', '...');//disponible dans fichier .gitignore
        return $db;
    }
}
