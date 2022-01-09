<?php
   require_once "../Model/entity/account.php";
   require "../Model/entity/user.php";
   require "../Model/entity/customer.php";
   require "../Model/entity/adviser.php";
   require_once "../Model/entity/accountType.php";
   require_once "../Model/entity/transaction.php";
   require_once "../Model/getAccounts.php";
  session_start();
  include "../template/header.php";
  include "../template/nav.php";

 if (!empty($_GET) && isset($_GET["id"])) { 
    $customer=new Customer(["id" => intval($_GET["id"])]);
    $accountsManager = new Accounts();
    $accounts = $accountsManager->getAccountsCustomer($customer);
    require "../View/customerAccountsView.php";
  }

include "../template/footer.php";  
?>
<script src="../js/main.js"></script>