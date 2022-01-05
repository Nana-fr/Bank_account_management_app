<?php

class Customer {

    protected int $id;
    protected string $firstname;
    protected string $lastname;
    protected string $password_customer;
    protected string $street;
    protected int $postcode;
    protected string $city;
    protected string $country;
    protected string $phone_number;
    protected string $email;
    protected string $subscript_date;
    
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

    public function setId($id) {
            $this->id = $id;
            return $this;
        }
    public function getId() {
        return $this->id;
    }
   

    public function getFirstname() {
        return $this->firstname;
    }
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname() {
        return $this->lastname;
    }
    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function getPassword_customer() {
        return $this->password_customer;
    }
    public function setPassword_customer($password_customer) {
        $this->password_customer = $password_customer;
        return $this;
    }

    public function getStreet() {
        return $this->street;
    }
    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    public function getPostcode() {
        return $this->postcode;
    }
    public function setPostcode($postcode) {
        $this->postcode = $postcode;
        return $this;
    }

    public function getCity() {
        return $this->city;
    }
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function getCountry() {
        return $this->country;
    }
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function getPhone_number() {
        return $this->phone_number;
    }
    public function setPhone_number($phone_number) {
        $this->phone_number = $phone_number;
        return $this;
    }

    public function setEmail(string $email):Customer {
        $this->email = $email;
        return $this;
    }
    public function getEmail():string {
        return $this->email;
    }
    

    public function getSubscript_date() {
        return $this->subscript_date;
    }
    public function setSubscript_date($subscript_date) {
        $this->subscript_date = $subscript_date;
        return $this;
    }
}

?>