<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['password'])) {

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id = filter_var($_SESSION['user']['id'], FILTER_SANITIZE_NUMBER_INT);

    // Change password
    $query = 'UPDATE users SET password = :password WHERE id = :id';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':password' => $password,
        ':id' => $id
        ]);
}

redirect('/editprofile.php');
