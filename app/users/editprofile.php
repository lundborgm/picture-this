<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_FILES['avatar'])) {

    $avatar = $_FILES['avatar'];
    $avatarName = $avatar['name'];
    $date = date('ymd');
    $avatarUrl = $date.'-'.$avatarName;


    if ($avatar['type'] !== 'image/png') {
        echo 'The image file type is not allowed.';
    }

    elseif ($avatar['size'] > 3000000) {
        echo 'The uploaded file exceeded the file size limit.';
    }

    else {
        $destination = __DIR__.'/../../uploads/avatar/'.$avatarUrl;

        move_uploaded_file($avatar['tmp_name'], $destination);

        $_SESSION['messages'] = ["Success!"];

        // Insert the image url to the database
        $id = $_SESSION['user']['id'];

        $statement = $pdo->prepare('UPDATE users set avatar_url = :avatar_url WHERE id = :id');

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':avatar_url' => $avatarUrl,
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
