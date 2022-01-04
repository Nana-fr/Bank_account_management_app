<?php
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
    exit();
  } else {
    $errorMessage = 'Login and/or password incorrect.';
  }
}
?>