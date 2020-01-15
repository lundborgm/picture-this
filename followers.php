<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!loggedIn()) {
    redirect('/');
}

displayMessage();

displayError();

$authorId = (int)$_GET['id'];

?>

<?php $followersList = displayFollowersList($authorId, $pdo); ?>

<ul class="follow-list">
    <?php foreach ($followersList as $follower):?>
        <li>
            <img class="post-avatar" src="<?php echo "uploads/avatar/".$follower['avatar_image']; ?>" alt="">
            <a class="visit-profile" href="<?php echo "visitprofile.php?id=".$follower['id']; ?>"><h3> <?php echo $follower['name']; ?> </h3></a>
        </li>
    <?php endforeach; ?>
</ul>


<?php require __DIR__.'/views/footer.php'; ?>
