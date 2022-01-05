<?php
function delete($connection, $idToDelete) {
    $sqlQuery = "DELETE FROM Transactions WHERE Transactions.account_id='$idToDelete'";
    $deleteStatement = $connection->prepare($sqlQuery);
    $deleteStatement->execute();
    $sqlQuery = "DELETE FROM Accounts WHERE Accounts.id='$idToDelete'";
    $deleteStatement = $connection->prepare($sqlQuery);
    $deleteStatement->execute();
    }

    function deposit($connection, $deposit_sum, $id) {
        $request = "UPDATE Accounts SET balance = balance + $deposit_sum WHERE id='$id'";
        $depositStatement = $connection->prepare($request);
        $depositStatement->execute();
        $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (32569, 'Deposit', '$deposit_sum', '+', '$id', Now())";
        $addTransactionStatement = $connection->prepare($sqlQuery);
        $addTransactionStatement->execute();
    }
    
    function withdraw($connection, $withdrawal_sum, $id){
        $request = "UPDATE Accounts SET balance = balance - $withdrawal_sum WHERE id='$id'";
        $depositStatement = $connection->prepare($request);
        $depositStatement->execute();
        $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (32569, 'Withdrawal', '$withdrawal_sum', '-', '$id', Now())";
        $addTransactionStatement = $connection->prepare($sqlQuery);
        $addTransactionStatement->execute();
    }

    function transfer($connection, $sumTransfer, $accountCredit, $accountDebit) {  
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

      function create_account($connection, $accountType, $customer_id, $deposit) {
        $request = "INSERT INTO Accounts (account_number, account_type_id, customer_id, balance, created_date) VALUES (123456789, '$accountType', '$customer_id', '$deposit', Now())";
        $newAccountStatement = $connection->prepare($request);
        $newAccountStatement->execute();
        $sqlQuery = "SELECT id FROM Accounts WHERE id=(SELECT MAX(id) FROM Accounts)";
        $accountStatement = $connection->prepare($sqlQuery);
        $accountStatement->execute();
        $account_id= $accountStatement->fetch();
        return $account_id;
      }
     
      function add_first_transaction($connection, $deposit, $account_id) {
        $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (85214, 'Deposit for new account', '$deposit', '+', '$account_id[0]', Now())";
        $addTransactionStatement = $connection->prepare($sqlQuery);
        $addTransactionStatement->execute();
      }
?>