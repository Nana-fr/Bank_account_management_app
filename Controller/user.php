<?php
  session_start();
  require "../Model/install.php";
  require "../Model/userdata.php";
  include "../template/header.php";
  include "../template/nav.php";
  
  if (!isset($_SESSION['firstname']) && !isset($_SESSION['lastname']) && !isset($_SESSION['id'])) {
    header('Location: login.php'); 
    exit();
  }
  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
  $id = $_SESSION['id'];
  $account=get_user_data($connection, $firstname, $lastname, $id);

  if (isset($_POST) && !isset($error)) {
    foreach (array_values($_POST) as $value){
      if ($value === ""){
        $error = "no values";
        echo "<div class='alert alert-danger' role='alert'>" . $error . "</div>";
      } else {
        foreach (array_keys($_POST) as $key) {
          $value=htmlspecialchars($_POST[$key]);
          edit_data($connection, $key, $value, $id); 
        }
      }
    }
  } else {
    echo "<div class='alert alert-danger' role='alert'>" . $error . "</div>";
  }

  require "../View/userView.php";
?>