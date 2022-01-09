<nav class="navbar navbar-expand-lg navbar-light bg-Kobi font-sixCaps fs-1 mb-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php"><i class="fas fa-piggy-bank fa-lg color pe-1"></i><span class="color fs-4">Piggy Bank</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../index.php"><i class="fas fa-university color fa-xs pe-2"></i>Homepage</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Controller/statistics.php"><i class="fas fa-chart-line color fa-xs pe-2"></i>Statistics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Controller/blog.php"><i class="far fa-newspaper color fa-xs pe-2"></i>Blog</a>
          </li>
          <?php if(!isset($_SESSION['user'])): ?>
          <li class="nav-item">
            <a href="../Controller/login.php" class="nav-link">login</a>
          </li>
          <?php else :?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user-circle color pe-2"></i><?php echo $_SESSION['user']->getFirstname() . " " . $_SESSION['user']->getLastname();?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item font-Zen color" href="../Controller/user.php">See profile</a></li>
            <li><a class="dropdown-item font-Zen color" href="../Controller/logout.php">Log out</a></li>
          </ul>
        </li>
        <?php endif; ?>
        </ul>
      </div>
    </div>
</nav>