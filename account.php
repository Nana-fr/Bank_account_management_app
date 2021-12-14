<?php
  session_start();
  require "install.php";
  require "data/accounts.php";
  include "template/header.php";
  include "template/nav.php";
?>

<?php if (!empty($_GET) && isset($_GET["id"])) { 
        $id = htmlspecialchars($_GET["id"]);
    } else {
        $error = "There is nothing here." ;
    }
    $sqlQuery = "SELECT * FROM Accounts INNER JOIN Accounts_type ON account_type_id=Accounts_type.id INNER JOIN Customers ON customer_id=Customers.id WHERE Accounts.id='$id'";
    $accountStatement = $connection->prepare($sqlQuery);
    $accountStatement->execute();
    $account = $accountStatement->fetchAll();
    $account = $account[0];
    $sqlQuery = "SELECT * FROM Transactions INNER JOIN Accounts ON account_id=Accounts.id WHERE Accounts.id='$id'";
    $lastTransactionsStatement = $connection->prepare($sqlQuery);
    $lastTransactionsStatement->execute();
    $lastTransactions = $lastTransactionsStatement->fetchAll();

    function deleteAccount($i) {
        $sqlQuery = "DELETE FROM Accounts WHERE Accounts.id='$id'";
        $deleteStatement->execute();}
;?>

<main class="container px-3 font-Zen">
    <h2 class="fw-bold text-center text-decoration-underline py-5">Data about <?php echo $account["account_type_name"] . " " . $account["account_number"];?></h2>

    <div class="row justify-content-center px-2">
        <article class='card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0'>
                <h5 class='card-header bg-Kobi text-white text-center'><?php echo $account["account_type_name"] . " " . $account["account_number"];?></h5>
                <div class='card-body px-0 pb-0'>
                <h5 class='card-title text-center mb-3'>Owner: <?php echo $account["firstname"] . " " . $account["lastname"];?></h5>
                <p class='card-text'>Balance:  <span class='fw-bold'><?php echo $account["balance"];?></span>€</p>
                <p class='card-text'>Last transaction:  <ul class='lastTransaction text-danger fw-bold'><?php foreach ($lastTransactions as $lastTransaction){
                  echo "<li>" . $lastTransaction['transaction_type'] . $lastTransaction['amount'] . "€ --- " . $lastTransaction['transaction_name'] . " --- " . $lastTransaction['transaction_date'] . "</li>";
                };?></ul></p>
                <ul class='px-0 pt-4 d-flex justify-content-around btnsBloc'>
                    <li>
                    <a href='#' name='0' type='deposit' class='btn btn-transaction rounded text-success' onClick='deployedForm(this.name, this.type)'>
                    <i class='fas fa-coins'></i><i class='fas fa-plus fa-xs ps-1'></i>
                    <span class='d-none d-lg-block'>Deposit</span></a>
                    </li>
                    <li>
                    <a href='#' name='0' type='withdrawal' class='btn btn-transaction rounded text-danger' onClick='deployedForm(this.name, this.type)'>
                    <i class='fas fa-coins'></i><i class='fas fa-minus fa-xs ps-1'></i>
                    <span class='d-none d-lg-block'>Withdrawal</span></a>
                    </li>
                    <li>
                    <button href='#' id='0' class='btn btn-transaction rounded' onClick='deleteAccount($i)'>
                    <i class='fas fa-trash-alt'></i>
                    <span class='d-none d-lg-block'>Delete</span></button>
                    </li>  
                </ul>
                </div>
                <!-- deposit & withdrawal form -->
                <div class='d-none form m-3'>
                <form action='account.php?id=<?php echo $id;?>' method='post' class='text-center pt-3'>
                    <i class='fas fa-coins'></i><label class='mt-2' for='sum'></label>
                    <input type='number' class='form-control my-2' name='sum' placeholder='Ex: 70' min='50'>
                    <small class='form-text help'></small>
                    <div class='d-flex justify-content-center'>
                        <input class='btn btn-transaction my-2' type='submit' value='Confirm'>
                    </div>
                </form>
                </div>

                <?php
                if (isset($_POST['sum'])) {
                    $sum=htmlspecialchars($_POST["sum"]);
                    $request = "UPDATE Accounts SET balance = balance + $sum WHERE id='$id'";
                    $depositStatement = $connection->prepare($request);
                    $depositStatement->execute();
                    } else {
                        $errorMessage = 'Error';
                }
                ?>

        </article>
    </div>
</main>

<?php
    include "template/footer.php";
?>
<script src="js/main.js"></script>