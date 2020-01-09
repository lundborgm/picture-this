<nav class="navbar">
  <!-- <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a> -->

  <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/index.php"><i class="fas fa-home fa-1x"></i></a>
    </li><!-- /nav-item -->

    <?php if (isset($_SESSION['user'])): ?>
        <li><a  href="profile.php"><i class="fas fa-user fa-1x"></i></a></li><!-- /nav-item -->
    <?php endif; ?>

    <li>
        <?php if (isset($_SESSION['user'])): ?>
            <a  href="/app/users/logout.php"><i class="fas fa-sign-out-alt fa-1x"></i></a>
            <?php else: ?>
            <a <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php"><i class="fas fa-sign-in-alt fa-1x"></i></a>
        <?php endif; ?>
    </li><!-- /nav-item -->

  </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
