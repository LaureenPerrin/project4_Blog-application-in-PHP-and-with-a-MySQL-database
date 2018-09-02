<?php

namespace projet4\Model\Repository;

abstract class Manager //implémentaion de la class Manager pour factorisation du code car $db commun aux deux managers (EpisodeManager et CommentManager):
{
    protected function dbConnect()//connexion à la bdd :
    {
        $db = new \PDO('mysql:host=localhost;dbname=blogjf;charset=utf8', '....', '...');//disponible dans fichier .gitignore
        return $db;
    }
}
