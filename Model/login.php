<?php

final class Login extends ConnexionBdd {

  function login($connection, $mail, $password) {
  $request = "SELECT id, firstname, lastname FROM Customers WHERE email = '$mail' AND password_customer = '$password'";
  $usernameStatement = $connection->prepare($request);
  $usernameStatement->execute();
  $username = $usernameStatement->fetch(PDO::FETCH_ASSOC);
  return $username;
}

}


?>