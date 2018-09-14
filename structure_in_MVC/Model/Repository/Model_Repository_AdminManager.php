<?php
namespace projet4\model\repository;

use projet4\model\repository\Manager;
use projet4\model\interfaces\Readable;

require_once("model/repository/Model_Repository_Manager.php");
require_once("model/interfaces/Model_Interface_Readable.php");

 abstract class AdminManager extends Manager implements Readable
 {
     /*---fonctions readable interface-----*/
     public function readItems()
     {
         $db = $this->dbConnect();
         $req = $db->query('SELECT * FROM admin WHERE idAdmin = 1');
         return $req;
     }

     public function readItemsById($idItem)
     {
     }

     public function readById($idItem)
     {
     }
 }
