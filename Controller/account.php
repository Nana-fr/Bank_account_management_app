<?php
  session_start();
  require "../Model/install.php";
  require "../data/accounts.php";
  require "../Model/getAccount.php";
  include "../template/header.php";
  include "../template/nav.php";
?>

<?php if (!empty($_GET) && isset($_GET["id"])) { 
        $id = htmlspecialchars($_GET["id"]);
        $account = get_account($connection, $id);
        $transactions = get_transactions($connection, $id);
        require "../View/accountView.php";
    } else {
        $error = "There is nothing here." ;
    }
;?>
     
