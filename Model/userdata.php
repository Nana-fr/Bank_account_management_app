<?php
 // get data
 $firstname = $_SESSION['firstname'];
 $lastname = $_SESSION['lastname'];
 $id = $_SESSION['id'];
 $sqlQuery = "SELECT * FROM Customers WHERE firstname='$firstname' AND lastname='$lastname' AND id='$id'";
 $accountStatement = $connection->prepare($sqlQuery);
 $accountStatement->execute();
 $account = $accountStatement->fetch(PDO::FETCH_ASSOC);
 
 // edit data
 foreach (array_values($_POST) as $value){
   if ($value === ""){
     $error = "no values";
   }
 };
 if (isset($_POST) && !isset($error)) {
   foreach (array_keys($_POST) as $key) {
     $value=htmlspecialchars($_POST[$key]);
     $request = "UPDATE Customers SET $key = '$value' WHERE id='$id'";
     $editStatement = $connection->prepare($request);
     $editStatement->execute();          
   }
 } else {
   echo "<div class='alert alert-danger' role='alert'>" . $error . "</div>";
 }
;?>