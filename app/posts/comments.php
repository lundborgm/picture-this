<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');
if(isset($_POST['delete-comment'])){
        $commentId = $_POST['comment-id'];
        
        $query = 'DELETE FROM comments where id=:id';
        
        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement-> execute([
            ':id'=> $commentId,
        ]);

}
if (isset($_POST['comment'])) {

    $userId = (int)$_SESSION['user']['id'];
    $postId = (int)$_POST['post-id'];
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

    $names = getUsernameFromComment($userId, $pdo);

    $comments = ([
        'comment' => $comment,
        'name' => $names['name']
    ]);

    echo json_encode($comments);


}

// redirect('/');
