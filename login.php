 <!-- #### Header #### -->
 <?php
  include "template/header.php";
  include "template/nav.php";
  ?>

<main class="container">
<form method="post" action="index.php">
    <label for="login">Login:</label>
    <input type="text" name="login">
    <label for="password" >Password:</label>
    <input type="password" name="password">
    <input type="submit" value="submit" class="btn btn-transaction">
</form>
</main>

<?php
    include "template/footer.php";
?>
