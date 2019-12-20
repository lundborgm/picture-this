<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['like'])) {

    $postId = (int)$_POST['like'];
    $userId = (int)$_SESSION['user']['id'];

    if ((checkForLikes($postId, $userId, $pdo))) {
        // Unlike if post is already liked and remove row from database

        $query = 'DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id';

        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':post_id' => $postId,
            ':user_id' => $userId,
        ]);

    } else {

    $query = 'INSERT INTO likes (post_id, user_id) VALUES (:post_id, :user_id)';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':post_id' => $postId,
        ':user_id' => $userId,
    ]);

    }

    $likes = countLikes($postId, $pdo);
    $likes = json_encode($likes);
    header('Content-Type: application/json');
    echo $likes;
}


// redirect('/');
