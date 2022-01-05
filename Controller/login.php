<?php
  session_start();
  require "../Model/entity/customer.php";
  require "../Model/login.php";
  include "../template/header.php";
  include "../template/nav.php";
  
  if (isset($_POST['email']) && isset($_POST['password_customer'])) {
    try {
      $logCustomer = new Customer($_POST);
      $login = new Login();
      $username = $login->login($logCustomer);
    } catch (Exception $e) {
      $error = $e->getMessage();
    }
    if ($username) {
      var_dump($username);
      $_SESSION['firstname'] = $username['firstname'];
      $_SESSION['lastname'] = $username['lastname'];
      $_SESSION['id'] = $username['id'];
      header('Location: ../index.php');
      exit();
    } else {
      $errorMessage = 'Login and/or password incorrect.';
    }
  }
  require "../View/loginView.php";
?>