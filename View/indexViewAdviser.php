<!-- #### Homepage #### -->
<main class="container px-3 font-Zen">

    <h2 class="fw-bold text-center text-decoration-underline py-5">List of Customers:</h2>

    <div class="row justify-content-center px-2">

        <?php foreach ($listCustomers as $customer): ?>
        <article class='card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0'>
            <h4 class='card-header bg-Kobi text-white text-center'><?php echo $customer->getFirstname() . ' ' . $customer->getLastname() ;?></h5>
            <div class='card-body d-flex flex-column px-0 pb-0'>
              <h5 class='card-title text-center fw-bold mb-3'>Contact data:</h5>
              <p class='card-text text-center'>
                <?php echo $customer->getStreet() . '<br>' .
                $customer->getPostcode() . ' ' . $customer->getCity() . '<br>' .
                $customer->getCountry();
                ?>
              </p>
              <p class='card-text my-2'><span class='fw-bold'>Phone number: </span><?php echo $customer->getPhone_number() . '<br><span class=\'fw-bold\'>Email: </span>' . $customer->getEmail();?></p>
              <a href='<?php echo'../Controller/customerAccounts.php?id=' . $customer->getId();?>' class='btn btn-transaction rounded align-self-center my-2'>See accounts</a>
            </div>
        </article>
        <?php endforeach;?>
    </div>
 
  </main>