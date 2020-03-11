<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

 // Create a new post and insert into the database
if (isset($_FILES['image'], $_POST['content'])) {
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

    if (!in_array($fileType, $allowed)) {
        $_SESSION['errors'] = ["The image file type is not allowed. Please use png, jpg, jpeg or gif."];
    } elseif ($image['size'] > 3145728) {
        $_SESSION['errors'] = ["The image exceeded the file size limit of 3MB. Please try again."];
    } else {
        $destination = __DIR__.'/../../uploads/'.$imageName;

        move_uploaded_file($image['tmp_name'], $destination);

        $_SESSION['messages'] = ["Success!"];

        $authorId = $_SESSION['user']['id'];

        $statement = $pdo->prepare('INSERT INTO posts (content, author_id, image, date) VALUES (:content, :author_id, :image, :date)');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':content' => $content,
            ':author_id' => $authorId,
            ':image' => $imageName,
            ':date' => $date
            ]);
    }
}

redirect('/newpost.php');
