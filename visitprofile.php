<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!loggedIn()) {
    redirect('/');
}

displayMessage();

displayError();

$allPosts = getAllPosts($pdo);

$authorId = intval($_GET['id']);

$user = getUserById($authorId, $pdo);

$posts = getPostById($authorId, $pdo);




?>

<div class="profile-page">

        <h2>Biography</h2>
        <p><?php echo $user['biography']; ?></p>
        <img class="avatar" src="<?php echo "uploads/avatar/".$user['avatar_image']; ?>" alt="">

        <?php $follows = countFollows($user['id'], $authorId, $pdo); ?>
        <form class="follow-form" action="/app/users/follow.php" method="post">
            <input type="hidden" name="follow" id="follow" value=" <?= $user['id'] ?>">
            <button class="follow-btn" type="submit">
            <?php if (checkIfFollowing($_SESSION['user']['id'], $authorId, $pdo)): ?>
                        Unfollow
                    <?php else: ?>
                        Follow
                    <?php endif; ?>
                </button>
        </form>
    </div>

    <div class="post-wrapper">
        <?php foreach ($posts as $post): ?>
            <div class="profile-posts">
                <?php $likes = countLikes($post['id'], $pdo) ?>

                <!-- <h2> <?php echo $post['title']; ?> </h2> -->
                <div class="post-header">
                    <img class="post-avatar" src="<?php echo "uploads/avatar/".$user['avatar_image']; ?>" alt="">
                   <a class="visit-profile" href="<?php echo "visitprofile.php?id=".$post['author_id']; ?>"><h3> <?php echo $user['name']; ?> </h3></a>
                </div>

                <img class="post-image" src="<?php echo "uploads/".$post['image']; ?>" alt="">
                <form class="like-form" action="/app/posts/likes.php" method="post">
                <input type="hidden" name="like" id="like" value=" <?= $post['id'] ?>">
                <button class="like-btn" type="submit">
                    <?php if (checkForLikes($post['id'], $_SESSION['user']['id'], $pdo)): ?>
                        <i class="fa-star fa-2x fas"></i>
                    <?php else: ?>
                        <i class="fa-star fa-2x far"></i>
                    <?php endif; ?>
                </button>
                <p class="likes"><?php if ($likes === 0): ?>
                    <?php echo '' ?>
                    <?php else: ?>
                    <?php echo $likes; ?>
                    <?php endif; ?></p>
                </form>
                <div class="content">
                    <p><span class="name"><?php echo $user['name']; ?></span> <?php echo $post['content']; ?></p>
                    <small> <?php echo "Published: ".$post['date']; ?></small>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

<?php require __DIR__.'/views/footer.php'; ?>
