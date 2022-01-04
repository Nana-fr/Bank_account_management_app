<?php
 session_start();
 session_unset();
 session_destroy();
  require "Model/install.php";
  include "template/header.php";
  include "template/nav.php";
  ?>
<main class="container text-center px-3 font-Zen">
    <h4 class="my-5">You have been logout.</h4>
</main>
<?php
    include "template/footer.php";
?>