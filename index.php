  <?php
  require_once "Model/entity/account.php";
  require "Model/entity/user.php";
  require "Model/entity/customer.php";
  require "Model/entity/adviser.php";
  require_once "Model/entity/accountType.php";
  require_once "Model/entity/transaction.php";
  require_once "Model/getAccounts.php";
  require_once "Model/userdata.php";
  session_start();
  include "template/header.php";
  include "template/nav.php";

  if (!isset($_SESSION['user'])) {
    header('Location: Controller/login.php');
  } else if (is_a($_SESSION['user'], 'Customer')){
    $accountsManager = new Accounts();
    $accounts = $accountsManager->getAccounts($_SESSION['user']);
    require "View/indexView.php";
  } else {
    $userDataManager = new UserDataManager();
    $listCustomers = $userDataManager->getCustomersList($_SESSION['user']);
    foreach ($listCustomers as $key => $customer) {
      $listCustomers[$key] = new Customer($customer);
    }
    require "View/indexViewAdviser.php";
  }

    
  // #### Layer ####
  // include_once "template/layer.php";
    include "template/footer.php";
  ?>
<script src="js/main.js"></script>


  
