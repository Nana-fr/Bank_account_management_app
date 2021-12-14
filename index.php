  <!-- #### Header #### -->
  <?php
  session_start();
  require "install.php";
  require "data/accounts.php";
  include "template/header.php";
  include "template/nav.php";
  if (!isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])) {
    header('Location: login.php'); 
  }
  ?>

    <!-- #### Layer #### -->
  <div id="warning" class="position-fixed top-0 start-0">
    <div class="position-absolute top-50 start-50 translate-middle bg-white p-2">
      <p id="message"></p><br>
      <button class="btn btn-transaction" onclick="closeLayer()">I understand</button>
    </div>
  </div>


  <!-- #### Homepage #### -->
  <main class="container px-3 font-Zen">
    <h2 class="fw-bold text-center text-decoration-underline py-5">My Banks Accounts<i class="fas fa-piggy-bank color ps-2"></i></h2>

    <!-- Display banks account -->
    <div id="newAccount" class="row justify-content-center px-2">
      <?php
      $firstname = $_SESSION['firstname'];
      $lastname = strtoupper($_SESSION['lastname']);
      $sqlQuery = "SELECT Accounts.*, Accounts_type.account_type_name, Customers.firstname, Customers.lastname FROM Accounts INNER JOIN Accounts_type ON account_type_id=Accounts_type.id INNER JOIN Customers ON customer_id=Customers.id WHERE Customers.firstname='$firstname' AND Customers.lastname='$lastname'";
      $accountsStatement = $connection->prepare($sqlQuery);
      $accountsStatement->execute();
      $accounts = $accountsStatement->fetchAll();
      foreach ($accounts as $account) {
        $i=$account["id"];
        echo "<article class='card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0'>
          <h5 class='card-header bg-Kobi text-white text-center'>" . $account["account_type_name"] . " n°" . $account["account_number"] . "</h5>
          <div class='card-body px-0 pb-0'>
          <h5 class='card-title text-center fw-bold mb-3'>Owner: " . $account["firstname"] . " " . $account["lastname"] . "</h5>
          <p class='card-text'>Balance:  <span class='fw-bold'>" . $account["balance"] . "</span>€</p>
          <ul class='px-0 pt-4 d-flex justify-content-around btnsBloc'>
              <li>
              <a href='account.php?id=$i' class='btn btn-transaction rounded'>See<span class='d-none d-lg-block'>more</span></a>
              </li>
              <li>
              <a href='#' name='' type='deposit' class='btn btn-transaction rounded text-success' onClick='deployedForm(this.name, this.type)'>
              <i class='fas fa-coins'></i><i class='fas fa-plus fa-xs ps-1'></i>
              <span class='d-none d-lg-block'>Deposit</span></a>
              </li>
              <li>
              <a href='#' name='' type='withdrawal' class='btn btn-transaction rounded text-danger' onClick='deployedForm(this.name, this.type)'>
              <i class='fas fa-coins'></i><i class='fas fa-minus fa-xs ps-1'></i>
              <span class='d-none d-lg-block'>Withdrawal</span></a>
              </li>
              <li>
              <button id='' class='btn btn-transaction rounded' onClick='deleteAccount(this.id)'>
              <i class='fas fa-trash-alt'></i>
              <span class='d-none d-lg-block'>Delete</span></button>
              </li>  
          </ul>
          </div>
          <!-- deposit & withdrawal form -->
          <div class='d-none form m-3'>
          <form action='' method='' class='text-center pt-3'>
              <i class='fas fa-coins'></i><label class='mt-2' for='sum'></label>
              <input type='number' class='form-control my-2' name='sum' placeholder='Ex: 70' min='50'>
              <small class='form-text help'></small>
          </form>
          <div class='d-flex justify-content-center'>
              <button class='btn btn-transaction my-2' type='submit' value='Confirm'>Confirm</button>
          </div>
          </div>
      </article>";
      }
      ;?>
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
      $request = "INSERT INTO Accounts (account_number, account_type_id, customer_id, balance, created_date) VALUES (123456789, '$accountType', 1, '$deposit', Now())";
      $newAccountStatement = $connection->prepare($request);
      $newAccountStatement->execute();
      } else {
        $errorMessage = 'Error';
}
?>


      <!-- Transfer money form-->
      <div id="transferMoney" class="d-none form mx-3 mx-lg-5 mb-5 col-11 col-sm-7 col-md-5 col-lg-4 col-xxl-3 p-0">
        <form action="" method="" class="">
          <fieldset>
            <legend class="bg-Kobi text-white text-center text-decoration-underline py-2">Transfer money to another account</legend>
            <div class="px-2">
              <label class="mt-2" for="accountDebit">Account to debit*:</label><br>
                    <select id="accountDebit" name="accountDebit" class="my-1">
                    <option value="">Select</option>
                    <option value="0">Current account n°$$$</option>
                    <option value="1">Savings account n°$$$</option>
                    <option value="2">ISA n°$$$</option>
                    </select><br>
              <small id="accountDebitHelp" class="form-text"></small><br>
              <label class="mt-2" for="sumTransfer">Sum of money (min 50€):</label>
              <input type="number" id="sumTransfer" class="form-control my-1" name="sumTransfer" placeholder="Ex: 70" min="50">
              <small id="sumTransferHelp" class="form-text"></small><br>
              <label class="mt-2" for="accountCredit">Account to credit*:</label><br>
                    <select id="accountCredit" name="accountCredit" class="my-1">
                    <option value="">Select</option>
                    <option value="0">Current account n°$$$</option>
                    <option value="1">Savings account n°$$$</option>
                    <option value="2">ISA n°$$$</option>
                    </select><br>
              <small id="accountCreditHelp" class="form-text"></small><br>
              <p class="py-2">*Please note that it isn't possible to transfer money from or to an account created less that 24h ago.</p>
            </div>
          </fieldset>
        </form>
        <div class="d-flex justify-content-center">
          <button class="btn btn-transaction my-2" type="submit" value="Confirm" onclick="checkTransferMoney()">Confirm</button>
        </div>
      </div>
    </div>

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

