<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// You should only be able to delete your own posts if you're logged in
    if (isset($_SESSION['user'], $_POST['id'])) {
        // DELETE FROM posts WHERE id = :id AND user_id = :user_id;

    }

redirect('/');
