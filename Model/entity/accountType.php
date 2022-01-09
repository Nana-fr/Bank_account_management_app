<?php
class Accounts_type {
    protected int $id;
    protected string $account_type_name;

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

    public function setId(int $id):Accounts_type {
        $this->id = $id;
        return $this;
    }
    public function getId():int {
        return $this->id;
    }
   
    public function getAccount_type_name():string {
        return $this->account_type_name;
    }
    public function setAccount_type_name(string $account_type_name):Accounts_type {
        $this->account_type_name = $account_type_name;
        return $this;
    }
}
    
?>