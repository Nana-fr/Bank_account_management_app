<?php
function newAccount($connection, $customer_id) {
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
}
;?>