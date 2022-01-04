<?php
function getAccounts($connection) {
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
    return $customer_id;
}

;?>