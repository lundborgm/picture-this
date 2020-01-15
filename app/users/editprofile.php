<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_FILES['avatar'])) {

    $avatar = $_FILES['avatar'];
    $avatarName = $avatar['name'];
    $date = date('ymd');
    $avatarImage = $date.'-'.$avatarName;
    $fileType = $avatar['type'];
    $allowed = [
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/gif'
    ];

    if (!in_array($fileType, $allowed)){
        $_SESSION['errors'] = ["The image file type is not allowed. Please use png, jpg, jpeg or gif."];
    }

    elseif ($avatar['size'] > 3145728) {
        $_SESSION['errors'] = ["The image exceeded the file size limit of 3MB. Please try again."];
    }

    else {
        $destination = __DIR__.'/../../uploads/avatar/'.$avatarImage;

        move_uploaded_file($avatar['tmp_name'], $destination);

        $_SESSION['messages'] = ["Success!"];

        // Insert the image filename to the database
        $id = $_SESSION['user']['id'];

        $statement = $pdo->prepare('UPDATE users set avatar_image = :avatar_image WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':avatar_image' => $avatarImage,
            ':id' =>  $id
        ]);
    }
}

if (isset($_POST['biography'])) {

    $bio = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);
    $id = filter_var($_SESSION['user']['id'], FILTER_SANITIZE_NUMBER_INT);

    // Update biography
    $query = 'UPDATE users SET biography = :biography WHERE id = :id';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':biography' => $bio,
        ':id' => $id
        ]);
}

if (isset($_POST['email'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $id = filter_var($_SESSION['user']['id'], FILTER_SANITIZE_NUMBER_INT);

    // Update email
    $query = 'UPDATE users SET email = :email WHERE id = :id';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':email' => $email,
        ':id' => $id
        ]);
}

redirect('/editprofile.php');
