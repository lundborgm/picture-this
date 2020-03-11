<?php
require __DIR__.'/../autoload.php';

if (isset($_POST['newComment'])) {
    $newComment = filter_var($_POST['newComment'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $commentId = $_POST['comment-id'];

    $query = 'UPDATE comments SET comment=:comment where id=:id';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
 
    $statement->execute([
        ':id' => $commentId,
        ':comment'=> $newComment
    ]);
    echo json_encode('200');
    //  redirect('/');
}

if (isset($_POST['newReply'])) {
    $newReply = filter_var($_POST['newReply'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $date = $_POST['date'];

    $query = 'UPDATE reply_comments SET reply_comment=:reply_comment where date=:date';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':date' => $date,
        ':reply_comment' => $newReply
    ]);
    echo json_encode('200');
    //  redirect('/');
}
