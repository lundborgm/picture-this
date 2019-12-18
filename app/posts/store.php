<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

 // Create a new post and insert into the database
if (isset($_POST['title'], $_FILES['image'], $_POST['content'])) {

    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $content = filter_var( $_POST['content'], FILTER_SANITIZE_STRING);
    $image = $_FILES['image'];
    $imageName = $image['name'];

    date_default_timezone_set('Europe/Stockholm');
    $date = date('Y/m/d H:i');

    // $uploadedImage = $date.'-'.$imageName;

    if ($image['type'] !== 'image/png') {
        $_SESSION['errors'] = ["The image file type is not allowed."];
    }

    elseif ($image['size'] > 3000000) {
        $_SESSION['errors'] = ["The uploaded file exceeded the file size limit."];
    }

    else {
        $destination = __DIR__.'/../../uploads/'.$imageName;

        move_uploaded_file($image['tmp_name'], $destination);

        $_SESSION['messages'] = ["Success!"];

        $authorId = $_SESSION['user']['id'];

        $statement = $pdo->prepare('INSERT INTO posts (title, content, author_id, image, date) VALUES (:title, :content, :author_id, :image, :date)');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':title' => $title,
            ':content' => $content,
            ':author_id' => $authorId,
            ':image' => $imageName,
            ':date' => $date
            ]);
    }
}

redirect('/newpost.php');
