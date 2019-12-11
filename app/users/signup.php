<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['name'], $_POST['password'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $statement = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
        }

    $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $password,
    ]);
}

redirect('/');
