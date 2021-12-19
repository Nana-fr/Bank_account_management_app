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
    $sqlQuery = "SELECT * FROM Transactions INNER JOIN Accounts ON account_id=Accounts.id WHERE Accounts.id='$id' ORDER BY transaction_date DESC";
    $transactionsStatement = $connection->prepare($sqlQuery);
    $transactionsStatement->execute();
    $transactions = $transactionsStatement->fetchAll();
;?>

<main class="container px-3 font-Zen">
    <h2 class="fw-bold text-center text-decoration-underline py-5">Data about <?php echo $account["account_type_name"] . " n°" . $account["account_number"];?></h2>

    <div class="row justify-content-center px-2">
        <article class='card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0'>
                <h5 class='card-header bg-Kobi text-white text-center'><?php echo $account["account_type_name"] . " n°" . $account["account_number"];?></h5>
                <div class='card-body px-0 pb-0'>
                <h5 class='card-title text-center mb-3'>Owner: <?php echo $account["firstname"] . " " . $account["lastname"];?></h5>
                <p class='card-text text-center fw-bold'>Balance:  <span class='fw-bold fs-5'><?php echo $account["balance"];?></span>€</p>
                    <table class='table table-bordered mt-3 mx-auto text-center bg-light'>
                        <thead>
                            <tr>
                                <th colspan='3'>Transactions:</th>
                            </tr>
                        </thead>
                      <?php foreach ($transactions as $transaction){
                  echo "<tbody><tr><td>" . $transaction['transaction_type'] . $transaction['amount'] . "€ </td><td>" . $transaction['transaction_name'] . "</td><td>" . $transaction['transaction_date'] . "</td></tr></tbody>";
                };?></ul>
                </table>
                <ul class='px-0 pt-4 d-flex justify-content-around btnsBloc'>
                    <li>
                    <button href='#' name='deposit' type='deposit' class='btn btn-transaction rounded text-success' onClick='deployedForm(this.name)'>
                    <i class='fas fa-coins'></i><i class='fas fa-plus fa-xs ps-1'></i>
                    <span class='d-none d-lg-block'>Deposit</span></button>
                    </li>
                    <li>
                    <button href='#' name='withdrawal' type='withdrawal' class='btn btn-transaction rounded text-danger' onClick='deployedForm(this.name)'>
                    <i class='fas fa-coins'></i><i class='fas fa-minus fa-xs ps-1'></i>
                    <span class='d-none d-lg-block'>Withdrawal</span></button>
                    </li>
                    <li>
                        <form action='delete_account.php' method='post'>
                        <button type='submit' name='idToDelete' value='<?php echo $id;?>' class='btn btn-transaction rounded'>
                        <i class='fas fa-trash-alt'></i>
                        <span class='d-none d-lg-block'>Delete</span></button>
                        </form>
                    </li>  
                </ul>
                </div>
                <!-- deposit & withdrawal form -->
                <div class='d-none form m-3'>
                <form action='account.php?id=<?php echo $id;?>' method='post' class='text-center pt-3'>
                    <i class='fas fa-coins'></i><label class='mt-2' for='sum'></label>
                    <input type='number' class='form-control my-2' name='' placeholder='Ex: 70' min='50'>
                    <small class='form-text help'></small>
                    <div class='d-flex justify-content-center'>
                        <input class='btn btn-transaction my-2' type='submit' value='Confirm'>
                    </div>
                </form>
                </div>

                <?php
                if (isset($_POST['Deposit'])) {
                    $deposit_sum=htmlspecialchars($_POST["Deposit"]);
                    $request = "UPDATE Accounts SET balance = balance + $deposit_sum WHERE id='$id'";
                    $depositStatement = $connection->prepare($request);
                    $depositStatement->execute();
                    $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (32569, 'Deposit', '$deposit_sum', '+', '$id', Now())";
                    $addTransactionStatement = $connection->prepare($sqlQuery);
                    $addTransactionStatement->execute();
                } else if (isset($_POST['Withdrawal'])) {
                    $withdrawal_sum=htmlspecialchars($_POST["Withdrawal"]);
                    $request = "UPDATE Accounts SET balance = balance - $withdrawal_sum WHERE id='$id'";
                    $depositStatement = $connection->prepare($request);
                    $depositStatement->execute();
                    $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (32569, 'Withdrawal', '$withdrawal_sum', '-', '$id', Now())";
                    $addTransactionStatement = $connection->prepare($sqlQuery);
                    $addTransactionStatement->execute();
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