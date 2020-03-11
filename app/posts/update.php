<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['content'], $_FILES['image'])) {
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $fileType = $image['type'];
    $allowed = [
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/gif'
    ];

    date_default_timezone_set('Europe/Stockholm');
    $date = date('Y/m/d H:i');

    $postId = (int)filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $authorId = (int)filter_var($_GET['author_id'], FILTER_SANITIZE_NUMBER_INT);
    $userId = (int)$_SESSION['user']['id'];

    // The users should only be able to edit their own posts
    if ($userId !== $authorId) {
        $_SESSION['errors'] = ["Ooops, you can only edit your own posts!"];
        redirect('/profile.php');
    } else {
        if (!in_array($fileType, $allowed)) {
            $_SESSION['errors'] = ["The image file type is not allowed. Please use png, jpg, jpeg or gif."];
        } elseif ($image['size'] > 3145728) {
            $_SESSION['errors'] = ["The image exceeded the file size limit of 3MB. Please try again."];
        } else {
            $destination = __DIR__.'/../../uploads/'.$imageName;

            move_uploaded_file($image['tmp_name'], $destination);

            $query = 'UPDATE posts SET content = :content, image = :image, date = :date WHERE id = :id';
            $statement = $pdo->prepare($query);

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->execute([
                ':content' => $content,
                ':image' => $imageName,
                ':date' => $date,
                ':id' => $postId
                ]);
        }
    }
}

redirect('/profile.php');
