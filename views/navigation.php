<nav class="navbar">
  <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

  <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="/index.php">Home</a>
    </li><!-- /nav-item -->

    <li class="nav-item">
        <a class="nav-link" href="/about.php">About</a>
    </li><!-- /nav-item -->

    <?php if (isset($_SESSION['user'])): ?>
        <li><a  href="profile.php">Profile</a></li><!-- /nav-item -->
    <?php endif; ?>

    <li>
        <?php if (isset($_SESSION['user'])): ?>
            <a  href="/app/users/logout.php">Logout</a>
            <?php else: ?>
            <a <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
        <?php endif; ?>
    </li><!-- /nav-item -->

  </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
