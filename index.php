<?php

require __DIR__.'/views/header.php';

$allPosts = getAllPosts($pdo);

?>

    <div class="profile-page">
        <h1><?php echo $config['title']; ?></h1>
        <p>Home page.</p>
        <?php if (loggedIn()): ?>
        <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
    </div>

    <div class="post-wrapper">
        <?php foreach ($allPosts as $post): ?>
            <div class="profile-posts">
                <?php $likes = countLikes($post['id'], $pdo) ?>

                <h2> <?php echo $post['title']; ?> </h2>
                <img class="post-image" src="<?php echo "uploads/".$post['image']; ?>" alt="">
                <p> <?php echo $post['content']; ?> </p>
                <small> <?php echo "Posted by: ".$post['name']; ?></small>
                <small> <?php echo "Published: ".$post['date']; ?></small>
                <p>Likes: <?php echo $likes; ?></p>
                <form class="like-form" action="/app/posts/likes.php" method="post">
                    <input type="hidden" name="like" id="like" value=" <?= $post['id'] ?>">
                    <button class="like-btn" type="submit"><i class="far fa-star fa-2x"></i></button>
                </form>

            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php require __DIR__.'/views/footer.php'; ?>
