  <!-- #### Header #### -->
  <?php
  require "install.php";
  var_dump($login);
  var_dump($_POST["login"] . " " . $_POST["password"]);



  // session_start();
  // if(isset($_POST['username']) && isset($_POST['password']))
  // {
  //     // connexion à la base de données
  //     $db_username = 'root';
  //     $db_password = 'mot_de_passe_bdd';
  //     $db_name     = 'nom_bdd';
  //     $db_host     = 'localhost';
  //     $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
  //            or die('could not connect to database');
      
  //     // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
  //     // pour éliminer toute attaque de type injection SQL et XSS
  //     $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
  //     $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
      
  //     if($username !== "" && $password !== "")
  //     {
  //         $requete = "SELECT count(*) FROM utilisateur where 
  //               nom_utilisateur = '".$username."' and mot_de_passe = '".$password."' ";
  //         $exec_requete = mysqli_query($db,$requete);
  //         $reponse      = mysqli_fetch_array($exec_requete);
  //         $count = $reponse['count(*)'];
  //         if($count!=0) // nom d'utilisateur et mot de passe correctes
  //         {
  //            $_SESSION['username'] = $username;
  //            header('Location: principale.php');
  //         }
  //         else
  //         {
  //            header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
  //         }
  //     }
  //     else
  //     {
  //        header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
  //     }
  // }
  // else
  // {
  //    header('Location: login.php');
  // }



//   <?php
//   session_start();
//   if($_SESSION['username'] !== ""){
//       $user = $_SESSION['username'];
//       echo "Bonjour $user, vous êtes connecté";
//   }
// ?>



  if (array_key_exists($_POST['login'], $login) === false || $login[$_POST["login"]] !== $_POST["password"]) {
   header('Location: login.php');
  exit; 
  }
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

