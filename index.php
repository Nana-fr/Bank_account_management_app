  <?php
  session_start();
  require "Model/install.php";
  include "template/header.php";
  include "template/nav.php";
  if (!isset($_SESSION['firstname']) && !isset($_SESSION['lastname']) && !isset($_SESSION['id'])) {
    header('Location: login.php');
  } else {
    require "Model/getAccounts.php";
    require "Model/newAccount.php";
    require "View/indexView.php";
  }
  // #### Layer ####
  // include_once "template/layer.php";
  // #### Footer ####
    include "template/footer.php";
  
  ?>
<script src="js/main.js"></script>
  
