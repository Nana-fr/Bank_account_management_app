<?php
session_start();
include "template/header.php";
include "template/nav.php";
?>

  <!-- #### Blog page #### -->
  <main class="container px-3 font-Zen">

    <h2 class="fw-bold text-center text-decoration-underline py-5">Lastest news<i class="far fa-newspaper color ps-2"></i></h2>
    
    <!-- Display articles -->
    <div id="blog" class="row justify-content-center text-center px-2">
    </div>

  </main>

   <!-- #### Footer #### -->
 <?php
 include "template/footer.php";
?>
<script src="js/blog_page.js"></script>
