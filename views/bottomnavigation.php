<?php if (isset($_SESSION['user'])): ?>
    <nav class="bottom-bar">
        <ul class="navbar-bottom">
            <li class="nav-item">
                <a class="nav-link" href="/index.php"><i class="fas fa-home fa-1x"></i></a>
            </li>

            <?php if (isset($_SESSION['user'])): ?>
                <li>
                    <a class="plus-btn" href="/newpost.php"><i class="fas fa-plus fa-1x"></i></a>
                </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user'])): ?>
                <li>
                    <a  href="/profile.php"><i class="fas fa-user fa-1x"></i></a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
