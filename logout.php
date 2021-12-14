<?php
 session_start();
 session_destroy();
  require "install.php";
  include "template/header.php";
  include "template/nav.php";
  ?>
<main class="container">
    <p>You have been loggout.</p>
</main>
<?php
    include "template/footer.php";
?>