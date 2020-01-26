<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');


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
 
 redirect('/') ; 
}
?>