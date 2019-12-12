<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!isset($_SESSION['user'])) {
    redirect('/');
}

?>

<article>
    <h1>Profile</h1>
        <p>Hello, <?php echo $_SESSION['user']['name']; ?>. This is your profile.</p>
        <h2>Biography</h2>
        <p><?php echo $_SESSION['user']['biography']; ?></p>

        <a href="editprofile.php"><button>Edit profile</button></a>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
