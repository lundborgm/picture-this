<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (!loggedIn()) {
    redirect('/');
}

    if (isset($_GET['id'], $_GET['author_id'])) {
        $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $authorId = filter_var($_GET['author_id'], FILTER_SANITIZE_NUMBER_INT);
        $userId = $_SESSION['user']['id'];

        // The users should only be able to delete their own posts
        if ($userId !== $authorId) {

            $_SESSION['errors'] = ["Fail, you can only delete your own posts!"];
            redirect('/profile.php');

        } else {

        $query = 'DELETE FROM posts WHERE id = :id AND author_id = :author_id';

        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':id' => $postId,
            ':author_id' => $authorId,
        ]);

        $_SESSION['messages'] = ["Post deleted!"];
        redirect('/profile.php');

        }
    }


