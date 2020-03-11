<?php
require __DIR__.'/../autoload.php';
header('Content-Type: application/json');

if (isset($_POST['search'])) {
    $search  =filter_var($_POST['search'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);


    $users = "SELECT id,name,avatar_image FROM users WHERE name LIKE ?";
    
    $statementUsers = $pdo->prepare($users);
    
    if (!$statementUsers) {
        die(var_dump($pdo->errorInfo()));
    }

    $statementUsers->execute([
    "%".$search."%",
]);
    $usersSearch = $statementUsers->fetchAll(PDO::FETCH_ASSOC);


    $usersAndSearch =[
    'users' => $usersSearch,
    'search' =>$search
];
    echo json_encode($usersAndSearch);
}
