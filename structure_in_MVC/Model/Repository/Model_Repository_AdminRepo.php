<?php

namespace projet4\Model\Repository;

use projet4\Model\Repository\AdminManager;

require_once("Model/Repository/Model_Repository_AdminManager.php");

class AdminRepo extends AdminManager
{
    //Récupèrer les données de l'admin :
    public function readAdmin()
    {
        $admin = $this->readItems();
        return $admin;
    }
}
