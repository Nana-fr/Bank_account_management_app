<?php
require "../Model/entity/user.php";
require "../Model/entity/customer.php";
require "../Model/entity/adviser.php";
 session_start();
 session_unset();
 session_destroy();
  
include "../template/header.php";
include "../template/nav.php";
require "../View/logoutView.php";
include "../template/footer.php";
?>