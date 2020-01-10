<nav class="top-bar">
    <ul class="navbar-top">
        <li class="nav-item">
            <a class="nav-link" href="/index.php">LOGO</a>
        </li>

        <li>
            <?php if (isset($_SESSION['user'])): ?>
                <a  href="/app/users/logout.php"><i class="fas fa-sign-out-alt fa-1x"></i></a>
            <?php else: ?>
                <a <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php"><i class="fas fa-sign-in-alt fa-1x"></i></a>
            <?php endif; ?>
        </li>
    </ul>
</nav>
