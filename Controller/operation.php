 <!-- #### Header #### -->
 <?php
 session_start();
  require "../Model/install.php";
  include "../template/header.php";
  include "../template/nav.php";
  require "../Model/operation.php";
 
  if (isset($_POST['idToDelete'])) {
    $idToDelete = $_POST['idToDelete'];
    delete($connection, $idToDelete);
    $text='This account has been successfully deleted.';
  } else if (isset($_POST['Deposit'])) {
    $id = htmlspecialchars($_GET["id"]);
    $deposit_sum=htmlspecialchars($_POST["Deposit"]);
    deposit($connection, $deposit_sum, $id);
    $text='The deposit of ' . $deposit_sum . '€ has been successfully done.';
  } else if (isset($_POST['Withdrawal'])) {
    $id = htmlspecialchars($_GET["id"]);
    $withdrawal_sum=htmlspecialchars($_POST["Withdrawal"]);
    withdraw($connection, $withdrawal_sum, $id);
    $text='The withdrawal of ' . $withdrawal_sum . '€ has been successfully done.';
  } else if (isset($_POST['accountDebit']) && isset($_POST['sumTransfer']) && isset($_POST['accountCredit'])) {
    $accountDebit=unserialize($_POST["accountDebit"]);
    $sumTransfer=htmlspecialchars($_POST["sumTransfer"]);
    $accountCredit=unserialize($_POST["accountCredit"]);
    transfer($connection, $sumTransfer, $accountCredit, $accountDebit);
    $text='the transfer money of ' . $sumTransfer . '€ from ' . $accountDebit[1] . ' to ' . $accountCredit[1] . ' has been successfully done.';
  } else if (isset($_POST['accountType']) && isset($_POST['deposit'])) {
    $accountType=htmlspecialchars($_POST["accountType"]);
    $deposit=htmlspecialchars($_POST["deposit"]);
    $customer_id = $_SESSION['id'];
    $account_id=create_account($connection, $accountType, $customer_id, $deposit);
    add_first_transaction($connection, $deposit, $account_id);
    $text='Your new account has been successfully created.';
  }
  require "../View/operationView.php";
  ?>