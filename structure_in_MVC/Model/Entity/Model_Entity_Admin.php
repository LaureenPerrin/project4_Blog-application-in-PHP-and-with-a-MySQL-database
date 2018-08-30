<?php

namespace projet4\Blog\Model;

require_once("Model/Repository/Model_Repository_AdminManager.php");
require_once("Model/Interface/Model_Interface_Readable.php");

  class Admin extends AdminManager
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
