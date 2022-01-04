<?php
    if (isset($_POST['accountDebit']) && isset($_POST['sumTransfer']) && isset($_POST['accountCredit'])) {
  $accountDebit=unserialize($_POST["accountDebit"]);
  $sumTransfer=htmlspecialchars($_POST["sumTransfer"]);
  $accountCredit=unserialize($_POST["accountCredit"]);
  
  $request = "UPDATE Accounts SET balance = balance + $sumTransfer WHERE id='$accountCredit[0]'";
  $creditStatement = $connection->prepare($request);
  $creditStatement->execute();

  $sqlQuery = "UPDATE Accounts SET balance = balance - $sumTransfer WHERE id='$accountDebit[0]'";
  $debitStatement = $connection->prepare($sqlQuery);
  $debitStatement->execute();

  $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (87456, 'Transfer money from $accountDebit[1]', '$sumTransfer', '+', '$accountCredit[0]', Now())";
  $addTransactionStatement = $connection->prepare($sqlQuery);
  $addTransactionStatement->execute();

  $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (87456, 'Transfer money to $accountCredit[1]', '$sumTransfer', '-', '$accountDebit[0]', Now())";
  $addTransactionStatement = $connection->prepare($sqlQuery);
  $addTransactionStatement->execute();
  } 
 ;?>