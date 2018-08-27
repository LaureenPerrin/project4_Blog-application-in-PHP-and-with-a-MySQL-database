<?php

namespace projet4\Blog\Model;

require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interface/Model_Interface_Readable.php");


//pour gÃ©rer l'admin :
 abstract class AdminManager extends Manager implements Readable
 {
     public function readItem()
     {
     }
 }
