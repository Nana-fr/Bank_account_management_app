<?php

require_once "connexionBdd.php";

final class Login extends ConnexionBdd {

  function login(Customer $customer) {
  $request = "SELECT id, firstname, lastname FROM Customers WHERE email = :email AND password_customer = :password_customer";
  $usernameStatement = $this->db->prepare($request);
  $usernameStatement->execute(["email" => $customer->getEmail(), "password_customer" => $customer->getPassword_customer()]);
  $username = $usernameStatement->fetch(PDO::FETCH_ASSOC);
  return $username;
  }

}


?>