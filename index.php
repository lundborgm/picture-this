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

                <!-- <h2> <?php echo $post['title']; ?> </h2> -->
                <div class="post-header">
                    <img class="post-avatar" src="<?php echo "uploads/avatar/".$post['avatar_image']; ?>" alt="">
                   <a class="visit-profile" href="<?php echo "visitprofile.php?id=".$post['author_id']; ?>"><h3> <?php echo $post['name']; ?> </h3></a>
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
                    <p><span class="name"><?php echo $post['name']; ?></span> <?php echo $post['content']; ?></p>
                    <small> <?php echo "Published: ".$post['date']; ?></small>
                </div>

                <?php $comments = getComments($post['id'], $pdo) ?>
                <div class="comment-wrapper">
                    <form class="comment-form" action="/app/posts/comments.php" method="post">
                        <input type="text" name="comment" id="comment" value="">
                        <input type="hidden" name="post-id" id="post-id" value=" <?= $post['id'] ?>">
                        <button class="send" type="submit">Send</button>
                        <ul class="comment-list">
                            <?php foreach ($comments as $comment): ?>
                                <li class="comment"><?php echo $comment['comment']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </form>
                </div>

            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php require __DIR__.'/views/footer.php'; ?>
