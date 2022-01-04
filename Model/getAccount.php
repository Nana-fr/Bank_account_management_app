<?php
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