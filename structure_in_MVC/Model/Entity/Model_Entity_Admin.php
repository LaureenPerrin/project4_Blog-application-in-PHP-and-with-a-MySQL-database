<?php

namespace projet4\Blog\Model;

//lien pour la class AdminManager dont hÃ©rite la class Admin:
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

      //fonctions setters
      public function setIdAdmin()
      {
          if (is_int($idAdmin) && $idAdmin >= 0) {
              $this->_idAdmin = $idAdmin;
          }
          return $this;
      }

      public function setPseudo($pseudo)
      {
          if (!empty($pseudo) && strlen($pseudo) <= 70) {
              $this->_pseudo= $pseudo;
          }
          return $this;
      }

      public function setPassword($password)
      {
          if (!empty($password) && strlen($password) <= 255) {
              $this->_password= $password;
          }
          return $this;
      }
  }
