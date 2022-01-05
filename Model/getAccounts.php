<?php
function getAccounts($connection, $firstname, $lastname) {
 $sqlQuery = "SELECT Accounts.*, Accounts_type.account_type_name, Accounts.customer_id, Customers.firstname, Customers.lastname FROM Accounts INNER JOIN Accounts_type ON account_type_id=Accounts_type.id INNER JOIN Customers ON customer_id=Customers.id WHERE Customers.firstname='$firstname' AND Customers.lastname='$lastname'";
 $accountsStatement = $connection->prepare($sqlQuery);
 $accountsStatement->execute();
 $accounts = $accountsStatement->fetchAll(PDO::FETCH_ASSOC);
 return $accounts;
}
function get_last_transaction($connection, $i) {
  $sqlQuery = "SELECT * FROM Transactions INNER JOIN Accounts ON account_id=Accounts.id WHERE Accounts.id='$i' ORDER BY transaction_date DESC LIMIT 0, 1";
    $lastTransactionStatement = $connection->prepare($sqlQuery);
    $lastTransactionStatement->execute();
    $lastTransaction = $lastTransactionStatement->fetch();
    return $lastTransaction;
}
;?>