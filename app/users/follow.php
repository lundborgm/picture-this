<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');

if (isset($_POST['follow'])) {

    $profileId = (int)$_POST['follow'];
    $userId = (int)$_SESSION['user']['id'];

    if (checkIfFollowing($userId, $profileId, $pdo)) {
        // Unfollow if already following

        $query = 'DELETE FROM follow WHERE user_id = :user_id AND following = :following';

        $statement = $pdo->prepare($query);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':user_id' => $userId,
            ':following' => $profileId,
        ]);

    } else {

    $query = 'INSERT INTO follow (user_id, following) VALUES (:user_id, :following)';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id' => $userId,
        ':following' => $profileId,
    ]);
    }

    $follows = countFollows($userId, $profileId, $pdo);
    echo json_encode($follows);

}

// redirect('/');
