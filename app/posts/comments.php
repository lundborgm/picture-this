<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');

if (isset($_POST['comment'])) {

    $userId = $_SESSION['user']['id'];
    $postId = $_POST['post-id'];
    $comment = $_POST['comment'];

    date_default_timezone_set('Europe/Stockholm');
    $date = date('Y/m/d H:i');

    $query = 'INSERT INTO comments (post_id, user_id, comment, date) VALUES (:post_id, :user_id, :comment, :date)';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':post_id' => $postId,
        ':user_id' => $userId,
        ':comment' => $comment,
        ':date' => $date
    ]);

}

redirect('/');
