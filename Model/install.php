<?php


abstract class DataBase {

    const HOST  = "localhost";
    const NAME = "banque_php";
    const LOGIN = "banquePHP";
    const PASSWORD = "banque76";
    const OPTION = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
  
    static public function getDB() {
      try {
        $db = new PDO("mysql:host=" . self::HOST .";dbname=" . self::NAME , self::LOGIN, self::PASSWORD, self::OPTION);
        return $db;
      } catch (Exception $e) {
        exit($e->getMessage());
      }
    }
  
}


// try {
//     $connection = new PDO('mysql:host=localhost;dbname=banque_php', 'banquePHP', 'banque76',
//     [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
// } catch(Exception $e) {
//     die('Erreur : '.$e->getMessage());
// }
?>