<?php
 session_start();
 session_unset();
 session_destroy();
  require "../Model/install.php";
  include "../template/header.php";
  include "../template/nav.php";
  require "../View/logoutView.php";
  ?>