<?php

namespace projet4\Model\Repository;

use projet4\Model\Repository\AdminManager;

require_once("Model/Repository/Model_Repository_AdminManager.php");

class AdminRepo extends AdminManager
{
    public function readAdmin($postName, $postPassword)//récupère tous les épisodes du blog :
    {
        $user = $this->readItemByGetPost($postName, $postPassword);
        $admin = $user->fetch();
        return $admin;
    }
}
