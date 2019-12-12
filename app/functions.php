<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

function getUserById($pdo, $userId)
{

    $userId = $_SESSION['user']['id'];
    $query = 'SELECT * FROM users WHERE id = :id';

    $statement = $pdo->prepare($query);
    $statement->execute([
        ':id' => $userId
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

}
