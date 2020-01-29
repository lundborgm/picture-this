<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path): void
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
 * Display error-messages and then unset them
 *
 * @return void
 */
function displayError(): void
{
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo $error;

            unset($_SESSION['errors']);
        }
    }
}

/**
 * Display messages and then unset them
 *
 * @return void
 */
function displayMessage(): void
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
 * @param integer $profileId
 *
 * @param PDO $pdo
 *
 * @return array
 */
function getPostById(int $profileId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE author_id = :profile_id ORDER BY date DESC');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':profile_id' => $profileId
    ]);

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}


function getPostBySearch($pdo,$search)
{   
      
    if($search === NULL){
        return getAllPosts($pdo);
       
    }else{

        
        $post = "SELECT users.name, posts.* FROM users
          LEFT JOIN posts
           ON posts.author_id = users.id WHERE name LIKE ?";
        $statementPost = $pdo->prepare($post);
        
        if (!$statementPost) {
            die(var_dump($pdo->errorInfo()));
        }
        
        $statementPost->execute([
            "%" . $search . "%",
            ]);
            $postSearch = $statementPost->fetchAll(PDO::FETCH_ASSOC);
            
            return $postSearch;
        }
    
}

/**
 * Select a specific post to be able to update it
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
 * Get all posts from the database and some user-info to display in feed
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
 * Count the likes of a specific post
 *
 * @param integer $postId
 *
 * @param PDO $pdo
 *
 * @return integer
 */
function countLikes(int $postId, PDO $pdo): int
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
 * Check if user is following another user
 *
 * @param integer $userId
 *
 * @param integer $profileId
 *
 * @param PDO $pdo
 *
 * @return boolean
 */
function checkIfFollowing(int $userId, int $profileId, PDO $pdo): bool
{
    $statement = $pdo->prepare('SELECT * FROM follow WHERE user_id = :user_id AND profile_id = :profile_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id' => $userId,
        ':profile_id' => $profileId
    ]);

    $follow = $statement->fetch(PDO::FETCH_ASSOC);

    if ($follow) {
        return true;
    } else {
        return false;
    }
}

/**
 * Count how many followers the selected user has
 *
 * @param integer $profileId
 *
 * @param PDO $pdo
 *
 * @return integer
 */
function countFollowers(int $profileId, PDO $pdo): int
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM follow WHERE profile_id = :profile_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':profile_id' => $profileId
    ]);

    $followers = $statement->fetch(PDO::FETCH_ASSOC);

    return (int)$followers["COUNT(*)"];
}

/**
 * Count how many users the selected user is following
 *
 * @param integer $userId
 *
 * @param PDO $pdo
 *
 * @return integer
 */
function countFollowing(int $userId, PDO $pdo): int
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM follow WHERE user_id = :user_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id' => $userId
    ]);

    $following = $statement->fetch(PDO::FETCH_ASSOC);

    return (int)$following["COUNT(*)"];
}

/**
 * Get information about a users followers
 *
 * @param integer $profileId
 *
 * @param PDO $pdo
 *
 * @return array
 */
function displayFollowersList(int $profileId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM follow INNER JOIN users on user_id = users.id WHERE profile_id = :profile_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':profile_id' => $profileId
    ]);

    $followersList = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $followersList;
}

/**
 * Get information about the users that the selected user is following
 *
 * @param integer $userId
 *
 * @param PDO $pdo
 *
 * @return array
 */
function displayFollowingList(int $userId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM follow INNER JOIN users on profile_id = users.id WHERE user_id = :user_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id' => $userId
    ]);

    $followingList = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $followingList;
}

/**
 * Get comments from database
 *
 * @param integer $postId
 *
 * @param PDO $pdo
 *
 * @return array
 */
function getComments(int $postId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT comments.id, comment, name,user_id FROM comments INNER JOIN users on user_id = users.id WHERE post_id = :post_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':post_id' => $postId
    ]);

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $comments;
}

/**
 * Display the name of the user who commented on a post
 *
 * @param integer $userId
 *
 * @param PDO $pdo
 *
 * @return array
 */
function getUsernameFromComment(int $userId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT name,user_id FROM comments INNER JOIN users on user_id = users.id WHERE user_id = :user_id');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id' => $userId
    ]);

    $username = $statement->fetch(PDO::FETCH_ASSOC);

    return $username;
}
