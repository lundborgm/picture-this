<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

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
