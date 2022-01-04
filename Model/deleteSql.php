<?php
if (isset($_POST['idToDelete'])) { 
    $idToDelete = $_POST['idToDelete'];
    $sqlQuery = "DELETE FROM Transactions WHERE Transactions.account_id='$idToDelete'";
    $deleteStatement = $connection->prepare($sqlQuery);
    $deleteStatement->execute();
    $sqlQuery = "DELETE FROM Accounts WHERE Accounts.id='$idToDelete'";
    $deleteStatement = $connection->prepare($sqlQuery);
    $deleteStatement->execute();
}
;?>