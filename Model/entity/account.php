<?php

class Account {

    protected int $id;
    protected int $account_number;
    protected int $account_type_id;
    protected int $customer_id;
    protected float $balance;
    protected string $created_date;

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

    public function getAccount_number() {
        return $this->account_number;
    }
    public function setAccount_number($account_number) {
        $this->account_number = $account_number;
        return $this;
    }

    public function getAccount_type_id() {
        return $this->account_type_id;
    }
    public function setAccount_type_id($account_type_id) {
        $this->account_type_id = $account_type_id;
        return $this;
    }

    public function getCustomer_id() {
        return $this->customer_id;
    }
    public function setCustomer_id($customer_id) {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function getBalance() {
        return $this->balance;
    }
    public function setBalance($balance) {
        $this->balance = $balance;
        return $this;
    }

    public function getCreated_date() {
        return $this->created_date;
    }
    public function setCreated_date($created_date) {
        $this->created_date = $created_date;
        return $this;
    }
}

?>