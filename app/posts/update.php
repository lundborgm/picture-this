<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// if (isset($_FILES['image'])) {


// }

if (isset($_POST['title'])) {

    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $postId = $_GET['id'];

    $query = 'UPDATE posts SET title = :title WHERE id = :id';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':title' => $title,
        ':id' => $postId
        ]);
}

// if (isset($_POST['content'])) {

// }

redirect('/profile.php');
