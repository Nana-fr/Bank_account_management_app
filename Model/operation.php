<?php
require_once "connexionBdd.php";

final class OperationManager extends ConnexionBdd {

  // function delete($idToDelete) {
  //   $sqlQuery = "DELETE FROM Transactions WHERE Transactions.account_id='$idToDelete'";
  //   $deleteStatement = $this->db->prepare($sqlQuery);
  //   $deleteStatement->execute();
  //   $sqlQuery = "DELETE FROM Accounts WHERE Accounts.id='$idToDelete'";
  //   $deleteStatement = $this->db->prepare($sqlQuery);
  //   $deleteStatement->execute();
  //   }

  //   function deposit($deposit_sum, $id) {
  //       $request = "UPDATE Accounts SET balance = balance + $deposit_sum WHERE id='$id'";
  //       $depositStatement = $this->db->prepare($request);
  //       $depositStatement->execute();
  //       $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (32569, 'Deposit', '$deposit_sum', '+', '$id', Now())";
  //       $addTransactionStatement = $this->db->prepare($sqlQuery);
  //       $addTransactionStatement->execute();
  //   }
    
  //   function withdraw($withdrawal_sum, $id){
  //       $request = "UPDATE Accounts SET balance = balance - $withdrawal_sum WHERE id='$id'";
  //       $depositStatement = $this->db->prepare($request);
  //       $depositStatement->execute();
  //       $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (32569, 'Withdrawal', '$withdrawal_sum', '-', '$id', Now())";
  //       $addTransactionStatement = $this->db->prepare($sqlQuery);
  //       $addTransactionStatement->execute();
  //   }

  //   function transfer($sumTransfer, $accountCredit, $accountDebit) {  
  //       $request = "UPDATE Accounts SET balance = balance + $sumTransfer WHERE id='$accountCredit[0]'";
  //       $creditStatement = $this->db->prepare($request);
  //       $creditStatement->execute();
    
  //       $sqlQuery = "UPDATE Accounts SET balance = balance - $sumTransfer WHERE id='$accountDebit[0]'";
  //       $debitStatement = $this->db->prepare($sqlQuery);
  //       $debitStatement->execute();
    
  //       $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (87456, 'Transfer money from $accountDebit[1]', '$sumTransfer', '+', '$accountCredit[0]', Now())";
  //       $addTransactionStatement = $this->db->prepare($sqlQuery);
  //       $addTransactionStatement->execute();
    
  //       $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (87456, 'Transfer money to $accountCredit[1]', '$sumTransfer', '-', '$accountDebit[0]', Now())";
  //       $addTransactionStatement = $this->db->prepare($sqlQuery);
  //       $addTransactionStatement->execute();
  //     }

  //     function create_account($accountType, $customer_id, $deposit) {
  //       $request = "INSERT INTO Accounts (account_number, account_type_id, customer_id, balance, created_date) VALUES (123456789, '$accountType', '$customer_id', '$deposit', Now())";
  //       $newAccountStatement = $this->db->prepare($request);
  //       $newAccountStatement->execute();
  //       $sqlQuery = "SELECT id FROM Accounts WHERE id=(SELECT MAX(id) FROM Accounts)";
  //       $accountStatement = $this->db->prepare($sqlQuery);
  //       $accountStatement->execute();
  //       $account_id= $accountStatement->fetch();
  //       return $account_id;
  //     }
     
  //     function add_first_transaction($deposit, $account_id) {
  //       $sqlQuery = "INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (85214, 'Deposit for new account', '$deposit', '+', '$account_id[0]', Now())";
  //       $addTransactionStatement = $this->db->prepare($sqlQuery);
  //       $addTransactionStatement->execute();
  //     }




      public function addAccount(Account $account) {
        $request = $this->db->prepare("INSERT INTO Accounts (account_number, account_type_id, customer_id, balance, created_date) VALUES (:account_number, :account_type_id, :customer_id, :balance, Now())");
        $result = $request->execute([
          'account_number' => $x = mt_Rand(100000000,999999999),
          'account_type_id' => $account->getAccount_type_id(),
          'customer_id' => $account->getCustomer_id(),
          'balance' => $account->getBalance(),
        ]);
        return $result;
      }

    public function addTransaction(Transaction $transaction, int $account_id) {
      $sqlQuery = $this->db->prepare("INSERT INTO Transactions (transaction_number, transaction_name, amount, transaction_type, account_id, transaction_date) VALUES (:transaction_number, :transaction_name, :amount, :transaction_type, :account_id, Now())");
      $result = $sqlQuery->execute([
          "transaction_number" => $x = mt_Rand(100000,999999),
          "transaction_name" => $transaction->getTransaction_name(),
          "amount" => $transaction->getAmount(),
          "transaction_type" => $transaction->getTransaction_type(),
          "account_id" => $account_id,
        ]);
      return $result;
    }

    public function updateBalance(Account $account) {
      $request = $this->db->prepare("UPDATE Accounts SET balance = :balance WHERE id=:id");
      $result = $request->execute(["balance"=> $account->getBalance(), "id"=> $account->getId()]);
      return $result;
    }

    public function makeDepositWithdrawal(Transaction $transaction, Account $account) {
      try {
        $this->db->beginTransaction();
        $this->addTransaction($transaction, $account->getId());
        $this->updateBalance($account);
        $this->db->commit();
        return true;
      } catch (PDOException $e) {
        $this->db->rollBack();
        echo $e->getMessage();
        return false;
      }
    }

    public function makeMoneyTransfer(Transaction $transactionDebit, Account $accountDebit, Transaction $transactionCredit, Account $accountCredit) {
      try {
        $this->db->beginTransaction();
        $this->addTransaction($transactionDebit, $accountDebit->getId());
        $this->updateBalance($accountDebit);
        $this->addTransaction($transactionCredit, $accountCredit->getId());
        $this->updateBalance($accountCredit);
        $this->db->commit();
        return true;
      } catch (PDOException $e) {
        $this->db->rollBack();
        echo $e->getMessage();
        return false;
      }
    }

    public function newAccount(Account $account, Transaction $transaction) {
      try {
        $this->db->beginTransaction();
        $accountManager = new AccountManager();
        $account_data = $accountManager->get_account_data($account);
        $this->addTransaction($transaction, $account_data['id']);
        $account->setAccount_number($account_data['account_number']);
        $this->db->commit();
        return true;
      } catch (PDOExecption $e) {
        $this->db->rollBack();
        echo $e->getMessage();
        return false;
      }
    }
}

?>