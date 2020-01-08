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
 * Check if user is logged in using SESSION
 *
 * @return boolean
 */
function loggedIn(): bool
{
    return isset($_SESSION['user']);
}

/**
 *
 *
 */
function displayError()
{
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo $error;

            unset($_SESSION['errors']);
        }
    }
}

/**
 *
 *
 */
function displayMessage()
{
    if (isset($_SESSION['messages'])) {
        foreach ($_SESSION['messages'] as $message) {
            echo $message;

            unset($_SESSION['messages']);
        }
    }
}

/**
 * Get user from the database
 *
 * @param integer $userId
 *
 * @param PDO $pdo
 *
 * @return array
 */
function getUserById(int $userId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT id, name, email, biography, avatar_image FROM users WHERE id = :id');

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
 * @param PDO $pdo
 *
 * @return array
 */
function getPostById(int $authorId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE author_id = :author_id ORDER BY date DESC');

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
 * @param PDO $pdo
 *
 * @return array
 */
function editPost(int $postId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $postId
    ]);

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

/**
 * Get all posts from the database
 *
 * @param PDO $pdo
 *
 * @return array
 */
function getAllPosts(PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT posts.*, users.name, users.avatar_image FROM posts INNER JOIN users WHERE author_id = users.id ORDER BY date DESC');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute();

    $allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $allPosts;
}

/**
 * Check for likes in the database
 *
 * @param integer $postId
 *
 * @param integer $userId
 *
 * @param PDO $pdo
 *
 * @return boolean
 *
 */
function checkForLikes(int $postId, int $userId, PDO $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':post_id' => $postId,
        ':user_id' => $userId
    ]);

    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    if ($likes) {
        return true;
    } else {
        return false;
    }
}

/**
 *
 *
 */
function countLikes(int $postId, PDO $pdo)
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM likes WHERE post_id = :post_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':post_id' => $postId
    ]);

    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    return (int)$likes["COUNT(*)"];
}

/**
 *
 *
 */
function checkIfFollowing(int $userId, int $follow ,PDO $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM follow WHERE user_id = :user_id AND following = :following');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id' => $userId,
        ':following' => $follow
    ]);

    $follow = $statement->fetch(PDO::FETCH_ASSOC);

    if ($follow) {
        return true;
    } else {
        return false;
    }
}

/**
 *
 *
 */
function countFollows(int $userId, int $follow ,PDO $pdo)
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM follow WHERE user_id = :user_id AND following = :following');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id' => $userId,
        ':following' => $follow
    ]);

    $follow = $statement->fetch(PDO::FETCH_ASSOC);

    return (int)$follow["COUNT(*)"];
}

/**
 *
 *
 */
function countFollowers(int $follow, PDO $pdo)
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM follow WHERE following = :following');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':following' => $follow
    ]);

    $followers = $statement->fetch(PDO::FETCH_ASSOC);

    return (int)$followers["COUNT(*)"];
}
