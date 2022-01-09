<?php
require_once "user.php";

class Customer extends User {

    protected int $adviser_id;

    public function getAdviser_id():int {
        return $this->adviser_id;
    }
    public function setAdviser_id(int $adviser_id):Customer {
        $this->adviser_id = $adviser_id;
        return $this;
    }
}

?>