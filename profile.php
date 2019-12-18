<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!loggedIn()) {
    redirect('/');
}

displayError();

displayMessage();

$user = getUserById($_SESSION['user']['id'], $pdo);
$avatar = $user['avatar_image'];
$biography = $user['biography'];

$posts = getPostById($_SESSION['user']['id'], $pdo);

?>

    <div class="profile-page">
        <h1>Profile</h1>
        <p>Hello, <?php echo $_SESSION['user']['name']; ?>. This is your profile.</p>
        <h2>Biography</h2>
        <p><?php echo $biography; ?></p>
        <img class="avatar" src="<?php echo "uploads/avatar/".$avatar; ?>" alt="">

        <a href="editprofile.php"><button>Edit profile</button></a>

        <a href="newpost.php"><button>New post</button></a>
    </div>

    <div class="post-wrapper">
        <?php foreach ($posts as $post): ?>
            <article class="profile-posts">
                <h2> <?php echo $post['title']; ?> </h2>
                <p> <?php echo $post['id']; ?></p>
                <a href="<?php echo "editpost.php?id=".$post['id']; ?>"><button>Edit post</button></a>
                <img class="post-image" src="<?php echo "uploads/".$post['image']; ?>" alt="">
                <p> <?php echo $post['content']; ?> </p>
                <small> <?php echo "Posted by: ".$user['name']; ?></small>
                <small> <?php echo "Published: ".$post['date']; ?></small>
            </article>
        <?php endforeach; ?>
    </div>

<?php require __DIR__.'/views/footer.php'; ?>
