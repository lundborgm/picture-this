<?php
require __DIR__.'/../autoload.php';
header('Content-Type: application/json');

if(isset($_POST['search'])){
    $search  =filter_var($_POST['search'],FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $post = "SELECT users.name, posts.* FROM users
          LEFT JOIN posts
           ON posts.author_id = users.id WHERE name LIKE ?" ;

$users = "SELECT id,name,avatar_image FROM users WHERE name LIKE ?";


$statementPost = $pdo->prepare($post);
if (!$statementPost) {
    die(var_dump($pdo->errorInfo()));
}

$statementPost->execute([
    "%".$search."%",
    ]); 
    $postSearch = $statementPost->fetchAll(PDO::FETCH_ASSOC);
    
    
    $statementUsers = $pdo->prepare($users);
    
    if (!$statementUsers) {
        die(var_dump($pdo->errorInfo()));
}

$statementUsers->execute([
    "%".$search."%",
]);
$usersSearch = $statementUsers->fetchAll(PDO::FETCH_ASSOC);

$usersAndPost =[
    'users' => $usersSearch,
    'posts' => $postSearch
];

    echo json_encode($usersAndPost);
   
}  
?>