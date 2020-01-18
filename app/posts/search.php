<?php
require __DIR__.'/../autoload.php';
print_r($_SESSION);
$query = 'SELECT * FROM s WHERE post_id = :post_id AND user_id = :user_id';

$statement = $pdo->prepare($query);

if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}
/* 
$statement->execute([
    ':post_id' => $postId,
    ':user_id' => $userId,
]); */

echo 'hello'
;?>