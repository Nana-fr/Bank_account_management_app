<?php
  session_start();
  require "Model/install.php";
  include "template/header.php";
  include "template/nav.php";
  if (!isset($_SESSION['firstname']) && !isset($_SESSION['lastname']) && !isset($_SESSION['id'])) {
    header('Location: login.php'); 
    exit();
  }
  require "Model/userdata.php";
?>

<main class="container px-3 font-Zen">
  <h2 class="fw-bold text-center text-decoration-underline py-5">Welcome <?php echo "$firstname $lastname";?></h2>
  <h3>Your personnal data: <i class="far fa-address-card"></i></h3>

  <form method="post" action="user.php">
    <label for="firstname">Firstname:</label>
    <input type="text" id="firstname" name="firstname" value="<?php echo ($account['firstname']);?>" disabled> <button id="editBtn1" class="btn-transaction editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this data" onclick="enableInput(this.id, event)"><i class="far fa-edit"></i></button>
    <label for="lastname">Lastname:</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo $account['lastname'];?>" disabled> <button id="editBtn2" class="btn-transaction editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this data" onclick="enableInput(this.id, event)"><i class="far fa-edit"></i></button><br>
    <label for="street">Street:</label> 
    <input type="text" id="street" name="street" value="<?php echo $account['street'];?>" disabled> <button id="editBtn3" class="btn-transaction editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this data" onclick="enableInput(this.id, event)"><i class="far fa-edit"></i></button><br>
    <label for="postcode">Postcode:</label>
    <input type="number" id="postcode" name="postcode" value="<?php echo $account['postcode'];?>" disabled> <button id="editBtn4" class="btn-transaction editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this data" onclick="enableInput(this.id, event)"><i class="far fa-edit"></i></button>
    <label for="city">City:</label>
    <input type="text" id="city" name="city" value="<?php echo $account['city'];?>" disabled> <button id="editBtn5" class="btn-transaction editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this data" onclick="enableInput(this.id, event)"><i class="far fa-edit"></i></button><br>
    <label for="country">Country:</label>
    <input type="text" id="country" name="country" value="<?php echo $account['country'];?>" disabled> <button id="editBtn6" class="btn-transaction editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this data" onclick="enableInput(this.id, event)"><i class="far fa-edit"></i></button><br>
    <label for="phone_number">Phone number:</label>
    <input type="tel" id="phone_number" name="phone_number" value="<?php echo $account['phone_number'];?>" disabled> <button id="editBtn7 editBtn" class="btn-transaction editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this data" onclick="enableInput(this.id, event)"><i class="far fa-edit"></i></button><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $account['email'];?>" disabled> <button id="editBtn8" class="btn-transaction editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this data" onclick="enableInput(this.id, event)"><i class="far fa-edit"></i></button><br>
    <input id="submit" class="d-none btn btn-transaction my-3" type="submit" value="Submit"> <button id="cancel" class="d-none btn btn-transaction my-3">Cancel</button>
</form>
  <button id="enableAll" class="btn btn-transaction my-3" onclick="enableAllInput()">Edit All Data</button>
</main>

<?php
    include "template/footer.php";
?>
 <script src="js/user_page.js"></script>