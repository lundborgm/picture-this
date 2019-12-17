<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['title'], $_POST['content'], $_FILES['image'])) {

    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $content = filter_var( $_POST['content'], FILTER_SANITIZE_STRING);
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $date = date('ymd');
    $uploadedImage = $date.'-'.$imageName;
    $postId = $_GET['id'];

    if ($image['type'] !== 'image/png') {
        $_SESSION['errors'] = ["The image file type is not allowed."];
    }

    elseif ($image['size'] > 3000000) {
        $_SESSION['errors'] = ["The uploaded file exceeded the file size limit."];
    }

    else {
        $destination = __DIR__.'/../../uploads/'.$uploadedImage;

        move_uploaded_file($image['tmp_name'], $destination);

        $query = 'UPDATE posts SET title = :title, content = :content, image = :image WHERE id = :id';
        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':title' => $title,
            ':content' => $content,
            ':image' => $uploadedImage,
            ':id' => $postId
            ]);
    }
}

redirect('/profile.php');
