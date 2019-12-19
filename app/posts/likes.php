<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['like'])) {

    $postId = $_POST['like'];
    $userId = $_SESSION['user']['id'];

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

redirect('/');
