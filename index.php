  <?php
  session_start();
  require "install.php";
  include "template/header.php";
  include "template/nav.php";
  if (!isset($_SESSION['firstname']) && !isset($_SESSION['lastname']) && !isset($_SESSION['id'])) {
    header('Location: login.php'); 
  }
  // #### Layer ####
  include_once "template/layer.php";
  ?>

  <!-- #### Homepage #### -->
  <main class="container px-3 font-Zen">
    <h2 class="fw-bold text-center text-decoration-underline py-5">My Banks Accounts<i class="fas fa-piggy-bank color ps-2"></i></h2>

    <!-- Display banks account -->
    <div id="newAccount" class="row justify-content-center px-2">
      <?php
      $firstname = $_SESSION['firstname'];
      $lastname = $_SESSION['lastname'];
      $sqlQuery = "SELECT Accounts.*, Accounts_type.account_type_name, Accounts.customer_id, Customers.firstname, Customers.lastname FROM Accounts INNER JOIN Accounts_type ON account_type_id=Accounts_type.id INNER JOIN Customers ON customer_id=Customers.id WHERE Customers.firstname='$firstname' AND Customers.lastname='$lastname'";
      $accountsStatement = $connection->prepare($sqlQuery);
      $accountsStatement->execute();
      $accounts = $accountsStatement->fetchAll(PDO::FETCH_ASSOC);

      foreach ($accounts as $account) {
      $i=$account["id"];
      $sqlQuery = "SELECT * FROM Transactions INNER JOIN Accounts ON account_id=Accounts.id WHERE Accounts.id='$i' ORDER BY transaction_date DESC LIMIT 0, 1";
      $lastTransactionStatement = $connection->prepare($sqlQuery);
      $lastTransactionStatement->execute();
      $lastTransaction = $lastTransactionStatement->fetch();   
        echo "<article class='card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0'>
          <h5 class='card-header bg-Kobi text-white text-center'>" . $account["account_type_name"] . " n°" . $account["account_number"] . "</h5>
          <div class='card-body d-flex flex-column px-0 pb-0'>
            <h5 class='card-title text-center fw-bold mb-3'>Owner: " . $account["firstname"] . " " . $account["lastname"] . "</h5>
            <p class='card-text'>Balance:  <span class='fw-bold fs-5'>" . $account["balance"] . "</span>€</p>
            <p class='card-text my-2'>Last transaction:  <span class='lastTransaction text-success fw-bold'>" . $lastTransaction['transaction_type'] . $lastTransaction['amount'] . "€ --- " . $lastTransaction['transaction_name'] . " --- " . $lastTransaction['transaction_date'] . "</span></p>
            <a href='account.php?id=$i' class='btn btn-transaction rounded align-self-center my-2'>See more</a>
          </div>
      </article>";
      }
      $customer_id=$accounts[0]["customer_id"];
      ?>
    </div>

    <!-- New account & transfer Form -->
    <div class="row justify-content-center px-2">
      
      <!-- New account form-->
      <div id="createAccount" class="d-none form mx-3 mx-lg-5 mb-5 col-11 col-sm-7 col-md-5 col-lg-4 col-xxl-3 p-0">
        <form action="index.php" method="post" class="">
          <fieldset>
            <legend class="bg-Kobi text-white text-center text-decoration-underline py-2">Create a new bank account</legend>
            <div class="px-2">
              <label class="mt-2" for="accountType">Type of account:</label><br>
                    <select id="accountType" name="accountType" class="my-1">
                      <option value="">Choose</option>
                      <option value=1>Current account</option>
                      <option value=2>Savings account</option>
                      <option value=3>ISA</option>
                    </select><br>
              <small id="accountTypeHelp" class="form-text"></small><br>
              <label class="mt-2" for="deposit">Cash deposit (min 50€):</label>
              <input type="number" id="deposit" class="form-control my-1" name="deposit" placeholder="Ex: 70" min="50">
              <small id="depositHelp" class="form-text"></small><br>
            </div>
          </fieldset>
          <div class="d-flex justify-content-center">
          <input class="btn btn-transaction my-3" type="submit" value="Confirm">
        </div>
        </form>
      </div>

      <?php
// Validation du formulaire
if (isset($_POST['accountType']) && isset($_POST['deposit'])) {
  $accountType=htmlspecialchars($_POST["accountType"]);
  $deposit=htmlspecialchars($_POST["deposit"]);
  $request = "INSERT INTO Accounts (account_number, account_type_id, customer_id, balance, created_date) VALUES (123456789, '$accountType', '$customer_id', '$deposit', Now())";
  $newAccountStatement = $connection->prepare($request);
  $newAccountStatement->execute();

  $sqlQuery = "SELECT id FROM Accounts WHERE id=(SELECT MAX(id) FROM Accounts)";
  $accountStatement = $connection->prepare($sqlQuery);
  $accountStatement->execute();
  $account_id= $accountStatement->fetch();

  $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (85214, 'Deposit for new account', '$deposit', '+', '$account_id[0]', Now())";
  $addTransactionStatement = $connection->prepare($sqlQuery);
  $addTransactionStatement->execute();
  } else {
  $errorMessage = 'Error';
}
?>

      <!-- Transfer money form-->
      <div id="transferMoney" class="d-none form mx-3 mx-lg-5 mb-5 col-11 col-sm-7 col-md-5 col-lg-4 col-xxl-3 p-0">
        <form action="index.php" method="post" class="">
          <fieldset>
            <legend class="bg-Kobi text-white text-center text-decoration-underline py-2">Transfer money to another account</legend>
            <div class="px-2">
              <label class="mt-2" for="accountDebit">Account to debit:</label><br>
                    <select id="accountDebit" name="accountDebit" class="my-1">
                    <option value="">Select</option>
                    <?php foreach ($accounts as $account): ?>
                      <?php $infoAccount=serialize(array($account['id'], $account["account_type_name"] . " n°" . $account["account_number"]));?>
                    <option value='<?php echo $infoAccount;?>'><?php echo $account["account_type_name"] . " n°" . $account["account_number"];?></option>
                    <?php endforeach;?>
                    </select><br>
              <small id="accountDebitHelp" class="form-text"></small><br>
              <label class="mt-2" for="sumTransfer">Sum of money (min 50€):</label>
              <input type="number" id="sumTransfer" class="form-control my-1" name="sumTransfer" placeholder="Ex: 70" min="50">
              <small id="sumTransferHelp" class="form-text"></small><br>
              <label class="mt-2" for="accountCredit">Account to credit:</label><br>
                    <select id="accountCredit" name="accountCredit" class="my-1">
                    <option value="">Select</option>
                    <?php foreach ($accounts as $account): ?>
                      <?php $infoAccount=serialize(array($account["id"], $account["account_type_name"] . " n°" . $account["account_number"]));?>
                    <option value='<?php echo $infoAccount;?>'><?php echo $account["account_type_name"] . " n°" . $account["account_number"];?></option>
                    <?php endforeach;?>
                    </select><br>
              <small id="accountCreditHelp" class="form-text"></small><br>
            </div>
          </fieldset>
          <div class="d-flex justify-content-center">
            <input class="btn btn-transaction my-2" type="submit" value="Confirm" onclick="checkTransferMoney()">
          </div>
        </form>
      </div>
    </div>

    <?php
    if (isset($_POST['accountDebit']) && isset($_POST['sumTransfer']) && isset($_POST['accountCredit'])) {
  $accountDebit=unserialize($_POST["accountDebit"]);
  $sumTransfer=htmlspecialchars($_POST["sumTransfer"]);
  $accountCredit=unserialize($_POST["accountCredit"]);
  
  $request = "UPDATE Accounts SET balance = balance + $sumTransfer WHERE id='$accountCredit[0]'";
  $creditStatement = $connection->prepare($request);
  $creditStatement->execute();

  $sqlQuery = "UPDATE Accounts SET balance = balance - $sumTransfer WHERE id='$accountDebit[0]'";
  $debitStatement = $connection->prepare($sqlQuery);
  $debitStatement->execute();

  $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (87456, 'Transfer money from $accountDebit[1]', '$sumTransfer', '+', '$accountCredit[0]', Now())";
  $addTransactionStatement = $connection->prepare($sqlQuery);
  $addTransactionStatement->execute();

  $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (87456, 'Transfer money to $accountCredit[1]', '$sumTransfer', '-', '$accountDebit[0]', Now())";
  $addTransactionStatement = $connection->prepare($sqlQuery);
  $addTransactionStatement->execute();
  } 
 ;?>

    <!-- Buttons to create new account & transfer money -->
    <div class="d-flex justify-content-around">
      <button name="createAccount" class="btn btn-transaction mb-5" onClick="addForm(this.name)">
        <i class="fas fa-piggy-bank fa-lg"></i><i class="fas fa-plus fa-xs ps-1"></i>
        <span class="d-none d-sm-block">Create a new account</span>
      </button>
      <button name="transferMoney" class="btn btn-transaction mb-5" onClick="addForm(this.name)">
        <i class="fas fa-piggy-bank fa-lg"></i>
        <span class="fa-stack fa-lg"><i class="fas fa-exchange-alt fa-lg" style="color: #eea3c1"></i>
          <i class="fas fa-euro-sign fa-stack-1x"></i>
        </span>
        <i class="fas fa-piggy-bank fa-lg"></i>
        <span class="d-none d-sm-block">Transfer money</span>
      </button>
    </div>
 
  </main>

      <!-- #### Footer #### -->
    <?php
      include "template/footer.php";
    ?>
    <script src="js/main.js"></script>

