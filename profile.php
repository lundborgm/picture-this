<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!loggedIn()) {
    redirect('/');
}

$user = getUserById($_SESSION['user']['id'], $pdo);

$userId = (int)$user['id'];

$avatar = $user['avatar_image'];

$biography = $user['biography'];

$posts = getPostById($_SESSION['user']['id'], $pdo);

?>

<p class="error"> <?php displayError(); ?> </p>
<p class="message"> <?php displayMessage(); ?> </p>

<div class="profile-page">
    <div class="profile-header">
        <img class="avatar" src="<?php echo "uploads/avatar/".$avatar; ?>" alt="">

        <div class="profile-info">
            <h3><?php echo $_SESSION['user']['name']; ?></h3>
            <p><?php echo $biography; ?></p>
        </div>
    </div>
    <a href="editprofile.php"><button class="edit-btn">Edit profile information</button></a>


    <div class="follow">
        <?php $followers = countFollowers($userId, $pdo); ?>
        <?php $following = countFollowing($userId, $pdo); ?>
        <a href="<?php echo "followers.php?id=".$userId; ?>">Followers: <span class="followers"><?php echo $followers; ?></span></a>
        <a href="<?php echo "following.php?id=".$userId; ?>">Following: <span class="followers"><?php echo $following; ?></span></a>
    </div>
</div>

<div class="post-wrapper">
    <?php foreach ($posts as $post): ?>
        <div class="profile-posts">
            <?php $likes = countLikes($post['id'], $pdo) ?>

            <div class="post-header profile">
                <img class="post-avatar" src="<?php echo "uploads/avatar/".$avatar; ?>" alt="">
                <h3> <?php echo $user['name']; ?> </h3>
                <a href="<?php echo "editpost.php?id=".$post['id']."&author_id=".$post['author_id']; ?>"><button><i class="fas fa-edit"></i></button></a>
            </div>

            <img class="post-image" src="<?php echo "uploads/".$post['image']; ?>" alt="">
            <form class="like-form" action="/app/posts/likes.php" method="post">
            <input type="hidden" name="like" id="like" value=" <?= $post['id'] ?>">
            <button class="like-btn" type="submit">
                <?php if (checkForLikes($post['id'], $userId, $pdo)): ?>
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

            <?php $comments = getComments($post['id'], $pdo) ?>
            <div class="comment-wrapper">
                <ul class="comment-list">
                    <?php foreach ($comments as $comment): ?>
                        <li class="comments">
                            <p class="author"><?php echo $comment['name']; ?></p>
                            <p class="comment"><?php echo $comment['comment']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <form class="comment-form" action="/app/posts/comments.php" method="post">
                    <li class="comments">
                        <p class="author"></p>
                        <p class="comment"></p>
                    </li>
                    <div class="comment-input">
                        <input type="text" name="comment" id="comment" value="">
                        <input type="hidden" name="post-id" id="post-id" value=" <?= $post['id'] ?>">
                        <button class="send" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
