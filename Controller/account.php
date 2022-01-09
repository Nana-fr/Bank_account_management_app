<?php
  require_once "../Model/entity/account.php";
  require_once "../Model/entity/customer.php";
  require_once "../Model/entity/accountType.php";
  require_once "../Model/entity/transaction.php";
  require_once "../Model/getAccount.php";
  session_start();
  include "../template/header.php";
  include "../template/nav.php";

 if (!empty($_GET) && isset($_GET["id"])) { 
    $id = htmlspecialchars($_GET["id"]);
    $accountManager = new AccountManager();
    $account = $accountManager->get_account($id, $_SESSION['user']);
    require "../View/accountView.php";
  } else {
      header("Location: ../index.php");
  }

include "../template/footer.php";  
?>
<script src="../js/main.js"></script>
     
