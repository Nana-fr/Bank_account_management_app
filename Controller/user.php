<?php
  require "../Model/entity/user.php";
  require "../Model/entity/customer.php";
  require "../Model/entity/adviser.php";
  require "../Model/userdata.php";
  session_start();
  include "../template/header.php";
  include "../template/nav.php";
  
  if (!isset($_SESSION['user'])) {
    header('Location: login.php'); 
    exit();
  }
  // $firstname = $_SESSION['firstname'];
  // $lastname = $_SESSION['lastname'];
  // $id = $_SESSION['id'];
  // $account=get_user_data($connection, $firstname, $lastname, $id);
  

  if (!empty($_POST) && !isset($error)) {
    $userManager = new UserDataManager();
    $result=$userManager->edit_data($_SESSION['user']);
    if ($result){
      if (is_a($_SESSION['user'], 'Customer')){
        $_SESSION['user'] = new Customer ($userManager->updateUser($_SESSION['user']));
      } else {
        $_SESSION['user'] = new Adviser ($userManager->updateUser($_SESSION['user']));
      }
    }
  }


  // if (isset($_POST) && !isset($error)) {
  //   foreach (array_values($_POST) as $value){
  //     if ($value === ""){
  //       $error = "no values";
  //       echo "<div class='alert alert-danger' role='alert'>" . $error . "</div>";
  //     } else {
  //       foreach (array_keys($_POST) as $key) {
  //         $value=htmlspecialchars($_POST[$key]);
  //         $userManager->edit_data($key, $value, $_SESSION['user']); 
  //       }
  //     }
  //   }
  // } else {
  //   echo "<div class='alert alert-danger' role='alert'>" . $error . "</div>";
  // }

  require "../View/userView.php";
  include "../template/footer.php";
?>
 <script src="../js/user_page.js"></script>