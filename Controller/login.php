<?php
  require "../Model/entity/user.php";
  require "../Model/entity/customer.php";
  require "../Model/entity/adviser.php";
  require "../Model/login.php";
  include "../template/header.php";
  include "../template/nav.php";
  
  if (isset($_POST['email']) && isset($_POST['password_customer'])) {
    try {
      $logUser = new User($_POST);
      $login = new Login();
      $user = $login->login($logUser);
    } catch (Exception $e) {
      $error = $e->getMessage();
    }
    if ($user) {
      if ($user['user_type'] === "Adviser") {
        $user = new Adviser($user);
      } else {
        $user = new Customer($user);
      }
      session_start();
      $_SESSION['user'] = $user;
      header('Location: ../index.php');
      exit();
    } else {
      $errorMessage = 'Login and/or password incorrect.';
    }
  }
  require "../View/loginView.php";
  include "../template/footer.php";
?>