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

<?php $followingList = displayFollowingList($authorId, $pdo); ?>

<ul>
    <?php foreach ($followingList as $following): ?>
        <li>
            <img class="post-avatar" src="<?php echo "uploads/avatar/".$following['avatar_image']; ?>" alt="">
            <a class="visit-profile" href="<?php echo "visitprofile.php?id=".$following['id']; ?>"><h3> <?php echo $following['name']; ?> </h3></a>
        </li>
    <?php endforeach; ?>
</ul>


<?php require __DIR__.'/views/footer.php'; ?>
