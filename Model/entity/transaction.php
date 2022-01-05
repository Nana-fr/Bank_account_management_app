<?php

class Transaction {

    protected int $id;
    protected int $transaction_number;
    protected string $transaction_name;
    protected string $transaction_description;
    protected float $amount;
    protected string $transaction_type;
    protected int $account_id;
    protected string $transaction_date;

    public function __contructor(array $data=null) {
        if ($data) {
            $this->hydrate($data);
        }
    }
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
          $method = "set". ucfirst($key);
          if(method_exists($this, $method)) {
            $this->$method($value);
          }
        }
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getTransaction_number() {
        return $this->transaction_number;
    }
    public function setTransaction_number($transaction_number) {
        $this->transaction_number = $transaction_number;
        return $this;
    }

    public function getTransaction_name() {
        return $this->transaction_name;
    }
    public function setTransaction_name($transaction_name) {
        $this->transaction_name = $transaction_name;
        return $this;
    }

    public function getTransaction_description() {
        return $this->transaction_description;
    }
    public function setTransaction_description($transaction_description) {
        $this->transaction_description = $transaction_description;
        return $this;
    }

    public function getAmount() {
        return $this->amount;
    }
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    public function getTransaction_type() {
        return $this->transaction_type;
    }
    public function setTransaction_type($transaction_type) {
        $this->transaction_type = $transaction_type;
        return $this;
    }

    public function getAccount_id() {
        return $this->account_id;
    }
    public function setAccount_id($account_id) {
        $this->account_id = $account_id;
        return $this;
    }

    public function getTransaction_date() {
        return $this->transaction_date;
    }
    public function setTransaction_date($transaction_date) {
        $this->transaction_date = $transaction_date;
        return $this;
    }
}

?>