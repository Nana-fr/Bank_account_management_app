<?php

require_once "connexionBdd.php";

final class Login extends ConnexionBdd {

  public function login(User $user) {
  $request = "SELECT * FROM Customer WHERE email = :email AND password_customer = :password_customer";
  $userStatement = $this->db->prepare($request);
  $userStatement->execute(["email" => $user->getEmail(), "password_customer" => $user->getPassword_customer()]);
  $user = $userStatement->fetch(PDO::FETCH_ASSOC);
  return $user;
  }
}


?>