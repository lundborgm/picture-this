<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['old-password'], $_POST['new-password'], $_POST['confirm-password'])) {
    $password = $_POST['old-password'];
    $id = $_SESSION['user']['id'];

    $query = 'SELECT * FROM users WHERE id = :id';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
    ':id' => $id
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if old password is the same as in the database, and if the new one is equal to confirm-password.
    if (password_verify($password, $user['password']) && $_POST['new-password'] === $_POST['confirm-password']) {
        $newPassword = password_hash($_POST['new-password'], PASSWORD_DEFAULT);
        $id = $_SESSION['user']['id'];

        // Change password
        $query = 'UPDATE users SET password = :password WHERE id = :id';
        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
        ':id' => $id,
        ':password' => $newPassword
    ]);

        $_SESSION['messages'] = ["The password was changed!"];
    } else {
        $_SESSION['errors'] = ["Wrong password, try again."];
    }
}

redirect('/editprofile.php');
