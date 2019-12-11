<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['name'], $_POST['password'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $errorMessage = "The email $email already exists!";

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
    $query = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
    $statement = $pdo->prepare($query);

    $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $password,
        ]);

    }

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

redirect('/');
