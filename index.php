  <?php
  session_start();
  // require "Model/install.php";
  // require "Model/getAccounts.php";
  include "template/header.php";
  include "template/nav.php";
  if (!isset($_SESSION['firstname']) && !isset($_SESSION['lastname']) && !isset($_SESSION['id'])) {
    header('Location: Controller/login.php');
  } else {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    // $accounts = getAccounts($connection, $firstname, $lastname);
    require "View/indexView.php";
  }
  // #### Layer ####
  // include_once "template/layer.php";
  
  
  ?>

  
