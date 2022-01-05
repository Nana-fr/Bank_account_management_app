<?php
  session_start();
  require "../Model/install.php";
  include "../template/header.php";
  include "../template/nav.php";
  require "../Model/login.php";
  if (isset($_POST['login']) && isset($_POST['password'])) {
    $mail=htmlspecialchars($_POST["login"]);
    $password=htmlspecialchars($_POST["password"]);
    $username=login($connection, $mail, $password);
    if ($username) {
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