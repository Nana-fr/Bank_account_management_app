<?php
  include "template/header.php";
  include "template/nav.php";
?>

<main class="container px-3 font-Zen">
    <h2 class="fw-bold text-center text-decoration-underline py-5">Data about <?php echo $_POST["accountType"]?></h2>

    <div class="row justify-content-center px-2">
        <article class='card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0'>
                <h5 class='card-header bg-Kobi text-white text-center'><?php echo $_POST["accountType"]?></h5>
                <div class='card-body px-0 pb-0'>
                <h5 class='card-title text-center mb-3'>Owner: <?php echo ucfirst(strtolower($_POST["firstName"])) . " " . strtoupper($_POST["LastName"]);?></h5>
                <p class='card-text'>Balance:  <span class='fw-bold'><?php echo $_POST["deposit"];?></span>€</p>
                <p class='card-text'>Last transaction:  <span class='lastTransaction text-success fw-bold'>+<?php echo $_POST["deposit"];?>€ --- Deposit new account</span></p>
                <ul class='px-0 pt-4 d-flex justify-content-around btnsBloc'>
                    <li>
                    <a href='#' name='0' type='deposit' class='btn btn-transaction rounded text-success' onClick='deployedForm(this.name, this.type)'>
                    <i class='fas fa-coins'></i><i class='fas fa-plus fa-xs ps-1'></i>
                    <span class='d-none d-lg-block'>Deposit</span></a>
                    </li>
                    <li>
                    <a href='#' name='0' type='withdrawal' class='btn btn-transaction rounded text-danger' onClick='deployedForm(this.name, this.type)'>
                    <i class='fas fa-coins'></i><i class='fas fa-minus fa-xs ps-1'></i>
                    <span class='d-none d-lg-block'>Withdrawal</span></a>
                    </li>
                    <li>
                    <a href='#' id='0' class='btn btn-transaction rounded' onClick='deleteAccount(this.id)'>
                    <i class='fas fa-trash-alt'></i>
                    <span class='d-none d-lg-block'>Delete</span></a>
                    </li>  
                </ul>
                </div>
                <!-- deposit & withdrawal form -->
                <div class='d-none form m-3'>
                <form action='' method='' class='text-center pt-3'>
                    <i class='fas fa-coins'></i><label class='mt-2' for='sum'></label>
                    <input type='number' class='form-control my-2' name='sum' placeholder='Ex: 70' min='50'>
                    <small class='form-text help'></small>
                </form>
                <div class='d-flex justify-content-center'>
                    <button class='btn btn-transaction my-2' type='submit' value='Confirm'>Confirm</button>
                </div>
                </div>
        </article>
    </div>
</main>


   <!-- #### Footer #### -->
   <?php
      include "template/footer.php";
    ?>
    <script src="js/main.js"></script>