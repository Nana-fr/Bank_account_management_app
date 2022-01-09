<?php

require_once "connexionBdd.php";

final class UserDataManager extends ConnexionBdd {

    public function edit_data(Adviser|Customer $user) {
    $request = "UPDATE Customer SET ";
    foreach (array_keys($_POST) as $key) { 
      if(is_numeric($_POST[$key])){
        $request .= $key ." = " . $_POST[$key] . ", ";
      } else {
        $request .= $key ." = " . "'" . $_POST[$key] . "'" . ", ";
      }
    }
    $request = trim($request, ' ');
    $request = trim($request, ',');
    $request .= " WHERE id=:id";
    $editStatement = $this->db->prepare($request);
    $result=$editStatement->execute(["id"=>$user->getId()]);
    return $result;
  }

  public function updateUser(Adviser|Customer $user) {
    $request = "SELECT * FROM Customer WHERE id = :id";
    $usernameStatement = $this->db->prepare($request);
    $usernameStatement->execute(["id" => $user->getId()]);
    $username = $usernameStatement->fetch(PDO::FETCH_ASSOC);
    return $username;
  }

  public function getCustomersList(Adviser $user) {
    $request = $this->db->prepare("SELECT * FROM Customer WHERE adviser_id=:adviser_id");
    $request->execute(["adviser_id" => $user->getId()]);
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}




//  function get_user_data($firstname, $lastname, $id) {
//     $sqlQuery = "SELECT * FROM Customers WHERE firstname='$firstname' AND lastname='$lastname' AND id='$id'";
//     $accountStatement = $connection->prepare($sqlQuery);
//     $accountStatement->execute();
//     $account = $accountStatement->fetch(PDO::FETCH_ASSOC);
//     return $account;
//  }

 
 // edit data
//  foreach (array_values($_POST) as $value){
//    if ($value === ""){
//      $error = "no values";
//    }
//  };
//  if (isset($_POST) && !isset($error)) {
//    foreach (array_keys($_POST) as $key) {
//      $value=htmlspecialchars($_POST[$key]);
//      $request = "UPDATE Customers SET $key = '$value' WHERE id='$id'";
//      $editStatement = $connection->prepare($request);
//      $editStatement->execute();          
//    }
//  } else {
//    echo "<div class='alert alert-danger' role='alert'>" . $error . "</div>";
//  }

;?>