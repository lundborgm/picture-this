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

/**
 * Get user from the database
 *
 * @param integer $userId
 *
 * @param string $dbPath
 *
 * @return array
 */
function getUserById(int $userId, string $dbPath = 'sqlite:app/database/database.db'): array
{
    $pdo = new PDO($dbPath);
    $query = 'SELECT * FROM users WHERE id = :id';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $userId
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

/**
 * Get posts from the database
 *
 * @param integer $authorId
 *
 * @param string $dbPath
 *
 * @return array
 */
function getPostById(int $authorId, string $dbPath = 'sqlite:app/database/database.db'): array
{
    $pdo = new PDO($dbPath);
    $query = 'SELECT * FROM posts WHERE author_id = :author_id';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':author_id' => $authorId
    ]);

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

/**
 * Get posts from the database -> edit posts
 *
 * @param integer $postId
 *
 * @param string $dbPath
 *
 * @return array
 */
function editPost(int $postId, string $dbPath = 'sqlite:app/database/database.db'): array
{
    $pdo = new PDO($dbPath);
    $query = 'SELECT * FROM posts WHERE id = :id';
    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $postId
    ]);

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
