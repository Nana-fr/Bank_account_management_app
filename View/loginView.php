<main class="container text-center px-3 font-Zen">
  <h2 class="fw-bold text-decoration-underline py-5">Please enter your email and password to log in:</h2>

<?php if(!isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])): ?>
<form method="post" action="../Controller/login.php">
    <label for="login">Login:</label>
    <input type="text" name="email">
    <label  class="ms-3" for="password" >Password:</label>
    <input type="password" name="password_customer"><br>
    <input type="submit" class="btn btn-transaction my-5" value="Submit">
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
</form>
<?php endif; ?>
</main>