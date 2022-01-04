 <!-- #### Header #### -->
 <?php
 session_start();
  require "Model/install.php";
  include "template/header.php";
  include "template/nav.php";
  require "Model/deleteSql.php";
  ?>

<main>
    <p>This account has been successfully deleted.</p>
</main>


<?php
    include "template/footer.php";
?>