<?php
require_once "connexionBdd.php";

final class Accounts extends ConnexionBdd {

  public function getAccounts(Customer $user) {
    $sqlQuery = "SELECT Accounts.*, Accounts_type.account_type_name, Transactions.transaction_number, Transactions.transaction_name, Transactions.amount, Transactions.transaction_type, Transactions.transaction_date FROM Accounts INNER JOIN Accounts_type ON Accounts.account_type_id=Accounts_type.id LEFT JOIN Transactions ON Accounts.id=Transactions.account_id 
    WHERE Accounts.customer_id=:id && (Transactions.id = (SELECT id FROM Transactions WHERE Transactions.account_id=Accounts.id ORDER BY transaction_date DESC LIMIT 0, 1))";
    $accountsStatement = $this->db->prepare($sqlQuery);
    $accountsStatement->execute(["id" => $user->getId()]);
    $accounts = $accountsStatement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($accounts as $key => $account) {
      $accounts[$key] = [new Account($account), new Accounts_type($account), new Transaction($account)];
    }
    return $accounts;
  }



  public function getAccountsCustomer(Customer $customer) {
    $sqlQuery = "SELECT Accounts.*, Accounts_type.account_type_name, Transactions.transaction_number, Transactions.transaction_name, Transactions.amount, Transactions.transaction_type, Transactions.transaction_date, Customer.firstname, Customer.lastname FROM Accounts INNER JOIN Accounts_type ON Accounts.account_type_id=Accounts_type.id LEFT JOIN Transactions ON Accounts.id=Transactions.account_id INNER JOIN Customer ON Accounts.customer_id=Customer.id 
    WHERE Accounts.customer_id=:id && (Transactions.id = (SELECT id FROM Transactions WHERE Transactions.account_id=Accounts.id ORDER BY transaction_date DESC LIMIT 0, 1))";
    $accountsStatement = $this->db->prepare($sqlQuery);
    $accountsStatement->execute(["id" => $customer->getId()]);
    $accounts = $accountsStatement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($accounts as $key => $account) {
      $accounts[$key] = [new Account($account), new Accounts_type($account), new Transaction($account), $customer->setFirstname($account['firstname'])->setLastname($account['lastname'])];
    }
    return $accounts;
  }



  // function get_last_transaction($i) {
  //   $sqlQuery = "SELECT * FROM Transactions INNER JOIN Accounts ON account_id=Accounts.id WHERE Accounts.id='$i' ORDER BY transaction_date DESC LIMIT 0, 1";
  //   $lastTransactionStatement = $this->db->prepare($sqlQuery);
  //   $lastTransactionStatement->execute();
  //   $lastTransaction = $lastTransactionStatement->fetch();
  //   return $lastTransaction;
  // }
}

;?>