<?php

namespace projet4\Model\Repository;
use projet4\Model\Repository\Manager;
use projet4\Model\Interfaces\Readable;

require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interfaces/Model_Interface_Readable.php");


//pour gÃ©rer l'admin :
 abstract class AdminManager extends Manager implements Readable
 {
     /*---fonctions readable interface-----*/
     public function readItems()//récupère les données admin :
     {
     }

     public function readItemByGetPost($postName, $postPassword)
     {
         $db = $this->dbConnect();
         $req = $db->prepare('SELECT * FROM admin WHERE pseudo = ? AND password = ?');
         $req->execute(array($postName, $postPassword));

         return $req;
     }

     public function readItemsById($idItem)
     {
     }

     public function readById($idItem)
     {
     }
 }
