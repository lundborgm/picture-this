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

        <div class="follow">
            <?php $followers = countFollowers((int)$_SESSION['user']['id'], $pdo); ?>
            <?php $following = countFollowing((int)$_SESSION['user']['id'], $pdo); ?>
            <a href="<?php echo "followers.php?id=".$authorId; ?>">Followers: <span class="followers"><?php echo $followers; ?></span></a>
            <a href="<?php echo "following.php?id=".$authorId; ?>">Following: <span class="followers"><?php echo $following; ?></span></a>
        </div>

        <a href="editprofile.php"><button><i class="fas fa-cog"></i></button></a>
        <a href="newpost.php"><button>New post</button></a>
    </div>

    <div class="post-wrapper">
        <?php foreach ($posts as $post): ?>
            <article class="profile-posts">
                <h2> <?php echo $post['title']; ?> </h2>
                <a href="<?php echo "editpost.php?id=".$post['id']; ?>"><button><i class="fas fa-edit"></i></button></a>
                <img class="post-image" src="<?php echo "uploads/".$post['image']; ?>" alt="">
                <p> <?php echo $post['content']; ?> </p>
                <small> <?php echo "Posted by: ".$user['name']; ?></small>
                <small> <?php echo "Published: ".$post['date']; ?></small>
            </article>
        <?php endforeach; ?>
    </div>

<?php require __DIR__.'/views/footer.php'; ?>
