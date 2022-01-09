<?php

class Account {

    protected int $id;
    protected int $account_number;
    protected int $account_type_id;
    protected int $customer_id;
    protected float $balance;
    protected string $created_date;

    const MIN_AMOUNT = 50;

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
    public function setId(int $id):Account {
        $this->id = $id;
        return $this;
    }

    public function getAccount_number():int {
        return $this->account_number;
    }
    public function setAccount_number(int $account_number):Account {
        $this->account_number = $account_number;
        return $this;
    }

    public function getAccount_type_id():int {
        return $this->account_type_id;
    }
    public function setAccount_type_id(int $account_type_id):Account {
        $this->account_type_id = $account_type_id;
        return $this;
    }

    public function getCustomer_id():int {
        return $this->customer_id;
    }
    public function setCustomer_id(int $customer_id):Account {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function getBalance():float {
        return $this->balance;
    }
    public function setBalance(float $balance):Account {
        $this->balance = $balance;
        return $this;
    }

    public function getCreated_date():string {
        return $this->created_date;
    }
    public function setCreated_date(string $created_date):Account {
        $this->created_date = $created_date;
        return $this;
    }

    public function UpdateBalance(Transaction $transaction) {
        if ($transaction->getAmount() >= self::MIN_AMOUNT) {
           if ($transaction->getTransaction_type() === "+") {
                $newBalance = $this->getBalance() + $transaction->getAmount();
            } else {
                $newBalance = $this->getBalance() - $transaction->getAmount();
            }
            $this->setBalance($newBalance);
        } else {
            throw new Exception("<li>Minimal amount : 50 euros</li>");
        }
    }
}

?>