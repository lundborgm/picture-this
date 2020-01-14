<nav class="top-bar">
    <ul class="navbar-top">
        <li class="nav-item">
            <a class="nav-link" href="/index.php">LOGO</a>
        </li>

        <li>
            <?php if (isset($_SESSION['user'])): ?>
                <a  href="/app/users/logout.php"><i class="fas fa-sign-out-alt fa-1x"></i></a>
            <?php else: ?>
                <a href="/app/users/login.php"><i class="fas fa-sign-in-alt fa-1x"></i></a>
            <?php endif; ?>
        </li>
    </ul>
</nav>

<?php if (isset($_SESSION['user'])): ?>
    <nav class="bottom-bar">
        <ul class="navbar-bottom">
            <li class="nav-item">
                <a class="nav-link" href="/index.php"><i class="fas fa-home fa-1x"></i></a>
            </li>

            <li>
                <a class="plus-btn" href="/newpost.php"><i class="fas fa-plus fa-1x"></i></a>
            </li>

            <li>
                <a  href="/profile.php"><i class="fas fa-user fa-1x"></i></a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

