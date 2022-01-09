<?php

class Transaction {

    protected int $id;
    protected int $transaction_number;
    protected string $transaction_name;
    protected ?string $transaction_description = null;
    protected float $amount;
    protected string $transaction_type;
    protected int $account_id;
    protected string $transaction_date;

    public function __construct(array $data=null) {
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

    public function getId():int {
        return $this->id;
    }
    public function setId(int $id):Transaction {
        $this->id = $id;
        return $this;
    }

    public function getTransaction_number():int {
        return $this->transaction_number;
    }
    public function setTransaction_number(int $transaction_number):Transaction {
        $this->transaction_number = $transaction_number;
        return $this;
    }

    public function getTransaction_name():string {
        return $this->transaction_name;
    }
    public function setTransaction_name(string $transaction_name):Transaction {
        $this->transaction_name = $transaction_name;
        return $this;
    }

    public function getTransaction_description():string {
        return $this->transaction_description;
    }
    public function setTransaction_description(?string $transaction_description):Transaction {
        $this->transaction_description = $transaction_description;
        return $this;
    }

    public function getAmount():float {
        return $this->amount;
    }
    public function setAmount(float $amount):Transaction {
        $this->amount = $amount;
        return $this;
    }

    public function getTransaction_type():string {
        return $this->transaction_type;
    }

    public function setTransaction_type(string $transaction_type=NULL):Transaction {
        if ($transaction_type) {
            $this->transaction_type = $transaction_type;
            return $this;
        } else {
            if ($this->getTransaction_name() === "Deposit") {
                $this->transaction_type = '+';
            } else if ($this->getTransaction_name() === "Withdrawal") {
                $this->transaction_type = '-';
            }
        }
        return $this;
    }

    public function getAccount_id():int {
        return $this->account_id;
    }
    public function setAccount_id(int $account_id):Transaction {
        $this->account_id = $account_id;
        return $this;
    }

    public function getTransaction_date():string {
        return $this->transaction_date;
    }
    public function setTransaction_date(string $transaction_date):Transaction {
        $this->transaction_date = $transaction_date;
        return $this;
    }

}

?>