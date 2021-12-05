  <!-- #### Header #### -->
  <?php
  require "data/accounts.php";
  include "template/header.php";
  include "template/nav.php";
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
    
    <?php get_accounts();?>
      <!-- first bank account -->
      <!-- <article class="card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0">
        <h5 class="card-header bg-Kobi text-white text-center">Current account n°$$$</h5>
        <div class="card-body px-0 pb-0">
          <h5 class="card-title text-center fw-bold mb-3">Owner: John DOE</h5>
          <p class="card-text">Balance:  <span class="fw-bold">5000</span>€</p>
          <p class="card-text">Last transaction:  <span class="lastTransaction text-danger fw-bold">-1000€ --- Football pools</span></p>
          <ul class="px-0 pt-4 d-flex justify-content-around btnsBloc">
            <li>
              <a href="#" class="btn btn-transaction rounded">See<span class="d-none d-lg-block">more</span></a>
            </li>
            <li>
              <a href="#" name="0" type="deposit" class="btn btn-transaction rounded text-success" onClick="deployedForm(this.name, this.type)">
              <i class="fas fa-coins"></i><i class="fas fa-plus fa-xs ps-1"></i>
              <span class="d-none d-lg-block">Deposit</span></a>
            </li>
            <li>
              <a href="#" name="0" type="withdrawal" class="btn btn-transaction rounded text-danger" onClick="deployedForm(this.name, this.type)">
              <i class="fas fa-coins"></i><i class="fas fa-minus fa-xs ps-1"></i>
              <span class="d-none d-lg-block">Withdrawal</span></a>
            </li>
            <li>
              <a href="#" id="0" class="btn btn-transaction rounded" onClick="deleteAccount(this.id)">
              <i class="fas fa-trash-alt"></i>
              <span class="d-none d-lg-block">Delete</span></a>
            </li>  
          </ul>
        </div> -->
        <!-- deposit & withdrawal form -->
        <!-- <div class="d-none form m-3">
          <form action="" method="" class="text-center pt-3">
            <i class="fas fa-coins"></i><label class="mt-2" for="sum"></label>
            <input type="number" class="form-control my-2" name="sum" placeholder="Ex: 70" min="50">
            <small class="form-text help"></small>
          </form>
          <div class="d-flex justify-content-center">
            <button class="btn btn-transaction my-2" type="submit" value="Confirm">Confirm</button>
          </div>
        </div>
      </article> -->

      <!-- second bank account -->
      <!-- <article class="card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0">
        <h5 class="card-header bg-Kobi text-white text-center">Savings account n°$$$</h5>
        <div class="card-body px-0 pb-0">
          <h5 class="card-title text-center fw-bold mb-3">Owner: John DOE </h5>
          <p class="card-text">Balance: <span class="fw-bold">30000</span>€</p>
          <p class="card-text">Last transaction: <span class="lastTransaction text-success fw-bold">+500€ --- Deposit</span></p>
          <ul class="px-0 pt-4 d-flex justify-content-around btnsBloc">
            <li>
              <a href="#" class="btn btn-transaction rounded m-1">See<span class="d-none d-lg-block">more</span></a>
            </li>
            <li>
              <a href="#" name="1" type="deposit" class="btn btn-transaction rounded text-success m-1" onClick="deployedForm(this.name, this.type)">
              <i class="fas fa-coins"></i><i class="fas fa-plus fa-xs ps-1"></i>
              <span class="d-none d-lg-block">Deposit</span></a>
            </li>
            <li>
              <a href="#" name="1" type="withdrawal" class="btn btn-transaction rounded text-danger m-1" onClick="deployedForm(this.name, this.type)">
              <i class="fas fa-coins"></i><i class="fas fa-minus fa-xs ps-1"></i>
              <span class="d-none d-lg-block">Withdrawal</span></a>
            </li>
            <li>
              <a href="#" id="1" class="btn btn-transaction rounded m-1" onClick="deleteAccount(this.id)">
              <i class="fas fa-trash-alt"></i>
              <span class="d-none d-lg-block">Delete</span></a>
            </li>  
          </ul>
        </div> -->
        <!-- deposit & withdrawal form -->
        <!-- <div class="d-none form m-3">
          <form action="" method="" class="text-center pt-3">
            <i class="fas fa-coins"></i><label class="mt-2" for="sum"></label>
            <input type="number" class="form-control my-2" name="sum" placeholder="Ex: 70" min="50">
            <small class="form-text help"></small>
          </form>
          <div class="d-flex justify-content-center">
            <button class="btn btn-transaction my-2" type="submit" value="Confirm">Confirm</button>
          </div>
        </div>
      </article> -->

      <!-- third bank account -->
      <!-- <article class="card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0">
        <h5 class="card-header bg-Kobi text-white text-center">ISA n°$$$</h5>
        <div class="card-body px-0 pb-0">
          <h5 class="card-title text-center fw-bold mb-3">Owner: John DOE</h5>
          <p class="card-text">Balance: <span class="fw-bold">15000</span>€</p>
          <p class="card-text">Last transaction: <span class="lastTransaction text-danger fw-bold">-1500€ --- Withdrawal</span></p>
          <ul class="px-0 pt-4 d-flex justify-content-around btnsBloc">
            <li>
              <a href="#" class="btn btn-transaction rounded m-1">See<span class="d-none d-lg-block">more</span></a>
            </li>
            <li>
              <a href="#" name="2" type="deposit" class="btn btn-transaction rounded text-success m-1" onClick="deployedForm(this.name, this.type)">
              <i class="fas fa-coins"></i><i class="fas fa-plus fa-xs ps-1"></i>
              <span class="d-none d-lg-block">Deposit</span></a>
            </li>
            <li>
              <a href="#" name="2" type="withdrawal" class="btn btn-transaction rounded text-danger m-1" onClick="deployedForm(this.name, this.type)">
              <i class="fas fa-coins"></i><i class="fas fa-minus fa-xs ps-1"></i>
              <span class="d-none d-lg-block">Withdrawal</span></a>
            </li>
            <li>
              <a href="#" id="2" class="btn btn-transaction rounded m-1" onClick="deleteAccount(this.id)">
              <i class="fas fa-trash-alt"></i><span class="d-none d-lg-block">Delete</span></a>
            </li>  
          </ul>
        </div> -->
        <!-- deposit & withdrawal form -->
        <!-- <div class="d-none form m-3">
          <form action="" method="" class="text-center pt-3">
            <i class="fas fa-coins"></i><label class="mt-2" for="sum"></label>
            <input type="number" class="form-control my-2" name="sum" placeholder="Ex: 70" min="50">
            <small class="form-text help"></small>
          </form>
          <div class="d-flex justify-content-center">
            <button class="btn btn-transaction my-2" type="submit" value="Confirm">Confirm</button>
          </div>
        </div>
      </article> -->

    </div>

    <!-- New account & transfer Form -->
    <div class="row justify-content-center px-2">
      
      <!-- New account form-->
      <div id="createAccount" class="d-none form mx-3 mx-lg-5 mb-5 col-11 col-sm-7 col-md-5 col-lg-4 col-xxl-3 p-0">
        <form action="submit_account_form.php" method="post" class="">
          <fieldset>
            <legend class="bg-Kobi text-white text-center text-decoration-underline py-2">Create a new bank account</legend>
            <div class="px-2">
              <label class="mt-2" for="accountType">Type of account:</label><br>
                      <select id="accountType" name="accountType" class="my-1">
                      <option value="">Choose</option>
                      <option value="Current account">Current account</option>
                      <option value="Savings account">Savings account</option>
                      <option value="ISA">ISA</option>
                      </select><br>
              <small id="accountTypeHelp" class="form-text"></small><br>
              <label class="mt-2" for="firstName">First name:</label>
              <input type="name" id="firstName" class="form-control my-1" name="firstName" placeholder="Ex: John">
              <small id="firstNameHelp" class="form-text"></small><br>
              <label class="mt-2" for="lastName">Last name:</label>
              <input type="name" id="lastName" class="form-control my-1" name="LastName" placeholder="Ex: DOE">
              <small id="lastNameHelp" class="form-text"></small><br>
              <label class="mt-2" for="deposit">Cash deposit (min 50€):</label>
              <input type="number" id="deposit" class="form-control my-1" name="deposit" placeholder="Ex: 70" min="50">
              <small id="depositHelp" class="form-text"></small><br>
            </div>
          </fieldset>
          <div class="d-flex justify-content-center">
          <button class="btn btn-transaction my-3" type="submit" value="Confirm" onclick="checkNewAccount()">Confirm</button>
        </div>
        </form>
      </div>

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

