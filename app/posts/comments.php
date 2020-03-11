<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');


if (isset($_POST['reply-text'])) {
    $commentId = $_POST['comment-id'];
    $postId = $_POST['post-id'];
    $reply = $_POST['reply-text'];
    $name = $_POST['comment-name'];
    date_default_timezone_set('Europe/Stockholm');
    $date = date('Y/m/d H:i:s');
   
    $queryInsert = "INSERT INTO reply_comments(comment_id,post_id,user_id,reply_comment,date)VALUES(:comment_id,:post_id,:user_id,:reply_comment,:date)";
   
    $statement = $pdo -> prepare($queryInsert);
   

    $statement ->execute([
        ':comment_id'=>$commentId,
        ':post_id'=>$postId,
        ':user_id'=>$_SESSION['user']['id'],
        ':reply_comment' => $reply,
        ':date' => $date,
    ]);

    $queryFetch = "SELECT reply_comments.reply_comment, reply_comments.user_id, users.name
                    FROM reply_comments LEFT JOIN users ON reply_comments.user_id = users.id WHERE date = :date";
    $statement = $pdo->prepare($queryFetch);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement -> execute([
        ':date' => $date
    ]);
    $fetchReply = $statement->fetch(PDO::FETCH_ASSOC);
    echo json_encode($fetchReply);
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
        'name' => $names['name'],
        'user_id' => $names['user_id']
    ]);
    
    
    echo json_encode($comments);
}

// redirect('/');
