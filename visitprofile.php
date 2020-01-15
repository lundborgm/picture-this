<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!loggedIn()) {
    redirect('/');
}

$profileId = (int)$_GET['id'];

$user = getUserById($profileId, $pdo);

$posts = getPostById($profileId, $pdo);

if ($profileId === (int)$_SESSION['user']['id']) {
    redirect('profile.php');
}

?>

<p class="error"> <?php displayError(); ?> </p>
<p class="message"> <?php displayMessage(); ?> </p>

<div class="profile-page">
    <div class="profile-header">
        <img class="avatar" src="<?php echo "uploads/avatar/".$user['avatar_image']; ?>" alt="">

        <div class="profile-info">
            <h3><?php echo $user['name']; ?></h3>
            <p><?php echo $user['biography']; ?></p>
        </div>
    </div>

    <form class="follow-form" action="/app/users/follow.php" method="post">
        <input type="hidden" name="follow" id="follow" value=" <?= $user['id'] ?>">
        <button class="follow-btn" type="submit">
            <?php if (checkIfFollowing($_SESSION['user']['id'], $profileId, $pdo)): ?>
                Unfollow
            <?php else: ?>
                Follow
            <?php endif; ?>
        </button>
    </form>

    <div class="follow">
        <?php $followers = countFollowers($profileId, $pdo); ?>
        <?php $following = countFollowing($profileId, $pdo); ?>
        <a href="<?php echo "followers.php?id=".$profileId; ?>">Followers: <span class="followers"><?php echo $followers; ?></span></a>
        <a href="<?php echo "following.php?id=".$profileId; ?>">Following: <span class="followers"><?php echo $following; ?></span></a>
    </div>
</div>

<div class="post-wrapper">
    <?php foreach ($posts as $post): ?>
        <div class="profile-posts">
            <?php $likes = countLikes($post['id'], $pdo) ?>

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
