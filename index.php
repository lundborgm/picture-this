<?php
//require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';
if (loggedIn()) {
} else {
    redirect('/login.php');
}

$allPosts = getAllPosts($pdo);



?>

<div class="post-wrapper">
    <?php foreach ($allPosts as $post) : ?>

        <div class="profile-posts">
            <?php $likes = countLikes($post['id'], $pdo) ?>

            <div class="post-header">
                <img class="post-avatar" src="<?php echo "uploads/avatar/" . $post['avatar_image']; ?>" alt="">
                <a class="visit-profile" href="<?php echo "visitprofile.php?id=" . $post['author_id']; ?>">
                    <h3> <?php echo $post['name']; ?> </h3>
                </a>
            </div>

            <img class="post-image" src="<?php echo "uploads/" . $post['image']; ?>" alt="">
            <form class="like-form" action="/app/posts/likes.php" method="post">
                <input type="hidden" name="like" id="like" value=" <?= $post['id'] ?>">
                <button class="like-btn" type="submit">
                    <?php if (checkForLikes($post['id'], $_SESSION['user']['id'], $pdo)) : ?>
                        <i class="fa-star fa-2x fas"></i>
                    <?php else : ?>
                        <i class="fa-star fa-2x far"></i>
                    <?php endif; ?>
                </button>
                <p class="likes"><?php if ($likes === 0) : ?>
                        <?php echo '' ?>
                    <?php else : ?>
                        <?php echo $likes; ?>
                    <?php endif; ?></p>
            </form>

            <div class="content">
                <p><span class="name"><?php echo $post['name']; ?></span> <?php echo $post['content']; ?></p>
                <small> <?php echo "Published: " . $post['date']; ?></small>
            </div>

            <?php $comments = getComments($post['id'], $pdo) ?>
            <div class="comment-wrapper">
                <ul class="comment-list">
                    <?php foreach ($comments as $comment) : ?>
                        <div class="comment-box">
                            <li class="comments">
                                <p class="author"><?php echo $comment['name']; ?></p>
                                <p class="comment"><?php echo $comment['comment']; ?></p>
                            </li>
                            <!-- you working here-->
                            <li>
                                <div class="edit-box">
                                    <?php if ($_SESSION['user']['id'] === $post['author_id']) : ?>
                                        <button class="send edit-comment">Edit</button>
                                        <form class="delete-comment-form" action="/app/posts/deleteComment.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="comment-id" value="<?php echo $comment['id'] ?>">
                                            <button type="submit" class="send delete-comment" name="delete-comment">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                    <button class="send reply-comment">Reply</button>
                                </div>
                            </li>
                            <li class="reply-text">
                                <!--foreach loop-->
                                <p class="author">k<?php ?></p>
                                <p class="comment">k<?php ?></p>

                            </li>
                            <li class='reply-edit'>
                                <?php if ($_SESSION['user']['id'] === $post['author_id']) : ?>
                                    <form action="post">
                                        <button class="send edit-comment">Edit</button>
                                    </form>
                                    <form class="delete-comment-form" action="/app/posts/deleteComment.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="comment-id" value="<?php echo $comment['id'] ?>">
                                        <button type="submit" class="send delete-comment" name="delete-comment">Delete</button>
                                    </form>
                                <?php endif; ?>
                            </li>
                        </div>
                    <?php endforeach; ?>
                </ul>
                <form class="comment-form" action="/app/posts/comments.php" method="post">
                    <li class="comments">
                        <p class="author"></p>
                        <p class="comment"></p>
                    </li>
                    <div class="comment-container">
                        <input class="comment-input" type="text" name="comment" id="comment" value="">
                        <input type="hidden" name="post-id" id="post-id" value=" <?= $post['id'] ?>">
                        <button class="send" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>