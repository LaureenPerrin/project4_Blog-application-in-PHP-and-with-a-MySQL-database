<?php
//pour gérer l'admin :
namespace projet4\Blog\Model;

//lien pour la class Manager dont hÃ©rite la class AdminManager :
require_once("Model/Repository/Model_Repository_Manager.php");
require_once("Model/Interface/Model_Interface_Readable.php");


//pour gÃ©rer l'admin :
 abstract class AdminManager extends Manager implements Readable
 {
     public function readItem()//rÃ©cupÃ¨re tous les derniers posts de blog :
     {
     }
 }
