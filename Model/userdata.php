<?php

 function get_user_data($connection, $firstname, $lastname, $id) {
    $sqlQuery = "SELECT * FROM Customers WHERE firstname='$firstname' AND lastname='$lastname' AND id='$id'";
    $accountStatement = $connection->prepare($sqlQuery);
    $accountStatement->execute();
    $account = $accountStatement->fetch(PDO::FETCH_ASSOC);
    return $account;
 }

 
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
function edit_data($connection, $key, $value, $id) {
  $request = "UPDATE Customers SET $key = '$value' WHERE id='$id'";
  $editStatement = $connection->prepare($request);
  $editStatement->execute();  
} 
;?>