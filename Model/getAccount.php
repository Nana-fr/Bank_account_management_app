<?php
require_once "connexionBdd.php";
require_once "entity/account.php";

final class AccountManager extends ConnexionBdd {

    public function get_account($id, Customer $user) {
    $sqlQuery = "SELECT * FROM Accounts INNER JOIN Accounts_type ON Accounts.account_type_id=Accounts_type.id INNER JOIN Transactions ON Accounts.id=Transactions.account_id WHERE Accounts.id=:id AND Accounts.customer_id=:userId ORDER BY transaction_date DESC";
    $accountStatement = $this->db->prepare($sqlQuery);
    $accountStatement->execute(["id" => $id, "userId" => $user->getId()]);
    $data = $accountStatement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $key=>$transactions) {
        $transactionsList[$key] = new Transaction($transactions);
    }
    $account = [new Accounts_type($data[0]), new Account($data[0]), $transactionsList];
    return $account;
    }

    public function get_balance($id, Customer $user) {
        $sqlQuery = $this->db->prepare("SELECT id, balance FROM Accounts WHERE id=:id AND customer_id=:userId");
        $sqlQuery->execute(["id" => $id, "userId" => $user->getId()]);
        $data = $sqlQuery->fetch(PDO::FETCH_ASSOC);
        return new Account($data);  
    }

    public function get_account_data(Account $account) {
        $sqlQuery = $this->db->prepare("SELECT id, account_number FROM Accounts WHERE customer_id=:customer_id ORDER BY created_date DESC LIMIT 0, 1");
        $sqlQuery->execute(['customer_id' => $account->getCustomer_id()]);
        $data = $sqlQuery->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function delete_transaction(Account $account_to_delete) {
        $sqlQuery = $this->db->prepare("DELETE FROM Transactions WHERE account_id=:account_id");
        $result = $sqlQuery->execute(['account_id' => $account_to_delete->getId()]);
        return $result;
    }

    public function delete_account(Account $account_to_delete) {
        $sqlQuery = $this->db->prepare("DELETE FROM Accounts WHERE id=:id AND customer_id=:customer_id");
        $result = $sqlQuery->execute(['id' => $account_to_delete->getId(), 'customer_id' => $account_to_delete->getCustomer_id()]);
        return $result;
    }

    
    public function deleteAccount(Account $account_to_delete) {
        try {
          $this->db->beginTransaction();
          $this->delete_transaction($account_to_delete);
          $this->delete_account($account_to_delete);
          $this->db->commit();
          return true;
        } catch (PDOExecption $e) {
          $this->db->rollBack();
          echo $e->getMessage();
          return false;
        }
    }

    // function get_transactions($connection, $id){
    //     $sqlQuery = "SELECT * FROM Transactions INNER JOIN Accounts ON account_id=Accounts.id WHERE Accounts.id='$id' ";
    //     $transactionsStatement = $connection->prepare($sqlQuery);
    //     $transactionsStatement->execute();
    //     $transactions = $transactionsStatement->fetchAll();
    //     return $transactions;
    // }   
}

;?>

