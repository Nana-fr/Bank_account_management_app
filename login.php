 <!-- #### Header #### -->
 <?php
 session_start();
  require "install.php";
  include "template/header.php";
  include "template/nav.php";
  ?>

<?php

// Validation du formulaire
if (isset($_POST['login']) && isset($_POST['password'])) {
    $mail=htmlspecialchars($_POST["login"]);
    $password=htmlspecialchars($_POST["password"]);
    if (array_key_exists($mail, $login) === false || $login[$mail] !== $password) {
        $errorMessage = 'Les informations envoyées ne permettent pas de vous identifier';
      } else {
      $request = "SELECT firstname, lastname FROM Customers WHERE email = '$mail' AND password_customer = '$password'";
      $usernameStatement = $connection->prepare($request);
      $usernameStatement->execute();
      $username = $usernameStatement->fetchAll();
      $_SESSION['firstname'] = $username[0]['firstname'];
      $_SESSION['lastname'] = $username[0]['lastname'];
      header('Location: index.php');
    }
}
?>

<main class="container">
<?php if(!isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])): ?>
<form method="post" action="">
    <label for="login">Login:</label>
    <input type="text" name="login">
    <label for="password" >Password:</label>
    <input type="password" name="password">
    <button type="submit" class="btn btn-transaction">submit</button>
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
</form>
<?php endif; ?>
</main>

<?php
    include "template/footer.php";
?>