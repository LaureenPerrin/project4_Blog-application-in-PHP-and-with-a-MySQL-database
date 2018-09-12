<?php

namespace projet4\model\repository;

use projet4\model\repository\AdminManager;

require_once("model/repository/Model_Repository_AdminManager.php");

class AdminRepo extends AdminManager
{
    //Récupèrer les données de l'admin :
    public function readAdmin()
    {
        $admin = $this->readItems();
        return $admin;
    }
}
