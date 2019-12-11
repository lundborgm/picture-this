<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'])) {

    $newEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $id = filter_var($_SESSION['user']['id'], FILTER_SANITIZE_NUMBER_INT);

    // Update email
    $query = 'UPDATE users SET email = :email WHERE id = :id';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':email' => $newEmail,
        ':id' => $id
        ]);
}

redirect('/../profile.php');
