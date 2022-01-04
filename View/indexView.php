<!-- #### Homepage #### -->
<main class="container px-3 font-Zen">
    <h2 class="fw-bold text-center text-decoration-underline py-5">My Banks Accounts<i class="fas fa-piggy-bank color ps-2"></i></h2>

    <!-- Display banks account -->
    <div id="newAccount" class="row justify-content-center px-2">
      <?php
      getAccounts($connection);
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
 <?php
 newAccount($connection, $customer_id);
// require "../Model/newAccount.php";
// require "../Model/transfer.php";
 ;?>
  </main>
