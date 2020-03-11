<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');
if (isset($_POST['delete-reply'])) {
    $commentId = $_POST['delete-reply'];
    $date = $_POST['date'];

    $query = 'DELETE FROM reply_comments where date=:date';
    $statement = $pdo->prepare($query);


    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':date' => $date,
    ]);

    redirect('/');
}

if (isset($_POST['delete-comment'])) {
    $commentId = $_POST['comment-id'];

    $query = 'DELETE FROM comments where id=:id';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $commentId,
    ]);
    
    $query = 'DELETE FROM reply_comments where comment_id=:comment_id';
    $statement = $pdo->prepare($query);


    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':comment_id' => $commentId,
    ]);

 
    redirect('/') ;
}
