<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['name'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $query = 'SELECT * FROM users WHERE email = :email';
    $statement = $pdo->prepare($query);

    $statement->execute([
        ':email' => $email
    ]);

    $emailExist = $statement->fetch(PDO::FETCH_ASSOC);

    // If email exists print errormessage
    if ($emailExist) {
        $_SESSION['errors'] = ["The email $email is already taken"];

        redirect('/signup.php');
    }

    // Create a new account
    $query = 'INSERT INTO users (name, email, password, avatar_image) VALUES (:name, :email, :password, :avatar_image)';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $password,
        ':avatar_image' => 'avatar.png'
        ]);
}

redirect('/');
