<?php
  session_start();
  require "install.php";
  include "template/header.php";
  include "template/nav.php";
  ?>

<?php
$sqlQuery = 'SELECT * FROM Customers';
$customersStatement = $connection->prepare($sqlQuery);
$customersStatement->execute();
$customers = $customersStatement->fetchAll();
$login = [];
foreach ($customers as $customer) {
  $login += [$customer['email'] => $customer['password_customer']];
};

// CHECK FORM
if (isset($_POST['login']) && isset($_POST['password'])) {
    $mail=htmlspecialchars($_POST["login"]);
    $password=htmlspecialchars($_POST["password"]);

      $request = "SELECT id, firstname, lastname FROM Customers WHERE email = '$mail' AND password_customer = '$password'";
      $usernameStatement = $connection->prepare($request);
      $usernameStatement->execute();
      $username = $usernameStatement->fetch(PDO::FETCH_ASSOC);
      if ($username) {
        $_SESSION['firstname'] = $username['firstname'];
        $_SESSION['lastname'] = $username['lastname'];
        $_SESSION['id'] = $username['id'];
        header('Location: index.php');
      } else {
        $errorMessage = 'Login and/or password incorrect.';
      }
}
?>
  
<main class="container text-center px-3 font-Zen">
  <h2 class="fw-bold text-decoration-underline py-5">Please enter your email and password to log in:</h2>

<?php if(!isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])): ?>
<form method="post" action="login.php">
    <label for="login">Login:</label>
    <input type="text" name="login">
    <label  class="ms-3" for="password" >Password:</label>
    <input type="password" name="password"><br>
    <input type="submit" class="btn btn-transaction my-5" value="Submit">
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