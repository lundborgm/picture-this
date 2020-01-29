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
    echo json_encode('hhh');
  //  redirect('/');
}
?>