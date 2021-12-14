<?php
  !isset($_SESSION['firstname']) || !isset($_SESSION['lastname'])? $log = 'login' : $log = 'logout';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-Kobi font-sixCaps fs-1 mb-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><i class="fas fa-piggy-bank fa-lg color pe-1"></i><span class="color fs-4">Piggy Bank</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php"><i class="fas fa-university color fa-xs pe-2"></i>Homepage</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="statistics.php"><i class="fas fa-chart-line color fa-xs pe-2"></i>Statistics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="blog.php"><i class="far fa-newspaper color fa-xs pe-2"></i>Blog</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo $log;?>.php" class="nav-link"><?php echo $log;?></a>
          </li>
          <li>
            <?php if($log === 'login') {
              echo "";
            } else {
              echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ;
            } ;?>
          </li>
        </ul>
      </div>
    </div>
</nav>