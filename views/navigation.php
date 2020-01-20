<?php if (isset($_SESSION['user'])) : ?>
    <nav class="top-bar">
        <ul class="navbar-top">
            <li class="nav-item">
                <a class="nav-link" href="/index.php"></a>
            </li>

            <li>
                <?php if (isset($_SESSION['user'])) : ?>

            <li>
                <form action="/searchView.php" method="post" class="search-form">
                    <label for="search"></label>
                    <input class="search-input" type="text" name="search" id="search">
                    <button type="submit" class="send"><i type='submit' class="fas fa-search fa-1x"></i></button> </form>
                </form>

            </li>
            <li>
                <a class="logout" href="/app/users/logout.php"><i class="fas fa-sign-out-alt fa-1x"></i></a>
            </li>
            </div>
        <?php else : ?>
            <a href="/app/users/login.php"><i class="fas fa-sign-in-alt fa-1x"></i></a>
        <?php endif; ?>
        </li>
        </ul>
    </nav>

    <nav class="bottom-bar">
        <ul class="navbar-bottom">
            <li class="nav-item">
                <a class="nav-link" href="/index.php"><i class="fas fa-home fa-1x"></i></a>
            </li>

            <li>
                <a class="plus-btn" href="/newpost.php"><i class="fas fa-plus fa-1x"></i></a>
            </li>

            <li>
                <a href="/profile.php"><i class="fas fa-user fa-1x"></i></a>
            </li>
        </ul>
    </nav>
<?php endif; ?>