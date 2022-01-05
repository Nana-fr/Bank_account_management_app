<?php
require "install.php";

abstract class ConnexionBdd {
    
    protected PDO $_db;

    function __construct() {
    $this->_db = DataBase::getDB();
  }
}

?>