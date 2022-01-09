 <!-- #### Header #### -->
 <?php
  require "../Model/entity/user.php";
  require "../Model/entity/customer.php";
  require "../Model/entity/transaction.php";
  require "../Model/getAccount.php";
  require "../Model/operation.php";
  session_start();
  include "../template/header.php";
  include "../template/nav.php";

  if(!isset($_SESSION["user"])) {
    header("Location: login.php");
  }
  
  if(!empty($_POST) && isset($_POST["d&w"])) {
    $accountManager = new AccountManager();
    $account = $accountManager->get_balance($_POST["account_id"], $_SESSION['user']);
    if ($account) {
      $transaction = new Transaction($_POST);
      $transaction->setTransaction_type();
      $account->UpdateBalance($transaction);
      $operationManager = new OperationManager();
      $result = $operationManager->makeDepositWithdrawal($transaction, $account);
      if ($result) {
        $text= '<div class="alert alert-success" role="alert"> The ' . $transaction->getTransaction_name() . ' of ' . $transaction->getAmount() . '€ has been successfully done. </div>';
      } else {
        $text = '<div class="alert alert-danger" role="alert"> Error. The ' . $transaction->getTransaction_name() . ' of ' . $transaction->getAmount() . '€ has failed. </div>';
      }
    }
  } else if(!empty($_POST) && isset($_POST["add_account"])) {
    $account = new Account($_POST);
    $account->setCustomer_id($_SESSION['user']->getId());
    $transaction= new Transaction();
    $transaction->setTransaction_name('Deposit for new account')->setAmount($_POST['balance'])->setTransaction_type('+');
    $operationManager = new OperationManager();
    $operationManager->addAccount($account);
    $result=$operationManager->newAccount($account, $transaction);
    if ($result) {
      $text= '<div class="alert alert-success" role="alert"> Your new account n°: ' . $account->getAccount_number() . ' has been successfully created with a balance of ' . $account->getBalance() . '€. </div>';
    } else {
      $text = '<div class="alert alert-danger" role="alert"> Error. Unable to create a new account. </div>';
    }
  } else if(!empty($_POST) && isset($_POST["money_transfer"])) {
    $accountManager = new AccountManager();
    $accountDebit = $accountManager->get_balance(unserialize($_POST["accountDebit"])[0], $_SESSION['user']);
    $accountCredit = $accountManager->get_balance(unserialize($_POST["accountCredit"])[0], $_SESSION['user']);

    if ($accountDebit && $accountCredit && $accountDebit->getId() !== $accountCredit->getId()) {
      $transactionDebit = new Transaction($_POST);
      $transactionDebit->setTransaction_type('-')->setTransaction_name('Transfer money to ' . unserialize($_POST["accountCredit"])[1]);
      $accountDebit->UpdateBalance($transactionDebit);

      $transactionCredit = new Transaction($_POST);
      $transactionCredit->setTransaction_type('+')->setTransaction_name('Transfer money from ' . unserialize($_POST["accountDebit"])[1]);;
      $accountCredit->UpdateBalance($transactionCredit);

      $operationManager = new OperationManager();
      $result = $operationManager->makeMoneyTransfer($transactionDebit, $accountDebit, $transactionCredit, $accountCredit);
      if ($result) {
        $text= '<div class="alert alert-success" role="alert">' . $transactionCredit->getTransaction_name() . ' to ' . unserialize($_POST["accountCredit"])[1] . ' of ' . $transactionDebit->getAmount() . '€ has been successfully done. </div>';
      } else {
        $text = '<div class="alert alert-danger" role="alert"> Error. ' . $transactionCredit->getTransaction_name() . ' to ' . unserialize($_POST["accountCredit"])[1] . ' of ' . $transactionDebit->getAmount() . '€ has failed. </div>';
      }
    }
  } else if(!empty($_POST) && isset($_POST["delete"])) {
    $account_to_delete = new Account();
    $account_to_delete->setId($_POST["delete"])->setCustomer_id($_SESSION['user']->getId());
    $accountManager = new AccountManager();
    $result = $accountManager->deleteAccount($account_to_delete);
    if ($result) {
      $text= '<div class="alert alert-success" role="alert"> This account has been successfully deleted. </div>';
    } else {
      $text = '<div class="alert alert-danger" role="alert"> Error. This account hasn\'t be deleted. </div>';
    }
  }
  

  
  

// var_dump($transaction);
// var_dump($account);
 
  // if (isset($_POST['idToDelete'])) {
  //   $idToDelete = $_POST['idToDelete'];
  //   delete($connection, $idToDelete);
  //   $text='This account has been successfully deleted.';
  // } else if (isset($_POST['Deposit'])) {
  //   $id = htmlspecialchars($_GET["id"]);
  //   $deposit_sum=htmlspecialchars($_POST["Deposit"]);
  //   deposit($connection, $deposit_sum, $id);
  //   $text=var_dump($_POST);
  // } else if (isset($_POST['Withdrawal'])) {
  //   $id = htmlspecialchars($_GET["id"]);
  //   $withdrawal_sum=htmlspecialchars($_POST["Withdrawal"]);
  //   withdraw($connection, $withdrawal_sum, $id);
  //   $text='The withdrawal of ' . $withdrawal_sum . '€ has been successfully done.';
  // } else if (isset($_POST['accountDebit']) && isset($_POST['sumTransfer']) && isset($_POST['accountCredit'])) {
  //   $accountDebit=unserialize($_POST["accountDebit"]);
  //   $sumTransfer=htmlspecialchars($_POST["sumTransfer"]);
  //   $accountCredit=unserialize($_POST["accountCredit"]);
  //   transfer($connection, $sumTransfer, $accountCredit, $accountDebit);
  //   $text='the transfer money of ' . $sumTransfer . '€ from ' . $accountDebit[1] . ' to ' . $accountCredit[1] . ' has been successfully done.';
  // } else if (isset($_POST['accountType']) && isset($_POST['deposit'])) {
  //   $accountType=htmlspecialchars($_POST["accountType"]);
  //   $deposit=htmlspecialchars($_POST["deposit"]);
  //   $customer_id = $_SESSION['id'];
  //   $account_id=create_account($connection, $accountType, $customer_id, $deposit);
  //   add_first_transaction($connection, $deposit, $account_id);
  //   $text='Your new account has been successfully created.';
  // }
  require "../View/operationView.php";
  include "../template/footer.php";
?>
<script src="../js/main.js"></script>