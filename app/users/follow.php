<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

header('Content-Type: application/json');

if (isset($_POST['follow'])) {

    $profileId = (int)$_POST['follow'];
    $userId = (int)$_SESSION['user']['id'];

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

redirect('/');
