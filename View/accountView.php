<main class="container px-3 font-Zen">
    <h2 class="fw-bold text-center text-decoration-underline py-5">Data about <?php echo $account[0]->getAccount_type_name() . " n°" . $account[1]->getAccount_number();?></h2>

    <div class="row justify-content-center px-2">
        <article class='card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0'>
                <h5 class='card-header bg-Kobi text-white text-center'><?php echo $account[0]->getAccount_type_name() . " n°" .  $account[1]->getAccount_number();?></h5>
                <div class='card-body px-0 pb-0'>
                <h5 class='card-title text-center mb-3'>Owner: <?php echo $_SESSION["user"]->getFirstname() . " " . $_SESSION["user"]->getLastname();?></h5>
                <p class='card-text text-center fw-bold'>Balance:  <span class='fw-bold fs-5'><?php echo $account[1]->getBalance();?></span>€</p>
                    <table class='table table-bordered mt-3 mx-auto text-center bg-light'>
                        <thead>
                            <tr>
                                <th colspan='3'>Transactions:</th>
                            </tr>
                        </thead>
                      <?php foreach ($account[2] as $transaction){
                  echo "<tbody><tr><td>" . $transaction->getTransaction_type() . $transaction->getAmount() . "€ </td><td>" . $transaction->getTransaction_name() . "</td><td>" . $transaction->getTransaction_date() . "</td></tr></tbody>";
                };?></ul>
                </table>
                <ul class='px-0 pt-4 d-flex justify-content-around btnsBloc'>
                    <li>
                    <button href='#' id='Deposit' class='btn btn-transaction rounded text-success' onClick='deployedForm(this.id)'>
                    <i class='fas fa-coins'></i><i class='fas fa-plus fa-xs ps-1'></i>
                    <span class='d-none d-lg-block'>Deposit</span></button>
                    </li>
                    <li>
                    <button href='#' id='Withdrawal' class='btn btn-transaction rounded text-danger' onClick='deployedForm(this.id)'>
                    <i class='fas fa-coins'></i><i class='fas fa-minus fa-xs ps-1'></i>
                    <span class='d-none d-lg-block'>Withdrawal</span></button>
                    </li>
                    <li>
                        <form action='../Controller/operation.php' method='post'>
                        <button type='submit' name='delete' value='<?php echo $id;?>' class='btn btn-transaction rounded'>
                        <i class='fas fa-trash-alt'></i>
                        <span class='d-none d-lg-block'>Delete</span></button>
                        </form>
                    </li>  
                </ul>
                </div>
                <!-- deposit & withdrawal form -->
                <div class='d-none form m-3'>
                <form action='../Controller/operation.php' method='post' class='text-center pt-3'>
                    <i class='fas fa-coins'></i><label class='mt-2' for='sum'></label>
                    <input type="hidden" id="transaction_name" name="transaction_name" value=''>
                    <input type="hidden" id="account_id" name="account_id" value='<?php echo $id;?>'>
                    <input type='number' class='form-control my-2' name='amount' placeholder='Ex: 70' min='50'>
                    <small class='form-text help'></small>
                    <div class='d-flex justify-content-center'>
                        <input class='btn btn-transaction my-2' type='submit' name='d&w' value='Confirm'>
                    </div>
                </form>
                </div>
        </article>
    </div>
</main>