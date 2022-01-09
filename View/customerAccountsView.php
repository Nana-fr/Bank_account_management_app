<!-- #### Homepage #### -->
<main class="container px-3 font-Zen">
    <h2 class="fw-bold text-center text-decoration-underline py-5">My Banks Accounts<i class="fas fa-piggy-bank color ps-2"></i></h2>

    <!-- Display banks account -->
    <div id="newAccount" class="row justify-content-center px-2">
      <?php
      foreach ($accounts as list ($account, $accountType, $transaction, $customer)) {
        $i=$account->getId();
        // 
        // $lastTransaction = get_last_transaction($connection, $i);
          echo "<article class='card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0'>
            <h5 class='card-header bg-Kobi text-white text-center'>" . $accountType->getAccount_type_name() . " n°" . $account->getAccount_number() . "</h5>
            <div class='card-body d-flex flex-column px-0 pb-0'>
              <h5 class='card-title text-center fw-bold mb-3'>Owner: " . $customer->getFirstname() . " " . $customer->getLastname() . "</h5>
              <p class='card-text'>Balance:  <span class='fw-bold fs-5'>" . $account->getBalance() . "</span>€</p>
              <p class='card-text my-2'>Last transaction:  <span class='lastTransaction text-success fw-bold'>" . $transaction->getTransaction_type() . $transaction->getAmount() . "€ --- " . $transaction->getTransaction_name() . " --- " . $transaction->getTransaction_date() . "</span></p>
            </div>
        </article>";
        }
      ?>
    </div>
  </main>