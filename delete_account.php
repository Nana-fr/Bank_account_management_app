 <!-- #### Header #### -->
 <?php
 session_start();
  require "install.php";
  include "template/header.php";
  include "template/nav.php";

  if (isset($_POST['idToDelete'])) { 
    $idToDelete = $_POST['idToDelete'];
    $sqlQuery = "DELETE FROM Transactions WHERE Transactions.account_id='$idToDelete'";
    $deleteStatement = $connection->prepare($sqlQuery);
    $deleteStatement->execute();
    $sqlQuery = "DELETE FROM Accounts WHERE Accounts.id='$idToDelete'";
    $deleteStatement = $connection->prepare($sqlQuery);
    $deleteStatement->execute();
}
  ?>

<main>
    <p>This account has been successfully deleted.</p>
</main>


<?php
    include "template/footer.php";
?>