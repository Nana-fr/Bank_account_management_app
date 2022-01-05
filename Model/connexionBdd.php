<?php
require_once "install.php";

abstract class ConnexionBdd {
    
    protected PDO $db;

    function __construct() {
    $this->db = DataBase::getDB();
  }
}

?>