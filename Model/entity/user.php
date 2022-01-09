<?php

class User {

    protected int $id;
    protected string $user_type;
    protected string $firstname;
    protected string $lastname;
    protected string $password_customer;
    protected string $street;
    protected int $postcode;
    protected string $city;
    protected string $country;
    protected string $phone_number;
    protected string $email;
    protected string $birth_date;
    
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

    public function setId(int $id):self {
        $this->id = $id;
        return $this;
    }
    public function getId():int {
        return $this->id;
    }
   
    public function getUser_type():string {
        return $this->user_type;
    }
    public function setUser_type(string $user_type):self {
        $this->user_type = $user_type;
        return $this;
    }

    public function getFirstname():string {
        return $this->firstname;
    }
    public function setFirstname(string $firstname):self {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname():string {
        return $this->lastname;
    }
    public function setLastname(string $lastname):self {
        $this->lastname = $lastname;
        return $this;
    }

    public function getPassword_customer():string {
        return $this->password_customer;
    }
    public function setPassword_customer(string $password_customer):self {
        $this->password_customer = $password_customer;
        return $this;
    }

    public function getStreet():string {
        return $this->street;
    }
    public function setStreet(string $street):self {
        $this->street = $street;
        return $this;
    }

    public function getPostcode():int {
        return $this->postcode;
    }
    public function setPostcode(int $postcode):self {
        $this->postcode = $postcode;
        return $this;
    }

    public function getCity():string {
        return $this->city;
    }
    public function setCity(string $city):self {
        $this->city = $city;
        return $this;
    }

    public function getCountry():string {
        return $this->country;
    }
    public function setCountry(string $country):self {
        $this->country = $country;
        return $this;
    }

    public function getPhone_number():string {
        return $this->phone_number;
    }
    public function setPhone_number(string $phone_number):self {
        $this->phone_number = $phone_number;
        return $this;
    }

    public function setEmail(string $email):self {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return $this;
        }
        throw new Exception("Syntaxe email incorrect");
    }
    public function getEmail():string {
        return $this->email;
    }
    

    public function getBirth_date():string {
        return $this->subscript_date;
    }
    public function setBirth_date(string $birth_date):self {
        $this->subscript_date = $birth_date;
        return $this;
    }

}
?>